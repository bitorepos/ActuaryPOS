<div class="modal fade" id="table_status_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
<div class="modal-dialog modal-sm" role="document" style="padding-top:10%">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-center">
					 Set <span id="table_status_modal_table_name"></span> Status
				</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" id="qm_table_id" value="">
				<?php echo Form::select('reserve_contact_id', [], null, ['class' => 'form-control', 'id' => 'reserve_customer_id', 'placeholder' => 'Enter Customer name / phone', 'style'=>'width:100%']); ?>


				<span class="hide" id="status_guest_content">
					<label></label>
					<select class="form-control" id="status_guest_count">
						<option value="0">No of Guests</option>
						<?php for($i=1;$i<50;$i++): ?>
							<option value="<?php echo e($i, false); ?>"><?php echo e($i, false); ?></option>
						<?php endfor; ?>
					</select>
				</span>
				<label></label>
				<div class="d-grid gap-2">
					<button class="btn btn-lg btn-warning" id="place_qm_table_order" style="padding:20px auto;" value="place_order">
						Place Order
					</button>
					<button class="btn btn-lg btn-primary" id="set_qm_table_status" style="padding:20px auto;" value="ready">
						Ready
					</button>
					<button class="btn btn-lg btn-success" id="set_qm_table_status" style="padding:20px auto;" value="reserved">
						Reserved
					</button>
					<button class="btn btn-lg btn-danger" id="set_qm_table_status" style="padding:20px auto;" value="out_of_order">
						Out of Order
					</button>
					<button class="btn btn-lg bg-secondary" style="padding:20px auto;" data-bs-dismiss="modal">
						Close
					</button>
				</div>
	
			</div>			
		</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div>
