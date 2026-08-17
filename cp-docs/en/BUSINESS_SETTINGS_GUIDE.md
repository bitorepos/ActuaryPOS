# Business Settings — Complete Guide

The **Business Settings** page is the control centre for your entire {application_name} system. This guide walks through every tab and every option, explaining what it does and when you should change it.

---

## What You'll Learn

- How to access and update settings
- What every setting does (in plain language)
- Best practices for each configuration area

---

## How to Access Business Settings

1. Go to **Settings → Business Settings** from the left sidebar.
2. You'll see multiple tabs across the top — click any tab to jump to that section.
3. After making changes, click **Update Settings** at the bottom to save.

📸 *[Screenshot: The Business Settings page showing the tab navigation]*

> ⚠️ **Important:** Only users with Settings permissions can access this page.

---

## Tab 1: Business

Your core business information.

| Setting | What It Does |
|---|---|
| **Business Name** | Your company or shop name — appears on invoices and receipts |
| **Start Date** | When your business started using {application_name} |
| **Logo** | Upload your business logo — shown on invoices and the login page |
| **Currency** | Your main business currency (e.g., USD, GBP, PKR) |
| **Currency Symbol Placement** | Show the currency symbol before (£100) or after (100£) the amount |
| **Default Profit Percent** | Automatically calculates selling price from purchase price |
| **Financial Year Start Month** | Which month your financial year begins (for reports) |
| **Accounting Method** | **FIFO** (First In First Out) or **LIFO** (Last In First Out) |
| **Transaction Edit Days** | How many days after creation a transaction can be edited |
| **Date Format** | How dates appear throughout the system (e.g., DD/MM/YYYY) |
| **Time Format** | 12-hour or 24-hour clock |
| **Time Zone** | Your business time zone |
| **Currency Precision** | Number of decimal places for money (usually 2) |
| **Quantity Precision** | Number of decimal places for quantities (usually 2) |
| **Discount Precision** | Number of decimal places for discounts |

📸 *[Screenshot: The Business tab with key fields highlighted]*

---

## Tab 2: Tax

Tax configuration for your business.

| Setting | What It Does |
|---|---|
| **Tax 1 Name & Number** | Your primary tax label and registration number (e.g., VAT, GST) |
| **Tax 2 Name & Number** | A second tax label if needed |
| **Default Sales Tax** | Tax rate automatically applied to new sales |
| **Default Purchase Tax** | Tax rate automatically applied to new purchases |

📸 *[Screenshot: The Tax settings tab]*

> 💡 **Tip:** Set up your tax rates first under **Settings → Tax Rates**, then select them here as defaults.

---

## Tab 3: Product

Controls how products behave in the system.

| Setting | What It Does | Default |
|---|---|---|
| **SKU Prefix** | Text added before auto-generated product codes | Empty |
| **Default Unit** | The unit selected by default for new products | Pieces |
| **Enable Sub-Units** | Allow units like "Box of 12" | Off |
| **Enable Secondary Unit** | Track products in a second unit of measurement | Off |
| **Enable Product Expiry** | Track expiry dates on products | Off |
| **Expiry Type** | How to enter expiry (date or manufacturing + period) | Date |
| **On Product Expiry** | What happens when a product expires (keep selling or stop) | Keep Selling |
| **Stop Selling Before (days)** | Block sales this many days before expiry | 0 |
| **Enable Categories** | Show product categories | On |
| **Enable Sub-Categories** | Allow categories within categories | Off |
| **Enable Brands** | Show product brands | On |
| **Enable Warranty** | Track warranty information per product | Off |
| **Enable Lot Numbers** | Track batch/lot numbers | Off |
| **Enable Generic Names** | For pharmacies — track generic drug names | Off |
| **Enable Potency** | For pharmacies — track medicine potency | Off |
| **Enable Drug Classes** | For pharmacies — classify medicines | Off |

📸 *[Screenshot: The Product settings tab]*

---

## Tab 4: Contact

Settings related to customers and suppliers.

| Setting | What It Does |
|---|---|
| **Contact ID Settings** | How contact ID numbers are generated |
| **Default Credit Limit** | Maximum credit allowed for new customers |
| **Default Pay Term** | Payment terms for new contacts |

📸 *[Screenshot: The Contact settings tab]*

---

## Tab 5: Sale

Controls how sales work.

| Setting | What It Does | Default |
|---|---|---|
| **Default Sale Status** | Whether new sales start as Final or Draft | Final |
| **Sell Price Tax** | Are your selling prices inclusive or exclusive of tax? | Exclusive |
| **Sales Item Addition Method** | How products are added to a sale (add row or increase qty) | Add Row |
| **Allow Currency Change** | Let users make sales in different currencies | Off |
| **Enable Sales Orders** | Show the Sales Orders feature | Off |
| **Enable Quotations** | Show the Quotations feature | Off |
| **Enable Shipping Details** | Show shipping fields on sales | Off |
| **Commission Agent** | How commission agents are selected | Disabled |
| **Pay Term Required** | Force users to enter payment terms on sales | Off |
| **Min Sale Price (MSP)** | Prevent selling below the minimum price | Off |
| **Allow Overselling** | Allow selling products with zero stock | On |

📸 *[Screenshot: The Sale settings tab]*

---

## Tab 6: POS Sale

Settings specific to the POS (Point of Sale) screen.

| Setting | What It Does | Default |
|---|---|---|
| **POS Interface** | Screen layout — Simple, Product Suggestion, or Quick Buttons | Simple |
| **Auto-Focus on Search Bar** | Automatically put the cursor in the search bar | On |
| **Tax Inclusive POS** | Whether POS prices include tax | Off |
| **Enable Transaction Date on POS** | Show date field on POS screen | Off |
| **Require Customer Always** | Make customer selection mandatory for every sale | Off |
| **Show Pricing on Suggestions** | Display prices on the product suggestion grid | On |
| **Service Staff Required** | Make service staff selection mandatory | Off |
| **Show Change/Return Modal** | Show change amount after cash payment | On |
| **Keyboard Shortcuts** | Customise shortcut keys for POS actions | Default |

📸 *[Screenshot: The POS Sale settings tab]*

---

## Tab 7: Payment

Payment method configuration and settings.

📸 *[Screenshot: The Payment settings tab]*

---

## Tab 8: Purchases

Settings for purchasing operations.

| Setting | What It Does |
|---|---|
| **Allow Currency Change** | Make purchases in different currencies |
| **Enable Purchase Orders** | Show the Purchase Orders feature |
| **Enable Purchase Requisitions** | Show the Purchase Requisitions feature |

📸 *[Screenshot: The Purchases settings tab]*

---

## Tab 9: Expenses

Expense tracking settings.

📸 *[Screenshot: The Expenses settings tab]*

---

## Tab 10: Dashboard

Control what appears on the home dashboard.

| Setting | What It Does |
|---|---|
| **Dashboard Sections** | Choose which sections to show/hide |
| **Default Date Range** | The time period shown when Dashboard loads |

📸 *[Screenshot: The Dashboard settings tab]*

---

## Tab 11: System

General system behaviour settings.

| Setting | What It Does | Default |
|---|---|---|
| **Default Table Page Entries** | How many rows to show per page in lists/tables | 25 |
| **Enable Tooltip** | Show helpful popup tips when hovering over icons | On |
| **Enable Urdu Typing** | Allow Urdu language input in text fields | Off |

📸 *[Screenshot: The System settings tab]*

---

## Tab 12: Date Range

Set the default date range for different parts of the system.

This lets you control what time period is shown by default when a user opens:
- Dashboard, Reports, Sales, Purchases, Expenses, and more

For each section, choose from: Today, This Week, This Month, This Quarter, This Year, etc.

📸 *[Screenshot: The Date Range settings tab]*

---

## Tab 13: Prefixes

Customise the reference number prefixes for all transaction types.

| Transaction | Example Prefix | Result |
|---|---|---|
| Sale | INV | INV-0001 |
| Purchase | PUR | PUR-0001 |
| Expense | EXP | EXP-0001 |
| Stock Transfer | ST | ST-0001 |
| Customer Payment | RV | RV-0001 |
| Supplier Payment | PV | PV-0001 |
| Sales Order | SO | SO-0001 |
| Quotation | QT | QT-0001 |

📸 *[Screenshot: The Prefixes settings tab with all prefix fields]*

> 💡 **Tip:** Set meaningful prefixes that match your existing numbering system. This makes it easier to identify transaction types at a glance.

---

## Tab 14: Email Settings

Configure how {application_name} sends emails (invoices, notifications, etc.).

| Setting | What It Does |
|---|---|
| **Mail Driver** | How emails are sent (SMTP, Sendmail, etc.) |
| **Host** | Your email server address |
| **Port** | The email server port (usually 587 or 465) |
| **Username** | Your email login |
| **Password** | Your email password |
| **Encryption** | Security type (TLS or SSL) |
| **From Address** | The email address that appears as the sender |
| **From Name** | The name that appears as the sender |

Click **Send Test Email** to verify your settings are working.

📸 *[Screenshot: The Email settings tab with the test button]*

---

## Tab 15: SMS Settings

Set up SMS (text message) notifications.

| Setting | What It Does |
|---|---|
| **SMS Gateway URL** | The web address of your SMS service provider |
| **Parameters** | Key-value pairs required by your SMS provider |
| **Send To Parameter** | Which parameter carries the phone number |
| **Message Parameter** | Which parameter carries the message text |
| **Request Method** | GET or POST |

You can also configure **Zekli SMS** integration with separate username/password fields.

Click **Send Test SMS** to verify your settings.

📸 *[Screenshot: The SMS settings tab]*

---

## Tab 16: Reward Points

Set up a loyalty programme for your customers.

| Setting | What It Does | Default |
|---|---|---|
| **Enable Reward Points** | Turn the loyalty system on or off | Off |
| **Reward Point Name** | What to call your points (e.g., "Stars", "Points") | Points |
| **Amount Per Unit RP** | How much a customer spends to earn 1 point | 1 |
| **Min Order Total** | Minimum sale amount to earn points | 0 |
| **Max RP Per Order** | Maximum points earnable in one transaction | Unlimited |
| **Redeem Amount Per Unit RP** | How much each point is worth when redeemed | 1 |
| **Min/Max Redeem Points** | Limits on how many points can be redeemed at once | None |
| **Expiry Period** | How long points last before expiring | Never |

📸 *[Screenshot: The Reward Points settings tab]*

---

## Tab 17: Modules

Enable or disable major features of {application_name}.

| Module | What It Does |
|---|---|
| **POS Sale** | The point-of-sale screen for quick sales |
| **Add Sale** | Direct sale/invoice creation |
| **Products** | Product management features |
| **Purchases** | Purchase and supplier management |
| **Stock Adjustment** | Stock level corrections |
| **Stock Transfers** | Move stock between locations |
| **Expenses** | Expense tracking |
| **Reports** | Business reports |
| **Accounts** | Payment account management |
| **Tables** | Restaurant table management |
| **Quick Menu** | Quick menu/order board |
| **Kitchen** | Kitchen display screen |
| **Service Staff** | Service staff assignment |
| **Booking** | Table/appointment bookings |
| **Subscription** | Recurring invoice management |
| **Notification Templates** | Email/SMS notification setup |

Toggle each module on or off. Disabled modules won't appear in the sidebar.

📸 *[Screenshot: The Modules tab with toggle switches]*

> 💡 **Tip:** Disable modules you don't use to keep the sidebar clean and simple for your staff.

---

## Tab 18: Custom Labels

Rename default field labels throughout the system to match your business terminology.

For example:
- Rename "Brand" to "Manufacturer"
- Rename "Category" to "Department"
- Change custom field labels to track industry-specific info

📸 *[Screenshot: The Custom Labels settings tab]*

---

## Other Settings Pages

### Business Locations

Go to **Settings → Business Locations** to manage your physical locations (shops, warehouses, etc.).

### Invoice Settings

Go to **Settings → Invoice Settings** to configure invoice numbering schemes and layouts.

### Barcode Settings

Go to **Settings → Barcode Settings** to configure how barcode labels are printed.

### Tax Rates

Go to **Settings → Tax Rates** to create and manage tax rates.

### Receipt Printers

Go to **Settings → Receipt Printers** to set up thermal or network printers.

---

## Common Questions

**Q: I changed a setting but it doesn't seem to work. What should I do?**
A: Make sure you clicked **Update Settings** at the bottom of the page. Some settings may also require you to refresh the page or log out and back in.

**Q: Will changing settings affect my past transactions?**
A: No. Settings only affect new transactions created after the change. Past records stay as they were.

**Q: Can different locations have different settings?**
A: Yes! Many POS and sale settings can be configured per location under **Settings → Business Locations → [Location] → Settings**.

---

## Tips & Best Practices

- 📌 Review **all settings** when you first set up the system — getting them right from the start saves time later
- 📌 Disable unused **modules** to keep the interface clean
- 📌 Set meaningful **prefixes** for all transaction types
- 📌 Test your **email** and **SMS** settings before relying on them
- 📌 Keep your **financial year start** month accurate for correct reports