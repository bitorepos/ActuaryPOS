<div class="row">
  <div class="col-md-12">
    <hr>
    <h3><?php echo app('translator')->get('lang_v1.expense_details_register'); ?></h3>
    <table class="table table-condensed">
      <tr>
        <th>#</th>
        <th class="col-md-2"><?php echo app('translator')->get('purchase.ref_no'); ?></th>
        <th class="col-md-2"><?php echo app('translator')->get('expense.expense_category'); ?></th>
        <th class="col-md-2"><?php echo app('translator')->get('expense.expense_note'); ?></th>
        <th class="col-md-2"><?php echo app('translator')->get('sale.total_amount'); ?></th>
        <th class="col-md-2"><?php echo app('translator')->get('sale.total_paid'); ?></th>
        <th class="col-md-2"><?php echo app('translator')->get('purchase.payment_due'); ?></th>
      </tr>
      <?php
        $total_amount = 0;
        $total_paid = 0;
        $total_due = 0;
      ?>
      <?php $__currentLoopData = $details['expense_details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td>
            <?php echo e($loop->iteration, false); ?>.
          </td>
          <td>
            <?php echo e($detail->ref_no, false); ?>

          </td>
          <td>
            <?php echo e($detail->expense_category, false); ?>

          </td>
          <td>
            <?php echo e($detail->expense_note, false); ?>

          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">
              <?php echo e($detail->final_total, false); ?>

            </span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">
              <?php echo e($detail->paid_total, false); ?>

            </span>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">
              <?php echo e($detail->final_total - $detail->paid_total, false); ?>

            </span>
          </td>
          <?php
            $total_amount += $detail->final_total;
            $total_paid += $detail->paid_total;
            $total_due += $detail->final_total - $detail->paid_total;
          ?>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <!-- Final details -->
      <tr class="success">
        <th colspan="3"></th>
        <th><span class="float-end"><?php echo app('translator')->get('sale.total'); ?>:</span></th>
        <th>
          <span class="display_currency" data-currency_symbol="true">
            <?php echo e($total_amount, false); ?>

          </span>
        </th>
        <th>
          <span class="display_currency" data-currency_symbol="true">
            <?php echo e($total_paid, false); ?>

          </span>
        </th>
        <th>
          <span class="display_currency" data-currency_symbol="true">
            <?php echo e($total_due, false); ?>

          </span>
        </th>
      </tr>

    </table>
  </div>
</div>
