<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'portrait';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $print_url = $print_url ?? url('reports/purchase-sell-print');
    $report_title = $report_title ?? __('report.purchase_sell');
    $total_pages = $total_pages ?? 1;
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_psr_print_money')) {
        function _psr_print_money($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
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

        .psr-print .section-title {
            margin: 10px 0 5px;
            font-size: 11pt;
            font-weight: 800;
            color: #111;
        }
        .psr-print table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 8.8pt;
        }
        .psr-print th,
        .psr-print td {
            border: 1px solid #d2d2d2;
            padding: 6px;
            line-height: 1.25;
            vertical-align: top;
            white-space: normal;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
        .psr-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: 8pt;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .psr-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .psr-print .text-right { text-align: right; }
        .psr-print .amount-cell {
            background: #f7fbff !important;
            font-weight: 700;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<div class="cr-stage psr-print" id="crStage">
    <div class="cr-sheet" id="crPage1">
        <?php echo $__env->make('report.partials.purchase_sell_report_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if(empty($sections)): ?>
            <div class="cr-empty"><?php echo e(__('lang_v1.no_records_found'), false); ?></div>
        <?php else: ?>
            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="section-title"><?php echo e($section['title'], false); ?></div>
                <table>
                    <thead>
                        <tr>
                            <th><?php echo e(__('lang_v1.description'), false); ?></th>
                            <th class="text-right"><?php echo e(__('sale.total'), false); ?> <?php echo e($currency_symbol, false); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $section['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($row['label'], false); ?></td>
                                <td class="text-right amount-cell"><?php echo e(_psr_print_money($row['value'], $decimal_separator, $thousand_separator), false); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <div class="cr-foot">
            <span><?php echo e($business_name, false); ?> - <?php echo e($report_title, false); ?></span>
            <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> 1 / 1</span>
        </div>
    </div>
</div>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
