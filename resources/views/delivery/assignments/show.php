<?php $cfg = \App\DeliveryAssignment::STATUSES[$assignment->status] ?? ['label'=>$assignment->status,'color'=>'secondary','icon'=>'fa-question']; ?>
<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Delivery #<?php echo e($assignment->id, false); ?> <span class="badge bg-<?php echo e($cfg['color'], false); ?>"><i class="fa <?php echo e($cfg['icon'], false); ?>"></i> <?php echo e($cfg['label'], false); ?></span></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <h6>Customer</h6>
                    <div><strong><?php echo e(optional($assignment->contact)->name ?: '—', false); ?></strong></div>
                    <div class="text-muted"><?php echo e(optional($assignment->contact)->mobile, false); ?></div>
                    <div class="text-muted"><?php echo e($assignment->dropoff_address, false); ?></div>
                </div>
                <div class="col-md-6">
                    <h6>Rider</h6>
                    <div><strong><?php echo e(optional(optional($assignment->rider)->user)->first_name, false); ?> <?php echo e(optional(optional($assignment->rider)->user)->last_name, false); ?></strong></div>
                    <div class="text-muted"><?php echo e(optional($assignment->rider)->vehicle_type, false); ?> · <?php echo e(optional($assignment->rider)->vehicle_plate, false); ?></div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3"><small class="text-muted">Distance</small><div><?php echo e($assignment->distance_km ? number_format($assignment->distance_km,2).' km' : '—', false); ?></div></div>
                <div class="col-md-3"><small class="text-muted">Est. Time</small><div><?php echo e($assignment->estimated_minutes ?: '—', false); ?> min</div></div>
                <div class="col-md-3"><small class="text-muted">Actual Time</small><div><?php echo e($assignment->actual_minutes ?: '—', false); ?> min</div></div>
                <div class="col-md-3"><small class="text-muted">Delivery Fee</small><div><?php echo e(number_format($assignment->delivery_fee,2), false); ?></div></div>
            </div>
            <hr>
            <h6>Timeline</h6>
            <ul class="list-unstyled small">
                <?php $__currentLoopData = ['assigned_at'=>'Assigned','accepted_at'=>'Accepted','picked_up_at'=>'Picked Up','on_the_way_at'=>'On The Way','delivered_at'=>'Delivered','cancelled_at'=>'Cancelled']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($assignment->$f): ?>
                        <li><i class="fa fa-circle text-success" style="font-size:8px;"></i> <strong><?php echo e($lbl, false); ?>:</strong> <?php echo e($assignment->$f->format('d M Y H:i'), false); ?></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php if($assignment->notes): ?><hr><h6>Notes</h6><pre class="bg-light p-2 small"><?php echo e($assignment->notes, false); ?></pre><?php endif; ?>
        </div>
        <div class="modal-footer"><button class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
    </div>
</div>
