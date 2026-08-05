<tr class="currency_row" data-row="<?php echo e($row_count, false); ?>">
    <td>
        <select name="location_currencies[<?php echo e($row_count, false); ?>][country]" class="form-control select2 currency_country" data-row="<?php echo e($row_count, false); ?>" required>
            <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
            <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($currency->country, false); ?>" 
                    data-currency="<?php echo e($currency->currency, false); ?>"
                    data-code="<?php echo e($currency->code, false); ?>"
                    data-symbol="<?php echo e($currency->symbol, false); ?>"
                    data-thousand_separator="<?php echo e($currency->thousand_separator, false); ?>"
                    data-decimal_separator="<?php echo e($currency->decimal_separator, false); ?>">
                    <?php echo e($currency->country, false); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </td>
    <td>
        <?php echo Form::text('location_currencies['.$row_count.'][currency]', null, ['class' => 'form-control currency_name', 'required']); ?>

    </td>
    <td>
        <?php echo Form::text('location_currencies['.$row_count.'][code]', null, ['class' => 'form-control currency_code', 'required']); ?>

    </td>
    <td>
        <?php echo Form::text('location_currencies['.$row_count.'][symbol]', null, ['class' => 'form-control currency_symbol', 'required']); ?>

    </td>
    <td>
        <?php echo Form::text('location_currencies['.$row_count.'][thousand_separator]', null, ['class' => 'form-control currency_thousand_separator', 'required']); ?>

    </td>
    <td>
        <?php echo Form::text('location_currencies['.$row_count.'][decimal_separator]', null, ['class' => 'form-control currency_decimal_separator', 'required']); ?>

    </td>
    <td>
        <div class="input-group">
            <?php echo Form::text('location_currencies['.$row_count.'][multiplier]', null, ['class' => 'form-control currency_multiplier input_number', 'required', 'placeholder' => '0.000000000']); ?>

            <button type="button" class="btn btn-outline-info btn-sm refresh_exchange_rate" title="Fetch latest rate" data-row="<?php echo e($row_count, false); ?>"><i class="fa fa-sync-alt"></i></button>
        </div>
    </td>
    <td>
        <button type="button" class="btn btn-danger btn-sm remove_currency_row"><i class="fa fa-trash"></i></button>
    </td>
</tr>