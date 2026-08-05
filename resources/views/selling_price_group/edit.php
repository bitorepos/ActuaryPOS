<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => action([\App\Http\Controllers\SellingPriceGroupController::class, 'update'], [$spg->id]), 'method' => 'put', 'id' => 'selling_price_group_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.edit_selling_price_group' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  
    </div>

    <div class="modal-body">
      <div class="form-group mb-2">
        <?php echo Form::label('name', __( 'lang_v1.name' ) . ':*'); ?>

          <?php echo Form::text('name', $spg->name, ['class' => 'form-control', 'required', 'placeholder' => __( 'lang_v1.name' ) ]); ?>

      </div>

      <div class="form-group mb-2">
        <?php echo Form::label('description', __( 'lang_v1.description' ) . ':'); ?>

          <?php echo Form::textarea('description', $spg->description, ['class' => 'form-control','placeholder' => __( 'lang_v1.description' ), 'rows' => 3]); ?>

      </div>
      
      <?php
      $pos_settings = !empty(session('business.pos_settings')) ? json_decode(session('business.pos_settings'), true) : [];
      ?>
      <?php if(!empty($pos_settings['enable_msp'])): ?>
      <div class="form-group mb-2">
        <br>
        <label class="form-check-label">
<?php echo Form::checkbox('sp_as_min', 1, $spg->sp_as_min, ['class' => 'form-check-input', 'id' => 'sp_as_min']); ?> <?php echo app('translator')->get('lang_v1.sale_price_is_minimum_sale_price'); ?>
        </label>
      </div>
      <?php endif; ?>
    </div>

    <div class="modal-footer">
      <button type="submit" class="btn btn-primary"><?php echo app('translator')->get( 'messages.update' ); ?></button>
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>

    <?php echo Form::close(); ?>


  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
