
<?php $__env->startSection('title', __('report.sales_analysis')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.sales_analysis'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_sales_analysis_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="row no-print">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
              <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getSalesAnalysis']), 'method' => 'get', 'class' => 'row', 'id' => 'sales_analysis_report_form']); ?>

                <div class="col-md-2">
                    <div class="form-group mb-2">
                        <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, $filters['location_id'], ['class' => 'form-control select2', 'style' => 'width:100%']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-2">
                        <?php echo Form::label('report_by', 'Report by:'); ?>

                        <?php echo Form::select('report_by', ['amount' =>'Amount', 'num_of_sales'=> 'Number of Sales'], $filters['report_by'], ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'report_by']); ?>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group mb-2">
                        <?php echo Form::label('period', 'Period:'); ?>

                        <?php echo Form::select('period', ['yearly' => 'Yearly', 'monthly'=> 'Monthly', 'weekly'=> 'Weekly ', 'daily'=> 'Daily', 'day_of_week'=> 'Day of Week','hourly'=> 'Hourly'],
                         $filters['period'], ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'sa-period']); ?>

                    </div>
                </div>
                <div id="period_range_div" class="row" data-current=''>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_from',__('report.range_from') .  ':'); ?>

                            <?php echo Form::selectRange('range_from', Carbon::createFromDate('2000')->startOfYear()->format('Y'), \Carbon::now()->startOfYear()->format('Y'), $filters['range_from'], 
                            [ 'placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'sa_range_from']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_to',__('report.range_to') .  ':'); ?>

                            <?php echo Form::selectRange('range_to', Carbon::createFromDate('2000')->startOfYear()->format('Y'), \Carbon::now()->startOfYear()->format('Y'), $filters['range_to'], 
                            [ 'placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'sa_range_to']); ?>

                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get('report.apply_filters'); ?></button>
                </div> 
                <?php echo Form::close(); ?>


                <div id="yearly" class="hide">
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_from',__('report.range_from') .  ':'); ?>

                            <?php echo Form::selectRange('range_from', Carbon::createFromDate('2000')->startOfYear()->format('Y'), \Carbon::now()->startOfYear()->format('Y'), $filters['range_from'], 
                            [ 'placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'sa_range_from']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_to',__('report.range_to') .  ':'); ?>

                            <?php echo Form::selectRange('range_to', Carbon::createFromDate('2000')->startOfYear()->format('Y'), \Carbon::now()->startOfYear()->format('Y'), $filters['range_to'], 
                            [ 'placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'sa_range_to']); ?>

                        </div>
                    </div>
                </div>
                <div id="monthly" class="hide">
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_to', 'Month End:'); ?>

                            <?php echo Form::selectMonth('range_to', ($filters['period'] == 'monthly' && !empty($filters['range_to'])) ? $filters['range_to'] : ltrim(\Carbon::now()->startOfYear()->format('m'), '0' ), 
                            ['class' => 'form-control', 'id' => 'sa_range_to']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_from', 'Year:'); ?>

                            <?php echo Form::selectRange('range_from', Carbon::createFromDate('2000')->startOfYear()->format('Y'), \Carbon::now()->startOfYear()->format('Y'), 
                            ($filters['period'] == 'monthly' && !empty($filters['range_from '])) ? $filters['range_from'] : \Carbon::now()->startOfYear()->format('Y'), 
                            [ 'class' => 'form-control', 'id' => 'range_from']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <br>
                            <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="compare_previous" id="compare_previous" <?php if(!empty($filters['compare_previous'])): ?> checked <?php endif; ?>>
                                Compare Previous
                            </label>
                        </div>
                    </div>
                </div>
                <div id="weekly" class="hide">
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_from', __('report.range_from') .  ':'); ?>

                            <?php echo Form::date('range_from', ($filters['period'] == 'weekly' && !empty($filters['range_from'])) ? $filters['range_from'] : \Carbon::now()->subDays(6)->format('Y-m-d'), [ 'class' => 'form-control', 'id' => 'sa_weekly_range_from']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_to', __('report.range_to') .  ':'); ?>

                            <?php echo Form::date('range_to', ($filters['period'] == 'weekly' && !empty($filters['range_to'])) ? $filters['range_to'] : \Carbon::now()->format('Y-m-d'), [ 'class' => 'form-control', 'id' => 'sa_weekly_range_to']); ?>

                        </div>
                    </div>
                </div>
                <div id="daily" class="hide">
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_to', 'Month:'); ?>

                            <?php echo Form::selectMonth('range_to', ($filters['period'] == 'daily' && !empty($filters['range_to'])) ? $filters['range_to'] : ltrim(\Carbon::now()->startOfYear()->format('m'), '0' ), 
                            ['class' => 'form-control', 'id' => 'sa_range_to']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_from', 'Year:'); ?>

                            <?php echo Form::selectRange('range_from', Carbon::createFromDate('2000')->startOfYear()->format('Y'), \Carbon::now()->startOfYear()->format('Y'), 
                            ($filters['period'] == 'daily' && !empty($filters['range_from'])) ? $filters['range_from'] : \Carbon::now()->startOfYear()->format('Y'), 
                            [ 'class' => 'form-control', 'id' => 'sa_range_from']); ?>

                        </div>
                    </div>
                </div>
                <div id="day_of_week" class="hide">
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_from', __('report.range_from') .  ':'); ?>

                            <?php echo Form::date('range_from', ($filters['period'] == 'day_of_week' && !empty($filters['range_from'])) ? $filters['range_from'] : \Carbon::now()->subDays(6)->format('Y-m-d'), [ 'class' => 'form-control', 'id' => 'sa_weekly_range_from']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_to', __('report.range_to') .  ':'); ?>

                            <?php echo Form::date('range_to', ($filters['period'] == 'day_of_week' && !empty($filters['range_to'])) ? $filters['range_to'] : \Carbon::now()->format('Y-m-d'), [ 'class' => 'form-control', 'id' => 'sa_weekly_range_to']); ?>

                        </div>
                    </div>
                </div>
                <div id="hourly" class="hide">
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_from', __('report.range_from') .  ':'); ?>

                            <?php echo Form::date('range_from', ($filters['period'] == 'hourly' && !empty($filters['range_from'])) ? $filters['range_from'] : \Carbon::now()->format('Y-m-d'), [ 'class' => 'form-control', 'id' => 'sa_weekly_range_from']); ?>

                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group mb-2">
                            <?php echo Form::label('range_to', __('report.range_to') .  ':'); ?>

                            <?php echo Form::date('range_to', ($filters['period'] == 'hourly' && !empty($filters['range_to'])) ? $filters['range_to'] : \Carbon::now()->format('Y-m-d'), [ 'class' => 'form-control', 'id' => 'sa_weekly_range_to']); ?>

                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-6">
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <br>
                                <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="report_days[Monday]" id="report_days[Monday]" <?php if(isset($filters['report_days']) && empty($filters['report_days']['Monday'])): ?> <?php else: ?> checked <?php endif; ?>>
                                    Monday
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <br>
                                <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="report_days[Tuesday]" id="report_days[Tuesday]" <?php if(isset($filters['report_days']) && empty($filters['report_days']['Tuesday'])): ?> <?php else: ?> checked <?php endif; ?>>
                                    Tuesday
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <br>
                                <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="report_days[Wednesday]" id="report_days[Wednesday]" <?php if(isset($filters['report_days']) && empty($filters['report_days']['Wednesday'])): ?> <?php else: ?> checked <?php endif; ?>>
                                    Wednesday
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <br>
                                <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="report_days[Thursday]" id="report_days[Thursday]" <?php if(isset($filters['report_days']) && empty($filters['report_days']['Thursday'])): ?> <?php else: ?> checked <?php endif; ?>>
                                    Thursday
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <br>
                                <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="report_days[Friday]" id="report_days[Friday]" <?php if(isset($filters['report_days']) && empty($filters['report_days']['Friday'])): ?> <?php else: ?> checked <?php endif; ?>>
                                    Friday
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <br>
                                <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="report_days[Saturday]" id="report_days[Saturday]" <?php if(isset($filters['report_days']) && empty($filters['report_days']['Saturday'])): ?> <?php else: ?> checked <?php endif; ?>>
                                    Saturday
                                </label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-2">
                                <br>
                                <label class="form-check-label">
<input type="checkbox" class="form-check-input" name="report_days[Sunday]" id="report_days[Sunday]" <?php if(isset($filters['report_days']) && empty($filters['report_days']['Sunday'])): ?> <?php else: ?> checked <?php endif; ?>>
                                    Sunday
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <?php $__env->slot('title'); ?>
                    <div class="d-flex justify-content-between align-items-center">
                        <span><?php echo app('translator')->get('report.sales_analysis'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.sales_analysis') . '"></i>';
                }
            ?></span>
                        <button type="button" class="btn btn-primary no-print" id="sales-analysis-print-btn">
                            <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
                        </button>
                    </div>
                <?php $__env->endSlot(); ?>
                <?php echo $chart->container(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="<?php echo e(asset('js/report.js?v=' . $asset_v), false); ?>"></script>
    <?php echo $chart->script(); ?>

    <script>
        $(document).ready(function() {
            $('#sales-analysis-print-btn').on('click', function() {
                var query = $('#sales_analysis_report_form').serialize();
                window.open("<?php echo e(url('reports/sales-analysis-print'), false); ?>" + (query ? '?' + query : ''), '_blank');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>