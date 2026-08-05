
<?php $__env->startSection('title', __('barcode.print_labels')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
<br>
    <h1><?php echo app('translator')->get('barcode.print_labels'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.print_label') . '"></i>';
                }
            ?>
        <a href="<?php echo e(action([\App\Http\Controllers\LabelDesignController::class, 'index']), false); ?>" class="btn btn-info btn-sm pull-right" style="margin-left: 10px;">
            <i class="fa fa-paint-brush"></i> <?php echo app('translator')->get('label_design.label_designer'); ?>
        </a>
    </h1>
</section>

<!-- Main content -->
<section class="content no-print" style="overflow-x: hidden;">
	<?php echo Form::open(['url' => '#', 'method' => 'post', 'id' => 'preview_setting_form', 'onsubmit' => 'return false']); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('product.add_product_for_labels')]); ?>
		<div class="row mb-2">
			<div class="col-sm-8">
				<div class="mb-3">
					<div class="input-group flex-nowrap">
						<button type="button" class="btn btn-outline-secondary bg-white" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
						<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product_for_label', 'placeholder' => __('lang_v1.enter_product_name_to_print_labels'), 'autofocus']); ?>

					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="mb-3">
					<?php echo Form::select('location_id', $locations, null, ['class' => 'form-control select2', 'required']); ?>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed table-th-skin" id="product_table" style="width: 100%;">
					<thead>
						<tr>
							<th><?php echo app('translator')->get( 'product.sku' ); ?></th>
							<th><?php echo app('translator')->get( 'barcode.products' ); ?></th>
							<th><?php echo app('translator')->get( 'barcode.no_of_labels' ); ?></th>
							<?php if(request()->session()->get('business.enable_lot_number') == 1): ?>
								<th><?php echo app('translator')->get( 'lang_v1.lot_number' ); ?></th>
							<?php endif; ?>
							<?php if(request()->session()->get('business.enable_product_expiry') == 1): ?>
								<th><?php echo app('translator')->get( 'product.exp_date' ); ?></th>
							<?php endif; ?>
							<th><?php echo app('translator')->get('lang_v1.packing_date'); ?></th>
							<th><?php echo app('translator')->get('lang_v1.selling_price_group'); ?></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php echo $__env->make('labels.partials.show_table_rows', ['index' => 0], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="2" class="text-end"><?php echo app('translator')->get('sale.total'); ?>:</th>
							<th id="total_labels" class="text-center">0</th>
							<th colspan="<?php echo e(3 + (request()->session()->get('business.enable_lot_number') == 1 ? 1 : 0) + (request()->session()->get('business.enable_product_expiry') == 1 ? 1 : 0), false); ?>"></th>
						</tr>
					</tfoot>
				</table>
				</div>
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>

	<?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'barcode.info_in_labels' )]); ?>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-bordered">
					<tr>
						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class ="form-check-input" <?php if($print_label['barcode']): ?> checked <?php endif; ?> name="print[barcode]" value="1"> <b><?php echo app('translator')->get( 'barcode.barcode_size' ); ?></b>
							    </label>
							</div>
							
							<div class="input-group">
      							<div class="input-group-text"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[barcode_size]" 
									value="<?php if($print_label['barcode_size']): ?><?php echo e($print_label['barcode_size'], false); ?><?php else: ?><?php echo e(0.8, false); ?><?php endif; ?>">
							</div>
						</td>
						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class ="form-check-input" <?php if($print_label['name']): ?> checked <?php endif; ?> name="print[name]" value="1"> <b><?php echo app('translator')->get( 'barcode.print_name' ); ?></b>
							    </label>
							</div>

							<div class="input-group">
      							<div class="input-group-text"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[name_size]" 
									value="<?php if($print_label['name_size']): ?><?php echo e($print_label['name_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
							</div>
						</td>

						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class ="form-check-input" <?php if($print_label['variations']): ?> checked <?php endif; ?> name="print[variations]" value="1"> <b><?php echo app('translator')->get( 'barcode.print_variations' ); ?></b>
							    </label>
							</div>

							<div class="input-group">
      							<div class="input-group-text"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[variations_size]" 
									value="<?php if($print_label['variations_size']): ?><?php echo e($print_label['variations_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class="form-check-input" <?php if($print_label['unit']): ?> checked <?php endif; ?> name="print[unit]" value="1" id="is_show_unit"> <b><?php echo app('translator')->get( 'barcode.show_unit' ); ?></b>
							    </label>
							</div>
							<div class="input-group">
      							<div class="input-group-addon"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[unit_size]" 
									value="<?php if($print_label['unit_size']): ?><?php echo e($print_label['unit_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
							</div>
						</td>
						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class="form-check-input" <?php if($print_label['sub_unit']): ?> checked <?php endif; ?> name="print[sub_unit]" value="1" id="is_show_sub_unit"> <b><?php echo app('translator')->get( 'barcode.show_sub_unit' ); ?></b>
							    </label>
							</div>

							<div class="input-group">
      							<div class="input-group-addon"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[sub_unit_size]" 
									value="<?php if($print_label['sub_unit_size']): ?><?php echo e($print_label['sub_unit_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
							</div>

						</td>
						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class="form-check-input" <?php if(!empty($print_label['category'])): ?> checked <?php endif; ?> name="print[category]" value="1"> <b><?php echo app('translator')->get( 'barcode.print_category' ); ?></b>
							    </label>
							</div>

							<div class="input-group">
      							<div class="input-group-addon"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[category_size]" 
									value="<?php if(!empty($print_label['category_size'])): ?><?php echo e($print_label['category_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
							</div>

						</td>
					</tr>
					<tr>
						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class ="form-check-input" <?php if($print_label['price']): ?> checked <?php endif; ?> name="print[price]" value="1" id="is_show_price"> <b><?php echo app('translator')->get( 'barcode.print_price' ); ?></b>
							    </label>
							</div>

							<div class="input-group">
      							<div class="input-group-text"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[price_size]" 
									value="<?php if($print_label['price_size']): ?><?php echo e($print_label['price_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
							</div>

						</td>
						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class ="form-check-input" <?php if($print_label['discount_price']): ?> checked <?php endif; ?> name="print[discount_price]" value="1" id="is_show_discount_price"> <b><?php echo app('translator')->get( 'barcode.show_discount_price' ); ?></b>
							    </label>
							</div>

							<div class="input-group">
      							<div class="input-group-text"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[discount_price_size]" 
									value="<?php if($print_label['discount_price_size']): ?><?php echo e($print_label['discount_price_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
							</div>

						</td>

						<td>
							
							<div class="" id="price_type_div">
								<div class="mb-3">
									<?php echo Form::label('print[price_type]', @trans( 'barcode.show_price' ) . ':'); ?>

									<div class="input-group">
										<span class="input-group-text">
											<i class="fa fa-info"></i>
										</span>
										<?php echo Form::select('print[price_type]', ['inclusive' => __('product.inc_of_tax'), 'exclusive' => __('product.exc_of_tax')], !empty($print_label['price_type']) ? ''.$print_label['price_type'].'' : 'inclusive', ['class' => 'form-control']); ?>

									</div>
								</div>
							</div>

						</td>
					</tr>

					<tr>
						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class ="form-check-input" <?php if($print_label['business_name']): ?> checked <?php endif; ?> name="print[business_name]" value="1"> <b><?php echo app('translator')->get( 'barcode.print_business_name' ); ?></b>
							    </label>
							</div>

							<div class="input-group">
      							<div class="input-group-text"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[business_name_size]" 
									value="<?php if($print_label['business_name_size']): ?><?php echo e($print_label['business_name_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
							</div>
						</td>

						<td>
							<div class="form-check">
							    <label class="form-check-label">
<input type="checkbox" class ="form-check-input" <?php if($print_label['packing_date']): ?> checked <?php endif; ?> name="print[packing_date]" value="1"> <b><?php echo app('translator')->get( 'lang_v1.print_packing_date' ); ?></b>
							    </label>
							</div>

							<div class="input-group">
      							<div class="input-group-text"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
								<input type="text" class="form-control" 
									name="print[packing_date_size]" 
									value="<?php if($print_label['packing_date_size']): ?><?php echo e($print_label['packing_date_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
							</div>
						</td>

						<td>
							<?php if(request()->session()->get('business.enable_lot_number') == 1): ?>
							
								<div class="form-check">
								    <label class="form-check-label">
<input type="checkbox" class ="form-check-input" <?php if($print_label['lot_number']): ?> checked <?php endif; ?> name="print[lot_number]" value="1"> <b><?php echo app('translator')->get( 'lang_v1.print_lot_number' ); ?></b>
								    </label>
								</div>

								<div class="input-group">
      							<div class="input-group-text"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
									<input type="text" class="form-control" 
										name="print[lot_number_size]" 
										value="<?php if($print_label['lot_number_size']): ?><?php echo e($print_label['lot_number_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
								</div>
							<?php endif; ?>
						</td>

						<td>
							<?php if(request()->session()->get('business.enable_product_expiry') == 1): ?>
								<div class="form-check">
								    <label class="form-check-label">
<input type="checkbox" class ="form-check-input" <?php if($print_label['exp_date']): ?> checked <?php endif; ?> name="print[exp_date]" value="1"> <b><?php echo app('translator')->get( 'lang_v1.print_exp_date' ); ?></b>
								    </label>
								</div>

								<div class="input-group">
      							<div class="input-group-text"><b><?php echo app('translator')->get( 'lang_v1.size' ); ?></b></div>
									<input type="text" class="form-control" 
										name="print[exp_date_size]" 
										value="<?php if($print_label['exp_date_size']): ?><?php echo e($print_label['exp_date_size'], false); ?><?php else: ?><?php echo e(11, false); ?><?php endif; ?>">
								</div>
							<?php endif; ?>
						</td>
					</tr>
				</table>
			</div>

			

			

			<div class="col-sm-12">
				<hr/>
			</div>

			<div class="col-sm-4">
				<div class="mb-3">
					<?php echo Form::label('price_type', @trans( 'barcode.barcode_setting' ) . ':'); ?>

					<div class="input-group">
						<span class="input-group-text">
							<i class="fa fa-cog"></i>
						</span>
						<select name="barcode_setting" class="form-select">
							<optgroup label="<?php echo app('translator')->get('barcode.barcode_settings'); ?>">
								<?php $__currentLoopData = $barcode_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bs_id => $bs_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option value="<?php echo e($bs_id, false); ?>" <?php if(!empty($default) && $default->id == $bs_id): ?> selected <?php endif; ?>><?php echo e($bs_name, false); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</optgroup>
							<?php if(!empty($label_design_options) && count($label_design_options) > 0): ?>
								<optgroup label="<?php echo app('translator')->get('label_design.label_designs'); ?>">
									<?php $__currentLoopData = $label_design_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ld_id => $ld_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($ld_id, false); ?>" <?php if(!empty($default) && $default->id == $ld_id): ?> selected <?php endif; ?>><?php echo e($ld_name, false); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</optgroup>
							<?php endif; ?>
						</select>
					</div>
				</div>
			</div>

		<div class="col-sm-4">
			<div class="form-group">
				<?php echo Form::label('label_font', 'Label Font Style:'); ?>

				<div class="input-group">
					<span class="input-group-text">
						<i class="fa fa-font"></i>
					</span>
					<select name="print[label_font]" id="label_font" class="form-select">
						<option value="Arial, Helvetica Neue, Helvetica, sans-serif" style="font-family: Arial, sans-serif" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Arial') !== false): ?> selected <?php endif; ?>>Arial (Default)</option>
						<option value="Verdana, Geneva, sans-serif" style="font-family: Verdana, sans-serif" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Verdana') !== false): ?> selected <?php endif; ?>>Verdana</option>
						<option value="Tahoma, Geneva, sans-serif" style="font-family: Tahoma, sans-serif" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Tahoma') !== false): ?> selected <?php endif; ?>>Tahoma</option>
						<option value="Trebuchet MS, Helvetica, sans-serif" style="font-family: Trebuchet MS, sans-serif" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Trebuchet') !== false): ?> selected <?php endif; ?>>Trebuchet MS</option>
						<option value="Calibri, Candara, sans-serif" style="font-family: Calibri, sans-serif" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Calibri') !== false): ?> selected <?php endif; ?>>Calibri</option>
						<option value="Segoe UI, Tahoma, sans-serif" style="font-family: Segoe UI, sans-serif" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Segoe') !== false): ?> selected <?php endif; ?>>Segoe UI</option>
						<option value="Roboto, Arial, sans-serif" style="font-family: Roboto, sans-serif" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Roboto') !== false): ?> selected <?php endif; ?>>Roboto</option>
						<option value="Courier New, Courier, monospace" style="font-family: Courier New, monospace" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Courier') !== false): ?> selected <?php endif; ?>>Courier New (Monospace)</option>
						<option value="Lucida Console, Monaco, monospace" style="font-family: Lucida Console, monospace" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Lucida') !== false): ?> selected <?php endif; ?>>Lucida Console (Monospace)</option>
						<option value="Georgia, Times New Roman, serif" style="font-family: Georgia, serif" <?php if(!empty($print_label['label_font']) && strpos($print_label['label_font'], 'Georgia') !== false): ?> selected <?php endif; ?>>Georgia (Serif)</option>
					</select>
				</div>
			</div>
		</div>
	<?php echo $__env->renderComponent(); ?>

	<?php echo Form::close(); ?>


	<div class="col-sm-8 hide display_label_div">
		<h3 class="box-title"><?php echo app('translator')->get( 'barcode.preview' ); ?></h3>
		<button type="button" class="col-sm-offset-2 btn btn-success btn-block" id="print_label">Print</button>
	</div>
	<div class="clearfix"></div>
</section>

<!-- Preview section-->
<div id="preview_box">
</div>


<div id="label-print-footer-actions-template" class="d-none">
	<div>
		<button type="button" id="labels_preview" class="btn btn-primary btn-flat"><?php echo app('translator')->get( 'barcode.preview' ); ?></button>
	</div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/labels.js?v=' . $asset_v), false); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>