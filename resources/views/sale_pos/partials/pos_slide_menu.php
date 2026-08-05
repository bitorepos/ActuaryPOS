<?php
$go_back_url = action([\App\Http\Controllers\SellPosController::class, 'index']);
$transaction_sub_type = '';
$view_suspended_sell_url = action([\App\Http\Controllers\SellController::class, 'index']).'?suspended=1';
$pos_redirect_url = action([\App\Http\Controllers\SellPosController::class, 'create']);
$pos_menu_common_settings = isset($common_settings) && is_array($common_settings) ? $common_settings : [];
$pos_menu_user_settings = auth()->check() && is_string(auth()->user()->user_settings)
	? (json_decode(auth()->user()->user_settings, true) ?: [])
	: (auth()->check() && is_array(auth()->user()->user_settings) ? auth()->user()->user_settings : []);

if (empty($pos_menu_common_settings) && isset($business_details)) {
	$business_common_settings = $business_details->common_settings ?? [];
	$pos_menu_common_settings = is_array($business_common_settings) ? $business_common_settings : [];
}

if (empty($pos_menu_common_settings)) {
	$session_common_settings = session()->get('business.common_settings') ?? [];
	$pos_menu_common_settings = is_array($session_common_settings) ? $session_common_settings : [];
}

if (!empty($pos_module_data)) {
	foreach ($pos_module_data as $value) {
		if (!empty($value['go_back_url'])) {
			$go_back_url = $value['go_back_url'];
		}

		if (!empty($value['transaction_sub_type'])) {
			$transaction_sub_type = $value['transaction_sub_type'];
			$view_suspended_sell_url .= '&transaction_sub_type='.$transaction_sub_type;
			$pos_redirect_url .= '?sub_type='.$transaction_sub_type;
		}
	}
}
?>

<input type="hidden" name="transaction_sub_type" id="transaction_sub_type" value="<?php echo e($transaction_sub_type, false); ?>">
<input type="hidden" id="pos_redirect_url" value="<?php echo e($pos_redirect_url, false); ?>">

<div class="pos-slide-menu no-print" aria-hidden="true">
	<div class="pos-slide-menu__scrim" data-pos-slide-close></div>
	<button type="button" class="pos-slide-menu__handle" data-pos-slide-open aria-label="Open menu">
		<i class="fas fa-bars"></i>
		<span>MENU</span>
	</button>
	<aside class="pos-slide-menu__panel" role="complementary">
		<div class="pos-slide-menu__header">
			<strong>POS Menu</strong>
			<button type="button" class="pos-slide-menu__close" data-pos-slide-close aria-label="<?php echo app('translator')->get('messages.close'); ?>">
				<i class="fas fa-times"></i>
			</button>
		</div>
		<div class="pos-slide-menu__content">
			<div class="pos-slide-menu__info">
				<?php if(empty($transaction->location_id)): ?>
					<?php if(count($business_locations) > 1): ?>
						<div class="pos-slide-menu__field-row">
							<i class="fa fa-map-marker"></i>
							<?php echo Form::select('select_location_id', $business_locations, $default_location->id ?? null, [
								'class' => 'form-select input-sm',
								'id' => 'select_location_id',
								'required',
								'autofocus'
							], $bl_attributes); ?>

						</div>
					<?php else: ?>
						<div class="pos-slide-menu__meta">
							<i class="fa fa-map-marker"></i>
							<span><?php echo e($default_location->name, false); ?></span>
						</div>
					<?php endif; ?>
				<?php endif; ?>

				<div class="pos-slide-menu__meta">
					<i class="fa fa-user"></i>
					<span>
						<?php echo e(Auth::User()->first_name, false); ?> <?php echo e(Auth::User()->last_name, false); ?>

						<span class="pos-slide-menu__meta-separator">|</span>
						<span class="curr_datetime"><?php echo e($default_datetime, false); ?></span>
					</span>
				</div>

			<?php if(!empty($user_settings['pos_show_total_profit'])): ?>
			<div class="pos-slide-menu__meta" id="pos_total_profit_row">
				<i class="fa fa-chart-line"></i>
				<span><?php echo app('translator')->get('lang_v1.total_profit'); ?>: <strong><span id="pos_total_profit_display">0.00</span></strong></span>
			</div>
			<?php endif; ?>
				<?php if(!empty($transaction->invoice_no)): ?>
					<div class="pos-slide-menu__meta">
						<i class="fa fa-file-invoice"></i>
						<span><?php echo app('translator')->get('sale.invoice_no'); ?>: <?php echo e($transaction->invoice_no, false); ?></span>
					</div>
				<?php endif; ?>

				<?php if(in_array('tables', $enabled_modules)): ?>
					<span id="header_table_name_span" class="pos-slide-menu__badge hide"></span>
				<?php endif; ?>
				<?php if(in_array('service_staff', $enabled_modules)): ?>
					<span id="header_service_staff_span" class="pos-slide-menu__meta"></span>
				<?php endif; ?>

				<?php if($pos_settings['hide_product_suggestion'] == 2 && (empty(Auth::user()->quick_menu_id) || Auth::user()->can('access_quick_menu'))): ?>
					<div class="pos-slide-menu__quick-menu-row">
						<?php if(empty(Auth::user()->quick_menu_id)): ?>
							<span id="quick_menus_buttons" class="pos-slide-menu__quick-menu-buttons"></span>
						<?php endif; ?>
						<?php if(Auth::user()->can('access_quick_menu')): ?>
							<div class="pos-slide-menu__toggle-row">
								<label class="pos-edit-switch" for="edit_quick_menus">
									<input type="checkbox" id="edit_quick_menus">
									<span class="pos-edit-slider"></span>
								</label>
								<span>Edit <span id="quick_menu_name_span">Quick Menu</span></span>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="pos-slide-menu__nav">
				<a href="<?php echo e($go_back_url, false); ?>" title="<?php echo e(__('lang_v1.go_back'), false); ?>" class="pos-slide-menu__item btn btn-info btn-sm">
					<i class="fas fa-sign-out-alt"></i>
					<span><?php echo e(__('lang_v1.go_back'), false); ?></span>
				</a>

				<?php if(auth()->user()->can('print_invoice') && !empty($pos_menu_user_settings['allow_open_cash_drawer'])): ?>
					<button type="button" id="open_cash_drawer" title="<?php echo e(__('lang_v1.open_cash_drawer'), false); ?>"
						class="pos-slide-menu__item btn btn-success btn-sm btn-modal">
						<i class="fa fa-cash-register"></i>
						<span><?php echo e(__('lang_v1.open_cash_drawer'), false); ?></span>
					</button>
				<?php endif; ?>

				<?php if(auth()->user()->can('access_sell_return') || auth()->user()->can('access_own_sell_return') || auth()->user()->can('access_invoice_sell_return') || auth()->user()->can('access_own_invoice_sell_return') || auth()->user()->can('access_direct_sell_return') || auth()->user()->can('access_own_direct_sell_return')): ?>
					<div class="pos-slide-menu__dropdown-wrap">
						<button type="button" class="pos-slide-menu__item btn btn-danger btn-sm" id="return_sale" title="<?php echo app('translator')->get('lang_v1.sell_return'); ?>">
							<i class="fas fa-undo"></i>
							<span><?php echo app('translator')->get('lang_v1.sell_return'); ?></span>
						</button>
						<div class="pos-header-dropdown" id="return_sale_dropdown" style="display:none;">
							<?php if(auth()->user()->can('access_sell_return') || auth()->user()->can('access_own_sell_return') || auth()->user()->can('access_invoice_sell_return') || auth()->user()->can('access_own_invoice_sell_return')): ?>
								<div class="mb-2">
									<input type="text" class="form-control" placeholder="<?php echo app('translator')->get('sale.invoice_no'); ?>" id="send_for_sell_return_invoice_no">
								</div>
							<?php endif; ?>
							<div class="w-100 text-center return-sale-actions">
								<?php if(auth()->user()->can('access_sell_return') || auth()->user()->can('access_own_sell_return') || auth()->user()->can('access_invoice_sell_return') || auth()->user()->can('access_own_invoice_sell_return')): ?>
									<button type="button" class="btn btn-danger btn-sm" id="send_for_sell_return"><?php echo app('translator')->get('lang_v1.sell_return'); ?></button>
									<button type="button" class="btn btn-primary btn-sm" id="load_invoice_products" title="<?php echo app('translator')->get('lang_v1.load_invoice_products'); ?>"><?php echo app('translator')->get('lang_v1.load_products'); ?></button>
								<?php endif; ?>
								<?php if(!empty($pos_menu_common_settings['enable_direct_sale_return'])): ?>
									<?php if(auth()->user()->can('access_sell_return') || auth()->user()->can('access_own_sell_return') || auth()->user()->can('access_direct_sell_return') || auth()->user()->can('access_own_direct_sell_return')): ?>
										<a href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'create']), false); ?>" target="_blank" title="<?php echo app('translator')->get('lang_v1.direct'); ?>" class="btn btn-info btn-sm text-white">
											<strong><?php echo app('translator')->get('lang_v1.direct_return'); ?></strong>
										</a>
									<?php endif; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('product_note.create')): ?>
					<button type="button" title="<?php echo app('translator')->get('product.add_product_note'); ?>"
						class="pos-slide-menu__item btn btn-primary btn-sm btn-modal"
						data-container=".view_modal"
						data-href="<?php echo e(action([\App\Http\Controllers\ProductNoteController::class, 'create']), false); ?>">
						<i class="fas fa-sticky-note"></i>
						<span><?php echo app('translator')->get('product.add_product_note'); ?></span>
					</button>
				<?php endif; ?>

				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense.add')): ?>
					<button type="button" title="<?php echo e(__('expense.add_expense'), false); ?>" class="pos-slide-menu__item btn bg-purple btn-primary btn-sm" id="add_expense">
						<i class="fas fa-minus-circle"></i>
						<span><?php echo e(__('expense.add_expense'), false); ?></span>
					</button>
				<?php endif; ?>

				<?php if(!empty($pos_settings['enable_cash_pull'])): ?>
					<button type="button" id="open_cash_pull_modal" title="<?php echo e(__('lang_v1.open_cash_pull_modal'), false); ?>" class="pos-slide-menu__item btn btn-warning btn-sm">
						<i class="fa fa-money-bill-alt"></i>
						<span><?php echo e(__('lang_v1.open_cash_pull_modal'), false); ?></span>
					</button>
				<?php endif; ?>

				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_cash_register_details')): ?>
					<?php if(auth()->user()->can('restrict_view_cash_register_details') && !auth()->user()->hasRole('Admin#' . auth()->user()->business_id)): ?>
						<button type="button" id="restrict_register_details" title="<?php echo e(__('cash_register.register_details'), false); ?>" class="pos-slide-menu__item btn btn-success btn-sm">
							<i class="fa fa-briefcase" aria-hidden="true"></i>
							<span><?php echo e(__('cash_register.register_details'), false); ?></span>
						</button>
					<?php else: ?>
						<button type="button" id="register_details" title="<?php echo e(__('cash_register.register_details'), false); ?>"
							class="pos-slide-menu__item btn btn-success btn-sm btn-modal" data-container=".register_details_modal"
							data-href="<?php echo e(action([\App\Http\Controllers\CashRegisterController::class, 'getRegisterDetails']), false); ?>">
							<i class="fa fa-briefcase" aria-hidden="true"></i>
							<span><?php echo e(__('cash_register.register_details'), false); ?></span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_cash_register_closing')): ?>
					<?php if(auth()->user()->can('restrict_view_cash_register_closing') && !auth()->user()->hasRole('Admin#' . auth()->user()->business_id)): ?>
						<button type="button" id="restrict_close_register" title="<?php echo e(__('cash_register.close_register'), false); ?>" class="pos-slide-menu__item btn btn-danger btn-sm">
							<i class="fa fa-briefcase"></i>
							<span><?php echo e(__('cash_register.close_register'), false); ?></span>
						</button>
					<?php else: ?>
						<button type="button" id="close_register" title="<?php echo e(__('cash_register.close_register'), false); ?>"
							class="pos-slide-menu__item btn btn-danger btn-sm btn-modal" data-container=".close_register_modal"
							data-href="<?php echo e(action([\App\Http\Controllers\CashRegisterController::class, 'getCloseRegister']), false); ?>">
							<i class="fa fa-briefcase"></i>
							<span><?php echo e(__('cash_register.close_register'), false); ?></span>
						</button>
					<?php endif; ?>
				<?php endif; ?>


				<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.payments')): ?>
					<button type="button" title="<?php echo app('translator')->get('lang_v1.pay_customer'); ?>" class="pos-slide-menu__item btn btn-success btn-sm nav_open_contact_payment_modal" data-contact_type="customer">
						<i class="fas fa-hand-holding-usd"></i>
						<span><?php echo app('translator')->get('lang_v1.pay_customer'); ?></span>
					</button>
				<?php endif; ?>

				<?php if(in_array('purchases', $enabled_modules)): ?>
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('purchase.payments')): ?>
						<button type="button" title="<?php echo app('translator')->get('lang_v1.pay_supplier'); ?>" class="pos-slide-menu__item btn btn-warning btn-sm nav_open_contact_payment_modal" data-contact_type="supplier">
							<i class="fas fa-money-bill-alt"></i>
							<span><?php echo app('translator')->get('lang_v1.pay_supplier'); ?></span>
						</button>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(Module::has('Manufacturing')): ?>
					<div class="pos-slide-menu__module-actions">
						<?php if ($__env->exists('manufacturing::layouts.partials.pos_header')) echo $__env->make('manufacturing::layouts.partials.pos_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				<?php endif; ?>

				<div class="pos-slide-menu__dropdown-wrap">
					<button title="<?php echo app('translator')->get('lang_v1.calculator'); ?>" id="btnCalculator" type="button" class="pos-slide-menu__item btn btn-success btn-sm">
						<i class="fa fa-calculator" aria-hidden="true"></i>
						<span><?php echo app('translator')->get('lang_v1.calculator'); ?></span>
					</button>
					<div class="calculator-dropdown" id="calculatorDropdown" style="display:none;">
						<?php echo $__env->make('layouts.partials.calculator', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				</div>

				<button type="button" title="<?php echo e(__('lang_v1.full_screen'), false); ?>" class="pos-slide-menu__item btn btn-primary btn-sm" id="full_screen">
					<i class="fa fa-window-maximize"></i>
					<span><?php echo e(__('lang_v1.full_screen'), false); ?></span>
				</button>

				<?php if(!empty($pos_settings['customer_display_screen'])): ?>
					<a href="<?php echo e(route('pos_display'), false); ?>" id="customer_display_screen"
						onclick="window.open(this.href, 'customer_display', 'width='+screen.width+',height='+screen.height+',top=0,left=0'); return false;"
						title="<?php echo e(__('lang_v1.customer_display_screen'), false); ?>" class="pos-slide-menu__item btn btn-info btn-sm">
						<i class="fa fa-tv"></i>
						<span><?php echo e(__('lang_v1.customer_display_screen'), false); ?></span>
					</a>
				<?php endif; ?>

				<?php if(empty($pos_settings['disable_suspend'])): ?>
					<button type="button" id="view_suspended_sales" title="<?php echo e(__('lang_v1.view_suspended_sales'), false); ?>"
						class="pos-slide-menu__item btn bg-red btn-sm btn-modal" data-container=".view_modal" data-href="<?php echo e($view_suspended_sell_url, false); ?>">
						<i class="fa fa-pause-circle"></i>
						<span><?php echo e(__('lang_v1.view_suspended_sales'), false); ?></span>
					</button>
				<?php endif; ?>

				<?php if(empty($pos_settings['hide_product_suggestion']) && isMobile()): ?>
					<button type="button" title="<?php echo e(__('lang_v1.view_products'), false); ?>" class="pos-slide-menu__item btn btn-success btn-sm btn-modal" data-bs-toggle="modal" data-bs-target="#mobile_product_suggestion_modal">
						<i class="fa fa-cubes"></i>
						<span><?php echo e(__('lang_v1.view_products'), false); ?></span>
					</button>
				<?php endif; ?>

				<?php if(Module::has('Repair') && $transaction_sub_type != 'repair'): ?>
					<div class="pos-slide-menu__module-actions">
						<?php echo $__env->make('repair::layouts.partials.pos_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
				<?php endif; ?>

				<?php if(in_array('pos_sale', $enabled_modules) && !empty($transaction_sub_type)): ?>
					<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('sell.create')): ?>
						<a href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'create']), false); ?>" title="<?php echo app('translator')->get('sale.pos_sale'); ?>" class="pos-slide-menu__item btn btn-success btn-sm">
							<i class="fa fa-shopping-cart"></i>
							<span><?php echo app('translator')->get('sale.pos_sale'); ?></span>
						</a>
					<?php endif; ?>
				<?php endif; ?>

				<?php if(!empty($pos_settings['inline_service_staff'])): ?>
					<button type="button" id="show_service_staff_availability" title="<?php echo e(__('lang_v1.service_staff_availability'), false); ?>"
						class="pos-slide-menu__item btn btn-primary btn-sm" data-container=".view_modal"
						data-href="<?php echo e(action([\App\Http\Controllers\SellPosController::class, 'showServiceStaffAvailibility']), false); ?>">
						<i class="fa fa-users"></i>
						<span><?php echo e(__('lang_v1.service_staff_availability'), false); ?></span>
					</button>
				<?php endif; ?>
			</div>
		</div>
	</aside>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
	$(document).on('click', '#return_sale', function (e) {
		e.stopPropagation();
		var $dropdown = $('#return_sale_dropdown');
		$('.pos-header-dropdown, .calculator-dropdown').not($dropdown).hide();
		$dropdown.toggle();
		if ($dropdown.is(':visible')) {
			setTimeout(function() {
				$('#send_for_sell_return_invoice_no').focus();
			}, 100);
		}
	});

	$(document).on('click', function (e) {
		if (!$(e.target).closest('#return_sale_dropdown, #return_sale').length) {
			$('#return_sale_dropdown').hide();
		}
	});

	$(document).on('click', '#return_sale_dropdown', function (e) {
		e.stopPropagation();
	});

	function initPosProductNoteSelect($element, dropdownParent) {
		$element.select2({
			ajax: {
				url: '/products/list-no-variation',
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						term: params.term
					};
				},
				processResults: function(data) {
					return {
						results: data
					};
				},
			},
			minimumInputLength: 1,
			dropdownParent: dropdownParent,
			escapeMarkup: function(m) {
				return m;
			},
		});
	}

	$(document).on('shown.bs.modal', '.view_modal', function() {
		var $modal = $(this);
		var $productNoteSelect = $modal.find('.product-note-product-select');

		if ($productNoteSelect.length) {
			initPosProductNoteSelect($productNoteSelect, $modal);
			$modal.find('select.select2').not('.product-note-product-select, .select2-hidden-accessible').each(function() {
				$(this).select2({
					dropdownParent: $modal
				});
			});
		}
	});

	$(document).on('submit', 'form#product_note_form', function(e) {
		e.preventDefault();

		var form = $(this);
		form.find('button[type="submit"]').attr('disabled', true);

		$.ajax({
			method: form.attr('method'),
			url: form.attr('action'),
			dataType: 'json',
			data: form.serialize(),
			success: function(result) {
				form.find('button[type="submit"]').attr('disabled', false);

				if (result.success == true) {
					$('div.view_modal').modal('hide');
					toastr.success(result.msg);
				} else {
					toastr.error(result.msg);
				}
			},
			error: function(xhr) {
				form.find('button[type="submit"]').attr('disabled', false);

				if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
					var errors = xhr.responseJSON.errors;
					var firstError = errors[Object.keys(errors)[0]][0];
					toastr.error(firstError);
				} else {
					toastr.error(<?php echo json_encode(__('messages.something_went_wrong'), 15, 512) ?>);
				}
			}
		});
	});

	$(document).on('keydown', '#send_for_sell_return_invoice_no', function (e) {
		if (e.key === 'Enter') {
			e.preventDefault();
			var val = $(this).val().trim();
			if (val === '') {
				var $directBtn = $('#return_sale_dropdown .return-sale-actions a.btn-info');
				if ($directBtn.length) {
					$directBtn[0].click();
				}
			} else {
				$('#send_for_sell_return').trigger('click');
			}
		}
	});
});
</script>
