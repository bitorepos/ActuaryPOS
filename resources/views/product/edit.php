
<?php $__env->startSection('title', __('product.edit_product')); ?>

<?php $__env->startSection('content'); ?>

<?php
$is_image_required = !empty($common_settings['is_product_image_required']) && empty($product->image);
?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('product.edit_product'); ?></h1>
    <!-- <ol class="breadcrumb">
                                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                                <li class="active">Here</li>
                            </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <?php if(!empty($common_settings['warn_same_product_name'])): ?>
    <input type="hidden" id="warn_same_product_name">
    <?php endif; ?>
    <?php echo Form::open([
    'url' => action([\App\Http\Controllers\ProductController::class, 'update'], [$product->id]),
    'method' => 'PUT',
    'id' => 'product_add_form',
    'class' => 'product_form',
    'files' => true,
    ]); ?>

    <input type="hidden" id="product_id" value="<?php echo e($product->id, false); ?>">

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <div class="row">


        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('sku', __('product.sku') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.sku') . '"></i>';
                }
            ?>
                <div class="input-group">
                    <?php echo Form::text('sku', $product->sku, [
                    'class' => 'form-control',
                    'placeholder' => __('product.sku'),
                    'required',
                    ]); ?>

                    
                        <button type="button" class="btn btn-primary bg-white btn-flat btn-modal add_alternate_sku <?php if($product->type == 'single'): ?> btn-modal <?php endif; ?>"
                            data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'getCreateAlternateSku'], ['product_id' => $product->id, 'sku' => $product->sku]), false); ?>"
                            title="Add Alternate SKU" <?php if($product->type == 'single'): ?> data-container=".view_modal" <?php endif; ?>>
                            <i class="fa fa-plus-circle text-primary fa-lg"></i>
                        </button>
                        
                    
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('barcode_type', __('product.barcode_type') . ':*'); ?>

                <?php echo Form::select('barcode_type', $barcode_types, $product->barcode_type, [
                'placeholder' => __('messages.please_select'),
                'class' => 'form-select select2',
                'required',
                ]); ?>

            </div>
        </div>
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
                <?php echo Form::select('product_locations[]', $business_locations, $product->product_locations->pluck('id'), [
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

                <?php echo Form::text('name', $product->name, [
                'class' => 'form-control',
                'required',
                'placeholder' => __('product.product_name'),
                ]); ?>

            </div>
        </div>
       
        <?php if(!empty($common_settings['enable_potency'])): ?>
            <div class="col-sm-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('potencies', __('product.potency') . ':'); ?>

                    <?php echo Form::select('potencies[]', $potencies, $product->potency, [
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

                <?php echo Form::select('drug_classes[]', $drug_classes, $product->drug_classes, [
                'class' => 'form-select select2',
                'multiple',
                'id' => 'drug_classes',
                ]); ?>

            </div>
        </div>
        <?php endif; ?>
        <!-- <div class="clearfix"></div> -->
        <?php if(!empty($common_settings['enable_other_product_name'])): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('other_name', !empty($common_settings['other_product_name_label']) ? $common_settings['other_product_name_label'] . ':': __('product.other_product_name') . ':'); ?>

                <?php echo Form::text('other_name', $product->other_name, [
                'class' => 'form-select',
                'placeholder' => __('product.other_product_name'),
                ]); ?>

            </div>
        </div>
        <?php endif; ?>

        <?php if(!empty($common_settings['enable_generic_name'])): ?>
        <div class="col-sm-12">
            <div class="form-group mb-2">
                <?php echo Form::label('generic_names', __('product.generic_names') . ':'); ?>

                <?php echo Form::select('generic_names[]', $generic_names, $product->generic_name, [
                'class' => 'form-select select2',
                'multiple',
                'id' => 'generic_names',
                'style' => 'width: 100%;']); ?>

            </div>
        </div>
        
        <?php endif; ?>


        <!-- <div class="clearfix"></div> -->

        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('unit_id', __('product.unit') . ':*'); ?>

                <div class="input-group">
                    <?php echo Form::select('unit_id', $units, $product->unit_id, [
                    'placeholder' => __('messages.please_select'),
                    'class' => 'form-select select2',
                    'required',
                    'id' => 'unit_id',
                    ]); ?>

                    
                        <button type="button" <?php if(!auth()->user()->can('unit.create')): ?> disabled <?php endif; ?>
                            class="btn btn-primary bg-white btn-flat btn-modal quick_add_unit btn-modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\UnitController::class, 'create'], ['quick_add' => true]), false); ?>"
                            title="<?php echo app('translator')->get('unit.add_unit'); ?>" data-container=".view_modal"><i
                                class="fa fa-plus-circle text-primary fa-lg"></i></button>
                    
                </div>
            </div>
        </div>

        <div class="col-sm-4 <?php if(!session('business.enable_sub_units')): ?> hide <?php endif; ?>">
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

                <select name="sub_unit_ids[]" class="form-control select2" multiple id="sub_unit_ids">
                    <?php $__currentLoopData = $sub_units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_unit_id => $sub_unit_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($sub_unit_id, false); ?>" <?php if(is_array($product->sub_unit_ids) && in_array($sub_unit_id,
                        $product->sub_unit_ids)): ?> selected <?php endif; ?>>
                        <?php echo e($sub_unit_value['name'], false); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
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
                <?php echo Form::select('secondary_unit_id', $units, $product->secondary_unit_id, ['class' => 'form-select select2']); ?>

            </div>
        </div>
        <?php endif; ?>
        <div class="clearfix"></div>


        <div class="col-sm-4 <?php if(!session('business.enable_category')): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select('category_id', $categories, $product->category_id, [
                    'placeholder' => __('messages.please_select'),
                    'class' => 'form-control select2',
                    'id' => 'category_id',
                    ]); ?>

                    
                        <button type="button" class="btn btn-primary bg-white btn-flat btn-modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'create'], ['type' => 'product', 'quick_add' => true]), false); ?>"
                            title="<?php echo app('translator')->get('category.add_category'); ?>" data-container=".view_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
                    
                </div>
            </div>
        </div>

        <div
            class="col-sm-4 <?php if(!(session('business.enable_category') && session('business.enable_sub_category'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                <?php echo Form::select('sub_category_id', $sub_categories, $product->resolved_sub_category_id ?? $product->sub_category_id, [
                'placeholder' => __('messages.please_select'),
                'class' => 'form-select select2',
                'id' => 'sub_category_id',
                ]); ?>

            </div>
        </div>
        <div
            class="col-sm-4 <?php if(!(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                <?php echo Form::select('sub2_category_id', $sub2_categories ?? [], $product->resolved_sub2_category_id ?? null, [
                'placeholder' => __('messages.please_select'),
                'class' => 'form-select select2',
                'id' => 'sub2_category_id',
                ]); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(!session('business.enable_brand')): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select('brand_id', $brands, $selected_brand_id, [
                    'placeholder' => __('messages.please_select'),
                    'class' => 'form-select select2',
                    'id' => 'brand_id',
                    ]); ?>

                    
                        <button type="button" <?php if(!auth()->user()->can('brand.create')): ?> disabled <?php endif; ?>
                            class="btn btn-primary bg-white btn-flat btn-modal"
                            data-href="<?php echo e(action([\App\Http\Controllers\BrandController::class, 'create'], ['quick_add' => true]), false); ?>"
                            title="<?php echo app('translator')->get('brand.add_brand'); ?>" data-container=".view_modal"><i
                                class="fa fa-plus-circle text-primary fa-lg"></i></button>
                    
                </div>
            </div>
        </div>
        <div class="col-sm-4 <?php if(!(session('business.enable_brand') && session('business.enable_sub_brand'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                <?php echo Form::select('sub_brand_id', $sub_brands, $selected_sub_brand_id, [
                'placeholder' => __('messages.please_select'),
                'class' => 'form-select select2',
                'id' => 'sub_brand_id',
                ]); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(!session('business.enable_gender')): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select('gender_id', $genders, $selected_gender_id, [
                    'placeholder' => __('messages.please_select'),
                    'class' => 'form-select select2',
                    'id' => 'gender_id',
                    ]); ?>

                    <button type="button" <?php if(!auth()->user()->can('gender.create')): ?> disabled <?php endif; ?>
                        class="btn btn-primary bg-white btn-flat btn-modal"
                        data-href="<?php echo e(action([\App\Http\Controllers\GenderController::class, 'create'], ['quick_add' => true]), false); ?>"
                        title="<?php echo app('translator')->get('gender.add_gender'); ?>" data-container=".view_modal"><i
                            class="fa fa-plus-circle text-primary fa-lg"></i></button>
                </div>
            </div>
        </div>
        <div class="col-sm-4 <?php if(!(session('business.enable_gender') && session('business.enable_sub_gender'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                <?php echo Form::select('sub_gender_id', $sub_genders, $selected_sub_gender_id, [
                'placeholder' => __('messages.please_select'),
                'class' => 'form-select select2',
                'id' => 'sub_gender_id',
                ]); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(!session('business.enable_procurement_source')): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select('procurement_source_id', $procurement_sources, $selected_procurement_source_id, [
                    'placeholder' => __('messages.please_select'),
                    'class' => 'form-select select2',
                    'id' => 'procurement_source_id',
                    ]); ?>

                    <button type="button" <?php if(!auth()->user()->can('procurement_source.create')): ?> disabled <?php endif; ?>
                        class="btn btn-primary bg-white btn-flat btn-modal"
                        data-href="<?php echo e(action([\App\Http\Controllers\ProcurementSourceController::class, 'create'], ['quick_add' => true]), false); ?>"
                        title="<?php echo app('translator')->get('procurement_source.add_procurement_source'); ?>" data-container=".view_modal"><i
                            class="fa fa-plus-circle text-primary fa-lg"></i></button>
                </div>
            </div>
        </div>
        <div class="col-sm-4 <?php if(!(session('business.enable_procurement_source') && session('business.enable_sub_procurement_source'))): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                <?php echo Form::select('sub_procurement_source_id', $sub_procurement_sources, $selected_sub_procurement_source_id, [
                'placeholder' => __('messages.please_select'),
                'class' => 'form-select select2',
                'id' => 'sub_procurement_source_id',
                ]); ?>

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

                <?php echo Form::text('product_custom_field1', $product->product_custom_field1,
                ['class' => 'form-control', 'placeholder' => $product_custom_field1],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field2)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field2', $product_custom_field2 . ':'); ?>

                <?php echo Form::text('product_custom_field2', $product->product_custom_field2,
                ['class' => 'form-control', 'placeholder' => $product_custom_field2],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field3)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field3', $product_custom_field3 . ':'); ?>

                <?php echo Form::text('product_custom_field3', $product->product_custom_field3,
                ['class' => 'form-control', 'placeholder' => $product_custom_field3],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field4)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field4', $product_custom_field4 . ':'); ?>

                <?php echo Form::text('product_custom_field4', $product->product_custom_field4,
                ['class' => 'form-control', 'placeholder' => $product_custom_field4],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field5)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field5', $product_custom_field5 . ':'); ?>

                <?php echo Form::text('product_custom_field5', $product->product_custom_field5,
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
                'product_custom_field6', $product->product_custom_field6,
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
                'product_custom_field7', $product->product_custom_field7,
                ['class' => 'form-control', 'placeholder' => $product_custom_field7],
                ); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($product_custom_field8)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field8', $product_custom_field8 . ':'); ?>

                <?php echo Form::text('product_custom_field8', $product->product_custom_field8, ['class' => 'form-control', 'placeholder' => $product_custom_field8],); ?>

            </div>
        </div>
        <?php endif; ?>
        
        <?php else: ?>

        <?php if(!empty($product_custom_field1)): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('product_custom_field1', $product_custom_field1 . ':'); ?>

                <?php echo Form::textarea('product_custom_field1', $product->product_custom_field1,
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
                'product_custom_field2', $product->product_custom_field2,
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
                'product_custom_field3', $product->product_custom_field3,
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
                'product_custom_field4', $product->product_custom_field4,
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
                'product_custom_field5', $product->product_custom_field5,
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
                'product_custom_field6', $product->product_custom_field6,
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
                'product_custom_field7', $product->product_custom_field7,
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
                'product_custom_field8', $product->product_custom_field8,
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

                <?php echo Form::textarea('product_description', $product->product_description, ['class' => 'form-control']); ?>

            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($common_settings['enable_product_image'])): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2 product-image-wrapper">
                <?php echo Form::label('image', __('lang_v1.product_image') . ':'); ?>

                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?>. <?php echo app('translator')->get('lang_v1.aspect_ratio_should_be_1_1'); ?><?php if(!empty($product->image)): ?><br><?php echo app('translator')->get('lang_v1.previous_image_will_be_replaced'); ?><?php endif; ?>"></i>
                <div class="d-flex align-items-center gap-2">
                    <div class="flex-grow-1">
                        <?php echo Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*', 'required' =>
                        $is_image_required]); ?>

                    </div>
                    <button type="button" class="btn btn-outline-primary btn-camera-capture" title="<?php echo app('translator')->get('lang_v1.capture_from_camera'); ?>">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                <?php if(!empty($product->image)): ?>
                    <div class="mt-2">
                        <strong>Current featured image:</strong>
                        <div>
                            <img src="<?php echo e($product->image_url, false); ?>" id="current_featured_product_image" class="img-thumbnail" style="width: 90px; height: 90px; object-fit: contain;" alt="Featured product image">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-sm-4 product-gallery-wrapper <?php if($product->type != 'single'): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('product_gallery_images', 'Product gallery images:'); ?>

                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br>Upload multiple images for the single product gallery."></i>
                <div class="d-flex flex-wrap gap-2 mt-1 mb-2">
                    <?php $__currentLoopData = $product->media->where('model_media_type', 'product_gallery'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="img-thumbnail text-center position-relative d-flex flex-column align-items-center" style="width: 94px;">
                            <span class="badge bg-red delete-media position-absolute" style="top: 2px; right: 2px;" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>"><i class="fas fa-times"></i></span>
                            <?php echo $media->thumbnail([70, 70]); ?>

                            <button type="button" class="btn btn-xs btn-primary mt-1 set-product-featured-image" style="width: 82px; white-space: normal;" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'setGalleryImageAsFeatured'], ['media_id' => $media->id]), false); ?>">
                                Make featured
                            </button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <?php echo Form::hidden('featured_gallery_image_index', null, ['id' => 'featured_gallery_image_index']); ?>

                <div class="mt-2">
                    <?php echo Form::file('product_gallery_images[]', [
                        'id' => 'product_gallery_images',
                        'accept' => 'image/*',
                        'multiple',
                        'class' => 'upload-element',
                    ]); ?>

                </div>
                <div class="product-gallery-selected-preview d-flex flex-wrap gap-2 mt-2"></div>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <?php if(!empty($common_settings['enable_product_brochure'])): ?>

    <div class="col-sm-4">
        <div class="form-group mb-2">
            <?php echo Form::label('product_brochure', __('lang_v1.product_brochure') . ':'); ?>

            <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('lang_v1.previous_file_will_be_replaced'); ?><br><?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
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
        <div class="col-sm-3 <?php if($hide): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <div class="multi-input">
                    <?php
                    $disabled = false;
                    $disabled_period = false;
                    if (empty($product->expiry_period_type) || empty($product->enable_stock)) {
                    $disabled = true;
                    }
                    if (empty($product->enable_stock)) {
                    $disabled_period = true;
                    }
                    ?>
                    <?php echo Form::label('expiry_period', __('product.expires_in') . ':'); ?><br>
                    <?php echo Form::text('expiry_period', number_format($product->expiry_period, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), [
                    'class' => 'form-control float-start input_number',
                    'placeholder' => __('product.expiry_period'),
                    'style' => 'width:60%;',
                    'disabled' => $disabled,
                    ]); ?>

                    <?php echo Form::select(
                    'expiry_period_type',
                    ['months' => __('product.months'), 'days' => __('product.days'), '' =>
                    __('product.not_applicable')],
                    $product->expiry_period_type,
                    [
                    'class' => 'form-select select2 float-start',
                    'style' => 'width:40%;',
                    'id' => 'expiry_period_type',
                    'disabled' => $disabled_period,
                    ],
                    ); ?>

                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if(!empty($common_settings['enable_serial_number'])): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <div class="form-check mb-2">
                    <?php echo Form::checkbox('enable_sr_no', 1, $product->enable_sr_no, ['class' => 'form-check-input', 'id' => 'enable_sr_no']); ?>

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
                <div class="form-check">
                    <?php echo Form::checkbox('enable_imei_no', 1, $product->enable_imei_no, ['class' => 'form-check-input', 'id' => 'enable_imei_no']); ?>

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
                <div class="form-check">
                    <?php echo Form::checkbox('not_for_selling', 1, $product->not_for_selling, ['class' => 'form-check-input', 'id' => 'not_for_selling']); ?>

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
                    <?php echo Form::checkbox('is_hidden_from_bill', 1, $product->is_hidden_from_bill, [
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
                    <?php echo Form::checkbox('edit_quantity_on_sale', 1, $product->edit_quantity_on_sale, [
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
                    <?php echo Form::checkbox('edit_price_on_sale', 1, $product->edit_price_on_sale, [
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
                    <?php echo Form::checkbox('discount_not_applicable', 1, ($product->discount_not_applicable) ? 1 : 0, ['class' => 'form-check-input', 'id'=> 'discount_not_applicable']); ?>

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
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <div class="form-check">
                    <?php echo Form::checkbox('enable_booking_hourly', 1, $product->enable_booking_hourly, [
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



                <?php if(!empty($rack_details[$id])): ?>
                <?php if(session('business.enable_racks')): ?>
                <?php echo Form::text('product_racks_update[' . $id . '][rack]', $rack_details[$id]['rack'], [
                'class' => 'form-control',
                'id' => 'rack_' . $id,
                ]); ?>

                <?php endif; ?>

                <?php if(session('business.enable_row')): ?>
                <?php echo Form::text('product_racks_update[' . $id . '][row]', $rack_details[$id]['row'], ['class' =>
                'form-control']); ?>

                <?php endif; ?>

                <?php if(session('business.enable_position')): ?>
                <?php echo Form::text('product_racks_update[' . $id . '][position]', $rack_details[$id]['position'], [
                'class' => 'form-control',
                ]); ?>

                <?php endif; ?>
                <?php else: ?>
                <?php echo Form::text('product_racks[' . $id . '][rack]', null, [
                'class' => 'form-control',
                'id' => 'rack_' . $id,
                'placeholder' => __('lang_v1.rack'),
                ]); ?>


                <?php echo Form::text('product_racks[' . $id . '][row]', null, [
                'class' => 'form-control',
                'placeholder' => __('lang_v1.row'),
                ]); ?>


                <?php echo Form::text('product_racks[' . $id . '][position]', null, [
                'class' => 'form-control',
                'placeholder' => __('lang_v1.position'),
                ]); ?>

                <?php endif; ?>

            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php if(!empty($common_settings['enable_product_weight'])): ?>

        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('weight', __('lang_v1.weight') . ':'); ?>

                <?php echo Form::text('weight', $product->weight, ['class' => 'form-select', 'placeholder' =>
                __('lang_v1.weight')]); ?>

            </div>
        </div>
        <?php endif; ?>

        <div class="clearfix"></div>
        <?php if(!empty($common_settings['enable_product_warranty'])): ?>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('warranty_id', __('lang_v1.warranty') . ':'); ?>

                <?php echo Form::select('warranty_id', $warranties, $product->warranty_id, [
                'class' => 'form-select select2',
                'placeholder' => __('messages.please_select'),
                ]); ?>

            </div>
        </div>
        <?php endif; ?>

        <div class="clearfix"></div>
        <div class="col-sm-12">
            <div class="form-group mb-2">
                <div class="form-check" style="padding-top: 4px;">
                    <?php echo Form::checkbox('enable_stock', 1, $product->enable_stock, [
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
        <div class="row alert_quantity_div" <?php if(empty($product->enable_stock)): ?> style="display:none" <?php endif; ?>>
            <div class="col-sm-2">
                <?php if($loop->first): ?>
                <br>
                <?php endif; ?>
                <?php echo Form::label('stock_levels_' . $id, $location . ':'); ?>

            </div>
            <div class="col-sm-10 row">
                <div class="col-md-3 form-group mb-2">
                    <?php if($loop->first): ?>
                    <?php echo Form::label('alert_quantity_low', __('product.alert_quantity_low') . ':'); ?>

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
                    !empty($stock_levels[$id]['low_level']) ? number_format($stock_levels[$id]['low_level'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : (!empty($product->alert_quantity) ? number_format($product->alert_quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null),
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
                    !empty($stock_levels[$id]['medium_level']) ? number_format($stock_levels[$id]['medium_level'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : (!empty($product->alert_quantity_medium) ? number_format($product->alert_quantity_medium, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null),
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
                    !empty($stock_levels[$id]['high_level']) ? number_format($stock_levels[$id]['high_level'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : (!empty($product->alert_quantity_high) ? number_format($product->alert_quantity_high, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null),
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
                    !empty($stock_levels[$id]['max_level']) ? number_format($stock_levels[$id]['max_level'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : (!empty($product->alert_quantity_max) ? number_format($product->alert_quantity_max, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null),
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

                <?php echo Form::select('fbr_di_sale_type', $fbr_di_sale_types, $product->fbr_di_sale_type, ['class' => 'form-control select2'],); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('fbr_di_sro_no', __('lang_v1.fbr_di_sro_no') . ':'); ?>

                <small><?php echo app('translator')->get('lang_v1.fbr_di_sro_no_help'); ?></small>
                <?php echo Form::text('fbr_di_sro_no', !empty($product->fbr_di_sro_no) ? $product->fbr_di_sro_no : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.fbr_di_sro_no')],); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('fbr_di_sro_item_no', __('lang_v1.fbr_di_sro_item_no') . ':'); ?>

                <small><?php echo app('translator')->get('lang_v1.fbr_di_sro_no_help'); ?></small>
                <?php echo Form::text('fbr_di_sro_item_no', !empty($product->fbr_di_sro_item_no) ? $product->fbr_di_sro_item_no : null, ['class' => 'form-control', 'placeholder' => __('lang_v1.fbr_di_sro_item_no')],); ?>

            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group mb-2">
                <?php echo Form::label('fbr_di_rrp', __('lang_v1.fbr_di_rrp') . ':'); ?>

                <small><?php echo app('translator')->get('lang_v1.fbr_di_rrp_help'); ?></small>
                <?php echo Form::number('fbr_di_rrp', !empty($product->fbr_di_rrp) ? number_format($product->fbr_di_rrp, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : null, ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.fbr_di_rrp')],); ?>

            </div>
        </div>
        
        <?php endif; ?>

        <div class="clearfix"></div>
        <div class="col-sm-3 default_supplier_div" <?php if(empty($product->enable_stock)): ?> style="display:none;" <?php endif; ?>>
            <div class="form-group mb-2">
                <?php echo Form::label('default_supplier_id', __('product.default_supplier_id') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select('default_supplier_id', $suppliers, $product->default_supplier_id,
                    ['placeholder' => __('messages.please_select'), 'class' => 'form-control select2'],
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
                        <?php echo Form::checkbox('post_to_account', 1, empty($product->purchase_acc_account_id) ? false : true, ['class' => 'form-check-input', 'id' => 'post_to_account']); ?>

                        <label class="form-check-label" for="post_to_account">
                            <?php echo e(__( 'lang_v1.post_to_account' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <?php if(empty($product->purchase_acc_account_id)): ?>
            
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
        <?php endif; ?>
        <div class="clearfix"></div>

        <div class="col-sm-4 <?php if(empty($common_settings['enable_kot_printer_prepration_time'])): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('printer_id', __('product.printer_name') . ':'); ?>

                <?php echo Form::select('printer_id', $printers, $product->printer_id, [
                'placeholder' => __('messages.please_select'),
                'class' => 'form-select select2',
                ]); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(empty($common_settings['enable_kot_printer_prepration_time'])): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('preparation_time_in_minutes', __('lang_v1.preparation_time_in_minutes') . ':'); ?>

                <?php echo Form::number('preparation_time_in_minutes', $product->preparation_time_in_minutes, [
                'class' => 'form-control',
                'placeholder' => __('lang_v1.preparation_time_in_minutes'),
                ]); ?>

            </div>
        </div>
        <div class="col-sm-4 <?php if(empty($common_settings['enable_prompt_msg'])): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('prompt', __('lang_v1.prompt_message') . ':'); ?>

                <?php echo Form::text(
                'prompt', $product->prompt,
                ['class' => 'form-control', 'placeholder' => __('lang_v1.prompt_message')],
                ); ?>

            </div>
        </div>
    </div>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
    <div class="row">
        <div class="col-sm-4 <?php if(!$has_taxes): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('tax', __('product.applicable_tax') . ':'); ?>

                <div class="input-group">
                    <?php echo Form::select(
                    'tax',
                    $taxes,
                    $product->tax,
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

        <?php
        $inc_on_gp_name = $inc_on_gp_name = !empty($tax_type_inc_on_group_price->name) ? $tax_type_inc_on_group_price->name : 'Group Price Name';
        ?>
        <div class="col-sm-4 <?php if(!$has_taxes): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <?php echo Form::label('tax_type', __('product.selling_price_tax_type') . ':*'); ?>

                <?php echo Form::select(
                'tax_type',
                ['inclusive' => __('product.inclusive'), 'inclusive_sell_price' => __('product.inclusive_sell_price'), 'inclusive_gp_price' => __('product.inclusive_on') . ' ' . $inc_on_gp_name, 'exclusive' => __('product.exclusive'), 'none' => 'None'],
                $product->tax_type,
                ['class' => 'form-select select2', 'required'],
                ); ?>

            </div>
        </div>

        <div class="col-sm-4 <?php if(!$has_taxes): ?> hide <?php endif; ?>">
            <div class="form-group mb-2">
                <br>
                <label class="form-check-label">
<?php echo Form::checkbox('tax_not_applicable', 1, ($product->tax_not_applicable) ? 1 : 0, ['class' => 'form-check-input', 'id'=> 'tax_not_applicable'],); ?>

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
                <?php echo Form::select('type', $product_types, $product->type, [
                'class' => 'form-control select2',
                'required',
                'disabled',
                'data-action' => 'edit',
                'data-product_id' => $product->id,
                ]); ?>

            </div>
        </div>

        <?php if(session('business.enable_pct_code')): ?>
        <div class="col-sm-4">
            <div class="form-group mb-2">
                <?php echo Form::label('pct_code', __('lang_v1.pct_code') . ':'); ?><?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('Write PCT/HSN Code
                without Dots <br> Example: 1208.1023
                will be written as 12081023') . '"></i>';
                }
            ?>
                <?php echo Form::text('pct_code', $product->pct_code, [
                'class' => 'form-control',
                'placeholder' => __('lang_v1.pct_code'),
                'inputmode' => 'numeric',
                'pattern' => '[0-9]*',
                ]); ?>

            </div>
        </div>
        <?php else: ?>
        <?php echo Form::hidden('pct_code', $product->pct_code, [
        'class' => 'form-control',
        'placeholder' => __('lang_v1.pct_code'),
        ]); ?>

        <?php endif; ?>

        <div class="form-group col-sm-12" id="product_form_part"></div>
        
        
        <?php if(!empty($common_settings['enable_discount'])): ?>
        <?php
            $product_discount_types = [
                'fixed' => __('lang_v1.fixed'),
                'percentage' => __('lang_v1.percentage'),
                'buy_for' => __('lang_v1.buy_for'),
                'buy_for_unit_price' => __('lang_v1.buy_for_unit_price'),
                'buy_get_free' => __('lang_v1.buy_get_free'),
            ];
            $product_discount_type = $discount_details->discount_type ?? null;
            $is_buy_discount = in_array($product_discount_type, ['buy_for', 'buy_for_unit_price', 'buy_get_free']);
        ?>

        <div class="col-sm-12" id="discount_row_form_part">
            <hr>
            <div class="row">
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
                    <?php echo Form::text('discount_priority', $discount_details->priority, ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.priority' ) ]); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_type', __('sale.discount_type') . ':'); ?>

                    <?php echo Form::select('discount_type', $product_discount_types, $product_discount_type, ['placeholder' => __('messages.please_select'), 'class' => 'form-select select2']); ?>

                </div>
            </div>
            <div class="col-sm-4 <?php if($is_buy_discount): ?> hide <?php endif; ?>" id="default_discount_section">
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_amount', __( 'sale.discount_amount' ) . ':'); ?>

                    <?php echo Form::text('discount_amount', number_format($discount_details->discount_amount, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __( 'sale.discount_amount' ) ]); ?>

                </div>
            </div>
            <div class="col-sm-4 <?php if(!$is_buy_discount): ?> hide <?php endif; ?>" id="buy_qty_div">
                <div class="form-group mb-2">
                    <?php echo Form::label('buy_qty', __( 'lang_v1.quantity' ) . ':'); ?>

                    <?php echo Form::text('buy_qty', number_format($discount_details->buy_qty, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.quantity' ) ]); ?>

                </div>
            </div>
            <div class="col-sm-4 <?php if(!in_array($product_discount_type, ['buy_for', 'buy_for_unit_price'])): ?> hide <?php endif; ?>" id="buy_price_div">
                <div class="form-group mb-2">
                    <label for="buy_price" id="buy_price_label" data-total-price-label="<?php echo app('translator')->get('lang_v1.total_price'); ?>" data-unit-price-label="<?php echo app('translator')->get('lang_v1.unit_price_label'); ?>"><?php echo e($product_discount_type == 'buy_for_unit_price' ? __('lang_v1.unit_price_label') : __('lang_v1.total_price'), false); ?></label>
                    <?php echo Form::text('buy_price', number_format($discount_details->buy_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.total_price' ) ]); ?>

                </div>
            </div>
            <div class="col-sm-4 <?php if($product_discount_type != 'buy_get_free'): ?> hide <?php endif; ?>" id="buy_free_qty_div">
                <div class="form-group mb-2">
                    <?php echo Form::label('buy_free_qty', __( 'lang_v1.free_quantity' ) . ':'); ?>

                    <?php echo Form::text('buy_free_qty', number_format($discount_details->buy_free_qty, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __( 'lang_v1.free_quantity' ) ]); ?>

                </div>
            </div>
            <div class="col-sm-4">
                <?php
                    $sp_after_discount_exc_tax = 0;
                    $sp_after_discount_inc_tax = 0;
                    if ($discount_details->discount_amount) {
                        $sp_after_discount_exc_tax = $discount_details->default_sell_price;
                        $sp_after_discount_inc_tax = $discount_details->sell_price_inc_tax;
                        
                        if ($discount_details->discount_type == 'fixed') {
                            $sp_after_discount_exc_tax = $sp_after_discount_exc_tax - $discount_details->discount_amount;
                            $sp_after_discount_inc_tax = $sp_after_discount_inc_tax - $discount_details->discount_amount;
                        } else if($discount_details->discount_type == 'percentage') {
                            $sp_after_discount_exc_tax = $sp_after_discount_exc_tax - (($sp_after_discount_exc_tax * $discount_details->discount_amount) / 100);
                            $sp_after_discount_inc_tax = $sp_after_discount_inc_tax - (($sp_after_discount_inc_tax * $discount_details->discount_amount) / 100);
                        }

                        if($product->tax){
                            if($tax_attributes[$product->tax]['data-type'] == 'fixed'){
                                $sp_after_discount_inc_tax = $sp_after_discount_exc_tax + $tax_attributes[$product->tax]['data-rate'];
                            }else{
                                $sp_after_discount_inc_tax = $sp_after_discount_exc_tax + (($sp_after_discount_exc_tax * $tax_attributes[$product->tax]['data-rate']) / 100);;
                            }
                        }
                    }
                ?>
                
            </div>

            <div class="col-sm-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_starts_at', __( 'lang_v1.starts_at' ) . ':'); ?>

                    <?php echo Form::text('discount_starts_at', $discount_details->starts_at, ['class' => 'form-control discount_date', 'placeholder' => __( 'lang_v1.starts_at' ), 'readonly' ]); ?>

                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-2">
                    <?php echo Form::label('discount_ends_at', __( 'lang_v1.ends_at' ) . ':'); ?>

                    <?php echo Form::text('discount_ends_at', $discount_details->ends_at, ['class' => 'form-control discount_date', 'placeholder' => __( 'lang_v1.ends_at' ), 'readonly' ]); ?>

                </div>
            </div>
            </div>
        </div>
        <?php endif; ?>

        <input type="hidden" id="variation_counter" value="0">
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
            <button type="submit" <?php if(empty($product->enable_stock)): ?> disabled="true" style="display:none;" <?php endif; ?>
                id="opening_stock_button" value="update_n_edit_opening_stock"
                class="btn btn-info submit_product_form"><i class="fas fa-boxes"></i> <?php echo app('translator')->get('lang_v1.update_n_edit_opening_stock'); ?></button>
            <?php endif; ?>

            <button type="submit" value="save_n_print_label"
            class="btn btn-secondary submit_product_form"><i class="fas fa-barcode"></i> <?php echo app('translator')->get('lang_v1.update_n_print_label'); ?></button>

            <button type="submit" value="save_n_add_another"
                class="btn btn-outline-primary submit_product_form"><i class="fas fa-copy"></i> <?php echo app('translator')->get('lang_v1.update_n_add_another'); ?></button>

            <button type="submit" value="submit"
                class="btn btn-primary submit_product_form"><i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?></button>
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
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>