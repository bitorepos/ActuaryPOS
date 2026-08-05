
<?php $__env->startSection('title', __('lang_v1.product_stock_history')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get('lang_v1.product_stock_history'); ?></h1>
</section>

<!-- Main content -->
<section class="content">
<div class="row">
    <div class="col-md-12">
    <?php $__env->startComponent('components.widget', ['title' => $product->name . ' - ' . ucwords($product->type) ]); ?>
        <?php
            $__enabled_modules = session('business.enabled_modules', []);
            $__show_stock_transfers = in_array('stock_transfers', $__enabled_modules);
            $__show_manufacturing = false;
            $__show_warehouse = false;
            if (class_exists(\Nwidart\Modules\Facades\Module::class)) {
                $__show_manufacturing = !empty(\Nwidart\Modules\Facades\Module::find('Manufacturing'));
                $__show_warehouse = !empty(\Nwidart\Modules\Facades\Module::find('Warehouse'));
            }
            $__qty_out_arr = [__('sale.sale'), __('stock_adjustment.stock_adjustment'), __('lang_v1.purchase_return')];
            if ($__show_stock_transfers) { $__qty_out_arr[] = __('lang_v1.stock_transfers') . ' (' . __('lang_v1.out') . ')'; }
            if ($__show_manufacturing) { $__qty_out_arr[] = __('manufacturing::lang.ingredient'); }
            if ($__show_warehouse) { $__qty_out_arr[] = __('warehouse::lang.wh_transfer') . ' (' . __('lang_v1.out') . ')'; }
            $__qty_out_types = json_encode($__qty_out_arr, JSON_HEX_APOS | JSON_HEX_QUOT);
        ?>
        <div class="d-flex flex-wrap align-items-end gap-3">
            <div class="flex-fill" style="min-width:200px;">
                <div class="mb-3">
                    <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                    <?php
                        $__stock_history_locations = collect(['' => __('lang_v1.all')])->union($business_locations);
                    ?>
                    <?php echo Form::select('location_id', $__stock_history_locations, request()->input('location_id', ''), ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="flex-fill" style="min-width:200px;">
                <div class="mb-3">
                    <?php echo Form::label('product_id',  __('sale.product') . ':'); ?>

                    <?php echo Form::select('product_id', [$product->id=>$product->name . ' - ' . $product->sku], $product->id, ['class' => 'form-control', 'style' => 'width:100%']); ?>

                </div>
            </div>
            <div class="flex-fill" style="min-width:200px;">
                <div class="mb-3">
                    <label for="stock_history_type"><?php echo app('translator')->get('lang_v1.type'); ?>:</label>
                    <select class="form-control" id="stock_history_type" data-qty-out='<?php echo $__qty_out_types; ?>'>
                        <option value=""><?php echo app('translator')->get('lang_v1.all'); ?></option>
                        <?php if($__show_manufacturing): ?>
                        <option value="<?php echo e(__('manufacturing::lang.ingredient'), false); ?>"><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</option>
                        <option value="<?php echo e(__('manufacturing::lang.manufactured'), false); ?>"><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</option>
                        <?php endif; ?>
                        <option value="<?php echo e(__('report.opening_stock'), false); ?>"><?php echo app('translator')->get('report.opening_stock'); ?></option>
                        <option value="__quantities_out__"><?php echo app('translator')->get('lang_v1.quantities_out'); ?></option>
                        <?php if($__show_stock_transfers): ?>
                        <option value="<?php echo e(__('lang_v1.stock_transfers'), false); ?> (<?php echo e(__('lang_v1.in'), false); ?>)"><?php echo app('translator')->get('lang_v1.stock_transfers'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</option>
                        <option value="<?php echo e(__('lang_v1.stock_transfers'), false); ?> (<?php echo e(__('lang_v1.out'), false); ?>)"><?php echo app('translator')->get('lang_v1.stock_transfers'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</option>
                        <?php endif; ?>
                        <?php if($__show_warehouse): ?>
                        <option value="<?php echo e(__('warehouse::lang.wh_transfer'), false); ?> (<?php echo e(__('lang_v1.in'), false); ?>)"><?php echo app('translator')->get('warehouse::lang.wh_transfer'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</option>
                        <option value="<?php echo e(__('warehouse::lang.wh_transfer'), false); ?> (<?php echo e(__('lang_v1.out'), false); ?>)"><?php echo app('translator')->get('warehouse::lang.wh_transfer'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</option>
                        <?php endif; ?>
                        <option value="<?php echo e(__('lang_v1.purchase_return'), false); ?>"><?php echo app('translator')->get('lang_v1.total_purchase_return'); ?></option>
                        <option value="<?php echo e(__('lang_v1.purchase'), false); ?>"><?php echo app('translator')->get('report.total_purchase'); ?></option>
                        <option value="<?php echo e(__('lang_v1.sell_return'), false); ?>"><?php echo app('translator')->get('lang_v1.total_sell_return'); ?></option>
                        <option value="<?php echo e(__('sale.sale'), false); ?>"><?php echo app('translator')->get('lang_v1.total_sold'); ?></option>
                        <option value="<?php echo e(__('stock_adjustment.stock_adjustment'), false); ?>"><?php echo app('translator')->get('report.total_stock_adjustment'); ?></option>
                    </select>
                </div>
            </div>
            <?php if($product->type == 'variable'): ?>
            <div class="flex-fill" style="min-width:180px;">
                <div class="mb-3">
                    <label for="variation_id"><?php echo app('translator')->get('product.variations'); ?>:</label>
                    <select class="select2 form-control" name="variation_id" id="variation_id">
                        <?php $__currentLoopData = $product->variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($variation->id, false); ?>"
                            <?php if(request()->input('variation_id', null) == $variation->id): ?>
                                selected
                            <?php endif; ?>
                            ><?php echo e($variation->product_variation->name, false); ?> - <?php echo e($variation->name, false); ?> (<?php echo e($variation->sub_sku, false); ?>)</option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            <?php else: ?>
                <input type="hidden" id="variation_id" name="variation_id" value="<?php echo e($product->variations->first()->id, false); ?>">
            <?php endif; ?>
            <div class="flex-fill" style="min-width:180px;">
                <div class="mb-3">
                    <button type="button" class="btn btn-warning" id="reindex_product_stock_history" data-product-id="<?php echo e($product->id, false); ?>">
                        <i class="fas fa-sync"></i> <?php echo app('translator')->get('lang_v1.reindex_stock_quantities'); ?>
                    </button>
                </div>
            </div>
        </div>
    <?php echo $__env->renderComponent(); ?>
    <?php $__env->startComponent('components.widget'); ?>
        <div id="product_stock_history_loader" style="display: none; padding: 15px 0;">
            <div class="progress progress-sm active" style="margin-bottom: 8px;">
                <div id="product_stock_history_progress_bar" class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="20" style="width: 20%;"></div>
            </div>
            <div class="text-muted text-center"><?php echo app('translator')->get('lang_v1.loading_data'); ?></div>
        </div>
        <div id="product_stock_history" style="display: none;"></div>
    <?php echo $__env->renderComponent(); ?>
    </div>
</div>

</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
   <script type="text/javascript">
        var stockHistoryRequest = null;
        var stockHistoryProgressTimer = null;
        var stockHistoryProgressValue = 20;

        $(document).ready( function(){
            load_stock_history($('#variation_id').val());

            $('#product_id').select2({
                ajax: {
                    url: '/products/list-no-variation',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            term: params.term, // search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data,
                        };
                    },
                },
                minimumInputLength: 1,
                escapeMarkup: function(m) {
                    return m;
                },
            }).on('select2:select', function (e) {
                var data = e.params.data;
                window.location.href = "<?php echo e(url('/'), false); ?>/products/stock-history/" + data.id
            });
       });

       function getSelectedStockHistoryLocationId() {
            return $('#location_id').val();
       }

       function showStockHistoryProgress() {
            var $loader = $('#product_stock_history_loader');
            var $bar = $('#product_stock_history_progress_bar');

            clearInterval(stockHistoryProgressTimer);
            stockHistoryProgressValue = 20;
            $bar
                .removeClass('progress-bar-danger')
                .addClass('progress-bar-info progress-bar-striped')
                .css('width', stockHistoryProgressValue + '%')
                .attr('aria-valuenow', stockHistoryProgressValue);
            $loader.stop(true, true).fadeIn(100);

            stockHistoryProgressTimer = setInterval(function () {
                stockHistoryProgressValue = Math.min(stockHistoryProgressValue + Math.max(1, Math.round((92 - stockHistoryProgressValue) * 0.12)), 92);
                $bar
                    .css('width', stockHistoryProgressValue + '%')
                    .attr('aria-valuenow', stockHistoryProgressValue);
            }, 500);
       }

       function hideStockHistoryProgress(success) {
            var $loader = $('#product_stock_history_loader');
            var $bar = $('#product_stock_history_progress_bar');

            clearInterval(stockHistoryProgressTimer);
            stockHistoryProgressTimer = null;

            if (success) {
                $bar.css('width', '100%').attr('aria-valuenow', 100);
                $loader.delay(150).fadeOut(150);
            } else {
                $bar
                    .removeClass('progress-bar-info progress-bar-striped')
                    .addClass('progress-bar-danger')
                    .css('width', '100%')
                    .attr('aria-valuenow', 100);
                $loader.delay(400).fadeOut(150);
            }
       }

       function initializeProductStockHistoryTables() {
            $('#product_stock_history .stock_history_table_loc, #product_stock_history #stock_history_table').each(function () {
                if (!isProductStockHistoryDataTable(this)) {
                    $(this).DataTable({
                        searching: true,
                        ordering: false
                    });
                }
            });
       }

       function load_stock_history(variation_id, location_id, options) {
            options = options || {};
            if (typeof location_id === 'undefined') {
                location_id = getSelectedStockHistoryLocationId();
            }

            var useLocationTabs = typeof options.all_locations === 'undefined'
                ? true
                : options.all_locations;
            var activeLocationTab = useLocationTabs && !location_id
                ? ($('#product_stock_history #stock_history_location_tabs .nav-link.active').data('bs-target') || '')
                : '';
            var data = {
                stock_history_type: $('#stock_history_type').val()
            };

            if (useLocationTabs) {
                data.all_locations = 1;
                if (location_id) {
                    data.location_id = location_id;
                }
            } else {
                data.location_id = location_id;
            }

            if (stockHistoryRequest && stockHistoryRequest.readyState !== 4) {
                stockHistoryRequest.abort();
            }

            $('#product_stock_history').stop(true, true).hide();
            showStockHistoryProgress();

            var request = $.ajax({
                url: '/products/stock-history/' + variation_id,
                data: data,
                dataType: 'html',
                success: function(result) {
                    if (request !== stockHistoryRequest) {
                        return;
                    }

                    $('#product_stock_history')
                        .html(result)
                        .fadeIn();

                    __currency_convert_recursively($('#product_stock_history'));

                    initializeProductStockHistoryTables();

                    if (activeLocationTab) {
                        var $activeLocationTab = $('#product_stock_history #stock_history_location_tabs button[data-bs-target="' + activeLocationTab + '"]');

                        if ($activeLocationTab.length && window.bootstrap && bootstrap.Tab) {
                            bootstrap.Tab.getOrCreateInstance($activeLocationTab[0]).show();
                        }
                    }

                    // Apply type filter if already selected
                    applyStockHistoryTypeFilter();

                    $('#product_stock_history')
                        .off('shown.bs.tab.stockHistoryTypeFilter', '#stock_history_location_tabs button')
                        .on('shown.bs.tab.stockHistoryTypeFilter', '#stock_history_location_tabs button', function () {
                        var target = $(this).data('bs-target');
                        var $table = $(target).find('.stock_history_table_loc');
                        if ($table.length && isProductStockHistoryDataTable($table[0])) {
                            $table.DataTable().columns.adjust();
                        }
                        applyStockHistoryTypeFilter();
                    });
                },
                error: function(xhr, textStatus) {
                    if (textStatus === 'abort' || request !== stockHistoryRequest) {
                        return;
                    }

                    $('#product_stock_history')
                        .html('<div class="alert alert-danger">Request failed. Please try again.</div>')
                        .fadeIn();
                },
                complete: function(xhr, textStatus) {
                    if (request !== stockHistoryRequest) {
                        return;
                    }

                    hideStockHistoryProgress(textStatus === 'success' || textStatus === 'notmodified');
                    stockHistoryRequest = null;
                }
            });

            stockHistoryRequest = request;
       }

       function normalizeProductStockHistoryFilterText(value) {
            if (typeof window.normalizeStockHistoryFilterText === 'function') {
                return window.normalizeStockHistoryFilterText(value);
            }

            return $('<textarea/>')
                .html(value == null ? '' : String(value))
                .text()
                .replace(/[\s\u00a0]+/g, ' ')
                .trim()
                .toLowerCase();
       }

       function getProductStockHistoryFilterTypes() {
            var $select = $('#stock_history_type');
            var val = $select.val();
            var values = [];

            if (!val) {
                return values;
            }

            if (val === '__quantities_out__') {
                values = $select.data('qty-out');

                if (typeof values === 'string') {
                    try {
                        values = JSON.parse(values);
                    } catch (e) {
                        values = values.split(',');
                    }
                }

                if (!$.isArray(values)) {
                    values = [];
                }
            } else {
                values = [val];
            }

            return $.map(values, function (value) {
                return normalizeProductStockHistoryFilterText(value);
            }).filter(function (value) {
                return value !== '';
            });
       }

       function isProductStockHistoryDataTable(table) {
            if (typeof window.isStockHistoryDataTable === 'function') {
                return window.isStockHistoryDataTable(table);
            }

            if ($.fn.dataTable && $.fn.dataTable.isDataTable) {
                return $.fn.dataTable.isDataTable(table);
            }

            if ($.fn.DataTable && $.fn.DataTable.isDataTable) {
                return $.fn.DataTable.isDataTable(table);
            }

            return false;
       }

       function registerProductStockHistoryTypeFilter() {
            if (typeof window.registerStockHistoryTypeFilter === 'function') {
                window.registerStockHistoryTypeFilter();
                return;
            }

            if (window.__stockHistoryTypeFilterRegistered || !$.fn.dataTable || !$.fn.dataTable.ext) {
                return;
            }

            window.__stockHistoryTypeFilterRegistered = true;
            $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
                var $table = $(settings.nTable);
                var filterTypes = $table.data('stock-history-type-filter');

                if (!filterTypes || !filterTypes.length) {
                    return true;
                }

                var row = settings.aoData && settings.aoData[dataIndex] ? settings.aoData[dataIndex].nTr : null;
                var typeLabel = row ? ($(row).attr('data-history-type-label') || $(row).children('td').eq(1).text()) : '';

                if (!typeLabel && data && data.length > 1) {
                    typeLabel = data[1];
                }

                return $.inArray(normalizeProductStockHistoryFilterText(typeLabel), filterTypes) !== -1;
            });
       }

       function applyProductStockHistoryRowFallback($table, filterTypes) {
            $table.find('tbody tr').each(function () {
                var $row = $(this);

                if (!$row.attr('data-history-type-label') && $row.children('td').length <= 1) {
                    $row.show();
                    return;
                }

                var typeLabel = $row.attr('data-history-type-label') || $row.children('td').eq(1).text();
                var show = !filterTypes.length || $.inArray(normalizeProductStockHistoryFilterText(typeLabel), filterTypes) !== -1;

                $row.toggle(show);
            });
       }

       function applyStockHistoryTypeFilter() {
            registerProductStockHistoryTypeFilter();
            var filterTypes = getProductStockHistoryFilterTypes();

            $('#product_stock_history .stock_history_table_loc, #product_stock_history #stock_history_table').each(function () {
                var $table = $(this);

                if (filterTypes.length) {
                    $table.data('stock-history-type-filter', filterTypes);
                } else {
                    $table.removeData('stock-history-type-filter');
                }

                if (isProductStockHistoryDataTable(this)) {
                    $table.DataTable().draw();
                }

                applyProductStockHistoryRowFallback($table, filterTypes);
            });
       }

       $(document).on('change', '#stock_history_type', function() {
            load_stock_history($('#variation_id').val(), getSelectedStockHistoryLocationId());
       });

       $(document).on('change', '#location_id', function() {
            load_stock_history($('#variation_id').val(), getSelectedStockHistoryLocationId());
       });

       $(document).on('change', '#variation_id', function(){
            load_stock_history($('#variation_id').val(), getSelectedStockHistoryLocationId());
       });

       $(document).on('click', '#reindex_product_stock_history', function(e){
            e.preventDefault();

            var $button = $(this);
            var product_id = $button.data('product-id');
            var variation_id = $('#variation_id').val();
            var selected_location_id = $('#location_id').val();
            var location_id = selected_location_id || $('#location_id option').filter(function () {
                return $(this).val() !== '';
            }).first().val();
            var reindex_all_locations = !selected_location_id;

            if (!product_id || !variation_id || !location_id) {
                toastr.error('Something Went Wrong');
                return;
            }

            $button.prop('disabled', true);
            $button.find('i').addClass('fa-spin');

            $.ajax({
                method: 'GET',
                url: '/products/reindex-stock-quantity/' + product_id,
                dataType: 'json',
                data: {
                    location_id: location_id,
                    variation_id: variation_id,
                    all_locations: reindex_all_locations ? 1 : 0
                },
                success: function(result) {
                    if (result.success == true) {
                        toastr.success(result.msg);
                        load_stock_history(variation_id, getSelectedStockHistoryLocationId());
                    } else {
                        toastr.error(result.msg);
                    }
                },
                error: function() {
                    toastr.error('Request Failed - Nothing Happend');
                },
                complete: function() {
                    $button.prop('disabled', false);
                    $button.find('i').removeClass('fa-spin');
                }
            });
       });
   </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>