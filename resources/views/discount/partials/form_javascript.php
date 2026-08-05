<script type="text/javascript">
    function initializeDiscountFormUi($container) {
        $container.find('.select2').each(function () {
            if ($(this).data('select2')) {
                $(this).select2('destroy');
            }

            var $parent = $container.hasClass('discount_modal') ? $container : $(this).parent();
            $(this).select2({ dropdownParent: $parent });
        });

        var $variationIds = $container.find('#variation_ids');
        if ($variationIds.length) {
            if ($variationIds.data('select2')) {
                $variationIds.select2('destroy');
            }

            $variationIds.select2({
                dropdownParent: $container.hasClass('discount_modal') ? $container : $variationIds.parent(),
                ajax: {
                    url: '/purchases/get_products?check_enable_stock=false&only_variations=true&hide_combo=false',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        var results = [];
                        for (var item in data) {
                            results.push({
                                id: data[item].variation_id,
                                text: data[item].text,
                            });
                        }
                        return { results: results };
                    },
                },
                // The product text contains markup like "<br>Price: ..." that
                // must render as HTML (line break) rather than escaped text.
                escapeMarkup: function (markup) { return markup; },
                templateResult: function (item) {
                    if (!item.id) { return item.text; }
                    return $('<span>' + item.text + '</span>');
                },
                templateSelection: function (item) {
                    if (!item.id) { return item.text; }
                    // For the selection chip use a plain-text version (no <br>)
                    // so the chip stays on a single line; the dropdown still
                    // shows the full multi-line markup.
                    var plain = String(item.text).replace(/<br\s*\/?>/gi, ' - ');
                    return $('<span>' + plain + '</span>');
                },
                minimumInputLength: 1,
                closeOnSelect: false
            }).off('select2:select.discount').on('select2:select.discount', function() {
                $('input.select2-search__field').val('');
            });
        }

        var $customerIds = $container.find('#customer_ids');
        if ($customerIds.length) {
            if ($customerIds.data('select2')) {
                $customerIds.select2('destroy');
            }

            $customerIds.select2({
                dropdownParent: $container.hasClass('discount_modal') ? $container : $customerIds.parent(),
                ajax: {
                    url: '/contacts/customers',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        var results = [];
                        for (var item in data) {
                            results.push({
                                id: data[item].id,
                                text: data[item].text,
                            });
                        }
                        return { results: results };
                    },
                },
                minimumInputLength: 1,
                closeOnSelect: true
            }).off('select2:select.discount').on('select2:select.discount', function() {
                $('input.select2-search__field').val('');
            });
        }

        $container.find('.discount_date').datepicker({
            autoclose: true,
            clearBtn: true,
            format: datepicker_date_format,
            container: $container.hasClass('discount_modal') ? '.discount_modal .modal-content' : 'body',
        });

        var isDiscountModal = $container.hasClass('discount_modal');
        $container.find('.discount_time').each(function () {
            var $input = $(this);
            var picker = $input.data('DateTimePicker');
            if (picker) {
                picker.destroy();
            }

            var $widgetParent = isDiscountModal ? $container.find('.modal-body') : $input.closest('.form-group');
            if (!isDiscountModal) {
                $widgetParent.css('position', 'relative');
            }

            $input.datetimepicker({
                format: moment_time_format,
                ignoreReadonly: true,
                showClear: true,
                widgetParent: $widgetParent,
                widgetPositioning: {
                    horizontal: 'left',
                    vertical: 'bottom',
                },
            });
        });

        $container.find('form#discount_form').validate();
    }

    $(document).on('shown.bs.modal', '.discount_modal', function () {
        initializeDiscountFormUi($(this));
    });

    $(document).ready(function () {
        var $pageForm = $('.discount-page-form');
        if ($pageForm.length) {
            initializeDiscountFormUi($pageForm);
        }
    });

    $(document).on('change', '#variation_ids', function(){
        if ($(this).val().length) {
            $('#brand_input').addClass('hide');
            $('#category_input').addClass('hide');
            $('#gender_input').addClass('hide');
            $('#procurement_source_input').addClass('hide');
        } else {
            $('#brand_input').removeClass('hide');
            $('#category_input').removeClass('hide');
            $('#gender_input').removeClass('hide');
            $('#procurement_source_input').removeClass('hide');
        }
    });

    $(document).on('change', '#discount_type', function(){
        let discount_type = $(this).val();
        if(discount_type == 'buy_for'){
            $('#default_discount_section').addClass('hide');
            $('#buy_free_qty_div').addClass('hide');
            $('#buy_qty_div').removeClass('hide');
            $('#buy_price_div').removeClass('hide');
            $('#buy_price_label').text('<?php echo app('translator')->get("lang_v1.total_price"); ?>*');
        }else if(discount_type == 'buy_for_unit_price'){
            $('#default_discount_section').addClass('hide');
            $('#buy_free_qty_div').addClass('hide');
            $('#buy_qty_div').removeClass('hide');
            $('#buy_price_div').removeClass('hide');
            $('#buy_price_label').text('<?php echo app('translator')->get("lang_v1.unit_price_label"); ?>*');
        }else if(discount_type == 'buy_get_free'){
            $('#default_discount_section').addClass('hide');
            $('#buy_price_div').addClass('hide');
            $('#buy_qty_div').removeClass('hide');
            $('#buy_free_qty_div').removeClass('hide');
        }else if(discount_type == 'fixed' || discount_type == 'percentage'){
            $('#buy_qty_div').addClass('hide');
            $('#buy_free_qty_div').addClass('hide');
            $('#buy_price_div').addClass('hide');
            $('#default_discount_section').removeClass('hide');
        }
    });

    $(document).on('change', '#type', function(){
        let type = $(this).val();
        if(type == 'invoice'){
            $('.product_fields').addClass('hide');
            $('.invoice_fields').removeClass('hide');
            $('#buy_free_qty_div').addClass('hide');
            $('#buy_qty_div').addClass('hide');
            $('#buy_price_div').addClass('hide');
        }else {
            $('.product_fields').removeClass('hide');
            $('.invoice_fields').addClass('hide');
        }
    });

    $(document).on('hidden.bs.modal', '.discount_modal', function(){
        var $modal = $(this);
        if ($modal.find("#variation_ids").data('select2')) {
            $modal.find("#variation_ids").select2('destroy');
        }
        if ($modal.find("#customer_ids").data('select2')) {
            $modal.find("#customer_ids").select2('destroy');
        }
    });

    function clearDiscountDateTime($field) {
        var $form = $field.closest('form#discount_form');
        var fieldId = $field.attr('id');
        var dateSelector = null;
        var timeSelector = null;

        if (fieldId === 'starts_at' || fieldId === 'starts_at_time') {
            dateSelector = '#starts_at';
            timeSelector = '#starts_at_time';
        } else if (fieldId === 'ends_at' || fieldId === 'ends_at_time') {
            dateSelector = '#ends_at';
            timeSelector = '#ends_at_time';
        }

        if (!dateSelector || !timeSelector) {
            return;
        }

        var $date = $form.find(dateSelector);
        var $time = $form.find(timeSelector);
        var timePicker = $time.data('DateTimePicker');

        if ($date.length && $date.data('datepicker')) {
            $date.datepicker('clearDates');
        }
        $date.val('').trigger('change');

        if (timePicker) {
            timePicker.clear();
        }
        $time.val('').trigger('change');
    }

    $(document).on('keydown', 'form#discount_form .discount_date, form#discount_form .discount_time', function (e) {
        if (e.key === 'Delete' || e.key === 'Backspace') {
            e.preventDefault();
            clearDiscountDateTime($(this));
        }
    });
</script>
