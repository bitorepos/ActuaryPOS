<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <i class="fas fa-credit-card"></i> <?php echo app('translator')->get('lang_v1.dojo_payment'); ?>
            </h4>
            
        </div>
        <div class="modal-body text-center">
            <div class="dojo-payment-status">
                
                <?php if(!empty($data['config']['branding']['logoUrl'])): ?>
                    <div class="dojo-branding mb-3">
                        <img src="<?php echo e($data['config']['branding']['logoUrl'], false); ?>" alt="Dojo" style="max-height: 50px; max-width: 200px;">
                    </div>
                <?php endif; ?>

                <?php if(!empty($data['config']['tradingName'])): ?>
                    <p class="text-muted mb-2"><small><?php echo e($data['config']['tradingName'], false); ?></small></p>
                <?php endif; ?>

                <div class="payment-info mb-3">
                    <h3><?php echo e($currency, false); ?> <?php echo e(number_format($amount, 2), false); ?></h3>
                    <p class="text-muted"><?php echo app('translator')->get('sale.invoice_no'); ?>: <?php echo e($reference, false); ?></p>
                </div>

                <div class="payment-status-indicator mb-3">
                    <?php if($status == 'Created' || $status == 'Pending'): ?>
                        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2"><strong><?php echo app('translator')->get('lang_v1.waiting_for_payment'); ?></strong></p>
                        <p class="text-muted"><?php echo app('translator')->get('lang_v1.please_complete_payment_on_terminal'); ?></p>
                    <?php elseif($status == 'Captured' || $status == 'Successful'): ?>
                        <div class="text-success">
                            <i class="fas fa-check-circle fa-4x"></i>
                        </div>
                        <p class="mt-2"><strong><?php echo app('translator')->get('lang_v1.payment_successful'); ?></strong></p>
                    <?php elseif($status == 'Failed' || $status == 'Declined'): ?>
                        <div class="text-danger">
                            <i class="fas fa-times-circle fa-4x"></i>
                        </div>
                        <p class="mt-2"><strong><?php echo app('translator')->get('lang_v1.payment_failed'); ?></strong></p>
                    <?php else: ?>
                        <div class="text-info">
                            <i class="fas fa-info-circle fa-4x"></i>
                        </div>
                        <p class="mt-2"><strong><?php echo e($status, false); ?></strong></p>
                    <?php endif; ?>
                </div>

                
                <?php if(!empty($data['paymentLink']) && 1 == 2): ?> 
                    <div class="payment-link-section mb-3 p-3" style="background-color: #f8f9fa; border-radius: 8px;">
                        <p class="mb-2"><strong><?php echo app('translator')->get('lang_v1.pay_online'); ?></strong></p>
                        <a href="<?php echo e($data['paymentLink'], false); ?>" target="_blank" class="btn btn-primary d-block w-100">
                            <i class="fas fa-external-link-alt"></i> <?php echo app('translator')->get('lang_v1.open_payment_page'); ?>
                        </a>
                        <div class="mt-3">
                            <small class="text-muted"><?php echo app('translator')->get('lang_v1.or_scan_qr_code'); ?></small>
                            <div class="mt-2">
                                <img class="img-fluid" height="150px" width="150px" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($data['paymentLink'], 'QRCODE', 4, 4, [39, 48, 54]), false); ?>" alt="Payment QR Code" style="border: 1px solid #ddd; padding: 5px; border-radius: 4px;">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <input type="hidden" id="dojo_payment_intent_id" value="<?php echo e($payment_intent_id, false); ?>">
                <input type="hidden" id="dojo_terminal_session_id" value="<?php echo e($terminal_session_id, false); ?>">
                <input type="hidden" id="dojo_ref_transaction_id" value="<?php echo e($transaction_id, false); ?>">

                <div id="dojo_signature_verification" style="display: none;">
                    <div class="d-flex justify-content-center gap-3">
                        <button type="button" id="dojo_accept_signature" class="btn btn-success">
                            <?php echo app('translator')->get('lang_v1.accept_signature'); ?>
                        </button>
                        <button type="button" id="dojo_reject_signature" class="btn btn-danger">
                            <?php echo app('translator')->get('lang_v1.reject_signature'); ?>
                        </button>   
                    </div>
                </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
