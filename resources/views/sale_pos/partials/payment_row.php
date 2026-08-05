<div class="col-md-12">
	<div class="box box-primary payment_row bg-lightgray">
		<?php if($removable): ?>
			<div class="box-header">
              <div class="box-tools float-end">
				<?php if(empty($payment_line['id'])): ?>
                <button type="button" class="btn btn-box-tool remove_payment_row"><i class="fa fa-times fa-2x"></i></button>
				<?php endif; ?>
              </div>
            </div>
        <?php endif; ?>

        <?php if(!empty($payment_line['id'])): ?>
        	<?php echo Form::hidden("payment[$row_index][payment_id]", $payment_line['id']); ?>

        <?php endif; ?>

		<div class="box-body" >
			<?php echo $__env->make('sale_pos.partials.payment_row_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	</div>
</div>
