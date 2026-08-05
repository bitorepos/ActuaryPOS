<h4 class="text-center">#<?php echo e($order->invoice_no, false); ?></h4>
<table class="table table-bordered table-striped table-th-skin">
	<tr>
		<th>
			<?php echo app('translator')->get('restaurant.placed_at'); ?>
		</th>
		<td>
			<?php echo e(\Carbon::createFromTimestamp(strtotime($order->created_at))->format(session('business.date_format')), false); ?> <?php echo e(\Carbon::createFromTimestamp(strtotime($order->created_at))->format('h:i A'), false); ?>

		</td>
	</tr>
	<tr>
		<th>
			<?php echo app('translator')->get('restaurant.order_status'); ?>
		</th>
		<td>
			<?php echo app('translator')->get('restaurant.order_statuses.' . $order->res_line_order_status); ?>
		</td>
	</tr>
	<tr>
		<th>
			<?php echo app('translator')->get('contact.customer'); ?>
		</th>
		<td>
			<?php echo e($order->customer_name, false); ?>

		</td>
	</tr>
	<tr>
		<th>
			<?php echo app('translator')->get('restaurant.table'); ?>
		</th>
		<td>
			<?php echo e($order->table_name, false); ?>

		</td>
	</tr>
    <tr>
    	<th>
    		<?php echo app('translator')->get('restaurant.service_staff'); ?>
    	</th>
    	<td>
    		<?php echo e($order->service_staff_name ?? '', false); ?>

    	</td>
    </tr>
	<tr>
		<th>
			<?php echo app('translator')->get('sale.location'); ?>
		</th>
		<td>
			<?php echo e($order->business_location, false); ?>

		</td>
	</tr>
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
    <tr>
    	<th>
    		<?php echo app('translator')->get('lang_v1.quantity'); ?>
    	</th>
    	<td>
    		<?php echo e($order->quantity, false); ?><?php echo e($order->unit, false); ?>

    	</td>
    </tr>
    <tr>
    	<th>
    		<?php echo app('translator')->get('lang_v1.description'); ?>
    	</th>
    	<td> 
    		<?php echo nl2br($order->sell_line_note ?? ''); ?>

    	</td>
    </tr>
</table>
