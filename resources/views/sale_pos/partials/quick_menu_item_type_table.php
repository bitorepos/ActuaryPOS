    <div class="col-md-8">
        <div class="mb-0">
            <?php echo Form::label('table_id', 'Table:', ['class'=>'form-label fw-semibold small mb-1']); ?>

            <?php echo Form::select('table_id', $tables, !empty($item_data->item_type_id) ? $item_data->item_type_id : null , ['id'=>'table_id','class' => 'form-select', 'placeholder'=>'Please Select']); ?>

        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-0">
            <?php echo Form::label('name', 'Table Name:', ['class'=>'form-label fw-semibold small mb-1']); ?>

            <?php echo Form::text('name', !empty($item_data->name) ? $item_data->name : '', 
            ['class' => 'form-control', 'placeholder' => 'Table Name' , 'id'=>'item_name']); ?>

        </div>
    </div>

    <div class="col-12"><hr class="my-2" style="border-color:#e9ecef;"></div>

    <div class="col-md-5">
        <div class="mb-0">
            <?php echo Form::label('image', 'Image:', ['class'=>'form-label fw-semibold small mb-1']); ?>

            <?php echo Form::file('image', ['id' => 'upload_image', 'accept' => 'image/*', 'class' => 'form-control form-control-sm',]); ?>

        </div>
    </div>
    <div class="col-md-auto">
        <div class="mb-0">
            <div id="menu_item_image" style="height:60px;width:60px;border:1px solid #dee2e6;border-radius:6px;overflow:hidden;">
                <?php
                    $__business_id = session()->get('user.business_id');
                    $__data_path = config('constants.data_path');
                    $__image_url = null;
                    if (! empty($item_data->image)) {
                        $__paths = [
                            'uploads/' . $__data_path . $__business_id . '/quick_menu/' . $item_data->quick_menu_id . '/' . $item_data->image,
                            'uploads/' . $__business_id . '/quick_menu/' . $item_data->quick_menu_id . '/' . $item_data->image,
                            'uploads/quick_menu/' . $item_data->quick_menu_id . '/' . $item_data->image,
                            'uploads/' . $__data_path . $__business_id . '/img/' . $item_data->image,
                            'uploads/' . $__business_id . '/img/' . $item_data->image,
                            'uploads/img/' . $item_data->image,
                        ];
                        foreach (array_unique($__paths) as $__path) {
                            if (file_exists(public_path($__path))) {
                                $__image_url = asset($__path);
                                break;
                            }
                        }
                    }
                ?>
                <?php if(! empty($__image_url)): ?>
                    <img id="item_menu_image_view" src="<?php echo e($__image_url, false); ?>" style="width:100%;height:100%;object-fit:cover;">
                <?php else: ?>
                    <img id="item_menu_image_view" src="../img/default.png" style="width:100%;height:100%;object-fit:cover;">
                <?php endif; ?>
            </div>
            <?php echo Form::hidden('pre_image', !empty($item_data->image) ? $item_data->image : '', ['id' => 'pre_image']); ?>

        </div>
    </div>

    <div class="col-12"><hr class="my-2" style="border-color:#e9ecef;"></div>

    <div class="col-md-2">
        <div class="mb-0">
            <?php echo Form::label('settings[font_size]', 'Font Size:', ['class'=>'form-label fw-semibold small mb-1']); ?>

            <?php echo Form::number('settings[font_size]', !empty($item_data->settings->font_size) ? $item_data->settings->font_size : 14, ['class' => 'form-control' ]); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-0">
            <?php echo Form::label('settings[color]', 'Item Color:', ['class'=>'form-label fw-semibold small mb-1']); ?>

            <?php echo Form::color('settings[color]', !empty($item_data->settings->color) ? $item_data->settings->color : $item_color, ['class' => 'form-control form-control-color', 'style'=>'height:38px;']); ?>

        </div>
    </div>
    <div class="col-md-2">
        <div class="form-check mb-0 pt-1">
            <?php echo Form::checkbox('settings[is_bold]', 1, ($item_data->settings->is_bold != null) ? true : false, ['class'=>'form-check-input', 'id'=>'settings_is_bold_tbl']); ?>

            <?php echo Form::label('settings[is_bold]', 'Is Bold', ['class'=>'form-check-label small', 'for'=>'settings_is_bold_tbl']); ?>

        </div>
    </div>
    <div class="col-md-auto">
        <div class="form-check mb-0 pt-1">
            <?php echo Form::checkbox('settings[ask_guest_count]', 1, ($item_data->settings->ask_guest_count != null) ? true : false, ['class'=>'form-check-input', 'id'=>'settings_ask_guest']); ?>

            <?php echo Form::label('settings[ask_guest_count]', 'Ask No. of Guests', ['class'=>'form-check-label small', 'for'=>'settings_ask_guest']); ?>

        </div>
    </div>
    <div class="col-md-auto">
        <div class="form-check mb-0 pt-1">
            <?php echo Form::checkbox('settings[ask_token_no]', 1, ($item_data->settings->ask_token_no != null) ? true : false, ['class'=>'form-check-input', 'id'=>'settings_ask_token']); ?>

            <?php echo Form::label('settings[ask_token_no]', 'Ask '.$prompt_token_label, ['class'=>'form-check-label small', 'for'=>'settings_ask_token']); ?>

        </div>
    </div>
    <div class="col-md-auto">
        <div class="form-check mb-0 pt-1">
            <?php echo Form::checkbox('settings[restrict_on_security]', 1, ($item_data->settings->restrict_on_security != null) ? true : false, ['class'=>'form-check-input', 'id'=>'settings_restrict_security']); ?>

            <?php echo Form::label('settings[restrict_on_security]', 'Restrict On Security', ['class'=>'form-check-label small', 'for'=>'settings_restrict_security']); ?>

        </div>
    </div>
