<!-- app css -->
<?php if(!empty($for_pdf)): ?>
	<link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
<?php endif; ?>
<?php
$statues = ['pending' => __('lang_v1.pending'), 'in_transit' => __('lang_v1.in_transit'), 'final' => __('restaurant.completed')];
$common_settings = session()->get('business.common_settings');
?>
<div class="col-md-12 col-sm-12" style="background-color: white !important">
	
	<div class="table-responsive">
		<table class="table table-bordered" id="combo_items_report" >
		<thead>
			<tr class="row-border blue-heading text-center">
				<th style="width:6%"><?php echo app('translator')->get('product.sku'); ?></th>
				<th style="width:30%"><?php echo app('translator')->get('sale.product'); ?></th>
				<th style="width:10%"><?php echo app('translator')->get('sale.unit_price'); ?> ()</th>
				<th style="width:10%"><?php echo e(__('purchase.unit_cost_exc_tax'), false); ?></th>
				<th style="width:6%"><?php echo e(__('lang_v1.profit'), false); ?></th>
				<th style="width:6%"><?php echo e(__('lang_v1.gross_profit'), false); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$footer_sale_total = 0;
				$footer_purchase_total = 0;
			?>
			<?php $__currentLoopData = $combo_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
				<?php
				$total_purchase = 0;
				foreach ($cp['combo_variations'] as $cpcv){
					$total_purchase += $cpcv['variation']->default_purchase_price * $cpcv['quantity'] * $cpcv['multiplier']; 
				}

				$footer_sale_total += $cp['sale_price'];
				$footer_purchase_total += $total_purchase;

				$gross_profit = 0;
				if($cp['sale_price'] != 0){
					$gross_profit = (($cp['sale_price'] - $total_purchase) / $cp['sale_price']) * 100;
				}
				?>

				<tr style="background: #ccc !important;">
					<td class="row-border"><?php echo e($cp['sku'], false); ?></td>
					<td><?php echo e($cp['name'], false); ?></td>
					<td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $cp['sale_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_purchase, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $cp['sale_price'] - $total_purchase, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
					<td><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $gross_profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>%</td>
				</tr>			
				
				<tr>
					<td colspan="8" class="bg-light-skin" style="padding: 0 20px 10px;">
						<table class="table table-bordered table-slim mb-0 bg-light-skin">
							<tr>
								<th style="width:6%">#</th>
								<th style="width:30%"><?php echo e(__('sale.product'), false); ?> </th>
								<th style="width:6%"><?php echo e(__('sale.qty'), false); ?></th>
								<th style="width:8%"><?php echo e(__('purchase.unit_cost_exc_tax'), false); ?></th>
								<th style="width:7%"><?php echo e(__('lang_v1.total_purchase'), false); ?></th>
							</tr>
							<?php
							$total_ing_purchase = 0;
							?>
							<?php $__empty_1 = true; $__currentLoopData = $cp['combo_variations']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
							<tr>
								<td><?php echo e($loop->index+1, false); ?></td>
								<td><?php echo e($v['variation']['product']->name, false); ?> 

									<?php if($v['variation']['product']->type == 'variable'): ?>
										- <?php echo e($v['variation']->name, false); ?>

									<?php endif; ?>
									
									(<?php echo e($v['variation']->sub_sku, false); ?>)
								</td>
								<td><?php echo e(number_format($v['quantity'], session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php echo e($v['unit_name'], false); ?></td>
								<td><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $v['variation']->default_purchase_price, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
								<td><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $v['variation']->default_purchase_price * $v['quantity'] * $v['multiplier'], session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
							</tr>
							<?php
							$total_ing_purchase += $v['variation']->default_purchase_price * $v['quantity'] * $v['multiplier'];
							?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
							<tr>
								<td colspan="5" class="text-center">No Products Assigned</td>
							</tr>
							<?php endif; ?>
							<tr>
								<td colspan="4"></td>
								<td><b><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total_ing_purchase, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></b></td>
							</tr>
						</table>
					</td>
				</tr>
					
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			<tr class="row-border blue-heading text-center">
				<?php
				$footer_gross_profit = 0;
				if(!empty($footer_sale_total)){
					$footer_gross_profit = (($footer_sale_total - $footer_purchase_total) / $footer_sale_total) * 100;
				}

				?>
				<th class="row-border align-right" colspan="2"><?php echo app('translator')->get('lang_v1.grand_total'); ?>:</th>
				<th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $footer_sale_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
				<th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $footer_purchase_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></t>
				<th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $footer_sale_total - $footer_purchase_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></th>
				<th><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $footer_gross_profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>%</th>
			</tr>	
		</tbody>
	</table>
	</div>
	<style>
		.line_details tr td, .line_details tr th, #yellow_footer td
		{
			text-align: left !important;
		}
		.bg-gray td, .center_text
		{
			text-align: center !important;
		}
		.ledger_table{
			overflow-x: scroll;
		}
	</style>
</div>
