<script type="text/javascript">
    $(document).ready(function() {
        <?php
            $st_shortcuts = !empty($shortcuts['stock_transfer']) ? $shortcuts['stock_transfer'] : [];
        ?>

        let stKeyBindingEnabled = true;

        // Save stock transfer
        <?php if(!empty($st_shortcuts['save'])): ?>
            Mousetrap.bind('<?php echo e($st_shortcuts["save"], false); ?>', function(e) {
                e.preventDefault();
                if (stKeyBindingEnabled) {
                    stKeyBindingEnabled = false;
                    if ($('#save_stock_transfer').length) {
                        $('#save_stock_transfer').trigger('click');
                    }
                    setTimeout(() => { stKeyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus location from (Select2)
        <?php if(!empty($st_shortcuts['focus_location_from'])): ?>
            Mousetrap.bind('<?php echo e($st_shortcuts["focus_location_from"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#location_id').length) {
                    $('#location_id').select2('open');
                }
            });
        <?php endif; ?>

        // Focus location to (Select2)
        <?php if(!empty($st_shortcuts['focus_location_to'])): ?>
            Mousetrap.bind('<?php echo e($st_shortcuts["focus_location_to"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#transfer_location_id').length) {
                    $('#transfer_location_id').select2('open');
                }
            });
        <?php endif; ?>

        // Focus ref no
        <?php if(!empty($st_shortcuts['focus_ref_no'])): ?>
            Mousetrap.bind('<?php echo e($st_shortcuts["focus_ref_no"], false); ?>', function(e) {
                e.preventDefault();
                $('input[name="ref_no"]').focus();
            });
        <?php endif; ?>

        // Focus date
        <?php if(!empty($st_shortcuts['focus_date'])): ?>
            Mousetrap.bind('<?php echo e($st_shortcuts["focus_date"], false); ?>', function(e) {
                e.preventDefault();
                if ($('#transaction_date_text').length) {
                    $('#transaction_date_text').focus();
                }
            });
        <?php endif; ?>

        // Product search (overrides hardcoded F10 in stock_transfer.js)
        <?php if(!empty($st_shortcuts['product_search'])): ?>
            Mousetrap.bind('<?php echo e($st_shortcuts["product_search"], false); ?>', function(e) {
                e.preventDefault();
                if (stKeyBindingEnabled) {
                    stKeyBindingEnabled = false;
                    $('#search_product_for_srock_adjustment').focus();
                    if ($('button#open_products_search_modal').length) {
                        $('button#open_products_search_modal').trigger('click');
                    }
                    setTimeout(() => { stKeyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Focus last product quantity
        <?php if(!empty($st_shortcuts['focus_last_qty'])): ?>
            Mousetrap.bind('<?php echo e($st_shortcuts["focus_last_qty"], false); ?>', function(e) {
                e.preventDefault();
                var lastQty = $('#stock_adjustment_product_table tbody tr:last').find('input.product_quantity');
                if (lastQty.length) {
                    lastQty.focus().select();
                }
            });
        <?php endif; ?>

        // Remove last product row
        <?php if(!empty($st_shortcuts['remove_last_product'])): ?>
            Mousetrap.bind('<?php echo e($st_shortcuts["remove_last_product"], false); ?>', function(e) {
                e.preventDefault();
                if (stKeyBindingEnabled) {
                    stKeyBindingEnabled = false;
                    var lastRow = $('#stock_adjustment_product_table tbody tr:last');
                    if (lastRow.length) {
                        lastRow.find('.remove_product_row').trigger('click');
                    }
                    setTimeout(() => { stKeyBindingEnabled = true; }, 2000);
                }
            });
        <?php endif; ?>

        // Show shortcuts help modal
        <?php if(!empty($st_shortcuts['show_shortcuts_help'])): ?>
            Mousetrap.bind('<?php echo e($st_shortcuts["show_shortcuts_help"], false); ?>', function(e) {
                e.preventDefault();
                $('#stockTransferKeyboardShortcutsModal').modal('toggle');
            });
        <?php endif; ?>

        // Apply shortcut tooltips on hover

        // Location from — Select2
        <?php if(!empty($st_shortcuts['focus_location_from'])): ?>
            var locFromTooltip = '<?php echo e(__("lang_v1.stock_transfer_focus_location_from"), false); ?>: <?php echo e(strtoupper($st_shortcuts["focus_location_from"]), false); ?>';
            var $locFromSelect2 = $('#location_id').next('.select2-container');
            if ($locFromSelect2.length) {
                $locFromSelect2.attr('title', locFromTooltip);
            } else {
                $(document).on('select2:open', '#location_id', function() {
                    $('#location_id').next('.select2-container').attr('title', locFromTooltip);
                });
            }
        <?php endif; ?>

        // Location to — Select2
        <?php if(!empty($st_shortcuts['focus_location_to'])): ?>
            var locToTooltip = '<?php echo e(__("lang_v1.stock_transfer_focus_location_to"), false); ?>: <?php echo e(strtoupper($st_shortcuts["focus_location_to"]), false); ?>';
            var $locToSelect2 = $('#transfer_location_id').next('.select2-container');
            if ($locToSelect2.length) {
                $locToSelect2.attr('title', locToTooltip);
            } else {
                $(document).on('select2:open', '#transfer_location_id', function() {
                    $('#transfer_location_id').next('.select2-container').attr('title', locToTooltip);
                });
            }
        <?php endif; ?>

        <?php if(!empty($st_shortcuts['focus_ref_no'])): ?>
            $('input[name="ref_no"]').attr('title', '<?php echo e(__("lang_v1.stock_transfer_focus_ref_no"), false); ?>: <?php echo e(strtoupper($st_shortcuts["focus_ref_no"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($st_shortcuts['focus_date'])): ?>
            $('#transaction_date_text').attr('title', '<?php echo e(__("lang_v1.stock_transfer_focus_date"), false); ?>: <?php echo e(strtoupper($st_shortcuts["focus_date"]), false); ?>');
        <?php endif; ?>
        <?php if(!empty($st_shortcuts['product_search'])): ?>
            $('#search_product_for_srock_adjustment').attr('title', '<?php echo e(__("lang_v1.stock_transfer_product_search"), false); ?>: <?php echo e(strtoupper($st_shortcuts["product_search"]), false); ?>');
        <?php endif; ?>

        // Save button tooltip (static inline button)
        <?php if(!empty($st_shortcuts['save'])): ?>
            var $saveBtn = $('#save_stock_transfer');
            if ($saveBtn.length) {
                $saveBtn.attr('title', $saveBtn.text().trim() + ' [<?php echo e(strtoupper($st_shortcuts["save"]), false); ?>]');
            }
        <?php endif; ?>
    });
</script>
