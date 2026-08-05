<?php if(!empty($requires_date)): ?>
    <div class="text-center py-4">
        <p class="text-muted"><?php echo app('translator')->get('lang_v1.select_a_date_range'); ?></p>
    </div>
<?php elseif(count($locations) > 0): ?>
    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $ledger_details = $location['ledger_details'];
            $paymentTypes = $ledger_details['paymentTypes'] ?? [];
            $ledger_rows = $ledger_details['ledger'] ?? [];
        ?>

        <div class="card mb-2 daily-closing-purchase-location-section">
            <div class="card-header bg-primary" style="background-color: #3c8dbc !important; padding: 8px 15px;">
                <h4 class="mb-0 text-white" style="margin:0; font-size: 16px; font-weight: 600;">
                    <i class="fas fa-map-marker-alt"></i> <?php echo e($location['name'], false); ?>

                    <span class="pull-right" style="font-size: 12px; font-weight: normal;">
                        <?php echo e(count($ledger_rows), false); ?> <?php echo app('translator')->get('lang_v1.invoices'); ?>
                    </span>
                </h4>
            </div>
            <div class="card-body" style="padding: 0;">
                <?php if(count($ledger_rows) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-bordered daily-closing-purchase-ledger-table" style="table-layout: fixed; width: 100%; margin-bottom: 0;">
                            <thead>
                                <tr class="row-border blue-heading">
                                    <th width="8%" class="text-left"><?php echo app('translator')->get('lang_v1.date'); ?></th>
                                    <th width="9%" class="text-left"><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                                    <th width="12%" class="text-left"><?php echo app('translator')->get('purchase.supplier'); ?></th>
                                    <th width="6%" class="text-left"><?php echo app('translator')->get('lang_v1.type'); ?></th>
                                    <th width="10%" class="text-left"><?php echo app('translator')->get('sale.location'); ?></th>
                                    <th width="8%" class="text-left"><?php echo app('translator')->get('sale.payment_status'); ?></th>
                                    <th width="10%" class="text-right"><?php echo app('translator')->get('sale.total_amount'); ?></th>
                                    <th width="10%" class="text-right"><?php echo app('translator')->get('lang_v1.paid'); ?></th>
                                    <th width="8%" class="text-left"><?php echo app('translator')->get('lang_v1.payment_method'); ?></th>
                                    <th width="10%" class="text-right"><?php echo app('translator')->get('lang_v1.due'); ?></th>
                                    <th width="9%" class="text-left"><?php echo app('translator')->get('report.others'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $ledger_rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr <?php if(!empty($data['transaction_type']) && in_array($data['transaction_type'], ['purchase', 'purchase_return'])): ?> class="pir_detail_row pir-invoice-info" <?php endif; ?>>
                                        <td class="row-border"><?php echo format_datetime_br($data['date']); ?></td>
                                        <td><?php echo e($data['ref_no'], false); ?></td>
                                        <td><?php echo e($data['contact_name'], false); ?></td>
                                        <td><?php echo e($data['type'], false); ?></td>
                                        <td><?php echo e($data['location'], false); ?></td>
                                        <td><?php echo e($data['payment_status'], false); ?></td>
                                        <td class="ws-nowrap align-right pir_grey_final_total" data-amount="<?php echo e($data['final_total'], false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['final_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                        <td class="ws-nowrap align-right pir_grey_paid" data-amount="<?php echo e($data['paid'], false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['paid'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                        <td class="pir_grey_method" data-orig-value="<?php echo e($data['payment_method'], false); ?>" data-status-name="<?php echo e(!empty($paymentTypes[$data['payment_method']]) ? $paymentTypes[$data['payment_method']] : '', false); ?>">
                                            <?php echo e(!empty($paymentTypes[$data['payment_method']]) ? $paymentTypes[$data['payment_method']] : '', false); ?>

                                        </td>
                                        <td class="ws-nowrap align-right pir_grey_due" data-orig-value="<?php echo e($data['due'], false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $data['due'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                                        <td><?php echo $data['others']; ?></td>
                                    </tr>
                                    <?php if(!empty($data['transaction_type']) && in_array($data['transaction_type'], ['purchase', 'purchase_return'])): ?>
                                        <tr>
                                            <td colspan="11" class="pir-invoice-detail" style="padding: 0 20px 10px;">
                                                <?php echo $__env->make('report.partials.purchase_line_details_pir', ['purchase' => (object) $data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                            <tfoot>
                                <tr class="font-17 text-center pir-footer-total" style="margin-top:10px">
                                    <td style="text-align: left !important;"><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                                    <td></td>
                                    <td></td>
                                    <td class="pir_grey_footer_count"></td>
                                    <td></td>
                                    <td></td>
                                    <td class="pir_grey_footer_final_total"></td>
                                    <td class="pir_grey_footer_paid"></td>
                                    <td class="pir_grey_footer_method"></td>
                                    <td class="pir_grey_footer_due"></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="11" style="padding: 0 20px 10px;">
                                        <table class="table pir_line_details table-bordered table-slim mb-0" style="table-layout: fixed; width: 100%;">
                                            <tr class="pir-footer-totals font-17 text-center">
                                                <td style="width:5%;text-align: left !important;"><strong><?php echo app('translator')->get('sale.total'); ?>s:</strong></td>
                                                <td style="width:23%;min-width: 23%;"></td>
                                                <td style="width:8%" class="pir_footer_quantity_count"></td>
                                                <td style="width:8%"></td>
                                                <td style="width:8%" class="pir_footer_discount_total"></td>
                                                <td style="width:8%" class="pir_footer_tax_total"></td>
                                                <td style="width:8%"></td>
                                                <td style="width:8%" class="pir_footer_subtotal"></td>
                                                <td style="width:8%" class="pir_footer_sell_total"></td>
                                                <td style="width:8%" class="pir_footer_profit_total"></td>
                                                <td style="width:8%" class="pir_footer_gp_percent"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <p class="text-muted"><?php echo app('translator')->get('lang_v1.no_data_available'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <style>
        .daily-closing-purchase-ledger-table .blue-heading th {
            white-space: normal !important;
            word-wrap: break-word;
        }
        .daily-closing-purchase-ledger-table .pir-invoice-info td {
            background-color: #d5f5e3 !important;
            border-bottom: 2px solid #a9dfbf;
            white-space: normal !important;
            word-wrap: break-word;
        }
        .daily-closing-purchase-ledger-table .pir-invoice-detail,
        .daily-closing-purchase-ledger-table .pir-invoice-detail .pir_line_details,
        .daily-closing-purchase-ledger-table .pir-invoice-detail .pir_line_details tr td {
            background-color: #fef9e7 !important;
        }
        .daily-closing-purchase-ledger-table .pir-invoice-detail .pir_line_details tr.pir_total_row_footer td,
        .daily-closing-purchase-ledger-table .pir-invoice-detail .pir_line_details tr th,
        .daily-closing-purchase-ledger-table .pir-footer-totals td {
            background-color: #fdf3cd !important;
        }
        .daily-closing-purchase-ledger-table > tfoot > tr.pir-footer-total td {
            background-color: #d5f5e3 !important;
            border-top: 2px solid #a9dfbf;
            text-align: right !important;
        }
        .daily-closing-purchase-ledger-table .pir_line_details tr td,
        .daily-closing-purchase-ledger-table .pir_line_details tr th {
            text-align: left !important;
        }
        .daily-closing-purchase-ledger-table .pir_line_details tr td.text-right,
        .daily-closing-purchase-ledger-table .pir_line_details tr th.text-right {
            text-align: right !important;
        }
    </style>
<?php else: ?>
    <div class="text-center py-4">
        <p class="text-muted"><?php echo app('translator')->get('lang_v1.no_data_available'); ?></p>
    </div>
<?php endif; ?>
