
<?php $__env->startSection('title', 'Add Delivery Note'); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1>Add Delivery Note 
        <?php if($transaction): ?>
            <small>Sale Invoice: <?php echo e($transaction->invoice_no, false); ?></small>
        <?php endif; ?>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => 'Select Sale']); ?>
                <div class="form-group">
                    <?php echo Form::label('transaction_select', 'Select Sale Invoice:*'); ?>

                    <?php echo Form::select('transaction_select', $sales, $transaction_id, ['class' => 'form-control select2', 'placeholder' => 'Select Invoice', 'id' => 'transaction_select']); ?>

                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <?php if($transaction): ?>
        <?php echo Form::open(['url' => action([\App\Http\Controllers\DeliveryNoteController::class, 'store']), 'method' => 'post', 'id' => 'delivery_note_form' ]); ?>

        <input type="hidden" name="transaction_id" value="<?php echo e($transaction->id, false); ?>">
        
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('delivery_note_no', 'Delivery Note No.:'); ?>

                        <?php echo Form::text('delivery_note_no', null, ['class' => 'form-control', 'placeholder' => 'Leave empty to auto generate']); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('status', 'Status:*'); ?>

                        <?php echo Form::select('status', ['pending' => 'Pending', 'on the way' => 'On the way', 'completed' => 'Completed'], 'pending', ['class' => 'form-control select2', 'required']); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('delivered_to', 'Delivered To:'); ?>

                        <?php echo Form::text('delivered_to', $transaction->delivered_to, ['class' => 'form-control', 'placeholder' => 'Delivered To']); ?>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <?php echo Form::label('shipping_address', 'Shipping Address:'); ?>

                        <?php echo Form::textarea('shipping_address', $transaction->shipping_address, ['class' => 'form-control', 'placeholder' => 'Shipping Address', 'rows' => 3]); ?>

                    </div>
                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => 'Products to Deliver']); ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Sold Qty</th>
                        <th>Balance Qty (Not Delivered)</th>
                        <th>Delivery Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($line->product->name, false); ?>

                                <?php if($line->product->type == 'variable' && !empty($line->variation)): ?>
                                    - <?php echo e($line->variation->name, false); ?>

                                <?php endif; ?>
                            </td>
                            <td><?php echo e(number_format($line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                            <td><?php echo e(number_format($line->balance_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                            <td>
                                <input type="hidden" name="products[<?php echo e($index, false); ?>][transaction_sell_line_id]" value="<?php echo e($line->id, false); ?>">
                                <input type="hidden" name="products[<?php echo e($index, false); ?>][product_id]" value="<?php echo e($line->product_id, false); ?>">
                                <input type="hidden" name="products[<?php echo e($index, false); ?>][variation_id]" value="<?php echo e($line->variation_id, false); ?>">
                                <?php echo Form::text("products[$index][quantity]", number_format($line->balance_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number delivery_qty', 'data-max' => $line->balance_qty, 'max' => $line->balance_qty, 'required']); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
    
    <div class="row">
        <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-primary btn-big">Save</button>
        </div>
    </div>
    <?php echo Form::close(); ?>

    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#transaction_select').on('change', function() {
            var transaction_id = $(this).val();
            if(transaction_id) {
                window.location.href = "<?php echo e(action([\App\Http\Controllers\DeliveryNoteController::class, 'create']), false); ?>?transaction_id=" + transaction_id;
            }
        });

        function validateDeliveryQty(el) {
            var $el = $(el);
            if ($el.attr('readonly')) return true;

            var val = __read_number($el);
            var max = parseFloat($el.data('max'));
            var $td = $el.closest('td');
            var $errorMsg = $td.find('.qty_error_msg');

            if ($errorMsg.length === 0) {
                $errorMsg = $('<span class="text-danger qty_error_msg" style="display:block; margin-top:4px; font-size:12px; font-weight:bold;"></span>').appendTo($td);
            }

            if (isNaN(val) || val < 0) {
                $errorMsg.text('Please enter a valid quantity').show();
                $td.addClass('has-error');
                return false;
            } else if (val > max) {
                $errorMsg.text('Delivery quantity cannot exceed balance quantity (' + max + ')').show();
                $td.addClass('has-error');
                return false;
            } else {
                $errorMsg.hide().text('');
                $td.removeClass('has-error');
                return true;
            }
        }

        $(document).on('change keyup input', '.delivery_qty', function() {
            validateDeliveryQty(this);
        });

        $('#delivery_note_form').on('submit', function(e) {
            var isValid = true;
            $('.delivery_qty').each(function() {
                if (!validateDeliveryQty(this)) {
                    if (isValid) {
                        $(this).focus();
                    }
                    isValid = false;
                }
            });
            if (!isValid) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>