<div class="modal-dialog" role="document">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\SellController::class, 'updateLocation'], [$transaction->id]), 'method' => 'put', 'id' => 'change_sell_location_form']); ?>

    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">
                <?php echo app('translator')->get('lang_v1.change_sell_location'); ?> - <?php echo e($transaction->invoice_no, false); ?>

            </h4>
        </div>

        <div class="modal-body">
            <div class="mb-3">
                <?php echo Form::label('current_location', __('lang_v1.current_location') . ':'); ?>

                <p class="form-control-static">
                    <?php echo e(optional($transaction->location)->name, false); ?>

                </p>
            </div>

            <?php if($business_locations->count()): ?>
                <div class="mb-3">
                    <?php echo Form::label('location_id', __('lang_v1.new_location') . ':*'); ?>

                    <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width: 100%;', 'placeholder' => __('messages.please_select'), 'required']); ?>

                </div>

                <?php if($transaction->payment_status != 'due'): ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <?php echo Form::checkbox('move_payments', 1, true, ['class' => 'form-check-input']); ?>

                            <?php echo app('translator')->get('lang_v1.move_sell_payments_to_new_location'); ?>
                        </label>
                    </div>
                <?php else: ?>
                    <?php echo Form::hidden('move_payments', 1); ?>

                <?php endif; ?>
            <?php else: ?>
                <div class="alert alert-warning mb-0">
                    <?php echo app('translator')->get('lang_v1.no_location_access_found'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" <?php if(!$business_locations->count()): ?> disabled <?php endif; ?>>
                <?php echo app('translator')->get('messages.update'); ?>
            </button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div>
    <?php echo Form::close(); ?>

</div>
