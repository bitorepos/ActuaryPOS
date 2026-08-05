<div class="modal-dialog" role="document">
    <?php echo Form::open([
        'url' => action([\App\Http\Controllers\PurchaseController::class, 'updateShippingCharges'], [$purchase->id]),
        'method' => 'put',
        'id' => 'add_purchase_shipping_charges_form',
        'files' => true,
    ]); ?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo app('translator')->get('purchase.add_shipping_charges'); ?> - <?php echo e($purchase->ref_no, false); ?></h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <?php echo Form::label('shipping_charges', __('purchase.additional_shipping_charges') . ':*'); ?>

                        <?php echo Form::text(
                            'shipping_charges',
                            number_format(
                                $purchase->shipping_charges / $purchase->exchange_rate,
                                $currency_precision,
                                $currency_details->decimal_separator,
                                $currency_details->thousand_separator,
                            ),
                            ['class' => 'form-control input_number', 'required', 'autofocus'],
                        ); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-3">
                        <?php echo Form::label('shipping_charge_note', __('purchase.additional_notes') . ':'); ?>

                        <?php echo Form::textarea('shipping_charge_note', null, ['class' => 'form-control', 'rows' => 3]); ?>

                    </div>
                </div>
                <?php if(in_array('upload_documents', $enabled_modules)): ?>
                <div class="col-md-12">
                    <div class="mb-3">
                        <?php echo Form::label('shipping_documents', __('lang_v1.shipping_documents') . ':'); ?>

                        <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                        <?php echo Form::file('shipping_documents[]', ['id' => 'shipping_documents', 'multiple', 'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types')))]); ?>

                    </div>
                    <?php
                        $medias = $purchase->media->where('model_media_type', 'shipping_document')->all();
                    ?>
                    <?php if(count($medias)): ?>
                        <?php echo $__env->make('sell.partials.media_table', ['medias' => $medias, 'delete' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
            <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
    <?php echo Form::close(); ?>

</div>

<script type="text/javascript">
    $(document).ready(function() {
        if ($('#shipping_documents').length) {
            $('#shipping_documents').fileinput({
                showUpload: false,
                showPreview: false,
                browseLabel: '',
                removeLabel: '',
                cancelLabel: '',
            });
        }
    });
</script>
