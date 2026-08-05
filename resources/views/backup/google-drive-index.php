
<?php $__env->startSection('title', __('lang_v1.backup')); ?>

<?php $__env->startSection('content'); ?>


<section class="content">
    <?php if(session('status')): ?>
        <div class="alert alert-<?php echo e(session('status.success') ? 'success' : 'danger', false); ?> alert-dismissible fade show" role="alert">
            <?php echo e(session('status.msg'), false); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

  <div class="row">
    <div class="col-sm-12">
      <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <h1 class="page-title"><?php echo e(__('lang_v1.backup'), false); ?></h1>

            <div class="card">
                <div class="card-header">
                    <h5>Google Drive Backup Integration</h5>
                </div>
                <div class="card-body">
                    <?php if($googleDriveEnabled): ?>
                        <div class="alert alert-success">
                            <i class="fa fa-check-circle"></i> <?php echo e(__('lang_v1.google_drive_connected'), false); ?>

                        </div>
                        
                        
                        <?php if($connectedAccount): ?>
                        <div class="card bg-light mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <?php if($connectedAccount['picture']): ?>
                                        <img src="<?php echo e($connectedAccount['picture'], false); ?>" 
                                             alt="<?php echo e($connectedAccount['name'], false); ?>" 
                                             class="rounded-circle mr-3" 
                                             style="width: 50px; height: 50px; object-fit: cover;">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center mr-3" 
                                             style="width: 50px; height: 50px;">
                                            <i class="fab fa-google text-white" style="font-size: 24px;"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <h6 class="mb-0"><?php echo e(__('lang_v1.connected_google_account'), false); ?></h6>
                                        <?php if($connectedAccount['name']): ?>
                                            <strong><?php echo e($connectedAccount['name'], false); ?></strong><br>
                                        <?php endif; ?>
                                        <?php if($connectedAccount['email']): ?>
                                            <span class="text-muted">
                                                <i class="fa fa-envelope"></i> <?php echo e($connectedAccount['email'], false); ?>

                                            </span>
                                        <?php endif; ?>
                                        <?php if($connectedAccount['connected_at']): ?>
                                            <br><small class="text-muted">
                                                <?php echo e(__('lang_v1.connected_since'), false); ?>: <?php echo e($connectedAccount['connected_at']->format('M d, Y'), false); ?>

                                            </small>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card text-center">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e(__('lang_v1.total_syncs'), false); ?></h5>
                                        <p class="card-text display-4"><?php echo e($stats['total_syncs'] ?? 0, false); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center border-success">
                                    <div class="card-body">
                                        <h5 class="card-title text-success"><?php echo e(__('lang_v1.completed'), false); ?></h5>
                                        <p class="card-text display-4 text-success"><?php echo e($stats['completed_syncs'] ?? 0, false); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center border-warning">
                                    <div class="card-body">
                                        <h5 class="card-title text-warning"><?php echo e(__('lang_v1.pending'), false); ?></h5>
                                        <p class="card-text display-4 text-warning"><?php echo e($stats['pending_syncs'] ?? 0, false); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-center border-danger">
                                    <div class="card-body">
                                        <h5 class="card-title text-danger"><?php echo e(__('lang_v1.failed'), false); ?></h5>
                                        <p class="card-text display-4 text-danger"><?php echo e($stats['failed_syncs'] ?? 0, false); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <form action="<?php echo e(route('backup.google-drive.disconnect'), false); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('<?php echo e(__('lang_v1.confirm_disconnect_google_drive'), false); ?>');">
                                    <i class="fa fa-unlink"></i> <?php echo e(__('lang_v1.disconnect_google_drive'), false); ?>

                                </button>
                            </form>
                            <button class="btn btn-info btn-sm" onclick="testGoogleDriveConnection()">
                                <i class="fa fa-plug"></i> <?php echo e(__('lang_v1.test_connection'), false); ?>

                            </button>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i> <?php echo e(__('lang_v1.google_drive_not_connected'), false); ?>

                        </div>
                        <p class="text-muted mb-3"><?php echo e(__('lang_v1.google_drive_connect_description'), false); ?></p>
                        <?php if(!empty($googleDriveConfig['client_id']) && !empty($googleDriveConfig['client_secret'])): ?>
                            <a href="<?php echo e(route('backup.google-drive.authorize'), false); ?>" class="btn btn-primary">
                                <i class="fab fa-google"></i> <?php echo e(__('lang_v1.connect_google_drive'), false); ?>

                            </a>
                        <?php else: ?>
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> <?php echo e(__('lang_v1.gdrive_configure_first'), false); ?>

                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            
            <?php if($canManageConfig): ?>
            <div class="card mt-3">
                <div class="card-header" data-toggle="collapse" data-target="#gdrive-config" style="cursor: pointer;">
                    <h5>
                        <i class="fa fa-cog"></i> <?php echo e(__('lang_v1.gdrive_api_configuration'), false); ?>

                        <span class="badge badge-warning"><?php echo e(__('lang_v1.admin_only'), false); ?></span>
                        <i class="fa fa-chevron-down float-right"></i>
                    </h5>
                </div>
                <div id="gdrive-config" class="collapse">
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i>
                            <strong><?php echo e(__('lang_v1.gdrive_config_warning_title'), false); ?></strong><br>
                            <?php echo e(__('lang_v1.gdrive_config_warning_desc'), false); ?>

                        </div>

                        <form action="<?php echo e(route('backup.google-drive.save-config'), false); ?>" method="POST" id="gdrive-config-form">
                            <?php echo csrf_field(); ?>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="google_drive_client_id">
                                            <?php echo e(__('lang_v1.gdrive_client_id'), false); ?> <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" 
                                               name="google_drive_client_id" 
                                               id="google_drive_client_id"
                                               class="form-control" 
                                               value="<?php echo e($googleDriveConfig['client_id'], false); ?>"
                                               placeholder="xxxxx.apps.googleusercontent.com">
                                        <small class="form-text text-muted"><?php echo e(__('lang_v1.gdrive_client_id_help'), false); ?></small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="google_drive_client_secret">
                                            <?php echo e(__('lang_v1.gdrive_client_secret'), false); ?> <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" 
                                                   name="google_drive_client_secret" 
                                                   id="google_drive_client_secret"
                                                   class="form-control" 
                                                   value="<?php echo e(!empty($googleDriveConfig['client_secret']) ? '********' : '', false); ?>"
                                                   placeholder="GOCSPX-xxxxxxxxxx">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary" onclick="toggleSecretVisibility()">
                                                    <i class="fa fa-eye" id="secret-toggle-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted"><?php echo e(__('lang_v1.gdrive_client_secret_help'), false); ?></small>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="google_drive_redirect_uri">
                                            <?php echo e(__('lang_v1.gdrive_redirect_uri'), false); ?>

                                        </label>
                                        <input type="text" 
                                               name="google_drive_redirect_uri" 
                                               id="google_drive_redirect_uri"
                                               class="form-control" 
                                               value="<?php echo e($googleDriveConfig['redirect_uri'], false); ?>"
                                               placeholder="/backup/google-drive/callback">
                                        <small class="form-text text-muted">
                                            <?php echo e(__('lang_v1.gdrive_redirect_uri_help'), false); ?><br>
                                            <code><?php echo e(route('backup.google-drive.callback'), false); ?></code>
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo e(__('lang_v1.gdrive_sync_options'), false); ?></label>
                                        <div class="form-check">
                                            <input type="hidden" name="google_drive_backup_sync_enabled" value="false">
                                            <input type="checkbox" 
                                                   name="google_drive_backup_sync_enabled" 
                                                   id="google_drive_backup_sync_enabled"
                                                   class="form-check-input" 
                                                   value="true"
                                                   <?php echo e($googleDriveConfig['backup_sync_enabled'] ? 'checked' : '', false); ?>>
                                            <label class="form-check-label" for="google_drive_backup_sync_enabled">
                                                <?php echo e(__('lang_v1.gdrive_enable_sync'), false); ?>

                                            </label>
                                        </div>
                                        <div class="form-check mt-2">
                                            <input type="hidden" name="google_drive_auto_sync_on_backup" value="false">
                                            <input type="checkbox" 
                                                   name="google_drive_auto_sync_on_backup" 
                                                   id="google_drive_auto_sync_on_backup"
                                                   class="form-check-input" 
                                                   value="true"
                                                   <?php echo e($googleDriveConfig['auto_sync_on_backup'] ? 'checked' : '', false); ?>>
                                            <label class="form-check-label" for="google_drive_auto_sync_on_backup">
                                                <?php echo e(__('lang_v1.gdrive_auto_sync'), false); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success" onclick="return confirmSaveConfig()">
                                    <i class="fa fa-save"></i> <?php echo e(__('lang_v1.save_config'), false); ?>

                                </button>
                                <button type="button" class="btn btn-secondary" onclick="resetConfigForm()">
                                    <i class="fa fa-undo"></i> <?php echo e(__('lang_v1.reset'), false); ?>

                                </button>
                            </div>
                        </form>

                        <hr>
                        <h6><i class="fa fa-info-circle text-info"></i> <?php echo e(__('lang_v1.gdrive_setup_instructions'), false); ?></h6>
                        <ol class="small">
                            <li><?php echo e(__('lang_v1.gdrive_setup_step1'), false); ?></li>
                            <li><?php echo e(__('lang_v1.gdrive_setup_step2'), false); ?></li>
                            <li><?php echo e(__('lang_v1.gdrive_setup_step3'), false); ?></li>
                            <li><?php echo e(__('lang_v1.gdrive_setup_step4'), false); ?></li>
                            <li><?php echo e(__('lang_v1.gdrive_setup_step5'), false); ?></li>
                        </ol>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Backup Files Card -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5>
                        Backup Files
                        <div class="float-right">
                            <a href="<?php echo e(route('backup.create'), false); ?>" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Create Backup
                            </a>
                        </div>
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>File Name</th>
                                <th>File Size</th>
                                <th>Last Modified</th>
                                <th>Google Drive Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $backups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $backup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($backup['file_name'], false); ?></td>
                                    <td><?php echo e(number_format($backup['file_size'] / 1024 / 1024, 2), false); ?> MB</td>
                                    <td><?php echo e(\Carbon\Carbon::createFromTimestamp($backup['last_modified'])->format('Y-m-d H:i:s'), false); ?></td>
                                    <td>
                                        <?php if($backup['google_drive_sync_status'] === 'completed'): ?>
                                            <span class="badge badge-success">Synced</span>
                                        <?php elseif($backup['google_drive_sync_status'] === 'syncing'): ?>
                                            <span class="badge badge-info">Syncing...</span>
                                        <?php elseif($backup['google_drive_sync_status'] === 'failed'): ?>
                                            <span class="badge badge-danger">Failed</span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary">Not Synced</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('backup.download', $backup['file_name']), false); ?>" class="btn btn-sm btn-info" title="Download">
                                            <i class="fa fa-download"></i>
                                        </a>
                                        
                                        <?php if($googleDriveEnabled && $backup['google_drive_sync_status'] !== 'completed'): ?>
                                            <a href="<?php echo e(route('backup.sync-to-google-drive', $backup['file_name']), false); ?>" class="btn btn-sm btn-warning" title="Sync to Google Drive">
                                                <i class="fab fa-google"></i> Sync
                                            </a>
                                        <?php endif; ?>
                                        
                                        <a href="<?php echo e(route('backup.delete', $backup['file_name']), false); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center">No backups found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Cron Job Instructions -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5>Scheduled Backup Commands</h5>
                </div>
                <div class="card-body">
                    <p>Add the following to your crontab to enable automatic backups:</p>
                    <div class="form-group">
                        <label>Backup Schedule</label>
                        <input type="text" class="form-control" value="<?php echo e($cron_job_command, false); ?>" readonly>
                    </div>
                    <p>To also sync backups to Google Drive, add:</p>
                    <div class="form-group">
                        <label>Google Drive Sync Schedule (runs 15 min after backup)</label>
                        <input type="text" class="form-control" value="*/15 * * * * cd <?php echo e(base_path(), false); ?> && php artisan backup:sync-to-google-drive" readonly>
                    </div>
                </div>
            </div>

            
            <div class="card mt-3">
                <div class="card-header" data-toggle="collapse" data-target="#gdrive-guide" style="cursor: pointer;">
                    <h5>
                        <i class="fa fa-question-circle text-info"></i> 
                        <?php echo app('translator')->get('lang_v1.google_drive_connect_guide'); ?>
                        <i class="fa fa-chevron-down float-right"></i>
                    </h5>
                </div>
                <div id="gdrive-guide" class="collapse show">
                    <div class="card-body">
                        
                        <div class="alert alert-info">
                            <h5><i class="fa fa-plug"></i> <?php echo app('translator')->get('lang_v1.how_to_connect_google_drive'); ?></h5>
                            <ol class="mb-0">
                                <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step1_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step1_desc'); ?></li>
                                <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step2_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step2_desc'); ?></li>
                                <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step3_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step3_desc'); ?></li>
                                <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step4_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step4_desc'); ?></li>
                                <li><strong><?php echo app('translator')->get('lang_v1.gdrive_step5_title'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_step5_desc'); ?></li>
                            </ol>
                        </div>

                        
                        <div class="alert alert-warning">
                            <h5><i class="fa fa-shield"></i> <?php echo app('translator')->get('lang_v1.required_permissions'); ?></h5>
                            <p><?php echo app('translator')->get('lang_v1.gdrive_permissions_intro'); ?></p>
                            <ul class="mb-2">
                                <li><strong><?php echo app('translator')->get('lang_v1.gdrive_perm_file'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_perm_file_desc'); ?></li>
                                <li><strong><?php echo app('translator')->get('lang_v1.gdrive_perm_metadata'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_perm_metadata_desc'); ?></li>
                                <li><strong><?php echo app('translator')->get('lang_v1.gdrive_perm_email'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_perm_email_desc'); ?></li>
                                <li><strong><?php echo app('translator')->get('lang_v1.gdrive_perm_profile'); ?>:</strong> <?php echo app('translator')->get('lang_v1.gdrive_perm_profile_desc'); ?></li>
                            </ul>
                            <small><i class="fa fa-info-circle"></i> <?php echo app('translator')->get('lang_v1.gdrive_permissions_note'); ?></small>
                        </div>

                        
                        <div class="alert alert-success">
                            <h5><i class="fa fa-check-circle"></i> <?php echo app('translator')->get('lang_v1.verify_connected_account'); ?></h5>
                            <p><?php echo app('translator')->get('lang_v1.gdrive_verify_intro'); ?></p>
                            <ul class="mb-2">
                                <li><i class="fa fa-user text-primary"></i> <?php echo app('translator')->get('lang_v1.gdrive_verify_profile'); ?></li>
                                <li><i class="fa fa-envelope text-primary"></i> <?php echo app('translator')->get('lang_v1.gdrive_verify_email'); ?></li>
                                <li><i class="fa fa-calendar text-primary"></i> <?php echo app('translator')->get('lang_v1.gdrive_verify_date'); ?></li>
                                <li><i class="fa fa-folder text-primary"></i> <?php echo app('translator')->get('lang_v1.gdrive_verify_folder'); ?></li>
                            </ul>
                            <small><?php echo app('translator')->get('lang_v1.gdrive_verify_test'); ?></small>
                        </div>

                        
                        <div class="alert alert-danger">
                            <h5><i class="fa fa-wrench"></i> <?php echo app('translator')->get('lang_v1.troubleshooting'); ?></h5>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered mb-2">
                                    <thead class="thead-light">
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
                            <small><i class="fa fa-exclamation-triangle"></i> <?php echo app('translator')->get('lang_v1.gdrive_troubleshoot_contact'); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->renderComponent(); ?>
    </div>
</section>

<script>
function testGoogleDriveConnection() {
    axios.post('<?php echo e(route("backup.google-drive.test"), false); ?>')
        .then(response => {
            if(response.data.success) {
                alert('Connection successful!');
            } else {
                alert('Connection failed: ' + response.data.message);
            }
        })
        .catch(error => {
            alert('Error testing connection: ' + error.response.data.message);
        });
}

// Toggle password visibility for client secret
function toggleSecretVisibility() {
    var secretInput = document.getElementById('google_drive_client_secret');
    var toggleIcon = document.getElementById('secret-toggle-icon');
    
    if (secretInput.type === 'password') {
        secretInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        secretInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Confirm before saving config
function confirmSaveConfig() {
    return confirm('<?php echo e(__("lang_v1.gdrive_confirm_save_config"), false); ?>');
}

// Reset form to original values
function resetConfigForm() {
    if (confirm('<?php echo e(__("lang_v1.gdrive_confirm_reset_form"), false); ?>')) {
        document.getElementById('gdrive-config-form').reset();
    }
}

// Clear secret field when user starts typing (to replace masked value)
document.addEventListener('DOMContentLoaded', function() {
    var secretInput = document.getElementById('google_drive_client_secret');
    if (secretInput) {
        var originalValue = secretInput.value;
        secretInput.addEventListener('focus', function() {
            if (this.value === '********' || /^\*+$/.test(this.value)) {
                this.value = '';
                this.type = 'text'; // Show text while entering new value
            }
        });
        secretInput.addEventListener('blur', function() {
            if (this.value === '' && originalValue) {
                this.value = '********';
                this.type = 'password';
            }
        });
    }
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>