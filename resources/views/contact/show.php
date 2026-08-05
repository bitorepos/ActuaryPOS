
<?php $__env->startSection('title', __('contact.view_contact')); ?>

<?php $__env->startSection('content'); ?>

<!-- Main content -->
<section class="content no-print">
    <div class="row no-print row justify-content-between">
        <div class="col-md-4 float-start">
            <h2> 
                <small>
                    <?php echo app('translator')->get('contact.view_contact'); ?>
                </small>
            </h2>
        </div>
        <div class="col-md-4 col-sm-12 float-end">
            <?php echo Form::select('contact_id', $contact_dropdown, $contact->id , ['class' => 'form-control select2', 'id' => 'contact_id']); ?>

        </div>
    </div>
    <div class="hide print_table_part">
        <style type="text/css">
            .info_col {
                width: 25%;
                float: left;
                padding-left: 10px;
                padding-right: 10px;
            }
            /* Contact tabs horizontal scroll on mobile */
            .contact-tabs-scroll {
                flex-wrap: nowrap;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none; /* Firefox */
                -ms-overflow-style: none; /* IE/Edge */
            }
            .contact-tabs-scroll::-webkit-scrollbar {
                display: none; /* Chrome/Safari */
            }
            .contact-tabs-scroll .nav-item {
                white-space: nowrap;
                flex-shrink: 0;
            }
            /* Ledger format buttons horizontal scroll on mobile */
            .ledger-format-scroll {
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }
            .ledger-format-scroll::-webkit-scrollbar {
                display: none;
            }
            .ledger-format-options {
                display: inline-flex;
                gap: 8px;
                align-items: flex-start;
            }
            .ledger-format-option {
                display: inline-flex;
                flex-direction: column;
                align-items: center;
                gap: 4px;
                min-width: 88px;
            }
            .ledger-format-option .btn {
                width: 100%;
            }
            .ledger-format-default-label {
                margin: 0;
                font-size: 12px;
                font-weight: 400;
                color: #555;
                line-height: 1.2;
                cursor: pointer;
                white-space: nowrap;
            }
            .ledger-format-default-label input {
                margin-top: 0;
                vertical-align: middle;
            }
        </style>
        <div style="width: 100%;">
            <div class="info_col">
                <?php echo $__env->make('contact.contact_basic_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="info_col">
                <?php echo $__env->make('contact.contact_more_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <?php if( $contact->type != 'customer'): ?>
                <div class="info_col">
                    <?php echo $__env->make('contact.contact_tax_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            <?php endif; ?>
            <div class="info_col">
                <?php echo $__env->make('contact.contact_payment_info', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
    <input type="hidden" id="sell_list_filter_customer_id" value="<?php echo e($contact->id, false); ?>">
    <input type="hidden" id="purchase_list_filter_supplier_id" value="<?php echo e($contact->id, false); ?>">
    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <?php echo $__env->make('contact.partials.contact_info_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="d-flex justify-content-end mb-2">
                    <button type="button" class="btn btn-primary" id="print_contact_active_tab">
                        <i class="fas fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                    </button>
                </div>
                <ul class="nav nav-tabs nav-justified contact-tabs-scroll">
                    <li class="nav-item ps-3 pe-3 p-2">
                        <a class="nav-link <?php if(!empty($view_type) &&  $view_type == 'ledger'): ?> active <?php endif; ?>" href="#ledger_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-scroll" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.ledger'); ?></a>
                    </li>
                    <?php if(in_array($contact->type, ['both', 'supplier'])): ?>
                        <li class="nav-item ps-3 pe-3 p-2">
                            <a class="nav-link <?php if(!empty($view_type) &&  $view_type == 'purchase'): ?> active <?php endif; ?>" href="#purchases_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-arrow-circle-down" aria-hidden="true"></i> <?php echo app('translator')->get( 'purchase.purchases'); ?></a>
                        </li>
                        <li class="nav-item ps-3 pe-3 p-2">
                            <a class="nav-link <?php if(!empty($view_type) &&  $view_type == 'stock_report'): ?> active <?php endif; ?>" href="#stock_report_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-hourglass-half" aria-hidden="true"></i> <?php echo app('translator')->get( 'report.stock_report'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(in_array($contact->type, ['both', 'customer'])): ?>
                        <li class="nav-item ps-3 pe-3 p-2">
                            <a class="nav-link <?php if(!empty($view_type) &&  $view_type == 'sales'): ?> active <?php endif; ?>" href="#sales_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-arrow-circle-up" aria-hidden="true"></i> <?php echo app('translator')->get( 'sale.sells'); ?></a>
                        </li>
                        <?php if(in_array('subscription', $enabled_modules)): ?>
                            <li class="nav-item ps-3 pe-3 p-2">
                                <a class="nav-link <?php if(!empty($view_type) &&  $view_type == 'subscriptions'): ?> active <?php endif; ?>" href="#subscriptions_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-recycle" aria-hidden="true"></i> <?php echo app('translator')->get( 'lang_v1.subscriptions'); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="nav-item ps-3 pe-3 p-2">
                        <a class="nav-link <?php if(!empty($view_type) &&  $view_type == 'documents_and_notes'): ?> active <?php endif; ?>" href="#documents_and_notes_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-paperclip" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.documents_and_notes'); ?></a>
                    </li>
                    <li class="nav-item ps-3 pe-3 p-2">
                        <a class="nav-link <?php if(!empty($view_type) &&  $view_type == 'payments'): ?> active <?php endif; ?>" href="#payments_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-money-bill-alt" aria-hidden="true"></i> <?php echo app('translator')->get('sale.payments'); ?></a>
                    </li>

                    <?php if( in_array($contact->type, ['customer', 'both']) && session('business.enable_rp')): ?>
                        <li class="nav-item ps-3 pe-3 p-2">
                            <a class="nav-link <?php if(!empty($view_type) &&  $view_type == 'reward_point'): ?> active <?php endif; ?>" href="#reward_point_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-gift" aria-hidden="true"></i> <?php echo e(session('business.rp_name') ?? __( 'lang_v1.reward_points'), false); ?></a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item ps-3 pe-3 p-2">
                        <a class="nav-link <?php if(!empty($view_type) &&  $view_type == 'activities'): ?> active <?php endif; ?>" href="#activities_tab" data-bs-toggle="tab" role="tab" aria-expanded="true"><i class="fas fa-pen-square" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.activities'); ?></a>
                        </li>

                    <?php if(!empty($contact_view_tabs)): ?>
                        <?php $__currentLoopData = $contact_view_tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tabs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                    <div class="tab-pane fade
                                <?php if(!empty($view_type) &&  $view_type == 'ledger'): ?>
                                    show active
                                <?php else: ?>
                                    ''
                                <?php endif; ?>"
                            id="ledger_tab" role="tabpanel">
                        <?php echo $__env->make('contact.partials.ledger_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <?php if(in_array($contact->type, ['both', 'supplier'])): ?>
                        <div class="tab-pane fade
                            <?php if(!empty($view_type) &&  $view_type == 'purchase'): ?>
                                show active
                            <?php else: ?>
                                ''
                            <?php endif; ?>"
                        id="purchases_tab" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <?php echo Form::label('purchase_list_filter_date_range', __('report.date_range') . ':'); ?>

                                        <?php echo Form::text('purchase_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <label>
                                                <br>
                                              <?php echo Form::checkbox('show_purchase_orders', 1, false, 
                                              [ 'class' => 'form-check-input', 'id' => 'show_purchase_orders']); ?> <?php echo e(__('lang_v1.show_purchase_orders'), false); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="col-md-12 mt-10" id="purchases_table_div">
                                    <?php echo $__env->make('purchase.partials.purchase_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade
                            <?php if(!empty($view_type) &&  $view_type == 'stock_report'): ?>
                                show active
                            <?php else: ?>
                                ''
                            <?php endif; ?>" id="stock_report_tab" role="tabpanel">
                            <?php echo $__env->make('contact.partials.stock_report_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    <?php endif; ?>
                    <?php if(in_array($contact->type, ['both', 'customer'])): ?>
                        <div class="tab-pane fade
                            <?php if(!empty($view_type) &&  $view_type == 'sales'): ?>
                                show active
                            <?php else: ?>
                                ''
                            <?php endif; ?>"
                        id="sales_tab" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <?php $__env->startComponent('components.widget'); ?>
                                    <div class="row">
                                        <?php echo $__env->make('sell.partials.sell_list_filters', ['only' => ['sell_list_filter_payment_status', 'sell_list_filter_date_range', 'only_subscriptions', 'show_quotations']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                    <?php echo $__env->renderComponent(); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" id="sales_table_div">
                                    <?php echo $__env->make('sale_pos.partials.sales_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        </div>
                        <?php if(in_array('subscription', $enabled_modules)): ?>
                            <?php echo $__env->make('contact.partials.subscriptions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="tab-pane fade
                            <?php if(!empty($view_type) &&  $view_type == 'documents_and_notes'): ?>
                                show active
                            <?php else: ?>
                                ''
                            <?php endif; ?>"
                        id="documents_and_notes_tab" role="tabpanel">
                        <?php echo $__env->make('contact.partials.documents_and_notes_tab', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="tab-pane fade
                        <?php if(!empty($view_type) &&  $view_type == 'payments'): ?>
                            show active
                        <?php else: ?>
                            ''
                        <?php endif; ?>" id="payments_tab" role="tabpanel">
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="d-inline-flex align-items-center">
                                    <?php echo app('translator')->get('lang_v1.show'); ?>
                                    <select id="contact_payments_per_page" class="form-select form-select-sm mx-1" style="width:auto;">
                                        <option value="10">10</option>
                                        <option value="25" selected>25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    entries
                                </label>
                            </div>
                            <div class="col-md-4 ms-auto">
                                <input type="text" id="contact_payments_search" class="form-control form-control-sm" placeholder="<?php echo app('translator')->get('messages.search'); ?>...">
                            </div>
                        </div>
                        <div id="contact_payments_div" style="height: 500px;overflow-y: scroll;"></div>
                    </div>
                    <?php if( in_array($contact->type, ['customer', 'both']) && session('business.enable_rp')): ?>
                        <div class="tab-pane fade
                            <?php if(!empty($view_type) &&  $view_type == 'reward_point'): ?>
                                show active
                            <?php else: ?>
                                ''
                            <?php endif; ?>"
                        id="reward_point_tab" role="tabpanel">
                        <br>
                            <div class="row">
                            <?php if($reward_enabled): ?>
                                <div class="col-md-3">
                                    <div class="info-box bg-yellow">
                                        <span class="info-box-icon"><i class="fa fa-gift"></i></span>

                                        <div class="info-box-content">
                                          <span class="info-box-text"><?php echo e(session('business.rp_name'), false); ?></span>
                                          <span class="info-box-number"><?php echo e($contact->total_rp ?? 0, false); ?></span>
                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-th-skin" 
                                    id="rp_log_table" width="100%">
                                        <thead>
                                            <tr>
                                                <th><?php echo app('translator')->get('messages.date'); ?></th>
                                                <th><?php echo app('translator')->get('sale.invoice_no'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.earned'); ?></th>
                                                <th><?php echo app('translator')->get('lang_v1.redeemed'); ?></th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endif; ?>

                    <div class="tab-pane fade
                        <?php if(!empty($view_type) &&  $view_type == 'activities'): ?>
                            show active
                        <?php else: ?>
                            ''
                        <?php endif; ?>"
                        id="activities_tab" role="tabpanel">
                        <?php echo $__env->make('activity_log.activities', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>

                    <?php if(!empty($contact_view_tabs)): ?>
                        <?php $__currentLoopData = $contact_view_tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tabs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

<?php $__env->startSection('modals'); ?>
<div class="modal fade" id="edit_ledger_discount_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade" id="edit_ledger_discount2_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade" id="edit_ledger_discount3_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade" id="contact_print_orientation_modal" tabindex="-1" aria-labelledby="contactPrintOrientationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactPrintOrientationLabel">Page orientation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo app('translator')->get('messages.close'); ?>"></button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-3">Choose the A4 page layout for this print.</p>
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-outline-primary contact-print-orientation-option" data-orientation="portrait">
                        <i class="far fa-file-alt me-1"></i> Portrait
                    </button>
                    <button type="button" class="btn btn-outline-primary contact-print-orientation-option" data-orientation="landscape">
                        <i class="far fa-image me-1"></i> Landscape
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(!$is_offline): ?>
<?php echo $__env->make('ledger_discount.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('ledger_discount2.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('ledger_discount3.create', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="modal fade bulk_add_serial_numbers_modal" id="add_serial_numbers_modal" tabindex="-1" role="dialog">
    <?php echo $__env->make('ledger_discount2.add_serial_numbers_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
var contactLedgerUrl = <?php echo json_encode(action([\App\Http\Controllers\ContactController::class, 'getLedger']), 512) ?>;
var contactLedgerContactId = <?php echo json_encode($contact->id, 15, 512) ?>;
var contactLedgerRequest = null;

$(document).ready( function(){
    var contactPrintUrl = <?php echo json_encode(action([\App\Http\Controllers\ContactController::class, 'printContact'], [$contact->id])) ?>;
    var pendingContactPrintTabId = null;
    var contactPrintOrientationStorageKey = 'contact_print_a4_orientation';

    function getActiveContactTabId() {
        var href = $('.nav-tabs .nav-link.active').attr('href') || '#ledger_tab';
        return href.replace('#', '');
    }

    function addDateRangeToContactPrintParams(params, selector) {
        var $field = $(selector);
        if ($field.length && $field.val() && $field.data('daterangepicker')) {
            params.start_date = $field.data('daterangepicker').startDate.format('YYYY-MM-DD');
            params.end_date = $field.data('daterangepicker').endDate.format('YYYY-MM-DD');
        }
    }

    function cleanContactPrintParams(params) {
        $.each(params, function(key, value) {
            if (value === '' || value === null || typeof value === 'undefined') {
                delete params[key];
            }
        });

        return params;
    }

    function getHiddenContactLedgerColumns() {
        var hiddenColumns = [];
        var format = $('input[name="ledger_format"]:checked').val() || 'format_1';
        var $ledgerTable = $('#ledger_table');

        if (!$ledgerTable.length) {
            return hiddenColumns;
        }

        if ($.fn.DataTable && $.fn.DataTable.isDataTable($ledgerTable[0])) {
            $ledgerTable.DataTable().columns().every(function(columnIndex) {
                if (!this.visible()) {
                    hiddenColumns.push(columnIndex);
                }
            });

            return hiddenColumns;
        }

        var visibility = $ledgerTable.data('contactLedgerVisibility')
            || loadContactLedgerColumnState(format, 'ledger_table', contactLedgerColumnCount($ledgerTable))
            || getContactLedgerDomColumnVisibility($ledgerTable);

        $.each(visibility, function(columnIndex, visible) {
            if (!visible) {
                hiddenColumns.push(columnIndex);
            }
        });

        return hiddenColumns;
    }

    function getContactPrintParams(tabId) {
        var params = {tab: tabId || getActiveContactTabId()};

        if (params.tab === 'ledger_tab') {
            addDateRangeToContactPrintParams(params, '#ledger_date_range');
            params.format = $('input[name="ledger_format"]:checked').val();
            params.location_id = $('#ledger_location').val();
            params.show_paid = $('input#show_paid').is(':checked') ? 'true' : 'false';
            params.hide_acc_summary = $('input#hide_account_summary_front').is(':checked') ? 'true' : 'false';
            params.hide_ageing = $('input#hide_ageing_front').is(':checked') ? 'true' : 'false';
            params.hide_clearing = $('input#hide_clearing').is(':checked') ? 'true' : 'false';
            params.hide_footer = $('input#hide_footer_total_front').is(':checked') ? 'true' : 'false';
            params.hidden_columns = getHiddenContactLedgerColumns();
        } else if (params.tab === 'purchases_tab') {
            addDateRangeToContactPrintParams(params, '#purchase_list_filter_date_range');
            params.show_purchase_orders = $('#show_purchase_orders').is(':checked') ? 1 : 0;
        } else if (params.tab === 'stock_report_tab') {
            params.location_id = $('#sr_location_id').val();
        } else if (params.tab === 'sales_tab') {
            addDateRangeToContactPrintParams(params, '#sell_list_filter_date_range');
            if (params.start_date && params.end_date) {
                var startTime = $('#sell_list_filter_start_time').val() || '00:00';
                var endTime = $('#sell_list_filter_end_time').val() || '23:59';
                var startMoment = moment(params.start_date + ' ' + startTime, 'YYYY-MM-DD ' + moment_time_format);
                var endMoment = moment(params.end_date + ' ' + endTime, 'YYYY-MM-DD ' + moment_time_format);
                params.start_time = startMoment.isValid() ? startMoment.format('HH:mm') : startTime;
                params.end_time = endMoment.isValid() ? endMoment.format('HH:mm') : endTime;
            }
            params.payment_status = $('#sell_list_filter_payment_status').val();
            params.only_subscriptions = $('#only_subscriptions').is(':checked') ? 1 : 0;
            params.show_quotations = $('#show_quotations').is(':checked') ? 1 : 0;
        } else if (params.tab === 'subscriptions_tab') {
            addDateRangeToContactPrintParams(params, '#subscriptions_filter_date_range');
        }

        return cleanContactPrintParams(params);
    }

    function getPreferredContactPrintOrientation() {
        try {
            var storedOrientation = localStorage.getItem(contactPrintOrientationStorageKey);
            if (storedOrientation === 'portrait' || storedOrientation === 'landscape') {
                return storedOrientation;
            }
        } catch (e) {}

        return 'landscape';
    }

    window.openContactPrintPreview = function(tabId, orientation) {
        var params = getContactPrintParams(tabId);
        params.orientation = orientation === 'portrait' ? 'portrait' : 'landscape';
        var query = $.param(params);
        window.open(contactPrintUrl + (query ? '?' + query : ''), '_blank');
    };

    $(document).on('click', '#print_contact_active_tab, #print_contact_active_tab_footer', function(e) {
        e.preventDefault();
        pendingContactPrintTabId = $(this).data('contact-tab') || getActiveContactTabId();

        var preferredOrientation = getPreferredContactPrintOrientation();
        $('#contact_print_orientation_modal .contact-print-orientation-option')
            .removeClass('btn-primary active')
            .addClass('btn-outline-primary')
            .filter('[data-orientation="' + preferredOrientation + '"]')
            .removeClass('btn-outline-primary')
            .addClass('btn-primary active');

        $('#contact_print_orientation_modal').modal('show');
    });

    $(document).on('click', '.contact-print-orientation-option', function() {
        var orientation = $(this).data('orientation') === 'portrait' ? 'portrait' : 'landscape';

        try {
            localStorage.setItem(contactPrintOrientationStorageKey, orientation);
        } catch (e) {}

        $('#contact_print_orientation_modal').modal('hide');
        window.openContactPrintPreview(pendingContactPrintTabId || getActiveContactTabId(), orientation);
        pendingContactPrintTabId = null;
    });

    function getContactLedgerDateRangeSettings() {
        if (typeof window.getAdminReportDateRangeSettings === 'function') {
            return window.getAdminReportDateRangeSettings('#ledger_filter_date_range');
        }

        var ledgerDateRangeSettings = $.extend({}, dateRangeSettings);
        var date_range_default = $('#ledger_filter_date_range').val();

        if(date_range_default == 'today'){
            ledgerDateRangeSettings.startDate = moment();
            ledgerDateRangeSettings.endDate = moment();
        }else if(date_range_default == 'yesterday'){
            ledgerDateRangeSettings.startDate = moment().subtract(1, 'days');
            ledgerDateRangeSettings.endDate = moment().subtract(1, 'days');
        }else if(date_range_default == 'last_seven_days'){
            ledgerDateRangeSettings.startDate = moment().subtract(6,'day');
            ledgerDateRangeSettings.endDate = moment();
        }else if(date_range_default == 'last_thirty_days'){
            ledgerDateRangeSettings.startDate = moment().subtract(29,'day');
            ledgerDateRangeSettings.endDate = moment();
        }else if(date_range_default == 'this_month'){
            ledgerDateRangeSettings.startDate = moment().startOf('month');
            ledgerDateRangeSettings.endDate = moment();
        }else if(date_range_default == 'last_month'){
            ledgerDateRangeSettings.startDate = moment().subtract(1, 'month').startOf('month');
            ledgerDateRangeSettings.endDate = moment().subtract(1, 'month').endOf('month');
        }else if(date_range_default == 'this_year'){
            ledgerDateRangeSettings.startDate = moment().startOf('year');
            ledgerDateRangeSettings.endDate = moment();
        }else if(date_range_default == 'last_year'){
            ledgerDateRangeSettings.startDate = moment().subtract(1, 'year').startOf('year');
            ledgerDateRangeSettings.endDate = moment().subtract(1, 'year').endOf('year');
        }else if(date_range_default == 'current_financial_year' && typeof financial_year !== 'undefined'){
            ledgerDateRangeSettings.startDate = moment(financial_year.start);
            ledgerDateRangeSettings.endDate = moment(financial_year.end);
        }else if(date_range_default == 'all_time'){
            ledgerDateRangeSettings.startDate = moment(business_start_date);
            ledgerDateRangeSettings.endDate = moment();
        }

        return ledgerDateRangeSettings;
    }

    var ledgerDateRangeSettings = getContactLedgerDateRangeSettings();

    $('#ledger_date_range').daterangepicker(
        ledgerDateRangeSettings,
        function (start, end) {
            $('#ledger_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
        }
    );
    var ledgerDateRangePicker = $('#ledger_date_range').data('daterangepicker');
    if (ledgerDateRangePicker) {
        $('#ledger_date_range').val(ledgerDateRangePicker.startDate.format(moment_date_format) + ' ~ ' + ledgerDateRangePicker.endDate.format(moment_date_format));
    }
    $('#ledger_date_range, #ledger_location').change( function(){
        get_contact_ledger();
    });
    get_contact_ledger();

    rp_log_table = $('#rp_log_table').DataTable({
        processing: true,
        serverSide: true,
        aaSorting: [[0, 'desc']],
        ajax: '/sells?customer_id=<?php echo e($contact->id, false); ?>&rewards_only=true',
        columns: [
            { data: 'transaction_date', name: 'transactions.transaction_date'  },
            { data: 'invoice_no', name: 'transactions.invoice_no'},
            { data: 'rp_earned', name: 'transactions.rp_earned'},
            { data: 'rp_redeemed', name: 'transactions.rp_redeemed'},
        ]
    });

    function supplierStockReportValue(value) {
        var $value = $('<div>').html(value || '');
        var origValue = $value.find('[data-orig-value]').first().data('orig-value');

        if (origValue !== undefined && origValue !== '') {
            return parseFloat(origValue) || 0;
        }

        return __number_uf($value.text()) || 0;
    }

    function supplierStockReportPageTotals(api) {
        var totals = {
            purchase_quantity: 0,
            total_quantity_sold: 0,
            total_quantity_transfered: 0,
            total_quantity_returned: 0,
            current_stock: 0,
            stock_price: 0,
        };

        api.rows({ page: 'current' }).data().each(function(row) {
            totals.purchase_quantity += supplierStockReportValue(row.purchase_quantity);
            totals.total_quantity_sold += supplierStockReportValue(row.total_quantity_sold);
            totals.total_quantity_transfered += supplierStockReportValue(row.total_quantity_transfered);
            totals.total_quantity_returned += supplierStockReportValue(row.total_quantity_returned);
            totals.current_stock += supplierStockReportValue(row.current_stock);
            totals.stock_price += supplierStockReportValue(row.stock_price);
        });

        return totals;
    }

    function updateSupplierStockReportFooter(api) {
        var totals = supplierStockReportPageTotals(api);

        $('#supplier_stock_report_table .footer_purchase_quantity').html(__currency_trans_from_en(parseFloat(totals.purchase_quantity || 0), false, false, __currency_precision, true));
        $('#supplier_stock_report_table .footer_total_quantity_sold').html(__currency_trans_from_en(parseFloat(totals.total_quantity_sold || 0), false, false, __currency_precision, true));
        $('#supplier_stock_report_table .footer_total_quantity_transfered').html(__currency_trans_from_en(parseFloat(totals.total_quantity_transfered || 0), false, false, __currency_precision, true));
        $('#supplier_stock_report_table .footer_total_quantity_returned').html(__currency_trans_from_en(parseFloat(totals.total_quantity_returned || 0), false, false, __currency_precision, true));
        $('#supplier_stock_report_table .footer_current_stock').html(__currency_trans_from_en(parseFloat(totals.current_stock || 0), false, false, __currency_precision, true));
        $('#supplier_stock_report_table .footer_stock_price').html(__currency_trans_from_en(parseFloat(totals.stock_price || 0), false));
    }

    var supplier_stock_report_table = $('#supplier_stock_report_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '/contacts/stock-report/<?php echo e($contact->id, false); ?>',
            data: function(d) {
                d.location_id = $('#sr_location_id').val();
            }
        },
        columns: [
            { data: 'sub_sku', name: 'v.sub_sku' },
            { data: 'product_name', name: 'product_name' },
            { data: 'product_unit', name: 'u.short_name' },
            { data: 'purchase_quantity', name: 'purchase_quantity', searchable: false, className: 'text-right' },
            { data: 'total_quantity_sold', name: 'total_quantity_sold', searchable: false, orderable: false, className: 'text-right' },
            { data: 'total_quantity_transfered', name: 'total_quantity_transfered', searchable: false, orderable: false, className: 'text-right' },
            { data: 'total_quantity_returned', name: 'quantity_returned', searchable: false, orderable: false, className: 'text-right' },
            { data: 'current_stock', name: 'current_stock', searchable: false, orderable: false, className: 'text-right' },
            { data: 'stock_price', name: 'stock_price', searchable: false, orderable: false, className: 'text-right' },
        ],
        fnDrawCallback: function() {
            var api = this.api();
            __currency_convert_recursively($('#supplier_stock_report_table'));
            updateSupplierStockReportFooter(api);
        }
    });

    $('#sr_location_id').change( function() {
        supplier_stock_report_table.ajax.reload();
    });

    $('#contact_id').change( function() {
        if ($(this).val()) {
            window.location = "<?php echo e(url('/contacts'), false); ?>/" + $(this).val();
        }
    });

    $('a[href="#sales_tab"]').on('shown.bs.tab', function (e) {
        $('#sales_table_div').find('thead').removeClass('hide');
        sell_table.ajax.reload();
    });

    $('a[href="#purchases_tab"]').on('shown.bs.tab', function (e) {
        $('#purchases_table_div').find('thead').removeClass('hide');
        $('#purchases_table_div').fadeOut(500);
        purchase_table.ajax.reload();
        $('#purchases_table_div').fadeIn(3000);
    });

    $('a[href="#ledger_tab"]').on('shown.bs.tab', function(e){
        $('#purchases_table_div').find('thead').addClass('hide');
        $('#sales_table_div').find('thead').addClass('hide');
    });

    // Update footer buttons on tab switch
    $('.nav-tabs a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
        var tabId = $(e.target).attr('href').replace('#', '');
        if (typeof window.contactViewFooterSetTab === 'function') {
            window.contactViewFooterSetTab(tabId);
        }
        // Hide inline Add button on Documents & Notes tab (moved to footer)
        if (tabId === 'documents_and_notes_tab') {
            $('#documents_and_notes_tab .document_note_body > .table-responsive > .float-end').hide();
        }
    });
    // Also hide on initial load if Documents & Notes tab is active
    $('#documents_and_notes_tab .document_note_body > .table-responsive > .float-end').hide();

    // Payments text search filter
    var paymentsSearchTimer = null;
    $(document).on('keyup', '#contact_payments_search', function() {
        var searchTerm = $(this).val().toLowerCase();
        clearTimeout(paymentsSearchTimer);
        paymentsSearchTimer = setTimeout(function() {
            $('#contact_payments_div .payment-row, #contact_payments_div table tbody tr').each(function() {
                var text = $(this).text().toLowerCase();
                $(this).toggle(text.indexOf(searchTerm) > -1);
            });
        }, 300);
    });

    //Date picker
    $('#discount_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });

    // Enter key on ledger discount amount submits the modal
    $(document).on('keydown', '#add_discount_modal input[name="amount"], #edit_ledger_discount_modal input[name="amount"]', function(e) {
        if (e.which === 13 || e.keyCode === 13) {
            e.preventDefault();
            $(this).closest('form').submit();
        }
    });

    $(document).on('submit', 'form#add_discount_form, form#edit_discount_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var data = form.serialize();

        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success === true) {
                    $('div#add_discount_modal').modal('hide');
                    $('div#edit_ledger_discount_modal').modal('hide');
                    toastr.success(result.msg);
                    form[0].reset();
                    form.find('button[type="submit"]').removeAttr('disabled');
                    get_contact_ledger();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button#view_ledger_discounts_modal', function(e) {
        e.preventDefault();
        let contact_id = $(this).data('contact-id');
        $.ajax({
            url: '/ledger-discount?id='+ contact_id,
            dataType: 'html',
            success: function(result) {
                $('.view_modal').html(result);
                $('.view_modal').modal('show');
            },
        });
    });

    $(document).on('click', 'button.delete_ledger_discount', function() {
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(willDelete => {
            if (willDelete) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'DELETE',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            $('.view_modal').modal('hide');
                            get_contact_ledger();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                    error: function(xhr) {
                        var msg = xhr.responseJSON && xhr.responseJSON.msg
                            ? xhr.responseJSON.msg
                            : (typeof LANG !== 'undefined' && LANG.something_went_wrong
                                ? LANG.something_went_wrong
                                : 'Something went wrong');
                        toastr.error(msg);
                    },
                });
            }
        });
    });
    $(document).on('click', 'button.restore_ledger_discount', function() {
        swal({
            title: LANG.sure,
            icon: 'info',
            buttons: true,
        }).then(willRestore => {
            if (willRestore) {
                var href = $(this).data('href');
                var data = $(this).serialize();

                $.ajax({
                    method: 'GET',
                    url: href,
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if (result.success == true) {
                            toastr.success(result.msg);
                            $('.view_modal').modal('hide');
                            get_contact_ledger();
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                });
            }
        });
    });

    //Add products
    function isLedgerDiscount2SerialEnabled(form) {
        let $form = form && form.length ? form : $('#add_discount2_form, #edit_discount2_form').first();
        return parseInt($form.data('serial-enabled') || 0) === 1;
    }

    function isLedgerDiscount2SerialRequired(form) {
        let $form = form && form.length ? form : $('#add_discount2_form, #edit_discount2_form').first();
        return parseInt($form.data('serial-required') || 0) === 1;
    }

    if ($('#ledger_discount_2_product_search').length > 0) {
        $('#ledger_discount_2_product_search')
            .autocomplete({
                source: function(request, response) {
                    $.getJSON(
                        '/purchases/get_products',
                        { location_id: $('#add_discount2_modal #location_id').val(), term: request.term },
                        response
                    );
                },
                minLength: 2,
                response: function(event, ui) {
                    if (ui.content.length == 1) {
                        ui.item = ui.content[0];
                        $(this)
                            .data('ui-autocomplete')
                            ._trigger('select', 'autocompleteselect', ui);
                        $(this).autocomplete('close');
                    } else if (ui.content.length == 0) {
                        var term = $(this).data('ui-autocomplete').term;
                        toastr.warning('No Product Found with Name :'+term);
                    }
                },
                select: function(event, ui) {
                    $(this).val(null);

                    let product_row_index = $('#ledger_discount_2_product_table tbody tr').length;
                    let row_index = product_row_index++;
                    let form = $(this).closest('form');
                    let serial_cell = isLedgerDiscount2SerialEnabled(form)
                        ? `<td>
                                <button type="button" class="btn btn-sm btn-primary row_add_serial_numbers_btn" data-row_index="${row_index}">Add Serial Nos.</button>
                            </td>`
                        : '';

                    let html = `<tr class="product_row" data-row_index="${row_index}">
                                    <td>${row_index + 1}</td>
                                    <td>
                                        ${ui.item.sku}
                                        <input type="hidden" name="products[${row_index}][product_id]" value="${ui.item.product_id}" class="row_product_id">
                                        <input type="hidden" name="products[${row_index}][variation_id]" value="${ui.item.variation_id}" class="row_variation_id">
                                        <input type="hidden" name="products[${row_index}][name]" value="${ui.item.name}" class="row_product_name">
                                        <input type="hidden" name="products[${row_index}][bulk_serial_numbers]" value="[]" class="row_bulk_serial_numbers">
                                    </td>
                                    ${serial_cell}
                                    <td>${ui.item.name}</td>
                                    <td>
                                        <input type="text" name="products[${row_index}][quantity]" value="1" class="form-control input-sm product_quantity input_number mousetrap" required>
                                    </td>
                                    <td>
                                        <input type="text" name="products[${row_index}][amount]" value="0" class="form-control input-sm product_amount input_number mousetrap" required>
                                    </td>
                                    <td>
                                        <input type="text" name="products[${row_index}][total]" value="0" class="form-control input-sm product_total input_number" readonly>
                                    </td>
                                    <td>
                                        <i class="fa fa-trash bg-danger remove_product_row"></i>
                                    </td>
                                </tr>`;

                    $('#add_discount2_modal #ledger_discount_2_product_table tbody').append(html);

                    updateLedgerDiscount2Totals();
                },
            })
            .autocomplete('instance')._renderItem = function(ul, item) {
            return $('<li>')
                .append('<div>' + item.text + '</div>')
                .appendTo(ul);
        };
    }
    $(document).on('shown.bs.modal', '#add_discount2_modal', function(e){
        $('#add_discount2_modal').find('#discount_date').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });
        $('#add_discount2_modal #ledger_discount_2_product_search').val('').focus();
    })

    // Prevent Enter key on product search from submitting form or opening calendar
    $(document).on('keydown', '#ledger_discount_2_product_search', function(e) {
        if (e.which === 13 || e.keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    // Enter key on adjustment (amount) column submits the modal form
    $(document).on('keydown', '#ledger_discount_2_product_table .product_amount', function(e) {
        if (e.which === 13 || e.keyCode === 13) {
            e.preventDefault();
            $(this).closest('form').submit();
        }
    });

    $(document).on('change keyup', '#ledger_discount_2_product_table input[name^="products"][name$="[quantity]"], #ledger_discount_2_product_table input[name^="products"][name$="[amount]"]', function () {
        let row = $(this).closest('tr');

        let qty = __read_number(row.find('input[name^="products"][name$="[quantity]"]')) || 0;
        let amount = __read_number(row.find('input[name^="products"][name$="[amount]"]')) || 0;

        let total = qty * amount;

        row.find('input[name^="products"][name$="[total]"]').val(__number_f(total));
        updateLedgerDiscount2Totals();
    });

    $(document).on('click', '.remove_product_row', function () {
        $(this).closest('tr').remove();
        $('#ledger_discount_2_product_table tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
        updateLedgerDiscount2Totals();
    });

    let current_serial_no_row_index = 0;
    let serial_no_parent_modal = null;

    $(document).on('click', '.row_add_serial_numbers_btn', function(e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        current_serial_no_row_index = $(this).data('row_index');

        // Track the parent modal so we can re-show it after serial modal closes
        serial_no_parent_modal = $(this).closest('.modal');
        var quantity = __read_number(row.find('input.product_quantity'), false);
        var net_cost = __read_number(row.find('input.product_amount'), false);
        
        let serials_raw = row.find('input.row_bulk_serial_numbers').val() || '[]';
        let serial_numbers = [];

        try {
            serial_numbers = JSON.parse(serials_raw);
        } catch (err) {
            serial_numbers = [];
        }

        let current_length = serial_numbers.length;
        if(current_length > quantity){
            swal({
                title: 'WARNING',
                text: 'Added Serial Numbers are more than Quantity, If not fixed System will not Save',
                icon: 'warning',
                dangerMode: true,
            });
        }
        
        // Update modal title with product name
        let product_name = row.find('input.row_product_name').val();
        $('#add_serial_numbers_modal .modal-title').text(product_name);

        // Update quantities and cost
        $('#add_serial_numbers_modal .add_sr_modal_qty').text(__number_f(quantity));
        $('#add_serial_numbers_modal .add_sr_modal_qty_remain').text(__number_f(quantity - current_length));
        $('#add_serial_numbers_modal .add_sr_modal_current').text(__number_f(current_length));
        $('#add_serial_numbers_modal .add_sr_modal_cost').text(__number_f(net_cost));
        
        // Populate existing serial numbers
        let html = '';
        serial_numbers.forEach((sn, i) => {
            html += `<div class="table_serial_no_row text-center">
                        <div class="col-md-2 bg-gray">${i + 1}</div>
                        <div class="col-md-8 bg-gray">${sn}</div>
                        <div class="col-md-2 bg-gray">
                            <i class="fa fa-trash text-danger remove_serial_row" data-value="${sn}" style="cursor:pointer"></i>
                        </div>
                    </div>`;
        });
        $('#add_serial_numbers_modal #serial_no_table').html(html);

        // Programmatically show the serial numbers modal
        $('#add_serial_numbers_modal').modal('show');

        // Focus after modal opens
        setTimeout(() => {
            $('#add_serial_numbers_modal .add_serial_no_serial_number').focus();
        }, 500);
    });

    $(document).on('keydown', '.add_serial_no_serial_number', function (e) {
        if (e.keyCode !== 13) return;

        e.preventDefault();
        let $input = $(this);
        let value = $input.val().trim();
        if (value === '') return;

        let $table = $($input.data('target')); // e.g. #serial_no_table
        let $row = $(`tr[data-row_index="${current_serial_no_row_index}"]`);

        let quantity = __read_number($row.find('input[name^="products"][name$="[quantity]"]'), false);
        let serialInput = $row.find('input.row_bulk_serial_numbers');

        let serials = [];
        try {
            serials = JSON.parse(serialInput.val()) || [];
        } catch (e) {
            serials = [];
        }

        if (serials.includes(value)) {
            toastr.error('Duplicate serial number not allowed');
            $input.val('').focus();
            return;
        }

        if (serials.length >= quantity) {
            toastr.warning('Cannot add more serials than quantity');
            $input.val('').focus();
            return;
        }

        // Add to serials array and update hidden input
        serials.push(value);
        serialInput.val(JSON.stringify(serials));

        // Update the modal UI table
        let index = serials.length;
        let html = `
            <div class="table_serial_no_row text-center">
                <div class="col-md-2 bg-gray">${index}</div>
                <div class="col-md-8 bg-gray">${value}</div>
                <div class="col-md-2 bg-gray">
                    <i class="fa fa-trash text-danger remove_serial_row" data-value="${value}" style="cursor:pointer"></i>
                </div>
            </div>
        `;
        $table.append(html);

        // Update modal counts
        $('#add_serial_numbers_modal .add_sr_modal_qty_remain').text(__number_f(quantity - serials.length));
        $('#add_serial_numbers_modal .add_sr_modal_current').text(__number_f(serials.length));

        // Clear input
        $input.val('').focus();
    });

    $(document).on('click', '.remove_serial_row', function () {
        let valueToRemove = $(this).data('value');
        let $row = $(`tr[data-row_index="${current_serial_no_row_index}"]`);
        let serialInput = $row.find('input.row_bulk_serial_numbers');
        let serials = [];
        try {
            serials = JSON.parse(serialInput.val()) || [];
        } catch (e) {
            serials = [];
        }
        // Remove the serial
        serials = serials.filter(s => s !== String(valueToRemove));
        serialInput.val(JSON.stringify(serials));
        // Populate existing serial numbers
        let html = '';
        serials.forEach((sn, i) => {
            html += `<div class="table_serial_no_row text-center">
                        <div class="col-md-2 bg-gray">${i + 1}</div>
                        <div class="col-md-8 bg-gray">${sn}</div>
                        <div class="col-md-2 bg-gray">
                            <i class="fa fa-trash text-danger remove_serial_row" data-value="${sn}" style="cursor:pointer"></i>
                        </div>
                    </div>`;
        });
        $('#add_serial_numbers_modal #serial_no_table').html(html);

        let quantity = __read_number($row.find('input[name^="products"][name$="[quantity]"]'), false);
        // Update modal counts
        $('#add_serial_numbers_modal .add_sr_modal_qty_remain').text(__number_f(quantity - serials.length));
        $('#add_serial_numbers_modal .add_sr_modal_current').text(__number_f(serials.length));
    });

    $(document).on('hidden.bs.modal', '#add_serial_numbers_modal', function () {
        // Re-show the parent modal (discount2 create or edit) after serial modal closes
        if (serial_no_parent_modal && serial_no_parent_modal.length) {
            serial_no_parent_modal.modal('show');
            serial_no_parent_modal = null;
        } else {
            // Fallback: clean up backdrop if no parent modal
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        }
    });

    //Date picker
    $('#discount2_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });

    $(document).on('submit', 'form#add_discount2_form, form#edit_discount2_form', function(e) {
        e.preventDefault();
        var form = $(this);
        updateLedgerDiscount2Totals();
        let is_valid = true;
        let error_msg = '';

        if($('#ledger_discount_2_product_table tbody tr.product_row').length < 1){
            is_valid = false;
            error_msg = 'No Products Added';
        }

        if (is_valid && isLedgerDiscount2SerialRequired(form)) {
            $('#ledger_discount_2_product_table tbody tr.product_row').each(function(index) {
                let $row = $(this);
                let quantity = __read_number($row.find('input[name^="products"][name$="[quantity]"]')) || 0;
                let serials_json = $row.find('input.row_bulk_serial_numbers').val();

                let serials = [];
                try {
                    serials = JSON.parse(serials_json || '[]');
                } catch (err) {
                    serials = [];
                }

                if (quantity !== serials.length) {
                    is_valid = false;
                    let product_name = $row.find('input.row_product_name').val() || 'Unnamed Product';
                    error_msg = `Serial numbers mismatch for "${product_name}". Quantity = ${quantity}, Serial Numbers = ${serials.length}`;
                    return false; // break the loop
                }
            });
        }

        if (!is_valid) {
            form.find('button[type="submit"]').removeAttr('disabled');
            toastr.error(error_msg);
            return false; // block form submission
        }

        var data = form.serialize();
        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            success: function(result) {
                if (result.success === true) {
                    $('div#add_discount2_modal').modal('hide');
                    $('div#edit_ledger_discount2_modal').modal('hide');
                    toastr.success(result.msg);
                    form[0].reset();
                    
                    $('div#add_discount2_modal #ledger_discount_2_product_table tbody').empty();
                    $('div#edit_ledger_discount2_modal #ledger_discount_2_product_table tbody').empty();

                    $('.ledger_discount2_total_items').text(__number_f(0));
                    $('.ledger_discount2_total_qty').text(__number_f(0));
                    $('.ledger_discount2_total_amount').text(__currency_trans_from_en(0, false));
                    $('.ledger_discount2_total_amount').attr('data-amount', 0);

                    $('#add_discount2_form #amount').val(0);
                    $('#edit_ledger_discount2_modal #amount').val(0);

                    form.find('button[type="submit"]').removeAttr('disabled');
                    get_contact_ledger();
                } else {
                    toastr.error(result.msg);
                }
            },
        });
    });

    $(document).on('click', 'button#view_ledger_discounts2_modal', function(e) {
        e.preventDefault();
        let contact_id = $(this).data('contact-id');
        $.ajax({
            url: '/ledger-discount2?id='+ contact_id,
            dataType: 'html',
            success: function(result) {
                $('.view_modal').html(result);
                $('.view_modal').modal('show');
            },
        });
    });    

    //Date picker
    $('#discount3_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });

    function preloadLedgerDiscount3Date($modal) {
        var $dateInput = $modal.find('#discount3_date');
        if (!$dateInput.length) {
            return;
        }

        var now = moment();
        if ($dateInput.data('DateTimePicker')) {
            $dateInput.data('DateTimePicker').date(now);
        } else {
            $dateInput.val(now.format(moment_date_format + ' ' + moment_time_format));
        }
    }

    function getPurchasePlaceholder() {
        return (typeof LANG !== 'undefined' && LANG.select_purchase) ? LANG.select_purchase : 'Select Purchases';
    }

    function getLedgerDiscount3Elements($modal) {
        return {
            select: $modal.find('#purchase_ids, #edit_purchase_ids').first(),
            table: $modal.find('#ledger_discount_3_purchase_table, #ledger_discount_3_purchase_table_edit').first(),
            total: $modal.find('.ledger_discount3_total_amount, .ledger_discount3_total_amount_edit').first(),
            location: $modal.find('#location_id, #edit_ld3_location_id').first(),
            contact: $modal.find('#ld3_contact_id, #edit_ld3_contact_id').first(),
        };
    }

    function initLedgerDiscount3PurchaseSelect($modal) {
        var elements = getLedgerDiscount3Elements($modal);
        var $select = elements.select;
        if (!$select.length) {
            return;
        }
        if ($select.data('select2')) {
            $select.select2('destroy');
        }
        $select.select2({
            dropdownParent: $modal,
            width: '100%',
            closeOnSelect: false,
            placeholder: getPurchasePlaceholder(),
        });
    }

    function updateLedgerDiscount3Totals($modal) {
        var elements = getLedgerDiscount3Elements($modal);
        var total = 0;
        elements.table.find('tbody tr').each(function () {
            total += parseFloat($(this).find('.purchase_amount').data('amount')) || 0;
        });
        elements.total.text(__currency_trans_from_en(total, false));
        elements.total.attr('data-amount', total);
        updateLedgerDiscount3Amount($modal);
        setLedgerDiscount3AmountEditable($modal);
    }

    function setLedgerDiscount3AmountEditable($modal) {
        var elements = getLedgerDiscount3Elements($modal);
        var $amountInput = $modal.find('input[name="amount"]');

        if (!$amountInput.length) {
            return;
        }

        var hasPurchases = elements.table.find('tbody tr').length > 0;
        $amountInput.prop('readonly', !hasPurchases);

        if (!hasPurchases) {
            $amountInput.val(0);
        }
    }

    function updateLedgerDiscount3Amount($modal, normalizeInput) {
        normalizeInput = normalizeInput === true;
        var elements = getLedgerDiscount3Elements($modal);
        var totalAmount = parseFloat(elements.total.attr('data-amount')) || 0;
        var $discountInput = $modal.find('input[name="discount_amount"]');
        var $amountInput = $modal.find('input[name="amount"]');

        if (!$discountInput.length || !$amountInput.length) {
            return;
        }

        var rawValue = $.trim($discountInput.val());
        if (rawValue === '') {
            $amountInput.val(0);
            return;
        }

        var percentage = parseFloat(rawValue);
        if (isNaN(percentage)) {
            return;
        }

        var boundedPercentage = percentage;
        if (boundedPercentage < 0) {
            boundedPercentage = 0;
        } else if (boundedPercentage > 100) {
            boundedPercentage = 100;
        }

        if (normalizeInput && boundedPercentage !== percentage) {
            $discountInput.val(boundedPercentage);
        }

        var discountAmount = (totalAmount * boundedPercentage) / 100;
        $amountInput.val(discountAmount.toFixed(2));
    }

    function updateLedgerDiscount3DiscountAmount($modal, normalizeInput) {
        normalizeInput = normalizeInput === true;
        var elements = getLedgerDiscount3Elements($modal);
        var totalAmount = parseFloat(elements.total.attr('data-amount')) || 0;
        var $discountInput = $modal.find('input[name="discount_amount"]');
        var $amountInput = $modal.find('input[name="amount"]');

        if (!$discountInput.length || !$amountInput.length) {
            return;
        }

        var rawValue = $.trim($amountInput.val());
        if (rawValue === '' || totalAmount <= 0) {
            $discountInput.val('');
            return;
        }

        var amountValue = parseFloat(rawValue);
        if (isNaN(amountValue)) {
            return;
        }

        if (amountValue < 0) {
            amountValue = 0;
        }

        if (amountValue > totalAmount) {
            amountValue = totalAmount;
        }

        var percentage = totalAmount ? (amountValue * 100) / totalAmount : 0;
        var boundedPercentage = percentage;
        if (boundedPercentage < 0) {
            boundedPercentage = 0;
        } else if (boundedPercentage > 100) {
            boundedPercentage = 100;
        }

        if (normalizeInput && boundedPercentage !== percentage) {
            amountValue = (totalAmount * boundedPercentage) / 100;
            $amountInput.val(amountValue.toFixed(2));
        }

        $discountInput.val(boundedPercentage.toFixed(4));
    }

    function clearLedgerDiscount3PurchaseTable($modal) {
        var elements = getLedgerDiscount3Elements($modal);
        elements.table.find('tbody').empty();
        updateLedgerDiscount3Totals($modal);
    }

    function renumberLedgerDiscount3Rows($modal) {
        var elements = getLedgerDiscount3Elements($modal);
        elements.table.find('tbody tr').each(function(index) {
            $(this).find('.purchase-row-number').text(index + 1);
        });
    }

    function syncLedgerDiscount3EditSelection($modal) {
        var elements = getLedgerDiscount3Elements($modal);
        var selectedIds = [];

        elements.table.find('tbody tr').each(function () {
            var purchaseId = $(this).data('purchase-id');
            if (purchaseId !== undefined && purchaseId !== null && purchaseId !== '') {
                selectedIds.push(String(purchaseId));
            }
        });

        if (!elements.select.length) {
            return;
        }

        $modal.data('ld3SyncingSelection', true);
        elements.select.find('option').each(function () {
            $(this).prop('selected', selectedIds.indexOf(String($(this).val())) !== -1);
        });
        elements.select.val(selectedIds).trigger('change');
        $modal.removeData('ld3SyncingSelection');
    }

    function get_purchases($modal, options) {
        options = options || {};
        var elements = getLedgerDiscount3Elements($modal);
        var $select = elements.select;
        if (!$select.length) {
            return;
        }

        var location_id = elements.location.val();
        var contact_id = elements.contact.val();

        if (!options.preserveTable) {
            clearLedgerDiscount3PurchaseTable($modal);
        }
        $select.val(null).trigger('change.select2');

        if (!location_id) {
            return;
        }

        var ajaxUrl = '/get-purchases-ld3/' + location_id + '?contact_id=' + contact_id;
        if (options.from_date) {
            ajaxUrl += '&from_date=' + encodeURIComponent(options.from_date);
        }
        if (options.to_date) {
            ajaxUrl += '&to_date=' + encodeURIComponent(options.to_date);
        }
        $.ajax({
            url: ajaxUrl,
            dataType: 'json',
            success: function (data) {
                var selectedIds = [];
                if (options.preselectExisting) {
                    elements.table.find('tbody tr').each(function () {
                        var purchaseId = $(this).data('purchase-id');
                        if (purchaseId !== undefined && purchaseId !== null && purchaseId !== '') {
                            selectedIds.push(String(purchaseId));
                        }
                    });

                    data = $.map(data, function (item) {
                        item.selected = selectedIds.indexOf(String(item.id)) !== -1;
                        return item;
                    });
                }

                initLedgerDiscount3PurchaseSelect($modal);
                $select.select2('destroy').empty().select2({
                    data: data,
                    dropdownParent: $modal,
                    width: '100%',
                    closeOnSelect: false,
                    placeholder: getPurchasePlaceholder(),
                });

                if (options.preselectExisting) {
                    syncLedgerDiscount3EditSelection($modal);
                } else {
                    $select.val(null).trigger('change');
                }

                if (options.autoLoadAll) {
                    elements.table.find('tbody').empty();
                    var autoIds = [];
                    $.each(data, function(i, item) {
                        if (!item.id) { return; }
                        var amount = parseFloat(item.amount || 0);
                        var itemDate = item.transaction_date_formatted || '';
                        var rowIndex = elements.table.find('tbody tr').length + 1;
                        var rowHtml = '<tr data-purchase-id="' + item.id + '">' +
                            '<td><span class="purchase-row-number">' + rowIndex + '</span></td>' +
                            '<td>' + itemDate + '</td>' +
                            '<td>' + item.text + '</td>' +
                            '<td class="purchase_amount" data-amount="' + amount + '">' + __currency_trans_from_en(amount, false) + '</td>' +
                            '<td><button type="button" class="btn btn-sm btn-danger remove_purchase_row" data-purchase-id="' + item.id + '"><i class="fa fa-trash"></i></button></td>' +
                            '</tr>';
                        elements.table.find('tbody').append(rowHtml);
                        autoIds.push(String(item.id));
                    });
                    $select.val(autoIds).trigger('change.select2');
                    updateLedgerDiscount3Totals($modal);
                    if (autoIds.length === 0) {
                        toastr.warning('No invoices found in the selected date range.');
                    }
                }
            },
        });
    }

    $(document).on('shown.bs.modal', '#add_discount3_modal', function() {
        var $modal = $(this);
        preloadLedgerDiscount3Date($modal);
        $modal.find('#ld3_from_date, #ld3_to_date').each(function() {
            if (!$(this).data('DateTimePicker')) {
                $(this).datetimepicker({
                    format: moment_date_format,
                    ignoreReadonly: true,
                });
            }
        });
        initLedgerDiscount3PurchaseSelect($modal);
        get_purchases($modal);
        updateLedgerDiscount3Amount($modal);
        setLedgerDiscount3AmountEditable($modal);
    });

    $(document).on('hidden.bs.modal', '#add_discount3_modal', function() {
        var $modal = $(this);
        // Reset date range pickers
        var $from = $modal.find('#ld3_from_date');
        var $to   = $modal.find('#ld3_to_date');
        if ($from.data('DateTimePicker')) { $from.data('DateTimePicker').clear(); } else { $from.val(''); }
        if ($to.data('DateTimePicker'))   { $to.data('DateTimePicker').clear(); }   else { $to.val(''); }
        // Reset purchase table and totals
        clearLedgerDiscount3PurchaseTable($modal);
        // Reset select2
        var $select = getLedgerDiscount3Elements($modal).select;
        if ($select.length && $select.data('select2')) {
            $select.val(null).trigger('change.select2');
        }
        // Reset discount % and amount inputs
        $modal.find('input[name="discount_amount"]').val('');
        $modal.find('input[name="amount"]').val(0);
        // Reset the form
        $modal.find('#add_discount3_form')[0] && $modal.find('#add_discount3_form')[0].reset();
    });

    $(document).on('shown.bs.modal', '#edit_ledger_discount3_modal', function() {
        var $modal = $(this);
        $('.view_modal').modal('hide');
        $modal.find('#edit_discount3_date').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });
        initLedgerDiscount3PurchaseSelect($modal);
        updateLedgerDiscount3Totals($modal);
        get_purchases($modal, {
            preserveTable: true,
            preselectExisting: true,
        });
    });

    $(document).on('input change', '#add_discount3_modal input[name="discount_amount"]', function() {
        var $modal = $(this).closest('#add_discount3_modal');
        updateLedgerDiscount3Amount($modal);
    });

    $(document).on('blur', '#add_discount3_modal input[name="discount_amount"]', function() {
        var $modal = $(this).closest('#add_discount3_modal');
        updateLedgerDiscount3Amount($modal, true);
    });

    $(document).on('input change', '#edit_ledger_discount3_modal input[name="discount_amount"]', function() {
        var $modal = $(this).closest('#edit_ledger_discount3_modal');
        updateLedgerDiscount3Amount($modal);
    });

    $(document).on('blur', '#edit_ledger_discount3_modal input[name="discount_amount"]', function() {
        var $modal = $(this).closest('#edit_ledger_discount3_modal');
        updateLedgerDiscount3Amount($modal, true);
    });

    $(document).on('input change', '#add_discount3_modal input[name="amount"], #edit_ledger_discount3_modal input[name="amount"]', function() {
        var $modal = $(this).closest('#add_discount3_modal, #edit_ledger_discount3_modal');
        updateLedgerDiscount3DiscountAmount($modal);
    });

    $(document).on('blur', '#add_discount3_modal input[name="amount"], #edit_ledger_discount3_modal input[name="amount"]', function() {
        var $modal = $(this).closest('#add_discount3_modal, #edit_ledger_discount3_modal');
        updateLedgerDiscount3DiscountAmount($modal, true);
    });

    $(document).on('change', '#add_discount3_modal #location_id', function() {
        var $modal = $(this).closest('#add_discount3_modal');
        clearLedgerDiscount3PurchaseTable($modal);
        var $select = getLedgerDiscount3Elements($modal).select;
        if ($select.length) {
            $select.val(null).trigger('change.select2');
        }
        get_purchases($modal);
    });

    $(document).on('click', '#add_discount3_modal #load_ld3_invoices', function() {
        var $modal = $(this).closest('#add_discount3_modal');
        var from_date = $modal.find('#ld3_from_date').val();
        var to_date   = $modal.find('#ld3_to_date').val();
        if (!from_date || !to_date) {
            toastr.warning('Please select both From Date and To Date.');
            return;
        }
        get_purchases($modal, {
            autoLoadAll: true,
            from_date: from_date,
            to_date: to_date,
        });
    });

    $(document).on('change', '#edit_ledger_discount3_modal #edit_ld3_location_id', function() {
        var $modal = $(this).closest('#edit_ledger_discount3_modal');
        clearLedgerDiscount3PurchaseTable($modal);
        var $select = getLedgerDiscount3Elements($modal).select;
        if ($select.length) {
            $select.val(null).trigger('change.select2');
        }
        get_purchases($modal);
    });

    $(document).on('select2:select', '#add_discount3_modal #purchase_ids, #edit_ledger_discount3_modal #edit_purchase_ids', function (e) {
        var $modal = $(this).closest('#add_discount3_modal, #edit_ledger_discount3_modal');
        var data = e.params.data;
        if (!data || !data.id) {
            return;
        }

        var elements = getLedgerDiscount3Elements($modal);
        if (elements.table.find('tbody tr[data-purchase-id="' + data.id + '"]').length) {
            return;
        }

        var amount = parseFloat(data.amount || 0);
        var rowDate = data.transaction_date_formatted || '';
        var rowIndex = elements.table.find('tbody tr').length + 1;
        var rowHtml = '<tr data-purchase-id="' + data.id + '">' +
            '<td><span class="purchase-row-number">' + rowIndex + '</span></td>' +
            '<td>' + rowDate + '</td>' +
            '<td>' + data.text + '</td>' +
            '<td class="purchase_amount" data-amount="' + amount + '">' + __currency_trans_from_en(amount, false) + '</td>' +
            '<td><button type="button" class="btn btn-sm btn-danger remove_purchase_row" data-purchase-id="' + data.id + '"><i class="fa fa-trash"></i></button></td>' +
            '</tr>';
        elements.table.find('tbody').append(rowHtml);
        updateLedgerDiscount3Totals($modal);
    });

    $(document).on('select2:unselect', '#add_discount3_modal #purchase_ids, #edit_ledger_discount3_modal #edit_purchase_ids', function (e) {
        var $modal = $(this).closest('#add_discount3_modal, #edit_ledger_discount3_modal');
        var data = e.params.data;
        if (!data || !data.id) {
            return;
        }

        if ($modal.data('ld3SyncingSelection')) {
            return;
        }

        var elements = getLedgerDiscount3Elements($modal);
        elements.table.find('tbody tr[data-purchase-id="' + data.id + '"]').remove();
        renumberLedgerDiscount3Rows($modal);
        updateLedgerDiscount3Totals($modal);
    });

    $(document).on('click', '#add_discount3_modal .remove_purchase_row, #edit_ledger_discount3_modal .remove_purchase_row', function () {
        var $modal = $(this).closest('#add_discount3_modal, #edit_ledger_discount3_modal');
        var purchase_id = $(this).data('purchase-id');
        var elements = getLedgerDiscount3Elements($modal);
        var $select = elements.select;
        var selected = $select.val() || [];
        selected = selected.filter(function (value) {
            return value != purchase_id;
        });
        $select.val(selected).trigger('change.select2');
        elements.table.find('tbody tr[data-purchase-id="' + purchase_id + '"]').remove();
        renumberLedgerDiscount3Rows($modal);
        updateLedgerDiscount3Totals($modal);
    });

    $(document).on('click', '#add_discount3_modal form#add_discount3_form button[type="submit"], #edit_ledger_discount3_modal form#edit_discount3_form button[type="submit"]', function() {
        var shouldReindex = $(this).attr('data-reindex-after-submit') === '1' ? 1 : 0;
        $(this).closest('form').find('input[name="reindex_after_submit"]').val(shouldReindex);
    });

    $(document).on('submit', 'form#add_discount3_form, form#edit_discount3_form', function(e) {
        e.preventDefault();
        var form = $(this);
        var $modal = form.closest('#add_discount3_modal, #edit_ledger_discount3_modal');
        updateLedgerDiscount3Amount($modal, true);
        let is_valid = true;
        let error_msg = '';

        if(form.find('#ledger_discount_3_purchase_table tbody tr, #ledger_discount_3_purchase_table_edit tbody tr').length < 1){
            is_valid = false;
            error_msg = 'No Purchases Added';
        }

        if (!is_valid) {
            form.find('button[type="submit"]').removeAttr('disabled');
            form.find('input[name="reindex_after_submit"]').val(0);
            toastr.error(error_msg);
            return false; // block form submission
        }

        var shouldReindex = form.find('input[name="reindex_after_submit"]').val() == '1';
        var data = form.serialize();
        $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            dataType: 'json',
            data: data,
            beforeSend: function() {
                form.find('button[type="submit"]').prop('disabled', true);
                if (shouldReindex) {
                    swal({
                        title: 'Processing',
                        text: 'Saving LD3 and reindexing selected purchase invoices. Please wait...',
                        icon: 'info',
                        buttons: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    });
                }
            },
            complete: function() {
                if (shouldReindex) {
                    swal.close();
                }
                form.find('button[type="submit"]').removeAttr('disabled');
                form.find('input[name="reindex_after_submit"]').val(0);
            },
            success: function(result) {
                if (result.success === true) {
                    $('div#add_discount3_modal').modal('hide');
                    $('div#edit_ledger_discount3_modal').modal('hide');
                    toastr.success(result.msg);
                    form[0].reset();
                    
                    $('div#add_discount3_modal #ledger_discount_3_purchase_table tbody').empty();
                    $('div#edit_ledger_discount3_modal #ledger_discount_3_purchase_table_edit tbody').empty();

                    $('.ledger_discount3_total_amount').text(__currency_trans_from_en(0, false));
                    $('.ledger_discount3_total_amount').attr('data-amount', 0);

                    $('#add_discount3_form #discount_amount').val(1);
                    $('#add_discount3_form #amount').val(0);

                    get_contact_ledger();
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function() {
                toastr.error('Request Failed - Nothing Happened');
            },
        });
    });

    $(document).on('click', 'button#view_ledger_discounts3_modal', function(e) {
        e.preventDefault();
        let contact_id = $(this).data('contact-id');
        $.ajax({
            url: '/ledger-discount3?id='+ contact_id,
            dataType: 'html',
            success: function(result) {
                $('.view_modal').html(result);
                $('.view_modal').modal('show');
            },
        });
    });    

});

function updateLedgerDiscount2Totals(){
    let total_qty = 0;
    let total_amount = 0;
    let total_items = $('#ledger_discount_2_product_table tbody tr').length;

    $('#ledger_discount_2_product_table tbody tr').each(function () {
        let qty = __read_number($(this).find('input[name^="products"][name$="[quantity]"]')) || 0;
        let amount = __read_number($(this).find('input[name^="products"][name$="[total]"]')) || 0;
        total_qty += qty;
        total_amount += amount;
    });

    $('.ledger_discount2_total_items').text(__number_f(total_items));
    $('.ledger_discount2_total_qty').text(__number_f(total_qty));
    $('.ledger_discount2_total_amount').text(__currency_trans_from_en(total_amount, false));
    $('#add_discount2_form #amount').val(total_amount);
    $('#edit_discount2_form #amount').val(total_amount);
}

$(document).on('shown.bs.modal', '#edit_ledger_discount_modal', function(e){
    $('.view_modal').modal('hide');
    $('#edit_ledger_discount_modal').find('#edit_discount_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });
})

$(document).on('shown.bs.modal', '#edit_ledger_discount2_modal', function(e){
    $('.view_modal').modal('hide');
    $('#edit_ledger_discount2_modal').find('#edit_discount_date').datetimepicker({
        format: moment_date_format + ' ' + moment_time_format,
        ignoreReadonly: true,
    });
    $('#ledger_discount_2_product_search')
        .autocomplete({
            source: function(request, response) {
                $.getJSON(
                    '/purchases/get_products',
                    { location_id: $('#edit_discount2_form #location_id').val(), term: request.term },
                    response
                );
            },
            minLength: 2,
            response: function(event, ui) {
                if (ui.content.length == 1) {
                    ui.item = ui.content[0];
                    $(this)
                        .data('ui-autocomplete')
                        ._trigger('select', 'autocompleteselect', ui);
                    $(this).autocomplete('close');
                } else if (ui.content.length == 0) {
                    var term = $(this).data('ui-autocomplete').term;
                    toastr.warning('No Product Found with Name :'+term);
                }
            },
            select: function(event, ui) {
                $(this).val(null);

                let product_row_index = $('#ledger_discount_2_product_table tbody tr').length;
                let row_index = product_row_index++;
                let form = $(this).closest('form');
                let serial_cell = isLedgerDiscount2SerialEnabled(form)
                    ? `<td>
                            <button type="button" class="btn btn-sm btn-primary row_add_serial_numbers_btn" data-bs-toggle="modal" data-row_index="${row_index}" data-bs-target="#add_serial_numbers_modal">Add Serial Nos.</button>
                        </td>`
                    : '';

                let html = `<tr class="product_row" data-row_index="${row_index}">
                                <td>${row_index + 1}</td>
                                <td>
                                    ${ui.item.sku}
                                    <input type="hidden" name="products[${row_index}][product_id]" value="${ui.item.product_id}" class="row_product_id">
                                    <input type="hidden" name="products[${row_index}][variation_id]" value="${ui.item.variation_id}" class="row_variation_id">
                                    <input type="hidden" name="products[${row_index}][name]" value="${ui.item.name}" class="row_product_name">
                                    <input type="hidden" name="products[${row_index}][bulk_serial_numbers]" value="[]" class="row_bulk_serial_numbers">
                                </td>
                                ${serial_cell}
                                <td>${ui.item.name}</td>
                                <td>
                                    <input type="text" name="products[${row_index}][quantity]" value="1" class="form-control input-sm product_quantity input_number mousetrap" required>
                                </td>
                                <td>
                                    <input type="text" name="products[${row_index}][amount]" value="0" class="form-control input-sm product_amount input_number mousetrap" required>
                                </td>
                                <td>
                                    <input type="text" name="products[${row_index}][total]" value="0" class="form-control input-sm product_total input_number" readonly>
                                </td>
                                <td>
                                    <i class="fa fa-trash bg-danger remove_product_row"></i>
                                </td>
                            </tr>`;

                $('#edit_discount2_form #ledger_discount_2_product_table tbody').append(html);

                updateLedgerDiscount2Totals();
            },
        })
        .autocomplete('instance')._renderItem = function(ul, item) {
        return $('<li>')
            .append('<div>' + item.text + '</div>')
            .appendTo(ul);
    };
});

$(document).on('hidden.bs.modal', '#edit_ledger_discount2_modal', function(e){
    $('div#edit_discount2_form #ledger_discount_2_product_table tbody').empty();
});

$('input.transaction_types, input#show_payments').on('change', function (e) {
    get_contact_ledger();
});

$(document).on('change', 'input#show_paid', function(){
    get_contact_ledger();
})

function syncContactLedgerSummaryVisibility() {
    var $summaryToggle = $('#hide_account_summary_front');
    var $summaryBlocks = $('#account_summary_div, .account-summary-div');

    if (!$summaryToggle.length || !$summaryBlocks.length) {
        return;
    }

    $summaryBlocks.toggle(!$summaryToggle.is(':checked'));
}

$(document).on('change', 'input#hide_account_summary_front', function(){
    syncContactLedgerSummaryVisibility();
})

$(document).on('change', 'input#hide_acc_summary', function(){
    get_contact_ledger();
})
$(document).on('change', 'input#hide_ageing', function(){
    get_contact_ledger();
})
$(document).on('change', 'input#hide_footer', function(){
    get_contact_ledger();
})
$(document).on('change', 'input[name="ledger_format"]', function(){
    get_contact_ledger();
})

$(document).on('change', '.ledger-format-default-checkbox', function(){
    var $checkbox = $(this);
    var $container = $checkbox.closest('.ledger-format-options');
    var previousDefault = $container.data('default-format') || 'format_1';
    var previousSelected = $('input[name="ledger_format"]:checked').val() || previousDefault;
    var format = $checkbox.val();

    if (!$checkbox.is(':checked')) {
        $checkbox.prop('checked', true);
        return;
    }

    $container.find('.ledger-format-default-checkbox').not($checkbox).prop('checked', false);
    $('input[name="ledger_format"][value="' + format + '"]').prop('checked', true);
    $container.find('.ledger-format-default-checkbox').prop('disabled', true);

    $.ajax({
        url: $container.data('default-url'),
        method: 'POST',
        dataType: 'json',
        data: {
            contact_id: contactLedgerContactId,
            format: format,
            contact_type: $('#ledger_contact_type').val()
        },
        success: function(result) {
            if (result && result.success) {
                $container.data('default-format', format);
                if (typeof toastr !== 'undefined') {
                    toastr.success(result.msg);
                }
                get_contact_ledger();
            }
        },
        error: function(xhr) {
            $container.find('.ledger-format-default-checkbox').prop('checked', false);
            $container.find('.ledger-format-default-checkbox[value="' + previousDefault + '"]').prop('checked', true);
            $('input[name="ledger_format"][value="' + previousSelected + '"]').prop('checked', true);

            var message = (xhr.responseJSON && xhr.responseJSON.msg)
                || (xhr.responseJSON && xhr.responseJSON.message)
                || (typeof LANG !== 'undefined' && LANG.something_went_wrong ? LANG.something_went_wrong : 'Something went wrong');

            if (typeof toastr !== 'undefined') {
                toastr.error(message);
            }
        },
        complete: function() {
            $container.find('.ledger-format-default-checkbox').prop('disabled', false);
        },
    });
})

$(document).one('shown.bs.tab', 'a[href="#payments_tab"]', function(){
    get_contact_payments();
})

$(document).on('click', '#contact_payments_pagination a', function(e){
    e.preventDefault();
    get_contact_payments($(this).attr('href'));
})

$(document).on('change', '#contact_payments_per_page', function(){
    get_contact_payments();
})

$(document).on('click', '.toggle_cp_payment', function(){
    var target = $(this).data('bs-target');
    var $icon = $(this).find('.fa-plus-circle, .fa-minus-circle');
    $('tr.' + CSS.escape(target)).toggleClass('hide');
    $icon.toggleClass('fa-plus-circle fa-minus-circle');
})

function get_contact_payments(url = null) {
    if (!url) {
        url = "<?php echo e(action([\App\Http\Controllers\ContactController::class, 'getContactPayments'], [$contact->id]), false); ?>";
    }
    var per_page = $('#contact_payments_per_page').val() || 25;
    var separator = url.indexOf('?') !== -1 ? '&' : '?';
    url = url + separator + 'per_page=' + per_page;
    $.ajax({
        url: url,
        dataType: 'html',
        success: function(result) {
            $('#contact_payments_div').fadeOut(400, function(){
                $('#contact_payments_div')
                .html(result).fadeIn(400);
            });
        },
    });
}

function contactLedgerColumnStateKey(format, tableId) {
    return 'DataTables_contact_ledger_columns_' + contactLedgerContactId + '_' + format + '_' + tableId;
}

function contactLedgerLegacyStateKey(format) {
    return 'DataTables_contact_ledger_' + contactLedgerContactId + '_' + format;
}

function contactLedgerColumnCount($table) {
    return $table.find('thead tr:first th').length;
}

function contactLedgerColumnVisibilityText() {
    return (typeof LANG !== 'undefined' && LANG.col_vis) ? LANG.col_vis : 'Column visibility';
}

function loadContactLedgerColumnState(format, tableId, columnCount) {
    var savedState = null;

    try {
        savedState = JSON.parse(localStorage.getItem(contactLedgerColumnStateKey(format, tableId)));
    } catch (e) {
        savedState = null;
    }

    if (savedState && $.isArray(savedState.columns) && savedState.columns.length === columnCount) {
        return savedState.columns;
    }

    if (tableId === 'ledger_table') {
        try {
            var legacyState = JSON.parse(localStorage.getItem(contactLedgerLegacyStateKey(format)));
            if (legacyState && $.isArray(legacyState.columns) && legacyState.columns.length === columnCount) {
                return $.map(legacyState.columns, function(column) {
                    return column.visible !== false;
                });
            }
        } catch (e) {}
    }

    return null;
}

function saveContactLedgerColumnState(api, format, tableId) {
    var visibility = [];

    api.columns().every(function(columnIndex) {
        visibility.push(api.column(columnIndex).visible());
    });

    saveContactLedgerColumnVisibility(format, tableId, visibility);
}

function saveContactLedgerColumnVisibility(format, tableId, visibility) {
    if (!visibility) {
        return;
    }

    try {
        localStorage.setItem(contactLedgerColumnStateKey(format, tableId), JSON.stringify({
            columns: visibility,
            saved_at: new Date().toISOString()
        }));
    } catch (e) {}
}

function applyContactLedgerColumnState(api, visibility) {
    if (!visibility) {
        return;
    }

    $.each(visibility, function(columnIndex, visible) {
        api.column(columnIndex).visible(visible, false);
    });

    api.columns.adjust().draw(false);
}

function getContactLedgerDomColumnVisibility($table) {
    var visibility = [];

    $table.find('thead tr:first th').each(function() {
        var $header = $(this);
        visibility.push(!$header.hasClass('hide') && $header.css('display') !== 'none');
    });

    return visibility;
}

function contactLedgerVisibleColumnCount(visibility) {
    var visibleCount = 0;

    $.each(visibility, function(columnIndex, visible) {
        if (visible) {
            visibleCount++;
        }
    });

    return visibleCount;
}

function contactLedgerAdjustFullSpanRows($table, visibility) {
    var visibleCount = Math.max(contactLedgerVisibleColumnCount(visibility), 1);

    $table.find('tbody tr, tfoot tr').each(function() {
        var $cells = $(this).children('th, td');

        if ($cells.length === 1 && (parseInt($cells.first().attr('colspan'), 10) || 1) > 1) {
            $cells.first().attr('colspan', visibleCount);
        }
    });
}

function setContactLedgerDomColumnVisibility($table, columnIndex, visible) {
    $table.find('tr').each(function() {
        var logicalIndex = 0;

        $(this).children('th, td').each(function() {
            var $cell = $(this);
            var colspan = parseInt($cell.attr('colspan'), 10) || 1;
            var rowspan = parseInt($cell.attr('rowspan'), 10) || 1;

            if (colspan === 1 && rowspan === 1 && logicalIndex === columnIndex) {
                if (visible) {
                    $cell.removeClass('hide').show();
                } else {
                    $cell.hide();
                }
            }

            logicalIndex += colspan;
        });
    });
}

function applyContactLedgerDomColumnState($table, visibility) {
    if (!visibility) {
        return;
    }

    $.each(visibility, function(columnIndex, visible) {
        setContactLedgerDomColumnVisibility($table, columnIndex, visible);
    });

    contactLedgerAdjustFullSpanRows($table, visibility);
    $table.data('contactLedgerVisibility', visibility);
}

function syncContactLedgerDomTableVisibility($sourceTable, $targetTable, format) {
    var visibility = $sourceTable.data('contactLedgerVisibility');

    if (!$targetTable.length || !visibility || visibility.length !== contactLedgerColumnCount($targetTable)) {
        return;
    }

    applyContactLedgerDomColumnState($targetTable, visibility.slice());
    saveContactLedgerColumnVisibility(format, $targetTable.attr('id'), visibility);
}

function contactLedgerTableHasComplexBodyRows($table) {
    return $table.find('tbody td[colspan], tbody th[colspan], tbody td[rowspan], tbody th[rowspan]').length > 0;
}

function buildContactLedgerManualColumnButton($table, format) {
    var tableId = $table.attr('id');
    var visibility = $table.data('contactLedgerVisibility') || getContactLedgerDomColumnVisibility($table);
    var $toolbarTarget = $('#contact_ledger_div .contact-ledger-column-buttons').first();

    if (!$toolbarTarget.length) {
        return;
    }

    var $buttonGroup = $('<div class="btn-group contact-ledger-manual-colvis"></div>');
    var $button = $(
        '<button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
            '<i class="fa fa-columns" aria-hidden="true"></i> ' + contactLedgerColumnVisibilityText() +
        '</button>'
    );
    var $menu = $('<div class="dropdown-menu dropdown-menu-right p-2" style="max-height: 320px; overflow-y: auto;"></div>');

    $table.find('thead tr:first th').each(function(columnIndex) {
        var label = $.trim($(this).text().replace(/\s+/g, ' ')) || ('Column ' + (columnIndex + 1));
        var checkboxId = 'contact_ledger_col_' + tableId + '_' + columnIndex;
        var $item = $(
            '<label class="dropdown-item mb-0" for="' + checkboxId + '">' +
                '<input type="checkbox" class="contact-ledger-column-toggle me-1" id="' + checkboxId + '" data-column-index="' + columnIndex + '"> ' +
                $('<div>').text(label).html() +
            '</label>'
        );

        $item.find('input').prop('checked', visibility[columnIndex] !== false);
        $menu.append($item);
    });

    $menu.on('click', function(e) {
        e.stopPropagation();
    });

    $menu.on('change', '.contact-ledger-column-toggle', function() {
        var $checkbox = $(this);
        var columnIndex = parseInt($checkbox.data('column-index'), 10);
        var visible = $checkbox.is(':checked');
        var nextVisibility = visibility.slice();

        nextVisibility[columnIndex] = visible;

        if (!visible && contactLedgerVisibleColumnCount(nextVisibility) < 1) {
            $checkbox.prop('checked', true);
            return;
        }

        visibility = nextVisibility;
        applyContactLedgerDomColumnState($table, visibility);
        saveContactLedgerColumnVisibility(format, tableId, visibility);
        syncContactLedgerDomTableVisibility($table, $('#ledger_table_converted'), format);
    });

    $buttonGroup.append($button).append($menu);
    $toolbarTarget.empty().append($buttonGroup);
}

function initContactLedgerManualColumnVisibility($table, format, withButtons) {
    if (!$table.length) {
        return null;
    }

    var tableId = $table.attr('id');
    var savedVisibility = loadContactLedgerColumnState(format, tableId, contactLedgerColumnCount($table));
    var visibility = savedVisibility || getContactLedgerDomColumnVisibility($table);

    applyContactLedgerDomColumnState($table, visibility);
    saveContactLedgerColumnVisibility(format, tableId, visibility);

    if (withButtons) {
        buildContactLedgerManualColumnButton($table, format);
    }

    return {
        visibility: visibility
    };
}

function syncContactLedgerTableVisibility(sourceApi, targetApi) {
    if (!sourceApi || !targetApi || typeof sourceApi.columns !== 'function' || typeof targetApi.columns !== 'function' || sourceApi.columns().count() !== targetApi.columns().count()) {
        return;
    }

    sourceApi.columns().every(function(columnIndex) {
        targetApi.column(columnIndex).visible(this.visible(), false);
    });

    targetApi.columns.adjust().draw(false);
}

function initContactLedgerDataTable($table, format, withButtons) {
    if (!$table.length) {
        return null;
    }

    if ($.fn.DataTable.isDataTable($table[0])) {
        $table.DataTable().destroy();
    }

    var tableId = $table.attr('id');
    var savedVisibility = loadContactLedgerColumnState(format, tableId, contactLedgerColumnCount($table));
    var buttonConfig = [];

    if (withButtons) {
        buttonConfig = [
            {
                extend: 'colvis',
                text: '<i class="fa fa-columns" aria-hidden="true"></i> ' +
                    contactLedgerColumnVisibilityText(),
                className: 'btn-sm btn-secondary'
            },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel" aria-hidden="true"></i> ' + LANG.export_to_excel,
                className: 'btn-sm hide',
                exportOptions: {
                    columns: ':visible'
                },
                action: function (e, dt, button, config) {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(this, e, dt, button, config);
                }
            }
        ];
    }

    var dataTable = null;

    try {
        dataTable = $table.DataTable({
            searching: false,
            ordering: false,
            paging: false,
            deferRender: true,
            autoWidth: false,
            stateSave: false,
            dom: withButtons ? 'Bt' : 't',
            buttons: buttonConfig,
            initComplete: function () {
                var api = this.api();

                applyContactLedgerColumnState(api, savedVisibility);
                saveContactLedgerColumnState(api, format, tableId);

                if (withButtons) {
                    var $buttonContainer = $(api.buttons().container());
                    var $toolbarTarget = $('#contact_ledger_div .contact-ledger-column-buttons').first();

                    if ($toolbarTarget.length) {
                        $buttonContainer.appendTo($toolbarTarget);
                    }

                    $buttonContainer.find('.buttons-excel').attr('id', 'ledger_dt_exportExcelBtn');
                }
            }
        });
    } catch (e) {
        if (window.console) {
            console.warn('Contact ledger DataTable init failed; using manual column visibility.', e);
        }
        return null;
    }

    $table
        .off('column-visibility.dt.contactLedgerState')
        .on('column-visibility.dt.contactLedgerState', function () {
            saveContactLedgerColumnState(dataTable, format, tableId);
        });

    return dataTable;
}

function initContactLedgerDataTables(format) {
    var $mainTable = $('#ledger_table');
    var $convertedTable = $('#ledger_table_converted');

    if (!$mainTable.length) {
        return;
    }

    var mainTable = null;
    var convertedTable = null;

    if ($.fn.DataTable && !contactLedgerTableHasComplexBodyRows($mainTable)) {
        mainTable = initContactLedgerDataTable($mainTable, format, true);
    }

    if (!mainTable) {
        initContactLedgerManualColumnVisibility($mainTable, format, true);
        initContactLedgerManualColumnVisibility($convertedTable, format, false);
        syncContactLedgerDomTableVisibility($mainTable, $convertedTable, format);
        return;
    }

    if ($.fn.DataTable && !contactLedgerTableHasComplexBodyRows($convertedTable)) {
        convertedTable = initContactLedgerDataTable($convertedTable, format, false);
    } else {
        initContactLedgerManualColumnVisibility($convertedTable, format, false);
    }

    syncContactLedgerTableVisibility(mainTable, convertedTable);

    $mainTable
        .off('column-visibility.dt.contactLedgerSync')
        .on('column-visibility.dt.contactLedgerSync', function () {
            syncContactLedgerTableVisibility(mainTable, convertedTable);

            if (convertedTable) {
                saveContactLedgerColumnState(convertedTable, format, 'ledger_table_converted');
            }
        });
}

function get_contact_ledger(page = 1) {

    var start_date = '';
    var end_date = '';
    var transaction_types = $('input.transaction_types:checked').map(function(i, e) {return e.value}).toArray();
    var show_payments = $('input#show_payments').is(':checked');
    var location_id = $('#ledger_location').val();
    var show_paid = $('input#show_paid').is(':checked');

    if($('#ledger_date_range').val()) {
        start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
        end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
    }

    var format = $('input[name="ledger_format"]:checked').val();
    if(format == 'format_2'){
        $('#ledger_filter_date_range').closest('.form-group').addClass('hide');
        start_date = null;
        end_date = null;
    }else{
        $('#ledger_filter_date_range').closest('.form-group').removeClass('hide');
    }
    
    // Hide DataTable Excel export button for format_4 (has its own export in the view)
    if(format == 'format_4'){
        $('#export_ledger_excel').addClass('hide');
    }else{
        $('#export_ledger_excel').removeClass('hide');
    }
    
    var data = {
        contact_id: contactLedgerContactId,
        ledger_page: page,
        ledger_per_page: 500,
        start_date: start_date,
        transaction_types: transaction_types,
        show_payments: show_payments,
        end_date: end_date,
        format: format,
        location_id: location_id,
        show_paid : show_paid,
    }
    if (contactLedgerRequest && contactLedgerRequest.readyState !== 4) {
        contactLedgerRequest.abort();
    }

    $('#contact_ledger_div').html(
        '<div class="col-md-12"><div class="alert alert-info mb-0"><i class="fas fa-spinner fa-spin"></i> Loading ledger...</div></div>'
    );

    contactLedgerRequest = $.ajax({
        url: contactLedgerUrl,
        data: data,
        dataType: 'html',
        success: function(result) {
            $('#contact_ledger_div')
                .html(result);
            __currency_convert_recursively($('#contact_ledger_div'));
            syncContactLedgerSummaryVisibility();
            setTimeout(function() {
                try {
                    initContactLedgerDataTables(format);
                } catch (e) {
                    if (window.console) {
                        console.error(e);
                    }
                }
            }, 0);
        },
        error: function(xhr) {
            if (xhr.statusText === 'abort') {
                return;
            }

            var message = (xhr.responseJSON && xhr.responseJSON.message)
                || (xhr.responseJSON && xhr.responseJSON.msg)
                || xhr.statusText
                || (typeof LANG !== 'undefined' && LANG.something_went_wrong ? LANG.something_went_wrong : 'Something went wrong');

            $('#contact_ledger_div').html(
                '<div class="col-md-12"><div class="alert alert-danger mb-0">' + message + '</div></div>'
            );
            if (typeof toastr !== 'undefined') {
                toastr.error(message);
            }
        },
    });
}

$(document).on('click', '.contact-ledger-page', function(e) {
    e.preventDefault();
    var page = parseInt($(this).data('page'), 10) || 1;
    get_contact_ledger(page);
});

$(document).on('click', '#send_ledger', function() {
    var start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
    var format = $('input[name="ledger_format"]:checked').val();

    var location_id = $('#ledger_location').val();

    var url = "<?php echo e(action([\App\Http\Controllers\NotificationController::class, 'getTemplate'], [$contact->id, 'send_ledger']), false); ?>" + '?start_date=' + start_date + '&end_date=' + end_date + '&format=' + format + '&location_id=' + location_id;

    $.ajax({
        url: url,
        dataType: 'html',
        success: function(result) {
            $('.view_modal')
                .html(result)
                .modal('show');
        },
    });
})

$(document).on('click', '#print_ledger_pdf', function() {
    var start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
    var show_paid = ($('input#show_paid').is(':checked')) ? true : false;
    var hide_acc_summary = ($('input#hide_account_summary_front').is(':checked')) ? true : false;
    var hide_ageing = ($('input#hide_ageing_front').is(':checked')) ? true : false;
    var hide_clearing = ($('input#hide_clearing').is(':checked')) ? true : false;
    var hide_footer = ($('input#hide_footer_total_front').is(':checked')) ? true : false;
    var format = $('input[name="ledger_format"]:checked').val();
    var location_id = $('#ledger_location').val();
    var url = $(this).data('href') + '&start_date=' + start_date + '&end_date=' + end_date + '&format=' + format + '&location_id=' + location_id+ '&show_paid=' + show_paid+'&hide_acc_summary='+hide_acc_summary+'&hide_ageing='+hide_ageing+'&hide_clearing='+hide_clearing+'&hide_footer='+hide_footer;
    window.open(url);
});

$(document).on('click', '#print_ledger_btn', function() {
    var start_date = $('#ledger_date_range').data('daterangepicker').startDate.format('YYYY-MM-DD');
    var end_date = $('#ledger_date_range').data('daterangepicker').endDate.format('YYYY-MM-DD');
    var show_paid = ($('input#show_paid').is(':checked')) ? true : false;
    var hide_acc_summary = ($('input#hide_account_summary_front').is(':checked')) ? true : false;
    var hide_ageing = ($('input#hide_ageing_front').is(':checked')) ? true : false;
    var hide_clearing = ($('input#hide_clearing').is(':checked')) ? true : false;
    var hide_footer = ($('input#hide_footer_total_front').is(':checked')) ? true : false;
    var format = $('input[name="ledger_format"]:checked').val();
    var location_id = $('#ledger_location').val();

    var url = $(this).data('href') + '&start_date=' + start_date + '&end_date=' + end_date + '&format=' + format + '&location_id=' + location_id+ '&show_paid=' + show_paid +'&hide_acc_summary='+hide_acc_summary+'&hide_ageing='+hide_ageing+'&hide_clearing='+hide_clearing+'&hide_footer='+hide_footer;
    window.open(url);
});

$(document).on('click', '#export_ledger_excel', function() {
   $('#contact_ledger_div #ledger_dt_exportExcelBtn').click();
});

var pdc_url = null;
$(document).on('click', '.update_pdc_payment_status', function(e) {
    e.preventDefault();
    if($(this).data('status') == 'pending'){
        $.ajax({
            url: $(this).data('href'),
            dataType: 'json',
            success: function(result) {
                get_contact_ledger();
            },
        });
    }else{
        pdc_url = $(this).data('href');
        $('div.pdc_modal').modal('show');
        $('#cleared_on').datetimepicker({
            format: moment_date_format + ' ' + moment_time_format,
            ignoreReadonly: true,
        });
        $('#cleared_on').datetimepicker('date', moment());
    }
});
$(document).on('click', '.update_pdc_payment_status_post', function(e) {
    e.preventDefault();
    $('div.pdc_modal').modal('hide');
    $.ajax({
        url: pdc_url,
        data: {
            cleared_on : $('#cleared_on').datetimepicker('date').format(moment_date_format + ' ' + moment_time_format),
        },
        dataType: 'json',
        success: function(result) {
            get_contact_ledger();
        },
    });
});

</script>
<?php echo $__env->make('sale_pos.partials.sale_table_javascript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script src="<?php echo e(asset('js/payment.js?v=' . $asset_v), false); ?>"></script>
<?php if(in_array($contact->type, ['both', 'supplier'])): ?>
    <?php if(!empty($common_settings['enable_ledger_discount3'])): ?>
    <script>
        window.enable_ledger_discount3 = true;
    </script>
    <?php endif; ?>
    <script src="<?php echo e(asset('js/purchase.js?v=' . $asset_v), false); ?>"></script>
<?php endif; ?>

<!-- document & note.js -->
<?php echo $__env->make('documents_and_notes.document_and_note_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(!empty($contact_view_tabs)): ?>
    <?php $__currentLoopData = $contact_view_tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $tabs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!empty($value['module_js_path'])): ?>
                <?php echo $__env->make($value['module_js_path'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<script type="text/javascript">
    $(document).ready( function(){
        $('#purchase_list_filter_date_range').daterangepicker(
            dateRangeSettings,
            function (start, end) {
                $('#purchase_list_filter_date_range').val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
               purchase_table.ajax.reload();
            }
        );
        $('#purchase_list_filter_date_range').on('cancel.daterangepicker', function(ev, picker) {
            $('#purchase_list_filter_date_range').val('');
            purchase_table.ajax.reload();
        });
        $(document).on('change', '#show_purchase_orders', function(){
            purchase_table.ajax.reload();
        }) 
    });
</script>
<?php echo $__env->make('sale_pos.partials.subscriptions_table_javascript', ['contact_id' => $contact->id], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>