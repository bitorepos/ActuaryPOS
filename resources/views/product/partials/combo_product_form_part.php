<?php
	$combo_products = $combo_products ?? [];
?>

<div class="col-sm-12"><br>
	<div class="row align-items-end mb-3">
		<div class="<?php if(!empty($combo_products)): ?> col-md-6 <?php else: ?> col-md-8 offset-md-2 <?php endif; ?>">
			<div class="mb-3">
				<?php echo Form::label('search_product', __('lang_v1.search_product') . ':'); ?>

				<div class="input-group">
					
						<button type="button" class="btn btn-secondary btn-flat" id="open_products_search_modal" title="<?php echo e(__('lang_v1.products_search'), false); ?>"><i class="fas fa-search"></i></button>
					
					<?php echo Form::text('search_product', null, ['class' => 'form-control', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder')]); ?>

				</div>
			</div>
		</div>

		<?php if(!empty($combo_products)): ?>
			<div class="col-md-6">
				<div class="mb-3">
					<?php echo Form::label('copy_combo_recipe_product_id', __('lang_v1.copy_combo_recipe_from') . ':'); ?>

					<select id="copy_combo_recipe_product_id" class="form-control select2" style="width: 100%;">
						<option value=""><?php echo app('translator')->get('messages.please_select'); ?></option>
						<?php $__currentLoopData = $combo_products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $combo_product_id => $combo_product_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($combo_product_id, false); ?>"><?php echo e($combo_product_name, false); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-condensed table-th-skin table-bordered table-striped add-product-price-table combo_product_table">
				<thead>
					<tr>
						<th class="text-center">
							<?php echo app('translator')->get('product.product_name'); ?>
						</th>
						<th class="text-center"> 
							<?php echo app('translator')->get('sale.qty'); ?>
						</th>
						<th class="text-center">
							<?php if($has_taxes): ?>
								<?php echo app('translator')->get('lang_v1.purchase_price_exc_tax'); ?>
							<?php else: ?>
								<?php echo app('translator')->get('lang_v1.purchase_price'); ?>
							<?php endif; ?>
						</th>
						<th class="text-center">
							<?php if($has_taxes): ?>
								<?php echo app('translator')->get('lang_v1.total_amount_exc_tax'); ?>
							<?php else: ?>
								<?php echo app('translator')->get('lang_v1.total_amount'); ?>
							<?php endif; ?>
						</th>
						<th class="text-center">
							<span>
								<i class="fa fa-trash"></i>
							</span>
						</th>
					</tr>
				</thead>
				<tbody>
					<?php if($action == 'edit' || $action == 'duplicate'): ?>
						<input type="hidden" name="combo_variation_id" value="<?php echo e($variation_id, false); ?>">

						<?php $__currentLoopData = $combo_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $combo_variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                			<?php echo $__env->make('product.partials.combo_product_entry_row', 
								['variations' => [$combo_variation['variation']], 'product' => $combo_variation['variation']->product, 'quantity' => $combo_variation['quantity'],
								'sub_units' => $combo_variation['sub_units'],
								'multiplier' => $combo_variation['multiplier'],
								'unit_id' => $combo_variation['unit_id'],
								]
							, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            		<?php endif; ?>

				</tbody><br>
				<tfoot class="combo_product_table_footer">
					<tr>
						<td></td>
						<td class="text-center"> 
							<b> <?php echo app('translator')->get( 'purchase.net_total_amount' ); ?></b> :
						</td>
						<td>
						</td>
						<td class="text-center">
							<span class="item_level_purchase_price_total display_currency" data-currency_symbol="true">
								0
							</span>
							<input type="hidden" name="item_level_purchase_price_total" id="item_level_purchase_price_total" value="0">
							<input type="hidden" name="purchase_price_inc_tax" id="purchase_price_inc_tax" value="0">
						</td>
					</tr>
				</tfoot>	
			</table>
		</div>
		<div class="col-sm-12">
			<div class="row">
			<div class="col-sm-4">
				<?php echo Form::label('margin', __('product.profit_percent')) .":"; ?>

				<?php echo Form::text('profit_percent', number_format($profit_percent, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number mousetrap', 'id' => 'margin']); ?>

			</div>
			<div class="col-sm-4">
				<?php echo Form::label('selling_price', "Default Selling Price "); ?> <?php echo e($has_taxes ? __('product.exc_of_tax').':' : '', false); ?>

				<?php echo Form::text('selling_price', ($product_details['variations'][0]['default_sell_price']) ? number_format($product_details['variations'][0]['default_sell_price'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number mousetrap']); ?>

			</div>
			<div class="col-sm-4 <?php if(!$has_taxes): ?> hidden <?php endif; ?>">
				<?php echo Form::label('selling_price', "Default Selling Price"); ?> <?php echo e($has_taxes ? __('product.inc_of_tax').':' : '', false); ?>

				<?php echo Form::text('selling_price_inc_tax', ($product_details['variations'][0]['sell_price_inc_tax']) ? number_format($product_details['variations'][0]['sell_price_inc_tax'], session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']) : number_format(0, session('business.currency_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), ['class' => 'form-control input-sm input_number mousetrap', 'id' => 'selling_price_inc_tax']); ?>

			</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var comboEventNs = '.combo_product_form';
		var comboRecipeReplaceText = <?php echo json_encode(__('lang_v1.existing_combo_ingredients_will_be_removed'), 15, 512) ?>;
		var comboRecipeLoadErrorText = <?php echo json_encode(__('lang_v1.unable_to_load_combo_recipe'), 15, 512) ?>;
		__currency_convert_recursively($(".combo_product_table"));
		//Use when editing product
		update_net_total_amount();

		if ($('#copy_combo_recipe_product_id').length) {
			$('#copy_combo_recipe_product_id').select2({
				width: '100%'
			});
		}

		function load_combo_recipe_rows(combo_product_id, select) {
			var comboRecipeSelect = $(select);
			var comboRecipeUrl = (typeof base_path !== 'undefined' ? base_path : '') + '/products/get-combo-product-recipe-rows';

			$.ajax({
				method : 'GET',
				url: comboRecipeUrl,
				dataType : 'json',
				data: { 'product_id' : combo_product_id},
				beforeSend: function() {
					comboRecipeSelect.prop('disabled', true);
				},
				success :function(result){
					if (result.success && result.html) {
						var rows = $('<tbody>' + result.html + '</tbody>').find('tr');
						var tbody = $(".combo_product_table tbody");
						tbody.find('tr').remove();

						rows.each(function(){
							tbody.append(update_combo_product_row_values($(this)));
						});

						update_net_total_amount();
						toastr.success(result.msg);
					} else {
						toastr.error(result.msg || comboRecipeLoadErrorText);
					}
				},
				error: function(xhr) {
					if (window.console) {
						console.error('Unable to load combo recipe', xhr.status, xhr.responseText);
					}
					toastr.error(comboRecipeLoadErrorText);
				},
				complete: function() {
					comboRecipeSelect.prop('disabled', false);
					comboRecipeSelect.val('').trigger('change.select2');
				}
			});
		}

		$(document)
			.off('change' + comboEventNs, '#copy_combo_recipe_product_id')
			.on('change' + comboEventNs, '#copy_combo_recipe_product_id', function(){
			var combo_product_id = $(this).val();
			var comboRecipeSelect = this;

			if (!combo_product_id) {
				return;
			}

			if ($(".combo_product_table tbody tr").length) {
				swal({
					title: LANG.sure,
					text: comboRecipeReplaceText,
					icon: "warning",
					buttons: true,
					dangerMode: true,
				}).then((value) => {
					if (value) {
						load_combo_recipe_rows(combo_product_id, comboRecipeSelect);
					} else {
						$(comboRecipeSelect).val('').trigger('change.select2');
					}
				});
			} else {
				load_combo_recipe_rows(combo_product_id, comboRecipeSelect);
			}
		});

		var appBasePath = (typeof base_path !== 'undefined' ? base_path : '');

		//Add products
	    if($( "#search_product" ).length > 0){
	        $( "#search_product" ).autocomplete({
	            source: appBasePath + "/purchases/get_products?check_enable_stock=false&hide_combo=<?php echo e($hide_combo, false); ?>",
	            minLength: 2,
	            response: function(event,ui) {
	                if (ui.content.length == 1)
	                {
	                    ui.item = ui.content[0];
	                    $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
	                    $(this).autocomplete('close');
	                }else if(ui.content.length == 0){
                        toastr.error(LANG.no_products_found);
                        $('#search_product').select();
					}
	            },
	            select: function( event, ui ) {
	                $(this).val(null);
	                get_product_entry_row( ui.item.product_id, ui.item.variation_id);
	            }
	        })
	        .autocomplete( "instance" )._renderItem = function( ul, item ) {
	            return $( "<li>" ).append( "<div>" + item.text + "</div>" ).appendTo( ul );
	        };
	    }

	    function get_product_entry_row(product_id, variation_id) {

	    	if (product_id) {
	    		$.ajax({
	    			method : 'GET',
	    			url: appBasePath + '/products/get-combo-product-entry-row',
	    			dataType : "html",
	    			data: { 'product_id' : product_id, 'variation_id' : variation_id},
	    			success :function(result){
	    				$(result).find('input.quantity').each(function(){
	    					var row = $(this).closest('tr');
	    					$(".combo_product_table tbody").append(update_combo_product_row_values(row));
	    					update_net_total_amount();
	    				});
	    			}
	    		});
	    	}
	    }

	    $(document)
			.off('click' + comboEventNs, '.remove_combo_product_entry_row')
			.on('click' + comboEventNs, '.remove_combo_product_entry_row', function(){
	    	swal({ 
            title: LANG.sure,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        	}).then((value) => {
	            if(value){
	                $(this).closest('tr').remove();
	                update_net_total_amount();
	            }
	        });
	    });

	    function update_combo_product_row_values(row) {
			var purchase_price = parseFloat(row.find('input.purchase_price').val());
			var quantity = __read_number(row.find('input.quantity'), false);
			var multiplier = __getUnitMultiplier(row);

			var item_level_purchase_price = quantity * purchase_price * multiplier;
			row.find('span.item_level_purchase_price').text(item_level_purchase_price);
			__currency_convert_recursively(row);

			row.find('input.item_level_purchase_price').val(item_level_purchase_price);
			
			return row;
	    }

	    function update_net_total_amount() {
	    	
	    	var item_level_purchase_price_total = 0;
	    	var purchase_price_inc_tax = 0;

	    	$('.combo_product_table').find('tr').each(function(){
	    		if ($(this).find('input.item_level_purchase_price').length) {
	    			item_level_purchase_price_total += parseFloat($(this).find('input.item_level_purchase_price').val());
	    		}
	    	});

	    	var tax_rate = $('select#tax').find(':selected').data('rate');
			var tax_type = $('select#tax_type').find(':selected').val();

	    	purchase_price_inc_tax = __add_percent(item_level_purchase_price_total, tax_rate);
	    	//Set selling price.
	    	$(".combo_product_table").find('span.item_level_purchase_price_total').text(item_level_purchase_price_total);
	    	$(".combo_product_table").find('input#item_level_purchase_price_total').val(item_level_purchase_price_total);
	    	$(".combo_product_table").find('input#purchase_price_inc_tax').val(purchase_price_inc_tax);

	    	__currency_convert_recursively($(".combo_product_table_footer").find('tr'));

	    	//Set selling price.
	    	var margin = __read_number($('input#margin'), false);
	    	
			if(tax_type == 'inclusive'){
				var selling_price = __add_percent(item_level_purchase_price_total, margin);
				if(selling_price == 0){
					selling_price = __read_number($('input#selling_price'));
					selling_price = __add_percent(selling_price, margin);
				}
				var selling_price_inc_tax = selling_price;
				var temp_tax = parseFloat((selling_price_inc_tax / ((tax_rate/100)+1)).toPrecision(5));
                var selling_price = temp_tax; 

			}else{
				var selling_price = __add_percent(item_level_purchase_price_total, margin);
				if(selling_price == 0){
					selling_price = __read_number($('input#selling_price'));
					selling_price = __add_percent(selling_price, margin);
				}
				var selling_price_inc_tax = __add_percent(selling_price, tax_rate);
			}
			//If Editing product don't change the selling price 
			if(!$('select#type').prop('disabled')){
				__write_number($('input#selling_price'), selling_price);
		    	__write_number($('input#selling_price_inc_tax'), selling_price_inc_tax);
			}else{
				var margin = __get_rate(item_level_purchase_price_total, __read_number($('input#selling_price')));
		    	__write_number($('input#margin'), margin);
			}
	    }

	    function recalculate_the_row(row){
	    	var quantity = __read_number(row.find('input.quantity'), false);
	    	var multiplier = __getUnitMultiplier(row);

	    	var purchase_price = parseFloat(row.find('input.purchase_price').val());
	    	var item_level_purchase_price = quantity * multiplier * purchase_price;

	    	row.find('span.purchase_price_text').text(purchase_price);
	    	row.find('span.item_level_purchase_price').text(item_level_purchase_price);
	    	row.find('input.item_level_purchase_price').val(item_level_purchase_price);
	    	__currency_convert_recursively(row);
	    	update_net_total_amount();
	    }

	    $(document)
			.off('change' + comboEventNs, 'input.quantity')
			.on('change' + comboEventNs, 'input.quantity', function(){
	    	var row = $(this).closest('tr');
	    	recalculate_the_row(row);
	    });
	    $(document)
			.off('change' + comboEventNs, 'select.sub_unit')
			.on('change' + comboEventNs, 'select.sub_unit', function(){
	    	var row = $(this).closest('tr');
	    	recalculate_the_row(row);
	    });

	    $(document)
			.off('change' + comboEventNs, 'input#margin')
			.on('change' + comboEventNs, 'input#margin', function(){
	    	update_net_total_amount();
	    });

	    $(document)
			.off('change' + comboEventNs, 'select#tax')
			.on('change' + comboEventNs, 'select#tax', function(){
			console.log('Test');

			var amount = __read_number($('input#selling_price'), false);
			var principal = parseFloat($('input#item_level_purchase_price_total').val());

	    	var margin = __get_rate(principal, amount);
	    	__write_number($('input#margin'), margin);

	    	var tax_rate = $('select#tax').find(':selected').data('rate');
	    	var selling_price_inc_tax = __add_percent(amount, tax_rate);
	    	__write_number($('input#selling_price_inc_tax'), selling_price_inc_tax);

	    	update_net_total_amount();
	    });

		$(document)
			.off('change' + comboEventNs, 'select#tax_type')
			.on('change' + comboEventNs, 'select#tax_type', function(){
	    	update_net_total_amount();
	    });

	    $(document)
			.off('change' + comboEventNs, 'input#selling_price')
			.on('change' + comboEventNs, 'input#selling_price', function(){
	    	var amount = __read_number($('input#selling_price'), false);
			var principal = parseFloat($('input#item_level_purchase_price_total').val());

	    	var margin = __get_rate(principal, amount);
	    	__write_number($('input#margin'), margin);

	    	var tax_rate = $('select#tax').find(':selected').data('rate');
	    	var selling_price_inc_tax = __add_percent(amount, tax_rate);
	    	__write_number($('input#selling_price_inc_tax'), selling_price_inc_tax);
	    });
		
		$(document)
			.off('change' + comboEventNs, 'input#selling_price_inc_tax')
			.on('change' + comboEventNs, 'input#selling_price_inc_tax', function(){
			var tax_rate = $('select#tax').find(':selected').data('rate');
			var selling_price_inc_tax = __read_number($('input#selling_price_inc_tax'));
	        var selling_price = __get_principle(selling_price_inc_tax, tax_rate);
	        
			__write_number($('input#selling_price'), selling_price);
			
			var principal = parseFloat($('input#item_level_purchase_price_total').val());
			var margin = __get_rate(principal, selling_price);
	    	__write_number($('input#margin'), margin);

	    });
		//Product Search Screen Functonality for Product
		$(document)
			.off('click' + comboEventNs, '#ps_select_products')
			.on('click' + comboEventNs, '#ps_select_products', function(e){
			e.preventDefault();
			if($('#products_search_results .ps-row-select:checked').length){
				$('#products_search_results .ps-row-select:checked').each(function() {
					let variation_id = $(this).val();
					let product_id = $(this).data('product-id');
					get_product_entry_row(product_id, variation_id);
				});
				$('#products_search_modal').modal('hide');
			}else if($('#products_search_results .ps-row-select:focus').length){
				let variation_id = $('#products_search_results .ps-row-select:focus').val();
				let product_id = $('#products_search_results .ps-row-select:focus').data('product-id');
				get_product_entry_row(product_id,variation_id);
				$('#products_search_modal').modal('hide');
			}else{
				toastr.error('No products selected');
			}
		});

		//PS Quick Add product
		// $(document).on('click', 'button#ps_add_new_product', function() {
		// 	$('button.pos_add_quick_product').trigger('click');
		// });

		$(document)
			.off('dblclick' + comboEventNs, '#products_search_results tbody tr')
			.on('dblclick' + comboEventNs, '#products_search_results tbody tr', function () {
			
			if($('#edit_quick_menu_item_modal').hasClass('in')){
				let sku = $(this).find('.ps-row-select').data('product-sku');
				$('#search_product_item_modal').val('');
				$('#search_product_item_modal').val(sku);
				$('#products_search_modal').modal('hide');
				setTimeout(() => {
					$('#search_product_item_modal').trigger('click');
				}, 1000);
			}else{
				let variation_id = $(this).find('.ps-row-select').val();
				let product_id = $(this).find('.ps-row-select').data('product-id');
				get_product_entry_row(product_id, variation_id);
				$('#products_search_modal').modal('hide');
			}
		});

		$(document)
			.off('keydown' + comboEventNs)
			.on('keydown' + comboEventNs, function(event) {
				if (event.key === 'F10') {
					event.preventDefault();
					if (keyBindingEnabled) {
						keyBindingEnabled = false;
						$('button#open_products_search_modal').trigger('click');
						setTimeout(() => {
							keyBindingEnabled = true;
						}, 1000);
					}
				}
			});
	});
</script>
