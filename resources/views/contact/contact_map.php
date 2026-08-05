
<?php $__env->startSection('title', __('lang_v1.contact_locations')); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $api_key = env('GOOGLE_MAP_API_KEY');
    ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.contact_locations'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
        <?php echo Form::open(['url' => action([\App\Http\Controllers\ContactController::class, 'contactMap']), 'method' => 'get', 'class' => 'row g-3 align-items-end']); ?>

            <div class="col-lg-6 col-md-8">
                <label class="form-label" for="contacts"><?php echo app('translator')->get('lang_v1.select_contacts'); ?></label>
                <select id="contacts" class="form-select select2" name="contacts[]" multiple="" data-placeholder="<?php echo app('translator')->get('messages.please_select'); ?>"></select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('messages.submit'); ?></button>
            </div>
        <?php echo Form::close(); ?>

    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-solid']); ?>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo e($api_key, false); ?>"></script>
        <div id="map" style="height: 450px;"></div>
    <?php echo $__env->renderComponent(); ?>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
    <?php if(!empty($api_key)): ?>
    <script type="text/javascript">
        $(document).ready( function(){
            initMap();
            var contacts = <?php echo json_encode($all_contacts->toArray()); ?>;
            var data = $.map(contacts, function (obj) {
                obj.text = obj.name;
                obj.id = obj.id;
                obj.shipping_address = obj.shipping_address || "";
                obj.contact_id = obj.contact_id || "";
                return obj;
            });

            var $contactsSelect = $('#contacts');
            $contactsSelect.select2({
                data: data,
                width: '100%',
                placeholder: $contactsSelect.data('placeholder'),
                templateResult: function (data) {
                    var template = data.name + " (" + data.contact_id + ")" + '<br><small>' + data.shipping_address + '</small>';

                    return template;
                },
                escapeMarkup: function(markup) {
                    return markup;
                },
            });
            <?php if(!empty(request()->input('contacts'))): ?>
                $contactsSelect.val([<?php echo e(implode(',', request()->input('contacts')), false); ?>]).change();
            <?php endif; ?>
        });

        var map
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 10,
                center: {lat: -33.9, lng: 151.2}
            });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    map.setCenter(initialLocation);
                });
            }

            setMarkers(map);
        }

        function setMarkers(map) {
            var contacts = [
                <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $contact_type = $contact->type != 'both' ? __('contact.' . $contact->type) : __('lang_v1.both_customer_and_supplier');
                    ?>
                    [
                        "<?php echo e($contact->name, false); ?> (<?php echo e($contact->contact_id, false); ?>) \n <?php echo e($contact_type, false); ?>", 
                        <?php echo e($contact->position, false); ?>

                    ],
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ];

            for (var i = 0; i < contacts.length; i++) {
                var contact = contacts[i];
                var marker = new google.maps.Marker({
                    position: {lat: contact[1], lng: contact[2]},
                    map: map,
                    title: contact[0]      
                });
            }
        };
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>