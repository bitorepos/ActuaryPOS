<div class="modal fade d-print-none" tabindex="-1" role="dialog" id="qr_order_notification_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fas fa-bell text-warning"></i> <?php echo app('translator')->get('lang_v1.system_notification'); ?></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="qr_order_notification_body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
            </div>
        </div>
    </div>
</div>
