<?php
    $is_cat_code_enabled = isset($module_category_data['enable_taxonomy_code']) && !$module_category_data['enable_taxonomy_code'] ? false : true;
    $can_manage_project_category = $category_type == 'project'
        && (auth()->user()->can('superadmin')
            || auth()->user()->hasRole('Admin#' . session()->get('user.business_id'))
            || auth()->user()->can('project.manage_project_category'));
    $can_create_category = $category_type == 'project' ? $can_manage_project_category : auth()->user()->can('category.create');
    $can_view_category = $category_type == 'project' ? $can_manage_project_category : auth()->user()->can('category.view');
?>
<?php if($can_create_category): ?>
	<button type="button" class="btn btn-sm float-end btn-primary btn-modal" data-href="<?php echo e(action([\App\Http\Controllers\TaxonomyController::class, 'create']), false); ?>?type=<?php echo e($category_type, false); ?>" data-container=".category_modal">
		<i class="fa fa-plus"></i>
		<?php echo app('translator')->get( 'messages.add' ); ?>
	</button>
	<br><br>
<?php endif; ?>

 <?php if($can_view_category): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-th-skin" id="category_table" style="width: 100%;">
            <thead>
                <tr>
                    <th><?php if(!empty($module_category_data['taxonomy_label'])): ?> <?php echo e($module_category_data['taxonomy_label'], false); ?> <?php else: ?> <?php echo app('translator')->get( 'category.category' ); ?> <?php endif; ?></th>
                    <?php if($is_cat_code_enabled): ?>
                        <th><?php echo e($module_category_data['taxonomy_code_label'] ?? __( 'category.code' ), false); ?></th>
                    <?php endif; ?>
                    <th><?php echo app('translator')->get( 'lang_v1.description' ); ?></th>
                    <?php if($category_type == 'product'): ?>
                        <th><?php echo app('translator')->get('lang_v1.no_of_products'); ?></th>
                    <?php endif; ?>
                    <th><?php echo app('translator')->get( 'messages.action' ); ?></th>
                </tr>
            </thead>
        </table>
    </div>
<?php endif; ?>

<div class="modal fade category_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>
