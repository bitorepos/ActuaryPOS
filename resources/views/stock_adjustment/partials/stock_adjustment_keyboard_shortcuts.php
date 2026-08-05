<script type="text/javascript">
    $(document).ready(function() {
        <?php
            $sa_shortcuts = !empty($shortcuts['stock_adjustment']) ? $shortcuts['stock_adjustment'] : [];
        ?>

        let keyBindingEnabled = true;

        // Save stock adjustment
        <?php if(!empty($sa_shortcuts['save'])): ?>
            Mousetrap.bind('<?php echo e($sa_shortcuts["save"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    var $btn = $('button[form="stock_adjustment_form"]');
                    if ($btn.length) {
                        $btn.trigger('click');
                    } else {
                        $('#stock_adjustment_form button[type="submit"]').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus location (Select2)
        <?php if(!empty($sa_shortcuts['focus_location'])): ?>
            Mousetrap.bind('<?php echo e($sa_shortcuts["focus_location"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#location_id').length) {
                    $('#location_id').select2('open');
                }
            });
        <?php endif; ?>

        // Focus ref no
        <?php if(!empty($sa_shortcuts['focus_ref_no'])): ?>
            Mousetrap.bind('<?php echo e($sa_shortcuts["focus_ref_no"], false); ?>', function(e) {
                e.preventDefault();
                $('input[name="ref_no"]').focus();
            });
        <?php endif; ?>

        // Focus date
        <?php if(!empty($sa_shortcuts['focus_date'])): ?>
            Mousetrap.bind('<?php echo e($sa_shortcuts["focus_date"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#transaction_date_text').length) {
                    $('#transaction_date_text').focus();
                }
            });
        <?php endif; ?>

        // Product search
        <?php if(!empty($sa_shortcuts['product_search'])): ?>
            Mousetrap.bind('<?php echo e($sa_shortcuts["product_search"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    $('#search_product_for_srock_adjustment').focus();
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus last product quantity
        <?php if(!empty($sa_shortcuts['focus_last_qty'])): ?>
            Mousetrap.bind('<?php echo e($sa_shortcuts["focus_last_qty"], false); ?>', function(e) {
                e.preventDefault();
                var lastQty = $('#stock_adjustment_product_table tbody tr:last').find('input.product_quantity');
                if (lastQty.length) {
                    lastQty.focus().select();
                }
            });
        <?php endif; ?>

        // Remove last product row
        <?php if(!empty($sa_shortcuts['remove_last_product'])): ?>
            Mousetrap.bind('<?php echo e($sa_shortcuts["remove_last_product"], false); ?>', function(e) {
                e.preventDefault();
                if (keyBindingEnabled) {
                    keyBindingEnabled = false;
                    var lastRow = $('#stock_adjustment_product_table tbody tr:last');
                    if (lastRow.length) {
                        lastRow.find('.remove_product_row').trigger('click');
                    }
                    setTimeout(() => { keyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus recovery amount
        <?php if(!empty($sa_shortcuts['focus_recovery_amount'])): ?>
            Mousetrap.bind('<?php echo e($sa_shortcuts["focus_recovery_amount"], false); ?>', function(e) {
                e.preventDefault();
                if ($('input[name="total_amount_recovered"]').length) {
                    $('input[name="total_amount_recovered"]').focus().select();
                }
            });
        <?php endif; ?>

        // Show shortcuts help modal
        <?php if(!empty($sa_shortcuts['show_shortcuts_help'])): ?>
            Mousetrap.bind('<?php echo e($sa_shortcuts["show_shortcuts_help"], false); ?>', function(e) {
                e.preventDefault();
                $('#stockAdjustmentKeyboardShortcutsModal').modal('toggle');
            });
        <?php endif; ?>

        // Apply shortcut tooltips on hover

        // Location — Select2
        <?php if(!empty($sa_shortcuts['focus_location'])): ?>
            var locationTooltip = '<?php echo e(__("lang_v1.stock_adjustment_focus_location"), false); ?>: <?php echo e(strtoupper($sa_shortcuts["focus_location"]), false); ?>';
            var $locationSelect2 = $('#location_id').next('.select2-container');
            if ($locationSelect2.length) {
                $locationSelect2.attr('title', locationTooltip);
            } else {
                $(document).on('select2:open', '#location_id', function() {
                    $('#location_id').next('.select2-container').attr('title', locationTooltip);
                });
            }
        <?php endif; ?>

        <?php if(!empty($sa_shortcuts['focus_ref_no'])): ?>
            $('input[name="ref_no"]').attr('title', '<?php echo e(__("lang_v1.stock_adjustment_focus_ref_no"), false); ?>: <?php echo e(strtoupper($sa_shortcuts["focus_ref_no"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($sa_shortcuts['focus_date'])): ?>
            $('#transaction_date_text').attr('title', '<?php echo e(__("lang_v1.stock_adjustment_focus_date"), false); ?>: <?php echo e(strtoupper($sa_shortcuts["focus_date"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($sa_shortcuts['product_search'])): ?>
            $('#search_product_for_srock_adjustment').attr('title', '<?php echo e(__("lang_v1.stock_adjustment_product_search"), false); ?>: <?php echo e(strtoupper($sa_shortcuts["product_search"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($sa_shortcuts['focus_recovery_amount'])): ?>
            $('input[name="total_amount_recovered"]').attr('title', '<?php echo e(__("lang_v1.stock_adjustment_focus_recovery_amount"), false); ?>: <?php echo e(strtoupper($sa_shortcuts["focus_recovery_amount"]), false); ?>');
        <?php endif; ?>

        // Footer button tooltips (created dynamically via MutationObserver)
        function applySaShortcutTooltips() {
            <?php if(!empty($sa_shortcuts['save'])): ?>
                $('button[form="stock_adjustment_form"]').each(function() {
                    if (!$(this).data('shortcut-applied')) {
                        $(this).attr('title', $(this).text().trim() + ' [<?php echo e(strtoupper($sa_shortcuts["save"]), false); ?>]');
                        $(this).data('shortcut-applied', true);
                    }
                });
            <?php endif; ?>
        }

        applySaShortcutTooltips();
        var footerActions = document.getElementById('footer-actions');
        if (footerActions) {
            var observer = new MutationObserver(function() {
                applySaShortcutTooltips();
            });
            observer.observe(footerActions, { childList: true, subtree: true });
        }
    });
</script>
