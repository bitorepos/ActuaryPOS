<div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <?php echo app('translator')->get('lang_v1.dojo_terminals'); ?>
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <?php if(!empty($terminals) && count($terminals) > 0): ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('lang_v1.dojo_terminal_tid'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.status'); ?></th>
                            <th><?php echo app('translator')->get('lang_v1.dojo_terminal_id'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $terminals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $terminal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($terminal['properties']['tid'] ?? 'N/A', false); ?></td>
                                <td>
                                    <span class="badge bg-success"><?php echo e($terminal['status'] ?? 'N/A', false); ?></span>
                                </td>
                                <td>
                                    <a href="#" class="terminal-id-select" data-terminal-id="<?php echo e($terminal['id'], false); ?>">
                                        <?php echo e($terminal['id'], false); ?>

                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning">
                    <?php echo app('translator')->get('lang_v1.no_terminals_found'); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
        </div>
    </div>
</div>
