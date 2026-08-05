<?php $user_settings = json_decode(auth()->user()->user_settings, true); ?>

<?php $__env->startSection('title', __('report.summary_income_report')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header no-print">
    <h1><?php echo e(__('report.summary_income_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="print_section">
        <h2><?php echo e(session('business.name'), false); ?> - <?php echo e(__('report.summary_income_report'), false); ?></h2>
        <p>
            <?php echo e(\Carbon::parse($filters['start_date'])->format(session('business.date_format') ?? 'd/m/Y'), false); ?>

            <?php if($filters['start_date'] != $filters['end_date']): ?>
                &ndash; <?php echo e(\Carbon::parse($filters['end_date'])->format(session('business.date_format') ?? 'd/m/Y'), false); ?>

            <?php endif; ?>
        </p>
    </div>

    <div class="row no-print">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getSummaryIncomeReport']), 'method' => 'get', 'class' => 'row']); ?>

                    <div class="col-md-3 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('location_id', __('purchase.business_location') . ':'); ?>

                            <?php echo Form::select('location_id', $business_locations, $filters['location_id'], ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('user_id', __('report.user') . ':'); ?>

                            <?php echo Form::select('user_id', $users, $filters['user_id'], ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('report.all_users')]); ?>

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('start_date', __('report.range_from') . ':'); ?>

                            <?php echo Form::date('start_date', $filters['start_date'], ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('end_date', __('report.range_to') . ':'); ?>

                            <?php echo Form::date('end_date', $filters['end_date'], ['class' => 'form-control']); ?>

                        </div>
                    </div>
                    <div class="col-sm-12 mt-2">
                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('report.apply_filters'); ?></button>
                        <button type="button" class="btn btn-success" id="sir_print_a4">
                            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                        </button>
                        <button type="button" class="btn btn-info" id="sir_print_thermal">
                            <i class="fa fa-receipt"></i> <?php echo app('translator')->get('messages.print'); ?> <?php echo app('translator')->get('lang_v1.thermal'); ?> (80mm)
                        </button>
                    </div>
                <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.sales_summary')]); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang_v1.description'); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('lang_v1.amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo app('translator')->get('report.total_sell'); ?></td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($summary['sale'], false); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.total_sales_return'); ?></td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($summary['sale_return'], false); ?></span>
                                </td>
                            </tr>
                            <tr class="bg-gray font-17">
                                <td><strong><?php echo app('translator')->get('lang_v1.gross_sale'); ?></strong></td>
                                <td class="text-right">
                                    <strong><span class="display_currency" data-currency_symbol="false"><?php echo e($summary['gross_sale'], false); ?></span></strong>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('sale.discount'); ?></td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($summary['discount'], false); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('purchase.tax'); ?></td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($summary['sales_tax'], false); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.service_charges'); ?></td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($summary['service_charges'], false); ?></span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-gray font-17 footer-total">
                                <td><strong><?php echo app('translator')->get('lang_v1.net_sales'); ?></strong></td>
                                <td class="text-right">
                                    <strong><span class="display_currency" data-currency_symbol="false"><?php echo e($summary['net_sales'], false); ?></span></strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>

        <div class="col-md-6">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.cash_details')]); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang_v1.description'); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('lang_v1.amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong><?php echo app('translator')->get('lang_v1.cash_sale'); ?></strong></td>
                                <td class="text-right">
                                    <strong><span class="display_currency" data-currency_symbol="false"><?php echo e($summary['cash_sale'], false); ?></span></strong>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.credit_card_sale'); ?></td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($summary['card_sale'], false); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.credit_sale'); ?></td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($summary['credit_sale'], false); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo app('translator')->get('lang_v1.opening_cash'); ?></td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($summary['opening_cash'], false); ?></span>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="bg-aqua-active font-17">
                                <td><strong><?php echo app('translator')->get('lang_v1.receivable_cash'); ?></strong></td>
                                <td class="text-right">
                                    <strong><span class="display_currency" data-currency_symbol="false"><?php echo e($summary['receivable_cash'], false); ?></span></strong>
                                </td>
                            </tr>
                            <tr class="footer-total">
                                <td><?php echo app('translator')->get('lang_v1.cash_received'); ?></td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($summary['cash_received'], false); ?></span>
                                </td>
                            </tr>
                            <tr class="bg-gray font-17 footer-total">
                                <td><strong><?php echo app('translator')->get('lang_v1.difference'); ?></strong></td>
                                <td class="text-right">
                                    <strong><span class="display_currency" data-currency_symbol="false"><?php echo e($summary['difference'], false); ?></span></strong>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

    <?php if(! empty($service_breakdown)): ?>
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __('lang_v1.service_sales_analysis')]); ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-th-skin">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang_v1.service_type'); ?></th>
                                <th class="text-right"><?php echo app('translator')->get('lang_v1.percentage'); ?> (%)</th>
                                <th class="text-right"><?php echo app('translator')->get('lang_v1.amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $service_breakdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $svc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($svc['name'], false); ?></td>
                                <td class="text-right"><?php echo e(number_format($svc['percent'], 2), false); ?>%</td>
                                <td class="text-right">
                                    <span class="display_currency" data-currency_symbol="false"><?php echo e($svc['amount'], false); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <?php endif; ?>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    (function () {
        function printSir(mode) {
            var src = document.getElementById('sir_printable_data');
            if (!src) { return; }
            var html = src.outerHTML;

            var pageCss;
            if (mode === 'thermal') {
                pageCss = '@page{size:80mm auto;margin:2mm}'
                    + 'html,body{width:76mm;margin:0;padding:0;font-family:"Courier New",Consolas,monospace;font-size:11px}'
                    + 'table{width:100%;border-collapse:collapse}'
                    + 'th,td{border:1px solid #000;padding:2px 4px;font-size:11px}'
                    + 'th{background:#000!important;color:#fff!important;-webkit-print-color-adjust:exact;print-color-adjust:exact}'
                    + '.sir-print-header{text-align:center;margin-bottom:6px}'
                    + '.sir-print-header h2{font-size:13px;margin:0 0 2px}'
                    + '.sir-print-header p{font-size:10px;margin:0}'
                    + '.sir-section-title{font-weight:700;text-transform:uppercase;font-size:11px;margin:6px 0 2px;border-bottom:1px dashed #000}'
                    + '.text-right{text-align:right}'
                    + '.bg-gray{background:#ddd!important;-webkit-print-color-adjust:exact;print-color-adjust:exact}'
                    + '.bg-aqua-active{background:#00a2c4!important;color:#fff!important;-webkit-print-color-adjust:exact;print-color-adjust:exact}';
            } else {
                pageCss = '@page{size:A4;margin:12mm}'
                    + 'html,body{margin:0;padding:0;background:#fff;font-family:Arial,Helvetica,sans-serif}'
                    + 'table{width:100%;border-collapse:collapse}'
                    + 'th,td{border:1px solid #999;padding:4px 8px;font-size:13px}'
                    + 'th{background:#3c8dbc!important;color:#fff!important;-webkit-print-color-adjust:exact;print-color-adjust:exact}'
                    + '.sir-print-header{text-align:center;margin-bottom:14px}'
                    + '.sir-print-header h2{font-size:20px;margin:0 0 4px}'
                    + '.sir-print-header p{font-size:13px;margin:0}'
                    + '.sir-section-title{font-weight:700;text-transform:uppercase;font-size:14px;margin:14px 0 4px}'
                    + '.sir-two-col{display:flex;gap:24px}'
                    + '.sir-two-col>div{flex:1}'
                    + '.text-right{text-align:right}'
                    + '.bg-gray{background:#e8e8e8!important;-webkit-print-color-adjust:exact;print-color-adjust:exact}'
                    + '.bg-aqua-active{background:#00a2c4!important;color:#fff!important;-webkit-print-color-adjust:exact;print-color-adjust:exact}';
            }

            var title = <?php echo json_encode(__('report.summary_income_report'), 15, 512) ?>;
            var doc = '<!doctype html><html><head><meta charset="utf-8"><title>'
                + title + '</title><style>' + pageCss + '</style></head><body>'
                + html + '</body></html>';

            var w = window.open('', '_blank', 'width=900,height=700');
            if (!w) {
                alert('Please allow pop-ups to print this report.');
                return;
            }
            w.document.open();
            w.document.write(doc);
            w.document.close();
            w.focus();
            setTimeout(function () { try { w.print(); } catch (e) {} }, 350);
        }

        document.addEventListener('DOMContentLoaded', function () {
            var a4 = document.getElementById('sir_print_a4');
            var th = document.getElementById('sir_print_thermal');
            if (a4) a4.addEventListener('click', function () { printSir('a4'); });
            if (th) th.addEventListener('click', function () { printSir('thermal'); });
        });
    })();
</script>


<div id="sir_printable_data" style="display:none">
    <div class="sir-print-header">
        <h2><?php echo e(strtoupper(session('business.name')), false); ?></h2>
        <p><strong><?php echo e(strtoupper(__('report.summary_income_report')), false); ?></strong></p>
        <p>
            <?php echo e(\Carbon::parse($filters['start_date'])->format(session('business.date_format') ?? 'd/m/Y'), false); ?>

            <?php if($filters['start_date'] != $filters['end_date']): ?>
                &ndash; <?php echo e(\Carbon::parse($filters['end_date'])->format(session('business.date_format') ?? 'd/m/Y'), false); ?>

            <?php endif; ?>
        </p>
    </div>

    <div class="sir-two-col">
        <div>
            <div class="sir-section-title"><?php echo app('translator')->get('lang_v1.sales_summary'); ?></div>
            <table>
                <thead><tr><th><?php echo app('translator')->get('lang_v1.description'); ?></th><th class="text-right"><?php echo app('translator')->get('lang_v1.amount'); ?></th></tr></thead>
                <tbody>
                    <tr><td><?php echo app('translator')->get('report.total_sell'); ?></td><td class="text-right"><?php echo e(number_format($summary['sale'], 2), false); ?></td></tr>
                    <tr><td><?php echo app('translator')->get('lang_v1.total_sales_return'); ?></td><td class="text-right"><?php echo e(number_format($summary['sale_return'], 2), false); ?></td></tr>
                    <tr class="bg-gray"><td><strong><?php echo app('translator')->get('lang_v1.gross_sale'); ?></strong></td><td class="text-right"><strong><?php echo e(number_format($summary['gross_sale'], 2), false); ?></strong></td></tr>
                    <tr><td><?php echo app('translator')->get('sale.discount'); ?></td><td class="text-right"><?php echo e(number_format($summary['discount'], 2), false); ?></td></tr>
                    <tr><td><?php echo app('translator')->get('purchase.tax'); ?></td><td class="text-right"><?php echo e(number_format($summary['sales_tax'], 2), false); ?></td></tr>
                    <tr><td><?php echo app('translator')->get('lang_v1.service_charges'); ?></td><td class="text-right"><?php echo e(number_format($summary['service_charges'], 2), false); ?></td></tr>
                    <tr class="bg-gray"><td><strong><?php echo app('translator')->get('lang_v1.net_sales'); ?></strong></td><td class="text-right"><strong><?php echo e(number_format($summary['net_sales'], 2), false); ?></strong></td></tr>
                </tbody>
            </table>
        </div>
        <div>
            <div class="sir-section-title"><?php echo app('translator')->get('lang_v1.cash_details'); ?></div>
            <table>
                <thead><tr><th><?php echo app('translator')->get('lang_v1.description'); ?></th><th class="text-right"><?php echo app('translator')->get('lang_v1.amount'); ?></th></tr></thead>
                <tbody>
                    <tr><td><strong><?php echo app('translator')->get('lang_v1.cash_sale'); ?></strong></td><td class="text-right"><strong><?php echo e(number_format($summary['cash_sale'], 2), false); ?></strong></td></tr>
                    <tr><td><?php echo app('translator')->get('lang_v1.credit_card_sale'); ?></td><td class="text-right"><?php echo e(number_format($summary['card_sale'], 2), false); ?></td></tr>
                    <tr><td><?php echo app('translator')->get('lang_v1.credit_sale'); ?></td><td class="text-right"><?php echo e(number_format($summary['credit_sale'], 2), false); ?></td></tr>
                    <tr><td><?php echo app('translator')->get('lang_v1.opening_cash'); ?></td><td class="text-right"><?php echo e(number_format($summary['opening_cash'], 2), false); ?></td></tr>
                    <tr class="bg-aqua-active"><td><strong><?php echo app('translator')->get('lang_v1.receivable_cash'); ?></strong></td><td class="text-right"><strong><?php echo e(number_format($summary['receivable_cash'], 2), false); ?></strong></td></tr>
                    <tr><td><?php echo app('translator')->get('lang_v1.cash_received'); ?></td><td class="text-right"><?php echo e(number_format($summary['cash_received'], 2), false); ?></td></tr>
                    <tr class="bg-gray"><td><strong><?php echo app('translator')->get('lang_v1.difference'); ?></strong></td><td class="text-right"><strong><?php echo e(number_format($summary['difference'], 2), false); ?></strong></td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php if(! empty($service_breakdown)): ?>
    <div class="sir-section-title"><?php echo app('translator')->get('lang_v1.service_sales_analysis'); ?></div>
    <table>
        <thead><tr><th><?php echo app('translator')->get('lang_v1.service_type'); ?></th><th class="text-right">%</th><th class="text-right"><?php echo app('translator')->get('lang_v1.amount'); ?></th></tr></thead>
        <tbody>
            <?php $__currentLoopData = $service_breakdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $svc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($svc['name'], false); ?></td>
                <td class="text-right"><?php echo e(number_format($svc['percent'], 2), false); ?>%</td>
                <td class="text-right"><?php echo e(number_format($svc['amount'], 2), false); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>