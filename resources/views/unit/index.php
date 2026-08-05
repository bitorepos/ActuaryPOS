
<?php $__env->startSection('title', __( 'unit.units' )); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* Unit Tree View Styles */
    .unit-parent-row {
        background-color: #f8f9fa !important;
    }
    .unit-parent-row td:first-child {
        font-weight: 600;
    }
    .unit-depth-1 td:first-child {
        padding-left: 35px !important;
    }
    .tree-parent .tree-toggle,
    .tree-child .tree-toggle {
        width: 16px;
        text-align: center;
        margin-right: 4px;
        color: #6c757d;
        transition: transform 0.2s ease;
        cursor: pointer;
    }
    .tree-toggle:hover {
        color: #333;
    }
    .tree-parent .fa-folder-open {
        margin-right: 4px;
    }
    .tree-child .tree-indent {
        margin-right: 6px;
        color: #adb5bd;
    }
    .tree-child .tree-indent .fa {
        font-size: 12px;
    }
    .tree-child .fa-tag {
        margin-right: 4px;
    }
    .unit-child-row.tree-collapsed {
        display: none;
    }
    .tree-toggle.collapsed {
        transform: rotate(-90deg);
    }
    .btn-tree-toggle-all {
        margin-left: 8px;
        font-size: 12px;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'unit.units' ); ?>
        <small><?php echo app('translator')->get( 'unit.manage_your_units' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'unit.all_your_units' )]); ?>
        <?php if(!$is_offline): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                        data-href="<?php echo e(action([\App\Http\Controllers\UnitController::class, 'create']), false); ?>" 
                        data-container=".unit_modal">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row align-items-center mb-3">
            <div class="col-md-4 col-sm-6 d-flex align-items-center">
                <div class="form-check d-inline-flex align-items-center gap-2 mb-0">
                    <?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?>

                    <label class="form-check-label fw-semibold mb-0" for="show_deleted"><?php echo app('translator')->get('lang_v1.show_deleted'); ?></label>
                </div>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-sm btn-default btn-tree-toggle-all" id="toggle_all_units">
                    <i class="fa fa-compress"></i> <?php echo app('translator')->get('lang_v1.collapse_all'); ?>
                </button>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('unit.view')): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="unit_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'unit.name' ); ?></th>
                            <th><?php echo app('translator')->get( 'unit.short_name' ); ?></th>
                            <th><?php echo app('translator')->get( 'unit.allow_decimal' ); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . __('tooltip.unit_allow_decimal') . '"></i>';
                }
            ?></th>
                            <th><?php echo app('translator')->get('lang_v1.no_of_products'); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
<div class="modal fade unit_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>