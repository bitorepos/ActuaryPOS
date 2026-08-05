<?php
    $dec = session('business.currency_precision', 2);
    $symbol = session('currency')['symbol'] ?? '';

    if (! function_exists('_crn')) {
        function _crn($v, $d = 2) { return number_format((float) $v, $d, '.', ','); }
    }

    $hide_prices = ! empty($hide_prices);
    $show_unit_prices = ! $hide_prices;
    $show_total_selling_value = ! empty($show_stock_report_sale_value);
    $show_total_cost_value = ! empty($show_stock_report_cost_value);
    $show_potential_profit = ! empty($show_stock_report_potential_profit);
    $show_variation_column = $show_variation_column ?? true;

    // Leading (text) columns before the Qty column.
    $leading_cols = $show_variation_column ? 7 : 6;

    $categories = $categorized ?? [];
    $cat_count = count($categories);
    // One sheet per category + 1 executive-summary sheet (when data exists).
    $total_pages = $cat_count > 0 ? $cat_count + 1 : 1;

    // Landscape A4 dimensions.
    $sheet_width = '297mm';
    $sheet_min_height = '210mm';
    $page_size = '297mm 210mm';

    $report_title = 'Stock Report — Categorized';

    // Pre-compute per-category totals for the summary sheet.
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
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($report_title, false); ?></title>
    <?php echo $__env->make('report.partials.crystal_report_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>
<body>
<?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="cr-stage" id="crStage">
    <?php $page_no = 0; ?>

    <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_name => $sub_cats): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php $page_no++; ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_no, false); ?>">
            <div class="cr-head">
                <div class="cr-head-left">
                    <?php if(! empty($logo)): ?>
                        <img src="<?php echo e($logo, false); ?>" class="cr-logo" alt="logo">
                    <?php endif; ?>
                    <div>
                        <div class="cr-biz-name"><?php echo e($business_name, false); ?></div>
                        <div class="cr-biz-loc"><?php echo e($location_name, false); ?></div>
                    </div>
                </div>
                <div class="cr-head-right">
                    <div class="cr-report-title">Stock Report</div>
                    <div class="cr-report-sub">Categorized &middot; Generated: <?php echo e($generated_at, false); ?></div>
                </div>
            </div>

            <?php if(! empty($filters_summary)): ?>
                <div class="cr-filters">
                    <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            if (is_array($value)) {
                                $label = $value['label'] ?? $label;
                                $value = $value['value'] ?? '';
                            }
                        ?>
                        <span class="f-item"><b><?php echo e($label, false); ?>:</b> <?php echo e($value, false); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <div class="cr-group-title"><?php echo e($cat_name, false); ?></div>

            <?php $__currentLoopData = $sub_cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_cat_name => $sc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="cr-subgroup-title"><?php echo e($sub_cat_name, false); ?></div>
                <table class="cr-table">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Product</th>
                            <?php if($show_variation_column): ?>
                            <th>Variation</th>
                            <?php endif; ?>
                            <th>Rack</th>
                            <th>Brand</th>
                            <th>Location</th>
                            <th>Unit</th>
                            <th class="r">Qty</th>
                            <?php if($show_unit_prices): ?><th class="r">Unit Sell</th><?php endif; ?>
                            <?php if($show_total_selling_value): ?><th class="r">Total Sell</th><?php endif; ?>
                            <?php if($show_unit_prices): ?><th class="r">Unit Cost</th><?php endif; ?>
                            <?php if($show_total_cost_value): ?><th class="r">Total Cost</th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sc['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($p['sku'], false); ?></td>
                                <td class="cr-prod-name"><?php echo e($p['product_name'], false); ?></td>
                                <?php if($show_variation_column): ?>
                                <td><?php echo e($p['variation'], false); ?></td>
                                <?php endif; ?>
                                <td><?php echo e($p['rack_details'], false); ?></td>
                                <td><?php echo e($p['brand_name'], false); ?></td>
                                <td><?php echo e($p['location_name'], false); ?></td>
                                <td><?php echo e($p['unit'], false); ?></td>
                                <td class="r"><?php echo e(_crn($p['qty'], 2), false); ?></td>
                                <?php if($show_unit_prices): ?><td class="r"><?php echo e(_crn($p['unit_selling_price'], $dec), false); ?></td><?php endif; ?>
                                <?php if($show_total_selling_value): ?><td class="r"><?php echo e(_crn($p['total_selling_value'], $dec), false); ?></td><?php endif; ?>
                                <?php if($show_unit_prices): ?><td class="r"><?php echo e(_crn($p['unit_purchase_price'], $dec), false); ?></td><?php endif; ?>
                                <?php if($show_total_cost_value): ?><td class="r"><?php echo e(_crn($p['total_cost_value'], $dec), false); ?></td><?php endif; ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="<?php echo e($leading_cols, false); ?>" class="r">Subtotal &mdash; <?php echo e($sub_cat_name, false); ?></td>
                            <td class="r"><?php echo e(_crn($sc['total_qty'], 2), false); ?></td>
                            <?php if($show_unit_prices): ?><td></td><?php endif; ?>
                            <?php if($show_total_selling_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crn($sc['total_selling_value'], $dec), false); ?></td><?php endif; ?>
                            <?php if($show_unit_prices): ?><td></td><?php endif; ?>
                            <?php if($show_total_cost_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crn($sc['total_cost_value'], $dec), false); ?></td><?php endif; ?>
                        </tr>
                    </tfoot>
                </table>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <table class="cr-table" style="margin-top:6px;">
                <tfoot>
                    <tr>
                        <td colspan="<?php echo e($leading_cols, false); ?>" class="r">Category Total &mdash; <?php echo e($cat_name, false); ?></td>
                        <td class="r"><?php echo e(_crn($cat_totals[$cat_name]['qty'], 2), false); ?></td>
                        <?php if($show_unit_prices): ?><td></td><?php endif; ?>
                        <?php if($show_total_selling_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crn($cat_totals[$cat_name]['sell'], $dec), false); ?></td><?php endif; ?>
                        <?php if($show_unit_prices): ?><td></td><?php endif; ?>
                        <?php if($show_total_cost_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crn($cat_totals[$cat_name]['cost'], $dec), false); ?></td><?php endif; ?>
                    </tr>
                </tfoot>
            </table>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> &mdash; Stock Report (Categorized)</span>
                <span>Page <?php echo e($page_no, false); ?> of <?php echo e($total_pages, false); ?></span>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="cr-sheet" id="crPage1">
            <div class="cr-head">
                <div class="cr-head-left">
                    <?php if(! empty($logo)): ?><img src="<?php echo e($logo, false); ?>" class="cr-logo" alt="logo"><?php endif; ?>
                    <div>
                        <div class="cr-biz-name"><?php echo e($business_name, false); ?></div>
                        <div class="cr-biz-loc"><?php echo e($location_name, false); ?></div>
                    </div>
                </div>
                <div class="cr-head-right">
                    <div class="cr-report-title">Stock Report</div>
                    <div class="cr-report-sub">Categorized &middot; Generated: <?php echo e($generated_at, false); ?></div>
                </div>
            </div>
            <div class="cr-empty">No stock records found for the selected filters.</div>
        </div>
    <?php endif; ?>

    <?php if($cat_count > 0): ?>
        <?php $page_no++; ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_no, false); ?>">
            <div class="cr-head">
                <div class="cr-head-left">
                    <?php if(! empty($logo)): ?><img src="<?php echo e($logo, false); ?>" class="cr-logo" alt="logo"><?php endif; ?>
                    <div>
                        <div class="cr-biz-name"><?php echo e($business_name, false); ?></div>
                        <div class="cr-biz-loc"><?php echo e($location_name, false); ?></div>
                    </div>
                </div>
                <div class="cr-head-right">
                    <div class="cr-report-title">Summary</div>
                    <div class="cr-report-sub">Categorized &middot; Generated: <?php echo e($generated_at, false); ?></div>
                </div>
            </div>

            <div class="cr-group-title">Category-wise Summary</div>
            <table class="cr-table">
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
                        <tr>
                            <td class="cr-prod-name"><?php echo e($cat_name, false); ?></td>
                            <td class="r"><?php echo e(_crn($t['qty'], 2), false); ?></td>
                            <?php if($show_total_selling_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crn($t['sell'], $dec), false); ?></td><?php endif; ?>
                            <?php if($show_total_cost_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crn($t['cost'], $dec), false); ?></td><?php endif; ?>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td class="r">Grand Total</td>
                        <td class="r"><?php echo e(_crn($grand_total_qty, 2), false); ?></td>
                        <?php if($show_total_selling_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crn($grand_total_selling, $dec), false); ?></td><?php endif; ?>
                        <?php if($show_total_cost_value): ?><td class="r"><?php echo e($symbol, false); ?> <?php echo e(_crn($grand_total_cost, $dec), false); ?></td><?php endif; ?>
                    </tr>
                </tfoot>
            </table>

            <?php if($show_total_selling_value || $show_total_cost_value || $show_potential_profit): ?>
                <div class="cr-grand">
                    <h3>Grand Totals</h3>
                    <div class="cr-grand-row"><span>Total Quantity</span><b><?php echo e(_crn($grand_total_qty, 2), false); ?></b></div>
                    <?php if($show_total_selling_value): ?><div class="cr-grand-row"><span>Total Selling Value</span><b><?php echo e($symbol, false); ?> <?php echo e(_crn($grand_total_selling, $dec), false); ?></b></div><?php endif; ?>
                    <?php if($show_total_cost_value): ?><div class="cr-grand-row"><span>Total Cost Value</span><b><?php echo e($symbol, false); ?> <?php echo e(_crn($grand_total_cost, $dec), false); ?></b></div><?php endif; ?>
                    <?php if($show_potential_profit): ?><div class="cr-grand-row"><span>Potential Profit</span><b><?php echo e($symbol, false); ?> <?php echo e(_crn($grand_total_selling - $grand_total_cost, $dec), false); ?></b></div><?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> &mdash; Stock Report (Categorized)</span>
                <span>Page <?php echo e($page_no, false); ?> of <?php echo e($total_pages, false); ?></span>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
