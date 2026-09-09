# User Guide Updates

## September 9, 2026 - Complete The Sharifas Online Stock Correction

- Fixed a case where the online update finished but earlier pack-sale quantities stayed incorrect.
- Run the latest application update, then refresh **Stock History** to check the corrected quantities.
- For example, selling **2 packs of 10** should show **-20 pieces**, not -200.
- Sales that are already correct stay unchanged. You do not need to enter the old sales again.

## September 8, 2026 - Closing Product Notes

- In **Add Product Note** and **Edit Product Note**, click **×** or **Close** to close the window without saving your changes.
- To save your note, click **Save** when adding a note or **Update** when editing one.
- Refresh the page after updating the application, then open the note window again.

## September 8, 2026 - Clearer Purchase Orders, Ledgers And Printed Reports

### Purchase Order Totals

- The **Total** column in the purchase order list now shows amounts for the affected orders that previously showed zero despite having priced items.
- Open **Purchase Orders** and refresh the list to see the amounts. You do not need to enter the orders again.

### Contact Ledger - Format 2

- The print preview now separates long statements into pages. Use the previous and next buttons, or enter a page number, to move through the statement.
- The ageing summary and footer appear once at the end.
- The **Ref. No.** column in downloaded PDFs adjusts its width to the information shown, leaving more room for the other columns.
- Your chosen table text size is now included when you download the contact ledger using the red **PDF** button.

### Text Size In Accounting Reports

- Table text-size controls now work in all **14 Accounting A4 print views**: receivable ageing, receivable ageing details, payable ageing, payable ageing details, trial balance, balance sheet, profit and loss, chart of accounts, daily transactions, account ledger, cash flow, journal entries, transfers, and cheque books.
- Use **A+** to make table text larger, **A-** to make it smaller, and **A** to return to the usual size. Headings, entries, and totals adjust together.
- Click the red **PDF** button after choosing the text size. The downloaded report uses your chosen adjustment too.
- The **100%**, **+**, and **-** zoom controls change how large the page looks on screen. Use the **A** controls when you want to change the table text size for printing or downloading.

### Ageing Report Layout

- In receivable and payable ageing summaries, the seven summary boxes stay together in one horizontal row in the downloaded PDF, as they do in the preview.
- In the receivable ageing report, **Customer name** lines up on the left. **Current**, all overdue amounts, and **Total** line up on the right, including their headings and totals.
- These columns adjust their widths to fit the information in both the preview and the downloaded PDF.
- Long receivable ageing PDFs now use the available page space before continuing onto the next page. This avoids nearly empty pages in the middle of a report.
- PDF page numbers show the actual number of pages. A larger text size may need more pages.
- Clear space is kept around the edges of every page, with room at the bottom for the page number.

### How To Use

1. Refresh the page with **Ctrl+F5** after updating.
2. Open the contact ledger or Accounting report and choose the filters you need.
3. Open **Print** or **Print A4** to view the report.
4. Choose the table text size using **A+**, **A-**, or **A**.
5. Click the red **PDF** button to download a fresh copy with your chosen text size.
6. Open the newly downloaded file. PDFs downloaded earlier keep their old appearance.

## September 8, 2026 - Smoother POS Billing

### Finding Products

- Product search is more responsive when you change what you are typing.
- If you use **Last Customer Sold Price** in product search, it shows the price from the customer's latest completed sale. Cancelled or deleted sales are not included.

### Finishing A Bill

- Receipt preparation has been improved to help reduce waiting when finishing a bill, especially bills with many items.
- Continue adding products, taking payment and printing the bill as usual. No new settings are needed.

### After Updating

- Reopen the POS screen or press **Ctrl+F5** after the application update.
- If billing still takes too long, share the invoice number, shop or branch, and whether the delay happens while finding a product, saving the bill or printing.

## September 8, 2026 - Smoother Login And Clearer Sale Updates

### Login When The POS Screen Is Turned Off

- When **POS** is turned off in **Business Settings > Modules**, signing in no longer sends you back to a previously opened POS page with a **POS screen is disabled** message.
- This also applies to admin users. Users without POS access are no longer sent to the POS entry page after signing in.
- Synchronizing cash registers no longer opens the POS screen when it is turned off or you do not have permission to use it.

### Updating A Sale On An Offline Workstation

- After changing a bill, click **Update** or **Update and print** as usual.
- If the customer credit check cannot finish, a message explains the problem and the buttons become available again. The bill has not been submitted at this point.
- If your sign-in has expired, a message asks you to sign in again.
- If information needs correcting, follow the message and check the highlighted fields before trying again. Customer credit limits still apply.
- If a connection problem prevents confirmation that the bill was saved, open the **Sales List** and check the bill before clicking Update again.

### Getting The Update On Another Computer

- Make sure each offline workstation has the latest application update.
- After updating, reopen the sale page or press **Ctrl+F5** to load the latest page.

## September 8, 2026 - Correct Stock For Singles And Packs

### Sending Sales To The Online Account

- Sales made on the shop computer now keep the correct stock quantities when sent to the online account using **Sales Sync**.
- This applies to different products and pack sizes, including invoices with both singles and packs.
- For example, selling **2 packs of 10** reduces stock by **20 pieces**, not 200. Selling **9 singles** reduces stock by **9 pieces**.
- Free items are counted once, using their selected pack size or single unit.

### Correcting Earlier Sales In Sharifas

- After the online application update, the affected earlier sales are checked and corrected automatically.
- The correction covers the identified products and invoices, not just one example sale.
- Extra stock deductions are corrected, and the product's stock history shows the correct quantity.
- Affected items entered with a minus quantity are also corrected so they do not add too much stock.
- Sales that already have the correct quantities stay unchanged. Invoice totals and payments are kept as they are.
- You do not need to delete or enter the old sales again. Running the update again will not apply the same stock correction twice.

### What To Do After Updating

1. Update the online application and the application on the shop computer.
2. Wait for the update to finish, then refresh the product's **Stock History** page.
3. Check a sale made in packs. For example, **2 packs of 10** should show **-20** in stock history.
4. Check the current stock quantity for the correct shop or branch.
5. Continue using **Sales Sync** as usual for new sales.
6. If a quantity still looks wrong, share the invoice number, product name, pack size and shop or branch with support.

## September 8, 2026 - Manage Stock And Correct Ledger Balances

### Products With Manage Stock Unticked

- Products with **Manage stock** unticked no longer appear in the **Stock Quantity Report**, including its printed and downloaded copies.
- Selling these products no longer reduces the **Stock Inventory** account or adds an inventory cost to **Cost of Sales**. The sale amount and customer balance are still recorded as usual.
- If an invoice includes products with different Manage stock settings, only the products with the box ticked count towards inventory costs.

### After Turning Off Manage Stock

1. Open the product's edit page, untick **Manage stock**, and save.
2. Run the product's **Reindex Stock Quantities** option. Choose all locations if you want to update every branch.
3. To update products together, use **Reindex Stock Quantities** above the Stock Quantity Report. Both the full reindex and the option for quantity differences include this correction.
4. You can also use **Sync Product Quantities** to apply this correction to products with Manage stock unticked.
5. Wait for the update to finish, then refresh the stock report and accounting ledger.

- These actions remove the product's old sales-related inventory costs and the matching Cost of Sales amounts. They also correct related sales-return and free-item costs.
- Other products on the same invoice keep their inventory costs. Sale amounts and customer balances remain unchanged.
- Running the update again does not deduct the same amount twice.
- The previously reported **72,000** difference in the Stock Inventory ledger has been corrected.

### Balances For Payments Shown Together

- When several payments appear together on one ledger row, the **Balance** now includes every payment in that row. This applies on screen and in printed reports.
- For example, a **40,000** payment made up of **37,400 + 2,600** reduces a **90,000** balance to **50,000**. A following **50,000** payment brings the balance to **0**.
- Refresh the ledger to see the corrected balances. There is no need to enter the payments again.

## September 8, 2026 - Clearer Contact Ledgers And Easier Printing

### All Ledger Formats

- On a contact's **Ledger** tab, columns in **Formats 1 to 6** adjust their widths to fit the information shown.
- This also applies to the second table when the ledger shows another currency.

### Format 1

- **Date**, **Number**, **Ref. No.**, and **Type** headings and values line up on the left.
- **Payment Status**, **Payment Method**, **Debit**, **Credit**, and **Balance** headings and values line up on the right.
- The **Descriptions** heading stays on one line. Long details underneath continue onto another line, making them easier to read.
- Long text in **Number**, such as a number followed by a description, continues onto another line. The **Number** heading stays on one line.
- Text saved in a sale's **Custom Field 7** now appears in **Descriptions**, below any existing sale notes. It is also included when printing or downloading Format 1.

### Format 2

- The **Ref. No.** heading stays on one line.
- Long reference details continue onto another line instead of appearing one letter at a time.
- The table's dividing lines now match the tables in the other contact tabs.

### Format 4

- **Product Details** use one full-width box beneath the entry, including when extra columns are shown.
- **Description** and **(Purchase) Description** headings stay on one line. Their data continues onto another line when needed.
- The **Others** heading stays on one line, with enough room for its details to wrap normally.
- The extra sentence beginning **Showing all invoices and payments between...** has been removed from above the table on the contact tab and printed copies.
- The print view now separates the ledger into pages. Each entry stays with its product details when they fit together on a page.

### Format 5

- **Date**, **Number**, and **Party Ref. No.** line up on the left. **Debit**, **Credit**, and **Balance** line up on the right.
- **Descriptions** has more room for long details.
- Long text in **Party Ref. No.** continues onto another line instead of stretching across the table.
- The extra date-range sentence above the table has been removed from the contact tab and printed copies.
- On the contact tab, choose **25**, **50**, **100**, or **All** entries and use the page controls to move through the ledger.
- The print view now separates the ledger into pages. Totals appear once at the end, with any ageing and cheque-clearance reports following the ledger.

### Format 6

- Date and number details line up on the left. **Debit**, **Credit**, and **Balance** line up on the right.
- **Descriptions** uses the remaining space, and long details continue onto another line.
- The extra date-range sentence above the table has been removed from the contact tab and printed copies.
- On the contact tab, choose **25**, **50**, **100**, or **All** entries and use the page controls to move through the ledger.
- The print view now separates the ledger into pages. Totals appear once at the end, with any ageing and cheque-clearance reports following the ledger.

### How To Use

1. Open a customer or supplier, then open the **Ledger** tab.
2. Choose your date range and ledger format.
3. In **Format 5** or **Format 6**, choose how many entries to show and use the page controls below the table.
4. To add sale details to **Format 1**, open the sale's create or edit page, enter the text in **Custom Field 7**, and save the sale. Refresh the ledger to see it under **Descriptions**.
5. Click **Print** to open the print view. For **Formats 4, 5, and 6**, use the previous and next page buttons, or enter a page number.
6. In these print views, use **A+** or **A-** to change the text size. The pages adjust to the new size.
7. If you still see the old layout, press **Ctrl+F5** to refresh the page.

## September 8, 2026 - Test Your Email Settings

- Superadmin can use **Send test email** to check whether the email settings work.
- Choose the email address where you want to receive the test message.
- You can test the details entered on the screen before saving them. Testing does not save your changes.
- A message on the screen tells you whether the test email was sent or whether you need to check your settings.

### How To Use

1. Open **Superadmin > Settings > Email/SMTP Settings**.
2. Enter or update your email settings.
3. In **Test email recipient**, enter an email address you can check.
4. Click **Send test email** and wait for the result.
5. If the test is successful, check the recipient's inbox and spam folder to confirm the email arrived.
6. If the test fails, check your email settings with your email provider, correct the details, and try again.
7. Save your settings when you are happy with the result.

If you run several tests quickly and see a message asking you to wait, wait one minute before trying again.

## September 8, 2026 - View And Print Receipts From Contact Ledger

- Click a **Cash Receipt Voucher (CRV)** or **Bank Receipt Voucher (BRV)** number in the contact ledger to view the receipt.
- Use **Print** in the receipt window to print a copy.
- Available in the main contact ledger and ledger formats **5** and **6**.

### How To Use

1. Open the contact's ledger.
2. Find the receipt you need and click its **CRV** or **BRV** number.
3. Review the receipt, then click **Print** to print it.
4. Click **Close** to return to the ledger.

## September 7, 2026 - Choose How Stock Costs Are Shown

### Stock Quantity Report And Stock Value Report

- Both reports now have a **Cost Method** choice in the filters. Select one option at a time:
  - **FIFO:** selected by default. Keeps the usual stock costing method, where older stock is used first.
  - **Last Cost:** uses the latest received cost for the product at each location.
  - **Average Cost:** uses the average received cost, giving more weight to purchases with larger quantities.
- Changing the choice updates the report's cost values and totals. In Stock Quantity Report, potential profit updates too.
- The choice also applies when you switch report tabs, print, or download the report.
- In Stock Value Report, the choice applies to opening stock, stock movements, and current stock values. Opening stock uses receipts before the opening-date cutoff.
- **Show Sell Price** in Stock Value Report continues to show selling values.
- These choices help you compare stock values. They do not change your stock quantities or saved product prices.

### How To Use

1. Open **Stock Quantity Report** or **Stock Value Report** from Reports.
2. Choose your location and other filters as usual.
3. Under **Cost Method**, select **FIFO**, **Last Cost**, or **Average Cost**. In Stock Value Report, select **Show Cost Price** to compare costs.
4. The report updates automatically. Check the values and totals, or switch tabs for more detail.
5. Print or download the report to keep a copy using your selected cost method.

## September 7, 2026 - Clearer Report Totals And Easier Report Controls

### POS Messages

- Messages at the top-right of the POS screen now close when you click **X**. They also disappear automatically after a short time.

### Page Totals And Quantities

- The **Total:** label at the bottom of paged lists now reads **Page Total:**, making it easier to identify the total for the page you are viewing.
- Quantity totals are shown separately for each unit. For example, **125.5 KG**, **1,356 Pc(s)**, and **500.25 Ltr** appear on separate lines instead of being added together.
- Unit names follow your product settings. The number of decimal places follows your quantity settings.
- Negative quantities and zero quantities are included in the totals.
- This applies to the following reports:
  - **Stock Value Report:** Summary, Details, Categorized, and Location Details, including group totals and grand totals.
  - **Stock Quantity Report:** Summary, Details, and Categorized, including group totals and grand totals.
  - **Stock Reorder Report:** the current-stock total at the bottom of the page.
  - **Stock Transfer Report:** quantity totals in Totals, Products Summary, and the detailed ledger.
  - **Combo Items Report:** a quantity subtotal for each combo and a quantity grand total for all displayed combos.
  - **Product Status Report:** the quantity total for the current page.
  - **Product Serial Report:** quantity and free-of-charge quantity totals for the current page.
- Page totals follow the page being viewed. Group totals cover their group, and grand totals cover the report results selected by your filters.

### Report Names And Tabs

- The Stock Value Report heading now reads **Stock Value Report (Analysis/Comparisons)**.
- In **Stock Quantity Report**, the **Locations** tab is now called **Summary**. The order is **Summary > Details > Categorized**.
- In **Stock Value Report**, the **Locations** tab is now called **Summary**. The order is **Summary > Details > Categorized > Location Details**.
- Both reports open on **Summary**, which shows stock grouped by location.

### Report Display Improvements

- In **Stock Quantity Report > Details**, the purchase value, selling value, and potential profit columns after Quantity are shown according to your access and column settings.
- In **Product Serial Report**, the Date column shows the date and time on separate lines, without unwanted text between them.

### Stock Value Report Summary Controls

- Above the Summary table, use **Export to CSV**, **Export to Excel**, or **Export to PDF** to download a copy. Available choices follow your access settings.
- Use **Print** to print the table or **Print A4** to open the A4 report.
- Use **Column visibility** to choose which columns to display.
- Use **Show entries** to choose how many rows appear on a page, and **Search** to find a location in the table.
- Downloaded table copies keep quantity totals for different units on separate lines.

### How To Use

1. Open the report you need and choose your filters.
2. Read each quantity total together with its unit, such as KG, Pc(s), or Ltr.
3. In Stock Quantity Report or Stock Value Report, start with **Summary**, then select another tab for more detail.
4. In **Stock Value Report > Summary**, use the buttons above the table to search, choose columns, download, or print.
5. If you still see the previous appearance, press **Ctrl+F5** to refresh the page.

## September 7, 2026 - Hidden Feature Choices Stay Saved

### What Superadmin Can Do

- Each business keeps its saved **Hide/Disable Features** choices after an application update.
- Saving **Business Settings** also keeps these choices.
- Features you selected to hide stay hidden. If you chose to hide no features, that choice stays saved too.

### How To Use

1. Open **Superadmin > Businesses** and view the business you want to manage.
2. Find **Hide/Disable Features**.
3. Tick the features you want to hide, then save your choices.
4. After an application update, your saved choices remain in place. You do not need to select them again.
5. To show a feature again, untick it in this section and save.

If an earlier update already cleared your choices, select and save them again once.

## September 7, 2026 - Product List Easier To Read

### What Users Can See

- The product list has cleaner rows with light dividing lines. Pointing at a row highlights it, making it easier to follow.
- Prices and quantities line up on the right, making them easier to compare.
- **Row density** lets you choose **Compact**, **Default**, or **Comfortable** spacing. Your choice is remembered in the same browser.
- On larger screens, **SKU** and **Product** stay visible when you scroll sideways. On smaller screens, the product name stays visible.
- Long names and other long details are shortened to keep rows tidy. Hold the mouse pointer over shortened text to see the full text.
- Missing details show a dash (**—**). A quantity of **0** still shows as **0**.
- The **Actions** button is always visible for each product, so you can open its menu without first pointing at the row.
- Column headings line up with the product details while scrolling, and the extra blank strip below the headings has been removed.
- Hold the mouse pointer over a product's small picture to see a larger preview of its attached image. Move the pointer away to close the preview.

### How To Use

1. Open **Products > Products List**.
2. Choose your preferred spacing from **Row density** above the list.
3. Scroll sideways to view more details while keeping the product name in view.
4. Hold the mouse pointer over a shortened name or detail to read it in full.
5. Click **Actions** beside a product to open its available options.
6. Hold the mouse pointer over a product picture to see it more clearly. Products without an attached image do not show a larger preview.
7. If the page still shows the old appearance, press **Ctrl+F5** to refresh it.

## September 7, 2026 - Sales Lists And Report Columns Updated

### What Users Can See

- In **Sales & Returns Report**, **TYPE** now appears before **INVOICE NO.**
- **REF. NO.** now appears after **INVOICE NO.** in **Sales & Returns Report** and the **Summary** tab of **Sale Invoices Report**. It shows the reference in the same way as the sales list.
- **CUSTOMER NOTE** appears only when **Enable Customer Note** is turned on in Business Settings. This applies to **All Sales**, **Sales & Returns Report**, and the **Summary** tab of **Sale Invoices Report**.
- Printed and downloaded copies of these reports follow the new column order and Customer Note setting.

### How To Use

1. Open **Sales & Returns Report** to see **TYPE**, **INVOICE NO.**, and **REF. NO.** next to each other.
2. Open **Sale Invoices Report > Summary** to see **REF. NO.** after **INVOICE NO.**
3. In **Business Settings**, turn **Enable Customer Note** on to show customer notes, or off to hide them, then save.
4. Refresh the sales list or report to see the change.
5. Print or download either report when you need a copy with the same columns.

## September 5, 2026 - Update Warning For All Users Added

### What Superadmin Can Do

- Superadmin can show an update warning to all users before taking the system down.
- Users get a message with an **OK** button before the update starts.
- After pressing **OK**, users can still see the remaining countdown time.
- New users who log in during the countdown also see the warning message first.
- The warning tells users to save their current work before the update starts.
- The maintenance page now shows that downtime is approximately **20 minutes**.
- When the update is complete, the maintenance page refreshes automatically and users can continue using the system.

### How To Check

1. Start the update warning from the server.
2. Log in as any user and confirm the warning message appears.
3. Press **OK** and confirm the countdown remains visible.
4. Log in as another user during the countdown and confirm the warning message appears for that user too.
5. Wait until the countdown finishes and confirm the update page appears.
6. Complete the update and bring the system back online.
7. Confirm the update page refreshes automatically and opens the system again.

### Why This Helps

- Users get time to save their work before an update.
- Businesses are not surprised by sudden downtime.
- New users are also informed if they log in during the countdown.
- Customers see a cleaner update page with expected downtime information.

## September 4, 2026 - FBR DI Invoice Cancellation Marking Added

### What Users Can Do

- Users can mark an FBR Digital Invoicing sale as **Invoice Canceled** after the invoice has already been canceled in IRIS.
- This option appears only for sales that already have an FBR DI invoice number.
- Canceled FBR DI invoices are hidden from the normal sales list.
- Users can tick **Show canceled FBR DI** when they need to review canceled invoices again.
- Users can click the **Invoice Canceled** label and confirm if they need to remove the canceled status.

### How To Check

1. Go to **Sales > All Sales**.
2. Open the action menu for a sale that has an FBR DI invoice number.
3. Click **Invoice Canceled** after confirming the invoice is canceled in IRIS.
4. Confirm the invoice disappears from the normal sales list.
5. Tick **Show canceled FBR DI** in the filters to see canceled invoices again.
6. Click **Invoice Canceled** and press **OK** to remove the canceled status if it was marked by mistake.

### Why This Helps

- Sales lists stay clear after an FBR DI invoice is canceled in IRIS.
- Users can still review canceled FBR DI invoices when needed.
- Users can correct a mistaken canceled marking without changing the invoice in FBR.
- The business keeps a simple record of which invoices were marked as canceled.

## September 4, 2026 - Invoice Layout Customer And HSN Options Improved

### What Users Can Do

- Users can set the **Client ID** label and turn **Show client ID** on or off from the same place.
- Users can set the **Category or HSN code** label and turn **Show category code or HSN code** on or off from the same place.
- If the HSN/category code option is turned on with no label, the code can show with the product name.
- If users enter a label such as **HSN**, the code can show in its own invoice column with that label as the heading.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Add a new layout or edit an existing layout.
3. Check the **Client ID Label** field and its checkbox.
4. Check the **Category or HSN code label** field and its checkbox.
5. Save the layout and print or preview an invoice.
6. Confirm the HSN/category code appears either with the product name or in a separate column, based on the label setting.

### Why This Helps

- Invoice layout settings are easier to understand.
- Users can control whether the HSN/category code appears with the product name or as a separate column.
- Printed invoices can be arranged more clearly for customers and business records.

## September 4, 2026 - Delivery Notes Customer Name Improved

### What Users Can See

- Users can now see the customer contact more clearly in the Delivery Notes list.
- The Customer Name column shows the business name and the customer's first name together.
- If the customer name was showing as a dot or blank, it now shows useful contact information when available.

### How To Check

1. Go to **Sales > Delivery Notes**.
2. Check the **Customer Name** column.
3. Confirm the customer appears like **Business Name - First Name**.
4. Use the search box to find a delivery note by business name or customer name.

### Why This Helps

- Delivery notes are easier to identify.
- Users can quickly confirm which customer the delivery note belongs to.

## September 3, 2026 - Classic v7 Invoice Header Layout Updated

### What Users Can Do

- Users can print **Classic v7 for Sale** invoices with the logo on the left side and business details on the right side.
- The selected font style now appears correctly on the Classic v7 invoice.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v7 for Sale**.
3. Add or confirm the invoice logo and choose the required font style.
4. Print or preview a sale invoice.
5. Confirm the logo appears on the left and business details appear on the right.

### Why This Helps

- Printed invoices match the expected Classic v7 format.
- Business details look cleaner and easier to read.

## September 3, 2026 - Location Name Font Size Option Added

### What Users Can Do

- Users can choose a separate font size for the location name in invoice layout settings.
- The location name can now be made smaller or larger without changing the business name size.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Add a new layout or edit an existing layout.
3. Find **Location Name Font Size** near **Business Name Font Size**.
4. Choose a size, save the layout, and print or preview an invoice.
5. Confirm the location name uses the selected size.

### Why This Helps

- Users have better control over the invoice header.
- Business name and location name can be balanced more neatly.

## September 3, 2026 - Purchase Return Product Table Matches Purchase Pages

### What Users Can Do

- Users can add or edit a purchase return with the same product table style used on purchase pages.
- Product columns now follow the business settings, so enabled options such as SKU, brand, category, scheme quantity, tax, discounts, discounted cost, line total, selling price, pack price, MRP, lot number, and expiry details appear when they are turned on.

### How To Check

1. Go to **Purchase > Purchase Return**.
2. Open **Add Purchase Return** or edit an existing purchase return.
3. Add a product or view existing products.
4. Confirm the product table shows the same enabled columns as the purchase page.

### Why This Helps

- Purchase return screens feel familiar.
- Users see the same product details they already use while entering purchases.

## September 3, 2026 - Purchase Return Footer Totals Added

### What Users Can Do

- Users can see detailed totals below the product table on purchase return add and edit pages.
- Totals update for quantity, discounts, tax, and net total amount.

### How To Check

1. Open a purchase return add or edit page.
2. Add a product or change quantity, cost, discount, or tax.
3. Check the totals section below the product table.
4. Confirm the total amount changes correctly.

### Why This Helps

- Users can review return totals before saving.
- It is easier to confirm quantity, discount, tax, and final amount.

## September 3, 2026 - Purchase Return Header And Payment Sections Improved

### What Users Can Do

- Users can use purchase-style header fields on purchase return add and edit pages.
- Users can enter purchase return payment details at the bottom of the page.
- Payment due updates when payment amount changes.

### How To Check

1. Open a purchase return add or edit page.
2. Check the top section for supplier, location, reference, date, pay term, and related purchase fields.
3. Scroll to the bottom and enter payment details.
4. Confirm the payment due amount updates correctly.

### Why This Helps

- Purchase returns are easier to enter from one page.
- Payment information can be recorded while saving the return.

## September 3, 2026 - Purchase Return From Purchase Invoice Kept Separate

### What Users Can Do

- Users can still open a purchase return directly from a purchase invoice.
- This page keeps the simple invoice-return layout with parent purchase details and return quantity for each purchased item.

### How To Check

1. Open a purchase invoice.
2. Choose the option to create or update its purchase return.
3. Confirm the page shows the parent purchase information.
4. Enter return quantities against the original invoice items.

### Why This Helps

- Returning items from a specific purchase invoice stays clear.
- Users do not mix invoice-based returns with general purchase return entry.

## September 3, 2026 - Classic v8 Extra Bottom Space Removed

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with less empty space below the main table.
- The amount in words and signature area now sit closer to the table.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview an invoice.
4. Confirm there is no large empty gap under the main table.

### Why This Helps

- The invoice looks more compact.
- Important invoice details stay closer together.

## September 3, 2026 - Classic v8 Payment Details Fit Main Box

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with paid amount details inside the main product table box.
- Payment details now line up with the totals area instead of sitting as a separate box below.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a paid invoice.
4. Confirm the paid amount details appear inside the main table box.

### Why This Helps

- The invoice uses the empty space better.
- Payment details and totals look more connected.

## September 3, 2026 - Quotation SKU Column Follows Layout Setting

### What Users Can Do

- Users can turn on **Show SKU** in a quotation invoice layout and see the SKU column on printed quotations.
- Quotation prints now use the quotation layout selected for the business location.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Open the quotation layout and turn on **Show SKU**.
3. Print or preview a quotation.
4. Confirm the **SKU** column appears in the product table.

### Why This Helps

- Quotations match the selected layout settings.
- Product codes are visible when users choose to show them.

## September 3, 2026 - Classic v8 Blank Table Boundary Fixed

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with the blank product area properly closed.
- The line before the totals area now continues across the left side of the table.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice.
4. Confirm the blank product area has a complete line before the totals start.

### Why This Helps

- The product table looks cleaner.
- The totals area connects more neatly with the product table.

## September 3, 2026 - Classic v8 Logos Center Aligned

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with centered header and footer logos.
- Footer logo images now stay centered instead of stretching unnecessarily.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice with header and footer logos.
4. Confirm both logos are horizontally centered.

### Why This Helps

- Invoice branding looks cleaner.
- Header and footer images line up better on printed invoices.

## September 3, 2026 - Classic v8 Vertical Table Lines Fixed

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with complete vertical table lines.
- The blank product area now lines up cleanly with the totals area.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice.
4. Confirm the vertical lines continue properly through the blank item area.

### Why This Helps

- The product table looks properly finished.
- Printed invoices look cleaner and easier to read.

## September 3, 2026 - Classic v8 Product Column Gets More Space

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with more room for product names.
- Right-side amount columns now use only the space they need.
- Product names are less likely to look cramped.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice with product names and VAT amounts.
4. Confirm the product name column has more space.
5. Confirm the amount columns still fit neatly on the right.

### Why This Helps

- Product names are easier to read.
- The invoice table looks more balanced.

## September 3, 2026 - Classic v8 Column Widths Rebalanced

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with better balanced product and amount columns.
- Right-side amount columns now take less extra space.
- The product name column has more room again.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice.
4. Confirm the right-side columns are not too wide.
5. Confirm product names and amount values still fit clearly.

### Why This Helps

- The invoice table looks more balanced.
- Product names and amount values are easier to read together.

## September 3, 2026 - Classic v8 Contact And Column Spacing Improved

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with the contact number aligned to the right.
- Product table columns now adjust more naturally to the invoice content.
- Amount and VAT values have more room to stay inside the table.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice with prices and VAT.
4. Confirm the contact number appears on the right side.
5. Confirm the product table columns fit the values better.

### Why This Helps

- The invoice header looks more balanced.
- The product table is easier to read.
- Amount values are less likely to overflow.

## September 3, 2026 - Classic v8 Sr Column Border Fixed

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with a complete Sr/# column border.
- The blank area under the Sr/# column now lines up properly with the product table.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice.
4. Confirm the Sr/# column border looks complete in the blank item area.

### Why This Helps

- The invoice table looks cleaner.
- The product table border looks properly finished.

## September 3, 2026 - Classic v8 Final Amount Column Widened

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with more space for the final amount.
- The **Amount Inc VAT** column is wider.
- Total values at the bottom fit better inside the table border.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice with VAT and totals.
4. Confirm the final amount values stay inside the right-side table border.

### Why This Helps

- The final total is easier to read.
- Printed invoices look cleaner when larger amounts are shown.

## September 3, 2026 - Classic v8 Header Spacing Reduced

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with less empty space above the invoice title.
- The invoice title now sits closer to the logo or letterhead area.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice.
4. Confirm there is less blank space between the logo area and invoice title.

### Why This Helps

- The invoice header looks tighter and cleaner.
- More page space is available for invoice details.

## September 3, 2026 - Classic v8 Amount Headers Are Easier To Read

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with clearer amount column headings.
- **Amount (Exc VAT)** and **Amount (Inc VAT)** now show on two lines.
- The amount headings fit better in the product table.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice.
4. Confirm the amount headings show neatly on two lines.

### Why This Helps

- The invoice table heading is easier to read.
- The amount columns look less crowded.

## September 3, 2026 - Classic v8 Amount Columns Are Wider

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with wider amount columns.
- Price, VAT, and total amount values are easier to read.
- The **Amount Inc VAT** column now has more space.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice with product prices and VAT.
4. Confirm the right-side amount columns have more space.
5. Confirm the final amount values are easier to read.

### Why This Helps

- Printed invoices look cleaner.
- Customers can read prices and totals without cramped numbers.

## September 3, 2026 - Classic v8 Invoice Header Improved

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with a cleaner header.
- The invoice title now appears centered above the customer and invoice details.
- Customer details show on the left, while invoice number and date show on the right.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice.
4. Confirm the invoice title is centered above the product table.
5. Confirm customer details are on the left and invoice details are on the right.

### Why This Helps

- The invoice header is easier to read.
- The printed invoice looks closer to standard business invoice formats.

## September 3, 2026 - Classic v8 Invoice Table Border Fixed

### What Users Can Do

- Users can print **Classic v8 for Sale** invoices with a complete table border.
- The bottom line of the product table now continues properly across the blank item area.
- The totals area still stays aligned at the bottom-right of the table.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Print or preview a sale invoice.
4. Confirm the product table border is complete near the totals area.

### Why This Helps

- Printed invoices look cleaner.
- The product table looks properly closed and easier to read.

## September 3, 2026 - Classic v8 Sale Invoice Table Looks Cleaner

### What Users Can Do

- Users can print sale invoices with a cleaner **Classic v8 for Sale** item table.
- The product table now has a colored heading row.
- The item area keeps clear column lines, even when there are only a few products.
- Invoice totals now line up neatly under the product table amount area.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Select a layout that uses **Classic v8 for Sale**.
3. Save the invoice layout.
4. Print or preview a sale invoice.
5. Confirm the product table has a colored heading row.
6. Confirm the totals are aligned at the bottom-right of the product table.

### Why This Helps

- Sale invoices look more organized and professional.
- Customers can read item details and final totals more easily.
- The Classic v8 design is easier to compare with printed invoice formats.

## September 2, 2026 - Classic v8 Sale Invoice Design Added

### What Users Can Do

- Users can now choose **Classic v8 for Sale** from the invoice layout design list.
- The new design starts with the same look as **Classic for Sale**.
- Users can keep using the original Classic design while testing or changing Classic v8 separately.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Add a new invoice layout or edit an existing one.
3. Open the **Design** dropdown.
4. Select **Classic v8 for Sale**.
5. Save the invoice layout.
6. Print or preview a sale invoice using that layout.
7. Confirm the invoice opens with the Classic sale invoice style.

### Why This Helps

- Users get a separate Classic v8 design for future invoice changes.
- The current Classic design can stay unchanged.
- Businesses can test the new invoice design before using it fully.

## September 2, 2026 - Classic Sale Invoice SKU Column Is Clearer

### What Users Can Do

- Users can set a custom **SKU Label**, such as **Design**, for the Classic sale invoice.
- The label now appears only as the column heading.
- The product row shows only the SKU value, without repeating the label before it.
- Longer SKU values stay on one line in the Classic sale invoice table.

### How To Check

1. Go to **Settings > Invoice Settings > Invoice Layouts**.
2. Add or edit a layout that uses **Classic for Sale**.
3. Enter a SKU Label, such as **Design**.
4. Tick **Show SKU**.
5. Save the invoice layout.
6. Print or preview a sale invoice using that layout.
7. Confirm the SKU column heading shows the label.
8. Confirm the product row shows only the SKU value and does not split after the dash.

### Why This Helps

- Sale invoices are easier to read when a custom SKU label is used.
- The SKU column looks cleaner because the label is not repeated in every product row.
- Staff can check product design or SKU numbers without confusing line breaks.

## September 2, 2026 - Purchase Date Warning Fixed On Edit Purchase

### What Users Can Do

- Users can edit and save a purchase even when the **Purchase Date** is already selected.
- The page no longer shows **The transaction date field is required** when the purchase date is visible on the form.
- If purchase date editing is not allowed for the user, the saved purchase date is still kept correctly.

### How To Check

1. Go to **Purchases**.
2. Open any purchase for editing.
3. Confirm the **Purchase Date** is showing on the page.
4. Save the purchase.
5. Confirm the purchase saves without the transaction date warning.

### Why This Helps

- Staff can update purchase details without getting stuck on a wrong date warning.
- The purchase date remains clear and reliable during editing.
- Users do not need to reselect a date that is already showing on the page.

## September 1, 2026 - Home Page Shows Current Stock Value

### What Users Can Do

- Users can now see the **Current Stock Value** on the home page.
- The value is shown inside the main sales overview cards.
- If a business location is selected, the value shows stock for that selected location.
- If no single location is selected, the value shows stock for all locations the user is allowed to view.
- Users can click the card to open the full Stock Value Report.

### How To Check

1. Go to the **Home** page.
2. Look at the **Total Sales Overview** section.
3. Check the **Current Stock Value** card.
4. Select a business location from the home page filter if needed.
5. Confirm the stock value changes for the selected location.
6. Click the card and confirm the Stock Value Report opens.

### Why This Helps

- Staff can quickly see the value of available stock from the home page.
- Users do not need to open the full report just to check the current stock value.
- Location-wise stock checking is faster and easier.

## September 1, 2026 - Stock Performance Report Shows Correct On Hand Quantity

### What Users Can Do

- Users can check the **On Hand** quantity in the Stock Performance Report with more confidence.
- The **On Hand** value now matches the quantity shown in the product stock quantity enquiry.
- When a business location is selected, the report shows the stock for that selected location.
- When all allowed locations are included, the report total matches the product quantity enquiry total.

### How To Check

1. Go to **Reports > Stock Performance Report**.
2. Select the required business location.
3. Search for a product by SKU, such as **111723**.
4. Check the **On Hand** quantity in the report.
5. Open the product quantity enquiry for the same product.
6. Confirm the selected location quantity matches the report.
7. Select all allowed locations if needed and confirm the total quantity also matches.

### Why This Helps

- Staff can trust the stock quantity shown in the Stock Performance Report.
- Product stock checking is clearer when comparing reports with the quantity enquiry.
- This reduces confusion when reviewing product stock by location.

## September 1, 2026 - Contact Ledger Format 1 A4 Print Is Easier To Read

### What Users Can Do

- Users can print **Contact Ledger - Format 1** on A4 with clearer table text.
- The print preview adjusts the ledger table text size based on the selected page layout.
- If fewer columns are shown, the table text becomes larger.
- If more columns are shown, the table stays fitted inside the A4 page.
- Debit, Credit, and Balance amounts now have more space in the print preview.
- The A4 print preview no longer shows the ledger table squeezed at the right side.

### How To Check

1. Open any customer, supplier, or barterer contact.
2. Go to the **Ledger** tab.
3. Select **Format 1**.
4. Use **Column visibility** to show or hide the columns you need.
5. Click **Print A4**.
6. Choose **Portrait** or **Landscape**.
7. Confirm the table text is easier to read.
8. Confirm the Debit, Credit, and Balance amounts fit inside the page.
9. Click **Print A4** in the preview if the page looks correct.

### Why This Helps

- Printed ledgers are easier for staff and customers to read.
- Users can hide unnecessary columns and get a cleaner printout.
- Amount columns are less likely to overlap or move outside the page.
- Portrait and landscape printouts are easier to use for different ledger sizes.

## September 1, 2026 - Product Labels Are Easier To Align And Print

### What Users Can Do

- Users can print product labels with the selected details centered on the label.
- Product name, price, barcode, and SKU can appear neatly in the middle of the label.
- Users can print only the product name when a simple name label is needed.
- Users can now choose whether to show **SKU** separately from the barcode.
- The **SKU** option has its own size field.
- Price on labels now shows only the currency symbol and amount, without the word **Price**.
- Barcode and SKU labels have more space, so the SKU is easier to see under the barcode.
- If a product code does not match the selected barcode style, the label preview can still open and print using a supported barcode style.

### How To Check

1. Go to **Products > Print Labels**.
2. Add a product for label printing.
3. Select the label details you want, such as product name, price, barcode, and SKU.
4. Use the new **SKU** checkbox if you want the SKU number to print.
5. Change the product name size or SKU size if needed.
6. Click **Preview**.
7. Confirm the selected details are centered on the label.
8. Confirm the SKU is visible under the barcode when **SKU** is selected.
9. Confirm the price shows only the currency symbol and amount.
10. Try a product code that does not match the selected barcode style and confirm the label preview still opens.

### Why This Helps

- Printed labels look cleaner and easier to read.
- Staff can choose whether the SKU should appear on the label.
- Simple product-name labels are easier to print.
- Price labels look shorter and clearer for customers.
- SKU numbers are easier to check during product handling and scanning.
- Staff do not get stuck on the barcode preview when one product code needs a different barcode style.

## September 1, 2026 - Cash Register Closing Can Print On The Receipt Printer

### What Users Can Do

- Users can close the cash register and print the closing details from the same flow.
- When the business location has a receipt printer selected, the closing slip is sent to that printer.
- The **Close and Print** button now opens the closing details and sends them for printing.
- The **Print** button inside the closing details popup also sends the closing slip to the receipt printer.
- If automatic printing is not available, users can still print from the normal print window.

### How To Check

1. Open the **POS** screen with an open cash register.
2. Click **Close Register**.
3. Enter the closing details.
4. Click **Close and Print**.
5. Confirm the register is closed.
6. Confirm the closing details popup opens.
7. Confirm the closing slip prints from the receipt printer.
8. Open the closing details popup again if needed.
9. Click **Print** and confirm the closing slip prints again.

### Why This Helps

- Staff can keep a printed closing slip at the end of the shift.
- Cashiers do not need to print the closing details separately from another screen.
- Managers get a clearer printed record for daily cash checking.
- The closing print process works better for counters that print daily slips.

## September 1, 2026 - Sales Order Status Updates After Invoice

### What Users Can Do

- Users can create a sale invoice from a sales order.
- After the invoice is made, the sales order status updates automatically.
- If the full sales order quantity is invoiced, the sales order shows as **Completed**.
- If only part of the sales order quantity is invoiced, the sales order shows as **Partial**.
- The **Quantity Remaining** column shows the correct remaining quantity.
- Completed sales orders no longer stay incorrectly marked as **Ordered**.

### How To Check

1. Go to **Sales Order**.
2. Open a sales order that still shows **Ordered**.
3. Create a sale invoice from that sales order.
4. Return to the **Sales Order** list.
5. Confirm the sales order status has changed to **Completed** or **Partial**.
6. Confirm the remaining quantity is correct.

### Why This Helps

- Staff can quickly see which sales orders are still pending.
- Completed orders are easier to separate from open orders.
- Users do not need to update the sales order status manually after making an invoice.
- Sales order follow-up is clearer and faster.

## September 1, 2026 - Sale Invoice Can Show Total Before Tax And Tax Percentage

### What Users Can Do

- Users can add a **Total before tax** column to the classic sale invoice.
- Users can add a **Tax %age** column to the classic sale invoice.
- These columns can be controlled from the invoice layout settings.
- If the label is left blank, that column will not show on the classic sale invoice.
- If a label is entered, the column will show for each product line.
- The **Tax %age** column shows only the tax percentage for each product line.

### How To Check

1. Go to **Settings > Invoice Settings**.
2. Open **Invoice Layouts**.
3. Create a new layout or edit an existing layout.
4. In product details, enter a label for **Total before tax label** if you want that column.
5. Enter a label for **Tax %age label** if you want that column.
6. Save the invoice layout.
7. Print or preview a sale invoice using the classic sale layout.
8. Confirm the selected columns are shown for each product line.
9. Clear either label and save again to hide that column.

### Why This Helps

- Staff can show tax details more clearly on sale invoices.
- Customers can see the amount before tax and the tax percentage separately.
- Businesses can choose only the columns they need on their invoice.

## August 29, 2026 - Purchase Discount Labels Are Easier To Manage

### What Users Can Do

- Users can set their own names for **Invoice Discount** and **Invoice Discount 2** from **Business Settings > Purchase**.
- The chosen discount names are shown on purchase create and purchase edit pages.
- Purchase order create and edit pages now show both purchase discount options.
- Purchase return create and edit pages now show both purchase discount options.
- Purchase returns made from an existing purchase also include both discount amounts.
- Purchase details, receiving slip details, purchase reports, purchase invoice reports, purchase return reports, and profit/loss details show the same purchase discount names.

### How To Check

1. Go to **Settings > Business Settings > Purchase**.
2. Turn on **Enable Total Discount on Purchase** and enter the label you want to use.
3. Turn on **Enable Total Discount 2 on Purchase** and enter the second discount label you want to use.
4. Save the settings.
5. Go to **Purchases > Add Purchase** and confirm both discount labels are shown.
6. Open an existing purchase for editing and confirm both discount labels are shown.
7. Go to **Purchases > Purchase Order** and create or edit a purchase order.
8. Confirm both purchase discount labels are shown on the purchase order page.
9. Create or edit a **Purchase Return** and confirm both purchase discount labels are shown.
10. View purchase details, purchase reports, and purchase return reports and confirm the same discount names are shown.

### Why This Helps

- Businesses can use purchase discount names that match their own billing style.
- Staff can understand purchase discounts more easily.
- Purchase, purchase order, purchase return, and report screens now use the same wording.

## August 29, 2026 - Add Sale Payment Rows Keep The Payment Type Selected

### What Users Can Do

- On **Sell > Add Sale**, users can split one sale payment into more than one payment row.
- When users click **Add Payment Row**, the new row now keeps the correct payment type selected.
- The payment type follows the default payment option set for the selected business location.
- For example, if the customer pays part of the bill first and the remaining amount is added in a second payment row, the second row also shows the correct payment type.

### How To Check

1. Go to **Sell > Add Sale**.
2. Select the required business location.
3. Add products to make a sale total.
4. Enter a partial payment amount in the first payment row.
5. Confirm the payment type is selected.
6. Click **Add Payment Row**.
7. Confirm the new row shows the remaining balance.
8. Confirm the payment type is also selected in the new row.

### Why This Helps

- Staff do not need to select the payment type again for every new payment row.
- Split payments are faster and easier to enter.
- The sale payment area now follows the business location payment settings more clearly.

## August 29, 2026 - POS Opens Without Empty Cart Warning

### What Users Can Do

- Staff can open the **POS** screen without seeing a red warning when no product has been added yet.
- The POS screen stays ready for normal billing when the cart is empty.
- Staff will still see a message if they try to complete a sale without adding any product.
- If products are added quickly, staff should wait until the items appear in the bill before saving or taking payment.

### How To Check

1. Open the **POS** screen.
2. Confirm no red warning appears just because the bill is empty.
3. Add a product and confirm it appears in the bill area.
4. Try to complete a sale without any product and confirm the screen tells the staff to add products first.
5. Add products normally and complete the sale.

### Why This Helps

- Staff are not distracted by a warning when they first open POS.
- The empty POS screen feels cleaner and easier to start using.
- Real mistakes are still shown clearly before a sale is completed.
- Billing is smoother during busy counter sales.

## August 29, 2026 - Contact Ledger Print And PDF Are Easier To Read

### What Users Can Do

- Users can print customer or supplier ledgers with a cleaner layout.
- The **Invoices Due Statement** heading is now centered properly.
- The **To** customer or supplier details are shown on the left side.
- Extra empty space around the **To** details has been reduced.
- Ledger table borders are clearer on printed copies.
- The same cleaner layout is used when users export the ledger to **PDF**.
- These improvements apply to all ledger formats.

### How To Check

1. Go to a customer or supplier ledger.
2. Choose any ledger format.
3. Click the print option.
4. Confirm the ledger heading is centered.
5. Confirm the **To** details are shown on the left side.
6. Confirm there is less empty space before the ledger table.
7. Confirm the ledger table borders are clear.
8. Export the ledger to **PDF** and check the same layout there.

### Why This Helps

- Printed ledgers look neater and easier to read.
- Staff can quickly find the customer or supplier details.
- PDF copies match the printed layout better.
- Ledger records are clearer for sharing, filing, and customer follow-up.

## August 29, 2026 - Sales Can Be Deleted More Reliably

### What Users Can Do

- Users can delete a sale from the sales list even when the sale was connected to an old sales order.
- If a sale cannot be deleted for any reason, the screen now shows an error message instead of giving no response.
- The sale delete process is clearer for staff because it no longer fails silently.

### How To Check

1. Go to **Sell > List Sales**.
2. Find a sale that needs to be removed.
3. Click **Delete** from the sale action menu.
4. Confirm the delete action.
5. Check that the sale is removed from the list.
6. If the sale cannot be removed, confirm that a message is shown on the screen.

### Why This Helps

- Staff can remove wrong sales more confidently.
- Users get clear feedback after pressing delete.
- Sales list cleanup is easier during daily work.

## August 29, 2026 - Sale Total Shows Current And Previous Due

### What Users Can Do

- On **Sell > Add Sale**, users can now see the current bill amount as **Total Receivable Current**.
- After selecting a customer, the customer's previous due is still shown near the customer name.
- The bottom total area now shows **Total Receivable with Previous**.
- **Total Receivable with Previous** adds the customer's previous due and the current bill amount together.
- This helps users quickly know the full amount receivable from the selected customer.

### How To Check

1. Go to **Sell > Add Sale**.
2. Select a customer who has a previous due amount.
3. Add products to the sale.
4. Check the bottom total area.
5. Confirm **Total Receivable Current** shows the current bill amount.
6. Confirm **Total Receivable with Previous** shows previous due plus the current bill amount.
7. Change the products or quantity and confirm the total updates.
8. Select another customer and confirm the previous due amount changes correctly.

### Why This Helps

- Staff can see the customer's full receivable amount without manual calculation.
- It is easier to collect both the old due and the current bill amount.
- The sale screen is clearer for customers who already owe money.

## August 29, 2026 - Change Return Can Be Turned Off For Sales

### What Users Can Do

- Users can turn on **Disable Change Return on Overpay** from **Business Settings > Sales**.
- When this option is turned on, the payment area does not show **Change Return**.
- This works on **POS**, **Sell > Add Sale**, and sale edit pages.
- If staff enter more than the bill amount, the screen stays simple and does not show a separate change return amount.

### How To Check

1. Go to **Settings > Business Settings > Sales**.
2. Turn on **Disable Change Return on Overpay**.
3. Save the settings.
4. Open **POS** or **Sell > Add Sale**.
5. Add products and open the payment area.
6. Enter a payment amount higher than the bill amount.
7. Confirm the **Change Return** section is not shown.
8. Save the sale normally.

### Why This Helps

- Businesses that do not use change return can keep the payment area simpler.
- Staff see fewer payment fields while completing a sale.
- Staff can finish overpaid sales without seeing an extra change return section.

## August 29, 2026 - Sale Discount Labels And Return Discounts Are Easier To Manage

### What Users Can Do

- Users can set their own names for **Invoice Discount** and **Invoice Discount 2** from **Business Settings > Sales**.
- The chosen discount names are shown on sale create and sale edit pages.
- The chosen discount names are also shown on sales order create and sales order edit pages.
- Sale return create and edit pages now show both discount options, including **Invoice Discount** and **Invoice Discount 2**.
- Sale returns use the selected discount names from business settings.
- Sale invoices, sale details, sale reports, and discount popups show the same discount names, so the wording stays consistent.
- The sale edit page discount area is now arranged like the sale create page, making it easier to read and fill.

### How To Check

1. Go to **Settings > Business Settings > Sales**.
2. Turn on **Enable Total Discount on Sale** and enter the label you want to use.
3. Turn on **Enable Total Discount 2 on Sale** and enter the second discount label you want to use.
4. Save the settings.
5. Go to **Sell > Add Sale** and confirm both discount labels are shown.
6. Open an existing sale for editing and confirm the discount area is aligned clearly.
7. Create or edit a **Sales Order** and confirm both discount labels are shown there too.
8. Create or edit a **Sale Return** and confirm both discount options are available with the same labels.
9. View or print a sale invoice, or open sale reports, and confirm the same discount names are shown.

### Why This Helps

- Businesses can use discount names that match their own billing style.
- Staff can understand the first and second discount more easily.
- Sale, sales order, return, invoice, and report screens now use the same wording.
- The sale edit screen is easier to use because the discount fields are better aligned.

## August 28, 2026 - Contact List Print A4 And PDF Are Easier To Use

### What Users Can Do

- Users can print the customer, supplier, or barterer list using the new **Print A4** button on the contact list page.
- The print preview follows the selected contact type, filters, search text, and sorting.
- If users hide columns with **Column visibility**, **Print A4** now prints only the columns currently shown on the contact list.
- Users can export the same contact list to **PDF** or **Excel** from the print preview.
- Contact list print pages now use page space better, so fewer large blank areas appear.
- PDF exports now use a larger, easier-to-read text size.
- The country filter now works correctly with the contact list print option.

### How To Check

1. Go to **Contacts > Customers**, **Suppliers**, or **Barterers**.
2. Apply any filters you need, such as location, city, state, country, status, payment status, or balance filters.
3. Search or sort the list if needed.
4. Use **Column visibility** to hide any columns that are not needed.
5. Click **Print A4**.
6. Confirm the print preview opens with the same filtered contact list and only the visible columns.
7. Check that the pages are filled properly and do not move rows to the next page too early.
8. Click **PDF** in the print preview.
9. Confirm the PDF text is easier to read and the pages do not show extra blank pages between contact rows.
10. Click **Excel** if a spreadsheet copy is needed.

### Why This Helps

- Users can keep printed contact lists for daily checking, office records, or customer/supplier review.
- Printed and downloaded copies match the contact list users are viewing.
- Users can hide private or unnecessary columns before printing.
- PDF copies are clearer to read.
- Less paper is wasted because contact rows fit better on each page.

## August 28, 2026 - Label Print Settings Stay Saved

### What Users Can Do

- Users can choose what information should appear on product labels.
- Label options such as barcode, product name, variation, unit, category, price, discount price, business name, packing date, lot number, and expiry date now stay saved.
- Font sizes and label font style now stay saved after previewing or printing labels.
- The selected barcode or label design stays selected the next time users open the label screen.
- Users can turn any label option on or off without the page resetting everything back to checked.
- The label product table now shows the total number of products in the footer.

### How To Check

1. Go to **Products > Print Labels**.
2. Add a product for printing.
3. Tick only the label details you want to print.
4. Change one or more font sizes or the label font style.
5. Choose a barcode setting or label design.
6. Click **Preview Labels**.
7. Return to the label screen.
8. Confirm the same ticked options, sizes, font style, and selected label setting are still shown.
9. Check the product table footer and confirm the total number of products is shown.

### Why This Helps

- Users do not need to select the same label options again and again.
- Label printing is faster for repeated daily use.
- Product labels are more consistent because the chosen layout settings are remembered.
- Users can quickly see how many products have been added for label printing.

## August 28, 2026 - Stock Transfer Save, Print, And Rack Details Are Easier To Use

### What Users Can Do

- Users can save a new stock transfer without seeing an extra **Leave site?** warning after it has already saved.
- After saving a stock transfer, users are taken back to the stock transfer list correctly.
- Users can open the **Update Status** popup clearly from the stock transfer list.
- Users can use **Save & Print** when creating a completed stock transfer.
- Users can use **Save & Print** when editing a stock transfer.
- After printing, users are returned to the stock transfer list more quickly.
- Stock transfer printouts now show rack movement in one line, such as **From Rack: A053 > To Rack: UP050**.
- The stock transfer view popup also shows the same **From Rack > To Rack** detail.
- The printout opened from the stock transfer view popup also shows the **From Rack > To Rack** detail.
- On the stock transfer edit page, clicking the calendar icon now opens the date picker.

### How To Check

1. Go to **Stock Transfers > Add Stock Transfer**.
2. Add a product, choose locations, and save the transfer.
3. Confirm the success message shows and no extra leave warning appears after saving.
4. Create a completed stock transfer and click **Save & Print**.
5. Confirm the print preview opens, then confirm the page returns to the stock transfer list.
6. Open an existing stock transfer, change details if needed, and click **Save & Print**.
7. Confirm the updated transfer is saved, the print preview opens, and the page returns to the stock transfer list.
8. On the stock transfer list, click a transfer status and confirm the **Update Status** popup appears in front of the page.
9. Print or view a stock transfer with rack details and confirm the product line shows **From Rack > To Rack**.
10. Open the stock transfer edit page and click the calendar icon beside the date field.
11. Confirm the date picker opens.

### Why This Helps

- Staff get clearer feedback when saving and printing stock transfers.
- Users do not need to manually return to the stock transfer list after printing.
- Rack movement is easier to read on screen and on printed copies.
- The edit page date field is easier to change.
- The stock transfer workflow feels smoother from entry to printout.

## August 28, 2026 - Cash Register Close And Print Works More Reliably

### What Users Can Do

- Users can close the cash register and print the closing details.
- After pressing **Close & Print**, the register closing details popup opens more reliably.
- The **Print** button on the register closing details popup now prints the closing information instead of a blank page.
- Non-admin users who are allowed to close the register can also see the closing details popup after closing.
- If the closing details cannot be opened, users now see a message instead of getting no response.

### How To Check

1. Open the POS screen with an open cash register.
2. Click **Close Register**.
3. Enter the closing details.
4. Click **Close & Print**.
5. Confirm the register is closed.
6. Confirm the register closing details popup opens.
7. Click **Print**.
8. Confirm the print preview shows the register closing information.
9. Repeat the same check with a non-admin user who has permission to close the register.

### Why This Helps

- Staff can print register closing details without repeating the close process.
- Cashiers and managers can review closing information immediately after closing the register.
- Non-admin users have a smoother register closing process.
- Register closing records are easier to print and keep for daily checking.

## August 28, 2026 - Contact Ledger Printouts Are Easier To Read

### What Users Can Do

- Users can print or download contact ledger reports in all available formats.
- Ledger tables now fit better on the printed page.
- Table headings and amounts are easier to read.
- Format 1, Format 3, and Format 4 print in **Landscape** view.
- Format 2, Format 5, and Format 6 print in **Portrait** view.
- The **Hide Account Summary**, ageing, clearing, and footer options can still be used when printing the ledger.

### How To Check

1. Open any customer or supplier.
2. Go to the **Ledger** tab.
3. Choose **Format 1** and download or print the PDF.
4. Confirm the table is readable and prints in **Landscape** view.
5. Choose **Format 2** and download or print the PDF.
6. Confirm the table is readable and prints in **Portrait** view.
7. Repeat the same check for **Format 3**, **Format 4**, **Format 5**, and **Format 6**.
8. Confirm **Format 5** and **Format 6** also print in **Portrait** view.

### Why This Helps

- Ledger printouts are clearer for staff and customers.
- Users do not need to adjust the page direction manually for each format.
- Amounts, dates, and reference numbers are easier to check on printed copies.

## August 28, 2026 - Classic 2 Invoice Details Are Easier To Read

### What Users Can Do

- Users can print sales invoices using the **Classic 2** design.
- The middle invoice details box now starts its text from the left side.
- The customer box, invoice details box, and other details box now look more consistent.

### How To Check

1. Go to **Settings > Invoice Settings > Layout**.
2. Open or select a sale invoice layout that uses **Classic 2** design.
3. Print or preview a sale invoice.
4. Check the box that shows **Invoice No.**, **Date**, and **Prepared by**.
5. Confirm the text starts from the left side like the other boxes.

### Why This Helps

- Printed invoices look neater and more balanced.
- Invoice details are easier to read at a glance.
- Staff and customers see a cleaner invoice layout.

## August 28, 2026 - Rack Details Update More Safely In Purchases

### What Users Can Do

- Users can still enter **Rack**, **Row**, and **Position** while making a purchase order.
- Purchase orders will keep these rack details for that order only.
- Changing rack details in a purchase order will not change the product's saved rack details.
- On normal purchases, the product's saved rack details will update only when the purchase status is **Received**.
- If a normal purchase is not **Received**, the rack details stay on that purchase only.

### How To Check

1. Go to **Purchases > Purchase Order**.
2. Add or edit a purchase order.
3. Enter or change **Rack**, **Row**, or **Position** in the product row.
4. Save the purchase order.
5. Open the product and confirm its saved rack details did not change.
6. Go to **Purchases > Add Purchase** or edit a normal purchase.
7. Change **Rack**, **Row**, or **Position** while the purchase status is not **Received**.
8. Save and confirm the product's saved rack details did not change.
9. Change the purchase status to **Received** and save again.
10. Confirm the product's saved rack details are updated.

### Why This Helps

- Purchase orders can record planned rack details without changing product setup.
- Product rack details change only after stock is actually received.
- Staff have less chance of changing product rack details too early by mistake.

## August 28, 2026 - Hide Account Summary Works On Contact Ledger

### What Users Can Do

- Users can now hide **Account Summary** on the contact ledger from **Business Settings > Merchants**.
- When this setting is turned on, the contact ledger opens with the account summary hidden.
- Users can still show or hide the account summary from the ledger screen when needed.
- The same setting works on the available contact ledger formats.

### How To Check

1. Go to **Settings > Business Settings**.
2. Open the **Merchants** tab.
3. Turn on **Hide Account Summary on Ledger**.
4. Save the settings.
5. Open any customer or supplier.
6. Go to the **Ledger** tab.
7. Confirm the **Account Summary** section is hidden.
8. Untick the hide option on the ledger screen if you want to show the account summary again.

### Why This Helps

- Ledger pages can be kept cleaner for users who do not need the account summary.
- Staff do not need to hide the account summary manually every time.
- Contact ledger viewing and printing is easier to control.

## August 28, 2026 - Purchase Status Popup Opens Correctly

### What Users Can Do

- Users can now open the **Update Status** popup from the purchases list without the screen covering it.
- Users can clearly see the purchase status field.
- Users can choose the new purchase status and press **Update** normally.
- Users can close the popup normally when no change is needed.

### How To Check

1. Go to **Purchases > Purchases List**.
2. Open the **Actions** menu for any purchase.
3. Click **Update Status**.
4. Confirm the **Update Status** popup is clear and easy to use.
5. Change the purchase status if needed.
6. Click **Update** and confirm the popup closes after saving.

### Why This Helps

- Users can update purchase status without confusion.
- The popup is easier to read and use.
- Purchase list work is smoother for staff.

## August 28, 2026 - Sale And Quotation Status Control Per User

### What Users Can Do

- Admin users can now control **Readonly Sale Status** from **User Settings > Sale**.
- This setting is no longer shown in **Business Settings > Sale**.
- Each user can have their own sale status permission.
- On **Add Quotation** and **Edit Quotation**, users can now choose only **Quotation** or **Proforma invoice**.
- **Quotation** is selected by default when adding a quotation.
- Admin users can turn on **Readonly Quotation Status** from **User Settings > Sale** to stop a user from changing the quotation status.

### How To Check

1. Go to **Users**.
2. Open a user's **Settings**.
3. Go to the **Sale** tab.
4. Check **Readonly Sale Status** and **Readonly Quotation Status**.
5. Open **Business Settings > Sale** and confirm **Readonly Sale Status** is no longer shown there.
6. Go to **Sales > Quotations List**.
7. Click **Add Quotation**.
8. Check that the **Status** field shows only **Quotation** and **Proforma invoice**.
9. Edit a quotation and check that the same two status options are shown.

### Why This Helps

- Admin users can give different sale and quotation controls to different users.
- Users see fewer status choices when working with quotations.
- Quotation entry is simpler and less confusing.
- Important sale or quotation statuses can be protected from accidental changes.

## August 28, 2026 - Customer Note Shown In Sales Lists And Reports

### What Users Can Do

- Users can now see **Customer note** after **Customer name** in the sales list.
- Users can now see **Customer note** after **Customer name** in the Sale Invoices Report summary.
- Users can now see **Customer note** after **Customer name** in the Sales Returns Report.
- Users can now see **Customer note** after the customer column in the Sale Payment Report.
- Printed and exported report copies also include the customer note where the report shows it.

### How To Check

1. Go to **Sell > List Sales**.
2. Check that **Customer note** is shown after **Customer name**.
3. Go to **Reports > Sale Invoices Report** and open the **Summary** tab.
4. Check that **Customer note** is shown after **Customer name**.
5. Go to **Reports > Sales Returns Report**.
6. Check that **Customer note** is shown after **Customer name**.
7. Go to **Reports > Sale Payment Report**.
8. Check the customer rows and sale payment detail rows for the **Customer note** column.
9. Print or export the report if needed and confirm the customer note is included.

### Why This Helps

- Users can review customer instructions or reminders directly from sales and payment reports.
- Users do not need to open each sale one by one to check the customer note.
- Sales, return, and payment checking is clearer and faster.

## August 28, 2026 - Invoice Scheme Shown More Clearly

### What Users Can Do

- When users edit a quotation, the **Invoice scheme** field now shows the same scheme that was used when the quotation was created.
- The invoice scheme no longer changes back to another scheme when opening the edit page.
- The sale details popup now shows **Invoice Scheme** along with **Layout name**.
- Users can now check both the invoice layout and invoice scheme from the sale details popup.
- When users change the business location on sale or quotation pages, the invoice scheme and invoice layout now change to match that location.
- Sale pages use the selected location's sale invoice settings.
- Quotation pages use the selected location's quotation invoice settings.

### How To Check

1. Open **Sales > Quotations List**.
2. Edit a quotation and check the **Invoice scheme** field.
3. Confirm it shows the scheme saved with that quotation.
4. Open the quotation or sale details popup.
5. Confirm **Invoice Scheme** is shown near **Layout name**.
6. Open an add sale or add quotation page.
7. Change the business location and confirm the invoice scheme and layout change to match the selected location.

### Why This Helps

- Users can confirm which invoice scheme was used without opening settings.
- Quotation editing is clearer because the saved invoice scheme is shown correctly.
- Sale details are easier to review before printing or checking records.
- Users can switch locations with less manual checking.

## August 27, 2026 - Sales And Quotation Settings Follow Business Location

### What Users Can Do

- The **Show invoice scheme** setting now works the same on add and edit sale pages.
- If **Show invoice scheme** is turned off, the invoice scheme field stays hidden on both pages.
- The quotation page now selects the default customer from the sales settings.
- Sales and quotations now use the invoice scheme and invoice layout selected in the business location settings.
- Sales use the sale invoice settings from the selected business location.
- Quotations use the quotation invoice settings from the selected business location.
- If a customer has their own invoice layout selected, that customer layout is used.
- If a customer does not have their own invoice layout selected, the business location layout is used.

### How To Check

1. Go to **Business Settings > Sales**.
2. Turn **Show invoice scheme** off and open add or edit sale pages.
3. Confirm the invoice scheme field is hidden.
4. Set a **Default Customer** in the sales settings.
5. Open **Add Quotation** and confirm the customer is selected automatically.
6. Go to **Business Locations** and check the sale and quotation invoice settings.
7. Open a sale or quotation for that location and confirm the matching invoice scheme and layout are selected.
8. Select another customer and confirm the layout only changes when that customer has its own invoice layout selected.

### Why This Helps

- Users get the same settings behavior on sale and quotation pages.
- Users do not need to manually select the correct customer, invoice scheme, or invoice layout every time.
- Business location settings are followed more clearly.
- Customer-specific invoice layouts still work when needed.

## August 27, 2026 - Current Stock Quantity In Supplier List

### What Users Can Do

- Users can now see a **Current stock Quantity** column in the supplier list.
- The column appears after **Number of Transactions**.
- It shows the supplier's current stock quantity from the supplier Stock Quantity Report.
- The supplier list quantity now matches the **Current Stock Quantity** total shown in the report.
- Users can also see the current stock quantity total at the bottom of the supplier list.

### How To Check

1. Go to **Contacts > Suppliers**.
2. Find the **Number of Transactions** column.
3. Check the **Current stock Quantity** column beside it.
4. Open a supplier and go to the **Stock Quantity Report** tab.
5. Confirm the supplier list quantity matches the **Current Stock Quantity** total shown in the report.

### Why This Helps

- Users can quickly see the stock quantity linked with each supplier.
- Users do not need to open every supplier one by one to check the quantity.
- The supplier list is easier to review and compare.

## August 27, 2026 - Hide Zero Balance Shows Customers With Due Amount

### What Users Can Do

- The **Hide Zero Balance** filter now keeps customers in the list when they still have a due amount.
- If a customer has **Total Sale Due**, the customer will still show after ticking **Hide Zero Balance**.
- Customers with no balance and no due amount will stay hidden.

### How To Check

1. Go to **Contacts > Customers**.
2. Search for a customer that has a value in **Total Sale Due**.
3. Tick **Hide Zero Balance**.
4. Confirm the customer still appears in the list.

### Why This Helps

- Users can find customers who still owe money more easily.
- The filter no longer hides customers just because other amounts affect the final balance.
- Customer follow-up is clearer and less confusing.

## August 27, 2026 - Current Stock Value In Supplier List

### What Users Can Do

- Users can now see a **Current Stock Value** column in the supplier list.
- The column appears after **Number of Transactions**.
- It shows the supplier's current stock value from the supplier Stock Quantity Report.
- Users can also see the total current stock value at the bottom of the supplier list.

### How To Check

1. Go to **Contacts > Suppliers**.
2. Find the **Number of Transactions** column.
3. Check the **Current Stock Value** column beside it.
4. Open a supplier and go to the **Stock Quantity Report** tab.
5. Confirm the supplier list value matches the current stock value total shown in the report.

### Why This Helps

- Users can quickly see the stock value linked with each supplier.
- Users do not need to open every supplier one by one to check this value.
- The supplier list is easier to review and compare.

## August 27, 2026 - Last Transaction In Business List

### What Users Can Do

- Superadmin users can now see a **Last Transaction** column in the business list.
- The column appears after **Registered on**.
- It shows the latest transaction date and time for each business.
- If a business has no transactions yet, the column stays empty.
- The exported business list also includes **Last Transaction**.

### How To Check

1. Go to **Superadmin > Business**.
2. Find the **Registered on** column.
3. Check the **Last Transaction** column beside it.
4. Confirm the latest date and time is shown for businesses with transactions.
5. Export the business list if needed and check the same column in the file.

### Why This Helps

- Superadmin users can quickly see which businesses are using the system.
- It is easier to find businesses that have not made recent transactions.
- Users do not need to open each business one by one to check recent activity.
- Exported reports are easier to review.

## August 27, 2026 - Delete Sales From Offline Workstation

### What Users Can Do

- Staff can delete a wrong sale from the offline workstation.
- The deleted sale will no longer appear in the normal sales list.
- After running sales sync, the same deleted sale will also stop showing in the live system.
- Users do not need to delete the same sale again from the live system.

### How To Check

1. Open the offline workstation.
2. Go to **Sell > List POS** or the sales list.
3. Delete a sale that was already sent to the live system.
4. Go to **Offline Sync > Sync Sales**.
5. Open the live system.
6. Check the sales list and confirm the deleted sale is not showing there.

### Why This Helps

- Staff can fix wrong offline sales more easily.
- Offline and live sales lists stay matched.
- Users save time because the sale only needs to be deleted once.

## August 25, 2026 - Correct Business Information

### What Users Can Do

- Each business now sees its own tax list, warranty list, dashboard totals, sales chart, cash register status, and stock progress.
- Staff will not see working information that belongs to another business.
- Branch and user information stays matched with the correct business.

### How To Check

1. Open the correct business login page.
2. Go to **Settings > Tax Rates** and check the tax list.
3. Open the **POS** screen and check the tax selection.
4. Open and close a cash register.
5. Check the dashboard totals and sales chart.
6. Refresh or update stock if needed.
7. Confirm the business only shows its own information.

### Why This Helps

- Business owners and staff see the correct information.
- Reports, POS, cash register, and stock progress are easier to trust.
- This reduces confusion when many businesses use the same system.

## August 24, 2026 - Correct Tax List On POS

### What Users Can Do

- The POS product tax dropdown now shows the tax rates saved for that business.
- Tax names added in **Settings > Tax Rates** will appear on the POS screen.
- Staff will not see tax names from another business.

### How To Check

1. Go to **Settings > Tax Rates**.
2. Check the tax names saved for the business.
3. Open the **POS** screen.
4. Add a product to the bill.
5. Open the tax dropdown in the product row.
6. Confirm the same tax names are shown.

### Example

For Alaska Bar, the POS tax dropdown should show:

- GST ON CARD
- GST ON CASH

### Why This Helps

- Staff can choose the correct tax while making a sale.
- Billing becomes clearer.
- Tax mistakes are reduced.

## August 24, 2026 - AiAssistance Setup For Each Business

### What Users Can Do

- Each business can connect its own OpenAI account for AiAssistance.
- Business owners can set this up from **Settings > AiAssistance (OpenAI)**.
- After setup, staff can use AI tools and the AI Messenger inside the software.
- The AI Messenger can help users understand features, workflows, and reports.
- The setup page includes a simple connection guide.

### How To Set Up

1. Go to **Settings**.
2. Open **AiAssistance (OpenAI)**.
3. Turn on OpenAI for the business.
4. Paste the connection key from the business OpenAI account.
5. Save the settings.
6. Test the connection.
7. Start using AI tools inside the application.

### Important Note

This uses the business owner's own OpenAI account. It does not use a normal ChatGPT website login. Any OpenAI usage cost belongs to the business account that is connected.

### Why This Helps

- Business owners control their own AI account and usage.
- Staff can get help inside the software.
- New users can learn the system faster.
- AI tools can help with product descriptions, reports, business messages, document reading, and business insights.
