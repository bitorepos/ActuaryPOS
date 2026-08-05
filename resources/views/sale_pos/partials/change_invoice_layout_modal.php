<div class="modal fade" id="change_invoice_layout_modal" tabindex="-1" role="dialog" aria-labelledby="changeInvoiceLayoutModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="changeInvoiceLayoutModalLabel">Change Layout</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo app('translator')->get('messages.close'); ?>"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="change_invoice_layout_print_url">
                <div class="form-group">
                    <?php echo Form::label('change_invoice_layout_id', __('invoice.invoice_layouts') . ':'); ?>

                    <?php echo Form::select('change_invoice_layout_id', $invoice_layouts ?? [], null, ['class' => 'form-control select2', 'id' => 'change_invoice_layout_id', 'style' => 'width: 100%;']); ?>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="print_changed_invoice_layout">
                    <i class="fas fa-print"></i> <?php echo app('translator')->get('messages.print'); ?>
                </button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">
                    <?php echo app('translator')->get('messages.close'); ?>
                </button>
            </div>
        </div>
    </div>
</div>
