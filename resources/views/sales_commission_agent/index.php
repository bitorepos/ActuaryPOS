
<?php $__env->startSection('title', __('lang_v1.sales_commission_agents')); ?>

<?php $__env->startSection('content'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'lang_v1.sales_commission_agents' ); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary']); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-primary btn-modal float-end"
                        data-href="<?php echo e(action([\App\Http\Controllers\SalesCommissionAgentController::class, 'create']), false); ?>" data-container=".commission_agent_modal"><i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user.view')): ?>
        <div class="row">
            <div class="col-md-4">
                <div class="mb-3">
                    <br>
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
        </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="sales_commission_agent_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'user.name' ); ?></th>
                            <th><?php echo app('translator')->get( 'business.email' ); ?></th>
                            <th><?php echo app('translator')->get( 'lang_v1.contact_no' ); ?></th>
                            <th><?php echo app('translator')->get( 'business.address' ); ?></th>
                            <th><?php echo app('translator')->get( 'lang_v1.cmmsn_percent' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade commission_agent_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>