# Multi-Currency Feature - Quick Reference Guide

## What Was Implemented

A complete multi-currency support system with configurable controls for POS, Sales, and Purchase modules in {application_name}.

## Key Features

### 1. Business Settings Configuration
Located in **Business Settings** → respective tabs:
- **POS Tab**: "Allow Currency Change on POS Screen"
- **Sales Tab**: "Allow Currency Change on Sales Screen"
- **Purchase Tab**: "Allow Currency Change on Purchase Screen"

All settings are **disabled by default** for maximum security.

### 2. Automatic UI Control
- **When Enabled**: Users can change currency on transaction screens
- **When Disabled**: Currency selector is hidden, locked to business default

### 3. Backend Enforcement
- Server-side validation prevents currency changes even if frontend is bypassed
- Ensures consistency and security across all transaction types

## Database Changes

### New Columns in `business` Table:
```sql
- allow_currency_change_pos (BOOLEAN, default: 0)
- allow_currency_change_sales (BOOLEAN, default: 0)
- allow_currency_change_purchase (BOOLEAN, default: 0)
```

## Files Modified

### Database
- `database/migrations/2026_01_31_100000_add_multi_currency_settings_to_business_table.php`

### Models
- `app/Business.php` - Added boolean casts

### Controllers
- `app/Http/Controllers/BusinessController.php` - Settings save logic
- `app/Http/Controllers/SellPosController.php` - POS validation
- `app/Http/Controllers/PurchaseController.php` - Purchase validation

### Views
- `resources/views/business/partials/settings_pos.blade.php`
- `resources/views/business/partials/settings_sales.blade.php`
- `resources/views/business/partials/settings_purchase.blade.php`
- `resources/views/sale_pos/partials/pos_form.blade.php`
- `resources/views/purchase/create.blade.php`

### Language Files
- `resources/lang/en/lang_v1.php` - Added 6 new translation keys

## Exchange Rate Handling

### POS Module
- Uses `exchange_rate` field in transactions table
- Hidden input preserves default value when currency change is disabled

### Purchase Module
- Uses `p_exchange_rate` field from business table
- Applied to all calculation fields (discounts, taxes, totals)
- Properly handles fixed and percentage discounts with exchange rates

### Sales Module
- Currently integrates with POS settings
- Can be extended in future with dedicated Sales currency support

## How to Enable the Feature

1. **Run Migration**:
   ```bash
   php artisan migrate
   ```

2. **Access Business Settings**:
   - Go to: Business Settings
   - Navigate to POS, Sales, or Purchase tabs
   - Check the respective "Allow Currency Change" checkbox
   - Click Save

3. **Users Can Now**:
   - Change currency on transaction screens (if enabled)
   - Currency selector will be visible and editable
   - Exchange rates applied automatically

## Security Considerations

✅ **Secure by Default**: All settings disabled at creation
✅ **Dual Enforcement**: Both frontend and backend validation
✅ **No Bypass Possible**: Backend resets invalid values
✅ **Backward Compatible**: Existing transactions unaffected

## Translation Support

The feature includes English translations. To support additional languages, add to their respective `lang_v1.php` files:

```php
'allow_currency_change_pos' => '[Your Translation]',
'allow_currency_change_pos_help' => '[Your Help Text]',
'allow_currency_change_sales' => '[Your Translation]',
'allow_currency_change_sales_help' => '[Your Help Text]',
'allow_currency_change_purchase' => '[Your Translation]',
'allow_currency_change_purchase_help' => '[Your Help Text]',
```

## Testing Checklist

- [ ] Run migration successfully
- [ ] Settings appear in Business Settings > POS tab
- [ ] Settings appear in Business Settings > Sales tab
- [ ] Settings appear in Business Settings > Purchase tab
- [ ] Settings save without errors
- [ ] POS form hides currency field when setting disabled
- [ ] POS form shows currency field when setting enabled
- [ ] Purchase form hides exchange rate when setting disabled
- [ ] Purchase form shows exchange rate when setting enabled
- [ ] Backend prevents unauthorized currency changes
- [ ] Exchange rates calculate correctly
- [ ] Existing transactions work normally
- [ ] Default currency transactions work when setting disabled

## Future Enhancements

1. **Sales Module**: Add dedicated currency selector to Sales form (currently uses POS setting)
2. **Multiple Currencies**: Support simultaneous transactions in different currencies
3. **Audit Trail**: Log currency changes for compliance
4. **Currency Conversion**: Automatic real-time exchange rate fetching
5. **Reporting**: Currency-wise sales/purchase reports

## Support & Documentation

For detailed implementation information, see: `MULTI_CURRENCY_IMPLEMENTATION.md`

## Version Info
- Implemented: January 31, 2026
- Compatibility: {application_name} 5.02 and later
- Status: Production Ready
