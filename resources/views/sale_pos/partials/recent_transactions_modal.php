<div class="modal fade d-print-none" tabindex="-1" role="dialog" id="recent_transactions_modal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content rt-modal-content">
			
			<div class="modal-header bg-primary text-white py-2">
				<h5 class="modal-title fw-semibold" id="recentTxModalTitle">
					<i class="fas fa-clock me-2"></i><?php echo app('translator')->get('lang_v1.recent_transactions'); ?>
				</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>

			
			<div class="modal-body rt-modal-body p-3">
				
				<ul class="nav nav-tabs rt-nav-tabs mb-3" role="tablist">
					<li class="nav-item" role="presentation">
						<a class="nav-link active" href="#tab_final" data-bs-toggle="tab" role="tab">
							<i class="fas fa-check-circle"></i> <span class="rt-tab-label"><?php echo app('translator')->get('lang_v1.final_paid'); ?></span>
						</a>
					</li>
					<?php if($pos_settings['disable_credit_sale_button'] != 1): ?>
					<li class="nav-item" role="presentation">
						<a class="nav-link" href="#tab_credit_sale" data-bs-toggle="tab" role="tab">
							<i class="fas fa-credit-card"></i> <span class="rt-tab-label"><?php echo app('translator')->get('lang_v1.credit_sale'); ?></span>
						</a>
					</li>
					<?php endif; ?>
					<?php if($pos_settings['disable_draft'] != 1 && (auth()->user()->hasRole('Admin#'.auth()->user()->business_id) || auth()->user()->can('draft.view_all') || auth()->user()->can('draft.view_own'))): ?>
					<li class="nav-item" role="presentation">
						<a class="nav-link" href="#tab_draft" data-bs-toggle="tab" role="tab">
							<i class="fas fa-file-alt"></i> <span class="rt-tab-label"><?php echo app('translator')->get('sale.draft'); ?></span>
						</a>
					</li>
					<?php endif; ?>
					<li class="nav-item" role="presentation">
						<a class="nav-link" href="#tab_return" data-bs-toggle="tab" role="tab">
							<i class="fas fa-undo"></i> <span class="rt-tab-label"><?php echo app('translator')->get('sale.return'); ?></span>
						</a>
					</li>
					<?php if($pos_settings['disable_quotation_button'] != 1): ?>
					<li class="nav-item" role="presentation">
						<a class="nav-link" href="#tab_quotation" data-bs-toggle="tab" role="tab">
							<i class="fas fa-file-invoice"></i> <span class="rt-tab-label"><?php echo app('translator')->get('lang_v1.quotation'); ?></span>
						</a>
					</li>
					<?php endif; ?>
					<?php if(in_array('tables', $enabled_modules)): ?>
					<li class="nav-item" role="presentation">
						<a class="nav-link" href="#tab_table_order" data-bs-toggle="tab" role="tab">
							<i class="fas fa-utensils"></i> <span class="rt-tab-label"><?php echo app('translator')->get('sale.table_order'); ?></span>
						</a>
					</li>
					<?php endif; ?>
				</ul>

				
				<div class="tab-content rt-tab-content">
					<div class="tab-pane fade show active" id="tab_final" role="tabpanel"></div>
					<?php if($pos_settings['disable_credit_sale_button'] != 1): ?>
					<div class="tab-pane fade" id="tab_credit_sale" role="tabpanel"></div>
					<?php endif; ?>
					<?php if($pos_settings['disable_draft'] != 1 && (auth()->user()->hasRole('Admin#'.auth()->user()->business_id) || auth()->user()->can('draft.view_all') || auth()->user()->can('draft.view_own'))): ?>
					<div class="tab-pane fade" id="tab_draft" role="tabpanel"></div>
					<?php endif; ?>
					<div class="tab-pane fade" id="tab_return" role="tabpanel"></div>
					<?php if($pos_settings['disable_quotation_button'] != 1): ?>
					<div class="tab-pane fade" id="tab_quotation" role="tabpanel"></div>
					<?php endif; ?>
					<?php if(in_array('tables', $enabled_modules)): ?>
					<div class="tab-pane fade" id="tab_table_order" role="tabpanel"></div>
					<?php endif; ?>
				</div>
			</div>

			
			<div class="modal-footer rt-modal-footer py-2 px-3">
				
				<div class="rt-footer-actions d-flex gap-2 flex-wrap">
					<?php if(auth()->user()->can('sell.update') || auth()->user()->can('direct_sell.update') || auth()->user()->can('draft.update')): ?>
					<button type="button" class="btn btn-outline-primary btn-sm rt-action-btn rt-act-edit" disabled>
						<i class="fas fa-pen me-1"></i><?php echo app('translator')->get('messages.edit'); ?>
					</button>
					<?php endif; ?>
					<?php if(auth()->user()->can('sell.delete') || auth()->user()->can('direct_sell.delete') || auth()->user()->can('draft.delete')): ?>
					<button type="button" class="btn btn-outline-danger btn-sm rt-action-btn rt-act-delete" disabled>
						<i class="fas fa-trash me-1"></i><?php echo app('translator')->get('messages.delete'); ?>
					</button>
					<?php endif; ?>
					<?php if(!auth()->user()->can('sell.update') && auth()->user()->can('edit_pos_payment')): ?>
					<button type="button" class="btn btn-outline-info btn-sm rt-action-btn rt-act-payment" disabled>
						<i class="fas fa-money-bill-alt me-1"></i><?php echo app('translator')->get('lang_v1.add_edit_payment'); ?>
					</button>
					<?php endif; ?>
					<button type="button" class="btn btn-outline-secondary btn-sm rt-action-btn rt-act-print" disabled>
						<i class="fas fa-print me-1"></i><?php echo app('translator')->get('lang_v1.print_invoice'); ?>
					</button>
					<button type="button" class="btn btn-outline-warning btn-sm rt-action-btn rt-act-kot" disabled>
						<i class="fas fa-utensils me-1"></i><?php echo app('translator')->get('lang_v1.print_kot'); ?>
					</button>
				</div>
				<div class="rt-footer-total" aria-live="polite"></div>
				
				<button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
					<i class="fas fa-times me-1"></i><?php echo app('translator')->get('messages.close'); ?>
				</button>
			</div>
		</div>
	</div>
</div>
