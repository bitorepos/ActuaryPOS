<?php
    $variation_name = !empty($variation_name) ? $variation_name : null;
    $variation_value_id = !empty($variation_value_id) ? $variation_value_id : null;
    if(!empty($group_name)){
        $variation_name = implode('-', $group_name);
    }
    $name = (empty($row_type) || $row_type == 'add') ? 'product_variation' : 'product_variation_edit';

    $readonly = !empty($variation_value_id) ? 'readonly' : '';
    // $sub_sku = !empty($row_sku) ? str_pad($row_sku, 2, '0', STR_PAD_LEFT) : null;
    $sub_sku = null;
    $variation_unit_id = !empty($variation_unit_id) ? $variation_unit_id : null;
    $variation_sub_unit_ids = !empty($variation_sub_unit_ids) ? $variation_sub_unit_ids : [];
?>

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
    $is_variation_value_hidden = !empty($variation_value_id) ? 1 : 0;
?>

<tr <?php if(!empty($variation_value_id)): ?> 
        data-variation_value_id="<?php echo e($variation_value_id, false); ?>" 
        class="variation_value_row hide" 
    <?php endif; ?>>
    <td>
        <?php echo Form::text($name . '[' . $variation_index . '][variations][' . $value_index . '][sub_sku]', $sub_sku, ['class' => 'form-control input-sm input_sub_sku']); ?>

        <?php echo Form::hidden($name . '[' . $variation_index . '][variations][' . $value_index . '][is_hidden]', 
            $is_variation_value_hidden , ['class' => 'is_variation_value_hidden']); ?>


        <?php echo Form::hidden($name . '[' . $variation_index . '][variations][' . $value_index . '][variation_value_id]', $variation_value_id); ?>

        <?php if(!empty($group)): ?>
        <?php echo Form::hidden($name . '[' . $variation_index . '][variations][' . $value_index . '][group_variation_value_ids]', json_encode($group), ['class' => 'group_variation_value_ids_hidden']); ?>

        <?php endif; ?>
    </td>
    <td>
        <?php echo Form::text($name . '[' . $variation_index . '][variations][' . $value_index . '][value]', $variation_name, ['class' => 'form-control input-sm variation_value_name', 'required', $readonly]); ?>

    </td>
    <?php if(session('business.enable_sub_units')): ?>
    <td>
        <?php echo Form::select($name . '[' . $variation_index . '][variations][' . $value_index . '][variation_unit_id]',
           !empty($units) ? $units : [], $variation_unit_id, [ 'class' => 'form-select select2 width-100 input-sm variation_unit_id', 'style' => 'width:100%;', 'placeholder' => __('messages.please_select')],
        ); ?>

    </td>
    <td>
        <?php echo Form::select($name . '[' . $variation_index . '][variations][' . $value_index . '][variation_sub_unit_ids][]',
           !empty($sub_units) ? $sub_units : [], $variation_sub_unit_ids, [ 'class' => 'form-select select2 width-100 input-sm variation_sub_unit_ids', 'style' => 'width:100%;', 'multiple', 'data-placeholder' => __('messages.please_select')],
        ); ?>

    </td>
    <?php endif; ?>
    <td class="<?php echo e($class, false); ?>">
        <div class="width-100 f-left">
            <div class="input-group width-100">
                <?php echo Form::text($name . '[' . $variation_index . '][variations][' . $value_index . '][default_purchase_price]', $default, ['class' => 'form-control input-sm variable_dpp input_number', 'placeholder' => $has_taxes ? __('product.exc_of_tax') : '' , 'required']); ?>

                <?php if(!$has_taxes): ?>
                    <?php if($value_index == 0): ?>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-bs-toggle="tooltip" title="<?php echo app('translator')->get('lang_v1.apply_all'); ?>" data-target-class=".variable_dpp_inc_tax"><i class="fas fa-check-double"></i></button>
                        </span>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="width-100 hidden f-left">
            <div class="input-group width-100">
                <?php echo Form::text($name . '[' . $variation_index . '][variations][' . $value_index . '][dpp_inc_tax]', $default, ['class' => 'form-control input-sm variable_dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); ?>

                <?php if($value_index == 0): ?>
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-bs-toggle="tooltip" title="<?php echo app('translator')->get('lang_v1.apply_all'); ?>" data-target-class=".variable_dpp_inc_tax"><i class="fas fa-check-double"></i></button>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </td>
    <td class="<?php echo e($class, false); ?>">
        <div class="input-group">
            <?php echo Form::hidden($name . '[' . $variation_index . '][variations][' . $value_index . '][profit_percent_uf]', $profit_percent, ['class' => 'variable_profit_percent_uf', 'required']); ?>

            <?php echo Form::text($name . '[' . $variation_index . '][variations][' . $value_index . '][profit_percent]', $profit_percent, ['class' => 'form-control input-sm variable_profit_percent input_number', 'required']); ?>

            <?php if($value_index == 0): ?>
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-bs-toggle="tooltip" title="<?php echo app('translator')->get('lang_v1.apply_all'); ?>" data-target-class=".variable_profit_percent"><i class="fas fa-check-double"></i></button>
                </span>
            <?php endif; ?>
        </div>
    </td>
    <td class="<?php echo e($class, false); ?>">
        <?php echo Form::text($name . '[' . $variation_index . '][variations][' . $value_index . '][default_sell_price]', $default, ['class' => 'form-control input-sm variable_dsp input_number', 'placeholder' => $has_taxes ? __('product.exc_of_tax') : '', 'required']); ?>

        <span class="hidden">
        <?php echo Form::text($name . '[' . $variation_index . '][variations][' . $value_index . '][sell_price_inc_tax]', $default, ['class' => 'form-control input-sm variable_dsp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); ?>

        </span>
    </td>
    <?php if(!empty($common_settings['enable_product_image'])): ?>
    <td><?php echo Form::file('variation_images_' . $variation_index . '_' . $value_index . '[]', ['class' => 
        'variation_images', 'accept' => 'image/*', 'multiple']); ?></td>
    <?php endif; ?>
    <td style="width: 3%;">
        <button type="button" class="btn btn-danger btn-sm remove_variation_value_row">-</button>
        <input type="hidden" class="variation_row_index" value="<?php echo e($value_index, false); ?>">
    </td>
</tr>
