<?php if($tab === 'detailed'): ?>
    <?php
        $common_settings = $common_settings ?? session()->get('business.common_settings', []);
        $show_product_tax_fields = $show_product_tax_fields ?? (!is_array($common_settings) || !array_key_exists('enable_product_tax', $common_settings) || !empty($common_settings['enable_product_tax']));
        $detail_colspan = $show_product_tax_fields ? 20 : 18;
    ?>
    <table>
        <thead>
            <tr>
                <th colspan="<?php echo e($detail_colspan, false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
            </tr>
            <?php if(! empty($filters_summary)): ?>
                <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th><?php echo e($label, false); ?></th>
                        <td colspan="<?php echo e($detail_colspan - 1, false); ?>"><?php echo e(is_array($value) ? ($value['value'] ?? '') : $value, false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <tr></tr>
            <tr>
                <th><?php echo e(__('lang_v1.date'), false); ?></th>
                <th><?php echo e(__('purchase.ref_no'), false); ?></th>
                <th><?php echo e(__('purchase.supplier'), false); ?></th>
                <th><?php echo e(__('lang_v1.type'), false); ?></th>
                <th><?php echo e(__('sale.location'), false); ?></th>
                <th><?php echo e(__('sale.payment_status'), false); ?></th>
                <th><?php echo e(__('sale.total_amount'), false); ?></th>
                <th><?php echo e(__('lang_v1.paid'), false); ?></th>
                <th><?php echo e(__('lang_v1.payment_method'), false); ?></th>
                <th><?php echo e(__('lang_v1.due'), false); ?></th>
                <th><?php echo e(__('sale.product'), false); ?></th>
                <th><?php echo e(__('sale.qty'), false); ?></th>
                <th><?php echo e(__('purchase.unit_cost_before_tax'), false); ?></th>
                <th><?php echo e(__('sale.discount'), false); ?></th>
                <?php if($show_product_tax_fields): ?>
                <th><?php echo e(__('sale.tax'), false); ?></th>
                <?php endif; ?>
                <?php if($show_product_tax_fields): ?>
                <th><?php echo e(__('purchase.unit_cost_after_tax'), false); ?></th>
                <?php endif; ?>
                <th><?php echo e(__('sale.subtotal'), false); ?></th>
                <th><?php echo e(__('purchase.unit_selling_price'), false); ?></th>
                <th><?php echo e(__('lang_v1.profit'), false); ?></th>
                <th><?php echo e(__('lang_v1.profit_margin'), false); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = ($ledger_details['ledger'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $paymentTypes = $ledger_details['paymentTypes'] ?? [];
                    $lines = $invoice['purchase_lines'] ?? [];
                ?>
                <?php $__empty_1 = true; $__currentLoopData = $lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $qty = ($invoice['transaction_type'] ?? '') == 'purchase_return' ? ($line->quantity_returned ?? 0) : ($line->quantity ?? 0);
                        $unit_cost = $line->purchase_price ?? 0;
                        $unit_cost_inc_tax = $line->purchase_price_inc_tax ?? 0;
                        $sell_price = ! empty($line->sell_price) ? $line->sell_price : ($line->variations->sell_price_inc_tax ?? 0);
                        $line_discount = method_exists($line, 'get_discount_amount') ? $line->get_discount_amount() : 0;
                        $line_tax = $line->item_tax ?? 0;
                        $subtotal = $qty * $unit_cost_inc_tax;
                        $sell_price_total = $sell_price * $qty;
                        $profit = ($sell_price - $unit_cost_inc_tax) * $qty;
                        $gp_percent = $sell_price_total != 0 ? ($profit / $sell_price_total) * 100 : 0;
                        $product_name = trim(($line->product->name ?? '').' '.($line->variations->sub_sku ?? ''));
                    ?>
                    <tr>
                        <td><?php echo e($invoice['date'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['ref_no'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['contact_name'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['type'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['location'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['payment_status'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['final_total'] ?? 0, false); ?></td>
                        <td><?php echo e($invoice['paid'] ?? 0, false); ?></td>
                        <td><?php echo e($paymentTypes[$invoice['payment_method'] ?? ''] ?? ($invoice['payment_method'] ?? ''), false); ?></td>
                        <td><?php echo e($invoice['due'] ?? 0, false); ?></td>
                        <td><?php echo e($product_name, false); ?></td>
                        <td><?php echo e($qty, false); ?></td>
                        <td><?php echo e($unit_cost, false); ?></td>
                        <td><?php echo e($line_discount, false); ?></td>
                        <?php if($show_product_tax_fields): ?>
                        <td><?php echo e($line_tax, false); ?></td>
                        <?php endif; ?>
                        <?php if($show_product_tax_fields): ?>
                        <td><?php echo e($unit_cost_inc_tax, false); ?></td>
                        <?php endif; ?>
                        <td><?php echo e($subtotal, false); ?></td>
                        <td><?php echo e($sell_price, false); ?></td>
                        <td><?php echo e($profit, false); ?></td>
                        <td><?php echo e(round($gp_percent, 2), false); ?>%</td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td><?php echo e($invoice['date'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['ref_no'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['contact_name'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['type'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['location'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['payment_status'] ?? '', false); ?></td>
                        <td><?php echo e($invoice['final_total'] ?? 0, false); ?></td>
                        <td><?php echo e($invoice['paid'] ?? 0, false); ?></td>
                        <td><?php echo e($paymentTypes[$invoice['payment_method'] ?? ''] ?? ($invoice['payment_method'] ?? ''), false); ?></td>
                        <td><?php echo e($invoice['due'] ?? 0, false); ?></td>
                        <td colspan="<?php echo e($show_product_tax_fields ? 10 : 8, false); ?>"></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th colspan="<?php echo e(max(count($columns), 1), false); ?>"><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?> - <?php echo e($tab_title, false); ?> - <?php echo e($location_name, false); ?> - <?php echo e($generated_at, false); ?></th>
            </tr>
            <?php if(! empty($filters_summary)): ?>
                <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th><?php echo e($label, false); ?></th>
                        <td colspan="<?php echo e(max(count($columns) - 1, 1), false); ?>"><?php echo e(is_array($value) ? ($value['value'] ?? '') : $value, false); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
            <tr></tr>
            <tr>
                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($column['label'], false); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td><?php echo e($row[$column['key']] ?? '', false); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <?php if(! empty($rows)): ?>
            <tfoot>
                <tr>
                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($loop->first): ?>
                            <td><?php echo e(__('sale.total'), false); ?></td>
                        <?php elseif(in_array(($column['type'] ?? ''), ['money', 'number'])): ?>
                            <td><?php echo e(round($totals[$column['key']] ?? 0, 2), false); ?></td>
                        <?php else: ?>
                            <td></td>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
<?php endif; ?>
