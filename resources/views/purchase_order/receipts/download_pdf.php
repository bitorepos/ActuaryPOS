<?php
	$pdf_generation_for = ['Original for Buyer'];
?>

<?php $__currentLoopData = $pdf_generation_for; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdf_for): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<link rel="stylesheet" href="<?php echo e(asset('css/app.css?v='.$asset_v), false); ?>">
	<style type="text/css">
		table.tpdf {
		  width: 100% !important;
		  border-collapse: collapse;
		  line-height: 1.1;
		}

		table.tpdf, table.tpdf tr, table.tpdf td, table.tpdf th {
		  border: 1px solid black;
		  padding-left: 10px;
		  padding-top: 6px;
		}
		.box {
			border: 1px solid black;
		}

	</style>
	<div class="width-100">
		<div class="width-100 f-left" align="center">
			<strong class="font-17"><?php echo app('translator')->get('lang_v1.purchase_order'); ?></strong>
		</div>
		
	</div>
	<div class="width-100 box">
		<div class="width-100 mb-10 mt-10" align="center">
		</div>
		<div class="width-40 f-left" style="text-align: center;">
			<?php if(!empty($logo)): ?>
	          <img src="<?php echo e($logo, false); ?>" alt="Logo" style="width: 85%; height: 60%; margin: auto;padding-left: 30px;">
	        <?php endif; ?>
	        <div style="margin-left: 30px;margin-top: 0px;padding-top: 0px;">
	        	<?php if(!empty($location_details->custom_field1) && !empty($custom_labels['location']['custom_field_1'])): ?>
					<?php echo e($custom_labels['location']['custom_field_1'], false); ?> : <?php echo e($location_details->custom_field1, false); ?>

		        <?php endif; ?>
	        	<br>
	        	<?php if(!empty($purchase->business->tax_number_1)): ?>
		          <br><?php echo e($purchase->business->tax_label_1, false); ?>: <?php echo e($purchase->business->tax_number_1, false); ?>

		        <?php endif; ?>

		        <?php if(!empty($purchase->business->tax_number_2)): ?>
		          , <?php echo e($purchase->business->tax_label_2, false); ?>: <?php echo e($purchase->business->tax_number_2, false); ?>

		        <?php endif; ?>
	        </div>
		</div>
		<div class="width-60 f-left" align="center" style="color: #22489B;padding-top: 5px;">
			<strong class="font-23">
	    		<?php echo $purchase->business->name; ?>

	    	</strong>
	    	<br>
	    	<?php echo e($purchase->location->name, false); ?>

	        <?php if(!empty($purchase->location->landmark)): ?>
	          <br><?php echo e($purchase->location->landmark, false); ?>

	        <?php endif; ?>
	        <?php if(!empty($purchase->location->city) || !empty($purchase->location->state) || !empty($purchase->location->country)): ?>
	          <?php echo e(implode(',', array_filter([$purchase->location->city, $purchase->location->state, $purchase->location->country])), false); ?>

	        <?php endif; ?>
	    	<?php if(!empty($location_details->mobile) || !empty($location_details->alternate_number)): ?>
	    		<br>
	    		<?php echo app('translator')->get('lang_v1.contact_no'); ?> : <?php echo e(!empty($location_details->mobile) ? $location_details->mobile .', ': '', false); ?> <?php echo e($location_details->alternate_number, false); ?>

	    	<?php endif; ?>
	    	<?php if(!empty($location_details->website)): ?>
	    		<br>
	    		<?php echo app('translator')->get('lang_v1.website'); ?>: 
	    		<a href="<?php echo $location_details->website; ?>" target="_blank" style="text-decoration: none;">
					<?php echo $location_details->website; ?>

				</a>
	    	<?php endif; ?>
	    	<?php if(!empty($location_details->email)): ?>
	    		<br><?php echo app('translator')->get('business.email'); ?>: <?php echo $location_details->email; ?>

	    	<?php endif; ?>
	        <?php if(!empty($location_details->custom_field2) && !empty($custom_labels['location']['custom_field_2'])): ?>
	          <br><?php echo e($custom_labels['location']['custom_field_2'], false); ?> : <?php echo e($location_details->custom_field2, false); ?>

	        <?php endif; ?>
	        <?php if(!empty($location_details->custom_field3) && !empty($custom_labels['location']['custom_field_3'])): ?>
	          <br><?php echo e($custom_labels['location']['custom_field_3'], false); ?> : <?php echo e($location_details->custom_field3, false); ?>

	        <?php endif; ?>
	        <?php if(!empty($location_details->custom_field4) && !empty($custom_labels['location']['custom_field_4'])): ?>
	          <br><?php echo e($custom_labels['location']['custom_field_4'], false); ?> : <?php echo e($location_details->custom_field4, false); ?>

	        <?php endif; ?>
		</div>
	</div>
	<table class="tpdf">
		<tr>
			<td class="width-50">
				<strong><?php echo app('translator')->get('lang_v1.po_no'); ?>:</strong> #<?php echo e($purchase->ref_no, false); ?> <br>
				<strong><?php echo app('translator')->get('lang_v1.order_date'); ?>:</strong> <?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->transaction_date))->format(session('business.date_format')), false); ?>

			</td>
			<td class="width-50">
				
				<?php if(!empty($purchase->shipping_custom_field_1)): ?>
		          <strong>
		          	<?php echo e($custom_labels['shipping']['custom_field_1'] ?? '', false); ?>:
		          </strong>
		          	<?php echo e($purchase->shipping_custom_field_1, false); ?>

		          <br>
		        <?php endif; ?>


		        <strong><?php echo app('translator')->get('lang_v1.delivery_date'); ?>:</strong>
				<?php if(!empty($purchase->delivery_date)): ?>
					<?php echo e(\Carbon::createFromTimestamp(strtotime($purchase->delivery_date))->format(session('business.date_format')), false); ?>

				<?php else: ?>
					<?php echo e('-', false); ?>

				<?php endif; ?>
			</td>
		</tr>
		<tr>
			<td class="width-50">
				<strong><?php echo app('translator')->get('purchase.supplier'); ?></strong> <br>
		        <?php
		        	$customer_address = [];
		            if (!empty($purchase->contact->supplier_business_name)) {
		                $customer_address[] = $purchase->contact->supplier_business_name;
		            }
		            if (!empty($purchase->contact->address_line_1)) {
		                $customer_address[] = '<br>' . $purchase->contact->address_line_1;
		            }
		            if (!empty($purchase->contact->address_line_2)) {
		                $customer_address[] =  '<br>' . $purchase->contact->address_line_2;
		            }
		            if (!empty($purchase->contact->city)) {
		                $customer_address[] = '<br>' . $purchase->contact->city;
		            }
		            if (!empty($purchase->contact->state)) {
		                $customer_address[] = $purchase->contact->state;
		            }
		            if (!empty($purchase->contact->country)) {
		                $customer_address[] = $purchase->contact->country;
		            }
		            if (!empty($purchase->contact->zip_code)) {
		                $customer_address[] = '<br>' . $purchase->contact->zip_code;
		            }
		            if (!empty($purchase->contact->name)) {
		                $customer_address[] = '<br>' . $purchase->contact->name;
		            }
		            if (!empty($purchase->contact->mobile)) {
		                $customer_address[] = '<br>' .$purchase->contact->mobile;
		            }
		            if (!empty($purchase->contact->landline)) {
		                $customer_address[] = $purchase->contact->landline;
		            }
		        ?>
		        <?php echo implode(', ', $customer_address); ?>

		        <?php if(!empty($purchase->contact->email)): ?>
		          <br><?php echo app('translator')->get('business.email'); ?>: <?php echo e($purchase->contact->email, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($purchase->contact->tax_number)): ?>
		          <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($purchase->contact->tax_number, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_1']) && !empty($purchase->contact->custom_field1)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_1'], false); ?> : <?php echo e($purchase->contact->custom_field1, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_2']) && !empty($purchase->contact->custom_field2)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_2'], false); ?> : <?php echo e($purchase->contact->custom_field2, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_3']) && !empty($purchase->contact->custom_field3)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_3'], false); ?> : <?php echo e($purchase->contact->custom_field3, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_4']) && !empty($purchase->contact->custom_field4)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_4'], false); ?> : <?php echo e($purchase->contact->custom_field4, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_5']) && !empty($purchase->contact->custom_field5)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_5'], false); ?> : <?php echo e($purchase->contact->custom_field5, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_6']) && !empty($purchase->contact->custom_field6)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_6'], false); ?> : <?php echo e($purchase->contact->custom_field6, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_7']) && !empty($purchase->contact->custom_field7)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_7'], false); ?> : <?php echo e($purchase->contact->custom_field7, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_8']) && !empty($purchase->contact->custom_field8)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_8'], false); ?> : <?php echo e($purchase->contact->custom_field8, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_9']) && !empty($purchase->contact->custom_field9)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_9'], false); ?> : <?php echo e($purchase->contact->custom_field9, false); ?>

		        <?php endif; ?>
		        <?php if(!empty($custom_labels['contact']['custom_field_10']) && !empty($purchase->contact->custom_field10)): ?>
		        	<br><?php echo e($custom_labels['contact']['custom_field_10'], false); ?> : <?php echo e($purchase->contact->custom_field10, false); ?>

		        <?php endif; ?>
			</td>
			<td class="width-50">
				<strong><?php echo app('translator')->get('lang_v1.delivery_at'); ?></strong><br>
				<?php echo $purchase->location->location_address; ?>

		        <br>
		        
			</td>
		</tr>
	</table>
	<div class="box box-primary">
	<table class="table-pdf td-border">
		<?php
			$show_cat_code = !empty($invoice_layout->show_cat_code) && $invoice_layout->show_cat_code == 1 ? true : false;

			$show_brand = !empty($invoice_layout->show_brand) && $invoice_layout->show_brand == 1 ? true : false;

			$show_sku = !empty($invoice_layout->show_sku) && $invoice_layout->show_sku == 1 ? true : false;
		?>
		<thead>
			<tr class="row-border">
				<th>
					#
				</th>
				<th style="width: 40% !important;">
					<?php echo e($invoice_layout->table_product_label, false); ?>

				</th>
				<?php if($show_cat_code): ?>
					<th>
						<?php echo e($invoice_layout->cat_code_label, false); ?>

					</th>
				<?php endif; ?>
				<th>
					<?php echo e($invoice_layout->table_qty_label, false); ?>

				</th>
				<th >
					<?php echo e($invoice_layout->table_unit_price_label, false); ?>

				</th>
				<th>
					<?php echo e($invoice_layout->table_subtotal_label, false); ?>

				</th>
		</tr>
		</thead>
	 	<?php 
        	$total = 0.00;
        	$is_empty_row_looped = true;
        	$tax_array = [];
      	?>
		<?php $__currentLoopData = $purchase->purchase_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase_line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr <?php if($loop->iteration % 2 !== 0): ?> class="odd" <?php endif; ?> style="border:hidden;">
				<td>
					<?php echo e($loop->iteration, false); ?>

				</td>
				<td style="width: 40% !important;">
					<?php echo e($purchase_line->product->name, false); ?>

	                <?php if( $purchase_line->product->type == 'variable'): ?>
	                  - <?php echo e($purchase_line->variations->product_variation->name, false); ?>

	                  - <?php echo e($purchase_line->variations->name, false); ?>

	                 <?php endif; ?>

	                <?php if($show_sku): ?>
	                , <?php echo e($purchase_line->variations->sub_sku, false); ?>

	                <?php endif; ?>

	                <?php if($show_brand && !empty($purchase_line->product->brand)): ?>
	                , <?php echo e($purchase_line->product->brand->name ?? '', false); ?>

	                <?php endif; ?>
				</td>
				<?php if($show_cat_code): ?>
					<td>
						<?php echo e($purchase_line->product->category->short_code ?? '', false); ?>

					</td>
				<?php endif; ?>
				<td>
					<?php echo e(number_format($purchase_line->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?>

				</td>
				<td>
					<?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->purchase_price, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?>
				</td>
				<td>
					<?php 
		              $total += ($purchase_line->quantity * $purchase_line->purchase_price);
		              if (!empty($purchase_line->tax_id)) {
		              	$tax_array[$purchase_line->tax_id][] = ($purchase_line->item_tax * $purchase_line->quantity);
		              }
		            ?>
		            <?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $purchase_line->quantity * $purchase_line->purchase_price, session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?>
				</td>
			</tr>
			<?php if(count($purchase->purchase_lines) < 6 && $is_empty_row_looped && $loop->last): ?>
				<?php
					$i = 0;
					$is_empty_row_looped = false;
					$loop_until = 0;
					if (count($purchase->purchase_lines) == 1) {
						$loop_until = 5;
					} elseif (count($purchase->purchase_lines) == 2) {
						$loop_until = 4;
					} elseif (count($purchase->purchase_lines) == 3) {
						$loop_until = 3;
					} elseif (count($purchase->purchase_lines) == 4) {
						$loop_until = 3;
					}
				?>
				<?php for($i; $i<= $loop_until ; $i++): ?>
					<tr style="border:hidden;">
						<td>
							&nbsp;
						</td>
						<td>
							&nbsp;
						</td>
						<?php if($show_cat_code): ?>
							<td>
								&nbsp;
							</td>
						<?php endif; ?>
						<td>
							&nbsp;
						</td>
						<td>
							&nbsp;
						</td>
						<td>
							&nbsp;
						</td>
					</tr>
				<?php endfor; ?>
			<?php endif; ?>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<tr>
			<td <?php if($show_cat_code): ?> colspan="5" <?php else: ?> colspan="4" <?php endif; ?> style="text-align: center;">
				<?php echo e($invoice_layout->sub_total_label, false); ?>

			</td>
			<td colspan="1">
				<strong>
					<?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
				</strong>
			</td>
		</tr>
		<tr>
			<td <?php if($show_cat_code): ?> colspan="3" <?php else: ?> colspan="2" <?php endif; ?>>
				<?php if($purchase->additional_notes): ?>
		          <?php echo e($purchase->additional_notes, false); ?>

		        <?php else: ?>
		          --
		        <?php endif; ?>
			</td>
			<td colspan="3">
				<?php if(!empty($tax_array)): ?>
		        	<?php $__currentLoopData = $tax_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		        		<?php echo e($taxes->where('id', $key)->first()->name, false); ?> (<?php echo e($taxes->where('id', $key)->first()->amount, false); ?>%) : <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) array_sum($value), session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <br>
		        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		        <?php endif; ?>
				
				<?php echo e($invoice_layout->total_label, false); ?> : <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $purchase->final_total, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?>
			</td>
		</tr>
		<tr>
			<td colspan="6">
				<?php echo ucfirst($total_in_words); ?>

			</td>
		</tr>
		<tr>
			<td colspan="6">
				<?php if(!empty($invoice_layout->footer_text)): ?>
					<?php echo $invoice_layout->footer_text; ?>

				<?php endif; ?>
			</td>
		</tr>
	</table>
	</div>
	<table class="tpdf">
		<tr>
			<td colspan="2" style="text-align: center;">
				<?php echo app('translator')->get('lang_v1.checked_by'); ?>
			</td>
			<td colspan="2" style="text-align: center;">
				<?php echo app('translator')->get('lang_v1.prepared_by'); ?> <br><?php echo e($purchase->sales_person->user_full_name, false); ?>

			</td>
			<td colspan="2" style="text-align: center;">
				<br><br>
				<?php echo app('translator')->get('lang_v1.for_business', ['business' => $purchase->business->name]); ?>
				<br><br>
				<?php if(!empty($last_purchase)): ?>
					<?php echo e($last_purchase->sales_person->user_full_name, false); ?>

				<?php endif; ?>
				<br>
				<?php echo e(__('lang_v1.authorized_signatory'), false); ?>

			</td>
		</tr>
	</table>
	<?php
		$bottom = '5px';
		if (count($purchase->purchase_lines) >= 3) {
			$bottom = '-15px';
		}
	?>
	<div align="center" class="fs-10" style="position: fixed;width: 100%;bottom: <?php echo e($bottom, false); ?>;text-align: center;">
		This is a computer generated document, no signature required.
	</div>
	<?php if(!$loop->last): ?>
		<pagebreak>
	<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
