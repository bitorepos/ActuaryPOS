<?php
    $__date_loc = isset($active_settings_location) ? (int) $active_settings_location : (int) ($default_location ?? 0);
    $__date_defaults = [
        'dashboard_filter_date_range' => 'today',
        'pos_sale_filter_date_range' => 'today',
        'purchase_filter_date_range' => 'today',
        'purchase_return_filter_date_range' => 'today',
        'purchase_order_filter_date_range' => 'today',
        'stock_transfer_filter_date_range' => 'today',
        'sale_filter_date_range' => 'this_year',
        'sell_return_filter_date_range' => 'this_year',
        'draft_filter_date_range' => 'this_year',
        'ledger_filter_date_range' => 'this_year',
        'expense_filter_date_range' => 'today',
        'accounting_filter_date_range' => 'today',
        'accounting_journal_entry_filter_date_range' => 'today',
        'accounting_transfer_filter_date_range' => 'today',
        'accounting_ledger_filter_date_range' => 'today',
        'accounting_cash_flow_filter_date_range' => 'today',
        'accounting_trial_balance_filter_date_range' => 'this_year',
        'accounting_balance_sheet_filter_date_range' => 'this_year',
        'accounting_profit_loss_filter_date_range' => 'this_year',
        'accounting_daily_transactions_filter_date_range' => 'today',
        'reports_filter_date_range' => 'this_year',
        'report_profit_loss_filter_date_range' => 'this_year',
        'report_purchase_sell_filter_date_range' => 'this_year',
        'report_tax_filter_date_range' => 'this_year',
        'report_gst_sales_filter_date_range' => 'this_month',
        'report_gst_purchase_filter_date_range' => 'this_month',
        'report_expense_filter_date_range' => 'this_month',
        'report_activity_log_filter_date_range' => 'today',
        'report_register_filter_date_range' => 'all_time',
        'report_summary_income_filter_date_range' => 'today',
        'report_sales_representative_filter_date_range' => 'current_financial_year',
        'report_service_staff_filter_date_range' => 'this_month',
        'report_table_filter_date_range' => 'this_month',
        'report_types_of_service_filter_date_range' => 'this_month',
        'report_sale_607_filter_date_range' => 'this_year',
        'report_sale_invoices_filter_date_range' => 'today',
        'report_sales_returns_filter_date_range' => 'today',
        'report_product_sale_filter_date_range' => 'this_month',
        'report_sale_payment_filter_date_range' => 'today',
        'report_sales_analysis_filter_date_range' => 'all_time',
        'report_trending_products_filter_date_range' => 'all_time',
        'report_payment_recovery_filter_date_range' => 'today',
        'report_discounts_filter_date_range' => 'last_thirty_days',
        'report_stock_performance_filter_date_range' => 'last_seven_days',
        'report_product_booking_filter_date_range' => 'today',
        'report_purchase_606_filter_date_range' => 'this_year',
        'report_purchase_invoices_filter_date_range' => 'today',
        'report_purchases_returns_filter_date_range' => 'today',
        'report_product_purchase_filter_date_range' => 'this_month',
        'report_purchase_payment_filter_date_range' => 'today',
        'report_purchase_analysis_filter_date_range' => 'all_time',
        'report_stock_quantity_filter_date_range' => 'current_financial_year',
        'report_stock_value_filter_date_range' => 'yesterday',
        'report_stock_reorder_filter_date_range' => 'current_financial_year',
        'report_opening_stock_filter_date_range' => 'current_financial_year',
        'report_mismatch_quantity_filter_date_range' => 'current_financial_year',
        'report_stock_adjustment_filter_date_range' => 'today',
        'report_stock_take_filter_date_range' => 'current_financial_year',
        'report_stock_transfer_filter_date_range' => 'today',
        'report_combo_items_filter_date_range' => 'current_financial_year',
        'report_stock_consumption_filter_date_range' => 'today',
        'report_product_status_filter_date_range' => 'current_financial_year',
        'report_product_serial_filter_date_range' => 'current_financial_year',
        'report_customer_supplier_filter_date_range' => 'current_financial_year',
        'report_contact_opening_balance_filter_date_range' => 'current_financial_year',
        'report_contact_advance_deposit_filter_date_range' => 'current_financial_year',
        'report_customer_group_filter_date_range' => 'current_financial_year',
        'report_cheque_clearance_filter_date_range' => 'today',
        'report_items_filter_date_range' => 'current_financial_year',
        'report_bookings_filter_date_range' => 'current_financial_year',
        'installments_filter_date_range' => 'today',
        'installment_reports_filter_date_range' => 'this_year',
        'hrm_filter_date_range' => 'today',
        'hrm_attendance_filter_date_range' => 'today',
        'hrm_attendance_by_date_filter_date_range' => 'last_seven_days',
        'essentials_filter_date_range' => 'today',
    ];
    $__current_date_settings = isset($date_settings[$__date_loc]) && is_array($date_settings[$__date_loc])
        ? array_replace($__date_defaults, $date_settings[$__date_loc])
        : array_replace($__date_defaults, is_array($date_settings ?? null) ? $date_settings : []);
?>
<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-12">
            <h3><?php echo app('translator')->get('lang_v1.date_settings'); ?>:</h3>
        </div>
        
        <?php echo Form::hidden('date_tab_location', $__date_loc); ?>


        <div class="clearfix"></div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('dashboard_filter_date_range', __('lang_v1.dashboard') . ':'); ?>

                <?php echo Form::select('date_settings[dashboard_filter_date_range]', $date_filter_values,
                $__current_date_settings['dashboard_filter_date_range'],['class' => 'form-control select2', 'id'=>'dashboard_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('pos_sale_filter_date_range', 'POS Index:'); ?>

                <?php echo Form::select('date_settings[pos_sale_filter_date_range]', $date_filter_values,
                $__current_date_settings['pos_sale_filter_date_range'],['class' => 'form-control select2', 'id'=>'pos_sale_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('sale_filter_date_range', __('lang_v1.sales') . ':'); ?>

                <?php echo Form::select('date_settings[sale_filter_date_range]', $date_filter_values,
                $__current_date_settings['sale_filter_date_range'] ,['class' => 'form-control select2', 'id'=>'sale_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('sell_return_filter_date_range', __('lang_v1.sell_return') . ':'); ?>

                <?php echo Form::select('date_settings[sell_return_filter_date_range]', $date_filter_values,
                $__current_date_settings['sell_return_filter_date_range'] ,['class' => 'form-control select2', 'id'=>'sell_return_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('draft_filter_date_range', __('sale.drafts') . ':'); ?>

                <?php echo Form::select('date_settings[draft_filter_date_range]', $date_filter_values,
                $__current_date_settings['draft_filter_date_range'] ,['class' => 'form-control select2', 'id'=>'draft_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('ledger_filter_date_range', __('lang_v1.ledger') . ':'); ?>

                <?php echo Form::select('date_settings[ledger_filter_date_range]', $date_filter_values,
                $__current_date_settings['ledger_filter_date_range'] ,['class' => 'form-control select2', 'id'=>'ledger_filter_date_range', 'style' => 'width:
                100%;']); ?> 
            </div>
        </div>
        
        

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('purchase_filter_date_range', __('lang_v1.purchases') . ':'); ?>

                <?php echo Form::select('date_settings[purchase_filter_date_range]', $date_filter_values,
                $__current_date_settings['purchase_filter_date_range'],['class' => 'form-control select2', 'id'=>'purchase_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('purchase_return_filter_date_range', __('lang_v1.purchase_return') . ':'); ?>

                <?php echo Form::select('date_settings[purchase_return_filter_date_range]', $date_filter_values,
                $__current_date_settings['purchase_return_filter_date_range'],['class' => 'form-control select2', 'id'=>'purchase_return_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('purchase_order_filter_date_range', __('lang_v1.purchase_order') . ':'); ?>

                <?php echo Form::select('date_settings[purchase_order_filter_date_range]', $date_filter_values,
                $__current_date_settings['purchase_order_filter_date_range'],['class' => 'form-control select2', 'id'=>'purchase_order_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('stock_transfer_filter_date_range', __('lang_v1.stock_transfer') . ':'); ?>

                <?php echo Form::select('date_settings[stock_transfer_filter_date_range]', $date_filter_values,
                $__current_date_settings['stock_transfer_filter_date_range'],['class' => 'form-control select2', 'id'=>'stock_transfer_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

       
        <div class="clearfix"></div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('expense_filter_date_range', __('lang_v1.expenses') . ':'); ?>

                <?php echo Form::select('date_settings[expense_filter_date_range]', $date_filter_values,
                $__current_date_settings['expense_filter_date_range'],['class' => 'form-control select2', 'id'=>'expense_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('accounting_filter_date_range', __('lang_v1.accounting') . ':'); ?>

                <?php echo Form::select('date_settings[accounting_filter_date_range]', $date_filter_values,
                $__current_date_settings['accounting_filter_date_range'],['class' => 'form-control select2', 'id'=>'accounting_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('reports_filter_date_range', __('lang_v1.reports') . ':'); ?>

                <?php echo Form::select('date_settings[reports_filter_date_range]', $date_filter_values,
                $__current_date_settings['reports_filter_date_range'],['class' => 'form-control select2', 'id'=>'reports_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-12">
            <h4>Accounting Pages & Reports:</h4>
        </div>

        <?php
            $__accounting_report_date_settings = [
                'accounting_journal_entry_filter_date_range' => __('accounting::lang.journal_entry'),
                'accounting_transfer_filter_date_range' => __('accounting::lang.transfer'),
                'accounting_ledger_filter_date_range' => __('accounting::lang.ledger_report'),
                'accounting_cash_flow_filter_date_range' => __('accounting::lang.cash_flow_report'),
                'accounting_trial_balance_filter_date_range' => __('accounting::lang.trial_balance'),
                'accounting_balance_sheet_filter_date_range' => __('accounting::lang.balance_sheet'),
                'accounting_profit_loss_filter_date_range' => __('accounting::lang.profit_loss'),
                'accounting_daily_transactions_filter_date_range' => __('accounting::lang.daily_transactions_report'),
            ];
        ?>

        <?php $__currentLoopData = $__accounting_report_date_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__accounting_report_date_key => $__accounting_report_date_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label($__accounting_report_date_key, $__accounting_report_date_label . ':'); ?>

                    <?php echo Form::select('date_settings[' . $__accounting_report_date_key . ']', $date_filter_values,
                    $__current_date_settings[$__accounting_report_date_key], ['class' => 'form-control select2', 'id' => $__accounting_report_date_key, 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="clearfix"></div>

        <div class="col-sm-12">
            <h4>Admin Reports:</h4>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_profit_loss_filter_date_range', __('report.profit_loss') . ':'); ?>

                <?php echo Form::select('date_settings[report_profit_loss_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_profit_loss_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_profit_loss_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_purchase_sell_filter_date_range', __('report.purchase_sell_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_purchase_sell_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_purchase_sell_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_purchase_sell_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_tax_filter_date_range', __('report.tax_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_tax_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_tax_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_tax_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <?php if(!empty(config('constants.enable_gst_report_india'))): ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label('report_gst_sales_filter_date_range', __('lang_v1.gst_sales_report') . ':'); ?>

                    <?php echo Form::select('date_settings[report_gst_sales_filter_date_range]', $date_filter_values,
                    $__current_date_settings['report_gst_sales_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_gst_sales_filter_date_range', 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>

            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label('report_gst_purchase_filter_date_range', __('lang_v1.gst_purchase_report') . ':'); ?>

                    <?php echo Form::select('date_settings[report_gst_purchase_filter_date_range]', $date_filter_values,
                    $__current_date_settings['report_gst_purchase_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_gst_purchase_filter_date_range', 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endif; ?>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_expense_filter_date_range', __('report.expense_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_expense_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_expense_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_expense_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_activity_log_filter_date_range', __('lang_v1.activity_log') . ':'); ?>

                <?php echo Form::select('date_settings[report_activity_log_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_activity_log_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_activity_log_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="clearfix"></div>

        <div class="col-sm-12">
            <h4>POS Reports:</h4>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_register_filter_date_range', __('report.register_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_register_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_register_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_register_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_summary_income_filter_date_range', __('report.summary_income_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_summary_income_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_summary_income_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_summary_income_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_sales_representative_filter_date_range', __('report.sales_representative') . ':'); ?>

                <?php echo Form::select('date_settings[report_sales_representative_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_sales_representative_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_sales_representative_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <?php if(in_array('service_staff', $enabled_modules ?? [])): ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label('report_service_staff_filter_date_range', __('restaurant.service_staff_report') . ':'); ?>

                    <?php echo Form::select('date_settings[report_service_staff_filter_date_range]', $date_filter_values,
                    $__current_date_settings['report_service_staff_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_service_staff_filter_date_range', 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(in_array('tables', $enabled_modules ?? [])): ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label('report_table_filter_date_range', __('restaurant.table_report') . ':'); ?>

                    <?php echo Form::select('date_settings[report_table_filter_date_range]', $date_filter_values,
                    $__current_date_settings['report_table_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_table_filter_date_range', 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(in_array('types_of_service', $enabled_modules ?? []) && in_array('pos_sale', $enabled_modules ?? [])): ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label('report_types_of_service_filter_date_range', __('lang_v1.types_of_service_report') . ':'); ?>

                    <?php echo Form::select('date_settings[report_types_of_service_filter_date_range]', $date_filter_values,
                    $__current_date_settings['report_types_of_service_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_types_of_service_filter_date_range', 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endif; ?>

        <div class="clearfix"></div>

        <div class="col-sm-12">
            <h4>Sales Reports:</h4>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_sale_607_filter_date_range', 'Report 607 (' . __('business.sale') . '):'); ?>

                <?php echo Form::select('date_settings[report_sale_607_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_sale_607_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_sale_607_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_sale_invoices_filter_date_range', __('lang_v1.sale_invoices_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_sale_invoices_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_sale_invoices_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_sale_invoices_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_sales_returns_filter_date_range', 'Sales & Returns Report:'); ?>

                <?php echo Form::select('date_settings[report_sales_returns_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_sales_returns_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_sales_returns_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_product_sale_filter_date_range', __('lang_v1.product_sell_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_product_sale_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_product_sale_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_product_sale_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_sale_payment_filter_date_range', __('lang_v1.sell_payment_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_sale_payment_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_sale_payment_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_sale_payment_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_sales_analysis_filter_date_range', __('report.sales_analysis') . ':'); ?>

                <?php echo Form::select('date_settings[report_sales_analysis_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_sales_analysis_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_sales_analysis_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_trending_products_filter_date_range', __('report.trending_products') . ':'); ?>

                <?php echo Form::select('date_settings[report_trending_products_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_trending_products_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_trending_products_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_payment_recovery_filter_date_range', __('lang_v1.payment_recovery_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_payment_recovery_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_payment_recovery_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_payment_recovery_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_discounts_filter_date_range', __('lang_v1.discounts_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_discounts_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_discounts_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_discounts_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('report_stock_performance_filter_date_range', __('report.stock_performance_report') . ':'); ?>

                <?php echo Form::select('date_settings[report_stock_performance_filter_date_range]', $date_filter_values,
                $__current_date_settings['report_stock_performance_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_stock_performance_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <?php if(!empty($common_settings['enable_booking_hourly_services'])): ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label('report_product_booking_filter_date_range', __('lang_v1.product_booking_report') . ':'); ?>

                    <?php echo Form::select('date_settings[report_product_booking_filter_date_range]', $date_filter_values,
                    $__current_date_settings['report_product_booking_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_product_booking_filter_date_range', 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endif; ?>

        <?php if(in_array('types_of_service', $enabled_modules ?? []) && !in_array('pos_sale', $enabled_modules ?? [])): ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label('report_types_of_service_filter_date_range', __('lang_v1.types_of_service_report') . ':'); ?>

                    <?php echo Form::select('date_settings[report_types_of_service_filter_date_range]', $date_filter_values,
                    $__current_date_settings['report_types_of_service_filter_date_range'],['class' => 'form-control select2', 'id'=>'report_types_of_service_sales_filter_date_range', 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endif; ?>

        

        <div class="clearfix"></div>

        <div class="col-sm-12">
            <h4>Purchase Reports:</h4>
        </div>

        <?php
            $__purchase_report_date_settings = [
                'report_purchase_606_filter_date_range' => 'Report 606 (' . __('lang_v1.purchase') . ')',
                'report_purchase_invoices_filter_date_range' => __('lang_v1.purchase_invoices_report'),
                'report_purchases_returns_filter_date_range' => __('lang_v1.purchases_returns_report'),
                'report_product_purchase_filter_date_range' => __('lang_v1.product_purchase_report'),
                'report_purchase_payment_filter_date_range' => __('lang_v1.purchase_payment_report'),
                'report_purchase_analysis_filter_date_range' => __('report.purchase_analysis'),
            ];
        ?>

        <?php $__currentLoopData = $__purchase_report_date_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__purchase_report_date_key => $__purchase_report_date_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label($__purchase_report_date_key, $__purchase_report_date_label . ':'); ?>

                    <?php echo Form::select('date_settings[' . $__purchase_report_date_key . ']', $date_filter_values,
                    $__current_date_settings[$__purchase_report_date_key], ['class' => 'form-control select2', 'id' => $__purchase_report_date_key, 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="clearfix"></div>

        <div class="col-sm-12">
            <h4>Stock Reports:</h4>
        </div>

        <?php
            $__stock_report_date_settings = [
                'report_stock_quantity_filter_date_range' => __('report.stock_report'),
                'report_stock_value_filter_date_range' => __('report.stock_value_report'),
                'report_stock_reorder_filter_date_range' => __('report.stock_reorder_report'),
                'report_opening_stock_filter_date_range' => __('lang_v1.opening_stock_report'),
                'report_mismatch_quantity_filter_date_range' => __('report.mismatch_report'),
                'report_stock_adjustment_filter_date_range' => __('report.stock_adjustment_report'),
                'report_stock_take_filter_date_range' => __('report.stock_take_report'),
                'report_stock_transfer_filter_date_range' => __('lang_v1.stock_transfer_report'),
                'report_combo_items_filter_date_range' => __('lang_v1.combo_items_report'),
                'report_product_status_filter_date_range' => __('lang_v1.product_status_report'),
                'report_product_serial_filter_date_range' => __('lang_v1.product_serial_report'),
            ];

            if (!empty($common_settings['enable_stock_issue_receive'])) {
                $__stock_report_date_settings['report_stock_consumption_filter_date_range'] = __('lang_v1.stock_consumption_report');
            }
        ?>

        <?php $__currentLoopData = $__stock_report_date_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__stock_report_date_key => $__stock_report_date_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label($__stock_report_date_key, $__stock_report_date_label . ':'); ?>

                    <?php echo Form::select('date_settings[' . $__stock_report_date_key . ']', $date_filter_values,
                    $__current_date_settings[$__stock_report_date_key], ['class' => 'form-control select2', 'id' => $__stock_report_date_key, 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="clearfix"></div>

        <div class="col-sm-12">
            <h4>General Reports:</h4>
        </div>

        <?php
            $__general_report_date_settings = [
                'report_customer_supplier_filter_date_range' => __('report.supplier') . ' & ' . __('report.customer') . ' ' . __('report.reports'),
                'report_contact_opening_balance_filter_date_range' => __('lang_v1.contact_opening_balance_report'),
                'report_contact_advance_deposit_filter_date_range' => __('lang_v1.contact_advance_deposit_report'),
                'report_customer_group_filter_date_range' => __('lang_v1.customer_groups_report'),
                'report_cheque_clearance_filter_date_range' => __('lang_v1.cheque_clearance_report'),
                'report_items_filter_date_range' => __('lang_v1.items_report'),
                'report_bookings_filter_date_range' => __('lang_v1.bookings_report'),
            ];
        ?>

        <?php $__currentLoopData = $__general_report_date_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $__general_report_date_key => $__general_report_date_label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <?php echo Form::label($__general_report_date_key, $__general_report_date_label . ':'); ?>

                    <?php echo Form::select('date_settings[' . $__general_report_date_key . ']', $date_filter_values,
                    $__current_date_settings[$__general_report_date_key], ['class' => 'form-control select2', 'id' => $__general_report_date_key, 'style' => 'width:
                    100%;']); ?>

                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="clearfix"></div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('installments_filter_date_range', __('lang_v1.installments') . ':'); ?>

                <?php echo Form::select('date_settings[installments_filter_date_range]', $date_filter_values,
                $__current_date_settings['installments_filter_date_range'],['class' => 'form-control select2', 'id'=>'installments_filter_date_range', 'style' => 'width:
                100%;']); ?> 
            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('installment_reports_filter_date_range', __('lang_v1.installments') . ' ' . __('lang_v1.reports') . ':'); ?>

                <?php echo Form::select('date_settings[installment_reports_filter_date_range]', $date_filter_values,
                $__current_date_settings['installment_reports_filter_date_range'],['class' => 'form-control select2', 'id'=>'installment_reports_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('hrm_filter_date_range', __('lang_v1.hrm') . ':'); ?>

                <?php echo Form::select('date_settings[hrm_filter_date_range]', $date_filter_values,
                $__current_date_settings['hrm_filter_date_range'],['class' => 'form-control select2', 'id'=>'hrm_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('hrm_attendance_filter_date_range', __('essentials::lang.all_attendance') . ':'); ?>

                <?php echo Form::select('date_settings[hrm_attendance_filter_date_range]', $date_filter_values,
                $__current_date_settings['hrm_attendance_filter_date_range'],['class' => 'form-control select2', 'id'=>'hrm_attendance_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('hrm_attendance_by_date_filter_date_range', __('essentials::lang.attendance_by_date') . ':'); ?>

                <?php echo Form::select('date_settings[hrm_attendance_by_date_filter_date_range]', $date_filter_values,
                $__current_date_settings['hrm_attendance_by_date_filter_date_range'],['class' => 'form-control select2', 'id'=>'hrm_attendance_by_date_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        <div class="col-sm-3">
            <div class="form-group mb-3">
                <?php echo Form::label('essentials_filter_date_range', __('essentials::lang.todo') . ':'); ?>

                <?php echo Form::select('date_settings[essentials_filter_date_range]', $date_filter_values,
                $__current_date_settings['essentials_filter_date_range'],['class' => 'form-control select2', 'id'=>'essentials_filter_date_range', 'style' => 'width:
                100%;']); ?>

            </div>
        </div>

        
       
        <div class="clearfix"></div>


    </div>
</div>
