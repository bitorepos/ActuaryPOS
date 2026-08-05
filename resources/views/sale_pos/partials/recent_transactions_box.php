<div class="box box-widget <?php if($pos_settings['hide_product_suggestion'] == 0): ?> collapsed-box <?php endif; ?>">
	<div class="box-header with-border">
		<h3 class="box-title"><?php echo app('translator')->get('sale.recent_transactions'); ?></h3>

		<div class="box-tools float-end">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<?php if($pos_settings['hide_product_suggestion'] == 0): ?>
					<i class="fa fa-plus"></i>
				<?php else: ?>
					<i class="fa fa-minus"></i>
				<?php endif; ?>
			</button>
		</div>

	<!-- /.box-tools -->
	</div>
	<!-- /.box-header -->

	<div class="box-body">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_final" data-bs-toggle="tab" aria-expanded="true"><b><i class="fa fa-check"></i> <?php echo app('translator')->get('lang_v1.final_paid'); ?></b></a></li>
				
				<?php if($pos_settings['disable_credit_sale_button'] != 1): ?>
				<li class=""><a href="#tab_credit_sale" data-bs-toggle="tab" aria-expanded="false"><b><i class="fa fa-terminal"></i> <?php echo app('translator')->get('lang_v1.credit_sale'); ?></b></a></li>
				<?php endif; ?>

				<?php if($pos_settings['disable_draft'] != 1 && (auth()->user()->hasRole('Admin#'.auth()->user()->business_id) || auth()->user()->can('draft.view_all') || auth()->user()->can('draft.view_own'))): ?>
				<li class=""><a href="#tab_draft" data-bs-toggle="tab" aria-expanded="false"><b><i class="fa fa-terminal"></i> <?php echo app('translator')->get('sale.draft'); ?></b></a></li>
				<?php endif; ?>

				<li><a href="#tab_return" data-bs-toggle="tab" aria-expanded="true"><b><i class="fa fa-check"></i> <?php echo app('translator')->get('sale.return'); ?></b></a></li>
				
				<?php if($pos_settings['disable_quotation_button'] != 1): ?>
				<li class=""><a href="#tab_quotation" data-bs-toggle="tab" aria-expanded="false"><b><i class="fa fa-terminal"></i> <?php echo app('translator')->get('lang_v1.quotation'); ?></b></a></li>
				<?php endif; ?>
				
				<li class=""><a href="#tab_table_order" data-bs-toggle="tab" aria-expanded="false"><b><i class="fa fa-terminal"></i> <?php echo app('translator')->get('sale.table_order'); ?></b></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_final" style="overflow: scroll;">
				</div>

				<?php if($pos_settings['disable_credit_sale_button'] != 1): ?>
				<div class="tab-pane" id="tab_credit_sale">
				</div>
				<?php endif; ?>

				<?php if($pos_settings['disable_draft'] != 1 && (auth()->user()->hasRole('Admin#'.auth()->user()->business_id) || auth()->user()->can('draft.view_all') || auth()->user()->can('draft.view_own'))): ?>
				<div class="tab-pane" id="tab_draft">
				</div>
				<?php endif; ?>

				<div class="tab-pane" id="tab_return" style="overflow: scroll;">
				</div>

				<?php if($pos_settings['disable_quotation_button'] != 1): ?>
				<div class="tab-pane" id="tab_quotation">
				</div>
				<?php endif; ?>
				
				<div class="tab-pane" id="tab_table_order"></div>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>
