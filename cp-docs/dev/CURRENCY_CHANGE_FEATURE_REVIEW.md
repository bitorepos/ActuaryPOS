# Currency Change Feature Implementation Review
## BitorePOS Sales & Purchase Invoice Creation

**Document Date:** January 22, 2026  
**Application:** BitorePOS502  
**Feature:** Currency Exchange Rate Change for Sales and Purchase Invoices

---

## Executive Summary

The BitorePOS system implements a comprehensive currency exchange rate feature for both **Purchase Invoices** and **Sales Invoices (POS)** creation. The feature allows users to specify different currencies for purchase transactions and applies exchange rates to convert prices between the business currency and purchase currency. This document provides a detailed review of the implementation.

---

## 1. Overview of Currency System

### 1.1 Business Currency Configuration

**Location:** [app/Utils/BusinessUtil.php](app/Utils/BusinessUtil.php)  
**Key Methods:**
- `convertCurrency()` - Converts currency using external API
- Currency details are loaded from the business record

**Database Tables:**
- `business` - Stores `p_exchange_rate` (purchase exchange rate)
- `currencies` - Stores currency codes, symbols, and formatting details
- `transactions` - Stores `exchange_rate` for each transaction

### 1.2 Currency Details Retrieval

**Method:** `TransactionUtil::purchaseCurrencyDetails()`

Returns:
```php
{
    'id' => currency_id,
    'code' => currency_code,
    'symbol' => currency_symbol,
    'name' => currency_name,
    'thousand_separator' => separator,
    'decimal_separator' => separator,
    'purchase_in_diff_currency' => boolean,
    'p_exchange_rate' => exchange_rate_value
}
```

---

## 2. PURCHASE INVOICE CURRENCY IMPLEMENTATION

### 2.1 Purchase Invoice Creation Form

**View File:** [resources/views/purchase/create.blade.php](resources/views/purchase/create.blade.php)  
**Lines:** 200-220

#### Exchange Rate Input Field
```php
<!-- Currency Exchange Rate -->
<div class="col-sm-3 @if (!$currency_details->purchase_in_diff_currency) hide @endif">
    {!! Form::label('exchange_rate', __('purchase.p_exchange_rate') . ':*') !!}
    {!! Form::number('exchange_rate', $currency_details->p_exchange_rate, [
        'class' => 'form-control',
        'required',
        'step' => 0.001,
    ]) !!}
</div>
```

**Key Points:**
- Field ID: `exchange_rate`
- Input type: `number` with step of 0.001
- Default value: Business-level purchase exchange rate
- Visibility: Hidden if `purchase_in_diff_currency` is false
- Help text: "1 Purchase Currency = ? Base Currency"

### 2.2 Purchase Line Item Pricing with Exchange Rate

**JavaScript File:** [public/js/purchase.js](public/js/purchase.js)

#### A. Line Item Row Update Function (Lines 2390-2450)

```javascript
function update_row_price_for_exchange_rate(row) {
    var exchange_rate = $('input#exchange_rate').val();
    
    if (exchange_rate == 1) {
        return true;  // No conversion needed
    }
    
    // Divide all prices by exchange rate to convert from purchase currency to base currency
    var purchase_unit_cost_without_discount = 
        __read_number(row.find('.purchase_unit_cost_without_discount'), true) / exchange_rate;
    __write_number(row.find('.purchase_unit_cost_without_discount'), 
                   purchase_unit_cost_without_discount, true);
    
    // Similar operations for:
    // - purchase_unit_cost
    // - row_subtotal_before_tax
    // - purchase_product_unit_tax
    // - purchase_unit_cost_after_tax
    // - row_subtotal_after_tax
}
```

**Conversion Logic:**
- When exchange rate > 1: Purchase price is DIVIDED by exchange rate
- Formula: `Price in Base Currency = Price in Purchase Currency / Exchange Rate`
- Applied to: Cost, tax, and subtotals

#### B. When Exchange Rate is Applied

**Line 2235-2240 in purchase.js:**
When a new row is added to the purchase table:

```javascript
function append_purchase_lines(data, row_count, trigger_change = false) {
    // ... row insertion code ...
    update_row_price_for_exchange_rate(row);  // Applied immediately
    update_inline_profit_percentage(row);
    update_table_total();
    update_grand_total();
}
```

### 2.3 Backend Storage & Processing

**Controller:** [app/Http/Controllers/PurchaseController.php](app/Http/Controllers/PurchaseController.php)  
**Method:** `store()` (Lines 450-550)

```php
public function store(Request $request)
{
    // Get exchange rate from form
    $exchange_rate = $transaction_data['exchange_rate'];
    
    // Update business default exchange rate
    Business::update_business($business_id, ['p_exchange_rate' => $exchange_rate]);
    
    // Convert prices using exchange rate
    $transaction_data['total_before_tax'] = 
        $this->productUtil->num_uf($transaction_data['total_before_tax'], 
        $currency_details) * $exchange_rate;
    
    // Handle discount conversion
    if ($transaction_data['discount_type'] == 'fixed') {
        $transaction_data['discount_amount'] = 
            $this->productUtil->num_uf($transaction_data['discount_amount'], 
            $currency_details) * $exchange_rate;
    } elseif ($transaction_data['discount_type'] == 'percentage') {
        // Percentage discounts are not multiplied
        $transaction_data['discount_amount'] = 
            $this->productUtil->num_uf($transaction_data['discount_amount'], 
            $currency_details);
    }
}
```

**Key Processing Steps:**
1. Extract exchange rate from request
2. Update business default p_exchange_rate
3. Multiply totals by exchange rate
4. Handle fixed vs percentage discounts differently
5. Store exchange_rate in transaction record

### 2.4 Profit Margin Calculation with Exchange Rate

**File:** [public/js/purchase.js](public/js/purchase.js) Lines 2465-2480

```javascript
function update_inline_profit_percentage(row) {
    var default_sell_price = __read_number(row.find('input.default_sell_price'), true);
    var exchange_rate = $('input#exchange_rate').val();
    
    // Convert selling price to base currency
    default_sell_price_in_base_currency = default_sell_price / parseFloat(exchange_rate);
    
    var purchase_after_tax = __read_number(row.find('input.purchase_unit_cost_after_tax'), true);
    
    // Gross Profit Calculation
    var profit_percent = ((default_sell_price - purchase_after_tax) / default_sell_price) * 100;
}
```

**Important:** Selling price is converted to base currency for profit margin calculation.

---

## 3. SALES INVOICE (POS) CURRENCY IMPLEMENTATION

### 3.1 Sales Invoice Form with Exchange Rate

**View Files:**
- [resources/views/sale_pos/partials/pos_form.blade.php](resources/views/sale_pos/partials/pos_form.blade.php) Line 180
- [resources/views/sale_pos/partials/pos_form_edit.blade.php](resources/views/sale_pos/partials/pos_form_edit.blade.php) Line 129

```php
{!! Form::text('exchange_rate', 
    config('constants.currency_exchange_rate'), 
    ['class' => 'form-control input-sm input_number', 
     'id' => 'exchange_rate']) !!}
```

### 3.2 POS Exchange Rate Change Event Handler

**JavaScript File:** [public/js/pos.js](public/js/pos.js)  
**Lines:** 2492-2500

```javascript
$('#exchange_rate').change(function() {
    var curr_exchange_rate = 1;
    if ($(this).val()) {
        curr_exchange_rate = __read_number($(this));
    }
    
    // Calculate total payable in purchase currency
    var total_payable = __read_number($('input#final_total_input'));
    var shown_total = total_payable * curr_exchange_rate;
    
    // Display converted total
    $('span#total_payable').text(__currency_trans_from_en(shown_total, false));
});
```

### 3.3 Total Calculation with Exchange Rate

**File:** [public/js/pos.js](public/js/pos.js)  
**Lines:** 4060-4075 (within `pos_total_row()` function)

```javascript
function pos_total_row() {
    // ... calculation of price_total, order_tax, discount, etc ...
    
    var total_payable_rounded = round_off_data.number;
    
    // Get current exchange rate
    var curr_exchange_rate = 1;
    if ($('#exchange_rate').length > 0 && $('#exchange_rate').val()) {
        curr_exchange_rate = __read_number($('#exchange_rate'));
    }
    
    // Multiply final total by exchange rate for display
    var shown_total = total_payable_rounded * curr_exchange_rate;
    $('span#total_payable').text(__currency_trans_from_en(shown_total, false));
}
```

**Key Difference from Purchase:**
- In POS, the total is MULTIPLIED by exchange rate
- In Purchase, individual line items are DIVIDED by exchange rate
- This suggests Purchase currency is used for input, converted to base for storage

### 3.4 POS Payment Processing

The payment amount field is also affected:

```javascript
// Payment is calculated in base currency and converted
__write_number($('.payment-amount').first(), total_payable_rounded);
```

---

## 4. DIFFERENCE: PURCHASE vs SALES CURRENCY HANDLING

### 4.1 Purchase Invoice Logic
- **Input Currency:** Purchase Currency
- **Conversion Direction:** Purchase Currency → Base Currency (DIVIDE)
- **Where Applied:** Individual line items in table
- **When Updated:** When exchange rate changes, rows are recalculated
- **Event Handler:** NO dedicated exchange rate change event in purchase.js
- **Update Mechanism:** Implicit through `append_purchase_lines()` when rows are added

### 4.2 Sales Invoice (POS) Logic
- **Input Currency:** Base Currency (typically)
- **Conversion Direction:** Base Currency → Purchase Currency (MULTIPLY)
- **Where Applied:** Final total display
- **When Updated:** When exchange rate changes via explicit event listener
- **Event Handler:** `$('#exchange_rate').change()` in pos.js Line 2492
- **Update Mechanism:** Explicit event handler that recalculates display total

### 4.3 Exchange Rate Direction

```
PURCHASE INVOICE:
Purchase Currency Amount ÷ Exchange Rate = Base Currency Amount

EXAMPLE: If buying in USD and business currency is PKR
- Exchange Rate = 280 (1 USD = 280 PKR)
- Purchase Price = 100 USD
- Base Currency Price = 100 ÷ 280 = 0.357 PKR

SALES INVOICE (POS):
Base Currency Amount × Exchange Rate = Display Amount

EXAMPLE: If selling in base currency but displaying in another
- Exchange Rate = 280 (1 Base = 280 USD)
- Sale Price = 1 PKR
- Display Price = 1 × 280 = 280 USD
```

---

## 5. CRITICAL CONFIGURATION & SETTINGS

### 5.1 Business Settings for Currency

**Location:** [resources/views/business/partials/settings_purchase.blade.php](resources/views/business/partials/settings_purchase.blade.php)

```php
<!-- Enable purchasing in different currency -->
{!! Form::checkbox('purchase_in_diff_currency', 1, 
    $business->purchase_in_diff_currency) !!}
    {{ __('purchase.allow_purchase_different_currency') }}

<!-- Select purchase currency -->
{!! Form::select('purchase_currency_id', $currencies, 
    $business->purchase_currency_id) !!}

<!-- Set default purchase exchange rate -->
{!! Form::number('p_exchange_rate', $business->p_exchange_rate, 
    ['step' => '0.001']) !!}
```

**Key Settings:**
- `purchase_in_diff_currency` - Boolean flag to enable feature
- `purchase_currency_id` - Which currency is used for purchases
- `p_exchange_rate` - Default exchange rate for conversions
- Updated in business table whenever a purchase is saved

### 5.2 Config Constants

**File:** `config/constants.php`

- `currency_exchange_rate` - Default exchange rate config value
- `disable_purchase_in_other_currency` - Feature flag (default: true)

---

## 6. DATABASE SCHEMA

### 6.1 Business Table Fields

```sql
ALTER TABLE business
ADD COLUMN p_exchange_rate DECIMAL(20, 3) NOT NULL DEFAULT 1 
    COMMENT '1 Purchase currency = ? Base Currency';

ALTER TABLE business  
ADD COLUMN purchase_currency_id INT(10) UNSIGNED 
    COMMENT 'Foreign key to currencies table';

ALTER TABLE business
ADD COLUMN purchase_in_diff_currency TINYINT(1) DEFAULT 0;
```

### 6.2 Transactions Table Fields

```sql
ALTER TABLE transactions
ADD COLUMN exchange_rate DECIMAL(20, 3) NOT NULL DEFAULT 1 
    COMMENT 'Exchange rate used for this transaction';
```

**Migration Files:**
- `database/migrations/2018_02_07_173326_modify_business_table.php`
- `database/migrations/2018_02_08_155348_add_exchange_rate_to_transactions_table.php`
- `database/migrations/2018_04_09_135320_change_exchage_rate_size_in_business_table.php`

---

## 7. LANGUAGE & LOCALIZATION

### 7.1 English Translations

**File:** [resources/lang/en/purchase.php](resources/lang/en/purchase.php)

```php
'allow_purchase_different_currency' => 'Purchases in other currency'
'purchase_currency' => 'Purchase Currency'
'p_exchange_rate' => 'Currency Exchange Rate'
'diff_purchase_currency_help' => 'Purchase currency is set to :currency'
```

**File:** [resources/lang/en/tooltip.php](resources/lang/en/tooltip.php)

```php
'purchase_different_currency' => 'Select this option if you purchase in a different 
    currency than your business currency'
    
'currency_exchange_factor' => "1 Purchase Currency = ? Base Currency <br> 
    <small class='text-muted'>You can enable/disabled 'Purchase in other currency' 
    from business settings.</small>"
```

### 7.2 Multi-Language Support

Translations available in:
- Arabic (ar)
- Spanish (es)
- French (fr)
- German (ce)
- Hindi (hi)
- Vietnamese (vi)
- Turkish (tr)
- Pashto (ps)
- Lao (lo)
- Portuguese (pt)
- Albanian (sq)
- Romanian (ro)

---

## 8. UTILITY FUNCTIONS

### 8.1 Number Formatting Functions

**File:** [app/Utils/Util.php](app/Utils/Util.php)

```php
public function num_uf($input_number, $currency_details = null)
{
    // Unformat number based on currency separators
    if (!empty($currency_details)) {
        $thousand_separator = $currency_details->thousand_separator;
        $decimal_separator = $currency_details->decimal_separator;
        // Conversion logic...
    }
}
```

**JavaScript Equivalent:**
```javascript
__read_number(element, true)  // Read and convert to base number
__write_number(element, value, true)  // Write formatted number
__currency_trans_from_en(value, false, true)  // Currency translation
```

---

## 9. KEY FINDINGS & IMPLEMENTATION GAPS

### 9.1 Missing Exchange Rate Change Event in Purchase

**Issue:** There is NO dedicated `$(document).on('change', '#exchange_rate')` event handler in [public/js/purchase.js](public/js/purchase.js)

**Current Behavior:**
- Exchange rate is read when new rows are added
- If exchange rate changes AFTER rows are added, rows are NOT updated
- Only new rows added after exchange rate change will use new rate

**Contrast with POS:**
- POS has explicit exchange rate change handler (pos.js:2492)
- POS totals update immediately when exchange rate changes

**Recommendation:** Should add event handler like:
```javascript
$(document).on('change', '#exchange_rate', function() {
    $('#purchase_entry_table tbody').find('tr').each(function() {
        update_row_price_for_exchange_rate($(this));
    });
    update_table_total();
    update_grand_total();
});
```

### 9.2 Inconsistent Exchange Rate Direction

**Purchase:** Divides by exchange rate (assumes input is in purchase currency)
**Sales POS:** Multiplies by exchange rate (assumes display conversion)

This inconsistency should be clarified in documentation.

### 9.3 Profit Margin Calculation

**Current Implementation:**
```javascript
default_sell_price_in_base_currency = default_sell_price / exchange_rate;
var profit_percent = ((default_sell_price - purchase_after_tax) / default_sell_price) * 100;
```

**Issue:** Compares unconverted selling price with converted cost price

---

## 10. USE CASE FLOWS

### 10.1 Typical Purchase Invoice Flow

```
1. User opens Purchase Create page
2. Selects location → currency details loaded
3. Exchange rate defaults from business p_exchange_rate setting
4. User can override exchange rate for this purchase
5. User adds products → update_row_price_for_exchange_rate() converts prices
6. All prices stored in base currency in database
7. On save, exchange_rate value stored in transaction record
8. Default p_exchange_rate updated for next purchase
```

### 10.2 Typical Sales Invoice (POS) Flow

```
1. User opens POS/Sales create page
2. Exchange rate defaults from config('constants.currency_exchange_rate')
3. Products added with base currency prices
4. Exchange rate change → event listener updates display total
5. Final total multiplied by exchange rate for display to customer
6. Actual transaction stored in base currency
7. Exchange rate stored for reference/historical tracking
```

---

## 11. FILE STRUCTURE SUMMARY

### Core Files for Purchase Currency:

| File | Lines | Purpose |
|------|-------|---------|
| [app/Http/Controllers/PurchaseController.php](app/Http/Controllers/PurchaseController.php) | 450-550 | Store/Update logic with exchange rate |
| [public/js/purchase.js](public/js/purchase.js) | 2235-2450 | Line item price conversion |
| [resources/views/purchase/create.blade.php](resources/views/purchase/create.blade.php) | 205-220 | Exchange rate input field |
| [resources/views/business/partials/settings_purchase.blade.php](resources/views/business/partials/settings_purchase.blade.php) | 1-50 | Business settings for currency |

### Core Files for Sales/POS Currency:

| File | Lines | Purpose |
|------|-------|---------|
| [public/js/pos.js](public/js/pos.js) | 2492-2500 | Exchange rate change handler |
| [public/js/pos.js](public/js/pos.js) | 4060-4075 | Total calculation with rate |
| [resources/views/sale_pos/partials/pos_form.blade.php](resources/views/sale_pos/partials/pos_form.blade.php) | 180 | Exchange rate input |

---

## 12. RECOMMENDATIONS

1. **Add Exchange Rate Change Event:** Implement missing event handler in purchase.js to dynamically update all line items when exchange rate changes.

2. **Clarify Documentation:** Document the directional difference between purchase and sales currency handling.

3. **Validate Exchange Rate:** Ensure exchange rate is not zero and is within reasonable bounds.

4. **Audit Trail:** Consider logging exchange rate changes for compliance/audit purposes.

5. **Bulk Update Capability:** When exchange rate changes after rows added, provide UI option to apply new rate to all rows.

6. **Testing:** Add test cases for:
   - Exchange rate change after rows are added
   - Negative exchange rates
   - Exchange rate of 0
   - Very large/small exchange rates
   - Decimal precision in calculations

---

## Document Metadata

**Last Reviewed:** January 22, 2026  
**System Version:** BitorePOS502  
**PHP Version:** Laravel Framework  
**Database:** MySQL  
**Front-end:** jQuery, Bootstrap  

**Related Documents:**
- DOJO_INTEGRATION.md
- XERO_INTEGRATION.md

---

**End of Document**
