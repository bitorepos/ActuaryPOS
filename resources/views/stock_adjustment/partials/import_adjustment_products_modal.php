<div class="modal fade" tabindex="-1" role="dialog" id="import_adjustment_products_modal">
	<div class="modal-dialog modal-lg" role="document">
  		<div class="modal-content">
  			<div class="modal-header">
				<h4 class="modal-title"><?php echo app('translator')->get('product.import_products'); ?></h4>
				<button type="button" class="btn-close no-print" data-bs-dismiss="modal" aria-label="Close"></button>
			    
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<strong><?php echo app('translator')->get( 'product.file_to_import' ); ?>:</strong>
					</div>
					<div class="col-md-12">
						<div id="import_product_dz" class="dropzone"></div>
					</div>
					
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4><?php echo e(__('lang_v1.instructions'), false); ?>:</h4>
						<strong><?php echo app('translator')->get('lang_v1.instruction_line1'); ?></strong><br>
		                    <?php echo app('translator')->get('lang_v1.instruction_line2'); ?>
		                    <br><br>
						<table class="table table-striped">
		                    <tr>
		                        <th><?php echo app('translator')->get('lang_v1.col_no'); ?></th>
		                        <th><?php echo app('translator')->get('lang_v1.col_name'); ?></th>
		                        <th><?php echo app('translator')->get('lang_v1.instruction'); ?></th>
		                    </tr>
		                    <tr>
		                    	<td>1</td>
		                        <td><?php echo app('translator')->get('product.sku'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
		                        <td>Set SKU column type to Text and put an apostrophe before SKU numbers, for example <code>'196382</code>.</td>
		                    </tr>
		                    <tr>
		                    	<td>2</td>
		                        <td><?php echo app('translator')->get('stock_adjustment.counted'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
		                        <td></td>
		                    </tr>
		                </table>
		            </div>
				</div>
			</div>
			<div class="modal-footer">
      			<button type="button" class="btn btn-primary" id="import_stock_adjustment_products"> <?php echo app('translator')->get( 'lang_v1.import' ); ?></button>
      			<button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    		</div>
  		</div>
  	</div>
</div>
