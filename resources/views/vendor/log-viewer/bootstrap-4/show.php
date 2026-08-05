<?php
/**
 * @var  Arcanedev\LogViewer\Entities\Log            $log
 * @var  Illuminate\Pagination\LengthAwarePaginator  $entries
 * @var  string|null                                 $query
 */
?>



<?php $__env->startSection('content'); ?>
    <div class="page-header mb-4">
        <h1>Log [<?php echo e($log->date, false); ?>]</h1>
    </div>

    <div class="row">
        <div class="col-lg-2">
            
            <div class="card mb-4">
                <div class="card-header"><i class="fa fa-fw fa-flag"></i> Levels</div>
                <div class="list-group list-group-flush log-menu">
                    <?php $__currentLoopData = $log->menu(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $levelKey => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item['count'] === 0): ?>
                            <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                                <span class="level-name"><?php echo $item['icon']; ?> <?php echo e($item['name'], false); ?></span>
                                <span class="badge empty"><?php echo e($item['count'], false); ?></span>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e($item['url'], false); ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center level-<?php echo e($levelKey, false); ?><?php echo e($level === $levelKey ? ' active' : '', false); ?>">
                                <span class="level-name"><?php echo $item['icon']; ?> <?php echo e($item['name'], false); ?></span>
                                <span class="badge badge-level-<?php echo e($levelKey, false); ?>"><?php echo e($item['count'], false); ?></span>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            
            <div class="card mb-4">
                <div class="card-header">
                    Log info :
                    <div class="group-btns float-end">
                        <a href="<?php echo e(route('log-viewer::logs.download', [$log->date]), false); ?>" class="btn btn-sm btn-success">
                            <i class="fa fa-download"></i> DOWNLOAD
                        </a>
                        <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-bs-toggle="modal">
                            <i class="fa fa-trash-o"></i> DELETE
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-condensed mb-0">
                        <tbody>
                            <tr>
                                <td>File path :</td>
                                <td colspan="7"><?php echo e($log->getPath(), false); ?></td>
                            </tr>
                            <tr>
                                <td>Log entries : </td>
                                <td>
                                    <span class="badge badge-primary"><?php echo e($entries->total(), false); ?></span>
                                </td>
                                <td>Size :</td>
                                <td>
                                    <span class="badge badge-primary"><?php echo e($log->size(), false); ?></span>
                                </td>
                                <td>Created at :</td>
                                <td>
                                    <span class="badge badge-primary"><?php echo e($log->createdAt(), false); ?></span>
                                </td>
                                <td>Updated at :</td>
                                <td>
                                    <span class="badge badge-primary"><?php echo e($log->updatedAt(), false); ?></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    
                    <form action="<?php echo e(route('log-viewer::logs.search', [$log->date, $level]), false); ?>" method="GET">
                        <div class=form-group">
                            <div class="input-group">
                                <input id="query" name="query" class="form-control"  value="<?php echo $query; ?>" placeholder="Type here to search">
                                <div class="input-group-append">
                                    <?php if (! (is_null($query))): ?>
                                        <a href="<?php echo e(route('log-viewer::logs.show', [$log->date]), false); ?>" class="btn btn-secondary">
                                            (<?php echo e($entries->count(), false); ?> results) <i class="fa fa-fw fa-times"></i>
                                        </a>
                                    <?php endif; ?>
                                    <button id="search-btn" class="btn btn-primary">
                                        <span class="fa fa-fw fa-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            
            <div class="card mb-4">
                <?php if($entries->hasPages()): ?>
                    <div class="card-header">
                        <span class="badge badge-info float-right">
                            Page <?php echo e($entries->currentPage(), false); ?> of <?php echo e($entries->lastPage(), false); ?>

                        </span>
                    </div>
                <?php endif; ?>

                <div class="table-responsive">
                    <table id="entries" class="table mb-0">
                        <thead>
                            <tr>
                                <th>ENV</th>
                                <th style="width: 120px;">Level</th>
                                <th style="width: 65px;">Time</th>
                                <th>Header</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_18 = true; $__currentLoopData = $entries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $entry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_18 = false; ?>
                                <?php /** @var  Arcanedev\LogViewer\Entities\LogEntry  $entry */ ?>
                                <tr>
                                    <td>
                                        <span class="badge badge-env"><?php echo e($entry->env, false); ?></span>
                                    </td>
                                    <td>
                                        <span class="badge badge-level-<?php echo e($entry->level, false); ?>">
                                            <?php echo $entry->level(); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge badge-secondary">
                                            <?php echo e($entry->datetime->format('H:i:s'), false); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <?php echo e($entry->header, false); ?>

                                    </td>
                                    <td class="text-right">
                                        <?php if($entry->hasStack()): ?>
                                            <a class="btn btn-sm btn-light" role="button" data-bs-toggle="collapse" href="#log-stack-<?php echo e($key, false); ?>" aria-expanded="false" aria-controls="log-stack-<?php echo e($key, false); ?>">
                                                <i class="fa fa-toggle-on"></i> Stack
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php if($entry->hasStack()): ?>
                                    <tr>
                                        <td colspan="5" class="stack py-0">
                                            <div class="stack-content collapse" id="log-stack-<?php echo e($key, false); ?>">
                                                <?php echo $entry->stack(); ?>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_18): ?>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <span class="badge badge-secondary"><?php echo e(trans('log-viewer::general.empty-logs'), false); ?></span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php echo $entries->appends(compact('query'))->render(); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modals'); ?>
    
    <div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="delete-log-form" action="<?php echo e(route('log-viewer::logs.delete'), false); ?>" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="<?php echo e(csrf_token(), false); ?>">
                <input type="hidden" name="date" value="<?php echo e($log->date, false); ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">DELETE LOG FILE</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to <span class="badge badge-danger">DELETE</span> this log file <span class="badge badge-primary"><?php echo e($log->date, false); ?></span> ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary mr-auto" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger" data-loading-text="Loading&hellip;">DELETE FILE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("<?php echo e(route('log-viewer::logs.list'), false); ?>");
                        }
                        else {
                            alert('OOPS ! This is a lack of coffee exception !')
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            <?php if (! (empty(log_styler()->toHighlight()))): ?>
            $('.stack-content').each(function() {
                var $this = $(this);
                var html = $this.html().trim()
                    .replace(/(<?php echo join(log_styler()->toHighlight(), '|'); ?>)/gm, '<strong>$1</strong>');

                $this.html(html);
            });
            <?php endif; ?>
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('log-viewer::bootstrap-4._master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>