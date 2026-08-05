<div class="modal-header bg-primary text-white">
    <h4 class="modal-title" id="modalTitle"><i class="fas fa-receipt me-2"></i> <?php echo app('translator')->get('expense.expense_details'); ?> (<b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($expense->ref_no, false); ?>)
    </h4>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

  
  <div class="border rounded p-3 mb-3 bg-light">
    <div class="row">
      <div class="col-md-4">
        <h6 class="fw-bold text-primary mb-2"><i class="fas fa-building me-1"></i> <?php echo app('translator')->get('business.business'); ?></h6>
        <?php if(empty($common_settings['expense_payment_hide_address'])): ?>
        <address class="mb-0">
          <strong><?php echo e($expense->business->name, false); ?></strong><br>
          <?php echo e($expense->location->name, false); ?>

          <?php if(!empty($expense->location->landmark)): ?>
            <br><?php echo e($expense->location->landmark, false); ?>

          <?php endif; ?>
          <?php if(!empty($expense->location->city) || !empty($expense->location->state) || !empty($expense->location->country)): ?>
            <br><?php echo e(implode(',', array_filter([$expense->location->city, $expense->location->state, $expense->location->country])), false); ?>

          <?php endif; ?>
          <?php if(!empty($expense->business->tax_number_1)): ?>
            <br><?php echo e($expense->business->tax_label_1, false); ?>: <?php echo e($expense->business->tax_number_1, false); ?>

          <?php endif; ?>
          <?php if(!empty($expense->business->tax_number_2)): ?>
            <br><?php echo e($expense->business->tax_label_2, false); ?>: <?php echo e($expense->business->tax_number_2, false); ?>

          <?php endif; ?>
          <?php if(!empty($expense->location->mobile)): ?>
            <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($expense->location->mobile, false); ?>

          <?php endif; ?>
          <?php if(!empty($expense->location->email)): ?>
            <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($expense->location->email, false); ?>

          <?php endif; ?>
        </address>
        <?php endif; ?>
      </div>
      <div class="col-md-4">
        <h6 class="fw-bold text-primary mb-2"><i class="fas fa-file-alt me-1"></i> <?php echo app('translator')->get('purchase.ref_no'); ?></h6>
        <table class="table table-sm table-borderless mb-0">
          <tr><td class="fw-bold py-0"><?php echo app('translator')->get('purchase.ref_no'); ?>:</td><td class="py-0">#<?php echo e($expense->ref_no, false); ?></td></tr>
          <tr><td class="fw-bold py-0"><?php echo app('translator')->get('messages.date'); ?>:</td><td class="py-0"><?php echo e(\Carbon::createFromTimestamp(strtotime($expense->transaction_date))->format(session('business.date_format')), false); ?></td></tr>
          <tr><td class="fw-bold py-0"><?php echo app('translator')->get('purchase.location'); ?>:</td><td class="py-0"><?php echo e($expense->location->name, false); ?></td></tr>
          <?php if(!empty($expense->project_name)): ?>
          <tr><td class="fw-bold py-0"><?php echo app('translator')->get('project::lang.project'); ?>:</td><td class="py-0"><?php echo e($expense->project_name, false); ?></td></tr>
          <?php endif; ?>
          <?php if(!empty($expense->project_step_name)): ?>
          <tr><td class="fw-bold py-0"><?php echo app('translator')->get('project::lang.project_steps'); ?>:</td><td class="py-0"><?php echo e($expense->project_step_name, false); ?></td></tr>
          <?php endif; ?>
          <?php if(!empty($expense->payment_status)): ?>
          <tr><td class="fw-bold py-0"><?php echo app('translator')->get('purchase.payment_status'); ?>:</td><td class="py-0"><span class="badge <?php echo e($expense->payment_status == 'paid' ? 'bg-success' : ($expense->payment_status == 'partial' ? 'bg-warning' : 'bg-danger'), false); ?>"><?php echo e(__('lang_v1.' . $expense->payment_status), false); ?></span></td></tr>
          <?php endif; ?>
          <?php if(!empty($expense_order_nos)): ?>
          <tr><td class="fw-bold py-0"><?php echo app('translator')->get('restaurant.order_no'); ?>:</td><td class="py-0"><?php echo e($expense_order_nos, false); ?></td></tr>
          <?php endif; ?>
          <?php if(!empty($expense_order_dates)): ?>
          <tr><td class="fw-bold py-0"><?php echo app('translator')->get('lang_v1.order_dates'); ?>:</td><td class="py-0"><?php echo e($expense_order_dates, false); ?></td></tr>
          <?php endif; ?>
        </table>
      </div>
      <div class="col-md-4 d-flex align-items-start justify-content-end">
        <?php if($expense->document_path): ?>
          <a href="<?php echo e($expense->document_path, false); ?>" 
            download="<?php echo e($expense->document_name, false); ?>" class="btn btn-sm btn-success no-print">
            <i class="fa fa-download me-1"></i><?php echo e(__('purchase.download_document'), false); ?>

          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>

  
  <?php if(!empty($expense->type == 'expense')): ?>
  <div class="border rounded p-3 mb-3">
    <h6 class="fw-bold text-primary mb-3"><i class="fas fa-list-alt me-1"></i> <?php echo e(__('expense.expense_details'), false); ?></h6>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-dark">
          <tr>
            <th><?php echo e(__('messages.date'), false); ?></th>
            <th><?php echo e(__('purchase.ref_no'), false); ?></th>
            <th><?php echo e(__('expense.expense_category'), false); ?></th>
            <th><?php echo e(__('product.sub_category'), false); ?></th>
            <th><?php echo e(__('expense.expense_for'), false); ?></th>
            <th><?php echo e(__('lang_v1.expense_for_contact'), false); ?></th>
            <th><?php echo e(__('expense.expense_note'), false); ?></th>
            <th class="text-end"><?php echo e(__('sale.amount'), false); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $total_paid = 0; ?>
          <tr>
            <td><?php echo e(\Carbon::createFromTimestamp(strtotime($expense->transaction_date))->format(session('business.date_format')), false); ?></td>
            <td><?php echo e($expense->ref_no, false); ?></td>
            <td><?php echo e($expense->category, false); ?></td>
            <td><?php echo e($expense->subcat, false); ?></td>
            <td><?php echo e($expense->expense_for, false); ?></td>
            <td>
              <?php if(empty($common_settings['expense_payment_hide_address'])): ?>
              <address class="mb-0">
                <?php echo $expense->contact->contact_address; ?>

                <?php if(!empty($expense->contact->tax_number)): ?>
                  <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($expense->contact->tax_number, false); ?>

                <?php endif; ?>
                <?php if(!empty($expense->contact->mobile)): ?>
                  <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($expense->contact->mobile, false); ?>

                <?php endif; ?>
                <?php if(!empty($expense->contact->email)): ?>
                  <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($expense->contact->email, false); ?>

                <?php endif; ?>
              </address>
              <?php endif; ?>
            </td>
            <td><?php if($expense->additional_notes): ?> 
              <?php echo e(ucfirst($expense->additional_notes), false); ?>

              <?php else: ?>
              --
              <?php endif; ?>
            </td>
            <td class="text-end"><span class="display_currency" data-currency_symbol="true"><?php echo e($expense->final_total, false); ?></span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <?php endif; ?>

  
  <div class="row mb-3">
    <div class="col-md-6"></div>
    <div class="col-md-6">
      <div class="border rounded p-3" style="border-color: #f0ad4e !important;">
        <h6 class="fw-bold text-warning mb-2"><i class="fas fa-calculator me-1"></i> <?php echo app('translator')->get('sale.total_amount'); ?></h6>
        <table class="table table-sm table-borderless mb-0">
          <tr>
            <th><?php echo app('translator')->get('product.applicable_tax'); ?>:</th>
            <td class="text-end">
              <?php if(!empty($expense_taxes)): ?>
                <?php $__currentLoopData = $expense_taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <strong><small><?php echo e($k, false); ?></small></strong> - <span class="display_currency" data-currency_symbol="true"><?php echo e($v, false); ?></span><br>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php else: ?>
                0.00
              <?php endif; ?>
            </td>
          </tr>
          <tr class="border-top">
            <th class="fs-6"><?php echo app('translator')->get('purchase.net_total_amount'); ?>:</th>
            <td class="text-end"><span class="display_currency fs-5 fw-bold text-success" data-currency_symbol="true"><?php echo e($expense->final_total, false); ?></span></td>
          </tr>
        </table>
      </div>
    </div>
  </div>

  
  <?php if(!empty($expense->type == 'expense')): ?>
  <div class="border rounded p-3 mb-3" style="border-color: #5bc0de !important;">
    <h6 class="fw-bold text-info mb-3"><i class="fas fa-credit-card me-1"></i> <?php echo e(__('sale.payment_info'), false); ?></h6>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-sm mb-0">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th><?php echo e(__('messages.date'), false); ?></th>
            <th><?php echo e(__('purchase.ref_no'), false); ?></th>
            <th><?php echo e(__('purchase.location'), false); ?></th>
            <th class="text-end"><?php echo e(__('sale.amount'), false); ?></th>
            <th><?php echo e(__('sale.payment_mode'), false); ?></th>
            <th><?php echo e(__('sale.payment_note'), false); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $total_paid = 0; ?>
          <?php $__empty_1 = true; $__currentLoopData = $expense->payment_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php $total_paid += $payment_line->amount; ?>
            <tr>
              <td><?php echo e($loop->iteration, false); ?></td>
              <td><?php echo e(\Carbon::createFromTimestamp(strtotime($payment_line->paid_on))->format(session('business.date_format')), false); ?></td>
              <td><?php echo e($payment_line->payment_ref_no, false); ?></td>
              <td><?php echo e($expense->location->name, false); ?></td>
              <td class="text-end"><span class="display_currency" data-currency_symbol="true"><?php echo e($payment_line->amount, false); ?></span></td>
              <td><?php echo e($payment_methods[$payment_line->method] ?? '', false); ?></td>
              <td><?php if($payment_line->note): ?> 
                <?php echo e(ucfirst($payment_line->note), false); ?>

                <?php else: ?>
                --
                <?php endif; ?>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="7" class="text-center text-muted py-3">
                <i class="fas fa-info-circle me-1"></i><?php echo app('translator')->get('purchase.no_payments'); ?>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php endif; ?>

  <?php if(!empty($activities)): ?>
  <div class="border rounded p-3 mb-3">
    <h6 class="fw-bold text-secondary mb-2"><i class="fas fa-history me-1"></i> <?php echo e(__('lang_v1.activities'), false); ?></h6>
    <?php if ($__env->exists('activity_log.activities', ['activity_type' => 'purchase'])) echo $__env->make('activity_log.activities', ['activity_type' => 'purchase'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </div>
  <?php endif; ?>

  
  <div class="row print_section">
    <div class="col-12 text-center">
      <img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($expense->ref_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
    </div>
  </div>
</div>
