<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            
            <h4 class="modal-title text-center" id="modalTitle"><?php echo e($product->name, false); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <?php echo $product->product_description; ?>

                </div>
                
                
            </div>
        </div>
        <div class="modal-footer">
            
            <button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
