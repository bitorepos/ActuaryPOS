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
            if(isset($update_action)) {
                $url = $update_action;
                $customer_groups = [];
                $opening_balance = 0;
                $lead_users = $contact->leadUsers->pluck('id');
            } else {
                $url = action([\App\Http\Controllers\ContactController::class, 'update'], [$contact->id]);
                $sources = [];
                $life_stages = [];
                $lead_users = [];
                $assigned_to_users = $contact->userHavingAccess->pluck('id');
            }
        // Phase 73: prefer controller-supplied per-branch common_settings / pos_settings; session is the fallback.
        $common_settings = isset($common_settings) && ! empty($common_settings)
            ? $common_settings
            : (session()->get('business.common_settings') ?? []);
        $pos_settings = isset($pos_settings) && ! empty($pos_settings) && is_array($pos_settings)
            ? $pos_settings
            : (json_decode(session()->get('business.pos_settings'), true) ?: []);
        ?>
        <?php echo Form::open(['url' => $url, 'method' => 'PUT', 'id' => 'contact_edit_form', 'class' => 'd-flex flex-column overflow-hidden flex-grow-1', 'style' => 'min-height:0', 'autocomplete' => 'off', 'data-redirect-url' => $render_full_page ? action([\App\Http\Controllers\ContactController::class, 'index'], ['type' => $contact->type]) : null, 'data-full-page' => $render_full_page ? 1 : 0]); ?>

    <?php if(!$render_full_page): ?>
    <div class="modal-header">
        <h4 class="modal-title"><?php echo app('translator')->get('contact.edit_contact'); ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php
        $api_key = env('GOOGLE_MAP_API_KEY');
    ?>
    <?php if(!empty($api_key)): ?>
        <script>
            (function() {
                var mapInstance;
                var mapMarkers = [];

                function clearMarkers() {
                    mapMarkers.forEach(function(marker) { marker.setMap(null); });
                    mapMarkers = [];
                }

                function initContactMap() {
                    var mapEl = document.getElementById('map');
                    var input = document.getElementById('shipping_address');
                    var positionInput = document.getElementById('position');
                    if (!mapEl || !input || !positionInput) { return; }

                    var defaultCenter = {lat: -33.8688, lng: 151.2195};
                    var existingPosition = positionInput.value ? positionInput.value.split(',') : null;
                    if (existingPosition && existingPosition.length === 2 && !isNaN(existingPosition[0]) && !isNaN(existingPosition[1])) {
                        defaultCenter = {lat: parseFloat(existingPosition[0]), lng: parseFloat(existingPosition[1])};
                    }

                    mapInstance = new google.maps.Map(mapEl, {
                        center: defaultCenter,
                        zoom: 12,
                        mapTypeId: 'roadmap'
                    });

                    if (!existingPosition && navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (position) {
                            mapInstance.setCenter({lat: position.coords.latitude, lng: position.coords.longitude});
                        });
                    }

                    var searchBox = new google.maps.places.SearchBox(input);

                    if (existingPosition && existingPosition.length === 2) {
                        var marker = new google.maps.Marker({
                            map: mapInstance,
                            position: defaultCenter
                        });
                        mapMarkers.push(marker);
                    }

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
                            $('#position').val([place.geometry.location.lat(), place.geometry.location.lng()]);

                            if (place.geometry.viewport) {
                                bounds.union(place.geometry.viewport);
                            } else {
                                bounds.extend(place.geometry.location);
                            }
                        });

                        mapInstance.fitBounds(bounds);
                    });
                }

                window.__initContactEditMap = function() {
                    if (typeof google !== 'undefined' && google.maps) {
                        initContactMap();
                    }
                };

                if (typeof google === 'undefined' || !google.maps) {
                    var mapScript = document.createElement('script');
                    mapScript.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo e($api_key, false); ?>&libraries=places&callback=__initContactEditMap';
                    mapScript.async = true;
                    mapScript.defer = true;
                    document.head.appendChild(mapScript);
                } else {
                    $(document).ready(__initContactEditMap);
                }
            })();
        </script>
    <?php endif; ?>

    <div class="<?php echo e($render_full_page ? 'box-body' : 'modal-body', false); ?>">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('type', __('contact.contact_type') . ':*' ); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('type', $types, $contact->type, ['class' => 'form-control', 'id' => 'contact_type','placeholder' => __('messages.please_select'), 'required']); ?>

                    </div>
                </div>
            </div>
            <div class="option-div-group col-md-4 <?php if(!empty($common_settings['merchant_hide_entity_type'])): ?> hide <?php endif; ?>">
                <div class="col-sm-6 float-start">
                  <div class="form-group">
                    <br>
                    <div class="option-div <?php if($contact->entity_type == 'individual'): ?> active <?php endif; ?>" style="padding: 8px;background: lightgray;border: none;border-radius:5px;margin-right:5px">
                        <i class="fa fa-check-circle float-start icon" style="margin-top: 4px;margin-right: 5px;"></i> <?php echo app('translator')->get('lang_v1.individual'); ?>
                        <?php echo Form::radio('contact_type_radio', 'individual', ($contact->entity_type == 'individual') ? true : false); ?>

                    </div>
                  </div>
                </div>
                <div class="col-md-6 float-end">
                    <div class="form-group mb-1">
                      <br>
                      <div class="option-div <?php if($contact->entity_type == 'business'): ?> active <?php endif; ?>" style="padding: 8px;background: lightgray;border: none;">
                          <i class="fa fa-check-circle float-start icon" style="margin-top: 4px;margin-right: 5px;"></i> <?php echo app('translator')->get('business.business'); ?>
                          <?php echo Form::radio('contact_type_radio', 'business', ($contact->entity_type == 'business') ? true : false); ?>

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
                        <input type="hidden" id="hidden_id" value="<?php echo e($contact->id, false); ?>">
                        <?php echo Form::text('contact_id', $contact->contact_id, ['class' => 'form-control','placeholder' => __('lang_v1.contact_id')]); ?>

                    </div>
                    <p class="help-block">
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
                            <?php echo Form::select('customer_group_id', $customer_groups, $contact->customer_group_id, ['class' => 'form-control']); ?>

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
<?php echo Form::checkbox('post_to_account', 1, !empty($contact->acc_account_id) ? true : false, [ 'class' => 'form-check-input', 'id' => 'post_to_account']); ?> <?php echo e(__( 'lang_v1.post_to_account' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-3 <?php if(empty($contact->acc_account_id)): ?> hide <?php endif; ?> acc_fields">
                <div class="form-group mb-1">
                    <?php echo Form::label('acc_sub_type', __('lang_v1.account_sub_type') . ':'); ?>

                    <?php echo Form::select('acc_sub_type', $acc_sub_types, $acc_sub_type_id, ['class' => 'form-control']); ?>

                </div>  
            </div>
            <div class="col-md-3 <?php if(empty($contact->acc_account_id)): ?> hide <?php endif; ?> acc_fields">
                <div class="form-group mb-1">
                    <?php echo Form::label('acc_parent_account', __('lang_v1.parent_account') . ':'); ?>

                    <?php echo Form::select('acc_parent_account', $parent_accounts, $contact_acc_account->parent_account_id, ['class' => 'form-control']); ?>

                </div>  
            </div>
        
            <?php endif; ?>
            <div class="clearfix customer_fields"></div>
            <div class="col-md-4 business">
                <div class="form-group mb-2">
                    <?php echo Form::label('supplier_business_name', __('business.business_name') . ':*'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-briefcase"></i>
                        </span>
                        <?php echo Form::text('supplier_business_name', 
                        $contact->supplier_business_name, ['class' => 'form-control', 'placeholder' => __('business.business_name'), 'requried']); ?>

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
                <?php if(empty($common_settings['hide_contact_prefix'])): ?>
                    <div class="col-md-3 individual">
                        <div class="form-group mb-2">
                            <?php echo Form::label('prefix', __( 'business.prefix' ) . ':'); ?>

                            <?php echo Form::text('prefix', $contact->prefix, ['class' => 'form-control', 'placeholder' => __( 'business.prefix_placeholder' ) ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-md-3 individual">
                    <div class="form-group mb-2">
                        <?php echo Form::label('first_name', __( 'business.first_name' ) . ':*'); ?>

                        <?php echo Form::text('first_name', $contact->first_name, ['class' => 'form-control', 'required', 'placeholder' => __( 'business.first_name' ) ]); ?>

                    </div>
                </div>
                <?php if(empty($common_settings['hide_contact_middle_name'])): ?>
                    <div class="col-md-3 individual">
                        <div class="form-group mb-2">
                            <?php echo Form::label('middle_name', __( 'lang_v1.middle_name' ) . ':'); ?>

                            <?php echo Form::text('middle_name', $contact->middle_name, ['class' => 'form-control', 'placeholder' => __( 'lang_v1.middle_name' ) ]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_contact_last_name'])): ?>
                    <div class="col-md-3 individual">
                        <div class="form-group mb-2">
                            <?php echo Form::label('last_name', __( 'business.last_name' ) . ':'); ?>

                            <?php echo Form::text('last_name', $contact->last_name, ['class' => 'form-control', 'placeholder' => __( 'business.last_name' ) ]); ?>

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
                    <?php echo Form::text('mobile', $contact->mobile, ['class' => 'form-control', (isset($common_settings['contact_mobile_num_required'])) ? 'required' : '', 'placeholder' => __('contact.mobile')]); ?>

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
                    <?php echo Form::text('alternate_number', $contact->alternate_number, ['class' => 'form-control', 'placeholder' => __('contact.alternate_contact_number')]); ?>

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
                    <?php echo Form::text('landline', $contact->landline, ['class' => 'form-control', 'placeholder' => __('contact.landline')]); ?>

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
                    <?php echo Form::email('email', $contact->email, ['class' => 'form-control','placeholder' => __('business.email')]); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(empty($common_settings['hide_contact_dob'])): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2 individual">
                <?php echo Form::label('dob', __('lang_v1.dob') . ':'); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                    </span>
                    
                    <?php echo Form::text('dob', !empty($contact->dob) ? \Carbon::createFromTimestamp(strtotime($contact->dob))->format(session('business.date_format')) : null, ['class' => 'form-control dob-date-picker','placeholder' => __('lang_v1.dob'), 'readonly']); ?>

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
                    <?php echo Form::select('crm_source', $sources, $contact->crm_source , ['class' => 'form-control', 'id' => 'crm_source','placeholder' => __('messages.please_select')]); ?>

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
                    <?php echo Form::select('crm_life_stage', $life_stages, $contact->crm_life_stage , ['class' => 'form-control', 'id' => 'crm_life_stage','placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
        </div>
        <?php if(empty($common_settings['hide_contact_assigned_users'])): ?>
        <div class="col-md-4 lead_additional_div">
            <div class="form-group mb-1">
                <?php echo Form::label('user_id', __('lang_v1.assigned_to_user') . ':*' ); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-user"></i>
                    </span>
                    <?php echo Form::select('user_id[]', $users, $lead_users , ['class' => 'form-select select2', 'id' => 'user_id', 'multiple', 'required', 'style' => 'width: 80%;']); ?>

                </div>
            </div>
        </div>
        <?php if(config('constants.enable_contact_assign') && $contact->type !== 'lead'): ?>
            <!-- User in create customer & supplier -->
            <div class="col-md-5">
                <div class="form-group mb-1">
                    <?php echo Form::label('assigned_to_users', __('lang_v1.assigned_to_user') . ':' ); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('assigned_to_users[]', $users, $assigned_to_users ?? [] , ['class' => 'form-control select2', 'id' => 'assigned_to_users', 'multiple', 'style' => 'width: 80%;']); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php endif; ?>
        <?php if(empty($common_settings['hide_contact_is_inclusive'])): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <div class="form-check">
                <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('is_inclusive', null, !empty($contact->is_inclusive) ? true : false ,[ 'class' => 'form-check-input']); ?> <?php echo e("Is Tax Inclusive?", false); ?>

                    </label>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="clearfix"></div>
        <?php if(empty($common_settings['hide_contact_location'])): ?>
            <div class="col-md-6">
                <div class="form-group mb-2">
                    <?php echo Form::label('contact_locations', 'Locations '.__('lang_v1.assigned_to') . ':' ); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-user"></i>
                        </span>
                        <?php echo Form::select('contact_locations[]', $business_locations, $contact->contact_locations->pluck('id'), ['class' => 'form-control select2', 'id' => 'contact_locations', 'multiple', 'style' => 'width: 80%;']); ?>

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
                    <?php echo Form::select('quick_menu_ids[]', $quick_menus ?? [], $contact->quick_menu_ids , ['class' => 'form-control select2', 'id' => 'quick_menu_ids', 'multiple', 'style' => 'width: 80%;']); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="clearfix"></div>
        <?php if(empty($common_settings['hide_contact_invoice_layout'])): ?>
            <div class="col-sm-4">
                <div class="form-group mb-1">
                    <?php echo Form::label('invoice_layout_id', __('invoice.invoice_layout') . ':'); ?>

                    <?php echo Form::select('invoice_layout_id', $invoice_layouts, $contact->invoice_layout_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
        <?php endif; ?>
        <?php if(empty($common_settings['hide_contact_default_currency'])): ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label('default_currency_id', __('lang_v1.default_currency_ledger') . ':'); ?>

                    <?php echo Form::select('default_currency_id', $currency_details ?? [], $contact->default_currency_id, ['class' => 'form-control', 'placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(empty($common_settings['hide_contact_more_info'])): ?>
        <div class="col-md-12 d-flex justify-content-center mb-2">
            <button type="button" class="btn btn-primary center-block more_btn" data-bs-target="#more_div" data-target="#more_div"><?php echo app('translator')->get('lang_v1.more_info'); ?> <i class="fa fa-chevron-down"></i></button>
        </div>
        <?php endif; ?>
        
        <div id="more_div" class=" <?php if(empty($common_settings['hide_contact_more_info'])): ?> hide <?php endif; ?> row" > 

        

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
                            <?php echo Form::text('ob['.$loop->index.'][opening_balance]', !empty($opening_balance[$key]['opening_balance']) ? $opening_balance[$key]['opening_balance'] : 0, ['class' => 'form-control input_number', 'data-rule-min-value' => 0, 'data-msg-min-value' => 'Min Value Allowed is 0.00', 'min' => 0, 'oninput' => 'if(parseFloat(this.value) < 0) this.value = 0;']); ?>

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
                            <?php echo Form::text('ob['.$loop->index.'][opening_balance_paid_on]', 
                            !empty($opening_balance[$key]['opening_balance_paid_on']) ? \Carbon::createFromTimestamp(strtotime($opening_balance[$key]['opening_balance_paid_on']))->format(session('business.date_format') . ' ' . 'h:i A') : \Carbon::createFromTimestamp(strtotime(now()))->format(session('business.date_format') . ' ' . 'h:i A'), 
                            ['class' => 'form-control ob_date', 'id'=>'opening_balance_paid_on'.$key.'', 'readonly', 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <?php
                        if($contact->type == 'supplier'){
                            $default_ob_type = 'credit';
                        }else{
                            $default_ob_type = 'debit';
                        }
                        $default_ob_type = !empty($opening_balance[$key]['payment_type']) ? $opening_balance[$key]['payment_type'] : $default_ob_type;
                    ?>
                    <div class="form-group mb-2">
                        <?php echo Form::label('ob_payment_type', __('lang_v1.payment_type') . ':'); ?>

                        <br/>
                        <?php echo Form::select('ob['.$loop->index.'][opening_balance_payment_type]', ['debit' => 'Debit', 'credit' => 'Credit'], $default_ob_type, ['class' => 'form-control']); ?>

                    </div>
                </div>
                
                <?php if(!empty($ob_location_currencies[$key] ?? [])): ?>
                <?php
                    $existing_ob_currency_id = !empty($opening_balance[$key]['location_currency_id']) ? $opening_balance[$key]['location_currency_id'] : '';
                    $existing_ob_exchange_rate = !empty($opening_balance[$key]['exchange_rate']) ? $opening_balance[$key]['exchange_rate'] : 1;
                ?>
                <div class="col-md-3">
                    <div class="form-group mb-2">
                        <?php echo Form::label('ob_currency', __('lang_v1.default_currency') . ':'); ?>

                        <select name="ob[<?php echo e($loop->index, false); ?>][location_currency_id]" class="form-select ob_currency_select" data-ob-index="<?php echo e($loop->index, false); ?>">
                            <option value=""><?php echo app('translator')->get('lang_v1.default_currency'); ?></option>
                            <?php $__currentLoopData = $ob_location_currencies[$key]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($lc['id'], false); ?>" data-multiplier="<?php echo e($lc['multiplier'], false); ?>" data-code="<?php echo e($lc['code'], false); ?>" data-symbol="<?php echo e($lc['symbol'], false); ?>"
                                    <?php if($existing_ob_currency_id == $lc['id']): ?> selected <?php endif; ?>>
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
                            <?php
                                $ob_rate_attrs = ['class' => 'form-control ob_exchange_rate', 'data-ob-index' => $loop->index, 'step' => 'any'];
                                if(empty($existing_ob_currency_id)) { $ob_rate_attrs['readonly'] = 'readonly'; }
                            ?>
                            <?php echo Form::number('ob['.$loop->index.'][exchange_rate]', $existing_ob_exchange_rate, $ob_rate_attrs); ?>

                            <button type="button" class="btn btn-outline-info btn-sm ob_refresh_exchange_rate_btn" data-ob-index="<?php echo e($loop->index, false); ?>" title="Refresh Rate"><i class="fas fa-sync-alt"></i></button>
                        </div>
                        <small class="ob_converted_amount text-muted" data-ob-index="<?php echo e($loop->index, false); ?>"></small>
                    </div>
                </div>
                <?php else: ?>
                <?php echo Form::hidden('ob['.$loop->index.'][exchange_rate]', 1); ?>

                <?php echo Form::hidden('ob['.$loop->index.'][location_currency_id]', ''); ?>

                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div class="clearfix"></div>
        
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
                    title="' . 'FBR DI requires buyer NTN/CNIC digits only: 7 digit NTN without dash/check digit (example: 4454284), or 13 digit CNIC without dashes. Click Check Reg. Type to verify before saving.' . '"></i>';
                }
            ?>
                <?php endif; ?>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa fa-info"></i>
                    </span>
                    <?php echo Form::text('tax_number', $contact->tax_number, ['class' => 'form-control', 'placeholder' => $tax_no_label]); ?>

                </div>
            </div>
        </div>
        <?php if($fbr_di_integration): ?>
        <div class="col-md-4">
            <div class="form-group mb-1">
                <?php echo Form::label('fbr_st_reg_type', __('lang_v1.fbr_st_reg_type') . ':'); ?>

                <br/>
                <?php echo Form::select('fbr_st_reg_type', ['Registered' => 'Registered', 'Unregistered' => 'Unregistered'], !empty($contact->fbr_st_reg_type) ? $contact->fbr_st_reg_type : 'Unregistered',  ['class' => 'form-control fbr_st_reg_type']); ?>

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
                    <?php echo Form::number('pay_term_number', $contact->pay_term_number, ['class' => 'form-control width-40 float-start', 'placeholder' => __('contact.pay_term')]); ?>


                    <?php echo Form::select('pay_term_type', ['months' => __('lang_v1.months'), 'days' => __('lang_v1.days')], $contact->pay_term_type, ['class' => 'form-select width-60 float-end','placeholder' => __('messages.please_select')]); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(empty($common_settings['hide_contact_credit_limit'])): ?>
        <div class="col-md-4 customer_fields">
            <div class="form-group mb-2">
                <?php echo Form::label('credit_limit', __('lang_v1.credit_limit') . ':'); ?>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-money-bill-alt"></i>
                    </span>
                    <?php echo Form::text('credit_limit', $contact->credit_limit != null ? number_format($contact->credit_limit, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, ['class' => 'form-control input_number']); ?>

                </div>
                <p class="help-block"><?php echo app('translator')->get('lang_v1.credit_limit_help'); ?></p>
            </div>
        </div>
        <?php endif; ?>
        <?php if(empty($common_settings['hide_contact_discount'])): ?>
        <div class="col-md-4 customer_fields">
            <div class="form-group mb-2">
                <?php echo Form::label('discount_type', 'Default '.__('lang_v1.discount_type') . ':' ); ?>

                <?php echo Form::select('discount_type', ['percentage'=> 'Percentage', 'fixed'=> 'Fixed'], $contact->discount_type , ['class' => 'form-control select2', 'id' => 'discount_type', 'style' => 'width: 100%;']); ?>

            </div>
        </div>

        <div class="col-md-4 customer_fields">
            <div class="form-group mb-2">
                <?php echo Form::label('discount_amount', 'Default ' .__('lang_v1.discount_amount') . ':'); ?>

                <?php echo Form::text('discount_amount', number_format($contact->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number']); ?>

            </div>
        </div>
        <div class="col-md-4 customer_fields">
            <div class="form-group mb-2">
                <?php echo Form::label('sales_discount_ids', __('sale.discounts') . ':'); ?>

                <?php echo Form::select('sales_discount_ids[]', $sales_discounts ?? [], $contact->sales_discount_ids ?? [], ['class' => 'form-control select2', 'multiple', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select')]); ?>

            </div>
        </div>
        <?php endif; ?>
        <div class="col-md-4 customer_fields">
            <div class="form-group mb-1">
                <?php echo Form::label('default_tax_id', 'Default '.__('sale.tax') . ':' ); ?>

                <?php echo Form::select('default_tax_id', $taxes['tax_rates'], $contact->default_tax_id , ['class' => 'form-control select2', 'id' => 'default_tax_id', 'style' => 'width: 100%;']); ?>

            </div>
        </div>
        <?php if(!empty($pos_settings['prompt_token_no'])): ?>
        <div class="col-sm-3 customer_fields">
            <div class="form-group mb-1">
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" name="not_ask_prompt" type="checkbox" <?php echo e(!empty($contact->not_ask_prompt) ? 'checked' : '', false); ?> > Don't Ask <?php echo e(!empty($pos_settings['prompt_token_label']) ? $pos_settings['prompt_token_label'] : 'Token No', false); ?>

                    </label>
                    
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(empty($contact_login) && empty($common_settings['hide_contact_allow_login'])): ?>
        <div class="col-md-4 customer_fields">
            <div class="form-group mb-2">
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
                <div class="form-group mb-2">
                    <?php echo Form::label("username", __( 'business.username' ) . ':*'); ?>

                    <?php echo Form::text('username', null, ['class' => 'form-control', 'placeholder' => __( 'business.username' ), 'required', 'id'=> "username", 'autocomplete' => 'off', 'disabled' => true]); ?>

                </div>
            </div>
            <div class="col-md-3 customer_fields">
                <div class="form-group mb-2">
                    <?php echo Form::label("password", __( 'business.password' ) . ':*'); ?>

                    <?php echo Form::password('password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.password' ), 'id'=>"password", 'autocomplete' => 'new-password', 'disabled' => true ]); ?>

                </div>
            </div>
            <div class="col-md-3 customer_fields">
                <div class="form-group mb-2">
                    <?php echo Form::label("confirm_password", __( 'business.confirm_password' ) . ':*'); ?>

                    <?php echo Form::password('confirm_password', ['class' => 'form-control', 'required', 'placeholder' => __( 'business.confirm_password' ), 'id' => "confirm_password", 'data-rule-equalTo' => "#password", 'autocomplete' => 'new-password', 'disabled' => true ]); ?>

                </div>
            </div>
            <div class="col-md-3 customer_fields">
                <div class="form-group mb-2">
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
        
        
        <?php if(empty($common_settings['hide_contact_address_line_1'])): ?>
        <div class="col-md-6">
            <div class="form-group mb-2">
                <?php echo Form::label('address_line_1', __('lang_v1.address_line_1') . ':'); ?>

                <?php echo Form::text('address_line_1', $contact->address_line_1, ['class' => 'form-control', 'placeholder' => __('lang_v1.address_line_1'), 'rows' => 3]); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(empty($common_settings['hide_contact_address_line_2'])): ?>
        <div class="col-md-6">
            <div class="form-group mb-2">
                <?php echo Form::label('address_line_2', __('lang_v1.address_line_2') . ':'); ?>

                <?php echo Form::text('address_line_2', $contact->address_line_2, ['class' => 'form-control', 
                    'placeholder' => __('lang_v1.address_line_2'), 'rows' => 3]); ?>

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
                        <?php echo Form::text('city', $contact->city, ['class' => 'form-control', 'placeholder' => __('business.city'), ($fbr_di_integration) ? 'required' : '']); ?>

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
                        <?php echo Form::text('state', $contact->state, ['class' => 'form-control', 'placeholder' => __('business.state'), ($fbr_di_integration) ? 'required' : '']); ?>

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
                        <?php echo Form::text('country', $contact->country, ['class' => 'form-control', 'placeholder' => __('business.country')]); ?>

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
                    <?php echo Form::label('zip_code', $zip_code_label . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <?php echo Form::text('zip_code', $contact->zip_code, ['class' => 'form-control', 'placeholder' => $zip_code_label]); ?>

                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
        <?php if(!empty($contact->contact_id) && !empty($gym_module)): ?>
            <?php
            $gym_settings = json_decode(request()->session()->get('business.gym_settings'), true);
            ?>
            <?php if(!empty($gym_settings['gym']['attendence_terminal_api_key']) && !empty($gym_settings['gym']['attendence_terminal_api_secret'])): ?>
            <div class="customer_fields"> 
                <div class="col-md-4">
                    <div class="form-group mb-1">
                        <input type="hidden" id='terminal_api_key' value="<?php echo e($gym_settings['gym']['attendence_terminal_api_key'], false); ?>">
                        <input type="hidden" id='terminal_api_secret' value="<?php echo e($gym_settings['gym']['attendence_terminal_api_secret'], false); ?>">
                        <?php echo Form::label('enroll_member', __('gym::lang.enroll_member') . ':'); ?>

                        <div class="form-group mb-1">
                            <button type="button" class="btn btn-primary enroll_member">Enroll in Terminal<i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-1">
                        <?php echo Form::label('enroll_member_finger', __('gym::lang.enroll_member_finger') . ':'); ?>

                        <div class="form-group mb-1">
                            <button type="button" class="btn btn-primary enroll_member_finger">Enroll Finger<i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endif; ?>
        
        <div class="clearfix"></div>
        <?php if(empty($common_settings['hide_contact_shipping_custom_labels'])): ?>
            <div class="col-md-12">
            <hr/>
            </div>

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

                    <?php echo Form::text('custom_field1', $contact->custom_field1, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field1]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field2', $contact_custom_field2 . ':'); ?>

                    <?php echo Form::text('custom_field2', $contact->custom_field2, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field2]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field3', $contact_custom_field3 . ':'); ?>

                    <?php echo Form::text('custom_field3', $contact->custom_field3, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field3]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field4', $contact_custom_field4 . ':'); ?>

                    <?php echo Form::text('custom_field4', $contact->custom_field4, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field4]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field5', $contact_custom_field5 . ':'); ?>

                    <?php echo Form::text('custom_field5', $contact->custom_field5, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field5]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field6', $contact_custom_field6 . ':'); ?>

                    <?php echo Form::text('custom_field6', $contact->custom_field6, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field6]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field7', $contact_custom_field7 . ':'); ?>

                    <?php echo Form::text('custom_field7', $contact->custom_field7, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field7]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field8', $contact_custom_field8 . ':'); ?>

                    <?php echo Form::text('custom_field8', $contact->custom_field8, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field8]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field9', $contact_custom_field9 . ':'); ?>

                    <?php echo Form::text('custom_field9', $contact->custom_field9, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field9]); ?>

                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('custom_field10', $contact_custom_field10 . ':'); ?>

                    <?php echo Form::text('custom_field10', $contact->custom_field10, ['class' => 'form-control', 
                        'placeholder' => $contact_custom_field10]); ?>

                </div>
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
        <?php if(empty($common_settings['hide_contact_shipping_address'])): ?>
            <div class="col-md-12 shipping_addr_div"><hr></div>

            <div class="col-md-8 col-md-offset-2 shipping_addr_div mb-10" >
                <strong><?php echo e(__('lang_v1.shipping_address'), false); ?></strong><br>
                <?php echo Form::text('shipping_address', $contact->shipping_address, ['class' => 'form-control', 
                    'placeholder' => __('lang_v1.search_address'), 'id' => 'shipping_address']); ?>

                <div class="mb-10" id="map" style="width: 100%; height: 300px;"></div>
            </div>
            <?php echo Form::hidden('position', $contact->position, ['id' => 'position']); ?>

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

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_1]', !empty($contact->shipping_custom_field_details['shipping_custom_field_1']) ? $contact->shipping_custom_field_details['shipping_custom_field_1'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_1]); ?>

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

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_2]', !empty($contact->shipping_custom_field_details['shipping_custom_field_2']) ? $contact->shipping_custom_field_details['shipping_custom_field_2'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_2]); ?>

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

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_3]', !empty($contact->shipping_custom_field_details['shipping_custom_field_3']) ? $contact->shipping_custom_field_details['shipping_custom_field_3'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_3]); ?>

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

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_4]', !empty($contact->shipping_custom_field_details['shipping_custom_field_4']) ? $contact->shipping_custom_field_details['shipping_custom_field_4'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_4]); ?>

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

                        <?php echo Form::text('shipping_custom_field_details[shipping_custom_field_5]', !empty($contact->shipping_custom_field_details['shipping_custom_field_5']) ? $contact->shipping_custom_field_details['shipping_custom_field_5'] : null, ['class' => 'form-control','placeholder' => $shipping_custom_label_5]); ?>

                    </div>
                </div>
            <?php endif; ?>

            <?php if(!empty($common_settings['is_enabled_export'])): ?>
                <div class="col-md-12 mb-12">
                    <div class="form-check">
                        <input type="checkbox" name="is_export" class="form-check-input" id="is_customer_export" <?php if(!empty($contact->is_export)): ?> checked <?php endif; ?>>
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

                            <?php echo Form::text('export_custom_field_'.$i, !empty($contact['export_custom_field_'.$i]) ? $contact['export_custom_field_'.$i] : null, ['class' => 'form-control','placeholder' => __('lang_v1.export_custom_field'.$i)]); ?>

                        </div>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
    </div>

    <?php if(!$render_full_page): ?>
    <div class="modal-footer">
        <button type="submit" id="contact_form_submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
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
