
<?php $__env->startSection('title', __('sale.products')); ?>

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1><?php echo app('translator')->get('sale.products'); ?>
            <small><?php echo app('translator')->get('lang_v1.manage_products'); ?></small>
        </h1>
        <!-- <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol> -->
    </section>
<?php
$user_settings = json_decode(auth()->user()->user_settings, true);
$common_settings = isset($common_settings) && ! empty($common_settings) ? $common_settings : (session()->get('business.common_settings') ?? []);
$custom_labels = json_decode(session('business.custom_labels'), true);
$show_pct_code_column = !empty(session('business.enable_pct_code'));
$inc_on_gp_name = !empty($tax_type_inc_on_group_price->name) ? $tax_type_inc_on_group_price->name : __('lang_v1.group_price');
?>
    <!-- Main content -->
    <section class="content">

        <div class="progress-div hide">
            <strong class="progress_type"></strong>
            <div class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    <b class="progress_text">0/0</b>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                    <input type="hidden" id="business_location" value="">
                    <div class="col-md-3" id="location_filter">
                        <div class="form-group mb-2">
                            <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                            <?php echo Form::select('location_id', $business_locations, null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('type', __('product.product_type') . ':'); ?>

                            <?php echo Form::select(
                                'type',
                                ['single' => __('lang_v1.single'), 'variable' => __('lang_v1.variable'), 'combo' => __('lang_v1.combo'), 'Package' => __('lang_v1.Package')],
                                null,
                                [
                                    'class' => 'form-control select2',
                                    'style' => 'width:100%',
                                    'id' => 'product_list_filter_type',
                                    'placeholder' => __('lang_v1.all'),
                                ],
                            ); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('variation_template_id', __('product.variation_template') . ':'); ?>

                            <?php echo Form::select('variation_template_id', $variation_templates, null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_variation_template_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <?php if(session('business.enable_category')): ?>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('category_id', __('product.category') . ':'); ?>

                            <?php echo Form::select('category_id', $categories, null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_category_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(session('business.enable_category') && session('business.enable_sub_category')): ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('sub_category_id', __('product.sub_category') . ':'); ?>

                            <?php echo Form::select('sub_category_id', array(), null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_sub_category_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(session('business.enable_category') && session('business.enable_sub_category') && session('business.enable_sub2_category')): ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('sub2_category_id', __('product.sub2_category') . ':'); ?>

                            <?php echo Form::select('sub2_category_id', array(), null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_sub2_category_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('supplier_id', __('purchase.supplier') . ':'); ?>

                            <?php echo Form::select('supplier_id', $suppliers, null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_supplier_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <?php if(session('business.enable_brand')): ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('brand_id', __('product.brand') . ':'); ?>

                            <?php echo Form::select('brand_id', $brands, null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_brand_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('sub_brand_id', __('product.sub_brand') . ':'); ?>

                            <?php echo Form::select('sub_brand_id', array(), null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_sub_brand_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(session('business.enable_gender')): ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('gender_id', __('product.gender') . ':'); ?>

                            <?php echo Form::select('gender_id', $genders, null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_gender_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('sub_gender_id', __('product.sub_gender') . ':'); ?>

                            <?php echo Form::select('sub_gender_id', array(), null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_sub_gender_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if(session('business.enable_procurement_source')): ?>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('procurement_source_id', __('product.procurement_source') . ':'); ?>

                            <?php echo Form::select('procurement_source_id', $procurement_sources, null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_procurement_source_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <?php echo Form::label('sub_procurement_source_id', __('product.sub_procurement_source') . ':'); ?>

                            <?php echo Form::select('sub_procurement_source_id', array(), null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_sub_procurement_source_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('unit_id', __('product.unit') . ':'); ?>

                            <?php echo Form::select('unit_id', $units, null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_unit_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sub_unit_id', __('product.sub_units') . ':'); ?>

                            <?php echo Form::select('sub_unit_id', array(), null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_sub_unit_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('tax_id', __('product.tax') . ':'); ?>

                            <?php echo Form::select('tax_id', $taxes, null, [
                                'class' => 'form-control select2',
                                'style' => 'width:100%',
                                'id' => 'product_list_filter_tax_id',
                                'placeholder' => __('lang_v1.all'),
                            ]); ?>

                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('tax_type', 'Tax Type:'); ?>

                            <?php echo Form::select(
                                'tax_type',
                                [
                                    'inclusive' => __('product.inclusive'),
                                    'inclusive_sell_price' => __('product.inclusive_sell_price'),
                                    'inclusive_gp_price' => __('product.inclusive_on') . ' ' . $inc_on_gp_name,
                                    'exclusive' => __('product.exclusive'),
                                    'none' => 'None',
                                ],
                                null,
                                [
                                    'class' => 'form-control select2',
                                    'style' => 'width:100%',
                                    'id' => 'product_list_filter_tax_type',
                                    'placeholder' => __('lang_v1.all'),
                                ],
                            ); ?>

                        </div>
                    </div>
                   
                    
                    <div class="col-md-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('tax_id', __('product.status') . ':'); ?>

                            <?php echo Form::select(
                                'active_state',
                                ['active' => __('business.is_active'), 'inactive' => __('lang_v1.inactive')],
                                null,
                                [
                                    'class' => 'form-control select2',
                                    'style' => 'width:100%',
                                    'id' => 'active_state',
                                ],
                            ); ?>

                        </div>
                    </div>
                    <!-- include module filter -->
                    <?php if(!empty($pos_module_data)): ?>
                        <?php $__currentLoopData = $pos_module_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($value['view_path'])): ?>
                                <?php if ($__env->exists($value['view_path'], ['view_data' => $value['view_data']])) echo $__env->make($value['view_path'], ['view_data' => $value['view_data']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <div class="clearfix"></div>
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_positive_quantity', 1, true, ['class' => 'form-check-input', 'id' => 'show_positive_quantity']); ?> <?php echo app('translator')->get('lang_v1.show_positive_quantity'); ?>
                                </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_negative_quantity', 1, true, ['class' => 'form-check-input', 'id' => 'show_negative_quantity']); ?> 
                                    <?php echo app('translator')->get('lang_v1.show_negative_quantity'); ?>
                                </label>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_zero_quantity', 1, true, ['class' => 'form-check-input', 'id' => 'show_zero_quantity']); ?> 
                                    <?php echo app('translator')->get('lang_v1.show_zero_quantity'); ?>
                                </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_without_history', 1, true, ['class' => 'form-check-input', 'id' => 'show_without_history']); ?> 
                                    <?php echo app('translator')->get('lang_v1.show_without_history'); ?>
                                </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_price_exc_tax', 1, false, ['class' => 'form-check-input', 'id' => 'show_price_exc_tax']); ?> 
                                    <?php echo app('translator')->get('lang_v1.show_price_exc_tax'); ?>
                                </label>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                            <label class="form-check-label">
<?php echo Form::checkbox('not_for_selling', 1, false, ['class' => 'form-check-input', 'id' => 'not_for_selling']); ?> <strong><?php echo app('translator')->get('lang_v1.not_for_selling'); ?></strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                            <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check mb-2">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('show_only_deactivated', 1, false, ['class' => 'form-check-input', 'id' => 'show_only_deactivated']); ?> <strong><?php echo app('translator')->get('lang_v1.show_only_deactivated'); ?></strong>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('show_duplicates', 1, false, ['class' => 'form-check-input', 'id' => 'show_duplicates']); ?> <strong><?php echo app('translator')->get('lang_v1.show_duplicates'); ?></strong>
                            </label>
                        </div>
                    </div>
                    <?php if($is_woocommerce): ?>
                        <div class="col-md-3">
                            <div class="form-check mb-2">
                                <label class="form-check-label">
<?php echo Form::checkbox('woocommerce_enabled', 1, false, ['class' => 'form-check-input', 'id' => 'woocommerce_enabled']); ?> <?php echo e(__('lang_v1.woocommerce_enabled'), false); ?>

                                </label>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php echo $__env->renderComponent(); ?>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.view')): ?>
            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="nav-item p-2">
                                <a class="nav-link active" href="#product_list_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fa fa-cubes"
                                        aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.all_products'); ?></a>
                            </li>
                            <?php if(!empty($variation_templates)): ?>
                            <li class="nav-item p-2">
                                <a class="nav-link" href="#variable_product_list_tab" data-bs-toggle="tab" role="tab" aria-expanded="false"><i class="fa fa-layer-group"
                                    aria-hidden="true"></i> Products Card</a>
                            </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stock_report.view')): ?>
                                <li class="nav-item p-2">
                                    <a class="nav-link" href="#product_stock_report" data-bs-toggle="tab" role="tab" aria-expanded="true"><i
                                            class="fa fa-hourglass-half" aria-hidden="true"></i> <?php echo app('translator')->get('report.stock_report'); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="product_list_tab" role="tabpanel">
                                <div class="d-flex flex-wrap justify-content-end gap-2 mb-2">
                                <?php if($is_admin): ?>
                                    <button type="button" class="sync_product_quantity btn btn-info"><?php echo app('translator')->get('lang_v1.sync_product_quantities'); ?> <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
                                    <button type="button" id="bulk_assign_sku_images_btn" class="btn btn-warning"><i class="fa fa-image"></i> Assign Images from SKU <i class="hide fas fa-spinner fa-spin fa-fw"></i></button>
                                    <a class="btn btn-success"
                                        href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'downloadExcel']), false); ?>"><i
                                            class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_excel'); ?></a>
                                    <a class="btn btn-info"
                                        href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'downloadVariableExcel']), false); ?>"><i
                                            class="fa fa-download"></i> Download Variable Products</a>
                                <?php endif; ?>
                                <?php if(!$is_admin): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_export_buttons')): ?>
                                <a class="btn btn-success"
                                    href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'downloadExcel']), false); ?>"><i
                                        class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_excel'); ?></a>
                                <a class="btn btn-info"
                                    href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'downloadVariableExcel']), false); ?>"><i
                                        class="fa fa-download"></i> Download Variable Products</a>
                                <?php endif; ?>
                                <?php endif; ?>
                                <?php if(!$is_offline): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.create')): ?>
                                    <a class="btn btn-primary"
                                        href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'create']), false); ?>">
                                        <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
                                <?php endif; ?>
                                <?php endif; ?>
                                </div>
                                <?php echo $__env->make('product.partials.product_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php if(!empty($variation_templates)): ?>
                            <div class="tab-pane fade" id="variable_product_list_tab" role="tabpanel">
                                <?php echo $__env->make('product.partials.variable_product_list', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stock_report.view')): ?>
                                <div class="tab-pane fade" id="product_stock_report" role="tabpanel">
                                    <?php echo $__env->make('report.partials.stock_report_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <input type="hidden" id="is_rack_enabled" value="<?php echo e($rack_enabled, false); ?>">

        <div class="loading" style="display: none">
            
            <div class="loading-animation"></div>
        </div>
    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>

<div class="modal fade" id="opening_stock_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade product_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade" id="view_product_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
<?php if($is_woocommerce): ?>
    <?php echo $__env->make('product.partials.toggle_woocommerce_sync_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->make('product.partials.edit_product_location_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="modal fade" id="stock_maintenance_modal" tabindex="-1" role="dialog" aria-labelledby="stockMaintenanceModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="stockMaintenanceModalLabel"><i class="fa fa-tools"></i> Stock Maintenance</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="sm_maintenance_type">Maintenance type:</label>
                    <select class="form-control select2" id="sm_maintenance_type" style="width:100%">
                        <option value="none" selected>None</option>
                        <option value="tax">Tax</option>
                        <option value="tax_type_change">Tax Type Change</option>
                        <?php if($show_pct_code_column): ?>
                            <option value="pct_code_add">Add PCT/HSN Code</option>
                            <option value="pct_code_update">Update PCT/HSN Code</option>
                        <?php endif; ?>
                        <option value="not_for_selling">Not for Selling</option>
                        <option value="category">Categories</option>
                        <option value="move_transactions">Move Transactions</option>
                    </select>
                </div>
                <div id="sm_move_transactions_group" style="display:none;">
                    <div class="form-group">
                        <label for="sm_transaction_type">Transaction type:</label>
                        <select class="form-control select2" id="sm_transaction_type" style="width:100%">
                            <option value="">-- Select Transaction Type --</option>
                            <option value="sale">Sale transactions</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sm_from_variation_id">FROM:</label>
                        <select class="form-control" id="sm_from_variation_id" style="width:100%"></select>
                    </div>
                    <div class="form-group">
                        <label for="sm_to_variation_id">TO:</label>
                        <select class="form-control" id="sm_to_variation_id" style="width:100%"></select>
                    </div>
                </div>
                <div class="form-group" id="sm_nfs_group" style="display:none;">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="sm_not_for_selling" value="1">
                            Mark selected products as <strong>Not for Selling</strong>
                            <small class="text-muted">(uncheck to mark as <em>For Selling</em>)</small>
                        </label>
                    </div>
                </div>
                <div class="form-group" id="sm_tax_group" style="display:none;">
                    <label for="sm_tax_id">Tax:</label>
                    <select class="form-control select2" id="sm_tax_id" style="width:100%">
                        <option value="">-- Select Tax --</option>
                        <option value="none">None (Remove Tax)</option>
                        <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax_id => $tax_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($tax_id, false); ?>"><?php echo e($tax_name, false); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div id="sm_tax_type_group" style="display:none;">
                    <p class="help-block" id="sm_tax_type_selected_help" style="display:none;">Selected products will be changed to the selected To Tax Type.</p>
                    <p class="help-block" id="sm_tax_type_unselected_help" style="display:none;">No products selected. Products with the selected From Tax Type will be changed to the selected To Tax Type.</p>
                    <div class="form-group" id="sm_from_tax_type_wrap">
                        <label for="sm_from_tax_type">From Tax Type:</label>
                        <select class="form-control select2" id="sm_from_tax_type" style="width:100%">
                            <option value="">-- Select From Tax Type --</option>
                            <option value="inclusive"><?php echo app('translator')->get('product.inclusive'); ?></option>
                            <option value="inclusive_sell_price"><?php echo app('translator')->get('product.inclusive_sell_price'); ?></option>
                            <option value="inclusive_gp_price"><?php echo app('translator')->get('product.inclusive_on'); ?> <?php echo e($inc_on_gp_name, false); ?></option>
                            <option value="exclusive"><?php echo app('translator')->get('product.exclusive'); ?></option>
                            <option value="none">None</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sm_to_tax_type">To Tax Type:</label>
                        <select class="form-control select2" id="sm_to_tax_type" style="width:100%">
                            <option value="">-- Select To Tax Type --</option>
                            <option value="inclusive"><?php echo app('translator')->get('product.inclusive'); ?></option>
                            <option value="inclusive_sell_price"><?php echo app('translator')->get('product.inclusive_sell_price'); ?></option>
                            <option value="inclusive_gp_price"><?php echo app('translator')->get('product.inclusive_on'); ?> <?php echo e($inc_on_gp_name, false); ?></option>
                            <option value="exclusive"><?php echo app('translator')->get('product.exclusive'); ?></option>
                            <option value="none">None</option>
                        </select>
                    </div>
                </div>
                <div class="form-group" id="sm_pct_code_group" style="display:none;">
                    <label for="sm_pct_code"><?php echo app('translator')->get('lang_v1.pct_code'); ?>:</label>
                    <input type="text" class="form-control" id="sm_pct_code" maxlength="100" inputmode="numeric" pattern="[0-9]*" placeholder="Write without Dots Ex: 1111.2222 => 11112222">
                    <p class="help-block" id="sm_pct_code_add_help" style="display:none;">Only products with empty PCT/HSN Code will be changed.</p>
                    <p class="help-block" id="sm_pct_code_update_help" style="display:none;">All selected products will be changed.</p>
                </div>
                <div id="sm_category_group" style="display:none;">
                    <div class="form-group">
                        <label for="sm_category_id"><?php echo app('translator')->get('product.category'); ?>:</label>
                        <select class="form-control select2" id="sm_category_id" style="width:100%">
                            <option value="">-- Select Category --</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_id => $cat_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat_id, false); ?>"><?php echo e($cat_name, false); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group" id="sm_sub_category_wrap" style="display:none;">
                        <label for="sm_sub_category_id"><?php echo app('translator')->get('product.sub_category'); ?>:</label>
                        <select class="form-control select2" id="sm_sub_category_id" style="width:100%">
                            <option value="">-- Select Sub Category --</option>
                        </select>
                    </div>
                    <div class="form-group" id="sm_sub2_category_wrap" style="display:none;">
                        <label for="sm_sub2_category_id"><?php echo app('translator')->get('product.sub2_category'); ?>:</label>
                        <select class="form-control select2" id="sm_sub2_category_id" style="width:100%">
                            <option value="">-- Select Sub2 Category --</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="sm_apply_btn">Apply</button>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>
    <script src="<?php echo e(asset('js/opening_stock.js?v=' . $asset_v), false); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var hide_custom_fields = $('input#hide_custom_feilds').val();
            product_table = $('#product_table').DataTable({
                processing: true,
                serverSide: true,
                aaSorting: [
                    [3, 'asc']
                ],
                scrollY: "75vh",
                scrollX: true,
                scrollCollapse: true,
                "ajax": {
                    "url": "/products",
                    "data": function(d) {
                        d.type = $('#product_list_filter_type').val();
                        d.category_id = $('#product_list_filter_category_id').val();
                        d.sub_category_id = $('#product_list_filter_sub_category_id').val();
                        d.sub2_category_id = $('#product_list_filter_sub2_category_id').val();
                        d.supplier_id = $('#product_list_filter_supplier_id').val();
                        d.brand_id = $('#product_list_filter_brand_id').val();
                        d.sub_brand_id = $('#product_list_filter_sub_brand_id').val();
                        d.gender_id = $('#product_list_filter_gender_id').val();
                        d.sub_gender_id = $('#product_list_filter_sub_gender_id').val();
                        d.procurement_source_id = $('#product_list_filter_procurement_source_id').val();
                        d.sub_procurement_source_id = $('#product_list_filter_sub_procurement_source_id').val();
                        d.unit_id = $('#product_list_filter_unit_id').val();
                        d.sub_unit_id = $('#product_list_filter_sub_unit_id').val();
                        d.variation_template_id = $('#product_list_filter_variation_template_id').val();
                        d.tax_id = $('#product_list_filter_tax_id').val();
                        d.tax_type = $('#product_list_filter_tax_type').val();
                        d.active_state = $('#active_state').val();
                        d.show_only_deactivated = $('#show_only_deactivated').is(':checked');
                        d.not_for_selling = $('#not_for_selling').is(':checked');
                        d.show_deleted = $('#show_deleted').is(':checked');
                        d.show_duplicates = $('#show_duplicates').is(':checked');
                        d.location_id = $('#location_id').val();
                        if ($('#repair_model_id').length == 1) {
                            d.repair_model_id = $('#repair_model_id').val();
                        }
                        if ($('#woocommerce_enabled').length == 1 && $('#woocommerce_enabled').is(':checked')) {
                            d.woocommerce_enabled = 1;
                        }
                        d.show_positive_quantity = $('#show_positive_quantity').length && $('#show_positive_quantity').is(':checked') ? 1 : 0;
                        d.show_negative_quantity = $('#show_negative_quantity').length && $('#show_negative_quantity').is(':checked') ? 1 : 0;
                        d.show_zero_quantity = $('#show_zero_quantity').length && $('#show_zero_quantity').is(':checked') ? 1 : 0;
                        d.show_without_history = $('#show_without_history').length && $('#show_without_history').is(':checked') ? 1 : 0;
                        d.show_price_exc_tax = $('#show_price_exc_tax').length && $('#show_price_exc_tax').is(':checked') ? 1 : 0;

                        d = __datatable_ajax_callback(d);
                    }
                },
                columnDefs: [{
                    "targets": [0, 1, 2],
                    "orderable": false,
                    "searchable": false
                }],
                columns: [
                    {
                        data: 'mass_delete'
                    },
                    {
                        data: 'image',
                        name: 'products.image'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    <?php if(empty($user_settings['product_index_hide_product_type'])): ?>
                    {
                        data: 'type',
                        name: 'products.type',
                        searchable: false,
                    },
                    <?php endif; ?>
                    {
                        data: 'sku',
                        name: 'products.sku'
                    },
                    {
                        data: 'product',
                        name: 'products.name'
                    },
                    <?php if($common_settings['enable_other_product_name']): ?>
                    {
                        data: 'other_name',
                        name: 'products.other_name',
                        searchable : true,
                    },
                    <?php endif; ?>
                    <?php if(session('business.enable_category') && empty($user_settings['product_index_hide_category'])): ?>
                    {
                        data: 'category',
                        name: 'c1.name',
                    },
                    <?php endif; ?>
                    <?php if(session('business.enable_sub_category') && empty($user_settings['product_index_hide_category'])): ?>
                    {
                        data: 'sub_category',
                        name: 'sub_category',
                        searchable: false,
                    },
                    <?php endif; ?>
                    <?php if(session('business.enable_sub2_category') && empty($user_settings['product_index_hide_category'])): ?>
                    {
                        data: 'sub2_category',
                        name: 'sub2_category',
                        searchable: false,
                    },
                    <?php endif; ?>
                    <?php if(empty($user_settings['product_index_hide_brand'])): ?>
                    {
                        data: 'brand',
                        name: 'brands.name',
                    },
                    <?php endif; ?>
                    <?php if(session('business.enable_gender') && empty($user_settings['product_index_hide_gender'])): ?>
                    {
                        data: 'gender',
                        name: 'genders.name',
                    },
                    <?php endif; ?>
                    <?php if(session('business.enable_procurement_source') && empty($user_settings['product_index_hide_procurement_source'])): ?>
                    {
                        data: 'procurement_source',
                        name: 'procurement_sources.name',
                    },
                    <?php endif; ?>
                    <?php if(empty($user_settings['product_index_hide_tax'])): ?>
                    {
                        data: 'tax',
                        name: 'tax_rates.name',
                        searchable: false,
                    },
                    {
                        data: 'tax_type',
                        name: 'products.tax_type',
                        searchable: false,
                    },
                    <?php endif; ?>
                    <?php if($show_pct_code_column): ?>
                    {
                        data: 'pct_code',
                        name: 'products.pct_code'
                    },
                    <?php endif; ?>
                    <?php if(empty($user_settings['product_index_hide_business_location'])): ?>
                    {
                        data: 'product_locations',
                        name: 'product_locations',
                    },
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_purchase_price')): ?>
                        <?php if(empty($user_settings['product_index_hide_unit_purchase_price'])): ?>
                        {
                            data: 'purchase_price',
                            name: 'max_purchase_price',
                            searchable: false
                        },
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_default_selling_price')): ?>
                        <?php if(empty($user_settings['product_index_hide_selling_price'])): ?>
                        {
                            data: 'selling_price',
                            name: 'max_price',
                            searchable: false
                        },
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if($user_settings['ps_show_price_group']): ?>
                    {
                        data: 'price_group',
                        name: 'price_group',
                        searchable: false
                    },
                    <?php endif; ?>
                    <?php if(empty($user_settings['product_index_hide_current_stock'])): ?>
                    {
                        data: 'current_stock',
                        searchable: false
                    },
                    <?php endif; ?>
                    <?php if(!empty($common_settings['enable_delivery_notes'])): ?>
                    {
                        data: 'held_quantity',
                        searchable: false
                    },
                    <?php endif; ?>
                    <?php if($common_settings['enable_kot_printer_prepration_time']): ?>
                    {
                        data: 'printer_name',
                        name: 'printer_name',
                        searchable: false
                    },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['product']['custom_field_1'])): ?>
                    {
                        data: 'product_custom_field1',
                        name: 'products.product_custom_field1'
                    },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['product']['custom_field_2'])): ?>
                    {
                        data: 'product_custom_field2',
                        name: 'products.product_custom_field2'
                    },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['product']['custom_field_3'])): ?>
                    {
                        data: 'product_custom_field3',
                        name: 'products.product_custom_field3'
                    },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['product']['custom_field_4'])): ?>
                    {
                        data: 'product_custom_field4',
                        name: 'products.product_custom_field4'
                    },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['product']['custom_field_5'])): ?>
                    {
                        data: 'product_custom_field5',
                        name: 'products.product_custom_field5'
                    },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['product']['custom_field_6'])): ?>
                    {
                        data: 'product_custom_field6',
                        name: 'products.product_custom_field6'
                    },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['product']['custom_field_7'])): ?>
                    {
                        data: 'product_custom_field7',
                        name: 'products.product_custom_field7'
                    },
                    <?php endif; ?>
                    <?php if(!empty($custom_labels['product']['custom_field_8'])): ?>
                    {
                        data: 'product_custom_field8',
                        name: 'products.product_custom_field8'
                    },
                    <?php endif; ?>
                   
                    <?php if(empty($user_settings['product_index_hide_created_at'])): ?>
                    {
                        data: 'creation_time',
                        name: 'products.created_at'
                    },
                    <?php endif; ?>
                    <?php if(empty($user_settings['product_index_hide_updated_at'])): ?>
                    {
                        data: 'updation_time',
                        name: 'products.updated_at'
                    }
                    <?php endif; ?>
                    
                    
                ],
                createdRow: function(row, data, dataIndex) {
                    if ($('input#is_rack_enabled').val() == 1) {
                        var target_col = 0;
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.delete')): ?>
                            target_col = 1;
                        <?php endif; ?>
                        $(row).find('td:eq(' + target_col + ') div').prepend(
                            '<i style="margin:auto;" class="fa fa-plus-circle text-success cursor-pointer no-print rack-details" title="' +
                            LANG.details + '"></i>&nbsp;&nbsp;');
                    }
                    $(row).find('td:eq(0)').attr('class', 'selectable_td');
                },
                fnDrawCallback: function(oSettings) {
                    __currency_convert_recursively($('#product_table'));
                },
            });

            var product_table_last_search = product_table.search();
            var should_reset_product_table_scroll = false;
            function reset_product_table_scroll_to_identifiers() {
                var $scroll_body = $('#product_table_wrapper .dataTables_scrollBody');
                if (!$scroll_body.length) {
                    return;
                }
                $scroll_body.scrollLeft(0);
            }

            product_table.on('search.dt', function() {
                var current_search = product_table.search();
                if (current_search !== product_table_last_search) {
                    product_table_last_search = current_search;
                    should_reset_product_table_scroll = true;
                }
            });

            product_table.on('draw.dt', function() {
                if (should_reset_product_table_scroll) {
                    should_reset_product_table_scroll = false;
                    reset_product_table_scroll_to_identifiers();
                    setTimeout(reset_product_table_scroll_to_identifiers, 0);
                }
            });


            // Array to track the ids of the details displayed rows
            var detailRows = [];

            $('#product_table tbody').on('click', 'tr i.rack-details', function() {
                var i = $(this);
                var tr = $(this).closest('tr');
                var row = product_table.row(tr);
                var idx = $.inArray(tr.attr('id'), detailRows);

                if (row.child.isShown()) {
                    i.addClass('fa-plus-circle text-success');
                    i.removeClass('fa-minus-circle text-danger');

                    row.child.hide();

                    // Remove from the 'open' array
                    detailRows.splice(idx, 1);
                } else {
                    i.removeClass('fa-plus-circle text-success');
                    i.addClass('fa-minus-circle text-danger');

                    row.child(get_product_details(row.data())).show();

                    // Add to the 'open' array
                    if (idx === -1) {
                        detailRows.push(tr.attr('id'));
                    }
                }
            });

            $('#opening_stock_modal').on('hidden.bs.modal', function(e) {
                product_table.ajax.reload();
            });

            // $('table#product_table tbody').on('click', 'a.delete-product', function(e) {
            $(document).on('click', 'a.delete-product', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).attr('href');
                        $.ajax({
                            method: "DELETE",
                            url: href,
                            dataType: "json",
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    product_table.ajax.reload();
                                    if (variable_showcase_initialized) {
                                        loadVariableShowcase(true);
                                    }
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', 'button.restore_product_button', function(e) {
                e.preventDefault();
                swal({
                    title: LANG.sure,
                    icon: "info",
                    buttons: true,
                }).then((willRestore) => {
                    if (willRestore) {
                        var href = $(this).data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result) {
                                if (result.success == true) {
                                    toastr.success(result.msg);
                                    product_table.ajax.reload();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#delete-selected', function(e) {
                e.preventDefault();
                var selected_rows = getSelectedRows();

                if (selected_rows.length > 0) {
                    $('input#selected_rows').val(selected_rows);
                    swal({
                        title: LANG.sure,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            $('form#mass_delete_form').submit();
                        }
                    });
                } else {
                    $('input#selected_rows').val('');
                    swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                }
            });

            $(document).on('click', '#deactivate-selected', function(e) {
                e.preventDefault();
                var selected_rows = getSelectedRows();

                if (selected_rows.length > 0) {
                    $('input#selected_products').val(selected_rows);
                    swal({
                        title: LANG.sure,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            var form = $('form#mass_deactivate_form')

                            var data = form.serialize();
                            $.ajax({
                                method: form.attr('method'),
                                url: form.attr('action'),
                                dataType: 'json',
                                data: data,
                                success: function(result) {
                                    if (result.success == true) {
                                        toastr.success(result.msg);
                                        product_table.ajax.reload();
                                        form
                                            .find('#selected_products')
                                            .val('');
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    });
                } else {
                    $('input#selected_products').val('');
                    swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                }
            });

            $(document).on('click', '#reactivate-selected', function(e) {
                e.preventDefault();
                var selected_rows = getSelectedRows();

                if (selected_rows.length > 0) {
                    $('input#selected_products').val(selected_rows);
                    swal({
                        title: LANG.sure,
                        icon: "info",
                        buttons: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            var form = $('form#mass_reactivate_form')

                            var data = form.serialize();
                            $.ajax({
                                method: form.attr('method'),
                                url: form.attr('action'),
                                dataType: 'json',
                                data: data,
                                success: function(result) {
                                    if (result.success == true) {
                                        toastr.success(result.msg);
                                        product_table.ajax.reload();
                                        form
                                            .find('#selected_products')
                                            .val('');
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    });
                } else {
                    $('input#selected_products').val('');
                    swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                }
            });

            $(document).on('click', '.deactivate-product', function(e) {
                e.preventDefault();

                    $('input#selected_products').val($(this).data('id'));
                    swal({
                        title: LANG.sure,
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willDelete) => {
                        if (willDelete) {
                            var form = $('form#mass_deactivate_form')

                            var data = form.serialize();
                            $.ajax({
                                method: form.attr('method'),
                                url: form.attr('action'),
                                dataType: 'json',
                                data: data,
                                success: function(result) {
                                    if (result.success == true) {
                                        toastr.success(result.msg);
                                        product_table.ajax.reload();
                                        form
                                            .find('#selected_products')
                                            .val('');
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                },
                            });
                        }
                    }); 
            });

            // ── Stock Maintenance modal ──────────────────────────────────
            $('#stock_maintenance_modal').on('shown.bs.modal', function() {
                var $modal = $(this);
                $modal.find('#sm_maintenance_type').select2({ dropdownParent: $modal, width: '100%' });
                $modal.find('#sm_tax_id').select2({ dropdownParent: $modal, width: '100%' });
                $modal.find('#sm_from_tax_type').select2({ dropdownParent: $modal, width: '100%' });
                $modal.find('#sm_to_tax_type').select2({ dropdownParent: $modal, width: '100%' });
                $modal.find('#sm_category_id').select2({ dropdownParent: $modal, width: '100%' });
                $modal.find('#sm_sub_category_id').select2({ dropdownParent: $modal, width: '100%' });
                $modal.find('#sm_sub2_category_id').select2({ dropdownParent: $modal, width: '100%' });
                $modal.find('#sm_transaction_type').select2({ dropdownParent: $modal, width: '100%' });
                initStockMaintenanceProductSelect($modal.find('#sm_from_variation_id'));
                initStockMaintenanceProductSelect($modal.find('#sm_to_variation_id'));
            });

            function initStockMaintenanceProductSelect($select) {
                if ($select.data('select2')) {
                    return;
                }

                $select.select2({
                    dropdownParent: $('#stock_maintenance_modal'),
                    width: '100%',
                    allowClear: true,
                    placeholder: '-- Select Product --',
                    ajax: {
                        url: '<?php echo e(action([\App\Http\Controllers\ProductController::class, "stockMaintenanceVariationSearch"]), false); ?>',
                        dataType: 'json',
                        delay: 250,
                        data: function(params) {
                            return { term: params.term || '' };
                        },
                        processResults: function(data) {
                            return { results: data.results || [] };
                        },
                        cache: true
                    },
                    minimumInputLength: 2
                });
            }

            function refreshTaxTypeChangeMode() {
                if ($('#sm_maintenance_type').val() !== 'tax_type_change') {
                    return;
                }

                var selected_rows = getSelectedRows();
                if (selected_rows.length > 0) {
                    $('#sm_from_tax_type_wrap').hide();
                    $('#sm_tax_type_unselected_help').hide();
                    $('#sm_tax_type_selected_help').show();
                    $('#sm_from_tax_type').val('').trigger('change');
                } else {
                    $('#sm_from_tax_type_wrap').show();
                    $('#sm_tax_type_selected_help').hide();
                    $('#sm_tax_type_unselected_help').show();
                }
            }

            $(document).on('change', '#sm_maintenance_type', function() {
                var val = $(this).val();
                $('#sm_tax_group').hide();
                $('#sm_tax_type_group').hide();
                $('#sm_tax_type_selected_help').hide();
                $('#sm_tax_type_unselected_help').hide();
                $('#sm_pct_code_group').hide();
                $('#sm_pct_code_add_help').hide();
                $('#sm_pct_code_update_help').hide();
                $('#sm_nfs_group').hide();
                $('#sm_category_group').hide();
                $('#sm_move_transactions_group').hide();
                if (val === 'tax') {
                    $('#sm_tax_group').show();
                } else if (val === 'tax_type_change') {
                    $('#sm_tax_type_group').show();
                    refreshTaxTypeChangeMode();
                } else if (val === 'pct_code_add') {
                    $('#sm_pct_code_group').show();
                    $('#sm_pct_code_add_help').show();
                } else if (val === 'pct_code_update') {
                    $('#sm_pct_code_group').show();
                    $('#sm_pct_code_update_help').show();
                } else if (val === 'not_for_selling') {
                    $('#sm_nfs_group').show();
                } else if (val === 'category') {
                    $('#sm_category_group').show();
                } else if (val === 'move_transactions') {
                    $('#sm_move_transactions_group').show();
                } else {
                    $('#sm_tax_id').val('').trigger('change');
                    $('#sm_from_tax_type').val('').trigger('change');
                    $('#sm_to_tax_type').val('').trigger('change');
                }
            });

            $(document).on('change', '#product_table .row-select, #select-all-row', function() {
                refreshTaxTypeChangeMode();
            });

            // Load sub-categories when category changes inside the modal
            $(document).on('change', '#sm_category_id', function() {
                var cat_id = $(this).val();
                $('#sm_sub_category_id').html('<option value="">-- Select Sub Category --</option>').trigger('change');
                $('#sm_sub2_category_id').html('<option value="">-- Select Sub2 Category --</option>').trigger('change');
                $('#sm_sub_category_wrap').hide();
                $('#sm_sub2_category_wrap').hide();
                if (!cat_id) { return; }
                $.ajax({
                    method: 'POST',
                    url: '/products/get_sub_categories',
                    dataType: 'html',
                    data: { cat_id: cat_id },
                    success: function(result) {
                        if (result && result.trim() !== '') {
                            $('#sm_sub_category_id').html(result);
                            $('#sm_sub_category_wrap').show();
                        }
                    }
                });
            });

            // Load sub2-categories when sub-category changes inside the modal
            $(document).on('change', '#sm_sub_category_id', function() {
                var sub_cat_id = $(this).val();
                $('#sm_sub2_category_id').html('<option value="">-- Select Sub2 Category --</option>').trigger('change');
                $('#sm_sub2_category_wrap').hide();
                if (!sub_cat_id) { return; }
                $.ajax({
                    method: 'POST',
                    url: '/products/get_sub_categories',
                    dataType: 'html',
                    data: { cat_id: sub_cat_id },
                    success: function(result) {
                        if (result && result.trim() !== '') {
                            $('#sm_sub2_category_id').html(result);
                            $('#sm_sub2_category_wrap').show();
                        }
                    }
                });
            });

            $(document).on('click', '#stock-maintenance-btn', function() {
                // Reset modal state
                $('#sm_maintenance_type').val('none').trigger('change');
                $('#sm_tax_id').val('').trigger('change');
                $('#sm_from_tax_type').val('').trigger('change');
                $('#sm_to_tax_type').val('').trigger('change');
                $('#sm_pct_code').val('');
                $('#sm_not_for_selling').prop('checked', false);
                $('#sm_category_id').val('').trigger('change');
                $('#sm_sub_category_id').html('<option value="">-- Select Sub Category --</option>');
                $('#sm_sub2_category_id').html('<option value="">-- Select Sub2 Category --</option>');
                $('#sm_transaction_type').val('').trigger('change');
                $('#sm_from_variation_id').val(null).trigger('change');
                $('#sm_to_variation_id').val(null).trigger('change');
                $('#sm_sub_category_wrap, #sm_sub2_category_wrap').hide();
                $('#stock_maintenance_modal').modal('show');
            });

            $(document).on('click', '#sm_apply_btn', function() {
                var maintenance_type = $('#sm_maintenance_type').val();

                var url, data;

                if (maintenance_type === 'tax') {
                    var selected_rows = getSelectedRows();
                    if (selected_rows.length === 0) {
                        swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                        return;
                    }

                    var tax_id = $('#sm_tax_id').val();
                    if (!tax_id) {
                        toastr.error('Please select a tax or None.');
                        return;
                    }
                    if (tax_id === 'none') { tax_id = ''; }
                    url = '<?php echo e(action([\App\Http\Controllers\ProductController::class, "massApplyTax"]), false); ?>';
                    data = { _token: '<?php echo e(csrf_token(), false); ?>', selected_products: selected_rows.join(','), tax_id: tax_id };

                } else if (maintenance_type === 'tax_type_change') {
                    var selected_rows = getSelectedRows();
                    var from_tax_type = $('#sm_from_tax_type').val();
                    var to_tax_type = $('#sm_to_tax_type').val();

                    if (!to_tax_type) {
                        toastr.error('Please select To Tax Type.');
                        return;
                    }

                    if (selected_rows.length === 0 && !from_tax_type) {
                        toastr.error('Please select From Tax Type.');
                        return;
                    }

                    if (selected_rows.length === 0 && from_tax_type === to_tax_type) {
                        toastr.error('From Tax Type and To Tax Type cannot be the same.');
                        return;
                    }

                    url = '<?php echo e(action([\App\Http\Controllers\ProductController::class, "massApplyTaxType"]), false); ?>';
                    data = { _token: '<?php echo e(csrf_token(), false); ?>', selected_products: selected_rows.join(','), from_tax_type: from_tax_type, to_tax_type: to_tax_type };

                } else if (maintenance_type === 'pct_code_add' || maintenance_type === 'pct_code_update') {
                    var selected_rows = getSelectedRows();
                    if (selected_rows.length === 0) {
                        swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                        return;
                    }

                    var pct_code = $.trim($('#sm_pct_code').val());
                    if (!pct_code) {
                        toastr.error('Please enter a PCT/HSN Code.');
                        return;
                    }

                    url = '<?php echo e(action([\App\Http\Controllers\ProductController::class, "massApplyPctCode"]), false); ?>';
                    data = {
                        _token: '<?php echo e(csrf_token(), false); ?>',
                        selected_products: selected_rows.join(','),
                        pct_code: pct_code,
                        mode: maintenance_type === 'pct_code_add' ? 'add' : 'update'
                    };

                } else if (maintenance_type === 'not_for_selling') {
                    var selected_rows = getSelectedRows();
                    if (selected_rows.length === 0) {
                        swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                        return;
                    }

                    url = '<?php echo e(action([\App\Http\Controllers\ProductController::class, "massApplyNotForSelling"]), false); ?>';
                    data = { _token: '<?php echo e(csrf_token(), false); ?>', selected_products: selected_rows.join(','), not_for_selling: $('#sm_not_for_selling').is(':checked') ? 1 : 0 };

                } else if (maintenance_type === 'category') {
                    var selected_rows = getSelectedRows();
                    if (selected_rows.length === 0) {
                        swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                        return;
                    }

                    var cat_id = $('#sm_category_id').val();
                    if (!cat_id) {
                        toastr.error('Please select a category.');
                        return;
                    }
                    var sub_cat_id  = $('#sm_sub_category_id').val()  || '';
                    var sub2_cat_id = $('#sm_sub2_category_id').val() || '';
                    url = '<?php echo e(action([\App\Http\Controllers\ProductController::class, "massApplyCategory"]), false); ?>';
                    data = { _token: '<?php echo e(csrf_token(), false); ?>', selected_products: selected_rows.join(','), category_id: cat_id, sub_category_id: sub_cat_id, sub2_category_id: sub2_cat_id };

                } else if (maintenance_type === 'move_transactions') {
                    var transaction_type = $('#sm_transaction_type').val();
                    var from_variation_id = $('#sm_from_variation_id').val();
                    var to_variation_id = $('#sm_to_variation_id').val();

                    if (!transaction_type) {
                        toastr.error('Please select a transaction type.');
                        return;
                    }
                    if (!from_variation_id || !to_variation_id) {
                        toastr.error('Please select both FROM and TO products.');
                        return;
                    }
                    if (from_variation_id === to_variation_id) {
                        toastr.error('FROM and TO products cannot be the same.');
                        return;
                    }

                    url = '<?php echo e(action([\App\Http\Controllers\ProductController::class, "moveSaleTransactions"]), false); ?>';
                    data = { _token: '<?php echo e(csrf_token(), false); ?>', transaction_type: transaction_type, from_variation_id: from_variation_id, to_variation_id: to_variation_id };

                } else {
                    return;
                }

                $.ajax({
                    method: 'POST',
                    url: url,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            $('#stock_maintenance_modal').modal('hide');
                            product_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });
            // ── End Stock Maintenance modal ──────────────────────────────

            $(document).on('click', '#edit-selected', function(e) {
                e.preventDefault();
                var selected_rows = getSelectedRows();

                if (selected_rows.length > 0) {
                    $('input#selected_products_for_edit').val(selected_rows);
                    $('form#bulk_edit_form').submit();
                } else {
                    $('input#selected_products').val('');
                    swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                }
            })

            // Bulk Print Labels button handler
            $(document).on('click', '#bulk-print-labels', function(e) {
                e.preventDefault();
                var selected_rows = getSelectedRows();

                if (selected_rows.length > 0) {
                    // Create a hidden form and POST to labels/show
                    var form = $('<form>', {
                        method: 'POST',
                        action: '<?php echo e(action([\App\Http\Controllers\LabelsController::class, "show"]), false); ?>'
                    });
                    // Add CSRF token
                    form.append($('<input>', {
                        type: 'hidden',
                        name: '_token',
                        value: $('meta[name="csrf-token"]').attr('content')
                    }));
                    // Add each product ID
                    selected_rows.forEach(function(id) {
                        form.append($('<input>', {
                            type: 'hidden',
                            name: 'product_ids[]',
                            value: id
                        }));
                    });
                    $('body').append(form);
                    form.submit();
                } else {
                    swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                }
            });

            // $('table#product_table tbody').on('click', 'a.activate-product', function(e) {
            $(document).on('click', 'a.activate-product', function(e) {
                e.preventDefault();
                var href = $(this).attr('href');
                $.ajax({
                    method: "get",
                    url: href,
                    dataType: "json",
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            product_table.ajax.reload();
                        } else {
                            toastr.error(result.msg);
                        }
                    }
                });
            });

            // Populate sub-categories when category changes
            $(document).on('change', '#product_list_filter_category_id', function() {
                var cat = $(this).val();
                $('#product_list_filter_sub2_category_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
                $.ajax({
                    method: 'POST',
                    url: '/products/get_sub_categories',
                    dataType: 'html',
                    data: { cat_id: cat },
                    success: function(result) {
                        if (result) {
                            $('#product_list_filter_sub_category_id').html(result);
                        }
                    },
                });
            });

            // Populate sub2-categories when sub-category changes
            $(document).on('change', '#product_list_filter_sub_category_id', function() {
                var sub_cat = $(this).val();
                $.ajax({
                    method: 'POST',
                    url: '/products/get_sub_categories',
                    dataType: 'html',
                    data: { cat_id: sub_cat },
                    success: function(result) {
                        if (result) {
                            $('#product_list_filter_sub2_category_id').html(result);
                        }
                    },
                });
            });

            // Populate sub-brands when brand changes
            $(document).on('change', '#product_list_filter_brand_id', function() {
                var brand_id = $(this).val();
                if (brand_id) {
                    $.ajax({
                        method: 'POST',
                        url: '/brands/get_sub_brands',
                        dataType: 'html',
                        data: { brand_id: brand_id },
                        success: function(result) {
                            if (result) {
                                $('#product_list_filter_sub_brand_id').html(result);
                            }
                        },
                    });
                } else {
                    $('#product_list_filter_sub_brand_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
                }
            });

            // Populate sub-genders when gender changes
            $(document).on('change', '#product_list_filter_gender_id', function() {
                var gender_id = $(this).val();
                if (gender_id) {
                    $.ajax({
                        method: 'POST',
                        url: '/genders/get_sub_genders',
                        dataType: 'html',
                        data: { gender_id: gender_id },
                        success: function(result) {
                            if (result) {
                                $('#product_list_filter_sub_gender_id').html(result);
                            }
                        },
                    });
                } else {
                    $('#product_list_filter_sub_gender_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
                }
            });

            // Populate sub-units when unit changes
            $(document).on('change', '#product_list_filter_unit_id', function() {
                var unit_id = $(this).val();
                if (unit_id) {
                    $.ajax({
                        method: 'GET',
                        url: '/products/get_sub_units',
                        dataType: 'html',
                        data: { unit_id: unit_id },
                        success: function(result) {
                            if (result) {
                                $('#product_list_filter_sub_unit_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>' + result);
                            }
                        },
                    });
                } else {
                    $('#product_list_filter_sub_unit_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
                }
            });

            // Populate sub-procurement-sources when procurement source changes
            $(document).on('change', '#product_list_filter_procurement_source_id', function() {
                var proc_id = $(this).val();
                if (proc_id) {
                    $.ajax({
                        method: 'POST',
                        url: '/procurement-sources/get_sub_procurement_sources',
                        dataType: 'html',
                        data: { procurement_source_id: proc_id },
                        success: function(result) {
                            if (result) {
                                $('#product_list_filter_sub_procurement_source_id').html(result);
                            }
                        },
                    });
                } else {
                    $('#product_list_filter_sub_procurement_source_id').html('<option value=""><?php echo e(__("lang_v1.all"), false); ?></option>');
                }
            });

            $(document).on('change',
                '#product_list_filter_type, #product_list_filter_variation_template_id, #product_list_filter_category_id, #product_list_filter_sub_category_id, #product_list_filter_sub2_category_id, #product_list_filter_supplier_id, #product_list_filter_brand_id, #product_list_filter_sub_brand_id, #product_list_filter_gender_id, #product_list_filter_sub_gender_id, #product_list_filter_procurement_source_id, #product_list_filter_sub_procurement_source_id, #product_list_filter_unit_id, #product_list_filter_sub_unit_id, #product_list_filter_tax_id, #product_list_filter_tax_type, #location_id, #active_state, #repair_model_id',
                function() {
                    var location = $('select#location_id').find('option:selected').text();
                    $('#business_location').val(location);

                    if ($("#product_list_tab").hasClass('active')) {
                        product_table.ajax.reload();
                    }

                    if ($("#product_stock_report").hasClass('active')) {
                        stock_report_table.ajax.reload();
                    }

                    if ($("#variable_product_list_tab").hasClass('active') && variable_showcase_initialized) {
                        loadVariableShowcase(true);
                    }
                });

            
            $(document).on('change', '#show_positive_quantity, #show_negative_quantity, #show_zero_quantity, #show_without_history, #show_price_exc_tax, #not_for_selling, #show_deleted, #show_duplicates, #woocommerce_enabled, #show_only_deactivated', function() {
                if ($("#product_list_tab").hasClass('active')) {
                    product_table.ajax.reload();
                }

                if ($("#product_stock_report").hasClass('active')) {
                     stock_report_table.ajax.reload();
                }

                if ($("#variable_product_list_tab").hasClass('active') && variable_showcase_initialized) {
                    loadVariableShowcase(true);
                }
            });

            $('#product_location').select2({
                dropdownParent: $('#product_location').closest('.modal')
            });

            $('#product_table').on('draw.dt', function() {
                $('.dropdown-toggle').dropdown();
            });

            $(document).on('click', 'button.merge_products', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '/products/merge-products',
                    dataType: 'html',
                    success: function(result) {
                        $('#view_product_modal')
                            .html(result)
                            .modal('show');

                        initProductSearch($('#merge_products_form #merge_from'), $('#view_product_modal'));
                        initProductSearch($('#merge_products_form #merge_to'), $('#view_product_modal'));
                    },
                });
            });

            <?php if($is_woocommerce): ?>
                $(document).on('click', '.toggle_woocomerce_sync', function(e) {
                    e.preventDefault();
                    var selected_rows = getSelectedRows();
                    if (selected_rows.length > 0) {
                        $('#woocommerce_sync_modal').modal('show');
                        $("input#woocommerce_products_sync").val(selected_rows);
                    } else {
                        $('input#selected_products').val('');
                        swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
                    }
                });

                $(document).on('submit', 'form#toggle_woocommerce_sync_form', function(e) {
                    e.preventDefault();
                    var url = $('form#toggle_woocommerce_sync_form').attr('action');
                    var method = $('form#toggle_woocommerce_sync_form').attr('method');
                    var data = $('form#toggle_woocommerce_sync_form').serialize();
                    var ladda = Ladda.create(document.querySelector('.ladda-button'));
                    ladda.start();
                    $.ajax({
                        method: method,
                        dataType: "json",
                        url: url,
                        data: data,
                        success: function(result) {
                            ladda.stop();
                            if (result.success) {
                                $("input#woocommerce_products_sync").val('');
                                $('#woocommerce_sync_modal').modal('hide');
                                toastr.success(result.msg);
                                product_table.ajax.reload();
                            } else {
                                toastr.error(result.msg);
                            }
                        }
                    });
                });

                $(document).on('click', '.unlink_variation_woocom', function(e) {
                    e.preventDefault();
                    var link = $(this);
                    var variation_id = $(this).data('variation_id');
                    swal({
                        title: LANG.sure,
                        icon: "info",
                        buttons: true,
                    }).then((willunlink) => {
                        if (willunlink) {
                            var href = $(this).data('href');
                            $.ajax({
                                method: 'POST',
                                dataType: "json",
                                url: href,
                                data: {
                                    variation_id : variation_id,
                                },
                                success: function(result) {
                                    if (result.success == true) {
                                        link.closest('span.woocom_detail').remove();
                                    } else {
                                        toastr.error(result.msg);
                                    }
                                }
                            });
                        }
                    });
                });
            <?php endif; ?>

            keyBindingEnabled = true;
            document.addEventListener('keydown', function(event) {
                if (event.key === 'F10') {
                    event.preventDefault();
                    if (keyBindingEnabled) {
                        keyBindingEnabled = false;
                        $('button#nav_open_products_search_modal').trigger('click');
                        setTimeout(() => {
                            keyBindingEnabled = true;
                        }, 1000);
                    }
                }
            });
        });

        $(document).on('shown.bs.modal', 'div.view_product_modal, div.view_modal, #view_product_modal',
            function() {
                var div = $(this).find('#view_product_stock_details');
                if (div.length) {
                    $.ajax({
                        url: "<?php echo e(action([\App\Http\Controllers\ReportController::class, 'getStockReport']), false); ?>" +
                            '?for=view_product&product_id=' + div.data('product_id'),
                        dataType: 'html',
                        success: function(result) {
                            div.html(result);
                            __currency_convert_recursively(div);
                        },
                    });
                }
                __currency_convert_recursively($(this));
            });

        var data_table_initailized = false;
        var variable_showcase_initialized = false;
        var variable_showcase_page = 0;
        var variable_showcase_size = 12;
        var variable_showcase_search_timer = null;

        function stripHtml(html) {
            return $('<div/>').html(html || '').text().trim();
        }

        function escapeHtml(value) {
            return $('<div/>').text(value || '').html();
        }

        var variable_showcase_color_map = {
            black: '#1f2328',
            white: '#f5f7fa',
            red: '#e25353',
            maroon: '#7b2235',
            blue: '#2f80ed',
            navy: '#24436a',
            skyblue: '#7dd3fc',
            green: '#2d9b57',
            olive: '#61764b',
            yellow: '#ffc425',
            gold: '#c8a44d',
            orange: '#ff8a34',
            purple: '#8c59d9',
            pink: '#f28fb1',
            brown: '#8d6548',
            beige: '#ddc3a5',
            cream: '#efe4c8',
            silver: '#b8bec9',
            grey: '#8a929c',
            gray: '#8a929c'
        };

        function normalizeVariationToken(token) {
            return (token || '').replace(/\s+/g, ' ').trim();
        }

        function resolveVariationColor(token) {
            var normalized = normalizeVariationToken(token).toLowerCase().replace(/[^a-z]/g, '');
            return variable_showcase_color_map[normalized] || null;
        }

        function pushUniqueVariationValue(collection, value, comparatorKey) {
            if (!value) {
                return;
            }

            var key = comparatorKey || value;
            var exists = collection.some(function(item) {
                return item.key === key;
            });

            if (!exists) {
                collection.push({
                    key: key,
                    label: value
                });
            }
        }

        function buildVariationDetails(productText, variationNames) {
            var baseParts = productText.split(' - ');
            var productName = normalizeVariationToken(baseParts[0] || productText);
            var colors = [];
            var options = [];

            // Use the pre-aggregated variation_names list (pipe-separated) when available,
            // otherwise fall back to parsing the product name string.
            var tokenSources = [];
            if (variationNames) {
                tokenSources = variationNames.split('|');
            } else if (baseParts.length > 1) {
                tokenSources = normalizeVariationToken(baseParts.slice(1).join(' - ')).split(/[,/|]/);
            }

            tokenSources.forEach(function(rawToken) {
                var token = normalizeVariationToken(rawToken);

                if (!token || token.toUpperCase() === 'DUMMY') {
                    return;
                }

                var splitParts = token.indexOf('-') > -1 ? token.split('-') : [token];
                var foundSwatch = false;

                splitParts.forEach(function(part) {
                    var cleanPart = normalizeVariationToken(part);

                    if (!cleanPart || cleanPart.toUpperCase() === 'DUMMY') {
                        return;
                    }

                    var swatchColor = resolveVariationColor(cleanPart);
                    if (swatchColor) {
                        var swatchKey = cleanPart.toLowerCase().replace(/\s+/g, '-');
                        var hasColor = colors.some(function(color) {
                            return color.key === swatchKey;
                        });

                        if (!hasColor) {
                            colors.push({
                                key: swatchKey,
                                label: cleanPart,
                                value: swatchColor
                            });
                        }
                        foundSwatch = true;
                    } else {
                        pushUniqueVariationValue(options, cleanPart, cleanPart.toLowerCase());
                    }
                });

                if (!foundSwatch && splitParts.length === 1) {
                    pushUniqueVariationValue(options, token, token.toLowerCase());
                }
            });

            return {
                productName: productName || productText,
                variationLabel: tokenSources.slice(0, 3).join(', '),
                colors: colors,
                options: options
            };
        }

        function buildSwatchMarkup(colors) {
            if (!colors.length) {
                return '';
            }
            var visible = colors.slice(0, 10);
            var extra = colors.length - visible.length;
            return '<div class="variable-showcase-swatch-section">'
                + '<div class="variable-showcase-section-label">Colors</div>'
                + '<div class="variable-showcase-swatches">'
                + visible.map(function(color) {
                    return '<span class="variable-showcase-swatch" data-label="' + escapeHtml(color.label) + '" title="' + escapeHtml(color.label) + '" style="background:' + escapeHtml(color.value) + ';"></span>';
                }).join('')
                + (extra > 0 ? '<span class="variable-showcase-token" style="font-size:10px;">+' + extra + '</span>' : '')
                + '</div>'
                + '</div>';
        }

        function buildOptionMarkup(options) {
            if (!options.length) {
                return '<div class="variable-showcase-token-section">'
                    + '<div class="variable-showcase-section-label">Options</div>'
                    + '<div class="variable-showcase-tokens"><span class="variable-showcase-token">Variation</span></div>'
                    + '</div>';
            }
            var visible = options.slice(0, 12);
            var extra = options.length - visible.length;
            return '<div class="variable-showcase-token-section">'
                + '<div class="variable-showcase-section-label">Sizes and options</div>'
                + '<div class="variable-showcase-tokens">'
                + visible.map(function(option) {
                    return '<span class="variable-showcase-token">' + escapeHtml(option.label) + '</span>';
                }).join('')
                + (extra > 0 ? '<span class="variable-showcase-token" style="opacity:.6;">+' + extra + ' more</span>' : '')
                + '</div>'
                + '</div>';
        }

        function buildMetaCard(label, value) {
            return '<div class="variable-showcase-meta-card">'
                + '<div class="variable-showcase-meta-label">' + escapeHtml(label) + '</div>'
                + '<div class="variable-showcase-meta-value">' + escapeHtml(value || '--') + '</div>'
                + '</div>';
        }

        function buildVariableCard(item) {
            var productText = stripHtml(item.product);
            var details = buildVariationDetails(productText, item.variation_names || null);
            var skuText = stripHtml(item.sku) || '--';
            var categoryText = stripHtml(item.category) || '--';
            var brandText = stripHtml(item.brand) || '--';
            var stockText = stripHtml(item.current_stock) || '--';

            // Count of variations
            var varCount = item.variation_names ? item.variation_names.split('|').filter(function(v){ return v.trim(); }).length : 0;
            var varCountBadge = varCount > 0
                ? '<span class="variable-showcase-var-count" title="' + varCount + ' variations">' + varCount + ' var</span>'
                : '';

            return '<div class="col-xl-4 col-lg-6 col-md-6 mb-4 variable-showcase-grid-item">'
                + '<div class="variable-showcase-card">'
                + '<div class="variable-showcase-image-wrap">' + (item.image || '') + '</div>'
                + '<div class="variable-showcase-card-body">'
                + '<div class="variable-showcase-card-top">'
                + '<span class="variable-showcase-badge">Variable product</span>'
                + varCountBadge
                + '<div class="variable-showcase-action-wrap">' + (item.action || '') + '</div>'
                + '</div>'
                + '<div class="variable-showcase-sku">SKU: ' + escapeHtml(skuText) + '</div>'
                + '<h4 class="variable-showcase-title">' + escapeHtml(details.productName) + '</h4>'
                + (varCount > 0 ? '<div class="variable-showcase-subtitle">' + varCount + ' variation' + (varCount > 1 ? 's' : '') + '</div>' : '')
                + buildSwatchMarkup(details.colors)
                + buildOptionMarkup(details.options)
                + '<div class="variable-showcase-meta-grid">'
                + buildMetaCard('Category', categoryText)
                + buildMetaCard('Brand', brandText)
                + '</div>'
                + '<div class="variable-showcase-footer">'
                + '<div>'
                + '<div class="variable-showcase-price">' + (item.selling_price || '--') + '</div>'
                + '<div class="variable-showcase-price-note">Selling price</div>'
                + '</div>'
                + '<div class="variable-showcase-stock">' + escapeHtml(stockText) + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>';
        }

        function loadVariableShowcase(resetPage) {
            if (resetPage) {
                variable_showcase_page = 0;
            }

            var searchValue = $('#variable_showcase_search').val() || '';
            var start = variable_showcase_page * variable_showcase_size;

            $('#variable_showcase_loading').removeClass('d-none');
            $('#variable_showcase_empty').addClass('d-none').text('No variable products found for current filters.');

            $.ajax({
                method: 'GET',
                url: '/products',
                dataType: 'json',
                data: {
                    draw: 1,
                    start: start,
                    length: variable_showcase_size,
                    type: 'variable',
                    category_id: $('#product_list_filter_category_id').val(),
                    sub_category_id: $('#product_list_filter_sub_category_id').val(),
                    sub2_category_id: $('#product_list_filter_sub2_category_id').val(),
                    supplier_id: $('#product_list_filter_supplier_id').val(),
                    brand_id: $('#product_list_filter_brand_id').val(),
                    sub_brand_id: $('#product_list_filter_sub_brand_id').val(),
                    gender_id: $('#product_list_filter_gender_id').val(),
                    sub_gender_id: $('#product_list_filter_sub_gender_id').val(),
                    procurement_source_id: $('#product_list_filter_procurement_source_id').val(),
                    sub_procurement_source_id: $('#product_list_filter_sub_procurement_source_id').val(),
                    unit_id: $('#product_list_filter_unit_id').val(),
                    sub_unit_id: $('#product_list_filter_sub_unit_id').val(),
                    variation_template_id: $('#product_list_filter_variation_template_id').val(),
                    tax_id: $('#product_list_filter_tax_id').val(),
                    tax_type: $('#product_list_filter_tax_type').val(),
                    active_state: $('#active_state').val(),
                    show_only_deactivated: $('#show_only_deactivated').is(':checked'),
                    not_for_selling: $('#not_for_selling').is(':checked'),
                    show_deleted: $('#show_deleted').is(':checked'),
                    show_duplicates: $('#show_duplicates').is(':checked'),
                    location_id: $('#location_id').val(),
                    show_positive_quantity: $('#show_positive_quantity').length && $('#show_positive_quantity').is(':checked') ? 1 : 0,
                    show_negative_quantity: $('#show_negative_quantity').length && $('#show_negative_quantity').is(':checked') ? 1 : 0,
                    show_zero_quantity: $('#show_zero_quantity').length && $('#show_zero_quantity').is(':checked') ? 1 : 0,
                    show_without_history: $('#show_without_history').length && $('#show_without_history').is(':checked') ? 1 : 0,
                    show_price_exc_tax: $('#show_price_exc_tax').length && $('#show_price_exc_tax').is(':checked') ? 1 : 0,
                    showcase_search: searchValue
                },
                success: function(response) {
                    var rows = response && response.data ? response.data : [];
                    var cards = rows.map(function(item) { return buildVariableCard(item); }).join('');
                    $('#variable_showcase_grid').html(cards);

                    if (!rows.length) {
                        $('#variable_showcase_empty').removeClass('d-none');
                    }

                    $('#variable_total_variations').text((response && response.recordsFiltered) ? response.recordsFiltered : 0);
                    $('#variable_visible_rows').text(rows.length);
                    $('#variable_showcase_page_info').text('Page ' + (variable_showcase_page + 1));

                    var total = (response && response.recordsFiltered) ? response.recordsFiltered : 0;
                    $('#variable_showcase_prev').prop('disabled', variable_showcase_page === 0);
                    $('#variable_showcase_next').prop('disabled', (start + variable_showcase_size) >= total);

                    $('.dropdown-toggle').dropdown();
                    __currency_convert_recursively($('#variable_showcase_grid'));
                },
                error: function() {
                    $('#variable_showcase_grid').html('');
                    $('#variable_showcase_empty').removeClass('d-none').text('Unable to load variable products. Please refresh and try again.');
                },
                complete: function() {
                    $('#variable_showcase_loading').addClass('d-none');
                }
            });
        }

        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            if ($(e.target).attr('href') == '#variable_product_list_tab') {
                if (!variable_showcase_initialized) {
                    variable_showcase_initialized = true;
                    $(document).on('click', '#variable_showcase_prev', function() {
                        if (variable_showcase_page > 0) {
                            variable_showcase_page--;
                            loadVariableShowcase(false);
                        }
                    });
                    $(document).on('click', '#variable_showcase_next', function() {
                        variable_showcase_page++;
                        loadVariableShowcase(false);
                    });
                    $(document).on('keyup', '#variable_showcase_search', function() {
                        clearTimeout(variable_showcase_search_timer);
                        variable_showcase_search_timer = setTimeout(function() {
                            loadVariableShowcase(true);
                        }, 350);
                    });
                }
                loadVariableShowcase(true);
            }

            if ($(e.target).attr('href') == '#product_stock_report') {
                if (!data_table_initailized) {
                    var $stockReportTable = $('#stock_report_table');
                    var stock_report_cols = [
                        { data: 'action', name: 'action', searchable: false, orderable: false },
                        { data: 'sku', name: 'variations.sub_sku' },
                        { data: 'product', name: 'p.name' },
                    ];
                    if ($stockReportTable.find('th.other_product_name').length) {
                        stock_report_cols.push({ data: 'other_name', name: 'p.other_name' });
                    }
                    if ($stockReportTable.find('th.stock-report-variation').length) {
                        stock_report_cols.push({ data: 'variation', name: 'variation' });
                    }
                    if ($stockReportTable.find('th.stock-report-category').length) {
                        stock_report_cols.push({ data: 'category_name', name: 'c.name' });
                    }
                    if ($stockReportTable.find('th.stock-report-sub-category').length) {
                        stock_report_cols.push({ data: 'sub_category_name', name: 'sub_category_name', searchable: false });
                    }
                    if ($stockReportTable.find('th.stock-report-sub2-category').length) {
                        stock_report_cols.push({ data: 'sub2_category_name', name: 'sub2_category_name', searchable: false });
                    }
                    if ($stockReportTable.find('th.stock-report-brand').length) {
                        stock_report_cols.push({ data: 'brand_name', name: 'brand_name', searchable: false });
                    }
                    if ($stockReportTable.find('th.stock-report-sub-brand').length) {
                        stock_report_cols.push({ data: 'sub_brand_name', name: 'sub_brand_name', searchable: false });
                    }
                    if ($stockReportTable.find('th.stock-report-gender').length) {
                        stock_report_cols.push({ data: 'gender_name', name: 'gender_name', searchable: false });
                    }
                    if ($stockReportTable.find('th.stock-report-sub-gender').length) {
                        stock_report_cols.push({ data: 'sub_gender_name', name: 'sub_gender_name', searchable: false });
                    }
                    if ($stockReportTable.find('th.stock-report-procurement-source').length) {
                        stock_report_cols.push({ data: 'procurement_source_name', name: 'procurement_source_name', searchable: false });
                    }
                    if ($stockReportTable.find('th.stock-report-sub-procurement-source').length) {
                        stock_report_cols.push({ data: 'sub_procurement_source_name', name: 'sub_procurement_source_name', searchable: false });
                    }
                    stock_report_cols.push(
                        { data: 'location_name', name: 'l.name' },
                        { data: 'cost_price', name: 'cost_price' },
                        { data: 'unit_price', name: 'variations.sell_price_inc_tax' },
                        { data: 'stock', name: 'stock', searchable: false }
                    );
                    if ($stockReportTable.find('th.stock_price').length) {
                        stock_report_cols.push({
                            data: 'stock_price',
                            name: 'stock_price',
                            searchable: false
                        });
                    }
                    if ($stockReportTable.find('th.stock_value_by_sale_price').length) {
                        stock_report_cols.push({
                            data: 'stock_value_by_sale_price',
                            name: 'stock_value_by_sale_price',
                            searchable: false,
                            orderable: false
                        });
                    }
                    if ($stockReportTable.find('th.potential_profit').length) {
                        stock_report_cols.push({
                            data: 'potential_profit',
                            name: 'potential_profit',
                            searchable: false,
                            orderable: false
                        });
                    }

                    stock_report_cols.push({
                        data: 'total_sold',
                        name: 'total_sold',
                        searchable: false
                    });
                    stock_report_cols.push({
                        data: 'total_transfered',
                        name: 'total_transfered',
                        searchable: false
                    });
                    stock_report_cols.push({
                        data: 'total_adjusted',
                        name: 'total_adjusted',
                        searchable: false
                    });
                    stock_report_cols.push( {
                        data: 'rack_details',
                        name: 'rack_details'
                    });
                    if ($stockReportTable.find('th.product_custom_field1').length) {
                        stock_report_cols.push({
                            data: 'product_custom_field1',
                            name: 'p.product_custom_field1'
                        });
                    }
                    if ($stockReportTable.find('th.product_custom_field2').length) {
                        stock_report_cols.push({
                            data: 'product_custom_field2',
                            name: 'p.product_custom_field2'
                        });
                    }
                    if ($stockReportTable.find('th.product_custom_field3').length) {
                        stock_report_cols.push({
                            data: 'product_custom_field3',
                            name: 'p.product_custom_field3'
                        });
                    }
                    if ($stockReportTable.find('th.product_custom_field4').length) {
                        stock_report_cols.push({
                            data: 'product_custom_field4',
                            name: 'p.product_custom_field4'
                        });
                    }
                    if ($stockReportTable.find('th.product_custom_field5').length) {
                        stock_report_cols.push({
                            data: 'product_custom_field5',
                            name: 'p.product_custom_field5'
                        });
                    }
                    if ($stockReportTable.find('th.product_custom_field6').length) {
                        stock_report_cols.push({
                            data: 'product_custom_field6',
                            name: 'p.product_custom_field6'
                        });
                    }
                    if ($stockReportTable.find('th.product_custom_field7').length) {
                        stock_report_cols.push({
                            data: 'product_custom_field7',
                            name: 'p.product_custom_field7'
                        });
                    }
                    if ($stockReportTable.find('th.product_custom_field8').length) {
                        stock_report_cols.push({
                            data: 'product_custom_field8',
                            name: 'p.product_custom_field8'
                        });
                    }

                    if ($stockReportTable.find('th.current_stock_mfg').length) {
                        stock_report_cols.push({
                            data: 'total_mfg_stock',
                            name: 'total_mfg_stock',
                            searchable: false
                        });
                    }
                    stock_report_table = $('#stock_report_table').DataTable({
                        order: [
                            [1, 'asc']
                        ],
                        processing: true,
                        serverSide: true,
                        scrollY: "75vh",
                        scrollX: true,
                        scrollCollapse: true,
                        ajax: {
                            url: '/reports/stock-report',
                            data: function(d) {
                                d.location_id = $('#location_id').val();
                                d.supplier_id = $('#product_list_filter_supplier_id').val();
                                d.category_id = $('#product_list_filter_category_id').val();
                                d.sub_category_id = $('#product_list_filter_sub_category_id').val();
                                d.sub2_category_id = $('#product_list_filter_sub2_category_id').val();
                                d.brand_id = $('#product_list_filter_brand_id').val();
                                d.sub_brand_id = $('#product_list_filter_sub_brand_id').val();
                                d.gender_id = $('#product_list_filter_gender_id').val();
                                d.sub_gender_id = $('#product_list_filter_sub_gender_id').val();
                                d.procurement_source_id = $('#product_list_filter_procurement_source_id').val();
                                d.sub_procurement_source_id = $('#product_list_filter_sub_procurement_source_id').val();
                                d.unit_id = $('#product_list_filter_unit_id').val();
                                d.sub_unit_id = $('#product_list_filter_sub_unit_id').val();
                                d.variation_template_id = $('#product_list_filter_variation_template_id').val();
                                d.tax_id = $('#product_list_filter_tax_id').val();
                                d.tax_type = $('#product_list_filter_tax_type').val();
                                d.type = $('#product_list_filter_type').val();
                                d.active_state = $('#active_state').val();
                                d.not_for_selling = $('#not_for_selling').is(':checked');
                                if ($('#repair_model_id').length == 1) {
                                    d.repair_model_id = $('#repair_model_id').val();
                                }
                                d.show_positive_quantity = $('#show_positive_quantity').length && $('#show_positive_quantity').is(':checked') ? 1 : 0;
                                d.show_negative_quantity = $('#show_negative_quantity').length && $('#show_negative_quantity').is(':checked') ? 1 : 0;
                                d.show_zero_quantity = $('#show_zero_quantity').length && $('#show_zero_quantity').is(':checked') ? 1 : 0;
                                d.show_without_history = $('#show_without_history').length && $('#show_without_history').is(':checked') ? 1 : 0;
                                d.show_price_exc_tax = $('#show_price_exc_tax').length && $('#show_price_exc_tax').is(':checked') ? 1 : 0;
                            }
                        },
                        columns: stock_report_cols,
                        fnDrawCallback: function(oSettings) {
                            __currency_convert_recursively($('#stock_report_table'));
                        },
                        "footerCallback": function(row, data, start, end, display) {
                            var footer_total_stock = 0;
                            var footer_total_sold = 0;
                            var footer_total_transfered = 0;
                            var total_adjusted = 0;
                            var total_stock_price = 0;
                            var footer_stock_value_by_sale_price = 0;
                            var total_potential_profit = 0;
                            var footer_total_mfg_stock = 0;
                            for (var r in data) {
                                footer_total_stock += $(data[r].stock).data('orig-value') ?
                                    parseFloat($(data[r].stock).data('orig-value')) : 0;

                                footer_total_sold += $(data[r].total_sold).data('orig-value') ?
                                    parseFloat($(data[r].total_sold).data('orig-value')) : 0;

                                footer_total_transfered += $(data[r].total_transfered).data(
                                        'orig-value') ?
                                    parseFloat($(data[r].total_transfered).data('orig-value')) : 0;

                                total_adjusted += $(data[r].total_adjusted).data('orig-value') ?
                                    parseFloat($(data[r].total_adjusted).data('orig-value')) : 0;

                                total_stock_price += $(data[r].stock_price).data('orig-value') ?
                                    parseFloat($(data[r].stock_price).data('orig-value')) : 0;

                                footer_stock_value_by_sale_price += $(data[r].stock_value_by_sale_price)
                                    .data('orig-value') ?
                                    parseFloat($(data[r].stock_value_by_sale_price).data(
                                        'orig-value')) : 0;

                                total_potential_profit += $(data[r].potential_profit).data(
                                        'orig-value') ?
                                    parseFloat($(data[r].potential_profit).data('orig-value')) : 0;

                                footer_total_mfg_stock += $(data[r].total_mfg_stock).data(
                                        'orig-value') ?
                                    parseFloat($(data[r].total_mfg_stock).data('orig-value')) : 0;
                            }

                            $('.footer_total_stock').html(__currency_trans_from_en(footer_total_stock,
                                false));
                            $('.footer_total_stock_price').html(__currency_trans_from_en(
                                total_stock_price));
                            $('.footer_total_sold').html(__currency_trans_from_en(footer_total_sold,
                                false));
                            $('.footer_total_transfered').html(__currency_trans_from_en(
                                footer_total_transfered, false));
                            $('.footer_total_adjusted').html(__currency_trans_from_en(total_adjusted,
                                false));
                            $('.footer_stock_value_by_sale_price').html(__currency_trans_from_en(
                                footer_stock_value_by_sale_price));
                            $('.footer_potential_profit').html(__currency_trans_from_en(
                                total_potential_profit));
                            if ($('th.current_stock_mfg').length) {
                                $('.footer_total_mfg_stock').html(__currency_trans_from_en(
                                    footer_total_mfg_stock, false));
                            }
                        },
                    });
                    data_table_initailized = true;
                } else {
                    stock_report_table.ajax.reload();
                }
            } else {
                product_table.ajax.reload();
            }
        });

        $(document).on('click', '.update_product_location', function(e) {
            e.preventDefault();
            var selected_rows = getSelectedRows();

            if (selected_rows.length > 0) {
                $('input#selected_products').val(selected_rows);
                var type = $(this).data('type');
                var modal = $('#edit_product_location_modal');
                if (type == 'add') {
                    modal.find('.remove_from_location_title').addClass('hide');
                    modal.find('.add_to_location_title').removeClass('hide');
                } else if (type == 'remove') {
                    modal.find('.add_to_location_title').addClass('hide');
                    modal.find('.remove_from_location_title').removeClass('hide');
                }

                modal.modal('show');
                modal.find('#product_location').select2({
                    dropdownParent: modal
                });
                modal.find('#product_location').val('').change();
                modal.find('#update_type').val(type);
                modal.find('#products_to_update_location').val(selected_rows);
            } else {
                $('input#selected_products').val('');
                swal('<?php echo app('translator')->get('lang_v1.no_row_selected'); ?>');
            }
        });

        $(document).on('click', '#downloadStockReportExcel', function(e) {
            e.preventDefault();
            console.log($(this).attr('data-href'));
            let href = $(this).attr('data-href');
            let location_id = $('#location_id').val();
            let category_id = $('#product_list_filter_category_id').val();
            let brand_id = $('#product_list_filter_brand_id').val();
            let unit_id = $('#product_list_filter_unit_id').val();
            let type = $('#product_list_filter_type').val();
            let tax_type = $('#product_list_filter_tax_type').val();
            let active_state = $('#active_state').val();
            let not_for_selling = $('#not_for_selling').is(':checked');
            if ($('#repair_model_id').length == 1) {
                let repair_model_id = $('#repair_model_id').val();
            }
            let show_positive_quantity = $('#show_positive_quantity').length && $('#show_positive_quantity').is(':checked') ? 1 : 0;
            let show_negative_quantity = $('#show_negative_quantity').length && $('#show_negative_quantity').is(':checked') ? 1 : 0;
            let show_zero_quantity = $('#show_zero_quantity').length && $('#show_zero_quantity').is(':checked') ? 1 : 0;
            let show_without_history = $('#show_without_history').length && $('#show_without_history').is(':checked') ? 1 : 0;
            let show_price_exc_tax = $('#show_price_exc_tax').length && $('#show_price_exc_tax').is(':checked') ? 1 : 0;

            // Construct query parameters properly
            href += `?location_id=${location_id}&category_id=${category_id}&brand_id=${brand_id}&unit_id=${unit_id}&type=${type}&tax_type=${tax_type}&active_state=${active_state}&not_for_selling=${not_for_selling}&show_positive_quantity=${show_positive_quantity}&show_negative_quantity=${show_negative_quantity}&show_zero_quantity=${show_zero_quantity}&show_without_history=${show_without_history}&show_price_exc_tax=${show_price_exc_tax}`;
            
            if ($('#repair_model_id').length == 1) {
                href += '&repair_model_id=${repair_model_id}';
            }
            
            $(this).attr('href', href);

            // Proceed with the default click action
            window.location.href = href;
        });

        $(document).on('submit', 'form#edit_product_location_form', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();

            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                dataType: 'json',
                data: data,
                beforeSend: function(xhr) {
                    __disable_submit_button(form.find('button[type="submit"]'));
                },
                success: function(result) {
                    if (result.success == true) {
                        $('div#edit_product_location_modal').modal('hide');
                        toastr.success(result.msg);
                        product_table.ajax.reload();
                        $('form#edit_product_location_form')
                            .find('button[type="submit"]')
                            .attr('disabled', false);
                    } else {
                        toastr.error(result.msg);
                    }
                },
            });
        });

        //Product Search Screen Functonality for POS
        $(document).on('click', '#ps_select_products', function(e){
            e.preventDefault();
            if($('#products_search_results .ps-row-select:focus').length){
                let sku = $('#products_search_results .ps-row-select:focus').data('product-sku');
                $('#products_search_modal').modal('hide');
                $('#product_table_wrapper input[type=search]').val(sku).trigger('keyup');
                $('#variable_showcase_search').val(sku);
                if ($('#variable_product_list_tab').hasClass('active') && variable_showcase_initialized) {
                    loadVariableShowcase(true);
                }
                $('#stock_report_table_wrapper input[type=search]').val(sku).trigger('keyup');
            }else{
                toastr.error('No products selected');
            }
        });

        $(document).on('dblclick', '#products_search_results tbody tr', function () {
            let sku = $(this).find('.ps-row-select').data('product-sku');
            $('#products_search_modal').modal('hide');
            $('#product_table_wrapper input[type=search]').val(sku).trigger('keyup');
            $('#variable_showcase_search').val(sku);
            if ($('#variable_product_list_tab').hasClass('active') && variable_showcase_initialized) {
                loadVariableShowcase(true);
            }
            $('#stock_report_table_wrapper input[type=search]').val(sku).trigger('keyup');
        });

        function initProductSearch(element, dropdownParent = $('body')) {
            element.select2({
                ajax: {
                    url: '/products/list',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term, // search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function (value, key) {
                                var name = value.type == 'variable' ? value.name + ' - ' + value.variation : value.name;
                                name += ' (' + value.sub_sku + ')';
                                return {
                                    id: value.variation_id,
                                    text: name
                                }
                            })
                        };
                    },
                },
                minimumInputLength: 1,
                escapeMarkup: function(markup) {
                    return markup;
                },
                dropdownParent: dropdownParent
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>