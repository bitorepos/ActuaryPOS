<?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
        $row_index = $loop->index + $index;
    ?>
    <tr class="product_row">
        <td>
            <?php echo e($product->product_sku ?? '', false); ?>

        </td>
        <td>
            <?php echo e($product->product_name, false); ?>


            <?php if($product->variation_name != "DUMMY"): ?>
                <b><?php echo e($product->variation_name, false); ?></b>
            <?php endif; ?>
            <input type="hidden" name="products[<?php echo e($loop->index + $index, false); ?>][product_id]" value="<?php echo e($product->product_id, false); ?>">
            <input type="hidden" name="products[<?php echo e($loop->index + $index, false); ?>][variation_id]" value="<?php echo e($product->variation_id, false); ?>">
        </td>
        <td>
            <input type="number" class="form-control label_qty" min=1
            name="products[<?php echo e($loop->index + $index, false); ?>][quantity]" value="<?php if(isset($product->quantity)): ?><?php echo e($product->quantity, false); ?><?php else: ?><?php echo e(request()->get('qty', 1), false); ?><?php endif; ?>">
        </td>
        <?php if(request()->session()->get('business.enable_lot_number') == 1): ?>
            <td>
                <input type="text" class="form-control"
                name="products[<?php echo e($loop->index + $index, false); ?>][lot_number]" value="<?php if(isset($product->lot_number)): ?><?php echo e($product->lot_number, false); ?><?php endif; ?>">
            </td>
        <?php endif; ?>
        <?php if(request()->session()->get('business.enable_product_expiry') == 1): ?>
            <td>
                <input type="text" class="form-control label-date-picker"
                name="products[<?php echo e($loop->index + $index, false); ?>][exp_date]" value="<?php if(isset($product->exp_date)): ?><?php echo e(\Carbon::createFromTimestamp(strtotime($product->exp_date))->format(session('business.date_format')), false); ?><?php endif; ?>">
            </td>
        <?php endif; ?>
        <td>
            <input type="text" class="form-control label-date-picker"
            name="products[<?php echo e($loop->index + $index, false); ?>][packing_date]" value="">
        </td>
        <td>
            <?php echo Form::select('products[' . $row_index . '][price_group_id]', $price_groups, null, ['class' => 'form-control', 'placeholder' => __('lang_v1.none')]); ?>

        </td>
        <td class="text-center v-center">
            <i class="fa fa-times text-danger label_remove_row cursor-pointer" aria-hidden="true"></i>
        </td>
    </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

<?php endif; ?>
