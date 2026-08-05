
<?php $__env->startSection('title', __('expense.expense_categories')); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* Expense Category Tree View Styles */
    .category-parent-row {
        background-color: #f8f9fa !important;
    }
    .category-parent-row td:nth-child(2) {
        font-weight: 600;
    }
    .category-depth-1 td:nth-child(2) {
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
    .category-child-row.tree-collapsed {
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
    <h1><?php echo app('translator')->get( 'expense.expense_categories' ); ?>
        <small><?php echo app('translator')->get( 'expense.manage_your_expense_categories' ); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'expense.all_your_expense_categories' )]); ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_category.add')): ?>
        <?php $__env->slot('tool'); ?>
            <div class="box-tools">
                <button type="button" class="btn btn-block btn-primary btn-modal" 
                data-href="<?php echo e(action([\App\Http\Controllers\ExpenseCategoryController::class, 'create']), false); ?>" 
                data-container=".expense_category_modal">
                <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
            </div>
        <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <div class="row">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense_category.delete')): ?>
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
            <?php endif; ?>
            <div class="col-md-4">
                <button type="button" class="btn btn-sm btn-default btn-tree-toggle-all" id="toggle_all_expense_categories">
                    <i class="fa fa-compress"></i> <?php echo app('translator')->get('lang_v1.collapse_all'); ?>
                </button>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-th-skin" id="expense_category_table">
                <thead>
                    <tr>
                        <th><?php echo app('translator')->get( 'expense.category_code' ); ?></th>
                        <th><?php echo app('translator')->get( 'expense.category_name' ); ?></th>
                        <th><?php echo app('translator')->get( 'expense.budget' ); ?></th>
                        <th><?php echo app('translator')->get( 'expense.remaining' ); ?></th>
                        <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                    </tr>
                </thead>
            </table>
        </div>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade expense_category_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>