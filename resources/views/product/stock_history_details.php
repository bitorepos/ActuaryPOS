<?php
    $can_view_purchase_price = auth()->user()->can('view_purchase_price');
    $stock_history_colspan = 8
        + (!empty($common_settings['enable_secondary_unit']) ? 2 : 0)
        + ($can_view_purchase_price ? 4 : 0)
        + (!empty($pos_settings['enable_customer_note']) ? 1 : 0);
?>
<div class="row">
    <div class="col-md-12">
        <h4><?php echo e($stock_details['variation'], false); ?></h4>
    </div>
    <div class="col-md-4 col-4 text-center">
        <strong><?php echo app('translator')->get('lang_v1.quantities_in'); ?></strong>
        <table class="table table-condensed">
            <tr>
                <th><?php echo app('translator')->get('report.total_purchase'); ?></th>
                <td>
                    <span class="display_currency" data-is_quantity="true"><?php echo e($stock_details['total_purchase'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.opening_stock'); ?></th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_opening_stock'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.total_sell_return'); ?></th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_sell_return'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php if(!empty($show_stock_transfers)): ?>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.stock_transfers'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_purchase_transfer'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($show_warehouse_data) && !empty($stock_details['total_wh_transfer_in'])): ?>
            <tr>
                <th><?php echo app('translator')->get('warehouse::lang.wh_transfer'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_wh_transfer_in'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php endif; ?>
            <?php if($show_manufacturing_data): ?>
            <tr>
                <th><?php echo app('translator')->get('manufacturing::lang.manufacturing'); ?> (<?php echo app('translator')->get('lang_v1.in'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_manufactured'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php endif; ?>
        </table>
    </div>
    <div class="col-md-4 col-4 text-center">
        <strong><?php echo app('translator')->get('lang_v1.quantities_out'); ?></strong>
        <table class="table table-condensed">
            <tr>
                <th><?php echo app('translator')->get('lang_v1.total_sold'); ?></th>
                <td>
                    <span class="display_currency" data-is_quantity="true"><?php echo e($stock_details['total_sold'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo app('translator')->get('report.total_stock_adjustment'); ?></th>
                <td>
                    <span class="display_currency" data-is_quantity="true"><?php echo e($stock_details['total_adjusted'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.total_purchase_return'); ?></th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_purchase_return'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>

            <?php if(!empty($show_stock_transfers)): ?>
            <tr>
                <th><?php echo app('translator')->get('lang_v1.stock_transfers'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_sell_transfer'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php endif; ?>
            <?php if(!empty($show_warehouse_data) && !empty($stock_details['total_wh_transfer_out'])): ?>
            <tr>
                <th><?php echo app('translator')->get('warehouse::lang.wh_transfer'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_wh_transfer_out'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php endif; ?>
            <?php if($show_manufacturing_data): ?>
            <tr>
                <th><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> (<?php echo app('translator')->get('lang_v1.out'); ?>)</th>
                <td>
                    <span class="display_currency"
                        data-is_quantity="true"><?php echo e($stock_details['total_ingredient'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="col-md-4 col-4 text-center">
        <strong><?php echo app('translator')->get('lang_v1.totals'); ?></strong>
        <table class="table table-condensed">
            <tr>
                <th><?php echo app('translator')->get('report.current_stock'); ?></th>
                <td>
                    <span class="display_currency" data-is_quantity="true"><?php echo e($stock_details['current_stock'], false); ?></span>
                    <?php echo e($stock_details['unit'], false); ?>

                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-12 col-12">
        <button class="btn btn-sm btn-primary toggle_ingrdient_summary" type="button" data-bs-toggle="collapse" data-bs-target="#ingrdient_summary_table" aria-expanded="false" aria-controls="ingrdient_summary_table">
            <span class="fa fas fa-plus-circle"></span>
        </button>
        <strong><?php echo app('translator')->get('manufacturing::lang.ingredients'); ?> <?php echo app('translator')->get('lang_v1.summary'); ?> </strong> 
        <div class="collapse" id="ingrdient_summary_table">
            <table class="table table-condensed">
                <tr>
                    <th><?php echo app('translator')->get('lang_v1.type'); ?></th>
                    <th><?php echo app('translator')->get('product.sku'); ?></th>
                    <th><?php echo app('translator')->get('product.product_name'); ?></th>
                    <th><?php echo app('translator')->get('sale.qty'); ?></th>
                </tr>
                <?php
                    $ingredients = [];
                    foreach($stock_history as $history){
                        if($history['type_label'] == 'Ingredient'){
                            if(array_key_exists($history['mfg_product_sku'], $ingredients)){
                                $ingredients[$history['mfg_product_sku']]['qty'] += abs($history['quantity_change']);
                            }else{
                                $ingredients[$history['mfg_product_sku']] = [
                                    'name' => $history['mfg_product'],
                                    'type' => 'Production',
                                    'qty' => abs($history['quantity_change']),
                                ];
                            }
                        }

                        if(!empty($history['combo_product_type'])){
                            if(array_key_exists($history['combo_product_sku'], $ingredients)){
                                $ingredients[$history['combo_product_sku']]['qty'] += abs($history['quantity_change']);
                            }else{
                                $ingredients[$history['combo_product_sku']] = [
                                    'name' => $history['combo_product'],
                                    'type' => $history['combo_product_type'],
                                    'qty' => abs($history['quantity_change']),
                                ];
                            }
                        }

                        if(!empty($history['combo_item_type'])){
                            if(array_key_exists($history['combo_item_sku'], $ingredients)){
                                $ingredients[$history['combo_item_sku']]['qty'] += $history['combo_item_qty'];
                            }else{
                                $ingredients[$history['combo_item_sku']] = [
                                    'name' => $history['combo_item'],
                                    'type' => $history['combo_item_type'],
                                    'qty' => $history['combo_item_qty'],
                                ];
                            }
                        }
                        
                    }
                ?>
                <?php $__currentLoopData = $ingredients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(ucwords($value['type']), false); ?></td>
                    <td><?php echo e($key, false); ?></td>
                    <td><?php echo e($value['name'], false); ?></td>
                    <td><span class="display_currency" data-is_quantity="true"><?php echo e($value['qty'], false); ?></span></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <hr>
        <div class="table-responsive">
<table class="table table-slim table-bordered table-striped table-th-skin" id="stock_history_table">
            <thead>
                <tr>
                    <th><?php echo app('translator')->get('lang_v1.date'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.type'); ?></th>
                    <th><?php echo app('translator')->get('purchase.ref_no'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.quantity_change'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.new_quantity'); ?></th>
                    <?php if(!empty($common_settings['enable_secondary_unit'])): ?>
                        <th><?php echo app('translator')->get('lang_v1.quantity_change'); ?> (<?php echo app('translator')->get('lang_v1.secondary_unit'); ?>)</th>
                    <?php endif; ?>
                    <?php if(!empty($common_settings['enable_secondary_unit'])): ?>
                        <th><?php echo app('translator')->get('lang_v1.new_quantity'); ?> (<?php echo app('translator')->get('lang_v1.secondary_unit'); ?>)</th>
                    <?php endif; ?>
                    <?php if($can_view_purchase_price): ?>
                    <th><?php echo app('translator')->get('purchase.cost_price'); ?></th>
                    <th><?php echo app('translator')->get('purchase.cost_total'); ?></th>
                    <?php endif; ?>
                    <th><?php echo app('translator')->get('sale.sell_price'); ?></th>
                    <th><?php echo app('translator')->get('sale.sell_total'); ?></th>
                    <?php if($can_view_purchase_price): ?>
                    <th><?php echo app('translator')->get('lang_v1.profit'); ?></th>
                    <th><?php echo app('translator')->get('lang_v1.total_profit'); ?> <?php
                if(session('business.enable_tooltip')){
                    echo '<i class="fa fa-info-circle text-info hover-q no-print"
                    aria-hidden="true"
                    data-bs-toggle="tooltip"
                    data-bs-placement="bottom"
                    data-bs-html="true"
                    title="' . 'Running realized sale profit. Sales add profit and sale returns reduce profit. Purchase, Opening Stock, Stock Adjustment, and Stock Transfer rows are not included.' . '"></i>';
                }
            ?></th>
                    <?php endif; ?>
                    
                    <th><?php echo app('translator')->get('lang_v1.customer_supplier_info'); ?></th>
                    <?php if(!empty($pos_settings['enable_customer_note'])): ?>
                    <th><?php echo app('translator')->get('restaurant.customer_note'); ?></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $stock_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr data-history-type-label="<?php echo e(e($history['type_label']), false); ?>">
                    <td style="white-space: nowrap;"><?php if(!empty($history['date'])): ?><?php
                        $__tf = session('business.time_format') == 24 ? 'H:i' : 'h:i A';
                        $__df = session('business.date_format') ?: 'm/d/Y';
                        try { $__dt = \Carbon\Carbon::parse($history['date']); } catch(\Exception $e) { $__dt = null; }
                    ?><?php if($__dt): ?><?php echo e($__dt->format($__df), false); ?><br><?php echo e($__dt->format($__tf), false); ?><?php else: ?><?php echo e($history['date'], false); ?><?php endif; ?> <?php endif; ?></td>

                    <td><?php echo e($history['type_label'], false); ?></td>
                    <td class="text-center">

                        <?php if($history['type_label'] == 'Sales'): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\SellController::class, 'show'], [$history['transaction_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php echo e($history['ref_no'], false); ?>

							</a>

						<?php elseif($history['type_label'] == 'Sale Return'): ?>
							<?php if(!empty($history['return_parent_id'])): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'show'], [$history['return_parent_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php else: ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\SellReturnController::class, 'show'], [$history['transaction_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php endif; ?>
								<?php echo e($history['ref_no'], false); ?>

							</a>
						<?php elseif($history['type_label'] == 'Purchase'): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseController::class, 'show'], [$history['transaction_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php echo e($history['ref_no'], false); ?>

							</a>
						<?php elseif($history['type_label'] == 'Purchase Return'): ?>
							<?php if(!empty($history['return_parent_id'])): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseReturnController::class, 'show'], [$history['return_parent_id']]), false); ?>" 
								href="#" data-container=".view_modal" class="btn-modal">
							<?php else: ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\PurchaseReturnController::class, 'show'], [$history['transaction_id']]), false); ?>" 
							href="#" data-container=".view_modal" class="btn-modal">
							<?php endif; ?>
							<?php echo e($history['ref_no'], false); ?>

							</a>
                        <?php elseif($history['type_label'] == 'Stock Adjustment'): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\StockAdjustmentController::class, 'show'], [$history['transaction_id']]), false); ?>" 
							href="#" data-container=".view_modal" class="btn-modal">
							<?php echo e($history['ref_no'], false); ?>

							</a>
                        <?php elseif($history['type_label'] == 'Stock Transfers (Out)' || $history['type_label'] == 'Stock Transfers (In)'): ?>
							<a data-href="<?php echo e(action([\App\Http\Controllers\StockTransferController::class, 'show'], [$history['transaction_id']]), false); ?>" 
							href="#" data-container=".view_modal" class="btn-modal">
							<?php echo e($history['ref_no'], false); ?>

							</a>
                        <?php elseif($history['type'] == 'wh_transfer_out' || $history['type'] == 'wh_transfer_in'): ?>
							<a href="<?php echo e(action([\Modules\Warehouse\Http\Controllers\StockTransferController::class, 'show'], [$history['transaction_id']]), false); ?>" target="_blank">
							<?php echo e($history['ref_no'], false); ?>

							</a>
                        <?php elseif($history['type_label'] == 'Manufactured'): ?>
							<a data-href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'show'], [$history['transaction_id']]), false); ?>" 
							href="#" data-container=".view_modal" class="btn-modal">
							<?php echo e($history['ref_no'], false); ?>

							</a>
						<?php elseif($history['type_label'] == 'Ingredient'): ?>
							<a data-href="<?php echo e(action([\Modules\Manufacturing\Http\Controllers\ProductionController::class, 'show'], [$history['transaction_id']-1]), false); ?>" 
							href="#" data-container=".view_modal" class="btn-modal">
							<?php echo e($history['ref_no'], false); ?>

							</a>
						<?php else: ?>
							<?php echo e($history['ref_no'], false); ?>

						<?php endif; ?>

                        <?php if(!empty($history['additional_notes'])): ?>
                        <?php if(!empty($history['ref_no'])): ?>
                        <br>
                        <?php endif; ?>
                        <?php echo e($history['additional_notes'], false); ?>


                        <?php endif; ?>
                    </td>
                    <?php if($history['quantity_change'] > 0 ): ?>
                    <td class="text-success text-right"> +<span class="display_currency"
                            data-is_quantity="true"><?php echo e($history['quantity_change'], false); ?></span>
                    </td>
                    <?php else: ?>
                    <td class="text-danger text-right"><span class="display_currency text-danger"
                            data-is_quantity="true"><?php echo e($history['quantity_change'], false); ?></span>
                    </td>
                    <?php endif; ?>
                    <td class="text-right <?php if($history['stock'] < 0): ?> text-danger <?php endif; ?>">
                        <span class="display_currency <?php if($history['stock'] < 0): ?> text-danger <?php endif; ?>" data-is_quantity="true"><?php echo e($history['stock'], false); ?></span>
                    </td>
                    <?php if(!empty($common_settings['enable_secondary_unit'])): ?>
                        <?php if($history['quantity_change'] > 0 ): ?>
                            <td class="text-success text-right">
                                <?php if(!empty($history['purchase_secondary_unit_quantity'])): ?>
                                +<span class="display_currency"
                                    data-is_quantity="true"><?php echo e($history['purchase_secondary_unit_quantity'], false); ?></span>
                                <?php echo e($stock_details['second_unit'], false); ?>

                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td class="text-danger text-right">
                                <?php if(!empty($history['sell_secondary_unit_quantity'])): ?>
                                -<span class="display_currency"
                                    data-is_quantity="true"><?php echo e($history['sell_secondary_unit_quantity'], false); ?></span>
                                <?php echo e($stock_details['second_unit'], false); ?>

                                <?php endif; ?>
                            </td>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                    <?php if(!empty($common_settings['enable_secondary_unit'])): ?>
                    <td>
                        <?php if(!empty($stock_details['second_unit'])): ?>
                        <span class="display_currency"
                            data-is_quantity="true"><?php echo e($history['stock_in_second_unit'], false); ?></span>
                        <?php echo e($stock_details['second_unit'], false); ?>

                        <?php endif; ?>
                    </td>
                    <?php endif; ?>
                    <?php if($can_view_purchase_price): ?>
                    <td class="text-right"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $history['cost_price'], session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
                    <td class="text-right"><?php 
            $formated_number = ""; 
            $formated_number .= number_format((float) $history['cost_total'], session("business.cost_decimal", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);
            echo $formated_number; ?></td>
                    <?php endif; ?>
                    <td class="text-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $history['sell_price'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                    <td class="text-right"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $history['sell_total'], session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                    <?php if($can_view_purchase_price): ?>
                    <?php
                        $__profit = $history['profit'] ?? 0;
                        $__total_profit = $history['total_profit'] ?? 0;
                        $__profit_class = $__profit > 0 ? 'text-success' : ($__profit < 0 ? 'text-danger' : '');
                        $__total_profit_class = $__total_profit > 0 ? 'text-success' : ($__total_profit < 0 ? 'text-danger' : '');
                    ?>
                    <td class="text-right <?php echo e($__profit_class, false); ?>"><?php if(!is_null($history['profit'] ?? null)): ?> <?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $__profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?> <?php endif; ?></td>
                    <td class="text-right <?php echo e($__total_profit_class, false); ?>"><?php 
            $formated_number = "";
            /* if (session("business.currency_symbol_placement") == "before") {
                 $formated_number .= session("currency")["symbol"] . " ";
            }*/ 
            $formated_number .= number_format((float) $__total_profit, session("business.currency_precision", 2) , session("currency")["decimal_separator"], session("currency")["thousand_separator"]);

            /* if (session("business.currency_symbol_placement") == "after") {
                 $formated_number .= " " . session("currency")["symbol"];
            } */
            echo $formated_number; ?></td>
                    <?php endif; ?>
                    
                    
                    <td>
                        <?php echo e($history['contact_name'] ?? '--', false); ?>

                        <?php if(!empty($history['supplier_business_name'])): ?>
                        - <?php echo e($history['supplier_business_name'], false); ?>

                        <?php endif; ?>
                        <?php if(!empty($history['mfg_product'])): ?>
                            <?php echo e($history['mfg_product_sku'] . ' - ' . $history['mfg_product'], false); ?>

                        <?php endif; ?>
                        <?php if($history['type'] == 'sell_transfer'): ?>
                            To <?php echo e($history['transfer_to_location'], false); ?>

                        <?php endif; ?>
                        <?php if($history['type'] == 'purchase_transfer'): ?>
                            From <?php echo e($history['transfer_from_location'], false); ?>

                        <?php endif; ?>
                        <?php if($history['type'] == 'wh_transfer_out'): ?>
                            <i class="fas fa-warehouse"></i> To <?php echo e($history['wh_transfer_location'] ?? '', false); ?>

                        <?php endif; ?>
                        <?php if($history['type'] == 'wh_transfer_in'): ?>
                            <i class="fas fa-warehouse"></i> From <?php echo e($history['wh_transfer_location'] ?? '', false); ?>

                        <?php endif; ?>
                    </td>
                    <?php if(!empty($pos_settings['enable_customer_note'])): ?>
                    <td><?php echo e($history['customer_note'] ?? '', false); ?></td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="<?php echo e($stock_history_colspan, false); ?>" class="text-center">
                        <?php echo app('translator')->get('lang_v1.no_stock_history_found'); ?>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
</div>
    </div>
</div>
