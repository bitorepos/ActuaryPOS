<style>
    @page { margin: 0; padding: 0; size: auto; }
    .invoice-print-page { color: #000 !important; background-color: #fff !important; }
    @media print {
        .invoice-print-page, .invoice-print-page *, .invoice-print-page :after, .invoice-print-page :before { color: #000 !important; background: #fff !important; text-shadow: none !important; -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        .invoice-print-page { height: auto !important; min-height: 0 !important; overflow: visible !important; }
        body.lockscreen, body.lockscreen > .wrapper, .wrapper { min-height: 0 !important; height: auto !important; overflow: visible !important; }
        .pos-content-wrapper { height: auto !important; min-height: 0 !important; max-height: none !important; overflow: visible !important; }
    }
</style>
<?php if(!empty($receipt_details->classic_receipt_font)): ?>
<style>
    .invoice-print-page, .invoice-print-page table, .invoice-print-page th, .invoice-print-page td, .invoice-print-page p, .invoice-print-page span, .invoice-print-page div { font-family: '<?php echo e($receipt_details->classic_receipt_font, false); ?>', serif !important; }
</style>
<?php endif; ?>
<!-- business information here -->



<style>
    table {
        border-spacing: 0;
        width: 100%;
        margin-bottom: 10px;
    }

    .invoice-print-page,
    .invoice-print-footer-push {
        height: auto !important;
    }

    .invoice-print-page {
        display: flex !important;
        flex-direction: column !important;
        min-height: 100vh !important;
    }

    .invoice-print-footer-push {
        display: block !important;
        margin-top: auto !important;
        min-height: 0 !important;
    }

    @media print {
        .invoice-print-page,
        .invoice-print-footer-push {
            height: auto !important;
        }

        .invoice-print-page {
            display: flex !important;
            flex-direction: column !important;
            min-height: 100vh !important;
        }

        .invoice-print-footer-push {
            display: block !important;
            margin-top: auto !important;
            min-height: 0 !important;
        }
    }

    /* Product & totals table borders for print */
    .print-table-bordered {
        border: 1px solid #000 !important;
        border-collapse: collapse !important;
    }
    .print-table-bordered > thead > tr > th,
    .print-table-bordered > thead > tr > td,
    .print-table-bordered > tbody > tr > th,
    .print-table-bordered > tbody > tr > td,
    .print-table-bordered > tfoot > tr > th,
    .print-table-bordered > tfoot > tr > td,
    .print-table-bordered > tr > th,
    .print-table-bordered > tr > td {
        border: 1px solid #000 !important;
        padding: 4px 6px !important;
    }
    .table-responsive {
        overflow: visible !important;
    }
    /* Force white background for laserjet printers */
    .invoice-print-page table,
    .invoice-print-page table *,
    .invoice-print-page th,
    .invoice-print-page td,
    .invoice-print-page tr {
        background-color: #fff !important;
        background: #fff !important;
    }

    /* Header layout responsive styles */
    .invoice-header-wrapper {
        display: flex;
        width: 100%;
        margin-bottom: 15px;
        color: #000000 !important;
        flex-wrap: wrap;
    }

    .invoice-header-wrapper.with-logo {
        align-items: flex-start;
    }

    /* Logo container - left aligned when present */
    .invoice-logo-container {
        flex: 0 0 auto;
        padding-right: 15px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .invoice-logo-container img {
        max-height: 120px;
        width: auto;
        display: block;
    }

    /* Business info container */
    .invoice-business-info {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .invoice-business-info.centered {
        text-align: center;
        align-items: center;
    }

    .invoice-business-info.right-aligned {
        text-align: right;
        align-items: flex-end;
    }

    /* Business info styles */
    .business-name {
        font-weight: bold;
        font-size: 1.2em;
        margin: 5px 0;
    }

    .location-name {
        font-size: 1em;
        margin: 5px 0;
    }

    .business-details {
        font-size: 0.9em;
        line-height: 1.4;
        margin: 5px 0;
    }

    .tax-info {
        font-size: 0.85em;
        margin: 5px 0;
    }

    .invoice-heading-section {
        width: 100%;
        text-align: center;
        margin-top: 10px;
    }

    /* A4 fixed page size */
    @page {
        size: A4;
        margin: 10mm;
    }

    /* Print-friendly styles */
    @media print {
        .invoice-print-page {
            width: 210mm;
            height: 297mm;
        }
        .invoice-header-wrapper {
            display: flex !important;
            flex-direction: row !important; /* Forces side-by-side */
            page-break-inside: avoid;
            margin-bottom: 15px;
            align-items: flex-start !important;
        }

        .invoice-logo-container {
            flex: 0 0 auto !important;
            page-break-inside: avoid;
            padding-right: 15px !important;
            justify-content: flex-start !important;
            margin-bottom: 0 !important;
        }

        .invoice-business-info {
            flex: 1 1 auto !important;
            page-break-inside: avoid;
        }

        /* Force right alignment specifically for the print layout */
        .invoice-business-info.right-aligned {
            text-align: right !important;
            align-items: flex-end !important;
        }

        .invoice-heading-section {
            page-break-inside: avoid;
        }
    }

    /* Responsive adjustments for screens ONLY (Ignores Print) */
    @media screen and (max-width: 768px) {
        .invoice-header-wrapper.with-logo {
            flex-direction: column;
            align-items: center;
        }

        .invoice-logo-container {
            padding-right: 0;
            margin-bottom: 10px;
            justify-content: center;
        }

        .invoice-business-info.right-aligned {
            text-align: center;
            align-items: center;
        }
    }
</style>
<div class="invoice-print-page" style="display:flex;flex-direction:column;height:100vh;">
    <div class="row" style="color: #000000 !important;">
        <?php if(empty($receipt_details->letter_head)): ?>
        <!-- Header text -->
        <?php if(!empty($receipt_details->header_text)): ?>
        <div class="col-xs-12">
            <?php echo $receipt_details->header_text; ?>

        </div>
        <?php endif; ?>

        <!-- Invoice Header: Logo and Business Information -->
        <?php if(!empty($receipt_details->logo)): ?>
            <!-- Layout with Logo - Logo Left, Business Info Right -->
            <div class="invoice-header-wrapper with-logo col-xs-12">
                <!-- Logo Container -->
                <div class="invoice-logo-container">
                    <img src="<?php echo e($receipt_details->logo, false); ?>" alt="Logo">
                </div>

                <!-- Business Information - Right Aligned -->
                <div class="invoice-business-info right-aligned">
                    <?php if(!empty($receipt_details->display_name)): ?>
                    <span class="business-name" style="font-size:<?php echo e($receipt_details->business_name_font_size, false); ?>"><?php echo $receipt_details->display_name; ?></span>
                    <?php endif; ?>

                    <?php if(!empty($receipt_details->location_name)): ?>
                    <span class="location-name"><?php echo $receipt_details->location_name; ?></span>
                    <?php endif; ?>

                    <!-- Address and Contact -->
                    <div class="business-details">
                        <?php if(!empty($receipt_details->address)): ?>
                        <?php echo $receipt_details->address; ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->contact)): ?>
                        <br><?php echo $receipt_details->contact; ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->show_website) && !empty($receipt_details->website)): ?>
                        <br><?php echo e($receipt_details->website, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->location_custom_fields)): ?>
                        <br><?php echo e($receipt_details->location_custom_fields, false); ?>

                        <?php endif; ?>
                    </div>

                    <!-- Sub-heading lines -->
                    <?php if(!empty($receipt_details->sub_heading_line1) || !empty($receipt_details->sub_heading_line2) || !empty($receipt_details->sub_heading_line3) || !empty($receipt_details->sub_heading_line4) || !empty($receipt_details->sub_heading_line5)): ?>
                    <div class="business-details">
                        <?php if(!empty($receipt_details->sub_heading_line1)): ?>
                        <?php echo e($receipt_details->sub_heading_line1, false); ?><br>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->sub_heading_line2)): ?>
                        <?php echo e($receipt_details->sub_heading_line2, false); ?><br>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->sub_heading_line3)): ?>
                        <?php echo e($receipt_details->sub_heading_line3, false); ?><br>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->sub_heading_line4)): ?>
                        <?php echo e($receipt_details->sub_heading_line4, false); ?><br>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->sub_heading_line5)): ?>
                        <?php echo e($receipt_details->sub_heading_line5, false); ?>

                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Tax Information -->
                    <?php if(!empty($receipt_details->tax_info1) || !empty($receipt_details->tax_info2)): ?>
                    <div class="tax-info">
                        <?php if(!empty($receipt_details->tax_info1)): ?>
                        <span><?php echo e($receipt_details->tax_label1, false); ?><?php echo e($receipt_details->tax_info1, false); ?></span><br>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->tax_info2)): ?>
                        <span><?php echo e($receipt_details->tax_label2, false); ?><?php echo e($receipt_details->tax_info2, false); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <!-- Layout without Logo - Business Info Centered -->
            <div class="col-xs-12">
                <div class="invoice-business-info centered">
                    <?php if(!empty($receipt_details->display_name)): ?>
                    <br>
                    <span class="business-name" style="font-size:<?php echo e($receipt_details->business_name_font_size, false); ?>"><?php echo $receipt_details->display_name; ?></span>
                    <?php endif; ?>

                    <?php if(!empty($receipt_details->location_name)): ?>
                    <br>
                    <span class="location-name"><?php echo $receipt_details->location_name; ?></span>
                    <?php endif; ?>

                    <!-- Address -->
                    <p class="business-details">
                        <?php if(!empty($receipt_details->address)): ?>
                            <?php echo $receipt_details->address; ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->contact)): ?>
                        <?php echo $receipt_details->contact; ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->show_website) && !empty($receipt_details->website)): ?>
                        <br><?php echo e($receipt_details->website, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->location_custom_fields)): ?>
                        <br><?php echo e($receipt_details->location_custom_fields, false); ?>

                        <?php endif; ?>
                    </p>

                    <p class="business-details">
                        <?php if(!empty($receipt_details->sub_heading_line1)): ?>
                        <?php echo e($receipt_details->sub_heading_line1, false); ?><br>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->sub_heading_line2)): ?>
                        <?php echo e($receipt_details->sub_heading_line2, false); ?><br>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->sub_heading_line3)): ?>
                        <?php echo e($receipt_details->sub_heading_line3, false); ?><br>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->sub_heading_line4)): ?>
                        <?php echo e($receipt_details->sub_heading_line4, false); ?><br>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->sub_heading_line5)): ?>
                        <?php echo e($receipt_details->sub_heading_line5, false); ?>

                        <?php endif; ?>
                    </p>

                    <p class="tax-info">
                        <?php if(!empty($receipt_details->tax_info1)): ?>
                        <?php echo e($receipt_details->tax_label1, false); ?>

                        <?php echo e($receipt_details->tax_info1, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->tax_info2)): ?>
                        <br><?php echo e($receipt_details->tax_label2, false); ?>

                        <?php echo e($receipt_details->tax_info2, false); ?>

                        <?php endif; ?>
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Invoice Title Section -->
        <div class="invoice-heading-section col-xs-12">
            <?php if(empty($is_delivery_note)): ?>
                <?php if(!empty($receipt_details->invoice_heading)): ?>
                <h3 class="text-center">
                    <?php echo $receipt_details->invoice_heading; ?>

                </h3>
                <?php endif; ?>
            <?php else: ?>
            <h3 class="text-center">
                Delivery Note
            </h3>
            <?php endif; ?>

            <?php if(!empty($receipt_details->takeaway_label)): ?>
            <h4 class="text-center">
                <?php echo $receipt_details->takeaway_label; ?>

            </h4>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="col-xs-12 text-center">
            <img style="width: 100%;margin-bottom: 10px;" src="<?php echo e($receipt_details->letter_head, false); ?>">
        </div>
        <?php endif; ?>
        <div class="col-xs-12">
            <!-- Invoice number, Date - Two column layout -->
            <table style="width:100%; border:none; border-collapse:collapse; margin-bottom:0;">
                <tr>
                    <!-- LEFT COLUMN: Customer Info (left-aligned) -->
                    <td style="width:50%; vertical-align:top; text-align:left; padding:5px; border:none;">

                        <?php if(!empty($receipt_details->token_no)): ?>
                        <?php if(!empty($receipt_details->token_no_label)): ?>
                        <b><?php echo $receipt_details->token_no_label; ?>: </b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->token_no, false); ?>

                        <br>
                        <?php endif; ?>

                        <?php if(!empty($receipt_details->types_of_service)): ?>
                        <strong><?php echo $receipt_details->types_of_service_label; ?>:</strong>
                        <?php echo e($receipt_details->types_of_service, false); ?>

                        <?php if(!empty($receipt_details->types_of_service_custom_fields)): ?>
                        <?php $__currentLoopData = $receipt_details->types_of_service_custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <strong><?php echo e($key, false); ?>: </strong> <?php echo e($value, false); ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        <br>
                        <?php endif; ?>

                        <!-- Table information-->
                        <?php if(!empty($receipt_details->table_label) || !empty($receipt_details->table)): ?>
                        <?php if(!empty($receipt_details->table_label)): ?>
                        <b><?php echo $receipt_details->table_label; ?></b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->table, false); ?>

                        <br>
                        <?php endif; ?>

                        <!-- customer info -->
                        <?php if(!empty($receipt_details->customer_info)): ?>
                        <b style="font-size:<?php echo e($receipt_details->customer_label_font_size, false); ?>"><?php echo e($receipt_details->customer_label, false); ?></b>
                        <br>
                        <span style="font-size:<?php echo e($receipt_details->customer_label_font_size, false); ?>"><?php echo $receipt_details->customer_info; ?></span>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->client_id_label)): ?>
                        <br><b><?php echo e($receipt_details->client_id_label, false); ?></b> <?php echo e($receipt_details->client_id, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->customer_tax_label)): ?>
                        <br><b><?php echo e($receipt_details->customer_tax_label, false); ?></b> <?php echo e($receipt_details->customer_tax_number, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->customer_tax_reg_type_label)): ?>
                        <br><b><?php echo e($receipt_details->customer_tax_reg_type_label, false); ?>:</b> <?php echo e($receipt_details->customer_tax_reg_type, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->customer_custom_fields)): ?>
                        <br><?php echo $receipt_details->customer_custom_fields; ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->customer_rp_label)): ?>
                        <br><strong><?php echo e($receipt_details->customer_rp_label, false); ?></strong> <?php echo e($receipt_details->customer_total_rp, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->customer_note)): ?>
                        <br><strong>Customer Note: </strong>
                        <br/>
                        <?php echo nl2br($receipt_details->customer_note); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->custom_field_1_label)): ?>
                        <br><strong><?php echo $receipt_details->custom_field_1_label; ?> :</strong>
                        <?php echo $receipt_details->custom_field_1 ?? ''; ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->custom_field_3_label)): ?>
                        <br><strong><?php echo $receipt_details->custom_field_3_label; ?> :</strong>
                        <?php echo $receipt_details->custom_field_3 ?? ''; ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->custom_field_5_label)): ?>
                        <br><strong><?php echo $receipt_details->custom_field_5_label; ?> :</strong>
                        <?php echo $receipt_details->custom_field_5 ?? ''; ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->custom_field_7_label)): ?>
                        <br><strong><?php echo $receipt_details->custom_field_7_label; ?> :</strong>
                        <?php echo $receipt_details->custom_field_7 ?? ''; ?>

                        <?php endif; ?>

                    </td>
                    <!-- RIGHT COLUMN: Invoice No, Date, Ref (right-aligned) -->
                    <td style="width:50%; vertical-align:top; text-align:right; padding:5px; border:none;">

                        <?php if(!empty($receipt_details->invoice_no_prefix)): ?>
                        <b><?php echo $receipt_details->invoice_no_prefix; ?></b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->invoice_no, false); ?>

                        <br>
                        <b><?php echo e($receipt_details->date_label, false); ?></b> <?php echo e($receipt_details->invoice_date, false); ?>


                        <?php if(!empty($receipt_details->due_date_label)): ?>
                        <br><b><?php echo e($receipt_details->due_date_label, false); ?></b> <?php echo e($receipt_details->due_date ?? '', false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->custom_field_2_label)): ?>
                        <br><strong><?php echo $receipt_details->custom_field_2_label; ?> :</strong>
                        <?php echo $receipt_details->custom_field_2 ?? ''; ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->custom_field_4_label)): ?>
                        <br><strong><?php echo $receipt_details->custom_field_4_label; ?> :</strong>
                        <?php echo $receipt_details->custom_field_4 ?? ''; ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->custom_field_6_label)): ?>
                        <br><strong><?php echo $receipt_details->custom_field_6_label; ?> :</strong>
                        <?php echo $receipt_details->custom_field_6 ?? ''; ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->custom_field_8_label)): ?>
                        <br><strong><?php echo $receipt_details->custom_field_8_label; ?> :</strong>
                        <?php echo $receipt_details->custom_field_8 ?? ''; ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->token_no)): ?>
                        <br>
                        <b><?php echo e(!empty($receipt_details->token_no_label) ? $receipt_details->token_no_label : 'Token No', false); ?>:</b>
                        <?php echo e($receipt_details->token_no ?? '', false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand)): ?>
                        <br>
                        <?php if(!empty($receipt_details->brand_label)): ?>
                        <b><?php echo $receipt_details->brand_label; ?></b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->repair_brand, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->sales_person_label)): ?>
                        <br><b><?php echo e($receipt_details->sales_person_label, false); ?></b> <?php echo e($receipt_details->sales_person, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->commission_agent_label)): ?>
                        <br><strong><?php echo e($receipt_details->commission_agent_label, false); ?></strong>
                        <?php echo e($receipt_details->commission_agent, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->device_label) || !empty($receipt_details->repair_device)): ?>
                        <br>
                        <?php if(!empty($receipt_details->device_label)): ?>
                        <b><?php echo $receipt_details->device_label; ?></b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->repair_device, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no)): ?>
                        <br>
                        <?php if(!empty($receipt_details->model_no_label)): ?>
                        <b><?php echo $receipt_details->model_no_label; ?></b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->repair_model_no, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no)): ?>
                        <br>
                        <?php if(!empty($receipt_details->serial_no_label)): ?>
                        <b><?php echo $receipt_details->serial_no_label; ?></b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->repair_serial_no, false); ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status)): ?>
                        <br>
                        <?php if(!empty($receipt_details->repair_status_label)): ?>
                        <b><?php echo $receipt_details->repair_status_label; ?></b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->repair_status, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty)): ?>
                        <br>
                        <?php if(!empty($receipt_details->repair_warranty_label)): ?>
                        <b><?php echo $receipt_details->repair_warranty_label; ?></b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->repair_warranty, false); ?>

                        <?php endif; ?>

                        <!-- Waiter info -->
                        <?php if(!empty($receipt_details->service_staff_label) || !empty($receipt_details->service_staff)): ?>
                        <br/>
                        <?php if(!empty($receipt_details->service_staff_label)): ?>
                        <b><?php echo $receipt_details->service_staff_label; ?></b>
                        <?php endif; ?>
                        <?php echo e($receipt_details->service_staff, false); ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->shipping_custom_field_1_label)): ?>
                        <br><strong><?php echo $receipt_details->shipping_custom_field_1_label; ?> :</strong>
                        <?php echo $receipt_details->shipping_custom_field_1_value ?? ''; ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->shipping_custom_field_2_label)): ?>
                        <br><strong><?php echo $receipt_details->shipping_custom_field_2_label; ?>:</strong>
                        <?php echo $receipt_details->shipping_custom_field_2_value ?? ''; ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->shipping_custom_field_3_label)): ?>
                        <br><strong><?php echo $receipt_details->shipping_custom_field_3_label; ?>:</strong>
                        <?php echo $receipt_details->shipping_custom_field_3_value ?? ''; ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->shipping_custom_field_4_label)): ?>
                        <br><strong><?php echo $receipt_details->shipping_custom_field_4_label; ?>:</strong>
                        <?php echo $receipt_details->shipping_custom_field_4_value ?? ''; ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->shipping_custom_field_5_label)): ?>
                        <br><strong><?php echo $receipt_details->shipping_custom_field_2_label; ?>:</strong>
                        <?php echo $receipt_details->shipping_custom_field_5_value ?? ''; ?>

                        <?php endif; ?>
                        
                        <?php if(!empty($receipt_details->sale_orders_invoice_no)): ?>
                        <br>
                        <strong><?php echo app('translator')->get('restaurant.order_no'); ?>:</strong> <?php echo $receipt_details->sale_orders_invoice_no ?? ''; ?>

                        <?php endif; ?>

                        <?php if(!empty($receipt_details->sale_orders_invoice_date)): ?>
                        <br>
                        <strong><?php echo app('translator')->get('lang_v1.order_dates'); ?>:</strong> <?php echo $receipt_details->sale_orders_invoice_date ?? ''; ?>

                        <?php endif; ?>

                    </td>
                </tr>
            </table>

            

        </div>
    </div>

    <div class="row" style="color: #000000 !important;">
        <?php if ($__env->exists('sale_pos.receipts.partial.common_repair_invoice')) echo $__env->make('sale_pos.receipts.partial.common_repair_invoice', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <div class="row" style="color: #000000 !important;">
        <div class="col-xs-12">
            <!-- <br/> -->
            <?php
            $p_width = 45;
            ?>
            <?php if(!empty($receipt_details->inline_unit_discount_label)): ?>
            <?php
            $p_width -= 10;
            ?>
            <?php endif; ?>
            <?php if(!empty($receipt_details->inline_unit_discount2_label)): ?>
            <?php
            $p_width -= 10;
            ?>
            <?php endif; ?>
            <?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
            <?php
            $p_width -= 10;
            ?>
            <?php endif; ?>
            <?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
            <?php
            $p_width -= 10;
            ?>
            <?php endif; ?>
            <?php if(!empty($receipt_details->table_sub_unit_price_label)): ?>
            <?php
            $p_width -= 10;
            
            
            ?>
            <?php endif; ?>
            <div class="table-responsive">
            <table class="table-slim print-table-bordered">
                <thead>
                    <tr>
                        <?php if(empty($receipt_details->hide_sr_number)): ?>
                        <th width="3%">#</th>
                        <?php endif; ?>
                        <?php if($receipt_details->show_sku): ?>
                        <th width="8%"><?php if(!empty($receipt_details->sku_label)): ?><?php echo e($receipt_details->sku_label, false); ?><?php else: ?> <?php echo app('translator')->get('lang_v1.sku_no'); ?> <?php endif; ?></th>
                        <?php endif; ?>
                        <?php if($receipt_details->show_alternate_sku): ?>
                        <th width="8%"><?php if(!empty($receipt_details->alternate_sku_label)): ?><?php echo e($receipt_details->alternate_sku_label, false); ?> <?php endif; ?></th>
                        <?php endif; ?>
                        <?php if($receipt_details->show_brand): ?>
                        <th width="8%"><?php echo app('translator')->get('lang_v1.brand'); ?></th>
                        <?php endif; ?>
                        <th width="<?php echo e($p_width, false); ?>%"><?php echo e($receipt_details->table_product_label, false); ?></th>
                        <?php if(!empty($receipt_details->variation_label)): ?>
                        <th width="8%"><?php echo e($receipt_details->variation_label, false); ?></th>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->show_unit_column)): ?>
                        <th class="text-right" width="5%"><?php echo e($receipt_details->table_qty_unit_label, false); ?></th>
                        <?php endif; ?>
                        <th class="text-right" width="5%"><?php echo e($receipt_details->table_qty_label, false); ?></th>
                        <?php if(!empty($receipt_details->table_foc_quantity_label)): ?>
                        <th class="text-right" width="5%"><?php echo e($receipt_details->table_foc_quantity_label, false); ?></th>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->table_foc_qty_total_label)): ?>
                        <th class="text-right" width="5%"><?php echo e($receipt_details->table_foc_qty_total_label, false); ?></th>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->table_sub_unit_qty_label)): ?>
                        <th class="text-right" width="5%"><?php echo e($receipt_details->table_sub_unit_qty_label, false); ?></th>
                        <?php endif; ?>
                        <?php if(empty($is_delivery_note)): ?>
                            <?php if(!empty($receipt_details->table_unit_price_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->table_unit_price_label, false); ?></th>
                            <?php endif; ?>
                            <?php if(!empty($receipt_details->table_sub_unit_price_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->table_sub_unit_price_label, false); ?></th>
                            <?php endif; ?>
                            <?php if(!empty($receipt_details->inline_unit_discount_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->inline_unit_discount_label, false); ?></th>
                            <?php endif; ?>
                            <?php if(!empty($receipt_details->inline_unit_discount2_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->inline_unit_discount2_label, false); ?></th>
                            <?php endif; ?>
                            <?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->inline_units_discount_total_label, false); ?></th>
                            <?php endif; ?>
                            <?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->inline_unit_discounted_rate_label, false); ?></th>
                            <?php endif; ?>
                            
                            <?php if(!empty($receipt_details->price_inc_tax_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->price_inc_tax_label, false); ?></th>
                            <?php endif; ?>
                            <?php if(!empty($receipt_details->table_subtotal_exc_tax_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->table_subtotal_exc_tax_label, false); ?></th>
                            <?php endif; ?>
                            
                            <?php if(!empty($receipt_details->product_tax_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->product_tax_label, false); ?></th>
                            <?php endif; ?>
                            <?php if(!empty($receipt_details->inline_product_tax_total_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->inline_product_tax_total_label, false); ?></th>
                            <?php endif; ?>
                            <?php if(!empty($receipt_details->table_subtotal_label)): ?>
                            <th class="text-right" width="5%"><?php echo e($receipt_details->table_subtotal_label, false); ?></th>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                
                    <?php
                        $classic_group_products_by_rack = !empty($receipt_details->group_products_by_rack);
                        $classic_lines = $receipt_details->lines;
                        if($classic_group_products_by_rack){
                            $classic_lines = is_array($classic_lines) ? $classic_lines : (method_exists($classic_lines, 'all') ? $classic_lines->all() : iterator_to_array($classic_lines));
                            $classic_lines = array_values($classic_lines);
                            $classic_rack_order = array_flip(array_keys((array)($receipt_details->racks ?? [])));
                            foreach($classic_lines as $classic_line_index => &$classic_sort_line){
                                $classic_sort_line['_receipt_sort_index'] = $classic_line_index;
                            }
                            unset($classic_sort_line);
                            usort($classic_lines, function($a, $b) use ($classic_rack_order){
                                $aRack = $a['rack_key'] ?? '';
                                $bRack = $b['rack_key'] ?? '';
                                $aOrder = $classic_rack_order[$aRack] ?? PHP_INT_MAX;
                                $bOrder = $classic_rack_order[$bRack] ?? PHP_INT_MAX;
                                if($aOrder == $bOrder){
                                    return ($a['_receipt_sort_index'] ?? 0) <=> ($b['_receipt_sort_index'] ?? 0);
                                }
                                return $aOrder <=> $bOrder;
                            });
                            $classic_lines = array_values(array_filter($classic_lines, function($line){
                                return ($line['parent_sell_line_id'] ?? null) == null;
                            }));
                        }
                        $classic_current_rack_key = '__unset__';
                        $current_set_order_classic7 = null;
                    ?>
                    <?php $__empty_1 = true; $__currentLoopData = $classic_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if($classic_group_products_by_rack && $line['parent_sell_line_id'] == null && ($line['rack_key'] ?? '') != $classic_current_rack_key): ?>
                            <?php if($current_set_order_classic7 !== null): ?>
                                <tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
                                <?php $current_set_order_classic7 = null; ?>
                            <?php endif; ?>
                            <?php $classic_current_rack_key = $line['rack_key'] ?? ''; ?>
                            <tr>
                                <td colspan="20" style="padding:4px 8px;background:#f0f0f0;"><b><?php echo e($line['rack_name'] ?? 'No Rack', false); ?></b></td>
                            </tr>
                        <?php endif; ?>
                        <?php if($current_set_order_classic7 !== null && $line['parent_sell_line_id'] == null && (empty($line['product_set_name']) || $line['product_set_order'] != $current_set_order_classic7)): ?>
                            <tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
                            <?php $current_set_order_classic7 = null; ?>
                        <?php endif; ?>
                        <?php if(!empty($line['product_set_name']) && $line['product_set_order'] != $current_set_order_classic7 && $line['parent_sell_line_id'] == null): ?>
                            <?php $current_set_order_classic7 = $line['product_set_order']; ?>
<tr>
    <td colspan="20" style="padding:4px 8px;background:#f0f0f0;">
        <strong><i><?php echo e($line['product_set_name'], false); ?> #<?php echo e($line['product_set_order'], false); ?></i></strong>
    </td>
</tr>
                        <?php endif; ?>
                        <?php if($line['parent_sell_line_id'] == null): ?>
                        <?php
                            $parent_id = $line['line_id'];
                        ?>
                            <tr>
                                <?php if(empty($receipt_details->hide_sr_number)): ?>
                                <td><?php echo e($loop->index+1, false); ?></td>
                                <?php endif; ?>
                                <?php if($receipt_details->show_sku): ?>
                                <td><?php if(!empty($line['sub_sku'])): ?> <?php echo e($line['sub_sku'], false); ?> <?php endif; ?></td>
                                <?php endif; ?>
                                <?php if($receipt_details->show_alternate_sku): ?>
                                <td><?php if(!empty($line['alternate_sku'])): ?> <?php echo e($line['alternate_sku'], false); ?> <?php endif; ?></td>
                                <?php endif; ?>
                                <?php if($receipt_details->show_brand): ?>
                                <td><?php if(!empty($line['brand'])): ?> <?php echo e($line['brand'], false); ?> <?php endif; ?> </td>
                                <?php endif; ?>
                                <td>
                                    <?php if(!empty($line['image'])): ?>
                                    <img src="<?php echo e($line['image'], false); ?>" alt="Image" width="50"
                                        style="float: left; margin-right: 8px;">
                                    <?php endif; ?>
                                    <?php echo e($line['name'], false); ?> 
                                    
                                    <?php if(!empty($line['other_name'])): ?><br>(<?php echo e($line['other_name'], false); ?>)<?php endif; ?>
                                    <?php if(!empty($line['cat_code'])): ?>, <?php echo e($line['cat_code'], false); ?><?php endif; ?>
                                    <?php if(!empty($line['product_custom_fields'])): ?>, <?php echo e($line['product_custom_fields'], false); ?> <?php endif; ?>
                                    <?php if(!empty($line['product_description'])): ?>
                                    <small>
                                        <?php echo $line['product_description']; ?>

                                    </small>
                                    <?php endif; ?>
                                    <?php if(!empty($line['sell_line_note'])): ?>
                                    <br>
                                    <small>
                                        <?php echo $line['sell_line_note']; ?>

                                    </small>
                                    <?php endif; ?>
                                    <?php if(!empty($line['lot_number'])): ?><br> <?php echo e($line['lot_number_label'], false); ?>: <?php echo e($line['lot_number'], false); ?>

                                    <?php endif; ?>
                                    <?php if(!empty($line['product_expiry'])): ?>, <?php echo e($line['product_expiry_label'], false); ?>:
                                    <?php echo e($line['product_expiry'], false); ?> <?php endif; ?>

                                    <?php if(!empty($line['warranty_name'])): ?> <br><small><?php echo e($line['warranty_name'], false); ?> </small><?php endif; ?>
                                    <?php if(!empty($line['warranty_exp_date'])): ?> <small>-
                                        <?php echo e(\Carbon::createFromTimestamp(strtotime($line['warranty_exp_date']))->format(session('business.date_format')), false); ?> </small><?php endif; ?>
                                    <?php if(!empty($line['warranty_description'])): ?> <small>
                                        <?php echo e($line['warranty_description'] ?? '', false); ?></small><?php endif; ?>

                                    <?php if($receipt_details->show_base_unit_details && $line['quantity'] &&
                                    $line['base_unit_multiplier'] !== 1): ?>
                                    <br><small>
                                        1 <?php echo e($line['units'], false); ?> = <?php echo e($line['base_unit_multiplier'], false); ?> <?php echo e($line['base_unit_name'], false); ?>

                                        <br>
                                        <?php echo e($line['base_unit_price'], false); ?> x <?php echo e($line['orig_quantity'], false); ?> = <?php echo e($line['line_total'], false); ?>

                                    </small>
                                    <?php endif; ?>
                                    <?php if(!empty(
                                        $receipt_details->serial_number_label)): ?>
                                    <small>
                                    <br>
                                    <?php echo e($receipt_details->serial_number_label, false); ?> : <?php echo e($line['serial_number'], false); ?>

                                    </small>
                                    <?php endif; ?>
                                    <?php if(!empty($receipt_details->imei_number_labels)): ?>
                                    <small>
                                    <?php $__currentLoopData = $receipt_details->imei_number_labels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $inl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(!empty($line['imei_numbers'][$key])): ?>
                                        <br>
                                        <?php echo e($inl, false); ?> : <?php echo e($line['imei_numbers'][$key], false); ?>    
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </small>
                                    <?php endif; ?>

                                </td>
                                <?php if($receipt_details->variation_label): ?>
                                <td><?php echo e($line['product_variation'], false); ?> <?php echo e($line['variation'], false); ?></td>
                                <?php endif; ?>
                                <?php if(!empty($receipt_details->show_unit_column)): ?>
                                <td class="text-right"><?php echo e($line['units'], false); ?></td>
                                <?php endif; ?>
                                <td class="text-right">
                                    <?php echo e($line['quantity'], false); ?>

                                    <?php if(!empty($receipt_details->show_unit_inline)): ?> <?php echo e($line['units'], false); ?> <?php endif; ?>

                                    <?php if($receipt_details->show_base_unit_details && $line['quantity'] &&
                                    $line['base_unit_multiplier'] !== 1): ?>
                                    <br><small>
                                        <?php echo e($line['quantity'], false); ?> x <?php echo e($line['base_unit_multiplier'], false); ?> = <?php echo e($line['orig_quantity'], false); ?>

                                        <?php echo e($line['base_unit_name'], false); ?>

                                    </small>
                                    <?php endif; ?>
                                </td>
                                <?php if(!empty($receipt_details->table_foc_quantity_label)): ?>
                                <td class="text-right"><?php echo e($line['foc_quantity'], false); ?> <?php echo e($line['foc_units'], false); ?> </td>
                                <?php endif; ?>
                                <?php if(!empty($receipt_details->table_foc_qty_total_label)): ?>
                                <td class="text-right"><?php echo e($line['foc_qty_total'], false); ?> </td>
                                <?php endif; ?>
                                
                                <?php if(!empty($receipt_details->table_sub_unit_qty_label)): ?>
                                <td class="text-right">
                                    <?php if($line['base_unit_multiplier'] != 1): ?>
                                        <?php echo e($line['orig_quantity'], false); ?>

                                        <?php if(!empty($receipt_details->show_unit)): ?>
                                        <?php echo e($line['base_unit_name'], false); ?>

                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php if(empty($is_delivery_note)): ?>
                                <?php if($line['base_unit_multiplier'] == 1): ?>
                                    <?php if(!empty($receipt_details->table_sub_unit_price_label)): ?>
                                    <td class="text-right"><?php echo e($line['unit_price_before_discount'], false); ?></td>
                                    <td></td>
                                    <?php else: ?>
                                        <?php if(!empty($receipt_details->table_unit_price_label)): ?>
                                        <td class="text-right"><?php echo e($line['unit_price_before_discount'], false); ?></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                <?php if(!empty($receipt_details->table_sub_unit_price_label)): ?>
                                <td class="text-right"><?php echo e($line['base_sub_unit_price'], false); ?></td>
                                <td class="text-right"><?php echo e($line['unit_price_before_discount'], false); ?></td>
                                <?php else: ?>
                                <?php if(!empty($receipt_details->table_unit_price_label)): ?>
                                <td class="text-right"><?php echo e($line['unit_price_before_discount'], false); ?></td>
                                <?php endif; ?>
                                <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php if(!empty($receipt_details->inline_unit_discount_label)): ?>
                                <td class="text-right">
                                    <?php echo e($line['line_discount'] ?? '0.00', false); ?>

                                </td>
                                <?php endif; ?>
                                <?php if(!empty($receipt_details->inline_unit_discount2_label)): ?>
                                <td class="text-right">
                                    <?php echo e($line['line_discount2'] ?? '0.00', false); ?>

                                </td>
                                <?php endif; ?>
                                
                                <?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
                                <td class="text-right">
                                    <?php echo e($line['total_line_discount'] ?? '0.00', false); ?>

                                    <?php if(!empty($line['line_discount_percent'])): ?>
                                        (<?php echo e($line['line_discount_percent'], false); ?>%)
                                    <?php endif; ?>
                                </td>
                                <?php endif; ?>
                                <?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
                                <td class="text-right">
                                    <?php echo e($line['unit_price'], false); ?>

                                </td>
                                <?php endif; ?>
                                
                                <?php if(!empty($receipt_details->price_inc_tax_label)): ?>
                                <td class="text-right"><?php echo e($line['unit_price_inc_tax'], false); ?></td>
                                <?php endif; ?>
                                <?php if(!empty($receipt_details->table_subtotal_exc_tax_label)): ?>
                                <td class="text-right"><?php echo e($line['line_total_exc_tax'], false); ?></td>
                                <?php endif; ?>
                                <?php if(!empty($receipt_details->product_tax_label)): ?>
                                
                                <td class="text-right"><?php echo e($line['tax'], false); ?></td>
                                <?php endif; ?>
                                <?php if(!empty($receipt_details->inline_product_tax_total_label)): ?>
                                
                                <td class="text-right"><?php echo e($line['line_tax_total_f'], false); ?></td>
                                <?php endif; ?>
                                <?php if(!empty($receipt_details->table_subtotal_label)): ?>
                                <td class="text-right"><?php echo e($line['line_total'], false); ?></td>
                                <?php endif; ?>
                                <?php endif; ?>
                            </tr>
                        <?php endif; ?>
                        <?php if($line['type'] == 'Package'): ?>
                            <?php $__currentLoopData = $receipt_details->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(($item['parent_sell_line_id'] == $parent_id) && ($item['children_type'] == 'combo') && ($item['sell_line_note'] != 'Combo Item')): ?>    
                                <tr>
                                        <td></td>
                                        <td>
                                            <?php if(!empty($item['image'])): ?>
                                            <img src="<?php echo e($item['image'], false); ?>" alt="Image" width="50"
                                                style="float: left; margin-right: 8px;">
                                            <?php endif; ?>
                                            <?php echo e($item['name'], false); ?>


                                            <?php if(!empty($item['sub_sku'])): ?>, <?php echo e($item['sub_sku'], false); ?> <?php endif; ?> <?php if(!empty($item['brand'])): ?>,
                                            <?php echo e($item['brand'], false); ?> <?php endif; ?> <?php if(!empty($item['cat_code'])): ?>, <?php echo e($item['cat_code'], false); ?><?php endif; ?>
                                            <?php if(!empty($item['product_custom_fields'])): ?>, <?php echo e($item['product_custom_fields'], false); ?> <?php endif; ?>
                                            <?php if(!empty($item['product_description'])): ?>
                                            <small>
                                                <?php echo $item['product_description']; ?>

                                            </small>
                                            <?php endif; ?>
                                            <?php if(!empty($item['sell_line_note'])): ?>
                                            <br>
                                            <small>
                                                <?php echo $item['sell_line_note']; ?>

                                            </small>
                                            <?php endif; ?>
                                            <?php if(!empty($item['lot_number'])): ?><br> <?php echo e($item['lot_number_label'], false); ?>: <?php echo e($item['lot_number'], false); ?>

                                            <?php endif; ?>
                                            <?php if(!empty($item['product_expiry'])): ?>, <?php echo e($item['product_expiry_label'], false); ?>:
                                            <?php echo e($item['product_expiry'], false); ?> <?php endif; ?>

                                            <?php if(!empty($item['warranty_name'])): ?> <br><small><?php echo e($item['warranty_name'], false); ?> </small><?php endif; ?>
                                            <?php if(!empty($item['warranty_exp_date'])): ?> <small>-
                                                <?php echo e(\Carbon::createFromTimestamp(strtotime($item['warranty_exp_date']))->format(session('business.date_format')), false); ?> </small><?php endif; ?>
                                            <?php if(!empty($item['warranty_description'])): ?> <small>
                                                <?php echo e($item['warranty_description'] ?? '', false); ?></small><?php endif; ?>

                                            <?php if($receipt_details->show_base_unit_details && $item['quantity'] &&
                                            $item['base_unit_multiplier'] !== 1): ?>
                                            <br><small>
                                                1 <?php echo e($item['units'], false); ?> = <?php echo e($item['base_unit_multiplier'], false); ?> <?php echo e($item['base_unit_name'], false); ?>

                                                <br>
                                                <?php echo e($item['base_unit_price'], false); ?> x <?php echo e($item['orig_quantity'], false); ?> = <?php echo e($item['line_total'], false); ?>

                                            </small>
                                            <?php endif; ?>
                                        </td>
                                        <?php if($receipt_details->variation_label): ?>
                                        <td><?php echo e($item['product_variation'], false); ?> <?php echo e($item['variation'], false); ?></td>
                                        <?php endif; ?>
                                        <?php if(!empty($receipt_details->show_unit_column)): ?>
                                        <td class="text-right"><?php echo e($item['units'], false); ?></td>
                                        <?php endif; ?>
                                        <td class="text-right">
                                            <?php echo e($item['quantity'], false); ?>

                                            <?php if(!empty($receipt_details->show_unit_inline)): ?> <?php echo e($item['units'], false); ?> <?php endif; ?>

                                            <?php if($receipt_details->show_base_unit_details && $item['quantity'] &&
                                            $item['base_unit_multiplier'] !== 1): ?>
                                            <br><small>
                                                <?php echo e($item['quantity'], false); ?> x <?php echo e($item['base_unit_multiplier'], false); ?> = <?php echo e($item['orig_quantity'], false); ?>

                                                <?php echo e($item['base_unit_name'], false); ?>

                                            </small>
                                            <?php endif; ?>
                                        </td>
                                        <?php if(empty($is_delivery_note)): ?>
                                        <?php if($item['base_unit_multiplier'] == 1): ?>
                                        <?php if(!empty($receipt_details->table_sub_unit_price_label)): ?>
                                        <td class="text-right"><?php echo e($item['unit_price_before_discount'], false); ?></td>
                                        <td></td>
                                        <?php else: ?>
                                        <?php if(!empty($receipt_details->table_unit_price_label)): ?>
                                        <td class="text-right"><?php echo e($item['unit_price_before_discount'], false); ?></td>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php else: ?>
                                        <?php if(!empty($receipt_details->table_sub_unit_price_label)): ?>
                                        <td class="text-right"><?php echo e($item['base_sub_unit_price'], false); ?></td>
                                        <td class="text-right"><?php echo e($item['unit_price_before_discount'], false); ?></td>
                                        <?php else: ?>
                                        <?php if(!empty($receipt_details->table_unit_price_label)): ?>
                                        <td class="text-right"><?php echo e($item['unit_price_before_discount'], false); ?></td>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
                                        <td class="text-right">
                                            <?php echo e($item['unit_price'], false); ?>

                                        </td>
                                        <?php endif; ?>

                                        <?php if(!empty($receipt_details->inline_unit_discount_label)): ?>
                                        <td class="text-right">
                                            <?php echo e($item['line_discount'] ?? '0.00', false); ?>

                                        </td>
                                        <?php endif; ?>
                                        <?php if(!empty($receipt_details->inline_unit_discount2_label)): ?>
                                        <td class="text-right">
                                            <?php echo e($item['line_discount2'] ?? '0.00', false); ?>

                                        </td>
                                        <?php endif; ?>
                                        <?php if(!empty($receipt_details->inline_units_discount_total_label)): ?>
                                        <td class="text-right">
                                            <?php echo e($item['total_line_discount'] ?? '0.00', false); ?>


                                            <?php if(!empty($item['line_discount_percent'])): ?>
                                            (<?php echo e($item['line_discount_percent'], false); ?>%)
                                            <?php endif; ?>
                                        </td>
                                        <?php endif; ?>
                                        <?php if(!empty($receipt_details->product_tax_label)): ?>
                                        <td class="text-right"><?php echo e($item['tax'], false); ?> <?php echo e($item['tax_name'], false); ?></td>
                                        <?php endif; ?>
                                        <?php if(!empty($receipt_details->inline_product_tax_total_label)): ?>
                                        <td class="text-right"><?php echo e($item['line_tax_total_f'], false); ?> <?php echo e($item['tax_name'], false); ?></td>
                                        <?php endif; ?>
                                        <?php if(!empty($receipt_details->price_inc_tax_label)): ?>
                                        <td class="text-right"><?php echo e($item['unit_price_inc_tax'], false); ?></td>
                                        <?php endif; ?>
                                        <td class="text-right"><?php echo e($item['line_total_exc_tax'], false); ?></td>
                                        <td class="text-right"><?php echo e($item['line_total'], false); ?></td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if(!empty($line['line_discount_percent'])): ?>
                            (<?php echo e($line['line_discount_percent'], false); ?>%)
                            <?php endif; ?>
                        </td>
                        <?php endif; ?>
                        
                        
                    
                    <?php if(!empty($line['modifiers'])): ?>
                    <?php $__currentLoopData = $line['modifiers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modifier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php echo e($modifier['name'], false); ?> <?php echo e($modifier['variation'], false); ?>

                            <?php if(!empty($modifier['sub_sku'])): ?>, <?php echo e($modifier['sub_sku'], false); ?> <?php endif; ?>
                            <?php if(!empty($modifier['cat_code'])): ?>, <?php echo e($modifier['cat_code'], false); ?><?php endif; ?>
                            <?php if(!empty($modifier['sell_line_note'])): ?>(<?php echo $modifier['sell_line_note']; ?>) <?php endif; ?>
                        </td>
                        <?php if(!empty($receipt_details->show_unit_column)): ?>
                        <td class="text-right"><?php echo e($modifier['units'], false); ?></td>
                        <?php endif; ?>
                        <td class="text-right"><?php echo e($modifier['quantity'], false); ?><?php if(!empty($receipt_details->show_unit_inline)): ?> <?php echo e($modifier['units'], false); ?> <?php endif; ?></td>
                        
                        <?php if(!empty($receipt_details->inline_unit_discounted_rate_label)): ?>
                        <td class="text-right"><?php echo e($modifier['unit_price_exc_tax'], false); ?></td>
                        <?php endif; ?>
                        <td class="text-right"><?php echo e($modifier['unit_price_inc_tax'], false); ?></td>
                        
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                    <?php endif; ?>
                					<?php if($current_set_order_classic7 !== null): ?>
						<tr><td colspan="20" style="border-bottom:2px solid #333;padding:0;"></td></tr>
					<?php endif; ?>
</tbody>
            </table>
            </div>
        </div>
    </div>
    <?php if(!empty($receipt_details->additional_notes)): ?>
    <div class="col-xs-12">
        <p><?php echo nl2br($receipt_details->additional_notes); ?></p>
    </div>
    <?php endif; ?>
    

    <div class="clearfix"></div>
    <div class="border-bottom col-md-12">
        <?php if(empty($receipt_details->hide_price) && !empty($receipt_details->tax_summary_label) ): ?>
        <!-- tax -->
        <?php if(!empty($receipt_details->taxes)): ?>
        <table class="table-slim print-table-bordered">
            <tr>
                <th colspan="2" class="text-center"><?php echo e($receipt_details->tax_summary_label, false); ?></th>
            </tr>
            <?php $__currentLoopData = $receipt_details->taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="text-center"><b><?php echo e($key, false); ?></b></td>
                <td class="text-center"><?php echo e($val, false); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </table>
        <?php endif; ?>
        <?php endif; ?>
    </div>
    <!-- Spacer pushes footer to bottom of A4 page -->
    <div style="flex-grow:1;"></div>
    <!-- Bottom section pinned to page end -->
    <div style="flex-shrink:0;">
    <table style="width:100%; color:#000000 !important; border-collapse:collapse;">
        <tr>
            <td style="width:50%; text-align:left; vertical-align:bottom; padding:4px;">
                <?php if(!empty($receipt_details->footer_text)): ?>
                <div>
                    <?php echo $receipt_details->footer_text; ?>

                </div>
                <?php endif; ?>
            </td>
            <td style="width:50%; text-align:right; vertical-align:bottom; padding:4px;">
            <div class="table-responsive">
                <table class="table-slim print-table-bordered" style="margin-left:auto;">
                    <tbody>
                        <?php if(!empty($receipt_details->total_quantity_label)): ?>
                            <tr>
                                <th style="width:60%; text-align:right;">
                                    <?php echo $receipt_details->total_quantity_label; ?>

                                </th>
                                <td class="text-right">
                                    <?php echo e(implode(', ',$receipt_details->total_quantity), false); ?>

                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->total_items_label)): ?>
                        <tr>
                            <th style="width:60%; text-align:right;">
                                <?php echo $receipt_details->total_items_label; ?>

                            </th>
                            <td class="text-right">
                                <?php echo e($receipt_details->total_items, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php if(!empty($receipt_details->packing_charge)): ?>
                        <tr>
                            <th style="width:60%; text-align:right;">
                                
                                <?php echo e($receipt_details->types_of_service, false); ?>

                            </th>
                            <td class="text-right">
                                <?php echo e($receipt_details->packing_charge, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(empty($is_delivery_note)): ?>
                        
                        <?php if(!empty($receipt_details->sub_total_exc_tax_label) ): ?>
                        <tr style="font-weight: <?php echo e(!empty($receipt_details->sub_total_exc_tax_bold) ? '700' : '400', false); ?> !important;">
                            <td style="width:60%; text-align:right;">
                                <?php echo $receipt_details->sub_total_exc_tax_label; ?>

                            </td>
                            <td class="text-right">
                                <?php echo e($receipt_details->subtotal_exc_tax, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php if(!empty($receipt_details->subtotal_label) ): ?>
                        <tr style="font-weight: <?php echo e(!empty($receipt_details->sub_total_inc_tax_bold) ? '700' : '400', false); ?> !important;">
                            <td style="width:60%; text-align:right;">
                                <?php echo $receipt_details->subtotal_label; ?>

                            </td>
                            <td class="text-right">
                                <?php echo e($receipt_details->subtotal, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php endif; ?>
                        <?php if(!empty($receipt_details->table_foc_qty_total_label) ): ?>
                        <tr>
                            <th style="width:60%; text-align:right;">
                                <?php echo $receipt_details->table_foc_qty_total_label; ?>

                            </th>
                            <td class="text-right">
                                <?php echo e($receipt_details->foc_qty_subtotal, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->total_exempt_uf)): ?>
                        <tr>
                            <th style="width:60%; text-align:right;">
                                <?php echo app('translator')->get('lang_v1.exempt'); ?>
                            </th>
                            <td class="text-right">
                                <?php echo e($receipt_details->total_exempt, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <!-- Shipping Charges -->
                        <?php if(!empty($receipt_details->shipping_charges)): ?>
                        <tr>
                            <th style="width:60%; text-align:right;">
                                <?php echo $receipt_details->shipping_charges_label; ?>

                            </th>
                            <td class="text-right">
                                <?php echo e($receipt_details->shipping_charges, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if(empty($is_delivery_note)): ?>
                        <!-- Discount -->
                        <?php if( !empty($receipt_details->total_line_discount) ): ?>
                        <tr>
                            <th style="text-align:right;">
                                <?php echo $receipt_details->line_discount_label; ?>

                            </th>

                            <td class="text-right">
                                (-) <?php echo e($receipt_details->total_line_discount, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php if( !empty($receipt_details->total_line_discount2) ): ?>
                        <tr>
                            <th style="text-align:right;">
                                <?php echo $receipt_details->line_discount2_label; ?>

                            </th>

                            <td class="text-right">
                                (-) <?php echo e($receipt_details->total_line_discount2, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        
                        <!-- Discount -->
                        <?php if( !empty($receipt_details->discount) ): ?>
                        <tr>
                            <th style="text-align:right;">
                                <?php echo $receipt_details->discount_label; ?>

                            </th>

                            <td class="text-right">
                                (-) <?php echo e($receipt_details->discount, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>
                        <?php if( !empty($receipt_details->discount2_label) ): ?>
                        <tr>
                            <th style="text-align:right;">
                                <?php echo $receipt_details->discount2_label; ?>

                            </th>

                            <td class="text-right">
                                (-) <?php echo e($receipt_details->discount2, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php if( !empty($receipt_details->additional_expenses) ): ?>
                        <?php $__currentLoopData = $receipt_details->additional_expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php echo e($key, false); ?>:
                            </td>

                            <td class="text-right">
                                (+) <?php echo e($val, false); ?>

                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <?php if( !empty($receipt_details->reward_point_label) ): ?>
                        <tr>
                            <th style="text-align:right;">
                                <?php echo $receipt_details->reward_point_label; ?>

                            </th>

                            <td class="text-right">
                                (-) <?php echo e($receipt_details->reward_point_amount, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <!-- product line total Tax below -->
                        <?php if( !empty($receipt_details->total_line_taxes) ): ?>
                        
                            <?php $__currentLoopData = $receipt_details->taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($loop->last): ?>
                                <?php continue; ?>
                            <?php endif; ?>
                            <tr>
                                <th style="text-align:right;">
                                    <?php echo e($key, false); ?>

                                </th>
                                <td class="text-right">
                                    (+) <?php echo e($val, false); ?>

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <!-- invoice Tax below -->
                        <?php if( !empty($receipt_details->tax) ): ?>
                        <tr>
                            <th style="text-align:right;">
                                <?php echo $receipt_details->tax_label; ?>

                            </th>
                            <td class="text-right">
                                (+) <?php echo e($receipt_details->tax, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php if( $receipt_details->round_off_amount > 0): ?>
                        <tr>
                            <th style="text-align:right;">
                                <?php echo $receipt_details->round_off_label; ?>

                            </th>
                            <td class="text-right">
                                <?php echo e($receipt_details->round_off, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <!-- Total -->
                        <?php if(!empty($receipt_details->total_label) ): ?>
                        
                            <tr>
                                <th style="font-size:<?php echo e($receipt_details->total_label_font_size, false); ?>">
                                    <?php echo $receipt_details->total_label; ?>

                                </th>
                                <td class="text-right" style="font-size:<?php echo e($receipt_details->total_label_font_size, false); ?>">
                                    <?php echo e($receipt_details->total, false); ?>

                                    
                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->prev_bal_label) && !empty($receipt_details->prev_bal)): ?>
                            <tr>
                                <th style="text-align:right;">
                                    <?php echo $receipt_details->prev_bal_label; ?>

                                </th>
                                <td class="text-right">
                                    <?php echo e($receipt_details->prev_bal, false); ?>

                                </td>
                            </tr>
                        <?php endif; ?>
                        <?php if(!empty($receipt_details->cur_total_label)): ?>
                            <tr>
                                <th style="text-align:right;">
                                    <?php echo $receipt_details->cur_total_label; ?>

                                </th>
                                <td class="text-right">
                                    <?php echo e($receipt_details->cur_total_due, false); ?>

                                </td>
                            </tr>
                        <?php endif; ?>

                        <!-- Total Paid-->
                        <?php if(!empty($receipt_details->total_paid_label) && !empty($receipt_details->total_paid)): ?>
                        <tr>
                            <th style="text-align:right;">
                                <?php echo $receipt_details->total_paid_label; ?>

                            </th>
                            <td class="text-right">
                                <?php echo e($receipt_details->total_paid, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php if(!empty($receipt_details->payments)): ?>
                            <?php $__currentLoopData = $receipt_details->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $payment['method']; ?></td>
                                <td class="text-right"><?php echo e($payment['amount'], false); ?></td>
                                <?php if(!empty($receipt_details->show_payment_date)): ?>
                                <td class="text-right"><?php echo e($payment['date'], false); ?></td>
                                <?php endif; ?>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <!-- Total Due-->
                        <?php if(!empty($receipt_details->total_due) && !empty($receipt_details->total_due_label)): ?>
                        <tr>
                            <th style="text-align:right;">
                                <?php echo $receipt_details->total_due_label; ?>

                            </th>
                            <td class="text-right">
                                <?php echo e($receipt_details->total_due, false); ?>

                            </td>
                        </tr>
                        <?php endif; ?>

                        <?php endif; ?>
                    </tbody>
                </table>
                
            </div>
            </td>
        </tr>
    </table>
    <div class="row">
        
        <div class="col-xs-6 text-right">
            <?php if(!empty($receipt_details->total_in_words)): ?>
            <small>(<?php echo e($receipt_details->total_in_words, false); ?>)</small>
            <?php endif; ?>
        </div>
    </div>

    <div class="row" style="padding-top:5px;">

        <?php if($receipt_details->disable_fbr != 1): ?>
            <?php if($receipt_details->fbr_invoice_no != "Not Available" && !empty($receipt_details->fbr_invoice_no)): ?>
                <div class="col-xs-6 text-center">
                    <?php if(!empty($receipt_details->fbr_invoice_no)): ?>
                        <?php if($receipt_details->fbr_di): ?>
                            <img style="margin-left:15px;" class="img-fluid" height="90px" width="90px" src="/uploads/fbr-di-logo.png">
                            <span style="margin-left:15px;">
                                <img class="img-fluid" height="90px" width="90px" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->fbr_invoice_no, 'QRCODE', 3, 3, [39, 48, 54]), false); ?>">
                            </span>
                            <br>
                            <b>FBR Inv No: </b> <?php echo e($receipt_details->fbr_invoice_no, false); ?><br>
                            <b>Date: </b> <?php echo e($receipt_details->invoice_date, false); ?><br>
                        <?php else: ?>
                            <img style="margin-left:15px;" class="img-fluid" height="90px" width="90px" src="/uploads/fbr-logo.png">
                            <span style="margin-left:15px;">
                                <img class="img-fluid" height="90px" width="90px" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->fbr_invoice_no, 'QRCODE', 3, 3, [39, 48, 54]), false); ?>">
                            </span>
                            <br>    
                            <b>FBR Inv No: </b> <?php echo e($receipt_details->fbr_invoice_no, false); ?><br>
                            <?php if($receipt_details->fbr_invoice_no != "Not Available"): ?>
                                <?php if(empty($receipt_details->fbr_pos_id)): ?>
                                    <b>FBR POS ID:</b> <?php echo e(substr($receipt_details->fbr_invoice_no, 0, 6), false); ?><br>
                                    <b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>	
                                <?php else: ?>
                                    <b>FBR POS ID:</b> <?php echo e($receipt_details->fbr_pos_id, false); ?><br>
                                    <b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>	
                                <?php endif; ?>
                            <?php else: ?>
                                <b>POS ID Invalid</b>
                            <?php endif; ?>
                        <?php endif; ?> 
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if($receipt_details->pra_invoice_no != "Not Available" && !empty($receipt_details->pra_invoice_no)): ?>
            <div class="col-xs-6 text-center">
                <?php if(!empty($receipt_details->pra_invoice_no)): ?>
                    <img style="margin-left:15px;" class="img-fluid" height="90px" width="90px" src="/uploads/pra-logo.png">
                    <span style="margin-left:15px;">
                        <img class="img-fluid" height="90px" width="90px" src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->pra_invoice_no, 'QRCODE', 3, 3, [39, 48, 54]), false); ?>">
                    </span>
                    <br>
                    <b>PRA Inv No: </b> <?php echo e($receipt_details->pra_invoice_no, false); ?><br>
                    <?php if($receipt_details->pra_invoice_no != "Not Available"): ?>
                        <?php if(empty($receipt_details->pra_pos_id)): ?>
                            <b>PRA Pos ID:</b> <?php echo e(substr($receipt_details->pra_invoice_no, 0, 6), false); ?><br>
                            <b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>
                        <?php else: ?>
                            <b>PRA Pos ID:</b> <?php echo e($receipt_details->pra_pos_id, false); ?><br>
                            <b>Date:</b> <?php echo e($receipt_details->invoice_date, false); ?><br>
                        <?php endif; ?>
                    <?php else: ?>
                        <b>POS ID Invalid</b>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            
        <?php endif; ?>

    </div>
    
    <div class="row" style="color: #000000 !important;">
        <?php if($receipt_details->show_barcode || $receipt_details->show_qr_code): ?>
        <div class="<?php if(!empty($receipt_details->footer_text)): ?> col-xs-4 <?php else: ?> col-xs-12 <?php endif; ?> text-center">
            <?php if($receipt_details->show_barcode): ?>
            
            <img class="center-block"
                src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
            <?php endif; ?>

            <?php if($receipt_details->show_qr_code && !empty($receipt_details->qr_code_text)): ?>
            <img class="center-block mt-5"
                src="data:image/png;base64,<?php echo e(DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE', 3, 3, [39, 48, 54]), false); ?>">
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($receipt_details->footer_logo)): ?>
        <div class="row text-center">
            <div class="col-md-12">
            <img style="width: 100%" src="<?php echo e($receipt_details->footer_logo, false); ?>">
            </div>
        </div>
        <?php endif; ?>
        <div>
            <?php if(!$receipt_details->hide_invoice_branding): ?>
            <small>
                <p style="text-align: left; font-size:10px;"><?php echo env('BRANDING_TEXT'); ?></p>
            </small>
            <?php endif; ?>
        </div>
    </div>
    </div><!-- end bottom section -->
    
</div>


