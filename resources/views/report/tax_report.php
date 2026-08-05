<?php $user_settings = json_decode(auth()->user()->user_settings, true) ?? []; ?>

<?php $__env->startSection('title', __( 'report.tax_report' )); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'report.tax_report' ); ?>
        <small><?php echo app('translator')->get( 'report.tax_report_msg' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('tax_report_location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('tax_report_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('tax_report_contact_id', __( 'report.contact' ) . ':'); ?>

                        <?php echo Form::select('tax_report_contact_id', $contact_dropdown, null , ['class' => 'form-control select2', 'id' => 'tax_report_contact_id', 'placeholder' => __('lang_v1.all'), 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('tax_report_date_range', __('report.date_range') . ':'); ?>

                        <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_tax_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::text('tax_report_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'tax_report_date_range', 'readonly']); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    

    <div class="row">
        <div class="col-12">
            <?php $__env->startComponent('components.widget'); ?>
                <?php $__env->slot('title'); ?>
                    <?php echo e(__('lang_v1.tax_overall'), false); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.tax_overall') . '"></i>';
                }
            ?>
                <?php $__env->endSlot(); ?>
                <h3 class="text-muted">
                    <?php echo e(__('lang_v1.output_tax_minus_input_tax'), false); ?>: 
                    <span class="tax_diff">
                        <i class="fas fa-sync fa-spin fa-fw"></i>
                    </span>
                </h3>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row no-print">
        <div class="col-sm-12 mb-2">
            <button type="button" class="btn btn-primary float-end" id="tax_report_print_btn" aria-label="Print">
                <i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?> A4
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
           <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#input_tax_tab" class="nav-link active pb-2 pe-2 ps-2" data-bs-toggle="tab" aria-expanded="true"><i class="fa fas fa-arrow-circle-up" aria-hidden="true"></i> <?php echo app('translator')->get('report.input_tax'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a href="#output_tax_tab" class="nav-link pb-2 pe-2 ps-2" data-bs-toggle="tab" aria-expanded="true"><i class="fa fas fa-arrow-circle-down" aria-hidden="true"></i> <?php echo app('translator')->get('report.output_tax'); ?></a>
                    </li>

                    <li class="nav-item">
                        <a href="#expense_tax_tab" class="nav-link pb-2 pe-2 ps-2" data-bs-toggle="tab" aria-expanded="true"><i class="fa fas fa-minus-circle" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.expense_tax'); ?></a>
                    </li>
                    <?php if(!empty($tax_report_tabs)): ?>
                        <?php $__currentLoopData = $tax_report_tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tabs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($value['tab_menu_path'])): ?>
                                    <?php
                                        $tab_data = !empty($value['tab_data']) ? $value['tab_data'] : [];
                                    ?>
                                    <?php echo $__env->make($value['tab_menu_path'], $tab_data, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="input_tax_tab">
                        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="input_tax_table">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                                    <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                    <th style="width:350px"><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                    <th><?php echo app('translator')->get('contact.tax_no'); ?></th>
                                    <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                                    <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                    <th class="text-right"><?php echo app('translator')->get('receipt.discount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th class="text-right">
                                            <?php echo e($tax['name'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)
                                        </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="bg-gray font-17 text-center footer-total">
                                    <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                    <td class="text-right"><span id="sell_total"></span></td>
                                    <td class="input_payment_method_count"></td>
                                    <td class="text-right">&nbsp;</td>
                                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td class="text-right">
                                            <span id="total_input_<?php echo e($tax['id'], false); ?>"></span>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </tfoot>
                        </table>
</div>
                    </div>
                    <div class="tab-pane" id="output_tax_tab">
                        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="output_tax_table" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                                    <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                    <th style="width:350px"><?php echo app('translator')->get('contact.customer'); ?></th>
                                    <th><?php echo app('translator')->get('contact.tax_no'); ?></th>
                                    <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                                    <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                    <th class="text-right"><?php echo app('translator')->get('receipt.discount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th class="text-right">
                                            <?php echo e($tax['name'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)
                                        </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="bg-gray font-17 text-center footer-total">
                                    <td colspan="4"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                    <td class="text-right"><span id="purchase_total"></span></td>
                                    <td class="output_payment_method_count"></td>
                                    <td class="text-right">&nbsp;</td>
                                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td class="text-right">
                                            <span id="total_output_<?php echo e($tax['id'], false); ?>"></span>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </tfoot>
                        </table>
</div>
                    </div>
                    <div class="tab-pane" id="expense_tax_tab">
                        <div class="table-responsive">
<table class="table table-bordered table-striped table-th-skin" id="expense_tax_table" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('messages.date'); ?></th>
                                    <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                    <th><?php echo app('translator')->get('contact.tax_no'); ?></th>
                                    <th class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                                    <th><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th class="text-right">
                                            <?php echo e($tax['name'], false); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)
                                        </th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="bg-gray font-17 text-center footer-total">
                                    <td colspan="3"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                    <td class="text-right">
                                        <span id="expense_total"></span>
                                    </td> 
                                    <td class="expense_payment_method_count"></td>
                                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td class="text-right">
                                            <span id="total_expense_<?php echo e($tax['id'], false); ?>"></span>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tr>
                            </tfoot>
                        </table>
</div>
                    </div>
                    <?php if(!empty($tax_report_tabs)): ?>
                        <?php $__currentLoopData = $tax_report_tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tabs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($value['tab_content_path'])): ?>
                                    <?php
                                        $tab_data = !empty($value['tab_data']) ? $value['tab_data'] : [];
                                    ?>
                                    <?php echo $__env->make($value['tab_content_path'], $tab_data, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('report.partials.reports_date_range_setting_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tax_report_date_range').daterangepicker(
            window.getAdminReportDateRangeSettings(),
            function(start, end) {
                $('#tax_report_date_range').val(
                    start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format)
                );
            }
        );
        var taxReportDatePicker = $('#tax_report_date_range').data('daterangepicker');
        if (taxReportDatePicker) {
            $('#tax_report_date_range').val(
                taxReportDatePicker.startDate.format(moment_date_format) + ' ~ ' + taxReportDatePicker.endDate.format(moment_date_format)
            );
        }

        input_tax_table = $('#input_tax_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '/reports/tax-details',
                data: function(d) {
                    d.type = 'purchase';
                    d.location_id = $('#tax_report_location_id').val();
                    d.contact_id = $('#tax_report_contact_id').val();
                    var start = $('input#tax_report_date_range')
                        .data('daterangepicker')
                        .startDate.format('YYYY-MM-DD');
                    var end = $('input#tax_report_date_range')
                        .data('daterangepicker')
                        .endDate.format('YYYY-MM-DD');
                    d.start_date = start;
                    d.end_date = end;
                }
            },
            columns: [
                { data: 'transaction_date', name: 'transaction_date' },
                { data: 'ref_no', name: 'ref_no' },
                { data: 'contact_name', name: 'c.name' },
                { data: 'tax_number', name: 'c.tax_number' },
                { data: 'total_before_tax', name: 'total_before_tax', className: 'text-right' },
                { data: 'payment_methods', orderable: false, "searchable": false},
                { data: 'discount_amount', name: 'discount_amount', className: 'text-right' },
                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                { data: "tax_<?php echo e($tax['id'], false); ?>", searchable: false, orderable: false, className: 'text-right' },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ],
            "footerCallback": function ( row, data, start, end, display ) {
                $('.input_payment_method_count').html(__count_status(data, 'payment_methods'));
            },
            fnDrawCallback: function(oSettings) {
                $('#sell_total').text(
                    __currency_trans_from_en(sum_table_col($('#input_tax_table'), 'total_before_tax'), false)
                );
                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    $("#total_input_<?php echo e($tax['id'], false); ?>").text(
                        __currency_trans_from_en(sum_table_col($('#input_tax_table'), "tax_<?php echo e($tax['id'], false); ?>"), false)
                    );
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                __currency_convert_recursively($('#input_tax_table'));
            },
        });
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            if ($(e.target).attr('href') == '#output_tax_tab') {
                if (typeof (output_tax_datatable) == 'undefined') {
                    output_tax_datatable = $('#output_tax_table').DataTable({
                        processing: true,
                        serverSide: true,
                        aaSorting: [[0, 'desc']],
                        ajax: {
                            url: '/reports/tax-details',
                            data: function(d) {
                                d.type = 'sell';
                                d.location_id = $('#tax_report_location_id').val();
                                d.contact_id = $('#tax_report_contact_id').val();
                                var start = $('input#tax_report_date_range')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                var end = $('input#tax_report_date_range')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.start_date = start;
                                d.end_date = end;
                            }
                        },
                        columns: [
                            { data: 'transaction_date', name: 'transaction_date' },
                            { data: 'invoice_no', name: 'invoice_no' },
                            { data: 'contact_name', name: 'c.name' },
                            { data: 'tax_number', name: 'c.tax_number' },
                            { data: 'total_before_tax', name: 'total_before_tax', className: 'text-right' },
                            { data: 'payment_methods', orderable: false, "searchable": false},
                            { data: 'discount_amount', name: 'discount_amount', className: 'text-right' },
                            <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            { data: "tax_<?php echo e($tax['id'], false); ?>", searchable: false, orderable: false, className: 'text-right' },
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ],
                        "footerCallback": function ( row, data, start, end, display ) {
                            $('.output_payment_method_count').html(__count_status(data, 'payment_methods'));
                        },
                        fnDrawCallback: function(oSettings) {
                            $('#purchase_total').text(
                                __currency_trans_from_en(sum_table_col($('#output_tax_table'), 'total_before_tax'), false)
                            );
                            <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                $("#total_output_<?php echo e($tax['id'], false); ?>").text(
                                    __currency_trans_from_en(sum_table_col($('#output_tax_table'), "tax_<?php echo e($tax['id'], false); ?>"), false)
                                );
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            __currency_convert_recursively($('#output_tax_table'));
                        },
                    });
                }
            } else if ($(e.target).attr('href') == '#expense_tax_tab') {
                if (typeof (expense_tax_datatable) == 'undefined') {
                    expense_tax_datatable = $('#expense_tax_table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: '/reports/tax-details',
                            data: function(d) {
                                d.type = 'expense';
                                d.location_id = $('#tax_report_location_id').val();
                                d.contact_id = $('#tax_report_contact_id').val();
                                var start = $('input#tax_report_date_range')
                                    .data('daterangepicker')
                                    .startDate.format('YYYY-MM-DD');
                                var end = $('input#tax_report_date_range')
                                    .data('daterangepicker')
                                    .endDate.format('YYYY-MM-DD');
                                d.start_date = start;
                                d.end_date = end;
                            }
                        },
                        columns: [
                            { data: 'transaction_date', name: 'transaction_date' },
                            { data: 'ref_no', name: 'ref_no' },
                            { data: 'tax_number', name: 'c.tax_number' },
                            { data: 'total_before_tax', name: 'total_before_tax', className: 'text-right' },
                            { data: 'payment_methods', orderable: false, "searchable": false},
                            <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            { data: "tax_<?php echo e($tax['id'], false); ?>", searchable: false, orderable: false, className: 'text-right' },
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        ],
                        "footerCallback": function ( row, data, start, end, display ) {
                            $('.expense_payment_method_count').html(__count_status(data, 'payment_methods'));
                        },
                        fnDrawCallback: function(oSettings) {
                            $('#expense_total').text(
                                __currency_trans_from_en(sum_table_col($('#expense_tax_table'), 'total_before_tax'), false)
                            );
                            <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                $("#total_expense_<?php echo e($tax['id'], false); ?>").text(
                                    __currency_trans_from_en(sum_table_col($('#expense_tax_table'), "tax_<?php echo e($tax['id'], false); ?>"), false)
                                );
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            __currency_convert_recursively($('#expense_tax_table'));
                        },
                    });
                }
            }
        });
        
        $('#tax_report_date_range, #tax_report_location_id, #tax_report_contact_id').change( function(){
            if ($("#input_tax_tab").hasClass('active')) {
                input_tax_table.ajax.reload();
            }
            if ($("#output_tax_tab").hasClass('active')) {
                output_tax_datatable.ajax.reload();
            }
            if ($("#expense_tax_tab").hasClass('active')) {
                expense_tax_datatable.ajax.reload();
            }
        });
    });
</script>
<?php if(!empty($tax_report_tabs)): ?>
    <?php $__currentLoopData = $tax_report_tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tabs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($value['module_js_path'])): ?>
                <?php echo $__env->make($value['module_js_path'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
<script>
$(document).ready(function(){
    function getActiveTaxReportPrintTab() {
        var activePaneId = $('.nav-tabs-custom .tab-content .tab-pane.active').attr('id') || 'input_tax_tab';
        var tabMap = {
            input_tax_tab: 'input',
            output_tax_tab: 'output',
            expense_tax_tab: 'expense',
            'ouput-tax-project-invoice': 'project_invoice'
        };

        return tabMap[activePaneId] || 'input';
    }

    $('#tax_report_print_btn').on('click', function () {
        var params = {
            tab: getActiveTaxReportPrintTab(),
            location_id: $('#tax_report_location_id').val() || '',
            contact_id: $('#tax_report_contact_id').val() || ''
        };
        var picker = $('#tax_report_date_range').data('daterangepicker');

        if (picker) {
            params.start_date = picker.startDate.format('YYYY-MM-DD');
            params.end_date = picker.endDate.format('YYYY-MM-DD');
        }

        window.open('<?php echo e(url('reports/tax-report-print'), false); ?>?' + $.param(params), '_blank');
    });

    <?php if(!empty($user_settings['rpt_admin_tax_hide_input_date'])): ?>
        input_tax_table.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_input_ref_no'])): ?>
        input_tax_table.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_input_supplier'])): ?>
        input_tax_table.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_input_tax_no'])): ?>
        input_tax_table.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_input_total_amount'])): ?>
        input_tax_table.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_input_payment_method'])): ?>
        input_tax_table.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_input_discount'])): ?>
        input_tax_table.column(6).visible(false);
    <?php endif; ?>

    <?php if(!empty($user_settings['rpt_admin_tax_hide_output_date'])): ?>
        output_tax_datatable.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_output_invoice_no'])): ?>
        output_tax_datatable.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_output_customer'])): ?>
        output_tax_datatable.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_output_tax_no'])): ?>
        output_tax_datatable.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_output_total_amount'])): ?>
        output_tax_datatable.column(4).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_output_payment_method'])): ?>
        output_tax_datatable.column(5).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_output_discount'])): ?>
        output_tax_datatable.column(6).visible(false);
    <?php endif; ?>

    <?php if(!empty($user_settings['rpt_admin_tax_hide_expense_date'])): ?>
        expense_tax_datatable.column(0).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_expense_ref_no'])): ?>
        expense_tax_datatable.column(1).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_expense_tax_no'])): ?>
        expense_tax_datatable.column(2).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_expense_total_amount'])): ?>
        expense_tax_datatable.column(3).visible(false);
    <?php endif; ?>
    <?php if(!empty($user_settings['rpt_admin_tax_hide_expense_payment_method'])): ?>
        expense_tax_datatable.column(4).visible(false);
    <?php endif; ?>
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>