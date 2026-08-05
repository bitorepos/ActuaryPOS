<?php
    $locations = $locations ?? [];
    $show_stock_report_cost_value = ! empty($show_stock_report_cost_value);
    $show_stock_report_sale_value = ! empty($show_stock_report_sale_value);
    $show_stock_report_potential_profit = ! empty($show_stock_report_potential_profit);
    $show_value_columns = $show_stock_report_cost_value || $show_stock_report_sale_value || $show_stock_report_potential_profit;
    $symbol = $currency_symbol ?? (session('currency')['symbol'] ?? '');
    $qty_precision = session('business.quantity_precision', 2);
    $value_precision = session('business.cost_decimal', session('business.currency_precision', 2));
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_srl_pdf_qty')) {
        function _srl_pdf_qty($value, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
        }
    }

    if (! function_exists('_srl_pdf_value')) {
        function _srl_pdf_value($value, $precision, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, $precision, $decimal_separator, $thousand_separator);
        }
    }

    $total_columns = 4
        + ($show_stock_report_cost_value ? 1 : 0)
        + ($show_stock_report_sale_value ? 1 : 0)
        + ($show_stock_report_potential_profit ? 1 : 0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        body { margin: 0; color: #1a1a1a; font-size: 8px; }
        .head { width: 100%; border-bottom: 2px solid #1a1a1a; padding-bottom: 6px; margin-bottom: 6px; }
        .head td { vertical-align: top; }
        .logo { max-height: 48px; max-width: 130px; }
        .biz-name { font-size: 15px; font-weight: bold; }
        .biz-loc { font-size: 9px; color: #444; }
        .rtitle { font-size: 13px; font-weight: bold; text-transform: uppercase; text-align: right; }
        .rsub { font-size: 8px; color: #444; text-align: right; }
        .filters { font-size: 8px; color: #333; margin-bottom: 6px; }
        .filters b { color: #000; }
        .group-title { font-size: 10px; font-weight: bold; background: #1a1a1a; color: #fff; padding: 4px 6px; margin: 8px 0 0; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data th { background: #1a1a1a; color: #fff; font-size: 7px; padding: 3px 4px; border: 1px solid #1a1a1a; text-align: left; }
        table.data th.r { text-align: right; }
        table.data td { padding: 3px 4px; border: 1px solid #cfcfcf; font-size: 7.5px; vertical-align: top; }
        table.data td.r { text-align: right; }
        table.data tr.even td { background: #f3f3f3; }
        table.data tfoot td { font-weight: bold; background: #e8e8e8; border-top: 1.5px solid #1a1a1a; }
        .qty-chip { display: inline-block; margin: 1px 4px 1px 0; white-space: nowrap; }
        .foot { margin-top: 8px; border-top: 1px solid #ccc; padding-top: 4px; font-size: 7px; color: #555; }
    </style>
</head>
<body>
    <table class="head" width="100%">
        <tr>
            <td>
                <?php if(! empty($logo)): ?><img src="<?php echo e($logo, false); ?>" class="logo"><br><?php endif; ?>
                <span class="biz-name"><?php echo e($business_name, false); ?></span><br>
                <span class="biz-loc"><?php echo e($location_name, false); ?></span>
            </td>
            <td>
                <div class="rtitle">Stock Report</div>
                <div class="rsub">Locations - Generated: <?php echo e($generated_at, false); ?></div>
            </td>
        </tr>
    </table>

    <?php if(! empty($filters_summary)): ?>
        <div class="filters">
            <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    if (is_array($value)) {
                        $label = $value['label'] ?? $label;
                        $value = $value['value'] ?? '';
                    }
                ?>
                <b><?php echo e($label, false); ?>:</b> <?php echo e($value, false); ?> &nbsp;
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="group-title">Location-wise Stock Summary</div>

    <table class="data">
        <thead>
            <tr>
                <th><?php echo e(__('sale.location'), false); ?></th>
                <th class="r"><?php echo e(__('product.products'), false); ?></th>
                <th class="r"><?php echo e(__('product.variations'), false); ?></th>
                <th>Quantity Summary</th>
                <?php if($show_stock_report_cost_value): ?>
                    <th class="r"><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e(__('lang_v1.by_purchase_price'), false); ?>)</th>
                <?php endif; ?>
                <?php if($show_stock_report_sale_value): ?>
                    <th class="r"><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e(__('lang_v1.by_sale_price'), false); ?>)</th>
                <?php endif; ?>
                <?php if($show_stock_report_potential_profit): ?>
                    <th class="r"><?php echo e(__('lang_v1.potential_profit'), false); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="<?php echo e($loop->even ? 'even' : '', false); ?>">
                    <td><?php echo e($location['location_name'], false); ?></td>
                    <td class="r"><?php echo e($location['product_count'], false); ?></td>
                    <td class="r"><?php echo e($location['variation_count'], false); ?></td>
                    <td>
                        <?php $__currentLoopData = $location['unit_quantities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="qty-chip"><?php echo e(_srl_pdf_qty($qty, $qty_precision, $decimal_separator, $thousand_separator), false); ?> <?php echo e($unit, false); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <?php if($show_stock_report_cost_value): ?>
                        <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_pdf_value($location['total_purchase_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                    <?php endif; ?>
                    <?php if($show_stock_report_sale_value): ?>
                        <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_pdf_value($location['total_sale_value'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                    <?php endif; ?>
                    <?php if($show_stock_report_potential_profit): ?>
                        <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_pdf_value($location['potential_profit'], $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="<?php echo e($total_columns, false); ?>" class="r"><?php echo e(__('lang_v1.no_data_available'), false); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
        <?php if(! empty($locations)): ?>
            <tfoot>
                <tr>
                    <td><?php echo e(__('lang_v1.grand_total'), false); ?>:</td>
                    <td class="r"><?php echo e($grand_product_count, false); ?></td>
                    <td class="r"><?php echo e($grand_variation_count, false); ?></td>
                    <td>
                        <?php $__currentLoopData = $grand_unit_quantities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="qty-chip"><?php echo e(_srl_pdf_qty($qty, $qty_precision, $decimal_separator, $thousand_separator), false); ?> <?php echo e($unit, false); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <?php if($show_stock_report_cost_value): ?>
                        <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_pdf_value($grand_total_purchase_value, $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                    <?php endif; ?>
                    <?php if($show_stock_report_sale_value): ?>
                        <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_pdf_value($grand_total_sale_value, $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                    <?php endif; ?>
                    <?php if($show_stock_report_potential_profit): ?>
                        <td class="r"><?php echo e($symbol, false); ?> <?php echo e(_srl_pdf_value($grand_potential_profit, $value_precision, $decimal_separator, $thousand_separator), false); ?></td>
                    <?php endif; ?>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>

    <div class="foot"><?php echo e($business_name, false); ?> - Stock Report (Locations) - Generated <?php echo e($generated_at, false); ?></div>
</body>
</html>
