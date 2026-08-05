<?php
    $qp = session('business.quantity_precision', 2);
    $dec = session('currency')['decimal_separator'];
    $thou = session('currency')['thousand_separator'];
    $cp = session('business.currency_precision', 2);
    if (!function_exists('_qp')) { function _qp($v, $qp, $dec, $thou) { return number_format((float) $v, $qp, $dec, $thou); } }
    if (!function_exists('_cp')) { function _cp($v, $cp, $dec, $thou) { return number_format((float) $v, $cp, $dec, $thou); } }
    $show_variation_column = $show_variation_column ?? true;
    $show_stock_report_cost_value = ! empty($show_stock_report_cost_value);
    $show_stock_report_sale_value = ! empty($show_stock_report_sale_value);
    $show_stock_report_potential_profit = ! empty($show_stock_report_potential_profit);
    $leading_cols = 5 + ($show_variation_column ? 1 : 0) + ($hide_prices ? 0 : 2);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * { font-family: DejaVu Sans, sans-serif; }
        body { font-size: 8pt; color: #1a1a1a; }
        .head { width: 100%; border-bottom: 2px solid #000; padding-bottom: 6px; margin-bottom: 6px; }
        .head td { vertical-align: top; }
        .logo { max-height: 50px; max-width: 130px; }
        .biz-name { font-size: 15pt; font-weight: bold; }
        .biz-loc { font-size: 8pt; color: #444; }
        .title { font-size: 13pt; font-weight: bold; text-transform: uppercase; text-align: right; }
        .sub { font-size: 7.5pt; color: #444; text-align: right; }
        .filters { font-size: 7.5pt; margin-bottom: 6px; color: #333; }
        .filters b { color: #000; }
        table.data { width: 100%; border-collapse: collapse; table-layout: fixed; }
        table.data th {
            background: #1a1a1a; color: #fff; font-size: 5.8pt; text-transform: uppercase;
            padding: 3px 3px; border: 1px solid #1a1a1a; text-align: left;
            line-height: 1.15; white-space: normal; word-break: break-word;
        }
        table.data th.r { text-align: right; }
        table.data th.c { text-align: center; }
        table.data td { padding: 3px 3px; border: 1px solid #ccc; font-size: 6.4pt; line-height: 1.18; word-break: break-word; }
        table.data td.r { text-align: right; white-space: normal; }
        table.data td.c { text-align: center; }
        table.data tr:nth-child(even) td { background: #f4f4f4; }
        tfoot td { background: #e8e8e8; font-weight: bold; border-top: 2px solid #000; }
        .sub2 { color: #666; font-size: 6pt; }
    </style>
</head>
<body>
    <table class="head">
        <tr>
            <td>
                <?php if($logo): ?>
                    <img src="<?php echo e($logo, false); ?>" class="logo"><br>
                <?php endif; ?>
                <span class="biz-name"><?php echo e($business_name, false); ?></span><br>
                <span class="biz-loc"><?php echo e($location_name, false); ?></span>
            </td>
            <td>
                <div class="title"><?php echo e(__('report.stock_report'), false); ?></div>
                <div class="sub"><?php echo e(__('lang_v1.generated_on') ?? 'Generated', false); ?>: <?php echo e($generated_at, false); ?></div>
            </td>
        </tr>
    </table>

    <?php if(!empty($filters_summary)): ?>
    <div class="filters">
        <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <b><?php echo e($label, false); ?>:</b> <?php echo e($value, false); ?> &nbsp;&nbsp;
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <table class="data">
        <colgroup>
            <col style="width: 3%;">
            <col style="width: 7%;">
            <col style="width: 10%;">
            <?php if($show_variation_column): ?>
            <col style="width: 6%;">
            <?php endif; ?>
            <col style="width: 7%;">
            <col style="width: 8%;">
            <?php if(!$hide_prices): ?>
                <col style="width: 6%;">
                <col style="width: 6%;">
            <?php endif; ?>
            <col style="width: 8%;">
            <?php if($show_stock_report_cost_value): ?>
                <col style="width: 9%;">
            <?php endif; ?>
            <?php if($show_stock_report_sale_value): ?>
                <col style="width: 9%;">
            <?php endif; ?>
            <?php if($show_stock_report_potential_profit): ?>
                <col style="width: 7%;">
            <?php endif; ?>
            <col style="width: 7%;">
            <?php if($show_manufacturing_data): ?>
                <col style="width: 7%;">
            <?php endif; ?>
        </colgroup>
        <thead>
            <tr>
                <th class="c">#</th>
                <th>SKU</th>
                <th><?php echo e(__('business.product'), false); ?></th>
                <?php if($show_variation_column): ?>
                <th><?php echo e(__('lang_v1.variation'), false); ?></th>
                <?php endif; ?>
                <th><?php echo e(__('product.category'), false); ?></th>
                <th><?php echo e(__('sale.location'), false); ?></th>
                <?php if(!$hide_prices): ?>
                <th class="r"><?php echo e(__('purchase.unit_cost_price'), false); ?></th>
                <th class="r"><?php echo e(__('purchase.unit_selling_price'), false); ?></th>
                <?php endif; ?>
                <th class="r"><?php echo e(__('report.current_stock'), false); ?></th>
                <?php if($show_stock_report_cost_value): ?>
                <th class="r"><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e(__('lang_v1.by_purchase_price'), false); ?>)</th>
                <?php endif; ?>
                <?php if($show_stock_report_sale_value): ?>
                <th class="r"><?php echo e(__('lang_v1.total_stock_price'), false); ?> (<?php echo e(__('lang_v1.by_sale_price'), false); ?>)</th>
                <?php endif; ?>
                <?php if($show_stock_report_potential_profit): ?>
                <th class="r"><?php echo e(__('lang_v1.potential_profit'), false); ?></th>
                <?php endif; ?>
                <th class="r"><?php echo e(__('report.total_unit_sold'), false); ?></th>
                <?php if($show_manufacturing_data): ?>
                <th class="r"><?php echo e(__('manufacturing::lang.current_stock_mfg'), false); ?></th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; ?>
            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $i++; ?>
            <tr>
                <td class="c"><?php echo e($i, false); ?></td>
                <td><?php echo e($r['sku'], false); ?></td>
                <td><?php echo e($r['product'], false); ?><?php if(!empty($r['other_name'])): ?><br><span class="sub2"><?php echo e($r['other_name'], false); ?></span><?php endif; ?></td>
                <?php if($show_variation_column): ?>
                <td><?php echo e($r['variation'], false); ?></td>
                <?php endif; ?>
                <td><?php echo e($r['category'], false); ?></td>
                <td><?php echo e($r['location'], false); ?></td>
                <?php if(!$hide_prices): ?>
                <td class="r"><?php echo e(_cp($r['cost_price'], $cp, $dec, $thou), false); ?></td>
                <td class="r"><?php echo e(_cp($r['unit_price'], $cp, $dec, $thou), false); ?></td>
                <?php endif; ?>
                <td class="r"><?php if($r['enable_stock']): ?><?php echo e(_qp($r['stock'], $qp, $dec, $thou), false); ?> <?php echo e($r['unit'], false); ?><?php else: ?>--<?php endif; ?></td>
                <?php if($show_stock_report_cost_value): ?>
                <td class="r"><?php echo e(_cp($r['stock_value_cost'], $cp, $dec, $thou), false); ?></td>
                <?php endif; ?>
                <?php if($show_stock_report_sale_value): ?>
                <td class="r"><?php echo e(_cp($r['stock_value_sale'], $cp, $dec, $thou), false); ?></td>
                <?php endif; ?>
                <?php if($show_stock_report_potential_profit): ?>
                <td class="r"><?php echo e(_cp($r['potential_profit'], $cp, $dec, $thou), false); ?></td>
                <?php endif; ?>
                <td class="r"><?php echo e(_qp($r['total_sold'], $qp, $dec, $thou), false); ?> <?php echo e($r['unit'], false); ?></td>
                <?php if($show_manufacturing_data): ?>
                <td class="r"><?php echo e(_qp($r['total_mfg_stock'], $qp, $dec, $thou), false); ?> <?php echo e($r['unit'], false); ?></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php if(empty($rows)): ?>
            <tr><td colspan="14" class="c"><?php echo e(__('lang_v1.no_records_found') ?? 'No records found', false); ?></td></tr>
            <?php endif; ?>
        </tbody>
        <?php if(!empty($rows)): ?>
        <tfoot>
            <tr>
                <td colspan="<?php echo e($leading_cols, false); ?>" class="r"><?php echo e(__('sale.total'), false); ?>:</td>
                <td class="r"><?php echo e(_qp($totals['stock'], $qp, $dec, $thou), false); ?></td>
                <?php if($show_stock_report_cost_value): ?>
                <td class="r"><?php echo e(_cp($totals['stock_value_cost'], $cp, $dec, $thou), false); ?></td>
                <?php endif; ?>
                <?php if($show_stock_report_sale_value): ?>
                <td class="r"><?php echo e(_cp($totals['stock_value_sale'], $cp, $dec, $thou), false); ?></td>
                <?php endif; ?>
                <?php if($show_stock_report_potential_profit): ?>
                <td class="r"><?php echo e(_cp($totals['potential_profit'], $cp, $dec, $thou), false); ?></td>
                <?php endif; ?>
                <td class="r"><?php echo e(_qp($totals['total_sold'], $qp, $dec, $thou), false); ?></td>
                <?php if($show_manufacturing_data): ?>
                <td class="r"><?php echo e(_qp($totals['total_mfg_stock'], $qp, $dec, $thou), false); ?></td>
                <?php endif; ?>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>
</body>
</html>
