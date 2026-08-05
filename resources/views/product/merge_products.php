<div class="modal-dialog" role="document">
    <div class="modal-content">

        <?php echo Form::open(['url' => action([\App\Http\Controllers\ProductController::class, 'postMergeProducts']), 'method' => 'post', 'id' => 'merge_products_form']); ?>


            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.merge_products' ); ?></h4>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <?php echo Form::label('merge_from', __('lang_v1.merge_from').':'); ?>

                    <?php echo Form::select('merge_from', [], null, ['class' => 'form-control', 'id' => 'merge_from', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                </div>
                <div class="mb-3">
                    <?php echo Form::label('merge_to', __('lang_v1.merge_to').':'); ?>

                    <?php echo Form::select('merge_to', [], null, ['class' => 'form-control', 'id' => 'merge_to', 'placeholder' => __('messages.please_select'), 'required', 'style' => 'width: 100%;']); ?>

                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.submit' ); ?></button>
                <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
            </div>

        <?php echo Form::close(); ?>


    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
