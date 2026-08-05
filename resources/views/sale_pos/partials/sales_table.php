<?php
    $custom_labels = json_decode(session('business.custom_labels'), true);
    $show_currency_in_value_headers = !empty($show_currency_in_value_headers);
    $currency_symbol = session('currency')['symbol'] ?? '';
    $show_fbr_invoice_no_column = !empty($fbr_enabled) || !empty($fbr_di_enabled);
?>
<div class="table-responsive">
<table class="table table-bordered table-striped ajax_view table-th-skin" id="sell_table">
    <thead>
        <tr>
            <th><?php echo app('translator')->get('messages.action'); ?></th>
            <th><?php echo app('translator')->get('messages.date'); ?></th>
            <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
            <?php if($show_fbr_invoice_no_column): ?>
            <th><?php echo app('translator')->get('sale.fbr_invoice_no'); ?></th>
            <?php endif; ?>
            <th><?php echo app('translator')->get('sale.ref_no'); ?></th>
            <th><?php echo app('translator')->get('sale.customer_name'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.contact_no'); ?></th>
            <th><?php echo app('translator')->get('sale.payment_status'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
            <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?><?php if($show_currency_in_value_headers): ?> (<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
            <th class="text-right"><?php echo app('translator')->get('sale.total_paid'); ?><?php if($show_currency_in_value_headers): ?> (<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
            <th class="text-right"><?php echo app('translator')->get('lang_v1.sell_due'); ?><?php if($show_currency_in_value_headers): ?> (<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
            <th class="text-right"><?php echo app('translator')->get('lang_v1.sell_return_due'); ?><?php if($show_currency_in_value_headers): ?> (<?php echo e($currency_symbol, false); ?>)<?php endif; ?></th>
            <th><?php echo app('translator')->get('sale.shipping_details'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.shipping_status'); ?></th>
            <th class="text-right"><?php echo app('translator')->get('lang_v1.total_items'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.types_of_service'); ?></th>
            <th><?php echo e($custom_labels['types_of_service']['custom_field_1'] ?? __('lang_v1.service_custom_field_1' ), false); ?></th>
            <th><?php echo app('translator')->get('sale.sell_note'); ?></th>
            <th><?php echo app('translator')->get('sale.staff_note'); ?></th>
            <th><?php echo app('translator')->get('restaurant.table'); ?></th>
            <th class="text-right"><?php echo app('translator')->get('restaurant.no_of_guests'); ?></th>
            <th><?php echo app('translator')->get('restaurant.service_staff'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.workstation'); ?></th>
            <th><?php echo app('translator')->get('sale.location'); ?></th>
            <th><?php echo app('translator')->get('lang_v1.created_at'); ?></th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 footer-total text-center">
            <td colspan="<?php echo e(6 + ($show_fbr_invoice_no_column ? 1 : 0), false); ?>"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
            <td class="footer_payment_status_count"></td>
            <td class="payment_method_count"></td>
            <td class="footer_sale_total text-right"></td>
            <td class="footer_total_paid text-right"></td>
            <td class="footer_total_remaining text-right"></td>
            <td class="footer_total_sell_return_due text-right"></td>
            <td colspan="2"></td>
            <td class="service_type_count"></td>
            <td colspan="5"></td>
            <td class="footer_guest_count text-right"></td>
            <td colspan="5"></td>
        </tr>
    </tfoot>
</table>
</div>
