<!--expenses create and edit page related settings -->
<div class="pos-tab-content">
    <div class="row">
        <div class="clearfix"></div>
       
        <div class="col-sm-12">
            <h4><?php echo app('translator')->get('lang_v1.hide_contact_extra_field_expenses'); ?>:</h4>
        </div>
        <div class="col-md-12 row">
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::hidden('common_settings[hide_expense_attach_document]', 0); ?>

<?php echo Form::checkbox('common_settings[hide_expense_attach_document]', 1,
                            !empty($common_settings['hide_expense_attach_document']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_expense_attach_document' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::hidden('common_settings[hide_expense_for_user]', 0); ?>

<?php echo Form::checkbox('common_settings[hide_expense_for_user]', 1,
                            !empty($common_settings['hide_expense_for_user']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_expense_for_user' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::hidden('common_settings[hide_expense_for_marchant]', 0); ?>

<?php echo Form::checkbox('common_settings[hide_expense_for_marchant]', 1,
                            !empty($common_settings['hide_expense_for_marchant']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_expense_for_marchant' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::hidden('common_settings[hide_expense_apllicable_tax]', 0); ?>

<?php echo Form::checkbox('common_settings[hide_expense_apllicable_tax]', 1,
                            !empty($common_settings['hide_expense_apllicable_tax']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_expense_apllicable_tax' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::hidden('common_settings[hide_expense_is_refund]', 0); ?>

<?php echo Form::checkbox('common_settings[hide_expense_is_refund]', 1,
                            !empty($common_settings['hide_expense_is_refund']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_expense_is_refund' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="form-group mb-3">
                    <div class="form-check">
                        
                        <label class="form-check-label">
<?php echo Form::hidden('common_settings[hide_expense_is_recurring]', 0); ?>

<?php echo Form::checkbox('common_settings[hide_expense_is_recurring]', 1,
                            !empty($common_settings['hide_expense_is_recurring']) ,
                            [ 'class' => 'form-check-input']); ?> <?php echo e(__( 'lang_v1.hide_expense_is_recurring' ), false); ?>

                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>
    <hr>
    <h4><?php echo app('translator')->get('business.add_keyboard_shortcuts'); ?> — <?php echo app('translator')->get('lang_v1.expense_page_shortcuts'); ?>:</h4>
    <p class="help-block"><?php echo app('translator')->get('lang_v1.shortcut_help'); ?>; <?php echo app('translator')->get('lang_v1.example'); ?>: <b>ctrl+shift+b</b>, <b>ctrl+h</b></p>
    <div class="row">
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('business.operations'); ?></th>
                    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.expense_save'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[expense][save]',
                        !empty($shortcuts["expense"]["save"]) ? $shortcuts["expense"]["save"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.expense_focus_location'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[expense][focus_location]',
                        !empty($shortcuts["expense"]["focus_location"]) ? $shortcuts["expense"]["focus_location"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.expense_focus_ref_no'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[expense][focus_ref_no]',
                        !empty($shortcuts["expense"]["focus_ref_no"]) ? $shortcuts["expense"]["focus_ref_no"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.expense_focus_date'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[expense][focus_date]',
                        !empty($shortcuts["expense"]["focus_date"]) ? $shortcuts["expense"]["focus_date"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.expense_show_shortcuts_help'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[expense][show_shortcuts_help]',
                        !empty($shortcuts["expense"]["show_shortcuts_help"]) ? $shortcuts["expense"]["show_shortcuts_help"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table table-striped">
                <tr>
                    <th><?php echo app('translator')->get('business.operations'); ?></th>
                    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.expense_focus_category'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[expense][focus_category]',
                        !empty($shortcuts["expense"]["focus_category"]) ? $shortcuts["expense"]["focus_category"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.expense_focus_amount'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[expense][focus_amount]',
                        !empty($shortcuts["expense"]["focus_amount"]) ? $shortcuts["expense"]["focus_amount"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.expense_focus_payment'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[expense][focus_payment]',
                        !empty($shortcuts["expense"]["focus_payment"]) ? $shortcuts["expense"]["focus_payment"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
                <tr>
                    <td><?php echo app('translator')->get('lang_v1.expense_focus_tax'); ?>:</td>
                    <td>
                        <?php echo Form::text('shortcuts[expense][focus_tax]',
                        !empty($shortcuts["expense"]["focus_tax"]) ? $shortcuts["expense"]["focus_tax"] : null,
                        ['class' => 'form-control']); ?>

                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
