<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.stock_transfer'); ?>:</h4>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[hide_stock_transfer_stock_type_category]', 1,
                            !empty($common_settings['hide_stock_transfer_stock_type_category']) ? true : false,
                            ['class' => 'form-check-input']); ?>

                        Hide Stock Type & Select Category
                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[hide_stock_transfer_demand_order]', 1,
                            !empty($common_settings['hide_stock_transfer_demand_order']) ? true : false,
                            ['class' => 'form-check-input']); ?>

                        Hide Demand Order
                    </label>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <label class="form-check-label">
                        <?php echo Form::checkbox('common_settings[hide_stock_transfer_production]', 1,
                            !empty($common_settings['hide_stock_transfer_production']) ? true : false,
                            ['class' => 'form-check-input']); ?>

                        Hide Production (Manufacturing)
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
