<div class="modal fade" tabindex="-1" role="dialog" id="import_sale_return_products_modal">
	<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
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
						<div id="import_sale_return_product_dz" class="dropzone"></div>
					</div>
					<div class="col-md-12 mt-10">
						<a href="<?php echo e(asset('files/import_sale_return_products_template.xls'), false); ?>" class="btn btn-success" download><i class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_template_file'); ?></a>
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
		                        <td></td>
		                    </tr>
		                    <tr>
		                    	<td>2</td>
		                        <td><?php echo app('translator')->get('lang_v1.return_quantity'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.required'); ?>)</small></td>
		                        <td></td>
		                    </tr>
		                    <tr>
		                    	<td>3</td>
		                        <td><?php echo app('translator')->get('sale.unit_price'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
		                        <td></td>
		                    </tr>
		                    <tr>
		                    	<td>4</td>
		                        <td><?php echo app('translator')->get( 'lang_v1.discount_percent' ); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
		                        <td></td>
		                    </tr>
		                    <tr>
		                    	<td>5</td>
		                        <td><?php echo app('translator')->get('lang_v1.return_status'); ?> <small class="text-muted">(<?php echo app('translator')->get('lang_v1.optional'); ?>)</small></td>
		                        <td>normal / damage</td>
		                    </tr>
		                </table>
		            </div>
				</div>
			</div>
			<div class="modal-footer">
      			<button type="button" class="btn btn-primary" id="import_sale_return_products"> <?php echo app('translator')->get( 'lang_v1.import' ); ?></button>
      			<button type="button" class="btn btn-default no-print" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    		</div>
  		</div>
  	</div>
</div>
