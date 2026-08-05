<script type="text/javascript">
    $(document).ready(function() {
        <?php
            $sell_shortcuts = !empty($shortcuts['sell']) ? $shortcuts['sell'] : [];
        ?>

        let keyBindingEnabled = true;

        // Save sell
        <?php if(!empty($sell_shortcuts['save_sell'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["save_sell"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    if ($('button#submit-sell').length) {
                        $('button#submit-sell').trigger('click');
                    } else if ($('button#submit_sell_return_form').length) {
                        $('button#submit_sell_return_form').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Save & print
        <?php if(!empty($sell_shortcuts['save_and_print'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["save_and_print"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('button#save-and-print').trigger('click');
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Cancel sell
        <?php if(!empty($sell_shortcuts['cancel_sell'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["cancel_sell"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    if ($('button#sale-cancel').length) {
                        $('button#sale-cancel').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Product search
        <?php if(!empty($sell_shortcuts['product_search'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["product_search"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('#search_product').focus();
                    if ($('button#open_products_search_modal').length) {
                        $('button#open_products_search_modal').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus payment amount
        <?php if(!empty($sell_shortcuts['focus_payment'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["focus_payment"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('.payment-amount:first').trigger('click');
                    $('html, body').animate({ scrollTop: $(document).height() }, 500);
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus customer field
        <?php if(!empty($sell_shortcuts['focus_customer'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["focus_customer"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#customer_id').length) {
                    $('#customer_id').focus();
                }
            });
        <?php endif; ?>

        // Add new customer
        <?php if(!empty($sell_shortcuts['add_new_customer'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["add_new_customer"], false); ?>', function(e) {
                e.preventDefault();
                if ($('.add_new_customer').length && !$('.add_new_customer').prop('disabled')) {
                    $('.add_new_customer').trigger('click');
                }
            });
        <?php endif; ?>

        // Add payment row
        <?php if(!empty($sell_shortcuts['add_payment_row'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["add_payment_row"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    if ($('button#add-payment-row').length) {
                        $('button#add-payment-row').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus sale date field
        <?php if(!empty($sell_shortcuts['focus_sale_date'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["focus_sale_date"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#transaction_date_text').length) {
                    $('#transaction_date_text').focus();
                } else if ($('#transaction_date').length) {
                    $('#transaction_date').focus();
                }
            });
        <?php endif; ?>

        // Focus ref no field
        <?php if(!empty($sell_shortcuts['focus_ref_no'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["focus_ref_no"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#ref_no').length) {
                    $('#ref_no').focus();
                }
            });
        <?php endif; ?>

        // Focus last product quantity
        <?php if(!empty($sell_shortcuts['focus_last_qty'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["focus_last_qty"], false); ?>', function(e) {
                e.preventDefault();
                var lastQty = $('tr.product_row:last').find('input.pos_quantity');
                if (lastQty.length) {
                    lastQty.focus().select();
                }
            });
        <?php endif; ?>

        // Focus last product unit price
        <?php if(!empty($sell_shortcuts['focus_last_price'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["focus_last_price"], false); ?>', function(e) {
                e.preventDefault();
                var lastPrice = $('tr.product_row:last').find('input.pos_unit_price');
                if (lastPrice.length) {
                    lastPrice.focus().select();
                }
            });
        <?php endif; ?>

        // Focus last product discount
        <?php if(!empty($sell_shortcuts['focus_last_discount'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["focus_last_discount"], false); ?>', function(e) {
                e.preventDefault();
                var lastDiscount = $('tr.product_row:last').find('input.row_discount_amount');
                if (lastDiscount.length) {
                    lastDiscount.focus().select();
                }
            });
        <?php endif; ?>

        // Remove last product row
        <?php if(!empty($sell_shortcuts['remove_last_product'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["remove_last_product"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    var lastRow = $('tr.product_row:last');
                    if (lastRow.length) {
                        lastRow.find('i.pos_remove_row').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Show shortcuts help modal
        <?php if(!empty($sell_shortcuts['show_shortcuts_help'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["show_shortcuts_help"], false); ?>', function(e) {
                e.preventDefault();
                $('#sell_keyboard_shortcuts_modal').modal('toggle');
            });
        <?php endif; ?>

        // Apply shortcut tooltips on hover for inline elements

        // Customer field — Select2 hides the original <select>, so target its container
        <?php if(!empty($sell_shortcuts['focus_customer'])): ?>
            var customerTooltip = '<?php echo e(__("lang_v1.sell_focus_customer"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["focus_customer"]), false); ?>';
            var $customerSelect2 = $('#customer_id').next('.select2-container');
            if ($customerSelect2.length) {
                $customerSelect2.attr('title', customerTooltip);
            } else {
                // Fallback: wait for Select2 to initialise then apply
                $(document).on('select2:open', '#customer_id', function() {
                    $('#customer_id').next('.select2-container').attr('title', customerTooltip);
                });
            }
        <?php endif; ?>

        <?php if(!empty($sell_shortcuts['add_new_customer'])): ?>
            $('.add_new_customer').attr('title', '<?php echo e(__("lang_v1.sell_add_new_customer"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["add_new_customer"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($sell_shortcuts['product_search'])): ?>
            $('#search_product').attr('title', '<?php echo e(__("lang_v1.sell_product_search"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["product_search"]), false); ?>');
            $('#open_products_search_modal').attr('title', '<?php echo e(__("lang_v1.sell_product_search"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["product_search"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($sell_shortcuts['add_payment_row'])): ?>
            $('#add-payment-row').attr('title', '<?php echo e(__("lang_v1.sell_add_payment_row"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["add_payment_row"]), false); ?>');
        <?php endif; ?>

        // Sale date & Ref no tooltips
        <?php if(!empty($sell_shortcuts['focus_sale_date'])): ?>
            var saleDateTooltip = '<?php echo e(__("lang_v1.sell_focus_sale_date"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["focus_sale_date"]), false); ?>';
            if ($('#transaction_date_text').length) {
                $('#transaction_date_text').attr('title', saleDateTooltip);
            } else if ($('#transaction_date').length) {
                $('#transaction_date').attr('title', saleDateTooltip);
            }
        <?php endif; ?>
        <?php if(!empty($sell_shortcuts['focus_ref_no'])): ?>
            $('#ref_no').attr('title', '<?php echo e(__("lang_v1.sell_focus_ref_no"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["focus_ref_no"]), false); ?>');
        <?php endif; ?>

        // Focus payment — element may be loaded later, use delegated approach
        <?php if(!empty($sell_shortcuts['focus_payment'])): ?>
            var paymentTooltip = '<?php echo e(__("lang_v1.sell_focus_payment"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["focus_payment"]), false); ?>';
            function applyPaymentTooltip() {
                $('.payment-amount').each(function() {
                    if (!$(this).data('shortcut-applied')) {
                        $(this).attr('title', paymentTooltip);
                        $(this).data('shortcut-applied', true);
                    }
                });
            }
            applyPaymentTooltip();
            $(document).on('DOMNodeInserted', '.payment_row', function() {
                setTimeout(applyPaymentTooltip, 100);
            });
        <?php endif; ?>

        // Apply shortcut tooltips on footer buttons (created dynamically, use MutationObserver)
        var sellShortcutData = {
            <?php if(!empty($sell_shortcuts['save_sell'])): ?>
                'submit-sell': '<?php echo e(strtoupper($sell_shortcuts["save_sell"]), false); ?>',
            <?php endif; ?>
            <?php if(!empty($sell_shortcuts['save_and_print'])): ?>
                'save-and-print': '<?php echo e(strtoupper($sell_shortcuts["save_and_print"]), false); ?>',
            <?php endif; ?>
            <?php if(!empty($sell_shortcuts['cancel_sell'])): ?>
                'sale-cancel': '<?php echo e(strtoupper($sell_shortcuts["cancel_sell"]), false); ?>',
            <?php endif; ?>
        };

        function applySellShortcutTooltips() {
            for (var btnId in sellShortcutData) {
                var btn = document.getElementById(btnId);
                if (btn && !btn.dataset.shortcutApplied) {
                    btn.title = btn.textContent.trim() + ' [' + sellShortcutData[btnId] + ']';
                    btn.dataset.shortcutApplied = '1';
                }
            }
        }

        // Apply immediately and observe for dynamic button creation
        applySellShortcutTooltips();
        var footerActions = document.getElementById('footer-actions');
        if (footerActions) {
            var observer = new MutationObserver(function() {
                applySellShortcutTooltips();
            });
            observer.observe(footerActions, { childList: true, subtree: true });
        }

        // Tab navigation for product search and quantity fields
        $(document).on('keydown', '#search_product', function(event) {
            if (event.key === 'Tab') {
                event.preventDefault();
                let lastQuantityElement = $('tr.product_row').find('input.pos_quantity').last();
                if (lastQuantityElement.length) {
                    lastQuantityElement.click();
                } else {
                    $('#search_product').focus();
                }
            }
        });

        $(document).on('keydown', '.product_row input[type=text]:last', function(event) {
            if (event.key === 'Tab') {
                event.preventDefault();
                $('#search_product').focus();
            }
        });

        $(document).on('keydown', '.product_row input[type=text]', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                $('#search_product').focus();
            }
        });
    });
</script>
