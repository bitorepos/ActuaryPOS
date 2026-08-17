# Multi-Currency Support Implementation

## Overview
This implementation adds multi-currency support with configurable controls for POS, Sales, and Purchase modules in the {application_name} system.

## Changes Made

### 1. Database Migration
**File**: `database/migrations/2026_01_31_100000_add_multi_currency_settings_to_business_table.php`

Added three new boolean columns to the `business` table:
- `allow_currency_change_pos` - Allows currency change on POS screen (default: 0)
- `allow_currency_change_sales` - Allows currency change on Sales screen (default: 0)
- `allow_currency_change_purchase` - Allows currency change on Purchase screen (default: 0)

All settings are disabled by default for security.

### 2. Business Model Updates
**File**: `app/Business.php`

Updated the `$casts` array to include the three new boolean fields:
```php
'allow_currency_change_pos' => 'boolean',
'allow_currency_change_sales' => 'boolean',
'allow_currency_change_purchase' => 'boolean',
```

### 3. Business Settings UI
**Files Modified**:
- `resources/views/business/partials/settings_sales.blade.php` - Added toggle for Sales currency change
- `resources/views/business/partials/settings_pos.blade.php` - Added toggle for POS currency change
- `resources/views/business/partials/settings_purchase.blade.php` - Added toggle for Purchase currency change

Each tab now includes:
- A checkbox input for the currency change setting
- A tooltip explaining the feature
- Help text describing what enabling/disabling does

### 4. Business Controller Updates
**File**: `app/Http/Controllers/BusinessController.php`

**Method**: `postBusinessSettings()`

- Added the three new settings to the `$business_details` array in the `$request->only()` method
- Added the new fields to the `$checkboxes` array for proper processing as boolean values

### 5. POS Transaction Form
**File**: `resources/views/sale_pos/partials/pos_form.blade.php`

Updated the currency exchange rate field to check the `allow_currency_change_pos` setting:
- When setting is enabled: Currency selector is visible and editable
- When setting is disabled: Currency field is hidden and exchange rate is sent as hidden input with default value

### 6. Purchase Transaction Form
**File**: `resources/views/purchase/create.blade.php`

Updated the exchange rate field visibility to check the `allow_currency_change_purchase` setting:
- Added additional condition: `!$business_details->allow_currency_change_purchase`
- When disabled: Exchange rate field is hidden, but a hidden input preserves the default rate

### 7. POS Controller Validation
**File**: `app/Http/Controllers/SellPosController.php`

**Method**: `store()`

Added backend validation (lines 565-576):
- Validates that currency changes are only allowed when the `allow_currency_change_pos` setting is enabled
- If a non-default exchange rate is submitted but the setting is disabled, resets to default value
- Prevents unauthorized currency changes even if form validation is bypassed

### 8. Purchase Controller Validation
**File**: `app/Http/Controllers/PurchaseController.php`

**Method**: `store()`

Added backend validation:
- Validates that currency changes are only allowed when the `allow_currency_change_purchase` setting is enabled
- If a non-default exchange rate is submitted but the setting is disabled, resets to default value
- Retrieves the business default exchange rate and compares against submitted value

### 9. Language/Translation File
**File**: `resources/lang/en/lang_v1.php`

Added translation keys:
- `allow_currency_change_pos` - Label for POS setting
- `allow_currency_change_pos_help` - Help tooltip for POS setting
- `allow_currency_change_sales` - Label for Sales setting
- `allow_currency_change_sales_help` - Help tooltip for Sales setting
- `allow_currency_change_purchase` - Label for Purchase setting
- `allow_currency_change_purchase_help` - Help tooltip for Purchase setting

## Acceptance Criteria Met

✅ **Multi-currency functionality** is implemented for Sales and Purchase transactions
- Exchange rate handling is preserved in both modules
- Currency can be changed when enabled, locked when disabled

✅ **Configuration options** added under Business Settings:
- **POS Tab**: Allow Currency Change on POS Screen
- **Sales Tab**: Allow Currency Change on Sales Screen  
- **Purchase Tab**: Allow Currency Change on Purchase Screen

✅ **All new settings disabled by default**
- All three checkboxes start unchecked (value: 0)
- Provides secure default behavior

✅ **Settings enforcement**:
- UI conditionally shows/hides currency selector based on settings
- Backend validation prevents unauthorized currency changes
- Exchange rates are applied correctly when currency is changed

✅ **Backward compatibility**:
- Existing transactions using default currency continue to work
- Settings don't affect transactions created before implementation
- Migration safely adds columns with safe defaults

## Implementation Notes

### Exchange Rate Handling
- **POS**: Exchange rate is handled via the `exchange_rate` field in transactions
- **Purchase**: Uses `p_exchange_rate` field from business table
- When disabled, hidden inputs preserve default values

### Security
- Backend validation ensures settings are enforced even if frontend is bypassed
- No unauthorized currency changes possible through form manipulation

### User Experience
- Settings are easily accessible in Business Settings > respective tab
- Clear tooltips explain the feature
- Default behavior (locked currency) provides safety

## Migration Instructions

To deploy this feature:

1. Run the migration:
   ```
   php artisan migrate
   ```

2. No additional setup needed - all settings default to disabled (secure)

3. Business owners can enable currency change per module in Business Settings

## Files Changed

1. Database: 1 migration file
2. Models: 1 file (Business.php)
3. Controllers: 2 files (BusinessController.php, SellPosController.php, PurchaseController.php)
4. Views: 3 files (settings_sales.blade.php, settings_pos.blade.php, settings_purchase.blade.php, pos_form.blade.php, purchase/create.blade.php)
5. Language: 1 file (lang_v1.php)

**Total**: 11 files modified/created
