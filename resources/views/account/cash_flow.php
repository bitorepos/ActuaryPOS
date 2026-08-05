
<?php $__env->startSection('title', __('lang_v1.cash_flow')); ?>

<?php $__env->startSection('css'); ?>
<style>
    .cash-flow-report .cash-flow-hero {
        background: #ffffff;
        border: 1px solid #e7edf3;
        border-radius: 8px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        margin-bottom: 18px;
        overflow: hidden;
    }
    .cash-flow-report .cash-flow-hero-header {
        align-items: center;
        border-bottom: 1px solid #eef2f7;
        display: flex;
        gap: 12px;
        justify-content: space-between;
        padding: 16px 18px;
    }
    .cash-flow-report .cash-flow-hero-header h3 {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }
    .cash-flow-report .cash-flow-updated {
        color: #64748b;
        font-size: 12px;
        white-space: nowrap;
    }
    .cash-flow-report .cash-flow-kpis {
        display: grid;
        gap: 12px;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        padding: 16px 18px 8px;
    }
    .cash-flow-report .cash-flow-kpi {
        border: 1px solid #e8eef5;
        border-left-width: 4px;
        border-radius: 8px;
        padding: 13px 14px;
    }
    .cash-flow-report .cash-flow-kpi .kpi-label {
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 0;
        text-transform: uppercase;
    }
    .cash-flow-report .cash-flow-kpi .kpi-value {
        color: #0f172a;
        font-size: 22px;
        font-weight: 800;
        margin-top: 6px;
    }
    .cash-flow-report .kpi-inflow { border-left-color: #16a34a; }
    .cash-flow-report .kpi-outflow { border-left-color: #dc2626; }
    .cash-flow-report .kpi-net { border-left-color: #2563eb; }
    .cash-flow-report .cash-flow-breakdown {
        display: grid;
        gap: 16px;
        grid-template-columns: 1.2fr 1fr;
        padding: 8px 18px 18px;
    }
    .cash-flow-report .summary-panel {
        border: 1px solid #edf2f7;
        border-radius: 8px;
        overflow: hidden;
    }
    .cash-flow-report .summary-panel-title {
        align-items: center;
        background: #f8fafc;
        border-bottom: 1px solid #edf2f7;
        display: flex;
        font-weight: 700;
        justify-content: space-between;
        padding: 10px 12px;
    }
    .cash-flow-report .summary-row {
        align-items: center;
        border-bottom: 1px solid #f1f5f9;
        display: grid;
        gap: 10px;
        grid-template-columns: 1fr auto;
        min-height: 42px;
        padding: 8px 12px;
    }
    .cash-flow-report .summary-row:last-child { border-bottom: 0; }
    .cash-flow-report .summary-row small {
        color: #64748b;
        display: block;
        font-size: 11px;
        line-height: 1.2;
    }
    .cash-flow-report .summary-amount {
        font-weight: 800;
        text-align: right;
        white-space: nowrap;
    }
    .cash-flow-report .summary-amount.positive { color: #15803d; }
    .cash-flow-report .summary-amount.negative { color: #b91c1c; }
    .cash-flow-report .cash-flow-table-box .box-header {
        align-items: center;
        display: flex;
        justify-content: space-between;
    }
    .cash-flow-report #cash_flow_table td {
        vertical-align: middle;
    }
    @media (max-width: 991px) {
        .cash-flow-report .cash-flow-kpis,
        .cash-flow-report .cash-flow-breakdown {
            grid-template-columns: 1fr;
        }
        .cash-flow-report .cash-flow-hero-header {
            align-items: flex-start;
            flex-direction: column;
        }
        .cash-flow-report .cash-flow-updated {
            white-space: normal;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.cash_flow'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content no-print cash-flow-report">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title"> <i class="fa fa-filter" aria-hidden="true"></i> <?php echo app('translator')->get('report.filters'); ?>:</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <?php echo Form::label('cash_flow_location_id',  __('purchase.business_location') . ':'); ?>

                            <?php echo Form::select('cash_flow_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <?php echo Form::label('account_id', __('account.account') . ':'); ?>

                            <?php echo Form::select('account_id', $accounts, '', ['class' => 'form-control', 'placeholder' => __('messages.all')]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <?php echo Form::label('transaction_type', __('account.transaction_type') . ':'); ?>

                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                                <?php echo Form::select('transaction_type', ['' => __('messages.all'),'debit' => __('account.debit'), 'credit' => __('account.credit')], '', ['class' => 'form-select']); ?>

                            </div>
                        </div>
                    </div>
                    <?php
                        $date_loc = array_key_first($date_settings);
                    ?>
                    <?php if(!empty($date_settings[$date_loc]['accounting_filter_date_range'])): ?>
                        <?php echo Form::hidden('accounting_filter_date_range', $date_settings[$date_loc]['accounting_filter_date_range'], ['id'=>'accounting_filter_date_range']); ?>

                    <?php endif; ?>
                    <div class="col-sm-3">
                        <div class="mb-3">
                            <?php echo Form::label('transaction_date_range', __('report.date_range') . ':'); ?>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                <?php echo Form::text('transaction_date_range', null, ['class' => 'form-control', 'readonly', 'placeholder' => __('report.date_range')]); ?>

                            </div>
                        </div>
                    </div>
                    </div><!-- /.row -->
                </div>
            </div>
        </div>
    </div>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account.access')): ?>
        <div class="cash-flow-hero">
            <div class="cash-flow-hero-header">
                <h3><i class="fa fa-chart-line"></i> <?php echo app('translator')->get('lang_v1.cash_flow'); ?> Summary</h3>
                <span class="cash-flow-updated" id="cash_flow_summary_range"></span>
            </div>
            <div class="cash-flow-kpis">
                <div class="cash-flow-kpi kpi-inflow">
                    <div class="kpi-label">Total Inflow</div>
                    <div class="kpi-value" id="summary_total_inflow"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                </div>
                <div class="cash-flow-kpi kpi-outflow">
                    <div class="kpi-label">Total Outflow</div>
                    <div class="kpi-value" id="summary_total_outflow"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                </div>
                <div class="cash-flow-kpi kpi-net">
                    <div class="kpi-label"><?php echo app('translator')->get('lang_v1.net_cash_flows'); ?></div>
                    <div class="kpi-value" id="summary_net_cash_flow"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) 0, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></div>
                </div>
            </div>
            <div class="cash-flow-breakdown">
                <div class="summary-panel">
                    <div class="summary-panel-title">
                        <span><i class="fa fa-list-ul"></i> Daily Closing Sheet</span>
                        <span><?php echo app('translator')->get('sale.total'); ?></span>
                    </div>
                    <div id="cash_flow_category_summary"></div>
                </div>
                <div class="summary-panel">
                    <div class="summary-panel-title">
                        <span><i class="fa fa-credit-card"></i> <?php echo app('translator')->get('lang_v1.payment_method'); ?></span>
                        <span><?php echo app('translator')->get('sale.total'); ?></span>
                    </div>
                    <div id="cash_flow_method_summary"></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account.access')): ?>
        <div class="text-end mb-2">
            <button type="button" id="print_cash_flow" class="btn btn-primary">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary cash-flow-table-box">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-table"></i> Payment Ledger</h3>
                </div>
                <div class="box-body">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('account.access')): ?>
                        <div class="table-responsive">
                    	<table class="table table-bordered table-striped table-th-skin" id="cash_flow_table">
                    		<thead>
                    			<tr>
                                    <th><?php echo app('translator')->get( 'messages.date' ); ?></th>
                                    <th><?php echo app('translator')->get( 'account.account' ); ?></th>
                                    <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                                    <th><?php echo app('translator')->get( 'lang_v1.payment_method' ); ?></th>
                                    <th><?php echo app('translator')->get( 'lang_v1.payment_details' ); ?></th>
                                    <th class="text-right"><?php echo app('translator')->get('account.debit'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                    				<th class="text-right"><?php echo app('translator')->get('account.credit'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                    				<th class="text-right"><?php echo app('translator')->get( 'lang_v1.account_balance' ); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>) <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.account_balance_tooltip') . '"></i>';
                }
            ?></th>
                                    <th class="text-right"><?php echo app('translator')->get( 'lang_v1.total_balance' ); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>) <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.total_balance_tooltip') . '"></i>';
                }
            ?></th>
                    			</tr>
                    		</thead>
                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-center">
                                    <td colspan="5"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                    <td class="footer_total_debit text-right"></td>
                                    <td class="footer_total_credit text-right"></td>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                    	</table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    

    <div class="modal fade account_model" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function(){
        function getCashFlowPrintParams() {
            var start = '';
            var end = '';
            if ($('#transaction_date_range').val() != '') {
                start = $('#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                end = $('#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
            }

            return $.param({
                account_id: $('#account_id').val(),
                type: $('#transaction_type').val(),
                start_date: start,
                end_date: end,
                location_id: $('#cash_flow_location_id').val(),
                tab: 'all'
            });
        }

        $(document).on('click', '#print_cash_flow', function() {
            window.open("<?php echo e(action([\App\Http\Controllers\AccountController::class, 'printCashFlow']), false); ?>?" + getCashFlowPrintParams(), '_blank');
        });

        let date_range_default = $('#accounting_filter_date_range').val();
        if(date_range_default == 'today'){
            dateRangeSettings.startDate = moment();
            dateRangeSettings.endDate = moment();
        }else if(date_range_default == 'last_seven_days'){
            dateRangeSettings.startDate = moment().subtract(6,'day');
            dateRangeSettings.endDate = moment();
        }else if(date_range_default == 'last_thirty_days'){
            dateRangeSettings.startDate = moment().subtract(29,'day');
            dateRangeSettings.endDate = moment();
        }else if(date_range_default == 'this_month'){
            dateRangeSettings.startDate = moment().startOf('month');
            dateRangeSettings.endDate = moment();
        }else if(date_range_default == 'last_month'){
            dateRangeSettings.startDate = moment().subtract(1, 'month').startOf('month');
            dateRangeSettings.endDate = moment().subtract(1, 'month').endOf('month');
        }else if(date_range_default == 'this_year'){
            dateRangeSettings.startDate = moment().startOf('year');
            dateRangeSettings.endDate = moment();
        }else if(date_range_default == 'last_year'){
            dateRangeSettings.startDate = moment().subtract(1, 'year').startOf('year');
            dateRangeSettings.endDate = moment().subtract(1, 'year').endOf('year');
        }else if(date_range_default == 'current_financial_year'){
            // dateRangeSettings.startDate = moment();
            // dateRangeSettings.endDate = moment();
        }else if(date_range_default == 'all_time'){
            dateRangeSettings.startDate = moment(business_start_date);
            dateRangeSettings.endDate = moment();
        }
        // dateRangeSettings.autoUpdateInput = false
        $('#transaction_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#transaction_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
                cash_flow_table.ajax.reload();
            }
        );
        
        // Cash Flow Table
        cash_flow_table = $('#cash_flow_table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                    "url": "<?php echo e(action([\App\Http\Controllers\AccountController::class, 'cashFlow']), false); ?>",
                    "data": function ( d ) {
                        var start = '';
                        var end = '';
                        if($('#transaction_date_range').val() != ''){
                            start = $('#transaction_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                            end = $('#transaction_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                        }
                        
                        d.account_id = $('#account_id').val();
                        d.type = $('#transaction_type').val();
                        d.start_date = start,
                        d.end_date = end
                        d.location_id = $('#cash_flow_location_id').val();

                    },
                    "dataSrc": function (json) {
                        updateCashFlowSummary(json.summary || {});
                        return json.data;
                    }
                },
            "ordering": false,
            columns: [
                {data: 'operation_date', name: 'operation_date'},
                {data: 'account_name', name: 'A.name'},
                {data: 'sub_type', name: 'sub_type', searchable: false},
                {data: 'method', name: 'TP.method'},
                {data: 'payment_details', name: 'TP.payment_ref_no'},
                {data: 'debit', name: 'amount', searchable: false, className: 'text-right'},
                {data: 'credit', name: 'amount', searchable: false, className: 'text-right'},
                {data: 'balance', name: 'balance', searchable: false, className: 'text-right'},
                {data: 'total_balance', name: 'total_balance', searchable: false, className: 'text-right'},
            ],
            "fnDrawCallback": function (oSettings) {
                __currency_convert_recursively($('#cash_flow_table'));
            },
            "footerCallback": function ( row, data, start, end, display ) {
                var footer_total_debit = 0;
                var footer_total_credit = 0;

                for (var r in data){
                    footer_total_debit += $(data[r].debit).data('orig-value') ? parseFloat($(data[r].debit).data('orig-value')) : 0;
                    footer_total_credit += $(data[r].credit).data('orig-value') ? parseFloat($(data[r].credit).data('orig-value')) : 0;
                }

                $('.footer_total_debit').html(__currency_trans_from_en(footer_total_debit, false));
                $('.footer_total_credit').html(__currency_trans_from_en(footer_total_credit, false));
            }
        });
        $('#transaction_type, #account_id, #cash_flow_location_id').change( function(){
            cash_flow_table.ajax.reload();
        });
        $('#transaction_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#transaction_date_range').val('').change();
            cash_flow_table.ajax.reload();
        });

    });

    function updateCashFlowSummary(summary) {
        var inflow = parseFloat(summary.inflow || 0);
        var outflow = parseFloat(summary.outflow || 0);
        var net = parseFloat(summary.net || 0);

        $('#summary_total_inflow').html(__currency_trans_from_en(inflow));
        $('#summary_total_outflow').html(__currency_trans_from_en(outflow));
        $('#summary_net_cash_flow')
            .toggleClass('text-success', net >= 0)
            .toggleClass('text-danger', net < 0)
            .html(__currency_trans_from_en(net));

        var range = $('#transaction_date_range').val();
        $('#cash_flow_summary_range').text(range ? range : '<?php echo e(__("messages.all"), false); ?>');

        renderSummaryRows('#cash_flow_category_summary', summary.categories || []);
        renderMethodRows('#cash_flow_method_summary', summary.methods || []);
    }

    function renderSummaryRows(selector, rows) {
        var html = '';

        if (!rows.length) {
            html = '<div class="summary-row"><span><?php echo e(__("lang_v1.no_data"), false); ?></span><span class="summary-amount">-</span></div>';
        } else {
            rows.forEach(function(row) {
                var amount = parseFloat(row.amount || 0);
                var amount_class = amount < 0 ? 'negative' : (amount > 0 ? 'positive' : '');
                html += '<div class="summary-row">'
                    + '<span>' + escapeHtml(row.label || '') + '<small>' + escapeHtml(directionLabel(row.direction)) + '</small></span>'
                    + '<span class="summary-amount ' + amount_class + '">' + __currency_trans_from_en(amount) + '</span>'
                    + '</div>';
            });
        }

        $(selector).html(html);
    }

    function renderMethodRows(selector, rows) {
        var html = '';

        if (!rows.length) {
            html = '<div class="summary-row"><span><?php echo e(__("lang_v1.no_data"), false); ?></span><span class="summary-amount">-</span></div>';
        } else {
            rows.forEach(function(row) {
                var net = parseFloat(row.net || 0);
                var amount_class = net < 0 ? 'negative' : (net > 0 ? 'positive' : '');
                html += '<div class="summary-row">'
                    + '<span>' + escapeHtml(row.label || '') + '<small>In: ' + __currency_trans_from_en(row.inflow || 0) + ' | Out: ' + __currency_trans_from_en(row.outflow || 0) + '</small></span>'
                    + '<span class="summary-amount ' + amount_class + '">' + __currency_trans_from_en(net) + '</span>'
                    + '</div>';
            });
        }

        $(selector).html(html);
    }

    function directionLabel(direction) {
        if (direction == 'inflow') {
            return 'Inflow';
        }
        if (direction == 'outflow') {
            return 'Outflow';
        }

        return 'Inflow / Outflow';
    }

    function escapeHtml(value) {
        return $('<div>').text(value).html();
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>