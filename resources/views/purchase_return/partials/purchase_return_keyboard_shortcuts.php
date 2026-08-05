<script type="text/javascript">
    $(document).ready(function() {
        <?php
            $purchase_shortcuts = !empty($shortcuts['purchase']) ? $shortcuts['purchase'] : [];
        ?>

        let keyBindingEnabled = true;

        // Save purchase return
        <?php if(!empty($purchase_shortcuts['save_purchase_return'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["save_purchase_return"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('button#submit_purchase_return_form:last').trigger('click');
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Save & print return
        <?php if(!empty($purchase_shortcuts['save_and_print_return'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["save_and_print_return"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('button.save_and_print_return, button#submit_purchase_return_form.save_and_print').trigger('click');
                    if (!$('button.save_and_print_return').length && !$('button#submit_purchase_return_form.save_and_print').length) {
                        $('button#submit_purchase_return_form:last').trigger('click');
                    }
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

        // Product search (for standalone purchase return)
        <?php if(!empty($purchase_shortcuts['product_search'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["product_search"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#search_product').length) {
                    $('#search_product').focus();
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

        // Show shortcuts help modal
        <?php if(!empty($purchase_shortcuts['show_shortcuts_help'])): ?>
            Mousetrap.bind('<?php echo e($purchase_shortcuts["show_shortcuts_help"], false); ?>', function(e) {
                e.preventDefault();
                $('#purchase_keyboard_shortcuts_modal').modal('toggle');
            });
        <?php endif; ?>

        // ---- Tooltips ----
        <?php if(!empty($purchase_shortcuts['focus_supplier'])): ?>
            var supplierTooltip = '<?php echo e(__("lang_v1.purchase_focus_supplier"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["focus_supplier"]), false); ?>';
            var $supplierSelect2 = $('#supplier_id').next('.select2-container');
            if ($supplierSelect2.length) {
                $supplierSelect2.attr('title', supplierTooltip);
            }
        <?php endif; ?>
        <?php if(!empty($purchase_shortcuts['product_search'])): ?>
            $('#search_product').attr('title', '<?php echo e(__("lang_v1.purchase_product_search"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["product_search"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($purchase_shortcuts['focus_ref_no'])): ?>
            $('input[name="ref_no"]').attr('title', '<?php echo e(__("lang_v1.purchase_focus_ref_no"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["focus_ref_no"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($purchase_shortcuts['focus_purchase_date'])): ?>
            var dateTooltip = '<?php echo e(__("lang_v1.purchase_focus_date"), false); ?>: <?php echo e(strtoupper($purchase_shortcuts["focus_purchase_date"]), false); ?>';
            if ($('#transaction_date_text').length) {
                $('#transaction_date_text').attr('title', dateTooltip);
            } else if ($('#transaction_date').length) {
                $('#transaction_date').attr('title', dateTooltip);
            }
        <?php endif; ?>

        // Footer button tooltips (dynamically created)
        var purchaseReturnShortcutData = {
            <?php if(!empty($purchase_shortcuts['save_purchase_return'])): ?>
                'submit_purchase_return_form': '<?php echo e(strtoupper($purchase_shortcuts["save_purchase_return"]), false); ?>',
            <?php endif; ?>
        };

        function applyPurchaseReturnShortcutTooltips() {
            $('button#submit_purchase_return_form').each(function() {
                if (!this.dataset.shortcutApplied && purchaseReturnShortcutData['submit_purchase_return_form']) {
                    this.title = this.textContent.trim() + ' [' + purchaseReturnShortcutData['submit_purchase_return_form'] + ']';
                    this.dataset.shortcutApplied = '1';
                }
            });
        }

        applyPurchaseReturnShortcutTooltips();
        var footerActions = document.getElementById('footer-actions');
        if (footerActions) {
            var observer = new MutationObserver(function() {
                applyPurchaseReturnShortcutTooltips();
            });
            observer.observe(footerActions, { childList: true, subtree: true });
        }
    });
</script>
