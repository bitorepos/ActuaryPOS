<?php
    $back_order_no_value = $back_order_no ?? null;
    if ($back_order_no_value === null && !empty($transaction)) {
        $back_order_no_value = $transaction->back_order_no ?? null;
    }
    if ($back_order_no_value === null && !empty($purchase)) {
        $back_order_no_value = $purchase->back_order_no ?? null;
    }

    $field_class = $field_class ?? 'col-sm-6 col-md-4';
?>

<?php if(!empty($common_settings['enable_back_order'])): ?>
    <div class="<?php echo e($field_class, false); ?>">
        <div class="form-group mb-2">
            <?php echo Form::label('back_order_no', __('lang_v1.back_order_no') . ':'); ?>

            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.back_order_autogenerate_help') . '"></i>';
                }
            ?>
            <?php echo Form::text('back_order_no', $back_order_no_value, [
                'class' => 'form-control',
                'placeholder' => __('lang_v1.back_order_no'),
            ]); ?>

        </div>
    </div>
<?php endif; ?>
