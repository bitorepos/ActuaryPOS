<?php
    $show_variation_column = $show_variation_column ?? true;
    $show_stock_report_cost_value = ! empty($show_stock_report_cost_value);
    $show_stock_report_sale_value = ! empty($show_stock_report_sale_value);
    $show_stock_report_potential_profit = ! empty($show_stock_report_potential_profit);
    $value_column_count = ($show_stock_report_cost_value ? 1 : 0) + ($show_stock_report_sale_value ? 1 : 0) + ($show_stock_report_potential_profit ? 1 : 0);
    $leading_cols = 5 + ($show_variation_column ? 1 : 0) + ($hide_prices ? 0 : 2); // #, SKU, Product, Category, Location (+ Variation, Unit Cost, Unit Sell)
    $qp = session('business.quantity_precision', 2);
    $dec = session('currency')['decimal_separator'];
    $thou = session('currency')['thousand_separator'];
    $cp = session('business.currency_precision', 2);
    if (!function_exists('_q')) { function _q($v, $qp, $dec, $thou) { return number_format((float) $v, $qp, $dec, $thou); } }
    if (!function_exists('_c')) { function _c($v, $cp, $dec, $thou) { return number_format((float) $v, $cp, $dec, $thou); } }
    $total_pages = count($row_pages);
    $row_counter = 0;
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    // Explicit page dimensions force the orientation in Chrome/Edge even when the
    // print dialog's "Layout" setting is sticky from a previous manual choice.
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(__('report.stock_report'), false); ?> — <?php echo e($business_name, false); ?></title>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body {
            font-family: Arial, Helvetica, sans-serif;
            color: #1a1a1a;
            background: #525659;
        }

        /* ===== Toolbar ===== */
        .cr-toolbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 48px;
            background: #323639;
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 0 14px;
            z-index: 1000;
            box-shadow: 0 1px 6px rgba(0,0,0,.4);
            color: #fff;
            flex-wrap: nowrap;
            overflow-x: auto;
        }
        .cr-toolbar .cr-title {
            font-size: 13px;
            font-weight: 700;
            margin-right: auto;
            white-space: nowrap;
            letter-spacing: .02em;
        }
        .cr-group {
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 0 8px;
            border-left: 1px solid #50545a;
            height: 30px;
        }
        .cr-group:first-of-type { border-left: 0; }
        .cr-btn {
            background: #4a4f54;
            color: #fff;
            border: 0;
            border-radius: 4px;
            padding: 6px 10px;
            font-size: 12px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
            transition: background .15s;
        }
        .cr-btn:hover { background: #5d636a; }
        .cr-btn.primary { background: #1a73e8; }
        .cr-btn.primary:hover { background: #2b7de9; }
        .cr-btn.success { background: #188038; }
        .cr-btn.success:hover { background: #1e9e45; }
        .cr-btn.danger { background: #b3261e; }
        .cr-btn.danger:hover { background: #c5362d; }
        .cr-iconbtn {
            width: 30px;
            height: 30px;
            justify-content: center;
            padding: 0;
            font-size: 15px;
            font-weight: 700;
        }
        .cr-zoom-label, .cr-page-label {
            font-size: 12px;
            min-width: 54px;
            text-align: center;
            font-variant-numeric: tabular-nums;
        }
        .cr-page-input {
            width: 42px;
            text-align: center;
            border: 0;
            border-radius: 3px;
            padding: 4px 2px;
            font-size: 12px;
        }

        /* ===== Stage ===== */
        .cr-stage {
            margin-top: 48px;
            padding: 24px 0 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 22px;
        }

        /* ===== A4 <?php echo e(ucfirst($orientation), false); ?> Sheet ===== */
        .cr-sheet {
            background: #fff;
            width: <?php echo e($sheet_width, false); ?>;
            min-height: <?php echo e($sheet_min_height, false); ?>;
            padding: 12mm 10mm;
            box-shadow: 0 2px 10px rgba(0,0,0,.45);
            position: relative;
            display: flex;
            flex-direction: column;
        }

        /* ===== Brand Header ===== */
        .cr-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2.5px solid #1a1a1a;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }
        .cr-head-left { display: flex; align-items: center; gap: 12px; }
        .cr-logo { max-height: 56px; max-width: 150px; object-fit: contain; }
        .cr-biz-name { font-size: 17pt; font-weight: 800; line-height: 1.1; }
        .cr-biz-loc { font-size: 9.5pt; color: #444; margin-top: 2px; }
        .cr-head-right { text-align: right; }
        .cr-report-title {
            font-size: 15pt;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: .05em;
        }
        .cr-report-sub { font-size: 9pt; color: #444; margin-top: 3px; }

        /* ===== Filters strip ===== */
        .cr-filters {
            font-size: 8.5pt;
            color: #333;
            margin-bottom: 8px;
            display: flex;
            flex-wrap: wrap;
            gap: 4px 16px;
        }
        .cr-filters .f-item b { color: #000; }

        /* ===== Table ===== */
        .cr-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 6.8pt;
        }
        .cr-table thead th {
            background: #1a1a1a;
            color: #fff;
            font-size: 5.8pt;
            font-weight: 700;
            text-transform: uppercase;
            padding: 3px 3px;
            border: 1px solid #1a1a1a;
            text-align: left;
            line-height: 1.15;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cr-table thead th.r { text-align: right; }
        .cr-table thead th.c { text-align: center; }
        .cr-table tbody td {
            padding: 3px 3px;
            border: 1px solid #d2d2d2;
            vertical-align: top;
            line-height: 1.18;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .cr-table tbody td.r { text-align: right; white-space: normal; }
        .cr-table tbody td.c { text-align: center; }
        .cr-table tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cr-table tbody tr.low-stock td {
            background: #fde8e8 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cr-prod-name { font-weight: 600; }
        .cr-sub { color: #666; font-size: 6.2pt; }
        .cr-table tfoot td {
            padding: 4px 3px;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            font-size: 6.4pt;
            background: #eaeaea;
            overflow-wrap: anywhere;
            word-break: break-word;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .cr-table tfoot td.r { text-align: right; white-space: normal; }

        /* ===== Sheet footer ===== */
        .cr-foot {
            margin-top: auto;
            padding-top: 8px;
            border-top: 1px solid #ccc;
            display: flex;
            justify-content: space-between;
            font-size: 8pt;
            color: #555;
        }
        .cr-empty {
            text-align: center;
            padding: 40px 0;
            font-size: 12pt;
            color: #888;
        }

        /* ===== Print ===== */
        @media print {
            @page { size: <?php echo e($page_size, false); ?>; margin: 8mm; }
            html, body { background: #fff !important; }
            .cr-toolbar { display: none !important; }
            .cr-stage { margin: 0; padding: 0; gap: 0; }
            .cr-sheet {
                width: auto;
                min-height: auto;
                box-shadow: none;
                padding: 0;
                page-break-after: always;
            }
            .cr-sheet:last-child { page-break-after: auto; }
        }
    </style>
</head>
<body>

    <!-- Toolbar -->
    <div class="cr-toolbar">
        <span class="cr-title"><?php echo e(__('report.stock_report'), false); ?></span>

        <div class="cr-group">
            <button class="cr-btn cr-iconbtn" id="zoomOut" title="<?php echo e(__('lang_v1.zoom_out') ?? 'Zoom Out', false); ?>">&minus;</button>
            <span class="cr-zoom-label" id="zoomLabel">100%</span>
            <button class="cr-btn cr-iconbtn" id="zoomIn" title="Zoom In">+</button>
            <button class="cr-btn cr-iconbtn" id="zoomReset" title="Fit / Reset" style="font-size:12px;">100%</button>
        </div>

        <div class="cr-group">
            <button class="cr-btn cr-iconbtn" id="prevPage" title="Previous Page">&#8249;</button>
            <span class="cr-page-label"><input type="text" class="cr-page-input" id="pageInput" value="1"> / <?php echo e($total_pages, false); ?></span>
            <button class="cr-btn cr-iconbtn" id="nextPage" title="Next Page">&#8250;</button>
        </div>

        <div class="cr-group">
            <a class="cr-btn success" href="<?php echo e(url('reports/stock-report-print'), false); ?>?output=excel<?php echo e(!empty($query_string) ? '&'.$query_string : '', false); ?>">
                &#128202; <?php echo e(__('lang_v1.export_to_excel') ?? 'Excel', false); ?>

            </a>
            <a class="cr-btn danger" href="<?php echo e(url('reports/stock-report-print'), false); ?>?output=pdf<?php echo e(!empty($query_string) ? '&'.$query_string : '', false); ?>">
                &#128196; PDF
            </a>
            <button class="cr-btn primary" id="printBtn">&#128424; <?php echo e(__('messages.print'), false); ?> A4</button>
            <button class="cr-btn" id="closeBtn">&times; <?php echo e(__('messages.close'), false); ?></button>
        </div>
    </div>

    <!-- Stage -->
    <div class="cr-stage" id="crStage">
        <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">

            <!-- Brand Header -->
            <div class="cr-head">
                <div class="cr-head-left">
                    <?php if($logo): ?>
                        <img src="<?php echo e($logo, false); ?>" alt="logo" class="cr-logo">
                    <?php endif; ?>
                    <div>
                        <div class="cr-biz-name"><?php echo e($business_name, false); ?></div>
                        <div class="cr-biz-loc"><?php echo e($location_name, false); ?></div>
                    </div>
                </div>
                <div class="cr-head-right">
                    <div class="cr-report-title"><?php echo e(__('report.stock_report'), false); ?></div>
                    <div class="cr-report-sub"><?php echo e(__('lang_v1.generated_on') ?? 'Generated', false); ?>: <?php echo e($generated_at, false); ?></div>
                </div>
            </div>

            <!-- Filters Summary -->
            <?php if(!empty($filters_summary)): ?>
            <div class="cr-filters">
                <?php $__currentLoopData = $filters_summary; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="f-item"><b><?php echo e($label, false); ?>:</b> <?php echo e($value, false); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>

            <?php if(empty($page_rows)): ?>
                <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found') ?? 'No records found', false); ?></div>
            <?php else: ?>
            <table class="cr-table">
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
                        <th class="c" style="width:32px;">#</th>
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
                        <th class="r"><?php echo e(__('lang_v1.total_stock_price'), false); ?><br><small>(<?php echo e(__('lang_v1.by_purchase_price'), false); ?>)</small></th>
                        <?php endif; ?>
                        <?php if($show_stock_report_sale_value): ?>
                        <th class="r"><?php echo e(__('lang_v1.total_stock_price'), false); ?><br><small>(<?php echo e(__('lang_v1.by_sale_price'), false); ?>)</small></th>
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
                    <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $row_counter++; ?>
                    <tr class="<?php echo e(($r['enable_stock'] && $r['stock'] <= $r['alert_quantity']) ? 'low-stock' : '', false); ?>">
                        <td class="c"><?php echo e($row_counter, false); ?></td>
                        <td><?php echo e($r['sku'], false); ?></td>
                        <td>
                            <span class="cr-prod-name"><?php echo e($r['product'], false); ?></span>
                            <?php if(!empty($r['other_name'])): ?><br><span class="cr-sub"><?php echo e($r['other_name'], false); ?></span><?php endif; ?>
                        </td>
                        <?php if($show_variation_column): ?>
                        <td><?php echo e($r['variation'], false); ?></td>
                        <?php endif; ?>
                        <td><?php echo e($r['category'], false); ?></td>
                        <td><?php echo e($r['location'], false); ?></td>
                        <?php if(!$hide_prices): ?>
                        <td class="r"><?php echo e(_c($r['cost_price'], $cp, $dec, $thou), false); ?></td>
                        <td class="r"><?php echo e(_c($r['unit_price'], $cp, $dec, $thou), false); ?></td>
                        <?php endif; ?>
                        <td class="r">
                            <?php if($r['enable_stock']): ?>
                                <?php echo e(_q($r['stock'], $qp, $dec, $thou), false); ?> <?php echo e($r['unit'], false); ?>

                            <?php else: ?>
                                --
                            <?php endif; ?>
                        </td>
                        <?php if($show_stock_report_cost_value): ?>
                        <td class="r"><?php echo e(_c($r['stock_value_cost'], $cp, $dec, $thou), false); ?></td>
                        <?php endif; ?>
                        <?php if($show_stock_report_sale_value): ?>
                        <td class="r"><?php echo e(_c($r['stock_value_sale'], $cp, $dec, $thou), false); ?></td>
                        <?php endif; ?>
                        <?php if($show_stock_report_potential_profit): ?>
                        <td class="r"><?php echo e(_c($r['potential_profit'], $cp, $dec, $thou), false); ?></td>
                        <?php endif; ?>
                        <td class="r"><?php echo e(_q($r['total_sold'], $qp, $dec, $thou), false); ?> <?php echo e($r['unit'], false); ?></td>
                        <?php if($show_manufacturing_data): ?>
                        <td class="r"><?php echo e(_q($r['total_mfg_stock'], $qp, $dec, $thou), false); ?> <?php echo e($r['unit'], false); ?></td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <?php if($page_index === $total_pages - 1): ?>
                <tfoot>
                    <tr>
                        <td colspan="<?php echo e($leading_cols, false); ?>" class="r"><?php echo e(__('sale.total'), false); ?>:</td>
                        <td class="r"><?php echo e(_q($totals['stock'], $qp, $dec, $thou), false); ?></td>
                        <?php if($show_stock_report_cost_value): ?>
                        <td class="r"><?php echo e(_c($totals['stock_value_cost'], $cp, $dec, $thou), false); ?></td>
                        <?php endif; ?>
                        <?php if($show_stock_report_sale_value): ?>
                        <td class="r"><?php echo e(_c($totals['stock_value_sale'], $cp, $dec, $thou), false); ?></td>
                        <?php endif; ?>
                        <?php if($show_stock_report_potential_profit): ?>
                        <td class="r"><?php echo e(_c($totals['potential_profit'], $cp, $dec, $thou), false); ?></td>
                        <?php endif; ?>
                        <td class="r"><?php echo e(_q($totals['total_sold'], $qp, $dec, $thou), false); ?></td>
                        <?php if($show_manufacturing_data): ?>
                        <td class="r"><?php echo e(_q($totals['total_mfg_stock'], $qp, $dec, $thou), false); ?></td>
                        <?php endif; ?>
                    </tr>
                </tfoot>
                <?php endif; ?>
            </table>
            <?php endif; ?>

            <!-- Sheet Footer -->
            <div class="cr-foot">
                <span><?php echo e($business_name, false); ?> — <?php echo e(__('report.stock_report'), false); ?></span>
                <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <script>
        (function () {
            var zoom = 1;
            var stage = document.getElementById('crStage');
            var zoomLabel = document.getElementById('zoomLabel');
            var pages = Array.prototype.slice.call(document.querySelectorAll('.cr-sheet'));
            var totalPages = pages.length;
            var pageInput = document.getElementById('pageInput');

            function applyZoom() {
                pages.forEach(function (p) { p.style.zoom = zoom; });
                zoomLabel.textContent = Math.round(zoom * 100) + '%';
            }
            function setZoom(z) {
                zoom = Math.min(2.5, Math.max(0.4, z));
                applyZoom();
            }

            document.getElementById('zoomIn').addEventListener('click', function () { setZoom(zoom + 0.1); });
            document.getElementById('zoomOut').addEventListener('click', function () { setZoom(zoom - 0.1); });
            document.getElementById('zoomReset').addEventListener('click', function () { setZoom(1); });

            // Fit-to-width on load (so the wide landscape sheet is visible)
            function fitWidth() {
                if (!pages.length) return;
                var avail = window.innerWidth - 60;
                var sheetW = pages[0].offsetWidth; // px at zoom 1
                if (sheetW > avail) {
                    setZoom(avail / sheetW);
                } else {
                    setZoom(1);
                }
            }

            // Page navigation
            function goToPage(n) {
                n = Math.min(totalPages, Math.max(1, n));
                var target = document.getElementById('crPage' + n);
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    pageInput.value = n;
                }
            }
            document.getElementById('prevPage').addEventListener('click', function () {
                goToPage((parseInt(pageInput.value) || 1) - 1);
            });
            document.getElementById('nextPage').addEventListener('click', function () {
                goToPage((parseInt(pageInput.value) || 1) + 1);
            });
            pageInput.addEventListener('change', function () {
                goToPage(parseInt(pageInput.value) || 1);
            });

            // Update current page indicator on scroll
            var ticking = false;
            window.addEventListener('scroll', function () {
                if (ticking) return;
                ticking = true;
                window.requestAnimationFrame(function () {
                    var mid = window.scrollY + (window.innerHeight / 2);
                    var current = 1;
                    for (var i = 0; i < pages.length; i++) {
                        if (pages[i].offsetTop <= mid) current = i + 1;
                    }
                    if (document.activeElement !== pageInput) {
                        pageInput.value = current;
                    }
                    ticking = false;
                });
            });

            document.getElementById('printBtn').addEventListener('click', function () { window.print(); });
            document.getElementById('closeBtn').addEventListener('click', function () { window.close(); });

            window.addEventListener('load', fitWidth);
        })();
    </script>
</body>
</html>
