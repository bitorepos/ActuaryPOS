<div class="tab-pane fade
    <?php if(!empty($view_type) &&  $view_type == 'subscriptions'): ?>
        show active
    <?php else: ?>
        ''
    <?php endif; ?>"
id="subscriptions_tab" role="tabpanel">
    <div class="row">
        <div class="col-md-12">
            <?php $__env->startComponent('components.widget'); ?>
                <div class="col-md-3">
                    <div class="mb-3">
                        <?php echo Form::label('subscriptions_filter_date_range', __('report.date_range') . ':'); ?>

                        <?php echo Form::text('subscriptions_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); ?>

                    </div>
                </div>
            <?php echo $__env->renderComponent(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php echo $__env->make('sale_pos.partials.subscriptions_table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
</div>
