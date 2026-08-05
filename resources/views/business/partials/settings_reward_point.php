<div class="pos-tab-content">
    <div class="row well">
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('enable_rp', 1, $business->enable_rp ,
                        [ 'class' => 'form-check-input', 'id' => 'enable_rp']); ?> <?php echo e(__( 'lang_v1.enable_rp' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('rp_name', __('lang_v1.rp_name') . ':'); ?>

                <?php echo Form::text('rp_name', $business->rp_name, ['class' => 'form-control','placeholder' =>
                __('lang_v1.rp_name')]); ?>

            </div>
        </div>

        <div class="clearfix"></div>
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.earning_points_setting'); ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('amount_for_unit_rp', __('lang_v1.amount_for_unit_rp') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.amount_for_unit_rp_tooltip') . '"></i>';
                }
            ?>
                <?php echo Form::text('amount_for_unit_rp', number_format($business->amount_for_unit_rp, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' =>
                'form-control input_number','placeholder' => __('lang_v1.amount_for_unit_rp')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('min_order_total_for_rp', __('lang_v1.min_order_total_for_rp') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.min_order_total_for_rp_tooltip') . '"></i>';
                }
            ?>
                <?php echo Form::text('min_order_total_for_rp', number_format($business->min_order_total_for_rp, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' =>
                'form-control input_number','placeholder' => __('lang_v1.min_order_total_for_rp')]); ?>

            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('max_rp_per_order', __('lang_v1.max_rp_per_order') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.max_rp_per_order_tooltip') . '"></i>';
                }
            ?>
                <?php echo Form::number('max_rp_per_order', $business->max_rp_per_order, ['class' =>
                'form-control','placeholder' => __('lang_v1.max_rp_per_order')]); ?>

            </div>
        </div>
    </div>
    <div class="row well">
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.redeem_points_setting'); ?>:</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('redeem_amount_per_unit_rp', __('lang_v1.redeem_amount_per_unit_rp') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.redeem_amount_per_unit_rp_tooltip') . '"></i>';
                }
            ?>
                <?php echo Form::text('redeem_amount_per_unit_rp', number_format($business->redeem_amount_per_unit_rp, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class'
                => 'form-control input_number','placeholder' => __('lang_v1.redeem_amount_per_unit_rp')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('min_order_total_for_redeem', __('lang_v1.min_order_total_for_redeem') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.min_order_total_for_redeem_tooltip') . '"></i>';
                }
            ?>
                <?php echo Form::text('min_order_total_for_redeem', number_format($business->min_order_total_for_redeem, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']),
                ['class' => 'form-control input_number','placeholder' => __('lang_v1.min_order_total_for_redeem')]); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('min_redeem_point', __('lang_v1.min_redeem_point') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.min_redeem_point_tooltip') . '"></i>';
                }
            ?>
                <?php echo Form::number('min_redeem_point', $business->min_redeem_point, ['class' =>
                'form-control','placeholder' => __('lang_v1.min_redeem_point')]); ?>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php echo Form::label('max_redeem_point', __('lang_v1.max_redeem_point') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.max_redeem_point_tooltip') . '"></i>';
                }
            ?>
                <?php echo Form::number('max_redeem_point', $business->max_redeem_point, ['class' => 'form-control',
                'placeholder' => __('lang_v1.max_redeem_point')]); ?>

            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group mb-3">
                <?php echo Form::label('rp_expiry_period', __('lang_v1.rp_expiry_period') . ':'); ?>

                <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.rp_expiry_period_tooltip') . '"></i>';
                }
            ?>
                <div class="input-group">
                    <?php echo Form::number('rp_expiry_period', $business->rp_expiry_period, ['class' =>
                    'form-control','placeholder' => __('lang_v1.rp_expiry_period')]); ?>

                    <span class="input-group-text">-</span>
                    <?php echo Form::select('rp_expiry_type', ['month' => __('lang_v1.month'), 'year' => __('lang_v1.year')],
                    $business->rp_expiry_type, ['class' => 'form-control form-select']); ?>

                </div>
            </div>
        </div>
    </div>
</div>
