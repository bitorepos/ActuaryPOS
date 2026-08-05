<?php
    $is_pdf = ! empty($is_pdf);
    $orientation = $orientation ?? 'landscape';
    $sheet_width = $orientation === 'portrait' ? '210mm' : '297mm';
    $sheet_min_height = $orientation === 'portrait' ? '297mm' : '210mm';
    $page_size = $orientation === 'portrait' ? '210mm 297mm' : '297mm 210mm';
    $raw_html_pages = $raw_html_pages ?? [];
    $print_url = $print_url ?? url('contacts/'.request()->route('id').'/print');
    $total_pages = ! empty($raw_html_pages) ? count($raw_html_pages) : count($row_pages ?? [[]]);
    $decimal_separator = session('currency')['decimal_separator'] ?? '.';
    $thousand_separator = session('currency')['thousand_separator'] ?? ',';

    if (! function_exists('_contact_print_number')) {
        function _contact_print_number($value, $decimal_separator, $thousand_separator) {
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
        @page { size: <?php echo e($page_size, false); ?>; margin: 0; }
        <?php if($is_pdf): ?>
        html, body { background: #fff !important; }
        .cr-stage {
            display: block;
            gap: 0;
            margin-top: 0;
            padding: 0;
        }
        .cr-sheet {
            break-after: page;
            box-shadow: none;
            display: block;
            margin: 0;
            min-height: auto;
            page-break-after: always;
            page-break-inside: avoid;
            padding: 8mm 9mm;
            width: auto;
        }
        .cr-sheet:last-child { page-break-after: auto; }
        .cr-foot { margin-top: 8px; }
        .contact-print .contact-ledger-html .col-md-12 {
            clear: both;
        }
        .contact-print .contact-ledger-html .table-responsive {
            clear: both;
            overflow: visible !important;
        }
        <?php endif; ?>

        .contact-print table {
            border-collapse: collapse;
            font-size: <?php echo e(count($columns ?? []) > 8 ? '6.4pt' : '7.2pt', false); ?>;
            table-layout: auto;
            width: 100%;
        }
        .contact-print th,
        .contact-print td {
            border: 1px solid #d2d2d2;
            line-height: 1.16;
            overflow-wrap: anywhere;
            padding: 4px 5px;
            text-align: left;
            vertical-align: top;
            white-space: normal;
            word-break: break-word;
        }
        .contact-print th {
            background: #1a1a1a !important;
            color: #fff !important;
            font-size: <?php echo e(count($columns ?? []) > 8 ? '5.8pt' : '6.5pt', false); ?>;
            font-weight: 700;
            text-transform: uppercase;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .contact-print tbody tr:nth-child(even) td {
            background: #f4f4f4;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .contact-print .text-right,
        .contact-print .text-end,
        .contact-print .align-right,
        .contact-print .float-end,
        .contact-print .numeric-cell,
        .contact-print tr.text-right > th,
        .contact-print tr.text-right > td {
            text-align: right !important;
        }
        .contact-print td.text-right,
        .contact-print th.text-right,
        .contact-print td.text-end,
        .contact-print th.text-end,
        .contact-print td.align-right,
        .contact-print th.align-right,
        .contact-print td.float-end,
        .contact-print th.float-end,
        .contact-print td.numeric-cell,
        .contact-print th.numeric-cell,
        .contact-print tr.text-right > th,
        .contact-print tr.text-right > td {
            white-space: nowrap;
        }
        .contact-print .total-row td {
            background: #e8e8e8 !important;
            border-top: 2px solid #1a1a1a;
            font-weight: 800;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .contact-print .empty-row {
            color: #777;
            padding: 28px 0;
            text-align: center;
        }
        .contact-print .contact-ledger-html {
            font-size: 8pt;
            overflow: visible;
        }
        .contact-print .contact-ledger-html table {
            font-size: inherit;
            table-layout: auto;
        }
        .contact-print thead {
            display: table-header-group;
        }
        .contact-print tfoot {
            display: table-row-group;
        }
        .contact-print tr,
        .contact-print td,
        .contact-print th {
            break-inside: avoid;
            page-break-inside: avoid;
        }
        .contact-print .contact-summary {
            border-bottom: 1px solid #d2d2d2;
            flex-wrap: nowrap;
            padding-bottom: 5px;
        }
        .contact-print .contact-summary .f-item {
            white-space: nowrap;
        }
    </style>
</head>
<body>
<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php if(! empty($raw_html_pages)): ?>
    <div class="cr-stage contact-print" id="crStage">
        <?php $__currentLoopData = $raw_html_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_html): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
                <?php echo $__env->make('contact.partials.contact_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="contact-ledger-html">
                    <?php echo $page_html; ?>

                </div>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo e($tab_label, false); ?></span>
                    <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <div class="cr-stage contact-print" id="crStage">
        <?php $__currentLoopData = $row_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page_index => $page_rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cr-sheet" id="crPage<?php echo e($page_index + 1, false); ?>">
                <?php echo $__env->make('contact.partials.contact_print_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php if(! empty($raw_html)): ?>
                    <div class="contact-ledger-html">
                        <?php echo $raw_html; ?>

                    </div>
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
                                                    <?php echo e($row[$key] === null || $row[$key] === '' ? '' : _contact_print_number($row[$key], $decimal_separator, $thousand_separator), false); ?>

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
                                            <td class="text-right"><?php echo e(_contact_print_number($totals[$column['key']] ?? 0, $decimal_separator, $thousand_separator), false); ?></td>
                                        <?php else: ?>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                <?php endif; ?>

                <div class="cr-foot">
                    <span><?php echo e($business_name, false); ?> - <?php echo e($tab_label, false); ?></span>
                    <span><?php echo e(__('lang_v1.page') ?? 'Page', false); ?> <?php echo e($page_index + 1, false); ?> / <?php echo e($total_pages, false); ?></span>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

<?php if(($tab ?? '') === 'ledger' && ! empty($filters['hidden_columns'])): ?>
<script>
    (function () {
        var hiddenColumns = <?php echo json_encode(array_values($filters['hidden_columns']), 15, 512) ?>;
        var hiddenColumnLookup = {};

        hiddenColumns.forEach(function (columnIndex) {
            hiddenColumnLookup[columnIndex] = true;
        });

        document.querySelectorAll('.contact-ledger-html #ledger_table, .contact-ledger-html #ledger_table_converted').forEach(function (table) {
            table.querySelectorAll('tr').forEach(function (row) {
                var logicalColumnIndex = 0;
                var cells = Array.prototype.filter.call(row.children, function (child) {
                    return child.tagName === 'TH' || child.tagName === 'TD';
                });

                cells.forEach(function (cell) {
                    var originalColspan = parseInt(cell.getAttribute('colspan') || '1', 10);
                    var visibleColspan = 0;

                    for (var offset = 0; offset < originalColspan; offset++) {
                        if (!hiddenColumnLookup[logicalColumnIndex + offset]) {
                            visibleColspan++;
                        }
                    }

                    logicalColumnIndex += originalColspan;

                    if (visibleColspan === 0) {
                        cell.parentNode.removeChild(cell);
                    } else if (visibleColspan !== originalColspan) {
                        cell.setAttribute('colspan', visibleColspan);
                    }
                });
            });
        });
    })();
</script>
<?php endif; ?>

<?php if(! $is_pdf): ?>
    <?php echo $__env->make('report.partials.crystal_report_scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
</body>
</html>
