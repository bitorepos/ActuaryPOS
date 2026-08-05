<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <i class="fas fa-undo"></i> <?php echo app('translator')->get('lang_v1.dojo_refund'); ?>
            </h4>
        </div>
        <div class="modal-body text-center">
            <div class="dojo-refund-status">
                <div class="payment-info mb-3">
                    <h3><?php echo e($currency, false); ?> <?php echo e(number_format($amount, 2), false); ?></h3>
                    <p class="text-muted"><?php echo app('translator')->get('lang_v1.refund_reference'); ?>: <?php echo e($reference, false); ?></p>
                </div>

                <div class="payment-status-indicator mb-3">
                    <?php if($status == 'InitiateRequested' || $status == 'Initiated'): ?>
                        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2"><strong><?php echo app('translator')->get('lang_v1.processing_refund'); ?></strong></p>
                        <p class="text-muted"><?php echo app('translator')->get('lang_v1.please_complete_refund_on_terminal'); ?></p>
                    <?php elseif($status == 'Captured'): ?>
                        <div class="text-success">
                            <i class="fas fa-check-circle fa-4x"></i>
                        </div>
                        <p class="mt-2"><strong><?php echo app('translator')->get('lang_v1.refund_successful'); ?></strong></p>
                    <?php elseif($status == 'Declined'): ?>
                        <div class="text-danger">
                            <i class="fas fa-times-circle fa-4x"></i>
                        </div>
                        <p class="mt-2"><strong><?php echo app('translator')->get('lang_v1.refund_declined'); ?></strong></p>
                    <?php else: ?>
                        <div class="text-info">
                            <i class="fas fa-info-circle fa-4x"></i>
                        </div>
                        <p class="mt-2"><strong><?php echo e($status, false); ?></strong></p>
                    <?php endif; ?>
                </div>

                <input type="hidden" id="dojo_refund_terminal_session_id" value="<?php echo e($terminal_session_id, false); ?>">
                <input type="hidden" id="dojo_refund_transaction_id" value="<?php echo e($transaction_id, false); ?>">

                <div id="dojo_refund_signature_verification" style="display: none;">
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" id="dojo_refund_accept_signature" class="btn btn-success">
                            <?php echo app('translator')->get('lang_v1.accept_signature'); ?>
                        </button>
                        <button type="button" id="dojo_refund_reject_signature" class="btn btn-danger">
                            <?php echo app('translator')->get('lang_v1.reject_signature'); ?>
                        </button>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="button" class="btn btn-secondary" id="dojo_cancel_refund">
                        <i class="fas fa-times"></i> <?php echo app('translator')->get('messages.cancel'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
