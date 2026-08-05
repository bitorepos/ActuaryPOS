<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="form-check">
                    <br>
                    <label class="form-check-label">
                        <?php echo Form::checkbox('pos_settings[customer_display_screen]', 1, !empty($pos_settings['customer_display_screen']), ['class' => 'form-check-input']); ?> <?php echo e(__('lang_v1.enable_customer_display_screen'), false); ?>

                    </label>
                    <p class="help-block"><i> <?php echo app('translator')->get('lang_v1.customer_display_instraction'); ?></i></p>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <?php echo Form::label('display_screen_heading', __('lang_v1.display_screen_heading') . ':'); ?>

                <?php echo Form::textarea('pos_settings[display_screen_heading]', isset($pos_settings['display_screen_heading']) ? $pos_settings['display_screen_heading'] : null, ['class' => 'form-control', 'id' => 'display_screen_heading']); ?>

            </div>
        </div>
        <?php for($i = 1; $i <= 10; $i++): ?>
            <?php
                $__carousel_existing = $pos_settings['carousel_image_' . $i] ?? null;
                $__carousel_business_id = request()->session()->get('user.business_id');
                $__carousel_business_path = ! empty($__carousel_business_id) && ! empty($__carousel_existing)
                    ? 'uploads/' . config('constants.data_path') . $__carousel_business_id . '/carousel_images/' . $__carousel_existing
                    : null;
                $__carousel_legacy_path = ! empty($__carousel_existing)
                    ? 'uploads/carousel_images/' . $__carousel_existing
                    : null;
                $__carousel_url = ! empty($__carousel_business_path) && file_exists(public_path($__carousel_business_path))
                    ? url($__carousel_business_path)
                    : (! empty($__carousel_legacy_path) ? url($__carousel_legacy_path) : null);
            ?>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo Form::label("carousel_image_$i", __('lang_v1.carousel_image', ['number' => $i]) . ':'); ?>

                    <?php echo Form::file("carousel_image_$i", ['accept' => 'image/*', 'class' => 'carousel_image form-control']); ?>

                    <?php if(!empty($__carousel_existing)): ?>
                        <p class="help-block" style="margin-top:5px;">
                            <a href="<?php echo e($__carousel_url, false); ?>" target="_blank">
                                <i class="fa fa-image"></i> <?php echo e($__carousel_existing, false); ?>

                            </a>
                        </p>
                    <?php endif; ?>
                    <p class="help-block"><i> <?php echo app('translator')->get('lang_v1.image_help'); ?></i></p>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>
