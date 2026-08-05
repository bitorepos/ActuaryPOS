
<?php
    $bb_categories = !empty($categories) && is_array($categories) ? array_slice($categories, 0, 18) : [];
    $bb_currency_symbol = session('currency')['symbol'] ?? '£';
    $bb_denominations = [5, 10, 20, 30, 40, 50, 100];
    $bb_user_name = trim(($logged_in_user->first_name ?? '') . ' ' . ($logged_in_user->last_name ?? ''));
    if ($bb_user_name === '') {
        $bb_user_name = auth()->user()->first_name ?? 'Cashier';
    }
    $bb_location_name = $default_location->name ?? '';
?>
<?php if(empty($pos_settings['disable_card_details_modal'])): ?>
    <input type="hidden" id="disable_card_details_modal" data-bb-card-direct="1">
<?php endif; ?>
<div class="bb-shell" id="bb-shell">

    
    <header class="bb-header">
        <div class="bb-header-left">
            <span class="bb-greet">Welcome, <strong><?php echo e($bb_user_name, false); ?></strong></span>
            <?php if($bb_location_name): ?>
                <span class="bb-loc"><?php echo e($bb_location_name, false); ?></span>
            <?php endif; ?>
        </div>
        <div class="bb-header-center">
            <a href="<?php echo e(route('home'), false); ?>" class="btn bb-home-btn" id="bb-home" data-home-url="<?php echo e(route('home'), false); ?>">
                <i class="fas fa-home"></i> HOME
            </a>
            <div class="bb-search-slot" id="bb-slot-search"><span class="bb-slot-placeholder">Search Item</span></div>
            <button type="button" class="btn bb-clear-btn" id="bb-clear-search"><i class="fas fa-eraser"></i>
                Clear</button>
        </div>
        <div class="bb-header-right">
            <div class="bb-customer-slot" id="bb-slot-customer"></div>
            <span class="bb-clock" id="bb-clock">00:00</span>
        </div>
    </header>

    
    <section class="bb-cats-area">
        
        <div class="bb-cats-row">
            <button type="button" class="btn bb-cats-nav bb-cats-prev" id="bb-prev-page" title="Previous categories">
                <i class="fas fa-chevron-left"></i>
            </button>
            <div class="bb-cats-scroll" id="bb-cats-scroll">
                <div class="bb-cats-grid" id="bb-cats-grid">
                    <?php $__empty_1 = true; $__currentLoopData = $bb_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bb_cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <button type="button" class="btn bb-category-tile" data-category_id="<?php echo e($bb_cat['id'], false); ?>"
                            data-category_name="<?php echo e($bb_cat['name'], false); ?>"
                            onclick="event.preventDefault();event.stopPropagation();if(window.bbLoadCategoryProducts){window.bbLoadCategoryProducts('<?php echo e($bb_cat['id'], false); ?>', window.jQuery ? jQuery(this) : null);}else{alert('bb not ready');}return false;"
                            title="<?php echo e($bb_cat['name'], false); ?>">
                            <span class="bb-category-thumb"><i class="fas fa-th-large"></i></span>
                            <span class="bb-category-name"><?php echo e($bb_cat['name'], false); ?></span>
                        </button>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="bb-empty-cats">
                            <?php echo app('translator')->get('lang_v1.no_records_found'); ?> — <?php echo app('translator')->get('product.category'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <button type="button" class="btn bb-cats-nav bb-cats-next" id="bb-next-page" title="Next categories">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        
        <div class="bb-products-pane">
            <input type="hidden" id="suggestion_page" value="1">
            <div id="suggestion_page_loader" style="display:none; text-align:center; padding:10px;">
                <i class="fas fa-spinner fa-spin"></i> Loading…
            </div>
            <div id="product_list_body" class="row m-0"></div>
        </div>
    </section>

    
    <section class="bb-cart-area">
        <div class="bb-cart-slot" id="bb-slot-cart"></div>
    </section>

    
    <section class="bb-totals-area">
        <div class="bb-totals-slot" id="bb-slot-totals"></div>
    </section>

    
    <section class="bb-action-area">
        <div class="bb-numpad">
            <?php $__currentLoopData = [1, 2, 3, 4, 5, 6, 7, 8, 9]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bb_n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <button type="button" class="btn bb-numpad-btn" data-bb_num="<?php echo e($bb_n, false); ?>"><?php echo e($bb_n, false); ?></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <button type="button" class="btn bb-numpad-btn" data-bb_num="0">0</button>
            <button type="button" class="btn bb-numpad-btn" data-bb_num=".">.</button>
            <button type="button" class="btn bb-numpad-btn bb-ce" id="bb-ce">CE</button>
        </div>
        <div class="bb-pay-row">
            <button type="button" class="btn bb-action-btn bb-pay-btn" id="bb-pay">PAY<br><small>Cash /
                    Multi-pay</small></button>
            <button type="button" class="btn bb-action-btn bb-card-btn" id="bb-card">CARD<br><small>Chip &amp;
                    PIN</small></button>
            <button type="button" class="btn bb-action-btn bb-cash-btn" id="bb-cash">CASH<br><small>Express
                    Checkout</small></button>
        </div>
    </section>

    
    <footer class="bb-footer-bar">
        <button type="button" class="btn bb-footer-btn bb-footer-exit" id="bb-exit"><i
                class="fas fa-sign-out-alt"></i><span>EXIT</span></button>
        <button type="button" class="btn bb-footer-btn bb-footer-logout" id="bb-logout"
            data-logout-url="<?php echo e(route('logout'), false); ?>" data-csrf-token="<?php echo e(csrf_token(), false); ?>"><i
                class="fas fa-power-off"></i><span>Logout</span></button>
        <a href="<?php echo e(action([\App\Http\Controllers\BusinessController::class, 'getBusinessSettings']), false); ?>"
            class="btn bb-footer-btn bb-footer-setup"><i class="fas fa-cog"></i><span>Setup</span></a>
        <button type="button" class="btn bb-footer-btn bb-footer-sales" data-bs-toggle="modal"
            data-bs-target="#recent_transactions_modal" id="recent-transactions"><i
                class="fas fa-receipt"></i><span>Sales</span></button>
        <button type="button" class="btn bb-footer-btn bb-footer-opentill" id="bb-open-till"><i
                class="fas fa-cash-register"></i><span>Open Till</span></button>
        <button type="button" class="btn bb-footer-btn bb-footer-minimize" id="bb-minimize"><i
                class="fas fa-expand"></i><span>Fullscreen</span></button>
        <button type="button" class="btn bb-footer-btn bb-footer-lookup" id="bb-lookup"><i
                class="fas fa-search"></i><span>Product Lookup</span></button>
        <button type="button" class="btn bb-footer-btn bb-footer-keyboard" id="bb-keyboard"><i
                class="fas fa-keyboard"></i><span>Keyboard</span></button>
        <button type="button" class="btn bb-footer-btn bg-danger bb-cancel-sale" id="bb-cancel"><i
                class="fas fa-eraser"></i>
            Clear</button>
    </footer>
</div>


<script>
    window.bbLoadCategoryProducts = function (catId, $tile) {
        if (!window.jQuery) { alert('jQuery not loaded'); return; }
        var $ = window.jQuery;
        $('.bb-category-tile.active').removeClass('active');
        if ($tile && $tile.length) { $tile.addClass('active'); }

        var locationId = $('#location_id').val() || '';
        var $list = $('#product_list_body');
        if (!$list.length) { alert('product_list_body missing'); return; }

        $list.html('<div class="col-12 text-center py-3" style="font-size:14px;color:#2c3e50;">'
            + '<i class="fas fa-spinner fa-spin"></i> Loading products for category #' + catId + '…</div>');
        $('#suggestion_page').val(1);
        $('#suggestion_page_loader').hide();

        $.ajax({
            method: 'GET',
            url: '/sells/pos/get-product-suggestion',
            data: { category_id: catId, brand_id: '', location_id: locationId, page: 1 },
            dataType: 'html'
        }).done(function (html) {
            $list.html(html && html.length
                ? html
                : '<div class="col-12 text-center py-3 text-muted">No products in this category.</div>');
        }).fail(function (xhr) {
            console.error('[bb] product-suggestion failed', xhr.status, xhr.responseText);
            $list.html('<div class="col-12 text-center text-danger py-3">Failed to load products (HTTP ' + xhr.status + ').</div>');
        });
    };
</script>

<script>
    (function initBbIIFE() {
        if (!window.jQuery) {
            setTimeout(initBbIIFE, 50);
            return;
        }
        var $ = window.jQuery;
        'use strict';

        /* -------------------------------------------------------------
         * 1) Move existing POS form pieces into the kiosk slots.
         *    The original DOM stays in the page (still inside the form),
         *    just relocated visually so existing JS hooks keep working.
         * ----------------------------------------------------------- */
        function bbMountSlots() {
            var $shell = $('#bb-shell');
            var $cartSlot = $('#bb-slot-cart');

            if (!$shell.length || $shell.data('bb-mounted')) {
                return;
            }

            // Wait until the pos_form has rendered the cart table.
            // If it isn't there yet, retry shortly without claiming "mounted".
            if (!$('#pos_table').length) {
                setTimeout(bbMountSlots, 150);
                return;
            }

            // Search field: prefer search_product (name), then SKU, then sub_sku.
            var $search = $('#search_product').first();
            if ($search.length) {
                var $searchWrap = $search.closest('.input-group, .form-group').first();
                if (!$searchWrap.length) { $searchWrap = $search; }
                $('#bb-slot-search').empty().append($searchWrap);
            }

            // Customer select.
            var $customer = $('#customer_id').first();
            if ($customer.length) {
                // select2 wraps it; grab the form-group for label-less reuse.
                var $custWrap = $customer.closest('.form-group, .col-md-4, .col-md-6').first();
                if (!$custWrap.length) { $custWrap = $customer; }
                $('#bb-slot-customer').empty().append($custWrap);
            }

            // Cart table. Move the <table> itself (not its wrapper) into a
            // clean container in the kiosk shell so no inherited inline styles
            // from the original pos_form container can hide it.
            var $cart = $('#pos_table').first();
            if ($cart.length) {
                $cartSlot
                    .empty()
                    .append('<div class="bb-cart-table-wrap"></div>')
                    .find('.bb-cart-table-wrap')
                    .append($cart);

                // Diagnostic strip — remove once layout confirmed working.
                var info = {
                    count: $('body').find('#pos_table').length,
                    inSlot: $('#bb-slot-cart').find('#pos_table').length,
                    rows: $('#bb-slot-cart').find('#pos_table > tbody > tr').length,
                    tDisp: $('#bb-slot-cart').find('#pos_table').css('display'),
                    tVis: $('#bb-slot-cart').find('#pos_table').is(':visible'),
                    tW: $('#bb-slot-cart').find('#pos_table').width(),
                    tH: $('#bb-slot-cart').find('#pos_table').height(),
                    slotW: $cartSlot.width(),
                    slotH: $cartSlot.height()
                };
                console.log('[bb] cart mounted', info);

                // Toggle the empty-state placeholder whenever cart rows change.
                function bbRefreshCartEmptyState() {
                    var hasRows = $('#pos_table > tbody > tr').not('.bb-ignore-row').length > 0;
                    $cartSlot.toggleClass('bb-cart-empty', !hasRows);
                }
                bbRefreshCartEmptyState();
                try {
                    var tbodyEl = $('#pos_table > tbody').get(0);
                    if (tbodyEl && window.MutationObserver) {
                        new MutationObserver(bbRefreshCartEmptyState)
                            .observe(tbodyEl, { childList: true });
                    }
                } catch (e) { /* ignore */ }
            } else {
                $cartSlot.html('<div style="padding:12px;color:#c0392b;font-size:12px;">[bb] #pos_table not found at mount time.</div>');
            }

            // Totals row.
            var $totals = $('.pos_form_totals').first();
            if ($totals.length) {
                $('#bb-slot-totals').empty().append($totals);
            }

            $shell.data('bb-mounted', true);
        }

        /* -------------------------------------------------------------
         * 2) Helpers.
         * ----------------------------------------------------------- */
        function bbClick(selector) {
            var $el = $(selector).filter(':not(:disabled):not(.hide)').first();
            if ($el.length) { $el.trigger('click'); return true; }
            return false;
        }

        function bbFindExpressFinalize(payMethod) {
            return $('.pos-express-finalize').filter(function () {
                return $(this).data('pay_method') === payMethod || $(this).attr('data-pay_method') === payMethod;
            }).filter(':not(:disabled):not(.hide)').first();
        }

        function bbPrepareDirectCardFinalize() {
            if ($('#disable_card_details_modal').length) {
                return;
            }

            var $form = $('#add_pos_sell_form, #edit_pos_sell_form').first();
            $('<input>', {
                type: 'hidden',
                id: 'disable_card_details_modal',
                'data-bb-card-direct': '1'
            }).appendTo($form.length ? $form : $('body'));
        }

        function bbExpressFinalize(payMethod, options) {
            options = options || {};
            var $button = bbFindExpressFinalize(payMethod);

            if (!$button.length) {
                if (typeof toastr !== 'undefined') {
                    toastr.warning(payMethod === 'card'
                        ? 'Card express checkout is not available.'
                        : 'Express checkout is not available.');
                }
                return false;
            }

            if (options.directCard) {
                bbPrepareDirectCardFinalize();
            }

            $button.trigger('click');
            return true;
        }

        function bbFocusKeyboardTarget() {
            var $target = $('#search_product:visible').first();
            if (!$target.length) { $target = $('#search_product').first(); }
            if (!$target.length) { return; }

            $target.trigger('focus').trigger('click');
            try {
                var input = $target.get(0);
                if (input && typeof input.setSelectionRange === 'function') {
                    var caret = (input.value || '').length;
                    input.setSelectionRange(caret, caret);
                }
            } catch (e) { /* noop */ }
        }

        function bbOpenWindowsKeyboard() {
            bbFocusKeyboardTarget();

            var bridgeMethods = [
                'openOnScreenKeyboard',
                'openWindowsKeyboard',
                'openKeyboard',
                'showKeyboard'
            ];

            if (window.electronAPI) {
                for (var i = 0; i < bridgeMethods.length; i++) {
                    var method = bridgeMethods[i];
                    if (typeof window.electronAPI[method] === 'function') {
                        try {
                            var result = window.electronAPI[method]();
                            if (result && typeof result.catch === 'function') {
                                result.catch(function () {
                                    if (!bbOpenWindowsKeyboardWithNode()) {
                                        bbOpenWindowsKeyboardViaServer();
                                    }
                                });
                            }
                            return true;
                        } catch (e) { /* try the next option */ }
                    }
                }
            }

            if (navigator.virtualKeyboard && typeof navigator.virtualKeyboard.show === 'function') {
                try {
                    navigator.virtualKeyboard.show();
                    return true;
                } catch (e) { /* continue to native desktop fallback */ }
            }

            return bbOpenWindowsKeyboardWithNode();
        }

        function bbOpenWindowsKeyboardWithNode() {
            var commonFiles = 'C:\\Program Files\\Common Files';
            try {
                if (window.process && window.process.env && window.process.env.CommonProgramFiles) {
                    commonFiles = window.process.env.CommonProgramFiles;
                }
            } catch (e) { /* noop */ }

            var tabTipPath = commonFiles + '\\Microsoft Shared\\ink\\TabTip.exe';

            if (window.nw && window.nw.Shell && typeof window.nw.Shell.openItem === 'function') {
                try {
                    window.nw.Shell.openItem(tabTipPath);
                    return true;
                } catch (e) {
                    try {
                        window.nw.Shell.openItem('osk.exe');
                        return true;
                    } catch (e2) { /* noop */ }
                }
            }

            if (!window.require) { return false; }

            try {
                var childProcess = window.require('child_process');
                childProcess.execFile(tabTipPath, [], { windowsHide: false }, function (error) {
                    if (error) {
                        childProcess.execFile('osk.exe', [], { windowsHide: false }, function () { });
                    }
                });
                return true;
            } catch (e) {
                try {
                    var fallbackProcess = window.require('child_process');
                    fallbackProcess.execFile('osk.exe', [], { windowsHide: false }, function () { });
                    return true;
                } catch (e2) { /* noop */ }
            }

            return false;
        }

        function bbOpenWindowsKeyboardViaServer() {
            if (!window.jQuery) { return; }

            $.ajax({
                method: 'POST',
                url: '<?php echo e(route('pos.openWindowsKeyboard'), false); ?>',
                data: { _token: '<?php echo e(csrf_token(), false); ?>' },
                dataType: 'json'
            }).done(function (result) {
                if (!result || result.success !== true) {
                    if (typeof toastr !== 'undefined') {
                        toastr.info((result && result.msg) ? result.msg : 'Tap the search box to show the keyboard.');
                    }
                }
            }).fail(function (xhr) {
                if (typeof toastr !== 'undefined') {
                    var msg = xhr.responseJSON && xhr.responseJSON.msg
                        ? xhr.responseJSON.msg
                        : 'Tap the search box to show the keyboard.';
                    toastr.info(msg);
                }
            });
        }

        function bbTextFromHtml(raw) {
            return $.trim($('<div>').html(raw || '').text().replace(/\s+/g, ' '));
        }

        function bbGetPaymentValidationMessage(validator) {
            var errorItem = validator && validator.errorList && validator.errorList.length
                ? validator.errorList[0]
                : null;
            var $field = errorItem && errorItem.element ? $(errorItem.element) : $();
            var $row = $field.closest('tr.product_row');
            var message = errorItem && errorItem.message ? errorItem.message : '';

            if (!message && $row.length) {
                message = $.trim($row.find('label.error:visible').first().text());
                if (!message) {
                    message = $.trim($row.find('label.error').first().text());
                }
            }

            if (!message && $field.length) {
                message = $field.data('msg-max-value')
                    || $field.data('msg_max_default')
                    || $field.attr('data-msg-max-value')
                    || $field.attr('data-msg-required')
                    || '';
            }

            var productName = '';
            if ($row.length) {
                productName = bbTextFromHtml($row.find('.product_name').first().val());
                if (!productName) {
                    productName = bbTextFromHtml($row.find('.product_name_td').first().html());
                }
            }

            message = $.trim(message || 'Please correct the highlighted sale item.');
            return productName ? productName + ': ' + message : message;
        }

        function bbPaymentModalIsOpen() {
            var $modal = $('#modal_payment');
            return $modal.length && ($modal.is(':visible') || $modal.hasClass('show'));
        }

        function bbShowPaymentValidation(message) {
            if (!bbPaymentModalIsOpen()) {
                return;
            }

            var $modal = $('#modal_payment');
            var $body = $modal.find('.modal-body').first();
            if (!$body.length) {
                return;
            }

            var $alert = $('#bb-payment-validation-alert');
            if (!$alert.length) {
                $alert = $(
                    '<div id="bb-payment-validation-alert" class="bb-payment-validation-alert" role="alert">' +
                    '<i class="fas fa-exclamation-triangle"></i>' +
                    '<div class="bb-payment-validation-copy">' +
                    '<strong>Cannot finalize sale.</strong>' +
                    '<span></span>' +
                    '</div>' +
                    '</div>'
                );
                $body.prepend($alert);
            }

            $alert.find('span').text(message);
        }

        function bbBindPaymentValidation() {
            $('#add_pos_sell_form, #edit_pos_sell_form')
                .off('invalid-form.validate.bbPayment')
                .on('invalid-form.validate.bbPayment', function (event, validator) {
                    $('.pos-express-finalize').prop('disabled', false).removeAttr('disabled');
                    if (!bbPaymentModalIsOpen()) {
                        return;
                    }
                    bbShowPaymentValidation(bbGetPaymentValidationMessage(validator));
                    event.stopImmediatePropagation();
                });
        }

        var $tendered = $('#bb-tendered');
        var bbTypingTarget = null;

        function bbIsWritableTarget(el) {
            if (!el) { return false; }
            var $el = $(el);
            if (!$el.length || !$el.is(':visible') || $el.is(':disabled,[readonly]')) { return false; }
            if ($el.closest('.bb-numpad, .bb-footer-bar, .bb-pay-row').length) { return false; }
            if ($el.is('textarea')) { return true; }
            if ($el.is('input')) {
                var type = String($el.attr('type') || 'text').toLowerCase();
                return ['button', 'checkbox', 'file', 'hidden', 'image', 'radio', 'reset', 'submit'].indexOf(type) === -1;
            }
            return $el.is('[contenteditable="true"],[contenteditable=""],[contenteditable]');
        }

        function bbRememberTypingTarget(el) {
            if (bbIsWritableTarget(el)) {
                bbTypingTarget = el;
            }
        }

        function bbGetTypingTarget() {
            if (bbIsWritableTarget(document.activeElement)) {
                return document.activeElement;
            }
            if (bbTypingTarget && document.documentElement.contains(bbTypingTarget) && bbIsWritableTarget(bbTypingTarget)) {
                return bbTypingTarget;
            }
            return null;
        }

        function bbTriggerTypingEvents(el) {
            $(el).trigger('input').trigger('keyup').trigger('change');
        }

        function bbSetTypingTargetValue(el, value, caretPos) {
            if ($(el).is('[contenteditable="true"],[contenteditable=""],[contenteditable]')) {
                $(el).text(value);
                bbTriggerTypingEvents(el);
                return;
            }

            el.value = value;
            try {
                if (typeof el.setSelectionRange === 'function') {
                    el.setSelectionRange(caretPos, caretPos);
                }
            } catch (e) { /* number inputs do not always allow selection ranges */ }
            bbTriggerTypingEvents(el);
        }

        function bbInsertIntoTypingTarget(text) {
            var el = bbGetTypingTarget();
            if (!el) { return false; }

            bbRememberTypingTarget(el);
            try { el.focus(); } catch (e) { /* noop */ }

            if ($(el).is('[contenteditable="true"],[contenteditable=""],[contenteditable]')) {
                if (document.queryCommandSupported && document.queryCommandSupported('insertText')) {
                    document.execCommand('insertText', false, text);
                } else {
                    $(el).text(($(el).text() || '') + text);
                }
                bbTriggerTypingEvents(el);
                return true;
            }

            var value = String(el.value || '');
            var start = typeof el.selectionStart === 'number' ? el.selectionStart : value.length;
            var end = typeof el.selectionEnd === 'number' ? el.selectionEnd : start;

            if (text === '.' && value.indexOf('.') !== -1 && start === end) {
                return true;
            }

            var nextValue = value.slice(0, start) + text + value.slice(end);
            var caretPos = start + String(text).length;
            bbSetTypingTargetValue(el, nextValue, caretPos);
            return true;
        }

        function bbClearTypingTarget() {
            var el = bbGetTypingTarget();
            if (!el) { return false; }
            bbRememberTypingTarget(el);
            try { el.focus(); } catch (e) { /* noop */ }
            bbSetTypingTargetValue(el, '', 0);
            return true;
        }

        function bbReadTendered() {
            var v = parseFloat(($tendered.val() || '0').replace(/,/g, ''));
            return isNaN(v) ? 0 : v;
        }
        function bbSetTendered(val) {
            $tendered.val(parseFloat(val || 0).toFixed(2));
        }

        /* -------------------------------------------------------------
         * 3) Numpad / denominations / EXACT.
         * ----------------------------------------------------------- */
        $(document).on('focusin mousedown click', 'input, textarea, [contenteditable]', function () {
            bbRememberTypingTarget(this);
        });
        $(document).on('mousedown', '.bb-numpad-btn', function (e) {
            e.preventDefault();
        });
        $(document).on('click', '.bb-numpad-btn:not(.bb-ce)', function (e) {
            e.preventDefault();
            var n = String($(this).data('bb_num'));
            if (bbInsertIntoTypingTarget(n)) {
                return;
            }
            var raw = ($tendered.val() || '').replace(/[^0-9]/g, '');
            raw = raw + n;
            if (raw.length > 9) { raw = raw.slice(-9); }
            bbSetTendered(parseInt(raw, 10) / 100);
        });
        $(document).on('click', '#bb-ce', function (e) {
            e.preventDefault();
            if (!bbClearTypingTarget()) {
                bbSetTendered(0);
            }
        });
        $(document).on('click', '.bb-denom-btn', function () {
            bbSetTendered(bbReadTendered() + (parseFloat($(this).data('bb_denom')) || 0));
        });
        $(document).on('click', '#bb-exact', function () {
            var $price = $('.price_total, #total_payable, #total_payable_span').first();
            var t = parseFloat(($price.text() || '0').replace(/[^0-9.\-]/g, ''));
            bbSetTendered(isNaN(t) ? 0 : t);
        });

        /* -------------------------------------------------------------
         * 4) Action button proxies (delegate to existing POS buttons).
         * ----------------------------------------------------------- */
        $(document).on('click', '#bb-pay', function () {
            if (!bbClick('#pos-finalize')) { bbClick('.pos-express-finalize[data-pay_method="cash"]'); }
        });
        $(document).on('click', '#bb-card', function (e) {
            e.preventDefault();
            bbExpressFinalize('card', { directCard: true });
        });
        $(document).on('click', '#bb-cash', function () {
            if (!bbClick('.pos-express-finalize[data-pay_method="cash"]')) { bbClick('#pos-finalize'); }
        });
        $(document).on('click', '#bb-cancel', function () { bbClick('#pos-cancel'); });
        $(document).on('click', '#bb-hold', function () {
            bbClick('#pos-suspend, .pos-suspend, [data-form_action="suspend"]');
        });
        $(document).on('click', '#bb-resume', function () {
            bbClick('#pos_recent_transcations_btn, .recent_transactions_btn, .btn-modal[data-container="#recent_drafts_modal"]');
        });
        $(document).on('click', '#bb-lookup', function () {
            if (!bbClick('#open_products_search_modal')) { $('#search_product').trigger('focus'); }
        });
        $(document).on('click', '#bb-payouts', function () {
            bbClick('.btn-modal[data-container="#expense_modal"], #pos_add_expense_btn');
        });
        $(document).on('click', '#bb-open-till', function (e) {
            e.preventDefault();
            if (typeof window.open_pos_cash_drawer_from_current_location === 'function') {
                window.open_pos_cash_drawer_from_current_location();
            } else if (typeof toastr !== 'undefined') {
                toastr.warning('Cash drawer is not ready.');
            }
        });
        $(document).on('click', '#bb-clear-search', function () {
            $('#search_product').val('').trigger('keyup').trigger('focus');
        });
        $(document).on('click', '#bb-home', function (e) {
            e.preventDefault();
            window.location.assign($(this).data('home-url') || '<?php echo e(route('home'), false); ?>');
        });
        $(document).on('click', '#bb-logout', function (e) {
            e.preventDefault();

            var $button = $(this);
            if ($button.data('logging-out')) {
                return;
            }
            $button.data('logging-out', true).prop('disabled', true);

            $('<form>', {
                method: 'POST',
                action: $button.data('logout-url')
            })
                .append($('<input>', {
                    type: 'hidden',
                    name: '_token',
                    value: $button.data('csrf-token')
                }))
                .appendTo('body')
                .trigger('submit');
        });

        /* -------------------------------------------------------------
         * 5) Category tile click bindings. The actual loader is defined
         *    as a top-level window.bbLoadCategoryProducts above so the
         *    inline onclick can always reach it regardless of script
         *    evaluation order or errors in this IIFE.
         * ----------------------------------------------------------- */

        // Delegated jQuery binding (covers tiles re-rendered dynamically).
        $(document).on('click', '.bb-category-tile', function (e) {
            e.preventDefault();
            e.stopPropagation();
            var $tile = $(this);
            var catId = $tile.attr('data-category_id');
            if (window.bbLoadCategoryProducts) {
                window.bbLoadCategoryProducts(catId, $tile);
            }
        });

        // Vanilla fallback: attach directly to every tile already in the DOM,
        // so the handler runs even if jQuery delegation is broken by another script.
        function bbBindCategoryTilesDirect() {
            var tiles = document.querySelectorAll('.bb-category-tile');
            tiles.forEach(function (btn) {
                if (btn.__bbBound) { return; }
                btn.__bbBound = true;
                btn.addEventListener('click', function (e) {
                    e.preventDefault();
                    var id = btn.getAttribute('data-category_id');
                    if (window.bbLoadCategoryProducts) {
                        window.bbLoadCategoryProducts(id, $(btn));
                    }
                }, false);
            });
        }

        /* -------------------------------------------------------------
         * 5b) Prev / Next horizontally scroll the categories strip.
         * ----------------------------------------------------------- */
        function getBbScrollAmount() {
            var grid = document.getElementById('bb-cats-grid');
            if (!grid) return 240;
            var tiles = grid.querySelectorAll('.bb-category-tile');
            if (tiles.length >= 2) {
                // The exact width of one tile + any gap/margin is the distance between their left edges.
                return tiles[1].getBoundingClientRect().left - tiles[0].getBoundingClientRect().left;
            } else if (tiles.length === 1) {
                return tiles[0].offsetWidth;
            }
            return 240;
        }

        $(document).on('click', '#bb-prev-page', function () {
            var el = document.getElementById('bb-cats-scroll');
            if (el) { el.scrollBy({ left: -getBbScrollAmount(), behavior: 'smooth' }); }
        });
        $(document).on('click', '#bb-next-page', function () {
            var el = document.getElementById('bb-cats-scroll');
            if (el) { el.scrollBy({ left: getBbScrollAmount(), behavior: 'smooth' }); }
        });

        /* -------------------------------------------------------------
         * 6) Fullscreen toggle.
         * ----------------------------------------------------------- */
        $(document).on('click', '#bb-minimize', function () {
            try {
                if (!document.fullscreenElement) { document.documentElement.requestFullscreen(); }
                else if (document.exitFullscreen) { document.exitFullscreen(); }
            } catch (e) { /* noop */ }
        });
        $(document).on('click', '#bb-exit', function () {
            if (document.fullscreenElement && document.exitFullscreen) { document.exitFullscreen(); }
            if (window.history.length > 1) { window.history.back(); }
            else { window.location.href = '<?php echo e(url('/home'), false); ?>'; }
        });
        $(document).on('click', '#bb-keyboard', function (e) {
            e.preventDefault();
            if (!bbOpenWindowsKeyboard()) {
                bbOpenWindowsKeyboardViaServer();
            }
        });
        $(document).on('change input', '#pos_table input, #pos_table select, #pos_table textarea', function () {
            $('#bb-payment-validation-alert').remove();
        });
        $(document).on('hidden.bs.modal show.bs.modal', '#modal_payment', function () {
            $('#bb-payment-validation-alert').remove();
        });

        /* -------------------------------------------------------------
         * 7) Live clock + slot mount on DOM ready.
         * ----------------------------------------------------------- */
        function bbTickClock() {
            var d = new Date();
            var hh = String(d.getHours()).padStart(2, '0');
            var mm = String(d.getMinutes()).padStart(2, '0');
            $('#bb-clock').text(hh + ':' + mm);
        }

        $(function () {
            document.body.classList.add('pos-interface-big-buttons-body');
            bbBindPaymentValidation();
            // Defer so Select2 / pos_form init finishes before we relocate nodes.
            setTimeout(bbMountSlots, 200);
            // Bind direct click listeners on category tiles as a safety net.
            setTimeout(bbBindCategoryTilesDirect, 250);
            // Auto-select the first category so products load on entry.
            setTimeout(function () {
                var $first = $('.bb-category-tile').first();
                if ($first.length && !$('.bb-category-tile.active').length) {
                    $first.trigger('click');
                }
            }, 600);
            bbTickClock();
            setInterval(bbTickClock, 30 * 1000);

            // After payment finalize, the receipt overlay closes and pos_form
            // is re-rendered; re-mount slots if needed.
            $(document).on('pos:reset pos.form.reset', function () {
                // small delay so the new DOM has settled
                setTimeout(bbMountSlots, 50);
            });
        });

        /* -------------------------------------------------------------
         * Safety net: $(function) inside a partial is sometimes never
         * fired (e.g. when pos.js throws after our script runs). Kick
         * off mount + clock immediately so the kiosk is usable even
         * if DOM-ready never resolves on this page.
         * ----------------------------------------------------------- */
        try { document.body.classList.add('pos-interface-big-buttons-body'); } catch (e) { }
        bbBindPaymentValidation();
        bbTickClock();
        setInterval(bbTickClock, 30 * 1000);
        // Poll until #pos_table is rendered then mount.
        (function bbWaitForCart() {
            if ($('#pos_table').length && $('#bb-shell').length) {
                bbMountSlots();
                bbBindCategoryTilesDirect();
                var $first = $('.bb-category-tile').first();
                if ($first.length && !$('.bb-category-tile.active').length) {
                    $first.trigger('click');
                }
                return;
            }
            setTimeout(bbWaitForCart, 100);
        })();
    })();
</script>

<script>
    /* ============================================================
     * STANDALONE KIOSK MOUNT — runs even if the IIFE above throws.
     * Self-contained: no dependencies on IIFE-scoped functions.
     * ============================================================ */
    (function () {
        function setDebug(msg) {
            if (window.console && console.debug) { console.debug(msg); }
        }
        function tickClock() {
            var d = new Date();
            var hh = String(d.getHours()).padStart(2, '0');
            var mm = String(d.getMinutes()).padStart(2, '0');
            var el = document.getElementById('bb-clock');
            if (el) { el.textContent = hh + ':' + mm; }
        }
        tickClock();
        setInterval(tickClock, 30 * 1000);

        var tries = 0;
        function bbStandaloneMount() {
            tries++;
            if (!window.jQuery) {
                setDebug('[bb-standalone] waiting for jQuery… try ' + tries);
                if (tries < 100) { setTimeout(bbStandaloneMount, 100); }
                return;
            }
            var $ = window.jQuery;
            var $shell = $('#bb-shell');
            var $cartSlot = $('#bb-slot-cart');
            var $cart = $('#pos_table').first();

            if (!$shell.length || !$cartSlot.length) {
                setDebug('[bb-standalone] missing shell/slot (try ' + tries + ')');
                return;
            }
            if (!$cart.length) {
                setDebug('[bb-standalone] waiting for #pos_table… try ' + tries);
                if (tries < 100) { setTimeout(bbStandaloneMount, 150); }
                return;
            }

            // Move the existing #pos_table into the cart slot.
            if (!$cartSlot.find('#pos_table').length) {
                $cartSlot.empty()
                    .append('<div class="bb-cart-table-wrap" style="overflow:auto;max-height:100%;"></div>')
                    .find('.bb-cart-table-wrap').append($cart);
            }

            // Move search & customer if not already moved.
            var $search = $('#search_product').first();
            if ($search.length && !$('#bb-slot-search').find('#search_product').length) {
                var $sw = $search.closest('.input-group, .form-group').first();
                if (!$sw.length) { $sw = $search; }
                $('#bb-slot-search').empty().append($sw);
            }
            var $cust = $('#customer_id').first();
            if ($cust.length && !$('#bb-slot-customer').find('#customer_id').length) {
                var $cw = $cust.closest('.form-group, .col-md-4, .col-md-6').first();
                if (!$cw.length) { $cw = $cust; }
                $('#bb-slot-customer').empty().append($cw);
            }
            var $totals = $('.pos_form_totals').first();
            if ($totals.length && !$('#bb-slot-totals').find('.pos_form_totals').length) {
                $('#bb-slot-totals').empty().append($totals);
            }

            // Force-style the cart table.
            $cart.css({
                'table-layout': 'auto', 'width': '100%',
                'display': 'table', 'visibility': 'visible', 'opacity': 1,
                'background': '#fff'
            });
            $cart.find('thead').css({ 'position': 'static', 'display': 'table-header-group' });

            var info = {
                rows: $cart.find('tbody > tr').length,
                tH: $cart.height(),
                slotW: $cartSlot.width(),
                slotH: $cartSlot.height()
            };
            setDebug('[bb-standalone OK] ' + JSON.stringify(info));
            console.log('[bb-standalone] mounted', info);

            // Watch tbody so newly-added rows get a visible default qty of 1
            // AND so trailing cells that mismatch the kiosk header are removed
            // (profit_margin, last_purchase, inc_tax, tax, sr_imei, etc.).
            function bbCleanRow($row) {
                // Remove ONLY the extra/auxiliary cells so the row has the same
                // visible cell count as the kiosk thead:
                // # | Product | Qty | Unit Price | Subtotal | X
                $row.find('td').each(function () {
                    var $td = $(this);
                    if ($td.find('.row_discount_amount, .pos_unit_price, .pos_unit_price_after_discount, .sell_line_tax_id, .pos_unit_price_inc_tax, .order_line_service_staff, .profit_margin_text, .serial_number, .imei_number, .row_add_serial_numbers_btn').length) {
                        $td.css('display', 'none');
                        $td.addClass('bb-hidden-cell');
                        return;
                    }
                    if ($td.hasClass('hide')) {
                        $td.css('display', 'none');
                        $td.addClass('bb-hidden-cell');
                    }
                });
            }
            function bbEnsureQtyDefaults() {
                $cart.find('tbody > tr').each(function () {
                    var $row = $(this);
                    // Make sure underlying (now-detached) qty input still has a
                    // value of at least 1 BEFORE we remove the cell, so totals
                    // calculate correctly. The input is set in the source row
                    // template already, but newly added rows can land empty.
                    var $qty = $row.find('input.pos_quantity').first();
                    if ($qty.length) {
                        var v = ($qty.val() || '').trim();
                        if (v === '' || v === '0' || v === '0.00' || parseFloat(v) === 0) {
                            $qty.val('1').trigger('change');
                        }
                        // Force visibility on the qty input + its wrapper.
                        $qty.attr('style',
                            'display:inline-block !important;' +
                            'visibility:visible !important;' +
                            'opacity:1 !important;' +
                            'width:100% !important;' +
                            'min-width:50px !important;' +
                            'height:34px !important;' +
                            'font-size:15px !important;' +
                            'font-weight:700 !important;' +
                            'text-align:center !important;' +
                            'background:#fffce8 !important;' +
                            'color:#2c3e50 !important;' +
                            'border:1px solid #c4cfd9 !important;' +
                            'border-radius:4px !important;' +
                            'padding:2px 4px !important;'
                        );
                        $qty.closest('.multi-input,.input-number').attr('style',
                            'display:flex !important;' +
                            'flex-wrap:nowrap !important;' +
                            'align-items:stretch !important;' +
                            'width:100% !important;' +
                            'visibility:visible !important;' +
                            'opacity:1 !important;'
                        );
                        $qty.closest('td').attr('style',
                            'display:table-cell !important;' +
                            'visibility:visible !important;' +
                            'opacity:1 !important;' +
                            'padding:6px 4px !important;' +
                            'vertical-align:middle !important;'
                        );
                    }
                    bbCleanRow($row);
                });
            }
            // Same cleanup on the thead so it also matches exactly.
            $cart.find('thead > tr > th').each(function () {
                var $th = $(this);
                if ($th.hasClass('hide')) { $th.remove(); }
            });
            // Force the QUANTITY header label so it can't render blank.
            (function () {
                var $ths = $cart.find('thead > tr > th');
                // 1) Find by text first (Qty / Quantity).
                var $qtyTh = $ths.filter(function () {
                    var t = ($(this).text() || '').trim().toLowerCase();
                    return t === 'qty' || t === 'quantity' || t.indexOf('qty') !== -1;
                }).first();
                // 2) Fallback: pick the th sitting at the same column index
                //    as the .pos_quantity td (using a freshly-built skeleton row
                //    if the cart is empty, we just guess col 3 = # Product Qty).
                if (!$qtyTh.length) {
                    $qtyTh = $ths.eq(3); // 0:# 1:Product 2:? 3:Qty (when sr_imei stayed)
                    if (!$qtyTh.length || ($qtyTh.text() || '').trim() !== '') {
                        $qtyTh = $ths.eq(2);
                    }
                }
                if ($qtyTh.length) {
                    $qtyTh.text('QUANTITY').attr('style',
                        'background:#1f6f8b !important;color:#fff !important;' +
                        'font-size:12px !important;font-weight:700 !important;' +
                        'text-align:center !important;padding:8px 4px !important;' +
                        'letter-spacing:0.5px !important;'
                    );
                }
                // Remove any empty/orphan th sitting AFTER the X column.
                var $allThs = $cart.find('thead > tr > th');
                var xIdx = -1;
                $allThs.each(function (i) {
                    if ($(this).find('.fa-times, .fa-xmark').length) { xIdx = i; }
                });
                if (xIdx > -1) {
                    $allThs.slice(xIdx + 1).remove();
                }
            })();
            bbEnsureQtyDefaults();
            try {
                var tb = $cart.find('tbody').get(0);
                if (tb && window.MutationObserver) {
                    new MutationObserver(function () {
                        var r = $cart.find('tbody > tr').length;
                        setDebug('[bb-standalone] tbody rows=' + r);
                        bbEnsureQtyDefaults();
                    }).observe(tb, { childList: true, subtree: true });
                }
            } catch (e) { }
        }
        bbStandaloneMount();
    })();
</script>
