
<?php $__env->startSection('title', __('product.add_new_product')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="d-flex align-items-start justify-content-between">
        <h1 class="mb-0"><?php echo app('translator')->get('product.add_new_product'); ?></h1>
        <div class="d-flex gap-2 flex-shrink-0">
            <button type="button" id="set_product_default" class="btn btn-flat bg-primary">Set Default</button>
            <button type="button" id="reset_product_default" class="btn btn-flat bg-info">Reset</button>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <?php
    $form_class = empty($duplicate_product) ? 'create' : '';
    $is_image_required = !empty($common_settings['is_product_image_required']);
    ?>
    <?php if(!empty($common_settings['warn_same_product_name'])): ?>
    <input type="hidden" id="warn_same_product_name">
    <?php endif; ?>
    <?php echo Form::open([
    'url' => action([\App\Http\Controllers\ProductController::class, 'store']),
    'method' => 'post',
    'id' => 'product_add_form',
    'class' => 'product_form ' . $form_class,
    'files' => true,
    ]); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group mb-2">
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
                <?php echo Form::text('sku', null, ['class' => 'form-control', 'placeholder' => __('product.sku')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php
                    if(!empty($product_default['barcode_type'])){
                        $barcode_default = $product_default['barcode_type'];
                    }
                ?>
                <?php echo Form::label('barcode_type', __('product.barcode_type') . ':*'); ?>

                <?php echo Form::select(
                'barcode_type',
                $barcode_types,
                !empty($duplicate_product->barcode_type) ? $duplicate_product->barcode_type : $barcode_default,
                ['class' => 'form-select select2', 'required'],
                ); ?>

            </div>
        </div>
        <?php
        $default_location = null;
        if (count($business_locations) == 1) {
            $default_location = array_key_first($business_locations->toArray());
        }else{
            $default_location = array_keys($business_locations->toArray());
        }
    
        if(!empty($product_default['product_locations'])){
            $default_location = $product_default['product_locations'];
        }
        ?>
        <div class="col-sm-4">
            <div class="form-group mb-2">
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
                <?php echo Form::select('product_locations[]', $business_locations, $default_location, [
                'class' => 'form-select select2',
                'multiple',
                'id' => 'product_locations',
                ]); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('name', __('product.product_name') . ':*'); ?>

                <?php echo Form::text('name', !empty($duplicate_product->name) ? $duplicate_product->name : null, [
                'class' => 'form-control',
                'required',
                'placeholder' => __('product.product_name'),
                ]); ?>

            </div>
        </div>
       
        <?php if(!empty($common_settings['enable_other_product_name'])): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('other_name', !empty($common_settings['other_product_name_label']) ? $common_settings['other_product_name_label'] . ':': __('product.other_product_name') . ':',
                ); ?>

                <?php echo Form::text('other_name', !empty($duplicate_product->other_name) ? $duplicate_product->other_name : null, [
                'class' => 'form-control',
                'placeholder' => __('product.other_product_name'),
                ]); ?>

            </div>
        </div>
        <?php endif; ?>

        <?php if(!empty($common_settings['enable_potency'])): ?>
            <div class="col-sm-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('potencies', __('product.potency') . ':'); ?>

                    <?php echo Form::select('potencies[]', $potencies, '', [
                    'class' => 'form-select select2',
                    'multiple',
                    'id' => 'potencies',
                    ]); ?>

                </div>
            </div>
        <?php endif; ?>
        <?php if(!empty($common_settings['enable_drugs_class'])): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('drug_classes', __('product.drugs_class') . ':'); ?>

                <?php echo Form::select('drug_classes[]', $drug_classes, '', [
                'class' => 'form-select select2',
                'multiple',
                'id' => 'drug_classes',
                ]); ?>

            </div>
        </div>
        <?php endif; ?>
        <!-- <div class="clearfix"></div> -->

        <?php if(!empty($common_settings['enable_generic_name'])): ?>
        <div class="col-sm-12">
            <div class="form-group mb-2">
                <?php echo Form::label(
                'generic_names',
                !empty($common_settings['generic_name_label'])
                ? $common_settings['generic_name_label'] . ':'
                : __('product.generic_name') . ':',
                ); ?>

                <?php echo Form::select('generic_names[]', $generic_names, '', [
                'class' => 'form-select select2',
                'multiple',
                'id' => 'generic_names',
                'style' => 'width: 100%;']); ?>

            </div>
        </div>
        
        <?php endif; ?>

        <!-- here is multiple selection table like opening qty -->
        <!-- <div class="clearfix"></div> -->

        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php
                    $unit_id = session('business.default_unit');
                    if(!empty($product_default['unit_id'])){
                        $unit_id = $product_default['unit_id'];
                    }
                ?>
                <?php echo Form::label('unit_id', __('product.unit') . ':*'); ?>

                <div class="input-group">
                    <?php echo Form::select(
                    'unit_id',
                    $units,
                    !empty($duplicate_product->unit_id) ? $duplicate_product->unit_id :
                    $unit_id,
                    ['class' => 'form-select  select2', 'required', 'id' => 'unit_id'],
                    ); ?>

                    
                        <button type="button" <?php if(!auth()->user()->can('unit.create')): ?> disabled <?php endif; ?>
                            class="btn btn-primary bg-white btn-flat btn-modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\UnitController::class, 'create'], ['quick_add' => true]), false); ?>"
                            title="<?php echo app('translator')->get('unit.add_unit'); ?>" data-container=".view_modal"><i
                                class="fa fa-plus-circle text-primary fa-lg"></i></button>
                    
                </div>
            </div>
        </div>

        <div class="col-sm-4 <?php if(!session('business.enable_sub_units')): ?> hide <?php endif; ?>">
            <?php
                $sub_unit_ids = null;
                $prefill_sub_units = [];
                if(!empty($product_default['sub_unit_ids']) && !empty($sub_units)){
                    $sub_unit_ids = $product_default['sub_unit_ids'];
                    $prefill_sub_units = $sub_units;
                }
            ?>
            <div class="form-group mb-2">
                
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

                <?php echo Form::select(
                'sub_unit_ids[]',
                $prefill_sub_units,
                !empty($duplicate_product->sub_unit_ids) ? $duplicate_product->sub_unit_ids : $sub_unit_ids,
                ['class' => 'form-select  select2', 'multiple', 'id' => 'sub_unit_ids'],
                ); ?>

            </div>
        </div>
        <?php if(!empty($common_settings['enable_secondary_unit'])): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('secondary_unit_id', __('lang_v1.secondary_unit') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.secondary_unit_help') . '"></i>';
                }
            ?>
                <?php echo Form::select(
                'secondary_unit_id',
                $units,
                !empty($duplicate_product->secondary_unit_id) ? $duplicate_product->secondary_unit_id : null,
                ['class' => 'form-select  select2'],
                ); ?>

            </div>
        </div>
        <?php endif; ?>

        <div class="clearfix"></div>

        <div class="col-sm-4 <?php if(!session('business.enable_category')): ?> hide <?php endif; ?>">
            <?php
                $category_id = null;
                if(!empty($product_default['category_id'])){
                    $category_id = $product_default['category_id'];
                }
            ?>
            <div class="form-group mb-2">
                <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select(
                    'category_id',
                    $categories,
                    !empty($duplicate_product->category_id) ? $duplicate_product->category_id : $category_id,
                    ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2', 'id' => 'category_id'],
                    ); ?>

                    
                        <button type="button" class="btn btn-primary bg-white btn-flat btn-modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'create'], ['type' => 'product', 'quick_add' => true]), false); ?>"
                            title="<?php echo app('translator')->get('category.add_category'); ?>" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                    
                </div>
            </div>
        </div>

        <div
            class="col-sm-4 <?php if(!(session('business.enable_category') && session('business.enable_sub_category'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php
                    $sub_category_id = null;
                    if(!empty($product_default['sub_category_id'])){
                        $sub_category_id = $product_default['sub_category_id'];
                    }
                ?>
                <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                <?php echo Form::select(
                'sub_category_id',
                $sub_categories,
                !empty($duplicate_product->sub_category_id) ? $duplicate_product->sub_category_id : $sub_category_id,
                ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2', 'id' => 'sub_category_id'],
                ); ?>

            </div>
        </div>
        <div
            class="col-sm-4 <?php if(!(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                <?php echo Form::select(
                'sub2_category_id',
                $sub2_categories ?? [],
                null,
                ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2', 'id' => 'sub2_category_id'],
                ); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(!session('business.enable_brand')): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php
                    $brand_id = null;
                    if(!empty($product_default['brand_id'])){
                        $brand_id = $product_default['brand_id'];
                    }
                ?>
                <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select(
                    'brand_id',
                    $brands,
                    $selected_brand_id,
                    ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2', 'id' => 'brand_id'],
                    ); ?>

                    <span class="input-group-btn">
                        <button type="button" <?php if(!auth()->user()->can('brand.create')): ?> disabled <?php endif; ?>
                            class="btn
                            btn-default bg-white btn-flat btn-modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\BrandController::class, 'create'], ['quick_add' => true]), false); ?>"
                            title="<?php echo app('translator')->get('brand.add_brand'); ?>" data-container=".view_modal"><i
                                class="fa fa-plus-circle text-primary fa-lg"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-4 <?php if(!(session('business.enable_brand') && session('business.enable_sub_brand'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                <?php echo Form::select(
                'sub_brand_id',
                $sub_brands,
                $selected_sub_brand_id,
                ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2', 'id' => 'sub_brand_id'],
                ); ?>

            </div>
        </div>

        <div class="col-sm-4 <?php if(!session('business.enable_gender')): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select(
                    'gender_id',
                    $genders,
                    $selected_gender_id,
                    ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2', 'id' => 'gender_id'],
                    ); ?>

                    <span class="input-group-btn">
                        <button type="button" <?php if(!auth()->user()->can('gender.create')): ?> disabled <?php endif; ?>
                            class="btn btn-default bg-white btn-flat btn-modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\GenderController::class, 'create'], ['quick_add' => true]), false); ?>"
                            title="<?php echo app('translator')->get('gender.add_gender'); ?>" data-container=".view_modal"><i
                                class="fa fa-plus-circle text-primary fa-lg"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-4 <?php if(!(session('business.enable_gender') && session('business.enable_sub_gender'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                <?php echo Form::select(
                'sub_gender_id',
                $sub_genders,
                $selected_sub_gender_id,
                ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2', 'id' => 'sub_gender_id'],
                ); ?>

            </div>
        </div>

        <div class="col-sm-4 <?php if(!session('business.enable_procurement_source')): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select(
                    'procurement_source_id',
                    $procurement_sources,
                    $selected_procurement_source_id,
                    ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2', 'id' => 'procurement_source_id'],
                    ); ?>

                    <span class="input-group-btn">
                        <button type="button" <?php if(!auth()->user()->can('procurement_source.create')): ?> disabled <?php endif; ?>
                            class="btn btn-default bg-white btn-flat btn-modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\ProcurementSourceController::class, 'create'], ['quick_add' => true]), false); ?>"
                            title="<?php echo app('translator')->get('procurement_source.add_procurement_source'); ?>" data-container=".view_modal"><i
                                class="fa fa-plus-circle text-primary fa-lg"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-sm-4 <?php if(!(session('business.enable_procurement_source') && session('business.enable_sub_procurement_source'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                <?php echo Form::select(
                'sub_procurement_source_id',
                $sub_procurement_sources,
                $selected_sub_procurement_source_id,
                ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2', 'id' => 'sub_procurement_source_id'],
                ); ?>

            </div>
        </div>

        <div class="clearfix"></div>
       
        <?php
        $custom_labels = json_decode(session('business.custom_labels'), true);
        $product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : '';
        $product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : '';
        $product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : '';
        $product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : '';
        $product_custom_field5 = !empty($custom_labels['product']['custom_field_5']) ? $custom_labels['product']['custom_field_5'] : '';
        $product_custom_field6 = !empty($custom_labels['product']['custom_field_6']) ? $custom_labels['product']['custom_field_6'] : '';
        $product_custom_field7 = !empty($custom_labels['product']['custom_field_7']) ? $custom_labels['product']['custom_field_7'] : '';
        $product_custom_field8 = !empty($custom_labels['product']['custom_field_8']) ? $custom_labels['product']['custom_field_8'] : '';

        ?>
        <!--custom fields-->
        <?php if(empty($common_settings['product_custom_labels_textarea'])): ?>
        <?php if(!empty($product_custom_field1)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field1', $product_custom_field1 . ':'); ?>

                <?php echo Form::text(
                'product_custom_field1',
                !empty($duplicate_product->product_custom_field1) ? $duplicate_product->product_custom_field1 : null,
                ['class' => 'form-control', 'placeholder' => $product_custom_field1],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field2)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field2', $product_custom_field2 . ':'); ?>

                <?php echo Form::text(
                'product_custom_field2',
                !empty($duplicate_product->product_custom_field2) ? $duplicate_product->product_custom_field2 : null,
                ['class' => 'form-control', 'placeholder' => $product_custom_field2],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field3)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field3', $product_custom_field3 . ':'); ?>

                <?php echo Form::text(
                'product_custom_field3',
                !empty($duplicate_product->product_custom_field3) ? $duplicate_product->product_custom_field3 : null,
                ['class' => 'form-control', 'placeholder' => $product_custom_field3],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field4)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field4', $product_custom_field4 . ':'); ?>

                <?php echo Form::text(
                'product_custom_field4',
                !empty($duplicate_product->product_custom_field4) ? $duplicate_product->product_custom_field4 : null,
                ['class' => 'form-control', 'placeholder' => $product_custom_field4],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field5)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field5', $product_custom_field5 . ':'); ?>

                <?php echo Form::text(
                'product_custom_field5',
                !empty($duplicate_product->product_custom_field5) ? $duplicate_product->product_custom_field5 : null,
                ['class' => 'form-control', 'placeholder' => $product_custom_field5],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field6)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field6', $product_custom_field6 . ':'); ?>

                <?php echo Form::text(
                'product_custom_field6',
                !empty($duplicate_product->product_custom_field6) ? $duplicate_product->product_custom_field6 : null,
                ['class' => 'form-control', 'placeholder' => $product_custom_field6],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field7)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field7', $product_custom_field7 . ':'); ?>

                <?php echo Form::text(
                'product_custom_field7',
                !empty($duplicate_product->product_custom_field7) ? $duplicate_product->product_custom_field7 : null,
                ['class' => 'form-control', 'placeholder' => $product_custom_field7],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field8)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field8', $product_custom_field8 . ':'); ?>

                <?php echo Form::text(
                'product_custom_field8',
                !empty($duplicate_product->product_custom_field8) ? $duplicate_product->product_custom_field8 : null,
                ['class' => 'form-control', 'placeholder' => $product_custom_field8],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        
        <?php else: ?>

        <?php if(!empty($product_custom_field1)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field1', $product_custom_field1 . ':'); ?>

                <?php echo Form::textarea(
                'product_custom_field1',
                !empty($duplicate_product->product_custom_field1) ? $duplicate_product->product_custom_field1 : null,
                ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field1],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field2)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field2', $product_custom_field2 . ':'); ?>

                <?php echo Form::textarea(
                'product_custom_field2',
                !empty($duplicate_product->product_custom_field2) ? $duplicate_product->product_custom_field2 : null,
                ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field2],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field3)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field3', $product_custom_field3 . ':'); ?>

                <?php echo Form::textarea(
                'product_custom_field3',
                !empty($duplicate_product->product_custom_field3) ? $duplicate_product->product_custom_field3 : null,
                ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field3],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field4)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field4', $product_custom_field4 . ':'); ?>

                <?php echo Form::textarea(
                'product_custom_field4',
                !empty($duplicate_product->product_custom_field4) ? $duplicate_product->product_custom_field4 : null,
                ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field4],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field5)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field5', $product_custom_field5. ':'); ?>

                <?php echo Form::textarea(
                'product_custom_field5',
                !empty($duplicate_product->product_custom_field5) ? $duplicate_product->product_custom_field5 : null,
                ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field5],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field6)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field6', $product_custom_field6 . ':'); ?>

                <?php echo Form::textarea(
                'product_custom_field6',
                !empty($duplicate_product->product_custom_field6) ? $duplicate_product->product_custom_field6 : null,
                ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field6],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field7)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field7', $product_custom_field7 . ':'); ?>

                <?php echo Form::textarea(
                'product_custom_field7',
                !empty($duplicate_product->product_custom_field7) ? $duplicate_product->product_custom_field7 : null,
                ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field7],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field8)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field8', $product_custom_field8 . ':'); ?>

                <?php echo Form::textarea(
                'product_custom_field8',
                !empty($duplicate_product->product_custom_field8) ? $duplicate_product->product_custom_field8 : null,
                ['class' => 'form-control', 'rows' => 2, 'placeholder' => $product_custom_field8],
                ); ?>

            </div>
        </div>
        <?php endif; ?>

        <?php endif; ?>

        <div class="clearfix"></div>



        <!-- include module fields -->

        <?php if(!empty($pos_module_data)): ?>
        <?php $__currentLoopData = $pos_module_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!empty($value['view_path'])): ?>
        <?php if ($__env->exists($value['view_path'], ['view_data' => $value['view_data']])) echo $__env->make($value['view_path'], ['view_data' => $value['view_data']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <div class="clearfix"></div>

        <?php if(!empty($common_settings['enable_product_description'])): ?>

        <div class="col-sm-8">
            <div class="form-group mb-2">
                <?php echo Form::label('product_description', __('lang_v1.product_description') . ':'); ?>

                <?php echo Form::textarea(
                'product_description',
                !empty($duplicate_product->product_description) ? $duplicate_product->product_description : null,
                ['class' => 'form-control'],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($common_settings['enable_product_image'])): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2 product-image-wrapper">
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
        <?php
            $selected_type_for_gallery = !empty($duplicate_product->type) ? $duplicate_product->type : (!empty($product_default['type']) ? $product_default['type'] : 'single');
        ?>
        <div class="col-sm-4 product-gallery-wrapper <?php if($selected_type_for_gallery != 'single'): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('product_gallery_images', 'Product gallery images:'); ?>

                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br>Upload multiple images for the single product gallery."></i>
                <?php echo Form::hidden('featured_gallery_image_index', null, ['id' => 'featured_gallery_image_index']); ?>

                <?php echo Form::file('product_gallery_images[]', [
                    'id' => 'product_gallery_images',
                    'accept' => 'image/*',
                    'multiple',
                    'class' => 'upload-element',
                ]); ?>

                <div class="product-gallery-selected-preview d-flex flex-wrap gap-2 mt-2"></div>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <?php if(!empty($common_settings['enable_product_brochure'])): ?>
    <div class="col-sm-4">
        <div class="form-group mb-2">
            <?php echo Form::label('product_brochure', __('lang_v1.product_brochure') . ':'); ?>

            <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
            <?php echo Form::file('product_brochure', [
            'id' => 'product_brochure',
            'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types'))),
            ]); ?>

        </div>
    </div>
    <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <div class="row">
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
            <div class="form-group mb-2">
                <div class="multi-input">
                    <?php echo Form::label('expiry_period', __('product.expires_in') . ':'); ?><br>
                    <?php echo Form::text(
                    'expiry_period',
                    !empty($duplicate_product->expiry_period) ? number_format($duplicate_product->expiry_period, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) :
                    $expiry_period,
                    [
                    'class' => 'form-select float-start
                    input_number',
                    'placeholder' => __('product.expiry_period'),
                    'style' => 'width:60%;',
                    ],
                    ); ?>

                    <?php echo Form::select(
                    'expiry_period_type',
                    ['months' => __('product.months'), 'days' => __('product.days'), '' =>
                    __('product.not_applicable')],
                    !empty($duplicate_product->expiry_period_type) ? $duplicate_product->expiry_period_type : 'months',
                    ['class' => 'form-select  select2 float-start', 'style' => 'width:40%;', 'id' =>
                    'expiry_period_type'],
                    ); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($common_settings['enable_serial_number'])): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php
                    $enable_sr_no = false;
                    if(!empty($product_default['enable_sr_no'])){
                        $enable_sr_no = ($product_default['enable_sr_no'] == 'true') ? true : false;
                    }
                ?>
                <div class="form-check mb-2">
                    <?php echo Form::checkbox('enable_sr_no', 1, !empty($duplicate_product) ? $duplicate_product->enable_sr_no
                        : $enable_sr_no, [
                        'class' => 'form-check-input',
                        'id' => 'enable_sr_no',
                        ]); ?>

                    <label class="form-check-label" for="enable_sr_no">
                        <strong><?php echo app('translator')->get('lang_v1.enable_sr_no'); ?></strong>
                    </label>
                    <?php
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
                <?php if(!empty($common_settings['enable_imei_number'])): ?>
                <?php
                    $enable_imei_no = false;
                    if(!empty($product_default['enable_imei_no'])){
                        $enable_imei_no = ($product_default['enable_imei_no'] == 'true') ? true : false;
                    }
                ?>
                <div class="form-check">
                    <?php echo Form::checkbox('enable_imei_no', 1, $enable_imei_no, ['class' => 'form-check-input', 'id' => 'enable_imei_no']); ?>

                    <label class="form-check-label" for="enable_imei_no">
                        <strong><?php echo app('translator')->get('lang_v1.enable_imei_no'); ?></strong>
                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_enable_imei_no') . '"></i>';
                }
            ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php
                    $not_for_selling = false;
                    if(!empty($product_default['not_for_selling'])){
                        $not_for_selling = ($product_default['not_for_selling'] == 'true') ? true : false;
                    }
                ?>
                <div class="form-check">
                    <?php echo Form::checkbox(
                        'not_for_selling',
                        1,
                        !empty($duplicate_product) ? $duplicate_product->not_for_selling : $not_for_selling,
                        ['class' => 'form-check-input', 'id'=> 'not_for_selling'],
                    ); ?>

                    <label class="form-check-label" for="not_for_selling">
                        <strong><?php echo app('translator')->get('lang_v1.not_for_selling'); ?></strong>
                    </label>
                    <?php
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
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <div class="form-check">
                    <?php echo Form::checkbox('is_hidden_from_bill', 1, !empty($duplicate_product) ? $duplicate_product->is_hidden_from_bill : false, [
                        'class' => 'form-check-input',
                        'id' => 'is_hidden_from_bill',
                    ]); ?>

                    <label class="form-check-label" for="is_hidden_from_bill">
                        <strong><?php echo app('translator')->get('lang_v1.is_hidden_from_bill'); ?></strong>
                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_is_hidden_from_bill') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <div class="form-check">
                    <?php echo Form::checkbox('edit_quantity_on_sale', 1, !empty($duplicate_product) ? $duplicate_product->edit_quantity_on_sale : false, [
                        'class' => 'form-check-input',
                        'id' => 'edit_quantity_on_sale',
                    ]); ?>

                    <label class="form-check-label" for="edit_quantity_on_sale">
                        <strong><?php echo app('translator')->get('lang_v1.edit_quantity_on_sale'); ?></strong>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <div class="form-check">
                    <?php echo Form::checkbox('edit_price_on_sale', 1, !empty($duplicate_product) ? $duplicate_product->edit_price_on_sale : false, [
                        'class' => 'form-check-input',
                        'id' => 'edit_price_on_sale',
                    ]); ?>

                    <label class="form-check-label" for="edit_price_on_sale">
                        <strong><?php echo app('translator')->get('lang_v1.edit_price_on_sale'); ?></strong>
                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <div class="form-check" style="margin-top: 1.75rem;">
                    <?php echo Form::checkbox('discount_not_applicable', 1, !empty($duplicate_product) ? $duplicate_product->discount_not_applicable : 0, ['class' => 'form-check-input', 'id'=> 'discount_not_applicable']); ?>

                    <label class="form-check-label" for="discount_not_applicable">
                        <strong><?php echo app('translator')->get('lang_v1.discount_not_applicable'); ?></strong>
                    </label>
                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_discount_not_applicable') . '"></i>';
                }
            ?>
                </div>
            </div>
        </div>
        <?php if(!empty($common_settings['enable_booking_hourly_services'])): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <div class="form-check">
                    <?php echo Form::checkbox('enable_booking_hourly', 1, !empty($duplicate_product) ? $duplicate_product->enable_booking_hourly : false, [
                        'class' => 'form-check-input',
                        'id' => 'enable_booking_hourly',
                    ]); ?>

                    <label class="form-check-label" for="enable_booking_hourly">
                        <strong><?php echo app('translator')->get('lang_v1.enable_booking_hourly'); ?></strong>
                    </label>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php echo $__env->make('layouts.partials.module_form_part', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="clearfix"></div>

        <!-- Rack, Row & position number -->
        <?php if(session('business.enable_racks') || session('business.enable_row') || session('business.enable_position')): ?>
        <div class="col-md-12">
            <h4><?php echo app('translator')->get('lang_v1.rack_details'); ?>:
                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_rack_details') . '"></i>';
                }
            ?>
            </h4>
        </div>
        <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('rack_' . $id, $location . ':'); ?>


                <?php if(session('business.enable_racks')): ?>
                <?php echo Form::text(
                'product_racks[' . $id . '][rack]',
                !empty($rack_details[$id]['rack']) ? $rack_details[$id]['rack'] : null,
                ['class' => 'form-control', 'id' => 'rack_' . $id, 'placeholder' => __('lang_v1.rack')],
                ); ?>

                <?php endif; ?>

                <?php if(session('business.enable_row')): ?>
                <?php echo Form::text(
                'product_racks[' . $id . '][row]',
                !empty($rack_details[$id]['row']) ? $rack_details[$id]['row'] : null,
                ['class' => 'form-control', 'placeholder' => __('lang_v1.row')],
                ); ?>

                <?php endif; ?>

                <?php if(session('business.enable_position')): ?>
                <?php echo Form::text(
                'product_racks[' . $id . '][position]',
                !empty($rack_details[$id]['position']) ? $rack_details[$id]['position'] : null,
                ['class' => 'form-control', 'placeholder' => __('lang_v1.position')],
                ); ?>

                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
        <?php if(!empty($common_settings['enable_product_weight'])): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('weight', __('lang_v1.weight') . ':'); ?>

                <?php echo Form::text('weight', !empty($duplicate_product->weight) ? $duplicate_product->weight : null, [
                'class' => 'form-control',
                'placeholder' => __('lang_v1.weight'),
                ]); ?>

            </div>
        </div>
        <?php endif; ?>

        <div class="clearfix"></div>

        <?php if(!empty($common_settings['enable_product_warranty'])): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('warranty_id', __('lang_v1.warranty') . ':'); ?>

                <?php echo Form::select('warranty_id', $warranties, null, [
                'class' => 'form-select select2',
                'placeholder' => __('messages.please_select'),
                ]); ?>

            </div>
        </div>
        <?php endif; ?>

        <div class="clearfix"></div>

        <div class="col-sm-12">
            <div class="form-group mb-2">
                <?php
                    $enable_stock = true;
                    if(!empty($product_default['enable_stock'])){
                        $enable_stock = ($product_default['enable_stock'] == 'true') ? true : false;
                    }
                ?>
                <div class="form-check" style="padding-top: 4px;">
                    <?php echo Form::checkbox('enable_stock', 1, !empty($duplicate_product) ? $duplicate_product->enable_stock
                        : $enable_stock, [
                        'class' => 'form-check-input',
                        'id' => 'enable_stock',
                        ]); ?>

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
        <?php $__currentLoopData = $business_locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row alert_quantity_div" <?php if(!empty($duplicate_product) && $duplicate_product->enable_stock == 0): ?> style="display:none" <?php endif; ?> <?php if(empty($duplicate_product) && empty($enable_stock)): ?> style="display:none" <?php endif; ?>>
            <div class="col-sm-2">
                <?php if($loop->first): ?>
                <br>
                <?php endif; ?>
                <?php echo Form::label('stock_levels_' . $id, $location . ':'); ?>

            </div>
            <div class="col-sm-10 row">
                <div class="col-md-3 form-group mb-2">
                    <?php if($loop->first): ?>
                    <?php echo Form::label('alert_quantity', __('product.alert_quantity_low') . ':'); ?>

                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.alert_quantity_low') . '"></i>';
                }
            ?>
                    <?php endif; ?>
                    <?php echo Form::text(
                    'stock_levels[' . $id . '][low_level]',
                    !empty($stock_levels[$id]['low_level']) ? $stock_levels[$id]['low_level'] : null,
                    ['class' => 'form-control input_number', 'id' => 'stock_level_' . $id, 'placeholder' => __('product.alert_quantity_low') , 'min' => '0'],
                    ); ?>

                </div>
                <div class="col-md-3 form-group mb-2">
                    <?php if($loop->first): ?>
                    <?php echo Form::label('alert_quantity_medium', __('product.alert_quantity_medium') . ':'); ?>

                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.alert_quantity_medium') . '"></i>';
                }
            ?>
                    <?php endif; ?>
                    <?php echo Form::text(
                    'stock_levels[' . $id . '][medium_level]',
                    !empty($stock_levels[$id]['medium_level']) ? $stock_levels[$id]['medium_level'] : null,
                    ['class' => 'form-control input_number', 'id' => 'stock_level_' . $id, 'placeholder' => __('product.alert_quantity_medium') , 'min' => '0'],
                    ); ?>

                </div>
                <div class="col-md-3 form-group mb-2">
                    <?php if($loop->first): ?>
                    <?php echo Form::label('alert_quantity_high', __('product.alert_quantity_high') . ':'); ?>

                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.alert_quantity_high') . '"></i>';
                }
            ?>
                    <?php endif; ?>
                    <?php echo Form::text(
                    'stock_levels[' . $id . '][high_level]',
                    !empty($stock_levels[$id]['high_level']) ? $stock_levels[$id]['high_level'] : null,
                    ['class' => 'form-control input_number', 'id' => 'stock_level_' . $id, 'placeholder' => __('product.alert_quantity_high') , 'min' => '0'],
                    ); ?>

                </div>
                <div class="col-md-3 form-group mb-2">
                    <?php if($loop->first): ?>
                    <?php echo Form::label('alert_quantity_max', __('product.alert_quantity_max') . ':'); ?>

                    <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.alert_quantity_max') . '"></i>';
                }
            ?>
                    <?php endif; ?>
                    <?php echo Form::text(
                    'stock_levels[' . $id . '][max_level]',
                    !empty($stock_levels[$id]['max_level']) ? $stock_levels[$id]['max_level'] : null,
                    ['class' => 'form-control input_number', 'id' => 'stock_level_' . $id, 'placeholder' => __('product.alert_quantity_max'), 'min' => '0'],
                    ); ?>

                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
        <?php if($fbr_di_integration): ?>
        
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('fbr_di_sale_type', __('lang_v1.fbr_di_sale_type') . ':'); ?>

                <?php echo Form::select('fbr_di_sale_type', $fbr_di_sale_types, 75, ['class' => 'form-control select2'],); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('fbr_di_sro_no', __('lang_v1.fbr_di_sro_no') . ':'); ?>

                <small><?php echo app('translator')->get('lang_v1.fbr_di_sro_no_help'); ?></small>
                <?php echo Form::text('fbr_di_sro_no', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.fbr_di_sro_no')],); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('fbr_di_sro_item_no', __('lang_v1.fbr_di_sro_item_no') . ':'); ?>

                <small><?php echo app('translator')->get('lang_v1.fbr_di_sro_no_help'); ?></small>
                <?php echo Form::text('fbr_di_sro_item_no', null, ['class' => 'form-control', 'placeholder' => __('lang_v1.fbr_di_sro_item_no')],); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('fbr_di_rrp', __('lang_v1.fbr_di_rrp') . ':'); ?>

                <small><?php echo app('translator')->get('lang_v1.fbr_di_rrp_help'); ?></small>
                <?php echo Form::number('fbr_di_rrp', null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.fbr_di_rrp')],); ?>

            </div>
        </div>
        
        <?php endif; ?>
        
        <div class="clearfix"></div>
        <?php
            $__stock_checked = !empty($duplicate_product) ? $duplicate_product->enable_stock : $enable_stock;
        ?>
        <div class="col-sm-3 default_supplier_div" <?php if(!$__stock_checked): ?> style="display:none;" <?php endif; ?>>
            <div class="form-group mb-2">
                <?php
                    $default_supplier_id = null;
                    if(!empty($product_default['default_supplier_id'])){
                        $default_supplier_id = $product_default['default_supplier_id'];
                    }
                ?>
                <?php echo Form::label('default_supplier_id', __('product.default_supplier_id') . ':'); ?>

                <div class="input-group">
                <?php echo Form::select('default_supplier_id', $suppliers, $default_supplier_id,
                ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2'],
                ); ?>

                
                    <button type="button" class="btn btn-primary bg-white btn-flat btn-modal add_new_supplier" data-name=""><i
                            class="fa fa-plus-circle text-primary fa-lg"></i></button>
                
                </div>
            </div>
        </div>
        <?php if($accounting_enabled): ?>
            <div class="col-sm-3">
                <div class="form-group mb-2">
                    <div class="form-check" style="margin-top: 1.75rem;">
                        <?php echo Form::checkbox('post_to_account', 1, false, ['class' => 'form-check-input', 'id' => 'post_to_account']); ?>

                        <label class="form-check-label" for="post_to_account">
                            <?php echo e(__( 'lang_v1.post_to_account' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3" id="acc_fields" style="display: none;">  
                <div class="form-group mb-2">
                    <?php echo Form::label('purchase_acc_sub_type', 'Purhase '. __('lang_v1.account_sub_type') . ':'); ?>

                    <?php echo Form::select('purchase_acc_sub_type', $acc_sub_types, 2, ['class' => 'form-control']); ?>

                </div>  
                <div class="form-group mb-2">
                    <?php echo Form::label('purchase_acc_parent_account', __('lang_v1.parent_account') . ':'); ?>

                    <?php echo Form::select('purchase_acc_parent_account', [], null, ['class' => 'form-control']); ?>

                </div>  
            </div>
        <?php endif; ?>
        <div class="clearfix"></div>
        <div class="col-sm-4 <?php if(empty($common_settings['enable_kot_printer_prepration_time'])): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php
                    $printer_id = null;
                    if(!empty($product_default['printer_id'])){
                        $printer_id = $product_default['printer_id'];
                    }
                    if(!empty($duplicate_product->printer_id)){
                        $printer_id = $duplicate_product->printer_id;
                    }
                ?>
                <?php echo Form::label('printer_id', __('product.printer_name') . ':'); ?>

                <?php echo Form::select('printer_id', $printers, $printer_id,
                ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2'],
                ); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(empty($common_settings['enable_kot_printer_prepration_time'])): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('preparation_time_in_minutes', __('lang_v1.preparation_time_in_minutes') . ':'); ?>

                <?php echo Form::number(
                'preparation_time_in_minutes',
                !empty($duplicate_product->preparation_time_in_minutes) ?
                $duplicate_product->preparation_time_in_minutes : null,
                ['class' => 'form-control', 'placeholder' => __('lang_v1.preparation_time_in_minutes')],
                ); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(empty($common_settings['enable_prompt_msg'])): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('prompt', __('lang_v1.prompt_message') . ':'); ?>

                <?php echo Form::text(
                'prompt',
                !empty($duplicate_product->prompt) ? $duplicate_product->prompt : null,
                ['class' => 'form-control', 'placeholder' => __('lang_v1.prompt_message')],
                ); ?>

            </div>
        </div>  
    </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <div class="row">

        <?php if(!empty($common_settings['warn_negative_profit_margin'])): ?>
            <input type="hidden" id="warn_negative_profit_margin">
        <?php endif; ?>
        <div class="col-sm-4 <?php if(!$has_taxes): ?> hide <?php endif; ?>">
            <?php
                $tax = null;
                if(!empty($product_default['tax'])){
                    $tax = $product_default['tax'];
                }
            ?>
            <div class="form-group mb-2">
                <?php echo Form::label('tax', __('product.applicable_tax') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select(
                    'tax',
                    $taxes,
                    !empty($duplicate_product->tax) ? $duplicate_product->tax : $tax,
                    ['class' => 'form-control select2'],
                    $tax_attributes,
                    ); ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax_rate.create')): ?>
                        <button type="button" class="btn btn-primary bg-white btn-flat btn-modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\TaxRateController::class, 'create']), false); ?>"
                            title="<?php echo app('translator')->get('tax_rate.add_tax_rate'); ?>" data-container=".tax_rate_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="col-sm-4 <?php if(!$has_taxes): ?> hide <?php endif; ?>">
            <?php
                $tax_type = 'none';
                if(!empty($product_default['tax_type'])){
                    $tax_type = $product_default['tax_type'];
                }
                $inc_on_gp_name = !empty($tax_type_inc_on_group_price->name) ? $tax_type_inc_on_group_price->name : 'Group Price Name';
            ?>
            <div class="form-group mb-2">
                <?php echo Form::label('tax_type', __('product.selling_price_tax_type') . ':*'); ?>

                <?php echo Form::select(
                'tax_type',
                ['inclusive' => __('product.inclusive'), 'inclusive_sell_price' => __('product.inclusive_sell_price'), 'inclusive_gp_price' => __('product.inclusive_on') . ' ' . $inc_on_gp_name, 'exclusive' => __('product.exclusive'), 'none' => 'None'],
                !empty($common_settings['default_product_tax_type']) ? $common_settings['default_product_tax_type'] :
                $tax_type,
                ['class' => 'form-select  select2', 'required'],
                ); ?>

            </div>
        </div>

        <div class="col-sm-4 <?php if(!$has_taxes): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <br>
                <label class="form-check-label">
<?php echo Form::checkbox('tax_not_applicable', 1, !empty($duplicate_product) ? $duplicate_product->tax_not_applicable : 0, ['class' => 'form-check-input', 'id'=> 'tax_not_applicable'],); ?>

                    <strong><?php echo app('translator')->get('lang_v1.tax_not_applicable'); ?></strong>
                </label> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_tax_not_applicable') . '"></i>';
                }
            ?>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-4">
            <?php
                $type = 'single';
                if(!empty($product_default['type'])){
                    $type = $product_default['type'];
                }
            ?>
            <div class="form-group mb-2">
                <?php echo Form::label('type', __('product.product_type') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.product_type') . '"></i>';
                }
            ?>
                <?php echo Form::select('type', $product_types, !empty($duplicate_product->type) ? $duplicate_product->type :
                $type, [
                'class' => 'form-select  select2',
                'required',
                'data-action' => !empty($duplicate_product) ? 'duplicate' : 'add',
                'data-product_id' => !empty($duplicate_product) ? $duplicate_product->id : '0',
                ]); ?>

            </div>
        </div>

        <?php if(session('business.enable_pct_code')): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('pct_code', __('lang_v1.pct_code') . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('Write PCT/HSN Code
                without Dots <br> Example: 1208.1023 will be written as 12081023') . '"></i>';
                }
            ?>
                <?php echo Form::text('pct_code', !empty($duplicate_product->pct_code) ? $duplicate_product->pct_code :
                '', [
                'class' => 'form-control',
                'placeholder' => 'Write without Dots Ex: 1111.2222 => 11112222',
                'inputmode' => 'numeric',
                'pattern' => '[0-9]*',
                ]); ?>

            </div>
        </div>
        <?php endif; ?>

        

        <div class="form-group mb-2 col-sm-12" id="product_form_part">
            <?php echo $__env->make('product.partials.single_product_form_part', [
            'profit_percent' => $default_profit_percent,
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>

        <?php if(!empty($duplicate_product) && $duplicate_product->type == 'combo' && $duplicate_product->type == 'Package'): ?>
        <input type="hidden" id="duplicate_combo" value="<?php echo e($duplicate_product->id, false); ?>">
        <?php endif; ?>

        
        <?php if(!empty($common_settings['enable_discount'])): ?>
        <?php
            $product_discount_types = [
                'fixed' => __('lang_v1.fixed'),
                'percentage' => __('lang_v1.percentage'),
                'buy_for' => __('lang_v1.buy_for'),
                'buy_for_unit_price' => __('lang_v1.buy_for_unit_price'),
                'buy_get_free' => __('lang_v1.buy_get_free'),
            ];
        ?>
        <div class="form-group mb-2 col-sm-12 row" id="discount_row_form_part">
            <hr>
            <div class="col-sm-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_priority', __( 'lang_v1.priority' ) . ':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.discount_priority_help') . '"></i>';
                }
            ?>
                    <?php echo Form::text('discount_priority', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.priority' ) ]); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_type', __('sale.discount_type') . ':'); ?> <br>
                    <?php echo Form::select('discount_type', $product_discount_types, null, ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2']); ?>

                </div>
            </div>
            <div class="col-sm-4" id="default_discount_section">
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_amount', __( 'sale.discount_amount' ) . ':'); ?>

                    <?php echo Form::text('discount_amount', null, ['class' => 'form-control input_number', 'placeholder' => __( 'sale.discount_amount' ) ]); ?>

                </div>
            </div>
            <div class="col-sm-4 hide" id="buy_qty_div">
                <div class="form-group mb-2">
                    <?php echo Form::label('buy_qty', __( 'lang_v1.quantity' ) . ':'); ?>

                    <?php echo Form::text('buy_qty', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.quantity' ) ]); ?>

                </div>
            </div>
            <div class="col-sm-4 hide" id="buy_price_div">
                <div class="form-group mb-2">
                    <label for="buy_price" id="buy_price_label" data-total-price-label="<?php echo app('translator')->get('lang_v1.total_price'); ?>" data-unit-price-label="<?php echo app('translator')->get('lang_v1.unit_price_label'); ?>"><?php echo app('translator')->get('lang_v1.total_price'); ?></label>
                    <?php echo Form::text('buy_price', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.total_price' ) ]); ?>

                </div>
            </div>
            <div class="col-sm-4 hide" id="buy_free_qty_div">
                <div class="form-group mb-2">
                    <?php echo Form::label('buy_free_qty', __( 'lang_v1.free_quantity' ) . ':'); ?>

                    <?php echo Form::text('buy_free_qty', null, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.free_quantity' ) ]); ?>

                </div>
            </div>
            

            <div class="col-sm-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_starts_at', __( 'lang_v1.starts_at' ) . ':'); ?>

                    <?php echo Form::text('discount_starts_at', null, ['class' => 'form-control discount_date', 'placeholder' => __( 'lang_v1.starts_at' ), 'readonly' ]); ?>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_ends_at', __( 'lang_v1.ends_at' ) . ':'); ?>

                    <?php echo Form::text('discount_ends_at', null, ['class' => 'form-control discount_date', 'placeholder' => __( 'lang_v1.ends_at' ), 'readonly' ]); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <input type="hidden" id="variation_counter" value="1">
        <input type="hidden" id="default_profit_percent" value="<?php echo e($default_profit_percent, false); ?>">

    </div>
    <?php echo $__env->renderComponent(); ?>
    <input type="hidden" name="submit_type" id="submit_type">
    <div id="product-footer-actions-template" class="d-none">
        <div class="d-flex gap-2 flex-wrap">
            <?php if($selling_price_group_count): ?>
            <button type="submit" value="submit_n_add_selling_prices"
                class="btn btn-warning submit_product_form"><i class="fas fa-dollar-sign"></i> <?php echo app('translator')->get('lang_v1.save_n_add_selling_price_group_prices'); ?></button>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.opening_stock')): ?>
            <button id="opening_stock_button" <?php if(!empty($duplicate_product) &&
                $duplicate_product->enable_stock == 0): ?> disabled style="display:none;" <?php endif; ?>
                <?php if(empty($duplicate_product) && empty($enable_stock)): ?> disabled style="display:none;" <?php endif; ?>
                type="submit" value="submit_n_add_opening_stock"
                class="btn btn-info submit_product_form"><i class="fas fa-boxes"></i> <?php echo app('translator')->get('lang_v1.save_n_add_opening_stock'); ?></button>
            <?php endif; ?>

            <button type="submit" value="save_n_print_label"
            class="btn btn-secondary submit_product_form"><i class="fas fa-barcode"></i> <?php echo app('translator')->get('lang_v1.save_n_print_label'); ?></button>

            <button type="submit" value="save_n_add_another"
                class="btn btn-outline-primary submit_product_form"><i class="fas fa-plus"></i> <?php echo app('translator')->get('lang_v1.save_n_add_another'); ?></button>

            <button type="submit" value="submit"
                class="btn btn-primary submit_product_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?></button>
        </div>
    </div>
    <?php echo Form::close(); ?>


</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <?php echo $__env->make('contact.create', ['quick_add' => true, 'supplier' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<div class="modal fade tax_rate_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php $asset_v = config('constants.asset_version', 1); ?>
<script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>

<script type="text/javascript">
$(document).ready(function() {
    __page_leave_confirmation('#product_add_form');

    // Disable Enter form submit & move to name on SKU Enter
    $('#product_add_form').on('keypress', 'input', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            if ($(this).attr('id') === 'sku') {
                $('#name').focus();
            }
            return false;
        }
    });

    onScan.attachTo(document, {
        suffixKeyCodes: [13], // enter-key expected at the end of a scan
        reactToPaste: true, // Compatibility to built-in scanners in paste-mode (as opposed to keyboard-mode)
        onScan: function(sCode, iQty) {
            $('input#sku').val(sCode);
        },
        onScanError: function(oDebug) {
            console.log(oDebug);
        },
        minLength: 2,
        ignoreIfFocusOn: ['input', '.form-control']
        // onKeyDetect: function(iKeyCode){ // output all potentially relevant key events - great for debugging!
        //     console.log('Pressed: ' + iKeyCode);
        // }
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>