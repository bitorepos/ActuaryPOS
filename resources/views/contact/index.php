
<?php $__env->startSection('title', __('lang_v1.'.$type.'s')); ?>
<?php
$api_key = env('GOOGLE_MAP_API_KEY');
$user_settings = json_decode(auth()->user()->user_settings, true);
?>
<?php if(!empty($api_key)): ?>
<?php $__env->startSection('css'); ?>
<?php echo $__env->make('contact.partials.google_map_styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php endif; ?>
<?php $__env->startSection('content'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1> <?php echo app('translator')->get('lang_v1.'.$type.'s'); ?>
        <small><?php echo app('translator')->get( 'contact.manage_your_contact', ['contacts' => __('lang_v1.'.$type.'s') ]); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
    
    <div class="clearfix"></div>
    <input type="hidden" id="business_location" value="">

    <div class="col-md-3 p-2 p-2" id="location_filter">
        <div class="mb-3">
            <?php echo Form::label('location_filter', __('purchase.business_location') . ':'); ?>

            <?php echo Form::select('location_filter', $business_locations, request()->get('location_filter', request()->get('location_id')), [
            'class' => 'form-control select2',
            'style' => 'width:100%',
            'id' => 'location_filter',
            ]); ?>

        </div>
    </div>
    <?php if(config('constants.enable_contact_assign') === true): ?>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <?php echo Form::label('assigned_to', __('lang_v1.assigned_to') . ':'); ?>

            <?php echo Form::select('assigned_to', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

        </div>
    </div>
    <?php endif; ?>

    <?php if($type == 'customer'): ?>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label for="cg_filter"><?php echo app('translator')->get('lang_v1.customer_group'); ?>:</label>
            <?php echo Form::select('cg_filter', $customer_groups, null, ['class' => 'form-control', 'id' => 'cg_filter']); ?>

        </div>
    </div>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label for="has_no_sell_from"><?php echo app('translator')->get('lang_v1.has_no_sell_from'); ?>:</label>
            <?php echo Form::select('has_no_sell_from', ['one_month' => __('lang_v1.one_month'), 'three_months' =>
            __('lang_v1.three_months'), 'six_months' => __('lang_v1.six_months'), 'one_year' => __('lang_v1.one_year')],
            null, ['class' => 'form-control', 'id' => 'has_no_sell_from', 'placeholder' =>
            __('messages.please_select')]); ?>

        </div>
    </div>


    <?php endif; ?>



    <div class="clearfix"></div>

    <div class="col-md-3 p-2" id='city_filter'>
        <div class="mb-3">
            <?php echo Form::label('city_filter', __('business.city') . ':'); ?>

            <?php echo Form::select('city_filter', $cities, null, [
            'class' => 'form-control select2',
            'style' => 'width:100%',
            'id' => 'city_filter',
            ]); ?>

        </div>
    </div>
    <div class="col-md-3 p-2" id='state_filter'>
        <div class="mb-3">
            <?php echo Form::label('state_filter', __('business.state') . ':'); ?>

            <?php echo Form::select('state_filter', $states, null, [
            'class' => 'form-control select2',
            'style' => 'width:100%',
            'id' => 'state_filter',
            ]); ?>

        </div>
    </div>
    <div class="col-md-3 p-2" id='country_filter'>
        <div class="mb-3">
            <?php echo Form::label('country_filter', __('business.country') . ':'); ?>

            <?php echo Form::select('country_filter', $countries, null, [
            'class' => 'form-control select2',
            'style' => 'width:100%',
            'id' => 'city_filter',
            ]); ?>

        </div>
    </div>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label for="status_filter"><?php echo app('translator')->get('sale.status'); ?>:</label>
            <?php echo Form::select('status_filter', ['active' => __('business.is_active'), 'inactive' =>
            __('lang_v1.inactive')], null, ['class' => 'form-control', 'id' => 'status_filter', 'placeholder' =>
            __('lang_v1.none')]); ?>

        </div>
    </div>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <?php echo Form::label('payment_type',  __('purchase.payment_status') . ':'); ?>

            <?php echo Form::select('payment_type', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], request()->get('payment_type'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

        </div>
    </div>
    <?php if(!empty($currency_dropdown) && empty($common_settings['hide_contact_default_currency'])): ?>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <?php echo Form::label('default_currency_filter', __('lang_v1.default_currency') . ':'); ?>

            <?php echo Form::select('default_currency_filter', $currency_dropdown, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'default_currency_filter', 'placeholder' => __('lang_v1.all')]); ?>

        </div>
    </div>
    <?php endif; ?>
    <?php if($type == 'customer'): ?>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label class="form-check-label">
<?php echo Form::checkbox('has_sell_due', 1, false, ['class' => 'form-check-input', 'id' => 'has_sell_due']); ?>

                <strong><?php echo app('translator')->get('lang_v1.sell_due'); ?></strong>
            </label>
        </div>
    </div>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label class="form-check-label">
<?php echo Form::checkbox('has_sell_return', 1, false, ['class' => 'form-check-input', 'id' => 'has_sell_return']); ?> <strong><?php echo app('translator')->get('lang_v1.sell_return'); ?></strong>
            </label>
        </div>
    </div>
    <?php elseif($type == 'supplier'): ?>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label class="form-check-label">
<?php echo Form::checkbox('has_purchase_due', 1, false, ['class' => 'form-check-input', 'id' =>
                'has_purchase_due']); ?> <strong><?php echo app('translator')->get('report.purchase_due'); ?></strong>
            </label>
        </div>
    </div>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label class="form-check-label">
<?php echo Form::checkbox('has_purchase_return', 1, false, ['class' => 'form-check-input', 'id' =>
                'has_purchase_return']); ?> <strong><?php echo app('translator')->get('lang_v1.purchase_return'); ?></strong>
            </label>
        </div>
    </div>
    <?php endif; ?>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label class="form-check-label">
<?php echo Form::checkbox('has_advance_balance', 1, false, ['class' => 'form-check-input', 'id' =>
                'has_advance_balance']); ?> <strong><?php echo app('translator')->get('lang_v1.advance_balance'); ?></strong>
            </label>
        </div>
    </div>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label class="form-check-label">
<?php echo Form::checkbox('has_opening_balance', 1, false, ['class' => 'form-check-input', 'id' =>
                'has_opening_balance']); ?> <strong><?php echo app('translator')->get('lang_v1.opening_balance'); ?></strong>
            </label>
        </div>
    </div>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label class="form-check-label">
<?php echo Form::checkbox('hide_zero_balance', 1, false, ['class' => 'form-check-input', 'id' =>
                'hide_zero_balance']); ?> <strong><?php echo app('translator')->get('lang_v1.hide_zero_balance'); ?></strong>
            </label>
        </div>
    </div>
    <?php if(session('business')->owner_id == auth()->user()->id): ?>
    <div class="col-md-3 p-2">
        <div class="mb-3">
            <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' =>
                'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
            </label>
        </div>
    </div>
    <?php endif; ?>

    
    <?php echo $__env->renderComponent(); ?>
    <input type="hidden" value="<?php echo e($type, false); ?>" id="contact_type">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'contact.all_your_contact', ['contacts' =>
    __('lang_v1.'.$type.'s') ])]); ?>
        <?php if((auth()->user()->can('supplier.create') || auth()->user()->can('customer.create') ||
        auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own')) && !$is_offline): ?>
        <?php $__env->slot('tool'); ?>
        <div class="box-tools">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view_export_buttons')): ?>
            <a class="btn btn-success pull-right margin-left-10"
                href="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'downloadExportExcel'], ['type' => $type]), false); ?>"><i
                    class="fa fa-download"></i> <?php echo app('translator')->get('lang_v1.download_excel'); ?></a>
            <?php endif; ?>
            <a class="btn btn-primary"
                href="<?php echo e(action([\App\Http\Controllers\ContactController::class, 'create'], ['type' => $type, 'full_page' => 1]), false); ?>">
                <i class="fa fa-plus"></i> <?php echo app('translator')->get('messages.add'); ?></a>
        </div>
        <?php $__env->endSlot(); ?>
        <?php endif; ?>
    <?php if(auth()->user()->can('supplier.view') || auth()->user()->can('customer.view') ||
    auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own')): ?>
    <div class="table-responsive" style="min-height: 80vh">
        <table class="table table-bordered table-striped table-hover table-th-skin" id="contact_table">
        <thead>
            <tr>
                <th><?php echo app('translator')->get('messages.action'); ?></th>
                <?php if($type == 'supplier'): ?>
                <?php if(empty($user_settings['contact_sup_hide_contact_id'])): ?>
                <th id='contact_id_col'><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('business.business_name'); ?></th>
                <th><?php echo app('translator')->get('contact.name'); ?></th>
                <?php if(empty($user_settings['contact_sup_hide_email'])): ?>
                <th id='contact_email_col'><?php echo app('translator')->get('business.email'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_sup_hide_mobile'])): ?>
                <th id='contact_mobile_col'><?php echo app('translator')->get('contact.mobile'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_sup_hide_address'])): ?>
                <th id='contact_address_col'><?php echo app('translator')->get('business.address'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_sup_hide_tax_number'])): ?>
                <th id='contact_tax_number_col'><?php echo app('translator')->get('contact.tax_no'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_sup_hide_opening_balance'])): ?>
                <th id='contact_ob_col'><?php echo app('translator')->get('account.opening_balance'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_sup_hide_advance_balance'])): ?>
                <th id='contact_advance_balance_col'><?php echo app('translator')->get('lang_v1.advance_balance'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_sup_hide_ledger_discount'])): ?>
                <th id='contact_ledger_discount_col'><?php echo app('translator')->get('lang_v1.ledger_discount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_sup_hide_total_purchase_due'])): ?>
                <th id='contact_due_col'><?php echo app('translator')->get('contact.total_purchase_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_sup_hide_total_purchase_return_due'])): ?>
                <th id='contact_return_due_col'><?php echo app('translator')->get('lang_v1.total_purchase_return_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('lang_v1.net_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('contact.pay_term'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php elseif( $type == 'customer'): ?>
                <?php if(empty($user_settings['contact_cus_hide_contact_id'])): ?>
                <th id='contact_id_col'><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('business.business_name'); ?></th>
                <th><?php echo app('translator')->get('user.name'); ?></th>
                <?php if(empty($user_settings['contact_cus_hide_email'])): ?>
                <th id='contact_email_col'><?php echo app('translator')->get('business.email'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_cus_hide_mobile'])): ?>
                <th id='contact_mobile_col'><?php echo app('translator')->get('contact.mobile'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_cus_hide_address'])): ?>
                <th id='contact_address_col'><?php echo app('translator')->get('business.address'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_cus_hide_tax_number'])): ?>
                <th id='contact_tax_number_col'><?php echo app('translator')->get('contact.tax_no'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_cus_hide_opening_balance'])): ?>
                <th id='contact_ob_col'><?php echo app('translator')->get('account.opening_balance'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_cus_hide_advance_balance'])): ?>
                <th id='contact_advance_balance_col'><?php echo app('translator')->get('lang_v1.advance_balance'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_cus_hide_ledger_discount'])): ?>
                <th id='contact_ledger_discount_col'><?php echo app('translator')->get('lang_v1.ledger_discount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_cus_hide_total_sale_due'])): ?>
                <th id='contact_due_col'><?php echo app('translator')->get('contact.total_sale_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_cus_hide_total_sell_return_due'])): ?>
                <th id='contact_return_due_col'><?php echo app('translator')->get('lang_v1.total_sell_return_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('lang_v1.net_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('contact.pay_term'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('lang_v1.credit_limit'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php if($reward_enabled): ?>
                <th id="rp_col"><?php echo e(session('business.rp_name'), false); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('lang_v1.customer_group'); ?></th>
                <?php elseif( $type == 'both'): ?>
                <?php if(empty($user_settings['contact_bar_hide_contact_id'])): ?>
                <th id='contact_id_col'><?php echo app('translator')->get('lang_v1.contact_id'); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('business.business_name'); ?></th>
                <th><?php echo app('translator')->get('user.name'); ?></th>
                <?php if(empty($user_settings['contact_bar_hide_email'])): ?>
                <th id='contact_email_col'><?php echo app('translator')->get('business.email'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_bar_hide_mobile'])): ?>
                <th id='contact_mobile_col'><?php echo app('translator')->get('contact.mobile'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_bar_hide_address'])): ?>
                <th id='contact_address_col'><?php echo app('translator')->get('business.address'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_bar_hide_tax_number'])): ?>
                <th id='contact_tax_number_col'><?php echo app('translator')->get('contact.tax_no'); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_bar_hide_opening_balance'])): ?>
                <th id='contact_ob_col'><?php echo app('translator')->get('account.opening_balance'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_bar_hide_advance_balance'])): ?>
                <th id='contact_advance_balance_col'><?php echo app('translator')->get('lang_v1.advance_balance'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_bar_hide_ledger_discount'])): ?>
                <th id='contact_ledger_discount_col'><?php echo app('translator')->get('lang_v1.ledger_discount'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_bar_hide_total_invoice_due'])): ?>
                <th id='contact_due_col'><?php echo app('translator')->get('contact.total_invoice_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <?php if(empty($user_settings['contact_bar_hide_total_invoice_return_due'])): ?>
                <th id='contact_return_due_col'><?php echo app('translator')->get('contact.total_invoice_return_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('lang_v1.net_due'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('contact.pay_term'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <th><?php echo app('translator')->get('lang_v1.credit_limit'); ?> <?php echo e('('.session("currency")["symbol"].')', false); ?></th>
                <?php if($reward_enabled): ?>
                <th id="rp_col"><?php echo e(session('business.rp_name'), false); ?></th>
                <?php endif; ?>
                <th><?php echo app('translator')->get('lang_v1.customer_group'); ?></th>
                <?php endif; ?>
                <?php
                $custom_labels = json_decode(session('business.custom_labels'), true);
                ?>
                <?php if(!empty($custom_labels['contact']['custom_field_1'])): ?>
                <th class="contact_custom_field1">
                    <?php echo e($custom_labels['contact']['custom_field_1'], false); ?>

                </th>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_2'])): ?>
                <th class="contact_custom_field2">
                    <?php echo e($custom_labels['contact']['custom_field_2'], false); ?>

                </th>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_3'])): ?>
                <th class="contact_custom_field3">
                    <?php echo e($custom_labels['contact']['custom_field_3'], false); ?>

                </th>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_4'])): ?>
                <th class="contact_custom_field4">
                    <?php echo e($custom_labels['contact']['custom_field_4'], false); ?>

                </th>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_5'])): ?>
                <th class="contact_custom_field5">
                    <?php echo e($custom_labels['contact']['custom_field_5'], false); ?>

                </th>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_6'])): ?>
                <th class="contact_custom_field6">
                    <?php echo e($custom_labels['contact']['custom_field_6'], false); ?>

                </th>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_7'])): ?>
                <th class="contact_custom_field7">
                    <?php echo e($custom_labels['contact']['custom_field_7'], false); ?>

                </th>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_8'])): ?>
                <th class="contact_custom_field8">
                    <?php echo e($custom_labels['contact']['custom_field_8'], false); ?>

                </th>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_9'])): ?>
                <th class="contact_custom_field9">
                    <?php echo e($custom_labels['contact']['custom_field_9'], false); ?>

                </th>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_10'])): ?>
                <th class="contact_custom_field10">
                    <?php echo e($custom_labels['contact']['custom_field_10'], false); ?>

                </th>
                <?php endif; ?>
                <th>Business Locations</th>
                <th><?php echo app('translator')->get('lang_v1.added_on'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 text-center footer-total">

                <?php if($type=='supplier'): ?>
                <td></td>
                    <?php if(empty($user_settings['contact_sup_hide_contact_id'])): ?>
                    <td></td>
                    <?php endif; ?>
                <td></td>
                <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                    <?php if(empty($user_settings['contact_sup_hide_email'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_sup_hide_mobile'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_sup_hide_address'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_sup_hide_tax_number'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_sup_hide_opening_balance'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_sup_hide_advance_balance'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_sup_hide_ledger_discount'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_sup_hide_total_purchase_due'])): ?>
                    <td class="footer_contact_due"></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_sup_hide_total_purchase_return_due'])): ?>
                    <td class="footer_contact_return_due"></td>
                    <?php endif; ?>
                <td class="footer_contact_net_due"></td>
                <td></td>
                <?php endif; ?>

                <?php if($type=='customer'): ?>
                <td></td>
                    <?php if(empty($user_settings['contact_cus_hide_contact_id'])): ?>
                    <td></td>
                    <?php endif; ?>
                <td></td>
                <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                    <?php if(empty($user_settings['contact_cus_hide_email'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_cus_hide_mobile'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_cus_hide_address'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_cus_hide_tax_number'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_cus_hide_opening_balance'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_cus_hide_advance_balance'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_cus_hide_ledger_discount'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_cus_hide_total_sale_due'])): ?>
                    <td class="footer_contact_due"></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_cus_hide_total_sell_return_due'])): ?>
                    <td class="footer_contact_return_due"></td>
                    <?php endif; ?>
                <td class="footer_contact_net_due"></td>
                <td></td>
                <td></td>
                    <?php if($reward_enabled): ?>
                    <td></td>
                    <?php endif; ?>
                <td></td>
                <?php endif; ?>

                <?php if($type=='both'): ?>
                <td></td>
                    <?php if(empty($user_settings['contact_bar_hide_contact_id'])): ?>
                    <td></td>
                    <?php endif; ?>
                <td></td>
                <td><strong><?php echo app('translator')->get('sale.total'); ?>:</strong></td>
                    <?php if(empty($user_settings['contact_bar_hide_email'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_bar_hide_mobile'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_bar_hide_address'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_bar_hide_tax_number'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_bar_hide_opening_balance'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_bar_hide_advance_balance'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_bar_hide_ledger_discount'])): ?>
                    <td></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_bar_hide_total_invoice_due'])): ?>
                    <td class="footer_contact_due"></td>
                    <?php endif; ?>
                    <?php if(empty($user_settings['contact_bar_hide_total_invoice_return_due'])): ?>
                    <td class="footer_contact_return_due"></td>
                    <?php endif; ?>
                <td class="footer_contact_net_due"></td>
                <td></td>
                <td></td>
                    <?php if($reward_enabled): ?>
                    <td></td>
                    <?php endif; ?>
                <td></td>
                <?php endif; ?>

                
                <?php if(!empty($custom_labels['contact']['custom_field_1'])): ?>
                <td></td>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_2'])): ?>
                <td></td>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_3'])): ?>
                <td></td>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_4'])): ?>
                <td></td>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_5'])): ?>
                <td></td>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_6'])): ?>
                <td></td>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_7'])): ?>
                <td></td>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_8'])): ?>
                <td></td>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_9'])): ?>
                <td></td>
                <?php endif; ?>
                <?php if(!empty($custom_labels['contact']['custom_field_10'])): ?>
                <td></td>
                <?php endif; ?>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
</div>
    <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade contact_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php if(!empty($api_key)): ?>
<script>
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
function initAutocomplete() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {
            lat: -33.8688,
            lng: 151.2195
        },
        zoom: 10,
        mapTypeId: 'roadmap'
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            map.setCenter(initialLocation);
        });
    }


    // Create the search box and link it to the UI element.
    var input = document.getElementById('shipping_address');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function(marker) {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
            }));

            //set position field value
            var lat_long = [place.geometry.location.lat(), place.geometry.location.lng()]
            $('#position').val(lat_long);

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($api_key, false); ?>&libraries=places" async defer></script>
<script type="text/javascript">
$(document).on('shown.bs.modal', '.contact_modal', function(e) {
    initAutocomplete();
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>