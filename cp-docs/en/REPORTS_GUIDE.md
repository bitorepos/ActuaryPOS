# Reports — Understanding Your Business Numbers

Reports are your window into how your business is performing. {application_name} includes over 30 built-in reports covering sales, purchases, stock, expenses, taxes, and more. This guide explains each report and what it tells you.

---

## What You'll Learn

- Where to find reports
- What each report shows
- How to filter and export reports
- How to use reports for better business decisions

---

## How to Access Reports

1. Go to **Reports** from the left sidebar.
2. You'll see all available reports organised into categories.
3. Click any report to open it.
4. Use the **date filter** and other options at the top to focus on what you need.
5. Most reports can be **exported** to Excel, CSV, PDF, or printed directly.

📸 *[Screenshot: The Reports menu showing all report categories]*

---

## Business & Profit Reports

### Profit & Loss Report

Shows your overall business performance — are you making money or losing it?

- **Total Sales** minus **Cost of Goods Sold** = **Gross Profit**
- **Gross Profit** minus **Expenses** = **Net Profit**
- When enabled in sales settings, sale-return discount and sale-return discount 2 totals appear in the right-hand summary.
- Payroll, HMS, and Production Cost totals appear only when the business package includes the corresponding module.
- Expense, stock adjustment/recovery, transfer shipping, and type-of-service totals appear when their modules are enabled in Business Settings > Modules, or when there is a report-period amount greater than zero.
- Shipping, additional-expense, invoice-discount, ledger-discount, and reward totals appear when their related Business Settings options are enabled, or when there is a report-period amount greater than zero.
- Ledger Discount 2 and Ledger Discount 3 totals appear separately for suppliers and customers when enabled, or when the report-period amount is greater than zero, using the labels configured in Contact settings.
- Total Sell Round Off appears when Amount Rounding Method is enabled, or when the report-period round-off amount is nonzero.

📸 *[Screenshot: The Profit & Loss report showing totals and net profit]*

> 💡 **Tip:** Run this report monthly to track your business health over time.

### Purchase & Sell Report

A combined view of all purchases and sales, with totals and difference calculations. Useful for getting the big picture.

---

## Sales Reports

### All Sales Report (Sale Invoices)

A list of every sale with:
- Invoice number, date, customer, total, payment status
- Filter by date, customer, payment status, or location

### Product Sell Report

See which products are selling and how much:
- Product name, quantity sold, total revenue
- Filter by product, category, brand, or date range

### Sell Payment Report

#### 1. Module Overview

The Sell Payment Report shows payments linked to customer transactions, with Summary, Customer Summary, and Detail tabs.

#### 2. Purpose of the Feature

Use the report to review and reconcile customer payments, compare totals by payment method or customer, and narrow results to transactions created by a particular user.

#### 3. User Access / Permissions

Users need the **View Sell Payment Report** permission. Users with location restrictions only see payments from their permitted Business Locations.

#### 4. Step-by-Step Usage Instructions

1. Open **Reports** from the left sidebar.
2. Select **Sell Payment Report**.
3. Optionally choose a User, payment location, payment method, customer, transaction location, customer group, or date range. **All Users** is selected by default.
4. Open **Summary**, **Customer Summary**, or **Detail** to view the results in the format you need.
5. Use the print button on the active tab to print or export that tab with the same filters.

#### 5. Field Descriptions

| Field | Type | Explanation |
|---|---|---|
| User | Dropdown | Limits results to transactions created by the selected user. **All Users** includes transactions created by any user. |
| Payment Location | Dropdown | Limits results to the Business Location where the payment was recorded. |
| Payment Method | Dropdown | Limits results to a selected payment method. |
| Customer | Dropdown | Limits results to a selected customer. |
| Transaction Location | Dropdown | Limits results to transactions from a selected Business Location. |
| Customer Group | Dropdown | Limits results to customers in a selected group. |
| Date Range | Date range | Limits results to payments within the selected dates. |

#### 6. Business Logic / Workflow

The selected User is matched against the user who created the underlying transaction. The filter is applied consistently to the detail list, both summary tabs, and printed or exported reports. When **All Users** is selected, the report retains its existing unfiltered-by-user behavior.

#### 7. Notes or Important Considerations

- The User filter defaults to **All Users**.
- Existing report access and permitted-location restrictions still apply.

### Sales Analysis

Compare sales across time periods, products, or locations to spot trends.

### Customer Sale by Categories

#### 1. Module Overview

The Customer Sale by Categories report shows each customer's sales grouped by product category, with one column for each month in the selected date range.

#### 2. Purpose of the Feature

Use the report to compare monthly category sales across customers and identify changes in buying patterns.

#### 3. User Access / Permissions

Users need the **Customer Sale by Categories Report** permission. Users with location restrictions only see sales from their permitted Business Locations.

#### 4. Step-by-Step Usage Instructions

1. Open **Reports** from the left sidebar.
2. Under **Sales Reports**, select **Customer Sale by Categories**.
3. Choose a start date and end date. The report creates one column for each month touched by this date range.
4. Optionally select a Business Location, customer, or product category.
5. Select **Apply Filters** to view the results.

#### 5. Field Descriptions

| Field | Type | Explanation |
|---|---|---|
| Start Date | Date | First date included in the report. |
| End Date | Date | Last date included in the report. |
| Business Location | Dropdown | Limits the report to a permitted Business Location. |
| Customer | Dropdown | Limits the report to one customer. |
| Category Filter | Dropdown | Limits the report to one product category. |
| City | Text | City recorded on the customer contact. |
| Shop Name | Text | Customer business name, or the contact name when no business name is set. |
| Number | Text | Customer mobile number. |
| Category | Text | Product category assigned to the sold item. |
| Month columns | Amount | Net sales value for that category and customer during the month. |

#### 6. Business Logic / Workflow

Sales and linked sale returns are grouped by customer, product category, and transaction month. Sale returns reduce the amount for their month. The report uses the product's category and the customer's saved contact details.

#### 7. Notes or Important Considerations

- A date range that starts or ends partway through a month still displays the full month column, but only transactions inside the selected dates are included.
- Negative monthly amounts are displayed in parentheses. A dash means there were no net sales for that month.

### Trending Products

Discover your best-selling products over any time period. Use this to make sure you always have popular items in stock.

📸 *[Screenshot: The Trending Products report showing top sellers]*

---

## Purchase Reports

### Product Purchase Report

See what you've been buying:
- Product name, quantity purchased, total cost
- Filter by supplier, category, or date

### Purchase Payment Report

Track all payments made to suppliers:
- Payment date, amount, method, reference

---

## Stock Reports

### Stock Report

The most important stock report — shows current stock levels for every product:
- Product name, SKU, current stock, stock value
- Filter by location, category, brand

📸 *[Screenshot: The Stock Report with location filter]*

### Stock Value Report

Shows the total financial value of your stock — useful for accounting and insurance.

### Stock Reorder Report

Lists all products that are below their reorder level and need to be restocked.

### Stock Expiry Report

Shows products approaching or past their expiry date. Only available if expiry tracking is enabled.

### Lot Report

Track products by lot/batch number — see which batch went to which customer.

### Stock Adjustment Report

View all stock adjustments, including the reason and value of each.

### Stock Transfer Report

Track all transfers between your locations.

---

## Expense Reports

### Expense Report

See all your business expenses:
- Broken down by category with totals
- Filter by date range, category, or location
- See trends in your spending

📸 *[Screenshot: The Expense Report with category breakdown chart]*

---

## Tax Reports

### Tax Report

Summary of all tax collected and paid:
- Tax collected on sales (output tax)
- Tax paid on purchases (input tax)
- Net tax payable or refundable

> 💡 **Tip:** Use this report when filing your tax returns. It gives you all the numbers you need.

### GST Reports (India)

If you're in India with GST enabled:
- **GST Sales Report** — Sales with GST breakdown
- **GST Purchase Report** — Purchases with GST breakdown

---

## POS Reports

### Register Report

#### Module Overview

The Register Report lists cash register sessions and summarizes their opening cash, payments, and closing differences.

#### Purpose of the Feature

Use the report to review register activity and compare the counted cash, card, and bank transfer amounts with the amounts expected by the system.

#### User Access / Permissions

Users need the **Register Report** permission. Users with location restrictions only see register sessions from their permitted Business Locations.

#### Step-by-Step Usage Instructions

1. Open **Reports** from the left sidebar and select **Register Report**.
2. Optionally filter by Business Location, User, register Status, or Date Range.
3. Review each register session's opening cash and payment totals.
4. For a closed register with cash denominations recorded, review **Net Difference** immediately after **Total**.

#### Field Descriptions

| Field | Type | Description |
|---|---|---|
| Business Location | Dropdown | Limits the report to one Business Location available to the user. |
| User | Dropdown | Limits the report to registers opened by the selected user. |
| Status | Dropdown | Limits the report to open or closed registers. |
| Date Range | Date range | Limits results by the register's opening date. |
| Advance Payments | Amount | Shows advance payments recorded for each register. |
| Net Sales | Amount | Shows paid sales plus credit sales minus sales returns. |
| Net Difference | Amount | Shows the difference between counted and expected cash, adjusted for card and bank transfer differences. |

#### Business Logic / Workflow

The report displays payment columns in the order configured on the Business Location page and only shows payment methods enabled for the selected location. **Cash Skimmed** appears when Cash Skim Protection is enabled in Business Settings. The footer totals opening cash, cash skimmed when enabled, payment methods, advance payments, Net Sales, and Net Difference for the displayed page. **Net Sales** is calculated as paid sales plus credit sales minus sales returns, matching Cash Register details. **Net Difference** follows the Cash Register details calculation: counted cash minus expected cash, plus any card and bank transfer differences.

#### Notes or Important Considerations

- **Net Difference** is blank until cash denomination counts are recorded for the register.
- When no single Business Location is selected, payment columns appear if the method is enabled at any location the user can access.

### Sales Representative Report

#### Module Overview

The Sales Representative Report shows sales performance by staff member, customer, and commission assignment. Its tabs include sales, sales with commission, and product summaries.

#### Purpose of the Feature

Use the report to review sales activity for a selected customer or customer group and to distinguish sales assigned to Commission Agent and Commission Agent 2.

#### User Access / Permissions

Users need the **Sales Representative Report** permission. Users with location restrictions only see activity from their permitted Business Locations.

#### Step-by-Step Usage Instructions

1. Open **Reports** from the left sidebar and select **Sales Representative Report**.
2. Optionally choose a Business Location, user, date range, customer, customer group, Commission Agent, or Commission Agent 2.
3. Optionally narrow the results by the product filters shown for your business.
4. Review the Sales, Sales with Commission, Product Summary, or Product Detailed tab. The selected customer, group, and commission-agent filters are applied to the sales-related results.
5. Clear a filter or choose **All** to include all values for that filter.

#### Field Descriptions

| Field | Type | Description |
|---|---|---|
| Business Location | Dropdown | Limits results to a Business Location the user can access. |
| User | Dropdown | Limits results to sales created by or assigned to the selected representative. |
| Date Range | Date range | Limits results to sales within the selected dates. |
| Customer | Dropdown | Limits results to sales for one customer. |
| Customer Group | Dropdown | Limits results to customers in one group. |
| Commission Agent | Dropdown | Limits results to sales assigned to the selected Commission Agent field. |
| Commission Agent 2 | Dropdown | Limits results to sales assigned to the Commission Agent 2 field. |
| Category and related product filters | Dropdowns | When enabled, limits results by product category, brand, gender, or procurement source and their subcategories. |
| City | Dropdown | Limits results to customers in the selected city. |

#### Business Logic / Workflow

Customer and customer-group filters use the customer on each sale. The Commission Agent filter matches the sale's first commission-agent assignment; Commission Agent 2 matches its second assignment. When more than one filter is selected, a sale must satisfy all selected filters. These filters update the sales totals and the Sales, Sales with Commission, Product Summary, and Product Detailed results.

#### Notes or Important Considerations

- The two commission-agent filters are independent; selecting both narrows results to sales matching both assignments.
- Commission-agent choices include business users so they cover the commission assignment modes configured for the business.
- Blank filters do not restrict results.

### Service Staff Report

Track performance of service staff (restaurant/hospitality).

### Table Report

For restaurants — see revenue and order counts by table.

---

## Other Reports

### Activity Log

Track who did what in the system:
- User actions (login, create, edit, delete)
- Timestamp and details
- Useful for security and auditing

### Contacts Report

Summary of customer and supplier accounts — total sales/purchases, outstanding balances.

### Customer Groups Report

Performance breakdown by customer group (e.g., retail vs. wholesale).

---

## How to Export Reports

Most reports include export buttons at the top:

| Button | What It Does |
|---|---|
| **Excel** | Downloads the report as an Excel spreadsheet |
| **CSV** | Downloads as a simple text file (comma-separated) |
| **PDF** | Downloads as a formatted PDF document |
| **Print** | Opens the print dialog for your printer |
| **Column Visibility** | Show or hide specific columns |

📸 *[Screenshot: The export buttons at the top of a report]*

---

## Settings & Options

| Setting | What It Does | Where to Find It |
|---|---|---|
| **Date Range Defaults** | Set default time periods for each report type | **Settings → Business Settings → Date Range** |
| **Financial Year Start** | When your financial year begins | **Settings → Business Settings → Business** |
| **Reports Module** | Enable or disable the Reports feature | **Settings → Business Settings → Modules** |

---

## Common Questions

**Q: Why are some reports empty?**
A: Check the date filter — it might be set to a period with no transactions. Also, make sure you have the right permissions to see report data.

**Q: Can I schedule automatic reports?**
A: Currently, reports are available on-demand. Export them regularly and save for your records.

**Q: Who can see reports?**
A: Only users with the "Reports" permission can access the Reports section. Administrators control this through role-based permissions.

---

## Tips & Best Practices

- 📌 Review **Profit & Loss** at least monthly to track business health
- 📌 Check **Trending Products** weekly to keep top sellers in stock
- 📌 Use the **Stock Reorder Report** to create your next purchase order
- 📌 Export the **Tax Report** before each tax filing deadline
- 📌 Review the **Activity Log** if you suspect any unusual activity
- 📌 Use **date range filters** to compare performance across months or years