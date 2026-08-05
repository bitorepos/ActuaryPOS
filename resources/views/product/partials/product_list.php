<?php 
    $colspan = 10;
    $custom_labels = json_decode(session('business.custom_labels'), true);
    $show_pct_code_column = !empty(session('business.enable_pct_code'));
    $colspan -= $show_pct_code_column ? 0 : 1;
?>
<div class="table-responsive" style="width:100%">
<table class="table table-bordered table-striped ajax_view hide-footer table-th-skin" id="product_table">
    <thead>
        <tr>
            <th><input type="checkbox" id="select-all-row" data-table-id="product_table"></th>
            <th>&nbsp;</th>
            <th><?php echo app('translator')->get('messages.action'); ?></th>
            <?php if(empty($user_settings['product_index_hide_product_type'])): ?>
            <th><?php echo app('translator')->get('product.product_type'); ?></th>
            <?php endif; ?>
            <th><?php echo app('translator')->get('product.sku'); ?></th>
            <th style="width:350px"><?php echo app('translator')->get('sale.product'); ?></th>
            <?php if($common_settings['enable_other_product_name']): ?>
            <th style="width:350px"><?php echo e(!empty($common_settings['other_product_name_label']) ? $common_settings['other_product_name_label'] . ':': __('product.other_product_name') . ':', false); ?></th>
            <?php endif; ?>
            <?php if(session('business.enable_category') && empty($user_settings['product_index_hide_category'])): ?>
            <th><?php echo app('translator')->get('product.category'); ?></th>
            <?php endif; ?>
            <?php if(session('business.enable_sub_category') && empty($user_settings['product_index_hide_category'])): ?>
            <th><?php echo app('translator')->get('product.sub_category'); ?></th>
            <?php endif; ?>
            <?php if(session('business.enable_sub2_category') && empty($user_settings['product_index_hide_category'])): ?>
            <th><?php echo app('translator')->get('product.sub2_category'); ?></th>
            <?php endif; ?>
            <?php if(empty($user_settings['product_index_hide_brand'])): ?>
            <th><?php echo app('translator')->get('product.brand'); ?></th>
            <?php endif; ?>
            <?php if(session('business.enable_gender') && empty($user_settings['product_index_hide_gender'])): ?>
            <th><?php echo app('translator')->get('product.gender'); ?></th>
            <?php endif; ?>
            <?php if(session('business.enable_procurement_source') && empty($user_settings['product_index_hide_procurement_source'])): ?>
            <th><?php echo app('translator')->get('product.procurement_source'); ?></th>
            <?php endif; ?>
            <?php if(empty($user_settings['product_index_hide_tax'])): ?>
            <th><?php echo app('translator')->get('product.tax'); ?></th>
            <th>Tax Type</th>
            <?php endif; ?>
            <?php if($show_pct_code_column): ?>
            <th><?php echo app('translator')->get('lang_v1.pct_code'); ?></th>
            <?php endif; ?>
            <?php if(empty($user_settings['product_index_hide_business_location'])): ?>
            <th><?php echo app('translator')->get('purchase.business_location'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.product_business_location_tooltip') . '"></i>';
                }
            ?></th>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_purchase_price')): ?>
                <?php if(empty($user_settings['product_index_hide_unit_purchase_price'])): ?>
                <?php 
                    $colspan++;
                ?>
                <th><?php echo app('translator')->get('lang_v1.unit_perchase_price'); ?></th>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access_default_selling_price')): ?>
                <?php if(empty($user_settings['product_index_hide_selling_price'])): ?>
                <?php 
                    $colspan++;
                ?>
                <th><?php echo app('translator')->get('lang_v1.selling_price'); ?></th>
                <?php endif; ?>
            <?php endif; ?>
            <?php if($user_settings['ps_show_price_group']): ?>
                <?php 
                    $colspan++;
                ?>
                <th><?php echo app('translator')->get('lang_v1.price_group'); ?></th>
            <?php endif; ?>
            <?php if(empty($user_settings['product_index_hide_current_stock'])): ?>
            <th><?php echo app('translator')->get('report.current_stock'); ?></th>
            <?php endif; ?>
            <?php if(!empty($common_settings['enable_delivery_notes'])): ?>
            <th>Held Quantity</th>
            <?php endif; ?>
            <?php if($common_settings['enable_kot_printer_prepration_time']): ?>
            <th>Printer Name</th>
            <?php endif; ?>
            <?php if(!empty($custom_labels['product']['custom_field_1'])): ?>
            <th><?php echo e($custom_labels['product']['custom_field_1'], false); ?></th>
            <?php endif; ?>
            <?php if(!empty($custom_labels['product']['custom_field_2'])): ?>
            <th><?php echo e($custom_labels['product']['custom_field_2'], false); ?></th>
            <?php endif; ?>
            <?php if(!empty($custom_labels['product']['custom_field_3'])): ?>
            <th><?php echo e($custom_labels['product']['custom_field_3'], false); ?></th>
            <?php endif; ?>
            <?php if(!empty($custom_labels['product']['custom_field_4'])): ?>
            <th><?php echo e($custom_labels['product']['custom_field_4'], false); ?></th>
            <?php endif; ?>
            <?php if(!empty($custom_labels['product']['custom_field_5'])): ?>
            <th><?php echo e($custom_labels['product']['custom_field_5'], false); ?></th>
            <?php endif; ?>
            <?php if(!empty($custom_labels['product']['custom_field_6'])): ?>
            <th><?php echo e($custom_labels['product']['custom_field_6'], false); ?></th>
            <?php endif; ?>
            <?php if(!empty($custom_labels['product']['custom_field_7'])): ?>
            <th><?php echo e($custom_labels['product']['custom_field_7'], false); ?></th>
            <?php endif; ?>
            <?php if(!empty($custom_labels['product']['custom_field_8'])): ?>
            <th><?php echo e($custom_labels['product']['custom_field_8'], false); ?></th>
            <?php endif; ?>
            <?php if(empty($user_settings['product_index_hide_created_at'])): ?>
            <th>Created at</th>
            <?php endif; ?>
            <?php if(empty($user_settings['product_index_hide_updated_at'])): ?>
            <th>Updated at</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td colspan="<?php echo e($colspan, false); ?>">
            <div style="display: flex; width: 100%;">
                <?php if(!$is_offline): ?>
                
                    <?php if(!$offline_module): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.delete')): ?>
                        <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'massDestroy']), 'method' => 'post', 'id' => 'mass_delete_form' ]); ?>

                        <?php echo Form::hidden('selected_rows', null, ['id' => 'selected_rows']); ?>

                        <?php echo Form::submit(__('lang_v1.delete_selected'), array('class' => 'btn btn-sm btn-danger', 'id' => 'delete-selected')); ?>

                        <?php echo Form::close(); ?>

                    <?php endif; ?>
                    <?php endif; ?>

                
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.update')): ?>
                    
                        <?php if(config('constants.enable_product_bulk_edit')): ?>
                            &nbsp;
                            <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'bulkEdit']), 'method' => 'post', 'id' => 'bulk_edit_form' ]); ?>

                            <?php echo Form::hidden('selected_products', null, ['id' => 'selected_products_for_edit']); ?>

                            <button type="submit" class="btn btn-sm btn-primary" id="edit-selected"> <i class="fa fa-edit"></i><?php echo e(__('lang_v1.bulk_edit'), false); ?></button>
                            <?php echo Form::close(); ?>

                        <?php endif; ?>
                        &nbsp;
                        <button type="button" class="btn btn-sm btn-success update_product_location" data-type="add"><?php echo app('translator')->get('lang_v1.add_to_location'); ?></button>
                        &nbsp;
                        <button type="button" class="btn btn-sm bg-navy update_product_location" data-type="remove"><?php echo app('translator')->get('lang_v1.remove_from_location'); ?></button>
                        &nbsp;
                        <button type="button" class="btn btn-sm btn-warning merge_products"><?php echo app('translator')->get('lang_v1.merge_products'); ?></button>
                        &nbsp;
                        <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'massReactivate']), 'method' => 'post', 'id' => 'mass_reactivate_form' ]); ?>

                        <?php echo Form::hidden('selected_products', null, ['id' => 'selected_products']); ?>

                        <?php echo Form::submit(__('lang_v1.reactivate_selected'), array('class' => 'btn btn-sm btn-info', 'id' => 'reactivate-selected')); ?>

                        <?php echo Form::close(); ?>

                        &nbsp;
                        <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'massDeactivate']), 'method' => 'post', 'id' => 'mass_deactivate_form' ]); ?>

                        <?php echo Form::hidden('selected_products', null, ['id' => 'selected_products']); ?>

                        <?php echo Form::submit(__('lang_v1.deactivate_selected'), array('class' => 'btn btn-sm btn-warning', 'id' => 'deactivate-selected')); ?>

                        <?php echo Form::close(); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.deactive_product_tooltip') . '"></i>';
                }
            ?>
                        &nbsp;
                    <?php endif; ?>
                <?php if($is_woocommerce): ?>
                    <button type="button" class="btn btn-sm btn-warning toggle_woocomerce_sync">
                        <?php echo app('translator')->get('lang_v1.woocommerce_sync'); ?>
                    </button>
                <?php endif; ?>
                <?php endif; ?>
                &nbsp;
                <button type="button" class="btn btn-sm btn-secondary" id="bulk-print-labels" style="background-color:#8e44ad;color:#fff;">
                    <i class="fa fa-barcode"></i> <?php echo app('translator')->get('barcode.print_labels'); ?>
                </button>
                &nbsp;
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product.update')): ?>
                <button type="button" class="btn btn-sm btn-default" id="stock-maintenance-btn" style="background-color:#17a589;color:#fff;">
                    <i class="fa fa-tools"></i> Stock Maintenance
                </button>
                <?php endif; ?>
                </div>
            </td>
        </tr>
    </tfoot>
</table>
</div>
