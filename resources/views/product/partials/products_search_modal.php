<?php
    $user_settings = json_decode(auth()->user()->user_settings, true);
    $common_settings = isset($common_settings) && ! empty($common_settings) ? $common_settings : (session()->get('business.common_settings') ?? []);
    $pos_settings = isset($pos_settings) && ! empty($pos_settings) ? $pos_settings : (json_decode(session()->get('business.pos_settings'), true) ?: []);
    $custom_fields = json_decode(session()->get('business.custom_labels'), true)['product'];
    $show_location_quantity = !empty($user_settings['ps_show_location_quantity'])
        || auth()->user()->can('product_search.show_location_quantity')
        || auth()->user()->hasRole('Admin#'.auth()->user()->business_id);
    $columns = 3;
if($user_settings['ps_show_other_name']){ $columns++; }
if($user_settings['ps_show_category']){ $columns++; }
if($user_settings['ps_show_brand']){ $columns++; }
if($user_settings['ps_show_category']){ $columns++; }
if($user_settings['ps_show_selling_price']){ $columns++; }
if($user_settings['ps_show_purchase_price']){ $columns++; }
if($user_settings['ps_show_stock_quantity']){ $columns++; }
if($user_settings['ps_show_rack_details']){ $columns++; }
if($user_settings['ps_show_custom_field1']){ $columns++; }
if($user_settings['ps_show_custom_field2']){ $columns++; }
if($user_settings['ps_show_custom_field3']){ $columns++; }
if($user_settings['ps_show_custom_field4']){ $columns++; }
if($user_settings['ps_show_price_group']){ $columns++; }
if($user_settings['ps_show_supplier']){ $columns++; }
?>

<div class="modal-dialog <?php if($columns <= 7): ?> modal-lg <?php else: ?> modal-xl <?php endif; ?> modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header bg-primary text-white py-2">
            <h5 class="modal-title fw-semibold">
                <i class="fas fa-search me-2"></i><?php echo app('translator')->get('lang_v1.products_search'); ?>
            </h5>
            <button type="button" class="btn-close btn-close-white no-print" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-3 ps-modal-body">
            
            <div class="row g-2 mb-3 align-items-end ps-filter-row">
                <div class="col-md-4 col-12">
                    <label for="products_search_text" class="form-label small fw-medium mb-1">Search Text</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" name="products_search_text" id="products_search_text"
                            placeholder="Search Product Name or SKU" autocomplete="off">
                    </div>
                </div>
                <div class="col-md-2 col-6 d-none d-md-block">
                    <div class="mb-0">
                        <?php echo Form::label('type', __('product.product_type') . ':', ['class' => 'form-label small fw-medium mb-1']); ?>

                        <?php echo Form::select(
                        'type',
                        ['single' => __('lang_v1.single'), 'variable' => __('lang_v1.variable'), 'combo' =>
                        __('lang_v1.combo')],
                        !empty($user_settings['ps_product_type']) ? $user_settings['ps_product_type'] : null,
                        [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'id' => 'product_search_filter_type',
                        'placeholder' => __('lang_v1.all'),
                        ],
                        ); ?>

                    </div>
                </div>
                <?php if(session('business.enable_category')): ?>
                <div class="col-md-2 col-6 d-none d-md-block">
                    <div class="mb-0">
                        <?php echo Form::label('category_id', __('product.category') . ':', ['class' => 'form-label small fw-medium mb-1']); ?>

                        <?php echo Form::select('category_id', $categories, !empty($user_settings['ps_category_id']) ?
                        $user_settings['ps_category_id'] : null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'id' => 'product_search_filter_category_id',
                        'placeholder' => __('lang_v1.all'),
                        ]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
                <div class="col-md-2 col-6 d-none d-md-block">
                    <div class="mb-0">
                        <?php echo Form::label('sub_category_id', __('product.sub_category') . ':', ['class' => 'form-label small fw-medium mb-1']); ?>

                        <?php echo Form::select('sub_category_id', [], null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'id' => 'product_search_filter_sub_category_id',
                        'placeholder' => __('lang_v1.all'),
                        ]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
                <div class="col-md-2 col-6 d-none d-md-block">
                    <div class="mb-0">
                        <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':', ['class' => 'form-label small fw-medium mb-1']); ?>

                        <?php echo Form::select('sub2_category_id', [], null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'id' => 'product_search_filter_sub2_category_id',
                        'placeholder' => __('lang_v1.all'),
                        ]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_brand')): ?>
                <div class="col-md-2 col-6 d-none d-md-block">
                    <div class="mb-0">
                        <?php echo Form::label('brand_id', __('product.brand') . ':', ['class' => 'form-label small fw-medium mb-1']); ?>

                        <?php echo Form::select('brand_id', $brands, !empty($user_settings['ps_brand_id']) ?
                        $user_settings['ps_brand_id'] : null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'id' => 'product_search_filter_brand_id',
                        'placeholder' => __('lang_v1.all'),
                        ]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <div class="col-md-2 col-6 d-none d-md-block">
                    <div class="mb-0">
                        <?php echo Form::label('unit_id', __('product.unit') . ':', ['class' => 'form-label small fw-medium mb-1']); ?>

                        <?php echo Form::select('unit_id', $units, !empty($user_settings['ps_unit_id']) ?
                        $user_settings['ps_unit_id'] : null, [
                        'class' => 'form-control select2',
                        'style' => 'width:100%',
                        'id' => 'product_search_filter_unit_id',
                        'placeholder' => __('lang_v1.all'),
                        ]); ?>

                    </div>
                </div>
                <input id="products_search_filter_show_exc" type="hidden"
                    value="<?php if($user_settings['ps_show_price_inclusive']): ?> 0 <?php else: ?> 1 <?php endif; ?>">
                <input id="products_search_filter_show_location_quantity" type="hidden"
                    value="<?php echo e($show_location_quantity ? 1 : 0, false); ?>">
            </div>
            
            <div class="ps-table-wrapper">
<table class="table table-bordered table-striped table-hover table-sm"
                        id="products_search_results" style="width: 100%">
                        <thead>
                            <th></th>
                            <?php if($user_settings['ps_show_custom_field1']): ?>
                            <th><?php echo e(!empty($custom_fields['custom_field_1']) ? $custom_fields['custom_field_1'] : "Custom Field 1", false); ?></th>
                            <?php endif; ?>
                            <?php if($user_settings['ps_show_custom_field2']): ?>
                            <th><?php echo e(!empty($custom_fields['custom_field_2']) ? $custom_fields['custom_field_2'] : "Custom Field 2", false); ?></th>
                            <?php endif; ?>
                            <th>SKU</th>
                            <?php if($user_settings['ps_show_brand']): ?><th>Brand</th><?php endif; ?>
                            <th>Details</th>
                            <?php if($user_settings['ps_show_other_name']): ?>
                            <th><?php echo e(!empty($common_settings['other_product_name_label']) ? $common_settings['other_product_name_label'] . ':': __('product.other_product_name') . ':', false); ?></th>
                            <?php endif; ?>
                            <?php if($user_settings['ps_show_category']): ?><th>Category</th><?php endif; ?>
                            <?php if($user_settings['ps_show_rack_details']): ?><th>Rack Details</th><?php endif; ?> 
                            <?php if($user_settings['ps_show_stock_quantity']): ?><th>Quantity</th><?php endif; ?>
                            <?php if($user_settings['ps_show_selling_price']): ?><th>Retail Price</th><?php endif; ?>
                            <?php if($user_settings['ps_show_price_group']): ?><th>Price Group</th><?php endif; ?>
                            <?php if($user_settings['ps_show_purchase_price']): ?><th>Cost Price</th><?php endif; ?>
                            <?php if($user_settings['ps_show_custom_field3']): ?>
                            <th><?php echo e(!empty($custom_fields['custom_field_3']) ? $custom_fields['custom_field_3'] : "Custom Field 3", false); ?></th>
                            <?php endif; ?>
                            <?php if($user_settings['ps_show_custom_field4']): ?>
                            <th><?php echo e(!empty($custom_fields['custom_field_4']) ? $custom_fields['custom_field_4'] : "Custom Field 4", false); ?></th>
                            <?php endif; ?>
                            <?php if($user_settings['ps_show_supplier']): ?>
                            <th><?php echo app('translator')->get('contact.supplier'); ?></th>
                            <?php endif; ?>
                        </thead>
                    </table>
            </div>
        </div>
        
        <div class="modal-footer ps-modal-footer d-flex flex-wrap justify-content-center gap-2 py-2 px-3">
            <button type="button" class="btn btn-primary ps-footer-btn" id="ps_select_products">
                <i class="fas fa-check"></i><span class="ps-btn-label">Select</span>
            </button>
            <?php if(!$is_offline): ?>
            <button type="button" class="btn btn-success ps-footer-btn" id="ps_add_new_product" 
            data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'quickAdd']), false); ?>"
            data-container=".quick_add_product_modal">
                <i class="fas fa-plus"></i><span class="ps-btn-label">New</span>
            </button>
            <?php endif; ?>
            <?php if(!$is_offline): ?>
            <button type="button" class="btn btn-success ps-footer-btn" 
                    data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'quickEdit']), false); ?>"
                    data-container=".view_modal" id="ps_edit_product">
                <i class="fas fa-edit"></i><span class="ps-btn-label">Edit</span>
            </button>
            <?php endif; ?>
            <button type="button" class="btn btn-warning ps-footer-btn" id="ps_show_product_qty_details">
                <i class="fas fa-boxes"></i><span class="ps-btn-label">Quantity</span>
            </button>
            <?php if(auth()->user()->can('product.view') && auth()->user()->can('product.view_stock_history')): ?>
                <button type="button" class="btn btn-secondary ps-footer-btn" id="ps_show_product_history_details">
                    <i class="fas fa-history"></i><span class="ps-btn-label">History</span>
                </button>
            <?php endif; ?>
            <?php if($pos_settings['enable_sales_order']): ?>
            <button type="button" class="btn btn-info text-white ps-footer-btn" id="ps_show_product_stock_on_so">
                <i class="fas fa-clipboard-list"></i><span class="ps-btn-label">Stock on SO</span>
            </button>
            <?php endif; ?>
            <?php if($common_settings['enable_purchase_order']): ?>
            <button type="button" class="btn btn-outline-warning ps-footer-btn" id="ps_show_product_stock_on_po">
                <i class="fas fa-clipboard-check"></i><span class="ps-btn-label">Stock on PO</span>
            </button>
            <?php endif; ?>
            <?php if($common_settings['enable_serial_number']): ?>
            <button type="button" class="btn btn-warning ps-footer-btn" id="ps_show_product_sr_no_details">
                <i class="fas fa-hashtag"></i><span class="ps-btn-label">Serial No.</span>
            </button>
            <?php endif; ?>
            <button type="button" class="btn btn-outline-secondary ps-footer-btn" id="ps_save_settings">
                <i class="fas fa-save"></i><span class="ps-btn-label">Save</span>
            </button>
            <button type="button" id="ps_settings" class="btn btn-outline-secondary ps-footer-btn" data-bs-toggle="modal"
                data-bs-target="#configure_search_modal" title="<?php echo e(__('lang_v1.configure_product_search'), false); ?>">
                <i class="fas fa-cog"></i><span class="ps-btn-label">Settings</span>
            </button>
            <button type="button" class="btn btn-danger ps-footer-btn" data-bs-dismiss="modal">
                <i class="fas fa-times"></i><span class="ps-btn-label">Close</span>
            </button>
        </div>
    </div>
</div>


<style>
    #products_search_modal .dataTables_filter { display: none; }
    #products_search_results tbody tr.bg-gray > th,
    #products_search_results tbody tr.bg-gray > td { background-color: #d2d6de !important; }
    #products_search_results .ps-row-select.focused-checkbox {
        outline: 2px solid #00c0ef !important;
        outline-offset: 2px;
    }
</style>
<script>
    var page_length = <?php echo e(!empty($common_settings['ps_page_length']) ? $common_settings['ps_page_length'] : 10, false); ?>;
    window.productSearchTableHasLoaded = false;
    $('#products_search_results').on('xhr.dt', function() {
        window.productSearchTableHasLoaded = true;
    });
    product_search_table = $('#products_search_results').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                deferLoading: 0,
                // autoWidth:true,	
                // responsive:true,
                lengthChange:true,	
                dom: 'Bfrt', //Bfrtip for everything 
                buttons: [],
                pageLength: page_length,
                aaSorting: [
                    [2, 'asc']
                ],
                scrollY: "calc(90vh - 260px)",
                scrollX: true,
                scrollCollapse: true,
                "ajax": {
                    "url": "/products",
                    "data": function(d) {
                        d.type = $('#product_search_filter_type').val();
                        d.category_id = $('#product_search_filter_category_id').val();
                        d.sub_category_id = $('#product_search_filter_sub_category_id').val();
                        d.sub2_category_id = $('#product_search_filter_sub2_category_id').val();
                        d.brand_id = $('#product_search_filter_brand_id').val();
                        d.unit_id = $('#product_search_filter_unit_id').val();
                        d.term = $('#products_search_text').val();
                        // d.tax_id = $('#product_list_filter_tax_id').val();
                        d.active_state = 'active';
                        // d.not_for_selling = $('#not_for_selling').is(':checked');
                        d.show_price_exc_tax = $('#products_search_filter_show_exc').val();
                        d.only_show_location_stock = $('#products_search_filter_show_location_quantity').val();
                        d.location_id = ($('#wh_transfer_page').length) ? '' : (typeof get_product_search_location_id === 'function' ? get_product_search_location_id() : $('#location_id').val());
                        d.price_group = $('#price_group').val();
                        d.page_type = $('#page_type').val();
                        d = __datatable_ajax_callback(d);
                        d.product_search = true;

                        var current_path = window.location.pathname.replace(/\/+$/, '');
                        var is_pos_screen = /\/pos(\/create|\/\d+\/edit)?$/.test(current_path);
                        var is_sell_create_or_edit = /\/sells\/create$/.test(current_path) || /\/sells\/\d+\/edit$/.test(current_path);
                        if (is_pos_screen || is_sell_create_or_edit) {
                            d.hide_not_for_sale = true;
                            if (d.location_id) {
                                d.only_show_location_stock = 1;
                            }
                        }
                    },
                },
                language: {
                    processing: '<i class="fa fa-spinner fa-spin"></i> Processing...'
                },
                columnDefs: [{
                    // "targets": [0, 1, 2, 3, 4,5],
                    "orderable": false,
                    "searchable": false,
                    // "className":'col-md-2',
                }],
                columns: [{
                        data: 'row_select',
                        className: 'col-md-1',
                    },
                    <?php if($user_settings['ps_show_custom_field1']): ?>
                    {
                        data: 'product_custom_field1',
                        name: 'products.product_custom_field1',
                        searchable : true,
                    },
                    <?php endif; ?>
                    <?php if($user_settings['ps_show_custom_field2']): ?>
                    {
                        data: 'product_custom_field2',
                        name: 'products.product_custom_field2',
                        searchable : true,
                    },
                    <?php endif; ?>

                    {
                        data: 'sku',
                        name: 'products.sku',
                        className: 'col-md-1',
                    },
                    <?php if($user_settings['ps_show_brand']): ?>
                    {
                        data: 'brand',
                        name: 'brands.name',
                        searchable : true,
                    },
                    <?php endif; ?> 
                    {
                        data: 'product',
                        name: 'products.name',
                        className: 'col-md-2',
                        searchable : true,
                    },
                    <?php if($user_settings['ps_show_other_name']): ?>
                    {
                        data: 'other_name',
                        name: 'products.other_name',
                        searchable : true,
                    },
                    <?php endif; ?>
                    <?php if($user_settings['ps_show_category']): ?>
                    {
                        data: 'category',
                        name: 'c1.name',
                        searchable : true,
                    },
                    <?php endif; ?>
                    <?php if($user_settings['ps_show_rack_details']): ?>
                    {
                        data: 'rack_details',
                        name: 'rack_details',
                        searchable: true,
                    },
                    <?php endif; ?>
                    <?php if($user_settings['ps_show_stock_quantity']): ?>
                    {
                        data: 'current_stock',
                        searchable: false,
                    },
                    <?php endif; ?>
                    
                    <?php if($user_settings['ps_show_selling_price']): ?>
                    {
                        data: 'selling_price',
                        name: 'max_price',
                        searchable: false
                    },
                    <?php endif; ?>

                    <?php if($user_settings['ps_show_price_group']): ?>
                    {
                        data: 'price_group',
                        name: 'price_group',
                        searchable: false
                    },
                    <?php endif; ?>
                    <?php if($user_settings['ps_show_purchase_price']): ?>
                    {
                        data: 'purchase_price',
                        name: 'max_purchase_price',
                        searchable: false
                    },
                    <?php endif; ?>
                    
                    
                    <?php if($user_settings['ps_show_custom_field3']): ?>
                    {
                        data: 'product_custom_field3',
                        name: 'products.product_custom_field3',
                        searchable : true,
                    },
                    <?php endif; ?>
                    <?php if($user_settings['ps_show_custom_field4']): ?>
                    {
                        data: 'product_custom_field4',
                        name: 'products.product_custom_field4',
                        searchable : true,
                    },
                    <?php endif; ?>
                    <?php if($user_settings['ps_show_supplier']): ?>
                    {
                        data: 'supplier',
                        name: 'sup.name',
                        searchable : true,
                    },
                    <?php endif; ?>
                ],
                fnDrawCallback: function(oSettings) {
                    __currency_convert_recursively($('#products_search_results'));
                    // Re-focus search field after DataTable draw completes
                    if ($('#products_search_modal').hasClass('show')) {
                        setTimeout(function() {
                            if (typeof apply_pending_product_search_row_focus === 'function'
                                && apply_pending_product_search_row_focus()) {
                                return;
                            }
                            if (typeof focus_product_search_text === 'function') {
                                focus_product_search_text(false, false);
                            } else {
                                $('#products_search_text').trigger('focus');
                            }
                        }, 50);
                    }
                    // if ($('#products_search_text').val().length > 0) {
                    //     var search_text = $('#products_search_text').val().trim().toLowerCase();
                    //     // var search_text = $('#products_search_text').val();
                    //     // var regex = new RegExp(search_text, "gi");
                    //     var words = search_text.split(/\s+/);
                    //     $('#products_search_results .product-name').each(function() {
                    //         if ($(this).is('td')) {
                    //             words.forEach(function(word) {
                    //                 var regex = new RegExp(word, "gi");
                    //                 var text = $(this).text();
                    //                 var newText = text.replace(regex, function(match) {
                    //                     return "<span class='text-info'>" + match +
                    //                         "</span>";
                    //                 });
                    //                 $(this).html(newText);
                    //             });
                    //         }
                    //     });
                    // }

                },
            });
            $('#product_search_filter_type, #product_search_filter_category_id, #product_search_filter_sub_category_id, #product_search_filter_sub2_category_id, #product_search_filter_brand_id, #product_search_filter_unit_id')
                .select2({
                    dropdownParent: $('#product_search_filter_type').closest('.modal')
                });
            // Re-focus search field after select2 init
            setTimeout(function() {
                if (typeof focus_product_search_text === 'function') {
                    focus_product_search_text(false, false);
                } else {
                    $('#products_search_text').trigger('focus');
                }
            }, 150);

            // Populate sub-categories when category changes in product search modal
            // Use .off() first to prevent duplicate handlers when modal is re-opened
            $(document).off('change.ps_category').on('change.ps_category', '#product_search_filter_category_id', function() {
                var cat = $(this).val();
                $('#product_search_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
                if (cat) {
                    $.ajax({
                        method: 'POST',
                        url: '/products/get_sub_categories',
                        dataType: 'html',
                        data: { cat_id: cat },
                        success: function(result) {
                            if (result) {
                                $('#product_search_filter_sub_category_id').html(result);
                                $('#product_search_filter_sub_category_id').trigger('change');
                            }
                        },
                    });
                } else {
                    $('#product_search_filter_sub_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
                    $('#product_search_filter_sub_category_id').trigger('change');
                }
            });

            // Populate sub2-categories when sub-category changes in product search modal
            $(document).off('change.ps_subcategory').on('change.ps_subcategory', '#product_search_filter_sub_category_id', function() {
                var sub_cat = $(this).val();
                if (sub_cat) {
                    $.ajax({
                        method: 'POST',
                        url: '/products/get_sub_categories',
                        dataType: 'html',
                        data: { cat_id: sub_cat },
                        success: function(result) {
                            if (result) {
                                $('#product_search_filter_sub2_category_id').html(result);
                            }
                            if (product_search_table) {
                                window.productSearchTableHasLoaded = true;
                                product_search_table.ajax.reload();
                            }
                        },
                    });
                } else {
                    $('#product_search_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
                    if (product_search_table) {
                        window.productSearchTableHasLoaded = true;
                        product_search_table.ajax.reload();
                    }
                }
            });

            // Reload DataTable when sub2-category changes
            $(document).off('change.ps_sub2category').on('change.ps_sub2category', '#product_search_filter_sub2_category_id', function() {
                if (product_search_table) {
                    window.productSearchTableHasLoaded = true;
                    product_search_table.ajax.reload();
                }
            });
</script>
