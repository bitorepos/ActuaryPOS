

<?php $__env->startSection('title', 'POS'); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<!-- <section class="content-header">
    <h1>Add Purchase</h1> -->
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
<!-- </section> -->

<!-- Main content -->
<section class="content no-print">
	<?php if(!empty($pos_settings['allow_overselling'])): ?>
		<input type="hidden" id="is_overselling_allowed">
	<?php endif; ?>
	<?php if(session('business.enable_rp') == 1): ?>
        <input type="hidden" id="reward_point_enabled">
    <?php endif; ?>
	<div class="row">
		<div class="<?php if(!empty($pos_settings['hide_product_suggestion']) && !empty($pos_settings['hide_recent_trans'])): ?> col-md-10 col-md-offset-1 <?php else: ?> col-md-7 <?php endif; ?> col-sm-12">
			<?php $__env->startComponent('components.widget', ['class' => 'box-success']); ?>
				<?php $__env->slot('header'); ?>
					<div class="col-sm-6">
						<h3 class="box-title">POS Terminal <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true" data-container="body" data-bs-toggle="popover" data-placement="bottom" data-content="<?php echo $__env->make('sale_pos.partials.keyboard_shortcuts_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>" data-html="true" data-trigger="hover" data-original-title="" title=""></i></h3>
					</div>
					<div class="col-sm-6">
						<p class="text-right"><strong><?php echo app('translator')->get('sale.location'); ?>:</strong> <?php echo e($default_location->name, false); ?></p>
					</div>
					<input type="hidden" id="item_addition_method" value="<?php echo e($business_details->item_addition_method, false); ?>">
				<?php $__env->endSlot(); ?>
				<?php echo Form::open(['url' => action([\App\Http\Controllers\SellPosController::class, 'store']), 'method' => 'post', 'id' => 'add_pos_sell_form' ]); ?>


				<?php echo Form::hidden('location_id', $default_location->id, ['id' => 'location_id', 'data-receipt_printer_type' => !empty($default_location->receipt_printer_type) ? $default_location->receipt_printer_type : 'browser', 'data-paymnet_labels' => $default_location->default_payment_accounts], 'data-default_accounts' => $default_location->default_payment_accounts]); ?>


				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<?php if(!empty($user_settings['enable_transaction_date'])): ?>
							<div class="col-md-4 col-sm-6">
								<div class="mb-3">
									<?php echo Form::label('transaction_date', __('sale.sale_date') . ':*'); ?>

									<div class="input-group">
										<span class="input-group-text">
											<i class="fa fa-calendar"></i>
										</span>
										<?php echo Form::text('transaction_date', $default_datetime, ['class' => 'form-control', 'readonly', 'required']); ?>

									</div>
								</div>
							</div>
						<?php endif; ?>
						<?php if(config('constants.enable_sell_in_diff_currency') == true): ?>
							<div class="col-md-4 col-sm-6">
								<div class="mb-3">
									<div class="input-group">
										<span class="input-group-text">
											<i class="fas fa-exchange-alt"></i>
										</span>
										<?php echo Form::text('exchange_rate', config('constants.currency_exchange_rate'), ['class' => 'form-control input-sm input_number', 'placeholder' => __('lang_v1.currency_exchange_rate'), 'id' => 'exchange_rate']); ?>

									</div>
								</div>
							</div>
						<?php endif; ?>
						<?php if(!empty($price_groups) && count($price_groups) > 1): ?>
							<div class="col-md-4 col-sm-6">
								<div class="mb-3">
									<div class="input-group">
										<span class="input-group-text">
											<i class="fas fa-money-bill-alt"></i>
										</span>
										<?php
											reset($price_groups);
											$selected_price_group = !empty($default_price_group_id) && array_key_exists($default_price_group_id, $price_groups) ? $default_price_group_id : null;
										?>
										<?php echo Form::hidden('hidden_price_group', key($price_groups), ['id' => 'hidden_price_group']); ?>

										<?php echo Form::select('price_group', $price_groups, $selected_price_group, ['class' => 'form-control select2', 'id' => 'price_group', 'style' => 'width: 100%;']); ?>

										<span class="input-group-text">
											<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.price_group_help_text') . '"></i>';
                }
            ?>
										</span> 
									</div>
								</div>
							</div>
						<?php else: ?>
							<?php
								reset($price_groups);
							?>
							<?php echo Form::hidden('price_group', key($price_groups), ['id' => 'price_group']); ?>

						<?php endif; ?>
						<?php if(!empty($default_price_group_id)): ?>
							<?php echo Form::hidden('default_price_group', $default_price_group_id, ['id' => 'default_price_group']); ?>

						<?php endif; ?>

						<?php if(in_array('types_of_service', $enabled_modules) && !empty($types_of_service)): ?>
							<div class="col-md-4 col-sm-6">
								<div class="mb-3">
									<div class="input-group">
										<span class="input-group-text">
											<i class="fa fa-external-link text-primary service_modal_btn"></i>
										</span>
										<?php echo Form::select('types_of_service_id', $types_of_service, null, ['class' => 'form-control', 'id' => 'types_of_service_id', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.select_types_of_service')]); ?>


										<?php echo Form::hidden('types_of_service_price_group', null, ['id' => 'types_of_service_price_group']); ?>


										<span class="input-group-text">
											<?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.types_of_service_help') . '"></i>';
                }
            ?>
										</span> 
									</div>
									<small><p class="help-block hide" id="price_group_text"><?php echo app('translator')->get('lang_v1.price_group'); ?>: <span></span></p></small>
								</div>
							</div>
							<div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
						<?php endif; ?>

						<?php if(in_array('subscription', $enabled_modules)): ?>
							<div class="col-md-4 float-end col-sm-6">
								<div class="form-check">
									<label class="form-check-label">
<?php echo Form::checkbox('is_recurring', 1, false, ['class' => 'form-check-input', 'id' => 'is_recurring']); ?> <?php echo app('translator')->get('lang_v1.subscribe'); ?>?
						            </label><button type="button" data-bs-toggle="modal" data-bs-target="#recurringInvoiceModal" class="btn btn-link"><i class="fa fa-external-link"></i></button><?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.recurring_invoice_help') . '"></i>';
                }
            ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="row">
						<div class="<?php if(!empty($commission_agent)): ?> col-sm-4 <?php else: ?> col-sm-6 <?php endif; ?>">
							<div class="mb-3" style="width: 100% !important">
								<div class="input-group">
									<span class="input-group-text">
										<i class="fa fa-user"></i>
									</span>
									<input type="hidden" id="default_customer_id" 
									value="<?php echo e($walk_in_customer['id'], false); ?>" >
									<input type="hidden" id="default_customer_name" 
									value="<?php echo e($walk_in_customer['name'], false); ?>" >
									<?php echo Form::select('contact_id', 
										[], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 100%;']); ?>

									<span class="input-group-btn">
										<button type="button" class="btn btn-default bg-white btn-flat add_new_customer" data-name=""  <?php if(!auth()->user()->can('customer.create')): ?> disabled <?php endif; ?>><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
									</span>
								</div>
							</div>
						</div>
						<input type="hidden" name="pay_term_number" id="pay_term_number" value="<?php echo e($walk_in_customer['pay_term_number'], false); ?>">
						<input type="hidden" name="pay_term_type" id="pay_term_type" value="<?php echo e($walk_in_customer['pay_term_type'], false); ?>">
						
						<?php if(!empty($commission_agent)): ?>
							<div class="col-sm-4">
								<div class="mb-3">
								<?php echo Form::select('commission_agent', 
											$commission_agent, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.commission_agent')]); ?>

								</div>
							</div>
						<?php endif; ?>

						<div class="<?php if(!empty($commission_agent)): ?> col-sm-4 <?php else: ?> col-sm-6 <?php endif; ?>">
							<div class="mb-3">
								<div class="input-group">
									<div class="input-group-btn">
										<button type="button" class="btn btn-default bg-white btn-flat" data-bs-toggle="modal" data-bs-target="#configure_search_modal" title="<?php echo e(__('lang_v1.configure_product_search'), false); ?>"><i class="fa fa-barcode"></i></button>
									</div>
									<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'),
									'disabled' => is_null($default_location)? true : false,
									'autofocus' => is_null($default_location)? false : true,
									]); ?>

									<span class="input-group-btn">
										<button type="button" class="btn btn-default bg-white btn-flat pos_add_quick_product" data-href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'quickAdd']), false); ?>" data-container=".quick_add_product_modal"><i class="fa fa-plus-circle text-primary fa-lg"></i></button>
									</span>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>

						<!-- Call restaurant module if defined -->
				        <?php if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules)): ?>
				        	<span id="restaurant_module_span">
				          		<div class="col-md-3"></div>
				        	</span>
				        <?php endif; ?>
			        </div>

					<div class="row">
					<div class="col-sm-12 pos_product_div">
						<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="<?php echo e($business_details->sell_price_tax, false); ?>">

						<!-- Keeps count of product rows -->
						<input type="hidden" id="product_row_count" 
							value="0">
						<?php
							$hide_tax = '';
							if( session()->get('business.enable_inline_tax') == 0){
								$hide_tax = 'hide';
							}
						?>
						<div class="table-responsive">
						<table class="table table-condensed table-th-skin table-bordered table-striped" id="pos_table">
							<thead>
								<tr>
									<th class="tex-center <?php if(!empty($pos_settings['inline_service_staff'])): ?> col-md-3 <?php else: ?> col-md-4 <?php endif; ?>">	
										<?php echo app('translator')->get('sale.product'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_sell_product_column') . '"></i>';
                }
            ?>
									</th>
									<th class="text-center col-md-3">
										<?php echo app('translator')->get('sale.qty'); ?>
									</th>
									<?php if(!empty($pos_settings['inline_service_staff'])): ?>
										<th class="text-center col-md-2">
											<?php echo app('translator')->get('restaurant.service_staff'); ?>
										</th>
									<?php endif; ?>
									<th class="text-center col-md-2 <?php echo e($hide_tax, false); ?>">
										<?php echo app('translator')->get('sale.price_inc_tax'); ?>
									</th>
									<th class="text-center col-md-2">
										<?php echo app('translator')->get('sale.subtotal'); ?>
									</th>
									<th class="text-center"><i class="fa fa-close" aria-hidden="true"></i></th>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
						</div>
						</div>
					</div>
					<?php echo $__env->make('sale_pos.partials.pos_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<?php echo $__env->make('sale_pos.partials.payment_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

					<?php if(empty($pos_settings['disable_suspend'])): ?>
						<?php echo $__env->make('sale_pos.partials.suspend_note_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php endif; ?>

					<?php if(empty($pos_settings['disable_recurring_invoice'])): ?>
						<?php echo $__env->make('sale_pos.partials.recurring_invoice_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					<?php endif; ?>
				</div>
				<!-- /.box-body -->
				<?php echo Form::close(); ?>

			<?php echo $__env->renderComponent(); ?>
		</div>

		<div class="col-md-5 col-sm-12">
			<?php echo $__env->make('sale_pos.partials.right_div', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	</div>
</section>

<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<?php echo $__env->make('contact.create', ['quick_add' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->


<?php echo $__env->make('sale_pos.partials.configure_search_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/pos.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/printer.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/opening_stock.js?v=' . $asset_v), false); ?>"></script>
	<?php echo $__env->make('sale_pos.partials.keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!-- Call restaurant module if defined -->
    <?php if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules)): ?>
    	<script src="<?php echo e(asset('js/restaurant.js?v=' . $asset_v), false); ?>"></script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>