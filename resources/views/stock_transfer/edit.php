
<?php $__env->startSection('title', __('lang_v1.edit_stock_transfer')); ?>

<?php $__env->startSection('css'); ?>
<style>
	#stock_adjustment_product_table .stock-transfer-money,
	#stock_adjustment_product_table .stock-transfer-money input {
		text-align: right !important;
	}
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.edit_stock_transfer'); ?> <i class="fas fa-keyboard text-muted" title="<?php echo app('translator')->get('lang_v1.stock_transfer_show_shortcuts_help'); ?>: <?php echo e(!empty($shortcuts['stock_transfer']['show_shortcuts_help']) ? strtoupper($shortcuts['stock_transfer']['show_shortcuts_help']) : 'F7', false); ?>" style="font-size: 16px; cursor: pointer;" onclick="$('#stockTransferKeyboardShortcutsModal').modal('show');"></i></h1>
</section>
<?php
$user_settings = json_decode(auth()->user()->user_settings,true);
?>
<!-- Main content -->
<section class="content no-print">
	
	<input type="hidden" id="page_type" value="purchase">
	<?php echo Form::open(['url' => action([\App\Http\Controllers\StockTransferController::class, 'update'], [$sell_transfer->id]), 'method' => 'put', 'id' => 'stock_transfer_form' ]); ?>

	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group mb-2">
						<?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

						<div class="input-group">
							<span class="input-group-text">
								<i class="fa fa-calendar"></i>
							</span>
							<?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($sell_transfer->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), ['class' => 'form-control', 'readonly', 'required']); ?>

						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group mb-2">
						<?php echo Form::label('ref_no', __('purchase.ref_no').':'); ?>

						<?php echo Form::text('ref_no', $sell_transfer->ref_no, ['class' => 'form-control', 'readonly']); ?>

					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group mb-2">
						<?php echo Form::label('status', __('sale.status').':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.completed_status_help') . '"></i>';
                }
            ?>
						<?php echo Form::select('status', $statuses, !empty($user_settings['stock_transfer_default_status']) ? $user_settings['stock_transfer_default_status'] : $sell_transfer->status , 
						array_merge(
							[ 'placeholder' => __('messages.please_select'), 'required', 'id' => 'status'],
							empty($user_settings['stock_transfer_status_readonly']) 
								? ['style' => 'width: 100%;', 'class' => 'form-control select2'] 
								: ['style' => 'pointer-events: none;background-color:#F5F5F5;', 'class' => 'form-control']
						)
						); ?>

					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div class="form-group mb-2">
						<?php echo Form::label('location_id', __('lang_v1.location_from').':*'); ?>

						<?php echo Form::select('location_id', $business_locations, $sell_transfer->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'id' => 'location_id', 'disabled']); ?>

					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group mb-2">
						<?php echo Form::label('transfer_location_id', __('lang_v1.location_to').':*'); ?>

						<?php echo Form::select('transfer_location_id', $business_locations, $purchase_transfer->location_id, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'id' => 'transfer_location_id', 'disabled']); ?>

					</div>
				</div>
				<?php if(!empty($common_settings['enable_stock_issue_receive']) && empty($common_settings['hide_stock_transfer_stock_type_category'])): ?>
					<div class="col-sm-4">
						<div class="mb-3">
							<?php echo Form::label('sub_type', __('lang_v1.stock_type').':*'); ?>

							<?php echo Form::select('sub_type', ['stock_issue' => 'Stock Issue', 'stock_receive' => 'Stock Receive'], $purchase_transfer->sub_type , ['style' => 'width: 100%;', 'required', 'class' => 'form-control select2']); ?>

						</div>
					</div>
					<div class="col-sm-4">
						<div class="mb-3">
							<?php echo Form::label('stock_category_id', __('lang_v1.select_category').':*'); ?>

							<?php echo Form::select('stock_category_id', $categories, $purchase_transfer->stock_category_id, ['class' => 'form-control select2', 'required', 'id' => 'stock_category_id']); ?>

						</div>
					</div>
					<div class="col-sm-2">
						<div class="mb-3">
							<br><button type="button" id="load_products" class="btn btn-primary btn-block" style="margin-top: 4px;">Load Products <i class="hide fas fa-sync fa-spin fa-fw"></i></button>
						</div>
					</div>
				<?php endif; ?>
				<?php if(!empty($pos_settings['allow_overselling'])): ?>
					<input type="hidden" id="is_overselling_allowed">
				<?php endif; ?>

				<?php if(empty($common_settings['hide_stock_transfer_demand_order']) && !empty($demand_orders) && count($demand_orders) > 0): ?>
				<div class="col-sm-12">
					<div class="form-group mb-2">
						<label><?php echo app('translator')->get('manufacturing::lang.demand_order'); ?> :</label>
						<div class="input-group">
							<?php echo Form::select('demand_order_id', $demand_orders, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'id' => 'demand_order_id', 'style' => 'width:auto; min-width:300px;']); ?>

							<button type="button" id="load_demand_order_ingredients" class="btn btn-info" style="margin-left:8px;">
								<i class="fa fa-download"></i> Load Ingredients
								<i class="hide fas fa-sync fa-spin fa-fw" id="do_load_spinner"></i>
							</button>
						</div>
					</div>
				</div>
				<?php endif; ?>

				<?php if(empty($common_settings['hide_stock_transfer_production']) && !empty($has_manufacturing_module)): ?>
					<div class="col-sm-12">
						<div class="form-group mb-2">
							<label>Production (Manufacturing) :</label>
							<div class="input-group">
								<?php echo Form::select('production_id', $productions ?? [], null, ['class' => 'form-control select2', 'placeholder' => empty($productions) ? 'No productions available' : __('messages.please_select'), 'id' => 'production_id', 'style' => 'width:auto; min-width:300px;', empty($productions) ? 'disabled' : '']); ?>

								<button type="button" id="load_production_ingredients" class="btn btn-info" style="margin-left:8px;" <?php echo e(empty($productions) ? 'disabled' : '', false); ?>>
									<i class="fa fa-download"></i> Load Ingredients
									<i class="hide fas fa-sync fa-spin fa-fw" id="prod_load_spinner"></i>
								</button>
							</div>
							<small class="text-muted">Loads consumed ingredients (sell lines) from the selected Manufacturing Production transaction.<?php if(empty($productions)): ?> <em>(Create a Production in Manufacturing &rarr; Productions first.)</em><?php endif; ?></small>
						</div>
					</div>
				<?php endif; ?>
				
			</div>
		</div>
	</div> <!--box end-->
	<div class="box box-primary">
		<div class="box-header">
        	<h3 class="box-title"><?php echo e(__('stock_adjustment.search_products'), false); ?></h3>
       	</div>
		<div class="box-body">
			<div class="row">
				<div class="col-sm-8 offset-sm-2">
					<div class="form-group mb-2">
						<div class="input-group">
							
								<button type="button" class="btn btn-secondary btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
							
							<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product_for_srock_adjustment', 'placeholder' => __('stock_adjustment.search_product')]); ?>

						</div>
					</div>
				</div>
			</div>
			<?php
			$is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id);
			$hide_brand = '';
			if (empty($user_settings['stock_transfer_show_brand_column']) && !$is_admin) {
				$hide_brand = 'hide';
			}
			if(empty(session('business.enable_brand'))){
				$hide_brand = 'hide';
			}
			$hide_category = '';
			if (empty($user_settings['stock_transfer_show_category_column']) && !$is_admin) {
				$hide_category = 'hide';
			}
			if(empty(session('business.enable_category'))){
				$hide_category = 'hide';
			}
			$hide_price = '';
			if (empty($user_settings['stock_transfer_show_price_column']) && !$is_admin) {
				$hide_price = 'hide';
			}
			// Columns before cost total: #, SKU, Product, [Brand], [Category], Qty, Cost Price.
			$colspan = 5 + (empty($hide_brand) ? 1 : 0) + (empty($hide_category) ? 1 : 0);
			?>
			<div class="row">
				<div class="col-sm-12">
					<div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
					<table class="table table-bordered table-striped table-condensed table-th-skin" 
					id="stock_adjustment_product_table">
						<thead>
							<tr>
								<th class="text-nowrap" style="width:1%; min-width:30px">#</th>
								<th class="text-nowrap" style="width:1%; min-width:50px">	
									<?php echo app('translator')->get('product.sku'); ?>
								</th>
								<th class="text-nowrap" style="width:100%">	
									<?php echo app('translator')->get('sale.product'); ?>
								</th>
								<th class="text-nowrap <?php echo e($hide_brand, false); ?>">	
									<?php echo app('translator')->get('product.brand'); ?>
								</th>
								<th class="text-nowrap <?php echo e($hide_category, false); ?>">	
									<?php echo app('translator')->get('product.category'); ?>
								</th>
								<th class="text-nowrap" style="width:1%">
									<?php echo app('translator')->get('sale.qty'); ?>
								</th>
								<th class="text-nowrap text-end stock-transfer-money <?php echo e($hide_price, false); ?>">
									<?php echo app('translator')->get('purchase.cost_price'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
								</th>
								<th class="text-nowrap text-end stock-transfer-money <?php echo e($hide_price, false); ?>">
									<?php echo app('translator')->get('purchase.cost_total'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
								</th>
								<th class="text-nowrap text-end stock-transfer-money">
									<?php echo app('translator')->get('lang_v1.sale_price'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span>
								</th>
								<th class="text-nowrap" style="width:1%; min-width:30px"><i class="fa fa-trash" aria-hidden="true"></i></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$product_row_index = 0;
								$subtotal = 0;
							?>
							<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php echo $__env->make('stock_transfer.partials.product_table_row', ['product' => $product, 'row_index' => $loop->index, 'sub_units' => !empty($product->unit_details) ? $product->unit_details : [], 'user_settings'=> $user_settings, 'is_admin'=> $is_admin], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<?php
									$product_row_index = $loop->index + 1;
									$subtotal += ($product->quantity_ordered*$product->last_purchased_price);
								?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
						<tfoot>
						<?php if(!empty($user_settings['stock_transfer_show_price_column']) || $is_admin): ?>
							<tr>
								<td colspan="<?php echo e($colspan, false); ?>"></td>
								<td class="text-end stock-transfer-money"><b><?php echo app('translator')->get('lang_v1.total_cost_value'); ?>:</b> <span id="total_adjustment"><?php echo e(number_format($subtotal, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span></td>
								<td></td>
								<td></td>
							</tr>
						<?php endif; ?>
						</tfoot>
					</table>
					<input type="hidden" id="product_row_index" value="<?php echo e($product_row_index, false); ?>">
					</div>
				</div>
			</div>
		</div>
	</div> <!--box end-->
	<div class="box box-primary">
		<div class="box-body">
			<div class="row">
				<div class="col-sm-4">
					<div class="form-group mb-2">
							<?php echo Form::label('shipping_charges', __('lang_v1.shipping_charges') . ':'); ?>

							<?php echo Form::text('shipping_charges', number_format($sell_transfer->shipping_charges, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input_number', 'placeholder' => __('lang_v1.shipping_charges')]); ?>

					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-group mb-2">
						<?php echo Form::label('additional_notes',__('purchase.additional_notes')); ?>

						<a href="javascript:void(0)" class="toggle-note">
							<i class="fa <?php echo e(!empty($sell_transfer->additional_notes) ? 'fa-minus-circle text-danger' : 'fa-plus-circle text-success', false); ?>"></i>
						</a>
						<div class="note-wrapper" style="<?php echo e(empty($sell_transfer->additional_notes) ? 'display:none;' : '', false); ?>">
							<?php echo Form::textarea('additional_notes', $sell_transfer->additional_notes, ['class' => 'form-control', 'rows' => 3]); ?>

						</div>
					</div>
				</div>
			</div>
			<?php
				$final_total = $subtotal + $sell_transfer->shipping_charges;
			?>
			<div class="row">
				<div class="col-md-12 text-right">
					<input type="hidden" id="total_amount" name="final_total" value="<?php echo e($sell_transfer->final_total, false); ?>">
					<b><?php echo app('translator')->get('stock_adjustment.total_amount'); ?>:</b> <span id="final_total_text"><?php echo e(number_format($final_total, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></span>
				</div>
				<br>
				<br>
				<div class="col-sm-12">
					<button type="submit" id="save_stock_transfer" class="btn btn-primary float-end stock_transfer_submit_action"><?php echo app('translator')->get('messages.save'); ?></button>
				</div>
			</div>

		</div>
	</div> <!--box end-->
	<?php echo Form::close(); ?>

</section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/stock_transfer.js?v=' . $asset_v), false); ?>"></script>
	<script type="text/javascript">
		__page_leave_confirmation('#stock_transfer_form');
	</script>
	<?php echo $__env->make('stock_transfer.partials.stock_transfer_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('stock_transfer.partials.stock_transfer_keyboard_shortcuts_help_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>