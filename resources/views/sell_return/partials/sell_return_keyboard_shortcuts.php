<script type="text/javascript">
    $(document).ready(function() {
        <?php
            $sell_shortcuts = !empty($shortcuts['sell']) ? $shortcuts['sell'] : [];
        ?>

        let keyBindingEnabled = true;

        // Save sell return
        <?php if(!empty($sell_shortcuts['save_sell_return'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["save_sell_return"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    if ($('button#submit_sell_return_form').length && !$('button#submit_sell_return_form').prop('disabled')) {
                        $('button#submit_sell_return_form').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Save & print sell return
        <?php if(!empty($sell_shortcuts['save_and_print_return'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["save_and_print_return"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    if ($('button#save-and-print').length) {
                        $('button#save-and-print').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus payment amount (reuse sell shortcut)
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

        // Focus sale date field
        <?php if(!empty($sell_shortcuts['focus_sale_date'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["focus_sale_date"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#transaction_date').length) {
                    $('#transaction_date').focus();
                }
            });
        <?php endif; ?>

        // Focus ref no field
        <?php if(!empty($sell_shortcuts['focus_ref_no'])): ?>
            Mousetrap.bind('<?php echo e($sell_shortcuts["focus_ref_no"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#invoice_no').length) {
                    $('#invoice_no').focus();
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

        // Apply shortcut tooltips on footer buttons (created dynamically)
        var sellReturnShortcutData = {
            <?php if(!empty($sell_shortcuts['save_sell_return'])): ?>
                'submit_sell_return_form': '<?php echo e(strtoupper($sell_shortcuts["save_sell_return"]), false); ?>',
            <?php endif; ?>
            <?php if(!empty($sell_shortcuts['save_and_print_return'])): ?>
                'save-and-print': '<?php echo e(strtoupper($sell_shortcuts["save_and_print_return"]), false); ?>',
            <?php endif; ?>
        };

        function applySellReturnShortcutTooltips() {
            for (var btnId in sellReturnShortcutData) {
                var btn = document.getElementById(btnId);
                if (btn && !btn.dataset.shortcutApplied) {
                    btn.title = btn.textContent.trim() + ' [' + sellReturnShortcutData[btnId] + ']';
                    btn.dataset.shortcutApplied = '1';
                }
            }
        }

        applySellReturnShortcutTooltips();
        var footerActions = document.getElementById('footer-actions');
        if (footerActions) {
            var observer = new MutationObserver(function() {
                applySellReturnShortcutTooltips();
            });
            observer.observe(footerActions, { childList: true, subtree: true });
        }

        // Sale date & Ref no tooltips
        <?php if(!empty($sell_shortcuts['focus_sale_date'])): ?>
            $('#transaction_date').attr('title', '<?php echo e(__("lang_v1.sell_focus_sale_date"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["focus_sale_date"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($sell_shortcuts['focus_ref_no'])): ?>
            $('#invoice_no').attr('title', '<?php echo e(__("lang_v1.sell_focus_ref_no"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["focus_ref_no"]), false); ?>');
        <?php endif; ?>

        // Focus payment tooltip
        <?php if(!empty($sell_shortcuts['focus_payment'])): ?>
            var paymentTooltip = '<?php echo e(__("lang_v1.sell_focus_payment"), false); ?>: <?php echo e(strtoupper($sell_shortcuts["focus_payment"]), false); ?>';
            function applyReturnPaymentTooltip() {
                $('.payment-amount').each(function() {
                    if (!$(this).data('shortcut-applied')) {
                        $(this).attr('title', paymentTooltip);
                        $(this).data('shortcut-applied', true);
                    }
                });
            }
            applyReturnPaymentTooltip();
            $(document).on('DOMNodeInserted', '.payment_row', function() {
                setTimeout(applyReturnPaymentTooltip, 100);
            });
        <?php endif; ?>
    });
</script>
