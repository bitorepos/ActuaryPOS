<div class="row">
  <div class="col-md-12">
    <hr>
    <h3><?php echo app('translator')->get('lang_v1.pending'); ?> <?php echo app('translator')->get('lang_v1.list_drafts'); ?></h3>
    <table class="table table-condensed">
      <tr>
        <th style="width: 5%">#</th>
        <th style="width: 15%"><?php echo app('translator')->get('lang_v1.date'); ?></th>
        <th style="width: 12%"><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
        <th style="width: 12%"><?php echo app('translator')->get('purchase.ref_no'); ?></th>
        <th style="width: 25%"><?php echo app('translator')->get('lang_v1.status'); ?></th>
        <th style="width: 12%"><?php echo app('translator')->get('sale.total'); ?></th>
      </tr>
      <?php
          $drafts_footer_total = 0;
      ?>
      <?php $__currentLoopData = $details['draft_details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td>
            <?php echo e($loop->iteration, false); ?>.
          </td>
          <td>
            <?php echo format_datetime_br($detail->transaction_date); ?>

          </td>
          <td>
            <?php echo e($detail->added_by, false); ?>

          </td>
          <td>
            <?php echo e($detail->invoice_no, false); ?>

          </td>
          <td>
            <?php echo e(ucwords($detail->draft_status), false); ?>

          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">
              <?php echo e($detail->final_total, false); ?>

            </span>
            <?php echo Form::hidden('extra_details[draft_details]['.$loop->iteration.'][transaction_date]', $detail->transaction_date); ?>

            <?php echo Form::hidden('extra_details[draft_details]['.$loop->iteration.'][invoice_no]', $detail->invoice_no); ?>

            <?php echo Form::hidden('extra_details[draft_details]['.$loop->iteration.'][added_by]', $detail->added_by); ?>

            <?php echo Form::hidden('extra_details[draft_details]['.$loop->iteration.'][draft_status]', $detail->draft_status); ?>

            <?php echo Form::hidden('extra_details[draft_details]['.$loop->iteration.'][final_total]', $detail->final_total); ?>

          </td>
        </tr>
        <?php
          $drafts_footer_total += $detail->final_total;
        ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <!-- Final details -->
      <tr class="success">
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th><span class="float-end"><?php echo app('translator')->get('sale.total'); ?>:</span></th>
        <th>
          <span class="display_currency" data-currency_symbol="true">
            <?php echo e($drafts_footer_total, false); ?>

          </span>
        </th>
      </tr>
    </table>
  </div>
</div>

<?php if($tables_enabled): ?>
<div class="row">
  <div class="col-md-12">
    <hr>
    <h3><?php echo app('translator')->get('lang_v1.pending'); ?> <?php echo app('translator')->get('lang_v1.table_orders'); ?></h3>
    <table class="table table-condensed">
      <tr>
        <th style="width: 5%">#</th>
        <th style="width: 15%"><?php echo app('translator')->get('lang_v1.date'); ?></th>
        <th style="width: 12%"><?php echo app('translator')->get('lang_v1.added_by'); ?></th>
        <th style="width: 12%"><?php echo app('translator')->get('purchase.ref_no'); ?></th>
        <th style="width: 25%"><?php echo app('translator')->get('lang_v1.status'); ?></th>
        <th style="width: 12%"><?php echo app('translator')->get('sale.total'); ?></th>
      </tr>
      <?php
          $tables_footer_total = 0;
      ?>
      <?php $__currentLoopData = $details['table_order_details']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td>
            <?php echo e($loop->iteration, false); ?>.
          </td>
          <td>
            <?php echo format_datetime_br($detail->transaction_date); ?>

          </td>
          <td>
            <?php echo e($detail->added_by, false); ?>

          </td>
          <td>
            <?php echo e($detail->invoice_no, false); ?>

          </td>
          <td>
            <?php echo e(ucwords($detail->draft_status), false); ?><br>
            <small>(<?php echo e($detail->table_name .' - '. ucwords(str_replace('_', ' ', $detail->sub_status)), false); ?>)</small>
          </td>
          <td>
            <span class="display_currency" data-currency_symbol="true">
              <?php echo e($detail->final_total, false); ?>

            </span>
            <?php echo Form::hidden('extra_details[table_order_details]['.$loop->iteration.'][transaction_date]', $detail->transaction_date); ?>

            <?php echo Form::hidden('extra_details[table_order_details]['.$loop->iteration.'][invoice_no]', $detail->invoice_no); ?>

            <?php echo Form::hidden('extra_details[table_order_details]['.$loop->iteration.'][added_by]', $detail->added_by); ?>

            <?php echo Form::hidden('extra_details[table_order_details]['.$loop->iteration.'][draft_status]', $detail->draft_status); ?>

            <?php echo Form::hidden('extra_details[table_order_details]['.$loop->iteration.'][sub_status]', $detail->sub_status); ?>

            <?php echo Form::hidden('extra_details[table_order_details]['.$loop->iteration.'][final_total]', $detail->final_total); ?>

            <?php echo Form::hidden('extra_details[table_order_details]['.$loop->iteration.'][table_name]', $detail->table_name); ?>

          </td>

          <?php
            $tables_footer_total += $detail->final_total;
          ?>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <!-- Final details -->
      <tr class="success">
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th><span class="float-end"><?php echo app('translator')->get('sale.total'); ?>:</span></th>
        <th>
          <span class="display_currency" data-currency_symbol="true">
            <?php echo e($tables_footer_total, false); ?>

          </span>
        </th>
      </tr>
    </table>
  </div>
</div>
<?php endif; ?>
