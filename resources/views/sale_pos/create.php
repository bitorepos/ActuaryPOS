

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
// Big Buttons uses its own kiosk layout. Internally treat it like the
// "Simple" path (full-width pos_form, no quick menu, no sidebar) and add
// kiosk-specific panels via the big_buttons_panels partial.
$is_simple_interface = ($interface_type === 0) || $is_big_buttons_interface;
$is_suggestion_interface = $interface_type === 1;
$is_quick_menu_interface = $interface_type === 2;
?>
<?php if($is_big_buttons_interface): ?>
<link rel="stylesheet" href="<?php echo e(asset('css/pos-big-buttons.css?v='.filemtime(public_path('css/pos-big-buttons.css'))), false); ?>">
<?php endif; ?>
<section class="content no-print pos-create-page <?php if(!$is_big_buttons_interface): ?> pos-has-slide-menu <?php endif; ?> <?php if($interface_type === 0): ?> pos-interface-simple <?php elseif($is_suggestion_interface): ?> pos-interface-suggestion <?php elseif($is_quick_menu_interface): ?> pos-interface-quick <?php endif; ?> <?php if($is_big_buttons_interface): ?> pos-interface-big-buttons pos-interface-simple <?php endif; ?>">
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
	<?php if(!empty($pos_settings['show_change_return_modal'])): ?>
		<input type="hidden" id="show_change_return_modal">
	<?php endif; ?>
	<?php if(!empty($pos_settings['warn_if_no_stock'])): ?>
		<input type="hidden" id="warn_if_no_stock">
	<?php endif; ?>
	<?php if(!empty($pos_settings['warn_if_product_not_found'])): ?>
		<input type="hidden" id="warn_if_product_not_found">
	<?php endif; ?>
	<?php if(!empty($pos_settings['enable_customer_display'])): ?>
		<input type="hidden" id="enable_customer_display">
		<input type="hidden" id="customer_display_height" value="<?php echo e($pos_settings['customer_display_height'], false); ?>">
		<input type="hidden" id="customer_display_width" value="<?php echo e($pos_settings['customer_display_width'], false); ?>">
		<input type="hidden" id="customer_display_data_timeout" value="<?php echo e($pos_settings['customer_display_data_timeout'], false); ?>">
	<?php endif; ?>
	<?php if(!empty($pos_settings['set_payment_modal_amount_zero'])): ?>
		<input type="hidden" id="set_payment_modal_amount_zero">
	<?php endif; ?>
	<?php if(!empty($pos_settings['restrict_sale_total_zero'])): ?>
		<input type="hidden" id="restrict_sale_total_zero">
	<?php endif; ?>
	<?php if($is_quick_menu_interface): ?>
		<input type="hidden" id="enable_quick_btns" value="1">
	<?php endif; ?>

	<?php if(!empty($pos_settings['enable_cash_pull'])): ?>
		<input type="hidden" id="cash_pull_limit" value="<?php echo e($pos_settings['cash_pull_limit'], false); ?>">
		<input type="hidden" id="cash_pull_warn_interval" value="<?php echo e(!is_null($pos_settings['cash_pull_warn_interval']) ? $pos_settings['cash_pull_warn_interval'] : 10, false); ?>">
	<?php endif; ?>
	<?php if($is_offline): ?>
		<input type="hidden" id="offline_background_sync">
		<?php if(!empty($pos_settings['enable_cash_register_sync_with_workstations'])): ?>
			<input type="hidden" id="offline_cash_register_background_sync">
		<?php endif; ?>
	<?php endif; ?>
	<?php if(session('business.enable_rp') == 1): ?>
        <input type="hidden" id="reward_point_enabled">
    <?php endif; ?>
	<?php if(session('status')): ?>
		<?php if(!empty(session('status.open_modal'))): ?>
			<input type="hidden" id="open_modal_span" data-for="<?php echo e(session('status.open_modal.for'), false); ?>" data-id="<?php echo e(session('status.open_modal.id'), false); ?>" data-fbr_msg="<?php echo e(session('status.fbr_msg'), false); ?>"
			data-print="<?php echo e(session('status.open_modal.print'), false); ?>" data-auto_print="<?php echo e(session('status.open_modal.auto_print'), false); ?>" data-print_out="<?php echo e(session('status.open_modal.print_out'), false); ?>" data-from_pos="<?php echo e(session('status.open_modal.from_pos'), false); ?>" data-invoice_layout_id="<?php echo e(session('status.open_modal.invoice_layout_id'), false); ?>">
		<?php endif; ?>
	<?php endif; ?>
	<input type="hidden" id="customer_discount_type" value="">
	<input type="hidden" id="customer_discount_amount" value="">
	<input type="hidden" id="customer_not_ask_prompt" value="">
	<input type="hidden" id="weighing_scale_prefix" value="<?php echo e(session('business.weighing_scale_setting')['label_prefix'], false); ?>">
	<?php if(!empty($common_settings['enable_draft_auto_save'])): ?>
		<input type="hidden" id="draft_auto_save" value="<?php echo e($common_settings['enable_draft_auto_save'], false); ?>">
		<input type="hidden" id="pos_draft_auto_save" value="1">
		<input type="hidden" id="sell_id" value="">
	<?php endif; ?>
		
    <?php
		$is_discount_enabled = $pos_settings['disable_discount'] != 1 ? true : false;
		$is_rp_enabled = session('business.enable_rp') == 1 ? true : false;
	?>
	<?php echo Form::open(['url' => action([\App\Http\Controllers\SellPosController::class, 'store']), 'method' => 'post', 'id' => 'add_pos_sell_form' ]); ?>

	<?php echo Form::hidden('request_uuid', null, ['id' => 'request_uuid']); ?>

	<div class="row mb-12 pos-create-layout <?php if($is_simple_interface): ?> pos-create-layout-simple <?php endif; ?>">
		<div class="col-md-12 p-0">
			<div class="row pos-create-main-row <?php if($is_simple_interface): ?> g-3 <?php endif; ?>">
				<div class="<?php if($is_suggestion_interface): ?> col-12 col-lg-8 pr-12 <?php elseif($is_quick_menu_interface): ?> col-12 col-lg-9 pr-0 <?php else: ?> col-12 <?php endif; ?> pos-create-main-col px-0"
				<?php if($is_quick_menu_interface): ?> style="padding-left: 10px;" <?php endif; ?>
				<?php if($is_quick_menu_interface): ?> id="create_pos_div" <?php endif; ?>>
					<div class="box box-primary pos-create-main-box">
						<div class="box-body pb-0 pt-0">
							<?php echo Form::hidden('location_id', $default_location->id ?? null , ['id' => 'location_id', 
							'data-receipt_printer_type' => !empty($default_location->receipt_printer_type) ? $default_location->receipt_printer_type : 'browser', 
							'data-default_payment_accounts' => $default_location->default_payment_accounts ?? '',
							'data-print-server-url' => $default_location->print_server_url ?? '',
							'data-printer_config' => json_encode($default_location->printer_config) ?? '',
							'data-payment_labels' => !empty($default_location->loc_settings['payment_labels']) ? json_encode($default_location->loc_settings['payment_labels']) : '',]); ?>

							<!-- sub_type -->
							<?php echo Form::hidden('sub_type', isset($sub_type) ? $sub_type : null); ?>

							<input type="hidden" id="item_addition_method" value="<?php echo e($business_details->item_addition_method, false); ?>">
								<?php echo $__env->make('sale_pos.partials.pos_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

								<?php if($is_quick_menu_interface): ?>
								<?php echo $__env->make('sale_pos.partials.pos_form_totals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<?php endif; ?>

								<?php if(!$is_big_buttons_interface): ?>
									<?php echo $__env->make('sale_pos.partials.payment_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<?php endif; ?>

								<?php if(empty($pos_settings['disable_suspend'])): ?>
									<?php echo $__env->make('sale_pos.partials.suspend_note_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<?php endif; ?>

								<?php if(empty($pos_settings['disable_recurring_invoice'])): ?>
									<?php echo $__env->make('sale_pos.partials.recurring_invoice_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php if($is_suggestion_interface && !isMobile()): ?>
				<div class="col-12 col-lg-4 no-padding pos-create-side-col">
					<?php echo $__env->make('sale_pos.partials.pos_sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<?php elseif($is_quick_menu_interface && !isMobile()): ?>
					<div class="col-12 col-lg-3 no-padding pos-quick-menu-sidebar" style="display: flex;flex-flow: column;padding-right: 12px;">
						<span class="d-none d-md-inline">
						<?php echo $__env->make('sale_pos.partials.pos_numpad', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						</span>
						<?php echo $__env->make('sale_pos.partials.pos_form_actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<?php if($is_quick_menu_interface): ?>
		<?php if(isMobile()): ?>
		<?php echo $__env->make('sale_pos.partials.pos_form_actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php endif; ?>
			
	<br class="d-none d-xs-block">
	<div class="row" id="quick_menu_div"></div>
	<?php else: ?>
		<?php echo $__env->make('sale_pos.partials.pos_form_actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>

	<?php if(!$is_big_buttons_interface): ?>
		<?php echo $__env->make('sale_pos.partials.pos_slide_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>

	<?php if($is_big_buttons_interface): ?>
		<?php echo $__env->make('sale_pos.partials.payment_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php echo $__env->make('sale_pos.partials.big_buttons_panels', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>


	<?php echo Form::close(); ?>

</section>

<!-- This will be printed -->
<section class="invoice print_section" id="receipt_section">
</section>

<div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<?php echo $__env->make('contact.create', ['quick_add' => true, 'customer' => true, 'from' => 'pos'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>

<?php if($is_suggestion_interface && isMobile()): ?>
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


<div class="modal fade" id="expense_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade" id="dojo_payment_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade" id="edit_quick_menu_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" id="edit_quick_menu_item_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<div class="modal fade" tabindex="-1" role="dialog" id="show_table_orders_modal"></div>
<div class="modal fade" id="table_move_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
<?php if(!isMobile() && !empty($pos_settings['enable_numeric_keypad_on_input'])): ?>
<?php echo $__env->make('sale_pos.partials.numpad_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(!isMobile() && !empty($pos_settings['show_change_return_modal'])): ?>
<?php echo $__env->make('sale_pos.partials.change_return_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php $__env->startSection('css'); ?>
	<!-- include module css -->
    <?php if(!empty($pos_module_data)): ?>
        <?php $__currentLoopData = $pos_module_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($value['module_css_path'])): ?>
                <?php if ($__env->exists($value['module_css_path'])) echo $__env->make($value['module_css_path'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
	<script>
		// Pre-loaded workstation settings for Electron silent printing (keyed by uppercase machine_name)
		var __workstationSettings = <?php echo json_encode($workstation_settings ?? new \stdClass()); ?>;
	</script>
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
	

	
	<script>
		(function() {
			function toggleFooterVisibility(sectionSelector, footerSelector, buttonSelector) {
				var section = document.querySelector(sectionSelector);
				if (!section) return;

				var footer = section.querySelector(footerSelector);
				if (!footer) return;

				var isMobile = window.matchMedia('(max-width: 767.98px)').matches;

				// On desktop, always show footer
				if (!isMobile) {
					footer.style.display = '';
					section.style.paddingBottom = '';
					return;
				}

				// On mobile, check if any buttons are visible
				var buttons = footer.querySelectorAll(buttonSelector);
				var hasVisibleButton = false;

				buttons.forEach(function(btn) {
					if (!btn.classList.contains('hide')) {
						var style = window.getComputedStyle(btn);
						if (style.display !== 'none' && style.visibility !== 'hidden') {
							hasVisibleButton = true;
						}
					}
				});

				if (hasVisibleButton) {
					footer.style.display = '';
					section.style.paddingBottom = '';
				} else {
					footer.style.display = 'none';
					section.style.paddingBottom = '0';
				}
			}

			function toggleAllFooters() {
				toggleFooterVisibility(
					'.pos-create-page.pos-interface-simple',
					'.bg-pos-actions',
					'.simple-footer-right .btn-simple'
				);
				toggleFooterVisibility(
					'.pos-create-page.pos-interface-suggestion',
					'.bg-pos-actions-suggestion',
					'.suggestion-footer-right .btn-suggestion'
				);
				toggleFooterVisibility(
					'.pos-create-page.pos-interface-quick',
					'.bg-pos-actions-qm',
					'.qm-footer-right .btn-qm'
				);
			}

			document.addEventListener('DOMContentLoaded', function() {
				toggleAllFooters();

				// Observe Simple footer button visibility changes
				var simpleRight = document.querySelector('.pos-create-page.pos-interface-simple .simple-footer-right');
				if (simpleRight) {
					var observer = new MutationObserver(toggleAllFooters);
					observer.observe(simpleRight, { attributes: true, childList: true, subtree: true });
				}

				// Observe Suggestion footer button visibility changes
				var suggestionRight = document.querySelector('.pos-create-page.pos-interface-suggestion .suggestion-footer-right');
				if (suggestionRight) {
					var observer2 = new MutationObserver(toggleAllFooters);
					observer2.observe(suggestionRight, { attributes: true, childList: true, subtree: true });
				}

				// Observe Quick Menu footer button visibility changes
				var qmRight = document.querySelector('.pos-create-page.pos-interface-quick .qm-footer-right');
				if (qmRight) {
					var observer3 = new MutationObserver(toggleAllFooters);
					observer3.observe(qmRight, { attributes: true, childList: true, subtree: true });
				}
			});

			window.addEventListener('resize', toggleAllFooters);
		})();
	</script>

	
	<script>
		(function() {
			document.addEventListener('DOMContentLoaded', function() {
				var mirror = document.querySelector('.qm-total-payable-mirror');
				if (!mirror) return;

				var source = document.getElementById('total_payable');
				if (!source || source === mirror) return;

				function syncTotal() {
					mirror.textContent = source.textContent;
				}

				var obs = new MutationObserver(syncTotal);
				obs.observe(source, { childList: true, characterData: true, subtree: true });
				syncTotal();
			});
		})();
	</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>