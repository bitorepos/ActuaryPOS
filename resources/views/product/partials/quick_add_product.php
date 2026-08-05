<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'saveQuickProduct']), 'method'
        => 'post', 'id' => 'quick_add_product_form', 'class' => 'd-flex flex-column overflow-hidden', 'style' => 'max-height:100%' ]); ?>


        <div class="modal-header">
            <h4 class="modal-title" id="modalTitle"><?php echo app('translator')->get( 'product.add_new_product' ); ?></h4>
            <button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php
            $sku = null;
            if(is_numeric($product_name)){
                $sku = $product_name;
                $product_name = null;
            }
            ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="mb-3">
                        <?php echo Form::label('sku', __('product.sku') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.sku') . '"></i>';
                }
            ?>
                        <?php echo Form::text('sku', $sku, ['class' => 'form-control',
                        'placeholder' => __('product.sku')]); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <?php echo Form::label('barcode_type', __('product.barcode_type') . ':*'); ?>

                        <?php echo Form::select('barcode_type', $barcode_types, 'C128', ['class' => 'form-control select2',
                        'required']); ?>

                    </div>
                </div>
                <?php
                $default_location = null;
                if(count($business_locations) == 1){
                    $default_location = array_key_first($business_locations->toArray());
                }else{
                    $default_location = array_keys($business_locations->toArray());
                }
                ?>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <?php echo Form::label('product_locations', __('business.business_locations') . ':'); ?>

                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.product_location_help') . '"></i>';
                }
            ?>
                        <?php echo Form::select('product_locations[]', $business_locations, $default_location, ['class' =>
                        'form-control select2', 'multiple', 'id' => 'product_locations']); ?>

                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <?php echo Form::label('name', __('product.product_name') . ':*'); ?>

                        <?php echo Form::text('name', $product_name, ['class' => 'form-control', 'required',
                        'placeholder' => __('product.product_name')]); ?>

                        <?php echo Form::select('type', ['single' => 'Single', 'variable' => 'Variable'], 'single', ['class' =>
                        'hide', 'id' => 'type']); ?>

                    </div>
                </div>
                
                <?php if(!empty($common_settings['enable_other_product_name'])): ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('other_name', !empty($common_settings['other_product_name_label']) ? $common_settings['other_product_name_label'] . ':': __('product.other_product_name') . ':'); ?>

                        <?php echo Form::text('other_name', null, [
                        'class' => 'form-control',
                        'placeholder' => __('product.other_product_name'),
                        ]); ?>

                    </div>
                </div>
                <?php endif; ?>
                
                <div class="col-sm-4">
                    <div class="mb-3">
                        <?php echo Form::label('unit_id', __('product.unit') . ':*'); ?>

                        <?php echo Form::select('unit_id', $units, session('business.default_unit'), ['class' => 'form-control select2', 'required']); ?>

                    </div>
                </div>

                <div class="col-sm-4 <?php if(!session('business.enable_sub_units')): ?> hide <?php endif; ?>">
                    <div class="mb-3">
                        <?php echo Form::label('sub_unit_ids', __('lang_v1.related_sub_units') . ':'); ?>

                        <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.sub_units_tooltip') . '"></i>';
                }
            ?>

                        <?php echo Form::select('sub_unit_ids[]', [], null, ['class' => 'form-control select2', 'multiple',
                        'id' => 'sub_unit_ids']); ?>

                    </div>
                </div>
                <div class="clearfix"></div>

                <?php if(empty($common_settings['hide_categories'])): ?>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                        <?php echo Form::select('category_id', $categories, null, ['placeholder' =>
                        __('messages.please_select'), 'class' => 'form-control select2']); ?>

                    </div>
                </div>

                <div
                    class="col-sm-4 <?php if(!(session('business.enable_category') && session('business.enable_sub_category'))): ?> hide <?php endif; ?>">
                    <div class="mb-3">
                        <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                        <?php echo Form::select('sub_category_id', [], null, ['placeholder' => __('messages.please_select'),
                        'class' => 'form-control select2']); ?>

                    </div>
                </div>
                <div
                    class="col-sm-4 <?php if(!(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category'))): ?> hide <?php endif; ?>">
                    <div class="mb-3">
                        <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                        <?php echo Form::select('sub2_category_id', [], null, ['placeholder' => __('messages.please_select'),
                        'class' => 'form-control select2']); ?>

                    </div>
                </div>
                <?php endif; ?>

                <?php if(empty($common_settings['hide_brand'])): ?>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                        <?php echo Form::select('brand_id', $brands, null, ['placeholder' => __('messages.please_select'),
                        'class' => 'form-control select2']); ?>

                    </div>
                </div>
                <?php endif; ?>

                <div class="clearfix"></div>
                <?php if(empty($common_settings['hide_custom_fields'])): ?>

                <?php
                $custom_labels = json_decode(session('business.custom_labels'), true);
                $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ?
                $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
                $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ?
                $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
                $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ?
                $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
                $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ?
                $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
                $product_custom_field5 = !empty($custom_labels['product']['custom_field_5']) ?
                $custom_labels['product']['custom_field_5'] : __('lang_v1.product_custom_field5');
                $product_custom_field6 = !empty($custom_labels['product']['custom_field_6']) ?
                $custom_labels['product']['custom_field_6'] : __('lang_v1.product_custom_field6');
                $product_custom_field7 = !empty($custom_labels['product']['custom_field_7']) ?
                $custom_labels['product']['custom_field_7'] : __('lang_v1.product_custom_field7');
                $product_custom_field8 = !empty($custom_labels['product']['custom_field_8']) ?
                $custom_labels['product']['custom_field_8'] : __('lang_v1.product_custom_field8');

                ?>
                <!--custom fields-->
                <?php if(empty($common_settings['product_custom_labels_textarea'])): ?>
                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field1', $product_custom_field1 . ':'); ?>

                        <?php echo Form::text(
                        'product_custom_field1',
                        !empty($duplicate_product->product_custom_field1) ? $duplicate_product->product_custom_field1 :
                        null,
                        ['class' => 'form-control', 'placeholder' => $product_custom_field1],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field2', $product_custom_field2 . ':'); ?>

                        <?php echo Form::text(
                        'product_custom_field2',
                        !empty($duplicate_product->product_custom_field2) ? $duplicate_product->product_custom_field2 :
                        null,
                        ['class' => 'form-control', 'placeholder' => $product_custom_field2],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field3', $product_custom_field3 . ':'); ?>

                        <?php echo Form::text(
                        'product_custom_field3',
                        !empty($duplicate_product->product_custom_field3) ? $duplicate_product->product_custom_field3 :
                        null,
                        ['class' => 'form-control', 'placeholder' => $product_custom_field3],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field4', $product_custom_field4 . ':'); ?>

                        <?php echo Form::text(
                        'product_custom_field4',
                        !empty($duplicate_product->product_custom_field4) ? $duplicate_product->product_custom_field4 :
                        null,
                        ['class' => 'form-control', 'placeholder' => $product_custom_field4],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field5', $product_custom_field5 . ':'); ?>

                        <?php echo Form::text(
                        'product_custom_field5',
                        !empty($duplicate_product->product_custom_field5) ? $duplicate_product->product_custom_field5 :
                        null,
                        ['class' => 'form-control', 'placeholder' => $product_custom_field5],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field6', $product_custom_field6 . ':'); ?>

                        <?php echo Form::text(
                        'product_custom_field6',
                        !empty($duplicate_product->product_custom_field6) ? $duplicate_product->product_custom_field6 :
                        null,
                        ['class' => 'form-control', 'placeholder' => $product_custom_field6],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field7', $product_custom_field7 . ':'); ?>

                        <?php echo Form::text(
                        'product_custom_field7',
                        !empty($duplicate_product->product_custom_field7) ? $duplicate_product->product_custom_field7 :
                        null,
                        ['class' => 'form-control', 'placeholder' => $product_custom_field7],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field8', $product_custom_field8 . ':'); ?>

                        <?php echo Form::text(
                        'product_custom_field8',
                        !empty($duplicate_product->product_custom_field8) ? $duplicate_product->product_custom_field8 :
                        null,
                        ['class' => 'form-control', 'placeholder' => $product_custom_field8],
                        ); ?>

                    </div>
                </div>

                <?php else: ?>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field1', $product_custom_field1 . ':'); ?>

                        <?php echo Form::textarea(
                        'product_custom_field1',
                        !empty($duplicate_product->product_custom_field1) ? $duplicate_product->product_custom_field1 :
                        null,
                        ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field1],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field2', $product_custom_field2 . ':'); ?>

                        <?php echo Form::textarea(
                        'product_custom_field2',
                        !empty($duplicate_product->product_custom_field2) ? $duplicate_product->product_custom_field2 :
                        null,
                        ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field2],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field3', $product_custom_field3 . ':'); ?>

                        <?php echo Form::textarea(
                        'product_custom_field3',
                        !empty($duplicate_product->product_custom_field3) ? $duplicate_product->product_custom_field3 :
                        null,
                        ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field3],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field4', $product_custom_field4 . ':'); ?>

                        <?php echo Form::textarea(
                        'product_custom_field4',
                        !empty($duplicate_product->product_custom_field4) ? $duplicate_product->product_custom_field4 :
                        null,
                        ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field4],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field5', $product_custom_field5. ':'); ?>

                        <?php echo Form::textarea(
                        'product_custom_field5',
                        !empty($duplicate_product->product_custom_field5) ? $duplicate_product->product_custom_field5 :
                        null,
                        ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field5],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field6', $product_custom_field6 . ':'); ?>

                        <?php echo Form::textarea(
                        'product_custom_field6',
                        !empty($duplicate_product->product_custom_field6) ? $duplicate_product->product_custom_field6 :
                        null,
                        ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field6],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field7', $product_custom_field7 . ':'); ?>

                        <?php echo Form::textarea(
                        'product_custom_field7',
                        !empty($duplicate_product->product_custom_field7) ? $duplicate_product->product_custom_field7 :
                        null,
                        ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field7],
                        ); ?>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="mb-3">
                        <?php echo Form::label('product_custom_field8', $product_custom_field8 . ':'); ?>

                        <?php echo Form::textarea(
                        'product_custom_field8',
                        !empty($duplicate_product->product_custom_field8) ? $duplicate_product->product_custom_field8 :
                        null,
                        ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field8],
                        ); ?>

                    </div>
                </div>

                <?php endif; ?>
                <?php endif; ?>

                <div class="clearfix"></div>
                <?php if(empty($common_settings['hide_product_description'])): ?>
                <div class="col-sm-8">
                    <div class="mb-3">
                        <?php echo Form::label('product_description', __('lang_v1.product_description') . ':'); ?>

                        <?php echo Form::textarea('product_description', null, ['class' => 'form-control']); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_product_image'])): ?>
                <div class="col-sm-4">
                    <div class="mb-3 product-image-wrapper">
                        <?php echo Form::label('image', __('lang_v1.product_image') . ':'); ?>

                        <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.aspect_ratio_should_be_1_1'); ?>"></i>
                        <div class="d-flex align-items-center gap-2">
                            <div class="flex-grow-1">
                                <?php echo Form::file('image', [
                                'id' => 'upload_image',
                                'accept' => 'image/*',
                                'required' => $is_image_required,
                                'class' => 'upload-element',
                                ]); ?>

                            </div>
                            <button type="button" class="btn btn-outline-primary btn-camera-capture" title="<?php echo app('translator')->get('lang_v1.capture_from_camera'); ?>">
                                <i class="fas fa-camera"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="clearfix"></div>
                <?php if(!empty($common_settings['enable_serial_number'])): ?>
                <div class="col-sm-6">
                    <div class="form-check">
                        <br>
                        <label class="form-check-label">
<?php echo Form::checkbox('enable_sr_no', 1, false, ['class' => 'form-check-input']); ?>

                            <strong><?php echo app('translator')->get('lang_v1.enable_sr_no'); ?></strong>
                        </label><?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_sr_no') . '"></i>';
                }
            ?>
                    </div>
                    <div class="form-check">
                        <br>
                        <label class="form-check-label">
<?php echo Form::checkbox('enable_sr_no_and_imei_no', 1, false, ['class' => 'form-check-input']); ?>

                            <strong><?php echo app('translator')->get('lang_v1.enable_sr_no_and_imei_no'); ?></strong>
                        </label><?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_sr_no_and_imei_no') . '"></i>';
                }
            ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(empty($common_settings['hide_Woocommerce'])): ?>
                    <!-- woocommerce -->
                    <?php if(!empty($module_form_parts)): ?>
                    <?php $__currentLoopData = $module_form_parts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(!empty($value['template_path'])): ?>
                    <?php
                    $template_data = $value['template_data'] ?: [];
                    ?>
                    <?php echo $__env->make($value['template_path'], $template_data, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if(empty($common_settings['hide_Not_for_selling'])): ?>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <br>
                        <label class="form-check-label">
<?php echo Form::checkbox('not_for_selling', 1, false, ['class' => 'form-check-input']); ?>

                            <strong><?php echo app('translator')->get('lang_v1.not_for_selling'); ?></strong>
                        </label> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_not_for_selling') . '"></i>';
                }
            ?>
                    </div>
                </div>
                <?php endif; ?>

                <div class="clearfix"></div>

                <div class="col-sm-4">
                    <div class="mb-3">
                        <?php echo Form::label('default_supplier_id', __('product.default_supplier_id') . ':'); ?>

                        <?php echo Form::select('default_supplier_id', $suppliers, null,
                        ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'],
                        ); ?>

                    </div>
                </div>
                <div class="col-sm-4" id="alert_quantity_div">
                    <div class="mb-3">
                        <?php echo Form::label('alert_quantity', __('product.alert_quantity_low') . ':'); ?>

                        <?php echo Form::text('alert_quantity', null, ['class' => 'form-control input_number',
                        'placeholder' => __('product.alert_quantity_low'), 'min' => '0']); ?>

                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-4">
                    <div class="mb-3">
                        <div class="form-check" style="padding-top: 4px;">
                            <?php echo Form::checkbox('enable_stock', 1, true, ['class' => 'form-check-input', 'id' => 'enable_stock']); ?>

                            <label class="form-check-label" for="enable_stock">
                                <strong><?php echo app('translator')->get('product.manage_stock'); ?></strong>
                            </label>
                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.enable_stock') . '"></i>';
                }
            ?>
                            <p class="help-block text-muted mb-0"><small><i><?php echo app('translator')->get('product.enable_stock_help'); ?></i></small></p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>

                <?php if(!empty($common_settings['enable_product_warranty'])): ?>
                <?php if(empty($common_settings['hide_warranty'])): ?>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <?php echo Form::label('warranty_id', __('lang_v1.warranty') . ':'); ?>

                        <?php echo Form::select('warranty_id', $warranties, null, ['class' => 'form-control select2',
                        'placeholder' => __('messages.please_select')]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <?php if(empty($common_settings['hide_weight'])): ?>
                <div class="col-sm-4">
                    <div class="mb-3">
                        <?php echo Form::label('weight', __('lang_v1.weight') . ':'); ?>

                        <?php echo Form::text('weight', null, ['class' => 'form-control', 'placeholder' =>
                        __('lang_v1.weight')]); ?>

                    </div>
                </div>
                <?php endif; ?>
                <?php if(session('business.enable_product_expiry')): ?>
                <?php if(session('business.expiry_type') == 'add_expiry'): ?>
                <?php
                $expiry_period = 12;
                $hide = true;
                ?>
                <?php else: ?>
                <?php
                $expiry_period = null;
                $hide = false;
                ?>
                <?php endif; ?>
                <div class="col-sm-4 <?php if($hide): ?> hide <?php endif; ?>">
                    <div class="mb-3">
                        <div class="multi-input">
                            <?php echo Form::label('expiry_period', __('product.expires_in') . ':'); ?><br>
                            <?php echo Form::text('expiry_period', $expiry_period, ['class' => 'form-control float-start
                            input_number',
                            'placeholder' => __('product.expiry_period'), 'style' => 'width:60%;']); ?>

                            <?php echo Form::select('expiry_period_type', ['months'=>__('product.months'),
                            'days'=>__('product.days'), '' =>__('product.not_applicable') ], 'months', ['class' =>
                            'form-control select2 float-start', 'style' => 'width:40%;', 'id' => 'expiry_period_type']); ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="clearfix"></div>


                <div class="col-sm-6 <?php if(!$has_taxes): ?> hide <?php endif; ?>">
                    <div class="mb-3">
                        <?php echo Form::label('tax', __('product.applicable_tax') . ':'); ?>

                        <?php echo Form::select('tax', $taxes, null, ['placeholder' => __('messages.please_select'), 'class' =>
                        'form-control select2'], $tax_attributes); ?>

                    </div>
                </div>
                <div class="col-sm-6 <?php if(!$has_taxes): ?> hide <?php endif; ?>">
                    <div class="mb-3">
                        <?php echo Form::label('tax_type', __('product.selling_price_tax_type') . ':*'); ?>

                        <?php echo Form::select('tax_type', ['inclusive' => __('product.inclusive'), 'exclusive' =>
                        __('product.exclusive'), 'none'=> 'None'], 
                        !empty($common_settings['default_product_tax_type']) ? $common_settings['default_product_tax_type'] : 'none',
                        ['class' => 'form-control select2', 'required']); ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <?php echo $__env->make('product.partials.single_product_form_part', ['profit_percent' => $default_profit_percent,
                    'quick_add' => true, 'has_taxes' => $has_taxes ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
            <?php if(!empty($product_for) && $product_for == 'pos'): ?>
            <?php echo $__env->make('product.partials.quick_product_opening_stock', ['locations' => $locations], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" id="submit_quick_product"><?php echo app('translator')->get( 'messages.save' ); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>

        <?php echo Form::close(); ?>


    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
$(document).ready(function() {
    $("form#quick_add_product_form").validate({
        rules: {
            sku: {
                remote: {
                    url: "/products/check_product_sku",
                    type: "post",
                    data: {
                        sku: function() {
                            return $("#sku").val();
                        },
                        product_id: function() {
                            if ($('#product_id').length > 0) {
                                return $('#product_id').val();
                            } else {
                                return '';
                            }
                        },
                    }
                }
            },
            expiry_period: {
                required: {
                    depends: function(element) {
                        return ($('#expiry_period_type').val().trim() != '');
                    }
                }
            }
        },
        messages: {
            sku: {
                remote: LANG.sku_already_exists
            }
        },
        submitHandler: function(form) {

            var form = $("form#quick_add_product_form");
            var url = form.attr('action');
            form.find('button[type="submit"]').attr('disabled', true);
            $.ajax({
                method: "POST",
                url: url,
                dataType: 'json',
                data: $(form).serialize(),
                success: function(data) {
                    $('.quick_add_product_modal').modal('hide');
                    if (data.success) {
                        toastr.success(data.msg);
                        if (typeof get_purchase_entry_row !== 'undefined') {
                            var selected_location = $('#location_id').val();
                            var location_check = true;
                            if (data.locations && selected_location && data.locations
                                .indexOf(selected_location) == -1) {
                                location_check = false;
                            }
                            if (location_check) {
                                get_purchase_entry_row(data.product.id, 0);
                            }

                        }
                        $(document).trigger({
                            type: "quickProductAdded",
                            'product': data.product,
                            'variation': data.variation
                        });
                    } else {
                        toastr.error(data.msg);
                    }
                }
            });
            return false;
        }
    });
});
    <?php if(empty($product_for)): ?>
    //Start For product type single
    //If purchase price exc tax is changed
    $(document).on('change', 'form#quick_add_product_form input#single_dpp', function(e) {
        var purchase_exc_tax = __read_number($('form#quick_add_product_form input#single_dpp'));
        purchase_exc_tax = purchase_exc_tax == undefined ? 0 : purchase_exc_tax;

        var tax_rate = $('form#quick_add_product_form select#tax').find(':selected').data('rate');
        var tax_rate_type = $('form#quick_add_product_form select#tax').find(':selected').data('type');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        if(tax_rate_type == 'fixed'){
            var purchase_inc_tax = purchase_exc_tax + tax_rate;
            __write_number($('form#quick_add_product_form  input#single_dpp_inc_tax'), purchase_inc_tax);

            var profit_percent = __read_number($('form#quick_add_product_form  #profit_percent'));
            var selling_price = __add_percent(purchase_exc_tax, profit_percent);
            __write_number($('form#quick_add_product_form input#single_dsp'), selling_price);

            var selling_price_inc_tax = selling_price + tax_rate;
            __write_number($('form#quick_add_product_form input#single_dsp_inc_tax'), selling_price_inc_tax);
        }else{
            var purchase_inc_tax = __add_percent(purchase_exc_tax, tax_rate);
            __write_number($('form#quick_add_product_form input#single_dpp_inc_tax'), purchase_inc_tax);

            var profit_percent = __read_number($('#profit_percent'));
            var selling_price = __add_percent(purchase_exc_tax, profit_percent);
            __write_number($('form#quick_add_product_form input#single_dsp'), selling_price);

            var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
            __write_number($('form#quick_add_product_form input#single_dsp_inc_tax'), selling_price_inc_tax);
        }

    });

    //If tax rate is changed
    $(document).on('change', 'form#quick_add_product_form select#tax', function() {

        // if ($('form#quick_add_product_form select#type').val() == 'single') {
            var tax_type = $('form#quick_add_product_form #tax_type').val();
            if(tax_type == 'inclusive'){
                $('form#quick_add_product_form #single_dsp_inc_tax').val($('form#quick_add_product_form #single_dsp').val())
                
                var tax_rate = $('form#quick_add_product_form select#tax')
                    .find(':selected')
                    .data('rate');
                var tax_rate_type = $('form#quick_add_product_form select#tax')
                    .find(':selected')
                    .data('type');
                
                tax_rate = tax_rate == undefined ? 0 : tax_rate;

                var single_dsp_inc_tax = __read_number($('form#quick_add_product_form #single_dsp_inc_tax'));
                
                if(tax_rate_type == 'fixed'){
                    var temp_tax = __calculate_amount('fixed', tax_rate, single_dsp_inc_tax);
                    var selling_price = single_dsp_inc_tax - temp_tax;
                }else if(tax_rate_type == 'percentage') {
                    var temp_tax = parseFloat((single_dsp_inc_tax / ((tax_rate/100)+1)).toPrecision(5));
                    var selling_price = temp_tax; 
                }
                __write_number($('form#quick_add_product_form input#single_dsp'), selling_price);

                //Update Profit Margin
                var selling_price = __read_number($('form#quick_add_product_form input#single_dsp'));
                var purchase_exc_tax = __read_number($('form#quick_add_product_form input#single_dpp'));
                var profit_percent = __read_number($('form#quick_add_product_form input#profit_percent'));

                //if purchase price not set
                if (purchase_exc_tax == 0) {
                    profit_percent = 0;
                } else {
                    profit_percent = __get_rate(purchase_exc_tax, selling_price);
                }
                __write_number($('form#quick_add_product_form input#profit_percent'), profit_percent);

            }else{
                
                var tax_rate = $('form#quick_add_product_form select#tax').find(':selected').data('rate');
                var tax_rate_type = $('form#quick_add_product_form select#tax').find(':selected').data('type');
                tax_rate = tax_rate == undefined ? 0 : tax_rate;

                if(tax_rate_type == 'fixed'){
                    var single_dpp = __read_number($('form#quick_add_product_form input#single_dpp')); 
                    __write_number($('form#quick_add_product_form input#single_dpp_inc_tax'), single_dpp+tax_rate);
                    
                    var single_dsp = __read_number($('form#quick_add_product_form input#single_dsp'));
                    var selling_price_inc_tax = single_dsp+tax_rate;
                    __write_number($('form#quick_add_product_form input#single_dsp_inc_tax'), selling_price_inc_tax);
                }else{
                    var single_dpp = __read_number($('form#quick_add_product_form input#single_dpp')); 
                    var single_dpp_inc_tax = __add_percent(single_dpp, tax_rate);
                    __write_number($('form#quick_add_product_form input#single_dpp_inc_tax'), single_dpp_inc_tax);

                    var single_dsp = __read_number($('form#quick_add_product_form input#single_dsp'));
                    var selling_price_inc_tax = __add_percent(single_dsp, tax_rate);
                    __write_number($('form#quick_add_product_form input#single_dsp_inc_tax'), selling_price_inc_tax);
                }
                var profit_percent = __read_number($('form#quick_add_product_form input#profit_percent'));
                //if purchase price not set
                if (single_dpp == 0) {
                    profit_percent = 0;
                } else {
                    profit_percent = __get_rate(single_dpp, single_dsp);
                }
                __write_number($('form#quick_add_product_form input#profit_percent'), profit_percent);
            }
        // }
    });

    //If purchase price inc tax is changed
    $(document).on('change', 'form#quick_add_product_form input#single_dpp_inc_tax', function(e) {
        var purchase_inc_tax = __read_number($('form#quick_add_product_form input#single_dpp_inc_tax'));
        purchase_inc_tax = purchase_inc_tax == undefined ? 0 : purchase_inc_tax;

        var tax_rate = $('form#quick_add_product_form select#tax')
            .find(':selected')
            .data('rate');
        var tax_rate_type = $('form#quick_add_product_form select#tax')
        .find(':selected')
        .data('type');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        if(tax_rate_type == 'fixed'){
            var purchase_exc_tax = purchase_inc_tax - tax_rate;
            __write_number($('form#quick_add_product_form input#single_dpp'), purchase_exc_tax);
            $('form#quick_add_product_form input#single_dpp').change();

            var profit_percent = __read_number($('form#quick_add_product_form #profit_percent'));
            var selling_price = __add_percent(purchase_exc_tax, profit_percent);
            __write_number($('form#quick_add_product_form input#single_dsp'), selling_price);

            var selling_price_inc_tax = selling_price + tax_rate;
            __write_number($('form#quick_add_product_form input#single_dsp_inc_tax'), selling_price_inc_tax);
        }else{
            var purchase_exc_tax = __get_principle(purchase_inc_tax, tax_rate);
            __write_number($('form#quick_add_product_form input#single_dpp'), purchase_exc_tax);
            $('form#quick_add_product_form input#single_dpp').change();

            var profit_percent = __read_number($('form#quick_add_product_form #profit_percent'));
            var selling_price = __add_percent(purchase_exc_tax, profit_percent);
            __write_number($('form#quick_add_product_form input#single_dsp'), selling_price);

            var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
            __write_number($('form#quick_add_product_form input#single_dsp_inc_tax'), selling_price_inc_tax);
        }

        // var profit_percent = __read_number($('#profit_percent'));
        // profit_percent = profit_percent == undefined ? 0 : profit_percent;
        // var selling_price = __add_percent(purchase_exc_tax, profit_percent);
        // __write_number($('input#single_dsp'), selling_price);

        // var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        // __write_number($('input#single_dsp_inc_tax'), selling_price_inc_tax);
    });

    $(document).on('change', 'form#quick_add_product_form input#profit_percent', function(e) {
        var tax_rate = $('form#quick_add_product_form select#tax')
            .find(':selected')
            .data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var purchase_inc_tax = __read_number($('form#quick_add_product_form input#single_dpp_inc_tax'));
        purchase_inc_tax = purchase_inc_tax == undefined ? 0 : purchase_inc_tax;

        var purchase_exc_tax = __read_number($('form#quick_add_product_form input#single_dpp'));
        purchase_exc_tax = purchase_exc_tax == undefined ? 0 : purchase_exc_tax;

        var profit_percent = __read_number($('form#quick_add_product_form input#profit_percent'));
        var selling_price = __add_percent(purchase_exc_tax, profit_percent);
        __write_number($('form#quick_add_product_form input#single_dsp'), selling_price);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number($('form#quick_add_product_form input#single_dsp_inc_tax'), selling_price_inc_tax);
    });

    $(document).on('change', 'form#quick_add_product_form input#single_dsp', function(e) {
        var tax_rate = $('form#quick_add_product_form select#tax')
            .find(':selected')
            .data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;

        var selling_price = __read_number($('form#quick_add_product_form input#single_dsp'));
        var purchase_exc_tax = __read_number($('form#quick_add_product_form input#single_dpp'));
        var profit_percent = __read_number($('form#quick_add_product_form input#profit_percent'));

        //if purchase price not set
        if (purchase_exc_tax == 0) {
            profit_percent = 0;
        } else {
            profit_percent = __get_rate(purchase_exc_tax, selling_price);
        }

        __write_number($('form#quick_add_product_form input#profit_percent'), profit_percent);

        var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
        __write_number($('form#quick_add_product_form input#single_dsp_inc_tax'), selling_price_inc_tax);
    });

    $(document).on('change', 'form#quick_add_product_form input#single_dsp_inc_tax', function(e) {
        var tax_rate = $('form#quick_add_product_form select#tax')
            .find(':selected')
            .data('rate');
        tax_rate = tax_rate == undefined ? 0 : tax_rate;
        var selling_price_inc_tax = __read_number($('form#quick_add_product_form input#single_dsp_inc_tax'));

        var selling_price = __get_principle(selling_price_inc_tax, tax_rate);
        __write_number($('form#quick_add_product_form input#single_dsp'), selling_price);
        var purchase_exc_tax = __read_number($('form#quick_add_product_form input#single_dpp'));
        var profit_percent = __read_number($('form#quick_add_product_form input#profit_percent'));

        //if purchase price not set
        if (purchase_exc_tax == 0) {
            profit_percent = 0;
        } else {
            profit_percent = __get_rate(purchase_exc_tax, selling_price);
        }

        __write_number($('form#quick_add_product_form input#profit_percent'), profit_percent);

    });
    <?php endif; ?>
</script>
