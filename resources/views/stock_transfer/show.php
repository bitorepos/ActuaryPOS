<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content">
		<div class="modal-header">
		    <h4 class="modal-title" id="modalTitle"> <?php echo app('translator')->get('lang_v1.stock_transfer_details'); ?> (<b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($sell_transfer->ref_no, false); ?>)
		    </h4>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
				<div class="row invoice-info">
				  <div class="col-sm-4 invoice-col">
				    <?php echo app('translator')->get('lang_v1.location_from'); ?>:
				    <address>
				      <strong><?php echo e($location_details['sell']->name, false); ?></strong>
				      
				      <?php if(!empty($location_details['sell']->landmark)): ?>
				        <br><?php echo e($location_details['sell']->landmark, false); ?>

				      <?php endif; ?>

				      <?php if(!empty($location_details['sell']->city) || !empty($location_details['sell']->state) || !empty($location_details['sell']->country)): ?>
				        <br><?php echo e(implode(',', array_filter([$location_details['sell']->city, $location_details['sell']->state, $location_details['sell']->country])), false); ?>

				      <?php endif; ?>

				      <?php if(!empty($sell_transfer->contact->tax_number)): ?>
				        <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($sell_transfer->contact->tax_number, false); ?>

				      <?php endif; ?>

				      <?php if(!empty($location_details['sell']->mobile)): ?>
				        <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($location_details['sell']->mobile, false); ?>

				      <?php endif; ?>
				      <?php if(!empty($location_details['sell']->email)): ?>
				        <br>Email: <?php echo e($location_details['sell']->email, false); ?>

				      <?php endif; ?>
				    </address>
				  </div>

				  <div class="col-md-4 invoice-col">
				    <?php echo app('translator')->get('lang_v1.location_to'); ?>:
				    <address>
				      <strong><?php echo e($location_details['purchase']->name, false); ?></strong>
				      
				      <?php if(!empty($location_details['purchase']->landmark)): ?>
				        <br><?php echo e($location_details['purchase']->landmark, false); ?>

				      <?php endif; ?>

				      <?php if(!empty($location_details['purchase']->city) || !empty($location_details['purchase']->state) || !empty($location_details['purchase']->country)): ?>
				        <br><?php echo e(implode(',', array_filter([$location_details['purchase']->city, $location_details['purchase']->state, $location_details['purchase']->country])), false); ?>

				      <?php endif; ?>

				      <?php if(!empty($sell_transfer->contact->tax_number)): ?>
				        <br><?php echo app('translator')->get('contact.tax_no'); ?>: <?php echo e($sell_transfer->contact->tax_number, false); ?>

				      <?php endif; ?>

				      <?php if(!empty($location_details['purchase']->mobile)): ?>
				        <br><?php echo app('translator')->get('contact.mobile'); ?>: <?php echo e($location_details['purchase']->mobile, false); ?>

				      <?php endif; ?>
				      <?php if(!empty($location_details['purchase']->email)): ?>
				        <br>Email: <?php echo e($location_details['purchase']->email, false); ?>

				      <?php endif; ?>
				    </address>
				  </div>

				  <div class="col-sm-4 invoice-col">
				    <b><?php echo app('translator')->get('purchase.ref_no'); ?>:</b> #<?php echo e($sell_transfer->ref_no, false); ?><br/>
				    <b><?php echo app('translator')->get('messages.date'); ?>:</b> <?php echo e(\Carbon::createFromTimestamp(strtotime($sell_transfer->transaction_date))->format(session('business.date_format')), false); ?><br/>
				    <b><?php echo app('translator')->get('sale.status'); ?>:</b> <?php echo e($statuses[$sell_transfer->status] ?? '', false); ?>

					<?php if(!empty($common_settings['enable_stock_issue_receive'])): ?>
					 	<br>
						<b><?php echo app('translator')->get('lang_v1.stock_type'); ?>:</b> <?php echo e(($sell_transfer->sub_type == 'stock_issue') ? 'Stock Issue Note' : 'Stock Receive Note', false); ?> <br/>
						<b><?php echo app('translator')->get('product.category'); ?>:</b> <?php echo e($sell_transfer->stock_category->name, false); ?> <br/>
					<?php endif; ?>
				  </div>
				</div>

				<br>
				<div class="row">
				  <div class="col-12">
					<?php
					$is_admin = auth()->user()->hasRole('Admin#'.auth()->user()->business_id);
					$hide_brand = '';
					if (empty($user_settings['stock_transfer_show_brand_column'])) {
						$hide_brand = 'hide';
					}
					if(empty(session('business.enable_brand'))){
						$hide_brand = 'hide';
					}
					$hide_category = '';
					if (empty($user_settings['stock_transfer_show_category_column'])) {
						$hide_category = 'hide';
					}
					if(empty(session('business.enable_category'))){
						$hide_category = 'hide';
					}
					$hide_price = '';
					if (empty($user_settings['stock_transfer_show_price_column']) && !$is_admin) {
						$hide_price = 'hide';
					}
					?>
				    <div class="table-responsive">
				      <table class="table bg-gray">
				        <tr class="bg-green">
				          <th>#</th>
				          <th><?php echo app('translator')->get('sale.product'); ?></th>
						  <th class="<?php echo e($hide_brand, false); ?>"><?php echo app('translator')->get('product.brand'); ?></th>
						  <th class="<?php echo e($hide_category, false); ?>"><?php echo app('translator')->get('product.category'); ?></th>
				          <th><?php echo app('translator')->get('sale.qty'); ?></th>
				          <th class="<?php echo e($hide_price, false); ?>"><?php echo app('translator')->get('sale.subtotal'); ?></th>
				        </tr>
				        <?php 
				          $total = 0.00;
				        ?>
				        <?php $__currentLoopData = $sell_transfer->sell_lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_lines): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						
				          <tr>
				            <td><?php echo e($loop->iteration, false); ?></td>
				            <td>
				              <?php echo e($sell_lines->product->name, false); ?>

				               <?php if( $sell_lines->product->type == 'variable'): ?>
				                - <?php echo e($sell_lines->variations->product_variation->name, false); ?>

				                - <?php echo e($sell_lines->variations->name, false); ?>

				               <?php endif; ?>
				               - <?php echo e($sell_lines->variations->sub_sku, false); ?>

				               <?php if($lot_n_exp_enabled && !empty($sell_lines->lot_details)): ?>
				                <br>
				                <strong><?php echo app('translator')->get('lang_v1.lot_n_expiry'); ?>:</strong> 
				                <?php if(!empty($sell_lines->lot_details->lot_number)): ?>
				                  <?php echo e($sell_lines->lot_details->lot_number, false); ?>

				                <?php endif; ?>
				                <?php if(!empty($sell_lines->lot_details->exp_date)): ?>
				                  - <?php echo e(\Carbon::createFromTimestamp(strtotime($sell_lines->lot_details->exp_date))->format(session('business.date_format')), false); ?>

				                <?php endif; ?>
				               <?php endif; ?>
							   <?php if(($sell_lines->product->rack_details)): ?>
							   <br/>
							   	<?php
									$rackDetails = json_decode($sell_lines->product->rack_details, true);
									$locationId = $location_details['sell']->id;
									$filtered = collect($rackDetails)->firstWhere('location_id', $locationId);
								?>
								<?php if( (session()->get('business.enable_racks') == 1) && ($filtered['rack'])): ?>
										- <?php echo e($filtered['rack'], false); ?>

								<?php endif; ?>
								<?php if( (session()->get('business.enable_row') == 1) && ($filtered['row'])): ?>
										- <?php echo e($filtered['row'], false); ?>

								<?php endif; ?>
								<?php if( (session()->get('business.enable_position') == 1) && ($filtered['position'])): ?>
										- <?php echo e($filtered['position'], false); ?>

								<?php endif; ?>
							   <?php endif; ?>
				            </td>
							<td class="<?php echo e($hide_brand, false); ?>"><?php echo e($sell_lines->product->brand->name, false); ?></td>
							<td class="<?php echo e($hide_category, false); ?>"><?php echo e($sell_lines->product->category->name, false); ?></td>
				            <td><?php echo e(number_format($sell_lines->quantity, session('business.quantity_precision', 2), session('currency')['decimal_separator'], session('currency')['thousand_separator']), false); ?> <?php if(!empty($sell_lines->sub_unit)): ?> <?php echo e($sell_lines->sub_unit->short_name, false); ?> <?php else: ?> <?php echo e($sell_lines->product->unit->short_name, false); ?> <?php endif; ?></td>
				            <td class="<?php echo e($hide_price, false); ?>">
				              <span class="display_currency" data-currency_symbol="true"><?php echo e($sell_lines->unit_price_inc_tax * $sell_lines->quantity, false); ?></span>
				            </td>
				          </tr>
				          <?php 
				            $total += ($sell_lines->unit_price_inc_tax * $sell_lines->quantity);
				          ?>
				        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				      </table>
				    </div>
				  </div>
				</div>
				<br>
				<div class="row">
				  
				  <div class="col-12 col-md-6 col-md-offset-6">
				    <div class="table-responsive <?php echo e((empty($user_settings['stock_transfer_show_price_column']) && !$is_admin) ? 'hide' : '', false); ?>">
				      <table class="table">
				        <tr>
				          <th><?php echo app('translator')->get('purchase.net_total_amount'); ?>: </th>
				          <td></td>
				          <td><span class="display_currency float-end" data-currency_symbol="true"><?php echo e($total, false); ?></span></td>
				        </tr>
				        <?php if( !empty( $sell_transfer->shipping_charges ) ): ?>
				          <tr>
				            <th><?php echo app('translator')->get('purchase.additional_shipping_charges'); ?>:</th>
				            <td><b>(+)</b></td>
				            <td><span class="display_currency float-end" data-currency_symbol="true"><?php echo e($sell_transfer->shipping_charges, false); ?></span></td>
				          </tr>
				        <?php endif; ?>
				        <tr>
				          <th><?php echo app('translator')->get('purchase.purchase_total'); ?>:</th>
				          <td></td>
				          <td><span class="display_currency float-end" data-currency_symbol="true" ><?php echo e($sell_transfer->final_total, false); ?></span></td>
				        </tr>
				      </table>
				    </div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-sm-6">
				    <strong><?php echo app('translator')->get('purchase.additional_notes'); ?>:</strong><br>
				    <p class="well well-sm no-shadow bg-gray">
				      <?php if($sell_transfer->additional_notes): ?>
				        <?php echo e($sell_transfer->additional_notes, false); ?>

				      <?php else: ?>
				        --
				      <?php endif; ?>
				    </p>
				  </div>
				</div>
				<div class="row">
			      <div class="col-md-12">
			            <strong><?php echo e(__('lang_v1.activities'), false); ?>:</strong><br>
			            <?php if ($__env->exists('activity_log.activities', ['activity_type' => 'sell'])) echo $__env->make('activity_log.activities', ['activity_type' => 'sell'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			        </div>
			    </div>
				<div class="row print_section">
				  <div class="col-12">
				    <img class="center-block" src="data:image/png;base64,<?php echo e(DNS1D::getBarcodePNG($sell_transfer->ref_no, 'C128', 2,30,array(39, 48, 54), true), false); ?>">
				  </div>
				</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary no-print" aria-label="Print" 
			onclick="$(this).closest('div.modal-content').printThis();"><i class="fa fa-print"></i> <?php echo app('translator')->get( 'messages.print' ); ?>
			</button>
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo app('translator')->get( 'messages.close' ); ?></button>
		</div>
	</div>
</div>
