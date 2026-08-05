<script type="text/javascript">
	$(document).ready( function() {
		// Move POS shortcuts modal to body to avoid stacking context issues
		$('#posKeyboardShortcutsModal').appendTo('body');

		let keyBindingEnabled = true;
		var posShortcutHandlers = {};
		var posShortcutScannerSelector = [
			'input#search_product',
			'input#search_product_sku',
			'#products_search_text',
			'#weighing_scale_barcode',
			'#search_product_item_modal',
			'#products_search_modal .select2-search__field'
		].join(',');

		function normalizeShortcutCombo(shortcut) {
			return $.trim(String(shortcut || '').toLowerCase()).replace(/\s+/g, '');
		}

		function getShortcutComboFromEvent(event) {
			var key = event.key || '';
			var code = event.code || '';

			if (/^Key[A-Z]$/.test(code)) {
				key = code.replace('Key', '').toLowerCase();
			} else if (/^Digit[0-9]$/.test(code)) {
				key = code.replace('Digit', '');
			} else if (/^Numpad[0-9]$/.test(code)) {
				key = code.replace('Numpad', '');
			} else {
				key = key.toLowerCase();
			}

			if (key === ' ') {
				key = 'space';
			} else if (key === 'esc') {
				key = 'escape';
			} else if (key.indexOf('arrow') === 0) {
				key = key.replace('arrow', '');
			}

			var combo = [];
			if (event.ctrlKey) {
				combo.push('ctrl');
			}
			if (event.altKey) {
				combo.push('alt');
			}
			if (event.shiftKey) {
				combo.push('shift');
			}
			if (event.metaKey) {
				combo.push('meta');
			}

			if (['control', 'ctrl', 'alt', 'shift', 'meta'].indexOf(key) === -1) {
				combo.push(key);
			}

			return combo.join('+');
		}

		function isTextEntryTarget(target) {
			return $(target).is('input, textarea, select') ||
				$(target).closest('[contenteditable="true"]').length > 0;
		}

		function shouldCapturePosShortcut(event, combo, options) {
			if (!combo) {
				return false;
			}

			if (options && options.visibleSelector && !$(options.visibleSelector).is(':visible')) {
				return false;
			}

			if (/^f\d{1,2}$/.test(combo)) {
				return true;
			}

			if ($(event.target).closest(posShortcutScannerSelector).length) {
				return true;
			}

			if (options && options.captureInInputs) {
				if (options.captureInInputs === true) {
					return true;
				}

				return $(event.target).closest(options.captureInInputs).length > 0;
			}

			return !isTextEntryTarget(event.target);
		}

		function stopPosShortcutEvent(event) {
			if (event && event.preventDefault) {
				event.preventDefault();
			}
			if (event && event.stopPropagation) {
				event.stopPropagation();
			}
			if (event && event.stopImmediatePropagation) {
				event.stopImmediatePropagation();
			}
		}

		function registerPosShortcut(shortcut, callback, options) {
			var combo = normalizeShortcutCombo(shortcut);
			if (!combo) {
				return;
			}

			posShortcutHandlers[combo] = posShortcutHandlers[combo] || [];
			posShortcutHandlers[combo].push({
				callback: callback,
				options: options || {}
			});
			Mousetrap.bind(shortcut, callback);
		}

		function registerPosModalShortcut(element, shortcut, callback, options) {
			var combo = normalizeShortcutCombo(shortcut);
			if (!combo) {
				return;
			}

			posShortcutHandlers[combo] = posShortcutHandlers[combo] || [];
			posShortcutHandlers[combo].push({
				callback: callback,
				options: options || {}
			});

			if (element) {
				Mousetrap(element).bind(shortcut, callback);
			}
		}

		// Product search inputs stop bubbling for scanner safety; capture POS shortcuts before that guard.
		document.addEventListener('keydown', function (event) {
			var combo = getShortcutComboFromEvent(event);
			var handlers = posShortcutHandlers[combo];
			if (!handlers || !handlers.length) {
				return;
			}

			var runnableHandlers = handlers.filter(function (handler) {
				return shouldCapturePosShortcut(event, combo, handler.options);
			});

			if (!runnableHandlers.length) {
				return;
			}

			stopPosShortcutEvent(event);

			runnableHandlers.forEach(function (handler) {
				handler.callback.call(document, event, combo);
			});
		}, true);

		//shortcut for express checkout
		<?php if(!empty($shortcuts["pos"]["express_checkout"]) && ($pos_settings['disable_express_checkout'] == 0)): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["express_checkout"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;	

					$('button.pos-express-finalize[data-pay_method="cash"]').trigger('click');

					setTimeout(() => {
                    	keyBindingEnabled = true;
                	}, 2000);
				}
			});
		<?php endif; ?>
		
		//shortcut for cancel checkout
		<?php if(!empty($shortcuts["pos"]["cancel"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["cancel"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;	

					$('#pos-cancel').trigger('click');
					
					setTimeout(() => {
                    	keyBindingEnabled = true;
                	}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for draft checkout
		<?php if(!empty($shortcuts["pos"]["draft"]) && ($pos_settings['disable_draft'] == 0)): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["draft"], false); ?>', function(e) {
				e.preventDefault();
				
				if (keyBindingEnabled) {
					keyBindingEnabled = false;	

					$('#pos-draft').trigger('click');
					
					setTimeout(() => {
                    	keyBindingEnabled = true;
                	}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for draft pay & checkout
		<?php if(!empty($shortcuts["pos"]["pay_n_ckeckout"]) && ($pos_settings['disable_pay_checkout'] == 0)): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["pay_n_ckeckout"], false); ?>', function(e) {
				e.preventDefault();
				
				if (keyBindingEnabled) {
					keyBindingEnabled = false;	

					$('#modal_payment').one('shown.bs.modal', function () {
						const paymentAmountField = $('#modal_payment .payment-amount:first');						
						paymentAmountField.click();
						paymentAmountField.focus();
					});

					$('#pos-finalize').trigger('click');

					setTimeout(() => {
                    	keyBindingEnabled = true;
                	}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for edit discount
		<?php if(!empty($shortcuts["pos"]["edit_discount"]) && ($pos_settings['disable_discount'] == 0)): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["edit_discount"], false); ?>', function(e) {
				e.preventDefault();
				$('#pos-edit-discount').trigger('click');
			});
		<?php endif; ?>

		//shortcut for edit tax
		<?php if(!empty($shortcuts["pos"]["edit_order_tax"]) && ($pos_settings['disable_invoice_tax'] == 0)): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["edit_order_tax"], false); ?>', function(e) {
				e.preventDefault();
				$('#pos-edit-tax').trigger('click');
			});
		<?php endif; ?>

		//shortcut for add payment row
		<?php if(!empty($shortcuts["pos"]["add_payment_row"]) && ($pos_settings['disable_pay_checkout'] == 0)): ?>
			var payment_modal = document.querySelector('#modal_payment');
			registerPosShortcut('<?php echo e($shortcuts["pos"]["add_payment_row"], false); ?>', function(e, combo) {
				
				if (keyBindingEnabled) {
					keyBindingEnabled = false;	

					if($('#modal_payment').is(':visible')){
						e.preventDefault();
						$('#add-payment-row').trigger('click');
					}
					
					setTimeout(() => {
                    	keyBindingEnabled = true;
                	}, 2000);
				}
			}, {captureInInputs: '#modal_payment', visibleSelector: '#modal_payment'});
		<?php endif; ?>

		//shortcut for add finalize payment
		<?php if(!empty($shortcuts["pos"]["finalize_payment"]) && ($pos_settings['disable_pay_checkout'] == 0)): ?>
			var payment_modal = document.querySelector('#modal_payment');
			registerPosModalShortcut(payment_modal, '<?php echo e($shortcuts["pos"]["finalize_payment"], false); ?>', function(e, combo) {
				
				if (keyBindingEnabled) {
					keyBindingEnabled = false;	

					if($('#modal_payment').is(':visible')){
						e.preventDefault();
						$('#pos-save').trigger('click');
					}
					
					setTimeout(() => {
                    	keyBindingEnabled = true;
                	}, 2000);
				}
				
			}, {captureInInputs: '#modal_payment', visibleSelector: '#modal_payment'});
		<?php endif; ?>

		//Shortcuts to go recent product quantity
		<?php if(!empty($shortcuts["pos"]["recent_product_quantity"])): ?>
			var recentProductQuantityShortcut = <?php echo json_encode(strtolower($shortcuts["pos"]["recent_product_quantity"]), 15, 512) ?>;
			var recentProductQuantityRowCount = 0;
			var recentProductQuantityIndex = null;

			function focusRecentProductQuantity(event) {
				if (event) {
					event.preventDefault();
					event.stopPropagation();
				}

				var productRows = $('table#pos_table tbody tr.product_row').filter(function () {
					return $(this).find('input.pos_quantity').length > 0;
				});

				if (!productRows.length) {
					return false;
				}

				if (
					productRows.length !== recentProductQuantityRowCount ||
					recentProductQuantityIndex === null ||
					recentProductQuantityIndex >= productRows.length
				) {
					recentProductQuantityIndex = productRows.length - 1;
				} else {
					recentProductQuantityIndex = recentProductQuantityIndex - 1;
					if (recentProductQuantityIndex < 0) {
						recentProductQuantityIndex = productRows.length - 1;
					}
				}

				recentProductQuantityRowCount = productRows.length;

				var last_qty_field = productRows
					.eq(recentProductQuantityIndex)
					.find('input.pos_quantity')
					.first();

				if (last_qty_field.length >= 1) {
					last_qty_field.focus().select();
				}

				return false;
			}

			registerPosShortcut(recentProductQuantityShortcut, focusRecentProductQuantity);

		<?php endif; ?>

		// //On focus of quantity field go back to search when stop typing
		// var timeout = null;
		// $('table#pos_table').on('focus', 'input.pos_quantity', function () {
		// 	var that = this;

		// 	$(this).on('keyup', function(e){

		// 		if (timeout !== null) {
		// 			clearTimeout(timeout);
		// 		}

		// 		var code = e.keyCode || e.which;
		// 		if (code != '9') {
		// 			timeout = setTimeout(function () {
		// 				$('input#search_product').focus().select();
		// 			}, 5000);
		// 		}
		// 	});
		// });

		var $search_product_input = $('input#search_product');
		var $search_product_sku_input = $('input#search_product_sku');
        var idleTime = <?php echo e($pos_settings['auto_cursor_on_barcode_delay'] ? intval($pos_settings['auto_cursor_on_barcode_delay']) : 15000, false); ?>;
        var idleTimer;

        function resetIdleTimer() {
            clearTimeout(idleTimer);
            idleTimer = setTimeout(function () {
				// console.log('Auto Cursor Idle time exceeded: ' + idleTime+ ' ms');
				if (!$search_product_input.is(':focus')) {
                    $search_product_input.focus();
                }
				if (!$search_product_sku_input.is(':focus')) {
                    $search_product_sku_input.focus();
                }
            }, idleTime);
        }

        // Reset timer on user activity
        $(document).on('keydown keyup scroll touchstart', resetIdleTimer);

        // Reset if the input is focused
        $search_product_input.on('focus', resetIdleTimer);
		$search_product_sku_input.on('focus', resetIdleTimer);

        // Start initially
        resetIdleTimer();

		//shortcut to go to add new products
		<?php if(!empty($shortcuts["pos"]["add_new_product"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["add_new_product"], false); ?>', function(e) {
				$('input#search_product').focus().select();
			});
		<?php endif; ?>

		//shortcut for weighing scale
		<?php if(!empty($shortcuts["pos"]["weighing_scale"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["weighing_scale"], false); ?>', function(e) {
				e.preventDefault();
				$('button#weighing_scale_btn').trigger('click');
			});
		<?php endif; ?>

		//shortcut for product search screen
		registerPosShortcut('f10', function(e) {
			e.preventDefault();
			if (keyBindingEnabled) {
				keyBindingEnabled = false;
				$('#search_product').focus();
				$('button#open_products_search_modal').trigger('click');
				setTimeout(() => {
					keyBindingEnabled = true;
				}, 2000);
			}
		});

		$(document).on('keydown', '#search_product', function(event) {
			if (event.key === 'Tab') {
				event.preventDefault();
				let lastQuantityElement = $('tr.product_row').find('input.pos_quantity').last();
				if (lastQuantityElement.length) {
					lastQuantityElement.click();
				}else{
					$('#search_product').focus();
					if($('input#search_product_sku').length){
						$('input#search_product_sku').focus();
					}
				}
			}
		});

		$(document).on('keydown', '#search_product_sku', function(event) {
			if (event.key === 'Tab') {
				event.preventDefault();
				let lastQuantityElement = $('tr.product_row').find('input.pos_quantity').last();
				if (lastQuantityElement.length) {
					lastQuantityElement.click();
				}else{
					$('#search_product').focus();
				}
			}
		});
		
		$(document).on('keydown', '.product_row input[type=text]:last', function(event) {
			if (event.key === 'Tab') {
				event.preventDefault();
				$('#search_product').focus();
				if($('input#search_product_sku').length){
					$('input#search_product_sku').focus();
				}
			}
		});

		$(document).on('keydown', '.payment-amount', function(event) {
			if (event.key === 'Enter') {
				event.preventDefault();
				$('#pos-save-multipay[data-save-and-print="true"]').trigger('click');
			}
		});

		
		$(document).on('keydown', '.product_row input[type=text]', function(event) {
			if (event.key === 'Enter') {
				event.preventDefault();
				$('#search_product').focus();
				if($('input#search_product_sku').length){
					$('input#search_product_sku').focus();
				}
			}
		});

		//shortcut for fullscreen toggle
		<?php if(!empty($shortcuts["pos"]["fullscreen_toggle"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["fullscreen_toggle"], false); ?>', function(e) {
				e.preventDefault();
				if (document.fullscreenElement) {
					document.exitFullscreen();
				} else {
					document.documentElement.requestFullscreen();
				}
			});
		<?php endif; ?>

		//shortcut to focus customer search
		<?php if(!empty($shortcuts["pos"]["focus_customer"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["focus_customer"], false); ?>', function(e) {
				e.preventDefault();
				$('#customer_id').focus();
			});
		<?php endif; ?>

		//shortcut to add new customer
		<?php if(!empty($shortcuts["pos"]["add_new_customer"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["add_new_customer"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('.add_new_customer:first').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for quotation
		<?php if(!empty($shortcuts["pos"]["quotation"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["quotation"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#pos-quotation').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for suspend
		<?php if(!empty($shortcuts["pos"]["suspend"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["suspend"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('.pos-express-finalize[data-pay_method="suspend"]').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for credit sale
		<?php if(!empty($shortcuts["pos"]["credit_sale"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["credit_sale"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('.pos-express-finalize[data-pay_method="credit_sale"]').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for express card checkout
		<?php if(!empty($shortcuts["pos"]["express_card"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["express_card"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('.pos-express-finalize[data-pay_method="card"]').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>






		//shortcut for recent transactions
		<?php if(!empty($shortcuts["pos"]["recent_transactions"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["recent_transactions"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#recent-transactions').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for quick add product
		<?php if(!empty($shortcuts["pos"]["quick_add_product"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["quick_add_product"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('.pos_add_quick_product:first').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut to focus SKU search
		<?php if(!empty($shortcuts["pos"]["focus_sku_search"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["focus_sku_search"], false); ?>', function(e) {
				e.preventDefault();
				$('input#search_product_sku').focus().select();
			});
		<?php endif; ?>

		//shortcut for keyboard shortcuts help
		<?php if(!empty($shortcuts["pos"]["show_shortcuts_help"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["show_shortcuts_help"], false); ?>', function(e) {
				e.preventDefault();
				$('#posKeyboardShortcutsModal').modal('show');
			});
		<?php endif; ?>

		//shortcut for takeaway 1
		<?php if(!empty($shortcuts["pos"]["takeaway_1"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["takeaway_1"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#pos-takeaway-finalize[data-takeaway="1"]').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for takeaway 2
		<?php if(!empty($shortcuts["pos"]["takeaway_2"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["takeaway_2"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#pos-takeaway-finalize[data-takeaway="2"]').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for takeaway 3
		<?php if(!empty($shortcuts["pos"]["takeaway_3"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["takeaway_3"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#pos-takeaway-finalize[data-takeaway="3"]').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for edit shipping
		<?php if(!empty($shortcuts["pos"]["edit_shipping"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["edit_shipping"], false); ?>', function(e) {
				e.preventDefault();
				$('#pos-edit-shipping').trigger('click');
			});
		<?php endif; ?>

		//shortcut for service charge
		<?php if(!empty($shortcuts["pos"]["service_charge"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["service_charge"], false); ?>', function(e) {
				e.preventDefault();
				$('.service_modal_btn:first').trigger('click');
			});
		<?php endif; ?>

		// ═══════════════════════════════════════════════════
		// POS Navbar Right-Side Button Shortcuts
		// ═══════════════════════════════════════════════════

		//shortcut for cash pull
		<?php if(!empty($shortcuts["pos"]["cash_pull"]) && !empty($pos_settings['enable_cash_pull'])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["cash_pull"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#open_cash_pull_modal').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for calculator
		<?php if(!empty($shortcuts["pos"]["calculator"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["calculator"], false); ?>', function(e) {
				e.preventDefault();
				$('#btnCalculator').trigger('click');
			});
		<?php endif; ?>

		//shortcut for customer display screen
		<?php if(!empty($shortcuts["pos"]["customer_display"]) && !empty($pos_settings['customer_display_screen'])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["customer_display"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#customer_display_screen')[0].click();
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for open cash drawer
		<?php if(!empty($shortcuts["pos"]["open_cash_drawer"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["open_cash_drawer"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#open_cash_drawer').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for view suspended sales
		<?php if(!empty($shortcuts["pos"]["view_suspended"]) && empty($pos_settings['disable_suspend'])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["view_suspended"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#view_suspended_sales').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for sell return
		<?php if(!empty($shortcuts["pos"]["sell_return"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["sell_return"], false); ?>', function(e) {
				e.preventDefault();
				$('#return_sale').trigger('click');
			});
		<?php endif; ?>

		//shortcut for add expense
		<?php if(!empty($shortcuts["pos"]["add_expense"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["add_expense"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#add_expense').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for register details
		<?php if(!empty($shortcuts["pos"]["register_details"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["register_details"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					var $regBtn = $('#register_details');
					if (!$regBtn.length) $regBtn = $('#restrict_register_details');
					$regBtn.trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for close register
		<?php if(!empty($shortcuts["pos"]["close_register"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["close_register"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					var $closeBtn = $('#close_register');
					if (!$closeBtn.length) $closeBtn = $('#restrict_close_register');
					$closeBtn.trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for service staff availability
		<?php if(!empty($shortcuts["pos"]["service_staff"]) && !empty($pos_settings['inline_service_staff'])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["service_staff"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('#show_service_staff_availability').trigger('click');
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

		//shortcut for go back
		<?php if(!empty($shortcuts["pos"]["go_back"])): ?>
			registerPosShortcut('<?php echo e($shortcuts["pos"]["go_back"], false); ?>', function(e) {
				e.preventDefault();
				if (keyBindingEnabled) {
					keyBindingEnabled = false;
					$('.pos-actions a.btn-info:has(.fa-sign-out-alt)')[0].click();
					setTimeout(() => {
						keyBindingEnabled = true;
					}, 2000);
				}
			});
		<?php endif; ?>

	});
</script>
