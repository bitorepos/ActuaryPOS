<?php
    $payment_status = $payment_status ?? '';
    $payment_status_label = '-';

    if (!empty($payment_status)) {
        $payment_status_key = 'lang_v1.' . $payment_status;
        $payment_status_label = __($payment_status_key);

        if ($payment_status_label === $payment_status_key) {
            $payment_status_label = ucwords(str_replace(['-', '_'], ' ', $payment_status));
        }
    }
?>

<a href="<?php echo e(action([\App\Http\Controllers\TransactionPaymentController::class, 'show'], [$id]), false); ?>" class="view_payment_modal payment-status-label" data-orig-value="<?php echo e($payment_status, false); ?>" data-status-name="<?php echo e($payment_status_label, false); ?>"><span class="badge <?php if($payment_status == 'partial'){
                echo 'bg-aqua';
            }elseif($payment_status == 'due'){
                echo 'bg-yellow';
            }elseif ($payment_status == 'paid') {
                echo 'bg-light-green';
            }elseif ($payment_status == 'overpaid') {
                echo 'bg-red';
            }elseif ($payment_status == 'overdue') {
                echo 'bg-red';
            }elseif ($payment_status == 'partial-overdue') {
                echo 'bg-red';
            }elseif ($payment_status == 'installmented') {
                echo 'bg-purple';
            } ?>"><?php echo e($payment_status_label, false); ?>

                        </span></a>
