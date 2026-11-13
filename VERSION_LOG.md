# Version Log

## 11 November 2026 - Offline Workstation Token Setup

- Offline Sync now reads and writes its workstation client secret and access token in the active host-specific environment file (for example `subdomains/.env.192.168.100.39`) when one is configured, instead of changing the root `.env` file.
- Workstation authorization now accepts Passport client secrets stored either as plain text or as a supported password hash, while still rejecting revoked clients.

## 11 November 2026 - Offline User List Download Sync

- Fixed cloud user downloads so users missing from an offline installation can be created even when that local installation has a smaller user quota. Cloud usernames are preserved as provided.
- Mapped the connector API's permitted-location and contact-number fields into the local user format, and kept role and location permissions with each imported user.
- User-list download now reports added, updated, and failed counts. It reports partial failures instead of showing a false success message.

## 11 November 2026 - Users List Processing Error

- Fixed the users DataTable crashing when a user's bank details are empty, malformed JSON, or stored as a non-object value. Valid bank fields continue to display safely.
- Corrected the Essentials department, sub-department, and designation join column references used by the users list.

## 10 November 2026 - Purchase, Order Request, POS, and Sales Form Updates

- **Purchase product details:** When enabled in Business Settings, purchase create/edit product rows let users review or update each location's Rack, Row, and Position details, and edit the product's PCT/HSN Code. Saved rack details are reflected on the product record for that purchase location; saved PCT/HSN changes update the product.
- **Purchase from Sales Invoices:** Business Settings > Purchase now has an option to load products from sales invoices. When enabled, purchase create/edit can select finalized sales invoices from any business location and add their lines to the purchase.
- **Contact Order Requests:** The contact portal's suggested-product cards show the contact's customer-group percentage or selling-group price. Each card has an **Add to Cart** button, and configured product gallery images open in a navigable image viewer.
- **Gross Profit visibility:** Both Gross Profit % and Gross Profit amount on sale create/edit are controlled by the user's **Show Total Profit** setting. When the POS module is enabled, that option is in POS settings; when POS is disabled, it is available under Sales settings. The amount includes the business currency symbol.
- **POS Quick Menu:** Default placeholder product images are omitted from quick-menu tiles. Tiles without a real image use the space for readable product text.

## 9 November 2026 - Catalogue My Orders Customer Details

The public Product Catalogue's **My Orders** modal now displays the order customer's name and contact number above the order list. Details saved with the order are used first, with the browser's saved customer details as a fallback.

## 9 November 2026 - Domain-Aware Public Downloads

CMS Download Buttons now accept either an external URL or a file name such as `ActuaryPOS-Pro.apk`. File names resolve from the active installation's `public/downloads` folder when it exists; otherwise they resolve from the primary domain configured by the root `.env` `APP_URL`. The Hardware Setup installer button follows the same fallback. This supports separate domains and subdomains without hardcoding a product domain or hosting-panel directory.

## 8 November 2026 - Location-Specific Dojo Accounts

Dojo API keys are saved per business location through Business Settings > Sales. Payment creation, status polling, refunds, cancellations, and terminal lookup now use the selected transaction or location's key. The terminal picker is scoped to the location being edited. Legacy business-wide keys continue to apply to the primary location only and are not inherited by other locations.

## 8 November 2026 - Held & Delivery History Transaction Links

Added clickable sale invoice and delivery note numbers to the product's Held & Delivery History report. Each reference opens its existing transaction detail modal, including the sale invoice linked beneath a delivery note. Fixed a Blade namespace syntax error that caused the history page to return a 500 error.

## 6 November 2026 - Selling Price Group Percentage Rules

Selling price groups can now use a fixed price, an increase percentage, or a decrease percentage. Percentage prices are derived from each product variation's default selling price including tax, and are calculated wherever group prices are used, including product views, POS, and purchase entry. Percentage-based prices are calculated dynamically; fixed group prices remain editable. The decrease percentage must be below 100%.

## 6 November 2026 - Purchase Entry Group Price Support

Purchase create and edit product rows now display configured selling-price group values, including dynamically calculated percentage groups. Dynamically calculated values are not saved over the product's stored fixed group prices when a purchase is edited.

## 6 November 2026 - Recent Workflow Updates

- **Purchase Returns:** The edit form restores the transaction number, matches the create form's product-table alignment, centers the Submit/Update actions, and supports the inline tax selector and expiry-date picker.
- **Expenses:** Expense status uses **Approved** in place of **Final**, includes **Rejected**, and create/edit forms provide a second expense note field.
- **Delivery Notes:** Create/edit forms support transaction-date selection. User Sales settings control whether staff may set a delivery-note transaction date and transaction number; the transaction-date permission is enabled by default for newly registered businesses.
- **Purchase Group Prices:** Purchase create/edit product tables can show configured group prices, and the Unit Cost heading opens a group selector to apply matching group prices to eligible rows.
- **Public Quotations:** Public pricing-page quotations show Home, Pricing, and Demo links for the deployed site, while authenticated quotation views do not show those public navigation links. Quotation numbering uses the location prefix, with **QU** as the default for new businesses and an existing-business migration available.
- **POS Product Tiles:** Product images are displayed on the POS type-button and suggestion-product views when an image is configured.
- **Payment Forms:** Payroll payment forms use the business location's default payment account. Contact is excluded as a payment method for supplier and purchase payments and remains available for contact-to-contact payments.

FBR Digital Invoicing sales-return behavior discussed for investigation is not recorded here as an implemented feature.

## Version 8.99.9

**Release Date:** 2026-10-27

### Module: Contact Ledger

#### New Features
- None

#### Improvements
- None

#### Bug Fixes
- Fixed ledger account-summaries so the carried-forward balance is included once when calculating the current balance, preventing all-time contact ledger totals from inflating far beyond the current customer balance when the date range is widened.

#### UI / UX Changes
- None

#### Technical Updates
- Normalized ledger balance calculations across ledger formats to keep summary totals aligned with the running balance rows.

## 31 October 2026 - Customer Zero Balance Filter and Row Colors

The customer list's **Hide Zero Balance** filter now evaluates the final net balance at the business currency precision, including balances that offset one another. Customers whose displayed balance rounds to zero are hidden, and zero balances are no longer colored as debit or credit due to a fractional remainder.

## 31 October 2026 - Contact Ledger Duplicate Payment References

Prevented payment entries from different transactions or return directions from merging just because their reference numbers match. The all-time customer ledger running balance now stays consistent with the customer index and ledger totals.

## 31 October 2026 - Monthly Delivery Report Alternating Date Pair Colors

Apply the same pale green to both columns for odd-numbered dates and the same pale blue to both columns for even-numbered dates, including headers, data rows, and totals.

## 31 October 2026 - Monthly Delivery Report Row-Level Stock Tooltips

Daily stock-balance cells now show the row's On Hand, Held Quantity, and Balance values in their tooltip.

## 31 October 2026 - Monthly Delivery Report Column Colors

Colored daily **Delivery Qty** columns and date stock-balance columns differently, consistently across headings, data, and totals.

## 31 October 2026 - Monthly Delivery Report Stock Formula Tooltip

Added a tooltip to each daily stock heading explaining that its value is On Hand + Held Quantity = Balance.

## 31 October 2026 - Monthly Delivery Report Date Attribution

Use a delivery note's creation date consistently for its daily Delivery Qty and held-stock reduction. Status updates made later no longer shift the delivery to a later report day.

## 29 October 2026 - Keep Open Register Totals in Sync with Sale Payment Changes

Reconcile finalized sale payments with saved entries whenever an open register is viewed, so stale sale/change-return rows are repaired automatically. Payment edits rebuild the sale's entries, and deleting a change-return matches its signed negative amount. Closed registers are not modified.

## 29 October 2026 - Register Report 404

Removed an accidental dependency on the Delivery Notes setting from Register Report. Users with the Register Report permission can now open the report regardless of whether delivery notes are enabled.

## 29 October 2026 - ZATCA Invoices DataTable Controls

Added page-length selection (including **All**), search, and CSV, Excel, Print, column-visibility, and PDF controls to the ZATCA Invoices list. Adjusted the table container spacing so the controls and data table have consistent margins.

## 29 October 2026 - Project Expense Status Modal Layering

Fixed the Update Status dialog on Project Expenses so it displays above the page backdrop and remains readable and interactive.

## 27 October 2026 - Show Zero Sales Filter

Added an unchecked **Show 0 Sales** filter to the Monthly Sales V/S Stock Closing Report. With the option off, products without sales in the selected month are hidden; enabling it includes them.

## 27 October 2026 - Show Zero Delivery Filter

Added an unchecked **Show 0 Delivery** filter to the Monthly Deliveries V/S Stock Closing Report. With the option off, products without delivery quantity in the selected month are hidden; enabling it includes them.

## 27 October 2026 - Monthly Deliveries V/S Stock Closing Report

Added a Stock Reports report using delivery notes, with the same month/location/category filters as the monthly sales report. Each date shows Delivery Qty and On Hand + Held = Balance; the report is available when Enable Delivery Notes is enabled.


## 27 October 2026 - Rename Monthly Sales V/S Stock Closing Report

Renamed the report, moved its sidebar entry under **Reports → Sales Reports**, updated its link to `/reports/monthly-sales-v-s-stock-closing-report`, and kept the former URL redirecting to the new link.

## 24 October 2026 - Product Index Group Selling Price Filter

Added a Group Selling Price dropdown to Product Index filters. Selecting an authorized selling price group limits products to those with a configured price in that group across the product list, variable product view, and stock tab.

## 24 October 2026 - Installment Plan Edit Button Caption

Changed the Edit Installment Plan modal's submit button caption from Save to Update.

## 24 October 2026 - Installment Plan Save Feedback

Show validation or request errors when saving an installment plan fails, and re-enable Save so the user can correct the form and submit again.

## 24 October 2026 - Installment Interest Rate Default

Set the Interest Rate field to default to 0 when adding an installment plan and display 0 for existing plans with no saved rate.

## 24 October 2026 - Installment Plan Modal Scrolling

Widened Add/Edit Installment Plan dialogs and constrained scrolling to the body so the header and action footer remain visible. The body can scroll horizontally and vertically when its content needs more room.

## 24 October 2026 - Installment Plan Modal Layering

Removed the installment page's lower inline modal z-index so the plan dialog renders above the shared backdrop layer and remains readable and interactive.

## 24 October 2026 - Gate Warehouse Transfers in Product History

Hide Warehouse Transfer in/out summary rows, history rows, and Type filter options unless the Warehouse module is installed and the business subscription includes `warehouse_module`.

## 24 October 2026 - Restore FIFO Costing in Stock History

Removed the override that replaced FIFO-linked sale and return costs with the product's current default purchase price. Stock history profit now uses each transaction's linked FIFO purchase cost, normalized exclusive of GST, with the existing fallback only when no transaction cost is available.

## 24 October 2026 - Booking Reminder Button Caption

Changed the booking reminder's **Close** button caption to **Completed**.

## 24 October 2026 - Preserve Blank Booking End Time

Booking End Time now remains blank when omitted and is stored as nullable. In-app reminders for bookings without an end time become due at the start time and remain available until dismissed or the booking status changes. Recurring bookings without an end time also trigger reminders from their scheduled start.

## 24 October 2026 - Booking Recurrence and In-App Alarms

Added repeat and in-app alarm controls to booking create/edit forms. Repeating bookings support daily, weekly, day-of-month, monthly, and yearly schedules and appear as occurrences on the bookings calendar; alarms include recurring occurrences and can be disabled per booking.

## 24 October 2026 - Slim Invoice Zero Balance Rows

Updated the Slim invoice receipt to hide the Previous Balance and Total Due rows when their values round to zero at the business currency precision. This applies to invoices using layouts configured through both create and edit.

## 24 October 2026 - Purchase Invoices Report

Added **Purchase Order** as a Type filter option in the Purchase Invoices Report. Selecting it filters the report's totals, summary, detailed rows, and print output to purchase-order transactions.

## 24 October 2026 - Past Period Reorder Report

Added **Past Period Reorder Report** under Stock Reports with location, supplier, category, brand, SKU range, date range, and days-of-cover filters. It displays SKU, product, rack information, current stock, net quantity sold, period length, average demand for the selected cover period, outstanding purchase-order quantity, and suggested reorder quantity. Days of cover defaults to 7; suggested reorder quantity is cover-period demand less open order quantity, with a minimum of zero.

The **No of Days** column and the average-demand column reflect the selected Days of Cover value; the average column heading updates to match the selected number of days.

Added an unchecked **Show Zero Sold Qty** filter; zero-sales products are hidden until it is selected.

All quantity columns in the report now follow the business's configured Quantity decimal precision.

Changed the date filters to a single date-range picker with the standard preset ranges and custom range selection.

Loaded the shared report date-picker script and set its default selection to **Last 30 Days**, fixing the blank date field.

Right-aligned the report's numeric quantity columns.

Fixed DataTable text search by excluding the calculated Qty Sold field from searchable columns.

The suggested Reorder Qty is rounded to the nearest whole unit after subtracting on-order quantity. On-hand stock remains visible for reference and does not reduce this value.

Fixed a Blade namespace escaping error that caused the report page to return a server error.

## 24 October 2026 - Delivery Note Quantity Footer

Fixed the Delivery Note products table footer so quantity totals are formatted and displayed as values with their units, rather than showing the formatter expression.

The Delivery Note products table now shows SKU in its own column before Product Name.

## 22 October 2026 - Dashboard Account Balances

Added a Payment Accounts section to the home dashboard for users with account access. The table shows each active account's name and balance, with a footer total and a link to the Accounts page.

The Accounts dashboard card now occupies the WooCommerce Orders card's former position beside Income Summary. WooCommerce Orders is placed where Accounts appeared before and remains limited to businesses whose package or subscription includes `woocommerce_module`.

Fixed the dashboard card heading to use the existing Payment Accounts language caption.

## 22 October 2026 - POS Multi-Payment Keyboard Entry

The POS multi-payment dialog now accepts keyboard input in the focused payment amount field, including after opening it with Shift+P. The field is focused and selected when the dialog opens, and the on-screen keypad remains available.

## 22 October 2026 - Monthly Sales V/S Stock Closing Report

Added a stock report with month, business location, category, subcategory, and subcategory 2 filters. It shows each product's SKU, name, category, unit, and **Opening Stock** (the previous month's closing quantity), followed by a **Sale Qty** column alongside each daily stock column; the final stock column remains labeled **Closing Stock**. A footer totals the numeric columns, and the table includes search, page-size, export, print, and column visibility controls.

## 22 October 2026 - Rental Agreement Workflow and Reporting Corrections

Rental agreements now use the signed-in user's default business location when available. The customer field supports searching contacts and opening the contact form in a modal. The agreement form shows the rental duration calculated from its selected start and end dates, and uses that duration for item lines. Editing an agreement now restores its saved location, dates, item names, rates, deposits, and totals. Saving a draft or updating an agreement returns to the Agreements list after success. The Agreements table keeps its action controls visible on narrow screens and places the Action column first.

Rental settings now include booking-style settings tabs and the Damage Report Prefix is set to **RD**. Rental invoice tax choices are sourced from the configured tax rates.

Profit figures in **Profit & Loss**, **Product Sell Report**, and **Product Stock History** use tax-exclusive selling values and tax-exclusive product costs. The Profit & Loss **Profit by** section, every Product Sell Report tab, and Product Stock History use the product's configured **Default Purchase Price (Exc. tax)** for sale and return costs. The Product Sell Report includes a separate Tax column across its tabs; Stock History shows sale tax separately and reverses it for sale returns. The Summary and Summary (Combo) tax cells now render as formatted values instead of displaying HTML markup.

The Sales Analysis page no longer fails when the hourly view has no submitted weekday filters; all weekdays are used by default.

## 20 October 2026 - Include HMS Bookings in Home Dashboard Sales

Active HMS bookings with **Pending** or **Confirmed** status now count toward the Home Dashboard's sales totals, revenue, recent transactions, sales charts, sales counts, income summary, user sales summary, and outstanding sales payment list. Booking payments appear in the sales payment method chart and income summary. Existing bookings with a missing transaction date use their creation date for dashboard reporting, and new bookings receive a transaction date. The selected date and location filters apply; cancelled bookings are excluded.

## 20 October 2026 - HMS Booking and Payment Improvements

Booking forms now use a clearer two-column layout, default the departure date to the next day, and provide four ID proof fields. Booking creation checks for a room or extra, a positive total, and customer credit-limit availability before saving.

You can record a booking with multiple payment rows, including an available customer advance deposit. The advance option is hidden when no deposit is available. Booking totals and balances now include all payment rows, and payment actions are available from the booking list and receipt.

The bookings list and other HMS indexes use compact row action menus. Check-in is available for bookings arriving today, including pending bookings. Booking reports can be printed from create and edit forms; closing the print dialog returns to the bookings list. The print layout uses more of the page width.

Housekeeping now marks assigned rooms as **Occupied** when a guest checks in and reflects existing active check-ins in its room list and status totals.

The same advance-payment availability behavior is available on the **Sell** create page.

Product stock history opened from **F10** product search now loads the selected variation's first location and loads each additional location when its tab is selected. The request URL follows the application's configured path.

## 29 September 2026 - Print the Sales Order Report on A4

The **Sales Order Report** can now be printed from both the **Summary** and **Details** tabs.

The printed report follows the filters selected on the screen, including the business location, customer, sales order status, delivery note status, date range, and time range. The preview also provides options to print on A4 paper, save a PDF, or export the report to Excel.

Customer names are now shown only once when the business name and contact name are the same. Report dates and times are also displayed clearly without unwanted formatting text.

To print the report:

1. Open **Reports > Sales Reports > Sales Order Report**.
2. Select the required filters and date range.
3. Open the **Summary** or **Details** tab.
4. Select **Print A4**.
5. Review the report, then choose **Print A4**, **PDF**, or **Export to Excel**.

## 29 September 2026 - Prevent Changes to Paid Sale Returns

Security roles now include a **Disable Update Sale Return when Paid** permission.

When this permission is selected for a role, users assigned to that role cannot edit a sale return after it has been fully paid. The **Edit** option is no longer shown for the paid sale return. Unpaid and partly paid sale returns can still be edited if the user has the normal sale return editing permission.

Administrators can still update paid sale returns when a correction is required.

To prevent a role from changing paid sale returns:

1. Open **User Management > Security Roles**.
2. Create a role or edit an existing role.
3. Open the **Sale Return** permissions section.
4. Select **Disable Update Sale Return when Paid**.
5. Save the role.

## 28 September 2026 - Clearer Purchase Invoice Tax Information

The **Purchase Invoices Report** now gives a clearer tax breakdown in the **Summary** and **Detailed** tabs.

In the **Summary** tab:

- Each tax has its own column using the name entered on the **Tax Rates** page.
- The total for each tax is shown at the bottom of its column.
- **Total (Exc. Tax)** now shows the amount before tax, while **Total (Inc. Tax)** shows the amount after tax.
- The transaction number can be selected to open the related purchase details without leaving the report.

In the **Detailed** tab, the yellow totals area now shows each tax by name with its amount, making it easier to check how the total tax is divided.

To review the updated report:

1. Open **Reports > Purchase Invoices Report**.
2. Select the required date range and filters.
3. Open the **Summary** tab to compare the before-tax total, individual tax amounts, and after-tax total.
4. Select a transaction number to view the purchase details.
5. Open the **Detailed** tab to review the named tax totals in the yellow totals area.

## 28 September 2026 - Customer Due Payments Match the Ledger Balance

The **Contact Payment** window now shows all invoice balances that make up a customer's final ledger balance, including any extra amount previously received from the customer.

For example, if an older invoice has an extra payment that fully covers the remaining amount of newer invoices, the window now shows that adjustment. The total due in the payment window will therefore match the customer's ledger balance.

To check a customer's due balance:

1. Open **Customers** and select the required customer.
2. Check the balance shown in the customer's ledger.
3. Select **Pay Due Amount**.
4. Review the invoices and any extra payment shown in the list.
5. Confirm that the final amount matches the ledger balance before entering a new payment.

When the extra payment fully covers the outstanding invoices, the final amount is shown as zero and no additional payment is required.

## 28 September 2026 - Kitchen Display Settings and Preparation Timers

The **Kitchen Display** now has its own tab under **Business Settings**. The following options are grouped there for easier setup:

- **Show Order Details Kitchen Screen**
- **Warn If Preparation Time Passed**
- **Mark as cooked button label**

The button label can be changed to wording that suits the kitchen team, such as **Ready**, **Prepared**, or **Complete**. Leaving the field blank keeps the normal **Mark as cooked** wording.

To change the Kitchen Display options:

1. Open **Settings > Business Settings**.
2. In **Location-based Settings**, select the required business location.
3. Open the **Kitchen Display** tab.
4. Choose whether order details and preparation-time warnings should be shown.
5. Enter the preferred **Mark as cooked button label**, or leave it blank to use the normal wording.
6. Select **Update Settings**.

### Live preparation countdown

When a product has a **Service staff timer/Preparation time (In minutes)** value, its remaining preparation time is shown beside the product on the Kitchen Display.

The timer counts down every second. After the allowed preparation time has passed, it continues as a negative time and changes to red, making overdue items easy to identify. For example, `-00:30` means that the item is 30 seconds overdue.

To use preparation timers:

1. Open the product create or edit page.
2. Enter the required **Service staff timer/Preparation time (In minutes)**.
3. Save the product.
4. Make sure **Show Order Details Kitchen Screen** is enabled in the **Kitchen Display** settings tab.
5. Open the Kitchen Display to view the live countdown beside ordered products.

The Kitchen Display also opens normally after these changes and continues updating its orders and timers automatically.

## 28 September 2026 - Easier Silent Printing for Receipts, KOT and Labels

### Receipt printer and print margins

The **Hardware Setup** page now shows the receipt printer and its print margins together. Each workstation can have its own left, right, top, and bottom margins.

The same margin choices are also available under **Business Location Settings > Workstations**. Changes made from either page are saved for the selected workstation and are used for the next receipt or kitchen ticket.

For most 80 mm thermal printers, start with a small margin such as:

- **Left:** 3 mm
- **Right:** 2 mm to 5 mm
- **Top:** 0 mm
- **Bottom:** 0 mm

Increase the right margin if wording is cut off at the right edge. Very large left and right margins make the printable area narrow. For example, 20 mm on both sides leaves only 40 mm for the receipt contents.

To set the receipt printer and margins:

1. Open **Settings > Hardware Setup**.
2. Select the correct business location and workstation.
3. Open the **Printers** tab.
4. Select the **Receipt printer**.
5. Enter the required left, right, top, and bottom margins.
6. Select **Save hardware setup**.
7. Complete a test sale and check the printed receipt.

Normal thermal receipts use the selected margins and 80 mm paper size. Full-page invoice designs continue to use their normal page layout.

### Silent receipt printing

When the ProSurface POS Hardware Service is connected and a receipt printer is selected, completing a sale sends the receipt directly to that printer. The browser print window is not shown.

If the service or selected printer is unavailable, the normal browser print window remains available as a backup.

### Better use of the page when printing from a browser

When the browser print window is used, Slim receipts now adjust to the width of the paper selected in the browser. Receipt details, product rows, totals, bank details, and terms and conditions are no longer restricted to a narrow strip on the left side of an A4 page.

Direct thermal printing continues to use the compact 80 mm receipt design. This keeps thermal receipts suitable for receipt printers while making browser-printed and PDF copies easier to read on larger paper.

To print from the browser:

1. Complete the sale and wait for the browser print window.
2. Select the required printer or **Save as PDF**.
3. Select the required paper size and orientation under the browser print settings.
4. Check that the preview uses the available page width.
5. Select **Print** or **Save**.

### Product-based KOT printers

Kitchen and bar printers are now selected from the **Printers** page and assigned to products. KOT printer choices are no longer entered on the Hardware Setup page.

To prepare KOT printing:

1. Open the **Printers** page.
2. Add or edit a printer.
3. Select the exact Windows printer name shown on the computer.
4. Save the printer.
5. Open the required products and assign them to that printer.
6. Complete a test order containing those products.

Each KOT is sent to the printer assigned to its products. For example, drinks can print at **BAR**, while food items can print at **KITCHEN**.

KOT printing continues to support all existing ways of working:

- The existing POS Print Server where it is already selected.
- The Web2Desk desktop application.
- The ProSurface POS Hardware Service in a normal browser.
- The browser print window when direct printing is unavailable.

### Silent barcode and price-label printing

Barcode and price labels can now print directly through the label printer selected in Hardware Setup.

To set it up:

1. Open **Settings > Hardware Setup**.
2. Select the correct business location and workstation.
3. Choose the required **Label printer**.
4. Select **Save hardware setup**.
5. Open **Products > Print Labels**.
6. Select the products and label design, then print the labels.

When the Hardware Service and label printer are ready, labels are sent directly to the selected printer without opening the browser print window.

### Selecting the correct Windows printer name

The printer create and edit pages can show printers detected on the current Windows computer. Select the exact printer name used by Windows to avoid sending a receipt, KOT, or label to the wrong device.

Printer names can still be entered manually when using a shared printer, a network printer, or an existing printing setup that is not listed.

### Printer choices stay with the correct website and workstation

Installing the ProSurface POS Hardware Service makes the printers on that computer available for selection, but it does not select or activate them automatically.

Printer choices from one website or business are not copied into another website when the same computer is used to sign in. A receipt or label printer is used only after it has been selected and saved for that workstation on the current website.

If no Hardware Setup has been saved for the current website and workstation, sales continue to use normal browser printing. Simply signing in or opening the Hardware Setup page does not turn on silent printing.

## 26 September 2026 - Easier F10 Product Search

The **F10 - Products Search** window is now taller, making it easier to view more products at once.

When the product list is wider or longer than the available space, scroll bars are shown so users can move left and right or up and down to view all product details.

### How to use it

1. Press **F10** to open the product search window.
2. Search for a product or use the available filters.
3. Use the scroll bars when more rows or columns are available.
4. Press **Esc** to close the product search window.

## 26 September 2026 - Product Stock History Loading

The **Product Stock History** page now finishes loading normally after the history appears. The loading bar no longer remains on the screen and makes the page look stuck.

If the history cannot be loaded within one minute, a clear message is shown instead of waiting indefinitely. Select a specific **Business Location** and try again when this happens.

### How to view product stock history

1. Open **Products > List Products**.
2. Find the required product and open its **Actions** menu.
3. Select **Product Stock History**.
4. Choose **All** to review every available location, or select one **Business Location** for a more focused view.
5. Use **Type** to show the required stock activity.

## 26 September 2026 - Stock Reindex and Background Task Notifications

### Stock quantity reindex

**Reindex Stock Quantities** now starts correctly when the application is opened from a local computer address.

To reindex stock quantities:

1. Open **Products**.
2. Select the **Stock Quantity Report** tab.
3. Select **Reindex Stock Quantities**.
4. Choose **Default** to update only quantities that need correction, or choose **All** to update every stock quantity.
5. Confirm the request when asked.
6. Open **Notifications** to follow the progress.

To stop a running reindex safely, select **Cancel Reindex**. The item currently being checked is completed first, and then the remaining work stops.

### Clearer progress notifications

The newest background task is now shown at the top of **Notifications**. Its current percentage and status are displayed so it is easier to see which task is active. When that task finishes, its completed result remains at the top as the latest update.

The status may show:

- **Pending** or **Queued** when the request is waiting to begin.
- **Processing** while the work is in progress.
- **Completed** when the work has finished successfully.
- **Cancelled** when the user stops the task.
- **Failed** when the task could not be completed.

Close and reopen the notification menu when you want to load the latest detailed progress.

### Successful completion message

When stock reindexing, transaction remapping, or sales synchronization finishes, a green success message is now shown automatically. The completed item remains available in **Notifications** for later review.

If more than one business workspace is used on the same computer, each task reports its progress in the workspace where it was started. An older **Completed** entry is the history of an earlier task and does not mean that the currently running task has finished.

## 26 September 2026 - Separate Sale Returns in Profit and Loss

The default **Chart of Accounts** now includes two return accounts:

- **Sale Returns** under **Income > Sales**
- **Returns Cost of Goods Sold - COGS** under **Cost of Sale > Cost of Goods Sold - COGS**

The **Profit and Loss** report now shows sales and sale returns separately. It also shows the normal cost of goods sold and the returned cost of goods sold separately.

Return amounts are shown with a minus sign so their effect on income, cost of sales, gross profit, and net profit is clear. The same information is shown on screen and in printed, PDF, and Excel copies.

The returned cost in **Profit and Loss** now matches the returned cost shown in the **Detailed** tab of the **Sale Invoices Report** when the same location and date range are selected. Older sale returns keep the cost recorded with the return, even if the product's purchase price changes later.

Sales with an invoice discount now show the same sales value in both reports. The full original cost of sold items remains under **Cost of Goods Sold - COGS**, while the cost of returned items is shown separately under **Returns Cost of Goods Sold - COGS**. This prevents a returned item from reducing the normal sales cost and then being counted again as a return.

Profit and Loss now follows the item totals shown in the Detailed Sale Invoices Report and counts completed invoices only. Draft or cancelled sales are not included. When a service or other non-stock item has a saved purchase cost, that cost is included so the Cost of Goods Sold total also matches the Detailed report.

### How to view it

1. Open **Reports > Sale Invoices Report**.
2. Select **Sale Returns**, open the **Detailed** tab, and choose the required location and date range.
3. Note the sale return value and returned cost.
4. Open **Accounting > Reports > Profit and Loss** and select the same location and date range.
5. Compare the Sale Invoices Report totals with **Sale Returns** and **Returns Cost of Goods Sold - COGS**.

If older figures need to be refreshed, open **Accounting > Transactions**, select **Remap All**, and wait for the completion notification before reopening the Profit and Loss report.

## 26 September 2026 - Remap All Accounting Transactions

The **Remap All** button in **Accounting > Transactions** now checks every transaction, including transactions that are not mapped and transactions that are already mapped. Existing mappings are refreshed using the current account choices.

### How to use it

1. Open **Accounting > Transactions**.
2. Select **Remap All**.
3. Confirm the message to begin.
4. Check the notification for progress and completion.

## 26 September 2026 - Default Manufacturing Accounts

The account choices for **Production** and **Reverse Production** are now filled automatically with **Stock Inventory** when no choices have been saved.

The following choices are filled automatically:

- **Production Credit:** Stock Inventory
- **Production Debit:** Stock Inventory
- **Reverse Production Credit:** Stock Inventory
- **Reverse Production Debit:** Stock Inventory

To review or change these choices:

1. Open **Accounting > Settings**.
2. Select the required business location.
3. Find **Manufacturing Module**.
4. Review the accounts under **Production** and **Reverse Production**.
5. Change an account when required and save the settings.

## 26 September 2026 - Employees List in the HRM Menu

The **Employees List** is now available from the **More** menu in HRM. This gives permitted users a quicker way to open and manage the employee list while working in HRM.

### How to open the employees list

1. Open **HRM**.
2. Select **More** from the top menu.
3. Select **Employees List**.

The employees page will open, where you can view and manage employees according to your access permissions.

## 26 September 2026 - Chart of Accounts Action Menu

The **Action** menu in **Accounting > Chart of Accounts** now opens fully after searching for an account. Options such as viewing the ledger, editing the account, and activating or deactivating the account are no longer hidden below the account list.

### How to use it

1. Open **Accounting > Chart of Accounts**.
2. Enter an account name in the search box.
3. Select the three-dot **Action** button beside the account.
4. Choose the required option from the complete menu.

## 26 September 2026 - Sell Payment Report Improvements

### Clearer totals and payment information

The **Sell Payment Report** is now easier to read and use across the **Summary**, **Customer Summary**, and **Detail** tabs.

- The **Detail** tab now shows the correct page total, including negative amounts such as sale returns and refunds.
- Customer names are no longer repeated when the business name and customer name are the same.
- The currency symbol is shown once in the **Amount** column heading instead of being repeated beside every amount.
- Amounts, payment counts, and footer totals are aligned to the right for easier comparison.
- The **Detail** tab search now finishes normally and shows matching payments without remaining on **Processing**.
- Printed, PDF, and Excel copies use the same clear Amount heading and number style.

### How to use the report

1. Open **Reports > Sell Payment Report**.
2. Select the required payment location, payment method, customer, transaction location, customer group, and date range.
3. Use **Summary** to review totals by payment method.
4. Use **Customer Summary** to review payment totals for each customer.
5. Use **Detail** to review individual payments or search by payment number, sale number, date, amount, payment method, or location.
6. Use **Print A4**, **Excel**, or **PDF** when a printed or saved copy is required.

## 26 September 2026 - Payroll Payment Access and Easier Viewing

### Wider payroll payment window

The **View Payments** window in **HRM > Payroll** is now wider. Payroll details, payment methods, notes, and action buttons are easier to review without unnecessary crowding.

To view payroll payments:

1. Open **HRM > Payroll**.
2. Find the required payroll record.
3. Open **Actions** and select **View Payments**.
4. Review the payment details or use an available payment action.

### Payroll payment permissions

Security roles now have separate permissions for payroll payments:

- **View Payroll Payments** — allows the user to open and review payroll payments.
- **Add Payroll Payments** — allows the user to record a payroll payment.
- **Edit Payroll Payments** — allows the user to change an existing payroll payment.
- **Delete Payroll Payments** — allows the user to remove a payroll payment.

To set payroll payment access:

1. Open **User Management > Security Roles**.
2. Create a role or edit an existing role.
3. Open the **Essentials** permissions section.
4. Under **Payroll**, select the payroll payment permissions required for that role.
5. Save the role.

Users only see and use the payroll payment options allowed by their role. Administrators continue to have full access.

### Automatic payroll entries in Accounting

New payroll records are now added to Accounting automatically, including payrolls created without a selected business location. The salary amount appears under **Payroll Expenses** and **Payroll Liabilities** without requiring the user to select **Map Transaction**.

When a salary is paid, the payment is also recorded automatically under **Payroll Liabilities** and the selected cash or bank account.

### Default payroll accounting settings

The payroll account choices in **Accounting Settings** are now filled automatically when no choices have been saved:

- **Payroll Credit:** Payroll Liabilities
- **Payroll Debit:** Payroll Expenses
- **Payroll Payment Credit:** Cash in Hand
- **Payroll Payment Debit:** Payroll Liabilities
- **Payroll Advance Payment Credit:** Cash in Hand
- **Payroll Advance Payment Debit:** Payroll Liabilities

When payroll or a payroll advance is paid through another payment method, the account linked to that payment method is used instead of **Cash in Hand**.

### Payroll advance payments

Advance payments entered from **HRM > Payroll > Advance Payments** now use the saved payroll advance account choices.

- A cash advance uses **Cash in Hand** and **Payroll Liabilities**.
- If another payment method is selected, its linked account is used instead of **Cash in Hand**.

To record an advance payment:

1. Open **HRM > Payroll**.
2. Open **Advance Payments**.
3. Add the employee's advance payment.
4. Select the payment method and save the payment.
5. Open the related accounts in **Accounting** to review the amount.

To review or change these choices:

1. Open **Accounting > Settings**.
2. Select the required business location.
3. Find **Payroll**, **Payroll Payments**, and **Payroll Advance Payments**.
4. Review the selected accounts and change them when required.
5. Save the settings.

Older payrolls and payroll payments that were still showing **Map Transaction** are added to the correct accounts automatically after this update.

### How to check payroll entries

1. Open **Accounting > Transactions > Payroll**.
2. Confirm that completed payrolls no longer show **Map Transaction**.
3. Open **Accounting > Transactions > Payroll Payments**.
4. Confirm that completed salary payments no longer show **Map Transaction**.
5. Open **Payroll Expenses**, **Payroll Liabilities**, or the payment account to review the amounts.

## 26 September 2026 - FBR POS ID and Token Setup

### Use the matching FBR details for each location

Every FBR-enabled business location must now have both an **FBR POS ID** and its matching **FBR Token**.

Each location uses only the token saved in its own location settings. A token belonging to another POS ID or an old disconnected POS should not be used.

If an FBR POS ID is entered without a token, the location cannot be saved until the correct token is provided. This helps prevent invoices from being sent with incorrect FBR details.

### How to enter the FBR details

1. Sign in to the FBR portal and find the active POS for the location.
2. Copy the **POS ID** and **Token** from the same active POS record.
3. Open **Business Locations** and edit the required location.
4. Enter the number in **FBR POS ID**.
5. Enter its matching token in **FBR Token**.
6. Save the location.

Do not enter the POS token in **FBR Digital Invoicing Token**. That field is for a different FBR service.

### How to confirm the connection

1. Create and complete a new test sale.
2. Open or print its invoice.
3. Confirm that the invoice shows an **FBR Invoice No.** and the correct **FBR POS ID**.
4. Search the FBR Invoice No. in the FBR portal when final confirmation is required.

If no FBR Invoice No. is received, check that the POS is active and that the POS ID and token were copied from the same FBR portal record.

## 26 September 2026 - Product by Sales Report Column Order

### Easier report reading

The **Product by Sales Report** now shows its columns in the following order:

1. Invoice No.
2. SKU
3. Date
4. Payment Method
5. Product
6. Category
7. Contact ID
8. Customer Name
9. Unit
10. Quantity
11. Unit Price
12. Total
13. Invoice Discount
14. Total Invoice Amount
15. Paid Amount
16. Due Amount

Amounts and quantities are aligned clearly for easier comparison. The same column order is used when viewing the report on screen, printing it, or saving it as an Excel or PDF file.

### How to view the report

1. Open **Reports > Sales Reports > Product by Sales Report**.
2. Select the required filters and date range.
3. Review the invoice, product, customer, and payment information from left to right.
4. Use **Print A4**, **Excel**, or **PDF** when a saved or printed copy is required.

## 24 September 2026 - Two Sales Commission Agents and Invoice Labels

### Two commission agents on one sale

A sale can now have two separate commission agents. **Commission Agent** and **Commission Agent 2** are selected independently and are saved against the same sale.

Both agent selections start blank when a new sale is created. Select an agent only when one is required. When editing a sale, each agent can be changed or cleared without changing the other agent.

The second agent is also included when viewing sales, filtering sales, checking agent access, and reviewing sales commission information.

### Commission agent settings

Open **Business Settings > Sales** to set up each commission agent separately.

The following choices are available for both agents:

- Choose whether the agent is selected from users, commission agents, or the logged-in user.
- Enter a custom label, such as **Order Booker**, **Sales Representative**, or **OT**.
- Choose whether commission is based on the invoice value or payment received.
- Choose whether selecting the agent is required before saving a sale.

The custom labels are shown on sale forms so each agent can be identified by the wording used by the business.

### Selecting agents on a sale

1. Open the POS sale or direct sale create page.
2. Select the first person from **Commission Agent**.
3. Select the second person from **Commission Agent 2** when required.
4. Complete and save the sale.
5. Open the sale later to review or change either agent.

The sale details window shows both agents on separate lines. Each line uses its own label from the selected invoice layout. When an invoice-layout label is blank, the custom label from Business Settings is used instead.

### Commission agents on sale returns

Sale return create and edit pages now show separate choices for **Commission Agent** and **Commission Agent 2**. Each choice uses its own custom label from Business Settings, and both agents are saved separately with the same sale return.

When creating a return from an existing sale, both selected agents are carried into the return.

### Invoice-layout labels for both agents

Invoice-layout create and edit pages now provide separate controls for:

- **Commission Agent Label** and **Show commission agent**.
- **Commission Agent Label 2** and **Show commission agent 2**.

These options allow the layout to use different wording for the two agents and decide whether each agent is shown on a Classic invoice.

To set the labels:

1. Open **Settings > Invoice Settings**.
2. Create an invoice layout or edit an existing layout.
3. Enter the required labels for Commission Agent and Commission Agent 2.
4. Select the **Show** checkbox beside each agent that should appear.
5. Save the invoice layout.

### Reference number visibility

A **Show Reference No.** checkbox is now available beside **Reference No. Prefix** on invoice-layout create and edit pages.

Select the checkbox to show the reference number and its prefix on the invoice. Clear the checkbox when the reference number should be hidden. Existing invoice layouts continue to show the reference number unless this option is cleared and the layout is saved.

### Faster Sales list

The Sales list has been improved so that sales records open without remaining on **Processing** for an extended period, including businesses with a large sales history.

## 24 September 2026 - Customer and Supplier List Reports

### Customer List Report

A new **Customer List Report** is available under **Reports > Sales Reports**.

The report can show **Customers** or **Barterers** and includes two tabs:

- **Summary:** Shows the contact ID, customer name, customer group, Credit balance, and Debit balance.
- **Customer Group:** Shows combined contact and balance totals for each customer group.

Balances are placed automatically in the correct Credit or Debit column according to the contact ledger. The currency symbol is shown in the column heading and is not repeated beside every amount.

The report can be filtered by business location, contact type, contact, and customer group. **Show Zero Balance** is unticked by default; select it when contacts with no outstanding balance are also required.

### Supplier List Report

A new **Supplier List Report** is available under **Reports > Purchase Reports**.

The report can show **Suppliers** or **Barterers** and displays:

- Contact ID.
- Supplier name.
- Debit balance.
- Credit balance.

Balances are placed automatically in the correct Debit or Credit column according to the contact ledger. The currency symbol is shown in the column heading and is not repeated beside every amount.

The report can be filtered by business location, contact type, and contact. **Show Zero Balance** is unticked by default.

### Page totals and exports

Both reports show Debit and Credit totals for the records on the current table page. The totals update when searching, filtering, or moving between pages.

The visible report can be exported to CSV, Excel, or PDF. Standard printing and **Print A4** are also available.

The Customer List Report has a separate **Print A4** option for the Summary and Customer Group tabs. Printed Customer and Supplier lists use the available A4 page space more efficiently, showing more records before continuing on the next page.

### Balance accuracy

Customer, supplier, and barterer balances follow the same balance information used in the Contacts list and contact ledger. Advance deposits, returns, payments, and ledger discounts are included when working out the final Debit or Credit balance.

### Sales and Purchase Reports menu order

The report menus have been rearranged for easier access:

- **Customer List Report** remains at the top of Sales Reports.
- **Report 607 (Sale)** is shown after **Stock Performance Report**.
- **Supplier List Report** remains at the top of Purchase Reports.
- **Report 606 (Purchase)** is shown after **Purchase Analysis**.

### How to use the Customer List Report

1. Open **Reports > Sales Reports > Customer List Report**.
2. Select Customers or Barterers.
3. Choose a business location, contact, or customer group when required.
4. Select **Show Zero Balance** when zero-balance contacts should be included.
5. Open Summary or Customer Group to review the required information.
6. Use the export choices or select **Print A4** to print the selected tab.

### How to use the Supplier List Report

1. Open **Reports > Purchase Reports > Supplier List Report**.
2. Select Suppliers or Barterers.
3. Choose a business location or contact when required.
4. Select **Show Zero Balance** when zero-balance contacts should be included.
5. Review the Debit and Credit balances and page totals.
6. Use the export choices or select **Print A4** to print the report.

## 24 September 2026 - Product by Sales Report

### New sales report

A new **Product by Sales Report** is available under **Reports > Sales Reports**, directly after **Product Sale Report**.

The report shows product sales with the following information:

- Invoice number and date.
- Customer contact ID and customer name.
- Product SKU, product name, category, and unit.
- Quantity, unit price, and product total.
- Invoice discount and total invoice amount.
- Payment method, paid amount, and due amount.

Branch and brand name columns are not shown. Product names remain on one line and use the space needed for the name. When the customer's business name and customer name are the same, the name is shown only once.

Invoice discount, total invoice amount, paid amount, and due amount are shown once for each invoice so that invoice totals are not repeated for every product on the same invoice.

### Filters and exports

The report can be filtered by product, supplier, customer, customer group, category, brand, gender, procurement source, date, and time. Extra filter choices are shown when subcategories or other subgroups are enabled.

The visible report can be exported to CSV or Excel. Use **Column Visibility** to choose which columns are shown before exporting.

### Print A4 and PDF

A separate **Print A4** button opens a full report preview using the current filters.

The preview provides options to:

- Increase, decrease, or reset the table text size.
- Zoom in, zoom out, or reset the page view.
- Move between report pages.
- Export the report to Excel.
- Download the report as a PDF.
- Print the report on A4 paper.

PDF preparation has been improved for reports containing many product sale records. A wider date range can still take longer because it creates more report pages.

### How to use the report

1. Open **Reports > Sales Reports > Product by Sales Report**.
2. Select the required filters and date range.
3. Review the product, customer, invoice, payment, and due details.
4. Use CSV or Excel when a spreadsheet is required.
5. Select **Print A4** to open the printable preview.
6. Adjust the text size or zoom if needed.
7. Select **PDF** to download the report, or **Print A4** to print it.

## 24 September 2026 - Product Sale Report Improvements

### Simpler Detailed report

The **Total Amount** column has been removed from the **Detailed** tab of the Product Sale Report. The same column is also no longer shown when printing the Detailed report.

### Better use of A4 pages

The printed Detailed report now shows more records on each page. This reduces empty space and avoids moving records to the next page too early.

### How to view or print the report

1. Open **Reports > Product Sale Report**.
2. Select the **Detailed** tab.
3. Choose the required date range and filters.
4. Review the report on screen, or select **Print A4** to open the print preview.

## 24 September 2026 - Sales Order Status

### Change a completed sales order back to ordered

A completed sales order can now be changed back to **Ordered** when no sale invoice has been created against it.

If a sale invoice already exists for the sales order, its completed status cannot be changed.

### How to change the status

1. Open **Sales > Sales Orders**.
2. Find the required sales order.
3. Select its **Completed** status.
4. Change the status to **Ordered** and save.

## 24 September 2026 - Completed Delivery Notes

### Prevent changes to completed delivery notes

Completed delivery notes can no longer be edited from the Delivery Notes list. The **Edit** option is hidden from the **Actions** menu when a delivery note has the **Completed** status.

Users can still select **Actions > View** to review a completed delivery note.

## 24 September 2026 - POS Sale Submission

### Clearer messages when completing a sale

The POS now gives a clear message when a sale cannot be completed because the customer is missing, the session has ended, permission is unavailable, or the customer could not be found.

If the customer credit limit cannot be checked, the sale is kept open and is not submitted. The **Save** and **Update** buttons become available again so the user can correct the issue and try again without entering the sale again.

### How to complete the sale

1. Select a customer before completing a final sale.
2. Review any message shown by the POS.
3. Correct the customer, sign-in, permission, or connection issue mentioned in the message.
4. Select **Save** or **Update** again.

## 24 September 2026 - Public Pricing Page

### Show only products with a selling price

Products with a default selling price of **0.00** are no longer shown on the public pricing page.

Visitors will now see only products that have a selling price greater than zero, making the available choices clearer and preventing unavailable products from being added to a package.

### How to check the pricing page

1. Open the public **Pricing** page.
2. Review the products available for purchase.
3. Confirm that products priced at **0.00** are not displayed.

## 24 September 2026 - User Creation

### Create new users successfully

New users can now be created without the page stopping unexpectedly.

After the user is saved, any selected departments, designations, and other employee details are also saved correctly.

### How to create a user

1. Open **User Management > Users**.
2. Select **Add**.
3. Enter the user's details and choose the required role and permissions.
4. Add any employee details that are needed.
5. Select **Save**.

The new user will appear in the Users list and can sign in using the saved login details.

## 24 September 2026 - Faster and Easier Public Website

### Cleaner website logo

The public website header now shows the logo in a compact brand area with the product name beside it, preventing oversized uploaded logos from stretching across the navigation.

### Quicker page opening

The public website now opens more quickly by reducing items that previously delayed the first screen. The main page picture is also smaller while keeping a clear appearance, helping visitors on mobile phones and slower connections.

### Working website buttons

Public website buttons now open the correct page. Optional download buttons are hidden when no destination has been entered, preventing visitors from selecting a button that leads nowhere.

### Easier website access

The website now keeps the logo area steady while the page opens. The contact button has a clear name and can be used more easily with a keyboard or screen reader.

## 23 September 2026 - Delivery Notes Improvements

### Clearer PDF file names

When a delivery note is saved as a PDF from the browser, the suggested file name now includes the customer name, business name, and delivery note number.

For example: **Walk-In Customer_D.R. Home_DN-0001.pdf**.

This makes saved delivery notes easier to identify and find later.

### Easier delivery note viewing

The delivery note heading and the **Print** and **Close** buttons remain visible while viewing a long or wide delivery note.

The delivery note details can be scrolled up, down, left, or right without moving the heading or buttons off the screen. This is especially helpful on smaller screens.

### Clearer date and time

On the Delivery Notes list, the date and time are now shown on separate lines for easier reading.

### How to view or save a delivery note

1. Open **Delivery Notes**.
2. Select **Actions > View** for the required delivery note.
3. Scroll through the delivery note details if needed.
4. Select **Print**.
5. Choose **Save as PDF** to save it using the suggested file name.

## 23 September 2026 - Automatic Product SKU Numbers

### Create reusable SKU number formats

A new **SKU Auto Generate** page is available under the **Products** menu.

Users can create, edit, and delete SKU formats by entering a prefix, the number of digits required, and the next number to use. For example, prefix **BR01** with a number length of **6** creates **BR01000001**.

### Generate the next SKU when adding a product

When adding a product, select a saved format from **SKU Auto Generator**. The next available SKU is filled in automatically.

Each new product using the same format receives the next number. For example:

- The first product receives **BR01000001**.
- The second product receives **BR01000002**.
- The third product receives **BR01000003**.

The normal SKU field can still be used when an automatic format is not selected. The **SKU Auto Generator** selection is hidden when no SKU formats have been created.

### How to set up and use automatic SKUs

1. Open **Products > SKU Auto Generate**.
2. Select **Add**.
3. Enter a prefix, such as **BR01**.
4. Enter the required number length, such as **6**.
5. Enter the next number to use, normally **1**.
6. Save the SKU format.
7. Open **Products > Add Product**.
8. Select the saved format from **SKU Auto Generator**.
9. Complete and save the product.

## 23 September 2026 - Supplier List Printing

### Clearer Print A4 and PDF reports

The supplier list is now easier to read when using **Print A4** or downloading a **PDF**.

Long column headings are shown on separate lines where needed, helping all selected columns fit neatly across the page. Text, amounts, quantities, and dates are aligned clearly for easier checking.

More supplier records are shown on each page, reducing empty space and unnecessary extra pages.

### How to print the supplier list

1. Open **Merchants > Suppliers**.
2. Select the columns and filters required for the report.
3. Select **Print A4**.
4. Review the report and use **Print A4** to print it, or select **PDF** to download it.

## 23 September 2026 - Faster Public Website and Easier Access

### Public pages open faster

The public website now loads more quickly, especially on mobile phones and slower internet connections.

Only the items needed for the public page are loaded, helping visitors see and use the page sooner. Pictures and other website items are also kept ready for repeat visits, so returning visitors can open the website faster.

### Easier mobile navigation

The website menu now opens and closes correctly on smaller screens, making it easier for mobile visitors to move between public pages.

### Website pages display correctly

The public website now opens with the correct design, images, and page layout when it is visited from other computers.

Visitors who enter the website address with or without **www** are taken to the correct website automatically.

### Improved search engine guidance

Search engines can now read the website guidance more clearly. This helps them find the public pages and website map without being distracted by unsupported information.

## 23 September 2026 - Customer Group on Sales Invoices

### Show the customer group on printed invoices

Invoice layouts can now show the customer's group on sales invoices that use the **Classic** design.

The wording can be changed to suit the business. For example, **Customer Group** can be changed to **Membership**, **Price Group**, or another preferred label.

### How to set it up

1. Open **Invoice Layouts**.
2. Create a new layout or edit an existing layout.
3. Go to **3 - Invoice Header to be shown**.
4. Enter the wording required in **Customer group label**.
5. Select **Show customer group**.
6. Save the invoice layout.

When a customer belongs to a group, the chosen label and group name are shown with the customer details on the printed sales invoice. Nothing is shown when the customer has no group.

## 23 September 2026 - Customer Details on Sales

### Clearer customer address information

When creating or editing a sale, **Billing Address** and **Shipping Address** are shown only when the selected customer has information saved for them. Empty address headings are no longer displayed.

If **Hide Customer Address Info** is selected in the business settings, customer address information is not shown or filled in automatically on the sale page.

### Customer group shown with customer details

When the selected customer belongs to a customer group, the group name is shown with the customer details on the sale create and edit pages. The customer group is hidden when no group has been selected for that customer.

## 23 September 2026 - Cash Skim Numeric Keypad

### Enter handover amounts using the numeric keypad

When **Enable Numeric Keypad on Input** is selected in the business POS settings, clicking the handover amount field in the **Cash Skim** window now opens the numeric keypad clearly in front of the window.

Enter the required amount and select **OK** to return it to the Cash Skim window. Select **Close** to leave the amount unchanged.

When **Enable Numeric Keypad on Input** is not selected, the handover amount can be entered normally without opening the on-screen keypad.

## 23 September 2026 - Cash Skim Report

### Review cash removed from POS registers

A new **Cash Skim Report** is available under **Reports > POS Reports > Cash Skim Report**.

The report shows cash skim entries recorded from the POS screen, including:

- Date and time of the cash skim.
- Register reference number.
- Business location.
- User responsible for the register.
- Register opening and closing times.
- Register status.
- Cash skim amount.

The total cash skim amount is shown at the bottom of the report.

### Filter the report

Users can filter cash skim records by business location, user, and date range. The preferred default date range can be selected from the report date settings.

### Report access and display

Administrators can choose which roles are allowed to view the Cash Skim Report. Access can also be limited to permitted business locations or allowed for all locations.

Each user can hide or show Cash Skim Report columns from their report column visibility settings.

### How to use the Cash Skim Report

1. Open **Reports**.
2. Select **POS Reports**.
3. Open **Cash Skim Report**.
4. Select a location, user, or date range if required.
5. Review the cash skim entries and the total amount shown at the bottom.

## 23 September 2026 - Module Installation

### Foodpanda installation button

The **Install** button for the Foodpanda module now works correctly from the **Manage Modules** page, including when the application is opened through a local folder address.

After a successful installation, Foodpanda is marked as installed and the button changes from **Install** to **Uninstall**. If the installation cannot be completed, a clear message is shown so the user knows what went wrong.

### Slaughterhouse installation page

The Slaughterhouse installation page can now be opened from a local installation. Users who are not signed in are taken to the login page first.

Only a super administrator can install either module.

### How to install a module

1. Sign in as a super administrator.
2. Open **Manage Modules**.
3. Find **Foodpanda** or **Slaughterhouse**.
4. Click **Install**.
5. Wait for the installation to finish and return to the module list.
6. Confirm that the button has changed to **Uninstall**.

Foodpanda version **1.0** is now installed on the current system.

## 23 September 2026 - Business Navigation

### Move between businesses more easily

The Business Information page now includes **PREVIOUS** and **NEXT** buttons in the main footer.

Administrators can use these buttons to open the previous or next business without returning to the business list. The **PREVIOUS** button is unavailable when viewing the first business, and the **NEXT** button is unavailable when viewing the last business.

## 23 September 2026 - Currency Setup for New Businesses

### No automatic CNY currency

New businesses will no longer have **Chinese Yuan (CNY)** added automatically to their location currency list.

The currency selected while creating the business will remain the main currency. Additional currencies can still be added later from the business location settings when required.

This change applies to newly created businesses. It does not remove currencies already saved for existing businesses.

## 23 September 2026 - Faster POS Sale Completion

### Start the next sale sooner

After a sale is completed, the POS screen is now prepared for the next customer more quickly.

When silent printing is used, receipt and kitchen ticket printing can continue while the cashier starts the next sale. Normal browser printing continues to wait until the receipt is ready, helping prevent blank print previews.

The product search field is selected automatically after the sale form is cleared, so the next item can be scanned or searched immediately.

## 23 September 2026 - Settings Menu

### AI Assistance is easier to find

**AI Assistance (OpenAI)** now appears directly after **Tax Rates** in the **Settings** menu.

## 23 September 2026 - Custom Subscription Packages

### Safer package quantities

When creating a custom package, the number of additional locations, users, workstations, and warehouses can be set from **0 to 99**.

Use the **+** and **-** buttons to adjust each quantity. A package will not be created if an invalid quantity is submitted.

### Only relevant packages are displayed

Custom packages created for a quotation are no longer shown as packages available to every business.

Businesses now see regular public packages and custom packages assigned specifically to them. This prevents incorrect or unrelated custom packages from appearing on the subscription page.

## 23 September 2026 - Products Page and Notifications

### Products page opens normally

The Products page now opens without showing an unexpected notification error.

### Mark all notifications as read

The **Mark all read** option in the notification menu now works correctly. Select it to clear the unread notification count and refresh the notification list.

## 23 September 2026 - Package Subscriber Count

### Correct subscriber count

The Packages page now includes businesses selected in **Only for Businesses** when showing the subscriber count.

For example, when one business is selected for a package, the package card now shows **1 subscriber** instead of **0**. This makes it easier for administrators to see which packages are assigned to businesses.

## 23 September 2026 - Demo Login Page

### Blank login details when the page opens

The username and password fields are now blank when the demo login page first opens. This prevents a default administrator account from appearing automatically.

To use a ready-made demo account, select a business from the **Demo Showcase**. Its login details will be filled in automatically.

### Businesses with additional modules

Any demo business that includes an additional module in its subscription is now shown under **Basic with Advanced Modules Demo**.

This makes it easier to find and open demo businesses that include features beyond the basic application.

### Choose where each business appears

In the demo environment, the Business Information page now lets the administrator choose one demo login category for each business:

- **Core Applications Demo**
- **Core with Advanced Modules Demo**
- **Core with Advanced Integrations Demo**
- **SuperAdmin with Full Demo**

After a category is selected, the business appears under that heading in the **Demo Showcase** on the login page.

## 22 September 2026 - Offline Subscription Payments

### More reliable offline payment requests

Users can now submit an offline subscription payment request even when an email notification cannot be sent.

After clicking **Offline**, the payment request is recorded and the confirmation page opens normally. An administrator can then review and approve the request.

### How to submit an offline payment request

1. Open the required subscription package.
2. Review the offline payment instructions and bank details.
3. Click **Offline**.
4. Wait for an administrator to review and approve the request.

If an email notification is temporarily unavailable, the request can still be completed without interrupting the subscription process.

## 22 September 2026 - Pakistan Employee Salary Tax

### Automatic salary tax calculation

Payroll can now calculate and deduct employee salary income tax according to the applicable Pakistan salary tax rates.

The correct tax year is selected automatically from the payroll month. Pakistan's tax year runs from July to June.

Salary tax is calculated from the employee's estimated annual taxable earnings. The deduction is updated automatically when salary or allowances change.

### Employee tax details

Salary tax can be enabled separately for each employee from the employee's payroll details.

The following information can be entered:

- **Calculate Pakistan salary income tax:** Turns automatic salary tax calculation on or off for the employee.
- **NTN / CNIC for tax:** Records the employee's tax identification number.
- **Annual taxable income adjustment:** Adds other taxable income to the yearly estimate. Enter a negative amount for an eligible exemption or other reduction.

Employees who do not have salary tax enabled will continue to use the normal payroll calculation without an automatic tax deduction.

### Payroll and payslips

When salary tax is enabled, the payroll screen shows:

- Pay before salary tax.
- Salary income tax deduction and tax year.
- Final net pay after tax.

The tax is recalculated when a new payroll is created or an existing payroll is edited, including payroll group changes.

The salary tax deduction is shown separately on the employee payslip and in the monthly payroll report.

### How to enable salary tax for an employee

1. Open the employee's details.
2. Go to the **Payroll** section.
3. Select **Calculate Pakistan salary income tax**.
4. Enter the employee's **NTN / CNIC for tax**.
5. Enter an annual adjustment only when required.
6. Save the employee.
7. Create or recalculate payroll for the required month.
8. Review the salary tax and final net pay before completing payroll.

Salary tax calculations should be reviewed when government rates change or when an employee has exemptions, tax credits, income from another employer, or other special tax circumstances.

## 21 September 2026 - ProSurface Hardware Setup

### New Hardware Setup page

A new **Hardware Setup** page is available under **Settings > Hardware Setup**.

Each computer can now keep its own printer and hardware choices. Settings made on one counter will not change the devices selected on another counter.

### Silent printing service

The new **ProSurface POS Hardware Service** allows supported printing to start directly from the POS without showing the browser print window.

The Hardware Setup page shows whether the service is connected. It also provides buttons to:

- Download the Windows installer.
- Test the connection.
- Refresh the list of available printers.
- View printers detected on the computer.

The service can start automatically with Windows and continue running from the Windows system tray.

### Printer assignments

Users can choose separate printers for:

- Customer receipts.
- Reports and summaries.
- Barcode and price labels.

Kitchen order ticket printers are managed from the **Printers** page and assigned to products. This allows food, drinks, and other product groups to print at the correct preparation area.

### Cash drawer

The Cash Drawer tab allows a drawer connected through the receipt printer to be enabled and tested.

Users can select the drawer connection pin before sending a test command.

### Barcode scanner

The Barcode Scanner tab allows users to:

- Select a scanner detected on the computer.
- Set an optional barcode prefix.
- Set the ending key used by the scanner.
- Refresh the scanner list.

### Supported websites

The same ProSurface Hardware Service installer can be used with the main website and any of its subdomains for:

- `actuarypos.com`
- `bitorepos.com`
- `intelliflowerp.com`
- `retailmanerp.com`
- `mobilespos.co.za`
- `friendsepos.co.uk`

Local installations are also supported through `localhost` and `127.0.0.1`, including installations that use a custom port.

### ProSurface branding

The Windows service, installer, status window, system tray, and application icon now use **ProSurface** branding with the black ProSurface icon for clearer visibility.

### Automatic printing choice

Browser printing is used automatically when the ProSurface POS Hardware Service is not installed or is not connected. The normal browser print window will open so the user can choose a printer.

After the service is installed, connected, and a receipt printer is saved in **Settings > Hardware Setup**, receipts print silently through the selected printer. The browser print window is skipped.

There is no need to change **Receipt Printer Type** or **Configure Printer** in the business location settings for this purpose. Those settings do not control silent printing through Hardware Setup.

If the service is unavailable, printing returns to the normal browser print window automatically.

### Quick setup guide

1. Open **Settings > Hardware Setup**.
2. Select the correct business location and workstation.
3. In **Windows Hardware Service**, click **Download installer**.
4. Install and start the ProSurface POS Hardware Service.
5. Return to Hardware Setup and click **Test connection**.
6. Select the receipt, report, and label printers required for this computer.
7. Set the receipt print margins if the printer cuts off content near an edge.
8. Use the **Printers** page and product settings to prepare kitchen and bar printing.
9. Configure the cash drawer or barcode scanner if needed.
10. Click **Save hardware setup**.
11. Open the POS and complete a test sale. The receipt should print without opening the browser print window.

When the service is ready, the Hardware Setup page displays **Connected**. Each computer must save its own hardware setup.

## 21 September 2026 - Classic Sale v8 Invoice Colors

### Invoice table header color

Users can now choose the table header color for invoices that use the **Classic Sale v8** design.

The color option is available when creating a new invoice layout or editing an existing one. It appears under **2 - Layout Header to be shown** after selecting **Classic Sale v8**.

The selected color is shown on the invoice item table header and the final total row, helping the printed invoice match the business branding.

### How to change the color

1. Open the invoice layout create or edit page.
2. Select **Classic Sale v8** as the invoice design.
3. Go to **2 - Layout Header to be shown**.
4. Choose the required table header color.
5. Save the invoice layout.
6. Preview or print an invoice to view the selected color.

This option is only shown for the **Classic Sale v8** design and does not change other invoice designs.

## 20 September 2026 - More Language Options

### Russian, Urdu, and improved Arabic support

**Russian** and **Urdu (Pakistan)** are now available across the main application and its modules. Urdu pages are displayed from right to left for easier reading.

Arabic wording has also been improved across the application, including dashboard headings, chart labels, totals, statuses, and other common captions.

### How to change the language

1. Sign in and open your user profile.
2. Find the **Language** option.
3. Select the required language.
4. Save the profile.
5. Refresh the page if the new language does not appear immediately.
