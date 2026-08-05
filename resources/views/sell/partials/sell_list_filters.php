<?php if(empty($only) || in_array('sell_list_filter_location_id', $only)): ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <?php echo Form::label('sell_list_filter_location_id',  __('purchase.business_location') . ':'); ?>


        <?php echo Form::select('sell_list_filter_location_id', $business_locations, request()->get('location_id'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); ?>

    </div>
</div>
<?php endif; ?>
<?php if(empty($only) || in_array('sell_list_filter_customer_id', $only)): ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <?php echo Form::label('sell_list_filter_customer_id',  __('contact.customer') . ':'); ?>

        <?php echo Form::select('sell_list_filter_customer_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

    </div>
</div>
<?php endif; ?>
<?php if(empty($only) || in_array('sell_list_filter_customer_group', $only)): ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <?php echo Form::label('sell_list_filter_customer_group_id', __( 'lang_v1.customer_group_name' ) . ':'); ?>

        <?php echo Form::select('sell_list_filter_customer_group_id', $customer_groups, null, ['class' => 'form-control select2',
        'style' => 'width:100%', 'id' => 'sell_list_filter_customer_group_id']); ?>

    </div>
</div>
<?php endif; ?>
<?php if(empty($only) || in_array('sell_list_filter_payment_status', $only)): ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <?php echo Form::label('sell_list_filter_payment_status',  __('purchase.payment_status') . ':'); ?>

        <?php echo Form::select('sell_list_filter_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue'), 'overpaid' => __('lang_v1.overpaid')], request()->get('payment_status'), ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

    </div>
</div>
<?php endif; ?>
<?php if(empty($only) || in_array('sell_list_filter_date_range', $only)): ?>
<?php
    $__date_settings = is_array($date_settings ?? null) ? $date_settings : [];
    $__date_setting_key = $date_range_setting_key ?? 'sale_filter_date_range';
    $__date_loc = array_key_first($__date_settings);
    $__sale_filter_date_range = $sale_filter_date_range_default ?? null;

    if (empty($__sale_filter_date_range)) {
        $__sale_filter_date_range = ! is_null($__date_loc) && is_array($__date_settings[$__date_loc] ?? null)
            ? ($__date_settings[$__date_loc][$__date_setting_key] ?? ($__date_settings[$__date_loc]['sale_filter_date_range'] ?? null))
            : ($__date_settings[$__date_setting_key] ?? ($__date_settings['sale_filter_date_range'] ?? null));
    }

    if (empty($__sale_filter_date_range)) {
        $__sale_filter_date_range = $date_range_setting_default ?? null;
    }
?>
<?php if(!empty($__sale_filter_date_range)): ?>
    <?php echo Form::hidden('sale_filter_date_range', $__sale_filter_date_range, ['id'=>'sale_filter_date_range']); ?>

<?php endif; ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <?php echo Form::label('sell_list_filter_date_range', __('report.date_range') . ':'); ?>

        <?php echo Form::text('sell_list_filter_date_range', '', ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

    </div>
</div>
<div class="col-md-3">
    <?php echo Form::label('sir_start_time', __('lang_v1.time_range') . ':'); ?>

    <div class="form-group mb-2">
        <?php echo Form::text('sell_list_filter_start_time', '00:00', ['style' => __('lang_v1.select_a_date_range'),
        'class' => 'form-control width-50 f-left', 'id' => 'sell_list_filter_start_time']); ?>

        <?php echo Form::text('sell_list_filter_end_time', '23:59', ['class' => 'form-control width-50 f-left', 'id'
        => 'sell_list_filter_end_time']); ?>

    </div>
</div>
<?php endif; ?>
<?php if((empty($only) || in_array('created_by', $only)) && !empty($sales_representative)): ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <?php echo Form::label('created_by',  __('report.user') . ':'); ?>

        <?php echo Form::select('created_by', $sales_representative, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

    </div>
</div>
<?php endif; ?>
<?php if(empty($only) || in_array('sales_cmsn_agnt', $only)): ?>
<?php if(!empty($is_cmsn_agent_enabled)): ?>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('sales_cmsn_agnt',  __('lang_v1.sales_commission_agent') . ':'); ?>

            <?php echo Form::select('sales_cmsn_agnt', $commission_agents, null, ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

        </div>
    </div>
<?php endif; ?>
<?php endif; ?>
<?php if(empty($only) || in_array('service_staffs', $only)): ?>
<?php if(!empty($service_staffs)): ?>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('service_staffs', __('restaurant.service_staff') . ':'); ?>

            <?php echo Form::select('service_staffs', $service_staffs, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

        </div>
    </div>
<?php endif; ?>
<?php endif; ?>
<?php if(!empty($shipping_statuses)): ?>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('shipping_status', __('lang_v1.shipping_status') . ':'); ?>

            <?php echo Form::select('shipping_status', $shipping_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

        </div>
    </div>
<?php endif; ?>
<?php if(!empty($tables)): ?>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('table_id', __('restaurant.tables') . ':'); ?>

            <?php echo Form::select('table_id', $tables, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

        </div>
    </div>
<?php endif; ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <?php echo Form::label('tax_type', ('Tax Type') . ':'); ?>

        <?php echo Form::select('tax_type', [ 'none' => __('lang_v1.none'), 'inclusive' => __('lang_v1.inclusive'), 'exclusive' => __('lang_v1.exclusive')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

    </div>
</div>
<?php if(empty($merge_station_with_source_filter)): ?>
    <div class="col-md-3">
        <div class="form-group mb-2">
            <?php echo Form::label('station_type', ('Station') . ':'); ?>

            <?php echo Form::select('station_type', $stations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

        </div>
    </div>
<?php else: ?>
    <?php
        $source_station_filter_options = [];

        if (!empty($sources)) {
            $source_station_filter_options[__('lang_v1.sources')] = $sources;
        }

        if (!empty($stations)) {
            $station_source_options = [];
            foreach ($stations as $station_value => $station_label) {
                $station_source_options['station:' . $station_value] = $station_label;
            }

            $source_station_filter_options['Station'] = $station_source_options;
        }
    ?>

    <?php if(!empty($source_station_filter_options)): ?>
        <div class="col-md-3">
            <div class="form-group mb-2">
                <?php echo Form::label('sell_list_filter_source', __('lang_v1.sources') . ':'); ?>

                <?php echo Form::select('sell_list_filter_source', $source_station_filter_options, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<?php if(!empty($currency_filter_options) && count($currency_filter_options) > 1): ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <?php echo Form::label('sell_list_filter_currency', __('business.currency') . ':'); ?>

        <?php echo Form::select('sell_list_filter_currency', $currency_filter_options, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); ?>

    </div>
</div>
<?php endif; ?>
<div class="clearfix"></div>
<?php if(empty($only) || in_array('only_subscriptions', $only)): ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <div class="form-check">
            <label>
                <br>
              <?php echo Form::checkbox('only_subscriptions', 1, false, 
              [ 'class' => 'form-check-input', 'id' => 'only_subscriptions']); ?> <?php echo e(__('lang_v1.subscriptions'), false); ?>

            </label>
        </div>
    </div>
</div>
<?php endif; ?>
<?php if(empty($only) || in_array('show_quotations', $only)): ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <div class="form-check">
            <label>
                <br>
              <?php echo Form::checkbox('show_quotations', 1, false, 
              [ 'class' => 'form-check-input', 'id' => 'show_quotations']); ?> <?php echo e(__('lang_v1.show_quotations'), false); ?>

            </label>
        </div>
    </div>
</div>
<?php endif; ?>
<div class="col-md-3">
    <div class="form-group mb-2">
        <div class="form-check">
            <label>
                <br>
              <?php echo Form::checkbox('only_takeaway', 1, false, 
              [ 'class' => 'form-check-input', 'id' => 'only_takeaway']); ?> 
              Only <?php echo e(!empty(json_decode(session('business.pos_settings'))->enable_takeaway_label) ? json_decode(session('business.pos_settings'))->enable_takeaway_label : 'Takeaway', false); ?>

            </label>
        </div>
    </div>
</div>
