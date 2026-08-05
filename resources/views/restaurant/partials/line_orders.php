<?php $__empty_1 = true; $__currentLoopData = $line_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
	<div class="col-md-3 col-6 line_order_div">
		<div class="small-box bg-gray">
            <div class="inner">
            	<h4 class="text-center">#<?php echo e($order->invoice_no, false); ?></h4>
            	<table class="table no-margin no-border table-slim">
            		<tr><th><?php echo app('translator')->get('restaurant.placed_at'); ?></th><td><?php echo e(\Carbon::createFromTimestamp(strtotime($order->created_at))->format(session('business.date_format')), false); ?> <?php echo e(\Carbon::createFromTimestamp(strtotime($order->created_at))->format('h:i A'), false); ?></td></tr>
            		<tr><th><?php echo app('translator')->get('restaurant.order_status'); ?></th><td><span class="label <?php if($order->res_order_status == 'cooked' ): ?> bg-red <?php elseif($order->res_order_status == 'served'): ?> bg-green <?php else: ?> bg-light-blue <?php endif; ?>"><?php echo app('translator')->get('restaurant.order_statuses.' . $order->res_line_order_status); ?> </span></td></tr>
            		<tr><th><?php echo app('translator')->get('contact.customer'); ?></th><td><?php echo e($order->customer_name, false); ?></td></tr>
            		<tr><th><?php echo app('translator')->get('restaurant.table'); ?></th><td><?php echo e($order->table_name, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('restaurant.service_staff'); ?></th><td><?php echo e($order->service_staff_name ?? '', false); ?></td></tr>
            		<tr><th><?php echo app('translator')->get('sale.location'); ?></th><td><?php echo e($order->business_location, false); ?></td></tr>
                        <tr>
                              <th>
                                    <?php echo app('translator')->get('sale.product'); ?>
                              </th>
                              <td>
                                    <?php echo e($order->product_name, false); ?>

                                    <?php if($order->product_type == 'variable'): ?>
                                           - <?php echo e($order->product_variation_name, false); ?> - <?php echo e($order->variation_name, false); ?> 
                                    <?php endif; ?>
                                    <?php if(!empty($order->modifiers) && count($order->modifiers) > 0): ?>
                                          <?php $__currentLoopData = $order->modifiers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <br><?php echo e($modifier->product->name ?? '', false); ?>

                                                <?php if(!empty($modifier->variations)): ?>
                                                      - <?php echo e($modifier->variations->name ?? '', false); ?>

                                                      <?php if(!empty($modifier->variations->sub_sku)): ?>
                                                            (<?php echo e($modifier->variations->sub_sku ?? '', false); ?>)
                                                      <?php endif; ?>
                                                <?php endif; ?>
                                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                              </td>
                        </tr>
                        <tr><th><?php echo app('translator')->get('lang_v1.quantity'); ?></th><td><?php echo e($order->quantity, false); ?><?php echo e($order->unit, false); ?></td></tr>
                        <tr><th><?php echo app('translator')->get('lang_v1.description'); ?></th><td> <?php echo nl2br($order->sell_line_note ?? ''); ?></td></tr>
            	</table>
                  <?php if(!empty($pos_settings['show_order_details_kitchen'])): ?>
                  <hr class="mb-5 mt-5">
                  <div class="table-responsive">
                        <?php echo $__env->make('restaurant.partials.sale_line_details', ['sell' => $order,], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  </div>
                  <?php endif; ?>
            </div>
            <?php if($orders_for == 'kitchen'): ?>
            	<a href="#" class="btn btn-flat btn-lg btn-block text-white bg-yellow mark_as_cooked_btn" data-href="<?php echo e(action([\App\Http\Controllers\Restaurant\KitchenController::class, 'markAsCooked'], [$order->id]), false); ?>"><i class="fa fa-check-square-o"></i> <?php echo app('translator')->get('restaurant.mark_as_cooked'); ?></a>
            <?php elseif($orders_for == 'waiter' && $order->res_order_status != 'served'): ?>
            	<a href="<?php echo e(action([\App\Http\Controllers\Restaurant\OrderController::class, 'markLineOrderAsServed'], [$order->id]), false); ?>" class="btn btn-flat btn-lg btn-block text-white bg-yellow mark_line_order_as_served"><i class="fa fa-check-square-o"></i> <?php echo app('translator')->get('restaurant.mark_as_served'); ?></a>
            <?php else: ?>
            	<div class="small-box-footer bg-gray">&nbsp;</div>
            <?php endif; ?>
            <div class="btn btn-flat btn-lg btn-block mt-0 bg-green print_line_order cursor-pointer" data-id="<?php echo e($order->id, false); ?>">
                  <?php echo app('translator')->get('messages.print'); ?>
            </div>
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
