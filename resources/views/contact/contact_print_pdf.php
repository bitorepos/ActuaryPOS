<?php
    $raw_html_pages = $raw_html_pages ?? [];
    $total_pages = ! empty($raw_html_pages) ? count($raw_html_pages) : count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';
    $orientation = ($orientation ?? 'landscape') === 'portrait' ? 'portrait' : 'landscape';
    $pdf_sheet_size = $orientation === 'portrait' ? 'A4' : 'A4-L';
    $use_mpdf_footer = ! empty($use_mpdf_footer);

    if (! function_exists('_contact_print_pdf_number')) {
        function _contact_print_pdf_number($value, $decimal_separator, $thousand_separator) {
            return number_format((float) $value, 2, $decimal_separator, $thousand_separator);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo e($report_title, false); ?></title>
    <style>
        @page { sheet-size: <?php echo e($pdf_sheet_size, false); ?>; margin: <?php echo e($use_mpdf_footer ? '8mm 9mm 13mm 9mm' : '8mm 9mm', false); ?>; }
        * { box-sizing: border-box; }
        body {
            color: #1a1a1a;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 7pt;
            margin: 0;
        }
        .pdf-page-break {
            page-break-after: always;
        }
        .pdf-head {
            border-bottom: 2px solid #1a1a1a;
            margin-bottom: 6px;
            padding-bottom: 5px;
            width: 100%;
        }
        .pdf-head td {
            border: 0;
            padding: 0;
            vertical-align: top;
        }
        .pdf-logo {
            max-height: 42px;
            max-width: 120px;
        }
        .pdf-biz-name {
            font-size: 15pt;
            font-weight: 800;
            line-height: 1.05;
        }
        .pdf-biz-loc,
        .pdf-report-sub {
            color: #444;
            font-size: 7.2pt;
        }
        .pdf-report-title {
            display: block;
            font-size: 13pt;
            font-weight: 800;
            text-align: right;
            text-transform: uppercase;
            width: 100%;
        }
        .pdf-report-sub {
            margin-top: 2px;
            text-align: right;
            width: 100%;
        }
        .pdf-filters {
            border-bottom: 1px solid #d2d2d2;
            font-size: 6.8pt;
            margin-bottom: 5px;
            padding-bottom: 4px;
        }
        .pdf-filters span {
            display: inline-block;
            margin-right: 10px;
            white-space: nowrap;
        }
        .contact-print table {
            border-collapse: collapse;
            table-layout: fixed;
            white-space: normal !important;
            width: 100%;
        }
        .contact-print th,
        .contact-print td {
            border: 0.5px solid #999;
            line-height: 1.12;
            overflow-wrap: break-word;
            padding: 2.4px 3px;
            vertical-align: top;
            word-break: break-word;
        }
        .contact-print th {
            background: #1a1a1a;
            color: #fff;
            font-size: 5.6pt;
            font-weight: 700;
            text-transform: uppercase;
        }
        .contact-print td {
            font-size: 6.1pt;
        }
        .contact-print .text-center,
        .contact-print .align-center {
            text-align: center;
        }
        .contact-print .text-right,
        .contact-print .align-right,
        .contact-print .float-end,
        .contact-print .ws-nowrap {
            text-align: right;
            white-space: nowrap;
        }
        .contact-print .col-md-6,
        .contact-print .col-sm-6,
        .contact-print .col-6 {
            float: left;
            width: 50%;
        }
        .contact-print .col-md-12,
        .contact-print .col-sm-12,
        .contact-print .width-100 {
            clear: both;
            float: none;
            width: 100%;
        }
        .contact-print .width-50 {
            width: 50%;
        }
        .contact-print .f-left {
            float: left;
        }
        .contact-print .f-right {
            float: right;
        }
        .contact-print .p-4 {
            padding: 3px;
        }
        .contact-print .mb-0 {
            margin-bottom: 0;
        }
        .contact-print .hide,
        .contact-print .no-print,
        .contact-print script {
            display: none;
        }
        .contact-print .blue-heading {
            background: #357ca5;
            color: #fff;
            font-weight: 700;
        }
        .contact-print .table-responsive,
        .contact-print .ledger-table-section,
        .contact-print .ledger-converted-section,
        .contact-print .clearfix {
            clear: both;
            overflow: visible;
        }
        .contact-print .table-striped tbody tr:nth-child(odd) td,
        .contact-print .table-pdf .odd td,
        .contact-print tr.odd td {
            background: #DCE6F1;
        }
        .contact-print .footer-total td,
        .contact-print .total-row td {
            background: #e8e8e8;
            border-top: 1.5px solid #1a1a1a;
            font-weight: 800;
            text-align: right;
            white-space: nowrap;
        }
        .contact-print .footer-total td:first-child,
        .contact-print .total-row td:first-child {
            text-align: right;
        }
        .contact-print #ledger_table th:nth-child(1),
        .contact-print #ledger_table_converted th:nth-child(1) { width: 9%; }
        .contact-print #ledger_table th:nth-child(2),
        .contact-print #ledger_table_converted th:nth-child(2) { width: 13%; }
        .contact-print #ledger_table th:nth-child(3),
        .contact-print #ledger_table_converted th:nth-child(3) { width: 7%; }
        .contact-print #ledger_table th:nth-child(4),
        .contact-print #ledger_table_converted th:nth-child(4) { width: 9%; }
        .contact-print #ledger_table th:nth-child(5),
        .contact-print #ledger_table_converted th:nth-child(5) { width: 16%; }
        .contact-print #ledger_table th:nth-child(6),
        .contact-print #ledger_table_converted th:nth-child(6) { width: 11%; }
        .contact-print #ledger_table th:nth-child(7),
        .contact-print #ledger_table_converted th:nth-child(7) { width: 11%; }
        .contact-print #ledger_table th:nth-child(8),
        .contact-print #ledger_table th:nth-child(9),
        .contact-print #ledger_table th:nth-child(10),
        .contact-print #ledger_table_converted th:nth-child(8),
        .contact-print #ledger_table_converted th:nth-child(9),
        .contact-print #ledger_table_converted th:nth-child(10) { width: 8%; }
        .pdf-foot {
            border-top: 1px solid #ccc;
            color: #555;
            font-size: 6.5pt;
            margin-top: 6px;
            padding-top: 4px;
            width: 100%;
        }
        .pdf-foot td {
            border: 0;
            padding: 0;
        }
        .pdf-foot .right {
            text-align: right;
        }
        .empty-row {
            color: #777;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
<?php if(! empty($raw_html_pages)): ?>
    <?php $__currentLoopData = $raw_html_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_html): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="pdf-page contact-print <?php if(! $loop->last): ?> pdf-page-break <?php endif; ?>">
            <?php echo $__env->make('contact.partials.contact_print_pdf_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $page_html; ?>

            <?php if(! $use_mpdf_footer): ?>
                <table class="pdf-foot">
                    <tr>
                        <td><?php echo e($business_name, false); ?> - <?php echo e($tab_label, false); ?></td>
                        <td class="right"><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></td>
                    </tr>
                </table>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="pdf-page contact-print <?php if(! $loop->last): ?> pdf-page-break <?php endif; ?>">
            <?php echo $__env->make('contact.partials.contact_print_pdf_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php if(! empty($raw_html)): ?>
                <?php echo $raw_html; ?>

            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <th class="<?php echo e(in_array(($column['type'] ?? ''), ['money', 'number'], true) ? 'text-right' : '', false); ?>">
                                    <?php echo e($column['label'], false); ?>

                                    <?php if(($column['type'] ?? '') === 'money' && ! empty($currency_symbol)): ?>
                                        (<?php echo e($currency_symbol, false); ?>)
                                    <?php endif; ?>
                                </th>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($rows)): ?>
                            <tr>
                                <td colspan="<?php echo e(max(count($columns), 1), false); ?>" class="empty-row"><?php echo e(__('lang_v1.no_records_found'), false); ?></td>
                            </tr>
                        <?php else: ?>
                            <?php $__currentLoopData = $page_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $key = $column['key'];
                                            $type = $column['type'] ?? 'text';
                                        ?>
                                        <td class="<?php echo e(in_array($type, ['money', 'number'], true) ? 'text-right' : '', false); ?>">
                                            <?php if(in_array($type, ['money', 'number'], true)): ?>
                                                <?php echo e($row[$key] === null || $row[$key] === '' ? '' : _contact_print_pdf_number($row[$key], $decimal_separator, $thousand_separator), false); ?>

                                            <?php else: ?>
                                                <?php echo e($row[$key] ?? '', false); ?>

                                            <?php endif; ?>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </tbody>
                    <?php if(! empty($rows) && $loop->last): ?>
                        <tfoot>
                            <tr class="total-row">
                                <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($loop->first): ?>
                                        <td><?php echo e(__('sale.total'), false); ?></td>
                                    <?php elseif(! empty($column['total']) && in_array(($column['type'] ?? ''), ['money', 'number'], true)): ?>
                                        <td class="text-right"><?php echo e(_contact_print_pdf_number($totals[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                    <?php else: ?>
                                        <td></td>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tr>
                        </tfoot>
                    <?php endif; ?>
                </table>
            <?php endif; ?>
            <?php if(! $use_mpdf_footer): ?>
                <table class="pdf-foot">
                    <tr>
                        <td><?php echo e($business_name, false); ?> - <?php echo e($tab_label, false); ?></td>
                        <td class="right"><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></td>
                    </tr>
                </table>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
</body>
</html>
