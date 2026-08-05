<!-- Edit Products Tax Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="bulk_edit_purchase_product_tax_modal">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="bulk_purchase_product_tax_title"><?php echo app('translator')->get('sale.edit_products_tax'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<?php echo Form::label('bulk_purchase_product_tax', __('sale.tax') . ':' ); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-info"></i>
						</span>
						<select name="bulk_purchase_product_tax" id="bulk_purchase_product_tax" class="form-control">
							<option value="" data-tax_amount="0"><?php echo app('translator')->get('lang_v1.none'); ?></option>
							<?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($tax->id, false); ?>" data-tax_amount="<?php echo e($tax->amount, false); ?>" data-tax_type="<?php echo e($tax->type, false); ?>"><?php echo e($tax->name, false); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="bulk_edit_purchase_product_tax_update"><?php echo app('translator')->get('messages.apply'); ?></button>
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.cancel' ); ?></button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
