<div class="row">
  <div class="col-md-12">
    <hr>
    <h3><?php echo app('translator')->get('lang_v1.purchase_summary'); ?></h3>
    <table class="table table-condensed">
      <tr>
        <th class="col-md-1">#</th>
        <th class="col-md-3"><?php echo app('translator')->get('lang_v1.date'); ?></th>
        <th class="col-md-2"><?php echo app('translator')->get('purchase.ref_no_short'); ?></th>
        <th><?php echo app('translator')->get('purchase.supplier'); ?></th>
        <th><?php echo app('translator')->get('sale.total_amount'); ?></th>
        <th><?php echo app('translator')->get('sale.total_paid'); ?></th>
        <th><?php echo app('translator')->get('purchase.payment_due'); ?></th>
      </tr>
      <?php
        $total_amount = 0;
        $total_paid = 0;
        $total_due = 0;
      ?>
      <?php $__currentLoopData = $details['purchase_details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td>
            <?php echo e($loop->iteration, false); ?>.
          </td>
          <td>
            <?php echo format_datetime_br($detail->transaction_date); ?>

          </td>
          <td>
            <?php echo e($detail->ref_no, false); ?>

          </td>
          <td>
            <?php echo e(ucwords($detail->supplier), false); ?>

          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">
              <?php echo e($detail->final_total, false); ?>

            </span>
            <?php echo Form::hidden('extra_details[purchase_details]['.$loop->iteration.'][transaction_date]', $detail->transaction_date); ?>

            <?php echo Form::hidden('extra_details[purchase_details]['.$loop->iteration.'][ref_no]', $detail->ref_no); ?>

            <?php echo Form::hidden('extra_details[purchase_details]['.$loop->iteration.'][supplier]', $detail->supplier); ?>

            <?php echo Form::hidden('extra_details[purchase_details]['.$loop->iteration.'][final_total]', $detail->final_total); ?>

            <?php echo Form::hidden('extra_details[purchase_details]['.$loop->iteration.'][paid_total]', $detail->paid_total); ?>

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
        </tr>
        <?php
            $total_amount += $detail->final_total;
            $total_paid += $detail->paid_total;
            $total_due += $detail->final_total - $detail->paid_total;
        ?>
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
