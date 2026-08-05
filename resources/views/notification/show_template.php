<!-- Fix for scroll issue in new booking -->
<style type="text/css">
  .modal {
    overflow-y:auto; 
  }
</style>
<div class="modal-dialog" role="document">
  <div class="modal-content">

    <?php echo Form::open(['url' => $notification_template['template_for'] == 'send_ledger' ? action([\App\Http\Controllers\ContactController::class, 'sendLedger']) : action([\App\Http\Controllers\NotificationController::class, 'send']), 'method' => 'post', 'id' => 'send_notification_form' ]); ?>


    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.send_notification' ); ?> - <?php echo e($template_name, false); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>   
    </div>

    <div class="modal-body">
        <div>
            <strong><?php echo app('translator')->get('lang_v1.available_tags'); ?>:</strong> 
            <?php echo $__env->make('notification_template.partials.tags', ['tags' => $tags], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="box-group" id="accordion">
            
            <div class="panel box box-primary">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#email_collapse" aria-expanded="true">
                   <?php echo app('translator')->get('lang_v1.send_email'); ?>
                  </a>
                </h4>
              </div>
              <div id="email_collapse" class="panel-collapse" aria-expanded="true">
                <div class="box-body">
                    <?php if($notification_template['template_for'] == 'send_ledger'): ?>
                        <div class="mb-3">
                            <?php echo Form::label('ledger_format', __('lang_v1.ledger_format').':'); ?>

                            <?php echo Form::select('ledger_format', ['format_1' => __('lang_v1.format_1'), 'format_2' => __('lang_v1.format_2')], $ledger_format, ['class' => 'form-control']); ?>

                        </div>
                    <?php endif; ?>
                    <div class="form-group <?php if($notification_template['template_for'] == 'send_ledger'): ?> hide <?php endif; ?>">
                        <div class="form-check">
                            <label class="form-check-label">
<?php echo Form::checkbox('notification_type[]', 'email', true, ['class' => 'form-check-input notification_type']); ?> <?php echo app('translator')->get('lang_v1.send_email'); ?>
                            </label>
                        </div>
                    </div>
                  <div id="email_div">
                    <div class="mb-3">
                      <?php echo Form::label('to_email', __('lang_v1.to').':'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('lang_v1.notification_email_tooltip') . '"></i>';
                }
            ?>
                      <?php echo Form::text('to_email', $contact->email, ['class' => 'form-control' , 'placeholder' => __('lang_v1.to')]); ?>

                    </div>
                    <div class="mb-3">
                      <?php echo Form::label('subject', __('lang_v1.email_subject').':'); ?>

                      <?php echo Form::text('subject', $notification_template['subject'], ['class' => 'form-control' , 'placeholder' => __('lang_v1.email_subject')]); ?>

                    </div>
                    <div class="mb-3">
                      <?php echo Form::label('cc', 'CC:'); ?>

                      <?php echo Form::email('cc', $notification_template['cc'], ['class' => 'form-control' , 'placeholder' => 'CC']); ?>

                    </div>
                    <div class="mb-3">
                      <?php echo Form::label('bcc', 'BCC:'); ?>

                      <?php echo Form::email('bcc', $notification_template['bcc'], ['class' => 'form-control' , 'placeholder' => 'BCC']); ?>

                    </div>
                    <div class="mb-3">
                      <?php echo Form::label('email_body', __('lang_v1.email_body').':'); ?>

                      <?php echo Form::textarea('email_body', $notification_template['email_body'], ['class' => 'form-control', 'placeholder' => __('lang_v1.email_body'), 'rows' => 6]); ?>

                    </div>
                    <?php if(config('constants.enable_download_pdf') && $notification_template['template_for'] == 'new_sale'): ?>
                        <div class="form-check">
                            <label class="form-check-label">
<?php echo Form::checkbox('attach_pdf', true, false, ['class' => 'form-check-input notification_type']); ?>

                              <?php echo app('translator')->get('lang_v1.attach_pdf_in_email'); ?>
                            </label>
                        </div>
                    <?php endif; ?>
                    <?php if($notification_template['template_for'] == 'send_ledger'): ?>
                      <p class="help-block">*<?php echo app('translator')->get('lang_v1.ledger_attacment_help'); ?></p>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            
            <?php if($notification_template['template_for'] != 'send_ledger'): ?>
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h5 class="box-title">
                      <a data-bs-toggle="collapse" data-bs-parent="#accordion" href="#sms_collapse" class="" aria-expanded="false">
                        <?php echo app('translator')->get('lang_v1.send_sms_whatsapp_notification'); ?>
                      </a>
                    </h5>
                  </div>
                  <div id="sms_collapse" class="panel-collapse" aria-expanded="false">
                    <div class="box-body">
                        <div class="form-group <?php if($notification_template['template_for'] == 'send_ledger'): ?> hide <?php endif; ?>">
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('notification_type[]', 'sms', false, ['class' => 'form-check-input notification_type']); ?> <?php echo app('translator')->get('lang_v1.send_sms'); ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
<?php echo Form::checkbox('notification_type[]', 'whatsapp', false, ['class' => 'form-check-input notification_type']); ?> <?php echo app('translator')->get('lang_v1.send_whatsapp'); ?>
                                </label>
                            </div>
                          </div>
                            <div class="mb-3">
                            <?php echo Form::label('mobile_number', __('lang_v1.mobile_number').':'); ?>

                            <?php echo Form::text('mobile_number', $contact->mobile, ['class' => 'form-control', 'placeholder' => __('lang_v1.mobile_number')]); ?>

                            </div>
                          <div id="sms_div" class="hide">
                            <div class="mb-3">
                              <?php echo Form::label('sms_body', __('lang_v1.sms_body').':'); ?>

                              <?php echo Form::textarea('sms_body', $notification_template['sms_body'], ['class' => 'form-control', 'placeholder' => __('lang_v1.sms_body'), 'rows' => 6]); ?>

                            </div>
                          </div>
                          <div id="whatsapp_div" class="hide">
                              <?php echo Form::label('whatsapp_text', __('lang_v1.whatsapp_text').':'); ?>

                              <?php echo Form::textarea('whatsapp_text', $notification_template['whatsapp_text'], ['class' => 'form-control', 'placeholder' => __('lang_v1.whatsapp_text'), 'rows' => 6]); ?>

                          </div>
                    </div>
                  </div>
                </div>
            <?php endif; ?>
        </div>
        
        <?php if(!empty($transaction)): ?>
            <?php echo Form::hidden('transaction_id', $transaction->id); ?>

        <?php endif; ?>

        <?php if($notification_template['template_for'] == 'send_ledger'): ?>
            <?php echo Form::hidden('contact_id', $contact->id); ?>

            <?php echo Form::hidden('start_date', $start_date); ?>

            <?php echo Form::hidden('end_date', $end_date); ?>

            <?php echo Form::hidden('location_id', $location_id); ?>

        <?php endif; ?>
        <?php echo Form::hidden('template_for', $notification_template['template_for']); ?>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="send_notification_btn"><?php echo app('translator')->get('lang_v1.send'); ?></button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
        </div>
        <?php echo Form::close(); ?>

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script type="text/javascript">
// Fix for not updating textarea value on modal
  // CKEDITOR.on('instanceReady', function(){
  //    $.each( CKEDITOR.instances, function(instance) {
  //     CKEDITOR.instances[instance].on("change", function(e) {
  //         for ( instance in CKEDITOR.instances )
  //         CKEDITOR.instances[instance].updateElement();
  //     });
  //    });
  // });

  if (_.isNull(tinyMCE.activeEditor)) {
        tinymce.init({
            selector: 'textarea#email_body',
        });
    }
    
  $(document).ready(function(){
    // iCheck removed - using Bootstrap 5 native checkboxes
  });

  $(document).on('change', '.notification_type', function(){
    var notification_type = $(this).val();
    if (notification_type == 'email') {
      if ($(this).is(':checked')) {
        $('div#email_div').removeClass('hide');
      } else {
        $('div#email_div').addClass('hide');
      }
    } else if(notification_type == 'sms'){
      if ($(this).is(':checked')) {
        $('div#sms_div').removeClass('hide');
      } else {
        $('div#sms_div').addClass('hide');
      }
    } else if(notification_type == 'whatsapp'){
      if ($(this).is(':checked')) {
        $('div#whatsapp_div').removeClass('hide');
      } else {
        $('div#whatsapp_div').addClass('hide');
      }
    }
  });
  $('#send_notification_form').submit(function(e){
    e.preventDefault();
    tinyMCE.triggerSave();
    var data = $(this).serialize();
    var btn = $('#send_notification_btn');
    btn.text("<?php echo app('translator')->get('lang_v1.sending'); ?>...");
    btn.attr('disabled', 'disabled');
    $.ajax({
      method: "POST",
      url: $(this).attr("action"),
      dataType: "json",
      data: $(this).serialize(),
      beforeSend: function(xhr) {
          __disable_submit_button(btn);
      },
      success: function(result){
        if(result.success == true){
          if (result.whatsapp_link) {
            window.open(result.whatsapp_link);
          }
          $('div.view_modal').modal('hide');
          toastr.success(result.msg);
        } else {
          toastr.error(result.msg);
        }
        $('#send_notification_btn').text("<?php echo app('translator')->get('lang_v1.send'); ?>");
        $('#send_notification_btn').removeAttr('disabled');
      }
    });
  });
</script>
