<script type="text/javascript">
    $(document).ready(function() {
        <?php
            $purchase_shortcuts = !empty($shortcuts['purchase']) ? $shortcuts['purchase'] : [];
        ?>

        let keyBindingEnabled = true;
        var purchaseProductSearchShortcut = '<?php echo e(!empty($purchase_shortcuts["product_search"]) ? strtolower($purchase_shortcuts["product_search"]) : "", false); ?>';

        function triggerPurchaseProductSearchShortcut(e) {
            if (e) {
                e.preventDefault();
                if (typeof e.stopImmediatePropagation === 'function') {
                    e.stopImmediatePropagation();
                }
            }

            if (!keyBindingEnabled) {
                return;
            }

            keyBindingEnabled = false;
            $('#search_product').focus();

            if ($('button#open_products_search_modal').length) {
                $('button#open_products_search_modal').trigger('click');
            }

            setTimeout(() => {
                keyBindingEnabled = true;
            }, 2000);
        }

        if (window.Mousetrap && !Mousetrap.purchaseSearchStopCallbackPatched) {
            var originalPurchaseStopCallback = Mousetrap.stopCallback;
            Mousetrap.stopCallback = function(e, element, combo) {
                if (element && element.id === 'search_product') {
                    if (combo && combo.toLowerCase() === purchaseProductSearchShortcut) {
                        return false;
                    }

                    return true;
                }

                return originalPurchaseStopCallback.call(this, e, element, combo);
            };
            Mousetrap.purchaseSearchStopCallbackPatched = true;
        }

        // Save purchase
        <?php if(!empty($purchase_shortcuts['save_purchase'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["save_purchase"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('button#submit_purchase_form:not(.save_and_print):last').trigger('click');
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Save & print
        <?php if(!empty($purchase_shortcuts['save_and_print'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["save_and_print"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('button.save_and_print').trigger('click');
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Cancel / go back
        <?php if(!empty($purchase_shortcuts['cancel_purchase'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["cancel_purchase"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    window.history.back();
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Product search
        <?php if(!empty($purchase_shortcuts['product_search'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["product_search"], false); ?>', function(e) {
                triggerPurchaseProductSearchShortcut(e);
            });

            <?php if(strtolower($purchase_shortcuts['product_search']) === 'f10'): ?>
                $(document)
                    .off('keydown.purchaseProductSearchShortcut')
                    .on('keydown.purchaseProductSearchShortcut', function(event) {
                        if (event.key === 'F10' || event.which === 121 || event.keyCode === 121) {
                            triggerPurchaseProductSearchShortcut(event);
                        }
                    });
            <?php endif; ?>
        <?php endif; ?>

        // Focus payment amount
        <?php if(!empty($purchase_shortcuts['focus_payment'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["focus_payment"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('.payment-amount:first').trigger('click');
                    $('html, body').animate({ scrollTop: $(document).height() }, 500);
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus supplier field
        <?php if(!empty($purchase_shortcuts['focus_supplier'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["focus_supplier"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#supplier_id').length) {
                    $('#supplier_id').focus();
                }
            });
        <?php endif; ?>

        // Add new supplier
        <?php if(!empty($purchase_shortcuts['add_new_supplier'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["add_new_supplier"], false); ?>', function(e) {
                e.preventDefault();
                if ($('.add_new_supplier').length && !$('.add_new_supplier').prop('disabled')) {
                    $('.add_new_supplier').trigger('click');
                }
            });
        <?php endif; ?>

        // Add payment row
        <?php if(!empty($purchase_shortcuts['add_payment_row'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["add_payment_row"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    if ($('button.add_payment_row_btn').length) {
                        $('button.add_payment_row_btn').trigger('click');
                    } else if ($('button#add-payment-row').length) {
                        $('button#add-payment-row').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus purchase date
        <?php if(!empty($purchase_shortcuts['focus_purchase_date'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["focus_purchase_date"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#transaction_date_text').length) {
                    $('#transaction_date_text').focus();
                } else if ($('#transaction_date').length) {
                    $('#transaction_date').focus();
                }
            });
        <?php endif; ?>

        // Focus ref no
        <?php if(!empty($purchase_shortcuts['focus_ref_no'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["focus_ref_no"], false); ?>', function(e) {
                e.preventDefault();
                if ($('input[name="ref_no"]').length) {
                    $('input[name="ref_no"]').focus();
                }
            });
        <?php endif; ?>

        // Focus last product quantity
        <?php if(!empty($purchase_shortcuts['focus_last_qty'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["focus_last_qty"], false); ?>', function(e) {
                e.preventDefault();
                var lastQty = $('tr.product_row:last').find('input.purchase_quantity');
                if (lastQty.length) {
                    lastQty.focus().select();
                }
            });
        <?php endif; ?>

        // Focus last product unit price
        <?php if(!empty($purchase_shortcuts['focus_last_price'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["focus_last_price"], false); ?>', function(e) {
                e.preventDefault();
                var lastPrice = $('tr.product_row:last').find('input.purchase_unit_cost_without_discount');
                if (lastPrice.length) {
                    lastPrice.focus().select();
                }
            });
        <?php endif; ?>

        // Focus last product discount
        <?php if(!empty($purchase_shortcuts['focus_last_discount'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["focus_last_discount"], false); ?>', function(e) {
                e.preventDefault();
                var lastDiscount = $('tr.product_row:last').find('input.inline_discounts');
                if (lastDiscount.length) {
                    lastDiscount.focus().select();
                }
            });
        <?php endif; ?>

        // Remove last product row
        <?php if(!empty($purchase_shortcuts['remove_last_product'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["remove_last_product"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    var lastRow = $('tr.product_row:last');
                    if (lastRow.length) {
                        lastRow.find('i.remove_purchase_entry_row, .remove_purchase_entry_row').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Show shortcuts help modal
        <?php if(!empty($purchase_shortcuts['show_shortcuts_help'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["show_shortcuts_help"], false); ?>', function(e) {
                e.preventDefault();
                $('#purchase_keyboard_shortcuts_modal').modal('toggle');
            });
        <?php endif; ?>

        // ---- Tooltips ----

        // Supplier field — Select2 container
        <?php if(!empty($purchase_shortcuts['focus_supplier'])): ?>
            var supplierTooltip = '<?php echo e(__("lang_v1.purchase_focus_supplier"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["focus_supplier"]), false); ?>';
            var $supplierSelect2 = $('#supplier_id').next('.select2-container');
            if ($supplierSelect2.length) {
                $supplierSelect2.attr('title', supplierTooltip);
            } else {
                $(document).on('select2:open', '#supplier_id', function() {
                    $('#supplier_id').next('.select2-container').attr('title', supplierTooltip);
                });
            }
        <?php endif; ?>

        <?php if(!empty($purchase_shortcuts['add_new_supplier'])): ?>
            $('.add_new_supplier').attr('title', '<?php echo e(__("lang_v1.purchase_add_new_supplier"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["add_new_supplier"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($purchase_shortcuts['product_search'])): ?>
            $('#search_product').attr('title', '<?php echo e(__("lang_v1.purchase_product_search"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["product_search"]), false); ?>');
            $('#open_products_search_modal').attr('title', '<?php echo e(__("lang_v1.purchase_product_search"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["product_search"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($purchase_shortcuts['add_payment_row'])): ?>
            $('button.add_payment_row_btn, button#add-payment-row').attr('title', '<?php echo e(__("lang_v1.purchase_add_payment_row"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["add_payment_row"]), false); ?>');
        <?php endif; ?>

        // Date & Ref No tooltips
        <?php if(!empty($purchase_shortcuts['focus_purchase_date'])): ?>
            var dateTooltip = '<?php echo e(__("lang_v1.purchase_focus_date"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["focus_purchase_date"]), false); ?>';
            if ($('#transaction_date_text').length) {
                $('#transaction_date_text').attr('title', dateTooltip);
            } else if ($('#transaction_date').length) {
                $('#transaction_date').attr('title', dateTooltip);
            }
        <?php endif; ?>
        <?php if(!empty($purchase_shortcuts['focus_ref_no'])): ?>
            $('input[name="ref_no"]').attr('title', '<?php echo e(__("lang_v1.purchase_focus_ref_no"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["focus_ref_no"]), false); ?>');
        <?php endif; ?>

        // Payment tooltip
        <?php if(!empty($purchase_shortcuts['focus_payment'])): ?>
            var paymentTooltip = '<?php echo e(__("lang_v1.purchase_focus_payment"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["focus_payment"]), false); ?>';
            function applyPurchasePaymentTooltip() {
                $('.payment-amount').each(function() {
                    if (!$(this).data('shortcut-applied')) {
                        $(this).attr('title', paymentTooltip);
                        $(this).data('shortcut-applied', true);
                    }
                });
            }
            applyPurchasePaymentTooltip();
            $(document).on('DOMNodeInserted', '.payment_row', function() {
                setTimeout(applyPurchasePaymentTooltip, 100);
            });
        <?php endif; ?>

        // Footer button tooltips (dynamically created)
        var purchaseShortcutData = {
            <?php if(!empty($purchase_shortcuts['save_purchase'])): ?>
                'submit_purchase_form_save': '<?php echo e(strtoupper($purchase_shortcuts["save_purchase"]), false); ?>',
            <?php endif; ?>
            <?php if(!empty($purchase_shortcuts['save_and_print'])): ?>
                'submit_purchase_form_print': '<?php echo e(strtoupper($purchase_shortcuts["save_and_print"]), false); ?>',
            <?php endif; ?>
        };

        function applyPurchaseShortcutTooltips() {
            $('button#submit_purchase_form').each(function() {
                if (!this.dataset.shortcutApplied) {
                    if ($(this).hasClass('save_and_print') && purchaseShortcutData['submit_purchase_form_print']) {
                        this.title = this.textContent.trim() + ' [' + purchaseShortcutData['submit_purchase_form_print'] + ']';
                    } else if (!$(this).hasClass('save_and_print') && purchaseShortcutData['submit_purchase_form_save']) {
                        this.title = this.textContent.trim() + ' [' + purchaseShortcutData['submit_purchase_form_save'] + ']';
                    }
                    this.dataset.shortcutApplied = '1';
                }
            });
        }

        applyPurchaseShortcutTooltips();
        var footerActions = document.getElementById('footer-actions');
        if (footerActions) {
            var observer = new MutationObserver(function() {
                applyPurchaseShortcutTooltips();
            });
            observer.observe(footerActions, { childList: true, subtree: true });
        }

        // Tab navigation for product search and quantity fields
        $(document).on('keydown', '#search_product', function(event) {
            if (event.key === 'Tab') {
                event.preventDefault();
                if (typeof focus_last_purchase_product_quantity === 'function' && focus_last_purchase_product_quantity()) {
                    return;
                }

                let lastQuantityElement = $('tr.product_row').find('input.purchase_quantity').last();
                if (lastQuantityElement.length) {
                    lastQuantityElement.trigger('click').focus().select();
                } else {
                    if (typeof focus_purchase_product_search === 'function') {
                        focus_purchase_product_search();
                    } else {
                        $('#search_product').focus();
                    }
                }
            }
        });

        $(document).on('keydown', '.product_row input[type=text]:last', function(event) {
            if (event.key === 'Tab') {
                event.preventDefault();
                if (typeof focus_purchase_product_search === 'function') {
                    focus_purchase_product_search();
                } else {
                    $('#search_product').focus();
                }
            }
        });

        $(document).on('keydown', '.product_row input[type=text]', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                if (typeof focus_purchase_product_search === 'function') {
                    focus_purchase_product_search();
                } else {
                    $('#search_product').focus();
                }
            }
        });
    });
</script>
