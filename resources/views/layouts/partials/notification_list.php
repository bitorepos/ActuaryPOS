<?php if(!empty($notifications_data)): ?>
  <?php $__currentLoopData = $notifications_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $is_reindex_notification = ($notification_data['type'] ?? null) === \App\Notifications\ReindexProgressNotification::class;
      $can_cancel_reindex = $is_reindex_notification && in_array($notification_data['status'] ?? null, ['pending', 'processing']);
    ?>
    <li class="<?php if(empty($notification_data['read_at'])): ?> unread <?php endif; ?> notification-li" style="border-bottom:1px solid #f0f0f0;">
      <?php if($can_cancel_reindex): ?>
        <div style="display:flex;align-items:flex-start;padding:10px 14px;color:inherit;width:100%;box-sizing:border-box;gap:10px;">
          <i class="notif-icon <?php echo e($notification_data['icon_class'] ?? '', false); ?>" style="flex-shrink:0;float:none;margin-right:2px;"></i>
          <div style="flex:1;min-width:0;">
            <span class="notif-info" style="display:block;white-space:normal;word-break:break-word;"><?php echo $notification_data['msg'] ?? ''; ?></span>
            <span class="time" style="margin-left:0;"><?php echo e($notification_data['created_at'], false); ?></span>
          </div>
          <button type="button" class="btn btn-xs btn-danger cancel_reindex_stock_quantity" style="flex-shrink:0;margin-top:2px;">Cancel <i class="hide fas fa-spinner fa-spin fa-fw"></i></button>
        </div>
      <?php else: ?>
        <a href="<?php echo e($notification_data['link'] ?? '#', false); ?>"
          <?php if(isset($notification_data['show_popup'])): ?> class="show-notification-in-popup" <?php endif; ?>
          style="display:flex;align-items:flex-start;padding:10px 14px;text-decoration:none;color:inherit;width:100%;box-sizing:border-box;">
          <i class="notif-icon <?php echo e($notification_data['icon_class'] ?? '', false); ?>" style="flex-shrink:0;float:none;margin-right:12px;"></i>
          <div style="flex:1;min-width:0;">
            <span class="notif-info" style="display:block;white-space:normal;word-break:break-word;"><?php echo $notification_data['msg'] ?? ''; ?></span>
            <span class="time" style="margin-left:0;"><?php echo e($notification_data['created_at'], false); ?></span>
          </div>
        </a>
      <?php endif; ?>
    </li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
  <li class="text-center no-notification notification-li" style="padding:16px;">
    <?php echo app('translator')->get('lang_v1.no_notifications_found'); ?>
  </li>
<?php endif; ?>
