
<?php $__env->startSection('title', 'Delivery Live Map'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .delivery-stat-card {
        border: 0;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.06);
        overflow: hidden;
        transition: transform .15s ease;
    }
    .delivery-stat-card:hover { transform: translateY(-3px); }
    .delivery-stat-card .body { padding: 18px 20px; display:flex; align-items:center; gap:14px; }
    .delivery-stat-card .icon { width:54px; height:54px; border-radius:12px; display:grid; place-items:center; color:#fff; font-size:22px; }
    .delivery-stat-card .num  { font-size: 28px; font-weight: 700; line-height: 1; }
    .delivery-stat-card .lbl  { font-size: 12px; color:#6c757d; text-transform:uppercase; letter-spacing:.5px; margin-top:4px; }
    .bg-grad-blue   { background: linear-gradient(135deg,#4361ee,#4895ef); }
    .bg-grad-green  { background: linear-gradient(135deg,#06a77d,#1abc9c); }
    .bg-grad-orange { background: linear-gradient(135deg,#f77f00,#fcbf49); }
    .bg-grad-purple { background: linear-gradient(135deg,#7209b7,#b5179e); }
    .bg-grad-red    { background: linear-gradient(135deg,#ef233c,#d90429); }
    .bg-grad-teal   { background: linear-gradient(135deg,#0096c7,#00b4d8); }
    #delivery-map { height: 600px; width: 100%; border-radius: 14px; }
    .rider-side-panel { max-height: 600px; overflow-y: auto; }
    .rider-card { padding: 12px; border-radius: 10px; border:1px solid #e9ecef; margin-bottom:10px; cursor:pointer; transition:all .15s; background:#fff; }
    .rider-card:hover { border-color:#4361ee; box-shadow:0 4px 12px rgba(67,97,238,.12); }
    .rider-card .rider-name { font-weight:600; }
    .rider-card .rider-meta { font-size:12px; color:#6c757d; }
    .badge-avail-available    { background:#06a77d; }
    .badge-avail-on_delivery  { background:#f77f00; }
    .badge-avail-on_break     { background:#0096c7; }
    .badge-avail-offline      { background:#6c757d; }
    .legend { background:rgba(255,255,255,.95); padding:8px 12px; border-radius:8px; font-size:12px; box-shadow:0 2px 8px rgba(0,0,0,.1); }
    .legend .dot { display:inline-block; width:12px; height:12px; border-radius:50%; margin-right:6px; vertical-align:middle; }
</style>

<section class="content-header">
    <h1><i class="fa fa-truck-fast"></i> Delivery Live Map
        <small class="text-muted ms-2" id="last-refresh"></small>
    </h1>
</section>

<section class="content">
    <?php if(empty($api_key)): ?>
        <div class="alert alert-warning"><strong>Google Maps API key missing.</strong> Set <code>GOOGLE_MAP_API_KEY</code> in your <code>.env</code> to enable the live map.</div>
    <?php endif; ?>

    <div class="row g-3 mb-3">
        <div class="col-md-2 col-sm-6"><div class="delivery-stat-card bg-white"><div class="body"><div class="icon bg-grad-blue"><i class="fa fa-users"></i></div><div><div class="num"><?php echo e($stats['riders_total'], false); ?></div><div class="lbl">Total Riders</div></div></div></div></div>
        <div class="col-md-2 col-sm-6"><div class="delivery-stat-card bg-white"><div class="body"><div class="icon bg-grad-green"><i class="fa fa-circle-check"></i></div><div><div class="num"><?php echo e($stats['riders_available'], false); ?></div><div class="lbl">Available</div></div></div></div></div>
        <div class="col-md-2 col-sm-6"><div class="delivery-stat-card bg-white"><div class="body"><div class="icon bg-grad-orange"><i class="fa fa-motorcycle"></i></div><div><div class="num"><?php echo e($stats['riders_on_delivery'], false); ?></div><div class="lbl">On Delivery</div></div></div></div></div>
        <div class="col-md-2 col-sm-6"><div class="delivery-stat-card bg-white"><div class="body"><div class="icon bg-grad-purple"><i class="fa fa-clipboard-list"></i></div><div><div class="num"><?php echo e($stats['assignments_today'], false); ?></div><div class="lbl">Today's Orders</div></div></div></div></div>
        <div class="col-md-2 col-sm-6"><div class="delivery-stat-card bg-white"><div class="body"><div class="icon bg-grad-teal"><i class="fa fa-route"></i></div><div><div class="num"><?php echo e($stats['assignments_active'], false); ?></div><div class="lbl">Active</div></div></div></div></div>
        <div class="col-md-2 col-sm-6"><div class="delivery-stat-card bg-white"><div class="body"><div class="icon bg-grad-red"><i class="fa fa-flag-checkered"></i></div><div><div class="num"><?php echo e($stats['assignments_done_today'], false); ?></div><div class="lbl">Delivered Today</div></div></div></div></div>
    </div>

    <div class="row g-3">
        <div class="col-md-9">
            <div class="card border-0 shadow-sm" style="border-radius:14px;">
                <div class="card-body p-2 position-relative">
                    <div id="delivery-map"></div>
                    <div class="legend position-absolute" style="top:14px; left:14px; z-index:5;">
                        <div><span class="dot" style="background:#06a77d"></span> Available</div>
                        <div><span class="dot" style="background:#f77f00"></span> On Delivery</div>
                        <div><span class="dot" style="background:#0096c7"></span> On Break</div>
                        <div><span class="dot" style="background:#6c757d"></span> Offline</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm" style="border-radius:14px;">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <strong><i class="fa fa-list"></i> Active Riders</strong>
                    <button class="btn btn-sm btn-outline-primary" id="btn-refresh"><i class="fa fa-rotate"></i></button>
                </div>
                <div class="card-body rider-side-panel" id="rider-panel">
                    <div class="text-center text-muted py-4"><i class="fa fa-spinner fa-spin"></i> Loading…</div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<?php if(!empty($api_key)): ?>
<script>
    (function () {
        let map, markers = {}, infoWindows = {}, polylines = {};
        const REFRESH_MS = 10000;

        function vehicleIcon(avail) {
            const colors = { available:'#06a77d', on_delivery:'#f77f00', on_break:'#0096c7', offline:'#6c757d' };
            const c = colors[avail] || '#6c757d';
            return {
                path: 'M-12,-12 L12,-12 L12,12 L-12,12 Z',
                fillColor: c, fillOpacity: 0.95, strokeColor:'#fff', strokeWeight: 2, scale: 1,
            };
        }

        function vehiclePin(avail) {
            const colors = { available:'#06a77d', on_delivery:'#f77f00', on_break:'#0096c7', offline:'#6c757d' };
            const c = colors[avail] || '#6c757d';
            const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="44" height="54" viewBox="0 0 44 54">
              <defs><filter id="s" x="-50%" y="-50%" width="200%" height="200%"><feDropShadow dx="0" dy="2" stdDeviation="2" flood-opacity=".4"/></filter></defs>
              <path filter="url(#s)" d="M22 2 C10 2 2 11 2 22 c0 14 20 30 20 30 s20-16 20-30 C42 11 34 2 22 2 z" fill="${c}" stroke="#fff" stroke-width="2"/>
              <circle cx="22" cy="22" r="11" fill="#fff"/>
              <text x="22" y="27" text-anchor="middle" font-family="FontAwesome,Arial" font-size="14" fill="${c}">🛵</text>
            </svg>`;
            return { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg), scaledSize: new google.maps.Size(44,54), anchor: new google.maps.Point(22,52) };
        }

        function customerPin() {
            const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="36" height="46" viewBox="0 0 36 46">
              <path d="M18 1 C9 1 2 8 2 17 c0 12 16 28 16 28 s16-16 16-28 C34 8 27 1 18 1 z" fill="#ef233c" stroke="#fff" stroke-width="2"/>
              <circle cx="18" cy="17" r="8" fill="#fff"/>
              <text x="18" y="21" text-anchor="middle" font-size="11" fill="#ef233c" font-weight="bold">📍</text>
            </svg>`;
            return { url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(svg), scaledSize: new google.maps.Size(36,46), anchor: new google.maps.Point(18,44) };
        }

        function infoHtml(r) {
            let html = `<div style="min-width:240px;font-family:inherit;">
              <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                ${r.photo_url ? `<img src="${r.photo_url}" style="width:42px;height:42px;border-radius:50%;object-fit:cover;">` : ''}
                <div>
                  <div style="font-weight:600;font-size:14px;">${r.name}</div>
                  <div style="font-size:11px;color:#6c757d;">${(r.vehicle||'').toUpperCase()}${r.plate?' • '+r.plate:''}</div>
                </div>
              </div>
              <div style="font-size:12px;line-height:1.6;">
                ${r.phone ? `<div><i class="fa fa-phone"></i> ${r.phone}</div>` : ''}
                <div><span class="badge badge-avail-${r.avail}" style="color:#fff;padding:2px 8px;border-radius:8px;">${r.avail.replace('_',' ').toUpperCase()}</span></div>
                ${r.speed ? `<div><i class="fa fa-gauge"></i> ${r.speed.toFixed(1)} km/h</div>`:''}
                <div style="color:#6c757d;"><i class="fa fa-clock"></i> ${r.last_ping_human || 'never'}</div>
              </div>`;
            if (r.assignment) {
                html += `<hr style="margin:8px 0;">
                  <div style="font-size:12px;">
                    <div style="font-weight:600;">Active Delivery #${r.assignment.id}</div>
                    <div>👤 ${r.assignment.customer || ''}</div>
                    ${r.assignment.customer_phone ? `<div>📞 ${r.assignment.customer_phone}</div>`:''}
                    ${r.assignment.dropoff_address ? `<div>📍 ${r.assignment.dropoff_address}</div>`:''}
                    <div style="margin-top:6px;">Status: <strong>${r.assignment.status.replace('_',' ')}</strong></div>
                  </div>`;
            }
            html += `</div>`;
            return html;
        }

        function refreshRiders() {
            $.get('<?php echo e(url('/delivery/api/riders-live'), false); ?>', function (data) {
                const seen = {};
                const panel = $('#rider-panel').empty();
                if (!data.riders.length) {
                    panel.html('<div class="text-muted text-center py-3">No riders online.</div>');
                }
                data.riders.forEach(r => {
                    seen[r.id] = true;
                    const pos = { lat: r.lat, lng: r.lng };
                    if (markers[r.id]) {
                        markers[r.id].setPosition(pos);
                        markers[r.id].setIcon(vehiclePin(r.avail));
                    } else {
                        markers[r.id] = new google.maps.Marker({ position: pos, map: map, icon: vehiclePin(r.avail), title: r.name });
                        infoWindows[r.id] = new google.maps.InfoWindow();
                        markers[r.id].addListener('click', function () {
                            Object.values(infoWindows).forEach(iw => iw.close());
                            infoWindows[r.id].setContent(infoHtml(r));
                            infoWindows[r.id].open(map, markers[r.id]);
                            drawRoute(r);
                        });
                    }
                    // refresh open infowindow
                    if (infoWindows[r.id] && infoWindows[r.id].getMap()) {
                        infoWindows[r.id].setContent(infoHtml(r));
                    }

                    // side panel card
                    panel.append(`<div class="rider-card" data-id="${r.id}">
                      <div class="d-flex justify-content-between align-items-start">
                        <div>
                          <div class="rider-name">${r.name}</div>
                          <div class="rider-meta">${(r.vehicle||'').toUpperCase()}${r.plate?' • '+r.plate:''}</div>
                          ${r.assignment ? `<div class="rider-meta mt-1"><i class="fa fa-user"></i> ${r.assignment.customer||''}</div>`:''}
                        </div>
                        <span class="badge badge-avail-${r.avail}" style="color:#fff;">${r.avail.replace('_',' ')}</span>
                      </div>
                      <div class="rider-meta mt-1"><i class="fa fa-clock"></i> ${r.last_ping_human||'—'}</div>
                    </div>`);
                });

                // remove markers no longer present
                Object.keys(markers).forEach(id => {
                    if (!seen[id]) {
                        markers[id].setMap(null); delete markers[id];
                        if (polylines[id]) { polylines[id].setMap(null); delete polylines[id]; }
                    }
                });

                $('#last-refresh').text('Updated ' + new Date().toLocaleTimeString());
            });
        }

        function drawRoute(r) {
            if (!r.assignment || !r.assignment.dropoff_lat || !r.assignment.dropoff_lng) return;
            if (polylines[r.id]) polylines[r.id].setMap(null);

            // simple straight polyline (use Directions API for routed paths)
            polylines[r.id] = new google.maps.Polyline({
                path: [{lat:r.lat,lng:r.lng}, {lat:parseFloat(r.assignment.dropoff_lat), lng:parseFloat(r.assignment.dropoff_lng)}],
                geodesic: true, strokeColor: '#4361ee', strokeOpacity: .85, strokeWeight: 3, map: map,
                icons: [{ icon: { path: 'M 0,-1 0,1', strokeOpacity:1, scale:3 }, offset:'0', repeat:'12px' }],
            });

            // dropoff marker
            new google.maps.Marker({
                position: { lat: parseFloat(r.assignment.dropoff_lat), lng: parseFloat(r.assignment.dropoff_lng) },
                map: map, icon: customerPin(), title: r.assignment.customer || 'Customer'
            });
        }

        window.__initDeliveryMap = function () {
            const locationPins = <?php echo json_encode($location_pins ?? [], 15, 512) ?>;
            const initialCenter = locationPins.length
                ? { lat: locationPins[0].lat, lng: locationPins[0].lng }
                : { lat: 24.8607, lng: 67.0011 }; // fallback Karachi
            const initialZoom = locationPins.length ? (locationPins[0].zoom || 13) : 12;

            map = new google.maps.Map(document.getElementById('delivery-map'), {
                zoom: initialZoom, center: initialCenter,
                mapTypeControl: false, streetViewControl: false, fullscreenControl: true,
                styles: [
                    { featureType:'poi', stylers:[{visibility:'off'}] },
                    { featureType:'transit', stylers:[{visibility:'off'}] },
                ],
            });

            // Drop a "store" pin for every business location with saved coordinates.
            // These are the configured ride start points.
            locationPins.forEach(function (loc) {
                const storeSvg = '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="50" viewBox="0 0 40 50">'
                    + '<path d="M20 1 C10 1 2 9 2 19 c0 13 18 30 18 30 s18-17 18-30 C38 9 30 1 20 1 z" fill="#1d3557" stroke="#fff" stroke-width="2"/>'
                    + '<circle cx="20" cy="19" r="9" fill="#fff"/>'
                    + '<text x="20" y="23" text-anchor="middle" font-size="12" fill="#1d3557" font-weight="bold">🏪</text>'
                    + '</svg>';
                const storeMarker = new google.maps.Marker({
                    position: { lat: loc.lat, lng: loc.lng },
                    map: map,
                    title: loc.name + ' (Ride Start)',
                    icon: {
                        url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(storeSvg),
                        scaledSize: new google.maps.Size(40, 50),
                        anchor: new google.maps.Point(20, 48),
                    },
                    zIndex: 50,
                });
                const iw = new google.maps.InfoWindow({
                    content: '<div style="font-weight:600;">' + loc.name + '</div><div style="font-size:11px;color:#6c757d;">Ride start point</div>'
                });
                storeMarker.addListener('click', function () { iw.open(map, storeMarker); });
            });

            // Only fall back to browser geolocation if no business location has coordinates.
            if (!locationPins.length && navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(p => {
                    map.setCenter({ lat: p.coords.latitude, lng: p.coords.longitude });
                });
            }
            refreshRiders();
            setInterval(refreshRiders, REFRESH_MS);
        };

        $(document).on('click', '#btn-refresh', refreshRiders);
        $(document).on('click', '.rider-card', function () {
            const id = $(this).data('id');
            if (markers[id]) {
                map.panTo(markers[id].getPosition()); map.setZoom(15);
                google.maps.event.trigger(markers[id], 'click');
            }
        });

        $(function () {
            const s = document.createElement('script');
            s.src = 'https://maps.googleapis.com/maps/api/js?key=<?php echo e($api_key, false); ?>&libraries=places&callback=__initDeliveryMap';
            s.async = true; s.defer = true;
            document.head.appendChild(s);
        });
    })();
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>