<!-- Edit Invocie Tax Modal -->
<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo app('translator')->get('lang_v1.suspended_sales'); ?></h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<?php
					$c = 0;
					$subtype = '';
				?>
				<?php if(!empty($transaction_sub_type)): ?>
					<?php
						$subtype = '?sub_type='.$transaction_sub_type;
					?>
				<?php endif; ?>
				<?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
					<?php if($sale->is_suspend): ?>
						<div class="col-6 col-sm-3">
							<div class="small-box bg-yellow">
					            <div class="inner text-center">
						            <?php if(!empty($sale->additional_notes)): ?>
						            	<p><i class="fa fa-edit"></i> <?php echo e($sale->additional_notes, false); ?></p>
						            <?php endif; ?>
					              <p><?php echo e($sale->invoice_no, false); ?><br>
					              <?php echo e(\Carbon::createFromTimestamp(strtotime($sale->transaction_date))->format(session('business.date_format')), false); ?><br>
					              <strong><i class="fa fa-user"></i> <?php echo e($sale->name, false); ?></strong></p>
					              <p><i class="fa fa-cubes"></i><?php echo app('translator')->get('lang_v1.total_items'); ?>: <?php echo e(count($sale->sell_lines), false); ?><br>
					              <i class="fas fa-money-bill-alt"></i> <?php echo app('translator')->get('sale.total'); ?>: <span class="display_currency" data-currency_symbol=true><?php echo e($sale->final_total, false); ?></span>
					              </p>
					              <?php if($is_tables_enabled && !empty($sale->table->name)): ?>
					              	<?php echo app('translator')->get('restaurant.table'); ?>: <?php echo e($sale->table->name, false); ?>

					              <?php endif; ?>
					              <?php if($is_service_staff_enabled && !empty($sale->service_staff)): ?>
					              	<br><?php echo app('translator')->get('restaurant.service_staff'); ?>: <?php echo e($sale->service_staff->user_full_name, false); ?>

					              <?php endif; ?>
					            </div>
								<?php if(auth()->user()->can('sell.update') || auth()->user()->can('direct_sell.update')): ?>
									<a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'edit'], ['po' => $sale->id]).$subtype, false); ?>" class="small-box-footer bg-blue p-10">
									<?php echo app('translator')->get('sale.edit_sale'); ?> <i class="fa fa-arrow-circle-right"></i>
									</a>
								<?php endif; ?>
								<?php if(auth()->user()->can('sell.delete') || auth()->user()->can('direct_sell.delete')): ?>
									<a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'destroy'], ['po' => $sale->id]), false); ?>" class="small-box-footer delete-sale bg-red is_suspended">
										<?php echo app('translator')->get('messages.delete'); ?> <i class="fas fa-trash"></i>
					            	</a>
								<?php endif; ?>
								<?php if(!auth()->user()->can('sell.update') && auth()->user()->can('edit_pos_payment')): ?>
									<a href="<?php echo e(route('edit-pos-payment', ['po' => $sale->id]), false); ?>" 
									class="small-box-footer bg-blue p-10">
									<?php echo app('translator')->get('lang_v1.add_edit_payment'); ?> <i class="fas fa-money-bill-alt"></i>
									</a>
								<?php endif; ?>
					         </div>
				         </div>
				        <?php
				         	$c++;
				        ?>
					<?php endif; ?>

					<?php if($c%4==0): ?>
						<div class="clearfix"></div>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
					<p class="text-center"><?php echo app('translator')->get('purchase.no_records_found'); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<div class="modal-footer">
		    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
