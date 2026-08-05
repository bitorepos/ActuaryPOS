<?php
    $dec = session('business.currency_precision', 2);
    $symbol = session('currency')['symbol'] ?? '';

    if (! function_exists('_crnp')) {
        function _crnp($v, $d = 2) { return number_format((float) $v, $d, '.', ','); }
    }

    $hide_prices = ! empty($hide_prices);
    $show_unit_prices = ! $hide_prices;
    $show_total_selling_value = ! empty($show_stock_report_sale_value);
    $show_total_cost_value = ! empty($show_stock_report_cost_value);
    $show_potential_profit = ! empty($show_stock_report_potential_profit);
    $show_variation_column = $show_variation_column ?? true;
    $leading_cols = $show_variation_column ? 7 : 6;

    $categories = $categorized ?? [];

    $cat_totals = [];
    foreach ($categories as $cat_name => $sub_cats) {
        $ct_qty = 0; $ct_sell = 0; $ct_cost = 0;
        foreach ($sub_cats as $sc) {
            $ct_qty  += $sc['total_qty'];
            $ct_sell += $sc['total_selling_value'];
            $ct_cost += $sc['total_cost_value'];
        }
        $cat_totals[$cat_name] = ['qty' => $ct_qty, 'sell' => $ct_sell, 'cost' => $ct_cost];
    }
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
        .subgroup-title { font-size: 9px; font-weight: bold; color: #333; padding: 5px 2px 2px; }
        table.data { width: 100%; border-collapse: collapse; }
        table.data th { background: #1a1a1a; color: #fff; font-size: 7px; padding: 3px 4px; border: 1px solid #1a1a1a; text-align: left; }
        table.data th.r { text-align: right; }
        table.data td { padding: 3px 4px; border: 1px solid #cfcfcf; font-size: 7.5px; }
        table.data td.r { text-align: right; }
        table.data tr.even td { background: #f3f3f3; }
        table.data tfoot td { font-weight: bold; background: #e8e8e8; border-top: 1.5px solid #1a1a1a; }
        .grand { border: 1.5px solid #1a1a1a; padding: 6px 8px; margin-top: 8px; background: #f4f8ff; }
        .grand h3 { font-size: 10px; margin: 0 0 4px; }
        .grand-row td { padding: 2px 0; font-size: 9px; }
        .page-break { page-break-after: always; }
        .foot { margin-top: 8px; border-top: 1px solid #ccc; padding-top: 4px; font-size: 7px; color: #555; }
    </style>
</head>
<body>
    <?php $cat_index = 0; $cat_count = count($categories); ?>
    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_name => $sub_cats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $cat_index++; ?>
        <table class="head" width="100%">
            <tr>
                <td>
                    <?php if(! empty($logo)): ?><img src="<?php echo e($logo, false); ?>" class="logo"><br><?php endif; ?>
                    <span class="biz-name"><?php echo e($business_name, false); ?></span><br>
                    <span class="biz-loc"><?php echo e($location_name, false); ?></span>
                </td>
                <td>
                    <div class="rtitle">Stock Report</div>
                    <div class="rsub">Categorized &middot; Generated: <?php echo e($generated_at, false); ?></div>
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

        <div class="group-title"><?php echo e($cat_name, false); ?></div>

        <?php $__currentLoopData = $sub_cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_cat_name => $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="subgroup-title"><?php echo e($sub_cat_name, false); ?></div>
            <table class="data">
                <thead>
                    <tr>
                        <th>SKU</th><th>Product</th><?php if($show_variation_column): ?><th>Variation</th><?php endif; ?><th>Rack</th><th>Brand</th><th>Location</th><th>Unit</th>
                        <th class="r">Qty</th>
                        <?php if($show_unit_prices): ?><th class="r">Unit Sell</th><?php endif; ?>
                        <?php if($show_total_selling_value): ?><th class="r">Total Sell</th><?php endif; ?>
                        <?php if($show_unit_prices): ?><th class="r">Unit Cost</th><?php endif; ?>
                        <?php if($show_total_cost_value): ?><th class="r">Total Cost</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $sc['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e($i % 2 ? 'even' : '', false); ?>">
                            <td><?php echo e($p['sku'], false); ?></td>
                            <td><?php echo e($p['product_name'], false); ?></td>
                            <?php if($show_variation_column): ?>
                            <td><?php echo e($p['variation'], false); ?></td>
                            <?php endif; ?>
                            <td><?php echo e($p['rack_details'], false); ?></td>
                            <td><?php echo e($p['brand_name'], false); ?></td>
                            <td><?php echo e($p['location_name'], false); ?></td>
                            <td><?php echo e($p['unit'], false); ?></td>
                            <td class="r"><?php echo e(_crnp($p['qty'], 2), false); ?></td>
                            <?php if($show_unit_prices): ?><td class="r"><?php echo e(_crnp($p['unit_selling_price'], $dec), false); ?></td><?php endif; ?>
                            <?php if($show_total_selling_value): ?><td class="r"><?php echo e(_crnp($p['total_selling_value'], $dec), false); ?></td><?php endif; ?>
                            <?php if($show_unit_prices): ?><td class="r"><?php echo e(_crnp($p['unit_purchase_price'], $dec), false); ?></td><?php endif; ?>
                            <?php if($show_total_cost_value): ?><td class="r"><?php echo e(_crnp($p['total_cost_value'], $dec), false); ?></td><?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="<?php echo e($leading_cols, false); ?>" class="r">Subtotal &mdash; <?php echo e($sub_cat_name, false); ?></td>
                        <td class="r"><?php echo e(_crnp($sc['total_qty'], 2), false); ?></td>
                        <?php if($show_unit_prices): ?><td></td><?php endif; ?>
                        <?php if($show_total_selling_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crnp($sc['total_selling_value'], $dec), false); ?></td><?php endif; ?>
                        <?php if($show_unit_prices): ?><td></td><?php endif; ?>
                        <?php if($show_total_cost_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crnp($sc['total_cost_value'], $dec), false); ?></td><?php endif; ?>
                    </tr>
                </tfoot>
            </table>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <table class="data" style="margin-top:5px;">
            <tfoot>
                <tr>
                    <td colspan="<?php echo e($leading_cols, false); ?>" class="r">Category Total &mdash; <?php echo e($cat_name, false); ?></td>
                    <td class="r"><?php echo e(_crnp($cat_totals[$cat_name]['qty'], 2), false); ?></td>
                    <?php if($show_unit_prices): ?><td></td><?php endif; ?>
                    <?php if($show_total_selling_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crnp($cat_totals[$cat_name]['sell'], $dec), false); ?></td><?php endif; ?>
                    <?php if($show_unit_prices): ?><td></td><?php endif; ?>
                    <?php if($show_total_cost_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crnp($cat_totals[$cat_name]['cost'], $dec), false); ?></td><?php endif; ?>
                </tr>
            </tfoot>
        </table>

        <div class="page-break"></div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php if($cat_count > 0): ?>
        <table class="head" width="100%">
            <tr>
                <td>
                    <?php if(! empty($logo)): ?><img src="<?php echo e($logo, false); ?>" class="logo"><br><?php endif; ?>
                    <span class="biz-name"><?php echo e($business_name, false); ?></span><br>
                    <span class="biz-loc"><?php echo e($location_name, false); ?></span>
                </td>
                <td>
                    <div class="rtitle">Summary</div>
                    <div class="rsub">Categorized &middot; Generated: <?php echo e($generated_at, false); ?></div>
                </td>
            </tr>
        </table>
        <div class="group-title">Category-wise Summary</div>
        <table class="data">
            <thead>
                <tr>
                    <th>Category</th>
                    <th class="r">Total Qty</th>
                    <?php if($show_total_selling_value): ?><th class="r">Total Selling Value</th><?php endif; ?>
                    <?php if($show_total_cost_value): ?><th class="r">Total Cost Value</th><?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $cat_totals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_name => $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($loop->even ? 'even' : '', false); ?>">
                        <td><?php echo e($cat_name, false); ?></td>
                        <td class="r"><?php echo e(_crnp($t['qty'], 2), false); ?></td>
                        <?php if($show_total_selling_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crnp($t['sell'], $dec), false); ?></td><?php endif; ?>
                        <?php if($show_total_cost_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crnp($t['cost'], $dec), false); ?></td><?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
                <tr>
                    <td class="r">Grand Total</td>
                    <td class="r"><?php echo e(_crnp($grand_total_qty, 2), false); ?></td>
                    <?php if($show_total_selling_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crnp($grand_total_selling, $dec), false); ?></td><?php endif; ?>
                    <?php if($show_total_cost_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crnp($grand_total_cost, $dec), false); ?></td><?php endif; ?>
                </tr>
            </tfoot>
        </table>

        <?php if($show_total_selling_value || $show_total_cost_value || $show_potential_profit): ?>
            <div class="grand">
                <h3>GRAND TOTALS</h3>
                <table width="100%">
                    <tr class="grand-row"><td>Total Quantity</td><td align="right"><b><?php echo e(_crnp($grand_total_qty, 2), false); ?></b></td></tr>
                    <?php if($show_total_selling_value): ?><tr class="grand-row"><td>Total Selling Value</td><td align="right"><b><?php echo e($symbol, false); ?> <?php echo e(_crnp($grand_total_selling, $dec), false); ?></b></td></tr><?php endif; ?>
                    <?php if($show_total_cost_value): ?><tr class="grand-row"><td>Total Cost Value</td><td align="right"><b><?php echo e($symbol, false); ?> <?php echo e(_crnp($grand_total_cost, $dec), false); ?></b></td></tr><?php endif; ?>
                    <?php if($show_potential_profit): ?><tr class="grand-row"><td>Potential Profit</td><td align="right"><b><?php echo e($symbol, false); ?> <?php echo e(_crnp($grand_total_selling - $grand_total_cost, $dec), false); ?></b></td></tr><?php endif; ?>
                </table>
            </div>
        <?php endif; ?>

        <div class="foot"><?php echo e($business_name, false); ?> &mdash; Stock Report (Categorized) &middot; Generated <?php echo e($generated_at, false); ?></div>
    <?php endif; ?>
</body>
</html>
