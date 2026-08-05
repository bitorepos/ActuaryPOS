

<style>
/* Shortcut badge on hover */
.pos-shortcut-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: rgba(0, 0, 0, 0.85);
    color: #fff;
    font-size: 10px;
    font-weight: 600;
    padding: 2px 5px;
    border-radius: 3px;
    white-space: nowrap;
    z-index: 1060;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.15s ease-in-out;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    line-height: 1.3;
    box-shadow: 0 1px 3px rgba(0,0,0,0.3);
}
[data-pos-shortcut] {
    position: relative;
}
[data-pos-shortcut]:hover {
    z-index: 1061;
}
[data-pos-shortcut]:hover .pos-shortcut-badge {
    opacity: 1;
}
/* Adjust badge position for input groups */
.input-group [data-pos-shortcut] .pos-shortcut-badge {
    top: -10px;
    right: 2px;
}
/* Keyboard shortcuts help button */
.pos-shortcuts-help-btn {
    position: fixed;
    bottom: 10px;
    right: 10px;
    z-index: 1050;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(0,0,0,0.6);
    color: #fff;
    border: none;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}
.pos-shortcuts-help-btn:hover {
    background: rgba(0,0,0,0.85);
    color: #fff;
}
.pos-shortcuts-help-btn .pos-shortcut-badge {
    top: -10px;
    right: -10px;
}
/* Responsive: hide badges on mobile */
@media (max-width: 767.98px) {
    .pos-shortcut-badge {
        display: none !important;
    }
    .pos-shortcuts-help-btn {
        display: none !important;
    }
}
</style>


<button type="button" class="pos-shortcuts-help-btn no-print" data-pos-shortcut="<?php echo e($shortcuts['pos']['show_shortcuts_help'] ?? 'f7', false); ?>" 
    onclick="$('#posKeyboardShortcutsModal').modal('show')" title="<?php echo app('translator')->get('lang_v1.show_shortcuts_help'); ?>">
    <i class="fas fa-keyboard"></i>
    <span class="pos-shortcut-badge"><?php echo e(strtoupper($shortcuts['pos']['show_shortcuts_help'] ?? 'F7'), false); ?></span>
</button>

<script>
$(document).ready(function() {
    // Map of element selectors => shortcut keys from server
    var posShortcutMap = {
        <?php if(!empty($shortcuts["pos"]["express_checkout"]) && ($pos_settings['disable_express_checkout'] == 0)): ?>
            'button.pos-express-finalize[data-pay_method="cash"]:not([data-takeaway])': '<?php echo e($shortcuts["pos"]["express_checkout"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["pay_n_ckeckout"]) && ($pos_settings['disable_pay_checkout'] == 0)): ?>
            '#pos-finalize': '<?php echo e($shortcuts["pos"]["pay_n_ckeckout"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["draft"]) && ($pos_settings['disable_draft'] == 0)): ?>
            '#pos-draft': '<?php echo e($shortcuts["pos"]["draft"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["cancel"])): ?>
            '#pos-cancel': '<?php echo e($shortcuts["pos"]["cancel"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["edit_discount"]) && ($pos_settings['disable_discount'] == 0)): ?>
            '#pos-edit-discount': '<?php echo e($shortcuts["pos"]["edit_discount"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["edit_order_tax"]) && ($pos_settings['disable_invoice_tax'] == 0)): ?>
            '#pos-edit-tax': '<?php echo e($shortcuts["pos"]["edit_order_tax"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["add_payment_row"]) && ($pos_settings['disable_pay_checkout'] == 0)): ?>
            '#add-payment-row': '<?php echo e($shortcuts["pos"]["add_payment_row"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["finalize_payment"]) && ($pos_settings['disable_pay_checkout'] == 0)): ?>
            '#pos-save': '<?php echo e($shortcuts["pos"]["finalize_payment"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["recent_product_quantity"])): ?>
            'table#pos_table': '<?php echo e($shortcuts["pos"]["recent_product_quantity"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["add_new_product"])): ?>
            '#search_product': '<?php echo e($shortcuts["pos"]["add_new_product"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["weighing_scale"])): ?>
            '#weighing_scale_btn': '<?php echo e($shortcuts["pos"]["weighing_scale"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["focus_customer"])): ?>
            '#customer_id': '<?php echo e($shortcuts["pos"]["focus_customer"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["add_new_customer"])): ?>
            '.add_new_customer': '<?php echo e($shortcuts["pos"]["add_new_customer"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["quotation"])): ?>
            '#pos-quotation': '<?php echo e($shortcuts["pos"]["quotation"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["suspend"])): ?>
            '.pos-express-finalize[data-pay_method="suspend"]': '<?php echo e($shortcuts["pos"]["suspend"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["credit_sale"])): ?>
            '.pos-express-finalize[data-pay_method="credit_sale"]:not([data-takeaway])': '<?php echo e($shortcuts["pos"]["credit_sale"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["express_card"])): ?>
            '.pos-express-finalize[data-pay_method="card"]': '<?php echo e($shortcuts["pos"]["express_card"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["recent_transactions"])): ?>
            '#recent-transactions': '<?php echo e($shortcuts["pos"]["recent_transactions"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["quick_add_product"])): ?>
            '.pos_add_quick_product': '<?php echo e($shortcuts["pos"]["quick_add_product"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["focus_sku_search"])): ?>
            '#search_product_sku': '<?php echo e($shortcuts["pos"]["focus_sku_search"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["fullscreen_toggle"])): ?>
            '.pos-shortcuts-help-fullscreen': '<?php echo e($shortcuts["pos"]["fullscreen_toggle"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["takeaway_1"])): ?>
            '#pos-takeaway-finalize[data-takeaway="1"]': '<?php echo e($shortcuts["pos"]["takeaway_1"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["takeaway_2"])): ?>
            '#pos-takeaway-finalize[data-takeaway="2"]': '<?php echo e($shortcuts["pos"]["takeaway_2"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["takeaway_3"])): ?>
            '#pos-takeaway-finalize[data-takeaway="3"]': '<?php echo e($shortcuts["pos"]["takeaway_3"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["edit_shipping"]) && ($pos_settings['disable_shipping'] == 0)): ?>
            '#pos-edit-shipping': '<?php echo e($shortcuts["pos"]["edit_shipping"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["service_charge"])): ?>
            '.service_modal_btn': '<?php echo e($shortcuts["pos"]["service_charge"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["cash_pull"])): ?>
            '#open_cash_pull_modal': '<?php echo e($shortcuts["pos"]["cash_pull"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["calculator"])): ?>
            '#btnCalculator': '<?php echo e($shortcuts["pos"]["calculator"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["customer_display"])): ?>
            '#customer_display_screen': '<?php echo e($shortcuts["pos"]["customer_display"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["open_cash_drawer"])): ?>
            '#open_cash_drawer': '<?php echo e($shortcuts["pos"]["open_cash_drawer"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["view_suspended"])): ?>
            '#view_suspended_sales': '<?php echo e($shortcuts["pos"]["view_suspended"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["sell_return"])): ?>
            '#return_sale': '<?php echo e($shortcuts["pos"]["sell_return"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["add_expense"])): ?>
            '#add_expense': '<?php echo e($shortcuts["pos"]["add_expense"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["register_details"])): ?>
            '#register_details': '<?php echo e($shortcuts["pos"]["register_details"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["close_register"])): ?>
            '#close_register': '<?php echo e($shortcuts["pos"]["close_register"], false); ?>',
        <?php endif; ?>
        <?php if(!empty($shortcuts["pos"]["service_staff"])): ?>
            '#show_service_staff_availability': '<?php echo e($shortcuts["pos"]["service_staff"], false); ?>',
        <?php endif; ?>
        '#open_products_search_modal': 'f10'
    };

    // Apply data-pos-shortcut attribute and badge to elements
    $.each(posShortcutMap, function(selector, shortcutKey) {
        // Always use querySelectorAll for ID selectors to handle duplicate IDs
        // (e.g. #pos-edit-discount exists in multiple POS interfaces)
        var $el = (selector.charAt(0) === '#' && selector.indexOf(' ') === -1)
            ? $(document.querySelectorAll(selector))
            : $(selector);
        if ($el.length) {
            $el.each(function() {
                var $this = $(this);
                // Skip if already has a badge
                if ($this.attr('data-pos-shortcut')) return;
                $this.attr('data-pos-shortcut', shortcutKey);
                // Add badge span
                var badgeHtml = '<span class="pos-shortcut-badge">' + shortcutKey.toUpperCase().replace(/\+/g, '+') + '</span>';
                $this.append(badgeHtml);
                // Update title to include shortcut
                var existingTitle = $this.attr('title') || '';
                if (existingTitle && existingTitle.indexOf('[') === -1) {
                    $this.attr('title', existingTitle + ' [' + shortcutKey.toUpperCase() + ']');
                } else if (!existingTitle) {
                    $this.attr('title', '[' + shortcutKey.toUpperCase() + ']');
                }
            });
        }
    });
});
</script>
