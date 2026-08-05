
<?php $__env->startSection('title', 'Brands'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .brand-parent-row {
        background-color: #f8f9fa !important;
    }
    .brand-parent-row td:first-child {
        font-weight: 600;
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
    .tree-toggle.collapsed {
        transform: rotate(-90deg);
    }
    .tree-child .tree-indent {
        margin-right: 6px;
        color: #adb5bd;
    }
    .brand-child-row.tree-collapsed {
        display: none;
    }
    .btn-tree-toggle-all {
        margin-left: 8px;
        font-size: 12px;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><?php echo app('translator')->get( 'brand.brands' ); ?>
        <small><?php echo app('translator')->get( 'brand.manage_your_brands' ); ?></small>
    </h1>
    <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
    </ol> -->
</section>

<!-- Main content -->
<section class="content">
    <?php $__env->startComponent('components.widget', ['class' => 'box-primary', 'title' => __( 'brand.all_your_brands' )]); ?>
        <?php if(!$is_offline): ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brand.create')): ?>
            <?php $__env->slot('tool'); ?>
                <div class="box-tools">
                    <button type="button" class="btn btn-block btn-primary btn-modal" 
                        data-href="<?php echo e(action([\App\Http\Controllers\BrandController::class, 'create']), false); ?>" 
                        data-container=".brands_modal">
                        <i class="fa fa-plus"></i> <?php echo app('translator')->get( 'messages.add' ); ?></button>
                </div>
            <?php $__env->endSlot(); ?>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-2">
                    <label class="form-check-label">
<?php echo Form::checkbox('show_deleted', 1, false, ['class' => 'form-check-input', 'id' => 'show_deleted']); ?> <strong><?php echo app('translator')->get('lang_v1.show_deleted'); ?></strong>
                    </label>
                </div>
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-sm btn-default btn-tree-toggle-all" id="toggle_all_brands">
                    <i class="fa fa-compress"></i> <?php echo app('translator')->get('lang_v1.collapse_all'); ?>
                </button>
            </div>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('brand.view')): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-th-skin" id="brands_table">
                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get( 'brand.brands' ); ?></th>
                            <th><?php echo app('translator')->get( 'brand.note' ); ?></th>
                            <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        <?php endif; ?>
    <?php echo $__env->renderComponent(); ?>

    <div class="modal fade brands_modal" tabindex="-1" role="dialog" 
    	aria-labelledby="gridSystemModalLabel">
    </div>

</section>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
<script>
    $(document).ready(function(){
        var expandAllText = "<?php echo app('translator')->get('lang_v1.expand_all'); ?>";
        var collapseAllText = "<?php echo app('translator')->get('lang_v1.collapse_all'); ?>";

        function collapseAllBrandChildren() {
            $('#brands_table tbody tr.brand-child-row').addClass('tree-collapsed').hide();
            $('#brands_table tbody tr.brand-parent-row .tree-toggle').addClass('collapsed');
            $('#toggle_all_brands').html('<i class="fa fa-expand"></i> ' + expandAllText);
            $('#toggle_all_brands').data('collapsed', true);
        }

        function expandAllBrandChildren() {
            $('#brands_table tbody tr.brand-child-row').removeClass('tree-collapsed').show();
            $('#brands_table tbody tr.brand-parent-row .tree-toggle').removeClass('collapsed');
            $('#toggle_all_brands').html('<i class="fa fa-compress"></i> ' + collapseAllText);
            $('#toggle_all_brands').data('collapsed', false);
        }

        function initBrandTreeState() {
            collapseAllBrandChildren();
        }

        $('#brands_table').on('draw.dt', function(){
            initBrandTreeState();
        });

        $(document).on('click', '#brands_table .tree-toggle', function(e){
            e.preventDefault();
            e.stopPropagation();

            var $toggle = $(this);
            var $parentRow = $toggle.closest('tr');
            var parentId = $parentRow.attr('data-item-id');
            var $childRows = $('#brands_table tbody tr.brand-child-row[data-parent-id="' + parentId + '"]');
            var isCollapsed = $toggle.hasClass('collapsed');

            if (isCollapsed) {
                $toggle.removeClass('collapsed');
                $childRows.removeClass('tree-collapsed').show();
            } else {
                $toggle.addClass('collapsed');
                $childRows.addClass('tree-collapsed').hide();
            }
        });

        $(document).on('click', '#toggle_all_brands', function(){
            var isCollapsed = $(this).data('collapsed') === true;
            if (isCollapsed) {
                expandAllBrandChildren();
            } else {
                collapseAllBrandChildren();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>