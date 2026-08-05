<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/product-serial-report-print');
    $report_title = $report_title ?? __('lang_v1.product_serial_report');
    $total_pages = count($row_pages ?? [[]]);
    $qty_precision = session('business.quantity_precision', 2);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $scheme_enabled = ! empty($show_scheme_qty);
    $us = $user_settings ?? [];
    $column_visible = function ($key) use ($us) {
        return empty($us['rpt_sales_pserial_hide_'.$key]);
    };

    $visible = [
        'sku' => $column_visible('sku'),
        'product' => $column_visible('product'),
        'brand_name' => $column_visible('brand_name'),
        'contact_id' => $column_visible('contact_id'),
        'contact' => $column_visible('contact'),
        'supplier_name' => $column_visible('supplier_name'),
        'type' => $column_visible('type'),
        'invoice_no' => $column_visible('invoice_no'),
        'date' => $column_visible('date'),
        'qty' => $column_visible('qty'),
        'scheme_qty' => $scheme_enabled && $column_visible('scheme_qty'),
        'sr_imei_no' => $column_visible('sr_imei_no'),
        'unit_price' => $column_visible('unit_price'),
        'subtotal' => $column_visible('subtotal'),
        'discount' => $column_visible('discount'),
        'discount_pct' => $column_visible('discount_pct'),
        'tax' => $column_visible('tax'),
        'price_inc_tax' => $column_visible('price_inc_tax'),
        'total' => $column_visible('total'),
        'days' => $column_visible('days'),
    ];

    $lead_cols = 0;
    foreach (['sku', 'product', 'brand_name', 'contact_id', 'contact', 'supplier_name', 'type', 'invoice_no', 'date'] as $key) {
        if ($visible[$key]) $lead_cols++;
    }

    if (! function_exists('_pser_print_money')) {
        function _pser_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
    if (! function_exists('_pser_print_qty')) {
        function _pser_print_qty($value, $unit, $precision, $decimal_separator, $thousand_separator) {
            return trim(number_format((float) $value, $precision, $decimal_separator, $thousand_separator).' '.$unit);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($report_title, false); ?></title>
    <?php echo $__env->make('report.partials.crystal_report_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <style>
        <?php if($is_pdf): ?>
        html, body { background: #fff !important; }
        .cr-stage { margin-top: 0; padding: 0; }
        .cr-sheet { box-shadow: none; }
        <?php endif; ?>

        .pser-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 5.2pt;
        }
        .pser-print th,
        .pser-print td {
            border: 1px solid #d2d2d2;
            padding: 2px;
            line-height: 1.08;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .pser-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 4.8pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .pser-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .pser-print tfoot td {
            background: #e8e8e8 !important;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .pser-print .text-right { text-align: right; }
        .pser-print .product-cell { font-weight: 700; }
        .pser-print .amount-cell {
            background: #f7fbff !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage pser-print" id="crStage">
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
            <?php echo $__env->make('report.partials.product_serial_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <?php if($visible['sku']): ?><th><?php echo e(__('product.sku'), false); ?></th><?php endif; ?>
                            <?php if($visible['product']): ?><th><?php echo e(__('sale.product'), false); ?></th><?php endif; ?>
                            <?php if($visible['brand_name']): ?><th><?php echo e(__('brand.brand_name'), false); ?></th><?php endif; ?>
                            <?php if($visible['contact_id']): ?><th><?php echo e(__('contact.contact_id'), false); ?></th><?php endif; ?>
                            <?php if($visible['contact']): ?><th><?php echo e(__('contact.contact'), false); ?></th><?php endif; ?>
                            <?php if($visible['supplier_name']): ?><th><?php echo e(__('lang_v1.supplier_name'), false); ?></th><?php endif; ?>
                            <?php if($visible['type']): ?><th><?php echo e(__('lang_v1.type'), false); ?></th><?php endif; ?>
                            <?php if($visible['invoice_no']): ?><th><?php echo e(__('sale.invoice_no'), false); ?></th><?php endif; ?>
                            <?php if($visible['date']): ?><th><?php echo e(__('messages.date'), false); ?></th><?php endif; ?>
                            <?php if($visible['qty']): ?><th class="text-right"><?php echo e(__('sale.qty'), false); ?></th><?php endif; ?>
                            <?php if($visible['scheme_qty']): ?><th class="text-right"><?php echo e(__('sale.scheme_qty'), false); ?></th><?php endif; ?>
                            <?php if($visible['sr_imei_no']): ?><th><?php echo e(__('product.sr_imei_no'), false); ?></th><?php endif; ?>
                            <?php if($visible['unit_price']): ?><th class="text-right"><?php echo e(__('sale.unit_price'), false); ?></th><?php endif; ?>
                            <?php if($visible['subtotal']): ?><th class="text-right"><?php echo e(__('sale.subtotal'), false); ?></th><?php endif; ?>
                            <?php if($visible['discount']): ?><th class="text-right"><?php echo e(__('sale.discount'), false); ?></th><?php endif; ?>
                            <?php if($visible['discount_pct']): ?><th class="text-right"><?php echo e(__('sale.discount'), false); ?> %</th><?php endif; ?>
                            <?php if($visible['tax']): ?><th class="text-right"><?php echo e(__('sale.tax'), false); ?></th><?php endif; ?>
                            <?php if($visible['price_inc_tax']): ?><th class="text-right"><?php echo e(__('sale.price_inc_tax'), false); ?></th><?php endif; ?>
                            <?php if($visible['total']): ?><th class="text-right"><?php echo e(__('sale.total'), false); ?></th><?php endif; ?>
                            <?php if($visible['days']): ?><th class="text-right"><?php echo e(__('lang_v1.days'), false); ?></th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($visible['sku']): ?><td><?php echo e($row['sub_sku'], false); ?></td><?php endif; ?>
                                <?php if($visible['product']): ?><td class="product-cell"><?php echo e($row['product_name'], false); ?></td><?php endif; ?>
                                <?php if($visible['brand_name']): ?><td><?php echo e($row['brand_name'], false); ?></td><?php endif; ?>
                                <?php if($visible['contact_id']): ?><td><?php echo e($row['contact_id'], false); ?></td><?php endif; ?>
                                <?php if($visible['contact']): ?><td><?php echo e($row['contact'], false); ?></td><?php endif; ?>
                                <?php if($visible['supplier_name']): ?><td><?php echo e($row['supplier'], false); ?></td><?php endif; ?>
                                <?php if($visible['type']): ?><td><?php echo e($row['type'], false); ?></td><?php endif; ?>
                                <?php if($visible['invoice_no']): ?><td><?php echo e($row['invoice_no'], false); ?></td><?php endif; ?>
                                <?php if($visible['date']): ?><td><?php echo e($row['transaction_date'], false); ?></td><?php endif; ?>
                                <?php if($visible['qty']): ?><td class="text-right"><?php echo e(_pser_print_qty($row['sell_qty'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['scheme_qty']): ?><td class="text-right"><?php echo e(_pser_print_qty($row['foc_qty'], $row['unit'], $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['sr_imei_no']): ?><td><?php echo e($row['serial_number'], false); ?></td><?php endif; ?>
                                <?php if($visible['unit_price']): ?><td class="text-right"><?php echo e($hide_values ? '' : _pser_print_money($row['unit_price'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['subtotal']): ?><td class="text-right amount-cell"><?php echo e($hide_values ? '' : _pser_print_money($row['subtotal_before_discount'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['discount']): ?><td class="text-right"><?php echo e($hide_values ? '' : _pser_print_money($row['discount_amount'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['discount_pct']): ?><td class="text-right"><?php echo e($row['discount_percent'], false); ?></td><?php endif; ?>
                                <?php if($visible['tax']): ?><td class="text-right"><?php echo e($hide_values ? '' : _pser_print_money($row['item_tax'], $decimal_separator, $thousand_separator), false); ?> <?php if(!$hide_values && !empty($row['tax'])): ?><br><small>(<?php echo e($row['tax'], false); ?>)</small><?php endif; ?></td><?php endif; ?>
                                <?php if($visible['price_inc_tax']): ?><td class="text-right"><?php echo e($hide_values ? '' : _pser_print_money($row['unit_sale_price'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['total']): ?><td class="text-right amount-cell"><?php echo e($hide_values ? '' : _pser_print_money($row['subtotal'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['days']): ?><td class="text-right"><?php echo e($row['days'], false); ?></td><?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <?php if($page_index === $total_pages - 1): ?>
                        <tfoot>
                            <tr>
                                <?php if($lead_cols > 0): ?><td colspan="<?php echo e($lead_cols, false); ?>" class="text-right"><?php echo e(__('sale.total'), false); ?>:</td><?php endif; ?>
                                <?php if($visible['qty']): ?><td class="text-right"><?php echo e(_pser_print_qty($totals['sell_qty'], '', $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['scheme_qty']): ?><td class="text-right"><?php echo e(_pser_print_qty($totals['foc_qty'], '', $qty_precision, $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['sr_imei_no']): ?><td></td><?php endif; ?>
                                <?php if($visible['unit_price']): ?><td></td><?php endif; ?>
                                <?php if($visible['subtotal']): ?><td class="text-right"><?php echo e($hide_values ? '' : _pser_print_money($totals['subtotal_before_discount'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['discount']): ?><td class="text-right"><?php echo e($hide_values ? '' : _pser_print_money($totals['discount_amount'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['discount_pct']): ?><td></td><?php endif; ?>
                                <?php if($visible['tax']): ?><td class="text-right"><?php echo e($hide_values ? '' : _pser_print_money($totals['item_tax'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['price_inc_tax']): ?><td></td><?php endif; ?>
                                <?php if($visible['total']): ?><td class="text-right"><?php echo e($hide_values ? '' : _pser_print_money($totals['subtotal'], $decimal_separator, $thousand_separator), false); ?></td><?php endif; ?>
                                <?php if($visible['days']): ?><td></td><?php endif; ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> - <?php echo e(__('lang_v1.product_serial_report'), false); ?></span>
                <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
