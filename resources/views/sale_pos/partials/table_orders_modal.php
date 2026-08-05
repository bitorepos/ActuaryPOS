<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	<div class="modal-content to-modal-content">
		
		<div class="modal-header bg-info text-white py-2">
			<h5 class="modal-title fw-semibold">
				<i class="fas fa-utensils me-2"></i><?php echo e($table->name, false); ?>

			</h5>
			<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>

		
		<div class="modal-body p-3 to-modal-body">
			<div class="table-responsive to-table-wrapper">
				<table class="table table-bordered table-striped table-hover table-sm text-center mb-0 to-selectable-table">
					<thead>
						<tr>
							<th class="to-checkbox-col"></th>
							<th>Date</th>
							<th>Orders</th>
							<?php if($kitchen): ?>
							<th>Kitchen</th>
							<?php endif; ?>
							<th>Customer</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$table_has_bill = 0;
						$contact_id = null;
						$order_totals = 0;
						?>
						<?php $__currentLoopData = $table_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $to): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
								$contact_id = $to->contact_id;
								$order_totals += $to->final_total;
								$is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id);
								$can_to_edit = (auth()->user()->can('table.printed_table_order_edit') && ($to->sub_status == 'table_order_bill' || $to->sub_status == 'table_order'));
								$can_to_edit_unpublished = (!auth()->user()->can('table.printed_table_order_edit') && $to->sub_status == 'table_order');
								$needs_to_approval_edit = (!auth()->user()->can('table.printed_table_order_edit') && $to->sub_status == 'table_order_bill');
								$can_to_view = (auth()->user()->can('draft_view') || auth()->user()->can('draft.view_all') || $is_admin);
								$can_to_delete = (auth()->user()->can('table.delete_order') || $is_admin);
								$can_to_kot = ($to->sub_status != 'table_order_bill' && (!auth()->user()->can('table.reprint_kot') || $is_admin));
								$needs_to_kot_approval = ($to->sub_status != 'table_order_bill' && auth()->user()->can('table.reprint_kot') && !$is_admin);
								$is_bill = ($to->sub_status == 'table_order_bill');
								if($is_bill) $table_has_bill++;
							?>
							<tr class="to-row <?php if($to->sub_status == 'table_order_bill'): ?> bg-green <?php endif; ?>"
								data-order-id="<?php echo e($to->id, false); ?>"
								data-loc-id="<?php echo e($to->location_id, false); ?>"
								data-sub-status="<?php echo e($to->sub_status, false); ?>"
								data-table-id="<?php echo e($table->id, false); ?>"
								data-can-edit="<?php echo e(($can_to_edit || $can_to_edit_unpublished) ? 1 : 0, false); ?>"
								data-needs-approval-edit="<?php echo e($needs_to_approval_edit ? 1 : 0, false); ?>"
								data-bypass-edit="<?php echo e(auth()->user()->can('table.printed_table_order_edit') ? 1 : 0, false); ?>"
								data-can-view="<?php echo e($can_to_view ? 1 : 0, false); ?>"
								data-view-url="<?php echo e(action([\App\Http\Controllers\SellController::class, 'show'], [$to->id]), false); ?>"
								data-can-delete="<?php echo e($can_to_delete ? 1 : 0, false); ?>"
								data-needs-approval-delete="<?php echo e((!$can_to_delete && !$is_admin) ? 1 : 0, false); ?>"
								data-delete-url="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'destroy'], [$to->id]), false); ?>"
								data-can-kot="<?php echo e($can_to_kot ? 1 : 0, false); ?>"
								data-needs-approval-kot="<?php echo e($needs_to_kot_approval ? 1 : 0, false); ?>"
								data-kot-url="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'printKOT'], [$to->id]), false); ?>"
								data-is-bill="<?php echo e($is_bill ? 1 : 0, false); ?>"
								data-print-url="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'printInvoice'], [$to->id]), false); ?>">
								<th class="to-checkbox-col">
									<input type="checkbox" class="qm_table_order form-check-input to-row-check" id='qm_table_order' name="orders[<?php echo e($to->id, false); ?>]" checked
											value="<?php echo e($to->id, false); ?>" data-type="<?php echo e($to->sub_status, false); ?>">
								</th>
								<td class="transaction_date" data-orig="<?php echo e($to->transaction_date, false); ?>"><?php echo e($to->transaction_date, false); ?></td>
								<td><?php echo e($to->invoice_no, false); ?></td>
								<?php if($kitchen): ?>
									<td><?php echo e(!empty($to->res_order_status) ? ucwords($to->res_order_status) : 'Sent', false); ?></td>
								<?php endif; ?>
								<td><?php echo e($to->name, false); ?></td>
								<td><?php echo e(number_format($to->final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
							</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</tbody> 
					<tfoot>
						<tr>
							<th></th>
							<th></th>
							<th></th>
							<?php if($kitchen): ?>
							<th></th>
							<?php endif; ?>
							<th>Total:</th>
							<th><?php echo e(number_format($order_totals, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

		
		<div class="modal-footer to-modal-footer d-flex flex-wrap justify-content-between py-2 px-3">
			<input type="hidden" id="qm_table_id" value="<?php echo e($table->id, false); ?>">
			<input type="hidden" id="customer_id" value="<?php echo e($contact_id, false); ?>">
			<?php $hide_table_order_print = ($table_orders->count() == $table_has_bill) ? true : false; ?>

			
			<div class="to-row-actions d-flex gap-1 flex-wrap">
				<button type="button" class="btn btn-outline-primary btn-sm to-footer-btn to-act-edit" title="<?php echo app('translator')->get('messages.edit'); ?>">
					<i class="fas fa-pen"></i> <span class="to-btn-label"><?php echo app('translator')->get('messages.edit'); ?></span>
				</button>
				<button type="button" class="btn btn-outline-info btn-sm to-footer-btn to-act-view" title="<?php echo app('translator')->get('messages.view'); ?>">
					<i class="fas fa-eye"></i> <span class="to-btn-label"><?php echo app('translator')->get('messages.view'); ?></span>
				</button>
				<button type="button" class="btn btn-outline-danger btn-sm to-footer-btn to-act-delete" title="<?php echo app('translator')->get('messages.delete'); ?>">
					<i class="fas fa-trash"></i> <span class="to-btn-label"><?php echo app('translator')->get('messages.delete'); ?></span>
				</button>
				<button type="button" class="btn btn-outline-secondary btn-sm to-footer-btn to-act-print-kot" title="<?php echo app('translator')->get('lang_v1.print_kot'); ?>">
					<i class="fas fa-print"></i> <span class="to-btn-label"><?php echo app('translator')->get('lang_v1.print_kot'); ?></span>
				</button>
				<button type="button" class="btn btn-outline-secondary btn-sm to-footer-btn to-act-print-invoice" title="<?php echo app('translator')->get('lang_v1.print_invoice'); ?>">
					<i class="fas fa-file-invoice"></i> <span class="to-btn-label"><?php echo app('translator')->get('lang_v1.print_invoice'); ?></span>
				</button>
			</div>

			
			<div class="to-bulk-actions d-flex gap-1 flex-wrap">
				<?php if(!auth()->user()->can('table.order_checkout') || $is_admin): ?>
				<button class="btn btn-success btn-sm to-footer-btn" id="pos-table-orders-checkout">
					<i class="fas fa-money-bill-alt"></i> <span class="to-btn-label">Checkout</span>
				</button>
				<?php endif; ?>
				<?php if(!auth()->user()->can('table.order_print_bill') || $is_admin): ?>
				<button class="btn btn-warning btn-sm to-footer-btn" <?php if($hide_table_order_print): ?> disabled <?php endif; ?> id="pos-table-orders-print">
					<i class="fas fa-print"></i> <span class="to-btn-label">Print Bill</span>
				</button>
				<?php endif; ?>
				<button class="btn btn-primary btn-sm to-footer-btn" id="pos-table-orders-place" value="place_order">
					<i class="fas fa-list"></i> <span class="to-btn-label">Place Order</span>
				</button>
				<?php if(!auth()->user()->can('table.move_order') || $is_admin): ?>
				<button class="btn btn-info text-white btn-sm to-footer-btn" id="pos-table-orders-move">
					<i class="fas fa-sign-out-alt"></i> <span class="to-btn-label">Move</span>
				</button>
				<?php endif; ?>
				<button class="btn btn-danger btn-sm to-footer-btn" data-bs-dismiss="modal">
					<i class="fas fa-times"></i> <span class="to-btn-label">Close</span>
				</button>
			</div>
		</div>
	</div>
</div>
