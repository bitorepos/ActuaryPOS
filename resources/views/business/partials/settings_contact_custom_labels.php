<div class="clearfix"></div>
<hr>
<div class="col-sm-12">
    <h4><?php echo app('translator')->get('lang_v1.labels_for_contact_custom_fields'); ?>:</h4>
</div>
<?php for($i = 1; $i <= 10; $i++): ?>
    <div class="col-sm-3">
        <div class="form-group mb-3">
            <?php
                $field = 'custom_field_' . $i;
                $label = $i <= 4
                    ? __('lang_v1.contact_custom_field' . $i)
                    : __('lang_v1.custom_field', ['number' => $i]);
            ?>
            <?php echo Form::label('contact_custom_field_' . $i . '_label', $label); ?>

            <?php echo Form::text(
                'custom_labels[contact][' . $field . ']',
                !empty($custom_labels['contact'][$field]) ? $custom_labels['contact'][$field] : null,
                ['class' => 'form-control', 'id' => 'contact_custom_field_' . $i . '_label']
            ); ?>

        </div>
    </div>
<?php endfor; ?>
