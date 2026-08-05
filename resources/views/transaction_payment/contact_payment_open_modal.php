<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.search_contact_for_payment' ); ?></h4>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-group">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-search"></i></span>
              <input type="text" class="form-control" id="contact_payment_search_text" placeholder="Search name or mobile" autocomplete="off">
              <?php echo Form::hidden('contact_type', $contact_type, ['id' => 'contact_type']); ?>

            </div>
          </div>

          <div class="list-group contact-payment-results" style="max-height: 260px; overflow-y: auto;">
            <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
                $mobile = $contact->mobile ?? '';
                $mobile_digits = preg_replace('/\D/', '', $mobile);
                $search_text = trim($contact->text.' '.$mobile.' '.$mobile_digits);
              ?>
              <button type="button"
                class="list-group-item list-group-item-action contact-payment-option"
                data-contact-id="<?php echo e($contact->id, false); ?>"
                data-contact-search="<?php echo e($search_text, false); ?>">
                <span><?php echo e($contact->text, false); ?></span>
                <?php if(! empty($mobile)): ?>
                  <small class="text-muted"> - <?php echo e($mobile, false); ?></small>
                <?php endif; ?>
              </button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
      
    </div>

  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
