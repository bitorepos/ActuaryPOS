
<?php $__env->startSection('title', __('lang_v1.edit_purchase_return')); ?>

<?php $__env->startSection('content'); ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <br>
        <h1><?php echo app('translator')->get('lang_v1.edit_purchase_return'); ?> <i class="fa fa-keyboard-o hover-q text-muted" aria-hidden="true"
            style="cursor:pointer" onclick="$('#purchase_keyboard_shortcuts_modal').modal('show');"
            title="<?php echo app('translator')->get('lang_v1.purchase_show_shortcuts_help'); ?> (<?php echo e(!empty($shortcuts['purchase']['show_shortcuts_help']) ? strtoupper($shortcuts['purchase']['show_shortcuts_help']) : 'F7', false); ?>)"></i></h1>
    </section>

    <!-- Main content -->
    <section class="content no-print">
        <?php echo Form::open([
            'url' => action([\App\Http\Controllers\CombinedPurchaseReturnController::class, 'update']),
            'method' => 'post',
            'id' => 'purchase_return_form',
            'files' => true,
        ]); ?>

        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <input type="hidden" name="purchase_return_id" value="<?php echo e($purchase_return->id, false); ?>">
                            <input type="hidden" id="location_id" value="<?php echo e($purchase_return->location_id, false); ?>">
                            <?php echo Form::label('supplier_id', __('purchase.supplier') . ':*'); ?>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-user"></i>
                                </span>
                                <?php echo Form::select(
                                    'contact_id',
                                    [$purchase_return->contact_id => !empty($purchase_return->contact->name) ? $purchase_return->contact->name : $purchase_return->contact->supplier_business_name],
                                    $purchase_return->contact_id,
                                    ['class' => 'form-control', 'placeholder' => __('messages.please_select'), 'required', 'id' => 'supplier_id', 'style' => 'width: 100%;'],
                                ); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('ref_no', __('purchase.ref_no') . ':'); ?>

                            <?php echo Form::text('ref_no', $purchase_return->ref_no, ['class' => 'form-control', empty($user_settings['enable_purchase_transaction_no']) ? 'readonly' : '',]); ?>

                            <b id="ref_no_error" class="error hide"><?php echo app('translator')->get('lang_v1.not_unique', ['name' => __('purchase.ref_no') ]); ?></b>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <?php echo Form::label('transaction_date', __('messages.date') . ':*'); ?>

                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <?php echo Form::text('transaction_date', \Carbon::createFromTimestamp(strtotime($purchase_return->transaction_date))->format(session('business.date_format') . ' ' . 'h:i A'), [
                                    'class' => 'form-control',
                                    'readonly',
                                    'required',
                                ]); ?>

                            </div>
                        </div>
                    </div>
                    <?php if(in_array('upload_documents', $enabled_modules)): ?>
                    <?php if(empty($common_settings['hide_attach_document_purchase'])): ?>
                        <div class="col-sm-3">
                            <div class="form-group mb-2">
                                <?php echo Form::label('document', __('purchase.attach_document') . ':'); ?>

                                <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?><br><?php echo app('translator')->get('lang_v1.allowed_file'); ?>: <?php echo e(implode(', ', config('constants.document_upload_mimes_types')), false); ?>"></i>
                                <?php echo Form::file('document', [
                                    'id' => 'upload_document',
                                    'accept' => implode(',', array_keys(config('constants.document_upload_mimes_types'))),
                                ]); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <?php endif; ?>
                    <div class="col-sm-3">
                        <div class="form-group mb-2">
                            <div class="form-check">
                                <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="is_inclusive" id="is_inclusive_tax" <?php echo
                                        !empty($is_purchase_return_tax_inclusive) ? 'Checked' : '' ?>>
                                    Is Tax Inclusive?
                                </label>
                            </div>
                        </div>
                    </div>
                    <?php
                        $custom_labels = json_decode(session('business.custom_labels'), true);

                        $custom_field_1_label = !empty($custom_labels['purchase']['custom_field_1']) ? $custom_labels['purchase']['custom_field_1'] : '';
                        $is_custom_field_1_required = !empty($custom_labels['purchase']['is_custom_field_1_required']) && $custom_labels['purchase']['is_custom_field_1_required'] == 1 ? true : false;

                        $custom_field_2_label = !empty($custom_labels['purchase']['custom_field_2']) ? $custom_labels['purchase']['custom_field_2'] : '';
                        $is_custom_field_2_required = !empty($custom_labels['purchase']['is_custom_field_2_required']) && $custom_labels['purchase']['is_custom_field_2_required'] == 1 ? true : false;

                        $custom_field_3_label = !empty($custom_labels['purchase']['custom_field_3']) ? $custom_labels['purchase']['custom_field_3'] : '';
                        $is_custom_field_3_required = !empty($custom_labels['purchase']['is_custom_field_3_required']) && $custom_labels['purchase']['is_custom_field_3_required'] == 1 ? true : false;

                        $custom_field_4_label = !empty($custom_labels['purchase']['custom_field_4']) ? $custom_labels['purchase']['custom_field_4'] : '';
                        $is_custom_field_4_required = !empty($custom_labels['purchase']['is_custom_field_4_required']) && $custom_labels['purchase']['is_custom_field_4_required'] == 1 ? true : false;

                        $custom_field_5_label = !empty($custom_labels['purchase']['custom_field_5']) ? $custom_labels['purchase']['custom_field_5'] : '';
                        $is_custom_field_5_required = !empty($custom_labels['purchase']['is_custom_field_5_required']) && $custom_labels['purchase']['is_custom_field_5_required'] == 1 ? true : false;

                        $custom_field_6_label = !empty($custom_labels['purchase']['custom_field_6']) ? $custom_labels['purchase']['custom_field_6'] : '';
                        $is_custom_field_6_required = !empty($custom_labels['purchase']['is_custom_field_6_required']) && $custom_labels['purchase']['is_custom_field_6_required'] == 1 ? true : false;

                        $custom_field_7_label = !empty($custom_labels['purchase']['custom_field_7']) ? $custom_labels['purchase']['custom_field_7'] : '';
                        $is_custom_field_7_required = !empty($custom_labels['purchase']['is_custom_field_7_required']) && $custom_labels['purchase']['is_custom_field_7_required'] == 1 ? true : false;

                        $custom_field_8_label = !empty($custom_labels['purchase']['custom_field_8']) ? $custom_labels['purchase']['custom_field_8'] : '';
                        $is_custom_field_8_required = !empty($custom_labels['purchase']['is_custom_field_8_required']) && $custom_labels['purchase']['is_custom_field_8_required'] == 1 ? true : false;
                    ?>
                    <div class="col-sm-12">
                        <div class="row">
                            <?php if(!empty($custom_field_1_label)): ?>
                                <?php
                                    $label_1 = $custom_field_1_label . ':';
                                    if ($is_custom_field_1_required) {
                                        $label_1 .= '*';
                                    }
                                ?>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo Form::label('custom_field_1', $label_1); ?>

                                        <?php echo Form::text('custom_field_1', $purchase_return->custom_field_1, ['class' => 'form-control', 'placeholder' => $custom_field_1_label, 'required' => $is_custom_field_1_required]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($custom_field_2_label)): ?>
                                <?php
                                    $label_2 = $custom_field_2_label . ':';
                                    if ($is_custom_field_2_required) {
                                        $label_2 .= '*';
                                    }
                                ?>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo Form::label('custom_field_2', $label_2); ?>

                                        <?php echo Form::text('custom_field_2', $purchase_return->custom_field_2, ['class' => 'form-control', 'placeholder' => $custom_field_2_label, 'required' => $is_custom_field_2_required]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($custom_field_3_label)): ?>
                                <?php
                                    $label_3 = $custom_field_3_label . ':';
                                    if ($is_custom_field_3_required) {
                                        $label_3 .= '*';
                                    }
                                ?>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo Form::label('custom_field_3', $label_3); ?>

                                        <?php echo Form::text('custom_field_3', $purchase_return->custom_field_3, ['class' => 'form-control', 'placeholder' => $custom_field_3_label, 'required' => $is_custom_field_3_required]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($custom_field_4_label)): ?>
                                <?php
                                    $label_4 = $custom_field_4_label . ':';
                                    if ($is_custom_field_4_required) {
                                        $label_4 .= '*';
                                    }
                                ?>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo Form::label('custom_field_4', $label_4); ?>

                                        <?php echo Form::text('custom_field_4', $purchase_return->custom_field_4, ['class' => 'form-control', 'placeholder' => $custom_field_4_label, 'required' => $is_custom_field_4_required]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($custom_field_5_label)): ?>
                                <?php
                                    $label_5 = $custom_field_5_label . ':';
                                    if ($is_custom_field_5_required) {
                                        $label_5 .= '*';
                                    }
                                ?>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo Form::label('custom_field_5', $label_5); ?>

                                        <?php echo Form::text('custom_field_5', $purchase_return->custom_field_5, ['class' => 'form-control', 'placeholder' => $custom_field_5_label, 'required' => $is_custom_field_5_required]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($custom_field_6_label)): ?>
                                <?php
                                    $label_6 = $custom_field_6_label . ':';
                                    if ($is_custom_field_6_required) {
                                        $label_6 .= '*';
                                    }
                                ?>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo Form::label('custom_field_6', $label_6); ?>

                                        <?php echo Form::text('custom_field_6', $purchase_return->custom_field_6, ['class' => 'form-control', 'placeholder' => $custom_field_6_label, 'required' => $is_custom_field_6_required]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($custom_field_7_label)): ?>
                                <?php
                                    $label_7 = $custom_field_7_label . ':';
                                    if ($is_custom_field_7_required) {
                                        $label_7 .= '*';
                                    }
                                ?>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo Form::label('custom_field_7', $label_7); ?>

                                        <?php echo Form::text('custom_field_7', $purchase_return->custom_field_7, ['class' => 'form-control', 'placeholder' => $custom_field_7_label, 'required' => $is_custom_field_7_required]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if(!empty($custom_field_8_label)): ?>
                                <?php
                                    $label_8 = $custom_field_8_label . ':';
                                    if ($is_custom_field_8_required) {
                                        $label_8 .= '*';
                                    }
                                ?>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <?php echo Form::label('custom_field_8', $label_8); ?>

                                        <?php echo Form::text('custom_field_8', $purchase_return->custom_field_8, ['class' => 'form-control', 'placeholder' => $custom_field_8_label, 'required' => $is_custom_field_8_required]); ?>

                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="hidden" id="page_type" value="purchase">
                </div>
            </div>
        </div>
        <!--box end-->
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title"><?php echo e(__('stock_adjustment.search_products'), false); ?></h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2">
                        <div class="form-group mb-2">
                            <div class="input-group">
                                
                                    <button type="button" class="btn btn-secondary btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
                                
                                <?php echo Form::text('search_product', null, [
                                    'class' => 'form-control',
                                    'id' => 'search_product_for_purchase_return',
                                    'placeholder' => __('stock_adjustment.search_products'),
                                ]); ?>

                            </div>
                        </div>
                    </div>
                </div>
                <?php
                $hide_tax = '';
                    // if( session()->get('business.enable_inline_tax') == 0){
                    // 	$hide_tax = 'hide';
                    // }
                    if (empty($common_settings['enable_inline_tax_purchase']) || $taxes->isEmpty()) {
                        $hide_tax = 'hide';
                    }
                ?>
                <?php
                $hide_discount = '';
                if (empty($common_settings['enable_inline_discount_purchase'])) {
                    $hide_discount = 'hide';
                }
                $hide_discount2 = '';
                if (empty($common_settings['enable_inline_discount2_purchase'])) {
                    $hide_discount2 = 'hide';
                }
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <input type="hidden" id="total_amount" name="final_total"
                            value="<?php echo e($purchase_return->final_total, false); ?>">
                        <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                            <table class="table table-bordered table-striped table-th-skin table-condensed"
                                id="purchase_return_product_table">
                                <thead>
                                    <tr>
                                        <th class="text-nowrap" style="width:1%; min-width:30px">#</th>
                                        <th class="text-nowrap" style="width:1%; min-width:50px"><?php echo app('translator')->get('product.sku'); ?></th>
                                        <th class="text-nowrap" style="width:100%">
                                            <?php echo app('translator')->get('sale.product'); ?>
                                        </th>
                                        
                                        <th class="text-nowrap">
                                            <?php echo app('translator')->get('sale.qty'); ?>
                                        </th>
                                        <th class="text-nowrap text-end"><?php echo app('translator')->get('lang_v1.unit_cost_before_discount'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                                        <th class="text-nowrap <?php echo e($hide_discount, false); ?>"><?php echo app('translator')->get('lang_v1.discount_percent'); ?></th>
                                        <th class="text-nowrap <?php echo e($hide_discount2, false); ?>"><?php echo app('translator')->get('lang_v1.discount_percent'); ?> 2</th>
                                        <th class="text-nowrap text-end <?php echo e($hide_discount, false); ?>"><?php echo app('translator')->get('purchase.unit_cost_before_tax'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                                        <th class="text-nowrap text-end"><?php echo app('translator')->get('purchase.subtotal_before_tax'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                                        <th class="text-nowrap <?php echo e($hide_tax, false); ?>"><?php echo app('translator')->get('purchase.product_tax'); ?> <br> (Name - Amount - Total)</th>
                                        <th class="text-nowrap text-end <?php echo e($hide_tax, false); ?>"><?php echo app('translator')->get('purchase.net_cost'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                                        <th class="text-nowrap text-end"><?php echo app('translator')->get('sale.subtotal'); ?> <span class="selected_currency_symbol badge bg-info" style="font-size:10px;"></span></th>
                                        <?php if(session('business.enable_lot_number')): ?>
                                            <th class="text-nowrap">
                                                Lot <br> Number
                                            </th>
                                        <?php endif; ?>
                                        <?php if(session('business.enable_product_expiry')): ?>
                                            <th class="text-nowrap">
                                                <?php echo app('translator')->get('product.exp_date'); ?>
                                            </th>
                                        <?php endif; ?>
                                        <th class="text-nowrap" style="width:1%; min-width:30px"><i class="fa fa-trash" aria-hidden="true"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $__env->make('purchase_return.partials.product_table_row', [
                                            'product' => $purchase_line,
                                            'row_index' => $loop->index,
                                            'edit' => true,
                                            'is_tax_inclusive' => !empty($is_purchase_return_tax_inclusive) ? true : false,
                                        ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                                        <?php
                                            $row_index = $loop->iteration;
                                        ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <?php if(!empty($common_settings['enable_total_tax_purchase'])): ?>
                    <div class="col-md-4">
                        <input type="hidden" id="product_row_index" value="<?php echo e($row_index, false); ?>">
                        <div class="form-group mb-2">
                            <?php echo Form::label('tax_id', __('purchase.purchase_tax') . ':'); ?>

                            <select name="tax_id" id="tax_id" class="form-control select2"
                                placeholder="'Please Select'">
                                <option value="" data-tax_amount="0" data-tax_type="fixed" selected><?php echo app('translator')->get('lang_v1.none'); ?>
                                </option>
                                <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tax): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($tax->id, false); ?>" data-tax_amount="<?php echo e($tax->amount, false); ?>"
                                        data-tax_type="<?php echo e($tax->type, false); ?>"
                                        <?php if($purchase_return->tax_id == $tax->id): ?> selected <?php endif; ?>><?php echo e($tax->name, false); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php echo Form::hidden('tax_amount', $purchase_return->tax_amount, ['id' => 'tax_amount']); ?>

                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-md-8">
                        <div class="float-end"><b><?php echo app('translator')->get('stock_adjustment.total_amount'); ?>:</b> <span id="total_return"
                                class="display_currency"><?php echo e($purchase_return->final_total, false); ?></span></div>
                    </div>
                </div>
            </div>
        </div>
        <!--box end-->
        
        <?php echo Form::close(); ?>

    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/purchase_return.js?v=' . $asset_v), false); ?>"></script>
    <script type="text/javascript">
        __page_leave_confirmation('#purchase_return_form');
    </script>
<?php echo $__env->make('purchase_return.partials.purchase_return_keyboard_shortcuts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('purchase.partials.purchase_keyboard_shortcuts_help_modal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>