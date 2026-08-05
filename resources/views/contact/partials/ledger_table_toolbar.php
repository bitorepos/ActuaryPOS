<?php if(request('sub_action') != 'print' && empty($for_pdf)): ?>
    <style>
        #contact_ledger_div .contact-ledger-description-column {
            width: 220px !important;
            min-width: 220px !important;
            max-width: 220px !important;
            white-space: normal !important;
            overflow-wrap: anywhere;
            word-break: break-word;
            vertical-align: top;
        }
    </style>
    <div class="contact-ledger-table-toolbar d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
        <?php if(!empty($show_footer_toggle)): ?>
            <div class="form-check mb-0">
                <label class="form-check-label">
                    <?php echo Form::checkbox('common_settings[hide_footer_total_format1]', 1,
                        !empty($common_settings['hide_footer_total_format1']),
                        ['class' => 'form-check-input', 'id' => 'hide_footer_total_front']); ?>

                    <?php echo e(__('lang_v1.hide_footer_total_format1'), false); ?>

                </label>
            </div>
        <?php endif; ?>

        <div class="contact-ledger-column-buttons ms-auto"></div>
    </div>
<?php endif; ?>
