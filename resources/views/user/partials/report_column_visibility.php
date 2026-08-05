
<?php
$us = $user->user_settings ?? [];
$reportVisibilityLocations = $report_visibility_locations ?? [];
if ($reportVisibilityLocations instanceof \Illuminate\Support\Collection) {
    $reportVisibilityLocations = $reportVisibilityLocations->toArray();
}

$reportColumnConfig = [
    'admin' => [
        'label' => 'Admin Reports',
        'icon' => 'fas fa-user-shield',
        'reports' => [
            'pl' => [
                'label' => 'Profit / Loss Report',
                'columns' => [
                    'opening_stock_purchase' => 'Opening Stock (Purchase Price)',
                    'opening_stock_sale' => 'Opening Stock (Sale Price)',
                    'total_purchase' => 'Total Purchase (Exc Tax, Discount)',
                    'closing_stock_purchase' => 'Closing Stock (Purchase Price)',
                    'closing_stock_sale' => 'Closing Stock (Sale Price)',
                    'total_cost_of_sales' => 'Total Cost of Sales',
                    'purchase_shipping' => 'Total Purchase Shipping Charge',
                    'purchase_additional_expense' => 'Purchase Additional Expense',
                    'sell_return' => 'Total Sell Return',
                    'sell_discount' => 'Total Sell Discount',
                    'sell_discount2' => 'Total Sell Discount 2',
                    'ledger_discount_purchase' => 'Total Ledger Discount Purchase',
                    'ledger_discount2_supplier' => 'Total Ledger Discount 2 Supplier',
                    'reward_amount' => 'Total Reward Amount',
                    'stock_adjustment' => 'Total Stock Adjustment',
                    'transfer_shipping' => 'Total Transfer Shipping Charge',
                    'total_expense' => 'Total Expense',
                    'total_sell' => 'Total Sell',
                    'sell_shipping' => 'Total Sell Shipping Charge',
                    'sell_additional_expense' => 'Sell Additional Expense',
                    'purchase_return' => 'Total Purchase Return',
                    'purchase_discount' => 'Total Purchase Discount',
                    'purchase_discount2' => 'Total Purchase Discount 2',
                    'ledger_discount_sell' => 'Total Ledger Discount Sell',
                    'ledger_discount2_customer' => 'Total Ledger Discount 2 Customer',
                    'sell_round_off' => 'Total Sell Round Off',
                    'type_of_services' => 'Total Type of Services',
                    'stock_recovered' => 'Total Stock Recovered',
                ],
            ],
            'ps' => [
                'label' => 'Purchase & Sale',
                'columns' => [
                    'purchase_exc_tax' => 'Purchase (Exc Tax)',
                    'purchase_inc_tax' => 'Purchase (Inc Tax)',
                    'purchase_return_inc_tax' => 'Total Purchase Return (Inc Tax)',
                    'purchase_due' => 'Purchase Due',
                    'total_sell' => 'Total Sell',
                    'sell_inc_tax' => 'Sell (Inc Tax)',
                    'sell_return_inc_tax' => 'Total Sell Return (Inc Tax)',
                    'sell_due' => 'Sell Due',
                ],
            ],
            'tax' => [
                'label' => 'Tax Report',
                'columns' => [
                    'input_date' => 'Input Tax – Date',
                    'input_ref_no' => 'Input Tax – Ref No',
                    'input_supplier' => 'Input Tax – Supplier',
                    'input_tax_no' => 'Input Tax – Tax No',
                    'input_total_amount' => 'Input Tax – Total Amount',
                    'input_payment_method' => 'Input Tax – Payment Method',
                    'input_discount' => 'Input Tax – Discount',
                    'output_date' => 'Output Tax – Date',
                    'output_invoice_no' => 'Output Tax – Invoice No',
                    'output_customer' => 'Output Tax – Customer',
                    'output_tax_no' => 'Output Tax – Tax No',
                    'output_total_amount' => 'Output Tax – Total Amount',
                    'output_payment_method' => 'Output Tax – Payment Method',
                    'output_discount' => 'Output Tax – Discount',
                    'expense_date' => 'Expense Tax – Date',
                    'expense_ref_no' => 'Expense Tax – Ref No',
                    'expense_tax_no' => 'Expense Tax – Tax No',
                    'expense_total_amount' => 'Expense Tax – Total Amount',
                    'expense_payment_method' => 'Expense Tax – Payment Method',
                ],
            ],
            'exp' => [
                'label' => 'Expense Report',
                'columns' => [
                    'expense_categories' => 'Expense Categories',
                    'total_expense' => 'Total Expense',
                ],
            ],
            'actlog' => [
                'label' => 'Activity Log',
                'columns' => [
                    'date' => 'Date',
                    'subject_type' => 'Subject Type',
                    'action' => 'Action',
                    'user_by' => 'User By',
                    'note' => 'Note',
                ],
            ],
            'dcsval' => [
                'label' => 'Daily Closing Report - Stock Value Report (Detailed)',
                'location_based' => true,
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'unit' => 'Unit',
                    'variation' => 'Variation',
                    'location' => 'Location',
                    'opening_stock' => 'Opening Stock',
                    'opening_stock_value' => 'Opening Stock Value',
                    'purchase' => 'Purchase',
                    'purchase_value' => 'Purchase Value',
                    'purchase_return' => 'Purchase Return',
                    'purchase_return_value' => 'Purchase Return Value',
                    'manufacturing' => 'Manufacturing (In)',
                    'manufacturing_value' => 'Manufacturing Value',
                    'ingredient' => 'Ingredients (Out)',
                    'ingredient_value' => 'Ingredient Value',
                    'stock_transfer' => 'Stock Transfer',
                    'stock_transfer_value' => 'Stock Transfer Value',
                    'stock_adjustment' => 'Stock Adjustment',
                    'stock_adjustment_value' => 'Stock Adjustment Value',
                    'sale' => 'Sale',
                    'sale_value' => 'Sale Value',
                    'sale_return' => 'Sale Return',
                    'sale_return_value' => 'Sale Return Value',
                    'current_stock' => 'Current Stock',
                    'total_stock_price' => 'Total Stock Price',
                ],
            ],
        ],
    ],
    'pos' => [
        'label' => 'POS Reports',
        'icon' => 'fas fa-cash-register',
        'reports' => [
            'reg' => [
                'label' => 'Register Report',
                'columns' => [
                    'ref_no' => 'Ref No',
                    'open_time' => 'Open Time',
                    'close_time' => 'Close Time',
                    'location' => 'Location',
                    'user' => 'User',
                    'total_card_slips' => 'Total Card Slips',
                    'total_cheques' => 'Total Cheques',
                    'total_cash' => 'Total Cash',
                    'total_bank_transfer' => 'Total Bank Transfer',
                    'total_advance_payment' => 'Total Advance Payment',
                    'other_payments' => 'Other Payments',
                    'total' => 'Total',
                ],
            ],
            'tbl' => [
                'label' => 'Table Report',
                'columns' => [
                    'table' => 'Table',
                    'total_sell' => 'Total Sell',
                ],
            ],
            'sstaff' => [
                'label' => 'Service Staff Report',
                'columns' => [
                    'date' => 'Date',
                    'invoice_no' => 'Invoice No',
                    'service_staff' => 'Service Staff',
                    'location' => 'Location',
                    'subtotal' => 'Subtotal',
                    'total_discount' => 'Total Discount',
                    'total_tax' => 'Total Tax',
                    'total_amount' => 'Total Amount',
                ],
            ],
        ],
    ],
    'sales' => [
        'label' => 'Sales Reports',
        'icon' => 'fas fa-chart-line',
        'reports' => [
            'sale' => [
                'label' => 'Sale Report',
                'columns' => [
                    'contact_id' => 'Contact ID',
                    'customer_name' => 'Customer Name',
                    'invoice_no' => 'Invoice No',
                    'date' => 'Date',
                    'total_exc_tax' => 'Total (Exc Tax)',
                    'discount' => 'Discount',
                    'tax' => 'Tax',
                    'total_inc_tax' => 'Total (Inc Tax)',
                    'payment_method' => 'Payment Method',
                ],
            ],
            'sinv' => [
                'label' => 'Sale Invoices Report',
                'columns' => [
                    'date' => 'Date',
                    'invoice_qty' => 'Invoice Quantity',
                    'avg_invoice' => 'Average Invoice',
                    'item_qty' => 'Item Quantity',
                    'scheme_qty' => 'Scheme Qty',
                    'total' => 'Total',
                    'paid' => 'Paid',
                    'due' => 'Due',
                ],
            ],
            'psell' => [
                'label' => 'Product Sell Report',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'qty' => 'Qty',
                    'avg_product' => 'Average Product',
                    'scheme_qty' => 'Scheme Qty',
                    'total' => 'Total',
                    'total_purchase' => 'Total Purchase',
                    'profit' => 'Profit',
                    'gross_profit' => 'Gross Profit',
                ],
            ],
            'pserial' => [
                'label' => 'Product Serial Report',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'brand_name' => 'Brand Name',
                    'contact_id' => 'Contact ID',
                    'contact' => 'Contact',
                    'supplier_name' => 'Supplier Name',
                    'type' => 'Type',
                    'invoice_no' => 'Invoice No',
                    'date' => 'Date',
                    'qty' => 'Qty',
                    'scheme_qty' => 'Scheme Qty',
                    'sr_imei_no' => 'SR/IMEI No',
                    'unit_price' => 'Unit Price',
                    'subtotal' => 'Subtotal',
                    'discount' => 'Discount',
                    'discount_pct' => 'Discount %',
                    'tax' => 'Tax',
                    'price_inc_tax' => 'Price Inc Tax',
                    'total' => 'Total',
                    'days' => 'Days',
                ],
            ],
            'pstatus' => [
                'label' => 'Product Status Report',
                'columns' => [
                    'status' => 'Status',
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'customer_name' => 'Customer Name',
                    'contact_id' => 'Contact ID',
                    'invoice_no' => 'Invoice No',
                    'date' => 'Date',
                    'qty' => 'Qty',
                    'unit_price' => 'Unit Price',
                    'subtotal' => 'Subtotal',
                    'discount' => 'Discount',
                    'tax' => 'Tax',
                    'price_inc_tax' => 'Price Inc Tax',
                    'total' => 'Total',
                ],
            ],
            'spay' => [
                'label' => 'Sell Payment Report',
                'columns' => [
                    'payment_no' => 'Payment No',
                    'payment_location' => 'Payment Location',
                    'paid_on' => 'Paid On',
                    'amount' => 'Amount',
                    'payment_method' => 'Payment Method',
                    'sale_no' => 'Sale No',
                    'sale_date' => 'Sale Date',
                    'transaction_location' => 'Transaction Location',
                    'customer' => 'Customer',
                    'customer_group' => 'Customer Group',
                    'payment_note' => 'Payment Note',
                ],
            ],
            'precov' => [
                'label' => 'Payment Recovery Report',
                'columns' => [
                    'payment_no' => 'Payment No',
                    'payment_location' => 'Payment Location',
                    'paid_on' => 'Paid On',
                    'amount' => 'Amount',
                    'payment_method' => 'Payment Method',
                    'sale_no' => 'Sale No',
                    'sale_date' => 'Sale Date',
                    'transaction_location' => 'Transaction Location',
                    'customer' => 'Customer',
                    'customer_group' => 'Customer Group',
                    'added_by' => 'Added By',
                    'payment_note' => 'Payment Note',
                ],
            ],
            'srep' => [
                'label' => 'Sales Representative Report',
                'columns' => [
                    'date' => 'Date',
                    'invoice_no' => 'Invoice No',
                    'customer_name' => 'Customer Name',
                    'location' => 'Location',
                    'payment_status' => 'Payment Status',
                    'total_amount' => 'Total Amount',
                    'total_paid' => 'Total Paid',
                    'total_remaining' => 'Total Remaining',
                ],
            ],
            'gstsale' => [
                'label' => 'GST Sales Report',
                'columns' => [
                    'invoice_no' => 'Invoice No',
                    'customer_name' => 'Customer Name',
                    'tax_no' => 'Tax No',
                    'invoice_date' => 'Invoice Date',
                    'hsn_code' => 'HSN Code',
                    'gst_pct' => 'GST%',
                    'qty' => 'Qty',
                    'unit_price' => 'Unit Price',
                    'discount' => 'Discount',
                    'taxable_value' => 'Taxable Value',
                    'total' => 'Total',
                ],
            ],
            'cgrp' => [
                'label' => 'Customer Group Report',
                'columns' => [
                    'customer_group' => 'Customer Group',
                    'total_sell' => 'Total Sell',
                ],
            ],
            'chqclr' => [
                'label' => 'Cheque Clearance Report',
                'columns' => [
                    'payment_no' => 'Payment No',
                    'issue_date' => 'Issue Date',
                    'contact_id' => 'Contact ID',
                    'contact_name' => 'Contact Name',
                    'transaction' => 'Transaction',
                    'bank_name' => 'Bank Name',
                    'cheque_no' => 'Cheque No',
                    'amount' => 'Amount',
                    'location' => 'Location',
                    'clearance_date' => 'Clearance Date',
                    'status' => 'Status',
                    'cleared_date' => 'Cleared Date',
                ],
            ],
        ],
    ],
    'stock' => [
        'label' => 'Stock Reports',
        'icon' => 'fas fa-warehouse',
        'reports' => [
            'stock' => [
                'label' => 'Stock Quantity Report (Details)',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'variation' => 'Variation',
                    'category' => 'Category',
                    'sub_category' => 'Sub Category',
                    'sub2_category' => 'Sub2 Category',
                    'brand' => 'Brand',
                    'sub_brand' => 'Sub Brand',
                    'gender' => 'Gender',
                    'sub_gender' => 'Sub Gender',
                    'procurement_source' => 'Procurement Source',
                    'sub_procurement_source' => 'Sub Procurement Source',
                    'location' => 'Location',
                    'unit_cost_price' => 'Unit Cost Price',
                    'unit_selling_price' => 'Unit Selling Price',
                    'current_stock' => 'Current Stock',
                    'total_stock_purchase' => 'Total Stock Price (Purchase)',
                    'total_stock_sale' => 'Total Stock Price (Sale)',
                    'potential_profit' => 'Potential Profit',
                    'total_unit_sold' => 'Total Unit Sold',
                    'total_unit_transferred' => 'Total Unit Transferred',
                    'total_unit_adjusted' => 'Total Unit Adjusted',
                    'rack_details' => 'Rack Details',
                    'current_stock_mfg' => 'Current Stock (Mfg)',
                ],
            ],
            'stockcat' => [
                'label' => 'Stock Quantity Report (Categorized)',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'variation' => 'Variation',
                    'rack_details' => 'Rack Details',
                    'brand' => 'Brand',
                    'location' => 'Location',
                    'unit' => 'Unit',
                    'quantity' => 'Quantity',
                    'unit_selling_price' => 'Unit Selling Price',
                    'total_selling_value' => 'Total Selling Value',
                    'unit_purchase_price' => 'Unit Purchase Price',
                    'total_cost_value' => 'Total Cost Value',
                ],
            ],
            'sval' => [
                'label' => 'Stock Value Report (Details)',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'unit' => 'Unit',
                    'variation' => 'Variation',
                    'location' => 'Location',
                    'opening_stock' => 'Opening Stock',
                    'opening_stock_value' => 'Opening Stock Value',
                    'purchase' => 'Purchase',
                    'purchase_value' => 'Purchase Value',
                    'purchase_return' => 'Purchase Return',
                    'purchase_return_value' => 'Purchase Return Value',
                    'stock_transfer' => 'Stock Transfer',
                    'stock_transfer_value' => 'Stock Transfer Value',
                    'stock_adjustment' => 'Stock Adjustment',
                    'stock_adjustment_value' => 'Stock Adjustment Value',
                    'sale' => 'Sale',
                    'sale_value' => 'Sale Value',
                    'sale_return' => 'Sale Return',
                    'sale_return_value' => 'Sale Return Value',
                    'current_stock' => 'Current Stock',
                    'total_stock_price' => 'Total Stock Price',
                ],
            ],
            'svalcat' => [
                'label' => 'Stock Value Report (Categorized)',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'unit' => 'Unit',
                    'variation' => 'Variation',
                    'location' => 'Location',
                    'opening_stock' => 'Opening Stock',
                    'opening_stock_value' => 'Opening Stock Value',
                    'purchase' => 'Purchase',
                    'purchase_value' => 'Purchase Value',
                    'purchase_return' => 'Purchase Return',
                    'purchase_return_value' => 'Purchase Return Value',
                    'stock_transfer' => 'Stock Transfer',
                    'stock_transfer_value' => 'Stock Transfer Value',
                    'stock_adjustment' => 'Stock Adjustment',
                    'stock_adjustment_value' => 'Stock Adjustment Value',
                    'sale' => 'Sale',
                    'sale_value' => 'Sale Value',
                    'sale_return' => 'Sale Return',
                    'sale_return_value' => 'Sale Return Value',
                    'current_stock' => 'Current Stock',
                    'total_stock_price' => 'Total Stock Price',
                ],
            ],
            'sreorder' => [
                'label' => 'Stock Reorder Report',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'variation' => 'Variation',
                    'category' => 'Category',
                    'location' => 'Location',
                    'current_stock' => 'Current Stock',
                    'alert_qty_low' => 'Alert Qty Low',
                    'alert_qty_medium' => 'Alert Qty Medium',
                    'alert_qty_high' => 'Alert Qty High',
                    'alert_qty_max' => 'Alert Qty Max',
                    'total_stock_purchase' => 'Total Stock Price (Purchase)',
                    'total_stock_sale' => 'Total Stock Price (Sale)',
                    'potential_profit' => 'Potential Profit',
                ],
            ],
            'sadj' => [
                'label' => 'Stock Adjustment Report',
                'columns' => [
                    'date' => 'Date',
                    'ref_no' => 'Ref No',
                    'location' => 'Location',
                    'adjustment_type' => 'Adjustment Type',
                    'total_amount' => 'Total Amount',
                    'total_recovered' => 'Total Amount Recovered',
                    'reason' => 'Reason',
                    'added_by' => 'Added By',
                ],
            ],
            'sexp' => [
                'label' => 'Stock Expiry Report',
                'columns' => [
                    'product' => 'Product',
                    'sku' => 'SKU',
                    'location' => 'Location',
                    'stock_left' => 'Stock Left',
                    'lot_number' => 'Lot Number',
                    'exp_date' => 'Exp Date',
                    'mfg_date' => 'Mfg Date',
                ],
            ],
            'stake' => [
                'label' => 'Stock Take Report',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'variation' => 'Variation',
                    'rack_details' => 'Rack Details',
                    'on_hand' => 'On Hand',
                    'actual_counted' => 'Actual Counted',
                ],
            ],
            'sdetail' => [
                'label' => 'Stock Details',
                'columns' => [
                    'sku' => 'SKU',
                    'variation' => 'Variation',
                    'unit_price' => 'Unit Price',
                    'current_stock' => 'Current Stock',
                    'total_unit_sold' => 'Total Unit Sold',
                    'total_unit_transferred' => 'Total Unit Transferred',
                    'total_unit_adjusted' => 'Total Unit Adjusted',
                ],
            ],
            'ostock' => [
                'label' => 'Opening Stock Report',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'qty' => 'Qty',
                    'qty_left' => 'Quantity Left',
                    'unit_price' => 'Unit Price',
                    'subtotal' => 'Subtotal',
                    'date' => 'Date',
                    'note' => 'Note',
                    'location' => 'Location',
                ],
            ],
            'lot' => [
                'label' => 'Lot Report',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'lot_number' => 'Lot Number',
                    'exp_date' => 'Exp Date',
                    'current_stock' => 'Current Stock',
                    'total_unit_sold' => 'Total Unit Sold',
                    'total_unit_adjusted' => 'Total Unit Adjusted',
                ],
            ],
            'strans' => [
                'label' => 'Stock Transfer Report',
                'columns' => [
                    'date' => 'Date',
                    'ref_no' => 'Ref No',
                    'location_from' => 'Location From',
                    'location_to' => 'Location To',
                    'status' => 'Status',
                    'shipping_charges' => 'Shipping Charges',
                    'total_amount' => 'Total Amount',
                    'additional_notes' => 'Additional Notes',
                ],
            ],
            'scons' => [
                'label' => 'Stock Consumption Report',
                'columns' => [
                    'code' => 'Code',
                    'category' => 'Category',
                    'total_sale_exc_tax' => 'Total Sale (Exc Tax)',
                    'sys_consumption_qty' => 'System Consumption Qty',
                    'sys_consumption_cost' => 'System Consumption Cost',
                    'sys_consumption_profit' => 'System Consumption Profit',
                    'actual_consumption_qty' => 'Actual Consumption Qty',
                    'actual_consumption_cost' => 'Actual Consumption Cost',
                    'actual_consumption_profit' => 'Actual Consumption Profit',
                    'difference_qty' => 'Difference Qty',
                    'difference_pct' => 'Difference Percentage',
                ],
            ],
        ],
    ],
    'purch' => [
        'label' => 'Purchase Reports',
        'icon' => 'fas fa-shopping-cart',
        'reports' => [
            'purch' => [
                'label' => 'Purchase Report',
                'columns' => [
                    'contact_id' => 'Contact ID',
                    'supplier' => 'Supplier',
                    'ref_no' => 'Ref No',
                    'purchase_date_ym' => 'Purchase Date (Year/Month)',
                    'purchase_date_d' => 'Purchase Date (Day)',
                    'payment_date_ym' => 'Payment Date (Year/Month)',
                    'payment_date_d' => 'Payment Date (Day)',
                    'total_exc_tax' => 'Total (Exc Tax)',
                    'discount' => 'Discount',
                    'tax' => 'Tax',
                    'total_inc_tax' => 'Total (Inc Tax)',
                    'payment_method' => 'Payment Method',
                ],
            ],
            'ppurch' => [
                'label' => 'Product Purchase Report',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'supplier' => 'Supplier',
                    'ref_no' => 'Ref No',
                    'date' => 'Date',
                    'qty' => 'Qty',
                    'total_unit_adjusted' => 'Total Unit Adjusted',
                    'unit_purchase_price' => 'Unit Purchase Price',
                    'subtotal' => 'Subtotal',
                ],
            ],
            'ppay' => [
                'label' => 'Purchase Payment Report',
                'columns' => [
                    'payment_no' => 'Payment No',
                    'payment_location' => 'Payment Location',
                    'paid_on' => 'Paid On',
                    'amount' => 'Amount',
                    'payment_method' => 'Payment Method',
                    'purchase_no' => 'Purchase No',
                    'purchase_date' => 'Purchase Date',
                    'supplier' => 'Supplier',
                    'transaction_location' => 'Transaction Location',
                    'payment_note' => 'Payment Note',
                ],
            ],
            'gstpurch' => [
                'label' => 'GST Purchase Report',
                'columns' => [
                    'ref_no' => 'Ref No',
                    'supplier_name' => 'Supplier Name',
                    'tax_no' => 'Tax No',
                    'purchase_date' => 'Purchase Date',
                    'hsn_code' => 'HSN Code',
                    'gst_pct' => 'GST%',
                    'qty' => 'Qty',
                    'unit_price' => 'Unit Price',
                    'discount' => 'Discount',
                    'taxable_value' => 'Taxable Value',
                    'total' => 'Total',
                ],
            ],
        ],
    ],
    'gen' => [
        'label' => 'General Reports',
        'icon' => 'fas fa-file-alt',
        'reports' => [
            'contact' => [
                'label' => 'Contact Report',
                'columns' => [
                    'contact_id' => 'Contact ID',
                    'contact' => 'Contact',
                    'total_purchase' => 'Total Purchase',
                    'total_purchase_return' => 'Total Purchase Return',
                    'total_sell' => 'Total Sell',
                    'total_sell_return' => 'Total Sell Return',
                    'opening_balance_due' => 'Opening Balance Due',
                    'ledger_discount' => 'Ledger Discount',
                    'advance_balance' => 'Advance Balance',
                    'total_due' => 'Total Due',
                    'contact_type' => 'Contact Type',
                ],
            ],
            'items' => [
                'label' => 'Items Report',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'description' => 'Description',
                    'purchase_date' => 'Purchase Date',
                    'purchase' => 'Purchase',
                    'lot_number' => 'Lot Number',
                    'supplier' => 'Supplier',
                    'purchase_price' => 'Purchase Price',
                    'sell_date' => 'Sell Date',
                    'sale' => 'Sale',
                    'customer' => 'Customer',
                    'location' => 'Location',
                    'sell_qty' => 'Sell Quantity',
                    'selling_price' => 'Selling Price',
                    'subtotal' => 'Subtotal',
                ],
            ],
            'combo' => [
                'label' => 'Combo Items Report',
                'columns' => [
                    'sku' => 'SKU',
                    'product' => 'Product',
                    'unit_price' => 'Unit Price',
                    'unit_cost_exc_tax' => 'Unit Cost Exc Tax',
                    'profit' => 'Profit',
                    'gross_profit' => 'Gross Profit',
                ],
            ],
        ],
    ],
];

$isFirstCat = true;
?>

<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-header d-flex justify-content-between align-items-center">
                <h3 class="box-title"><i class="fas fa-chart-bar me-2"></i>Reports Column Visibility</h3>
                <button type="button" class="btn btn-sm btn-danger" id="resetAllReportVisibility"><i class="fas fa-undo me-1"></i>Reset All</button>
            </div>
            <div class="box-body">
                
                <ul class="nav nav-tabs mb-3" id="rptColVisibilityTabs" role="tablist">
                    <?php $__currentLoopData = $reportColumnConfig; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catKey => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link <?php echo e($isFirstCat ? 'active' : '', false); ?>"
                                    id="rpt-<?php echo e($catKey, false); ?>-tab"
                                    data-bs-toggle="tab"
                                    data-bs-target="#rpt-<?php echo e($catKey, false); ?>"
                                    type="button" role="tab"
                                    aria-controls="rpt-<?php echo e($catKey, false); ?>"
                                    aria-selected="<?php echo e($isFirstCat ? 'true' : 'false', false); ?>">
                                <i class="<?php echo e($category['icon'], false); ?> me-1"></i> <?php echo e($category['label'], false); ?>

                            </button>
                        </li>
                        <?php $isFirstCat = false; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

                
                <div class="tab-content" id="rptColVisibilityTabContent">
                    <?php $isFirstCat = true; ?>
                    <?php $__currentLoopData = $reportColumnConfig; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $catKey => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="tab-pane fade <?php echo e($isFirstCat ? 'show active' : '', false); ?>"
                             id="rpt-<?php echo e($catKey, false); ?>"
                             role="tabpanel"
                             aria-labelledby="rpt-<?php echo e($catKey, false); ?>-tab">

                            
                            <?php $isFirstRpt = true; ?>
                            <ul class="nav nav-pills mb-3" id="rpt-<?php echo e($catKey, false); ?>-pills" role="tablist">
                                <?php $__currentLoopData = $category['reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rptKey => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link <?php echo e($isFirstRpt ? 'active' : '', false); ?>"
                                                id="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>-pill"
                                                data-bs-toggle="pill"
                                                data-bs-target="#rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>"
                                                type="button" role="tab"
                                                aria-controls="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>"
                                                aria-selected="<?php echo e($isFirstRpt ? 'true' : 'false', false); ?>">
                                            <?php echo e($report['label'], false); ?>

                                        </button>
                                    </li>
                                    <?php $isFirstRpt = false; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>

                            
                            <?php $isFirstRpt = true; ?>
                            <div class="tab-content" id="rpt-<?php echo e($catKey, false); ?>-pillContent">
                                <?php $__currentLoopData = $category['reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rptKey => $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="tab-pane fade <?php echo e($isFirstRpt ? 'show active' : '', false); ?>"
                                         id="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>"
                                         role="tabpanel"
                                         aria-labelledby="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>-pill">
                                        <?php if(!empty($report['location_based'])): ?>
                                            <?php if(empty($reportVisibilityLocations)): ?>
                                                <p class="text-muted mb-0">No business locations available.</p>
                                            <?php else: ?>
                                                <?php $firstLocation = true; ?>
                                                <ul class="nav nav-pills mb-3" id="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>-locations" role="tablist">
                                                    <?php $__currentLoopData = $reportVisibilityLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locationId => $locationName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link <?php echo e($firstLocation ? 'active' : '', false); ?>"
                                                                    id="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>-loc-<?php echo e($locationId, false); ?>-pill"
                                                                    data-bs-toggle="pill"
                                                                    data-bs-target="#rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>-loc-<?php echo e($locationId, false); ?>"
                                                                    type="button" role="tab"
                                                                    aria-controls="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>-loc-<?php echo e($locationId, false); ?>"
                                                                    aria-selected="<?php echo e($firstLocation ? 'true' : 'false', false); ?>">
                                                                <?php echo e($locationName, false); ?>

                                                            </button>
                                                        </li>
                                                        <?php $firstLocation = false; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>

                                                <?php $firstLocation = true; ?>
                                                <div class="tab-content" id="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>-locationContent">
                                                    <?php $__currentLoopData = $reportVisibilityLocations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locationId => $locationName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="tab-pane fade <?php echo e($firstLocation ? 'show active' : '', false); ?>"
                                                             id="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>-loc-<?php echo e($locationId, false); ?>"
                                                             role="tabpanel"
                                                             aria-labelledby="rpt-<?php echo e($catKey, false); ?>-<?php echo e($rptKey, false); ?>-loc-<?php echo e($locationId, false); ?>-pill">
                                                            <div class="row">
                                                                <?php $__currentLoopData = $report['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colKey => $colLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <?php $settingKey = "rpt_{$catKey}_{$rptKey}_loc_{$locationId}_hide_{$colKey}"; ?>
                                                                    <div class="col-md-12">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <?php echo Form::checkbox("user_settings[{$settingKey}]", 1, !empty($us[$settingKey]), ['class' => 'form-check-input']); ?> Hide <?php echo e($colLabel, false); ?>

                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </div>
                                                        </div>
                                                        <?php $firstLocation = false; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <div class="row">
                                                <?php $__currentLoopData = $report['columns']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $colKey => $colLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $settingKey = "rpt_{$catKey}_{$rptKey}_hide_{$colKey}"; ?>
                                                    <div class="col-md-4">
                                                        <div class="form-check">
                                                            <label class="form-check-label">
                                                                <?php echo Form::checkbox("user_settings[{$settingKey}]", 1, !empty($us[$settingKey]), ['class' => 'form-check-input']); ?> Hide <?php echo e($colLabel, false); ?>

                                                            </label>
                                                        </div>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php $isFirstRpt = false; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        </div>
                        <?php $isFirstCat = false; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
