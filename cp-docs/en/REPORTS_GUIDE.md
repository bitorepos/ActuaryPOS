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

### Monthly Sales V/S Stock Closing Report

Use this report to compare each stock-enabled product's daily sale quantity with its end-of-day stock quantity for every date in a selected month.

Filter by month, business location, product category, subcategory, and subcategory 2. The table includes SKU, product name, category, unit, **Opening Stock** carried forward from the previous month, and the existing daily stock columns with an adjacent **Sale Qty** column for each date. A footer totals the numeric columns. Search, page-size, export, print, and column visibility controls are available above the table. The final stock column remains labeled **Closing Stock**. The report is available under **Reports → Sales Reports**.

The **Show 0 Sales** checkbox is off by default, so products without sales in the selected month are hidden. Turn it on to include those products.

### Monthly Deliveries V/S Stock Closing Report

Use this report to review delivered quantities and the on-hand, held, and combined stock balance for each day in a selected month. It has the same month, location, category, subcategory, and subcategory 2 filters as the monthly sales report. Daily stock is shown as **On Hand + Held = Balance**. The report appears under **Reports → Stock Reports** when **Enable Delivery Notes** is enabled in Business Settings.

The **Show 0 Delivery** checkbox is off by default, so products without delivery quantity in the selected month are hidden. Turn it on to include those products.

### Summary Income Report

#### 1. Module Overview

The Summary Income Report brings sales totals, cash totals, and service sales analysis together for a selected period.

#### 2. Purpose of the Feature

Use this report to review net sales, returns, discounts, tax, service charges, cash received, and the difference between expected and received cash.

#### 3. User Access / Permissions

Users need the **View Summary Income Report** permission. Location-restricted users only see information from their permitted Business Locations.

#### 4. Step-by-Step Usage Instructions

1. Open **Reports** from the left sidebar and select **Summary Income Report**.
2. Optionally select a Business Location, User, and start and end dates.
3. Select **Apply Filters** to refresh the summary.
4. Select **Print A4** to open the report preview. Use its page, print, PDF, or Excel controls as needed.
5. Select the thermal print action when you need the existing 80mm receipt layout.

#### 5. Field Descriptions

| Field | Type | Explanation |
|---|---|---|
| Business Location | Dropdown | Limits the report to a selected location that the user is permitted to access. |
| User | Dropdown | Limits report transactions and register totals to the selected user. |
| Start Date | Date | First date included in the report period. |
| End Date | Date | Last date included in the report period. |
| Print A4 | Button | Opens an A4 preview for the filtered report, with print, PDF, and Excel actions. |
| Thermal Print (80mm) | Button | Prints the report using the existing receipt-width layout. |

#### 6. Business Logic / Workflow

Sales Summary shows sales, returns, gross sales, discounts, sales tax, service charges, and net sales. Cash Details shows cash, card and credit sales, opening cash, receivable cash, cash received, and the difference. Service Sales Analysis appears when service breakdown data is available. The A4 preview uses the same calculated report data and selected filters as the on-screen report.

#### 7. Notes or Important Considerations

- The report remains subject to existing report permissions and location restrictions.
- PDF output uses the browser print dialog; choose **Save as PDF** in the print dialog to save a PDF.
- The thermal print action remains separate from the A4 preview.

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

Product-level profit uses the tax-exclusive selling value minus the product's configured **Default Purchase Price (Exc. tax)** across Product Sell Report tabs, the Profit & Loss **Profit by** section, and Product Stock History. Tax is reported separately and is not included in product profit.

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
- Review tax separately from the tax-exclusive sales subtotal across the report tabs.
- Product profit compares tax-exclusive sales and cost values; transactions without tax retain their existing amounts.

The Product Stock History report also shows sale tax separately. Sale returns reverse the related sale tax, and realized profit is calculated from tax-exclusive sale and cost values.

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
5. In the **Detail** tab, review **Customer (Payment)** after **Payment No.** and **Customer (Sale No.)** after **Sale No.** to compare the customer assigned to the payment with the customer assigned to the sale.
6. Select **SHOW ONLY MISMATCH CUSTOMER** to show payment references where the payment's assigned customer differs from the customer assigned to at least one linked sale.
7. Use the print button on the active tab to print or export that tab with the same filters.

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
| Customer (Payment) | Report column | Shows the contact assigned to the payment, immediately after Payment No. in the Detail tab. |
| Customer (Sale No.) | Report column | Shows the contact assigned to the sale, immediately after Sale No. in the Detail tab. |
| SHOW ONLY MISMATCH CUSTOMER | Checkbox | Filters the Detail tab to payment references whose assigned payment customer differs from a linked sale's assigned customer. |

#### 6. Business Logic / Workflow

The selected User is matched against the user who created the underlying transaction. The filter is applied consistently to the detail list, both summary tabs, and printed or exported reports. When **All Users** is selected, the report retains its existing unfiltered-by-user behavior.
The Detail tab shows payment and sale customers separately. The payment customer comes from the payment's assigned contact; the sale customer comes from the sale transaction's assigned contact.
The mismatch checkbox filters the Detail tab only. A payment reference is included when one of its linked sales has a different customer assigned to its payment and sale.

#### 7. Notes or Important Considerations

- The User filter defaults to **All Users**.
- Existing report access and permitted-location restrictions still apply.

### Sales Analysis

Compare sales across time periods, products, or locations to spot trends.

### Customer Sale by Categories

#### 1. Module Overview

The Customer Sale by Categories report shows each customer's sales grouped by product category, with all 12 months for the selected year.

#### 2. Purpose of the Feature

Use the report to compare monthly category sales across customers and identify changes in buying patterns.

#### 3. User Access / Permissions

Users need the **Customer Sale by Categories Report** permission. Users with location restrictions only see sales from their permitted Business Locations.

#### 4. Step-by-Step Usage Instructions

1. Open **Reports** from the left sidebar.
2. Under **Sales Reports**, select **Customer Sale by Categories**.
3. Select a year. The report displays January through December for that year.
4. Optionally select a Business Location, customer, or product category.
5. Select **Apply Filters** to view the results.
6. Use the table search and page-size controls as needed. Select **Print A4** above the table to open a paginated preview of the filtered and searched report. In the preview toolbar, select **PDF** to download the report as a PDF, or use **Print A4** to open the browser print dialog.

#### 5. Field Descriptions

| Field | Type | Explanation |
|---|---|---|
| Year | Dropdown | Shows the 12 monthly columns for the selected year. Available years include years with sales and the current year. |
| Business Location | Dropdown | Limits the report to a permitted Business Location. |
| Customer | Dropdown | Limits the report to one customer. |
| Category Filter | Dropdown | Limits the report to one product category. |
| Show entries | Dropdown | Starts at 25 rows per page; choose 25, 50, 100, 200, 500, 1,000, or All. |
| Search | Search field | Narrows the table and the A4 preview to rows matching the search text. |
| Export controls | Buttons | Export matching table data to available formats or change visible columns. |
| Print A4 | Button | Above the table; opens a paginated A4 preview with PDF download, Excel export, and browser print actions. |
| Address | Text | Customer contact address, including available address lines, city, state, country, and postal code. |
| Customer Name | Text | Business name for business contacts, or the contact name when no business name is set. |
| Contact ID | Text | Contact ID recorded on the customer record. |
| Category | Text | Product category assigned to the sold item. |
| Month columns | Amount | Net sales value for that category and customer during the month. |

#### 6. Business Logic / Workflow

Sales and linked sale returns are grouped by customer, product category, and transaction month. Sale returns reduce the amount for their month. The report uses the product's category and the customer's saved contact details.

#### 7. Notes or Important Considerations

- The Year filter defaults to the current year. All 12 months are shown, including months with no sales.
- Only sales and returns dated within the selected calendar year are included.
- Negative monthly amounts are displayed in parentheses. A dash means there were no net sales for that month.
- The preview includes all report rows and a per-month total on its last page.

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

### Product List Report

#### 1. Module Overview

The Product List Report displays product and variation details, categories, brands, units, supplier, stock, rack information, and record dates in a searchable table.

#### 2. Purpose of the Feature

Use this report to review your product catalogue and stock information, filter the list by product attributes, or print and export a complete filtered result.

#### 3. User Access / Permissions

Users need the **View Stock Report** permission. Users with location restrictions only see products associated with their permitted Business Locations. Product price visibility follows the existing stock-report price permission.

#### 4. Step-by-Step Usage Instructions

1. Open **Reports** from the left sidebar and select **Product List Report**.
2. Optionally filter by Business Location, category, brand, supplier, unit or sub-unit, and product status.
3. Use the table search to narrow the displayed products if needed.
4. Select **Print A4** to open a preview of the filtered and searched results.
5. In the preview, navigate pages and choose print, PDF, or Excel.

#### 5. Field Descriptions

| Field | Type | Explanation |
|---|---|---|
| Business Location | Dropdown | Limits the report to products assigned to the selected permitted location. |
| Category | Dropdown | Limits the report to products in the selected category. |
| Brand | Dropdown | Limits the report to products assigned to the selected brand. |
| Supplier | Dropdown | Limits the report to products with the selected default supplier. |
| Unit | Dropdown | Limits the report to the selected base unit. |
| Sub-unit | Dropdown | Limits the report to a sub-unit of the selected base unit. |
| Status | Dropdown | Shows active or inactive products. |
| Table Search | Search field | Narrows products using the table's searchable product fields. |
| Print A4 | Button | Opens a paginated preview and provides print, PDF, and Excel actions. |

#### 6. Business Logic / Workflow

The report uses the selected filters and the current table search to load all matching products in pages. The preview includes the available catalogue and stock columns, including variation names, locations, stock and rack details. Purchase and selling price columns are omitted for users whose existing permissions hide stock-report prices.

#### 7. Notes or Important Considerations

- The preview follows the same location access and price visibility rules as the report.
- The print preview fetches all matching pages, not only the rows currently loaded in the table.

### Held Quantity Report

#### 1. Module Overview

The Held Quantity Report compares held stock recorded at each Business Location with the quantity expected from sales that have not yet been delivered.

#### 2. Purpose of the Feature

Use the report to identify held quantity mismatches, review pending delivery notes and sales orders, and reconcile stored held quantities.

#### 3. User Access / Permissions

Users need the **View Stock Report** permission. Users with location restrictions only see data from their permitted Business Locations. Row-level or bulk synchronization actions continue to require their existing product-update permissions.

#### 4. Step-by-Step Usage Instructions

1. Open **Reports** from the left sidebar and select **Held Quantity Report**.
2. Optionally choose a Business Location and held status. Use the table search to narrow results further.
3. Select **Print A4** in the filter panel to open a preview of all matching rows.
4. Navigate the pages, then choose print, PDF, or Excel in the preview.
5. To reconcile stored values, use the existing row or bulk sync actions when permitted.

#### 5. Field Descriptions

| Field | Type | Explanation |
|---|---|---|
| Business Location | Dropdown | Limits the report to a permitted location. |
| Held Status | Dropdown | Shows all held or mismatched rows, mismatches only, matched rows with stored held stock, or rows with stored held stock. |
| Table Search | Search field | Narrows rows by searchable product, SKU, category, or location fields. |
| SKU | Report column | Variation SKU for the stock row. |
| Product / Variation | Report columns | Product and, when applicable, its variation name. |
| Current Stock | Quantity | Available stock at the Business Location. |
| Sold / Delivered Quantities | Quantities | Final sale quantity, delivered quantity, pending delivery-note quantity, and sales-order quantity. |
| Expected / Stored Held Quantity | Quantities | Expected held stock and the held quantity currently stored for the location. |
| Held Difference | Quantity | Stored held quantity minus expected held quantity. |
| Held Status | Status | Indicates whether the quantities match within the report's tolerance. |
| Print A4 | Button | Opens a paginated preview with print, PDF, and Excel actions. |

#### 6. Business Logic / Workflow

Expected held quantity is calculated as final sale quantity after returns minus quantities on processed delivery notes, with a lower bound of zero. Pending delivery notes and sales-order quantities are shown separately for reference. A row is marked mismatched when the difference is greater than the report's tolerance. The preview applies the same location, status, and table-search criteria as the report and totals quantity columns across all fetched rows.

#### 7. Notes or Important Considerations

- The preview includes all matching rows, not only the current DataTables page.
- Synchronizing held quantities changes stored inventory data; use the sync actions only when the expected quantity is correct.
- Quantity totals combine the displayed numeric values across matching rows, consistent with the on-screen report's total behavior.

### Held & Delivery History

Open a product's event history from the Held Quantity Report's **Product stock history** action, or from the Products list action menu. The report lists held sale quantities and completed delivery quantities for the selected location, with the running held balance.

Use **Sale Invoice No.** or **Delivery Note No.** to find matching events. When filtering by either reference, related held or delivery rows remain visible. Click a sale invoice number to open the sale details modal. Click a delivery note number to open its delivery details modal; the sale invoice number shown below it also opens the sale details modal.

Access requires **View Stock Report**, **View Product**, and **View Product Stock History** permissions, plus access to the selected Business Location.

### Stock Value Report

Shows stock value and movement across the **Summary**, **Details**, **Categorized**, and **Location Details** tabs. Use **Print A4** in the filter panel to open a preview of the selected tab with the current report filters.

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

### Cash Skim Report

#### Module Overview

The Cash Skim Report lists cash amounts removed from registers using the cash skim action.

#### Purpose of the Feature

Use the report to review when cash was skimmed, which register and Business Location it came from, and the user responsible.

#### User Access / Permissions

Users need the **Cash Skim Report** permission. Users with location restrictions only see cash skims from their permitted Business Locations.

#### Step-by-Step Usage Instructions

1. Open **Reports** from the left sidebar and select **Cash Skim Report**.
2. Optionally choose a Business Location, User, or Date Range.
3. Select **Print A4** to open a preview of all matching cash skim records and the columns currently shown.
4. Review the preview, then choose **Print A4**, **PDF**, or **Export to Excel**.

#### Field Descriptions

| Field | Type | Description |
|---|---|---|
| Business Location | Dropdown | Limits results to one Business Location available to the user. |
| User | Dropdown | Limits results to registers opened by the selected user. |
| Date Range | Date range | Limits results to cash skim transactions within the selected dates. |
| Date | Report column | Date and time when the cash skim was recorded. |
| Register | Report column | Register reference associated with the cash skim. |
| Location | Report column | Business Location associated with the register. |
| User | Report column | User who opened the register. |
| Open Time / Close Time | Report columns | Opening and closing times for the register session. Close Time is blank while the register is open. |
| Status | Report column | Whether the associated register is open or closed. |
| Amount | Report column | Amount of cash removed from the register. |

#### Business Logic / Workflow

The report includes cash register transactions recorded as cash-out using the cash payment method. The total at the bottom of the preview sums the matching cash skim amounts across all pages.

#### Notes or Important Considerations

- The print preview includes all matching records, not only the rows currently loaded on screen.
- The print preview follows the visible columns after applying the user's report column preferences.

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
4. Select **Print A4** to open a preview of the filtered report, including the columns currently shown for the selected location.
5. Review the preview, then choose **Print A4**, **PDF**, or **Export to Excel**.
6. For a closed register with cash denominations recorded, review **Net Difference** immediately after **Total**.

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
- The print preview includes all matching register sessions and follows the visible columns and payment labels for the selected location.

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
4. Review the Sales, Sales with Commission, Product Summary, Product Detailed, or Expenses tab. The Payments with Commission tab is also available when commission is calculated from payments.
5. Select **Print A4** on the tab you want to print. Each tab opens its own report preview and keeps the selected report filters.
6. In the preview, review the pages, then choose **Print A4**, **PDF**, or **Export to Excel**.
7. Clear a filter or choose **All** to include all values for that filter.

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
| Product Summary quantities | Report columns | Shows the unit in its own column, followed by SALES quantity and separate return quantities under Returns / Normal and Returns / Damage. |

#### Business Logic / Workflow

Customer and customer-group filters use the customer on each sale. The Commission Agent filter matches the sale's first commission-agent assignment; Commission Agent 2 matches its second assignment. When more than one filter is selected, a sale must satisfy all selected filters. These filters update the sales totals and the Sales, Sales with Commission, Product Summary, and Product Detailed results.

In the Product Summary tab, the UNIT column identifies the product's unit. Quantity columns show numbers only, without repeating the unit, and the Returns / Normal and Returns / Damage columns show returned quantities split by status.

#### Notes or Important Considerations

- The two commission-agent filters are independent; selecting both narrows results to sales matching both assignments.
- Commission-agent choices include business users so they cover the commission assignment modes configured for the business.
- Print A4 previews are separate for each report tab and include the complete filtered tab results, not only the rows currently visible on screen.
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
