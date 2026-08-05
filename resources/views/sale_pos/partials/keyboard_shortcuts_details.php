<div class="modal fade" id="posKeyboardShortcutsModal" tabindex="-1" aria-labelledby="posKeyboardShortcutsModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
	<h5 class="modal-title" id="posKeyboardShortcutsModalLabel"><i class="fas fa-keyboard"></i> <?php echo app('translator')->get('business.add_keyboard_shortcuts'); ?></h5>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-6">
<table class='table table-condensed table-striped'>
	<tr>
	    <th><?php echo app('translator')->get('business.operations'); ?></th>
	    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
	</tr>

	<?php if($pos_settings['disable_express_checkout'] == 0): ?>
		<tr>
		    <td><?php echo app('translator')->get('sale.express_finalize'); ?>:</td>
		    <td>
			    <?php if(!empty($shortcuts["pos"]["express_checkout"])): ?>
			    	<kbd><?php echo e($shortcuts["pos"]["express_checkout"], false); ?></kbd>
			    <?php endif; ?>
		    </td>
		</tr>
	<?php endif; ?>

	<?php if($pos_settings['disable_pay_checkout'] == 0): ?>
		<tr>
		    <td><?php echo app('translator')->get('sale.finalize'); ?>:</td>
		    <td>
		    	<?php if(!empty($shortcuts["pos"]["pay_n_ckeckout"])): ?>
			    	<kbd><?php echo e($shortcuts["pos"]["pay_n_ckeckout"], false); ?></kbd>
			    <?php endif; ?>
		    </td>
		</tr>
	<?php endif; ?>

	<?php if($pos_settings['disable_draft'] == 0): ?>
		<tr>
		    <td><?php echo app('translator')->get('sale.draft'); ?>:</td>
		    <td>
		    	<?php if(!empty($shortcuts["pos"]["draft"])): ?>
			    	<kbd><?php echo e($shortcuts["pos"]["draft"], false); ?></kbd>
			    <?php endif; ?>
		    </td>
		</tr>
	<?php endif; ?>

	<tr>
	    <td><?php echo app('translator')->get('messages.cancel'); ?>:</td>
	    <td>
	    	<?php if(!empty($shortcuts["pos"]["cancel"])): ?>
		    	<kbd><?php echo e($shortcuts["pos"]["cancel"], false); ?></kbd>
		    <?php endif; ?>
	    </td>
	</tr>

	<?php if($pos_settings['disable_discount'] == 0): ?>
		<tr>
		    <td><?php echo app('translator')->get('sale.edit_discount'); ?>:</td>
		    <td>
		    	<?php if(!empty($shortcuts["pos"]["edit_discount"])): ?>
			    	<kbd><?php echo e($shortcuts["pos"]["edit_discount"], false); ?></kbd>
			    <?php endif; ?>
		    </td>
		</tr>
	<?php endif; ?>

	<?php if($pos_settings['disable_invoice_tax'] == 0): ?>
		<tr>
		    <td><?php echo app('translator')->get('sale.edit_order_tax'); ?>:</td>
		    <td>
		    	<?php if(!empty($shortcuts["pos"]["edit_order_tax"])): ?>
			    	<kbd><?php echo e($shortcuts["pos"]["edit_order_tax"], false); ?></kbd>
			    <?php endif; ?>
		    </td>
		</tr>
	<?php endif; ?>

	<?php if($pos_settings['disable_pay_checkout'] == 0): ?>
		<tr>
		    <td><?php echo app('translator')->get('sale.add_payment_row'); ?>:</td>
		    <td>
		    	<?php if(!empty($shortcuts["pos"]["add_payment_row"])): ?>
			    	<kbd><?php echo e($shortcuts["pos"]["add_payment_row"], false); ?></kbd>
			    <?php endif; ?>
		    </td>
		</tr>
	<?php endif; ?>

	<?php if($pos_settings['disable_pay_checkout'] == 0): ?>
		<tr>
		    <td><?php echo app('translator')->get('sale.finalize_payment'); ?>:</td>
		    <td>
		    	<?php if(!empty($shortcuts["pos"]["finalize_payment"])): ?>
			    	<kbd><?php echo e($shortcuts["pos"]["finalize_payment"], false); ?></kbd>
			    <?php endif; ?>
		    </td>
		</tr>
	<?php endif; ?>
	
	<tr>
	    <td><?php echo app('translator')->get('lang_v1.recent_product_quantity'); ?>:</td>
	    <td>
	    	<?php if(!empty($shortcuts["pos"]["recent_product_quantity"])): ?>
		    	<kbd><?php echo e($shortcuts["pos"]["recent_product_quantity"], false); ?></kbd>
		    <?php endif; ?>
	    </td>
	</tr>

	<tr>
	    <td><?php echo app('translator')->get('lang_v1.add_new_product'); ?>:</td>
	    <td>
	    	<?php if(!empty($shortcuts["pos"]["add_new_product"])): ?>
		    	<kbd><?php echo e($shortcuts["pos"]["add_new_product"], false); ?></kbd>
		    <?php endif; ?>
	    </td>
	</tr>
	
	<?php if(isset($pos_settings['enable_weighing_scale']) && $pos_settings['enable_weighing_scale'] == 1): ?>
		<tr>
		    <td><?php echo app('translator')->get('lang_v1.weighing_scale'); ?>:</td>
		    <td>
		    	<?php if(!empty($shortcuts["pos"]["weighing_scale"])): ?>
			    	<kbd><?php echo e($shortcuts["pos"]["weighing_scale"], false); ?></kbd>
			    <?php endif; ?>
		    </td>
		</tr>
	<?php endif; ?>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.products_search'); ?>:</td>
		<td><kbd>f10</kbd></td>
	</tr>
</table>
</div>
<div class="col-md-6">
<table class='table table-condensed table-striped'>
	<tr>
	    <th><?php echo app('translator')->get('business.operations'); ?></th>
	    <th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
	</tr>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.focus_customer'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["focus_customer"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["focus_customer"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.add_new_customer_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["add_new_customer"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["add_new_customer"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<?php if(empty($pos_settings['disable_quotation_button'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.quotation'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["quotation"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["quotation"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if(empty($pos_settings['disable_suspend'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.suspend'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["suspend"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["suspend"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if(empty($pos_settings['disable_credit_sale_button'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.credit_sale'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["credit_sale"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["credit_sale"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if(empty($pos_settings['disable_card_button'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.express_card_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["express_card"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["express_card"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.recent_transactions'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["recent_transactions"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["recent_transactions"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.quick_add_product'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["quick_add_product"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["quick_add_product"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<?php if(!empty($pos_settings['enable_product_search_sku_pos'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.focus_sku_search'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["focus_sku_search"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["focus_sku_search"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.fullscreen_toggle'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["fullscreen_toggle"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["fullscreen_toggle"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.show_shortcuts_help'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["show_shortcuts_help"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["show_shortcuts_help"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<?php if($pos_settings['disable_shipping'] == 0): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.edit_shipping'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["edit_shipping"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["edit_shipping"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if(in_array('types_of_service', $enabled_modules ?? [])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.service_charge'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["service_charge"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["service_charge"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if(!empty($pos_settings['enable_takeaway'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.takeaway_1'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["takeaway_1"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["takeaway_1"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if(!empty($pos_settings['enable_takeaway_2'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.takeaway_2'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["takeaway_2"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["takeaway_2"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<?php if(!empty($pos_settings['enable_takeaway_3'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.takeaway_3'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["takeaway_3"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["takeaway_3"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>
</table>
</div>
</div>


<h6 class="mt-3 mb-2 text-muted"><i class="fas fa-bars"></i> <?php echo app('translator')->get('lang_v1.pos_navbar_shortcuts'); ?></h6>
<div class="row">
<div class="col-md-6">
<table class='table table-condensed table-striped'>
	<tr>
		<th><?php echo app('translator')->get('business.operations'); ?></th>
		<th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
	</tr>

	<?php if(!empty($pos_settings['enable_cash_pull'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.cash_pull'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["cash_pull"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["cash_pull"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.calculator_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["calculator"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["calculator"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<?php if(!empty($pos_settings['customer_display_screen'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.customer_display'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["customer_display"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["customer_display"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.open_cash_drawer_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["open_cash_drawer"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["open_cash_drawer"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<?php if(empty($pos_settings['disable_suspend'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.view_suspended_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["view_suspended"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["view_suspended"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.sell_return_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["sell_return"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["sell_return"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
</table>
</div>
<div class="col-md-6">
<table class='table table-condensed table-striped'>
	<tr>
		<th><?php echo app('translator')->get('business.operations'); ?></th>
		<th><?php echo app('translator')->get('business.keyboard_shortcut'); ?></th>
	</tr>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.add_expense_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["add_expense"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["add_expense"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.register_details_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["register_details"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["register_details"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.close_register_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["close_register"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["close_register"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>

	<?php if(!empty($pos_settings['inline_service_staff'])): ?>
	<tr>
		<td><?php echo app('translator')->get('lang_v1.service_staff_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["service_staff"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["service_staff"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
	<?php endif; ?>

	<tr>
		<td><?php echo app('translator')->get('lang_v1.go_back_shortcut'); ?>:</td>
		<td>
			<?php if(!empty($shortcuts["pos"]["go_back"])): ?>
				<kbd><?php echo e($shortcuts["pos"]["go_back"], false); ?></kbd>
			<?php endif; ?>
		</td>
	</tr>
</table>
</div>
</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get('messages.close'); ?></button>
</div>
</div>
</div>
</div>
