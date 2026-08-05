<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">
                <?php echo $document_note->heading; ?>

            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <?php echo $document_note->description; ?>

                    <?php if($document_note->expiry_date): ?>
                        <?php echo app('translator')->get('lang_v1.expiry_date'); ?> : <?php echo e(\Carbon::createFromTimestamp(strtotime($document_note->expiry_date))->format(session('business.date_format')), false); ?>

                    <?php endif; ?>
                </div>
            </div>
            <?php if(($document_note->media)->count() > 0): ?>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h4><?php echo app('translator')->get('lang_v1.documents'); ?></h4>
                        
                        <?php $__currentLoopData = $document_note->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6 mb-5">
                                <?php
                                    $ext = strtolower(pathinfo($media->display_name, PATHINFO_EXTENSION));
                                    $isImage = in_array($ext, ['jpg','jpeg','png','gif','webp','bmp','svg']);
                                ?>

                                <?php if($isImage): ?>
                                    <img src="<?php echo e($media->display_url, false); ?>" width="100%" class="mb-2"><br>
                                <?php endif; ?>

                                <a href="<?php echo e($media->display_url, false); ?>" download="<?php echo e($media->display_name, false); ?>">
                                    <i class="fa fa-download"></i> <?php echo e($media->display_name, false); ?>

                                </a>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="modal-footer">
            <span class="float-start">
                <i class="fas fa-pencil-alt"></i>
                <?php echo e($document_note->createdBy->user_full_name, false); ?>

                &nbsp;
                <i class="fa fa-calendar-check-o"></i>
                <?php echo e(\Carbon::createFromTimestamp(strtotime($document_note->created_at))->format(session('business.date_format')), false); ?>

            </span>
            <button type="button" class="btn btn-default btn-sm" data-bs-dismiss="modal">
                <?php echo app('translator')->get('messages.close'); ?>
            </button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
