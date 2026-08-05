<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">
				<?php echo e($product->product_name, false); ?>

				&nbsp;(<?php echo e($product->sub_sku, false); ?>)
			</h4>
		</div>
		<div class="modal-body">
			<div class="row">
                <div class="col-md-12"></div>
				<div class="col-md-12">
                    <div class="mb-3">
                        <?php echo Form::label('booking_date_range', __('lang_v1.select_date_range') . ':'); ?>

                        <?php echo Form::text('products['.$row_count.'][booking_date_range]', !empty($product->booking_date_range) ? $product->booking_date_range : null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control booking_date_range', 'readonly', 'id' => 'booking_date_range']); ?>

						<?php echo Form::hidden('products['.$row_count.'][selected_booking_dates]', !empty($product->product_bookings) ? $product->product_bookings : null, ['class'=> 'selected_booking_dates']); ?>


						<!-- Hidden field for user computer date (yyyy-mm-dd) -->
						<input type="hidden" id="user_computer_date_<?php echo e($row_count, false); ?>" name="products[<?php echo e($row_count, false); ?>][user_computer_date]" />
						<input type="hidden" id="user_computer_time_<?php echo e($row_count, false); ?>" name="products[<?php echo e($row_count, false); ?>][user_computer_time]" />
                    </div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
            <button type="button" class="btn btn-primary booking_select_time" data-row_count="<?php echo e($row_count, false); ?>" data-product_id="<?php echo e($product->product_id, false); ?>" data-variation_id="<?php echo e($product->variation_id, false); ?>"><?php echo app('translator')->get('lang_v1.booking_select_time'); ?></button>
			<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
		</div>
	</div>
</div>
