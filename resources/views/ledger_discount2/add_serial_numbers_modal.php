<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">Add Serial Nos.</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="col-md-6">
					<h4>Quantity : <span class="add_sr_modal_qty"> <?php echo e(number_format(1, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></h4>
					<h4>Remaining : <span class="add_sr_modal_qty_remain"> <?php echo e(number_format(0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> </span></h4>
				</div>
				<div class="col-md-6">
					<h4>Cost : <span class="add_sr_modal_cost"> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> </span></h4>
					<h4>Current : <span class="add_sr_modal_current"> <?php echo e(number_format(0, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> </span></h4>
				</div>
				<div class="col-md-12">
					<div class="mb-3">
						<input type="text" class="form-control mousetrap add_serial_no_serial_number" placeholder="Type and Enter to Add"
							   autocomplete="off" data-bs-target="#serial_no_table">
					</div>
				</div>
				<div class="col-md-12 text-center">
					<span class="table_serial_no_row pt-5 pb-5">
					<div class="col-md-2 bg-info"><b>#</b></div>
					<div class="col-md-8 bg-info"><b>Serial No.</b></div>
					<div class="col-md-2 bg-info"><b>X</b></div>
					</span>
				</div>
				<div class="col-md-12" id="serial_no_table"></div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
		</div>
	</div>
</div>
