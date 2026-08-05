
<?php $__env->startSection('title', __('lang_v1.backup')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.backup'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    
  <?php if(session('notification') || !empty($notification)): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-bs-dismiss="alert" aria-hidden="true">×</button>
                <?php if(!empty($notification['msg'])): ?>
                    <?php echo e($notification['msg'], false); ?>

                <?php elseif(session('notification.msg')): ?>
                    <?php echo e(session('notification.msg'), false); ?>

                <?php endif; ?>
              </div>
          </div>  
      </div>     
  <?php endif; ?>

  <div class="row">
    <div class="col-sm-12">
      <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php $__env->slot('header'); ?>
          <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
            <h4 class="mb-0 d-flex align-items-center gap-2">
              <i class="fa fa-clock"></i> <?php echo app('translator')->get('lang_v1.auto_backup_time'); ?>:
              <span class="badge bg-success" style="font-size: 14px;"><?php echo e($backup_time ?? '03:55', false); ?></span>
            </h4>
            <div class="d-flex gap-2 flex-wrap justify-content-end">
                <?php if(config('constants.is_offline')): ?>
                    <button type="button" id="sync-backups-btn" class="btn btn-success" data-url="<?php echo e(route('backup.sync-backups-to-google-drive'), false); ?>">
                        <i class="fab fa-google-drive"></i> Sync to Google Drive
                    </button>
                <?php endif; ?>
                <a id="create-new-backup-button" href="<?php echo e(url('backup/create'), false); ?>" class="btn btn-primary"><i
                            class="fa fa-plus"></i> <?php echo app('translator')->get('lang_v1.create_new_backup'); ?>
                </a>
            </div>
          </div>
        <?php $__env->endSlot(); ?>
        <?php if(count($backups)): ?>
                <table class="table table-striped table-bordered">
                  <thead>
                  <tr>
                      <th><?php echo app('translator')->get('lang_v1.file'); ?></th>
                      <th><?php echo app('translator')->get('lang_v1.size'); ?></th>
                      <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                      <th><?php echo app('translator')->get('lang_v1.age'); ?></th>
                      <th>Deletion Time</th>
                      <?php if(env('ENABLE_GD_BACKUP') == 'true'): ?>
                      <th>Sync Status</th>
                      <?php endif; ?>
                      <th><?php echo app('translator')->get('messages.actions'); ?></th>
                  </tr>
                  </thead>
                    <tbody>
                    <?php $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($backup['file_name'], false); ?></td>
                            <td><?php echo e(humanFilesize($backup['file_size']), false); ?></td>
                            <td>
                                <?php echo e($backup['backup_created_at']->toDateTimeString(), false); ?>

                            </td>
                            <td>
                                <?php echo e($backup['backup_created_at']->diffForHumans(Carbon::now()), false); ?>

                            </td>
                            <td>
                                <?php echo e($backup['deletion_at']->toDateTimeString(), false); ?>

                                <br>
                                <small class="<?php echo e($backup['deletion_at']->isPast() ? 'text-danger' : 'text-muted', false); ?>">
                                    <?php echo e($backup['deletion_at']->isPast() ? 'Due now' : $backup['deletion_at']->diffForHumans(), false); ?>

                                </small>
                            </td>
                            <?php if(env('ENABLE_GD_BACKUP') == 'true'): ?>
                            <td>
                                <?php if($backup['rsync_synced']): ?>
                                    <span class="badge bg-success"><i class="fa fa-check"></i> Synced to Cloud</span>
                                <?php else: ?>
                                    <span class="badge bg-warning"><i class="fa fa-clock"></i> Sync Pending</span>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>
                            <td>
                              <a class="btn btn-sm btn-success"
                                   href="<?php echo e(action([\App\Http\Controllers\BackUpController::class, 'download'], [$backup['file_name']]), false); ?>"><i
                                        class="fa fa-cloud-download"></i> <?php echo app('translator')->get('lang_v1.download'); ?></a>
                                <a class="btn btn-sm btn-danger link_confirmation" data-button-type="delete"
                                   href="<?php echo e(action([\App\Http\Controllers\BackUpController::class, 'delete'], [$backup['file_name']]), false); ?>"><i class="fa fa-trash-o"></i>
                                    <?php echo app('translator')->get('messages.delete'); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
              </table>
            <?php else: ?>
                <div class="p-3 border rounded bg-light">
                    <h4>There are no backups</h4>
                </div>
            <?php endif; ?>
            <br>
            <?php if($is_offline): ?>
            <strong><?php echo app('translator')->get('lang_v1.auto_backup_instruction'); ?>:</strong><br>
            <code><?php echo e($cron_job_command, false); ?></code> <br>
            <strong><?php echo app('translator')->get('lang_v1.backup_clean_command_instruction'); ?>:</strong><br>
            <code><?php echo e($backup_clean_cron_job_command, false); ?></code>
            <br><small class="text-muted">Backup files are automatically deleted after <?php echo e($backupRetentionHours, false); ?> hours.</small>
            <?php endif; ?>
      <?php echo $__env->renderComponent(); ?>
    </div>
  </div>

  <?php
    $googleDriveBackupSyncEnabled = filter_var(config('google-drive.backup_sync.enabled'), FILTER_VALIDATE_BOOLEAN);
    $rcloneGoogleDriveBackupEnabled = filter_var(config('constants.enable_gd_backup'), FILTER_VALIDATE_BOOLEAN);
    $googleDriveIntegrationConfigured = $googleDriveBackupSyncEnabled || $rcloneGoogleDriveBackupEnabled;
    $googleDriveIntegrationConnected = $googleDriveEnabled || $rcloneGoogleDriveBackupEnabled;
  ?>

  <div class="row">
    <div class="col-sm-12">
      <?php $__env->startComponent('components.widget', [
        'class' => 'box-info',
        'title' => __('lang_v1.google_drive'),
        'icon' => '<i class="fab fa-google-drive text-success"></i> ',
        'collapsible' => true,
        'collapsed' => true
      ]); ?>
        <?php $__env->slot('tool'); ?>
          <div class="d-flex align-items-center gap-2 flex-wrap justify-content-end">
            <?php if(!$googleDriveIntegrationConfigured): ?>
              <span class="badge bg-secondary">
                <i class="fa fa-info-circle"></i> <?php echo app('translator')->get('lang_v1.google_drive_not_configured'); ?>
              </span>
            <?php elseif($googleDriveIntegrationConnected): ?>
              <span class="badge bg-success">
                <i class="fa fa-check-circle"></i> <?php echo app('translator')->get('lang_v1.google_drive_connected'); ?>
              </span>
            <?php else: ?>
              <span class="badge bg-warning text-dark">
                <i class="fa fa-exclamation-triangle"></i> <?php echo app('translator')->get('lang_v1.google_drive_not_connected'); ?>
              </span>
            <?php endif; ?>
            <a href="<?php echo e(route('backup.google-drive.index'), false); ?>" class="btn btn-sm btn-primary">
              <i class="fa fa-cog"></i> <?php echo app('translator')->get('lang_v1.google_drive_settings'); ?>
            </a>
          </div>
        <?php $__env->endSlot(); ?>

        <div class="row">
          <div class="col-md-12">
            <?php if(!$googleDriveIntegrationConfigured): ?>
              <p class="text-muted">
                <i class="fa fa-info-circle"></i> <?php echo app('translator')->get('lang_v1.google_drive_not_configured'); ?>
              </p>
            <?php elseif($googleDriveIntegrationConnected): ?>
              <p class="text-success">
                <i class="fa fa-check-circle"></i> <?php echo app('translator')->get('lang_v1.google_drive_connected'); ?>
                <?php if(!empty($connectedAccount['email'])): ?>
                  - <strong><?php echo e($connectedAccount['email'], false); ?></strong>
                <?php endif; ?>
              </p>
            <?php else: ?>
              <p class="text-warning">
                <i class="fa fa-exclamation-triangle"></i> <?php echo app('translator')->get('lang_v1.google_drive_not_connected'); ?>
              </p>
            <?php endif; ?>
          </div>
        </div>

        <div class="panel panel-info">
          <div class="panel-heading">
            <h4 class="panel-title">
              <i class="fa fa-plug"></i> <?php echo app('translator')->get('lang_v1.how_to_connect_google_drive'); ?>
            </h4>
          </div>
          <div class="panel-body">
            <ol>
              <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step1_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step1_desc'); ?></li>
              <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step2_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step2_desc'); ?></li>
              <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step3_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step3_desc'); ?></li>
              <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step4_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step4_desc'); ?></li>
              <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step5_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step5_desc'); ?></li>
            </ol>
          </div>
        </div>

        <div class="panel panel-warning">
          <div class="panel-heading">
            <h4 class="panel-title">
              <i class="fa fa-shield"></i> <?php echo app('translator')->get('lang_v1.required_permissions'); ?>
            </h4>
          </div>
          <div class="panel-body">
            <p><?php echo app('translator')->get('lang_v1.gdrive_permissions_intro'); ?></p>
            <ul>
              <li><strong><?php echo app('translator')->get('lang_v1.gdrive_perm_file'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_perm_file_desc'); ?></li>
              <li><strong><?php echo app('translator')->get('lang_v1.gdrive_perm_metadata'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_perm_metadata_desc'); ?></li>
              <li><strong><?php echo app('translator')->get('lang_v1.gdrive_perm_email'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_perm_email_desc'); ?></li>
              <li><strong><?php echo app('translator')->get('lang_v1.gdrive_perm_profile'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_perm_profile_desc'); ?></li>
            </ul>
            <div class="alert alert-info">
              <i class="fa fa-info-circle"></i> <?php echo app('translator')->get('lang_v1.gdrive_permissions_note'); ?>
            </div>
          </div>
        </div>

        <div class="panel panel-success">
          <div class="panel-heading">
            <h4 class="panel-title">
              <i class="fa fa-check-circle"></i> <?php echo app('translator')->get('lang_v1.verify_connected_account'); ?>
            </h4>
          </div>
          <div class="panel-body">
            <p><?php echo app('translator')->get('lang_v1.gdrive_verify_intro'); ?></p>
            <ul>
              <li><i class="fa fa-user text-primary"></i> <?php echo app('translator')->get('lang_v1.gdrive_verify_profile'); ?></li>
              <li><i class="fa fa-envelope text-primary"></i> <?php echo app('translator')->get('lang_v1.gdrive_verify_email'); ?></li>
              <li><i class="fa fa-calendar text-primary"></i> <?php echo app('translator')->get('lang_v1.gdrive_verify_date'); ?></li>
              <li><i class="fa fa-folder text-primary"></i> <?php echo app('translator')->get('lang_v1.gdrive_verify_folder'); ?></li>
            </ul>
            <p><?php echo app('translator')->get('lang_v1.gdrive_verify_test'); ?></p>
          </div>
        </div>

        <div class="panel panel-danger">
          <div class="panel-heading">
            <h4 class="panel-title">
              <i class="fa fa-wrench"></i> <?php echo app('translator')->get('lang_v1.troubleshooting'); ?>
            </h4>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="35%"><?php echo app('translator')->get('lang_v1.issue'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.solution'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><strong><?php echo app('translator')->get('lang_v1.gdrive_issue_not_configured'); ?></strong></td>
                    <td><?php echo app('translator')->get('lang_v1.gdrive_solution_not_configured'); ?></td>
                  </tr>
                  <tr>
                    <td><strong><?php echo app('translator')->get('lang_v1.gdrive_issue_auth_failed'); ?></strong></td>
                    <td><?php echo app('translator')->get('lang_v1.gdrive_solution_auth_failed'); ?></td>
                  </tr>
                  <tr>
                    <td><strong><?php echo app('translator')->get('lang_v1.gdrive_issue_access_denied'); ?></strong></td>
                    <td><?php echo app('translator')->get('lang_v1.gdrive_solution_access_denied'); ?></td>
                  </tr>
                  <tr>
                    <td><strong><?php echo app('translator')->get('lang_v1.gdrive_issue_token_expired'); ?></strong></td>
                    <td><?php echo app('translator')->get('lang_v1.gdrive_solution_token_expired'); ?></td>
                  </tr>
                  <tr>
                    <td><strong><?php echo app('translator')->get('lang_v1.gdrive_issue_sync_failed'); ?></strong></td>
                    <td><?php echo app('translator')->get('lang_v1.gdrive_solution_sync_failed'); ?></td>
                  </tr>
                  <tr>
                    <td><strong><?php echo app('translator')->get('lang_v1.gdrive_issue_wrong_account'); ?></strong></td>
                    <td><?php echo app('translator')->get('lang_v1.gdrive_solution_wrong_account'); ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="alert alert-warning">
              <i class="fa fa-exclamation-triangle"></i> <?php echo app('translator')->get('lang_v1.gdrive_troubleshoot_contact'); ?>
            </div>
          </div>
        </div>
      <?php echo $__env->renderComponent(); ?>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script type="text/javascript">
$(document).ready(function() {
    $('#sync-backups-btn').click(function(e) {
        e.preventDefault();
        var btn = $(this);
        var originalHtml = btn.html();
        
        btn.html('<i class="fas fa-spinner fa-spin"></i> Syncing...');
        btn.prop('disabled', true);
        
        $.ajax({
            url: btn.data('url'),
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                if (result.success) {
                    toastr.success(result.msg);
                    setTimeout(function(){
                        location.reload();
                    }, 1500);
                } else {
                    toastr.error(result.msg);
                    btn.html(originalHtml);
                    btn.prop('disabled', false);
                }
            },
            error: function(err) {
                toastr.error('Something went wrong.');
                btn.html(originalHtml);
                btn.prop('disabled', false);
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>