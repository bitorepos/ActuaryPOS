<div class="modal fade" id="dojo_refund_amount_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">
                    <i class="fas fa-credit-card"></i> <?php echo app('translator')->get('lang_v1.dojo_refund'); ?>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="dojo_refund_amount_input"><?php echo app('translator')->get('lang_v1.refund_amount'); ?>:</label>
                    <div class="input-group">
                        <input type="number" step="0.01" min="0.01" class="form-control input-lg" 
                            id="dojo_refund_amount_input" placeholder="0.00" required>
                    </div>
                    <p class="text-muted mt-1">
                        <?php echo app('translator')->get('lang_v1.max'); ?>: <span id="dojo_refund_max_amount" class="fw-bold"></span>
                    </p>
                    <p class="text-muted">
                        <?php echo app('translator')->get('sale.invoice_no'); ?>: <span id="dojo_refund_invoice_display" class="fw-bold"></span>
                    </p>
                </div>
                <input type="hidden" id="dojo_refund_transaction_id_input" value="">
                <input type="hidden" id="dojo_refund_invoice_no_input" value="">
                <input type="hidden" id="dojo_refund_is_return_input" value="">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.cancel'); ?></button>
                <button type="button" class="btn btn-primary" id="dojo_refund_proceed_btn">
                    <i class="fas fa-check"></i> <?php echo app('translator')->get('lang_v1.proceed'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="dojo_refund_terminal_modal" tabindex="-1" role="dialog" data-bs-backdrop="static" data-bs-keyboard="false"></div>
