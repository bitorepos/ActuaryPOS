<?php
    $transaction_types = [];
    if(in_array($contact->type, ['both', 'supplier'])){
        $transaction_types['purchase'] = __('lang_v1.purchase');
        $transaction_types['purchase_return'] = __('lang_v1.purchase_return');
    }

    if(in_array($contact->type, ['both', 'customer'])){
        $transaction_types['sell'] = __('sale.sale');
        $transaction_types['sell_return'] = __('lang_v1.sell_return');
    }

    $transaction_types['opening_balance'] = __('lang_v1.opening_balance');
    $date_loc = isset($ledger_date_settings_location) && isset($date_settings[$ledger_date_settings_location])
        ? $ledger_date_settings_location
        : array_key_first($date_settings ?? []);
    $ledger_filter_date_range = ! is_null($date_loc) && is_array($date_settings[$date_loc] ?? null)
        ? ($date_settings[$date_loc]['ledger_filter_date_range'] ?? 'this_year')
        : ($date_settings['ledger_filter_date_range'] ?? 'this_year');
    $ledger_formats = [
        'format_1' => __('lang_v1.format_1'),
        'format_2' => __('lang_v1.format_2'),
        'format_3' => __('lang_v1.format_3'),
        'format_4' => __('lang_v1.format_4'),
        'format_5' => __('lang_v1.format_5'),
        'format_6' => __('lang_v1.format_6'),
    ];
    $ledger_default_format_keys = [
        'customer' => 'default_customer_ledger_format',
        'supplier' => 'default_supplier_ledger_format',
        'both' => 'default_barterer_ledger_format',
    ];
    $ledger_default_format_key = $ledger_default_format_keys[$contact->type] ?? 'default_customer_ledger_format';
    $default_ledger_format = $common_settings[$ledger_default_format_key] ?? 'format_1';
    if (!array_key_exists($default_ledger_format, $ledger_formats)) {
        $default_ledger_format = 'format_1';
    }
?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                <?php echo Form::label('ledger_date_range', __('report.date_range') . ':'); ?>

                <?php echo Form::text('ledger_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                <?php echo Form::hidden('ledger_filter_date_range', $ledger_filter_date_range, ['id'=>'ledger_filter_date_range']); ?>

                <?php echo Form::hidden('ledger_contact_type', $contact->type, ['id' => 'ledger_contact_type']); ?>

                
            </div>
        </div>
        <div class="col-md-auto">
            <div class="mb-3">
                <label><?php echo app('translator')->get('lang_v1.ledger_format'); ?></label><br>
                <div class="ledger-format-scroll">
                <div class="ledger-format-options"
                    data-default-format="<?php echo e($default_ledger_format, false); ?>"
                    data-default-url="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'setDefaultLedgerFormat']), false); ?>">
                    <?php $__currentLoopData = $ledger_formats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ledger_format_value => $ledger_format_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $ledger_format_number = str_replace('format_', '', $ledger_format_value);
                            $is_default_ledger_format = $default_ledger_format === $ledger_format_value;
                        ?>
                        <div class="ledger-format-option">
                            <input type="radio" class="btn-check" name="ledger_format" value="<?php echo e($ledger_format_value, false); ?>" id="ledger_format_<?php echo e($ledger_format_number, false); ?>" autocomplete="off" <?php if($is_default_ledger_format): ?> checked <?php endif; ?>>
                            <label class="btn btn-outline-secondary" for="ledger_format_<?php echo e($ledger_format_number, false); ?>"><?php echo e($ledger_format_label, false); ?></label>
                            <label class="ledger-format-default-label" for="ledger_default_format_<?php echo e($ledger_format_number, false); ?>">
                                <input type="checkbox"
                                    class="ledger-format-default-checkbox"
                                    value="<?php echo e($ledger_format_value, false); ?>"
                                    id="ledger_default_format_<?php echo e($ledger_format_number, false); ?>"
                                    <?php if($is_default_ledger_format): ?> checked <?php endif; ?>>
                                <?php echo app('translator')->get('lang_v1.is_default'); ?>
                            </label>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 ms-auto">
            <div class="mb-3">
                <?php echo Form::label('ledger_location', __('purchase.business_location') . ':'); ?>

                <?php echo Form::select('ledger_location', $business_locations, null , ['class' => 'form-control select2', 'id' => 'ledger_location']); ?>

            </div>
        </div>
    </div>
    <div id="contact_ledger_div" class="row" style="overflow:auto;"></div>
    
    <input type="hidden" id="ledger_print_href" value="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'getLedger']), false); ?>?contact_id=<?php echo e($contact->id, false); ?>&action=pdf&sub_action=print">
    <input type="hidden" id="ledger_pdf_href" value="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'getLedger']), false); ?>?contact_id=<?php echo e($contact->id, false); ?>&action=pdf">
    <input type="hidden" id="ledger_contact_id" value="<?php echo e($contact->id, false); ?>">
</div>
