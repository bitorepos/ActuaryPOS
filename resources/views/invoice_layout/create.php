
<?php $__env->startSection('title', __('invoice.add_invoice_layout')); ?>
<?php $__env->startSection('content'); ?>
<style type="text/css">
    .invoice-layout-accordion .accordion-item {
        border: 1px solid rgba(0,0,0,.08);
        border-radius: 0.5rem !important;
        margin-bottom: 0.75rem;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,.04);
        transition: box-shadow 0.2s;
    }
    .invoice-layout-accordion .accordion-item:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
    }
    .invoice-layout-accordion .accordion-button {
        font-size: 0.95rem;
        font-weight: 600;
        padding: 0.85rem 1.25rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
        color: #333;
        gap: 0.5rem;
    }
    .invoice-layout-accordion .accordion-button:not(.collapsed) {
        background: linear-gradient(135deg, #e8f0fe 0%, #f0f4ff 100%);
        color: #1a56db;
        box-shadow: none;
    }
    .invoice-layout-accordion .accordion-button:focus {
        box-shadow: 0 0 0 0.15rem rgba(26,86,219,.15);
    }
    .invoice-layout-accordion .accordion-button::after {
        transition: transform 0.3s ease;
    }
    .invoice-layout-accordion .accordion-button .section-icon {
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.375rem;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .invoice-layout-accordion .accordion-button:not(.collapsed) .section-icon {
        background: rgba(26,86,219,.12);
        color: #1a56db;
    }
    .invoice-layout-accordion .accordion-button.collapsed .section-icon {
        background: rgba(0,0,0,.05);
        color: #666;
    }
    .invoice-layout-accordion .accordion-body {
        padding: 1.25rem;
        border-top: 1px solid rgba(0,0,0,.06);
    }
    .invoice-layout-accordion .accordion-collapse {
        transition: height 0.3s ease;
    }
</style>
<?php
$custom_labels = json_decode(session('business.custom_labels'), true);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('invoice.add_invoice_layout'); ?></h1>
    <br>
    <?php echo $__env->make('layouts.partials.search_settings', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</section>
<!-- Main content -->
<section class="content">
    <?php echo Form::open(['url' => action([\App\Http\Controllers\InvoiceLayoutController::class, 'store']), 'method' =>
    'post', 'id' => 'add_invoice_layout_form', 'files' => true]); ?>

    <div class="accordion invoice-layout-accordion" id="invoiceAccordion">

        <!-- 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <span class="section-icon"><i class="fas fa-file-invoice"></i></span>
                    <?php echo app('translator')->get('lang_v1.invoice_layout_type'); ?>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('name', __('invoice.layout_name') . ':*'); ?>

                            <?php echo Form::text('name', null, ['class' => 'form-control', 'required',
                            'placeholder' => __('invoice.layout_name')]); ?>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('design', __('lang_v1.design') . ':*'); ?>

                            <?php echo Form::select('design', $designs, 'classic', ['class' => 'form-control']); ?>

                            <span class="help-block">
                                <?php echo app('translator')->get('lang_v1.used_for_browser_based_printing'); ?>
                            </span>
                        </div>
                        <div class="form-group mb-2 hide" id="columnize-taxes">
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="table_tax_headings[]"
                                    required="required" placeholder="tax 1 name" disabled>
                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_columnize_taxes_heading') . '"></i>';
                }
            ?>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="table_tax_headings[]"
                                    placeholder="tax 2 name" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="table_tax_headings[]"
                                    placeholder="tax 3 name" disabled>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="table_tax_headings[]"
                                    placeholder="tax 4 name" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_letter_head', 1, false,
                                    ['class' => 'form-check-input', 'id' => 'show_letter_head']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_letter_head'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('is_default', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('barcode.set_as_default'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 letter_head_input hide">
                        <div class="form-group mb-2">
                            <?php echo Form::label('letter_head', __('lang_v1.letter_head') . ':'); ?>

                            <?php echo Form::file('letter_head', ['accept' => 'image/*']); ?>

                            <span class="help-block"><?php echo app('translator')->get('lang_v1.letter_head_help'); ?> <br>
                                <?php echo app('translator')->get('lang_v1.invoice_logo_help', ['max_size' => '1 MB']); ?></span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('slim_receipt_font', __('Font Style for Slim Designs') . ':'); ?>

                            <?php echo Form::select('slim_receipt_font', [
                                'Verdana' => 'Verdana (Default)',
                                'Tahoma' => 'Tahoma',
                                'Geneva' => 'Geneva',
                                'sans-serif' => 'Sans-serif',
                                'Times New Roman' => 'Times New Roman',
                                'Arial' => 'Arial',
                            ], 'Verdana', ['class' => 'form-control select2', 'style' => 'width: 100%;']); ?>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('classic_receipt_font', __('Font Style for Classic and Others Designs') . ':'); ?>

                            <?php echo Form::select('classic_receipt_font', [
                                'Arial' => 'Arial (Default)',
                                'Helvetica' => 'Helvetica',
                                'Times New Roman' => 'Times New Roman',
                                'Georgia' => 'Georgia',
                                'Verdana' => 'Verdana',
                                'Tahoma' => 'Tahoma',
                                'Trebuchet MS' => 'Trebuchet MS',
                                'Calibri' => 'Calibri',
                                'Cambria' => 'Cambria',
                                'Garamond' => 'Garamond',
                                'Book Antiqua' => 'Book Antiqua',
                                'Palatino Linotype' => 'Palatino Linotype',
                            ], 'Arial', ['class' => 'form-control select2', 'style' => 'width: 100%;']); ?>

                            <span class="help-block"><?php echo app('translator')->get('lang_v1.best_for_laser_printing'); ?></span>
                        </div>
                    </div>
                </div>    
            </div>
            </div>
        </div>
        <!-- 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    <span class="section-icon"><i class="fas fa-heading"></i></span>
                    <?php echo app('translator')->get('lang_v1.layout_header_to_be_shown'); ?>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
                <div class="row">
                    <!-- Logo -->
                    <div class="col-sm-6 hide-for-letterhead">
                        <div class="form-group mb-2">
                            <?php echo Form::label('logo', __('invoice.invoice_logo') . ':'); ?>

                            <?php echo Form::file('logo', ['accept' => 'image/*']); ?>

                            <span class="help-block"><?php echo app('translator')->get('lang_v1.invoice_logo_help', ['max_size' => '1
                                MB']); ?></span>
                        </div>
                    </div>
                    <div class="col-sm-3 hide-for-letterhead">
                        <span id="logo_preview">
                            <img id="logo_preview_img" src="" style="max-width: 100%; max-height: 100px;">
                        </span>
                    </div>
                    <div class="col-sm-3 hide-for-letterhead">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_logo', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_logo'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 hide-for-letterhead">
                        <div class="form-group mb-2">
                            <?php echo Form::label('header_text', __('invoice.header_text') . ':' ); ?>

                            <?php echo Form::textarea('header_text','', ['class' => 'form-control',
                            'placeholder' => __('invoice.header_text'), 'rows' => 3]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_business_name', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_business_name'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_location_name', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_location_name'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('business_name_font_size', __('invoice.business_name_font_size') . ':'  ); ?>

                            <?php echo Form::select('common_settings[business_name_font_size]', ['10px'=>'10px',
                            '12px'=>'12px',
                            '14px'=>'14px', '16px'=>'16px','18px'=>'18px','20px'=>'20px','22px'=>'22px','24px'=>'24px','26px'=>'26px'], '14px', ['class' =>
                            'form-control',
                            'placeholder' => 'Please Select' ]); ?>

                        </div>
                    </div>

                    <div class="col-sm-12">
                        <h4 class="box-title"><?php echo app('translator')->get('invoice.fields_to_be_shown_in_address'); ?>:</h4>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_landmark', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('business.landmark'); ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_city', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('business.city'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_state', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('business.state'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_country', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('business.country'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_zip_code', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('business.zip_code'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('location_custom_fields[]', 'custom_field1', false, ['class'
                                    =>
                                    'form-check-input']); ?>

                                    <?php echo e($custom_labels['location']['custom_field_1'] ?? __('lang_v1.location_custom_field1'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('location_custom_fields[]', 'custom_field2', false, ['class'
                                    =>
                                    'form-check-input']); ?>

                                    <?php echo e($custom_labels['location']['custom_field_2'] ?? __('lang_v1.location_custom_field2'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('location_custom_fields[]', 'custom_field3', false, ['class'
                                    =>
                                    'form-check-input']); ?>

                                    <?php echo e($custom_labels['location']['custom_field_3'] ?? __('lang_v1.location_custom_field3'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('location_custom_fields[]', 'custom_field4', false, ['class'
                                    =>
                                    'form-check-input']); ?>

                                    <?php echo e($custom_labels['location']['custom_field_4'] ?? __('lang_v1.location_custom_field4'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <!-- Shop Communication details -->
                    <div class="col-sm-12">
                        <h4 class="box-title"><?php echo app('translator')->get('invoice.fields_to_shown_for_communication'); ?>:</h4>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_mobile_number', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_mobile_number'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_alternate_number', 1, false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_alternate_number'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_email', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_email'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_website', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_website'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4 class="box-title"><?php echo app('translator')->get('invoice.fields_to_shown_for_tax'); ?>:</h4>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_tax_1', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_tax_1'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_tax_2', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_tax_2'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sub_heading_line1', __('lang_v1.sub_heading_line', ['_number_' => 1]) .
                            ':'
                            ); ?>

                            <?php echo Form::text('sub_heading_line1', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 1]) ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sub_heading_line2', __('lang_v1.sub_heading_line', ['_number_' => 2]) .
                            ':'
                            ); ?>

                            <?php echo Form::text('sub_heading_line2', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 2]) ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sub_heading_line3', __('lang_v1.sub_heading_line', ['_number_' => 3]) .
                            ':'
                            ); ?>

                            <?php echo Form::text('sub_heading_line3', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 3]) ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sub_heading_line4', __('lang_v1.sub_heading_line', ['_number_' => 4]) .
                            ':'
                            ); ?>

                            <?php echo Form::text('sub_heading_line4', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 4]) ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sub_heading_line5', __('lang_v1.sub_heading_line', ['_number_' => 5]) .
                            ':'
                            ); ?>

                            <?php echo Form::text('sub_heading_line5', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.sub_heading_line', ['_number_' => 5]) ]); ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('invoice_heading', __('invoice.invoice_heading') . ':' ); ?>

                            <?php echo Form::text('invoice_heading', 'Invoice', ['class' => 'form-control',
                            'placeholder' => __('invoice.invoice_heading') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('invoice_heading_not_paid', __('invoice.invoice_heading_not_paid') . ':'
                            ); ?>

                            <?php echo Form::text('invoice_heading_not_paid', 'Unpaid', ['class' => 'form-control',
                            'placeholder' => __('invoice.invoice_heading_not_paid') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('invoice_heading_paid', __('invoice.invoice_heading_paid') . ':' ); ?>

                            <?php echo Form::text('invoice_heading_paid', 'Paid', ['class' => 'form-control',
                            'placeholder' => __('invoice.invoice_heading_paid') ]); ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <!-- Draft UI ready by asif 27-08-2023 -->
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('draft_heading', __('invoice.draft_heading') . ':' ); ?>

                            <?php echo Form::text('common_settings[draft_heading]','Draft', ['class' => 'form-control',
                            'placeholder' => __('invoice.draft_heading') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('proforma_heading', __('lang_v1.proforma_heading') . ':' ); ?>

                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_proforma_heading') . '"></i>';
                }
            ?>
                            <?php echo Form::text('common_settings[proforma_heading]', __('Proforma'), ['class'
                            =>
                            'form-control',
                            'placeholder' => __('lang_v1.proforma_heading'), 'id' => 'proforma_heading' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('quotation_heading', __('lang_v1.quotation_heading') . ':' ); ?>

                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.tooltip_quotation_heading') . '"></i>';
                }
            ?>
                            <?php echo Form::text('quotation_heading', __('Quotation'), ['class' => 'form-control',
                            'placeholder' => __('lang_v1.quotation_heading') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sales_order_heading', __('lang_v1.sales_order_heading') . ':' ); ?>

                            <?php echo Form::text('common_settings[sales_order_heading]', __('Sales Order'), ['class'
                            =>
                            'form-control',
                            'placeholder' => __('lang_v1.sales_order_heading'), 'id' => 'sales_order_heading' ]); ?>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    <span class="section-icon"><i class="fas fa-receipt"></i></span>
                    <?php echo app('translator')->get('lang_v1.invoice_header_to_be_shown'); ?>
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('invoice_no_prefix', __('invoice.invoice_no_prefix') . ':' ); ?>

                            <?php echo Form::text('invoice_no_prefix', __('Invoice No.'), ['class' => 'form-control',
                            'placeholder' => __('invoice.invoice_no_prefix') ]); ?>

                        </div>
                    </div>
                    <!-- draft no UI ready by asif 27-08-2023 -->
                    <!-- lang_v1.draft_no -->
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('draft_no_prefix', __('lang_v1.draft_no_prefix') . ':' ); ?>

                            <?php echo Form::text('common_settings[draft_no_prefix]', __('Draft No.'), ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.draft_no_prefix') ]); ?>

                        </div>
                    </div>
                    <!-- proforma no UI ready by asif 27-08-2023 -->
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('proforma_no_prefix', __('lang_v1.proforma_no_prefix') . ':' ); ?>

                            <?php echo Form::text('common_settings[proforma_no_prefix]', __('Proforma No.'), ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.proforma_no_prefix') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('quotation_no_prefix', __('lang_v1.quotation_no_prefix') . ':' ); ?>

                            <?php echo Form::text('quotation_no_prefix', __('Quotation No.'), ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.quotation_no_prefix') ]); ?>

                        </div>
                    </div>
                    <!-- sale order no UI ready by asif 27-08-2023 -->
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sale_order_no_prefix', __('lang_v1.sale_order_no_prefix') . ':' ); ?>

                            <?php echo Form::text('common_settings[sale_order_no_prefix]', __('Sale Order No.'), ['class'
                            =>
                            'form-control',
                            'placeholder' => __('lang_v1.sale_order_no_prefix') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('date_label', __('lang_v1.date_label') . ':' ); ?>

                            <?php echo Form::text('date_label', __('lang_v1.date'), ['class' => 'form-control',
                            'placeholder' => __('lang_v1.date_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('due_date_label', __('lang_v1.due_date_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[due_date_label]', __('lang_v1.due_date'), ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.due_date_label'), 'id' => 'due_date_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <br>
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_due_date]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_due_date'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('ref_no_prefix', __('lang_v1.ref_no_prefix') . ':' ); ?>

                            <?php echo Form::text('common_settings[ref_no_prefix]', null, ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.ref_no_prefix') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <br>
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_time]', 1,
                                    true, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_time'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <br>
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_local_time]', 1,
                                    false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_local_time'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('date_time_format', __('lang_v1.date_time_format') . ':' ); ?>

                            <?php echo Form::text('date_time_format', $invoice_layout->date_time_format, ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.date_time_format') ]); ?>

                            <p class="help-block"><?php echo __('lang_v1.date_time_format_help'); ?></p>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sales_person_label', __('lang_v1.sales_person_label') . ':' ); ?>

                            <div class="input-group">
                                <?php echo Form::text('sales_person_label', null, ['class' => 'form-control',
                                'placeholder' => __('lang_v1.sales_person_label') ]); ?>

                                <div class="input-group-text bg-primary text-white">
                                    <label class="mb-0">
                                        <?php echo Form::checkbox('show_sales_person', 1, false, ['class' => 'form-check-input m-auto me-1']); ?>

                                        <?php echo app('translator')->get('lang_v1.show_sales_person'); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('commission_agent_label', __('lang_v1.commission_agent_label') . ':' ); ?>

                            <div class="input-group">
                                <?php echo Form::text('commission_agent_label', __('lang_v1.commission_agent'), ['class' =>
                                'form-control',
                                'placeholder' => __('lang_v1.commission_agent_label') ]); ?>

                                <div class="input-group-text bg-primary text-white">
                                    <label class="mb-0">
                                        <?php echo Form::checkbox('show_commission_agent', 1, false, ['class' =>
                                        'form-check-input m-auto me-1']); ?> <?php echo app('translator')->get('lang_v1.show_commission_agent'); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_logged_in_user]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_logged_in_user'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4 class="box-title"><?php echo app('translator')->get('lang_v1.fields_for_customer_details'); ?>:</h4>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('customer_label', __('invoice.customer_label') . ':' ); ?>

                            <div class="input-group">
                                <?php echo Form::text('customer_label', __('contact.customer'), ['class' => 'form-control',
                                'placeholder' => __('invoice.customer_label') ]); ?>

                                <div class="input-group-text bg-primary text-white">
                                    <label class="mb-0">
                                        <?php echo Form::checkbox('show_customer', 1, true, ['class' => 'form-check-input m-auto me-1']); ?>

                                        <?php echo app('translator')->get('invoice.show_customer'); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('customer_label_font_size', __('invoice.customer_label_font_size') . ':'  ); ?>

                            <?php echo Form::select('common_settings[customer_label_font_size]', ['10px'=>'10px',
                            '12px'=>'12px',
                            '14px'=>'14px', '16px'=>'16px','18px'=>'18px','20px'=>'20px'], '14px', ['class' =>
                            'form-control',
                            'placeholder' => 'Please Select' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('client_id_label', __('lang_v1.client_id_label') . ':' ); ?>

                            <?php echo Form::text('client_id_label', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.client_id_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('client_tax_label', __('lang_v1.client_tax_label') . ':' ); ?>

                            <?php echo Form::text('client_tax_label', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.client_tax_label') ]); ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_customer_mobile_number]', 1 , false,
                                    ['class'
                                    => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_customer_mobile_number'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_client_id', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_client_id'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_reward_point', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_reward_point'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('contact_custom_fields[]', 'custom_field1', false, ['class'
                                    =>
                                    'form-check-input']); ?>

                                    <?php echo e($custom_labels['contact']['custom_field_1'] ?? __('lang_v1.contact_custom_field1'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('contact_custom_fields[]', 'custom_field2', false, ['class'
                                    =>
                                    'form-check-input']); ?>

                                    <?php echo e($custom_labels['contact']['custom_field_2'] ?? __('lang_v1.contact_custom_field2'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('contact_custom_fields[]', 'custom_field3', false, ['class'
                                    =>
                                    'form-check-input']); ?>

                                    <?php echo e($custom_labels['contact']['custom_field_3'] ?? __('lang_v1.contact_custom_field3'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('contact_custom_fields[]', 'custom_field4', false, ['class'
                                    =>
                                    'form-check-input']); ?>

                                    <?php echo e($custom_labels['contact']['custom_field_4'] ?? __('lang_v1.contact_custom_field4'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-12">
                        <h4 class="box-title"><?php echo app('translator')->get('lang_v1.sell_custom_fields'); ?>:</h4>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field1]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field1'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field2]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field2'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field3]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field3'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field4]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field4'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field5]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field5'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field6]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field6'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field7]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field7'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field8]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field8'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field9]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field9'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field10]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field10'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field11]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field11'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field12]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field12'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field13]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field13'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_sell_custom_field14]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.sell_custom_field14'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    <span class="section-icon"><i class="fas fa-boxes"></i></span>
                    <?php echo app('translator')->get('lang_v1.product_details_to_be_shown'); ?>
                </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_product_label', __('lang_v1.product_label') . ':' ); ?>

                            <?php echo Form::text('table_product_label', __('sale.product'), ['class' => 'form-control',
                            'placeholder' => __('lang_v1.product_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_qty_label', __('lang_v1.qty_label') . ':' ); ?>

                            <?php echo Form::text('table_qty_label', __('lang_v1.quantity'), ['class' => 'form-control',
                            'placeholder' => __('lang_v1.qty_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_qty_unit_label', __('lang_v1.qty_unit_label') . ':' ); ?>

                            <div class="input-group">
                                <?php echo Form::text('common_settings[table_qty_unit_label]', __('lang_v1.unit'), ['class' => 'form-control',
                                'placeholder' => __('lang_v1.qty_unit_label'), 'id' => 'table_qty_unit_label' ]); ?>

                                <div class="input-group-text bg-primary text-white gap-3">
                                    <label class="mb-0">
                                        <?php echo Form::radio('common_settings[unit_display_mode]', 'inline', true, ['class' => 'form-check-input m-auto me-1']); ?>

                                        <?php echo app('translator')->get('lang_v1.show_unit'); ?>
                                    </label>
                                    <label class="mb-0">
                                        <?php echo Form::radio('common_settings[unit_display_mode]', 'column', false, ['class' => 'form-check-input m-auto me-1']); ?>

                                        <?php echo app('translator')->get('lang_v1.show_unit_column'); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sku_label', __('lang_v1.sku_label') . ':' ); ?>

                            <div class="input-group">
                                <?php echo Form::text('common_settings[sku_label]', 'SKU', ['class' => 'form-control',
                                'placeholder' => __('lang_v1.sku_label'), 'id' => 'sku_label' ]); ?>

                                <div class="input-group-text bg-primary text-white">
                                    <label class="mb-0">
                                        <?php echo Form::checkbox('show_sku', 1, true, ['class' => 'form-check-input m-auto me-1']); ?>

                                        <?php echo app('translator')->get('lang_v1.show_sku'); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('variation_label', __('lang_v1.variation_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[variation_label]', '', ['class' => 'form-control',
                            'placeholder' => __('lang_v1.variation_label'), 'id' => 'variation_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_unit_price_label', __('lang_v1.unit_price_label') . ':' ); ?>

                            <?php echo Form::text('table_unit_price_label', __('Price Exc. Tax'), ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.unit_price_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('price_inc_tax_label', __('lang_v1.price_inc_tax_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[price_inc_tax_label]', 'Price Inc. Tax', ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.price_inc_tax_label'), 'id' => 'price_inc_tax_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_sub_unit_price_label', __('lang_v1.sub_unit_price_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[table_sub_unit_price_label]', null,
                            ['class'=> 'form-control', 'placeholder' => __('lang_v1.sub_unit_price_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_sub_unit_qty_label', __('lang_v1.sub_unit_qty_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[table_sub_unit_qty_label]', null,
                            ['class'=> 'form-control', 'placeholder' => __('lang_v1.sub_unit_qty_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('secondary_quantity_label', __('lang_v1.secondary_quantity_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[secondary_quantity_label]', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.secondary_quantity_label'), 'id' => 'secondary_quantity_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('alternate_sku_label', __('lang_v1.alternate_sku_label') . ':' ); ?>

                            <div class="input-group">
                                <?php echo Form::text('common_settings[alternate_sku_label]', '', ['class' => 'form-control',
                                'placeholder' => __('lang_v1.alternate_sku_label'), 'id' => 'alternate_sku_label' ]); ?>

                                <div class="input-group-text bg-primary text-white">
                                    <label class="mb-0">
                                        <?php echo Form::checkbox('common_settings[show_alternate_sku]', 1, false, ['class' => 'form-check-input m-auto me-1']); ?>

                                        <?php echo app('translator')->get('lang_v1.show_alternate_sku'); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_foc_quantity_label', __('lang_v1.table_foc_quantity_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[table_foc_quantity_label]', null,
                            ['class'=> 'form-control', 'placeholder' => __('lang_v1.table_foc_quantity_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_foc_qty_total_label', __('lang_v1.table_foc_qty_total_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[table_foc_qty_total_label]', null,
                            ['class'=> 'form-control', 'placeholder' => __('lang_v1.table_foc_qty_total_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cat_code_label', __('lang_v1.cat_code_label') . ':' ); ?>

                            <?php echo Form::text('cat_code_label', 'HSN', ['class' => 'form-control',
                            'placeholder' => 'HSN or Category Code' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('inline_unit_discount_label', __('lang_v1.inline_unit_discount_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[inline_unit_discount_label]', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.inline_unit_discount_label'), 'id' => 'inline_unit_discount_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('inline_units_discount_total_label', __('lang_v1.inline_units_discount_total_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[inline_units_discount_total_label]', 'Discount', ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.inline_units_discount_total_label'), 'id' => 'inline_units_discount_total_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('inline_units_discount_total_percentage_label', __('lang_v1.inline_units_discount_total_percentage_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[inline_units_discount_total_percentage_label]', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.inline_units_discount_total_percentage_label'), 'id' => 'inline_units_discount_total_percentage_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('inline_unit_discount2_label', __('lang_v1.inline_unit_discount2_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[inline_unit_discount2_label]', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.inline_unit_discount2_label'), 'id' => 'inline_unit_discount2_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('inline_units_discount2_total_label', __('lang_v1.inline_units_discount2_total_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[inline_units_discount2_total_label]', 'Discount', ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.inline_units_discount2_total_label'), 'id' => 'inline_units_discount2_total_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('inline_unit_discounted_rate_label', __('lang_v1.inline_unit_discounted_rate_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[inline_unit_discounted_rate_label]', 'Price after discount',
                            ['class' => 'form-control',
                            'placeholder' => __('lang_v1.inline_unit_discounted_rate_label'), 'id' =>
                            'inline_unit_discounted_rate_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('product_tax_label', __('lang_v1.product_tax_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[product_tax_label]', null,
                            ['class' => 'form-control',
                            'placeholder' => __('lang_v1.product_tax_label'), 'id' =>
                            'product_tax_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('inline_product_tax_total_label', __('lang_v1.inline_product_tax_total_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[inline_product_tax_total_label]', null,
                            ['class' => 'form-control', 'placeholder' => __('lang_v1.inline_product_tax_total_label'), 'id' => 'inline_product_tax_total_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <br>
                            <label class="form-check-label">
                                <?php echo Form::checkbox('common_settings[show_tax_group_columns]', 1, false, ['class' => 'form-check-input']); ?>

                                <?php echo app('translator')->get('lang_v1.show_tax_group_columns'); ?>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_subtotal_exc_tax_label', __('lang_v1.table_subtotal_exc_tax_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[table_subtotal_exc_tax_label]', null, ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.table_subtotal_exc_tax_label'), 'id' =>
                            'table_subtotal_exc_tax_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('table_subtotal_label', __('lang_v1.subtotal_label') . ':' ); ?>

                            <?php echo Form::text('table_subtotal_label', __('sale.subtotal'), ['class' => 'form-control',
                            'placeholder' => __('lang_v1.subtotal_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('preparation_time_label', __('lang_v1.preparation_time_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[preparation_time_label]', 'Preparation Time',
                            ['class'=> 'form-control', 'placeholder' => __('lang_v1.preparation_time_label') ]); ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_sr_number]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.hide_sr_number'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_brand', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_brand'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_cat_code', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_cat_code'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_category]', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_category'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_inline_total_inc_discount]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_inline_total_inc_discount'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[total_show_discount_in_percentage]', 1, false,
                                    ['class' =>'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.total_show_discount_in_percentage'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[group_products_by_categories]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.group_products_by_categories'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[group_products_by_rack]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.group_products_by_rack'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('product_custom_fields[]', 'product_custom_field1', false,
                                    ['class' => 'form-check-input']); ?>

                                    <?php echo e($custom_labels['product']['custom_field_1'] ?? __('lang_v1.product_custom_field1'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('product_custom_fields[]', 'product_custom_field2', false,
                                    ['class' => 'form-check-input']); ?>

                                    <?php echo e($custom_labels['product']['custom_field_2'] ?? __('lang_v1.product_custom_field2'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('product_custom_fields[]', 'product_custom_field3', false,
                                    ['class' => 'form-check-input']); ?>

                                    <?php echo e($custom_labels['product']['custom_field_3'] ?? __('lang_v1.product_custom_field3'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('product_custom_fields[]', 'product_custom_field4', false,
                                    ['class' => 'form-check-input']); ?>

                                    <?php echo e($custom_labels['product']['custom_field_4'] ?? __('lang_v1.product_custom_field4'), false); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php if(request()->session()->get('business.enable_product_expiry') == 1): ?>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_expiry', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_product_expiry'); ?></label>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(request()->session()->get('business.enable_lot_number') == 1): ?>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_lot', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_lot_number'); ?></label>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_image', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_product_image'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_serial_number]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_serial_number'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_imei_number]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_imei_number'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_warranty_name]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_warranty_name'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_warranty_exp_date]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_warranty_exp_date'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_warranty_description]', 1, false,
                                    ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_warranty_description'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_base_unit_details]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_base_unit_details'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    <span class="section-icon"><i class="fas fa-calculator"></i></span>
                    <?php echo app('translator')->get('lang_v1.total_details_to_be_shown'); ?>
                </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('common_settings[sub_total_exc_tax_label]', __('invoice.sub_total_exc_tax_label') . ':' ); ?>

                            <div class="input-group">
                                <?php echo Form::text('common_settings[sub_total_exc_tax_label]', null, ['class' =>
                                'form-control',
                                'placeholder' => __('invoice.sub_total_exc_tax_label') ]); ?>

                                <div class="input-group-text bg-primary text-white">
                                    <label class="mb-0">
                                        <?php echo Form::hidden('common_settings[sub_total_exc_tax_bold]', 0); ?>

                                        <?php echo Form::checkbox('common_settings[sub_total_exc_tax_bold]', 1, false, ['class' => 'form-check-input m-auto me-1']); ?> Bold
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('sub_total_label', __('invoice.sub_total_inc_tax_label') . ':' ); ?>

                            <div class="input-group">
                                <?php echo Form::text('sub_total_label', __('sale.subtotal'), ['class' => 'form-control',
                                'placeholder' => __('invoice.sub_total_inc_tax_label') ]); ?>

                                <div class="input-group-text bg-primary text-white">
                                    <label class="mb-0">
                                        <?php echo Form::hidden('common_settings[sub_total_inc_tax_bold]', 0); ?>

                                        <?php echo Form::checkbox('common_settings[sub_total_inc_tax_bold]', 1, false, ['class' => 'form-check-input m-auto me-1']); ?> Bold
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('discount_label', __('invoice.inline_discount_total_footer_label') . ':' ); ?>

                            <?php echo Form::text('discount_label', __('sale.discount'), ['class' => 'form-control',
                            'placeholder' => __('invoice.inline_discount_total_footer_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('discount_label', __('invoice.total_invoice_discount_label') . ':' ); ?>

                            <?php echo Form::text('discount_label', __('sale.discount'), ['class' => 'form-control',
                            'placeholder' => __('invoice.total_invoice_discount_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('common_settings[discount2_label]', __('invoice.inline_discount2_total_footer_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[discount2_label]', __('sale.discount'). '2', ['class' => 'form-control',
                            'placeholder' => __('invoice.inline_discount2_total_footer_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('common_settings[discount2_label]', __('invoice.total_invoice_discount2_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[discount2_label]', __('sale.discount'). '2', ['class' => 'form-control',
                            'placeholder' => __('invoice.total_invoice_discount2_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('common_settings[total_exc_tax_label]', __('invoice.total_exc_tax_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[total_exc_tax_label]', null, ['class' =>
                            'form-control',
                            'placeholder' => __('invoice.total_exc_tax_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('total_label', __('invoice.total_label') . ':' ); ?>

                            <?php echo Form::text('total_label', __('sale.total'), ['class' => 'form-control',
                            'placeholder' => __('invoice.total_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('total_label_font_size',__('invoice.total_label_font_size') . ':'  ); ?>

                            <?php echo Form::select('common_settings[total_label_font_size]', ['10px'=>'10px',
                            '12px'=>'12px',
                            '14px'=>'14px', '16px'=>'16px','18px'=>'18px','20px'=>'20px'], '14px', ['class' =>
                            'form-control',
                            'placeholder' => 'Please Select' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('total_quantity_label', __('lang_v1.total_quantity_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[total_quantity_label]', 'Total Quantity', ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.total_quantity_label'), 'id' => 'total_quantity_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('total_items_label', __('lang_v1.total_items_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[total_items_label]', null, ['class' => 'form-control',
                            'placeholder' => __('lang_v1.total_items_label'), 'id' => 'total_items_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('round_off_label', __('lang_v1.round_off_label') . ':' ); ?>

                            <?php echo Form::text('round_off_label', __('lang_v1.round_off'), ['class' => 'form-control',
                            'placeholder' => __('lang_v1.round_off_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('total_due_label', __('invoice.total_due_label') . ' (' .
                            __('lang_v1.current_sale') . '):' ); ?>

                            <?php echo Form::text('total_due_label', __('report.total_due'), ['class' => 'form-control',
                            'placeholder' => __('invoice.total_due_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('paid_label', __('invoice.paid_label') . ':' ); ?>

                            <?php echo Form::text('paid_label', __('sale.total_paid'), ['class' => 'form-control',
                            'placeholder' => __('invoice.paid_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('prev_bal_label', __('invoice.prev_bal_label') . ' (' .
                            __('lang_v1.all_sales') . '):' ); ?>

                            <?php echo Form::text('prev_bal_label', null, ['class' =>
                            'form-control',
                            'placeholder' => __('invoice.prev_bal_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('common_settings[cur_total_label]', __('invoice.total_due_label') . ' (' .
                            __('lang_v1.all_sales') . '):' ); ?>

                            <?php echo Form::text('common_settings[cur_total_label]', null, ['class' => 'form-control',
                            'placeholder' => __('invoice.total_due_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('change_return_label', __('lang_v1.change_return_label') . ':' ); ?>

                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.change_return_help') . '"></i>';
                }
            ?>
                            <?php echo Form::text('change_return_label', __('lang_v1.change_return'), ['class' =>
                            'form-control',
                            'placeholder' => __('lang_v1.change_return_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('word_format', __('lang_v1.word_format') . ':'); ?>

                            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.word_format_help') . '"></i>';
                }
            ?>
                            <?php echo Form::select('common_settings[num_to_word_format]', ['international' =>
                            __('lang_v1.international'), 'indian' => __('lang_v1.indian')], 'international',
                            ['class' =>
                            'form-control', 'id' => 'word_format']); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('tax_summary_label', __('lang_v1.tax_summary_label') . ':' ); ?>

                            <?php echo Form::text('common_settings[tax_summary_label]', '', ['class' => 'form-control',
                            'placeholder' => __('lang_v1.tax_summary_label'), 'id' => 'tax_summary_label' ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('select_second_tax', __('lang_v1.select_second_tax') . ':'); ?>

                            <div class="input-group">
                                <?php echo Form::select('common_settings[second_tax_id]', $tax_rates, null, ['class' => 'form-control', 'id' => 'select_second_tax']); ?>

                                <div class="input-group-text bg-primary text-white">
                                    <label class="mb-0">
                                        <?php echo Form::checkbox('common_settings[show_second_tax_on_bill]', 1, false, ['class' =>
                                        'form-check-input m-auto me-1']); ?> <?php echo app('translator')->get('lang_v1.show_second_tax_on_bill'); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-3 hide" id="hide_price_div">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[hide_price]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.hide_all_prices'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_total_in_words]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_total_in_words'); ?></label>
                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.show_in_word_help') . '"></i>';
                }
            ?>
                                <?php if(!extension_loaded('intl')): ?>
                                <p class="help-block"><?php echo app('translator')->get('lang_v1.enable_php_intl_extension'); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_payments', 1, true, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_payments'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_tax_on_footer]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_tax_on_footer'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_previous_bal', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_previous_bal_due'); ?></label>
                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.previous_bal_due_help') . '"></i>';
                }
            ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_payment_date]', 1, false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_payment_date'); ?></label>
                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . 'For Layouts with Payment Dates Visible in Footer' . '"></i>';
                }
            ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- 6 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    <span class="section-icon"><i class="fas fa-shoe-prints"></i></span>
                    <?php echo app('translator')->get('lang_v1.footer_message_to_be_shown'); ?>
                </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-sm-6 hide">
                        <div class="form-group mb-2">
                            <?php echo Form::label('highlight_color', __('invoice.highlight_color') . ':' ); ?>

                            <?php echo Form::text('highlight_color', '#000000', ['class' => 'form-control',
                            'placeholder' => __('invoice.highlight_color') ]); ?>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 hide">
                        <hr />  
                    </div>
                    <!-- Logo -->
                    <div class="col-sm-6">
                        <div class="form-group mb-2">
                            <?php echo Form::label('footer_logo', __('invoice.footer_logo') . ':'); ?>

                            <?php echo Form::file('footer_logo', ['accept' => 'image/*']); ?>

                            <span class="help-block"><?php echo app('translator')->get('lang_v1.invoice_logo_help', ['max_size' => '1MB']); ?></span>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <span id="footer_logo_preview">
                            <img id="footer_logo_preview_img" src="" style="max-width: 100%; max-height: 100px;">
                        </span>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_footer_logo', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_footer_logo'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group mb-2">
                            <?php echo Form::label('footer_text', __('invoice.footer_text') . ':' ); ?>

                            <?php echo Form::textarea('footer_text', null, ['class' => 'form-control',
                            'placeholder' => __('invoice.footer_text'), 'rows' => 3]); ?>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- 7 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    <span class="section-icon"><i class="fas fa-undo-alt"></i></span>
                    <?php echo app('translator')->get('lang_v1.layout_credit_note'); ?>
                </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cn_heading', __('lang_v1.cn_heading') . ':' ); ?>

                            <?php echo Form::text('cn_heading', 'Credit Note', ['class' => 'form-control',
                            'placeholder' => __('lang_v1.cn_heading') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cn_no_label', __('lang_v1.cn_no_label') . ':' ); ?>

                            <?php echo Form::text('cn_no_label', __('purchase.ref_no'), ['class' => 'form-control',
                            'placeholder' => __('lang_v1.cn_no_label') ]); ?>

                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('cn_amount_label', __('lang_v1.cn_amount_label') . ':' ); ?>

                            <?php echo Form::text('cn_amount_label', 'Credit Amount', ['class' => 'form-control',
                            'placeholder'
                            =>
                            __('lang_v1.cn_amount_label') ]); ?>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <!-- 8 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    <span class="section-icon"><i class="fas fa-flag"></i></span>
                    <?php echo app('translator')->get('lang_v1.fbr_pakistan_fields_to_be_shown'); ?>
                </button>
            </h2>
            <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
                <?php $__env->startComponent('components.widget', ['title' => __('lang_v1.qr_code')]); ?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <?php echo Form::label('Tax Image', "Tax Image" . ':'); ?>

                            <?php echo Form::select('tax_image', [1=> "FBR", 2=> "PRA"], 1, ['class' => 'form-control']); ?>

                            <span class="help-block">
                                Which Logo to Show on Invoice
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_tax_image]', 1,
                                    true, ['class' =>
                                    'form-check-input']); ?> Show Tax Image</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_tax_qr_code]', 1,
                                    true, ['class' =>
                                    'form-check-input']); ?> Show Tax QR Code</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_tax_pos_id]', 1,
                                    true, ['class' =>
                                    'form-check-input']); ?> Show Tax POS ID</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_pos_id_date]', 1,
                                    true, ['class' =>
                                    'form-check-input']); ?> Show POS ID Date</label>
                            </div>
                        </div>
                    </div>

                </div>
                <?php echo $__env->renderComponent(); ?>

            </div>
            </div>
        </div>
        <!-- 9 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    <span class="section-icon"><i class="fas fa-globe-asia"></i></span>
                    <?php echo app('translator')->get('lang_v1.UAE_fields_to_be_shown'); ?>
                </button>
            </h2>
            <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
                <?php $__env->startComponent('components.widget', ['title' => __('lang_v1.qr_code')]); ?>
                <div class="row">


                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_qr_code', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.show_qr_code'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[zatca_qr]', 1, false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.zatca_qr'); ?></label>
                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.zatca_qr_help') . '"></i>';
                }
            ?>
                            </div>
                        </div>
                    </div>
                    <!-- Barcode -->
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('show_barcode', 1, false, ['class' => 'form-check-input']); ?>

                                    <?php echo app('translator')->get('invoice.show_barcode'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('common_settings[show_qr_code_label]', 1, false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.show_labels'); ?></label>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <h4 class="box-title"><?php echo app('translator')->get('lang_v1.fields_to_be_shown'); ?>:</h4>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'business_name', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('business.business_name'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'address', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.business_location_address'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'tax_1', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.business_tax_1'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'tax_2', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.business_tax_2'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'invoice_no', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('sale.invoice_no'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'invoice_datetime', false, ['class' =>
                                    'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.invoice_datetime'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'subtotal', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('sale.subtotal'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'total_amount', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.total_amount_with_tax'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'total_tax', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.total_tax'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'customer_name', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('sale.customer_name'); ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('qr_code_fields[]', 'invoice_url', false, ['class' =>
                                    'form-check-input']); ?>

                                    <?php echo app('translator')->get('lang_v1.view_invoice_url'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo $__env->renderComponent(); ?>

            </div>
            </div>
        </div>
        <!-- 10 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTen">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                    <span class="section-icon"><i class="fas fa-puzzle-piece"></i></span>
                    <?php echo app('translator')->get('lang_v1.modules_related_settings'); ?>
                </button>
            </h2>
            <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" data-bs-parent="#invoiceAccordion">
            <div class="accordion-body">
            
                

                    <!-- Call type of services module if defined -->
                    <?php if(!empty($enabled_modules) && in_array('types_of_service', $enabled_modules) ): ?>
                    <?php echo $__env->make('types_of_service.invoice_layout_settings', ['module_info' =>
                    $invoice_layout->module_info], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <!-- Call restaurant module if defined -->
                    <?php echo $__env->make('restaurant.partials.invoice_layout', ['module_info' => $invoice_layout->module_info,
                    'edit_il' => true, 'hide_price_total'=> $invoice_layout->common_settings['hide_price_total']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <!-- Call repair module if install -->
                    <?php if(Module::has('Repair')): ?>
                    <?php echo $__env->make('repair::layouts.partials.invoice_layout_settings', ['module_info' =>
                    $invoice_layout->module_info,
                    'edit_il' => true], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                
            
            </div>
            </div>
        </div>

    </div>

    <!-- commented original code by asif 11-01-2024 below -->

    

    <div id="invoice-layout-footer-actions-template" class="d-none">
        <button type="submit" class="btn btn-primary" form="add_invoice_layout_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?></button>
    </div>
    <?php echo Form::close(); ?>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
__page_leave_confirmation('#add_invoice_layout_form');
$(document).on('change', '#show_letter_head', function() {
    letter_head_changed();
});

function letter_head_changed() {
    if ($('#show_letter_head').is(":checked")) {
        $('.letter_head_input').removeClass('hide');
    } else {
        $('.letter_head_input').addClass('hide');
    }
}
$(document).ready(function() {
    letter_head_changed();
})
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>