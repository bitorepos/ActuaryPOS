<?php if(empty($common_settings['enable_prices'])): ?> 
    <?php
        $default = 0;
        $class = 'hide';
    ?>
<?php else: ?>
    <?php
        $default = null;
        $class = '';
    ?>
<?php endif; ?>

<?php
 $array_name = 'product_variation_edit';
 $variation_array_name = 'variations_edit';
 if($action == 'duplicate'){
    $array_name = 'product_variation';
    $variation_array_name = 'variations';
 }
?>

<tr class="variation_row">
    <td>
        <div class="d-flex flex-column align-items-start gap-2">
            <?php echo Form::text($array_name . '[' . $row_index .'][name]', $product_variation->name, ['class' => 'form-control input-sm variation_name', 'required', 'readonly', 'style' => 'width: 100%;']); ?>


            <?php echo Form::hidden($array_name . '[' . $row_index .'][variation_template_id]', $product_variation->variation_template_id); ?>


            <input type="hidden" class="row_index" value="<?php if($action == 'edit'): ?><?php echo e($row_index, false); ?><?php else: ?><?php echo e($loop->index, false); ?><?php endif; ?>">
            <input type="hidden" class="row_edit" value="edit">
        </div>
    </td>

    <td>
        <table class="table table-condensed table-bordered blue-header variation_value_table" style="width: 100%; table-layout: fixed;">
            <thead>
            <tr>
                <th style="width: 10%;"><?php echo app('translator')->get('product.sku'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.sub_sku') . '"></i>';
                }
            ?></th>
                <th style="<?php if(!empty($common_settings['enable_product_image'])): ?> width: 15%; <?php else: ?> width: 20%; <?php endif; ?>"><?php echo app('translator')->get('product.value'); ?></th>
                <?php if(session('business.enable_sub_units')): ?>
                <th style="width: 10%;"><?php echo app('translator')->get('product.unit'); ?></th>
                <th style="width: 15%;"><?php echo app('translator')->get('lang_v1.related_sub_units'); ?></th>
                <?php endif; ?>
                <th class="<?php echo e($class, false); ?>" style="width: 20%;"><?php echo app('translator')->get('product.purchase_price'); ?>
                </th>
                <th class="<?php echo e($class, false); ?>" style="width: 12%;"><?php echo app('translator')->get('product.profit_percent'); ?></th>
                <th class="<?php echo e($class, false); ?>" style="width: 18%;"><?php echo app('translator')->get('product.selling_price'); ?> 
                <br/>
                <small><i><span class="dsp_label"></span></i></small>
                </th>
                <?php if(!empty($common_settings['enable_product_image'])): ?>
                <th style="width: 15%;"><?php echo app('translator')->get('lang_v1.variation_images'); ?></th>
                <?php endif; ?>
                <th style="width: 3%;">
                    <?php if(!empty($product_variation->variation_template) && !$product_variation->variation_template->is_group): ?>
                    <button type="button" class="btn btn-success btn-sm add_variation_value_row">+</button>
                    <?php endif; ?>
                </th>
            </tr>
            </thead>

            <tbody>

            <?php $__empty_1 = true; $__currentLoopData = $product_variation->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $variation_row_index = $variation->id;
                    $sub_sku_required = 'required';
                    if($action == 'duplicate'){
                        $variation_row_index = $loop->index;
                        $sub_sku_required = '';
                    }
                ?>
                <tr>
                    <td>
                        <?php if($action != 'duplicate'): ?>
                            <input type="hidden" class="row_variation_id" value="<?php echo e($variation->id, false); ?>">
                        <?php endif; ?>
                        <?php echo Form::text($array_name . '[' . $row_index .'][' . $variation_array_name . '][' . $variation_row_index . '][sub_sku]', $action == 'edit' ? $variation->sub_sku : null, ['class' => 'form-control input-sm input_sub_sku', $sub_sku_required]); ?>

                    </td>
                    <td>
                        <?php echo Form::text($array_name . '[' . $row_index .'][' . $variation_array_name . '][' . $variation_row_index . '][value]', $variation->name, ['class' => 'form-control input-sm variation_value_name', 'required', 'readonly']); ?>

                        <?php echo Form::hidden($array_name . '[' . $row_index .'][' . $variation_array_name . '][' . $variation_row_index . '][variation_value_id]', $variation->variation_value_id); ?>

                        <?php if(!empty($variation->group_variation_value_ids)): ?>
                            <?php echo Form::hidden($array_name . '[' . $row_index . '][' . $variation_array_name . '][' . $variation_row_index . '][group_variation_value_ids]', json_encode($variation->group_variation_value_ids), ['class' => 'group_variation_value_ids_hidden']); ?>

                        <?php endif; ?>
                    </td>
                    <?php if(session('business.enable_sub_units')): ?>
                    <td>
                        <?php echo Form::select($array_name . '[' . $row_index . ']['.$variation_array_name.'][' . $variation_row_index . '][variation_unit_id]',
                        !empty($units) ? $units : [], !empty($variation->variation_unit_id) ? $variation->variation_unit_id : null,[ 'class' => 'form-select select2 width-100 input-sm variation_unit_id', 'style' => 'width:100%;', 'placeholder' => __('messages.please_select')],
                        ); ?>

                    </td>
                    <td>
                        <?php echo Form::select($array_name . '[' . $row_index . ']['.$variation_array_name.'][' . $variation_row_index . '][variation_sub_unit_ids][]',
                        !empty($sub_units) ? $sub_units : [], !empty($variation->variation_sub_unit_ids) ? (is_array($variation->variation_sub_unit_ids) ? $variation->variation_sub_unit_ids : json_decode($variation->variation_sub_unit_ids, true)) : [],[ 'class' => 'form-select select2 width-100 input-sm variation_sub_unit_ids', 'style' => 'width:100%;', 'multiple', 'data-placeholder' => __('messages.please_select')],
                        ); ?>

                    </td>
                    <?php endif; ?>
                    <td class="<?php echo e($class, false); ?>">
                        <div class="">
                            <?php echo Form::text($array_name . '[' . $row_index .'][' . $variation_array_name . '][' . $variation_row_index . '][default_purchase_price]', number_format($variation->default_purchase_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm variable_dpp input_number', 'placeholder' => $has_taxes ? __('product.exc_of_tax') : '', 'required', (!empty($purchase_exists) && empty($common_settings['enable_purchase_price_for_purchased'])) ? 'readonly' : '']); ?>

                        </div>
                        <div class="hidden">
                            <?php echo Form::text($array_name . '[' . $row_index .'][' . $variation_array_name . '][' . $variation_row_index . '][dpp_inc_tax]', number_format($variation->dpp_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm variable_dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required', (!empty($purchase_exists) && empty($common_settings['enable_purchase_price_for_purchased'])) ? 'readonly' : '']); ?>

                        </div>
                    </td>
                    <td class="<?php echo e($class, false); ?>">
                        <?php echo Form::hidden($array_name . '[' . $row_index .'][' . $variation_array_name . '][' . $variation_row_index . '][profit_percent_uf]', number_format($variation->profit_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'variable_profit_percent_uf']); ?>

                        <?php echo Form::text($array_name . '[' . $row_index .'][' . $variation_array_name . '][' . $variation_row_index . '][profit_percent]', number_format($variation->profit_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm variable_profit_percent input_number', 'required']); ?>

                    </td>
                    <td class="<?php echo e($class, false); ?>">
                        <?php echo Form::text($array_name . '[' . $row_index .'][' . $variation_array_name . '][' . $variation_row_index . '][default_sell_price]', number_format($variation->default_sell_price, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm variable_dsp input_number', 'placeholder' => $has_taxes ? __('product.exc_of_tax') : '', 'required']); ?>

                        <span class="hidden">
                        <?php echo Form::text($array_name . '[' . $row_index .'][' . $variation_array_name . '][' . $variation_row_index . '][sell_price_inc_tax]', number_format($variation->sell_price_inc_tax, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm variable_dsp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); ?>

                        </span>
                    </td>
                    <?php if(!empty($common_settings['enable_product_image'])): ?>
                    <td>
                        <?php 
                            $action = !empty($action) ? $action : '';
                        ?>
                        <?php if($action !== 'duplicate'): ?>
                            <?php $__currentLoopData = $variation->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="img-thumbnail">
                                    <span class="badge bg-red delete-media" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'deleteMedia'], ['media_id' => $media->id]), false); ?>"><i class="fas fa-times"></i></span>
                                    <?php echo $media->thumbnail(); ?>

                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php echo Form::file('edit_variation_images_' . $row_index . '_' . $variation_row_index . '[]',
                                 ['class' => 'variation_images', 'accept' => 'image/*', 'multiple']); ?>

                        <?php else: ?>
                            <?php echo Form::file('edit_variation_images_' . $row_index . '_' . $variation_row_index . '[]', 
                                ['class' => 'variation_images', 'accept' => 'image/*', 'multiple']); ?>

                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                    <td style="width: 3%;">
                        <button type="button" class="btn btn-danger btn-sm remove_variation_value_row">-</button>
                        <input type="hidden" class="variation_row_index" value="<?php if($action == 'duplicate'): ?><?php echo e($loop->index, false); ?><?php else: ?><?php echo e(0, false); ?><?php endif; ?>">
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                &nbsp;
            <?php endif; ?>
            </tbody>
        </table>
    </td>
</tr>
