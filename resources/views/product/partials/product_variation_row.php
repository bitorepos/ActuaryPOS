
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

<tr class="variation_row">
    <td>
        <div class="d-flex flex-column align-items-start gap-2">
            <?php echo Form::select('product_variation[' . $row_index .'][variation_template_id]', $variation_templates, null, ['class' => 'form-select input-sm variation_template', 'required', 'style' => 'width: 100%;']); ?>

            <input type="hidden" class="row_index" value="<?php echo e($row_index, false); ?>">
            <div class="form-group variation_template_values_div mt-15 hide w-100">
                <label><?php echo app('translator')->get('lang_v1.select_variation_values'); ?></label>
                <br>
                <?php echo Form::select('product_variation[' . $row_index .'][variation_template_values][]', [], null, ['class' => 'form-select input-sm variation_template_values', 'multiple', 'style' => 'width: 100%;']); ?>

            </div>
            <span class="variation_template_group_value_selects w-100">
                <div class="form-group variation_template_group_values_div mt-15 hide">        
                    <label><span class="variation_sub_template_label"></span><?php echo app('translator')->get('lang_v1.select_variation_values'); ?></label><br>
                    <?php echo Form::select('product_variation[' . $row_index .'][variation_template_group_values][]', [], null, ['class' => 'form-select input-sm variation_template_group_values', 'multiple', 'style' => 'width: 100%;']); ?>

                </div>
            </span>
            <div class="form-group variation_template_group_values_div mt-15 hide">
                <button type="button" class="btn btn-md btn-outline btn-primary generate_group_variations"><?php echo app('translator')->get('lang_v1.generate_variations'); ?></button>
            </div>
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
                    <!-- &nbsp;&nbsp;<b><i class="fa fa-info-circle" aria-hidden="true" data-bs-toggle="popover" data-html="true" data-trigger="hover" data-content="<p class='text-primary'>Drag the mouse over the table cells to copy input values</p>" data-placement="top"></i></b> -->
                </th>
                <?php if(!empty($common_settings['enable_product_image'])): ?>
                <th style="width: 15%;"><?php echo app('translator')->get('lang_v1.variation_images'); ?></th>
                <?php endif; ?>
                <th style="width: 5%;"><button type="button" class="btn btn-success btn-sm add_variation_value_row">+</button></th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>
                    <?php echo Form::text('product_variation[' . $row_index .'][variations][0][sub_sku]', null, ['class' => 'form-control input-sm']); ?>

                </td>
                <td>
                    <?php echo Form::text('product_variation[' . $row_index .'][variations][0][value]', null, ['class' => 'form-control input-sm variation_value_name', 'required']); ?>

                </td>
                <?php if(session('business.enable_sub_units')): ?>
                <td>
                    <?php echo Form::select('product_variation[' . $row_index .'][variations][0][variation_unit_id]',
                        !empty($units) ? $units : [], !empty($variation_unit_id) ? $variation_unit_id : null, ['class' => 'form-select select2 width-100 input-sm variation_unit_id', 'style' => 'width:100%;', 'placeholder' => __('messages.please_select')]); ?>

                </td>
                <td>
                    <?php echo Form::select('product_variation[' . $row_index .'][variations][0][variation_sub_unit_ids][]',
                        !empty($sub_units) ? $sub_units : [], !empty($variation_sub_unit_ids) ? $variation_sub_unit_ids : null, ['class' => 'form-select select2 width-100 input-sm variation_sub_unit_ids', 'style' => 'width:100%;', 'multiple', 'data-placeholder' => __('messages.please_select')]); ?>

                </td>
                <?php endif; ?>
                <td class="<?php echo e($class, false); ?>">
                    <div class="width-100 f-left">
                        <div class="input-group width-100">
                            <?php echo Form::text('product_variation[' . $row_index .'][variations][0][default_purchase_price]', $default, ['class' => 'form-control input-sm variable_dpp input_number', 'placeholder' => $has_taxes ? __('product.exc_of_tax') : '', 'required']); ?>

                            <?php if(!$has_taxes): ?>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-bs-toggle="tooltip" title="<?php echo app('translator')->get('lang_v1.apply_all'); ?>" data-target-class=".variable_dpp_inc_tax"><i class="fas fa-check-double"></i></button>
                            </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="width-100 f-left hidden">
                        <div class="input-group width-100">
                            <?php echo Form::text('product_variation[' . $row_index .'][variations][0][dpp_inc_tax]', $default, ['class' => 'form-control input-sm variable_dpp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); ?>

                            
                                <button type="button" class="btn btn-secondary btn-flat apply-all btn-sm p-5-5" data-bs-toggle="tooltip" title="<?php echo app('translator')->get('lang_v1.apply_all'); ?>" data-target-class=".variable_dpp_inc_tax"><i class="fas fa-check-double"></i></button>
                            
                        </div>
                    </div>
                </td>
                <td class="<?php echo e($class, false); ?>">
                    <div class="input-group">
                        <?php echo Form::hidden('product_variation[' . $row_index .'][variations][0][profit_percent_uf]', $profit_percent, ['class' => 'variable_profit_percent_uf']); ?>

                        <?php echo Form::text('product_variation[' . $row_index .'][variations][0][profit_percent]', $profit_percent, ['class' => 'form-control input-sm variable_profit_percent input_number', 'required']); ?>

                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default bg-white btn-flat apply-all btn-sm p-5-5" data-bs-toggle="tooltip" title="<?php echo app('translator')->get('lang_v1.apply_all'); ?>" data-target-class=".variable_profit_percent"><i class="fas fa-check-double"></i></button>
                        </span>
                    </div>
                </td>
                <td class="<?php echo e($class, false); ?>">
                    <?php echo Form::text('product_variation[' . $row_index .'][variations][0][default_sell_price]', $default, ['class' => 'form-control input-sm variable_dsp input_number', 'placeholder' => $has_taxes ? __('product.exc_of_tax') : '', 'required']); ?>

                    <span class="hidden">
                    <?php echo Form::text('product_variation[' . $row_index .'][variations][0][sell_price_inc_tax]', $default, ['class' => 'form-control input-sm variable_dsp_inc_tax input_number', 'placeholder' => __('product.inc_of_tax'), 'required']); ?>

                    </span>
                </td>
                <?php if(!empty($common_settings['enable_product_image'])): ?>
                <td><?php echo Form::file('variation_images_' . $row_index .'_0[]', ['class' => 'variation_images', 
                    'accept' => 'image/*', 'multiple']); ?></td>
                <?php endif; ?>
                <td style="width: 3%;">
                    <button type="button" class="btn btn-danger btn-sm remove_variation_value_row">-</button>
                    <input type="hidden" class="variation_row_index" value="0">
                </td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
