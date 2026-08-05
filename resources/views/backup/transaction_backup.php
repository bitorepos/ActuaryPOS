
<?php $__env->startSection('title', __('lang_v1.transaction_backup')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fas fa-exchange-alt"></i> <?php echo app('translator')->get('lang_v1.transaction_backup'); ?></h1>
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
      <?php $__env->startComponent('components.widget', ['class' => 'box-success']); ?>
        <?php $__env->slot('title'); ?>
          <i class="fas fa-exchange-alt"></i> Local Transaction Backup & Import
        <?php $__env->endSlot(); ?>

        <?php
          $ltb = $localTransactionBackupSettings ?? [];
          $last_export_status = $ltb['last_export_status'] ?? null;
          $last_import_summary = $ltb['last_import_summary'] ?? null;
        ?>

        <form method="POST" action="<?php echo e(route('backup.store'), false); ?>">
          <?php echo csrf_field(); ?>
          <div class="row">
            <div class="col-md-12">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="enabled" value="1" <?php echo e(!empty($ltb['enabled']) ? 'checked' : '', false); ?>>
                  Enable Real-Time Local Transaction Backup
                </label>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="local_transaction_export_path">Local Transaction Export Path</label>
                <input type="text" class="form-control" id="local_transaction_export_path" name="export_path" value="<?php echo e(old('export_path', $ltb['export_path'] ?? ''), false); ?>" placeholder="C:\backup\AUTO\">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="local_transaction_import_path">Local Transaction Import Path</label>
                <input type="text" class="form-control" id="local_transaction_import_path" name="import_path" value="<?php echo e(old('import_path', $ltb['import_path'] ?? ''), false); ?>" placeholder="C:\backup\IMPORT\">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-8">
              <p class="help-block">
                Export and import paths are blank by default. Transactions are exported into a
                sub-folder named after the business ID (for example <code>C:\backup\AUTO\</code>).
              </p>
            </div>
            <div class="col-md-4 text-right">
              <?php if(config('constants.is_offline')): ?>
              <button type="button" class="btn btn-info" id="ltb-sync-settings"
                data-url="<?php echo e(action([\App\Http\Controllers\OfflineSyncController::class, 'syncTransactionBackupSettings']), false); ?>">
                <i class="fa fa-sync"></i> Sync Settings
              </button>
              <?php endif; ?>
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-save"></i> Save Settings
              </button>
              <button type="button" class="btn btn-success" id="ltb-start-import"
                data-start-url="<?php echo e(route('backup.local-import.start'), false); ?>"
                data-batch-url="<?php echo e(route('backup.local-import.batch'), false); ?>"
                data-status-url="<?php echo e(route('backup.local-import.status'), false); ?>">
                <i class="fa fa-upload"></i> Import (Disaster Recovery)
              </button>
            </div>
          </div>
        </form>

        <div class="row" id="ltb-import-progress-wrap" style="margin-top: 15px; display: none;">
          <div class="col-md-12">
            <div class="alert alert-info" style="margin-bottom: 10px;">
              <strong>Disaster Recovery Import</strong> — <span id="ltb-status-text">Preparing…</span>
              <button type="button" class="btn btn-xs btn-danger pull-right" id="ltb-cancel-import" style="display:none;">Stop</button>
            </div>
            <div class="progress" style="height: 22px;">
              <div class="progress-bar progress-bar-success progress-bar-striped active" id="ltb-progress-bar"
                role="progressbar" style="width: 0%;">0%</div>
            </div>
            <div class="row" style="margin-top: 8px;">
              <div class="col-md-2 col-xs-6"><small class="text-muted">Total</small><br><strong id="ltb-total">0</strong></div>
              <div class="col-md-2 col-xs-6"><small class="text-muted">Imported</small><br><strong id="ltb-imported" class="text-success">0</strong></div>
              <div class="col-md-2 col-xs-6"><small class="text-muted">Skipped</small><br><strong id="ltb-skipped">0</strong></div>
              <div class="col-md-2 col-xs-6"><small class="text-muted">Remaining</small><br><strong id="ltb-remaining">0</strong></div>
              <div class="col-md-2 col-xs-6"><small class="text-muted">Failed</small><br><strong id="ltb-failed" class="text-danger">0</strong></div>
              <div class="col-md-2 col-xs-6"><small class="text-muted">ETA</small><br><strong id="ltb-eta">—</strong></div>
            </div>
          </div>
        </div>

        <div class="row" style="margin-top: 15px;">
          <div class="col-md-6">
            <strong>Last export status:</strong>
            <?php if(!empty($last_export_status)): ?>
              <span class="label <?php echo e(!empty($last_export_status['success']) ? 'label-success' : 'label-danger', false); ?>">
                <?php echo e(!empty($last_export_status['success']) ? 'Success' : 'Failed', false); ?>

              </span>
              <span><?php echo e($last_export_status['message'] ?? '', false); ?></span>
              <?php if(!empty($last_export_status['time'])): ?>
                <small class="text-muted">(<?php echo e($last_export_status['time'], false); ?>)</small>
              <?php endif; ?>
            <?php else: ?>
              <span class="text-muted">No export yet.</span>
            <?php endif; ?>
          </div>

          <div class="col-md-6">
            <strong>Last import summary:</strong>
            <?php if(!empty($last_import_summary)): ?>
              <span>
                Files: <?php echo e($last_import_summary['total_files'] ?? 0, false); ?>,
                imported: <?php echo e($last_import_summary['imported'] ?? 0, false); ?>,
                skipped: <?php echo e($last_import_summary['skipped_duplicates'] ?? 0, false); ?>,
                failed: <?php echo e($last_import_summary['failed'] ?? 0, false); ?>

              </span>
              <?php if(!empty($last_import_summary['time'])): ?>
                <small class="text-muted">(<?php echo e($last_import_summary['time'], false); ?>)</small>
              <?php endif; ?>
              <?php if(!empty($last_import_summary['errors'])): ?>
                <ul class="text-danger" style="margin-top: 5px;">
                  <?php $__currentLoopData = array_slice($last_import_summary['errors'], 0, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error, false); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              <?php endif; ?>
            <?php else: ?>
              <span class="text-muted">No import yet.</span>
            <?php endif; ?>
          </div>
        </div>

        <hr>

        <div class="row" style="margin-top: 15px;">
          <div class="col-md-12">
            <h4 style="margin-top: 0;"><i class="fa fa-download"></i> Export Transactions With Date Range</h4>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label for="ltb_export_date_range">Date Range</label>
              <input type="text" class="form-control" id="ltb_export_date_range" placeholder="Select date range" readonly>
            </div>
          </div>

          <div class="col-md-5">
            <div class="form-group">
              <label>Export Destination</label>
              <p class="help-block" style="margin-top: 7px;">
                Uses <strong>Local Transaction Export Path</strong>: <span id="ltb-export-path-preview"><?php echo e($ltb['export_path'] ?? '', false); ?></span>
              </p>
            </div>
          </div>

          <div class="col-md-3 text-right">
            <button type="button" class="btn btn-success" id="ltb-export-date-range-btn"
              style="margin-top: 25px;"
              data-url="<?php echo e(route('backup.transaction-backup.export-date-range'), false); ?>">
              <i class="fa fa-download"></i> Export Transactions
            </button>
          </div>

          <div class="col-md-12">
            <div class="alert" id="ltb-export-date-range-result" style="display: none; margin-top: 10px;"></div>
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
    $('#ltb-sync-settings').click(function(e) {
        e.preventDefault();

        var $btn = $(this);
        var btnHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Syncing');

        $.ajax({
            url: $btn.data('url'),
            dataType: 'json'
        }).done(function(res) {
            if (res.success) {
                toastr.success(res.msg || 'Transaction Backup settings synced.');

                if (res.settings) {
                    $('input[name="enabled"]').prop('checked', !!parseInt(res.settings.enabled || 0, 10));
                    $('#local_transaction_export_path').val(res.settings.export_path || '');
                    $('#local_transaction_import_path').val(res.settings.import_path || '');
                    $('#ltb-export-path-preview').text(res.settings.export_path || '');
                }
            } else {
                toastr.error(res.msg || 'Could not sync Transaction Backup settings.');
            }
        }).fail(function(xhr) {
            var msg = (xhr.responseJSON && xhr.responseJSON.msg) ? xhr.responseJSON.msg : 'Could not sync Transaction Backup settings.';
            toastr.error(msg);
        }).always(function() {
            $btn.prop('disabled', false).html(btnHtml);
        });
    });

    $('#local_transaction_export_path').on('input change', function() {
        $('#ltb-export-path-preview').text($(this).val() || '');
    });

    (function() {
        var $range = $('#ltb_export_date_range');
        var $btn = $('#ltb-export-date-range-btn');
        var $result = $('#ltb-export-date-range-result');

        if (!$range.length || !$btn.length) { return; }

        if ($.fn.daterangepicker && typeof dateRangeSettings !== 'undefined') {
            $range.daterangepicker(dateRangeSettings, function(start, end) {
                $range.val(start.format(moment_date_format) + ' ~ ' + end.format(moment_date_format));
            });
            $range.val('');
            $range.on('cancel.daterangepicker', function() {
                $range.val('');
            });
        }

        $btn.click(function(e) {
            e.preventDefault();

            var picker = $range.data('daterangepicker');
            if (!$range.val() || !picker) {
                toastr.error('Please select a date range.');
                return;
            }

            if (!$('#local_transaction_export_path').val()) {
                toastr.error('Local Transaction Export Path is required.');
                return;
            }

            var btnHtml = $btn.html();
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Exporting');
            $result.hide().removeClass('alert-success alert-danger alert-warning alert-info');

            $.ajax({
                url: $btn.data('url'),
                type: 'POST',
                dataType: 'json',
                headers: { 'Accept': 'application/json' },
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').first().val(),
                    start_date: picker.startDate.format('YYYY-MM-DD'),
                    end_date: picker.endDate.format('YYYY-MM-DD'),
                    export_path: $('#local_transaction_export_path').val()
                }
            }).done(function(res) {
                var summary = res.summary || {};

                if (res.success) {
                    toastr.success(res.msg || 'Transactions export started.');
                    $result.addClass(summary.failed > 0 ? 'alert-warning' : 'alert-success').text(res.msg || '');

                    if (summary.mode === 'queued'
                        && window.LocalTransactionBackupBridge
                        && typeof window.LocalTransactionBackupBridge.pullQueuedExports === 'function') {
                        window.LocalTransactionBackupBridge.pullQueuedExports(false);
                    }
                } else {
                    toastr.error(res.msg || 'Transactions export failed.');
                    $result.addClass('alert-danger').text(res.msg || '');
                }

                $result.show();
            }).fail(function(xhr) {
                var msg = (xhr.responseJSON && xhr.responseJSON.msg) ? xhr.responseJSON.msg : 'Transactions export failed.';
                toastr.error(msg);
                $result.addClass('alert-danger').text(msg).show();
            }).always(function() {
                $btn.prop('disabled', false).html(btnHtml);
            });
        });
    })();

    // ----- Local Transaction Disaster-Recovery Import (resumable, batched) -----
    (function() {
        var $btn = $('#ltb-start-import');
        if (!$btn.length) { return; }

        var startUrl = $btn.data('start-url');
        var batchUrl = $btn.data('batch-url');
        var statusUrl = $btn.data('status-url');
        var csrf = $('meta[name="csrf-token"]').attr('content') || $('input[name="_token"]').first().val();

        var running = false;
        var cancelled = false;
        var startTime = null;
        var startProcessed = 0;
        var currentSessionId = null;

        function pct(p) { return (p || 0).toFixed(2) + '%'; }

        function render(s) {
            if (!s) { return; }
            currentSessionId = s.session_id;
            $('#ltb-import-progress-wrap').show();
            $('#ltb-total').text(s.total_files);
            $('#ltb-imported').text(s.imported);
            $('#ltb-skipped').text(s.skipped);
            $('#ltb-remaining').text(s.remaining);
            $('#ltb-failed').text(s.failed);
            $('#ltb-progress-bar').css('width', s.progress_percent + '%').text(pct(s.progress_percent));

            // ETA based on throughput since we started driving this run.
            if (startTime && s.processed_files > startProcessed) {
                var elapsed = (Date.now() - startTime) / 1000;
                var done = s.processed_files - startProcessed;
                var rate = done / Math.max(elapsed, 0.001);
                var remainSec = rate > 0 ? Math.round(s.remaining / rate) : null;
                if (remainSec !== null && s.remaining > 0) {
                    var m = Math.floor(remainSec / 60), sec = remainSec % 60;
                    $('#ltb-eta').text((m > 0 ? m + 'm ' : '') + sec + 's');
                } else {
                    $('#ltb-eta').text('—');
                }
            }

            if (s.finished) {
                $('#ltb-progress-bar').removeClass('active progress-bar-striped');
                if (s.failed > 0) {
                    $('#ltb-progress-bar').removeClass('progress-bar-success').addClass('progress-bar-warning');
                    $('#ltb-status-text').text('Completed with ' + s.failed + ' failed file(s).');
                } else {
                    $('#ltb-status-text').text('Restore complete. ' + s.imported + ' transaction(s) restored.');
                }
            } else {
                $('#ltb-status-text').text('Importing… batch in progress.');
            }
        }

        function processNext() {
            if (cancelled) {
                running = false;
                $('#ltb-status-text').text('Import stopped. You can resume later.');
                $btn.prop('disabled', false).html('<i class="fa fa-upload"></i> Resume Import');
                $('#ltb-cancel-import').hide();
                return;
            }

            $.ajax({
                url: batchUrl, type: 'POST', dataType: 'json',
                data: { _token: csrf, session_id: currentSessionId }
            }).done(function(res) {
                if (!res.success) {
                    toastr.error(res.msg || 'Import batch failed.');
                    running = false;
                    $btn.prop('disabled', false).html('<i class="fa fa-upload"></i> Retry Import');
                    return;
                }
                render(res.session);
                if (res.session.finished) {
                    running = false;
                    $('#ltb-cancel-import').hide();
                    $btn.prop('disabled', false).html('<i class="fa fa-upload"></i> Import (Disaster Recovery)');
                    toastr.success('Disaster recovery import finished.');
                } else {
                    processNext();
                }
            }).fail(function(xhr) {
                var msg = (xhr.responseJSON && xhr.responseJSON.msg) ? xhr.responseJSON.msg : 'Import request failed.';
                toastr.error(msg);
                running = false;
                $btn.prop('disabled', false).html('<i class="fa fa-upload"></i> Resume Import');
            });
        }

        function beginRun() {
            cancelled = false;
            running = true;
            startTime = Date.now();
            $('#ltb-cancel-import').show();
            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Importing…');
            processNext();
        }

        $btn.click(function(e) {
            e.preventDefault();
            if (running) { return; }

            // If a session is already created (resume), continue it; else start a fresh scan.
            if (currentSessionId) {
                $.get(statusUrl, { session_id: currentSessionId }).done(function(res) {
                    if (res.session) { render(res.session); startProcessed = res.session.processed_files; }
                    beginRun();
                });
                return;
            }

            $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Scanning files…');
            $('#ltb-import-progress-wrap').show();
            $('#ltb-status-text').text('Scanning import folder…');

            $.ajax({
                url: startUrl, type: 'POST', dataType: 'json',
                data: {
                    _token: csrf,
                    import_path: $('#local_transaction_import_path').val()
                }
            }).done(function(res) {
                if (!res.success) {
                    toastr.error(res.msg || 'Could not start import.');
                    $btn.prop('disabled', false).html('<i class="fa fa-upload"></i> Import (Disaster Recovery)');
                    return;
                }
                render(res.session);
                startProcessed = res.session.processed_files;
                if (res.session.total_files === 0) {
                    toastr.info('No backup files found in the import folder.');
                    $btn.prop('disabled', false).html('<i class="fa fa-upload"></i> Import (Disaster Recovery)');
                    return;
                }
                beginRun();
            }).fail(function(xhr) {
                var msg = (xhr.responseJSON && xhr.responseJSON.msg) ? xhr.responseJSON.msg : 'Could not start import.';
                toastr.error(msg);
                $btn.prop('disabled', false).html('<i class="fa fa-upload"></i> Import (Disaster Recovery)');
            });
        });

        $('#ltb-cancel-import').click(function() { cancelled = true; });

        // On page load, detect an unfinished session and offer resume.
        $.get(statusUrl).done(function(res) {
            if (res.session && !res.session.finished) {
                currentSessionId = res.session.session_id;
                render(res.session);
                startProcessed = res.session.processed_files;
                $('#ltb-status-text').text('An unfinished import was found. Click "Resume Import" to continue.');
                $btn.html('<i class="fa fa-upload"></i> Resume Import');
            }
        });
    })();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>