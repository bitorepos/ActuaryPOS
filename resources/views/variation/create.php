<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\VariationTemplateController::class, 'store']), 'method' => 'post', 'id' => 'variation_add_form', 'class' => 'form-horizontal' ]); ?>

    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get('lang_v1.add_variation'); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name',__('lang_v1.variation_name') . ':*', ['class' => 'col-sm-3 control-label']); ?>


        <div class="col-sm-12">
          <?php echo Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder' => __('lang_v1.variation_name')]); ?>

        </div>
      </div>
      <div class="row form-group mb-2">
        <label class="col-sm-3 control-label"><?php echo app('translator')->get('lang_v1.add_variation_values'); ?>:*</label>
        <div class="col-sm-7">
           <?php echo Form::text('variation_values[]', null, ['class' => 'form-control', 'required']); ?>

        </div>
        <div class="col-sm-2">
          <button type="button" class="btn btn-primary" id="add_variation_values">+</button>
        </div>
      </div>
      <div id="variation_values"></div>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.save'); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
