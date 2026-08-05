
<?php
    $heading = !empty($module_category_data['heading']) ? $module_category_data['heading'] : __('category.categories');
    $navbar = !empty($module_category_data['navbar']) ? $module_category_data['navbar'] : null;
?>
<?php $__env->startSection('title', $heading); ?>

<?php $__env->startSection('content'); ?>
<style>
    /* Category Tree View Styles */
    .category-parent-row {
        background-color: #f8f9fa !important;
    }
    .category-parent-row td:first-child {
        font-weight: 600;
    }
    .category-depth-1 td:first-child {
        padding-left: 35px !important;
    }
    .category-depth-2 td:first-child {
        padding-left: 65px !important;
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
    .tree-child .fa-tag,
    .tree-child .fa-folder {
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
    #category_table_wrapper .dataTables_scrollBody > table {
        min-width: 100% !important;
    }
</style>
<?php if(!empty($navbar)): ?>
    <?php echo $__env->make($navbar, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo e($heading, false); ?>

        <small>
            <?php echo e($module_category_data['sub_heading'] ?? __( 'category.manage_your_categories' ), false); ?>

        </small>
        <?php if(isset($module_category_data['heading_tooltip'])): ?>
            <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . $module_category_data['heading_tooltip'] . '"></i>';
                }
            ?>
        <?php endif; ?>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <?php
        $cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;
    ?>
    <input type="hidden" id="category_type" value="<?php echo e(request()->get('type'), false); ?>">
    <?php
        $can_add = true;
        if(request()->get('type') == 'product' && !auth()->user()->can('category.create')) {
            $can_add = false;
        }
        if(request()->get('type') == 'project'
            && !(auth()->user()->can('superadmin')
                || auth()->user()->hasRole('Admin#' . session()->get('user.business_id'))
                || auth()->user()->can('project.manage_project_category'))) {
            $can_add = false;
        }
    ?>
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'can_add' => $can_add]); ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-2">
                        <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                        </label>
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-sm btn-default btn-tree-toggle-all" id="toggle_all_categories">
                        <i class="fa fa-compress"></i> <?php echo app('translator')->get('lang_v1.collapse_all'); ?>
                    </button>
                </div>
            </div>
            <?php if($can_add && !$is_offline): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-primary btn-modal" 
                    data-href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'create']), false); ?>?type=<?php echo e(request()->get('type'), false); ?>" 
                    data-container=".category_modal">
                    <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                    <?php if(request()->get('type') == 'product' && $fbr_di_integration): ?>
                        <a class="btn btn-info load_hscodes" href="loadHSCode">Sync HS Codes</a>
                    <?php endif; ?>
                </div>
            <?php $__env->endSlot(); ?>
            <?php endif; ?>
       
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="category_table">
                    <thead>
                        <tr>
                            <th><?php if(!empty($module_category_data['taxonomy_label'])): ?> <?php echo e($module_category_data['taxonomy_label'], false); ?> <?php else: ?> <?php echo app('translator')->get( 'category.category' ); ?> <?php endif; ?></th>
                            <?php if($cat_code_enabled): ?>
                                <th><?php echo e($module_category_data['taxonomy_code_label'] ?? __( 'category.code' ), false); ?></th>
                            <?php endif; ?>
                            <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                            <?php if(request()->get('type') == 'product'): ?>
                                <th><?php echo app('translator')->get('lang_v1.no_of_products'); ?></th>
                            <?php endif; ?>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
    <?php echo $__env->renderComponent(); ?>
</section>
<!-- /.content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('modals'); ?>
    <div class="modal fade category_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('javascript'); ?>
<?php if ($__env->exists('taxonomy.taxonomies_js')) echo $__env->make('taxonomy.taxonomies_js', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>