<input type="hidden" id="orders_count" value="<?php echo e(count($orders), false); ?>">
<?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	<div class="col-md-3 col-sm-6 order_div">
		<div class="small-box bg-gray">
            <div class="inner">
            	<h4 class="text-center">#<?php echo e($order->invoice_no, false); ?></h4>
            	<table class="table no-margin no-border table-slim">
            		<tr><th><?php echo app('translator')->get('restaurant.placed_at'); ?></th><td><?php echo e(\Carbon::createFromTimestamp(strtotime($order->created_at))->format(session('business.date_format')), false); ?> <?php echo e(\Carbon::createFromTimestamp(strtotime($order->created_at))->format('h:i A'), false); ?></td></tr>
            		<tr><th><?php echo app('translator')->get('restaurant.order_status'); ?></th>
                              <?php
									$count_sell_line = count($order->sell_lines);
									$count_cooked = count($order->sell_lines->where('res_line_order_status', 'cooked'));
									$count_served = count($order->sell_lines->where('res_line_order_status', 'served'));
									$order_status =  'received';
									if($count_cooked == $count_sell_line) {
										$order_status =  'cooked';
									} else if($count_served == $count_sell_line) {
										$order_status =  'served';
									} else if ($count_served > 0 && $count_served < $count_sell_line) {
										$order_status =  'partial_served';
									} else if ($count_cooked > 0 && $count_cooked < $count_sell_line) {
										$order_status =  'partial_cooked';
									}
                              ?>
                              <td><span class="label <?php if($order_status == 'cooked' ): ?> bg-red <?php elseif($order_status == 'served'): ?> bg-green <?php elseif($order_status == 'partial_cooked'): ?> bg-orange <?php else: ?> bg-light-blue <?php endif; ?>"><?php echo app('translator')->get('restaurant.order_statuses.' . $order_status); ?> </span></td>
                        </tr>
            		<tr><th><?php echo app('translator')->get('contact.customer'); ?></th><td><?php echo e($order->customer_name, false); ?></td></tr>
            		<tr>
						<th> <?php if(!empty($pos_settings['prompt_token_label'])): ?> <?php echo e($pos_settings['prompt_token_label'], false); ?> <?php else: ?> <?php echo app('translator')->get('lang_v1.token_no'); ?> <?php endif; ?> </th>
						<td><?php echo e($order->token_no, false); ?></td></tr>
					<tr>
						<th><?php echo app('translator')->get('restaurant.table'); ?></th>
						<?php
						$table_name = !empty($order->table_name) ? $order->table_name : null;
						if(empty($table_name)){
							$table_name = !empty($pos_settings['enable_takeaway_label']) ? $pos_settings['enable_takeaway_label'] :  $order->sub_type;
						}
						?>
						<td><?php echo e($table_name, false); ?></td>
					</tr>
            		<tr><th><?php echo app('translator')->get('sale.location'); ?></th><td><?php echo e($order->business_location, false); ?></td></tr>
            	</table>
				<?php if(!empty($pos_settings['show_order_details_kitchen'])): ?>
				<hr class="mb-5 mt-5">
				<div class="table-responsive">
					<?php echo $__env->make('restaurant.partials.sale_line_details', ['sell' => $order,], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<?php endif; ?>
            </div>
            <?php if($orders_for == 'kitchen'): ?>
            	<a href="#" class="btn btn-flat btn-lg btn-block text-white bg-yellow  mark_as_cooked_btn" data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\KitchenController::class, 'markAsCooked'], [$order->id]), false); ?>"><i class="fa fa-check-square-o"></i> <?php echo app('translator')->get('restaurant.mark_as_cooked'); ?></a>
            <?php elseif($orders_for == 'waiter' && $order->res_order_status != 'served'): ?>
            	<a href="#" class="btn btn-flat btn-lg btn-block text-white bg-yellow  mark_as_served_btn" data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\OrderController::class, 'markAsServed'], [$order->id]), false); ?>"><i class="fa fa-check-square-o"></i> <?php echo app('translator')->get('restaurant.mark_as_served'); ?></a>
            <?php else: ?>
            	<div class="small-box-footer bg-gray">&nbsp;</div>
            <?php endif; ?>

			<?php if(empty($pos_settings['show_order_details_kitchen'])): ?>
            	<a href="#" class="btn btn-flat btn-lg btn-block bg-grey btn-modal-kot mt-0" data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\KitchenController::class, 'viewKOT'], [$order->id]), false); ?>" data-container=".view_modal">
					<?php echo app('translator')->get('restaurant.order_details'); ?> <i class="fa fa-arrow-circle-right"></i>
				</a>
			<?php endif; ?>
         </div>
	</div>
	<?php if($loop->iteration % 4 == 0): ?>
		<div class="d-none d-sm-inline">
			<div class="clearfix"></div>
		</div>
	<?php endif; ?>
	<?php if($loop->iteration % 2 == 0): ?>
		<div class="d-none d-xs-block">
			<div class="clearfix"></div>
		</div>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
<div class="col-md-12">
	<h4 class="text-center"><?php echo app('translator')->get('restaurant.no_orders_found'); ?></h4>
</div>
<?php endif; ?>
