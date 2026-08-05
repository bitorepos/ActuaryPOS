<div class="pos-tab-content">
     <div class="row">
        
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <?php
                    $page_entries = [25 => 25, 50 => 50, 100 => 100, 200 => 200, 500 => 500, 1000 => 1000, -1 => __('lang_v1.all')];
                ?>
                <?php echo Form::label('default_datatable_page_entries', __('lang_v1.default_datatable_page_entries')); ?>

                <?php echo Form::select('common_settings[default_datatable_page_entries]', $page_entries, !empty($common_settings['default_datatable_page_entries']) ? $common_settings['default_datatable_page_entries'] : 25 , 
                    ['class' => 'form-control select2', 'style' => 'width: 100%;', 'id' => 'default_datatable_page_entries']); ?>

            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <br>
                  <label class="form-check-label">
<?php echo Form::checkbox('enable_tooltip', 1, $business->enable_tooltip , 
                    [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'business.show_help_text' ), false); ?>

                  </label>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group mb-3">
                <div class="form-check">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('common_settings[enable_urdu_typing]', 1,
                        !empty($common_settings['enable_urdu_typing']) ? true : false,
                        [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.enable_urdu_typing' ), false); ?>

                    </label>
                </div>
            </div>
        </div>
        
    </div>
</div>
