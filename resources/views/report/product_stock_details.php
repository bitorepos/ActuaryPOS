
<?php $__env->startSection('title', __('report.mismatch_report')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_mismatch_quantity_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.mismatch_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-solid" id="accordion">
              <div class="box-header with-border">
                <h3 class="box-title">
                    <i class="fa fa-filter" aria-hidden="true"></i> <?php echo app('translator')->get('report.filters'); ?>
                </h3>
              </div>
              <div class="box-body box box-primary">
                <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'productStockDetails']), 'method' => 'get' ]); ?>

                            
                <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                            <?php echo Form::label('search_product', __('lang_v1.search_product') . ':'); ?>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-search"></i>
                                    </span>
                                    <?php echo Form::select('variation_id', [], null, ['class' => 'form-control', 'id' => 'variation_id', 'placeholder' => __('lang_v1.search_product_placeholder')]); ?>

                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-3">
                                <?php echo Form::label('location_id', __('purchase.business_location').':'); ?>

                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="fa fa-map-marker"></i>
                                    </span>
                                    <?php echo Form::select('location_id', $business_locations, !empty(request()->get('location_id')) ? request()->get('location_id') : null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); ?>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <br>
                                <button type="submit" class="btn btn-primary"><?php echo app('translator')->get('lang_v1.search'); ?></button>
                            </div>
                        </div>
                        
                    </div>
                    <?php echo Form::close(); ?>


                    
                    <?php if(!empty($stock_details)): ?>
                    <div class="col-md-12">
                        <hr>
                        <div class="text-end mb-2">
                            <button type="button" class="btn btn-primary open-mismatch-report-print">
                                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                            </button>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                            <table class="table table-striped table-bordered" style="font-size: 16px">
                                <tr>
                                    <th><br>#</th>
                                    <th><br>Variation ID (DB ID)</th>
                                    <th><small>Purchase</small><br>Qty</th>
                                    <th><small>Purchase</small> <br>Returned</th>
                                    <th><small>Purchase</small><br>Sold</th>
                                    <th><small>Purchase</small><br>Adjusted</th>
                                    <th><small>Purchase</small><br>Mfg Used<br></th>
                                    <th class="bg-success"><small>Purchase</small><br>Qty Avlb<br></th>
                                    <th><small>Sell</small><br>Qty</th>
                                    <th><small>Sell</small> <br>Returned</th>
                                    <th class="bg-warning"><small>Sell</small><br>Net Qty<br></th>
                                    <th class="bg-info"><small>VLD</small><br>Qty<br></th>
                                    
                                </tr>
                                <?php
                                    $count = 0;
                                ?>
                                <?php $__currentLoopData = $stock_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    if(empty($row->sl_qty)){
                                        continue;
                                    }   
                                    // if((float)$row->pl_qty_avlb == (float)$row->vld_qty){
                                    //     continue;
                                    // }
                                    $pl_qty_avlb = 0;
                                    $vld_qty = 0;
                                    $pl_qty_avlb = number_format($row->pl_qty_avlb, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']);
                                    $vld_qty = number_format($row->vld_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']);
                                    if($pl_qty_avlb == $vld_qty){
                                        continue;
                                    }
                                    if($row->vld_qty == 0){
                                        continue;
                                    }
                                    $count++;
                                    ?>
                                    <tr>
                                        <td><?php echo e($count, false); ?></td>
                                        <td>
                                            <?php if(auth()->user()->can('product.view') && auth()->user()->can('product.view_stock_history')): ?>
                                                <a href="<?php echo e(action([\App\Http\Controllers\ProductController::class, 'productStockHistory'], $row->pid), false); ?>?location_id=<?php echo e(request()->get('location_id'), false); ?>&variation_id=<?php echo e($row->vid, false); ?>" target="_BLANK"><?php echo e($row->sub_sku, false); ?></a>
                                            <?php else: ?>
                                                <?php echo e($row->sub_sku, false); ?>

                                            <?php endif; ?>
                                            (<?php echo e($row->vid, false); ?>)
                                        </td>
                                        <td><?php echo e(number_format($row->pl_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                        <td><?php echo e(number_format($row->pl_qty_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                        <td><?php echo e(number_format($row->pl_qty_sold, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                        <td><?php echo e(number_format(-1*$row->pl_qty_adjusted, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                        <td><?php echo e(number_format($row->pl_qty_mfg, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                        <td class="bg-success"><?php echo e(number_format($row->pl_qty_avlb, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                        <td><?php echo e(number_format($row->sl_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                        <td><?php echo e(number_format($row->sl_qty_returned, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                        <td class="bg-warning"><?php echo e(number_format($row->sl_qty_avlb, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                        <td class="bg-info"><?php echo e(number_format($row->vld_qty, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </table>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
<div class="modal fade view_register" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $(document).on('click', '.open-mismatch-report-print', function(e) {
                e.preventDefault();
                var params = {
                    location_id: $('select#location_id').val(),
                    variation_id: $('#variation_id').val()
                };
                var url = "<?php echo e(url('reports/mismatch-report-print'), false); ?>?" + $.param(params);
                window.open(url, '_blank');
            });

            //get customer
            $('#variation_id').select2({
                ajax: {
                    url: '/purchases/get_products',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                          term: params.term, // search term
                        };
                    },
                    processResults: function (data) {
                        var data_formated = [];
                        data.forEach(function (item) {
                            var temp = {
                                'id': item.variation_id,
                                'text': item.text
                            }
                            data_formated.push(temp);
                        });
                        return {
                            results: data_formated
                        };
                    }
                },
                minimumInputLength: 1,
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>