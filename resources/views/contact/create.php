<?php
    $render_full_page = !empty($render_full_page);
?>

<?php if($render_full_page): ?>
<div class="box box-primary contact-page-form">
    <div class="box-body">
<?php else: ?>
<div class="modal-dialog modal-xl modal-dialog-scrollable modal-fullscreen-sm-down" role="document">
    <div class="modal-content">
<?php endif; ?>
    <?php
    $form_id = 'contact_add_form';
    if(isset($quick_add)){
        $form_id = 'quick_add_contact';
    }

    if(isset($store_action)) {
        $url = $store_action;
        $type = 'lead';
        $customer_groups = [];
    } else {
        $url = action([\App\Http\Controllers\ContactController::class, 'store']);
        $type = isset($selected_type) ? $selected_type : '';
        $sources = [];
        $life_stages = [];
    }
    if($is_offline){
        $url = action([\App\Http\Controllers\OfflineSyncController::class, 'createContact']);
    }
    if(isset($customer)){
        $type = 'customer';
    }
    if(isset($supplier)){
        $type = 'supplier';
    }
    
    $selected_type = $type;
    
    // Phase 73: prefer controller-supplied per-branch common_settings / pos_settings; session is the fallback.
    $common_settings = isset($common_settings) && ! empty($common_settings)
        ? $common_settings
        : (session()->get('business.common_settings') ?? []);
    $pos_settings = isset($pos_settings) && ! empty($pos_settings) && is_array($pos_settings)
        ? $pos_settings
        : (json_decode(session()->get('business.pos_settings'), true) ?: []);
    if(empty($contact_type)){
        if($type == 'customer'){
            $contact_type = $common_settings['default_customer_type'];
        }else{
            $contact_type = $common_settings['default_supplier_type'];
        }
    }
    if(empty($types)){
        $types = [];
        if (auth()->user()->can('supplier.create')) {
            $types['supplier'] = __('report.supplier');
        }
        if (auth()->user()->can('customer.create')) {
            $types['customer'] = __('report.customer');
        }
        if (auth()->user()->can('supplier.create') && auth()->user()->can('customer.create')) {
            $types['both'] = __('lang_v1.both_supplier_customer');
        }
    }
    ?>
    <?php echo Form::open(['url' => $url, 'method' => 'post', 'id' => $form_id, 'class' => 'd-flex flex-column overflow-hidden flex-grow-1', 'style' => 'min-height:0', 'autocomplete' => 'off', 'data-redirect-url' => $render_full_page ? action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => $selected_type ?: $type]) : null, 'data-full-page' => $render_full_page ? 1 : 0 ]); ?>


    <?php if(!$render_full_page): ?>
    <div class="modal-header">
        <h4 class="modal-title"><?php echo app('translator')->get('contact.add_contact'); ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <?php endif; ?>


    <?php
        $api_key = env('GOOGLE_MAP_API_KEY');
    ?>
    <?php if(!empty($api_key)): ?>
        <style>
            .pac-container { z-index: 12000 !important; }
        </style>
        <script>
            (function() {
                var mapInstance;
                var mapMarkers = [];
                var geocoder;
                var contactMapFormId = '<?php echo e($form_id, false); ?>';
                var lastResolvedAddress = '';

                function clearMarkers() {
                    mapMarkers.forEach(function(marker) { marker.setMap(null); });
                    mapMarkers = [];
                }

                function setLocation(location, title, viewport) {
                    var form = document.getElementById(contactMapFormId);
                    var positionInput = form ? form.querySelector('input[name="position"]') : document.getElementById('position');
                    var lat = location.lat();
                    var lng = location.lng();

                    clearMarkers();
                    mapMarkers.push(new google.maps.Marker({
                        map: mapInstance,
                        title: title || '',
                        position: location
                    }));

                    if (positionInput) {
                        positionInput.value = lat + ',' + lng;
                    }

                    if (viewport) {
                        mapInstance.fitBounds(viewport);
                    } else {
                        mapInstance.setCenter(location);
                        mapInstance.setZoom(15);
                    }
                }

                function geocodeTypedAddress(input) {
                    var query = (input.value || '').trim();
                    if (!query || query === lastResolvedAddress || !geocoder || !mapInstance) { return; }

                    geocoder.geocode({ address: query }, function(results, status) {
                        if (status !== 'OK' || !results.length || !results[0].geometry) { return; }

                        lastResolvedAddress = query;
                        input.value = results[0].formatted_address || query;
                        setLocation(
                            results[0].geometry.location,
                            results[0].formatted_address || query,
                            results[0].geometry.viewport
                        );
                    });
                }

                function refreshMapSize() {
                    if (!mapInstance) { return; }
                    var center = mapInstance.getCenter();
                    google.maps.event.trigger(mapInstance, 'resize');
                    if (center) {
                        mapInstance.setCenter(center);
                    }
                }

                function initContactMap() {
                    var form = document.getElementById(contactMapFormId);
                    var mapEl = form ? form.querySelector('#map') : document.getElementById('map');
                    var input = form ? form.querySelector('input[name="shipping_address"]') : document.getElementById('shipping_address');
                    if (!mapEl || !input) { return; }

                    mapInstance = new google.maps.Map(mapEl, {
                        center: {lat: -33.8688, lng: 151.2195},
                        zoom: 10,
                        mapTypeId: 'roadmap'
                    });
                    geocoder = new google.maps.Geocoder();

                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            mapInstance.setCenter({lat: position.coords.latitude, lng: position.coords.longitude});
                        });
                    }

                    var searchBox = new google.maps.places.SearchBox(input);

                    mapInstance.addListener('bounds_changed', function() {
                        searchBox.setBounds(mapInstance.getBounds());
                    });

                    searchBox.addListener('places_changed', function() {
                        var places = searchBox.getPlaces();
                        if (!places.length) { return; }

                        clearMarkers();
                        var bounds = new google.maps.LatLngBounds();

                        places.forEach(function(place) {
                            if (!place.geometry) { return; }
                            var marker = new google.maps.Marker({
                                map: mapInstance,
                                title: place.name,
                                position: place.geometry.location
                            });
                            mapMarkers.push(marker);
                            var positionInput = form ? form.querySelector('input[name="position"]') : document.getElementById('position');
                            if (positionInput) {
                                positionInput.value = place.geometry.location.lat() + ',' + place.geometry.location.lng();
                            }
                            lastResolvedAddress = input.value.trim();

                            if (place.geometry.viewport) {
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });

                        mapInstance.fitBounds(bounds);
                    });

                    input.addEventListener('keydown', function(event) {
                        if (event.key === 'Enter') {
                            event.preventDefault();
                            geocodeTypedAddress(input);
                        }
                    });
                    input.addEventListener('change', function() {
                        geocodeTypedAddress(input);
                    });
                    input.addEventListener('blur', function() {
                        window.setTimeout(function() {
                            geocodeTypedAddress(input);
                        }, 200);
                    });

                    $(document).on('shown.bs.modal', '.contact_modal', refreshMapSize);
                    $(document).on('click', '#' + contactMapFormId + ' .more_btn', function() {
                        window.setTimeout(refreshMapSize, 250);
                    });
                }

                window.__initContactCreateMap = function() {
                    if (typeof google !== 'undefined' && google.maps) {
                        initContactMap();
                    }
                };

                if (typeof google === 'undefined' || !google.maps) {
                    var mapScript = document.createElement('script');
                    mapScript.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo e($api_key, false); ?>&libraries=places&callback=__initContactCreateMap';
                    mapScript.async = true;
                    mapScript.defer = true;
                    document.head.appendChild(mapScript);
                } else {
                    $(document).ready(__initContactCreateMap);
                }
            })();
        </script>
    <?php endif; ?>
    <div class="<?php echo e($render_full_page ? 'box-body' : 'modal-body', false); ?>">
        <div class="row"> 
        
            <?php if($from): ?>
                <?php echo Form::hidden('create_from', $from); ?>

            <?php endif; ?>

            <div class="col-md-4 contact_type_div">
                <div class="form-group mb-2">
                    <?php echo Form::label('type', __('contact.contact_type') . ':*' ); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('type', $types, $type , ['class' => 'form-control', 'id' => 'contact_type','placeholder' => __('messages.please_select'), 'required']); ?>

                    </div>
                </div>
            </div>

            <div class="option-div-group col-md-4 <?php if(!empty($common_settings['merchant_hide_entity_type'])): ?> hide <?php endif; ?>">
                <div class="col-sm-6 float-start">
                  <div class="form-group">
                    <br>
                    <div class="option-div <?php if($contact_type == 'individual' || $contact_type == ''): ?> active <?php endif; ?>" style="padding: 8px;background: lightgray;border: none;">
                        <i class="fa fa-check-circle float-start icon" style="margin-top: 4px;margin-right: 5px;"></i> <?php echo app('translator')->get('lang_v1.individual'); ?>
                        <?php echo Form::radio('contact_type_radio', 'individual', ($contact_type == 'individual' || $contact_type == '') ? true : false); ?>

                    </div>
                  </div>
                </div>
                <div class="col-sm-6 float-end">
                    <div class="form-group mb-1">
                      <br>
                      <div class="option-div <?php if($contact_type == 'business'): ?> active <?php endif; ?>" style="padding: 8px;background: lightgray;border: none;">
                          <i class="fa fa-check-circle float-start icon" style="margin-top: 4px;margin-right: 5px;"></i> <?php echo app('translator')->get('business.business'); ?>
                          <?php echo Form::radio('contact_type_radio', 'business', ($contact_type == 'business') ? true : false); ?>

                      </div>
                    </div>
                  </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('contact_id', __('lang_v1.contact_id') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-id-badge"></i>
                        </span>
                        <?php echo Form::text('contact_id', null, ['class' => 'form-control','placeholder' => __('lang_v1.contact_id')]); ?>

                    </div>
                    <p class="mb-0">
                        <?php echo app('translator')->get('lang_v1.leave_empty_to_autogenerate'); ?>
                    </p>
                </div>
            </div>
            <?php if(empty($common_settings['hide_contact_customer_group'])): ?>
            <div class="col-md-3 customer_fields">
                <div class="form-group mb-1">
                    <?php echo Form::label('customer_group_id', __('lang_v1.customer_group') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-users"></i>
                        </span>
                        <?php echo Form::select('customer_group_id', $customer_groups, '', ['class' => 'form-control']); ?>

                    </div>
                </div>  
            </div>
            <?php endif; ?>
            <?php if($accounting_enabled): ?>
                <div class="col-sm-3">
                    <div class="form-group mb-1">
                        <div class="form-check">
                            <br>
                            <label class="form-check-label">
<?php echo Form::checkbox('post_to_account', 1, false, ['id' => 'post_to_account']); ?> <?php echo e(__( 'lang_v1.post_to_account' ), false); ?>

                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 hide acc_fields">
                    <div class="form-group mb-1">
                        <?php echo Form::label('acc_sub_type', __('lang_v1.account_sub_type') . ':'); ?>

                        <?php echo Form::select('acc_sub_type', $acc_sub_types, ($type == 'supplier') ? 6 : 1, ['class' => 'form-control']); ?>

                    </div>  
                </div>
                <div class="col-md-3 hide acc_fields">
                    <div class="form-group mb-1">
                        <?php echo Form::label('acc_parent_account', __('lang_v1.parent_account') . ':'); ?>

                        <?php echo Form::select('acc_parent_account', $parent_accounts, null, ['class' => 'form-control']); ?>

                    </div>  
                </div>
            <?php endif; ?>
            
            <div class="clearfix "></div>
            <div class="col-md-4 business" style="display: none;">
                <div class="form-group mb-2">
                    <?php echo Form::label('supplier_business_name', __('business.business_name') . ':*'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-briefcase"></i>
                        </span>
                        <?php echo Form::text('supplier_business_name', null, ['class' => 'form-control', 'placeholder' => __('business.business_name'), 'requried']); ?>

                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <?php if(empty($common_settings['hide_contact_prefix'])): ?>
            <div class="col-md-3 individual" style="display: none;">
                <div class="form-group mb-2">
                    <?php echo Form::label('prefix', __( 'business.prefix' ) . ':'); ?>

                    <?php echo Form::text('prefix', null, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); ?>

                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-3 individual" style="display: none;">
                <div class="form-group mb-2">
                    <?php echo Form::label('first_name', __( 'business.first_name' ) . ':*'); ?>

                    <?php echo Form::text('first_name', null, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); ?>

                </div>
            </div>
            <?php if(empty($common_settings['hide_contact_middle_name'])): ?>
            <div class="col-md-3 individual" style="display: none;">
                <div class="form-group mb-2">
                    <?php echo Form::label('middle_name', __( 'lang_v1.middle_name' ) . ':'); ?>

                    <?php echo Form::text('middle_name', null, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.middle_name' ) ]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(empty($common_settings['hide_contact_last_name'])): ?>
            <div class="col-md-3 individual" style="display: none;">
                <div class="form-group mb-2">
                    <?php echo Form::label('last_name', __( 'business.last_name' ) . ':'); ?>

                    <?php echo Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); ?>

                </div>
            </div>
            <?php endif; ?>
            <div class="clearfix"></div>
        
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('mobile', __('contact.mobile') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-mobile"></i>
                        </span>
                        <?php echo Form::text('mobile', null, ['class' => 'form-control', (isset($common_settings['contact_mobile_num_required'])) ? 'required' : '', 'placeholder' => __('contact.mobile')]); ?>

                    </div>
                </div>
                <input type='hidden' id='contact_mobile_num_required' value="<?php echo e((isset($common_settings['contact_mobile_num_required'])) ? 1 : 0, false); ?>">
            </div>

            <?php if(empty($common_settings['hide_contact_alternate_number'])): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('alternate_number', __('contact.alternate_contact_number') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-phone"></i>
                        </span>
                        <?php echo Form::text('alternate_number', null, ['class' => 'form-control', 'placeholder' => __('contact.alternate_contact_number')]); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(empty($common_settings['hide_contact_landline'])): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('landline', __('contact.landline') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-phone"></i>
                        </span>
                        <?php echo Form::text('landline', null, ['class' => 'form-control', 'placeholder' => __('contact.landline')]); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(empty($common_settings['hide_contact_email'])): ?>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('email', __('business.email') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <?php echo Form::email('email', null, ['class' => 'form-control','placeholder' => __('business.email')]); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(empty($common_settings['hide_contact_dob'])): ?>
            <div class="clearfix"></div>
            <div class="col-sm-4 individual" style="display: none;">
                <div class="form-group mb-2">
                    <?php echo Form::label('dob', __('lang_v1.dob') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                        </span>
                        
                        <?php echo Form::text('dob', null, ['class' => 'form-control dob-date-picker','placeholder' => __('lang_v1.dob'), 'readonly']); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- lead additional field -->
            <div class="col-md-4 lead_additional_div">
                <div class="form-group mb-2">
                    <?php echo Form::label('crm_source', __('lang_v1.source') . ':' ); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa fa-search"></i>
                        </span>
                        <?php echo Form::select('crm_source', $sources, null , ['class' => 'form-control', 'id' => 'crm_source','placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
            </div>
            
            <div class="col-md-4 lead_additional_div">
                <div class="form-group mb-2">
                    <?php echo Form::label('crm_life_stage', __('lang_v1.life_stage') . ':' ); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa fa-life-ring"></i>
                        </span>
                        <?php echo Form::select('crm_life_stage', $life_stages, null , ['class' => 'form-control', 'id' => 'crm_life_stage','placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
            </div>

            <?php if(empty($common_settings['hide_contact_assigned_users'])): ?>
                <!-- User in create leads -->
                <div class="col-md-6 lead_additional_div">
                    <div class="form-group mb-1">
                        <?php echo Form::label('user_id', __('lang_v1.assigned_to_user') . ':*' ); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php echo Form::select('user_id[]', $users ?? [], null , ['class' => 'form-control select2', 'id' => 'user_id', 'multiple', 'required', 'style' => 'width: 80%;']); ?>

                        </div>
                    </div>
                </div>

                <!-- User in create customer & supplier -->
                <?php if(config('constants.enable_contact_assign') && $type !== 'lead'): ?>
                    <div class="col-md-4">
                        <div class="form-group mb-1">
                            <?php echo Form::label('assigned_to_users', __('lang_v1.assigned_to_user') . ':' ); ?>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php echo Form::select('assigned_to_users[]', $users ?? [], null , ['class' => 'form-control select2', 'id' => 'assigned_to_users', 'multiple', 'style' => 'width: 80%;']); ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(empty($common_settings['hide_contact_is_inclusive'])): ?>
            <?php
                if($from == 'pos'){
                    $checked = !empty($pos_settings['is_tax_inclusive_pos']) ? 'checked' : '';
                }else if($from == 'sell'){
                    $checked = !empty($common_settings['is_tax_inclusive_sales']) ? 'checked' : '';
                }else{
                    if($type == 'customer'){
                        $checked = !empty($pos_settings['is_tax_inclusive_pos']) ? 'checked' : '';
                    }else{
                        $checked = !empty($common_settings['is_tax_inclusive_purchase']) ? 'checked' : '';
                    }
                }
            ?>
            <div class="col-sm-3">
                <div class="form-group mb-2">
                    <div class="form-check">
                        <br>
                        <label class="form-check-label">
                            <input class="form-check-input" name="is_inclusive" type="checkbox" <?php echo e($checked, false); ?> > Is Tax Inclusive?
                        </label>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <?php if(empty($common_settings['hide_contact_location'])): ?>
                <?php
                $default_location = null;
                if(!empty($business_locations)){
                    $default_location = array_keys($business_locations->toArray());
                }
                ?>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label('contact_locations', 'Locations '.__('lang_v1.assigned_to') . ':' ); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                            <?php echo Form::select('contact_locations[]', $business_locations ?? [], $default_location , ['class' => 'form-select select2', 'id' => 'contact_locations', 'multiple', 'style' => 'width: 80%;']); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if(empty($common_settings['hide_contact_assigned_menus'])): ?>
            <div class="col-md-6 customer_fields">
                <div class="form-group mb-1">
                    <?php echo Form::label('quick_menu_ids', 'Quick Menus '.__('lang_v1.assigned_to_menu') . ':' ); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('quick_menu_ids[]', $quick_menus ?? [], null , ['class' => 'form-select select2', 'id' => 'quick_menu_ids', 'multiple', 'style' => 'width: 80%;']); ?>

                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <?php if(empty($common_settings['hide_contact_invoice_layout'])): ?>
            <div class="col-sm-4">
                <div class="form-group mb-1">
                    <?php echo Form::label('invoice_layout_id', __('invoice.invoice_layout') . ':'); ?>

                    <?php echo Form::select('invoice_layout_id', $invoice_layouts, null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if(empty($common_settings['hide_contact_default_currency']) && !isset($quick_add)): ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('default_currency_id', __('lang_v1.default_currency_ledger') . ':'); ?>

                    <?php echo Form::select('default_currency_id', $currency_details ?? [], null, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            
            <?php if(empty($common_settings['hide_contact_more_info'])): ?>
            <div class="col-md-12 d-flex justify-content-center mb-2">
                <button type="button" class="btn btn-primary center-block more_btn" data-bs-target="#more_div" data-target="#more_div"><?php echo app('translator')->get('lang_v1.more_info'); ?> <i class="fa fa-chevron-down"></i></button>
            </div>
            <?php endif; ?>

            <div id="more_div" class=" <?php if(empty($common_settings['hide_contact_more_info'])): ?> hide  <?php endif; ?> row">
                <?php echo Form::hidden('position', null, ['id' => 'position']); ?>

                

                <?php if(empty($common_settings['hide_contact_opening_balance'])): ?>
                <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('', 'Location:' ); ?><br> <?php echo e($value, false); ?>

                        <?php echo Form::hidden('ob['.$loop->index.'][ob_location]', $key); ?>

                    </div>
                </div>
                <div class="col-md-3 opening_balance">
                    <div class="form-group mb-2">
                        <?php echo Form::label('ob', __('lang_v1.opening_balance') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-money-bill-alt"></i>
                            </span>
                            <?php echo Form::text('ob['.$loop->index.'][opening_balance]', 0, ['class' => 'form-control input_number ob_payment', 'data-rule-min-value' => 0, 'data-msg-min-value' => 'Min Value Allowed is 0.00', 'min' => 0, 'oninput' => 'if(parseFloat(this.value) < 0) this.value = 0;']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                    <?php echo Form::label("ob_paid_on" , __('lang_v1.opening_balance_date') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                        </span>
                        <?php echo Form::text('ob['.$loop->index.'][opening_balance_paid_on]', \Carbon::createFromTimestamp(strtotime(now()))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control ob_date', 'id'=>'opening_balance_paid_on'.$key.'', 'readonly', 'required']); ?>

                    </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <?php
                        if($selected_type == 'supplier'){
                            $default_ob_type = 'credit';
                        }else{
                            $default_ob_type = 'debit';
                        }
                    ?>
                    <div class="form-group mb-2">
                        <?php echo Form::label('ob_payment_type', __('lang_v1.payment_type') . ':'); ?>

                        <br/>
                        <?php echo Form::select('ob['.$loop->index.'][opening_balance_payment_type]', ['debit' => 'Debit', 'credit' => 'Credit'], $default_ob_type, ['class' => 'form-select']); ?>

                    </div>
                </div>
                
                <?php if(!empty($ob_location_currencies[$key] ?? [])): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('ob_currency', __('lang_v1.default_currency') . ':'); ?>

                        <select name="ob[<?php echo e($loop->index, false); ?>][location_currency_id]" class="form-select ob_currency_select" data-ob-index="<?php echo e($loop->index, false); ?>">
                            <option value=""><?php echo app('translator')->get('lang_v1.default_currency'); ?></option>
                            <?php $__currentLoopData = $ob_location_currencies[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lc['id'], false); ?>" data-multiplier="<?php echo e($lc['multiplier'], false); ?>" data-code="<?php echo e($lc['code'], false); ?>" data-symbol="<?php echo e($lc['symbol'], false); ?>">
                                    <?php echo e($lc['code'], false); ?> (<?php echo e($lc['symbol'], false); ?>) - <?php echo e($lc['multiplier'], false); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('ob_exchange_rate', __('purchase.p_exchange_rate') . ':'); ?>

                        <div class="input-group">
                            <?php echo Form::number('ob['.$loop->index.'][exchange_rate]', 1, ['class' => 'form-control ob_exchange_rate', 'data-ob-index' => $loop->index, 'step' => 'any', 'readonly']); ?>

                            <button type="button" class="btn btn-outline-info btn-sm ob_refresh_exchange_rate_btn" data-ob-index="<?php echo e($loop->index, false); ?>" title="Refresh Rate"><i class="fas fa-sync-alt"></i></button>
                        </div>
                        <small class="ob_converted_amount text-muted" data-ob-index="<?php echo e($loop->index, false); ?>"></small>
                    </div>
                </div>
                <?php else: ?>
                <?php echo Form::hidden('ob['.$loop->index.'][exchange_rate]', 1); ?>

                <?php echo Form::hidden('ob['.$loop->index.'][location_currency_id]', ''); ?>

                <?php endif; ?>
                <div class="clearfix"></div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_contact_tax_no'])): ?>
                <div class="col-md-4">
                    <div class="form-group">
                    <?php
                        $tax_no_label = (!empty($common_settings['merchant_tax_number_label'])) ? $common_settings['merchant_tax_number_label'] : __('contact.tax_no');
                    ?>
                    <?php echo Form::label('tax_number', $tax_no_label . ':'); ?>

                    <?php if($fbr_di_integration): ?>
                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . 'FBR DI requires buyer NTN/CNIC digits only: 7 digit NTN without dashes (example: 1234567 or A234567), or 13 digit CNIC without dashes. Click Check Reg. Type to verify before saving.' . '"></i>';
                }
            ?>
                    <?php endif; ?>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-info"></i>
                            </span>
                            <?php echo Form::text('tax_number', null, ['class' => 'form-control', 'placeholder' => $tax_no_label ]); ?>

                        </div>
                    </div>
                </div>

                <?php if($fbr_di_integration): ?>
                <div class="col-md-4">
                    <div class="form-group mb-1">
                        <?php echo Form::label('fbr_st_reg_type', __('lang_v1.fbr_st_reg_type') . ':'); ?>

                        <br/>
                        <?php echo Form::select('fbr_st_reg_type', ['Registered' => 'Registered', 'Unregistered' => 'Unregistered'], 'Unregistered', ['class' => 'form-control']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-1">
                        <br>
                        <button class="btn btn-primary check_fbr_st_type" type="button" style="margin-top: 5px;">
                            <i class="fas fa-sync fa-spin fa-fw hide"></i> Check Reg. Type
                        </button>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php endif; ?>

                <?php endif; ?>
                <?php if(empty($common_settings['hide_contact_pay_term'])): ?>
                <div class="col-md-4 pay_term">
                    <div class="form-group mb-2">
                    <div class="multi-input">
                        <?php echo Form::label('pay_term_number', __('contact.pay_term') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.pay_term') . '"></i>';
                }
            ?>
                        <br/>
                        <?php echo Form::number('pay_term_number', null, ['class' => 'form-control width-40 float-start', 'placeholder' => __('contact.pay_term')]); ?>


                        <?php echo Form::select('pay_term_type', ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], '', ['class' => 'form-select width-60 float-end','placeholder' => __('messages.please_select')]); ?>

                    </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php
                    // $common_settings = session()->get('business.common_settings');
                    $default_credit_limit = (array_key_exists('default_credit_limit', $common_settings) && $common_settings['default_credit_limit'] !== '') ? $common_settings['default_credit_limit'] : null;
                ?>
                <?php echo Form::hidden('_default_credit_limit', $default_credit_limit); ?>

                <?php if(empty($common_settings['hide_contact_credit_limit'])): ?>
                <div class="col-md-4 customer_fields">
                    <div class="form-group mb-2">
                        <?php echo Form::label('credit_limit', __('lang_v1.credit_limit') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-money-bill-alt"></i>
                            </span>
                            <?php echo Form::text('credit_limit', $default_credit_limit, ['class' => 'form-control input_number']); ?>

                        </div>
                        <p class="help-block"><?php echo app('translator')->get('lang_v1.credit_limit_help'); ?></p>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_contact_discount'])): ?>
                <div class="col-md-4 customer_fields">
                    <div class="form-group mb-2">
                        <?php echo Form::label('discount_type', 'Default '.__('lang_v1.discount_type') . ':' ); ?>

                        <?php echo Form::select('discount_type', ['percentage'=> 'Percentage', 'fixed'=> 'Fixed'], null , ['class' => 'form-control select2', 'id' => 'discount_type', 'style' => 'width: 100%;']); ?>

                    </div>
                </div>

                <div class="col-md-4 customer_fields">
                    <div class="form-group mb-2">
                        <?php echo Form::label('discount_amount', 'Default ' .__('lang_v1.discount_amount') . ':'); ?>

                        <?php echo Form::text('discount_amount', 0, ['class' => 'form-control input_number']); ?>

                    </div>
                </div>
                <div class="col-md-4 customer_fields">
                    <div class="form-group mb-2">
                        <?php echo Form::label('sales_discount_ids', __('sale.discounts') . ':'); ?>

                        <?php echo Form::select('sales_discount_ids[]', $sales_discounts ?? [], null, ['class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_contact_default_tax'])): ?>
                    <div class="col-md-4 customer_fields">
                        <div class="form-group mb-1">
                            <?php echo Form::label('default_tax_id', 'Default '.__('sale.tax') . ':' ); ?>

                            <?php echo Form::select('default_tax_id', $taxes['tax_rates'], null , ['class' => 'form-control select2', 'id' => 'default_tax_id', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(!empty($pos_settings['prompt_token_no'])): ?>
                <div class="col-sm-3 customer_fields">
                    <div class="form-group mb-1">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" name="not_ask_prompt" type="checkbox"> Don't Ask <?php echo e(!empty($pos_settings['prompt_token_label']) ? $pos_settings['prompt_token_label'] : 'Token No', false); ?>

                            </label>
                            
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="clearfix"></div>
                <?php if(!$crm_enabled && empty($common_settings['hide_contact_allow_login'])): ?>
                    <div class="col-md-4 customer_fields">
                        <div class="form-group mb-1">
                            <div class="form-check">
                            <label class="form-check-label">
<?php echo Form::checkbox('allow_login', 1, false, 
                                [ 'class' => 'form-check-input allow_login', "data-loginDiv" => "loginDiv"]); ?> <?php echo e(__( 'lang_v1.allow_login' ), false); ?>

                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="hide" id="loginDiv">
                        <div class="clearfix"></div>
                        <div class="col-md-3 customer_fields">
                            <div class="form-group mb-1">
                                <?php echo Form::label("username", __( 'business.username' ) . ':*'); ?>

                                <?php echo Form::text('username', null, ['class' => 'form-control', 'placeholder' => __( 'business.username' ), 'required', 'id'=>"username", 'autocomplete' => 'off', 'disabled' => true]); ?>

                            </div>
                        </div>
                        <div class="col-md-3 customer_fields">
                            <div class="form-group mb-1">
                                <?php echo Form::label("password", __( 'business.password' ) . ':*'); ?>

                                <?php echo Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.password' ), 'id'=>"password", 'autocomplete' => 'new-password', 'disabled' => true ]); ?>

                            </div>
                        </div>
                        <div class="col-md-3 customer_fields">
                            <div class="form-group mb-1">
                                <?php echo Form::label("confirm_password", __( 'business.confirm_password' ) . ':*'); ?>

                                <?php echo Form::password('confirm_password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.confirm_password' ), 'id' => "confirm_password", 'data-rule-equalTo' => "#password", 'autocomplete' => 'new-password', 'disabled' => true ]); ?>

                            </div>
                        </div>
                        <div class="col-md-3 customer_fields">
                            <div class="form-group mb-1">
                                <label class="form-check-label">
<?php echo Form::checkbox('is_active', 'active', true, ['class' => 'form-check-input status']); ?> <?php echo e(__('lang_v1.status_for_user'), false); ?>

                                </label>
                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_enable_user_active') . '"></i>';
                }
            ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <div class="clearfix"></div>
                
                <?php if(empty($common_settings['hide_contact_address_line_1'])): ?>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label('address_line_1', __('lang_v1.address_line_1') . ':'); ?>

                        <?php echo Form::text('address_line_1', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_1'), 'rows' => 3]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_contact_address_line_2'])): ?>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label('address_line_2', __('lang_v1.address_line_2') . ':'); ?>

                        <?php echo Form::text('address_line_2', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_2'), 'rows' => 3]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="clearfix"></div>
                <?php if(empty($common_settings['hide_contact_city'])): ?>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('city', __('business.city') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('business.city'), ($fbr_di_integration) ? 'required' : '']); ?>

                    </div>
                </div>
                </div>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_contact_state'])): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('state', __('business.state') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-map-marker"></i>
                            </span>
                            <?php echo Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('business.state'), ($fbr_di_integration) ? 'required' : '']); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_contact_country'])): ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('country', __('business.country') . ':'); ?>

                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-globe"></i>
                            </span>
                            <?php echo Form::text('country', null, ['class' => 'form-control', 'placeholder' => __('business.country')]); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_contact_zip_code'])): ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php
                                $zip_code_label = (!empty($common_settings['merchant_zip_code_label'])) ? $common_settings['merchant_zip_code_label'] : __('business.zip_code');
                            ?>
                            <?php echo Form::label('zip_code',  $zip_code_label. ':'); ?>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-map-marker"></i>
                                </span>
                                <?php echo Form::text('zip_code', null, ['class' => 'form-control', 'placeholder' => $zip_code_label]); ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <div class="clearfix"></div>
            <?php if(empty($common_settings['hide_contact_shipping_custom_labels'])): ?>
                
                <?php
                $custom_labels = json_decode(session('business.custom_labels'), true);
                $contact_custom_field1 = !empty($custom_labels['contact']['custom_field_1']) ? $custom_labels['contact']['custom_field_1'] : __('lang_v1.contact_custom_field1');
                $contact_custom_field2 = !empty($custom_labels['contact']['custom_field_2']) ? $custom_labels['contact']['custom_field_2'] : __('lang_v1.contact_custom_field2');
                $contact_custom_field3 = !empty($custom_labels['contact']['custom_field_3']) ? $custom_labels['contact']['custom_field_3'] : __('lang_v1.contact_custom_field3');
                $contact_custom_field4 = !empty($custom_labels['contact']['custom_field_4']) ? $custom_labels['contact']['custom_field_4'] : __('lang_v1.contact_custom_field4');
                $contact_custom_field5 = !empty($custom_labels['contact']['custom_field_5']) ? $custom_labels['contact']['custom_field_5'] : __('lang_v1.custom_field', ['number' => 5]);
                $contact_custom_field6 = !empty($custom_labels['contact']['custom_field_6']) ? $custom_labels['contact']['custom_field_6'] : __('lang_v1.custom_field', ['number' => 6]);
                $contact_custom_field7 = !empty($custom_labels['contact']['custom_field_7']) ? $custom_labels['contact']['custom_field_7'] : __('lang_v1.custom_field', ['number' => 7]);
                $contact_custom_field8 = !empty($custom_labels['contact']['custom_field_8']) ? $custom_labels['contact']['custom_field_8'] : __('lang_v1.custom_field', ['number' => 8]);
                $contact_custom_field9 = !empty($custom_labels['contact']['custom_field_9']) ? $custom_labels['contact']['custom_field_9'] : __('lang_v1.custom_field', ['number' => 9]);
                $contact_custom_field10 = !empty($custom_labels['contact']['custom_field_10']) ? $custom_labels['contact']['custom_field_10'] : __('lang_v1.custom_field', ['number' => 10]);
                ?>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field1', $contact_custom_field1 . ':'); ?>

                    <?php echo Form::text('custom_field1', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field1]); ?>

                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field2', $contact_custom_field2 . ':'); ?>

                    <?php echo Form::text('custom_field2', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field2]); ?>

                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field3', $contact_custom_field3 . ':'); ?>

                    <?php echo Form::text('custom_field3', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field3]); ?>

                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field4', $contact_custom_field4 . ':'); ?>

                    <?php echo Form::text('custom_field4', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field4]); ?>

                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field5', $contact_custom_field5 . ':'); ?>

                    <?php echo Form::text('custom_field5', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field5]); ?>

                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field6', $contact_custom_field6 . ':'); ?>

                    <?php echo Form::text('custom_field6', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field6]); ?>

                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field7', $contact_custom_field7 . ':'); ?>

                    <?php echo Form::text('custom_field7', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field7]); ?>

                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field8', $contact_custom_field8 . ':'); ?>

                    <?php echo Form::text('custom_field8', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field8]); ?>

                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field9', $contact_custom_field9 . ':'); ?>

                    <?php echo Form::text('custom_field9', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field9]); ?>

                </div>
                </div>
                <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field10', $contact_custom_field10 . ':'); ?>

                    <?php echo Form::text('custom_field10', null, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field10]); ?>

                </div>
                </div>
            <?php endif; ?>
            <?php if(empty($common_settings['hide_contact_shipping_address'])): ?>
            
            <div class="col-md-8 col-md-offset-2 shipping_addr_div mb-10" >
                <strong><?php echo e(__('lang_v1.shipping_address'), false); ?></strong><br>
                <?php echo Form::text('shipping_address', null, ['class' => 'form-control', 
                    'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']); ?>

                <div class="mb-10" id="map" style="width: 100%; height: 300px;"></div>
            </div>
            <?php
                $shipping_custom_label_1 = !empty($custom_labels['shipping']['custom_field_1']) ? $custom_labels['shipping']['custom_field_1'] : '';

                $shipping_custom_label_2 = !empty($custom_labels['shipping']['custom_field_2']) ? $custom_labels['shipping']['custom_field_2'] : '';

                $shipping_custom_label_3 = !empty($custom_labels['shipping']['custom_field_3']) ? $custom_labels['shipping']['custom_field_3'] : '';

                $shipping_custom_label_4 = !empty($custom_labels['shipping']['custom_field_4']) ? $custom_labels['shipping']['custom_field_4'] : '';

                $shipping_custom_label_5 = !empty($custom_labels['shipping']['custom_field_5']) ? $custom_labels['shipping']['custom_field_5'] : '';
            ?>

            <?php if(!empty($custom_labels['shipping']['is_custom_field_1_contact_default']) && !empty($shipping_custom_label_1)): ?>
                <?php
                    $label_1 = $shipping_custom_label_1 . ':';
                ?>

                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('shipping_custom_field_1', $label_1 ); ?>

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_1]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_1]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($custom_labels['shipping']['is_custom_field_2_contact_default']) && !empty($shipping_custom_label_2)): ?>
                <?php
                    $label_2 = $shipping_custom_label_2 . ':';
                ?>

                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('shipping_custom_field_2', $label_2 ); ?>

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_2]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_2]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($custom_labels['shipping']['is_custom_field_3_contact_default']) && !empty($shipping_custom_label_3)): ?>
                <?php
                    $label_3 = $shipping_custom_label_3 . ':';
                ?>

                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('shipping_custom_field_3', $label_3 ); ?>

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_3]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_3]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($custom_labels['shipping']['is_custom_field_4_contact_default']) && !empty($shipping_custom_label_4)): ?>
                <?php
                    $label_4 = $shipping_custom_label_4 . ':';
                ?>

                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('shipping_custom_field_4', $label_4 ); ?>

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_4]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_4]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($custom_labels['shipping']['is_custom_field_5_contact_default']) && !empty($shipping_custom_label_5)): ?>
                <?php
                    $label_5 = $shipping_custom_label_5 . ':';
                ?>

                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('shipping_custom_field_5', $label_5 ); ?>

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_5]', null, ['class' => 'form-control','placeholder' => $shipping_custom_label_5]); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if(!empty($common_settings['is_enabled_export'])): ?>
                <div class="col-md-12 mb-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_export" class="form-check-input" id="is_customer_export">
                        <label class="form-check-label" for="is_customer_export"><?php echo app('translator')->get('lang_v1.is_export'); ?></label>
                    </div>
                </div>
                <?php
                    $i = 1;
                ?>
                <?php for($i; $i <= 6 ; $i++): ?>
                    <div class="col-md-4 export_div" style="display: none;">
                        <div class="form-group mb-2">
                            <?php echo Form::label('export_custom_field_'.$i, __('lang_v1.export_custom_field'.$i).':' ); ?>

                            <?php echo Form::text('export_custom_field_'.$i, null, ['class' => 'form-control','placeholder' => __('lang_v1.export_custom_field'.$i)]); ?>

                        </div>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>            <?php endif; ?>
            </div>

        </div>
        <?php if(!$quick_add): ?>
        <?php echo $__env->make('layouts.partials.module_form_part', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
    
    <?php if(!$render_full_page): ?>
    <div class="modal-footer">
        <button type="submit" id="contact_form_submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.save' ); ?></button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
    <?php endif; ?>

    <?php echo Form::close(); ?>


    <?php if($render_full_page): ?>
    </div>
</div>
    <?php else: ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
    <?php endif; ?>
