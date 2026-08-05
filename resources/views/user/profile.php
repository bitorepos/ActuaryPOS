
<?php $__env->startSection('title', __('lang_v1.my_profile')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.my_profile'); ?></h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
<?php echo Form::open(['url' => action([\App\Http\Controllers\UserController::class, 'updatePassword']), 'method' => 'post', 'id' => 'edit_password_form',
            'class' => 'form-horizontal' ]); ?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary"> <!--business info box start-->
            <div class="box-header">
                <div class="box-header">
                    <h3 class="box-title"> <?php echo app('translator')->get('user.change_password'); ?></h3>
                </div>
            </div>
            <div class="box-body">
                <div class="form-group mb-2">
                    <?php echo Form::label('current_password', __('user.current_password') . ':', ['class' => 'col-sm-3 control-label']); ?>

                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                            <?php echo Form::password('current_password', ['class' => 'form-control','placeholder' => __('user.current_password'), 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <?php echo Form::label('new_password', __('user.new_password') . ':', ['class' => 'col-sm-3 control-label']); ?>

                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                            <?php echo Form::password('new_password', ['class' => 'form-control','placeholder' => __('user.new_password'), 'required']); ?>

                        </div>
                    </div>
                </div>
                <div class="form-group mb-2">
                    <?php echo Form::label('confirm_password', __('user.confirm_new_password') . ':', ['class' => 'col-sm-3 control-label']); ?>

                    <div class="col-sm-9">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </span>
                            <?php echo Form::password('confirm_password', ['class' => 'form-control','placeholder' =>  __('user.confirm_new_password'), 'required']); ?>

                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get('messages.update'); ?></button>
            </div>
        </div>
    </div>
</div>
<?php echo Form::close(); ?>

<?php echo Form::open(['url' => action([\App\Http\Controllers\UserController::class, 'updateProfile']), 'method' => 'post', 'id' => 'edit_user_profile_form', 'files' => true ]); ?>

<div class="row">
    <div class="col-sm-8">
        <div class="box box-primary"> <!--business info box start-->
            <div class="box-header">
                <div class="box-header">
                    <h3 class="box-title"> <?php echo app('translator')->get('user.edit_profile'); ?></h3>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                <div class="form-group mb-2 col-md-2">
                    <?php echo Form::label('surname', __('business.prefix') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-info"></i>
                        </span>
                        <?php echo Form::text('surname', $user->surname, ['class' => 'form-control','placeholder' => __('business.prefix_placeholder')]); ?>

                    </div>
                </div>
                <div class="form-group mb-2 col-md-5">
                    <?php echo Form::label('first_name', __('business.first_name') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-info"></i>
                        </span>
                        <?php echo Form::text('first_name', $user->first_name, ['class' => 'form-control','placeholder' => __('business.first_name'), 'required']); ?>

                    </div>
                </div>
                <div class="form-group mb-2 col-md-5">
                    <?php echo Form::label('last_name', __('business.last_name') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-info"></i>
                        </span>
                        <?php echo Form::text('last_name', $user->last_name, ['class' => 'form-control','placeholder' => __('business.last_name')]); ?>

                    </div>
                </div>
                <div class="form-group mb-2 col-md-6">
                    <?php echo Form::label('email', __('business.email') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-info"></i>
                        </span>
                        <?php echo Form::email('email',  $user->email, ['class' => 'form-control','placeholder' => __('business.email') ]); ?>

                    </div>
                </div>
                <div class="form-group mb-2 col-md-6">
                    <?php echo Form::label('language', __('business.language') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-info"></i>
                        </span>
                        <?php echo Form::select('language',$languages, $user->language, ['class' => 'form-control select2']); ?>

                    </div>
                </div>
                <div class="form-group mb-2 col-md-6">
                    <?php echo Form::label('font_style', __('lang_v1.font_style') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-font"></i>
                        </span>
                        <?php
                            $current_font = null;
                            if (!empty($user->user_settings)) {
                                $settings = is_string($user->user_settings) ? json_decode($user->user_settings, true) : $user->user_settings;
                                $current_font = $settings['font_style'] ?? null;
                            }
                        ?>
                        <?php echo Form::select('font_style', $font_styles, $current_font, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
                <div class="form-group mb-2 col-md-6">
                    <?php echo Form::label('theme_color', __('lang_v1.theme_color') . ':'); ?>

                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fa fa-paint-brush"></i>
                        </span>
                        <?php
                            $current_theme = null;
                            if (!empty($user->user_settings)) {
                                $settings = is_string($user->user_settings) ? json_decode($user->user_settings, true) : $user->user_settings;
                                $current_theme = $settings['theme_color'] ?? null;
                            }
                        ?>
                        <?php echo Form::select('theme_color', $theme_colors, $current_theme, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'style' => 'width: 100%;']); ?>

                    </div>
                </div>
                </div><!-- /.row -->
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <?php $__env->startComponent('components.widget', ['title' => __('lang_v1.profile_photo')]); ?>
            <?php if(!empty($user->media)): ?>
                <div class="col-md-12 text-center">
                    <?php echo $user->media->thumbnail([150, 150], 'img-circle'); ?>

                </div>
            <?php endif; ?>
            <div class="col-md-12">
                <div class="form-group mb-2">
                    <?php echo Form::label('profile_photo', __('lang_v1.upload_image') . ':'); ?>

                    <i class="fas fa-info-circle text-muted" data-bs-toggle="tooltip" data-bs-html="true" title="<?php echo app('translator')->get('purchase.max_file_size', ['size' => config('constants.document_size_limit') / 1000000]); ?>"></i>
                    <?php echo Form::file('profile_photo', ['id' => 'profile_photo', 'accept' => 'image/*']); ?>

                </div>
            </div>
        <?php echo $__env->renderComponent(); ?>
    </div>
</div>
<?php echo $__env->make('user.edit_profile_form_part', ['bank_details' => !empty($user->bank_details) ? json_decode($user->bank_details, true) : null], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="row" id="user-email-settings-section">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header d-flex justify-content-between align-items-center">
                <h3 class="box-title"><i class="fas fa-envelope me-2"></i><?php echo app('translator')->get('lang_v1.email_settings'); ?></h3>
                <button type="button" class="btn btn-sm btn-success" id="test_user_email_btn">
                    <i class="fas fa-paper-plane me-1"></i><?php echo app('translator')->get('lang_v1.test_email_configuration'); ?>
                </button>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('mail_driver', __('lang_v1.mail_driver') . ':'); ?>

                            <?php echo Form::select('email_settings[mail_driver]', $mail_drivers, !empty($email_settings['mail_driver']) ? $email_settings['mail_driver'] : 'smtp', ['class' => 'form-control', 'id' => 'mail_driver']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('mail_host', __('lang_v1.mail_host') . ':'); ?>

                            <?php echo Form::text('email_settings[mail_host]', $email_settings['mail_host'] ?? '', ['class' => 'form-control', 'placeholder' => __('lang_v1.mail_host'), 'id' => 'mail_host']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('mail_port', __('lang_v1.mail_port') . ':'); ?>

                            <?php echo Form::text('email_settings[mail_port]', $email_settings['mail_port'] ?? '', ['class' => 'form-control', 'placeholder' => __('lang_v1.mail_port'), 'id' => 'mail_port']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('mail_username', __('lang_v1.mail_username') . ':'); ?>

                            <?php echo Form::text('email_settings[mail_username]', $email_settings['mail_username'] ?? '', ['class' => 'form-control', 'placeholder' => __('lang_v1.mail_username'), 'id' => 'mail_username']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('mail_password', __('lang_v1.mail_password') . ':'); ?>

                            <input type="password" name="email_settings[mail_password]" value="<?php echo e($email_settings['mail_password'] ?? '', false); ?>" class="form-control" placeholder="<?php echo e(__('lang_v1.mail_password'), false); ?>" id="mail_password" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('mail_encryption', __('lang_v1.mail_encryption') . ':'); ?>

                            <?php echo Form::text('email_settings[mail_encryption]', $email_settings['mail_encryption'] ?? '', ['class' => 'form-control', 'placeholder' => __('lang_v1.mail_encryption_place'), 'id' => 'mail_encryption']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('mail_from_address', __('lang_v1.mail_from_address') . ':'); ?>

                            <?php echo Form::email('email_settings[mail_from_address]', $email_settings['mail_from_address'] ?? '', ['class' => 'form-control', 'placeholder' => __('lang_v1.mail_from_address'), 'id' => 'mail_from_address']); ?>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group mb-3">
                            <?php echo Form::label('mail_from_name', __('lang_v1.mail_from_name') . ':'); ?>

                            <?php echo Form::text('email_settings[mail_from_name]', $email_settings['mail_from_name'] ?? '', ['class' => 'form-control', 'placeholder' => __('lang_v1.mail_from_name'), 'id' => 'mail_from_name']); ?>

                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-check">
                            <label class="form-check-label">
                                <?php echo Form::checkbox('email_settings[mail_verify_peer]', 1, !array_key_exists('mail_verify_peer', $email_settings) || !empty($email_settings['mail_verify_peer']), ['class' => 'form-check-input', 'id' => 'mail_verify_peer']); ?>

                                <?php echo e(__('lang_v1.verify_smtp_certificate'), false); ?>

                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header d-flex justify-content-between align-items-center">
                <h3 class="box-title"><i class="fas fa-columns me-2"></i>Indexes Column Visibility</h3>
                <button type="button" class="btn btn-sm btn-danger" id="resetAllIndexVisibility"><i class="fas fa-undo me-1"></i>Reset All</button>
            </div>
            <div class="box-body">
                
                <ul class="nav nav-tabs mb-3" id="colVisibilityTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="cv-merchants-tab" data-bs-toggle="tab" data-bs-target="#cv-merchants" type="button" role="tab" aria-controls="cv-merchants" aria-selected="true">
                            <i class="fas fa-store me-1"></i> Merchants
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cv-pos-tab" data-bs-toggle="tab" data-bs-target="#cv-pos" type="button" role="tab" aria-controls="cv-pos" aria-selected="false">
                            <i class="fas fa-cash-register me-1"></i> POS
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cv-sales-tab" data-bs-toggle="tab" data-bs-target="#cv-sales" type="button" role="tab" aria-controls="cv-sales" aria-selected="false">
                            <i class="fas fa-chart-line me-1"></i> Sales
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cv-products-tab" data-bs-toggle="tab" data-bs-target="#cv-products" type="button" role="tab" aria-controls="cv-products" aria-selected="false">
                            <i class="fas fa-boxes me-1"></i> Products
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cv-purchase-tab" data-bs-toggle="tab" data-bs-target="#cv-purchase" type="button" role="tab" aria-controls="cv-purchase" aria-selected="false">
                            <i class="fas fa-shopping-cart me-1"></i> Purchase
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cv-expense-tab" data-bs-toggle="tab" data-bs-target="#cv-expense" type="button" role="tab" aria-controls="cv-expense" aria-selected="false">
                            <i class="fas fa-money-bill-wave me-1"></i> Expense
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cv-stock-adjustment-tab" data-bs-toggle="tab" data-bs-target="#cv-stock-adjustment" type="button" role="tab" aria-controls="cv-stock-adjustment" aria-selected="false">
                            <i class="fas fa-sliders-h me-1"></i> Stock Adjustment
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="cv-stock-transfers-tab" data-bs-toggle="tab" data-bs-target="#cv-stock-transfers" type="button" role="tab" aria-controls="cv-stock-transfers" aria-selected="false">
                            <i class="fas fa-exchange-alt me-1"></i> Stock Transfers
                        </button>
                    </li>
                </ul>

                
                <div class="tab-content" id="colVisibilityTabContent">
                    <div class="tab-pane fade show active" id="cv-merchants" role="tabpanel" aria-labelledby="cv-merchants-tab">
                        <div class="row">
                            <div class="col-md-3"><h4>Supplier</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_contact_id]', 1, !empty($user->user_settings['contact_sup_hide_contact_id']), ['class' => 'form-check-input']); ?> Hide Contact ID
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_email]', 1, !empty($user->user_settings['contact_sup_hide_email']), ['class' => 'form-check-input']); ?> Hide Email
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_mobile]', 1, !empty($user->user_settings['contact_sup_hide_mobile']), ['class' => 'form-check-input']); ?> Hide Mobile
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_address]', 1, !empty($user->user_settings['contact_sup_hide_address']), ['class' => 'form-check-input']); ?> Hide Address
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_tax_number]', 1, !empty($user->user_settings['contact_sup_hide_tax_number']), ['class' => 'form-check-input']); ?> Hide Tax Number
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_opening_balance]', 1, !empty($user->user_settings['contact_sup_hide_opening_balance']), ['class' => 'form-check-input']); ?> Hide Opening Balance
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_advance_balance]', 1, !empty($user->user_settings['contact_sup_hide_advance_balance']), ['class' => 'form-check-input']); ?> Hide Advance Balance
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_ledger_discount]', 1, !empty($user->user_settings['contact_sup_hide_ledger_discount']), ['class' => 'form-check-input']); ?> Hide Ledger Discount
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_total_purchase_due]', 1, !empty($user->user_settings['contact_sup_hide_total_purchase_due']), ['class' => 'form-check-input']); ?> Hide Total Purchase Due
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_sup_hide_total_purchase_return_due]', 1, !empty($user->user_settings['contact_sup_hide_total_purchase_return_due']), ['class' => 'form-check-input']); ?> Hide Total Purchase Return Due
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"><h4>Customer</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_contact_id]', 1, !empty($user->user_settings['contact_cus_hide_contact_id']), ['class' => 'form-check-input']); ?> Hide Contact ID
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_email]', 1, !empty($user->user_settings['contact_cus_hide_email']), ['class' => 'form-check-input']); ?> Hide Email
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_mobile]', 1, !empty($user->user_settings['contact_cus_hide_mobile']), ['class' => 'form-check-input']); ?> Hide Mobile
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_address]', 1, !empty($user->user_settings['contact_cus_hide_address']), ['class' => 'form-check-input']); ?> Hide Address
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_tax_number]', 1, !empty($user->user_settings['contact_cus_hide_tax_number']), ['class' => 'form-check-input']); ?> Hide Tax Number
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_opening_balance]', 1, !empty($user->user_settings['contact_cus_hide_opening_balance']), ['class' => 'form-check-input']); ?> Hide Opening Balance
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_advance_balance]', 1, !empty($user->user_settings['contact_cus_hide_advance_balance']), ['class' => 'form-check-input']); ?> Hide Advance Balance
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_ledger_discount]', 1, !empty($user->user_settings['contact_cus_hide_ledger_discount']), ['class' => 'form-check-input']); ?> Hide Ledger Discount
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_total_sale_due]', 1, !empty($user->user_settings['contact_cus_hide_total_sale_due']), ['class' => 'form-check-input']); ?> Hide Total Sale Due
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_cus_hide_total_sell_return_due]', 1, !empty($user->user_settings['contact_cus_hide_total_sell_return_due']), ['class' => 'form-check-input']); ?> Hide Total Sell Return Due
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3"><h4>Barterer</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_contact_id]', 1, !empty($user->user_settings['contact_bar_hide_contact_id']), ['class' => 'form-check-input']); ?> Hide Contact ID
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_email]', 1, !empty($user->user_settings['contact_bar_hide_email']), ['class' => 'form-check-input']); ?> Hide Email
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_mobile]', 1, !empty($user->user_settings['contact_bar_hide_mobile']), ['class' => 'form-check-input']); ?> Hide Mobile
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_address]', 1, !empty($user->user_settings['contact_bar_hide_address']), ['class' => 'form-check-input']); ?> Hide Address
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_tax_number]', 1, !empty($user->user_settings['contact_bar_hide_tax_number']), ['class' => 'form-check-input']); ?> Hide Tax Number
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_opening_balance]', 1, !empty($user->user_settings['contact_bar_hide_opening_balance']), ['class' => 'form-check-input']); ?> Hide Opening Balance
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_advance_balance]', 1, !empty($user->user_settings['contact_bar_hide_advance_balance']), ['class' => 'form-check-input']); ?> Hide Advance Balance
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_ledger_discount]', 1, !empty($user->user_settings['contact_bar_hide_ledger_discount']), ['class' => 'form-check-input']); ?> Hide Ledger Discount
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_total_invoice_due]', 1, !empty($user->user_settings['contact_bar_hide_total_invoice_due']), ['class' => 'form-check-input']); ?> Hide Total Invoice Due
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[contact_bar_hide_total_invoice_return_due]', 1, !empty($user->user_settings['contact_bar_hide_total_invoice_return_due']), ['class' => 'form-check-input']); ?> Hide Total Invoice Return Due
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cv-pos" role="tabpanel" aria-labelledby="cv-pos-tab">
                        <div class="row">
                            <div class="col-md-12"><h4>POS Index Column Visibility</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_invoice_no]', 1, !empty($user->user_settings['pos_index_hide_invoice_no']), ['class' => 'form-check-input']); ?> Hide Invoice No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_ref_no]', 1, !empty($user->user_settings['pos_index_hide_ref_no']), ['class' => 'form-check-input']); ?> Hide Ref No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_customer_name]', 1, !empty($user->user_settings['pos_index_hide_customer_name']), ['class' => 'form-check-input']); ?> Hide Customer Name
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_contact_no]', 1, !empty($user->user_settings['pos_index_hide_contact_no']), ['class' => 'form-check-input']); ?> Hide Contact No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_payment_status]', 1, !empty($user->user_settings['pos_index_hide_payment_status']), ['class' => 'form-check-input']); ?> Hide Payment Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_payment_method]', 1, !empty($user->user_settings['pos_index_hide_payment_method']), ['class' => 'form-check-input']); ?> Hide Payment Method
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_total_amount]', 1, !empty($user->user_settings['pos_index_hide_total_amount']), ['class' => 'form-check-input']); ?> Hide Total Amount
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_total_paid]', 1, !empty($user->user_settings['pos_index_hide_total_paid']), ['class' => 'form-check-input']); ?> Hide Total Paid
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_sell_due]', 1, !empty($user->user_settings['pos_index_hide_sell_due']), ['class' => 'form-check-input']); ?> Hide Sell Due
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_sell_return_due]', 1, !empty($user->user_settings['pos_index_hide_sell_return_due']), ['class' => 'form-check-input']); ?> Hide Sell Return Due
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_shipping_details]', 1, !empty($user->user_settings['pos_index_hide_shipping_details']), ['class' => 'form-check-input']); ?> Hide Shipping Details
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_shipping_status]', 1, !empty($user->user_settings['pos_index_hide_shipping_status']), ['class' => 'form-check-input']); ?> Hide Shipping Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_total_items]', 1, !empty($user->user_settings['pos_index_hide_total_items']), ['class' => 'form-check-input']); ?> Hide Total Items
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_types_of_service]', 1, !empty($user->user_settings['pos_index_hide_types_of_service']), ['class' => 'form-check-input']); ?> Hide Types of Service
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_sell_note]', 1, !empty($user->user_settings['pos_index_hide_sell_note']), ['class' => 'form-check-input']); ?> Hide Sell Note
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_staff_note]', 1, !empty($user->user_settings['pos_index_hide_staff_note']), ['class' => 'form-check-input']); ?> Hide Staff Note
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_table]', 1, !empty($user->user_settings['pos_index_hide_table']), ['class' => 'form-check-input']); ?> Hide Table
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_service_staff]', 1, !empty($user->user_settings['pos_index_hide_service_staff']), ['class' => 'form-check-input']); ?> Hide Service Staff
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_added_by]', 1, !empty($user->user_settings['pos_index_hide_added_by']), ['class' => 'form-check-input']); ?> Hide Added By
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_workstation]', 1, !empty($user->user_settings['pos_index_hide_workstation']), ['class' => 'form-check-input']); ?> Hide Workstation
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[pos_index_hide_location]', 1, !empty($user->user_settings['pos_index_hide_location']), ['class' => 'form-check-input']); ?> Hide Location
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cv-sales" role="tabpanel" aria-labelledby="cv-sales-tab">
                        <div class="row">
                            <div class="col-md-12"><h4>Sales Index Column Visibility</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_invoice_no]', 1, !empty($user->user_settings['sale_index_hide_invoice_no']), ['class' => 'form-check-input']); ?> Hide Invoice No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_ref_no]', 1, !empty($user->user_settings['sale_index_hide_ref_no']), ['class' => 'form-check-input']); ?> Hide Ref No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_customer_name]', 1, !empty($user->user_settings['sale_index_hide_customer_name']), ['class' => 'form-check-input']); ?> Hide Customer Name
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_contact_no]', 1, !empty($user->user_settings['sale_index_hide_contact_no']), ['class' => 'form-check-input']); ?> Hide Contact Number
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_payment_status]', 1, !empty($user->user_settings['sale_index_hide_payment_status']), ['class' => 'form-check-input']); ?> Hide Payment Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_payment_method]', 1, !empty($user->user_settings['sale_index_hide_payment_method']), ['class' => 'form-check-input']); ?> Hide Payment Method
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_payment_terms]', 1, !empty($user->user_settings['sale_index_hide_payment_terms']), ['class' => 'form-check-input']); ?> Hide Payment Terms
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_total_amount]', 1, !empty($user->user_settings['sale_index_hide_total_amount']), ['class' => 'form-check-input']); ?> Hide Total Amount
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_total_paid]', 1, !empty($user->user_settings['sale_index_hide_total_paid']), ['class' => 'form-check-input']); ?> Hide Total Paid
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_sell_due]', 1, !empty($user->user_settings['sale_index_hide_sell_due']), ['class' => 'form-check-input']); ?> Hide Sell Due
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_sell_return_due]', 1, !empty($user->user_settings['sale_index_hide_sell_return_due']), ['class' => 'form-check-input']); ?> Hide Sell Return Due
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_shipping_details]', 1, !empty($user->user_settings['sale_index_hide_shipping_details']), ['class' => 'form-check-input']); ?> Hide Shipping Details
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_shipping_status]', 1, !empty($user->user_settings['sale_index_hide_shipping_status']), ['class' => 'form-check-input']); ?> Hide Shipping Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_total_items]', 1, !empty($user->user_settings['sale_index_hide_total_items']), ['class' => 'form-check-input']); ?> Hide Total Items
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_types_of_service]', 1, !empty($user->user_settings['sale_index_hide_types_of_service']), ['class' => 'form-check-input']); ?> Hide Types of Service
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_sell_note]', 1, !empty($user->user_settings['sale_index_hide_sell_note']), ['class' => 'form-check-input']); ?> Hide Sell Note
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_staff_note]', 1, !empty($user->user_settings['sale_index_hide_staff_note']), ['class' => 'form-check-input']); ?> Hide Staff Note
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_table]', 1, !empty($user->user_settings['sale_index_hide_table']), ['class' => 'form-check-input']); ?> Hide Table
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_service_staff]', 1, !empty($user->user_settings['sale_index_hide_service_staff']), ['class' => 'form-check-input']); ?> Hide Service Staff
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_added_by]', 1, !empty($user->user_settings['sale_index_hide_added_by']), ['class' => 'form-check-input']); ?> Hide Added By
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_workstation]', 1, !empty($user->user_settings['sale_index_hide_workstation']), ['class' => 'form-check-input']); ?> Hide Workstation
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[sale_index_hide_location]', 1, !empty($user->user_settings['sale_index_hide_location']), ['class' => 'form-check-input']); ?> Hide Location
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cv-products" role="tabpanel" aria-labelledby="cv-products-tab">
                        <div class="row">
                            <div class="col-md-12"><h4>Products Index Column Visibility</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_product_type]', 1, !empty($user->user_settings['product_index_hide_product_type']), ['class' => 'form-check-input']); ?> Hide Product Type
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_category]', 1, !empty($user->user_settings['product_index_hide_category']), ['class' => 'form-check-input']); ?> Hide Category
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_brand]', 1, !empty($user->user_settings['product_index_hide_brand']), ['class' => 'form-check-input']); ?> Hide Brand
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_tax]', 1, !empty($user->user_settings['product_index_hide_tax']), ['class' => 'form-check-input']); ?> Hide Tax
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_business_location]', 1, !empty($user->user_settings['product_index_hide_business_location']), ['class' => 'form-check-input']); ?> Hide Business Location
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_unit_purchase_price]', 1, !empty($user->user_settings['product_index_hide_unit_purchase_price']), ['class' => 'form-check-input']); ?> Hide Unit Purchase Price
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_selling_price]', 1, !empty($user->user_settings['product_index_hide_selling_price']), ['class' => 'form-check-input']); ?> Hide Selling Price
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_current_stock]', 1, !empty($user->user_settings['product_index_hide_current_stock']), ['class' => 'form-check-input']); ?> Hide Current Stock
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_created_at]', 1, !empty($user->user_settings['product_index_hide_created_at']), ['class' => 'form-check-input']); ?> Hide Created At
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[product_index_hide_updated_at]', 1, !empty($user->user_settings['product_index_hide_updated_at']), ['class' => 'form-check-input']); ?> Hide Updated At
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cv-purchase" role="tabpanel" aria-labelledby="cv-purchase-tab">
                        <div class="row">
                            <div class="col-md-12"><h4>Purchase Index Column Visibility</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_ref_no]', 1, !empty($user->user_settings['purchase_index_hide_ref_no']), ['class' => 'form-check-input']); ?> Hide Ref No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_ref_no_short]', 1, !empty($user->user_settings['purchase_index_hide_ref_no_short']), ['class' => 'form-check-input']); ?> Hide Ref No (Short)
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_supplier]', 1, !empty($user->user_settings['purchase_index_hide_supplier']), ['class' => 'form-check-input']); ?> Hide Supplier
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_supplier_business_name]', 1, !empty($user->user_settings['purchase_index_hide_supplier_business_name']), ['class' => 'form-check-input']); ?> Hide Supplier Business Name
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_purchase_status]', 1, !empty($user->user_settings['purchase_index_hide_purchase_status']), ['class' => 'form-check-input']); ?> Hide Purchase Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_payment_status]', 1, !empty($user->user_settings['purchase_index_hide_payment_status']), ['class' => 'form-check-input']); ?> Hide Payment Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_grand_total]', 1, !empty($user->user_settings['purchase_index_hide_grand_total']), ['class' => 'form-check-input']); ?> Hide Grand Total
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_payment_due]', 1, !empty($user->user_settings['purchase_index_hide_payment_due']), ['class' => 'form-check-input']); ?> Hide Payment Due
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_added_by]', 1, !empty($user->user_settings['purchase_index_hide_added_by']), ['class' => 'form-check-input']); ?> Hide Added By
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[purchase_index_hide_location]', 1, !empty($user->user_settings['purchase_index_hide_location']), ['class' => 'form-check-input']); ?> Hide Location
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cv-expense" role="tabpanel" aria-labelledby="cv-expense-tab">
                        <div class="row">
                            <div class="col-md-12"><h4>Expense Index Column Visibility</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_ref_no]', 1, !empty($user->user_settings['expense_index_hide_ref_no']), ['class' => 'form-check-input']); ?> Hide Ref No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_recur_details]', 1, !empty($user->user_settings['expense_index_hide_recur_details']), ['class' => 'form-check-input']); ?> Hide Recur Details
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_expense_category]', 1, !empty($user->user_settings['expense_index_hide_expense_category']), ['class' => 'form-check-input']); ?> Hide Expense Category
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_sub_category]', 1, !empty($user->user_settings['expense_index_hide_sub_category']), ['class' => 'form-check-input']); ?> Hide Sub Category
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_location]', 1, !empty($user->user_settings['expense_index_hide_location']), ['class' => 'form-check-input']); ?> Hide Location
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_payment_status]', 1, !empty($user->user_settings['expense_index_hide_payment_status']), ['class' => 'form-check-input']); ?> Hide Payment Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_payment_method]', 1, !empty($user->user_settings['expense_index_hide_payment_method']), ['class' => 'form-check-input']); ?> Hide Payment Method
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_tax]', 1, !empty($user->user_settings['expense_index_hide_tax']), ['class' => 'form-check-input']); ?> Hide Tax
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_total_amount]', 1, !empty($user->user_settings['expense_index_hide_total_amount']), ['class' => 'form-check-input']); ?> Hide Total Amount
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_payment_due]', 1, !empty($user->user_settings['expense_index_hide_payment_due']), ['class' => 'form-check-input']); ?> Hide Payment Due
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_expense_for]', 1, !empty($user->user_settings['expense_index_hide_expense_for']), ['class' => 'form-check-input']); ?> Hide Expense For
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_contact]', 1, !empty($user->user_settings['expense_index_hide_contact']), ['class' => 'form-check-input']); ?> Hide Contact
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_expense_note]', 1, !empty($user->user_settings['expense_index_hide_expense_note']), ['class' => 'form-check-input']); ?> Hide Expense Note
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[expense_index_hide_added_by]', 1, !empty($user->user_settings['expense_index_hide_added_by']), ['class' => 'form-check-input']); ?> Hide Added By
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cv-stock-adjustment" role="tabpanel" aria-labelledby="cv-stock-adjustment-tab">
                        <div class="row">
                            <div class="col-md-12"><h4>Stock Adjustment Index Column Visibility</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_adj_index_hide_ref_no]', 1, !empty($user->user_settings['stock_adj_index_hide_ref_no']), ['class' => 'form-check-input']); ?> Hide Ref No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_adj_index_hide_location]', 1, !empty($user->user_settings['stock_adj_index_hide_location']), ['class' => 'form-check-input']); ?> Hide Location
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_adj_index_hide_adjustment_type]', 1, !empty($user->user_settings['stock_adj_index_hide_adjustment_type']), ['class' => 'form-check-input']); ?> Hide Adjustment Type
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_adj_index_hide_total_amount]', 1, !empty($user->user_settings['stock_adj_index_hide_total_amount']), ['class' => 'form-check-input']); ?> Hide Total Amount
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_adj_index_hide_total_recovered]', 1, !empty($user->user_settings['stock_adj_index_hide_total_recovered']), ['class' => 'form-check-input']); ?> Hide Total Amount Recovered
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_adj_index_hide_reason]', 1, !empty($user->user_settings['stock_adj_index_hide_reason']), ['class' => 'form-check-input']); ?> Hide Reason
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_adj_index_hide_added_by]', 1, !empty($user->user_settings['stock_adj_index_hide_added_by']), ['class' => 'form-check-input']); ?> Hide Added By
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="cv-stock-transfers" role="tabpanel" aria-labelledby="cv-stock-transfers-tab">
                        <div class="row">
                            <div class="col-md-12"><h4>Stock Transfers Index Column Visibility</h4></div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_transfer_index_hide_ref_no]', 1, !empty($user->user_settings['stock_transfer_index_hide_ref_no']), ['class' => 'form-check-input']); ?> Hide Ref No
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_transfer_index_hide_location_from]', 1, !empty($user->user_settings['stock_transfer_index_hide_location_from']), ['class' => 'form-check-input']); ?> Hide Location From
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_transfer_index_hide_location_to]', 1, !empty($user->user_settings['stock_transfer_index_hide_location_to']), ['class' => 'form-check-input']); ?> Hide Location To
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_transfer_index_hide_status]', 1, !empty($user->user_settings['stock_transfer_index_hide_status']), ['class' => 'form-check-input']); ?> Hide Status
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_transfer_index_hide_shipping_charges]', 1, !empty($user->user_settings['stock_transfer_index_hide_shipping_charges']), ['class' => 'form-check-input']); ?> Hide Shipping Charges
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_transfer_index_hide_total_amount]', 1, !empty($user->user_settings['stock_transfer_index_hide_total_amount']), ['class' => 'form-check-input']); ?> Hide Total Cost Value
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_transfer_index_hide_total_selling_value]', 1, !empty($user->user_settings['stock_transfer_index_hide_total_selling_value']), ['class' => 'form-check-input']); ?> Hide Total Selling Value
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <?php echo Form::checkbox('user_settings[stock_transfer_index_hide_additional_notes]', 1, !empty($user->user_settings['stock_transfer_index_hide_additional_notes']), ['class' => 'form-check-input']); ?> Hide Additional Notes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('user.partials.report_column_visibility', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div id="user-profile-footer-actions-template" class="d-none">
    <button class="btn btn-primary" type="submit" form="edit_user_profile_form"><i class="fas fa-save"></i> <?php echo app('translator')->get('messages.update'); ?></button>
</div>
<?php echo Form::close(); ?>


</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
  // Per-user SMTP test (moved from Business Settings)
  $(document).on('click', '#test_user_email_btn', function() {
      var data = {
          mail_driver: $('#mail_driver').val(),
          mail_host: $('#mail_host').val(),
          mail_port: $('#mail_port').val(),
          mail_username: $('#mail_username').val(),
          mail_password: $('#mail_password').val(),
          mail_encryption: $('#mail_encryption').val(),
          mail_from_address: $('#mail_from_address').val(),
          mail_from_name: $('#mail_from_name').val(),
          mail_verify_peer: $('#mail_verify_peer').is(':checked') ? 1 : 0,
      };
      $.ajax({
          method: 'post',
          data: data,
          url: "<?php echo e(action([\App\Http\Controllers\BusinessController::class, 'testEmailConfiguration']), false); ?>",
          dataType: 'json',
          success: function(result) {
              if (result.success == true) {
                  swal({ text: result.msg, icon: 'success' });
              } else {
                  swal({ text: result.msg, icon: 'error' });
              }
          },
      });
  });

  $(document).ready(function(){
    // Instant theme preview on dropdown change
    $('select[name="theme_color"]').on('change', function() {
      var selected = $(this).val();
      // Remove all existing theme-* classes from body
      document.body.className = document.body.className.replace(/\btheme-\S+/g, '').trim();
      if (selected) {
        document.body.classList.add('theme-' + selected);
      }
    });

    // Reset All - Indexes Column Visibility
    $('#resetAllIndexVisibility').on('click', function() {
        $('#colVisibilityTabContent input[type="checkbox"]').prop('checked', false);
        toastr.info('All index column visibility checkboxes have been unticked. Click Update to save.');
    });

    // Reset All - Reports Column Visibility
    $('#resetAllReportVisibility').on('click', function() {
        $('#rptColVisibilityTabContent input[type="checkbox"]').prop('checked', false);
        toastr.info('All report column visibility checkboxes have been unticked. Click Update to save.');
    });
  });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>