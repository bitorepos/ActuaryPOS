<div class="modal-dialog" role="document">
  <div class="modal-content">

    <div class="modal-header">
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title"><?php echo app('translator')->get( 'lang_v1.uom_for_hscode' ); ?> : <?php echo e($hs_code, false); ?></h4>
    </div>

    <div class="modal-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>UoM ID</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>
              <?php $__currentLoopData = $uom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($u['uoM_ID'], false); ?></td>
                    <td><?php echo e($u['description'], false); ?></td>
                  </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
          </table>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
    </div>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
