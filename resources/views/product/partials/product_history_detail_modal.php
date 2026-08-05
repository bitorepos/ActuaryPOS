<div class="modal fade" id="product_history_detail_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
		<div class="modal-header bg-info">
			<h4 class="modal-title text-light text-center">
				<?php echo app('translator')->get('lang_v1.product_stock_history'); ?>
			</h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body" style="overflow-x: auto;">
			<div class="row">
				<div class="col-md-12">
					<?php
						$__enabled_modules = session('business.enabled_modules', []);
						$__show_stock_transfers = in_array('stock_transfers', $__enabled_modules);
						$__show_manufacturing = false;
						$__show_warehouse = false;
						if (class_exists(\Nwidart\Modules\Facades\Module::class)) {
							$__show_manufacturing = !empty(\Nwidart\Modules\Facades\Module::find('Manufacturing'));
							$__show_warehouse = !empty(\Nwidart\Modules\Facades\Module::find('Warehouse'));
						}
						$__qty_out_arr = [__('sale.sale'), __('stock_adjustment.stock_adjustment'), __('lang_v1.purchase_return')];
						if ($__show_stock_transfers) { $__qty_out_arr[] = __('lang_v1.stock_transfers') . ' (' . __('lang_v1.out') . ')'; }
						if ($__show_manufacturing) { $__qty_out_arr[] = __('manufacturing::lang.ingredient'); }
						if ($__show_warehouse) { $__qty_out_arr[] = __('warehouse::lang.wh_transfer') . ' (' . __('lang_v1.out') . ')'; }
						$__modal_qty_out = json_encode($__qty_out_arr, JSON_HEX_APOS | JSON_HEX_QUOT);
					?>
					<div class="row mb-2">
						<div class="col-md-3">
							<label for="ps_stock_history_type"><?php echo app('translator')->get('lang_v1.type'); ?>:</label>
							<select class="form-control" id="ps_stock_history_type" data-qty-out='<?php echo $__modal_qty_out; ?>'>
								<option value=""><?php echo app('translator')->get('lang_v1.all'); ?></option>
								<?php if($__show_manufacturing): ?>
								<option value="<?php echo e(__('manufacturing::lang.ingredient'), false); ?>"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</option>
								<option value="<?php echo e(__('manufacturing::lang.manufactured'), false); ?>"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</option>
								<?php endif; ?>
								<option value="<?php echo e(__('report.opening_stock'), false); ?>"><?php echo app('translator')->get('report.opening_stock'); ?></option>
								<option value="__quantities_out__"><?php echo app('translator')->get('lang_v1.quantities_out'); ?></option>
								<?php if($__show_stock_transfers): ?>
								<option value="<?php echo e(__('lang_v1.stock_transfers'), false); ?> (<?php echo e(__('lang_v1.in'), false); ?>)"><?php echo app('translator')->get('lang_v1.stock_transfers'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</option>
								<option value="<?php echo e(__('lang_v1.stock_transfers'), false); ?> (<?php echo e(__('lang_v1.out'), false); ?>)"><?php echo app('translator')->get('lang_v1.stock_transfers'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</option>
								<?php endif; ?>
								<?php if($__show_warehouse): ?>
								<option value="<?php echo e(__('warehouse::lang.wh_transfer'), false); ?> (<?php echo e(__('lang_v1.in'), false); ?>)"><?php echo app('translator')->get('warehouse::lang.wh_transfer'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</option>
								<option value="<?php echo e(__('warehouse::lang.wh_transfer'), false); ?> (<?php echo e(__('lang_v1.out'), false); ?>)"><?php echo app('translator')->get('warehouse::lang.wh_transfer'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</option>
								<?php endif; ?>
								<option value="<?php echo e(__('lang_v1.purchase_return'), false); ?>"><?php echo app('translator')->get('lang_v1.total_purchase_return'); ?></option>
								<option value="<?php echo e(__('lang_v1.purchase'), false); ?>"><?php echo app('translator')->get('report.total_purchase'); ?></option>
								<option value="<?php echo e(__('lang_v1.sell_return'), false); ?>"><?php echo app('translator')->get('lang_v1.total_sell_return'); ?></option>
								<option value="<?php echo e(__('sale.sale'), false); ?>"><?php echo app('translator')->get('lang_v1.total_sold'); ?></option>
								<option value="<?php echo e(__('stock_adjustment.stock_adjustment'), false); ?>"><?php echo app('translator')->get('report.total_stock_adjustment'); ?></option>
							</select>
						</div>
					</div>
					<div id="ps_product_stock_history_div" style="display: none; overflow-x: auto; max-width: 100%;"></div>
				</div>
			</div>
		</div>
		<div class="modal-footer bg-info justify-items-center">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
		</div>
	</div>
</div>
</div>