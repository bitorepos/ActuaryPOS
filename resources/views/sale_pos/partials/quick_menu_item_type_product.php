    <div class="col-md-8">
        <div class="mb-0">
            <?php echo Form::label('search_product_item_modal', __('manufacturing::lang.choose_product').':', ['class'=>'form-label fw-semibold small mb-1']); ?>

            <select id="search_product_item_modal" name="search_product_item_modal" class="form-select" style="width:100%;">
                <option value="">Enter Product name or SKU</option>
            </select>
        </div>	
    </div>
    <div class="col-md-6">
        <div class="mb-0">
            <?php echo Form::label('name', __( 'business.quick_menu_name' ) . ':', ['class'=>'form-label fw-semibold small mb-1']); ?>

            <?php echo Form::text('name', !empty($item_data->name) ? $item_data->name : '', 
            ['class' => 'form-control', 'placeholder' => 'Item Name' , 'id'=>'item_name']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-0">
            <?php echo Form::label('price', 'Price:', ['class'=>'form-label fw-semibold small mb-1']); ?>

            <?php echo Form::text('price', !empty($item_data->price) ? $item_data->price : 0, 
            ['readonly'=> true, 'class' => 'form-control', 'id'=>'item_price']); ?>

        </div>
    </div>
    <div class="col-md-3">
        <div class="mb-0">
            <?php echo Form::label('quantity', 'Quantity:', ['class'=>'form-label fw-semibold small mb-1']); ?>

            <?php echo Form::number('quantity', !is_null($item_data->quantity) ? $item_data->quantity : 1, 
            ['class' => 'form-control', 'id'=>'item_quantity' ]); ?>

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
    <div class="col-md-auto">
        <div class="form-check mb-0 pt-1">
            <?php echo Form::checkbox('use_product_image', 1, false, ['class'=>'form-check-input', 'id'=>'use_product_image']); ?>

            <?php echo Form::label('use_product_image', 'Use Product Image', ['class'=>'form-check-label small']); ?>

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
            <?php echo Form::checkbox('settings[is_bold]', 1, ($item_data->settings->is_bold != null) ? true : false, ['class'=>'form-check-input', 'id'=>'settings_is_bold_item']); ?>

            <?php echo Form::label('settings[is_bold]', 'Is Bold', ['class'=>'form-check-label small', 'for'=>'settings_is_bold_item']); ?>

        </div>
    </div>
