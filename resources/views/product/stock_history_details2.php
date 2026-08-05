<div class="row">
    <div class="col-md-12">
        <h4><?php echo e($stock_details['variation'], false); ?></h4>
    </div>
    <div class="col-md-4 col-4 text-center">
        <strong><?php echo app('translator')->get('lang_v1.quantities_in'); ?></strong>
        <table class="table table-condensed">
            <tr>
                <th><?php echo app('translator')->get('report.total_purchase'); ?></th>
                <td>
                    <span class="display_currency" data-is_quantity="true"><?php echo e($stock_details['total_purchase'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.opening_stock'); ?></th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_opening_stock'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.total_sell_return'); ?></th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_sell_return'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.stock_transfers'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_purchase_transfer'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php if($show_manufacturing_data): ?>
            <tr>
                <th><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_manufactured'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
    <div class="col-md-4 col-4 text-center">
        <strong><?php echo app('translator')->get('lang_v1.quantities_out'); ?></strong>
        <table class="table table-condensed">
            <tr>
                <th><?php echo app('translator')->get('lang_v1.total_sold'); ?></th>
                <td>
                    <span class="display_currency" data-is_quantity="true"><?php echo e($stock_details['total_sold'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo app('translator')->get('report.total_stock_adjustment'); ?></th>
                <td>
                    <span class="display_currency" data-is_quantity="true"><?php echo e($stock_details['total_adjusted'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.total_purchase_return'); ?></th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_purchase_return'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>

            <tr>
                <th><?php echo app('translator')->get('lang_v1.stock_transfers'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_sell_transfer'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php if($show_manufacturing_data): ?>
            <tr>
                <th><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_ingredient'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="col-md-4 col-4 text-center">
        <strong><?php echo app('translator')->get('lang_v1.totals'); ?></strong>
        <table class="table table-condensed">
            <tr>
                <th><?php echo app('translator')->get('report.current_stock'); ?></th>
                <td>
                    <span class="display_currency" data-is_quantity="true"><?php echo e($stock_details['current_stock'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
        </table>
    </div>
    <?php if($show_manufacturing_data): ?>
    <div class="col-md-12 col-12">
        <button class="btn btn-sm btn-primary toggle_ingrdient_summary" type="button" data-bs-toggle="collapse" data-bs-target="#ingrdient_summary_table" aria-expanded="false" aria-controls="ingrdient_summary_table">
            <span class="fa fas fa-plus-circle"></span>
        </button>
        <strong><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> <?php echo app('translator')->get('lang_v1.summary'); ?> </strong> 
        <div class="collapse" id="ingrdient_summary_table">
            <table class="table table-condensed">
                <tr>
                    <th><?php echo app('translator')->get('product.sku'); ?></th>
                    <th><?php echo app('translator')->get('product.product_name'); ?></th>
                    <th><?php echo app('translator')->get('sale.qty'); ?></th>
                </tr>
                <?php
                    $ingredients = [];

                    foreach($stock_history as $history){
                        if($history['type_label'] == 'Ingredient'){
                            if(array_key_exists($history['mfg_product_sku'], $ingredients)){
                                $ingredients[$history['mfg_product_sku']]['qty'] += abs($history['quantity_change']);
                            }else{
                                $ingredients[$history['mfg_product_sku']] = [
                                    'name' => $history['mfg_product'],
                                    'qty' => abs($history['quantity_change']),
                                ];
                            }
                        }
                    }
                ?>
                <?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key, false); ?></td>
                    <td><?php echo e($value['name'], false); ?></td>
                    <td><span class="display_currency" data-is_quantity="true"><?php echo e($value['qty'], false); ?></span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
<div class="row">
	<div class="col-md-12">
		<hr>
		<div class="table-responsive">
<table class="table table-slim" id="stock_history_table">
			<thead>
			<tr>
				<th><?php echo app('translator')->get('lang_v1.date'); ?></th>
				<th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
				<th><?php echo app('translator')->get('lang_v1.type'); ?></th>
				<th><?php echo app('translator')->get('lang_v1.quantity_change'); ?></th>
				<?php if(!empty($common_settings['enable_secondary_unit'])): ?>
					<th><?php echo app('translator')->get('lang_v1.quantity_change'); ?> (<?php echo app('translator')->get('lang_v1.secondary_unit'); ?>)</th>
				<?php endif; ?>
				<th><?php echo app('translator')->get('lang_v1.new_quantity'); ?></th>
				<?php if(!empty($common_settings['enable_secondary_unit'])): ?>
					<th><?php echo app('translator')->get('lang_v1.new_quantity'); ?> (<?php echo app('translator')->get('lang_v1.secondary_unit'); ?>)</th>
				<?php endif; ?>
				<th><?php echo app('translator')->get('lang_v1.customer_supplier_info'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php $__empty_1 = true; $__currentLoopData = $stock_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
				<tr data-history-type-label="<?php echo e(e($history['type_label']), false); ?>">
					<td><?php echo format_datetime_br($history['date']); ?></td>
                    <td>
						<?php echo e($history['ref_no'], false); ?>


						<?php if(!empty($history['additional_notes'])): ?>
							<?php if(!empty($history['ref_no'])): ?>
							<br>
							<?php endif; ?>
							<?php echo e($history['additional_notes'], false); ?>

						
						<?php endif; ?>
					</td>
                    <td><?php echo e($history['type_label'], false); ?></td>
					<?php if($history['quantity_change'] > 0 ): ?>
						<td class="text-success"> +<span class="display_currency" data-is_quantity="true"><?php echo e($history['quantity_change'], false); ?></span>
						</td>
					<?php else: ?>
						<td class="text-danger"><span class="display_currency text-danger" data-is_quantity="true"><?php echo e($history['quantity_change'], false); ?></span>
						</td>
					<?php endif; ?>

					<?php if(!empty($common_settings['enable_secondary_unit'])): ?>
						<?php if($history['quantity_change'] > 0 ): ?>
							<td class="text-success">
								<?php if(!empty($history['purchase_secondary_unit_quantity'])): ?>
									+<span class="display_currency" data-is_quantity="true"><?php echo e($history['purchase_secondary_unit_quantity'], false); ?></span> <?php echo e($stock_details['second_unit'], false); ?>

								<?php endif; ?>
							</td>
						<?php else: ?>
							<td class="text-danger">
								<?php if(!empty($history['sell_secondary_unit_quantity'])): ?>
									-<span class="display_currency" data-is_quantity="true"><?php echo e($history['sell_secondary_unit_quantity'], false); ?></span> <?php echo e($stock_details['second_unit'], false); ?>

								<?php endif; ?>
							</td>
						<?php endif; ?>
					<?php endif; ?>
					<td>
						<span class="display_currency" data-is_quantity="true"><?php echo e($history['stock'], false); ?></span>
					</td>
					<?php if(!empty($common_settings['enable_secondary_unit'])): ?>
						<td>
							<?php if(!empty($stock_details['second_unit'])): ?>
								<span class="display_currency" data-is_quantity="true"><?php echo e($history['stock_in_second_unit'], false); ?></span> <?php echo e($stock_details['second_unit'], false); ?>

							<?php endif; ?>
						</td>
					<?php endif; ?>
					<td>
						<?php echo e($history['contact_name'] ?? '--', false); ?> 
						<?php if(!empty($history['supplier_business_name'])): ?>
						 - <?php echo e($history['supplier_business_name'], false); ?>

						<?php endif; ?>
					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
				<tr><td colspan="5" class="text-center">
					<?php echo app('translator')->get('lang_v1.no_stock_history_found'); ?>
				</td></tr>
			<?php endif; ?>
			</tbody>
		</table>
</div>
	</div>
</div>
