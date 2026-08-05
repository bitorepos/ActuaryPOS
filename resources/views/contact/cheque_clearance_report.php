<?php if(request('sub_action') != 'print' && empty($for_pdf)): ?>
	<div class="col-md-12">
		<div class="mb-3">
			<div class="form-check">
				<label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_clearing_format1]', 1,
					!empty($common_settings['hide_clearing_format1']) ? true : false,
					[ 'class' => 'form-check-input', 'id' => 'hide_clearing']); ?> <?php echo e(__( 'lang_v1.hide_clearing_format1' ), false); ?>

				</label>
			</div>
		</div>
	</div>
<?php endif; ?>
<div id="cheque_clearance_div" class="col-md-12 col-sm-12 <?php if(!empty($for_pdf)): ?> width-100 <?php endif; ?> <?php if(request('hide_clearing') == 'true'): ?> hide <?php endif; ?>">
		<?php if(!empty($for_pdf)): ?>
		<br>
		<?php endif; ?>
		<div class="table-responsive">
		<table class="table table-bordered table-striped table-th-skin" style="margin-top: 0;"
			id="cheque_clearance_report_table">
			<thead>
				<tr>
					<th><?php echo app('translator')->get('purchase.payment_no'); ?></th>
					<th><?php echo app('translator')->get('lang_v1.issue_date'); ?></th>
					<th><?php echo app('translator')->get('lang_v1.contact_id'); ?></th> 
					<th><?php echo app('translator')->get('contact.contact_name'); ?></th> 
					<th><?php echo app('translator')->get('lang_v1.transaction'); ?></th>
					<th><?php echo app('translator')->get('lang_v1.cheque_no'); ?></th>
					<th class="align-right"><?php echo app('translator')->get('sale.amount'); ?></th>
					<?php if(count($business_locations) > 1): ?>
					<th id="ccr_location"><?php echo app('translator')->get('business.location'); ?></th>
					<?php endif; ?>
					<th><?php echo app('translator')->get('lang_v1.clearance_date'); ?></th>
					<th><?php echo app('translator')->get('lang_v1.status'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					$clearing_total = 0;
				?>
				<?php $__currentLoopData = $clearing_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
					$clearing_total += $row->amount;
					?>
					<tr>
						<td>
							<?php
								$pay_url = action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPayment'], [$row->DT_RowId]);
							?>
							<a data-href="<?php echo e($pay_url, false); ?>" class="view_payment"><?php echo e($row->payment_ref_no, false); ?></a>
						</td>
						<td><?php echo e(\Carbon::createFromTimestamp(strtotime($row->paid_on))->format(session('business.date_format')), false); ?></td>
						<td><?php echo $row->contact_id; ?></td>
						<td><?php echo $row->contact; ?></td>
						<td>
							<?php
							$ref = $row->invoice_no ?? $row->ref_no;
							$url = null;
	
							switch ($row->transaction_type) {
								case 'sell':
									$url = action([\App\Http\Controllers\SellController::class, 'show'], [$row->transaction_id]);
									break;
	
								case 'sell_return':
									$id = $row->return_parent_id ?: $row->transaction_id;
									$url = action([\App\Http\Controllers\SellReturnController::class, 'show'], [$id]);
									break;
	
								case 'advance_deposit':
									$url = action([\App\Http\Controllers\TransactionPaymentController::class, 'viewPaymentAD'], [$row->transaction_id]);
									break;
	
								case 'purchase':
									$url = action([\App\Http\Controllers\PurchaseController::class, 'show'], [$row->transaction_id]);
									break;
	
								case 'purchase_return':
									$id = $row->return_parent_id ?: $row->transaction_id;
									$url = action([\App\Http\Controllers\PurchaseReturnController::class, 'show'], [$id]);
									break;
							}
							?>
							<?php if($url): ?>
								<a data-href="<?php echo e($url, false); ?>" href="#" data-container=".view_modal" class="btn-modal"><?php echo e($ref, false); ?></a>
							<?php else: ?>
								<?php echo e($ref, false); ?>

							<?php endif; ?>
						</td>
						<td><?php echo e($row->cheque_number, false); ?></td>
						<td class="ws-nowrap align-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $row->amount, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
						<?php if(count($business_locations) > 1): ?>
						<td><?php echo e($row->location, false); ?></td>
						<?php endif; ?>
						<td><?php echo e(\Carbon::createFromTimestamp(strtotime($row->clearance_date))->format(session('business.date_format')), false); ?></td>
						<td>
							<?php
							$status = ucwords($row->status);
							if(request('sub_action') != 'print' && empty($for_pdf)){
								if($row->status == 'pending'){
									$status .= '<br><a href="#" data-href="'.action([\App\Http\Controllers\TransactionPaymentController::class, 'updatePDCPaymentStatus'], [$row->payment_id]).'"
												class="update_pdc_payment_status" data-status="cleared">Cleared</a>';
								}else{
									$status .= '<br><a href="#" data-href="'.action([\App\Http\Controllers\TransactionPaymentController::class, 'updatePDCPaymentStatus'], [$row->payment_id]).'"
												class="update_pdc_payment_status" data-status="pending">Pending</a>';
								}
							}
							?>
							<?php echo $status; ?>

						</td>
					</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
			<tfoot>
				<tr class="bg-gray font-17 footer-total text-right">
					<td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
					<td class="ws-nowrap align-right"><span class="display_currency" id="footer_total_amount"
							data-currency_symbol="true"><?php echo e($clearing_total, false); ?></span></td>
					<td colspan="<?php if(count($business_locations) > 1): ?> 5 <?php else: ?> 4 <?php endif; ?>"></td>
				</tr>
			</tfoot>
		</table>
		</div>
</div>
<?php if(request('sub_action') != 'print' && empty($for_pdf)): ?>
<div class="modal fade pdc_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog no-print" role="document">
    <div class="modal-content">
          <div class="modal-header">
		  <h4 class="modal-title" id="modalTitle">Set Cleared Date</h4>
			<button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
          
		</div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                  <?php echo Form::label("cleared_on" , __('lang_v1.cleared_on') . ':*'); ?>

                  <div class="input-group">
                    <span class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </span>
                    <?php echo Form::text('cleared_on', \Carbon::createFromTimestamp(strtotime(now()))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="update_pdc_payment_status_post btn btn-primary">Proceed </a>
            <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>
<?php endif; ?>
