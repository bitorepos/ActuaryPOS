<div class="row">
	<div class="col-md-4">
	    <div class="mb-3">
	        <?php echo Form::label('sr_location_id',  __('purchase.business_location') . ':'); ?>


	        <?php echo Form::select('sr_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

	    </div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" 
            id="supplier_stock_report_table" width="100%">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get('product.sku'); ?></th>
                        <th><?php echo app('translator')->get('sale.product'); ?></th>
                        <th><?php echo app('translator')->get('product.unit'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('purchase.purchase_quantity'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_sold'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_unit_transfered'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_returned'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('report.current_stock'); ?></th>
                        <th class="text-right"><?php echo app('translator')->get('lang_v1.total_stock_price'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr class="bg-gray font-17 text-center footer-total">
                        <td colspan="3"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                        <td class="footer_purchase_quantity text-right"></td>
                        <td class="footer_total_quantity_sold text-right"></td>
                        <td class="footer_total_quantity_transfered text-right"></td>
                        <td class="footer_total_quantity_returned text-right"></td>
                        <td class="footer_current_stock text-right"></td>
                        <td class="footer_stock_price text-right"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
	</div>
</div>
