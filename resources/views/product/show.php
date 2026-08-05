<div class="row">
  <div class="col-md-10 col-md-offset-1 col-12">
    <div class="table-responsive">
      <table class="table table-condensed bg-gray">
        <tr>
          <th><?php echo app('translator')->get('business.location'); ?></th>
          <th><?php echo app('translator')->get('lang_v1.rack'); ?></th>
          <th><?php echo app('translator')->get('lang_v1.row'); ?></th>
          <th><?php echo app('translator')->get('lang_v1.position'); ?></th>
        </tr>
        <?php if(!empty($details[0])): ?>
          <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($detail->name, false); ?></td>
              <td>
                <?php echo e($detail->rack, false); ?>

              </td>
              <td>
                <?php echo e($detail->row, false); ?>

              </td>
              <td>
                <?php echo e($detail->position, false); ?>

              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="text-center">
              -
            </td>
          </tr>
        <?php endif; ?>
        
      </table>
    </div>
  </div>
</div>
