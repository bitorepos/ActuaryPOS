
<?php $__env->startSection('title', 'Delivery Performance Report'); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header"><h1><i class="fa fa-chart-line"></i> Rider Performance</h1></section>

<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php echo Form::open(['method' => 'get', 'class' => 'row g-2 align-items-end']); ?>

            <div class="col-md-3"><label>From</label><input type="date" name="start_date" value="<?php echo e($start->toDateString(), false); ?>" class="form-control form-control-sm"></div>
            <div class="col-md-3"><label>To</label><input type="date" name="end_date" value="<?php echo e($end->toDateString(), false); ?>" class="form-control form-control-sm"></div>
            <div class="col-md-3"><button class="btn btn-primary btn-sm">Apply</button></div>
        <?php echo Form::close(); ?>


        <div class="table-responsive mt-3">
            <table class="table table-striped table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Rider</th><th class="text-end">Total</th><th class="text-end">Delivered</th>
                        <th class="text-end">Cancelled</th><th class="text-end">Success %</th>
                        <th class="text-end">Total Km</th><th class="text-end">Total Fees</th><th class="text-end">Avg Time (min)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $perRider; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php $pct = $r->total ? round($r->delivered / $r->total * 100, 1) : 0; ?>
                        <tr>
                            <td><?php echo e(trim($r->rider_name) ?: '—', false); ?></td>
                            <td class="text-end"><?php echo e($r->total, false); ?></td>
                            <td class="text-end text-success"><?php echo e($r->delivered, false); ?></td>
                            <td class="text-end text-danger"><?php echo e($r->cancelled, false); ?></td>
                            <td class="text-end"><?php echo e($pct, false); ?>%</td>
                            <td class="text-end"><?php echo e(number_format($r->total_km ?? 0, 1), false); ?></td>
                            <td class="text-end"><?php echo e(number_format($r->total_fee ?? 0, 2), false); ?></td>
                            <td class="text-end"><?php echo e($r->avg_minutes ? round($r->avg_minutes) : '—', false); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="8" class="text-center text-muted py-3">No deliveries in this range.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>