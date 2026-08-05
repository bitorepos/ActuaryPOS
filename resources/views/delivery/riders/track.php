
<?php $__env->startSection('title', 'Track Rider'); ?>

<?php $__env->startSection('content'); ?>
<section class="content-header">
    <h1><i class="fa fa-map-marker-alt"></i> Tracking — <?php echo e(optional($rider->user)->first_name, false); ?> <?php echo e(optional($rider->user)->last_name, false); ?>

        <small class="text-muted"><?php echo e($rider->vehicle_type, false); ?> <?php echo e($rider->vehicle_plate ? '· '.$rider->vehicle_plate : '', false); ?></small>
    </h1>
</section>

<section class="content">
    <?php if(empty($api_key)): ?>
        <div class="alert alert-warning">Google Maps API key missing.</div>
    <?php endif; ?>
    <div class="card border-0 shadow-sm" style="border-radius:14px;">
        <div class="card-body p-2">
            <div id="track-map" style="height:600px;width:100%;border-radius:12px;"></div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php if(!empty($api_key)): ?>
<script>
window.__initTrackMap = function () {
    const trail = <?php echo json_encode($trail, 15, 512) ?>;
    const path  = trail.map(p => ({ lat: parseFloat(p.latitude), lng: parseFloat(p.longitude) }));
    const last  = path.length ? path[path.length - 1] : { lat: <?php echo e($rider->current_latitude ?: 0, false); ?>, lng: <?php echo e($rider->current_longitude ?: 0, false); ?> };

    const map = new google.maps.Map(document.getElementById('track-map'), {
        zoom: 14, center: last.lat ? last : { lat: -33.8688, lng: 151.2195 },
        mapTypeControl: false, streetViewControl: false,
    });

    if (path.length > 1) {
        new google.maps.Polyline({ path: path, geodesic: true, strokeColor: '#4361ee', strokeOpacity: .9, strokeWeight: 4, map: map });
        new google.maps.Marker({ position: path[0], map: map, label: 'S' });
    }
    if (last.lat) {
        new google.maps.Marker({ position: last, map: map, label: 'E' });
    }
};
$(function () {
    const s = document.createElement('script');
    s.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo e($api_key, false); ?>&callback=__initTrackMap';
    s.async = true; s.defer = true; document.head.appendChild(s);
});
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>