<script type="text/javascript">
    $(document).ready(function() {
        <?php
            $exp_shortcuts = !empty($shortcuts['expense']) ? $shortcuts['expense'] : [];
        ?>

        let expKeyBindingEnabled = true;

        // Save expense
        <?php if(!empty($exp_shortcuts['save'])): ?>
            Mousetrap.bind('<?php echo e($exp_shortcuts["save"], false); ?>', function(e) {
                e.preventDefault();
                if (expKeyBindingEnabled) {
                    expKeyBindingEnabled = false;
                    var $btn = $('button[form="add_expense_form"]');
                    if ($btn.length) {
                        $btn.trigger('click');
                    } else {
                        $('#add_expense_form button[type="submit"]').trigger('click');
                    }
                    setTimeout(() => { expKeyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus location (Select2)
        <?php if(!empty($exp_shortcuts['focus_location'])): ?>
            Mousetrap.bind('<?php echo e($exp_shortcuts["focus_location"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#location_id').length) {
                    $('#location_id').select2('open');
                }
            });
        <?php endif; ?>

        // Focus ref no
        <?php if(!empty($exp_shortcuts['focus_ref_no'])): ?>
            Mousetrap.bind('<?php echo e($exp_shortcuts["focus_ref_no"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#ref_no').length) {
                    $('#ref_no').focus();
                }
            });
        <?php endif; ?>

        // Focus date
        <?php if(!empty($exp_shortcuts['focus_date'])): ?>
            Mousetrap.bind('<?php echo e($exp_shortcuts["focus_date"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#expense_transaction_date_text').length) {
                    $('#expense_transaction_date_text').focus();
                }
            });
        <?php endif; ?>

        // Focus category (Select2)
        <?php if(!empty($exp_shortcuts['focus_category'])): ?>
            Mousetrap.bind('<?php echo e($exp_shortcuts["focus_category"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#expense_category_id').length) {
                    $('#expense_category_id').select2('open');
                }
            });
        <?php endif; ?>

        // Focus amount
        <?php if(!empty($exp_shortcuts['focus_amount'])): ?>
            Mousetrap.bind('<?php echo e($exp_shortcuts["focus_amount"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#final_total').length) {
                    $('#final_total').focus().select();
                }
            });
        <?php endif; ?>

        // Focus payment amount
        <?php if(!empty($exp_shortcuts['focus_payment'])): ?>
            Mousetrap.bind('<?php echo e($exp_shortcuts["focus_payment"], false); ?>', function(e) {
                e.preventDefault();
                var $paymentAmount = $('.payment-amount:first');
                if ($paymentAmount.length) {
                    $paymentAmount.focus().select();
                }
            });
        <?php endif; ?>

        // Focus tax (Select2)
        <?php if(!empty($exp_shortcuts['focus_tax'])): ?>
            Mousetrap.bind('<?php echo e($exp_shortcuts["focus_tax"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#tax_id').length) {
                    $('#tax_id').select2('open');
                }
            });
        <?php endif; ?>

        // Show shortcuts help modal
        <?php if(!empty($exp_shortcuts['show_shortcuts_help'])): ?>
            Mousetrap.bind('<?php echo e($exp_shortcuts["show_shortcuts_help"], false); ?>', function(e) {
                e.preventDefault();
                $('#expenseKeyboardShortcutsModal').modal('toggle');
            });
        <?php endif; ?>

        // Apply shortcut tooltips on hover

        // Location — Select2
        <?php if(!empty($exp_shortcuts['focus_location'])): ?>
            var expLocTooltip = '<?php echo e(__("lang_v1.expense_focus_location"), false); ?>: <?php echo e(strtoupper($exp_shortcuts["focus_location"]), false); ?>';
            var $expLocSelect2 = $('#location_id').next('.select2-container');
            if ($expLocSelect2.length) {
                $expLocSelect2.attr('title', expLocTooltip);
            } else {
                $(document).on('select2:open', '#location_id', function() {
                    $('#location_id').next('.select2-container').attr('title', expLocTooltip);
                });
            }
        <?php endif; ?>

        <?php if(!empty($exp_shortcuts['focus_ref_no'])): ?>
            $('#ref_no').attr('title', '<?php echo e(__("lang_v1.expense_focus_ref_no"), false); ?>: <?php echo e(strtoupper($exp_shortcuts["focus_ref_no"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($exp_shortcuts['focus_date'])): ?>
            $('#expense_transaction_date_text').attr('title', '<?php echo e(__("lang_v1.expense_focus_date"), false); ?>: <?php echo e(strtoupper($exp_shortcuts["focus_date"]), false); ?>');
        <?php endif; ?>

        // Category — Select2
        <?php if(!empty($exp_shortcuts['focus_category'])): ?>
            var expCatTooltip = '<?php echo e(__("lang_v1.expense_focus_category"), false); ?>: <?php echo e(strtoupper($exp_shortcuts["focus_category"]), false); ?>';
            var $expCatSelect2 = $('#expense_category_id').next('.select2-container');
            if ($expCatSelect2.length) {
                $expCatSelect2.attr('title', expCatTooltip);
            } else {
                $(document).on('select2:open', '#expense_category_id', function() {
                    $('#expense_category_id').next('.select2-container').attr('title', expCatTooltip);
                });
            }
        <?php endif; ?>

        <?php if(!empty($exp_shortcuts['focus_amount'])): ?>
            $('#final_total').attr('title', '<?php echo e(__("lang_v1.expense_focus_amount"), false); ?>: <?php echo e(strtoupper($exp_shortcuts["focus_amount"]), false); ?>');
        <?php endif; ?>

        // Tax — Select2
        <?php if(!empty($exp_shortcuts['focus_tax'])): ?>
            var expTaxTooltip = '<?php echo e(__("lang_v1.expense_focus_tax"), false); ?>: <?php echo e(strtoupper($exp_shortcuts["focus_tax"]), false); ?>';
            var $expTaxSelect2 = $('#tax_id').next('.select2-container');
            if ($expTaxSelect2.length) {
                $expTaxSelect2.attr('title', expTaxTooltip);
            } else {
                $(document).on('select2:open', '#tax_id', function() {
                    $('#tax_id').next('.select2-container').attr('title', expTaxTooltip);
                });
            }
        <?php endif; ?>

        // Payment tooltip
        <?php if(!empty($exp_shortcuts['focus_payment'])): ?>
            var expPayTooltip = '<?php echo e(__("lang_v1.expense_focus_payment"), false); ?>: <?php echo e(strtoupper($exp_shortcuts["focus_payment"]), false); ?>';
            function applyExpPaymentTooltip() {
                $('.payment-amount').each(function() {
                    if (!$(this).data('shortcut-applied')) {
                        $(this).attr('title', expPayTooltip);
                        $(this).data('shortcut-applied', true);
                    }
                });
            }
            applyExpPaymentTooltip();
            $(document).on('DOMNodeInserted', '.payment_row', function() {
                setTimeout(applyExpPaymentTooltip, 100);
            });
        <?php endif; ?>

        // Footer button tooltips (created dynamically via MutationObserver)
        function applyExpShortcutTooltips() {
            <?php if(!empty($exp_shortcuts['save'])): ?>
                $('button[form="add_expense_form"]').each(function() {
                    if (!$(this).data('shortcut-applied')) {
                        $(this).attr('title', $(this).text().trim() + ' [<?php echo e(strtoupper($exp_shortcuts["save"]), false); ?>]');
                        $(this).data('shortcut-applied', true);
                    }
                });
            <?php endif; ?>
        }

        applyExpShortcutTooltips();
        var footerActions = document.getElementById('footer-actions');
        if (footerActions) {
            var observer = new MutationObserver(function() {
                applyExpShortcutTooltips();
            });
            observer.observe(footerActions, { childList: true, subtree: true });
        }
    });
</script>
