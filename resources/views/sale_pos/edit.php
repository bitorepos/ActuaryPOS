

<?php $__env->startSection('title', __('sale.pos_sale')); ?>

<?php $__env->startSection('content'); ?>
<div class="loader">
	
	<div class="loading-animation-text"></div>
	<div class="loading-animation"></div>
</div>
<?php
$user_settings = json_decode(auth()->user()->user_settings, true);
$interface_type = (int)($pos_settings[$default_location->id]['hide_product_suggestion'] ?? 0);
$is_big_buttons_interface = $interface_type === 3;
$is_simple_interface = ($interface_type === 0) || $is_big_buttons_interface;
$is_suggestion_interface = $interface_type === 1;
$is_quick_menu_interface = $interface_type === 2;
?>
<?php if($is_big_buttons_interface): ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pos-big-buttons.css?v='.$asset_v), false); ?>">
<?php endif; ?>
<section class="content no-print pos-create-page <?php if(!$is_big_buttons_interface): ?> pos-has-slide-menu <?php endif; ?> <?php if($interface_type === 0): ?> pos-interface-simple <?php elseif($is_suggestion_interface): ?> pos-interface-suggestion <?php elseif($is_quick_menu_interface): ?> pos-interface-quick <?php endif; ?> <?php if($is_big_buttons_interface): ?> pos-interface-big-buttons pos-interface-simple <?php endif; ?>">
	<input type="hidden" id="amount_rounding_method" value="<?php echo e($pos_settings['amount_rounding_method'] ?? '', false); ?>">
	<input type="hidden" id="amount_rounding_method" value="<?php echo e($pos_settings['amount_rounding_method'] ?? '', false); ?>">
	<input type="hidden" id="user_quick_menu_id" value="<?php echo e(Auth::user()->quick_menu_id, false); ?>">
	<input type="hidden" id='allow_table_order_assign_after_bill' <?php if(auth()->user()->can('allow_table_order_assign_after_bill')): ?> value="1" <?php endif; ?>>
	<input type="hidden" id="hide_product_suggestions" value="<?php echo e($pos_settings[$default_location->id]['hide_product_suggestion'], false); ?>">
	<input type="hidden" id="pos_search_box_speed" value="<?php echo e($pos_settings[$default_location->id]['pos_search_box_speed'], false); ?>">
	<input type="hidden" id="ask_deletion_reason" value="<?php echo e($pos_settings[$default_location->id]['ask_deletion_reason'], false); ?>">
	<input type="hidden" id="disable_changing_entered_products_on_pos" <?php if(auth()->user()->can('disable_changing_entered_products_on_pos') && !auth()->user()->hasRole('Admin#'.auth()->user()->business_id)): ?> value="1" <?php endif; ?>>
	<input type="hidden" id="tax_payment_methods" value="">
	<?php if(!empty($pos_settings['allow_overselling'])): ?>
		<input type="hidden" id="is_overselling_allowed">
	<?php endif; ?>
	<?php if(!empty($pos_settings['disable_card_details_modal'])): ?>
	<input type="hidden" id="disable_card_details_modal">
	<?php endif; ?>
	<?php if(!empty($pos_settings['warn_if_no_stock'])): ?>
		<input type="hidden" id="warn_if_no_stock">
	<?php endif; ?>
	<?php if($pos_settings[$default_location->id]['hide_product_suggestion'] == 2): ?>
		<input type="hidden" id="enable_quick_btns" value="1">
	<?php endif; ?>
	<?php if(!empty($pos_settings['restrict_sale_total_zero'])): ?>
		<input type="hidden" id="restrict_sale_total_zero">
	<?php endif; ?>
	<?php if(session('business.enable_rp') == 1): ?>
        <input type="hidden" id="reward_point_enabled">
    <?php endif; ?>
	<input type="hidden" id="customer_discount_type" value="<?php echo e($transaction->contact->discount_type, false); ?>">
	<input type="hidden" id="customer_discount_amount" value="<?php echo e($transaction->contact->discount_amount, false); ?>">
	<input type="hidden" id="customer_not_ask_prompt" value="<?php echo e($transaction->contact->not_ask_prompt, false); ?>">
	<input type="hidden" id="weighing_scale_prefix" value="<?php echo e(session('business.weighing_scale_setting')['label_prefix'], false); ?>">
	<?php if($transaction->status == 'draft' && !empty($common_settings['enable_draft_auto_save'])): ?>
		<input type="hidden" id="draft_auto_save" value="<?php echo e($common_settings['enable_draft_auto_save'], false); ?>">
		<input type="hidden" id="pos_draft_auto_save" value="1">
		<input type="hidden" id="sell_id" value="<?php echo e($transaction->id, false); ?>">
	<?php endif; ?>
	
    <?php
		$is_discount_enabled = $pos_settings['disable_discount'] != 1 ? true : false;
		$is_rp_enabled = session('business.enable_rp') == 1 ? true : false;
	?>
	<?php echo Form::open(['url' => action([\App\Http\Controllers\SellPosController::class, 'update'], [$transaction->id]), 'method' => 'post', 'id' => 'edit_pos_sell_form' ]); ?>

	<?php echo e(method_field('PUT'), false); ?>

	<input type="hidden" name="status" id="status" value="<?php echo e($transaction->status, false); ?>">
	<div class="row mb-12 pos-create-layout <?php if($is_simple_interface): ?> pos-create-layout-simple <?php endif; ?>">
		<div class="col-md-12">
			<div class="row pos-create-main-row <?php if($is_simple_interface): ?> g-3 <?php endif; ?>">
				<div class="<?php if($is_suggestion_interface): ?> col-12 col-lg-8 pr-12 <?php elseif($is_quick_menu_interface): ?> col-12 col-lg-9 pr-0 <?php else: ?> col-12 <?php endif; ?> pos-create-main-col"
				<?php if($is_quick_menu_interface): ?> id="edit_pos_div" <?php endif; ?>>
					<div class="box box-primary mb-12 pos-create-main-box">
						<div class="box-body pb-0">
							<?php echo Form::hidden('location_id', $transaction->location_id, ['id' => 'location_id',
							'data-receipt_printer_type' => !empty($location_printer_type) ? $location_printer_type : 'browser',
							'data-default_payment_accounts' => $transaction->location->default_payment_accounts,
							'data-print-server-url' => $location_print_server_url ?? '']); ?>

							<!-- sub_type -->
							<?php echo Form::hidden('sub_type', isset($sub_type) ? $sub_type : null); ?>

							<input type="hidden" id="item_addition_method" value="<?php echo e($business_details->item_addition_method, false); ?>">
								<?php echo $__env->make('sale_pos.partials.pos_form_edit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

								<?php if($pos_settings[$default_location->id]['hide_product_suggestion'] == 2): ?>
								<?php echo $__env->make('sale_pos.partials.pos_form_totals', ['edit' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<?php endif; ?>

								<?php echo $__env->make('sale_pos.partials.payment_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

								<?php if(empty($pos_settings['disable_suspend'])): ?>
									<?php echo $__env->make('sale_pos.partials.suspend_note_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<?php endif; ?>

								<?php if(empty($pos_settings['disable_recurring_invoice'])): ?>
									<?php echo $__env->make('sale_pos.partials.recurring_invoice_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<?php endif; ?>
							</div>
							<?php if(!empty($only_payment)): ?>
								<div class="overlay"></div>
							<?php endif; ?>
						</div>
					</div>
				<?php if($is_suggestion_interface && !isMobile()): ?>
					<div class="col-12 col-lg-4 no-padding pos-create-side-col">
						<?php echo $__env->make('sale_pos.partials.pos_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
					<?php elseif($is_quick_menu_interface && !isMobile()): ?>
						<div class="col-12 col-lg-3 no-padding" style="display: flex;flex-flow: column;height: 100%;">
							<span class="d-none d-md-inline">
							<?php echo $__env->make('sale_pos.partials.pos_numpad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</span>
							<?php echo $__env->make('sale_pos.partials.pos_form_actions', ['edit' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</div>
					<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if($is_quick_menu_interface): ?>
		<?php if(isMobile()): ?>
		<?php echo $__env->make('sale_pos.partials.pos_form_actions', ['edit' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
			
	<br class="d-none d-xs-block">
	<div class="row" id="quick_menu_div"></div>
	<?php else: ?>
		<?php echo $__env->make('sale_pos.partials.pos_form_actions', ['edit' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
	<?php if(!$is_big_buttons_interface): ?>
		<?php echo $__env->make('sale_pos.partials.pos_slide_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>
	<?php echo Form::close(); ?>

</section>

<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>
<?php if(!$is_offline): ?>
<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<?php echo $__env->make('contact.create', ['quick_add' => true, 'customer'=> true, 'from' => 'pos'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php endif; ?>
<?php if(!empty($pos_settings[$default_location->id]['hide_product_suggestion']) && $pos_settings[$default_location->id]['hide_product_suggestion'] == 1 && isMobile()): ?>
	<?php echo $__env->make('sale_pos.partials.mobile_product_suggestions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!-- /.content -->
<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
</div>
<!-- quick product modal -->

<div class="modal fade" id="edit_quick_menu_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="edit_quick_menu_item_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade no-print" id="show_table_orders_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="table_move_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="dojo_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>

<?php if(!isMobile() && !empty($pos_settings['enable_numeric_keypad_on_input'])): ?>
<?php echo $__env->make('sale_pos.partials.numpad_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php echo $__env->make('sale_pos.partials.qr_order_notification_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sale_pos.partials.table_save_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sale_pos.partials.table_status_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(!empty($pos_settings['prompt_token_no'])): ?>
<?php echo $__env->make('sale_pos.partials.add_token_no_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php echo $__env->make('sale_pos.partials.configure_search_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('sale_pos.partials.recent_transactions_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php echo $__env->make('sale_pos.partials.weighing_scale_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sale_pos.partials.bulk_edit_product_tax_modal', ['selected_tax' => $business_details->default_sales_tax], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sale_pos.partials.bulk_edit_product_discount_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('sale_pos.partials.keyboard_shortcuts_details', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
	<script src="<?php echo e(asset('js/pos.js?v=' . $asset_v . '.' . filemtime(public_path('js/pos.js'))), false); ?>"></script>
	<script src="<?php echo e(asset('js/printer.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/product.js?v=' . $asset_v), false); ?>"></script>
	<script src="<?php echo e(asset('js/opening_stock.js?v=' . $asset_v), false); ?>"></script>
	<?php echo $__env->make('sale_pos.partials.keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('sale_pos.partials.shortcut_hover_tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<!-- Call restaurant module if defined -->
    <?php if(in_array('tables' ,$enabled_modules) || in_array('modifiers' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules)): ?>
    	<script src="<?php echo e(asset('js/restaurant.js?v=' . $asset_v), false); ?>"></script>
    <?php endif; ?>

    <!-- include module js -->
    <?php if(!empty($pos_module_data)): ?>
	    <?php $__currentLoopData = $pos_module_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($value['module_js_path'])): ?>
                <?php if ($__env->exists($value['module_js_path'], ['view_data' => $value['view_data']])) echo $__env->make($value['module_js_path'], ['view_data' => $value['view_data']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
	    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
	<style type="text/css">
		/*CSS to print receipts*/
		.print_section{
		    display: none;
		}
		@media print{
		    .print_section{
		        display: block !important;
		    }
		}
		@page {
		    size: 3.1in auto;/* width height */
		    height: auto !important;
		    margin-top: 0mm;
		    margin-bottom: 0mm;
		}
		.overlay {
			background: rgba(255,255,255,0) !important;
			cursor: not-allowed;
		}
	</style>
	<!-- include module css -->
    <?php if(!empty($pos_module_data)): ?>
        <?php $__currentLoopData = $pos_module_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($value['module_css_path'])): ?>
                <?php if ($__env->exists($value['module_css_path'])) echo $__env->make($value['module_css_path'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>