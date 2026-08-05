<?php
	$is_mobile = isMobile();
	$bg_colors = array('0079FF', '00DFA2', '4F709C', 'FF0060', 'E55807', 'F79327', 'B70404', 'DB005B', 'F266AB', 'A459D1');
	
?>
<div class="col-md-12">
		
		<?php if(!$is_mobile): ?>
			<button type="button" class="btn btn-danger disabled btn-lg col-md-12 pos_numpad_btn">
				<span class="text total_payable_preview_span" style="margin-right:0px;"><?php echo app('translator')->get('sale.total_payable'); ?></span>
				<span id="total_payable" class="number" style="font-size:40px">0</span>
				<span class="number change_return_preview_span hide" style="font-size:40px">0</span>
			</button>
			<input type="hidden" name="final_total" id="final_total_input" value=0>
		<?php endif; ?>
		
			
</div>
