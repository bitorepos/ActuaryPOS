
<?php $__env->startSection('title', __('messages.business_location_settings')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'messages.business_location_settings' ); ?> - <?php echo e($location->name, false); ?></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link active" href="#tab_1" data-bs-toggle="tab" role="tab" aria-expanded="true"><?php echo app('translator')->get('receipt.receipt_settings'); ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_2" data-bs-toggle="tab" role="tab" aria-expanded="false"><?php echo app('translator')->get('lang_v1.settings'); ?></a></li>
                <?php if($show_stations): ?>
                <li class="nav-item"><a class="nav-link" href="#tab_3" data-bs-toggle="tab" role="tab" aria-expanded="false"><?php echo app('translator')->get('lang_v1.workstations'); ?></a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="#tab_4" data-bs-toggle="tab" role="tab" aria-expanded="false"><?php echo app('translator')->get('lang_v1.currencies'); ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_prefixes" data-bs-toggle="tab" role="tab" aria-expanded="false"><?php echo app('translator')->get('lang_v1.prefixes'); ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#documents_and_notes_tab" data-bs-toggle="tab" role="tab" aria-expanded="false"><i class="fas fa-paperclip" aria-hidden="true"></i> <?php echo app('translator')->get('lang_v1.documents_and_notes'); ?></a></li>
                <li class="nav-item"><a class="nav-link" href="#tab_map" data-bs-toggle="tab" role="tab" aria-expanded="false"><i class="fas fa-map-marked-alt"></i> <?php echo app('translator')->get('lang_v1.map_and_location'); ?></a></li>
            </ul>
            <?php echo Form::open(['url' => route('location.settings_update', [$location->id]), 'method' => 'post', 'id' => 'bl_receipt_setting_form']); ?>

            <div class="tab-content">
                

                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-12 p-5">
                            <div class="col-md-6">
                                <h4><?php echo app('translator')->get( 'receipt.receipt_settings'); ?>
                                    <small><?php echo app('translator')->get( 'receipt.receipt_settings_mgs'); ?></small>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row p-3">
                        

                        <div class="col-sm-4">
                            <div class="form-group mb-3">
                                <?php echo Form::label('print_receipt_on_invoice', __('receipt.print_receipt_on_invoice') . ':'); ?>

                                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.print_receipt_on_invoice') . '"></i>';
                }
            ?>
                                <div class="input-group">
                                    
                                    <label class="input-group-text"><i class="fa fa-file-alt"></i></label>
                                    <?php echo Form::select('print_receipt_on_invoice', $printReceiptOnInvoice, $location->print_receipt_on_invoice, ['class' => 'form-select', 'required']); ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group mb-3">
                                <?php echo Form::label('receipt_printer_type', __('receipt.receipt_printer_type') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.receipt_printer_type') . '"></i>';
                }
            ?>
                                <div class="input-group">
                                    
                                    <label class="input-group-text"><i class="fa fa-print"></i></label>
                                    <?php echo Form::select('receipt_printer_type', $receiptPrinterType, $location->receipt_printer_type, ['class' => 'form-select', 'required']); ?>

                                </div>
                                <?php if(config('app.env') == 'demo'): ?>
                                    <span class="help-block">Only Browser based option is enabled in demo.</span>
                                <?php endif; ?>
                                
                            </div>
                        </div>
                        <div class="col-sm-4" 
                            id="location_printer_div">
                            <div class="form-group mb-3">
                                <?php echo Form::label('printer_id', __('printer.receipt_printers') . ':*'); ?>

                                <div class="input-group">
                                    
                                    <label class="input-group-text"><i class="fa fa-share-alt"></i></label>
                                    <?php echo Form::select('printer_id', $printers, $location->printer_id, ['class' => 'form-select select2', 'required']); ?>

                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <?php echo Form::label('print_server_url', __('printer.print_server_url') . ':'); ?>

                                <div class="input-group">
                                    <?php echo Form::text('print_server_url', $location->print_server_url, ['class' => 'form-control']); ?>

                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br/>

                        <div class="col-sm-4">
                            <div class="form-group mb-3">
                                <?php echo Form::label('invoice_layout_id', __('lang_v1.invoice_layout_for_pos') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_layout') . '"></i>';
                }
            ?>
                                <div class="input-group">
                                    
                                    <label class="input-group-text"><i class="fa fa-info"></i></label>
                                    <?php echo Form::select('invoice_layout_id', $invoice_layouts, $location->invoice_layout_id, ['class' => 'form-select', 'required']); ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group mb-3">
                                <?php echo Form::label('invoice_scheme_id', __('invoice.invoice_scheme') . ':*'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.invoice_scheme') . '"></i>';
                }
            ?>
                                <div class="input-group">
                                    
                                    <label class="input-group-text"><i class="fa fa-info"></i></label>
                                    <?php echo Form::select('invoice_scheme_id', $invoice_schemes, $location->invoice_scheme_id, ['class' => 'form-select', 'required']); ?>

                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="tab-pane " id="tab_2">
                    <div class="row p-4">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <div class="form-check">
                                    
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('enable_other_location_payments', 1,
                                        !empty($location->loc_settings['enable_other_location_payments']),
                                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_other_location_payments' ), false); ?>

                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <?php echo Form::checkbox('disable_manufacturing', 1,
                                        !empty($location->loc_settings['disable_manufacturing']),
                                        [ 'class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.disable_manufacturing'); ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($show_stations): ?>
                <div class="tab-pane" id="tab_3">
                    <div class="row p-3">
                        <div class="col-md-12">
                            <h4><i class="fas fa-desktop"></i> <?php echo app('translator')->get('lang_v1.workstations'); ?>
                                <button type="button" class="btn btn-primary btn-sm ms-2" id="add_workstation_btn">
                                    <i class="fas fa-plus"></i> <?php echo app('translator')->get('lang_v1.add_workstation'); ?>
                                </button>
                                <small class="text-muted ms-2"><?php echo app('translator')->get('lang_v1.workstation_help'); ?></small>
                            </h4>
                        </div>
                    </div>

                    
                    <div class="row p-3">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="workstation_table">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get('lang_v1.machine_name'); ?></th>
                                            <th><?php echo app('translator')->get('lang_v1.display_name'); ?></th>
                                            <th><?php echo app('translator')->get('lang_v1.pos_printer'); ?></th>
                                            <th><?php echo app('translator')->get('lang_v1.report_printer'); ?></th>
                                            <th><?php echo app('translator')->get('lang_v1.label_printer'); ?></th>
                                            <th><?php echo app('translator')->get('lang_v1.cash_drawer'); ?></th>
                                            <th><?php echo app('translator')->get('lang_v1.auto_print'); ?></th>
                                            <th><?php echo app('translator')->get('messages.action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $workstations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ws): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr data-ws-id="<?php echo e($ws->id, false); ?>">
                                            <td><code><?php echo e($ws->machine_name, false); ?></code></td>
                                            <td><?php echo e($ws->display_name, false); ?></td>
                                            <td><?php echo e($ws->pos_printer_name ?: '-', false); ?></td>
                                            <td><?php echo e($ws->report_printer_name ?: '-', false); ?></td>
                                            <td><?php echo e($ws->label_printer_name ?: '-', false); ?></td>
                                            <td>
                                                <?php if(!empty($ws->settings['enable_cash_drawer_pos_printer'])): ?>
                                                    <span class="badge bg-success"><?php echo app('translator')->get('lang_v1.enabled'); ?></span>
                                                    <?php if(!empty($ws->settings['cash_drawer_password_protected'])): ?>
                                                        <span class="badge bg-warning"><?php echo app('translator')->get('lang_v1.password'); ?></span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($ws->auto_print_pos): ?> <span class="badge bg-success">POS</span> <?php endif; ?>
                                                <?php if($ws->auto_print_reports): ?> <span class="badge bg-info">Reports</span> <?php endif; ?>
                                                <?php if($ws->auto_print_labels): ?> <span class="badge bg-warning">Labels</span> <?php endif; ?>
                                                <?php if(!$ws->auto_print_pos && !$ws->auto_print_reports && !$ws->auto_print_labels): ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-xs btn-primary edit_workstation_btn"
                                                    data-ws='<?php echo json_encode($ws, 15, 512) ?>'>
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-xs btn-danger delete_workstation_btn"
                                                    data-href="<?php echo e(route('location.workstations.destroy', [$location->id, $ws->id]), false); ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr class="no-workstations-row">
                                            <td colspan="8" class="text-center text-muted">
                                                <i class="fas fa-info-circle"></i> <?php echo app('translator')->get('lang_v1.no_workstations_configured'); ?>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <div class="modal fade" id="workstation_modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title"><i class="fas fa-cogs"></i> <?php echo app('translator')->get('lang_v1.hardware_setup'); ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body" style="overflow-x: auto;">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label><?php echo app('translator')->get('lang_v1.machine_name'); ?> <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="ws_machine_name" placeholder="e.g. CASHIER-PC-01" readonly>
                                                <button type="button" class="btn btn-outline-secondary" id="ws_detect_machine" title="<?php echo app('translator')->get('lang_v1.detect_this_machine'); ?>">
                                                    <i class="fas fa-laptop"></i> <?php echo app('translator')->get('lang_v1.detect'); ?>
                                                </button>
                                            </div>
                                            <small class="text-muted"><?php echo app('translator')->get('lang_v1.machine_name_help'); ?></small>
                                        </div>
                                        <div class="col-md-6">
                                            <label><?php echo app('translator')->get('lang_v1.display_name'); ?></label>
                                            <input type="text" class="form-control" id="ws_display_name" placeholder="e.g. Cashier 1">
                                        </div>
                                    </div>

                                    <hr>

                                    
                                    <ul class="nav nav-tabs" id="printer_tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#printer_default">
                                                <i class="fas fa-print"></i> <?php echo app('translator')->get('lang_v1.default_printers'); ?>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content p-3 border border-top-0">
                                        <div class="tab-pane active" id="printer_default">
                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <fieldset class="border p-3 mb-3" style="border-radius:5px;">
                                                        <legend class="w-auto px-2 fs-6"><i class="fas fa-file-alt"></i> <?php echo app('translator')->get('lang_v1.report_printer'); ?></legend>
                                                        <div class="form-group mb-2">
                                                            <select class="form-select ws-printer-select" id="ws_report_printer">
                                                                <option value=""><?php echo app('translator')->get('lang_v1.browser_default'); ?></option>
                                                            </select>
                                                        </div>
                                                        <small class="text-muted"><?php echo app('translator')->get('lang_v1.report_printer_help'); ?></small>
                                                    </fieldset>
                                                </div>

                                                
                                                <div class="col-md-6">
                                                    <fieldset class="border p-3 mb-3" style="border-radius:5px;">
                                                        <legend class="w-auto px-2 fs-6"><i class="fas fa-barcode"></i> <?php echo app('translator')->get('lang_v1.label_printer'); ?></legend>
                                                        <div class="form-group mb-2">
                                                            <select class="form-select ws-printer-select" id="ws_label_printer">
                                                                <option value=""><?php echo app('translator')->get('lang_v1.browser_default'); ?></option>
                                                            </select>
                                                        </div>
                                                        <small class="text-muted"><?php echo app('translator')->get('lang_v1.label_printer_help'); ?></small>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <div class="row">
                                                
                                                <div class="col-md-6">
                                                    <fieldset class="border p-3 mb-3" style="border-radius:5px;">
                                                        <legend class="w-auto px-2 fs-6"><i class="fas fa-receipt"></i> <?php echo app('translator')->get('lang_v1.pos_printer'); ?></legend>
                                                        <div class="form-group mb-2">
                                                            <select class="form-select ws-printer-select" id="ws_pos_printer">
                                                                <option value=""><?php echo app('translator')->get('lang_v1.browser_default'); ?></option>
                                                            </select>
                                                        </div>
                                                        <small class="text-muted"><?php echo app('translator')->get('lang_v1.pos_printer_help'); ?></small>
                                                    </fieldset>
                                                </div>

                                                
                                                <div class="col-md-6">
                                                    <fieldset class="border p-3 mb-3" style="border-radius:5px;">
                                                        <legend class="w-auto px-2 fs-6"><i class="fas fa-receipt"></i> <?php echo app('translator')->get('lang_v1.pos_printer2'); ?></legend>
                                                        <div class="form-group mb-2">
                                                            <select class="form-select ws-printer-select" id="ws_pos_printer2">
                                                                <option value=""><?php echo app('translator')->get('lang_v1.none_installed'); ?></option>
                                                            </select>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                            </div>

                                            <hr>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h5><i class="fas fa-arrows-alt-h"></i> <?php echo app('translator')->get('lang_v1.receipt_margins'); ?></h5>
                                                    <small class="text-muted d-block mb-2"><?php echo app('translator')->get('lang_v1.receipt_margins_help'); ?></small>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="ws_receipt_margin_left"><?php echo app('translator')->get('lang_v1.margin_left'); ?> (mm)</label>
                                                    <input type="number" class="form-control" id="ws_receipt_margin_left" value="3" min="0" max="20" step="0.5">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="ws_receipt_margin_right"><?php echo app('translator')->get('lang_v1.margin_right'); ?> (mm)</label>
                                                    <input type="number" class="form-control" id="ws_receipt_margin_right" value="2" min="0" max="20" step="0.5">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="ws_receipt_margin_top"><?php echo app('translator')->get('lang_v1.margin_top'); ?> (mm)</label>
                                                    <input type="number" class="form-control" id="ws_receipt_margin_top" value="0" min="0" max="20" step="0.5">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="ws_receipt_margin_bottom"><?php echo app('translator')->get('lang_v1.margin_bottom'); ?> (mm)</label>
                                                    <input type="number" class="form-control" id="ws_receipt_margin_bottom" value="0" min="0" max="20" step="0.5">
                                                </div>
                                            </div>

                                            <hr>
                                            
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <h5><i class="fas fa-cash-register"></i> <?php echo app('translator')->get('lang_v1.cash_drawer_hardware_settings'); ?></h5>
                                                    <small class="text-muted d-block mb-2"><?php echo app('translator')->get('lang_v1.cash_drawer_hardware_settings_help'); ?></small>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="ws_enable_cash_drawer_pos_printer">
                                                        <label class="form-check-label" for="ws_enable_cash_drawer_pos_printer">
                                                            <?php echo app('translator')->get('lang_v1.enable_cash_drawer_pos_printer'); ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="ws_cash_drawer_password_protected">
                                                        <label class="form-check-label" for="ws_cash_drawer_password_protected">
                                                            <?php echo app('translator')->get('lang_v1.cash_drawer_password_protected'); ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5><i class="fas fa-bolt"></i> <?php echo app('translator')->get('lang_v1.silent_print_options'); ?></h5>
                                                    <small class="text-muted d-block mb-2"><?php echo app('translator')->get('lang_v1.silent_print_help'); ?></small>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="ws_auto_print_pos">
                                                        <label class="form-check-label" for="ws_auto_print_pos">
                                                            <?php echo app('translator')->get('lang_v1.auto_print_pos_receipts'); ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="ws_auto_print_reports">
                                                        <label class="form-check-label" for="ws_auto_print_reports">
                                                            <?php echo app('translator')->get('lang_v1.auto_print_reports'); ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="ws_auto_print_labels">
                                                        <label class="form-check-label" for="ws_auto_print_labels">
                                                            <?php echo app('translator')->get('lang_v1.auto_print_labels'); ?>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times"></i> <?php echo app('translator')->get('messages.close'); ?>
                                    </button>
                                    <button type="button" class="btn btn-primary" id="save_workstation_btn">
                                        <i class="fas fa-save"></i> <?php echo app('translator')->get('messages.save'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="tab-pane" id="tab_4">
                    <div class="row">
                        <div class="col-md-12 p-5">
                            <div class="col-md-6">
                                <h4><?php echo app('translator')->get( 'lang_v1.currencies' ); ?>
                                    <small><?php echo app('translator')->get( 'lang_v1.location_currencies_help'); ?></small>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="location_currencies_table">
                                    <thead>
                                        <tr>
                                            <th><?php echo app('translator')->get( 'lang_v1.country' ); ?></th>
                                            <th><?php echo app('translator')->get( 'lang_v1.currency_name'); ?></th>
                                            <th><?php echo app('translator')->get( 'lang_v1.currency_code'); ?></th>
                                            <th><?php echo app('translator')->get( 'lang_v1.currency_symbol'); ?></th>
                                            <th><?php echo app('translator')->get( 'lang_v1.currency_thousand_separator'); ?></th>
                                            <th><?php echo app('translator')->get( 'lang_v1.currency_decimal_separator'); ?></th>
                                            <th><?php echo app('translator')->get( 'lang_v1.multiplier'); ?>
                                                <button type="button" class="btn btn-outline-info btn-xs refresh_all_exchange_rates ms-1" title="<?php echo app('translator')->get('lang_v1.refresh_all_rates'); ?>"><i class="fa fa-sync-alt"></i> All</button>
                                            </th>
                                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody id="location_currencies_body">
                                        <?php $currency_row_count = 0; ?>
                                        <?php $__empty_1 = true; $__currentLoopData = $location_currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loc_currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="currency_row" data-row="<?php echo e($currency_row_count, false); ?>">
                                            <td>
                                                <select name="location_currencies[<?php echo e($currency_row_count, false); ?>][country]" class="form-control select2 currency_country" data-row="<?php echo e($currency_row_count, false); ?>" required>
                                                    <option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
                                                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($currency->country, false); ?>" 
                                                            data-currency="<?php echo e($currency->currency, false); ?>"
                                                            data-code="<?php echo e($currency->code, false); ?>"
                                                            data-symbol="<?php echo e($currency->symbol, false); ?>"
                                                            data-thousand_separator="<?php echo e($currency->thousand_separator, false); ?>"
                                                            data-decimal_separator="<?php echo e($currency->decimal_separator, false); ?>"
                                                            <?php if($loc_currency->country == $currency->country): ?> selected <?php endif; ?>>
                                                            <?php echo e($currency->country, false); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php echo Form::hidden('location_currencies['.$currency_row_count.'][id]', $loc_currency->id); ?>

                                            </td>
                                            <td>
                                                <?php echo Form::text('location_currencies['.$currency_row_count.'][currency]', $loc_currency->currency, ['class' => 'form-control currency_name', 'required']); ?>

                                            </td>
                                            <td>
                                                <?php echo Form::text('location_currencies['.$currency_row_count.'][code]', $loc_currency->code, ['class' => 'form-control currency_code', 'required']); ?>

                                            </td>
                                            <td>
                                                <?php echo Form::text('location_currencies['.$currency_row_count.'][symbol]', $loc_currency->symbol, ['class' => 'form-control currency_symbol', 'required']); ?>

                                            </td>
                                            <td>
                                                <?php echo Form::text('location_currencies['.$currency_row_count.'][thousand_separator]', $loc_currency->thousand_separator, ['class' => 'form-control currency_thousand_separator', 'required']); ?>

                                            </td>
                                            <td>
                                                <?php echo Form::text('location_currencies['.$currency_row_count.'][decimal_separator]', $loc_currency->decimal_separator, ['class' => 'form-control currency_decimal_separator', 'required']); ?>

                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <?php echo Form::text('location_currencies['.$currency_row_count.'][multiplier]', number_format($loc_currency->multiplier, 9, '.', ''), ['class' => 'form-control currency_multiplier input_number', 'required', 'placeholder' => '0.000000000']); ?>

                                                    <button type="button" class="btn btn-outline-info btn-sm refresh_exchange_rate" title="<?php echo app('translator')->get('lang_v1.fetch_latest_rate'); ?>" data-row="<?php echo e($currency_row_count, false); ?>"><i class="fa fa-sync-alt"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove_currency_row"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <?php $currency_row_count++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr class="no_currency_row">
                                            <td colspan="8" class="text-center">
                                                <?php echo app('translator')->get('lang_v1.no_records_found'); ?>
                                            </td>
                                        </tr>
                                        <?php endif; ?>
                                        <tr class="add_currency_row_tr">
                                            <td colspan="8" class="text-center">
                                                <button class="btn btn-sm btn-default add_new_currency_row" type="button"><i class="fa fa-plus"></i> <?php echo app('translator')->get('lang_v1.add_new'); ?></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                </div> 

                
                <div class="tab-pane" id="tab_prefixes">
                    <div class="row">
                        <div class="col-md-12 p-4">
                            <h4><?php echo app('translator')->get('lang_v1.prefixes'); ?>
                                <small class="d-block text-muted mt-1"><?php echo app('translator')->get('lang_v1.location_prefixes_help'); ?></small>
                            </h4>
                        </div>
                    </div>
                    <?php echo $__env->make('location_settings.partials.prefixes', ['location' => $location, 'business' => $business], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                
                <div class="tab-pane" id="documents_and_notes_tab" role="tabpanel">
                    <input type="hidden" name="notable_id" id="notable_id" value="<?php echo e($location->id, false); ?>">
                    <input type="hidden" name="notable_type" id="notable_type" value="App\BusinessLocation">
                    <div class="row">
                        <div class="col-md-12 p-4">
                            <div class="document_note_body"></div>
                        </div>
                    </div>
                </div>

                
                <div class="tab-pane" id="tab_map">
                    <div class="row">
                        <div class="col-md-12 p-4">
                            <h4><i class="fas fa-map-marked-alt"></i> <?php echo app('translator')->get('lang_v1.business_location_map'); ?>
                                <small class="d-block text-muted mt-1"><?php echo app('translator')->get('lang_v1.business_location_map_help'); ?></small>
                            </h4>
                            <hr>
                        </div>
                    </div>
                    <?php $gmap_key = env('GOOGLE_MAP_API_KEY'); ?>
                    <?php if(empty($gmap_key)): ?>
                    <div class="row"><div class="col-md-12 p-4">
                        <div class="alert alert-warning"><strong>Google Maps API key missing.</strong> Set <code>GOOGLE_MAP_API_KEY</code> in your <code>.env</code> to enable the map picker.</div>
                    </div></div>
                    <?php else: ?>
                    <div class="row">
                        <div class="col-md-4 px-4">
                            <div class="form-group mb-3">
                                <label for="map_address_search"><?php echo app('translator')->get('lang_v1.search_address'); ?></label>
                                <input type="text" id="map_address_search" class="form-control" placeholder="<?php echo app('translator')->get('lang_v1.start_typing_address'); ?>" autocomplete="off">
                                <small class="form-text text-muted"><?php echo app('translator')->get('lang_v1.search_address_help'); ?></small>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <?php echo Form::label('latitude', __('lang_v1.latitude')); ?>

                                        <?php echo Form::text('latitude', $location->latitude, ['class' => 'form-control', 'id' => 'location_latitude', 'placeholder' => '0.0000000', 'readonly']); ?>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-3">
                                        <?php echo Form::label('longitude', __('lang_v1.longitude')); ?>

                                        <?php echo Form::text('longitude', $location->longitude, ['class' => 'form-control', 'id' => 'location_longitude', 'placeholder' => '0.0000000', 'readonly']); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <?php echo Form::label('map_zoom', __('lang_v1.map_zoom')); ?>

                                <?php echo Form::number('map_zoom', $location->map_zoom ?? 15, ['class' => 'form-control', 'id' => 'location_map_zoom', 'min' => 1, 'max' => 22]); ?>

                            </div>
                            <div class="d-grid gap-2">
                                <button type="button" id="btn_use_my_location" class="btn btn-outline-primary"><i class="fas fa-crosshairs"></i> <?php echo app('translator')->get('lang_v1.use_my_current_location'); ?></button>
                                <button type="button" id="btn_clear_location" class="btn btn-outline-danger"><i class="fas fa-times"></i> <?php echo app('translator')->get('lang_v1.clear_pinned_location'); ?></button>
                            </div>
                            <div class="alert alert-info mt-3 mb-0">
                                <i class="fas fa-info-circle"></i> <?php echo app('translator')->get('lang_v1.business_location_map_delivery_note'); ?>
                            </div>
                        </div>
                        <div class="col-md-8 px-4">
                            <div id="business_location_map" style="height:520px; width:100%; border:1px solid #ddd; border-radius:6px;"></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- /.tab-content -->
          </div>
            <?php echo Form::close(); ?>


          <div id="location-settings-footer-actions-template" class="d-none">
              <button class="btn btn-primary" type="submit" form="bl_receipt_setting_form"><i class="fas fa-sync"></i> <?php echo app('translator')->get('messages.update'); ?></button>
          </div>
          <!-- nav-tabs-custom -->
        </div>
    </div>
	
    <div class="modal fade invoice_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade invoice_edit_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php echo $__env->make('documents_and_notes.document_and_note_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $gmap_key = env('GOOGLE_MAP_API_KEY'); ?>
<?php if(!empty($gmap_key)): ?>
<script>
(function () {
    var mapInstance = null;

    function buildMap() {
        if (mapInstance) {
            // Ensure tiles paint after the container becomes visible
            google.maps.event.trigger(mapInstance, 'resize');
            mapInstance.setCenter(mapInstance.getCenter());
            return;
        }
        var mapEl = document.getElementById('business_location_map');
        if (!mapEl) { return; }

        var latInput = document.getElementById('location_latitude');
        var lngInput = document.getElementById('location_longitude');
        var zoomInput = document.getElementById('location_map_zoom');
        var searchInput = document.getElementById('map_address_search');

        var savedLat = parseFloat(latInput.value);
        var savedLng = parseFloat(lngInput.value);
        var savedZoom = parseInt(zoomInput.value, 10) || 15;
        var hasSaved = !isNaN(savedLat) && !isNaN(savedLng);
        // Default center: Karachi if nothing saved
        var center = hasSaved ? { lat: savedLat, lng: savedLng } : { lat: 24.8607, lng: 67.0011 };

        var map = new google.maps.Map(mapEl, {
            center: center,
            zoom: hasSaved ? savedZoom : 12,
            mapTypeControl: true,
            streetViewControl: false,
            fullscreenControl: true
        });

        var marker = new google.maps.Marker({
            position: center,
            map: hasSaved ? map : null,
            draggable: true,
            title: '<?php echo e(addslashes($location->name), false); ?>'
        });

        function setPin(latLng, zoom) {
            marker.setPosition(latLng);
            marker.setMap(map);
            map.panTo(latLng);
            if (zoom) { map.setZoom(zoom); }
            latInput.value = latLng.lat().toFixed(7);
            lngInput.value = latLng.lng().toFixed(7);
        }

        // Click map to drop pin
        map.addListener('click', function (e) { setPin(e.latLng); });
        marker.addListener('dragend', function (e) { setPin(e.latLng); });
        map.addListener('zoom_changed', function () { zoomInput.value = map.getZoom(); });

        // Places Autocomplete
        if (searchInput && google.maps.places) {
            var autocomplete = new google.maps.places.Autocomplete(searchInput, { fields: ['geometry', 'formatted_address', 'name'] });
            autocomplete.bindTo('bounds', map);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                if (!place.geometry || !place.geometry.location) { return; }
                if (place.geometry.viewport) { map.fitBounds(place.geometry.viewport); }
                else { map.setCenter(place.geometry.location); map.setZoom(17); }
                setPin(place.geometry.location, map.getZoom());
            });
        }

        // Use my current location
        var btnGeo = document.getElementById('btn_use_my_location');
        if (btnGeo) {
            btnGeo.addEventListener('click', function () {
                if (!navigator.geolocation) { alert('Geolocation is not supported by your browser.'); return; }
                navigator.geolocation.getCurrentPosition(function (pos) {
                    var ll = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
                    setPin(ll, 17);
                }, function (err) { alert('Unable to retrieve your location: ' + err.message); });
            });
        }

        // Clear pin
        var btnClear = document.getElementById('btn_clear_location');
        if (btnClear) {
            btnClear.addEventListener('click', function () {
                marker.setMap(null);
                latInput.value = '';
                lngInput.value = '';
            });
        }

        // Trigger map resize when tab becomes visible (otherwise map renders blank)
        document.querySelectorAll('a[href="#tab_map"]').forEach(function (link) {
            link.addEventListener('shown.bs.tab', function () {
                google.maps.event.trigger(map, 'resize');
                if (hasSaved) { map.setCenter({ lat: parseFloat(latInput.value) || 0, lng: parseFloat(lngInput.value) || 0 }); }
            });
            // Bootstrap 5 fires on the link element
            link.addEventListener('click', function () { setTimeout(function () { google.maps.event.trigger(map, 'resize'); }, 200); });
        });

        mapInstance = map;
    };

    window.initBusinessLocationMap = function () {
        // Google Maps API has loaded. If the Map tab is already active, build immediately;
        // otherwise wait until the user opens it.
        var pane = document.getElementById('tab_map');
        if (pane && pane.classList.contains('active')) {
            buildMap();
        }
        // Wire tab-show event so the map builds the first time the user opens the tab.
        document.querySelectorAll('a[href="#tab_map"]').forEach(function (link) {
            link.addEventListener('shown.bs.tab', buildMap);
            link.addEventListener('click', function () { setTimeout(buildMap, 250); });
        });
    };

    // Inject the Google Maps script (callback-based, single-load guarded)
    if (!window.__bl_gmaps_loading) {
        window.__bl_gmaps_loading = true;
        var s = document.createElement('script');
        s.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo e($gmap_key, false); ?>&libraries=places&callback=initBusinessLocationMap';
        s.async = true; s.defer = true;
        document.head.appendChild(s);
    }
})();
</script>
<?php endif; ?>
<script>
$(document).ready(function() {
    function updateLocationPrefixPreview() {
        var $preview = $('#location_prefix_preview');
        if (!$preview.length) {
            return;
        }

        var format = $('input[type=radio][name="ref_no_prefixes[transaction_number_format]"]:checked').val() || 'year';
        var prefixSelector = $preview.data('prefix-selector');
        var prefix = $(prefixSelector).val() || 'PI';
        var locationCode = $preview.data('location-code') || '01';
        var year = format == 'year' ? new Date().getFullYear() : '';

        $preview.text(prefix + locationCode + year + APP.INVOICE_SCHEME_SEPARATOR + '000001');
    }

    $(document).on('change', 'input[type=radio][name="ref_no_prefixes[transaction_number_format]"]', updateLocationPrefixPreview);
    $(document).on('keyup change', "input[name='ref_no_prefixes[purchase]']", updateLocationPrefixPreview);
    updateLocationPrefixPreview();

    // Track currency row count
    var currency_row_count = <?php echo e($location_currencies->count(), false); ?>;
    
    // Add new currency row
    $(document).on('click', '.add_new_currency_row', function() {
        var location_id = <?php echo e($location->id, false); ?>;
        $.ajax({
            url: "<?php echo e(route('location.currency_row', ['location_id' => $location->id]), false); ?>",
            type: 'GET',
            data: {
                row_count: currency_row_count
            },
            success: function(response) {
                // Remove no records row if exists
                $('.no_currency_row').remove();
                // Insert new row before the add button row
                $('.add_currency_row_tr').before(response);
                // Initialize select2 for new row
                $('.currency_row[data-row="' + currency_row_count + '"] .select2').select2();
                currency_row_count++;
            }
        });
    });

    // Remove currency row
    $(document).on('click', '.remove_currency_row', function() {
        $(this).closest('tr').remove();
        // Show no records row if no currency rows left
        if ($('.currency_row').length == 0) {
            $('.add_currency_row_tr').before('<tr class="no_currency_row"><td colspan="8" class="text-center"><?php echo app('translator')->get("lang_v1.no_records_found"); ?></td></tr>');
        }
    });

    // Auto-fill currency details when country is selected
    $(document).on('change', '.currency_country', function() {
        var row = $(this).data('row');
        var selected = $(this).find(':selected');
        
        var tr = $(this).closest('tr');
        tr.find('.currency_name').val(selected.data('currency'));
        tr.find('.currency_code').val(selected.data('code'));
        tr.find('.currency_symbol').val(selected.data('symbol'));
        tr.find('.currency_thousand_separator').val(selected.data('thousand_separator'));
        tr.find('.currency_decimal_separator').val(selected.data('decimal_separator'));

        // Auto-fetch exchange rate for the selected currency
        var currency_code = selected.data('code');
        if (currency_code) {
            fetchExchangeRate(tr, currency_code);
        }
    });

    // Refresh exchange rate for a single row
    $(document).on('click', '.refresh_exchange_rate', function(e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var currency_code = tr.find('.currency_code').val();
        if (currency_code) {
            fetchExchangeRate(tr, currency_code);
        } else {
            toastr.warning('Please select a country first.');
        }
    });

    // Refresh all exchange rates
    $(document).on('click', '.refresh_all_exchange_rates', function(e) {
        e.preventDefault();
        var btn = $(this);
        btn.prop('disabled', true).find('i').addClass('fa-spin');
        var rows = $('.currency_row');
        var total = rows.length;
        var completed = 0;

        if (total === 0) {
            btn.prop('disabled', false).find('i').removeClass('fa-spin');
            toastr.info('No currency rows to update.');
            return;
        }

        rows.each(function() {
            var tr = $(this);
            var currency_code = tr.find('.currency_code').val();
            if (currency_code) {
                fetchExchangeRate(tr, currency_code, function() {
                    completed++;
                    if (completed >= total) {
                        btn.prop('disabled', false).find('i').removeClass('fa-spin');
                        toastr.success('All exchange rates updated.');
                    }
                });
            } else {
                completed++;
                if (completed >= total) {
                    btn.prop('disabled', false).find('i').removeClass('fa-spin');
                }
            }
        });
    });

    /**
     * Fetch exchange rate from server for a given currency code and update the multiplier field.
     */
    function fetchExchangeRate(tr, currency_code, callback) {
        var multiplierField = tr.find('.currency_multiplier');
        var refreshBtn = tr.find('.refresh_exchange_rate');

        // Show loading state
        refreshBtn.prop('disabled', true).find('i').addClass('fa-spin');
        multiplierField.attr('placeholder', 'Fetching...');

        $.ajax({
            url: "<?php echo e(route('location.get_exchange_rate', ['location_id' => $location->id]), false); ?>",
            type: 'GET',
            dataType: 'json',
            data: {
                currency_code: currency_code
            },
            success: function(response) {
                if (response.success) {
                    multiplierField.val(response.multiplier);
                    toastr.success(currency_code + ' rate: ' + response.multiplier);
                } else {
                    toastr.error(response.msg || 'Failed to fetch exchange rate.');
                }
            },
            error: function(xhr) {
                toastr.error('Could not fetch exchange rate. Check your connection.');
            },
            complete: function() {
                refreshBtn.prop('disabled', false).find('i').removeClass('fa-spin');
                multiplierField.attr('placeholder', '0.000000000');
                if (typeof callback === 'function') {
                    callback();
                }
            }
        });
    }
});

// ═══ Workstation Hardware Setup ═══════════════════════════════════════════
<?php if($show_stations): ?>
(function() {
    var locationId = <?php echo e($location->id, false); ?>;
    var storeUrl = "<?php echo e(route('location.workstations.store', [$location->id]), false); ?>";

    // Check if running inside Electron (web2desk)
    function isElectron() {
        return !!(
            (window.electronAPI) ||
            (window.process && window.process.versions && window.process.versions.electron) ||
            (navigator.userAgent && navigator.userAgent.indexOf('Electron') !== -1) ||
            (window.require && (function() {
                try { window.require('electron'); return true; } catch(e) { return false; }
            })())
        );
    }

    // Detect installed printers via Electron API
    function detectPrinters(callback) {
        if (window.electronAPI && typeof window.electronAPI.getPrinters === 'function') {
            window.electronAPI.getPrinters().then(function(printers) {
                callback(printers);
            }).catch(function() {
                callback([]);
            });
        } else if (window.require) {
            // Legacy Electron: try webContents.getPrintersAsync via remote
            try {
                var remote = window.require('@electron/remote') || window.require('electron').remote;
                if (remote) {
                    var webContents = remote.getCurrentWebContents();
                    var printers = webContents.getPrinters();
                    callback(printers.map(function(p) {
                        return { name: p.name, isDefault: p.isDefault };
                    }));
                    return;
                }
            } catch(e) {}
            callback([]);
        } else {
            callback([]);
        }
    }

    // Detect machine hostname via Electron
    function detectMachineName(callback) {
        // Method 1: Modern Electron preload API
        if (window.electronAPI && typeof window.electronAPI.getHostname === 'function') {
            window.electronAPI.getHostname().then(function(name) {
                callback(name);
            }).catch(function() {
                callback('');
            });
            return;
        }
        // Method 2: Legacy Electron with nodeIntegration
        if (window.require) {
            try {
                var os = window.require('os');
                callback(os.hostname());
                return;
            } catch(e) {}
        }
        // Method 3: process.env (web2desk with contextBridge or partial node access)
        if (window.process && window.process.env) {
            var envName = window.process.env.COMPUTERNAME || window.process.env.HOSTNAME;
            if (envName) {
                callback(envName);
                return;
            }
        }
        // Method 4: Server-side detection via AJAX
        if (isElectron()) {
            $.ajax({
                url: '<?php echo e(route("workstation.detect-hostname"), false); ?>',
                method: 'GET',
                dataType: 'json',
                success: function(resp) {
                    if (resp && resp.hostname) {
                        callback(resp.hostname);
                    } else {
                        callback('');
                    }
                },
                error: function() {
                    callback('');
                }
            });
            return;
        }
        callback('');
    }

    function populatePrinterDropdowns(printers) {
        var selects = ['#ws_pos_printer', '#ws_pos_printer2', '#ws_report_printer', '#ws_label_printer'];
        selects.forEach(function(sel) {
            var $el = $(sel);
            var currentVal = $el.data('current-value') || '';
            var firstOptText = $el.find('option:first').text();
            $el.empty().append('<option value="">' + firstOptText + '</option>');
            printers.forEach(function(p) {
                var name = p.name || p.displayName || p;
                var isDefault = p.isDefault ? ' ★' : '';
                $el.append('<option value="' + name + '"' + (name === currentVal ? ' selected' : '') + '>' + name + isDefault + '</option>');
            });
        });
    }

    // Populate on modal open
    function openModal(data) {
        var $modal = $('#workstation_modal');

        // Reset
        $('#ws_machine_name').val(data ? data.machine_name : '').prop('readonly', !!data);
        $('#ws_display_name').val(data ? data.display_name : '');
        $('#ws_auto_print_pos').prop('checked', data ? data.auto_print_pos : false);
        $('#ws_auto_print_reports').prop('checked', data ? data.auto_print_reports : false);
        $('#ws_auto_print_labels').prop('checked', data ? data.auto_print_labels : false);

        // Populate receipt margins from settings JSON
        var s = (data && data.settings) ? (typeof data.settings === 'string' ? JSON.parse(data.settings) : data.settings) : {};
        $('#ws_receipt_margin_left').val(s.receipt_margin_left !== undefined ? s.receipt_margin_left : 3);
        $('#ws_receipt_margin_right').val(s.receipt_margin_right !== undefined ? s.receipt_margin_right : 2);
        $('#ws_receipt_margin_top').val(s.receipt_margin_top !== undefined ? s.receipt_margin_top : 0);
        $('#ws_receipt_margin_bottom').val(s.receipt_margin_bottom !== undefined ? s.receipt_margin_bottom : 0);
        $('#ws_enable_cash_drawer_pos_printer').prop('checked', !!s.enable_cash_drawer_pos_printer);
        $('#ws_cash_drawer_password_protected').prop('checked', !!s.cash_drawer_password_protected);

        // Store current values for selection after printers load
        $('#ws_pos_printer').data('current-value', data ? (data.pos_printer_name || '') : '');
        $('#ws_pos_printer2').data('current-value', data ? (data.pos_printer2_name || '') : '');
        $('#ws_report_printer').data('current-value', data ? (data.report_printer_name || '') : '');
        $('#ws_label_printer').data('current-value', data ? (data.label_printer_name || '') : '');

        // Detect printers
        detectPrinters(function(printers) {
            if (printers.length > 0) {
                populatePrinterDropdowns(printers);
            } else {
                // Not Electron - allow manual typing by converting selects to text inputs
                // Or show a message
                var selects = ['#ws_pos_printer', '#ws_pos_printer2', '#ws_report_printer', '#ws_label_printer'];
                selects.forEach(function(sel) {
                    var $el = $(sel);
                    var val = $el.data('current-value') || '';
                    var $input = $('<input type="text" class="form-control ws-printer-manual" id="' + sel.replace('#','') + '" value="' + val + '" placeholder="Enter Windows printer driver name">');
                    $el.replaceWith($input);
                });
            }
        });

        // Move modal to body to avoid z-index issues from parent stacking context
        if (!$modal.data('moved-to-body')) {
            $modal.appendTo('body');
            $modal.data('moved-to-body', true);
        }

        $modal.modal('show');
    }

    // Add workstation
    $(document).on('click', '#add_workstation_btn', function() {
        openModal(null);
        // Auto-detect machine name for new workstation
        detectMachineName(function(name) {
            if (name) {
                $('#ws_machine_name').val(name);
            }
            $('#ws_machine_name').prop('readonly', false);
        });
    });

    // Edit workstation
    $(document).on('click', '.edit_workstation_btn', function() {
        var data = $(this).data('ws');
        openModal(data);
    });

    // Save workstation
    $(document).on('click', '#save_workstation_btn', function() {
        var btn = $(this);
        btn.prop('disabled', true);

        var data = {
            machine_name: $('#ws_machine_name').val(),
            display_name: $('#ws_display_name').val(),
            pos_printer_name: ($('#ws_pos_printer').is('select') ? $('#ws_pos_printer').val() : $('#ws_pos_printer').val()) || '',
            pos_printer2_name: ($('#ws_pos_printer2').is('select') ? $('#ws_pos_printer2').val() : $('#ws_pos_printer2').val()) || '',
            report_printer_name: ($('#ws_report_printer').is('select') ? $('#ws_report_printer').val() : $('#ws_report_printer').val()) || '',
            label_printer_name: ($('#ws_label_printer').is('select') ? $('#ws_label_printer').val() : $('#ws_label_printer').val()) || '',
            auto_print_pos: $('#ws_auto_print_pos').is(':checked') ? 1 : 0,
            auto_print_reports: $('#ws_auto_print_reports').is(':checked') ? 1 : 0,
            auto_print_labels: $('#ws_auto_print_labels').is(':checked') ? 1 : 0,
            receipt_margin_left: $('#ws_receipt_margin_left').val() || 3,
            receipt_margin_right: $('#ws_receipt_margin_right').val() || 2,
            receipt_margin_top: $('#ws_receipt_margin_top').val() || 0,
            receipt_margin_bottom: $('#ws_receipt_margin_bottom').val() || 0,
            enable_cash_drawer_pos_printer: $('#ws_enable_cash_drawer_pos_printer').is(':checked') ? 1 : 0,
            cash_drawer_password_protected: $('#ws_cash_drawer_password_protected').is(':checked') ? 1 : 0,
        };

        if (!data.machine_name) {
            toastr.error('<?php echo app('translator')->get("lang_v1.machine_name_required"); ?>');
            btn.prop('disabled', false);
            return;
        }

        $.ajax({
            url: storeUrl,
            type: 'POST',
            data: data,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function(result) {
                if (result.success) {
                    toastr.success(result.msg);
                    $('#workstation_modal').modal('hide');
                    // Reload the page to show updated table
                    location.reload();
                } else {
                    toastr.error(result.msg);
                }
            },
            error: function() {
                toastr.error('<?php echo app('translator')->get("messages.something_went_wrong"); ?>');
            },
            complete: function() {
                btn.prop('disabled', false);
            }
        });
    });

    // Delete workstation
    $(document).on('click', '.delete_workstation_btn', function() {
        var href = $(this).data('href');
        var row = $(this).closest('tr');
        swal({
            title: LANG.sure,
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then(function(confirm) {
            if (confirm) {
                $.ajax({
                    url: href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function(result) {
                        if (result.success) {
                            toastr.success(result.msg);
                            row.fadeOut(300, function() { $(this).remove(); });
                        } else {
                            toastr.error(result.msg);
                        }
                    },
                    error: function() {
                        toastr.error('<?php echo app('translator')->get("messages.something_went_wrong"); ?>');
                    }
                });
            }
        });
    });

    // Detect machine button
    $(document).on('click', '#ws_detect_machine', function() {
        var $btn = $(this);
        $btn.prop('disabled', true);
        detectMachineName(function(name) {
            $btn.prop('disabled', false);
            if (name) {
                $('#ws_machine_name').val(name);
                toastr.success('Detected: ' + name);
            } else if (isElectron()) {
                toastr.warning('<?php echo app('translator')->get("lang_v1.machine_detect_electron_failed"); ?>');
                $('#ws_machine_name').prop('readonly', false).focus();
            } else {
                toastr.warning('<?php echo app('translator')->get("lang_v1.machine_detect_not_available"); ?>');
                $('#ws_machine_name').prop('readonly', false).focus();
            }
        });
    });
})();
<?php endif; ?>
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>