<?php $user_settings = json_decode(auth()->user()->user_settings, true) ?? []; ?>

<?php $__env->startSection('title', __('report.expense_report')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e(__('report.expense_report'), false); ?></h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row no-print">
        <div class="col-md-12">
            <?php $__env->startComponent('components.filters', ['title' => __('report.filters')]); ?>
              <?php echo Form::open(['url' => action([\App\Http\Controllers\ReportController::class, 'getExpenseReport']), 'method' => 'get', 'class' => 'row', ]); ?>

                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('location_id',  __('purchase.business_location') . ':'); ?>

                        <?php echo Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'location_id']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('category_id', __('category.category').':'); ?>

                        <?php echo Form::select('category', $categories, null, ['placeholder' =>
                        __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'category_id']); ?>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <?php echo Form::label('trending_product_date_range', __('report.date_range') . ':'); ?>

                        <?php echo $__env->make('report.partials.reports_date_range_setting', ['date_range_setting_key' => 'report_expense_filter_date_range'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::text('date_range', $date_range , ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'trending_product_date_range', 'readonly']); ?>

                    </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary float-end"><?php echo app('translator')->get('report.apply_filters'); ?></button>
                </div> 
                <?php echo Form::close(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row no-print">
        <div class="col-sm-12 mb-2">
            <button type="button" class="btn btn-primary float-end" id="expense_report_print_btn" aria-label="Print">
                <i class="fa fa-print"></i> <?php echo app('translator')->get('messages.print'); ?> A4
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
                <?php echo $chart->container(); ?>

            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
            <div class="table-responsive">
<table class="table" id="expense_report_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get( 'expense.expense_categories' ); ?></th>
                        <th class="text-right"><?php echo app('translator')->get( 'report.total_expense' ); ?> (<?php echo e(session('currency')['symbol'] ?? '', false); ?>)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $total_expense = 0;
                    ?>
                    <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($expense['category'] ?? __('report.others'), false); ?></td>
                            <td class="text-right"><span class="display_currency" data-currency_symbol="false"><?php echo e($expense['total_expense'], false); ?></span></td>
                        </tr>
                        <?php
                            $total_expense += $expense['total_expense'];
                        ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td><?php echo app('translator')->get('sale.total'); ?></td>
                        <td class="text-right"><span class="display_currency" data-currency_symbol="false"><?php echo e($total_expense, false); ?></span></td>
                    </tr>
                </tfoot>
            </table>
</div>
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
        $(document).ready(function () {
            $('#expense_report_print_btn').on('click', function () {
                var params = {
                    location_id: $('#location_id').val() || '',
                    category: $('#category_id').val() || ''
                };
                var dateRange = $('#trending_product_date_range').val();

                if (dateRange) {
                    params.date_range = dateRange;
                }

                window.open('<?php echo e(url('reports/expense-report-print'), false); ?>?' + $.param(params), '_blank');
            });
        });
    </script>
    <style>
        <?php if(!empty($user_settings['rpt_admin_exp_hide_expense_categories'])): ?>
            #expense_report_table th:nth-child(1),
            #expense_report_table td:nth-child(1) { display: none; }
        <?php endif; ?>
        <?php if(!empty($user_settings['rpt_admin_exp_hide_total_expense'])): ?>
            #expense_report_table th:nth-child(2),
            #expense_report_table td:nth-child(2) { display: none; }
        <?php endif; ?>
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>