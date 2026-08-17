# Multi-Currency Feature — Quick Reference Guide

## Overview

The multi-currency feature lets you accept payments and create transactions in different currencies across your POS, Sales, and Purchase screens.

All currency change options are **turned off by default** — an administrator must enable them before staff can use them.

---

## Key Features

### 1. Currency Settings in Business Settings

You can enable or disable currency switching separately for each area:

| Setting Location | What It Controls |
|---|---|
| **Business Settings → POS Tab** | "Allow Currency Change on POS Screen" |
| **Business Settings → Sales Tab** | "Allow Currency Change on Sales Screen" |
| **Business Settings → Purchase Tab** | "Allow Currency Change on Purchase Screen" |

### 2. How It Works for Staff

- **When enabled:** A currency selector appears on the screen, letting you choose a different currency for the transaction. Exchange rates are applied automatically.
- **When disabled:** The currency is locked to your business default. No currency selector is shown.

---

## How to Enable Currency Switching

1. Go to **Business Settings**
2. Open the **POS**, **Sales**, or **Purchase** tab (whichever you want to enable)
3. Check the **"Allow Currency Change"** checkbox
4. Click **Save**

Staff will now see a currency selector on that screen.

---

## How Exchange Rates Work

- When you select a different currency, the system automatically applies the exchange rate set up in your POS.
- All calculations — including discounts, taxes, and totals — are converted using the exchange rate.
- If currency switching is disabled, the default business currency is always used.

---

## Security

- **Secure by default:** All currency change options are turned off when your business is first set up.
- **Admin-controlled:** Only an administrator can enable or disable currency switching.
- **Consistent:** Even if someone tries to change the currency when it's disabled, the system will always use the default currency.
- **No impact on old transactions:** Enabling or disabling this feature does not affect past transactions.

---

## Frequently Asked Questions

**Q: Can I enable currency switching for POS but not for Purchases?**
A: Yes. Each screen has its own setting, so you can mix and match.

**Q: What happens if I disable the setting after staff have already used it?**
A: Past transactions are not affected. Going forward, the currency selector will be hidden and all new transactions will use the default currency.

**Q: Where do I set up exchange rates?**
A: Exchange rates are managed in your POS currency settings. Contact your administrator if you're unsure where to find this.

---

## Support

If you encounter issues with the multi-currency feature, contact your system administrator.

**Compatibility:** Version 5.02 and later
