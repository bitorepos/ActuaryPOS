<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li class="nav-item" <?php if($loop->index == 0): ?> class="nav-item active" <?php endif; ?>>
                <a class="nav-link <?php if($loop->index == 0): ?> active <?php endif; ?> pe-2 ps-2 pb-2" href="#cn_<?php echo e($key, false); ?>" data-bs-toggle="tab" role="tab" aria-expanded="true">
                <?php echo e($value['name'], false); ?> </a>
            </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <div class="tab-content">
        <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="tab-pane fade <?php if($loop->index == 0): ?> show active <?php endif; ?>" id="cn_<?php echo e($key, false); ?>" role="tabpanel">
                <div class="row">
                <div class="col-md-12">
                    <?php if(!empty($value['extra_tags'])): ?>
                        <strong><?php echo app('translator')->get('lang_v1.available_tags'); ?>:</strong>
                        <?php echo $__env->make('notification_template.partials.tags', ['tags' => $value['extra_tags']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    
                    <?php endif; ?>
                    <?php if(!empty($value['help_text'])): ?>
                    <p class="help-block"><?php echo e($value['help_text'], false); ?></p>
                    <?php endif; ?>
                </div>
                <div class="col-md-12 mt-10">
                    <div class="form-group mb-2">
                        <?php echo Form::label($key . '_subject',
                        __('lang_v1.email_subject').':'); ?>

                        <?php echo Form::text('template_data[' . $key . '][subject]', 
                        $value['subject'], ['class' => 'form-control'
                        , 'placeholder' => __('lang_v1.email_subject'), 'id' => $key . '_subject']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label($key . '_cc',
                        'CC:'); ?>

                        <?php echo Form::email('template_data[' . $key . '][cc]', 
                        $value['cc'], ['class' => 'form-control'
                        , 'placeholder' => 'CC', 'id' => $key . '_cc']); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <?php echo Form::label($key . '_bcc',
                        'BCC:'); ?>

                        <?php echo Form::email('template_data[' . $key . '][bcc]', 
                        $value['bcc'], ['class' => 'form-control'
                        , 'placeholder' => 'BCC', 'id' => $key . '_bcc']); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group mb-2">
                        <?php echo Form::label($key . '_email_body',
                        __('lang_v1.email_body').':'); ?>

                        <?php echo Form::textarea('template_data[' . $key . '][email_body]', 
                        $value['email_body'], ['class' => 'form-control ckeditor'
                        , 'placeholder' => __('lang_v1.email_body'), 'id' => $key . '_email_body', 'rows' => 6]); ?>

                    </div>
                </div>
                <?php if(!empty($value['email_only'])): ?>
                    <?php echo Form::hidden('template_data[' . $key . '][sms_body]', $value['sms_body'] ?? ''); ?>

                    <?php echo Form::hidden('template_data[' . $key . '][whatsapp_text]', $value['whatsapp_text'] ?? ''); ?>

                <?php else: ?>
                    <div class="col-md-12 <?php if($key == 'send_ledger'): ?> hide <?php endif; ?>">
                        <div class="form-group mb-2">
                            <?php echo Form::label($key . '_sms_body',
                            __('lang_v1.sms_body').':'); ?>

                            <?php echo Form::textarea('template_data[' . $key . '][sms_body]', 
                            $value['sms_body'], ['class' => 'form-control'
                            , 'placeholder' => __('lang_v1.sms_body'), 'id' => $key . '_sms_body', 'rows' => 6]); ?>

                        </div>
                    </div>
                    <div class="col-md-12 <?php if($key == 'send_ledger'): ?> hide <?php endif; ?>">
                        <div class="form-group mb-2">
                            <?php echo Form::label($key . '_whatsapp_text',
                            __('lang_v1.whatsapp_text').':'); ?>

                            <?php echo Form::textarea('template_data[' . $key . '][whatsapp_text]', 
                            $value['whatsapp_text'], ['class' => 'form-control'
                            , 'placeholder' => __('lang_v1.whatsapp_text'), 'id' => $key . '_whatsapp_text', 'rows' => 6]); ?>

                        </div>
                    </div>
                <?php endif; ?>
                <?php if($key == 'new_sale' || $key == 'payment_reminder' || !empty($value['auto_send_email_only'])): ?>
                    <div class="col-md-12 mt-15">
                        <div class="form-group mb-2">
                            <label class="checkbox-inline">
                                <?php echo Form::checkbox('template_data[' . $key . '][auto_send]', 1, $value['auto_send'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.autosend_email'); ?>
                            </label>
                            <?php if(empty($value['auto_send_email_only'])): ?>
                                <label class="checkbox-inline">
                                    <?php echo Form::checkbox('template_data[' . $key . '][auto_send_sms]', 1, $value['auto_send_sms'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.autosend_sms'); ?>
                                </label>
                                <label class="checkbox-inline">
                                    <?php echo Form::checkbox('template_data[' . $key . '][auto_send_wa_notif]', 1, $value['auto_send_wa_notif'], ['class' => 'form-check-input']); ?> <?php echo app('translator')->get('lang_v1.auto_send_wa_notif'); ?>
                                </label>
                            <?php endif; ?>
                        </div>
                        <?php if($key == 'payment_reminder'): ?>
                            <p class="help-block"><?php echo app('translator')->get('lang_v1.payment_reminder_help'); ?></p>

                        <?php elseif($key == 'new_sale'): ?>
                            <p class="help-block"><?php echo app('translator')->get('lang_v1.new_sale_notification_help'); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
