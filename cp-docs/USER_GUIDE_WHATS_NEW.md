# What's New - User Guide
**Updated:** 2026-07-23

This guide explains system changes in simple user language. It only includes what users can see, do, check, print, export, or manage in the system.

---

## Version 8.93.0 - 2026-07-23

### FBR POS Integration - Cloud Based POS ID

Important note:
- Cloud-hosted POS businesses must use an FBR POS ID registered as Cloud based in the FBR portal.
- Client-server/offline POS IDs are for desktop or local fiscal service software and should not be used for the hosted cloud POS.
- If a bill prints without the FBR QR code, first check the POS Type in the FBR portal.
- If FBR returns Code 112, register or select a Cloud based POS ID, then save that new POS ID in Business Location > FBR POS ID.
- For the normal cloud POS flow, no IMS_URL or FBR token is needed unless your provider has given a special setup.
- Sales and POS report filters now show Bulk Sync PRA for businesses whose package includes the FBR POS module.
- Sales and POS report filters now show Bulk Sync FBR DI for businesses whose package includes the FBR DI module.
- Bulk Sync FBR POS is no longer available from FBR. FBR POS invoices should submit when the sale is generated.

How to check it:
- Open the FBR portal.
- Go to POS details for the business.
- Confirm the POS Type is Cloud based.
- Copy the Cloud based POS ID.
- Open Business Location in the POS system.
- Paste the POS ID in FBR POS ID and save.
- Generate a new POS bill and verify that FBR Inv No and QR code appear.
- Open Sales or POS Sale list and check the report filters.
- Confirm Bulk Sync PRA or Bulk Sync FBR DI appears only when the related package module is active.

---

## Version 8.92.6 - 2026-07-20

### Reports - Stock Value Report

What works correctly now:
- The As of Date now starts from yesterday by default. When users open the Stock Value Report, the date is set to the previous day automatically.
- Products with no stock activity are hidden by default. Products that have no purchase, sale, return, transfer, manufacturing, or stock adjustment activity will not appear unless users choose to show them.
- Show Zero Quantity still works normally. Users can tick Show Zero Quantity to see products with zero current stock when those products have stock activity.
- Show without History Products can be used when needed. Users can tick this option if they also want to see products that do not have any stock activity.
- The report list is cleaner by default. Users see products with real stock movement first, without extra empty products filling the report.

How to use or check it:
- Go to Reports > Stock Value Report.
- Check the As of Date. It should show yesterday by default.
- Leave Show without History Products unticked if you only want products with stock activity.
- Tick Show Zero Quantity if you also want to include products with zero current stock.
- Tick Show without History Products only when you want to include products that have no stock activity.
- Review the Details, Categorized, Locations, or Location Details tab as needed.

---

### Sales Settings - Required Quotation and Sales Order

What users can do now:
- Quotation can now be required before creating a sale invoice. A new Is Quotation Required option is available with Enable Quotations.
- Sales Order can now be required before creating a sale invoice. A new Is Sales Order Required option is available with Enable Sales Order.
- If Quotation is required, the cashier must select a quotation before saving the invoice as final.
- If Sales Order is required, the cashier must select a sales order before saving the invoice as final.
- If both options are required, both selections must be made before the invoice can be completed.
- A clear warning is now shown when a required Quotation or Sales Order is missing.
- The missing field is also highlighted in red beside Sales Order or Load Products from Quotation, so the cashier knows what to select.

How to use or check it:
- Go to Settings > Business Settings > Sales tab.
- Turn on Enable Quotations if the business uses quotations.
- Tick Is Quotation Required if a quotation must be selected before creating a final sale invoice.
- Turn on Enable Sales Order if the business uses sales orders.
- Tick Is Sales Order Required if a sales order must be selected before creating a final sale invoice.
- Save the settings.
- When creating a sale invoice, select the required Sales Order and/or Load Products from Quotation before completing the invoice.
- If a required selection is missing, read the red warning and select the missing item before saving again.

---

### Sales and POS - Reprint Invoice Layout

What users can do now:
- Users can choose a different invoice layout only when reprinting. This helps print an old sale in another receipt or invoice format when needed.
- Change Layout is available from the Actions button. Users can open it from both the Sales list and the POS sales list.
- A layout selection window opens after clicking Change Layout. Users can choose the required invoice layout from the dropdown.
- The saved invoice layout stays unchanged. Choosing a layout from this option does not update the original sale.
- The saved layout is selected by default. When the Change Layout window opens, it first shows the layout already linked with that invoice.
- The window has Print and Close buttons at the bottom. Users can print with the selected layout or close the window without printing.

How to use or check it:
- Go to Sales > All Sales or POS Sales.
- Find the invoice you want to reprint.
- Click Actions and choose Change Layout.
- Select the layout you want to use for this reprint.
- Click Print to print the invoice with the selected layout.
- Click Close if you do not want to print.
- The original invoice layout remains the same after printing.

---

### Business Registration - Date and Time Settings

What works correctly now:
- New businesses now follow the Date Format saved in Business Settings. If the business uses dd/mm/yyyy, newly registered businesses will also start with dd/mm/yyyy.
- New businesses now follow the Time Format saved in Business Settings. If the business uses 12 Hour time, newly registered businesses will also start with 12 Hour time.
- Users do not need to change these settings again after registering a new business. The saved format is applied automatically.

How to use or check it:
- Go to Settings > Business Settings > Business tab.
- Choose the required Date Format and Time Format.
- Save the Business Settings.
- Register a new business.
- Open the new business and check Settings > Business Settings > Business tab.
- The Date Format and Time Format should match the saved settings.

---

### Invoice Layout - Sale Print Options

What users can do now:
- Products can now be grouped by rack on sale invoices. When Group Products by Rack is selected in an invoice layout, the printed sale groups products under their rack names.
- Rack grouping is available on Slim 6 and all Classic sale designs. This includes Classic, Classic 2, Classic 3, Classic 4, Classic 5, Classic 6, and Classic 7.
- Products without a rack are shown under No Rack. This makes it easy to find items that still need rack information.
- Products can still be grouped by category. The category grouping option continues to work on the supported print layouts.
- Slim 6 now shows product categories correctly when Show Category is selected. If the option is on, the category appears on the printed receipt.
- Unit can now be shown as a separate column on Classic sale invoices. Users can set the Unit label and tick Show Unit, similar to the SKU label and Show SKU option.
- Show Unit applies to Classic sale designs only. It works on Classic, Classic 2, Classic 3, Classic 4, Classic 5, Classic 6, and Classic 7.
- Subtotal bold options now work on all print designs. If Bold is selected, the subtotal title and amount print in bold. If Bold is not selected, they print in normal text.
- Classic invoice headers are more compact. Extra blank space around the shop heading, Invoice title, and invoice details has been reduced.

How to use or check it:
- Go to Settings > Invoice Settings > Invoice Layout.
- Add a new layout or edit an existing layout.
- To group products by rack, tick Group Products by Rack and save the layout.
- To group products by category, tick Group Products by Categories and save the layout.
- To show product categories on Slim 6, tick Show Category and save the layout.
- To print Unit as a separate Classic column, enter the Unit label and tick Show Unit.
- To make subtotal lines bold on Slim 6, tick Bold beside the required subtotal label.
- Print or preview a sale invoice with the selected layout to check the result.

---

### Sales - Sale Return Payments

What works correctly now:
- Sale returns without payment no longer show a 0.00 payment receipt. If the payment amount is left as 0, the system saves the sale return without adding a payment entry.
- Sale returns stay Due when no payment is entered. Users can clearly see that the return amount is still unpaid.
- The receipt/payment list now shows only real payments. Users will not see an extra 0.00 sale return payment line.
- Actual sale return payments still save normally. If a payment amount is entered, it appears in the payment list as expected.

How to use or check it:
- Go to Sales > Sale Returns.
- Create a sale return and add the returned products.
- If no payment or refund is being made, leave the payment amount as 0 or blank.
- Save the sale return.
- Open the payment/receipt view. No 0.00 payment line should appear.
- If a payment or refund is made, enter the amount in the payment section before saving.

---

### Accounting - Cash Flow Report

What works correctly now:
- Contact Payments now show the correct cash effect in the Cash Flow Report. When a payment includes both a sale amount and a matching sale return amount, the report now shows the final net amount.
- Payments that cancel each other now show as 0.00. For example, if a customer payment has 1,000.00 received and 1,000.00 adjusted against a sale return, the Cash Flow Report shows 0.00 instead of adding both amounts.
- The Cash Flow Report now matches the Contact Payment preview. Users can open the payment preview and see the same final amount shown in accounting.
- Printed and exported Cash Flow Reports follow the same correct amount.

How to use or check it:
- Go to Accounting > Reports > Cash Flow Report.
- Select the required cash account, location, and date range.
- Find the Contact Payment reference number.
- Open the payment preview if you want to compare the details.
- The amount in Cash Flow should now match the final amount shown in the payment preview.

---

### Sales - Direct Sale Returns and Invoice Printing

What works correctly now:
- Product discounts are calculated correctly when editing a direct sale return. The discount, product subtotal, and final return amount now match the values entered for each returned product.
- Saved direct sale returns keep the correct discount amounts. Opening a return again shows the same product calculations that were shown when it was created.
- Sale-return invoices now show product discounts correctly. The printed invoice can show the unit discount, total product discount, and discount percentage when their labels are enabled.
- Classic invoices now follow the discount labels saved in the invoice layout. Each enabled discount label appears as its own clear column on the invoice.
- Sale-return invoice links open and print normally. Users can view the invoice without receiving a general error message.

How to use or check it:
- Go to Sales > Sale Returns and create or edit a direct sale return.
- Enter the product quantity, price, and discount.
- Check the product subtotal and final return amount, then save the return.
- To choose the discount columns shown on an invoice, go to Settings > Invoice Settings > Invoice Layouts.
- Create or edit a Classic layout and enter the required Unit Discount, Discount Total, and Discount Percentage labels.
- Save the layout, then open or print the sale-return invoice. Only the labels you entered will appear as columns.

---

### Contacts - Ledger Columns and A4 Printing

What users can do now:
- Column Visibility is now available in all six contact ledger formats. Users can choose which ledger columns they want to see.
- Column choices are remembered for each contact and ledger format. Users can return to a ledger without selecting the same columns again.
- Hidden columns can be shown again at any time. Users can open Column Visibility again and select the column they want to bring back.
- Print A4 follows the visible ledger columns. Any column hidden before printing is also left out of the printed ledger.
- Converted-currency ledger tables follow the same column choices when printing. Both ledger tables stay consistent on the printed copy.
- Print A4 now asks for Portrait or Landscape. Users can choose the page direction before opening the print preview.
- The previous page direction is remembered. The last Portrait or Landscape choice is highlighted the next time Print A4 is used.
- The selected page direction is also followed when downloading a PDF from the print preview.

How to use or check it:
- Go to Contacts and open the required contact.
- Open the Ledger tab and choose any ledger format from Format 1 to Format 6.
- Click Column Visibility and select the columns you want to show.
- To show a hidden column again, click Column Visibility again and select that column.
- Click Print A4.
- Choose Portrait or Landscape.
- Review the preview and print the ledger. Hidden columns will not appear on the printed copy.

---

### Reports - Sale Invoices Report Filters

What works correctly now:
- The Date Range filter now updates the Detailed tab correctly. Users can change or clear the date range without reopening the report.
- All report filters now work while the Detailed tab is open. This includes type, payment status, payment method, location, product, invoices, invoice range, customer, customer group, city, state, country, brand, time range, and duplicate sales.
- The Brand filter now applies to the Detailed report. The selected brand is also followed when printing or exporting the Detailed report to Excel.
- The latest filter selection is shown when filters are changed quickly. Older results no longer replace the newly filtered report.
- Filtered Detailed reports load more reliably.

How to use or check it:
- Go to Reports > Sale Invoices Report.
- Open the Detailed tab.
- Choose the required date range and any other filters.
- Review the updated Detailed report.
- Use Print A4 or Export to Excel when you need a copy with the same selected filters.

---

### Stock Transfers - Cost and Selling Values

What users can do now:
- Cost and sale values are easier to understand on stock transfers. The price headings now use Cost Price, Cost Total, Sale Price, and Sale Total.
- Price and total amounts are arranged more clearly. The value columns are easy to scan and compare while creating, editing, or reviewing a stock transfer.
- Add Stock Transfer shows both cost and sale information for every product. Users can review the Cost Price, Cost Total, Sale Price, and Sale Total before saving the transfer.
- Add Stock Transfer shows both overall values at the bottom. Total Cost Value and Total Selling Value make it easier to compare the transfer's cost and sale values.
- Edit Stock Transfer shows the Sale Price alongside the cost values. Users can review the product's Cost Price, Cost Total, and Sale Price while editing a transfer.
- The Stock Transfers list shows Total Cost Value and Total Selling Value. Users can compare both values without opening each transfer.
- The Stock Transfer Report shows both values throughout the report. Total Cost Value and Total Selling Value are available in the Totals, Summary, Detailed, and Product Summary views.
- Printed and exported Stock Transfer Reports include the same values. The updated headings and totals are also shown when printing or exporting the report to PDF or Excel.
- Users can choose whether to show these value columns on the Stock Transfers list. Total Cost Value and Total Selling Value can be hidden from the user's column visibility settings when required.

How to use or check it:
- Go to Stock Transfers and click Add.
- Add the products and enter the required quantities.
- Review Cost Price, Cost Total, Sale Price, and Sale Total for each product.
- Review Total Cost Value and Total Selling Value at the bottom, then save the transfer.
- Open the Stock Transfers list to compare the two total values for saved transfers.
- Go to Reports > Stock Transfer Report to review the Totals, Summary, Detailed, or Product Summary view.
- Use Print A4, PDF, or Excel when you need a printed or exported copy with the same values.
- To hide a value on the Stock Transfers list, open your Profile settings and use Stock Transfers Index Column Visibility.

---

### Reports - Stock Value Report

What works correctly now:
- Current Stock Value now shows the correct amount in the Details tab. Products with a current stock quantity no longer show a zero value when a purchase price is available.
- Opening and current stock values can now be compared correctly. Users can review both amounts together when checking product stock value.

How to use or check it:
- Go to Reports > Stock Value Report.
- Open the Details tab.
- Search for the required product or SKU.
- Review Current Stock Quantity and Current Stock Value.

---

### Products - Actions Menu

What works correctly now:
- Product Stock History now opens with a cleaner screen. After users choose Product Stock History from the Actions button, the old action menu does not stay open.
- Duplicate Product now opens with a cleaner screen. After users choose Duplicate Product from the Actions button, the old action menu does not stay open.

How to use or check it:
- Go to Products > Products List.
- Click the Actions button for the product.
- Choose Product Stock History or Duplicate Product.
- The selected page or popup opens without the old Actions menu left behind.

---

### Products - Add/Edit Alternate SKU

What works correctly now:
- Add/Edit Alternate SKU now opens more cleanly from the Products list. When users choose this option from the Actions button, the action menu closes and the popup is easier to view.
- The Products list stays clearer while the popup is open. Users no longer see the old Actions menu left open behind the Alternate SKU popup.

How to use or check it:
- Go to Products > Products List.
- Click the Actions button for the product.
- Choose Add/Edit Alternate SKU.
- Add or update the alternate SKU details.
- Click Save.

---

### Products - Add/Edit Opening Stock

What works correctly now:
- Add/Edit Opening Stock now opens properly from the Products list. When users choose this option from the Actions button, the popup appears clearly on the screen.
- The opening stock form is no longer covered by the dark background. Users can view, enter, and save opening stock without the popup looking blocked.

How to use or check it:
- Go to Products > Products List.
- Click the Actions button for the product.
- Choose Add/Edit Opening Stock.
- Enter or update the opening stock details.
- Save the changes.

---

### POS - Product Entry and Shortcuts

What works correctly now:
- POS product entry is smoother from the keyboard. After adding a product, the product search stays ready so the cashier can scan or type the next item.
- F2 now moves to the latest product quantity. Cashiers can press F2 to quickly edit the quantity of the most recently added product row.
- Shift + P now works more reliably on POS. The shortcut can be used even when the cursor is already inside the product search box.
- POS shortcuts work better while scanning or typing products. Common POS shortcut keys can be used without first clicking somewhere else on the screen.

How to use or check it:
- Open POS.
- Scan or type a product and add it to the bill.
- Continue scanning or typing the next product from the product search box.
- Press F2 if you need to change the latest product quantity.
- Press Shift + P when you want to move back to product search.

---

### POS - Finalizing Bills

What works correctly now:
- Bills can be completed more reliably. The system is less likely to show Something went wrong while finalizing a bill.
- Cashiers can complete payment and save the bill normally. The sale should finish without needing to repeat the same bill.
- Finalized bills remain available for review and printing. Users can check the completed sale from the Sales list when needed.

How to use or check it:
- Create the bill in POS as usual.
- Choose the payment option.
- Finalize the bill.
- If needed, open Sales > All Sales to review or reprint the completed bill.

---

### Purchases and Purchase Orders - Product Quantity Entry

What works correctly now:
- Tab now moves to the product quantity on purchase screens. After entering a product, users can press Tab from the product search box to go directly to that product's quantity field.
- The latest product row is selected correctly. If a second product is entered, pressing Tab moves to the second product's quantity field.
- Add Purchase and Edit Purchase follow the same keyboard flow. Users can use the same Tab behavior while creating or editing purchases.
- Add Purchase Order and Edit Purchase Order follow the same keyboard flow. Users can use the same Tab behavior while creating or editing purchase orders.

How to use or check it:
- Open Add Purchase, Edit Purchase, Add Purchase Order, or Edit Purchase Order.
- Scan or type the product in Product Search.
- Press Tab to move to that product's quantity field.
- Enter the quantity.
- Go back to Product Search and add the next product.
- Press Tab again to move to the new product's quantity field.

---

### Sales Invoice - Go Back Button

What users can do now:
- A Go Back button is now shown on the invoice page. After creating or reprinting a sale invoice, users can quickly return to the Sales list.
- The button appears at the top with Print and New Invoice. Users do not need to use the browser back button.
- Printed invoices stay clean. The Go Back button is only for screen use and does not appear on printed invoices.

How to use or check it:
- Create a sale or reprint an invoice.
- On the invoice page, click Go Back at the top.
- The system opens Sales > All Sales.

---

## Version 8.92.4 - 2026-07-17

### Product Search - F10 Keyboard Use

What users can do now:
- F10 Product Search is easier to use from the keyboard. When the search window opens, the cursor is ready in Search Text.
- F10 opens Product Search on sales, purchase, return, and stock screens. Users can use it on POS, Add Sale, Edit Sale, Add Purchase, Edit Purchase, Purchase Return, Sale Return, Stock Adjustment, and Stock Transfer screens.
- F10 no longer moves focus to the browser menu. Pressing F10 now opens Product Search on these screens instead of moving to the browser's menu.
- Down Arrow now moves from Search Text to the product list. Users can type a product name or SKU, press Down Arrow, and the first matching product row is highlighted.
- Up Arrow and Down Arrow can move between products. This lets users choose a product without using the mouse.
- Enter adds the highlighted product. After moving to the product row, users can press Enter to add the product to the bill, purchase, return, adjustment, or transfer.
- The highlighted product row is easier to see. The selected row is shown clearly in the product list.

How to use or check it:
- Open POS, Add Sale, Edit Sale, Add Purchase, Edit Purchase, Purchase Return, Sale Return, Stock Adjustment, or Stock Transfer.
- Press F10 to open Product Search.
- Type the product name or SKU in Search Text.
- Press Down Arrow to move to the product list.
- Use Up Arrow or Down Arrow to choose the product.
- Press Enter to add the highlighted product.

---

### Expenses - Project Filters

What users can do now:
- Expenses can now be filtered by Project. Users can choose a project on the Expenses page and see only expenses linked to that project.
- Expenses can now be filtered by Project Step. After choosing a project, users can choose a step to see expenses for that specific stage of work.
- Project expenses can be hidden from the main Expenses list. Users can tick Hide Project's Expenses when they want to review only normal expenses that are not linked to projects.
- The Expenses list now shows the Project column. Users can see the project name and step name directly in the expense table.
- Print A4 follows the selected project filters. When users print the Expenses list, the print view follows the selected project, project step, or hide project expenses option.

How to use or check it:
- Go to Expenses.
- Use the Project filter to choose the required project.
- Use the Project Step filter if you want to narrow the list to one step.
- Tick Hide Project's Expenses if you want to hide all project-linked expenses.
- Check the Project column in the table to see which project and step each expense belongs to.
- Click Print A4 if you want to print the filtered expense list.

---

### Purchases - Product Row Discounts

What users can do now:
- Purchase product rows now have clearer discount names. The old inline Discount column is now shown as Unit Discount, so users can understand that it is applied per unit.
- The Purchase settings label is clearer. The setting is now called Enable Inline Unit Discount in purchase.
- Users can add a Total Discount on each purchase product row. When enabled, a Total Discount column appears after Unit Discount on Add Purchase and Edit Purchase.
- Total Discount updates the Line Total automatically. Users can enter a fixed amount or a percentage, and the row total changes based on the discount.
- Discount 2 is still available separately. The existing Enable Inline Discount 2 in purchase setting is not changed.
- Users can add a Total Discount 2 on each purchase product row. When enabled, a Total Discount 2 column appears after Discount 2.
- Total Discount 2 also updates the Line Total automatically. This gives users another whole-row discount option after Discount 2.
- Purchase row totals are easier to review. The purchase page shows separate totals for Unit Discount, Total Discount, Discount 2, and Total Discount 2 when those options are enabled.

How to use or check it:
- Go to Settings > Business Settings > Purchase tab.
- Turn on Enable Inline Unit Discount in purchase to use a per-unit discount column.
- Turn on Enable Inline Total Discount in purchase to add a whole-row Total Discount column.
- Turn on Enable Inline Discount 2 in purchase if you need the second per-unit discount column.
- Turn on Enable Inline Total Discount 2 in purchase if you need a second whole-row discount column.
- Choose Fixed or Percentage as the default type for each discount option.
- Open Add Purchase or Edit Purchase.
- Enter the product quantity and discounts. The Line Total and purchase totals update automatically.

---

### Stock Report - Reindex Stock Quantities

What users can do now:
- Stock quantity reindex is easier to control from the Stock Report. Users can choose whether to reindex all stock quantities or only the default mismatch check.
- Only one stock reindex can run at a time. This helps prevent repeated clicks from starting the same long reindex many times.
- Reindex progress is shown in the notification bell. Users can check the bell icon to see the current reindex status.
- Users can cancel an active reindex safely. The system finishes the current item first, then stops, so stock data is not left halfway updated.
- Cancel is available from the Stock Report and from the notification bell. Active reindex notifications now show a Cancel option.
- Old stuck reindex notifications are clearer. If an old reindex did not finish, it is shown as not completed instead of looking like it is still running.
- Stock reindex focuses on stock-managed products. Products that do not track stock are not included in the reindex.

How to use or check it:
- Go to Reports > Stock Report.
- Click Reindex Stock Quantities.
- Choose All if you want to recheck all stock-managed products.
- Choose Default if you only want the normal mismatch check.
- Open the notification bell to view the reindex status.
- To stop it, click Cancel Reindex on the Stock Report or click Cancel inside the active bell notification.
- Wait until the notification shows that the reindex was cancelled or completed before starting another reindex.

---

### Reports - Purchase Payment Report

What works correctly now:
- The Detail tab now opens normally. Users can view purchase payment details without the table staying on Processing.
- Purchase payment records load with the selected filters. Date range, supplier, payment location, transaction location, and payment method filters continue to apply.
- Summary and Detail tabs can be checked together. Users can move between the report tabs and review the information they need.

How to use or check it:
- Go to Reports > Purchase Payment Report.
- Choose the date range and filters you want to check.
- Open the Detail tab.
- Review the payment list after it loads.

---

### User Security - Expense Category Permissions

What users can do now:
- Expense Category permissions can now be set separately. Roles now have separate options for Add Expense Category, Edit Expense Category, and Delete Expense Category.
- Staff can be given only the category access they need. For example, a user can be allowed to add categories without also being allowed to delete them.
- Expense Category buttons now follow the user's role. Add, Edit, Delete, and Restore options appear only for users who are allowed to use them.
- Expense Category access can be managed from the Expenses tab in Roles. This keeps all expense-related role settings in one place.

How to use or check it:
- Go to User Management > Roles.
- Add a new role or edit an existing role.
- Open the Expenses tab.
- Tick Add Expense Category, Edit Expense Category, or Delete Expense Category as needed.
- Save the role.
- Open Expenses > Expense Categories to check the available buttons for that user.

---

### Sales - All Sales Action Button

What works correctly now:
- The Actions button on All Sales now opens for allowed non-admin users. Users do not need to be Admin just to open the action menu.
- Allowed users can view sales from the Actions menu. Users with permission to view their own sales or assigned sales can open the sale details.
- The Actions menu shows only the options the user is allowed to use. Each role sees the available View, Print, Payment, Return, or other actions based on its permissions.

How to use or check it:
- Go to Sales > All Sales.
- Find the sale you want to check.
- Click Actions.
- Choose the available option, such as View or Print, depending on your role permission.

---

### Reports - Activity Log

What is easier now:
- Activity Log can now be filtered by Transaction Type. Users can choose Sales, Purchase, Sale Return, Purchase Return, Expense, Stock Adjustment, and other transaction types from the report filters.
- Subject Type and Transaction Type are now separate filters. Users can first choose whether they want to see contacts, users, roles, transactions, or payments, then narrow the list by transaction type when needed.
- The search box now finds activity log records correctly. Users can search by invoice number, reference number, payment reference number, product name, SKU, user name, action, or words shown in the note.
- Print A4 now follows the same search and filters. If users filter or search the Activity Log before printing, the A4 print report shows the same matching records.

How to use or check it:
- Go to Reports > Activity Log.
- Use Transaction Type to show only the type of activity you need, such as Sales or Purchase.
- Use the search box to find a specific invoice, reference number, payment number, product, SKU, user, or note.
- Click Print A4 if you want to print the filtered or searched results.

---

### POS and Sales - Completed Invoices

What works correctly now:
- Completed invoices stay completed. After a sale is finished, an old open POS page will no longer change that sale back into a draft by mistake.
- Finished sales stay visible in the Sales list. Completed invoices should remain available from the normal sales list after saving.
- Invoice numbers are safer after printing. A completed sale is less likely to disappear from the list because of an old screen still open in the background.
- Printed invoice totals should match the saved sale. Users can reprint the invoice from the saved sale record when needed.

How to use or check it:
- Complete the sale as usual from POS or Add Sale.
- After printing the invoice, check Sales > All Sales if you need to view or reprint it.
- If the invoice is not visible, check the selected date range and invoice search first.
- Avoid continuing work from an old browser tab for a sale that has already been completed.

---

### Sales List - Deleted Sales

What works correctly now:
- Show Only Deleted now shows removed sales correctly. When this option is ticked, the Sales list shows deleted sales instead of normal active sales.
- Deleted sales can be reviewed separately. This makes it easier for allowed users to check removed invoices without mixing them with normal sales.
- The date filter still applies. If no deleted sale exists in the selected date range, the table will correctly show no records.
- Restore is available for deleted sales. Allowed users can bring a deleted sale back from the deleted sales list.

How to use or check it:
- Go to Sales > All Sales.
- Choose the date range you want to check.
- Tick Show Only Deleted.
- If no deleted sales appear, increase the date range and search again.
- Use Restore if a deleted sale needs to be brought back.

---

### POS and Sales - Negative Quantity / Sale Return

What works correctly now:
- Negative quantity items now work like sale returns. If a product is entered with a negative quantity, the sale amount, bill total, stock, cost, and profit are handled as a return.
- Mixed bills now work correctly. A bill can include normal sale items and return items together, and the final bill amount stays correct.
- Only return bills also work correctly. One product or many products can be entered with negative quantities, and the stock is added back correctly.
- Sell Create and Sell Edit pages follow the same behavior. Negative quantity return entries work the same way on POS, Add Sale, and Edit Sale.

How to use or check it:
- Open POS, Add Sale, or Edit Sale.
- Add the product normally.
- Enter a negative quantity for the item being returned, such as -1.
- Complete the bill as usual.
- Check stock and reports after saving to confirm the returned quantity has been added back.

---

### POS and Sales - Zero Stock Products

What works correctly now:
- Zero-stock products can still be selected when selling without stock is not allowed. The product is added with quantity 0 so the cashier can see it, but it cannot be finalized as a normal sale with a positive quantity.
- A clear Product out of Stock warning is shown. If a cashier tries to sell a zero-stock product with a positive quantity, the system shows a warning with the product SKU.
- Positive quantity is stopped when stock is not available. The sale cannot be completed with a positive quantity for an out-of-stock product when selling without stock is disabled.
- Negative quantity is still allowed for returns. Out-of-stock products can be entered with a negative quantity when the customer is returning the item.
- When selling without stock is allowed, products are added normally. The system follows the business setting and does not force the product quantity to 0.

How to use or check it:
- Go to Settings > Business Settings > Sales tab.
- If Allow Sale if No Stock is disabled, zero-stock products can be selected but should stay at quantity 0 unless it is a return.
- For a sale, add stock first or choose another product.
- For a return, enter the quantity as a negative number.
- If Allow Sale if No Stock is enabled, continue selling the product normally.

---

### Product Search Popup

What works correctly now:
- Text search in the F10 product search popup now works correctly. Users can type a product name or SKU and the product list will update.
- The F10 product search popup now shows fresher stock figures. When the popup opens, it reloads the latest product list and quantity.
- Location stock is clearer on POS and Sales pages. The popup shows quantity for the selected selling location where allowed.
- Product quantity in the popup now matches the product stock history more closely. This helps users choose the correct product before adding it to a bill.
- Products marked as not for sale stay hidden on selling screens. This keeps the selling list cleaner for cashiers and sales staff.

How to use or check it:
- Open POS, Add Sale, or Edit Sale.
- Press F10 to open Products Search.
- Type the product name or SKU in Search Text to find the product.
- Check the Quantity column before selecting a product.
- If the quantity does not look right, close and reopen the popup to refresh the list.

---

### Product History, Cost, and Profit

What works correctly now:
- Product history now shows cost for negative quantity sale entries. Return-style sale lines no longer show missing cost when the product has a saved purchase cost.
- If there is no purchase or opening stock record, the product's saved cost is used. This helps product history still show a useful cost value.
- Profit figures now stay correct for negative quantity sale entries. Reports treat these entries like sale returns.
- Edited and finalized sales now refresh the related cost and profit figures. After a sale is changed, reports show the latest values.

How to use or check it:
- Open the product's stock history.
- Check sale and return rows for Quantity Change, Cost Price, Cost Total, Sell Price, and Sell Total.
- If a product has no purchase history, check the product's saved cost on the product create/edit page.
- Review profit reports after saving or editing a sale to confirm the return effect is included.

---

### Accounting - Ledgers and Refund Payments

What works correctly now:
- Accounting ledgers now show cost values for negative quantity sale entries. Return-style sale entries are reflected correctly in the ledger.
- Refund payments now appear on the correct side of the selected payment account. A negative payment, such as a cash refund, is shown on the payment-out / credit side.
- Accounting reports now match the sale return effect more clearly. This helps users compare sales, returns, payments, stock, cost, and profit.

How to use or check it:
- Complete the sale or return entry.
- Open the related Accounting ledger.
- Check that the cost and payment amounts are shown on the correct side.
- For a refund, check the selected cash or bank account to confirm the amount is shown as money paid out.

---

### Payment Accounts

What works correctly now:
- The Account Types tab now opens correctly. Users can switch from Accounts to Account Types without the page getting stuck on the Accounts list.
- The selected tab is now highlighted correctly. It is clearer which tab is currently open.

How to use or check it:
- Go to Account > Account.
- Click the Account Types tab.
- Add, edit, delete, or restore account types from this tab as needed.
- Click the Accounts tab to return to the payment account list.

---

## Version 8.92.1 - 2026-07-16

### Product SKU Scanning

What works correctly now:
- Alphanumeric product SKUs can now be scanned correctly. SKUs with letters and numbers, such as `FN368463427566`, are accepted in product search fields.
- Purchase product scanning now works correctly. Users can scan this type of SKU on the Add Purchase screen.
- POS product scanning now works correctly in both product scan fields. Users can scan the SKU in the SKU scan box or the normal product search box.
- The scanner no longer opens the wrong popup while scanning. The full SKU stays in the search box and the product can be selected or added normally.
- The same scanning improvement is available on other product search screens. This includes Sales, Purchase Orders, Purchase Returns, Stock Adjustment, Stock Transfer, and product search popups.

How to use or check it:
- Open the screen where you want to add a product.
- Click inside the product search or SKU scan box.
- Scan the product barcode.
- Check that the full SKU appears, including letters.
- Press Enter if the product is not added automatically.
- If the product still does not appear, confirm that the same SKU is saved in the product record.

---

### User Roles - Sale Return Payments

What works correctly now:
- Sale return payment option now appears when it is allowed in the role. If a user role has Add sale return payment (SRP) selected, the Add Payment section is shown on sale return pages.
- Staff can add payment details while creating or editing a sale return. The payment area is available at the bottom of the sale return page for users who have this role permission.

How to use or check it:
- Go to Settings > User Management > Roles.
- Create a new role or edit an existing role.
- Open the Sales tab.
- In Sale Return permissions, tick Add sale return payment (SRP).
- Save the role.
- Open a sale return create or edit page.
- Check the bottom of the page to add the sale return payment.

---

## Version 8.92.0 - 2026-07-14

### HRM - Attendance Import

What users can do now:
- Attendance can now be imported using User ID. Users should enter the User ID shown in the Users List instead of entering an email address.
- The attendance import template now starts with User ID. The first column in the Excel file is now clear and matches the User ID column on the Users List page.
- The template includes an example row. Users can see the correct way to fill User ID, clock-in time, clock-out time, shift, notes, and IP address.
- Email is no longer needed for attendance import. This makes the import easier when employee emails are missing or changed.

How to use or check it:
- Go to User Management > Users List.
- Note the employee's User ID from the User ID column.
- Go to HRM > Attendance > Import Attendance.
- Download the attendance import template.
- Replace the example row with the real attendance details.
- Enter the User ID in the first column.
- Enter Clock-in Time and Clock-out Time in this format: `YYYY-MM-DD HH:MM:SS`.
- Enter Shift only if that shift name already exists, otherwise leave it blank.
- Upload the completed Excel file and click Submit.

---

### Home Dashboard - Module Shortcuts

What users can do now:
- Module buttons are now shown above the quick action buttons on the Home Dashboard. Users can quickly open the dashboard of available modules such as HRM, Installment, Project, Accounting, Warehouse, and other active modules.
- Clicking a module button opens that module's dashboard or main page. Users no longer need to search through the side menu for common module dashboards.
- Module buttons now have colorful styling. The buttons are easier to notice and match the quick action buttons below them.
- Accounting now appears in the dashboard module buttons when it is available for the business. If Accounting is included and visible in the side menu, users can also open it from the Home Dashboard shortcut.
- Manufacturing now appears in the dashboard module buttons when it is available for the business. If Manufacturing is included and visible in the side menu, users can also open it from the Home Dashboard shortcut.

How to use or check it:
- Go to Home / Dashboard.
- Look below the greeting box and above Add Sale / Add Purchase.
- Click any module name button to open that module's dashboard or main page.
- Use the Add Sale, Add Purchase, Add Product, Add Contact, and Add Expense buttons below for quick daily actions.

---

### Expenses - Expense Categories

What is easier now:
- Budget is now shown as Monthly Budget. Users can clearly understand that the amount is for one month.
- The list now shows Remaining Budget. Users can quickly see how much budget is still left for the current month.
- Remaining Budget starts fresh every month. At the start of a new month, the remaining amount begins again from the monthly budget and then reduces as expenses are added.
- Expense refunds are included in the remaining budget. If an expense refund is recorded, the remaining budget is adjusted.

How to use or check it:
- Go to Expenses > Expense Categories.
- Click Add to create a new category, or Edit to update an existing one.
- Enter the Monthly Budget amount if needed.
- Click Save or Update.
- Check the Remaining Budget column to see how much is left for the current month.
- When a new month starts, the remaining amount starts again from the Monthly Budget.

---

### FBR Digital Invoicing - Customer Tax Number

What is easier now:
- Customer Tax Number entry is clearer for FBR Digital Invoicing. A help tooltip is shown on the customer add/edit form to guide users about the correct number format.
- Users can enter the buyer NTN or CNIC in the correct FBR format. Use 7 digit NTN without dash/check digit, or 13 digit CNIC without dashes.
- The Check Reg. Type button helps confirm the customer registration type. Users can check whether the customer is Registered or Unregistered before saving.
- Sales can be submitted to FBR after the correct customer tax number is saved.

How to use or check it:
- Go to Merchants > Customers.
- Add a new customer or edit an existing customer.
- Enter the Tax number as required by FBR.
- For NTN, enter only the 7 digit number before the dash. Example: if the NTN is 4454284-0, enter 4454284.
- For CNIC, enter all 13 digits without dashes.
- Click Check Reg. Type.
- Confirm the Sale Tax Reg. Type is correct, then save the customer.
- Create the sale again and submit it to FBR.

---

### FBR Digital Invoicing - Sale Submission

What users can do now:
- FBR Digital Invoicing has its own submission button. Businesses with FBR Digital Invoicing included in their package will see the FBR DI Submission button.
- The old Sync FBR/PRA Sales button remains available. Users can still use the existing button where it is needed.
- Users can submit pending sales to FBR Digital Invoicing from the sales list. The button sends sales that have not already received an FBR invoice number.
- Users can use the date filter before submitting. This helps submit only the required sales for the selected period.
- A result message shows how many sales were submitted and if any failed.

How to use or check it:
- Go to Sales > All Sales or POS Sales.
- Use the date filter if you only want to submit sales for a selected period.
- Click FBR DI Submission.
- Confirm the message on screen.
- Review the result message after submission finishes.

---

### Sales - Draft Auto Save

What works correctly now:
- Draft Auto Save now saves draft sales properly. When this setting is enabled, products added on the draft sale screen are saved automatically.
- Auto-saved draft sales now appear in the Drafts list. If the user closes the browser window after the sale has been auto-saved, the draft can still be found later.
- The same draft keeps updating while the user continues editing. This helps avoid missing or duplicate draft bills.

How to use or check it:
- Go to Settings > Business Settings > Sales tab.
- Turn on Enable Draft Auto Save.
- Open Sales > Draft or create a sale as Draft.
- Add the customer and products.
- Wait a few seconds for the auto-save to complete.
- Open the Drafts list to continue the saved draft later.

---

### Sales - Sale Details

What users can see now:
- Layout Name is now shown when viewing a sale. Users can quickly see which invoice or receipt layout is linked with the sale.
- Table bills also show the correct layout name. This helps users confirm which bill format was used for restaurant table bills.

How to use or check it:
- Go to Sales > All Sales.
- Find the sale you want to check.
- Click Actions and then View.
- Check the sale details window for Layout Name near the invoice and payment information.

---

### POS - Draft Auto Save

What users can do now:
- POS can now auto-save the current bill as a draft. When Enable Draft Auto Save is turned on, adding products on POS saves the bill in the background.
- The POS screen stays quiet while saving. Users can keep billing without extra auto-save messages appearing on screen.
- Closing POS after auto-save will keep the draft available. The saved draft can be opened again from the draft list or recent transactions.
- Finishing the sale uses the saved draft. When the user completes checkout, the draft becomes the final sale instead of leaving an extra draft behind.

How to use or check it:
- Go to Settings > Business Settings > Sales tab.
- Turn on Enable Draft Auto Save.
- Open POS.
- Select the customer and add products to the bill.
- Wait a few seconds while the bill is saved in the background.
- Open Recent > Draft or the Drafts list to find the saved draft.
- Complete checkout as usual when the customer is ready to pay.

---

### POS - Recent Transactions Draft Tab

What works correctly now:
- Auto-saved draft bills now show their correct total in POS Recent Transactions. The Draft tab no longer shows 0.00 for a saved draft bill that has products.
- Auto-saved draft bills now show an Auto Saved label. Users can quickly identify which draft was saved automatically.
- The Draft tab total now includes the correct draft bill amount.

How to use or check it:
- Open POS.
- Click Recent.
- Open the Draft tab.
- Check the bill amount and the Auto Saved label beside auto-saved draft bills.
- Select the draft and click Edit to continue the bill.

---

### Invoice Layout - Subtotal Labels

What users can do now:
- Subtotal labels can now be printed in bold. Users can choose bold printing separately for Subtotal Exc. Tax and Subtotal Inc. Tax.
- The Bold option is shown beside each subtotal label field. This makes it easier to turn bold printing on or off while editing the invoice layout.
- When Bold is selected, both the title and amount print in bold. This helps important subtotal lines stand out on the printed invoice or receipt.

How to use or check it:
- Go to Settings > Invoice Settings > Invoice Layout.
- Add a new invoice layout or edit an existing one.
- Open the Total Details section.
- Enter the Subtotal Exc. Tax Label or Subtotal Inc. Tax Label.
- Tick Bold beside the label you want to highlight.
- Save the invoice layout and print an invoice to see the bold subtotal line.

---

### Invoice Layout - Commission Agent

What looks cleaner now:
- Commission agent settings are now easier to use. The Show commission agent option is shown beside the Commission agent label field.
- Users can turn the commission agent name on or off from the same line where they set its label. This keeps the invoice layout form cleaner and easier to understand.

How to use or check it:
- Go to Settings > Invoice Settings > Invoice Layout.
- Add a new invoice layout or edit an existing one.
- Find Commission agent label.
- Enter the label name you want to print.
- Tick Show commission agent if you want the commission agent to appear on the invoice.
- Save the invoice layout.

---

### Invoice Layout - Sales Person

What looks cleaner now:
- Sales person settings are now easier to use. The Show Sales Person option is shown beside the Sales Person Label field.
- Users can turn the sales person name on or off from the same line where they set its label. This keeps the invoice layout form cleaner and easier to understand.

How to use or check it:
- Go to Settings > Invoice Settings > Invoice Layout.
- Add a new invoice layout or edit an existing one.
- Find Sales Person Label.
- Enter the label name you want to print.
- Tick Show Sales Person if you want the sales person to appear on the invoice.
- Save the invoice layout.

---

### Invoice Layout - SKU

What looks cleaner now:
- SKU settings are now easier to use. The Show SKU option is shown beside the SKU Label field.
- Users can turn SKU printing on or off from the same line where they set its label. This keeps the invoice layout form cleaner and easier to understand.

How to use or check it:
- Go to Settings > Invoice Settings > Invoice Layout.
- Add a new invoice layout or edit an existing one.
- Find SKU Label.
- Enter the label name you want to print.
- Tick Show SKU if you want the SKU to appear on the invoice.
- Save the invoice layout.

---

### Invoice Layout - Alternate SKU

What looks cleaner now:
- Alternate SKU settings are now easier to use. The Show Alternate SKU option is shown beside the Alternate SKU Label field.
- Users can turn alternate SKU printing on or off from the same line where they set its label. This keeps the invoice layout form cleaner and easier to understand.

How to use or check it:
- Go to Settings > Invoice Settings > Invoice Layout.
- Add a new invoice layout or edit an existing one.
- Find Alternate SKU Label.
- Enter the label name you want to print.
- Tick Show Alternate SKU if you want the alternate SKU to appear on the invoice.
- Save the invoice layout.

---

### Invoice Layout - Second Tax

What looks cleaner now:
- Second tax settings are now easier to use. The Show Second Tax on Bill option is shown beside the Select Second Tax field.
- Users can choose the second tax and turn it on for the bill from the same line. This keeps the invoice layout form cleaner and easier to understand.

How to use or check it:
- Go to Settings > Invoice Settings > Invoice Layout.
- Add a new invoice layout or edit an existing one.
- Find Select Second Tax.
- Choose the tax you want to use as the second tax.
- Tick Show Second Tax on Bill if you want it to appear on the bill.
- Save the invoice layout.

---

### Invoice Layout - Customer Information

What looks cleaner now:
- Customer information settings are now easier to use. The Show Customer information option is shown beside the Customer Label field.
- Users can turn customer information on or off from the same line where they set its label. This keeps the invoice layout form cleaner and easier to understand.

How to use or check it:
- Go to Settings > Invoice Settings > Invoice Layout.
- Add a new invoice layout or edit an existing one.
- Find Customer Label.
- Enter the label name you want to print.
- Tick Show Customer information if you want customer details to appear on the invoice.
- Save the invoice layout.

---

### Purchases - Product Table

What looks cleaner now:
- Purchase product tables now have easier column names. Columns such as Qty, Scheme Qty, Unit Cost, Discounted Cost, Tax, Tax Amount, Cost Inc. Tax, Line Total, and GP % are easier to understand at a glance.
- Tax selection is now clearer. The Tax column is used for choosing the tax, while Tax Amount and Line Total are shown separately.
- Tax amounts are easier to read. Product tax amounts now show as plain numbers without repeating the currency symbol in each row.
- Price headings are cleaner. Currency symbols now appear neatly under most price headings, while Sell Price stays compact on one line.
- Quantity columns use space better. Quantity and Scheme Quantity columns now adjust more naturally instead of taking unnecessary width.
- The same cleaner table is available across purchase work. These improvements apply on Add Purchase, Edit Purchase, Add Purchase Order, and Edit Purchase Order.

How to use or check it:
- Go to Purchases > Add Purchase or edit an existing purchase.
- You can also open Add Purchase Order or edit an existing purchase order.
- Add or review products in the product table.
- Use the shorter column names to enter quantity, cost, discount, tax, and totals more easily.
- Select tax from the Tax column and review the tax amount beside it.

---

### Purchases - Add Purchase Table

What looks cleaner now:
- Quantity unit boxes are now smaller on Purchase and Purchase Order forms. The unit beside Quantity and Scheme Quantity now takes less space, similar to the discount type box.
- Product rows have more room for prices and totals. This makes the purchase table easier to read on smaller screens.

How to use or check it:
- Go to Purchases > Add Purchase, edit a purchase, or open Purchase Order add/edit.
- Add or review products in the table.
- Check the Quantity and Scheme Quantity columns.
- The unit box beside each quantity now appears in a compact size.

---

### Purchases - Product Tax

What users can do now:
- Users can apply one product tax to all products on Purchase and Purchase Order forms. Click the Tax column heading, select the tax, and apply it to all product rows together.
- The purchase totals update after the tax is applied. Each product line recalculates using the selected tax.

How to use or check it:
- Go to Purchases > Add Purchase, edit a purchase, or open Purchase Order add/edit.
- Add or review products in the table.
- Click the Tax column heading.
- Select the tax.
- Click Apply to update all products.

---

### POS - Keyboard Shortcuts Help

What works correctly now:
- Keyboard shortcuts help window now opens properly on POS. When users press F7, the shortcut help window appears clearly on screen.
- Users can review POS shortcut keys without the window being hidden by the page overlay.

How to use or check it:
- Open POS.
- Press F7.
- Review the available shortcut keys.
- Close the window when finished.

---

### Sales, Purchases and Stock - Product Search

What works better now:
- Product Search now opens faster on sales, purchase, and stock screens. Users see the product search window with less waiting.
- Users can search and select products more quickly while entering sales, returns, purchases, purchase orders, stock transfers, and stock adjustments.
- Opening Product Search again on the same page feels smoother.

How to use or check it:
- Open POS, Add Sale, Edit Sale, Add Sale Return, Edit Sale Return, Add Purchase, Edit Purchase, Add Purchase Order, Edit Purchase Order, Stock Transfer, or Stock Adjustment.
- Press F10 or click the Product Search button.
- Type the product name or SKU.
- Select the product and continue your work.

---

### POS - Product Discounts

What works correctly now:
- Bulk product discount window now opens properly on POS. When users click the Discount column heading, the discount window appears clearly on screen.
- Users can apply one discount to all products in the sale. Enter the discount once and apply it to all product rows together.

How to use or check it:
- Open POS.
- Add products to the sale.
- Click the Discount column heading.
- Enter the discount.
- Click Apply to update all products in the sale.

---

### POS - Product Tax

What works correctly now:
- Bulk product tax window now opens properly on POS. When users click the Tax column heading, the tax window appears clearly on screen.
- Users can apply one tax selection to all products in the sale. Select the tax once and apply it to all product rows together.

How to use or check it:
- Open POS.
- Add products to the sale.
- Click the Tax column heading.
- Select the tax.
- Click Apply to update all products in the sale.

---

### Purchases - Product Discounts

What works correctly now:
- Bulk product discount window now opens properly on Purchase and Purchase Order forms. When users click the Discount column heading, the discount window appears clearly on screen.
- Users can apply one discount to all products. Enter the discount percentage once and update all product rows together.

How to use or check it:
- Go to Purchases > Add Purchase, edit a purchase, or open Purchase Order add/edit.
- Add or review products in the table.
- Click the Discount column heading.
- Enter the discount percentage.
- Click Update to apply the discount to all products.

---

### Invoice Layout - Receipt Designs

What users can do now:
- New receipt layout Slim 6 is now available. Users can select it from Invoice Layout design options.
- Slim 6 follows the Slim 4 receipt style with clearer boxed product and totals sections. This makes product lines and bill totals easier to read on 80mm receipt prints.

What looks cleaner now:
- Invoice heading spacing is now tighter on Slim receipt designs. The Invoice title no longer leaves extra blank space above or below it.
- Extra blank space after Total Due has been reduced. Receipt notes now appear closer to the totals section.
- KOT and POS Bill prints now use the same cleaner spacing. This helps kitchen and POS bill receipts look shorter and neater.
- Slim for Purchase and Slim for Expense prints also have cleaner spacing. Extra blank receipt space has been removed from these designs.

How to use or check it:
- Go to Settings > Invoice Settings > Invoice Layout.
- Add or edit an invoice layout.
- Open the Invoice Layout tab.
- Choose Slim 6 if you want the new boxed receipt style.
- Use Slim, KOT, POS Bill, Slim for Purchase, or Slim for Expense as usual to see the cleaner spacing on prints.

---

### Sales - Offline Workstation

What users can do now:
- Offline workstations can now continue sales even when an item has no stock. Cashiers will not be stopped by the Allow Sale if No Stock setting while working on the offline system.
- Sales can be completed first and reviewed after sync. This helps the branch keep billing customers when live stock is not fully updated.

How to use or check it:
- Open POS or Sales on the offline workstation.
- Add the customer and products as usual.
- Complete the sale even if the product stock is showing zero or less.
- Sync the offline workstation later so the sale is sent to the live system.

---

### Products - Products Note

What users can do now:
- Products Note is now available under Products after Add Product. Users can open it directly from the sidebar.
- Product-specific notes can now be recorded with a priority status. Each note stores the selected product, priority, note text, creator, and created date.
- The Product Notes list includes report filters. Users can filter notes by product, priority status, and deleted records.
- Notes can be added and edited in a modal. Users select a product, choose Low, Medium, High, or Urgent priority, and enter the note text.
- Deleted notes can be reviewed and restored. Enable Show Deleted to see removed notes.

How to use or check it:
- Go to Products > Products Note.
- Click Add.
- Select the product.
- Choose the priority status.
- Enter the note and click Save.
- Use the filters to review notes by product or priority.

---

### Merchants - Walk-In Customer Ledger

What works better now:
- Walk-In Customer ledger now opens properly even when it has many sales. Users can view the ledger without the page staying blank.
- Large ledgers are easier to browse. The ledger is shown in smaller pages, so users can move through the records using Previous and Next buttons.
- A loading message is shown while the ledger is opening. Users can see that the system is working instead of waiting on an empty area.
- Print and PDF options still show the full ledger statement. Users can continue printing or saving the complete ledger when needed.

How to use or check it:
- Go to Merchants > Customers.
- Open Walk-In Customer.
- Open the Ledger tab.
- Select the date range and business location if needed.
- Use the Previous and Next buttons to move through the ledger records.
- Click Print A4 or PDF when you need the full ledger statement.

---

### Merchants - Contact Ledger Print

What looks cleaner now:
- Contact ledger print title is now shorter. The print page now shows only the ledger name and format, such as Ledger - Format 1.
- Important ledger details are shown in one line. Users can see Contact ID, contact type, ledger format, and date range together at the top.
- Contact name and mobile are no longer repeated at the top. These details remain available in the To section of the ledger print.
- The extra line above the ledger table has been removed. The print page no longer repeats the message about showing invoices and payments between dates.
- A4 print pages now use space better. Small sections such as ageing details can appear on the previous page when there is enough space.
- Empty extra sections no longer add unnecessary pages. This helps avoid blank-looking pages in the ledger print preview.

How to use or check it:
- Go to Merchants > Suppliers or Merchants > Customers.
- Open the contact ledger.
- Select the date range and ledger format.
- Click Print A4.
- Review the cleaner heading, one-line filter information, and page layout before printing.

---

### Reports - Profit / Loss PDF Export

What works correctly now:
- Profit / Loss PDF export now fits properly on the page. The right-side report title, table heading, and amount column no longer cut off in the exported PDF.
- Product profit report PDFs are easier to read. Product names and gross profit amounts stay inside the printable page area.

How to use or check it:
- Go to Reports > Profit / Loss Report.
- Open the Products tab.
- Select the date range and location if needed.
- Click PDF to export the report.
- Open the PDF and check that the right-side amounts are fully visible.

---

### Reports - Print A4 PDF Export

What works better now:
- Print A4 PDF exports now fit better across reports. Reports that use the Print A4 style now keep headings, tables, totals, and page numbers inside the printable page area.
- Right-side columns are less likely to cut off in exported PDFs. Amount columns and report titles now have safer spacing when saved as PDF.
- PDF pages now match the A4 page size more closely. This helps printed reports look closer to the on-screen Print A4 preview.

How to use or check it:
- Open any report that has Print A4 or PDF export.
- Choose the filters you need.
- Click PDF to export the report.
- Open the PDF and confirm the right-side headings and amount columns are fully visible.

---

## Version 8.91.9 - 2026-07-13

### Superadmin - Business List

What works correctly now:
- Login as button is now disabled for inactive businesses. Superadmin users will not be logged out by mistake when a business is inactive.
- Inactive businesses still show the Activate button. Activate the business first if you need to open it.
- After the business is active, Login as username can be used normally.

How to use or check it:
- Go to Superadmin > Businesses.
- Find the business you want to open.
- If the business is inactive, click Activate first.
- After activation, click Login as username.

---

### Contacts - Ledger Print

What works correctly now:
- Contact Ledger A4 preview now opens in proper pages. Users no longer see the ledger as one very long page.
- Downloaded Contact Ledger PDF now keeps the table aligned. The ledger rows stay inside the page and do not shift to the side.
- Contact Ledger PDF pages now continue neatly. The PDF no longer splits one page into broken pieces.
- Page numbers are easier to follow. The page count shown in the ledger copy matches the pages in the PDF.

How to use or check it:
- Open Contacts.
- Open the customer or supplier.
- Go to the Ledger tab.
- Choose the date range and ledger format.
- Click Print A4 to check the page preview.
- Click PDF if you need to download a PDF copy.

---

### Reports - Payment Reports

What works correctly now:
- Sale Payment Report Detail print now opens normally. Users can open the detail print view even when no customer, location, or payment method is selected.
- Sale Payment Report PDF now fits on the page. Right-side columns such as Customer Group and Payment Note stay visible.
- Sale Payment Report PDF no longer adds a blank extra page when the report fits on one page.
- Purchase Payment Report print and PDF copies also follow the same cleaner page layout.

How to use or check it:
- Go to Reports > Sale Payment Report.
- Open the Detail tab.
- Choose the date range and filters if needed.
- Click Print A4 to check the print preview.
- Click PDF if you need to download a PDF copy.
- For supplier payments, use Reports > Purchase Payment Report and follow the same steps.

---

### Sales - Add Sale Payment

What users can do now:
- More than one payment row can now be added on the Add Sale page. This helps when a customer pays the same sale using more than one payment method.
- Each payment row can have its own amount, payment date, and payment method.
- The new row starts with the remaining balance. This makes it quicker for staff to complete split payments.

How to use or check it:
- Go to Sales > Add Sale.
- Add the customer and sale items.
- Scroll to the Add Payment section.
- Click Add Payment Row.
- Enter the amount and choose the payment method for the new row.
- Add more rows if the customer is paying in more than one way.
- Save the sale when all payments are entered.

---

### POS - Big Buttons Screen

What users can do now:
- Big Buttons POS screen is easier to use for checkout. The payment buttons are now shown clearly as Pay, Card, and Cash.
- Cash is now available as Express Checkout. Click Cash to finish a cash sale directly without opening the payment window.
- Card can now finish the sale directly. Click Card to complete a card sale without opening the multi-pay window.
- Pay still opens the Multi-Pay payment window. Use Pay when the customer is paying with more than one payment method.
- The Keyboard button can open the Windows on-screen keyboard. This helps touchscreen users enter product names, customer names, and other details.
- The number keypad can type into the selected field. Tap a quantity, search, or amount field, then use the on-screen number buttons to enter values.
- The Logout button signs the user out directly. After logout, the system returns to the login page.
- The Home button takes the user back to the dashboard/home page.
- Product cards now show current stock on hand. Users can see available quantity such as 5.00 PCS before adding an item to the bill.

What looks different:
- Cash button is light green. It is easier to recognize as the quick cash checkout button.
- Pay, Card, and Cash buttons now stay in one row. The buttons adjust their width to fit the screen and should not move to the next line.
- Checkout buttons are clearer for staff. Pay is used for Cash / Multi-pay, Card is used for Chip & PIN, and Cash is used for Express Checkout.

What works correctly now:
- Pay button opens the Multi-Pay payment window properly. The screen no longer appears stuck when Pay is clicked.
- Payment errors are easier to see while using Multi-Pay. If something is missing or incorrect, the message appears on the payment window so staff know what to fix.
- Product list loads normally on the Big Buttons screen. Users should no longer see a failed-to-load message when opening or refreshing product buttons.
- Products with available stock can be added to the bill. The system no longer shows an out-of-stock message for items that still have stock available.

How to use or check it:
- Go to Settings > Business Settings > POS tab.
- Set POS Screen Interface to Big Buttons.
- Open the POS screen.
- Click a product card to add the item to the bill.
- Check the stock label on the product card before adding items.
- Click Pay to use Multi-Pay.
- Click Card to finish a card payment directly.
- Click Cash to finish a cash payment directly.
- Click Keyboard when the Windows on-screen keyboard is needed.
- Click any quantity, search, or amount field, then use the number keypad to enter values.
- Click Home to return to the dashboard/home page.
- Click Logout to sign out and return to the login page.

---

### Business Settings - Payments

What users can do now:
- User selection can now be required on payment screens. A new Is User required on payments option is available in Business Settings.
- When this option is turned on, staff must choose a user before saving a payment.
- This applies when adding or editing payments. It works for advance deposits, customer payments, supplier payments, and purchase payments.

What works correctly now:
- Payments cannot be saved without a user when the setting is enabled. Staff will need to select a user first.
- Edited payments keep or update the selected user properly.

How to use or check it:
- Go to Settings > Business Settings > Payment tab.
- Tick Is User required on payments.
- Save the settings.
- Open any payment window.
- Choose a user before saving the payment.

---

### POS - Cash Drawer

What users can do now:
- Cash drawer can now be enabled per workstation. Admins can choose which counter or computer is allowed to open the cash drawer.
- Manual cash drawer opening can be password protected. If enabled, the cashier must enter their password before opening the drawer manually.
- Cash drawer access can now be allowed per user. Admins can choose which cashiers are allowed to open the drawer from POS.
- The cash drawer now opens before receipt printing starts. This helps the cashier prepare change while the receipt is printing.
- The Big Buttons screen Open Till button now opens the cash drawer. Cashiers using the Big Buttons POS screen can open the till from the footer button.

What is easier now:
- Password entry is faster. When the password box opens, the cursor is already inside the password field.
- Cashiers can press Enter after typing the password. The Open button is selected automatically, so the cashier does not need to use the mouse.
- Cash drawer settings are clearer. Workstation settings and user POS settings now show separate options for drawer hardware and cashier permission.

How to use or check it:
- Go to Business Location > Settings.
- Open the Workstation tab.
- Add or edit the workstation used by the counter.
- Turn on Enable Cash Drawer (POS Printer).
- Turn on Password Protected to Open Cash Drawer if a password should be required.
- Go to Users > Settings > POS for the cashier.
- Turn on Allow to Open Cash Drawer.
- Save the settings.
- Open POS and use the cash drawer button or the Big Buttons Open Till button.

---

### Documentation - Desktop App Guide

What users can do now:
- A new {application_name} Desktop App guide has been added to Documentation.
- Users can now read simple setup help for the desktop app, connection settings, printer selection, cash drawer setup, and local transaction export.
- The guide uses the app name saved in Superadmin > Application Settings. It does not list different desktop app brand names.

How to use or check it:
- Go to Documentation.
- Open the {application_name} Desktop App section.
- Read the setup steps for connection, printers, cash drawer, and local export.

---

### Products and POS - Edit Price on Sale

What users can do now:
- Product prices can be changed at the time of sale. A new Edit Price on Sale option is available on the Add Product and Edit Product screens.
- POS shows the current selling price before adding the item. When this option is enabled for a product, adding that product on POS opens a price window with the current selling price already filled in.
- Cashiers can type a new price and press Enter. The entered price is applied to that product line on the current sale.
- The saved product price is not changed. The new price is used only for that sale line.
- The same product can be added more than once with different prices. If Edit Price on Sale is enabled, POS adds the product as a new line each time instead of increasing the old line quantity.
- This works even when Sales Item Addition Method is set to increase the item quantity if it already exists.

How to use or check it:
- Go to Products > Add Product or Products > Edit Product.
- Tick Edit Price on Sale.
- Save the product.
- Open POS.
- Add that product to the sale.
- When the price window opens, keep the existing price or enter a new price.
- Press Enter or click Update.
- The product appears on the sale with the selected price.
- Add the same product again if you need another line with a different price.

---

## Version 8.91.8 - 2026-07-12

### Roles - Manufacturing Location Access

What users can do now:
- Manufacturing permissions now have location choices. Production, Demand Order, Demand Order Report, Demand Ingredient Report, Manufacturing Report, Productions Report, and Productions & Stock Transfers Product Summary can be set to Own Location or All Locations.
- Own Location keeps users limited to their assigned business locations.
- All Locations lets users view records from every business location for the selected Manufacturing permission.
- Manufacturing pages and report popups/prints follow the same role setting.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Manufacturing tab.
- Tick the Manufacturing permission this role should use.
- Choose Own Location or All Locations under that permission.
- Save the role and open the matching Manufacturing page or report with that user.

---

### Sales and POS - Report Filters

What users can do now:
- Station filter is now included inside Sources. Users no longer need to use a separate Station dropdown on the Sales list and POS Sales list.
- Sales can be filtered from one place. Open Sources and choose either a sale source or a station/workstation.
- The filter area is cleaner and easier to use. Station and Sources are now handled together, so users have fewer separate boxes to check.

How to use or check it:
- Open Sales list or POS Sales list.
- Open Report Filters.
- Use the Sources dropdown.
- Choose All to see every sale.
- Choose a source to see sales from that source.
- Choose a station/workstation to see sales from that station.

---

### Roles - Main List Location Access

What users can do now:
- Expense, Stock Adjustment, Stock Transfer, Purchases, Sales, and POS tabs now have their own location choice. Users can select Own Location or All Locations under each tab.
- Own Location keeps users limited to their assigned business locations.
- All Locations lets users view records from every business location on that tab's main list.
- Stock Transfer Own Location includes transfers sent from or received into the user's allowed location.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Expense, Stock Adjustment, Stock Transfers, Purchases, Sales, or POS tab.
- Choose Own Location or All Locations at the top of the tab.
- Save the role and open the matching list with that user.

---

### Roles - Accounting Report Access

What users can do now:
- Accounting Reports no longer use one single View Reports permission. Each accounting report can now be allowed separately.
- Each accounting report now has its own location choice. Users can select Own Location or All Locations for the report they are allowed to view.
- The Accounting Reports page only shows reports the user is allowed to open.
- Ledger, Cash Flow, Trial Balance, Balance Sheet, Profit and Loss, ageing reports, Daily Transactions, and Chart of Account Report can now be controlled separately.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Accounting tab.
- Go to Reports.
- Tick only the accounting reports this role should use.
- Choose Own Location or All Locations under each selected report.
- Save the role and open Accounting Reports with that user.

---

### Roles - Accounting Entry List Access

What users can do now:
- Journal Entry list now has its own location choice. Under View Journal, users can select Own Location or All Locations.
- Transfer Entry list now has its own location choice. Under View Transfer, users can select Own Location or All Locations.
- Own Location keeps users limited to their assigned business locations.
- All Locations lets users view entries from every business location on these lists.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Accounting tab.
- Go to Journal Entry or Transfer.
- Choose Own Location or All Locations under the View permission.
- Save the role and open the Journal Entry or Transfer Entry list with that user.

---

### Roles - Project and Installment Permissions

What users can do now:
- Project permissions are now grouped into clear sections. Dashboard, Projects, Tasks, Time Logs, Documents & Notes, Stock, Invoices, Reports, and Settings are easier to review.
- Installment permissions are now grouped into clear sections. Dashboard, Installment access, Installment Plans, Collection, Reports, and Settings are easier to review.
- The permissions themselves stay the same. The role screen is cleaner, but saved access works the same way.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Project tab or Installment tab.
- Use each section's Select all option when you want to allow the full section.
- Save the role after choosing the needed permissions.

---

### Roles - Profit / Loss Report Access

What users can do now:
- Profit / Loss Report now has its own location choice. Under View profit/loss report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Profit / Loss report permission.
- The same choice applies when using the report. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Admin Reports.
- Tick View profit/loss report.
- Choose Own Location or All Locations.
- Save the role.
- Open Profit / Loss Report with that user and confirm the location access.

---

### Roles - Purchase & Sell Report Access

What users can do now:
- Purchase & Sell Report now has its own location choice. Under View purchase & sell report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Purchase & Sell report permission.
- The same choice applies when using the report. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Admin Reports.
- Tick View purchase & sell report.
- Choose Own Location or All Locations.
- Save the role.
- Open Purchase & Sell Report with that user and confirm the location access.

---

### Roles - Tax Report Access

What users can do now:
- Tax Report now has its own location choice. Under View Tax report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Tax Report permission.
- The same choice applies when using the report. The report screen, location filter, print, PDF, Excel, and GST report screens follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Admin Reports.
- Tick View Tax report.
- Choose Own Location or All Locations.
- Save the role.
- Open Tax Report with that user and confirm the location access.

---

### Roles - Expense Report Access

What users can do now:
- Expense Report now has its own location choice. Under View expense report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Expense Report permission.
- The same choice applies when using the report. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Admin Reports.
- Tick View expense report.
- Choose Own Location or All Locations.
- Save the role.
- Open Expense Report with that user and confirm the location access.

---

### Roles - Activity Log Report Access

What users can do now:
- Activity Log Report now has its own location choice. Under View Activity Log Report, users can select Own Location or All Locations.
- All-location access is easier to manage. Admin users can set Activity Log Report location access directly below the main report permission.
- The same choice applies when using the report. The report screen, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Admin Reports.
- Tick View Activity Log Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Activity Log Report with that user and confirm the location access.

---

### Roles - POS Report Location Access

What users can do now:
- Register Report now has its own location choice. Under View register report, users can select Own Location or All Locations.
- Summary Income Report now has its own location choice. Under View summary income report, users can select Own Location or All Locations.
- Sales Representative Report now has its own location choice. Under View sales representative report, users can select Own Location or All Locations.
- Types of Service Report now has its own location choice. Under View Types of Service Report, users can select Own Location or All Locations.
- The old separate All Locations checkboxes have been removed. Location access is now selected directly under each main report permission.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to POS Reports.
- Tick the report the user should access.
- Choose Own Location or All Locations under that report.
- Save the role.
- Open the report with that user and confirm the location access.
- For Types of Service Report, check Sales Reports if it is not shown under POS Reports.

---

### Roles - Report 606 Purchase Access

What users can do now:
- Report 606 (Purchase) now has its own location choice. Under Report 606 (Purchase), users can select Own Location or All Locations.
- Report 606 location access can be managed separately. Giving All Locations for the Purchase & Sell Report no longer has to control Report 606.
- The same choice applies when using Report 606. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Purchase Reports.
- Tick Report 606 (Purchase).
- Choose Own Location or All Locations.
- Save the role.
- Open Report 606 (Purchase) with that user and confirm the location access.

---

### Roles - Report 607 Sale Access

What users can do now:
- Report 607 (Sale) now has its own location choice. Under Report 607 (Sale), users can select Own Location or All Locations.
- Report 607 location access can be managed separately. Giving All Locations for the Purchase & Sell Report no longer has to control Report 607.
- The same choice applies when using Report 607. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Sales Reports.
- Tick Report 607 (Sale).
- Choose Own Location or All Locations.
- Save the role.
- Open Report 607 (Sale) with that user and confirm the location access.

---

### Roles - Sale Invoices Report Access

What users can do now:
- Sale Invoices Report now has its own location choice. Under View Sale Invoices Report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Sale Invoices Report permission.
- Cost value and profit can be hidden. Use Hide Cost value & Profit to stop users from seeing cost, purchase, and profit amounts in the detailed Sale Invoices Report, print, PDF, and Excel output.
- The same choice applies across the report. Totals, Summary, Detailed view, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Sales Reports.
- Tick View Sale Invoices Report.
- Choose Own Location or All Locations.
- Tick Hide Cost value & Profit if this user should not see cost or profit amounts.
- Save the role.
- Open Sale Invoices Report with that user and confirm the location and value access.

---

### Roles - Sales Reports Access

What users can do now:
- Sale Invoices Report now has its own location choice. Users can select Own Location or All Locations under the main report permission.
- Sales & Returns Report now has its own location choice. Users can select Own Location or All Locations under the main report permission.
- Product Sale Report now has its own location choice. Users can select Own Location or All Locations under the main report permission.
- Sale Payment Report now has its own location choice. Users can select Own Location or All Locations under the main report permission.
- Sales Analysis Report now has its own location choice. Users can select Own Location or All Locations under the main report permission.
- Trending Product Report now has its own location choice. Users can select Own Location or All Locations under the main report permission.
- Payment Recovery Report now has its own location choice. Users can select Own Location or All Locations under the main report permission.
- Discounts Report now has its own location choice. Users can select Own Location or All Locations under the main report permission.
- Stock Performance Report now has its own location choice. Users can select Own Location or All Locations under the main report permission.
- Old separate All Locations checkboxes have been removed. Location access is now selected directly under each report permission.
- Sale Invoices Report can hide cost and profit values. Use Hide Cost value & Profit to hide cost, purchase, and profit amounts from users.
- Product Sale Report can hide values separately. Use Hide Cost value & Profit to hide cost and profit amounts, and Hide Sale value to hide sale amount columns.
- Stock Performance Report can hide cost and profit values. Use Hide Cost value & Profit to hide cost, stock value, average cost, profit, and gross profit values.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Sales Reports.
- Tick the report the user should access.
- Choose Own Location or All Locations under that report.
- Tick the Hide value options if the user should not see those amounts.
- Save the role.
- Open the report with that user and confirm the location and value access.

---

### Roles - Purchase Invoices Report Access

What users can do now:
- Purchase Invoices Report now has its own location choice. Under View Purchase Invoices Report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Purchase Invoices Report permission.
- The same choice applies across the report. The report screen, summary, detailed view, totals, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Purchase Reports.
- Tick View Purchase Invoices Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Purchase Invoices Report with that user and confirm the location access.

---

### Roles - Purchase Analysis Report Access

What users can do now:
- Purchase Analysis Report now has its own location choice. Under View Purchase Analysis report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Purchase Analysis Report permission.
- The same choice applies when using the report. The report screen and print output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Purchase Reports.
- Tick View Purchase Analysis report.
- Choose Own Location or All Locations.
- Save the role.
- Open Purchase Analysis Report with that user and confirm the location access.

---

### Roles - Purchases & Returns Report Access

What users can do now:
- Purchases & Returns Report now has its own location choice. Under View Purchases & Returns Report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Purchases & Returns Report permission.
- The same choice applies when using the report. The report screen, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Purchase Reports.
- Tick View Purchases & Returns Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Purchases & Returns Report with that user and confirm the location access.

---

### Roles - Product Purchase Report Access

What users can do now:
- Product Purchase Report now has its own location choice. Under View Product Purchase Report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Product Purchase Report permission.
- The same choice applies across the report. Summary, Detailed, group-wise, Not Purchased, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Purchase Reports.
- Tick View Product Purchase Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Product Purchase Report with that user and confirm the location access.

---

### Roles - Purchase Payment Report Access

What users can do now:
- Purchase Payment Report now has its own location choice. Under View Purchase Payment Report, users can select Own Location or All Locations.
- The same choice applies across the report. Summary, Supplier Summary, Detail, print, PDF, and Excel output follow the selected Own Location or All Locations access.
- Advance payment rows also follow the selected location access. Users with Own Location only see advance payment rows for their allowed locations.
- All-location access is easier to manage. Admin users can set Purchase Payment Report location access directly below the main report permission.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Purchase Reports.
- Tick View Purchase Payment Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Purchase Payment Report with that user and confirm the location access.

---

### Roles - Supplier & Customer Report Access

What users can do now:
- Supplier & Customer report now has its own location choice. Under View Supplier & Customer report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Supplier & Customer report permission.
- The same choice applies when using the report. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to General Reports.
- Tick View Supplier & Customer report.
- Choose Own Location or All Locations.
- Save the role.
- Open Supplier & Customer report with that user and confirm the location access.

---

### Roles - Customer Groups Report Access

What users can do now:
- Customer Groups Report now has its own location choice. Under View Customer Groups Report, users can select Own Location or All Locations.
- All-location access is easier to manage. Admin users can set Customer Groups Report location access directly below the main report permission.
- The same choice applies when using the report. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to General Reports.
- Tick View Customer Groups Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Customer Groups Report with that user and confirm the location access.

---

### Roles - Cheque Clearance Report Access

What users can do now:
- Cheque Clearance Report now has its own location choice. Under View Cheque Clearance Report, users can select Own Location or All Locations.
- All-location access is easier to manage. Admin users can set Cheque Clearance Report location access directly below the main report permission.
- The same choice applies when using the report. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to General Reports.
- Tick View Cheque Clearance Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Cheque Clearance Report with that user and confirm the location access.

---

### Roles - Items Report Access

What users can do now:
- Items Report now has its own location choice. Under View Items Report, users can select Own Location or All Locations.
- All-location access is easier to manage. Admin users can set Items Report location access directly below the main report permission.
- The same choice applies when using the report. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to General Reports.
- Tick View Items Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Items Report with that user and confirm the location access.

---

### Roles - Bookings Report Access

What users can do now:
- Bookings Report now has its own location choice. Under View Bookings Report, users can select Own Location or All Locations.
- All-location access is easier to manage. Admin users can set Bookings Report location access directly below the main report permission.
- The same choice applies when using the report. The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to General Reports.
- Tick View Bookings Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Bookings Report with that user and confirm the location access.

---

## Version 8.91.7 - 2026-07-11

### Roles - Product History Access

What users can do now:
- Product History can now be controlled from the product role permissions. Businesses can decide which users are allowed to open product stock history.
- Purchase price and cost details stay hidden when the user is not allowed to view purchase price. This applies on the product history page and product history popup.
- Product history access is easier to manage. Admin users can give history access without automatically showing sensitive cost or purchase price information.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Product permissions section.
- Tick View product history if the user should be allowed to open product history.
- Only tick View Purchase Price for users who should see purchase price or cost information.
- Save the role.
- When that user opens Product History, purchase price and cost details will only show if View Purchase Price is allowed.

---

### Roles - Stock Quantity Report Access

What users can do now:
- Stock Quantity Report location access is easier to choose. Under View Stock Quantity Report, users can now select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Stock Quantity Report permission.
- Cost values can be hidden from the Stock Quantity Report. Use Hide Cost value to stop users from seeing purchase-value stock amounts.
- Sale values can be hidden from the Stock Quantity Report. Use Hide Sale value to stop users from seeing sale-value stock amounts.
- Stock Quantity Report follows the selected location access properly. Users with Own Location only see their allowed locations, while users with All Locations can see all stock locations.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Stock Quantity Report.
- Choose Own Location or All Locations.
- Tick Hide Cost value if this user should not see cost or purchase value amounts.
- Tick Hide Sale value if this user should not see sale value amounts.
- Save the role.
- Open Stock Quantity Report with that user and confirm the location and value access.

---

### Roles - Stock Value Report Access

What users can do now:
- Stock Value Report now has its own location choice. Under View Stock value Report, users can select Own Location or All Locations.
- Cost values can be hidden from the Stock Value Report. Use Hide Cost value to hide cost-side stock values from the report.
- Sale values can be hidden from the Stock Value Report. Use Hide Sale value to hide sale-side stock values from the report.
- Stock Value Report access is cleaner. The old View product stock value and Hide Stock / Value Report Prices checkboxes are no longer shown on the role setup page.
- The setting applies across the Stock Value Report. The same access is used on the main report, categorized view, location view, location details, print, PDF, and Excel export.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Stock value Report.
- Choose Own Location or All Locations.
- Tick Hide Cost value if this user should not see cost value amounts.
- Tick Hide Sale value if this user should not see sale value amounts.
- Save the role.
- Open Stock Value Report with that user and check the report, print, and export views.

---

### Roles - Opening Stock Report Access

What users can do now:
- Opening Stock Report now has its own location choice. Under View Opening Stock Report, users can select Own Location or All Locations.
- Opening stock cost amounts can be hidden. Use Hide Cost value to hide Unit Price and Subtotal amounts from the Opening Stock Report.
- Opening Stock Report now has the same value access options as the other stock reports. Hide Cost value and Hide Sale value are shown under the report permission.
- The setting applies across the Opening Stock Report. The same access is used on the main report, print, PDF, and Excel export.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Opening Stock Report.
- Choose Own Location or All Locations.
- Tick Hide Cost value if this user should not see opening stock cost amounts.
- Tick Hide Sale value if this user should not see sale value amounts.
- Save the role.
- Open Opening Stock Report with that user and check the report, print, and export views.

---

### Roles - Product Reorder Report Access

What users can do now:
- Product Reorder Report now has its own location choice. Under View Product Reorder Report, users can select Own Location or All Locations.
- Product Reorder Report no longer depends on Stock Quantity Report for location access. Admin users can manage Product Reorder Report location access separately.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Product Reorder Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Product Reorder Report with that user and confirm the correct locations are shown.

---

### Roles - Mismatch Quantity Report Access

What users can do now:
- Mismatch Quantity Report location access is easier to choose. Under View Mismatch Quantity Report, users can select Own Location or All Locations.
- The old separate All Locations checkbox has been removed. Location access is now selected directly under the main Mismatch Quantity Report permission.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Mismatch Quantity Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Mismatch Quantity Report with that user and confirm the correct locations are shown.

---

### Roles - Lot Report Access

What users can do now:
- Lot Report now has its own location choice. Under View Lot Report, users can select Own Location or All Locations.
- Lot Report no longer depends on Stock Quantity Report for location access. Admin users can manage Lot Report location access separately.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Lot Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Lot Report with that user and confirm the correct locations are shown.

---

### Roles - Stock Expiry Report Access

What users can do now:
- Stock Expiry Report now has its own location choice. Under View Stock Expiry Report, users can select Own Location or All Locations.
- Stock Expiry Report no longer depends on Stock Quantity Report for location access. Admin users can manage Stock Expiry Report location access separately.
- The same location choice is used when printing the report. Print, PDF, and Excel output follow the selected Own Location or All Locations access.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Stock Expiry Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Stock Expiry Report with that user and confirm the correct locations are shown.

---

### Roles - Product Serial Report Access

What users can do now:
- Product Serial Report now has its own location choice. Under View Product Serial Report, users can select Own Location or All Locations.
- Product Serial Report no longer depends on Stock Quantity Report for location access. Admin users can manage Product Serial Report location access separately.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Product Serial Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Product Serial Report with that user and confirm the correct locations are shown.

---

### Roles - Product Status Report Access

What users can do now:
- Product Status Report now has its own location choice. Under View Product Status Report, users can select Own Location or All Locations.
- Product Status Report no longer depends on Stock Quantity Report for location access. Admin users can manage Product Status Report location access separately.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Product Status Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Product Status Report with that user and confirm the correct locations are shown.

---

### Roles - Combo Items Report Access

What users can do now:
- Combo Items Report now has its own location choice. Under View Combo Items Report, users can select Own Location or All Locations.
- Combo Items Report no longer depends on Stock Quantity Report for location access. Admin users can manage Combo Items Report location access separately.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Combo Items Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Combo Items Report with that user and confirm the correct locations are shown.

---

### Roles - Stock Take Report Access

What users can do now:
- Stock Take Report now has its own location choice. Under View Stock Take Report, users can select Own Location or All Locations.
- Stock Take Report no longer depends on Stock Quantity Report for location access. Admin users can manage Stock Take Report location access separately.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Stock Take Report.
- Choose Own Location or All Locations.
- Save the role.
- Open Stock Take Report with that user and confirm the correct locations are shown.

---

### Roles - Stock Adjustment Report Access

What users can do now:
- Stock Adjustment Report now has its own location choice. Under View Stock Adjustment Report, users can select Own Location or All Locations.
- Cost values can be hidden from the Stock Adjustment Report. Use Hide Cost value to hide adjustment amount, unit price, subtotal, and other cost amounts.
- Recovered sale value can be hidden from the Stock Adjustment Report. Use Hide Sale value to hide the recovered amount.
- Stock Adjustment Report now has the same value access options as the other stock reports. Hide Cost value and Hide Sale value are shown under the report permission.
- The setting applies across the Stock Adjustment Report. The same access is used on the main report, summary, detailed view, product summary, print, PDF, and Excel export.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Stock Adjustment Report.
- Choose Own Location or All Locations.
- Tick Hide Cost value if this user should not see stock adjustment cost amounts.
- Tick Hide Sale value if this user should not see sale value amounts.
- Save the role.
- Open Stock Adjustment Report with that user and check the report, print, and export views.

---

### Roles - Stock Transfer Report Access

What users can do now:
- Stock Transfer Report now has its own location choice. Under View Stock Transfer Report, users can select Own Location or All Locations.
- Cost values can be hidden from the Stock Transfer Report. Use Hide Cost value to hide transfer amount, unit price, subtotal, and product summary value.
- Sale or charge values can be hidden from the Stock Transfer Report. Use Hide Sale value to hide shipping charges.
- The setting applies across the Stock Transfer Report. The same access is used on the main report, totals, summary, detailed view, product summary, print, PDF, and Excel export.
- Stock Consumption Report follows the Stock Transfer location choice. If a user has Own Location, the Stock Consumption Report stays limited to their allowed locations. If a user has All Locations, they can use all locations.
- Stock Consumption detailed view is safer to open. Users can open it with Category set to All without getting an error.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- Go to Stock Reports.
- Tick View Stock Transfer Report.
- Choose Own Location or All Locations.
- Tick Hide Cost value if this user should not see stock transfer cost amounts.
- Tick Hide Sale value if this user should not see shipping charge amounts.
- Save the role.
- Open Stock Transfer Report and Stock Consumption Report with that user and check the report, print, and export views.

---

### Roles - Separate Stock Report Permissions

What users can do now:
- Stock Performance Report now has its own permission. It no longer depends on the Stock Quantity Report permission.
- Mismatch Quantity Report now has its own permission. It can be allowed or blocked separately from Stock Quantity Report.
- Each report can have its own location access. Admin users can choose whether users see only their own locations or all locations for each report.
- Report access is easier to understand. Giving access to one stock report no longer automatically gives access to the other stock reports.

How to use or check it:
- Go to Settings > Roles.
- Add a new role, or edit an existing role.
- Open the Reports tab.
- For Stock Performance Report, go to Sales Reports and tick View Stock Performance Report.
- For Mismatch Quantity Report, go to Stock Reports and tick View Mismatch Quantity Report.
- Choose the needed location access for each report.
- Save the role.
- Log in as that user and confirm only the allowed reports are visible.

---

### Roles - Permission Search

What users can do now:
- Permissions are easier to find while adding or editing a role. A search box is now shown at the top of the Add Role and Edit Role pages.
- Users can quickly jump to the permission they need. Search for a permission name or section, then select the matching result.
- The correct permission section opens automatically. The page moves to the matching area and highlights it, so users do not need to scroll through the full role form.
- Role setup is faster for large permission lists. This helps when setting access for sales, purchases, products, reports, users, settings, and other sections.

How to use or check it:
- Go to Settings > Roles.
- Click Add Role, or edit an existing role.
- Use the search box at the top of the page.
- Type the permission or section name you want to find.
- Select the matching result from the list.
- Review or tick the needed permission.
- Save the role when finished.

---

### Main Menu - Mobile Top Shortcuts

What users can do now:
- Top shortcut buttons are easier to use on mobile. When users tap the three-dot menu, the shortcut buttons stay in one neat row.
- Users can swipe the shortcut buttons left or right. This makes it easier to reach all available shortcut buttons on small screens.
- Shortcut buttons no longer hide behind the right side of the screen. The menu now uses the available space better.
- The shortcut buttons are easier to see and tap. The buttons have more height and are not cut off.
- The three-dot button is easier to reach. Its position is adjusted for a better mobile view.

How to use or check it:
- Open the software on a mobile screen or small browser size.
- Tap the three-dot button in the top menu.
- Swipe the shortcut button row left or right to see more options.
- Tap any shortcut button you want to use.
- Tap the close button to hide the shortcut row again.

---

### Business Settings - Date Range Defaults

What users can do now:
- Default date ranges can now be set from one place. Users can open Business Settings and choose the starting date range for the dashboard, lists, and reports.
- Each important page can have its own date range. For example, Purchases can open on Today, Sales Reports can open on This Year, and Activity Log can open on Today.
- Report filters are easier to use. When a report is opened, the date filter starts with the saved default instead of needing to be changed every time.
- Users can still change the date manually. The saved option only controls what date range appears first when the page or report opens.

Pages covered:
- Home / Dashboard.
- Sales pages: Sale Returns and Draft Sales.
- Purchase pages: Purchases, Purchase Returns, Purchase Orders, and Stock Transfers.
- Installment pages: Installment Sales and Installment Reports.
- HRM pages: Leave, All Attendance, and Attendance by Date.
- Accounting pages: Journal Entry, Transfer, and Cash Flow.
- Accounts pages: Payment Account Report.
- Other daily work pages: To Do, Expenses, and Profit / Loss Report.

Reports covered:
- Admin Reports: Profit / Loss Report, Purchase & Sale, Tax Report, Expense Report, and Activity Log.
- POS Reports: Register Report, Summary Income Report, Sales Representative Report, Service Staff Report, Table Report, and Types of Service Report.
- Sales Reports: Report 607 (Sale), Sale Invoices Report, Sales & Returns Report, Product Sale Report, Sale Payment Report, Sales Analysis, Trending Products, Payment Recovery Report, Discounts Report, Stock Performance Report, and Product Booking Report.
- Purchase Reports: Report 606 (Purchase), Purchase Invoices Report, Purchases & Returns Report, Product Purchase Report, Purchase Payment Report, and Purchase Analysis.
- Stock Reports: Stock Quantity Report, Stock Value Report, Stock Reorder Report, Opening Stock Report, Mismatch Quantity Report, Stock Adjustment Report, Stock Take Report, Stock Transfer Report, Combo Items Report, Stock Consumption Report, Product Status Report, and Product Serial Report.
- General Reports: Supplier & Customer Report, Contact's Opening Balance Report, Contact's Advance Deposit Report, Customer Groups Report, Cheque Clearance Report, Items Report, and Bookings Report.
- Accounting Reports: Ledger Report, Cash Flow Report, Trial Balance, Balance Sheet, Profit / Loss, and Daily Transactions Report.

How to use or check it:
- Go to Settings > Business Settings.
- Open the Date Range tab.
- Choose the default date range for each page or report you use.
- Click Update Settings.
- Open the page or report again. The date filter should now start with the saved date range.
- Change the date filter on the page anytime if you need a different period for that visit.

---

### Contacts - Contact List

What users can do now:
- Contact lists now open in Contact ID order. Suppliers, customers, and combined contacts show the smaller Contact IDs first when the Contact ID column is visible.
- Supplier IDs are easier to follow. For example, CO0002 will appear before CO0193 on the supplier list.
- Users can still change the order when needed. Click any column heading to sort the list another way.

How to use or check it:
- Go to Contacts and open Suppliers, Customers, or Both.
- Check the Contact ID column.
- The list should start from the smaller Contact IDs first.
- Click the Contact ID heading again if you want to reverse the order.

---

### Invoice Layout - Slim 4 Receipt

What users can do now:
- Slim 4 receipt labels now print in normal text. Token, reference, and similar title labels no longer appear bold on the printed receipt.
- The receipt looks cleaner and more even. The label text now matches the regular invoice, date, and customer labels.

How to use or check it:
- Go to Settings > Invoice Settings.
- Open the Layout tab.
- Use a layout with Slim 4 design.
- Print or preview a POS invoice.
- Check the Token or Ref label. It should now print in normal text.

---

### POS - Final Bill Edit

What users can do now:
- Token No can be entered again while editing a final POS bill. If the token number was missing, the cashier can add it before saving the edited bill.
- Existing Token No can be changed while editing. If the bill already has a token number, it appears in the prompt and can be updated.
- The Draft button is hidden on final bill edit. Users editing a completed POS bill now see only the relevant save and payment actions.

How to use or check it:
- Open POS sales and edit a completed bill.
- Make the needed changes.
- Click the final save or payment button.
- When the Token No box appears, enter a new token number or change the existing one.
- Press Enter to continue and save the bill.
- The Draft button will not show on the final bill edit page.

---

### POS - Close Register

What users can do now:
- Close Register now works properly for restricted cashiers after approval. When a cashier needs approval to close the register, the approval login opens and accepts the authorized user's username and password.
- The Close Register form opens after successful approval. Cashiers can continue the closing process without refreshing the POS screen.
- The POS screen no longer stays stuck after approval. After the authorized user approves, the cashier can complete the register closing normally.
- If closing is not allowed yet, users see a clear warning. For example, if offline sales still need to be synced, the system shows a message instead of leaving the screen stuck.

How to use or check it:
- Open the POS screen.
- Open the POS Menu from the right side.
- Click Close Register.
- Enter the authorized user's username and password when approval is required.
- After approval, fill in the Close Register form and close the register as usual.
- If a warning appears, follow the message shown on the screen, then try Close Register again.

---

### Discounts - Date Limit

What users can do now:
- Discounts can now be saved without a Start Date or End Date. If both dates are left blank, the discount has no date limit.
- Open-ended discounts can be used at any time. These discounts can apply on POS and sales screens without needing a fixed date range.
- Existing discount dates can be removed easily. On the discount edit page, users can click the date or time field and press Delete or Backspace to clear it.
- The discount list shows No Limit for blank dates. This helps users quickly understand which discounts do not have a date limit.

How to use or check it:
- Go to Discounts.
- Click Add, or edit an existing discount.
- Leave Start Date and End Date blank if the discount should have no date limit.
- If an old date is already selected, click the date or time field and press Delete or Backspace to remove it.
- Save the discount.
- Use POS or sales as usual. The discount can apply without a date limit.

---

### Products - Discount Promo Date Limit

What users can do now:
- Product Discount Promo dates are now blank by default. When adding a product, Start Date and End Date are no longer filled automatically.
- Product promos can be saved without a date limit. If Start Date and End Date are left blank, the promo can apply at any time.
- Existing product promo dates can be removed easily. On the product edit page, users can click the promo date field and press Delete or Backspace to clear it.
- Users can still set dates when needed. If a promo should run for a limited period, users can select Start Date and End Date as before.

How to use or check it:
- Go to Products and click Add Product, or edit an existing product.
- Go to the Discount Promo section near the bottom of the product form.
- Choose the discount type and enter the needed promo details.
- Leave Start Date and End Date blank if the promo should have no date limit.
- If an old date is already selected, click the date field and press Delete or Backspace to remove it.
- Save the product.
- Open POS and add the product. The promo can apply without a date limit.

---

## Version 8.91.6 - 2026-07-10

### POS - Item Discount

What users can do now:
- Default Item Discount Type now works on the POS screen. When Fixed is selected, the item discount is treated as an amount. When Percentage is selected, the item discount is treated as a percent.
- New POS items follow the selected default discount type. Cashiers do not need to change the item discount type manually for every product.
- Inline item discount is easier to use during sales. Businesses can choose the discount style that matches their normal billing process.

How to use or check it:
- Go to Settings > Business Settings.
- Open the Sales tab.
- Turn on Enable Inline Discount in Sales.
- Choose Default Item Discount Type: Fixed or Percentage.
- Save the settings.
- Open the POS screen and add a product.
- Check the item discount field. It should now use the selected default type.

---

### POS - Buy for Quantity Discount

What users can do now:
- Buy for Quantity discounts are clearer on the POS screen. When an offer is set with a total price, the discount field now shows the discount as a percent instead of showing a small per-item rupee amount.
- The subtotal still matches the offer total. For example, if 12 items are set to sell for Rs 2,000, the POS subtotal stays Rs 2,000.
- Cashiers can understand the discount field more easily. The discount value and discount type now match each other, so users do not see a rupee sign beside a percentage-style value.

How to use or check it:
- Go to Discounts.
- Create or edit a discount.
- Choose Buy For as the discount type.
- Enter the quantity and total offer price.
- Save the discount.
- Open the POS screen and add the same product.
- Enter the offer quantity.
- Check that the discount field shows a percent and the subtotal shows the offer total.

---

### Products - Discount Promo

What users can do now:
- Product add and edit pages now support all discount promo types. Users can choose Fixed, Percentage, Buy For, Buy For Unit Price, or Buy Get Free directly from the product page.
- Buy For offer fields are available on the product page. Users can enter the offer quantity and total offer price without opening the separate Discounts page.
- Buy For Unit Price offer fields are available on the product page. Users can enter the offer quantity and unit offer price for the product.
- Buy Get Free offer fields are available on the product page. Users can enter the buy quantity and free quantity in the same Discount Promo section.
- Discount promos saved from the product edit page now work on the POS screen. Users can add an offer on the product page and use it during billing.

How to use or check it:
- Go to Settings > Business Settings.
- Open the Product tab.
- Turn on Enable Discount Promo.
- Open Products and create or edit a product.
- Go to the Discount Promo section near the bottom of the product form.
- Choose the discount type you want to use.
- Fill in the fields shown for that discount type.
- Save the product.
- Open POS, add the product, and enter the offer quantity.
- The saved promo should apply while the selected dates are active.

---

### Contacts - Ledger

What users can do now:
- Contact ledger pages open normally. Users can open a customer, supplier, or contact ledger without seeing an error page.
- Ledger date filters load correctly. The saved date range settings are ready when the ledger page opens.
- Users can continue checking contact balances, invoices, and payments without refreshing or logging in again.

How to use or check it:
- Go to Contacts.
- Open the customer or supplier you want to check.
- Open the Ledger tab.
- Review the ledger details and use the date or location filters as needed.
- Print or download the ledger if a copy is required.

---

### POS - Sales List Navigation

What users can do now:
- Users can return to the POS sales list without an error. When a cashier goes back from the POS screen, the POS sales list opens normally.
- The POS sales list filters are ready to use. Date, location, customer, and payment filters load normally when the page opens.
- Cashiers can continue working without refreshing the page or logging in again.

How to use or check it:
- Open the POS screen.
- Use the Back button or open the POS sales list from the menu.
- Check that the sales list and filters appear normally.
- Continue searching, viewing, or adding POS sales as needed.

---

### Business Settings - Admin Access

What users can do now:
- Admin users can open Business Settings normally. The Business Settings page is available from the sidebar for admin users without showing an unauthorized message.
- The sidebar menu now matches admin access. If an admin user is allowed to manage business settings, the Business Settings menu option stays visible and opens correctly.

How to use or check it:
- Login with an admin user.
- Go to Settings > Business Settings from the sidebar.
- The Business Settings page should open normally.
- Use the available tabs to review or update business setup options.

---

### Products - Product Tax Fields

What users can do now:
- Product tax fields can now be turned on or off from Business Settings. A new option, Enable product tax fields, is available in the Product tab.
- When this option is turned on, product tax choices are shown on product add and edit pages. Users can select Applicable Tax, Selling Price Tax Type, and Tax Not Applicable while creating or editing products.
- When this option is turned off, product tax choices are hidden. This keeps the product form simpler for businesses that do not use product-level tax.
- Product price fields follow the same setting. Tax-related price fields appear only when product tax fields are enabled.
- New taxes can be added directly from the product page. Users can click the plus button beside Applicable Tax to add a new tax rate without leaving the product add or edit page.

How to use or check it:
- Go to Settings > Business Settings.
- Open the Product tab.
- Tick Enable product tax fields if you want to use tax on products.
- Click Update Settings.
- Go to Products > Add Product or edit an existing product.
- Use Applicable Tax, Selling Price Tax Type, and Tax Not Applicable as needed.
- Click the plus button beside Applicable Tax if you need to add a new tax rate.
- Untick Enable product tax fields if your business does not need product tax fields on product pages.

---

### Contact Payments - Payment Details

What users can do now:
- Customer to supplier payments are easier to understand. The payment view now clearly shows when a customer payment is used to pay a supplier.
- The payment title is clearer. These payments now show the title Customer to Supplier Payment, so users can quickly understand the payment purpose.
- From and To details are shown in the correct order. The From contact is shown at the top, and the To contact is shown below.
- Printed payment details are easier to follow. Users can check who the payment came from and who it was paid to before printing or sharing the payment details.

How to use or check it:
- Open the contact payment you want to check.
- Click View on the payment.
- Check that the title shows Customer to Supplier Payment.
- Review the From section at the top.
- Review the To section below it.
- Print or share the payment details if needed.

---

## Version 8.91.5 - 2026-07-09

### Expenses - Expense Categories

What users can do now:
- Expense categories can now have a monthly budget. Users can enter a monthly budget amount while adding or editing an expense category.
- Expense categories can be organised as sub-categories. Users can tick Add as sub category and select a parent category when needed.
- The Expense Categories list is easier to read. Category Code is now shown first, followed by Category Name, Monthly Budget, Remaining Budget, and Action.
- Users can quickly see how much monthly budget is left. The Remaining Budget column shows the amount left for the current month.
- Remaining Budget starts fresh every month. When a new month starts, the remaining amount begins again from the monthly budget.
- Expense refunds reduce the used amount. If a refund is recorded, the remaining budget is adjusted accordingly.
- Main categories and sub-categories still stay grouped together. Users can expand or collapse categories to review them neatly.

How to use or check it:
- Go to Expenses > Expense Categories.
- Click Add to create a new category, or Edit to update an existing one.
- Enter the Category Name, Category Code, and Monthly Budget if needed.
- To make it a sub-category, tick Add as sub category and select the parent category.
- Click Save or Update.
- Check the list to review Category Code, Category Name, Monthly Budget, and Remaining Budget.
- Use Collapse All or Expand All to show or hide sub-categories.

---

### HRM - Holidays, Leave, and Role Access

What users can do now:
- Holiday access can now be controlled separately. Admins can decide who can only view holidays and who can add, edit, or delete holidays.
- The Holiday menu is shown only to allowed users. Staff without holiday access will not see the Holiday option.
- The Holiday page shows actions based on access. Users with view access can check holidays, while users with manage access can add, edit, and delete them.
- The HRM Dashboard now follows each user's access. Leave and holiday information is shown only to users who are allowed to view it.
- Leave access is clearer for staff and approvers. Staff who can apply for leave can use the Add button, and leave approvers can review leave requests.
- HRM menus now match each user's role. Leave, Holidays, Attendance, Employee Documents, Warnings, Awards, Announcements, and Leave Quotas are shown only to allowed users.
- Shift management is limited to allowed HRM users. Only users with the correct access can manage shifts.

How to use or check it:
- Go to Settings > Roles.
- Create a new role or edit an existing role.
- Open the HRM / Essentials access section.
- Under Holidays, tick View Holidays for users who only need to see holidays.
- Tick Add, Edit, and Delete Holidays for users who should manage holidays.
- For Leave, give the user the needed leave access, such as applying for leave or approving leave.
- Save the role.
- Ask the user to open HRM and check that only the allowed HRM options are visible.

---

### Reports - Stock Transfer Report

What users can do now:
- The Detailed tab now shows footer totals at the bottom. Users can see the total shipping charges, total amount, total item quantity, and product subtotal without adding them manually.
- Amount columns now show the currency symbol in the column heading. The values stay clean and easy to read because the currency symbol is no longer repeated beside every amount.
- Number and amount values are now aligned to the right. This makes totals, quantities, and amounts easier to compare across all report tabs.
- The same clean format is used in report print and Excel output. Users see the currency in the heading and plain numeric values in the rows.

How to use or check it:
- Go to Reports > Stock Transfer Report.
- Open the Totals, Summary, Detailed, or Products Summary tab.
- Check the column headings to see the currency symbol.
- Read the numeric values from the right side of each number column.
- Open the Detailed tab to see footer totals at the bottom of the report.
- Use Print A4 or Export to Excel when a copy of the report is needed.

---

### Purchase Orders - Stock Level Product Load

What users can do now:
- Products can be prepared with Low, Medium, High, and Max stock levels. These levels help the system know how much quantity should be ordered when stock becomes low.
- A default supplier can be selected on the product add and edit pages. This helps the system know which supplier should be used for each product.
- Purchase Order add and edit pages can now load products by stock level. Users can choose a supplier, location, and stock level, then load matching products into the purchase order.
- Only products that have reached low stock are loaded. If a product still has enough stock, it will not be added by the load button.
- The selected stock level decides the order quantity. For example, if Low is 5, Medium is 10, High is 20, and Max is 30, selecting High will load the product with quantity 20 when the product has reached low stock.
- Supplier products are loaded based on the product's default supplier. This helps users order only the products linked with the selected supplier.
- Already added products are updated instead of added again. If the same product is already in the purchase order, its quantity is changed to the selected stock level quantity.

How to use or check it:
- Go to Products and add or edit a product.
- Select the Default Supplier for the product.
- Enter Low Stock Level, Medium Stock Level, High Stock Level, and Max Stock Level as needed.
- Save the product.
- Go to Purchases > Purchase Order.
- Click Add or edit an existing purchase order.
- Select the supplier and business location.
- Select the stock level you want to order up to, such as Low, Medium, High, or Max.
- Click Load Products.
- Check the loaded products and quantities before saving the purchase order.

---

### Settings - Search

What users can do now:
- Business Settings search now helps users find settings even when the typed words are not exact. If the user types similar text, the page shows the closest matching setting.
- Invoice Layout add and edit pages now also have a settings search field. Users can search layout options from the top of the page instead of scrolling through all sections.
- The best matching setting is shown under the search field. Users can click the suggested match to go directly to that setting.
- The correct section opens automatically. When a setting is selected, the page opens the right tab or layout section and highlights the setting.
- Users can see when no close match is found. This helps users know they should try a different word.

How to use or check it:
- Go to Settings > Business Settings to search business settings.
- Type the setting name or similar words in the search field.
- Check the Best match suggestion under the search field.
- Click the suggestion or select a result from the search list.
- The page will move to the matching setting and highlight it.
- Go to Settings > Invoice Settings > Layout tab.
- Click Add or Edit on an invoice layout.
- Use the search field at the top to find layout settings in the same way.

---

### HRM - Employee Documents

What users can do now:
- Employee documents can now be uploaded while adding a document. Users can attach the document file directly from the Add Employee Document form.
- New employee document entries appear in the list right after saving. Users no longer need to refresh the page to see the new entry.
- Employee document entries can now be edited. Users can open an existing employee document, change the details, and replace the attached file if needed.
- Users can view attached employee documents from the list. A View button is shown when a file is attached.
- Download is only shown when a file is attached. If no file is attached, the View and Download buttons stay hidden so users do not click empty actions.
- Employee document files are saved in the correct business folder. This keeps uploaded HRM files organised for each business.

How to use or check it:
- Go to HRM > More > Employee Documents.
- Click Add.
- Select the employee and enter the document details.
- Attach the document file.
- Click Save.
- Check the list to see the new entry immediately.
- Use the View button to open an attached file.
- Use the Download button to download an attached file.
- Use the Edit button to update the entry or replace the file.
- If no file is attached, View and Download will not be shown.

---

### Superadmin - Fix Uploads Folder

What users can do now:
- Fix Uploads Folder now organises more uploaded files into the correct business folder. This includes employee documents, display screen carousel images, and quick menu images.
- Old selected upload folders can now be cleaned up. The tool can move files from old shared folders into the correct business folder and remove empty old folders after cleanup.
- Display screen carousel images continue to open after cleanup. Users can still see their saved carousel images from the Display Screen settings and customer display screen.
- Quick menu images continue to show after cleanup. Quick menu images remain visible on POS buttons and edit screens after files are moved.
- The tool avoids guessing when files cannot be safely matched. If files cannot be matched to one business automatically, the tool leaves them for review instead of moving them to the wrong place.

How to use or check it:
- Go to Superadmin > Settings.
- Open the Maintenance Tools tab.
- Click Fix Uploads Folder.
- Wait until the page shows the cleanup result.
- Check Employee Documents, Display Screen carousel images, and Quick Menu images after the cleanup.
- If the result says some files were left for review, check those files before moving them manually.

---

### User Management - Users and Employees

What users can do now:
- The All users section now shows the user limit. Users can see how many login users are already added and how many are allowed in the current package, for example All users 7/10.
- The All Employees section now shows the employee limit when HRM & Essentials is included. Users can see how many employees are already added and how many are allowed in the current package.
- Businesses without HRM & Essentials no longer see the All Employees section. This keeps the Users List focused on the features available in the package.
- The All Merchants section is only shown when contact login records exist. If no contact login has been created, the empty merchants section is hidden.
- Unlimited packages are shown clearly. If the package allows unlimited users or employees, the heading shows Unlimited instead of a number.
- It is easier to know before adding more users or employees. Users can quickly check the heading and understand whether there is still space in the package.

How to use or check it:
- Go to Users List.
- Check the All users heading to see the current login user count and package limit.
- If HRM & Essentials is included, check the All Employees heading to see the current employee count and package limit.
- If contact logins exist, check the All Merchants section to view them.
- Use these numbers before adding a new user or employee.

---

### Superadmin - Packages

What users can do now:
- Employee limit is only shown for packages that include HRM & Essentials. Packages without HRM & Essentials no longer show the employee limit line.
- The employee limit label is easier to understand. When it is shown, it appears as the number of employees instead of a warning message.

How to use or check it:
- Go to Superadmin > Packages.
- Open or check a package card.
- If the package includes HRM & Essentials, the employee limit is shown.
- If the package does not include HRM & Essentials, the employee limit is hidden.

---

## Version 8.91.2 - 2026-07-07

### Superadmin - Maintenance Tools

What users can do now:
- Maintenance Tools now has its own tab in Superadmin Settings. Superadmin users can find repair tools in one clear place instead of looking at the bottom of other settings tabs.
- Fix Uploads Folder is available from the Maintenance Tools tab. This helps move old uploaded files into the correct business folders.
- Fix Default Product Image Repeats and Fix Quantity Mismatch are also available from the Maintenance Tools tab. Superadmin users can use these repair buttons from the same screen.

How to use or check it:
- Go to Superadmin > Settings.
- Open the Maintenance Tools tab.
- Click Fix Uploads Folder if uploaded files need to be moved into the correct business folders.
- Click Fix Default Product Image Repeats if repeated default product images need to be corrected.
- Click Fix Quantity Mismatch if product quantities need to be checked and corrected.

---

### Sales - Edit Sale

What users can do now:
- Sale invoice number can now be changed from the Edit Sale page. Users can open an existing sale and update the Invoice No. / Transaction No. when needed.
- The invoice number field is now visible on the Edit Sale page. Users do not need to turn on a separate setting to see it.
- Duplicate invoice numbers are checked before saving. If the same number is already used on another sale, the system shows a warning so the user can choose a different number.

How to use or check it:
- Go to Sales > All Sales.
- Find the sale you want to update.
- Click Actions > Edit.
- Change the Invoice No. / Transaction No. field if needed.
- Click Save.
- If a duplicate number warning appears, enter a different number and save again.

---

### User Security - Users and Employees

What users can do now:
- Adding users and adding employees can now be controlled separately. Business owners can allow a staff member to add login users, add employees, or both.
- The All users Add button and All Employees Add button now follow separate access settings. Staff will only see the Add button they are allowed to use.
- Employee records stay as employees when added from All Employees. This helps avoid creating a login user by mistake.

How to use or check it:
- Go to Settings > Security Roles.
- Create a new role or edit an existing role.
- Open the User Security tab.
- Tick Add user if the staff member should add login users.
- Tick Add employee if the staff member should add employees without login access.
- Save the role.
- Go to Users List and check the All users and All Employees sections.

---

### Products and POS - Alternate SKU

What users can do now:
- Product View now shows alternate SKUs with the main SKU. Users can open a product and quickly see its saved alternate SKU or barcode.
- POS SKU search now works with alternate SKUs. Cashiers can scan or type an alternate SKU in the SKU search box and the correct product is added to the sale.
- Checkout is easier when products have more than one SKU. Users do not need to remember only the main SKU.

How to use or check it:
- Go to Products.
- Open Actions > View on a product to check its main SKU and alternate SKU.
- Turn on Enable SKU Based Product Search from Business Settings if it is not already enabled.
- Open POS.
- Scan or type the main SKU or alternate SKU in the SKU search box.
- The matching product is added to the sale.

---

### Sales - Sale Returns

What users can do now:
- Sale Returns list is easier to read. Column headings now line up neatly with the return details below them.
- Actions are now easier to find. The Actions button is shown as the first column, so users can open View, Edit, Print, or Delete without scrolling to the right.
- Sale returns save faster after changes. Users should wait less when updating an existing sale return, especially when it has several items.
- Stock stays more accurate when a sale return is edited. Changes in date, item quantity, or removed items are now reflected more reliably.

How to use or check it:
- Go to Sales > Sale Returns.
- Use the Actions button in the first column to view, edit, print, or delete a sale return.
- Check the list columns to read sale return details clearly.
- To update a sale return, click Actions > Edit.
- Make the needed changes and click Save.
- Wait for the success message before leaving the page.

---

### Reports - Profit / Loss

What users can do now:
- Sale returns now show correctly in the Profit / Loss report. Returned products reduce the profit amount properly, so users see a more accurate report.
- Product returns entered from the Sale Returns screen are also included. Users can trust the profit figures when returned products are added from Sale Returns.
- Profit breakdown tabs now open properly. Users can check profit by product, category, brand, location, invoice, date, customer, and day without the screen staying on Processing.

How to use or check it:
- Go to Reports > Profit / Loss.
- Select the date range and location you want to check.
- Review Gross Profit and Net Profit.
- If sale returns were made in that period, they are now included in the profit amount.
- Use the profit breakdown tabs at the bottom to review profit in different ways.
- If you change the date range or location, wait for the tab to refresh and show the updated result.

---

### Home - Today's Profit

What users can do now:
- Today's Profit popup is wider and easier to read. Users can view the report details with more space on the screen.
- The popup still adjusts to smaller screens. Users can open it on different screen sizes without the content going outside the page.

How to use or check it:
- Click the Today's Profit button from the top menu.
- Review the profit details in the wider popup.
- Click Close when you are finished.

---

### Reports - Product Sale Report

What users can do now:
- Product returns are now shown correctly in the Product Sale Report. Returned products reduce quantity, amount, cost, and profit instead of being missed.
- Sold quantity now shows after returns. For example, if 2 quantities were sold and 1 quantity was returned, the report shows 1 quantity sold.
- Sale return cost now stays correct. If a product is purchased again later at a different cost, the old sale return still shows the correct cost in the report.
- Summary and Grouped tabs now match the Detailed result. Users can check profit from any tab and get the same correct result.
- Detailed (With purchase) now also shows sale return rows. Returned items appear with a minus quantity, so users can see where the returned item is included.
- Printed and exported Product Sale Reports show the same result. Users can print or export the report and still see the return effect clearly.
- Loss checking is easier. Users can review products where returns or costs caused a loss.

How to use or check it:
- Go to Reports > Product Sale Report.
- Choose the needed date range, location, product, category, or other filters.
- Open the Detailed tab, Summary tab, Grouped tab, or Detailed (With purchase) tab.
- Check the quantity, subtotal, cost, and profit columns.
- In Detailed (With purchase), sale return rows are shown as minus quantity and marked as Sale Return.
- Use Print or Export if you need a copy for review.

---

### Reports - Sale Invoices Report

What users can do now:
- Sale return profit is now shown correctly in the Sale Invoices Report. When users filter the report by Sale Returns and open the Detailed tab, the profit now follows the correct returned item cost.
- Ledger Discount 3 is now included in sale return profit. If a discount was added on selected purchase invoices, the Sale Invoices Report now shows profit in line with the Product Sale Report and Profit / Loss report.
- Net profit checking is clearer. Users can compare Sales Invoices profit with Sales Return profit and get the correct net profit after discounts.
- Old sale returns stay correct after new purchases. If the same product is purchased later at a new cost, old sale return profit does not change incorrectly.

How to use or check it:
- Go to Reports > Sale Invoices Report.
- Select Sales Invoices in the report filter and open the Detailed tab to check sale profit.
- Select Sale Returns in the report filter and open the Detailed tab to check return profit.
- If Ledger Discount 3 was added, check the cost and profit columns after saving the discount.
- Compare sale profit minus return profit to review the net profit.

---

### Contacts - Ledger Discount 3

What users can do now:
- Ledger Discount 3 can now be saved with Submit and Reindex. This helps users save the discount and refresh the selected purchase invoices in one step.
- Submit and Reindex is available while adding and editing Ledger Discount 3. Users can use the same option when creating a new discount or changing an existing discount.
- The edit popup now stays in front properly. Users can open and work in the Ledger Discount 3 edit popup without it hiding behind the page.
- A clear processing message appears while the stock refresh is running. Users can wait until the save is finished without clicking again.
- If no purchase invoice is selected, users now see a clear message. This helps avoid saving a discount without choosing the purchases it belongs to.
- Users can still save normally. Use the regular Submit button when a stock refresh is not needed.

How to use or check it:
- Open the required contact.
- Open the Ledger Discount 3 option.
- Select the purchase invoices that should receive the discount.
- Click Submit to save normally.
- Click Submit and Reindex when you also want the selected purchase invoices to refresh.
- Use the same Submit and Reindex button when editing an existing Ledger Discount 3 entry.
- Wait for the success message before closing the popup.

---

### Sales - POS and Direct Sale

What users can do now:
- After saving a direct sale, the system now opens the correct Sales list. This helps users return to the sale list smoothly after saving.
- Booking reminders now continue to the correct Sales list. Users are taken to the right page after completing the reminder step.

How to use or check it:
- Go to POS or Direct Sale.
- Create or update the sale as usual.
- Save the sale.
- After the success message, the system opens the correct Sales list page.

---

## Version 8.90.7 - 2026-07-06

### Sales - Sales List

What users can do now:
- Sales list now shows when a sale was last updated. Users can check the Updated At column to see the latest change time for each sale.
- Updated At appears before Created At. This makes it easy to compare when a sale was first made and when it was last changed.

How to use or check it:
- Go to Sales > List Sales.
- Scroll to the right side of the list if needed.
- Check the Updated At column before Created At.
- Use Updated At to see when the sale was last changed.
- Use Created At to see when the sale was first added.

---

### Sales - Sale Returns List

What users can do now:
- Sale Returns list now shows Created At and Updated At. Users can see when each sale return was added and when it was last changed.
- The new date columns are shown on the right side of the list. This keeps the main sale return details in place while still showing the extra timing information.

How to use or check it:
- Go to Sales > Sale Returns.
- Scroll to the right side of the list if needed.
- Check Created At to see when the sale return was first added.
- Check Updated At to see when the sale return was last changed.

---

### Offline Sync - Products, Contacts and Sales

What users can do now:
- Offline Sync now checks that the offline company and cloud company are the same before syncing. This helps stop products, contacts, or sales from being synced to the wrong company.
- Users now see a clear warning if the wrong company is logged in. The message tells users to login to the matching offline company before syncing.
- Product sync is safer for offline workstations. Users should only sync products after confirming they are logged into the same company that is connected on cloud.
- Sales sync is safer when contacts are involved. This helps avoid a sale showing under the wrong customer after syncing.
- Slow or failed sync attempts show clearer messages. Users can understand whether they need to check internet, login, or company selection.

How to use or check it:
- Go to Synchronization / Offline Sync.
- Check the warning message at the top of the page before syncing.
- If it says the offline company and cloud company do not match, logout from the offline system.
- Login again using the correct company user.
- After the correct company name appears on the screen, sync Products, Contacts, and Sales again.
- If the warning still appears, ask the admin to check the cloud connection details for this workstation.

---

## Version 8.90.6 - 2026-06-29

### Sales and Purchases - View Details

What users can do now:
- Sale Details now shows the customer Contact ID. When users open a sale invoice, the Contact ID appears above the customer name.
- Purchase Details now shows the supplier Contact ID. When users open a purchase, the Contact ID appears above the supplier details.
- Customer and supplier checking is easier. Staff can quickly confirm the correct contact before reviewing products, payments, or totals.

How to use or check it:
- Go to Sales > List Sales.
- Open the View option for any sale invoice.
- Check the customer section. The Contact ID is shown above the customer name.
- Go to Purchases.
- Open the View option for any purchase.
- Check the supplier section. The Contact ID is shown above the supplier details.

---

### Products - Product Stock History

What users can do now:
- Product stock history now shows a loading bar while opening. Users can see that the page is working when a product has many stock records.
- Large stock histories open more smoothly. This helps users wait with confidence instead of seeing an empty area during loading.
- The stock history screen keeps the same layout after loading. Users can review the same stock summary, location tabs, filters, and history table as before.

How to use or check it:
- Go to Products and open Product Stock History for the required product.
- If the history takes a little time, wait for the loading bar to finish.
- After loading, check the stock summary, location tabs, and history table as usual.
- Use the type filter if you want to view only purchases, sales, transfers, or other stock movements.

---

### Backup - Transaction Backup

What users can do now:
- Transactions can now be exported by date range. Users can choose a start and end date from the Transaction Backup page and export only the transactions from that period.
- The export uses the Local Transaction Export Path. Users can check or enter the local folder path on the same page before exporting.
- The export works on localhost and with the {application_name} Desktop App. On live/cloud, users can keep the desktop app open so the export files are saved on their computer.
- Users can see a clear export message. After export, the page shows how many transactions were exported or prepared for the desktop app.

How to use or check it:
- Go to Backup > Transaction Backup.
- Check the Local Transaction Export Path.
- Go to the Export Transactions With Date Range section at the bottom.
- Select the date range you want to export.
- Click Export Transactions.
- On localhost, check the selected local export folder.
- On live/cloud, keep the {application_name} Desktop App open and check the same local export folder on your computer.

---

### Superadmin - Hard Reset Options

What users can do now:
- Accounting reset options are now separated. Superadmin can reset accounting mappings without resetting accounting vouchers and bank records.
- Reset Accounting Mapping is available as its own option. Use this when you only want to clear mappings from Accounting > Transactions.
- Reset Accounting Transactions is available as its own option. Use this when you want to clear Journal Voucher, Transfer Voucher, Cheque Book, and Bank Reconciliation records.
- This makes accounting reset safer and easier to choose. Superadmin can now select only the accounting reset area that is needed.

How to use or check it:
- Go to Superadmin > All Businesses.
- Open the required business.
- Open Hard Reset Options.
- In Transactions Hard Delete, choose Reset Accounting Mapping if you only want to reset mappings from Accounting > Transactions.
- Choose Reset Accounting Transactions if you want to reset Journal Voucher, Transfer Voucher, Cheque Book, and Bank Reconciliation records.
- Select any other reset options needed, then confirm the reset.

---

### Accounting - Transactions

What users can do now:
- Transaction tabs now show totals at the bottom of the list. Users can quickly check the total amount for each tab without adding the rows manually.
- Sales now show Total Amount and Total Paid at the bottom. This makes it easier to review the sale value and received amount in one place.
- Payment tabs now show the total payment amount. Users can check the total for sales payments, purchase payments, expense payments, contact payments, and other payment tabs from the bottom row.
- Purchase, purchase return, and expense tabs now show amount totals and due totals. Users can quickly see the grand total and pending amount for the selected list.
- Stock adjustment now shows total amount and recovered amount. Users can compare both values directly from the bottom of the tab.
- Opening balance, opening stock, advance deposit, payroll, payroll advance, production, and reverse production tabs now show their amount totals.
- Totals change with the selected list. When users apply filters, choose a date range, or search in the table, the bottom totals update for the visible results.
- Payroll transactions can now be mapped from the Payroll tab using the default payroll accounts selected in Accounting Settings.
- Payroll Remap Defaults is now available. Users can filter payroll records first, then remap only the matching payroll transactions.
- Payroll list filters are easier to use. Users can filter payroll by location, payment status, mapping status, and date range.
- Payroll Payments now use the selected payment method account when mapping. This keeps cash, bank, card, and other payroll payments linked to the correct account.
- Payroll Payments can also be remapped from the Payroll Payments tab. Users can filter the list first, then click Remap Defaults for the matching payments.

How to use or check it:
- Go to Accounting > Transactions.
- Open the tab you want to review, such as Sales, Purchases, Expenses, Payments, Opening Stock, or Payroll.
- Use the date range, filters, or search box if you want to narrow the list.
- Check the bottom row of the table to see the total amount for that tab.
- For tabs with more than one amount column, check each total shown at the bottom of its column.
- For Payroll mapping, first select the Payroll Credit and Payroll Debit accounts in Accounting Settings.
- Then go to Accounting > Transactions > Payroll, apply the needed filters, and click Remap Defaults.
- For Payroll Payments, make sure each payment method has the correct Default Account in the business location payment options.
- Then go to Accounting > Transactions > Payroll Payments, apply the needed filters, and click Remap Defaults.

---

### Reports - General Reports

What users can do now:
- New "Contact's Opening Balance Report" added under Reports > General Reports. Users can now see contacts who have an opening balance saved from the contact add or edit screen.
- Contacts without an opening balance are not shown in this report. This keeps the list focused only on contacts where an opening balance was entered.
- Opening balance details are easier to check in one place. The report shows the contact, contact type, business location, opening balance date, debit or credit type, opening balance amount, amount paid, remaining due amount, and added by user.
- Opening balance amount columns are easier to read. The currency symbol now appears in the column heading, and the amount values show as clean numbers.
- Opening balance amounts line up neatly. Opening Balance, Amount Paid, and Opening Balance Due values are aligned to the right so users can compare them more easily.
- The report can be filtered and printed. Users can filter by location, contact type, contact, opening balance type, and date range, then print the report in A4 format.
- Users can also export the report. From the print preview, users can save the report as PDF or export it to Excel.
- New "Contact's Advance Deposit Report" added under Reports > General Reports. Users can now check advance deposits for customers and suppliers in one place.
- Advance deposit details are easier to review. The report shows the contact, contact type, business location, date, reference number, debit or credit type, payment method, payment status, deposit amount, adjusted amount, balance, and added by user.
- Users can quickly find open or completed advance deposits. The report can be filtered by location, contact type, contact, advance deposit type, payment status, and date range.
- The advance deposit report can be printed or exported. Users can print the report in A4 format, save it as PDF, or export it to Excel.

How to use or check it:
- Go to Reports > General Reports > Contact's Opening Balance Report.
- Use the filters at the top if you want to check a specific location, contact, date range, or opening balance type.
- Check the Opening Balance, Amount Paid, and Opening Balance Due columns to review the balance.
- Read the currency from the column heading, then compare the right-aligned amount values.
- Click Print A4 to open the print preview.
- From the print preview, print the report, save it as PDF, or export it to Excel.
- Go to Reports > General Reports > Contact's Advance Deposit Report.
- Use the filters at the top if you want to check a specific location, contact, date range, advance deposit type, or payment status.
- Check the Deposit Amount, Adjusted Amount, and Advance Deposit Balance columns to review the deposit.
- Use the Payment Status filter if you want to see only due, partial, paid, or overpaid advance deposits.
- Click Print A4 to open the print preview.
- From the print preview, print the report, save it as PDF, or export it to Excel.

---

### Reports - Opening Stock Report

What users can do now:
- Products with 0 opening quantity are no longer shown in the Opening Stock Report. This keeps the report focused only on products where opening stock was actually entered.
- Opening stock totals are easier to review. The total quantity, quantity left, and subtotal now match the products shown in the report.
- Opening stock numbers line up neatly. Quantity, Quantity Left, Unit Price, and Subtotal values are aligned to the right so users can compare rows and totals more easily.
- Print and export copies follow the same list. Products with 0 opening quantity stay hidden when users print or export the report.

How to use or check it:
- Go to Reports > Stock Reports > Opening Stock Report.
- Use the date, location, category, brand, or product filters if needed.
- Check the report list. Products with 0 opening quantity will not appear.
- Compare Quantity, Quantity Left, Unit Price, and Subtotal values from the right side of each column.
- Use Print A4 if you want to print, save as PDF, or export the same clean report.

---

### User Management - Merchant List

What users can do now:
- The Users page now has a separate "All Merchants" section. Merchants are no longer mixed with regular users or employees.
- The Superadmin business detail page also shows "All Merchants". Superadmin can open a business and view that business's merchants in their own section.
- All Users, All Employees, and All Merchants are now easier to check separately. This helps users find the right person list faster.

How to use or check it:
- Go to Users.
- Check the three sections: All Users, All Employees, and All Merchants.
- Use All Merchants to view merchant logins separately.
- For Superadmin, go to Superadmin > All Businesses.
- Open the required business and check All Merchants on the business detail page.

---

### Sales - Classic Receipt Print

What users can do now:
- Sale and quotation print copies now show a clearer right-side border. The product table border looks even from left to right.
- The total amount box now looks neater on print and PDF copies. Its right-side border now matches the rest of the box.

How to use or check it:
- Go to Sales and open a sale or quotation that uses the Classic print layout.
- Print the copy or save it as PDF.
- Check the product table and total amount box.
- The right-side border should now look clear and even.

---

### Contacts - Ledger Discount View

What users can do now:
- Deleted ledger discounts now show a success message. When users delete a Ledger Discount, Ledger Discount 2, or Ledger Discount 3 from the contact ledger view popup, the system confirms the deletion.
- The discount view popup now closes properly after delete. Users no longer need to refresh the page to see that the discount was removed.
- New Ledger Discount 3 entries now appear in the view popup. After adding Ledger Discount 3, users can open the view popup and see the saved entry.
- Ledger Discount and Ledger Discount 2 entries also show correctly in their view popups. Saved discount records are no longer hidden from users.

How to use or check it:
- Go to Contacts and open the customer or supplier ledger.
- Click View Ledger Discount, View Ledger Discount 2, or View Ledger Discount 3.
- Check the saved discount entries in the popup.
- To remove an entry, click the Delete icon and confirm.
- After deletion, check the success message and updated ledger balance.

---

### Contacts - Ledger Print

What users can do now:
- Ledger print copies now show number values on the right side in all ledger formats. Amounts, quantities, debit, credit, balance, ageing amounts, and cheque clearing amounts are easier to compare.
- Product detail numbers inside the ledger print are also easier to read. Quantities, prices, discounts, tax, and subtotals now line up neatly.
- Printed ledgers look more consistent across different formats. Users can switch formats and still read number columns in the same clear way.

How to use or check it:
- Go to Contacts and open the required customer or supplier.
- Open the Ledger tab.
- Choose the ledger format you want to print.
- Open the print copy.
- Check the amount and quantity columns. The numbers should now appear on the right side.

---

### Expenses - Draft and Final Status

What users can do now:
- Expenses can now be saved as Draft or Final. Users can save an expense as Draft when it is not ready yet, or Final when it is complete.
- Final is selected automatically when adding a new expense. Users can keep Final or change it to Draft before saving.
- Expense status is shown near the top on Add Expense and Edit Expense. Users can choose the status without scrolling to the payment area.
- Draft expenses do not show payment entry. This helps users save incomplete expenses without adding payment details.
- The Expenses list now shows the expense status. Users can quickly see which expenses are Draft and which are Final.
- Expense status can be changed from the Expenses list when no payment has been entered. Users can open the status popup and move an expense between Draft and Final when allowed.
- Expense status is protected after payment is entered or paid. Once an expense has a payment, the status cannot be changed.
- Admins can choose who may change expense status. A user can be allowed to edit expenses without being allowed to change Draft or Final status.
- Payments are only added for Final expenses. The Add Payment option appears when the expense is Final and still has an unpaid amount.
- Changing status from the Expenses list now stays smooth. The page no longer gets stuck on processing after a status change.
- Expense payment access can now be controlled from Roles. Admins can choose who may add, edit, or delete expense payments.

How to use or check it:
- Go to Expenses > Add Expense.
- Check Expense Status near the top of the form.
- Keep Final if the expense is complete and payment can be added.
- Select Draft if the expense is not ready for payment yet.
- When Draft is selected, the payment section will stay hidden.
- To update an existing expense, open Edit and check the Expense Status near the top.
- Go to Expenses to view the saved expense status in the list.
- Click the status label to update the expense status when no payment has been entered.
- If payment has already been entered or paid, keep the current status. The system will not allow the status to be changed.
- After changing an expense to Final, add payment if payment is due.
- To allow a role to change expense status, go to Roles, open the Expense tab, and tick Update Status for that role.
- To allow a role to manage expense payments, go to Roles, open the Expense tab, and tick Add Expense Payment, Edit Expense Payment, or Delete Expense Payment as needed.

---

### Projects - Project Expenses Tab

What users can do now:
- Projects now have an Expenses tab. Users can open a project and see expenses linked to that project in one place.
- Project expenses can be filtered by project step. Users can choose a step to see only expenses for that step.
- Add Expense from a project now fills the project automatically. When users add an expense from the project page, the expense is linked to that project.
- Add Expense from a selected step now fills that step automatically. Users can select a project step first, then click Add Expense to create an expense for that step.
- Project expense entry opens as Draft by default. This helps users review the expense before making it final or adding payment.
- Project expenses can now be added in a popup. Users can add an expense without leaving the project page.
- The popup shows Status, Project, and Project Step. Users can confirm or update these details before saving.
- The project expense list updates after saving. Users can see the new expense in the Expenses tab.

How to use or check it:
- Go to Projects and open the required project.
- Open the Expenses tab.
- Use the Project Step dropdown if you want to view or add expenses for one step only.
- Click Add Expense to create a new expense for the project.
- The Add Expense popup will open on the same page.
- Check that Expense Status is Draft by default.
- Check that the Project and Project Step are correct.
- Save the expense and check the Expenses tab list.

---

### Superadmin - Business Reset

What users can do now:
- Reset All Transactions now completes more smoothly from the business reset screen. Superadmin users can reset transaction data without getting a general error when Truckmate activity is included.
- Truckmate-related transaction records are handled during the reset. This helps Superadmin clear business transaction activity from one place.

How to use or check it:
- Go to Superadmin > All Businesses.
- Open the required business.
- Open Hard Reset Options.
- In Transactions Hard Delete, select the reset options needed.
- Click Reset Data and confirm the action.
- After reset, check that the success message appears.

---

### Products - Combo Products

What users can do now:
- Combo product edit page now shows the ingredients and pricing section properly. Users can open an existing combo product and review its ingredient list, quantities, units, total cost, profit percentage, and selling price.
- Users can copy ingredients from another combo product while creating or editing a combo product. This saves time when two combo items use a similar recipe.
- Old combo products are easier to edit. If one old ingredient is no longer available, users can still open the combo product and update the remaining ingredients.

How to use or check it:
- Go to Products > List Products.
- Open Edit for a combo product.
- Scroll to the Product Type area.
- Check the ingredients and pricing section below Product Type.
- To copy ingredients, select a product from Copy ingredients from combo.
- Confirm the message if you want to replace the current ingredients.
- Review the loaded ingredients, quantities, units, and selling price.
- Click Update to save the combo product.

---

### Reports - Product Purchase Report

What users can do now:
- Bottom totals now work on more purchase report tabs. Users can see correct totals on By Category, By Sub-Category, By Sub2 Category, By Brand, By Gender, and By Procurement Source.
- Search works smoothly on these tabs. Users can type in the search box without the report getting stuck on processing.
- Sub2 Category is now available as its own tab. Users can check purchase details by the second level of sub-category.
- Amount columns are easier to read. The currency symbol appears in the column heading, and the values appear as clean numbers.
- Number values are right aligned. This makes quantities, prices, subtotals, and totals easier to compare.

How to use or check it:
- Go to Reports > Product Purchase Report.
- Select the filters you need, such as date range, category, brand, gender, or procurement source.
- Open By Category, By Sub-Category, By Sub2 Category, By Brand, By Gender, or By Procurement Source.
- Use the Search box to quickly find matching records.
- Check the total row at the bottom of the tab.
- Read amount columns by checking the currency symbol in the heading and the number value in the row.

---

### Reports - Product Sale Report

What users can do now:
- The Detailed tab now matches the other report tabs. Users can use Show entries, Search, export buttons, Print, and Column visibility on the Detailed tab.
- The buttons and search area on the Detailed tab are easier to use. They appear in the same style and position as the other Product Sale Report tabs.
- Amount columns are easier to read across the Product Sale Report. The currency symbol appears in the column heading, and the values appear as clean numbers.
- Number values are right aligned. This makes quantities, prices, discounts, tax, totals, costs, profit, and profit percentage easier to compare.
- Print and export headings are clearer. Amount columns show the currency in the heading instead of repeating it inside every value.

How to use or check it:
- Go to Reports > Product Sale Report.
- Select the filters you need, such as date range, customer, supplier, category, brand, gender, or procurement source.
- Open the Detailed tab.
- Use Show entries to choose how many rows appear on the screen.
- Use Search to quickly find matching sales records.
- Use the export, print, and column visibility buttons when needed.
- Check amount columns by reading the currency symbol in the heading and the number value in the row.

---

### Reports - Payment Reports

What users can do now:
- Purchase Payment Report now has a Supplier Summary tab. Users can see supplier-wise payment totals and the number of payment entries for each supplier.
- Sell Payment Report now has a Customer Summary tab. Users can see customer-wise payment totals and the number of payment entries for each customer.
- Customer Summary includes customers and barterers. This helps users check normal customer payments and barter customer payments in one place.
- All payment report tabs now have Show entries and Search. Users can choose how many rows to show and search inside Summary, Supplier Summary, Customer Summary, and Detail tabs.
- Payment report tables are easier to use on smaller screens. Wide tables fit better and can be scrolled when needed.
- New summary tabs can be printed in A4 format. Users can print Supplier Summary or Customer Summary with the selected filters.

How to use or check it:
- Go to Reports > Purchase Payment Report.
- Use the filters if needed, such as date range, supplier, payment method, payment location, or transaction location.
- Open Supplier Summary to see supplier-wise payment totals.
- Go to Reports > Sell Payment Report.
- Use the filters if needed, such as date range, customer, customer group, payment method, payment location, or transaction location.
- Open Customer Summary to see customer-wise payment totals, including barterers.
- Use Show entries to choose how many rows appear on the screen.
- Use Search to quickly find a supplier, customer, payment type, or amount.
- Click Print A4 on any tab when a print copy is needed.

---

### Manufacturing - Demand Ingredient Report Print

What users can do now:
- Demand Ingredient Report print copy is easier to read. Wide report sections now fit better on the print page.
- Product-wise, category-wise, ingredient summary, and batch ingredient sections are cleaner in print. Users can check long ingredient lists without the columns becoming too squeezed.
- Totals remain visible at the bottom of each printed section. This helps users review quantities and costs after printing.

How to use or check it:
- Go to Manufacturing > Reports > Demand Ingredient Report.
- Select the filters needed for the report.
- Open the print view.
- Check each section before printing or saving as PDF.
- Use the printed copy to review ingredient quantities, costs, and totals.

---

### Backup - Create Backup

What users can do now:
- Create Backup works normally on live sites when no special backup path is needed. Admins can leave the backup path empty if their hosting already supports backup creation.
- The Backup page no longer shows an error page just because the backup path is left empty. This makes the normal backup flow smoother for admins.

How to use or check it:
- Go to Backup.
- Click Create Backup.
- Wait for the backup process to finish.
- Download or keep the backup file as needed.
- If backup still does not start, ask hosting support to check the backup setup for the site.

---

### Lists and Reports - Amount Columns

What users can do now:
- Amount columns are easier to read across lists and reports. Currency symbols are now shown in the column headings, and the amount values are shown as clean numbers.
- Number values are right aligned. This makes it easier to compare amounts, dues, totals, payments, tax, stock values, and other money columns.
- Footer totals are clearer. Total rows now follow the same style as the table values, so users can read totals without repeated currency symbols.
- All related tabs follow the same display style. Reports with multiple tabs now show amount columns in the same clear format on every tab.

Pages covered:
- Accounting Payment Account Report.
- Accounting Cash Flow.
- Accounting Accounts list.
- Profit and Loss Report, all tabs.
- Tax Report.
- Expense Report.
- Register Report.
- Sales Representative Report, all tabs.
- POS sales list.
- Sales Drafts.
- Sales list.
- Sales Quotations.
- Purchase Orders.
- Purchases list.
- Purchase Returns list.
- Stock Adjustments list.
- Stock Transfers list.
- Expenses list.

How to use or check it:
- Open any of the pages listed above.
- Check the amount or value columns.
- The currency symbol appears in the column heading.
- The values inside the column appear as numbers only.
- Amounts and totals are aligned to the right for easier reading and comparison.

---

### Contacts - Stock Quantity Report Tab

What users can do now:
- The Stock Quantity Report tab on a supplier contact now shows total values at the bottom. Users can quickly see totals for purchased quantity, sold quantity, transferred quantity, returned quantity, current stock, and total stock price.
- Totals change with the selected number of shown entries. If users choose to show 10, 25, 50, or more entries, the bottom totals update for the rows currently shown on the screen.
- The table is easier to read. SKU now appears first, Product appears after SKU, and Unit has its own separate column.
- Quantity values are cleaner. Unit names are no longer repeated inside quantity values because the Unit column already shows the unit.
- Stock price is easier to compare. The currency symbol is shown in the column heading, and the values are shown as numbers only.
- Number columns are right aligned. This makes quantities and stock price values easier to compare row by row.

How to use or check it:
- Go to Contacts and open a supplier.
- Open the Stock Quantity Report tab.
- Use Business Location if you want to view one location or all locations.
- Use the Show entries option to choose how many rows appear on the screen.
- Check the total row at the bottom.
- The totals will match the rows currently shown on the screen.

---

### Live Site Update

What users can do now:
- Existing live sites open normally after new version files are uploaded. Admins can continue the normal update process without extra manual steps.
- The site no longer sends an already installed business to the first-time install page by mistake. This keeps the update process clear for existing users.
- Admins can log in and open the update page as usual. The regular I Understand, Update button flow remains the same.

How to use or check it:
- Upload the new version files to the live site.
- Open the live site in the browser.
- Log in with an admin account.
- Go to the update page.
- Click I Understand, Update to complete the update.

---

## Version 8.90.5 - 2026-06-27

### Expenses - Add and Edit Expense

What users can do now:
- Add Expense and Edit Expense pages now show only the normal Save or Update button in the footer. Extra Print A4 and Print A5 buttons are no longer shown on these pages.
- Expense entry stays simple for staff. Users can save a new expense or update an existing expense from the footer without extra print choices on the form.

How to use or check it:
- Go to Expenses > Add Expense.
- Enter the expense details and click Save from the footer.
- Open an existing expense if you need to change it.
- Click Update from the footer after making changes.
- Use the regular expense print option from the expense record or list when a print copy is needed.

---

### Expenses - Expense List Print

What users can do now:
- Expense List can now be printed in A4 format. Users can click Print A4 from the Expenses page and open a clean print preview.
- The print preview follows the selected filters. Date range, location, category, sub category, contact, payment status, added by, expense for, and job sheet filters are included when printing.
- Detailed and Summary views are available together. Users can check the full expense list and a category-wise summary in the same print preview.
- Users can print, save as PDF, or export to Excel from the preview.
- Expense refunds are shown clearly. Refund amounts are shown as negative values so totals are easier to understand.

How to use or check it:
- Go to Expenses.
- Select the filters you need.
- Click Print A4.
- Check the preview page.
- Use Print, PDF, or Export to Excel as needed.

---

### Project - Location

What users can do now:
- Each project now has a Location tab. Users can open a project and save its address details in one place.
- Project address fields are easier to manage. Address Line 1, Address Line 2, City, State, Country, Zip Code, and Map Address can be added or updated.
- Map search is available when the map is available. Users can search the map address and save the selected map location with the project.
- Users without edit access can still view the location details. Only users with project edit access can update the location.

How to use or check it:
- Go to Project and open a project.
- Open the Location tab.
- Enter the address details.
- Use the Map Address field to search the map location, if the map is available.
- Click Update to save the project location.

---

### Project - Email Notifications

What users can do now:
- Project leads can now receive email updates when a project is created or edited. This helps the lead person stay informed when project details are added or changed.
- Project leads can now receive email updates when a project task is created or edited. This helps the lead person follow task changes without checking the project screen again and again.
- Project email messages can be changed from Notify Templates. Users can update the subject and message wording for Project and Project Task emails.
- Project emails include useful details. The email can show project name, status, customer, location, dates, budget, members, task name, task status, priority, due date, and a link to open the project.
- Auto Send Email can be turned on or off. If Auto Send Email is selected, the email is sent automatically when the project or task is saved.

How to use or check it:
- Go to Settings > Notify Templates.
- Open the Project Notifications section.
- Open Project to edit the email used for project create and edit updates.
- Open Project Task to edit the email used for task create and edit updates.
- Keep Auto Send Email selected if the email should be sent automatically.
- Create or edit a project, or create or edit a project task.
- The project lead person will receive the email if their email address is saved in their user profile.

---

### Project - Settings

What users can do now:
- Hard Reset option has been removed from the Project screens. This keeps the Project area safer for daily users.
- Project settings are now simpler. Users will only see the normal Project options they need for regular work.
- Project reset is now handled by Superadmin from the business view page. This keeps reset work in one safer place for the system owner.

How to use or check it:
- Go to Project.
- Use the available menus such as Projects, Tasks, Stock, Reports, Categories, and Settings.
- The Hard Reset option will no longer appear in the Project menu or settings area.
- For reset work, Superadmin can go to Superadmin > Businesses, open the business, and use Hard Reset Options there.

---

### Installment - Settings

What users can do now:
- Hard Reset option has been removed from the Installment screens. This keeps the Installment area safer for daily users.
- Installment settings are now simpler. Users will only see the normal Installment options they need for regular work.
- Installment reset is now handled by Superadmin from the business view page. This keeps reset work in one safer place for the system owner.

How to use or check it:
- Go to Installment.
- Use the available menus such as Installments, Customers, Reports, and Settings.
- The Hard Reset option will no longer appear in the Installment menu or settings area.
- For reset work, Superadmin can go to Superadmin > Businesses, open the business, and use Hard Reset Options there.

---

### Installment - Installment Plans

What users can do now:
- Installment Plans now opens with a clearer page name. Users can open the plans page from the Installment menu without seeing the old System wording.
- The Installment Plans menu item is easier to understand. Staff can quickly find where installment plan names, number of installments, payment period, interest, and description are managed.

How to use or check it:
- Go to Installment > Installment Plans.
- Use Add to create a new installment plan.
- Use Edit if an existing installment plan needs changes.
- Use Delete only when the plan is no longer needed.

---

### Installment - Reports

What users can do now:
- Installment Reports and All Installments are now available on one Reports page. Users can switch between the two views using tabs.
- One Report Filters section is used for both tabs. Customer, installment status, date from, and date to filters now apply to both report views.
- The Reports page is easier to use. Users do not need to open separate pages to check installment details and customer-wise installment totals.
- Customer balance is shown from the shared filter area. When a customer is selected, users can quickly see the total money owed.

How to use or check it:
- Go to Installment > Reports.
- Select the customer, installment status, and date range you need.
- Open the Installment Reports tab to check individual installment details.
- Open the All Installments tab to check customer-wise installment totals.
- Change the filters once at the top, and both tabs will follow the same filter choices.

---

### Installment - A4 Printing

What users can do now:
- Installment Reports can now be printed in A4 format. Users can print the current tab or print all report tabs together.
- Customer Installments can now be printed in A4 format. Users can open a clean print preview for the customer installment list.
- Installment Sales can now be printed in A4 format. The print copy follows the selected filters such as location, customer, payment status, date range, staff, and shipping status.
- Installment Plans can now be printed in A4 format. Users can print the plan list, including plan name, number of installments, payment period, interest, interest type, and description.
- Print previews include useful actions. Users can print the A4 copy, save it as PDF, or export it to Excel from the preview page.
- Search and filters are kept when printing. The printed copy matches the list or report the user is viewing.

How to use or check it:
- Go to Installment.
- Open Reports, Customers, Sales, or Installment Plans.
- Select the filters or search text you need.
- Click Print A4 Current Tab to print the active view.
- Click Print A4 All Tabs when you want all available tabs together.
- On pages with only one list, both print buttons open the same current list.
- Use Print A4, PDF, or Export to Excel from the preview page.

---

### Accounting - Settings

What users can do now:
- Chart of Accounts Order now opens in the correct default order. New businesses will see the order as Asset, Liability, Equity, Income, Expenses when Accounting is used for the first time.
- First-time settings save keeps the correct order. If users save Accounting Settings without changing the order, the same default order is saved automatically.

How to use or check it:
- Go to Accounting > Settings.
- Check Chart of Accounts Order.
- The default order should be Asset, Liability, Equity, Income, Expenses.
- Save the settings as usual if no change is needed.

---

### Sales - Sale Return Details Popup

What is easier now:
- SKU is now shown in the sale return product list. When users open a sale return, each returned product now shows its SKU next to the product number.
- Returned products are easier to identify. Staff can quickly match the returned item with the correct product code before checking quantity and amount.

How to use or check it:
- Go to Sales > Sale Return.
- Open the View popup for any sale return.
- Check the product table.
- The SKU column appears after the # column for each returned product.

---

### Sales - Sale Details Popup

What works correctly now:
- Sale Details now shows the correct Total before discount. When an invoice has inline product discounts, the popup now shows the original total first, then the discount amount, and then the final receivable amount after discount.
- Discount checking is easier for staff. Users can now clearly see how much was discounted and confirm that the final invoice amount is correct.

How to use or check it:
- Go to Sales > List Sales.
- Open the Sale Details popup for an invoice that has inline discount.
- Check the Total, Inline Discount, and Total Receivable rows.
- The Total row shows the amount before discount, and Total Receivable shows the final amount after discount.

---

### Reports - Payment Recovery Report

What works correctly now:
- Summary total now shows the full correct amount. If the Cash amount is 759,070.53, the footer total now uses the full amount instead of showing only 759.
- Date Range now updates the Summary tab properly. When users select a range like Last 30 Days, the Summary rows and footer totals both follow the selected dates.
- Type names now follow the Payment Method names set for the business location. If payment methods are renamed from the business location settings, the Payment Recovery Report shows those same names.
- Amount columns are easier to read. The currency symbol is shown in the Amount heading, and the amount values are shown as clean numbers.
- Number and amount values are right aligned. This makes totals easier to compare in the Summary and Detail tabs.
- Print and export copies follow the same clear amount heading. Users see the currency symbol in the heading instead of inside each amount value.

How to use or check it:
- Go to Reports > Payment Recovery Report.
- Select the required Payment Location, Payment Method, Customer, Staff, or Date Range.
- Open the Summary tab.
- Check the Type names, No of Transactions, Amount, and footer Total.
- The Type names should match the Payment Method names saved in the selected business location.
- The footer Total should match the amounts shown for the selected date range.
- Open the Detail tab if you need to check the individual recovered payments.

---

### Roles & Permissions - Sale Return

What is easier now:
- Sale Return permissions are now easier to control. Admins can give separate access for sale returns made against an invoice and direct sale returns.
- Own and all access can be managed separately. A user can be allowed to see only their own sale returns, or all sale returns, for each sale return type.
- Sale Return now has its own permission section. In the Sales tab, Sale Return permissions appear under a separate Sale Return heading, similar to the Shipments section.
- Edit and Delete can now be controlled separately. Admins can allow a user to view sale returns without also allowing them to edit or delete them.
- Sale Return Payment permissions are now separate. Admins can separately allow users to add, edit, or delete sale return payments.
- Sale Return permissions are still available when the Sales module is turned off. If POS is enabled but Sales is disabled, the Sale Return permission section appears in the POS tab on the role screen.

How to use or check it:
- Go to Settings > Roles.
- Open Add Role or Edit Role.
- If the Sales module is enabled, open the Sales tab and find the Sale Return section.
- If the Sales module is disabled and POS is enabled, open the POS tab and find the Sale Return section there.
- Select the Sale Return access, edit, delete, and payment options needed for that role.
- Click Save or Update.

---

### Sales Report - Workstation Sales

What is easier now:
- Workstation sales now show the correct Added By name after syncing to cloud. If a sale is created by a cashier on Workstation 01, the Sales list keeps showing that same cashier name after the sale is synced.
- Station filtered sales are easier to trust. When users filter the Sales list by workstation, the Added By column now matches the user who actually made the sale.

How to use or check it:
- Go to Sales > List Sales.
- Use the Station or Workstation filter if needed.
- Check the Added By column.
- For synced workstation sales, this name should be the cashier who created the sale on the workstation.

---

### Reports - Stock Value Report

What is easier now:
- Stock used in manufacturing is now shown clearly in the Stock Value Report. When a product is used as an ingredient, the report now shows it separately as Ingredients (Out) instead of making the stock look like it reduced without a clear reason.
- Opening Stock is easier to understand. If stock was already used as an ingredient before the selected date, that usage is now included in the opening calculation so the opening quantity matches the real stock position.
- Current Stock is easier to check. Users can now compare Opening Stock, stock coming in, stock going out, and Ingredients (Out) to understand why the current stock is lower.
- Ingredient value is also shown. The report shows the value of ingredient stock used in manufacturing, so stock value totals are clearer.
- Print and Excel copies now include the same ingredient information. Users can download or print the report and still see why stock was reduced.

How to use or check it:
- Go to Reports > Stock Value Report.
- Select the required date, location, product, or SKU.
- Check the Opening Stock and Current Stock columns.
- If the Current Stock is lower than expected, check the Ingredients (Out) column.
- If Ingredients (Out) has a quantity, it means that stock was used in manufacturing.
- Use Print or Export to Excel if you need to share or keep the report.

---

### Reports - Stock Quantity and Stock Value Reports

What is easier now:
- Variation column is now hidden when no variations are saved. If the business has not added any variation template, the Stock Quantity Report and Stock Value Report will not show the Variation column.
- Reports are cleaner for simple products. Businesses that do not use sizes, colors, or other variations will now see fewer empty columns.
- Printed and exported reports follow the same rule. Print, PDF, and Excel copies also hide the Variation column when no variations are saved.

How to use or check it:
- Go to Products > Variations and check if any variation is saved.
- If no variation is saved, open Reports > Stock Quantity Report or Reports > Stock Value Report.
- The Variation column will not appear in the report.
- If you add a variation later, the Variation column will appear again where it is needed.
- Use Print, PDF, or Export to Excel as usual. The same column layout will be used.

---

## Version 8.90.4 - 2026-06-26

### Business Settings - Default Customer

What is easier now:
- Sales and POS default customers now follow their own settings. If the Sales tab default customer is left as Please Select, the Add Sale screen now opens with no customer selected.
- POS default customer is handled separately from Sales default customer. Changing the default customer for POS will not change the Add Sale screen customer, and changing the Sales default customer will not change the POS customer.
- Branch-wise default customer settings now work correctly. Each business location can keep its own Sales and POS default customer choice.

How to use or check it:
- Go to Business Settings > Location-based Settings.
- Select the business location you want to set.
- Open the Sale tab and choose the Default Customer for Add Sale.
- Open the POS tab and choose the Default Customer for POS.
- Choose Please Select if you want the cashier to select a customer manually.
- Save the settings, then open Add Sale or POS to check the customer field.

---

### Reports - Print, PDF, and Excel

What users can do now:
- Print options have been added to more reports. Users can open a clean report preview directly from the report screen.
- Reports can now be printed, saved as PDF, or exported to Excel from the preview page.
- Selected filters are followed in the preview. For example, if a user selects a location, category, supplier, product, date, or other filter, the printed report shows the same filtered result.
- Report buttons are easier to find. Print and export buttons are now placed near the top of the report area where they are needed.
- Wide reports are easier to read in print preview. Long tables are adjusted so columns fit better on the page.
- Report page navigation works better in the preview. Users can move between preview pages using the page buttons.
- Report captions now show proper names. Labels such as All Locations and Tab: Detail now appear clearly instead of showing missing language text.
- Sale Invoices Report detailed print preview now opens normally. Users can print the detailed invoice view without seeing an error page.
- Product Sell Report Not Sold tab now shows products correctly when matching data is available.
- Stock Value Report preview page buttons now work better for Categorized and Location Details views.
- Expense Report print preview now includes the chart and the table. Users can print the same chart view they see on the report screen.
- Trending Products print preview now includes the chart and product list. Users can print or export the same filtered trending products view.
- Activity Log is easier to read. The Note column now gets more space, and other columns stay compact and left aligned.

Reports covered:
- Profit / Loss Report: Summary and profit-by tabs.
- Purchase & Sale Report.
- Purchase Report: Supplier, reference, purchase date, payment date, payment method, and purchase totals.
- Purchase Invoices Report: Totals, Summary, and Detailed tabs.
- Purchases & Returns Report: Purchase and purchase return list with supplier, payment, date, and location filters.
- Product Purchase Report: Summary, Detailed, group-wise, and Not Purchased tabs with product, supplier, location, category, brand, gender, procurement, and date filters.
- Purchase Payment Report: Summary and Detail tabs with supplier, payment method, payment location, transaction location, and date filters.
- Purchase Analysis Report: Yearly, monthly, weekly, daily, day-of-week, and hourly views.
- Sale Report: Sales list with customer, payment, date, location, user, station, and related filters.
- Sale Invoices Report: Totals, Summary, Detailed, and Scheme detail tabs where available.
- Sales & Returns Report: Summary tab with sale and return filters.
- Product Sell Report: Summary, combo, detailed, grouped, category-wise, brand-wise, gender-wise, procurement-wise, and not-sold tabs.
- Sell Payment Report: Summary and Detail tabs.
- Payment Recovery Report: Summary and Detail tabs.
- Discounts Report: Summary and Detail tabs.
- Sales Analysis Report: Yearly, monthly, weekly, daily, day-of-week, and hourly views.
- Trending Products Report: Top trending products chart and product list.
- Tax Report: Tax Paid, Tax Collected, Expense Tax, and Project Invoice Tax where available.
- Expense Report: Chart and category-wise expense table.
- Activity Log Report.
- Account Book: Account ledger with date and transaction type filters.
- Cash Flow Report: Cash flow summary and payment ledger with location, account, date, and transaction type filters.
- Payment Account Report: Payment list with account, date, and linked account filters.
- Contact Detail Page: Ledger formats, purchases, stock, sales, payments, notes, rewards, and activity tabs.
- Customer & Supplier Report: Contact balances with location, type, contact, customer group, and date filters.
- Customer Group Report: Customer group sales totals with location, customer group, and date filters.
- Cheque Clearance Report: Pending and cleared cheque payments with contact, status, payment location, and date filters.
- Stock Quantity Report: Details, Categorized, and Locations.
- Stock Value Report: Details, Categorized, Locations, and Location Details.
- Stock Reorder Report.
- Stock Performance Report: Summary and Average Sold tabs.
- Opening Stock Report.
- Mismatch Report.
- Stock Expiry Report.
- Stock Adjustment Report.
- Stock Take Report.
- Stock Transfer Report.
- Items Report: Purchase, sale, supplier, customer, location, date, and manufacturing item filters.
- Combo Items Report.
- Product Status Report.
- Product Serial Report.
- Lot Report.

How to use or check it:
- Open the required report from the Reports menu.
- Select the filters you need, such as date, location, product, category, brand, supplier, or serial number.
- Open the report tab you want, if the report has tabs.
- Click Print at the top of the report area.
- Check the preview that opens in the new tab.
- Use Print, PDF, or Export to Excel from the preview page as needed.
- Use the page buttons in the preview when the report has more than one page.

---

### Reports - Product Serial Report

What is easier now:
- Product Serial Report now opens without getting stuck on Processing. The report should load normally, even when there are many sale and purchase serial number records.
- The All, Sell, and Purchase filters now work smoothly. Users can view all serial number activity together, or show only sales or only purchases.
- Purchase invoice links now open the correct purchase details. Sale rows open sale details, and purchase rows open purchase details.
- Discount percentage now shows safely even when the item price is 0. The report will not stop loading because of a zero-price item.

How to use or check it:
- Go to Reports > Product Serial Report.
- Use the filters for date, location, product, contact, supplier, type, or serial number.
- Wait for the report table to load.
- Click an invoice number to open the related sale or purchase details.

---

## Version 8.90.3 - 2026-06-25

### Reports - Stock Report

What users can do now:
- Stock Report can now be printed from the Details tab. The Print button opens a clean preview with the business logo, business name, location, report title, date and selected filters.
- Users can print, save as PDF, or export to Excel from the preview.
- The preview follows the filters selected on the Stock Report. Location, category, supplier, brand, product details, quantity options and price options stay the same in the printed or exported copy.
- Wide stock reports are easier to read. The preview is arranged for A4 landscape printing and includes clear page controls.
- Grand totals are included. The final page shows the overall total for the report.

How to use or check it:
- Go to Reports > Stock Report.
- Open the Details tab.
- Select the filters you need.
- Click Print.
- Use the preview buttons to print, save as PDF, export to Excel, zoom, or move between pages.

---

### CMS - Public Landing Page

What users can see now:
- The public homepage now has an Advanced Modules section. It shows useful add-on modules such as AI Assistance, Manufacturing, CRM, HRM, Project, Repair, Accounting, Warehouse, Online Store, Asset Management, Rental and Connector.
- The module cards slide automatically and work on desktop, tablet and mobile screens.

- Homepage wording is clearer and more professional. It explains the business benefits of POS, inventory, accounting, CRM, HR and AI tools in simple sales language.
- The homepage now presents the platform as one complete business system instead of only a basic POS.

- The homepage now uses the configured application name. The page feels branded for the installed business or product name.
- The landing page design is more modern. Sections, cards, buttons, testimonials, FAQs and call-to-action areas are easier to read and more polished.

How to use or check it:
- Open the public website homepage.
- Scroll to the Advanced Modules section to view available modules.
- Use the slider dots or wait for the cards to move automatically.
- Review the feature, industry, testimonial, FAQ and call-to-action sections for the updated content.

---

### Offline Sync

What is easier now:
- Local installations stay faster when the internet is off. POS and normal pages no longer keep waiting for the cloud server for a long time.
- Cashiers can keep using POS during internet problems. The system quickly detects that the cloud server is not reachable and lets local work continue.
- The Offline Sync page opens faster when there is no internet.
- Standalone local installs behave better with weak or missing internet. Users see fewer delays and fewer login or notification problems.
- The app works better in both browser and desktop app mode. Local pages, styles, redirects and printing behave more reliably.

How to use or check it:
- If the internet is off, continue using POS as normal on the local system.
- Open Offline Sync only when you want to check or start syncing.
- When internet comes back, use the sync options as usual.
- For desktop users, printing and workstation features should continue to work in the desktop app.

---

### Software Update Page

What is easier now:
- Software updates are easier for administrators. After clicking I Understand, Update, the system finishes the normal update work automatically.
- Admins no longer need to do extra steps after updating.
- The update page should finish faster and feel less stuck during normal updates.
- The system should run smoother after the update is completed.

How to use or check it:
- Go to the Software Update page.
- Read the update confirmation message.
- Click I Understand, Update.
- Wait until the update finishes and returns you to the login screen.
- Log in again and continue using the system.

---

## Version 8.89.12 - 2026-06-24

### Products - Import Products

What is easier now:
- Import Products now saves a selling price of 0 from Excel. If Update Existing Products is ticked and the SKU already exists, entering 0 in the Selling Price column will update the product selling price to 0.
- Blank Selling Price still works as before. If the Selling Price cell is left blank, the system will calculate the selling price from the purchase price and profit margin.

How to use or check it:
- Go to Products > Import Products.
- Choose your Excel file.
- Tick Update Existing Products.
- Enter 0 in the Selling Price column if the product price should become 0.
- Import the file and check the product to confirm the new selling price.

---

### Reports - Stock Value Report

What works correctly now:
- Opening Stock now shows the correct quantity when an As of Date is selected. The quantity now matches the Product Stock History for the same product and location.
- Manufactured products are now counted correctly in Opening Stock. If stock was made before the selected date, it is included in the opening quantity.
- Wrong negative Opening Stock quantities are now corrected. Products should no longer show an incorrect negative opening quantity when the history shows a positive balance.

How to use or check it:
- Go to Reports > Stock Value Report.
- Select the required As of Date.
- Search the product or SKU you want to check.
- Check the Opening Stock column for the selected location.
- If needed, open Product Stock History for the same product and location to confirm the quantity matches.

---

## Version 8.89.11 - 2026-06-23

### Software Update Page

What users can do now:
- A red UPDATE button now appears in the main software navbar when a new software update is available. Users can quickly see that the system needs to be updated.
- The UPDATE button opens the Software Update page. Users do not need to remember or type the update page link.
- The update can now be completed from the Software Update page. Users can click I Understand, Update and follow the on-screen update flow.
- After the update is completed once, the UPDATE button is hidden for everyone. Other businesses and users will no longer see the button after the system has already been updated.
- User roles continue working after the update. Cashier and other staff roles should keep their access without needing to edit and save the role again.

How to use or check it:
- When the red UPDATE button appears in the main navbar, click UPDATE.
- Read the warning on the Software Update page.
- Take a backup before continuing.
- Click I Understand, Update.
- Wait until the update is completed.
- After the update is completed, log in again if the software asks you to.
- Check that staff users can still open their normal screens, such as sales, purchases, products, and reports.

---

### Superadmin Menu Access

How to use or check it:
- The Superadmin menu is shown only to users who have Superadmin access.
- If the Superadmin menu is not visible, log in with the correct Superadmin user account.
- If the menu is still not visible, ask the system owner to check that your username is allowed for Superadmin access.

---

## Version 8.89.10 - 2026-06-22

### Superadmin - Registration Link

What is easier now:
- A Registration URL field has been added beside Allow Registration. Superadmin can now choose where the Register Now buttons should send new users.
- The normal registration page is still used by default. If no other link is entered, users will continue to go to the normal business registration page.
- Register Now buttons now follow the saved Registration URL. Login pages, website buttons, pricing package buttons, repair status pages, truckmate status pages, and scanner pages all use the same saved link.
- Package and language choices are carried forward when possible. If a user clicks register from a package card or changes language, the selected information is passed to the registration link.
- Opening the old registration page can also send users to the saved registration link. This helps keep all registrations going to the same place.

How to use or check it:
- Go to Superadmin > Settings.
- Open the Application Settings tab.
- Tick Allow Registration if new businesses should be allowed to register.
- In Registration URL, keep the default registration page or enter another link, such as `https://register.bitorepos.com/`.
- Click Update Settings.
- Now users who click Register Now will be sent to the saved registration link.

---

### Project - Reset Options

What users can do now:
- Hard Reset Options has been added to the Project module. Project managers can now open a separate reset page from the Project menu.
- Project transactions can be reset separately. This is useful when project activity needs to be cleared before starting fresh.
- Project data can be reset separately. This is useful when project setup records need to be removed after project activity has already been cleared.
- A warning and confirmation message is shown before reset. Users must confirm before selected project data is permanently removed.

How to use or check it:
- Go to Project > Hard Reset Options.
- Tick Reset Project Transactions if project transaction activity should be removed.
- Tick Reset Project if project records and setup should be removed.
- Click Reset Data.
- Read the warning carefully and confirm only if you are sure.

---

### Truckmate - Reset Options

What users can do now:
- Hard Reset Options has been added to the Truckmate module. Users can now open a reset page from the Truckmate menu.
- Truckmate transactions can be reset separately. This helps clear Truckmate job or transaction activity when a fresh start is needed.
- Truckmate setup data can be reset separately. This helps remove Truckmate records after the related activity has already been cleared.
- A warning and confirmation message is shown before reset. Users must confirm before selected Truckmate data is permanently removed.

How to use or check it:
- Go to Truckmate > Hard Reset Options.
- Tick Reset Truckmate Transactions if Truckmate transaction activity should be removed.
- Tick Reset Truckmate if Truckmate records and setup should be removed.
- Click Reset Data.
- Read the warning carefully and confirm only if you are sure.

---

### Installment - Reset Options

What users can do now:
- Hard Reset Options has been added to the Installment module. Users can now open a reset page from the Installment menu.
- Installment transactions can be reset separately. This helps clear installment payment activity when a fresh start is needed.
- Installment setup data can be reset separately. This helps remove installment settings and records after installment activity has already been cleared.
- A warning and confirmation message is shown before reset. Users must confirm before selected installment data is permanently removed.

How to use or check it:
- Go to Installment > Hard Reset Options.
- Tick Reset Installment Transactions if installment transaction activity should be removed.
- Tick Reset Installment if installment records and setup should be removed.
- Click Reset Data.
- Read the warning carefully and confirm only if you are sure.

---

### Warehouse - Reset Options

What users can do now:
- Hard Reset Options has been added to the Warehouse module. Users can now open a reset page from the Warehouse menu.
- Warehouse transactions can be reset separately. This helps clear warehouse transfer, movement, and stock activity when a fresh start is needed.
- Warehouse setup data can be reset separately. This helps remove warehouse records after warehouse activity has already been cleared.
- A warning and confirmation message is shown before reset. Users must confirm before selected warehouse data is permanently removed.

How to use or check it:
- Go to Warehouse > Hard Reset Options.
- Tick Reset Warehouse Transactions if warehouse transaction activity should be removed.
- Tick Reset Warehouse if warehouse records and setup should be removed.
- Click Reset Data.
- Read the warning carefully and confirm only if you are sure.

---

### Superadmin - Business Reset

What is easier now:
- More reset choices are now available from the Superadmin business reset screen. Superadmin can reset Truckmate, Installment, Warehouse, and Project data while managing a business.
- Each supported area has separate choices for transactions and setup data. Superadmin can clear only the part that is needed instead of resetting everything at once.

How to use or check it:
- Go to Superadmin > All Businesses.
- Open the required business.
- Find the reset options section.
- In Transactions Hard Delete, tick the required option such as Reset Truckmate Transactions, Reset Installment Transactions, Reset Warehouse Transactions, or Reset Project Transactions.
- In Data Entry Hard Delete, tick the required option such as Reset Truckmate, Reset Installment, Reset Warehouse, or Reset Project.
- Confirm the reset only after checking the selected business and selected options.

---

### Rental Management - Navigation

What is easier now:
- Rental Management now has a cleaner top menu. Users can move between Dashboard, Rental Items, Agreements, Returns, Payments, Calendar, Damage Reports, Maintenance, Reports, and Settings from one clear menu.
- The active Rental page is easier to identify. The Rental menu now highlights the current section more clearly.
- The Rental menu is easier to use on smaller screens. The menu can collapse neatly when there is less screen space.

How to use or check it:
- Go to Rental Management.
- Use the top menu to open the required rental area.
- Look for the highlighted menu item to know which page you are currently viewing.

---

### Rental Management - Page Access and Settings

What works correctly now:
- Rental pages now open normally. Settings, Maintenance, Calendar, Agreements, and Add Rental Item pages no longer show an error page.
- Rental Settings now saves properly. When users click Save, the page responds and the saved choices are kept.
- Reminder and overdue notice choices now save correctly. Users can turn these options on or off from Rental Settings.
- Default rental terms now save correctly. Users can save the standard terms they want to use for rental work.

What looks different:
- The Rental Settings Save button is now shown in the main software footer. This keeps the save button in the same place users see on other software screens.

How to use or check it:
- Go to Rental Management > Settings.
- Change the required rental settings.
- Click Save from the main software footer.
- Open Settings again if you want to confirm the saved choices are still selected.

---

### Rental Management - Agreements

What is easier now:
- Rental Agreements list now shows clearer information. Users can see agreement number, customer, location, rental period, total amount, balance due, status, and payment status in one table.
- Agreement filters are easier to use. Users can filter agreements by status, business location, date range, and payment status.
- Rental Calendar can now be filtered by location and status. This helps users view only the rental bookings they need to check.
- The Return and Print buttons on agreement details now open the correct screens. Users can process returns or print an agreement from the agreement detail page more smoothly.

How to use or check it:
- Go to Rental Management > Agreements.
- Use the Status, Business Location, Date Range, and Payment Status filters to narrow the list.
- Click an agreement number to open the agreement details.
- Use Process Return when rental items are coming back.
- Use Print when you need a printed copy of the agreement.
- Go to Rental Management > Calendar and use the Location or Status filters to check bookings on the calendar.

---

### Rental Management - Maintenance

What is easier now:
- Maintenance entries can now be added from the Maintenance page. Users with maintenance access can click Add and create a new maintenance record.
- Maintenance list filters are improved. Users can filter by maintenance type, status, and priority.
- Maintenance types are clearer. Users can choose Routine, Repair, Inspection, Cleaning, or Replacement.
- Priority choices are clearer. Users can choose Low, Normal, High, or Urgent.
- Maintenance can be assigned to a staff member. The Assigned To field now uses a staff list, making it easier to choose the right person.
- The Maintenance list now shows the assigned staff member by name. Users can quickly see who is responsible for each maintenance job.

How to use or check it:
- Go to Rental Management > Maintenance.
- Click Add to create a maintenance record.
- Select the rental item, maintenance type, priority, scheduled date, cost, and assigned staff member.
- Save the record.
- Use the Type, Status, and Priority filters to find maintenance records later.
- Use Edit to update an open maintenance record or Mark Completed when the work is done.

---

### Rental Management - Form Buttons

What looks different:
- Rental Item form buttons are now in the main software footer. Users can add or edit a rental item and click Save from the footer.
- Rental Agreement form buttons are now in the main software footer. Users can Save as Draft, Confirm Agreement, or Update from the footer when those actions are available.
- Rental Maintenance form buttons are now in the main software footer. Users can add or edit maintenance records and click Save from the footer.
- Agreement buttons still follow the agreement status. Draft agreements show draft and confirm choices, while confirmed agreements show the update choice.

How to use or check it:
- Go to Rental Management > Rental Items and add or edit an item.
- Click Save from the main software footer.
- Go to Rental Management > Agreements and add or edit an agreement.
- Use Save as Draft, Confirm Agreement, or Update from the main software footer, depending on what is shown.
- Go to Rental Management > Maintenance and add or edit a maintenance record.
- Click Save from the main software footer.

---

### Business Settings - Transaction Edit Days

What works correctly now:
- Transaction Edit Days now follows the value saved in Global Settings. If the business sets this to 399 days, users can edit allowed transactions within 399 days instead of being stopped after 30 days.
- The setting now applies business-wide across every location. Users do not need to update the same value separately for each branch.
- Purchase editing now follows the saved Transaction Edit Days value. Older purchases can be edited when they are still inside the allowed number of days.
- The same edit-day rule is also followed on sales, repairs, truckmate sales, and stock transfers. Users will see the same rule across these transaction screens.

How to use or check it:
- Go to Business Settings > Global Settings > Business.
- Enter the required number in Transaction Edit Days.
- Click Update Settings.
- Open the transaction you want to edit, such as a purchase, sale, repair, truckmate sale, or stock transfer.
- If the transaction date is within the saved number of days, the edit screen will open normally.
- If the transaction is older than the saved number of days, the system will show that editing is not allowed.

---

### Administer Backup

What is easier now:
- Old backup files are now removed automatically after 72 hours. This helps keep the backup list clean and avoids keeping very old backup files for too long.
- The backup list now shows Deletion Time. Users can see when each backup file is expected to be removed.
- Backup date and age are easier to understand. Users can check when the backup was created and how much time is left before it is deleted.

How to use or check it:
- Go to Administer Backup from the sidebar menu.
- Check the Deletion Time column to see when each backup file will be removed.
- Download any backup file before its deletion time if you need to keep a copy.
- Create a new backup when you need a fresh backup file.

---

### Security Roles - Administer Backup Access

What is easier now:
- Administer Backup now has its own role permission. Business owners can allow selected staff to open the Administer Backup page without giving them full admin access.
- The permission is available in Security Roles. This makes it easier to control who can see and use the backup page.
- Staff with this permission can see Administer Backup in the sidebar menu. Staff without permission will not see or open the page unless they already have allowed access.

How to use or check it:
- Go to Settings > Security Roles.
- Create a new role or edit an existing role.
- Open the Settings section.
- Tick Access administer backup.
- Save the role.
- Assign this role to the staff members who need Administer Backup access.

---

## Version 8.89.9 - 2026-06-21

### Reports - Stock Value Report

What is easier now:
- Export to Excel and Print buttons are now available on the Locations tab. Users can download or print the location-wise stock value summary directly from the report.
- A new Location Details tab has been added. Users can now see products grouped under each business location, making it easier to review stock value location by location.
- Each location section shows its own totals. Users can check opening stock, purchases, returns, sales, current stock, stock value, and other totals for one location before moving to the next location.
- Grand totals are shown at the bottom of Location Details. Users can still see the overall totals for all shown locations in one place.
- Location Details can also be exported to Excel or printed. Users can save or print the location-wise product detail report for checking, sharing, or record keeping.

How to use or check it:
- Go to Reports > Stock Value Report.
- Use the filters at the top to choose the required location, supplier, category, brand, unit, or stock options.
- Open the Locations tab to see the location-wise stock value summary.
- Click Export to Excel or Print on the Locations tab if you need a downloaded or printed copy.
- Open the Location Details tab to see each location with its own product list and section totals.
- Click Export to Excel or Print on the Location Details tab if you need the full location-wise product detail report.

---

### Product Stock History

What works correctly now:
- The Type filter now works correctly on Product Stock History. When users choose a type, the history table shows only matching entries.
- Manufacturing (In) now shows only manufactured product entries. Other transactions such as stock transfers and stock adjustments are no longer mixed into this view.
- Only completed production appears in Manufacturing (In). Planned or pending production will not appear in Product Stock History until it is completed.
- The selected location tab stays easier to follow while changing the Type filter. Users can check a location such as Production Depot without losing their place.

How to use or check it:
- Open Products and go to Product Stock History.
- Select the required product.
- Choose Manufacturing (In) from the Type filter to see completed manufactured entries.
- Click a production number to open its production details.
- Complete/finalize production when it should be added to stock.

---

### Offline Sync - User Settings

What works correctly now:
- User settings changed on live/cloud now work on the offline workstation after sync. The workstation follows the same settings as the live system for the synced user.
- The Recent Transactions Total setting now works correctly on the workstation. If this setting is turned off for a user, the Recent Transactions popup follows the same choice offline.
- User settings linked with locations, quick menus, selling price groups, and drug classes now stay matched after sync. This helps the workstation show the same choices and access as live/cloud.

How to use or check it:
- Go to Offline Sync.
- Click Sync All for the easiest update.
- If syncing one by one, sync Business Locations, Users, Drug Classes, Quick Menu, and Products.
- If the current logged-in user's settings were changed, log out and log in again after sync.
- Open POS or User Settings on the workstation to confirm the same settings are now applied.

---

### Offline Sync - Transaction Backup Settings

What is easier now:
- Transaction Backup settings can now be synced to the offline workstation. The workstation can receive the backup on/off setting and saved backup folders from live/cloud.
- A Sync Settings button is now available on the Transaction Backup page in offline mode. Users can update backup settings without entering them again by hand.
- Transaction Backup Settings is also available on the Offline Sync page. Users can sync it together with other workstation settings.

How to use or check it:
- Go to Offline Sync and click Sync for Transaction Backup Settings.
- Or go to Backup > Transaction Backup and click Sync Settings.
- After syncing, check that the backup option and folder fields are correct.
- Use Save Settings only if you need to change anything on the workstation.

---

### Offline Sync - Products

What works correctly now:
- Product prices changed on live/cloud now update correctly on the offline workstation. After Products sync, the workstation shows the latest selling price.
- Products sync is faster again for normal use. The workstation no longer spends extra time checking every product price when it is not needed.
- A deeper price check is still available when an old price needs to be checked again. This can be used only when required.

How to use or check it:
- Go to Offline Sync.
- Click Sync for Products.
- After sync, open the product or POS screen on the workstation and check the latest price.
- If a price still looks old, run Products sync again or ask support to run the deeper price check.

---

### Reports - Customer/Supplier Report

What is easier now:
- Ledger Discount column now uses the label set in Business Settings. If users rename Ledger Discount from the Merchants tab, the Customer/Supplier Report shows the same name.
- Ledger Discount 2 and Ledger Discount 3 columns are now available in the Customer/Supplier Report. These columns appear only when they are enabled from Business Settings.
- Ledger Discount 2 and Ledger Discount 3 use their own labels from Business Settings. This makes the report wording match the names used by the business.
- Total Due now considers all enabled ledger discount types. Users can see a more complete customer or supplier balance when Ledger Discount 2 or Ledger Discount 3 is used.

How to use or check it:
- Go to Business Settings > Merchants.
- Set the required labels for Ledger Discount, Ledger Discount 2, and Ledger Discount 3.
- Enable Ledger Discount 2 or Ledger Discount 3 if the business uses them.
- Go to Reports > Customer/Supplier Report.
- Check the discount columns and Total Due amount in the report.

---

### Contacts - Contact Payment

What works correctly now:
- Ledger Discount 2 and Ledger Discount 3 can now be adjusted in Contact Payment. Users can adjust these discount rows together with a purchase invoice from the Contact Payment screen.
- Saving Contact Payment with Ledger Discount 2 or Ledger Discount 3 no longer shows an error. Users can save the payment normally after entering the required Today Pay amounts.

How to use or check it:
- Open a supplier contact.
- Click Contact Payment.
- Select the purchase invoice and any Ledger Discount, Ledger Discount 2, or Ledger Discount 3 rows that need adjustment.
- Use Auto Apply or enter the Today Pay amounts manually.
- Click Save to record the payment.

---

### Contacts - Contact Ledger

What is easier now:
- Edit and Delete buttons are no longer shown inside Ledger Discount rows in the ledger. The ledger now looks cleaner and users will not see these action buttons directly inside the ledger line.
- Ledger Discount records can still be managed from the Ledger Discount list. Users can use the normal View Ledger Discounts option when they need to review or manage discount entries.

How to use or check it:
- Open a contact and view the ledger.
- Ledger Discount rows will show as ledger entries without inline Edit or Delete buttons.
- Use View Ledger Discounts when you need to open the discount list.

---

### Reports - Payment Recovery Report

What is easier now:
- Staff filter has been added to the Payment Recovery Report. Users can now view recovered payments for one selected staff member.
- The Summary and Detail tabs both follow the selected staff filter. This helps users check staff-wise payment recovery totals and payment details from the same report.

How to use or check it:
- Go to Reports > Payment Recovery Report.
- Use the Staff filter to select the required staff member.
- Check the Summary tab for staff-wise totals.
- Open the Detail tab to see the payment recovery entries for that staff member.
- Clear the Staff filter to view payment recovery for all staff again.

---

### Contacts - Advance Deposit

What is easier now:
- Advance Deposit now has separate View and Add buttons on the View Contact page. Users can open the deposit list or add a new advance deposit directly from the top button area.
- The View Advance Deposit button opens the previous advance deposits list. Users can check old advance deposits without opening the add form.
- The Add Advance Deposit button opens the new advance deposit form. Users can record a new advance deposit without first going through the list.

How to use or check it:
- Go to Contacts and open the required customer or supplier.
- On the View Contact page, look at the top-right button area.
- Click View Advance Deposit to check previous advance deposits.
- Click Add Advance Deposit to record a new advance deposit.

---

### POS - Recent Transactions

What is easier now:
- Recent Transaction Total is now shown at the bottom of the Transactions popup. Users can see the total near the footer buttons without looking inside the transaction list.
- The total stays visible while reviewing transactions. This makes it easier to check the total amount while scrolling through recent sales.
- The total changes with the selected tab. When users open another tab, the bottom total shows the amount for that tab.

How to use or check it:
- Go to the POS screen.
- Click Transactions to open the Recent Transactions popup.
- Check the Recent Transaction Total at the bottom of the popup.
- Open another tab, such as Credit Sale, Draft, or Return, to see that tab's total.

---

## Version 8.89.8 - 2026-06-20

### Stock Transfer - Manufacturing Option

What is easier now:
- Production (Manufacturing) is now shown only for businesses that have Manufacturing in their package. Businesses without Manufacturing will no longer see this option on the Add Stock Transfer or Edit Stock Transfer page.
- Stock Transfer pages are cleaner for non-manufacturing businesses. Users only see the options that apply to their package.

How to use or check it:
- Go to Stock Transfers > Add Stock Transfer.
- If your package includes Manufacturing, you can use Production (Manufacturing) to load production ingredients.
- If your package does not include Manufacturing, the Production (Manufacturing) option will not appear.

---

### Manufacturing - Production

What is easier now:
- Ingredient current stock is now shown while creating production. When users select a product recipe, each ingredient row shows the available stock for the selected business location.
- Extra ingredients also show current stock. If users add another ingredient manually, its available stock is shown under the ingredient name.
- Stock quantity follows the selected ingredient unit. If users change the ingredient unit, the shown stock quantity updates to match that unit.

How to use or check it:
- Go to Manufacturing > Production > Add.
- Select the Business Location and Product.
- Check the Current stock Quantity shown under each ingredient name.
- Use this stock quantity to confirm whether enough raw material is available before saving production.
- If you add another ingredient manually, check its stock quantity under the ingredient name before continuing.

---

### Reports - Stock Transfer Report

What users can do now:
- Products Summary tab has been added to the Stock Transfer Report. Users can now see product-wise stock transfer totals in one place.
- Users can check how many transfers included each product. The report also shows the total quantity transferred and the total value for each product.
- The Products Summary tab follows the selected filters. Date range, Location From, Location To, status, category, brand, gender, and procurement source filters update the product summary.

How to use or check it:
- Go to Reports > Stock Transfer Report.
- Use the filters at the top of the page to select the required date, locations, status, or product group.
- Open the Products Summary tab.
- Check each product's transfer count, total quantity, and total value.

---

## Version 8.89.7 - 2026-06-19

### Sales - Duplicate Invoice Numbers

What works correctly now:
- Fix Duplicates now corrects repeated sale invoice numbers without removing any sale. If different sales were given the same invoice number, the system can now give the extra sales new invoice numbers safely.
- Product sale details stay unchanged. Product quantities, sale amounts, payments, and customer records remain the same.
- The sales list refreshes after fixing duplicates. Users can immediately check that the duplicate invoice numbers are cleared.
- If there are no duplicate invoice numbers, the system shows a clear message. Users do not need to guess whether anything was changed.

How to use or check it:
- Go to Sales > List Sales.
- Tick Show Only Duplicates to view sales with repeated invoice numbers.
- Click Fix Duplicates.
- Wait for the success message.
- The list will refresh automatically.
- Tick Show Only Duplicates again if needed to confirm that no duplicate invoice numbers remain.

---

### Reports - Sale Invoices Report

What is easier now:
- Show Only Duplicates is now available in the Sale Invoices Report filters. Users can quickly view duplicate sale invoices from the report screen.
- The Detailed tab now has an Export to Excel button at the bottom. Users can download the detailed sale invoice report for checking, sharing, or record keeping.
- The Detailed Excel file now follows the same invoice layout shown on screen. Each invoice is shown first, with its product details and totals listed underneath.
- The Excel file follows the selected filters. Date, location, customer, payment, invoice range, city, state, country, and duplicate filter choices are included when exporting.
- The Excel file includes invoice and product details. Users can review invoice totals, paid amount, due amount, payment method, product quantity, price, discount, tax, cost, and profit information in one file.

How to use or check it:
- Go to Reports > Sale Invoices Report.
- Use the filters at the top of the page to select the required date, location, customer, product, payment method, or invoice range.
- Tick Show Only Duplicates if you want to see only duplicate sale invoices.
- Open the Detailed tab to view invoice-wise details.
- Click Export to Excel at the bottom of the Detailed tab to download the report.
- Open the downloaded Excel file to review or share the filtered sale invoice details in the same invoice-wise style.

---

### Lists - Created At Information

What is easier now:
- Created At information is now shown on the Purchases list. Users can see when each purchase entry was created.
- Created At information is now shown on the Expenses list. Users can see when each expense entry was created.
- Created At information is now shown on the Stock Adjustments list. Users can see when each stock adjustment was created.
- Created At information is now shown on the Stock Transfers list. Users can see when each stock transfer was created.
- Created At information is now shown on the Accounts list. Users can see when each account was created.

How to use or check it:
- Open the required list page, such as Purchases, Expenses, Stock Adjustments, Stock Transfers, or Accounts.
- Look at the last column named Created At.
- Use this column to check the actual date and time the record was entered in the system.
- The normal Date column still shows the transaction date selected by the user. Created At shows when the record was made.

---

### Contacts - Contact Payment

What works correctly now:
- Customer Contact Payment can now be saved when returning an advance deposit amount to the customer. Users can enter a negative amount for the advance deposit row and save the payment without seeing a date error.
- The Paid on date now works more smoothly in Contact Payment. The payment can be saved even when the date is shown in a different common date style.
- Cash Contact Payments no longer need a clearance date. Users paying by Cash can save normally without filling any extra date field.
- Save and Print now opens the Contact Payment receipt after saving. Users can save the payment and print the receipt in one flow.

How to use or check it:
- Go to Merchants > Customers.
- Find the customer and open Contact Payment from the Actions menu.
- Select the Location, Payment Method, Paid on date, and Amount.
- Enter the amount in Today Pay, or use Auto Apply where suitable.
- For Cash payment, no clearance date is needed.
- Click Save to record the payment, or Save and Print to record and print the receipt.

---

### Stock Adjustments - Excel Import

What works correctly now:
- Stock Take Excel import now accepts products with 0 counted quantity. If a product is counted as 0 during Stock Take, users can import it from Excel and continue the stock take normally.
- Stock Adjustment Excel import does not allow 0 quantity. If the selected type is Stock Adjustment, users must enter a quantity greater than 0 in the Excel sheet.

What is easier now:
- The import instructions now explain how to enter numeric SKUs in Excel. Users are told to set the SKU column type to Text and put an apostrophe before SKU numbers, for example '196382.

How to use or check it:
- Go to Stock Adjustments > Add.
- Select Stock Take if you are importing counted stock.
- Use SKU in column 1 and Counted quantity in column 2.
- For numeric SKUs, set the SKU column to Text and type an apostrophe before the number, for example '196382.
- A counted quantity of 0 is allowed for Stock Take.
- For Stock Adjustment, do not use 0 quantity in the Excel sheet.

---

### Stock Adjustments - Stock Take Save

What works correctly now:
- Stock Take can now be saved when the counted quantity is 0. If the product shows negative stock and the actual counted quantity is 0, users can save the stock take normally.
- Large negative stock quantities no longer stop Stock Take from saving. Users can correct products that show very low or negative stock without seeing an error page.
- After saving, users return to the Stock Adjustments list. This makes it easier to confirm the saved entry and continue work.
- Opening the Login page while already signed in no longer interrupts work. If the user is already signed in, the system takes them back to the page they were opening.

How to use or check it:
- Go to Stock Adjustments > Add.
- Select Stock Take.
- Load or search the product.
- Enter the actual counted quantity. Use 0 if no stock is found.
- Click Save.
- After saving, check the saved entry on the Stock Adjustments list.

---

### Transaction Numbers - Location Wise Numbering

What works correctly now:
- New transaction numbers now include the location code after the prefix. For example, numbers like SRP2026_0001, PR2026_0001, and CR2026_0001 will now be created with the branch code included after the prefix.
- Purchase Return numbers now follow the branch-wise format. Each location will get its own number series, using its location code such as 01, 02, or 03.
- Sell Return Payment numbers now follow the branch-wise format. This makes it easier to know which branch created the payment.
- Cash Register numbers now follow the branch-wise format. New cash register numbers will show the branch code after CR.
- Payment and voucher numbers now use the selected transaction location. This helps keep branch-wise records clear when receiving or making payments.
- Old cash register numbers received from offline or synced data are corrected when saved. If an old-style cash register number is received, the system will save it in the branch-wise format where possible.

How to use or check it:
- Go to Business Settings > Business Locations.
- Check that each location has a location code, such as 01, 02, or 03.
- When creating a transaction, select the correct business location.
- The new number will show the location code after the prefix.
- Example: if the prefix is PR and the location code is 03, the new number will start with PR03.
- Use the number to quickly identify which branch created the transaction, payment, or cash register.

---

### Stock Report - Reindex Stock Quantities

What works correctly now:
- Reindex Stock Quantities now updates stock history costs more reliably. When users reindex a product, Stock Adjustment and Stock Transfer history can now show the correct cost price and cost total.
- Stock Adjustment cost can now be picked from the product's earlier purchase. For example, if a product was purchased and later adjusted, reindex can use that purchase cost for the adjustment history.
- Stock Transfer cost is updated for both outgoing and incoming transfer history. This helps users see the same product cost clearly when stock is moved from one branch to another.
- Quantity Report reindex and Purchase action reindex now give more consistent results. Users should not need to reindex from Purchase again just to fix missing Stock Adjustment cost.

What is easier now:
- Reindex from Stock Quantity Report now checks all active locations for the product. This helps when a product was purchased in one location and transferred to another.
- Product Stock History now has a Reindex Stock Quantities button. Users can open Product Stock History and reindex the selected product directly from that page.
- Purchase edit page Re-Index Stock checkbox now refreshes related stock history after saving.
- Purchase list action menu Reindex Stock Quantities now refreshes related stock history.
- Opening Stock edit page Re-Index Stock checkbox now refreshes related stock history after saving.

How to use or check it:
- Go to Reports > Stock Report or Stock Quantity Report.
- Find the product and click Reindex Stock Quantities.
- Open Product Stock History to check the result.
- Cost Price and Cost Total should now appear for related Stock Adjustment and Stock Transfer rows when purchase cost is available.
- For transfer-out rows, New Quantity may show 0 if all stock was moved out from that location. This is normal.
- To check received stock, open the destination location tab in Product Stock History.
- If editing a purchase or opening stock, tick Re-Index Stock before saving when you want stock history to be refreshed.

---

### Project Management

What works correctly now:
- Project menu buttons now open the correct pages. Users can click Dashboard, Projects, Kanban Board, My Tasks, Stock, Project Reports, Project Category, and Settings without menu problems.
- The Project Stock tab now opens correctly when clicked. Users can open the Stock section from a project page and view the available stock options.
- Request Stock and Return Stock buttons now work from the Project Stock tab. Users can open the stock forms, enter details, save, or close the form normally.
- Project create and edit windows now close properly. The top close icon and footer Close button now work as expected.
- Dropdown fields in project forms now open correctly. Customer, Business Location, Status, Lead, Team Members, and Category lists can now be selected inside the project form.
- The project budget field now works properly in create and edit forms. Users can enter or update a project budget normally.
- The Task tab now opens without warning messages. Users can open project tasks from a project card or project page without an error popup.
- The Project Task page layout is now aligned better. Extra blank space on the right side has been reduced so the page is easier to use.
- Task create forms now close and open dropdowns correctly. Users can select priority, status, members, and close the form without refreshing the page.
- Time Log forms now close and open dropdowns correctly. Users can select task, user, date/time details, save, or close the form normally.
- Project card action menu now works. The three-dot menu on project cards now opens its options correctly.
- Project edit form now works correctly when opened from the Stock tab. Users can edit a project from Project > Stock and use all dropdowns and close buttons normally.

What is easier now:
- Project Dashboard has been improved for owners. The dashboard now gives a clearer view of projects, tasks, hours, team members, project status, task priority, recent projects, and upcoming tasks.
- Project pages now better match the OneDash style. The module has a cleaner layout and more consistent menu design.
- Project cards have a modern design. Cards now show project name, status, category, progress, lead, task count, and quick actions in a cleaner way.
- Project create and edit windows now keep the header and footer visible. If the form has many fields, users can scroll the form body while the title and Save/Close buttons stay easy to reach.
- Project work is now business-location based. Projects can be linked with a business location, helping businesses manage project work branch by branch.
- Project stock work is now location-aware. Stock requests, returns, and project stock records follow the selected project location.
- Project role permissions are now more complete. Business owners can give staff access only to the project features they need, such as dashboard, projects, tasks, time logs, documents, stock, reports, invoices, categories, and settings.

How to use or check it:
- Go to Project > Dashboard to view the improved project summary.
- Go to Project > Projects to view the modern project cards.
- Use the three-dot menu on a project card to open View, Edit, Task, Time Logs, Stock, and other options.
- Click New Project to create a project and select the correct Business Location.
- Open a project and click Stock to request stock, return stock, or view stock history.
- Open a project and click Task to create or manage project tasks.
- Open a project and click Time Logs to add work time for team members.
- Go to Settings > Security Roles and open the Project tab to control which project features each staff role can use.

---

### Installment Management

What works correctly now:
- Installment menu is now available on all Installment pages. Users can move between Dashboard, Installment Plans, Sale Invoices, Customer Installments, Reports, All Installments, and Settings without losing the module menu.
- Installment table action buttons now show correctly. Edit, Delete, View, Collection, Print, and other action buttons now appear as normal buttons instead of showing unreadable text.
- Missing action headings have been added. Action columns on Installment Plans, Customer Installments, Installment Customers, and related pages are now easier to understand.
- Sale Invoice payment status now shows correct wording. Missing or unclear payment status text has been cleaned up.
- Customer Installments now show all customers when no customer is selected. Users can leave the customer filter empty to see all installment customer records.
- Installment dates now show in a simple date format. Start dates, due dates, and payment dates are easier to read.
- Installment report rows now show status and action buttons correctly. Paid, Due, Late, Print, Collection, and Delete Collection are shown clearly.
- The Delete button is no longer shown for every installment row. Users cannot accidentally delete an installment schedule row from the report table.
- Buttons in the installment action column now have better spacing. Print, Collection, and Delete Collection buttons are easier to click.
- Sale invoices that already have an installment plan no longer show the Add Installment Plan option again. This helps avoid duplicate plans for the same invoice.
- Sale invoices with an attached installment plan are separated from normal due/credit sales. This keeps the regular Sales list cleaner.
- View Payment now handles installment plans correctly. When an invoice has an installment plan, users can edit or delete the full plan from the payment window.
- Edit Plan now opens the edit plan window directly. Users no longer land on the report page when editing a plan from View Payment.
- Add Payment is hidden when an invoice already has an installment plan. Collection should be done from the installment collection screen instead.
- Opening a payment receipt from View Payment now appears in front. The receipt popup no longer opens behind the payment window.
- Deleting an installment collection now updates both places. If a collection is deleted from View Payment or from the Installment report, the paid status and Delete Collection button are updated correctly.
- Installment collection amount is protected from manual editing. The Total Paid field in the collection window is now read-only.
- Account selection follows Business Settings. If Payment Accounts are turned off, the Account dropdown is hidden in the installment collection window.
- Payment Status on Installment Sale Invoices now shows the installment plan name. Users can quickly see which plan is attached to the invoice.
- The plan name in Payment Status no longer disturbs the page layout. It is shown as information only, so the sidebar and page design stay normal.

What is easier now:
- Installment Dashboard and module menu now follow the Project module style. The menu is easier to scan and use across the Installment module.
- Add and Edit Installment Plan windows are wider and easier to work with. They now give more room for plan details.
- Add Installment Plan window keeps its heading and buttons visible. If the form has many fields, users can scroll the middle area while the title and Save/Close buttons stay easy to reach.
- The Advance Payment option has been removed from Add Installment Plan. Users only see the fields needed for creating the installment plan.
- Installment Collection window is wider and easier to use. Users have more space when collecting an installment payment.
- Installment collection numbers now use a separate Installment Payment prefix. New installment collections use the prefix saved in Installment Settings, with IP as the default.
- Normal sale payment numbers stay separate from installment collection numbers. Sale payments continue to use their normal sale payment prefix, while installment collections use the installment payment prefix.
- Normal, partial, early settlement, and bulk installment collections all follow the same collection prefix setting.
- Older installment collection records keep their old numbers. Only new collections use the latest prefix saved in Installment Settings.
- Installment collection records remain visible in payment records. Users can still review installment collection payments from the payment history.
- Installment permissions are now more complete. Business owners can control access to each important part of the Installment module.
- Separate permissions are available for dashboard, reports, customer installments, installment customers, sale invoices, installment plans, printing, collections, partial payments, early settlement, and bulk payments.
- Installment menu items now appear based on staff permission. Staff only see the Installment pages they are allowed to use.
- Installment pages are better protected by role access. If a staff member does not have permission for a page or action, they will not be able to open or use it.

How to use or check it:
- To create an installment plan, go to Installment > Sale Invoices.
- Find the due or partial sale invoice and click Action > Sell Installment.
- Select the installment plan, check the amount and dates, then save.
- After a plan is added, the same invoice will show the plan name in the Payment Status column.
- Use Action > Plan to open the installment schedule for that invoice.
- To collect an installment, open Installment > All Installments or Installment > Installment Reports and click Collection.
- Check the due date, fine amount if any, and payment method, then click Add.
- To change the installment collection prefix, go to Installment > Settings and update Prefix for Collection.
- Use IP for installment payments if you want installment collection numbers to be separate from normal sale payments.
- To edit or delete a full installment plan, open View Payment for the invoice and use Edit Plan or Delete Plan.
- To control staff access, go to Settings > Security Roles, open the Installment tab, tick the allowed features, and save the role.

---

## Version 8.89.6 - 2026-06-17

### Products - Combo Products

What users can do now:
- Copy ingredients from another combo product while creating a combo. On the Add Product page, choose Combo as the Product Type and select an existing combo from Copy ingredients from combo.
- Copied combo ingredients are filled into the ingredient table automatically. Product names, quantities, units, purchase prices, total amounts, and selling price totals are loaded for review.

What is easier now:
- The combo ingredient area is easier to use. Search Product is shown on the left and Copy ingredients from combo is shown on the right, so users can either add ingredients one by one or load an existing combo recipe.

How to use or check it:
- Go to Products > Add Product.
- Select Combo in Product Type.
- Use Search Product to add ingredients manually, or select a product from Copy ingredients from combo to load an existing combo's ingredients.
- Review the loaded ingredients, quantities, prices, and total amount.
- Save the combo product when everything is correct.

---

## Version 8.89.5 - 2026-06-16

### Manufacturing - Productions and Stock Transfers Product Summary

What users can do now:
- New product summary report added in Manufacturing Reports. Users can now compare produced products and stock transferred products in one report.
- The report shows product-wise produced quantity, transferred quantity, and difference. This helps users quickly check how much was produced and how much was moved to other locations.
- Value comparison is also shown. Users can compare production value, transfer value, and the remaining difference.
- Useful filters are available. Users can filter by date range, location from, location to, stock transfer status, production final/draft status, and product category.

What is easier now:
- Manufacturing is now easier to open from the left sidebar. The Manufacturing menu now opens like the Accounting menu and shows its main pages inside the sidebar.
- The new report is available from Manufacturing > Reports. Users can open it from the top Manufacturing Reports dropdown and from the left Manufacturing sidebar menu.
- A separate role permission is available for the new report. Business owners can allow selected staff to view only this report without giving access to all Manufacturing reports.
- The Productions Report permission is also available in role settings. This makes Manufacturing report access clearer when creating or editing user roles.

How to use or check it:
- Go to Settings > Security Roles.
- Create a new role or edit an existing role.
- Open the Manufacturing tab.
- In the Reports section, tick View Productions & Stock Transfers Product Summary.
- Save the role and assign it to the required staff.
- Go to Manufacturing > Reports > Productions & Stock Transfers Product Summary.
- Select the required filters and review the product comparison.

---

## Version 8.89.4 - 2026-06-16

### Security Roles - Transaction Backup Access

What is easier now:
- Transaction Backup now has its own role permission. Business owners can allow selected staff to open the Transaction Backup page without giving them full admin access.
- The permission is available in the Settings tab when creating or editing a role. This makes it easier to control who can manage transaction backup settings.
- Users who have this permission will see the Transaction Backup option in the menu. Users without permission will not see or open this page.

How to use or check it:
- Go to Settings > Security Roles.
- Create a new role or edit an existing role.
- Open the Settings tab.
- Tick Access transaction backup.
- Save the role.
- Assign this role to the staff members who need Transaction Backup access.

---

## Version 8.89.1 - 2026-06-14

### Business Settings - Location Based Sales Settings

What works correctly now:
- Allow Sale if No Stock now works separately for each business location. Each branch can now have its own setting for allowing sales when stock is not available.
- Changing this option for one branch no longer affects other branches. For example, Branch A can allow sale without stock while Branch B can still block sale without stock.
- The selected branch now shows the correct saved setting. When users switch location in Business Settings, the Sales tab shows the option saved for that location.

How to use or check it:
- Go to Business Settings.
- In Location Based Settings, select the business location.
- Open the Sales tab.
- Tick Allow Sale if No Stock if that branch should allow sale without stock.
- Untick it if that branch should stop sale when stock is not available.
- Click Update Settings.

---

### Superadmin - Business List

What is easier now:
- Quick login button added for each business. Superadmin users can now log in to a business directly from the Business list.
- The button uses the first admin user of that business. This makes it faster to open a business account for checking settings, support, or daily work.
- The button is shown only when an admin login is available. If the business does not have an active admin user who can log in, the quick login button will not appear.

How to use or check it:
- Go to Superadmin > Business.
- Find the business you want to open.
- In the Action column, click Login as username.
- The system opens that business using its admin account.

---

### Login

What is easier now:
- Continue as option added on the Login page. If a user is already signed in and opens the Login page again, the system now shows a Continue as option with the current user's name/email.
- Users can quickly return to their account. Click Continue as to go back into the system without entering the username and password again.
- Users can still switch accounts. If someone wants to use a different account, they can sign out from the current account and log in with another username and password.

How to use or check it:
- Open the Login page while already signed in.
- Click Continue as to enter the system with the current account.
- Click the close/sign-out option beside the account if you want to use another account.

---

### POS / Sales - Product Search

What works correctly now:
- "Not for selling" products are now hidden from the F10 Product Search popup on sale screens. When cashiers open product search from POS, Add Sale, or Edit Sale, products marked as Not for selling will no longer appear in the list.
- Cashiers now see only products that can be sold. This helps avoid selecting internal-use, purchase-only, or blocked sale products by mistake.

How to use or check it:
- Open POS, Add Sale, or Edit Sale.
- Press F10 to open Product Search.
- Search or select products as usual.
- Products marked as Not for selling will not appear in this sale search list.

---

### POS - Cash Skim

What works correctly now:
- Cash Skim warning now waits for the selected warning interval after Cancel. If Cash Skim Warning Interval is set to 30 minutes, the warning will come back after 30 minutes instead of showing again after a few minutes.
- The warning still comes back if the register cash is over the limit. This helps cashiers delay the reminder for the correct time without missing the cash skim warning completely.

How to use or check it:
- Go to Business Settings > Payment.
- Set Cash Skim Warning Interval to the number of minutes you want.
- On the POS screen, when the Cash Skim warning appears, click Cancel if you want to delay it.
- The warning will show again after the selected time if the register cash is still over the limit.

---

### POS - Close Register

What works correctly now:
- Close Register now opens correctly after manager approval. When a cashier clicks Close Register from the POS side menu and enters the required username and password, the Close Register screen now opens normally.
- The POS screen no longer stays dim after approval. Cashiers can continue the close register process without needing to refresh the page.

How to use or check it:
- Open the POS screen.
- Open the POS Menu from the right side.
- Click Close Register.
- Enter the required username and password for approval.
- After approval, complete the Close Register form as usual.

---

### Superadmin - Registration Settings

What users can do now:
- New "Is email required" option added in Superadmin settings. This option is available under Superadmin > Settings > Application Settings.
- Email is optional by default. If "Is email required" is not ticked, the registration form works as before and users can register without email verification.
- Email verification starts only when "Is email required" is ticked. When this option is enabled, new users must enter an email address during registration.
- New users must verify their email before logging in. After registration, the user sees a Check Your Email page and receives a verification email.
- Resend verification email option added. If the email is not received, the user can request the verification email again from the Check Your Email page.
- Email verified confirmation page added. After clicking the verification link, the user sees a success message and can go to the Login page.
- This feature is for Superadmin setups only. If the Superadmin module is not installed, registration continues as normal.

How to use or check it:
- Go to Superadmin > Settings > Application Settings.
- Tick Is email required if you want new registrations to verify their email.
- Save the settings.
- When a new user registers, they must enter an email address.
- After registration, ask the user to open their email and click the verification link.
- Once the email is verified, the user can go to Login and sign in normally.
- Leave Is email required unticked if you do not want email verification during registration.

---

## Version 8.89.0 - 2026-06-11

### Fuel Station Management

What users can do now:
- New Fuel Station Management module. A complete petrol/diesel station operations module integrated into the existing system, respecting business, location, role and subscription rules.
- Fuel Tanks. Register underground or above-ground tanks with capacity, opening stock, minimum-stock alerts, graph colour and a linked inventory product, with live current-stock tracking and fill-percentage display.
- Dispensers and Nozzles. Maintain fuel dispensers (pumps) and their nozzles; each nozzle links to a tank and inherits its product, with meter (reading) tracking.
- Shift Management. Open a shift for an operator/dispenser with opening meter readings, then close it by entering closing readings, test quantities and collected cash/card/bank/credit amounts. The system auto-calculates litres sold, total sales, expected cash and cash short/excess, and supports supervisor approval.
- Credit / Fleet Sales capture. Credit amounts collected during a shift are recorded for credit-customer reporting.
- Tank Stock Calculation. Current stock is recalculated automatically from opening stock, refills, transfers, sales and approved adjustments.
- Tank Refills, Adjustments and Transfers. Record supplier refills (with weighted-average purchase price), tank-to-tank transfers, and stock adjustments (leakage, loss, gain, testing, evaporation, calibration) with an approval workflow.
- Dispenser setup options are available. Users can record dispenser connection details and test readings where supported.
- Dashboard. KPI cards (today's sales, litres, active shifts, pending approvals), tank-wise stock, low-stock alerts, cash short/excess, sales-trend and product-wise charts, dispenser-wise sales and integration status.
- Reports. Eleven reports: Daily Sales, Shift Closing, Nozzle Reading, Tank Stock, Tank Refill, Tank Adjustment, Dispenser Sales, Staff Sales, Credit Customer, Cash Short/Excess and Integration Log - each filterable by location and date range and print-friendly.

What is easier now:
- Granular permissions. Thirteen module permissions (view dashboard, manage tanks/dispensers/nozzles, open/close/approve shift, manage refill, manage/approve tank adjustment, manage tank transfer, manage integration, view reports) control access per role.
- Reuse of existing base modules. Inventory products, business locations, contacts (suppliers), users/roles and the reports framework are reused rather than duplicated.

What looks different:
- Bootstrap 5 interface with a dedicated Fuel Station sidebar dropdown and an in-module navigation bar gated by permissions.
- Charts continue working in offline setups. Users can still view the important dashboard and report charts when the local setup is being used.

---

## Version 8.88.12 - 2026-06-12

### Stock Adjustments - Stock Take Import

What works correctly now:
- Imported counted quantities now appear correctly in Stock Take. When users import an Excel file with SKU in the first column and Counted quantity in the second column, the Counted column on the stock adjustment screen now fills automatically.
- Zero counted quantity can now be imported. If the counted quantity is 0, it will still be accepted and shown correctly.
- The adjustment quantity now updates from the imported count. The system uses the imported Counted quantity and the current On Hand quantity to show the correct adjustment quantity.

How to use or check it:
- Go to Stock Adjustments > Add.
- Select Stock Take as the adjustment type.
- Click Import Product.
- Upload the Excel file with SKU in column 1 and Counted quantity in column 2.
- After import, check that the Counted column is filled with the quantity from the Excel file.

---

## Version 8.88.11 - 2026-06-12

### Manufacturing - Add Production

What is easier now:
- Current stock is now shown after selecting a product for production. When adding a production entry, users can see the selected product's available stock quantity directly under the Product field.
- The stock quantity changes with the selected product and business location. This helps users check the available quantity before continuing with production.

How to use or check it:
- Go to Manufacturing > Production > Add.
- Select the Business Location.
- Select the Product.
- Check the Current stock Quantity shown under the Product field.

---

## Version 8.88.10 - 2026-06-11

### Manufacturing - Productions Report

What works correctly now:
- Raw Materials Used now shows each material only once when All locations is selected. The same raw material will no longer appear as duplicate rows just because productions came from different business locations.
- Raw Materials Used totals now match the visible list. The ingredient count, quantity, waste, and cost totals are easier to check from the table.

How to use or check it:
- Go to Manufacturing > Productions Report.
- Select All locations in the Business Location filter.
- Open the Raw Materials Used tab.
- Generate the report to review each raw material once with the correct totals.

---

## Version 8.88.9 - 2026-06-10

### Manufacturing - Productions Report

What is easier now:
- Production Detail tab now opens normally. The tab no longer stays stuck on "Processing" when viewing production details.
- Product search in Production Detail now works properly. Users can search by product name and see the matching production records.

How to use or check it:
- Go to Manufacturing > Productions Report.
- Open the Production Detail tab.
- Use the filters or search box to find the required production records.

---

### Reports - Stock Transfer Report

What users can do now:
- Print button added to the Detailed tab. Users can now print the full detailed stock transfer report directly from the Detailed tab.
- Export to Excel button added to the Detailed tab. Users can now download the detailed stock transfer report as an Excel file.
- Product item details are included in the export. The Excel file includes the stock transfer details and the product lines under each transfer.

How to use or check it:
- Go to Reports > Stock Transfer Report.
- Open the Detailed tab.
- Apply the required filters, such as date range, location from, location to, or status.
- Click Print to print the detailed report.
- Click Export to Excel to download the detailed report.

---

## Version 8.88.8 - 2026-06-05

### Purchases - Classic Print Layout

What works correctly now:
- Classic purchase invoice printing no longer produces a blank extra page. The Classic, Classic 2, and Classic 6 purchase layouts previously forced the printable area to a full page height, which pushed a small overflow onto a second blank sheet. Printed output now flows to the natural content height and ends on the last used page.

How to use or check it:
- Open Purchases List, print any purchase using the Classic (or Classic 2 / Classic 6) layout. Confirm the print preview now shows a single page when the content fits.

---

### Contacts - Ledger Discount 2

What works correctly now:
- Ledger Discount 2 adjustment can now be saved when serial numbers are not enabled. The system no longer asks for serial numbers on products that do not need them.
- The serial number option is now hidden in Ledger Discount 2 adjustment when serial numbers are turned off.
- Edited Ledger Discount 2 amounts now update Accounting reports correctly. When quantity or adjustment amount is changed, Trial Balance now shows the updated discount amount.

How to use or check it:
- Add the product, enter quantity and adjustment amount, then save as usual. Serial numbers are only needed when serial numbers are enabled and required.

---

### Contact Payments

What is easier now:
- Ledger Discount 3 now works in Contact Payment the same way as the existing ledger discount. When paying supplier or customer dues, Ledger Discount 3 is now included in the payable amount, invoice adjustment list, auto apply, and saved payment details.
- Ledger Discount 3 rows are easier to identify in payment adjustment lists. They now show as LD3 in the payment table.
- Supplier payments now show the correct net effect in Accounting reports when Ledger Discount 2 or Ledger Discount 3 is included. For example, if a purchase is 1,000 and discounts reduce the payable amount to 993, Accounting now reduces the supplier payable and cash by 993 only.
- Ledger Discount 2 and Ledger Discount 3 payments now follow the same Trial Balance effect as the existing Ledger Discount.

How to use or check it:
- After adding Ledger Discount 3, open Contact Payment again to see the updated due amount and adjustment row.
- Use Auto Apply as usual; Ledger Discount 3 is now included with the other due adjustments.
- After saving a supplier payment, open Accounting > Reports > Trial Balance to check the updated Cash in Hand and Trade Creditors balances.

---

### Accounting - Settings

What is easier now:
- Map Transactions location tabs now stay selected correctly. When users click another business location, the selected tab now remains highlighted and the matching settings are shown.
- Default accounts now appear for every business location after creating a fresh Chart of Accounts. Locations that were showing "Select Credit Account" or "Select Debit Account" now show the expected default accounts such as Sales, Trade Debters (A/R), Cash in Hand, Stock Inventory, and Cost of Goods Sold - COGS.

How to use or check it:
- Go to Accounting > Settings > Map Transactions to review default accounts for each business location.
- Click each location tab and confirm the default accounts are selected before saving.

---

### Reports - Ledger Discount 3 Profit Accuracy

What is easier now:
- Product Sale Report now shows profit using the updated product cost after Ledger Discount 3. This applies across the Summary, Summary Combo, Detailed, Grouped, and all "By" tabs such as By Category, By Brand, By Location, and similar views.
- Stock Performance Report now shows cost, stock value, profit, and average cost using the updated product cost after Ledger Discount 3.
- Profit & Loss Report now uses the updated product cost after Ledger Discount 3 when showing gross profit, net profit, and Profit By tabs.
- Profit figures are now more consistent between Sale Invoices Detail, Product Sale Report, Stock Performance Report, and Profit & Loss Report.

How to use or check it:
- After entering Ledger Discount 3 for a purchase, open these reports again to see the updated profit figures.
- Use these reports when checking product profit, stock profit, and overall business profit after supplier cost discounts.

---

### Contacts - Ledger Ageing

What is easier now:
- Contact Ledger ageing now shows the correct due amount after Ledger Discount 3. The ageing boxes at the bottom now match the ledger balance when a supplier discount is entered.

How to use or check it:
- After adding Ledger Discount 3, reopen the contact ledger to check the updated ageing amount.

---

### Accounting Reports - Ledger Discount 3

What is easier now:
- Accounting Trial Balance now includes Ledger Discount 3. Supplier discounts now appear in accounting balances after the discount is entered.
- Accounting Balance Sheet now reflects Ledger Discount 3. Supplier balances and retained profit now stay aligned with the discount.
- Accounting Profit and Loss now reflects Ledger Discount 3. Product cost and profit now use the updated cost after the supplier discount.

How to use or check it:
- After entering Ledger Discount 3, open Accounting Reports again to see the updated Trial Balance, Balance Sheet, and Profit and Loss.
- If an older sale still shows old profit, refresh its accounting mapping and open the report again.

---

### Home Dashboard

What users can do now:
- Stock Transfer Between Locations chart added to the dashboard. Users can now see stock movement from one business location to another directly on the Home Dashboard.
- The stock transfer chart shows useful totals. It shows how many transfers were made, how many items were moved, and the total stock value transferred between locations.
- Recent Transactions now includes more activity. Manufacturing productions and stock transfers now appear in Recent Transactions along with sales and purchases.
- Dashboard summary cards are now clickable. Users can click the main dashboard cards to open the matching list or report.

How to use or check it:
- Click Total Sales to open the Sales list.
- Click Invoice Due to open the Sales list with due invoices.
- Click Total Sale Return to open the Sale Return list.
- Click Total Purchase to open the Purchase list.
- Click Purchase Due to open the Purchase list with due purchases.
- Click Total Purchase Return to open the Purchase Return list.
- Click Expense to open the Expense list.
- Click Suppliers Due to open supplier dues.
- Click Customer Due to open customer dues.
- Click Barterer Due to open barterer dues.
- Click Net to open the Profit / Loss report.
- When a dashboard date range or business location is selected, the opened list follows the same selection where available.

What is easier now:
- Stock transfer data is now easier to find on the dashboard. Recent transfers can still be reviewed even when the dashboard first opens on today's date.

---

### Sales Menu

What is easier now:
- Drafts List is now available under the Sales menu when POS is turned off. If POS is disabled from Settings > Business Settings > Global Settings > Modules, users can still open their saved draft sales from the Sales menu.
- Drafts List still follows user permission. Only users who are allowed to view drafts will see this option.
- When POS is turned on, Drafts List stays in the POS menu as before.

How to use or check it:
- To view saved drafts when POS is turned off, go to Sales > Drafts List.

---

### Products - Product Images

What users can do now:
- Multiple images can now be added to a Single product. On the Add Product and Edit Product pages, users can upload more than one gallery image for the same product.
- One image can be selected as the main product image. Users can keep a main featured image for the product and also keep extra gallery images.
- Gallery images are shown on the Product View popup. The main image is shown first, and the extra product images are shown below it as small previews.
- Existing gallery images can be made the main image. On the Edit Product page, click Make featured on a gallery image to use it as the product's main image.
- Newly selected gallery images can also be chosen as the main image before saving. When choosing multiple new images, select the image marked as Featured to make it the main product image.
- Gallery images can be removed one by one. Users can delete only the image they no longer need without removing the other product images.

What is easier now:
- The Product Edit page now clearly shows the current main product image. This makes it easier to compare the main image with the gallery images.
- Gallery image buttons are now neatly aligned. The delete button and Make featured button stay inside each image box.
- WooCommerce product image sync now includes product gallery images. When product image sync is enabled, the main product image and the extra gallery images are sent to WooCommerce.
- Existing product images remain safe. The old main product image feature continues to work as before.

---

## Version 8.88.7 - 2026-06-02

### Expense - Payment Section Visibility By Location

What looks different:
- The "Add Payment" section on the Add Expense page now shows or hides based on the selected Business Location's payment options. When every payment method is disabled for a location (Business Location > Edit > Payment Options > Enable column all unticked), the payment section is hidden. If at least one payment method is enabled, the section is shown.
- The payment section updates instantly when the Business Location is changed on the Add Expense page, without reloading, reflecting the newly selected location's payment settings.

What works correctly now:
- The payment section appears correctly on the Add Expense page. If the selected business location has at least one payment method enabled, the payment section is shown. If all payment methods are disabled, it stays hidden.

---

### Business Settings - Disable Ledger Discount Setting

What works correctly now:
- "Disable Ledger Discount" now saves correctly when unticked. If a user turns it off from Location Based Settings > Merchants and saves, it stays off the next time the page is opened.

How to use or check it:
- Go to Settings > Business Settings > Location Based Settings > Merchants.
- Untick Disable Ledger Discount.
- Click Save and reopen the page to confirm the setting stayed off.

---

## Version 8.88.6 - 2026-06-02

### Reports - Stock Transfer Report

What works correctly now:
- Business Location filter now correctly filters data in the Summary tab. Previously, selecting a Business Location in the report filters had no effect on the Summary tab - it always showed transfers from all locations. It now shows only the transfers that match the selected location.

What is easier now:
- Business Location filter now has an "All Locations" option. Previously, a location was required. You can now leave the location blank to view transfers across all business locations.
- Two separate location filters are now available: "Location From" and "Location To". You can filter stock transfers by where the stock was sent from, where it was sent to, or both at the same time. These filters apply across all three tabs - Totals, Summary, and Detailed.

---

## Version 8.88.5 - 2026-05-26

### Purchase - Create Purchase

What works correctly now:
- The Purchase Date calendar no longer closes on its own. Previously, when you clicked to open the date/time picker on the Create Purchase page, it would close automatically after a couple of seconds. It now stays open until you manually close it or pick a date.

---

### POS - Sale Screen

What users can do now:
- New "Show Total Profit" option added in User Settings. Go to User Settings > POS tab and tick Show Total Profit to enable this feature. It is turned off by default.
- Total Profit now shows live on the POS screen. When the option is turned on, the right-side POS menu displays a Total Profit value below the user name. This value updates automatically as products are added, quantities are changed, or prices are adjusted.

---

## Version 8.88.107 - 2026-06-01

### Business Settings - Dashboard

What users can do now:
- Dashboard sections can now be hidden from Business Settings. Go to Settings > Business Settings > Global Settings > Dashboard and tick the dashboard items you want to hide.
- All dashboard hide options are off by default. If no boxes are ticked, the dashboard will continue to show normally.
- Each dashboard option has its own clear label. Users can choose exactly what to hide, such as Quick Actions, Today at a Glance, Business Analytics, Sales Overview, Sales Charts, Reports, Payment Dues, Orders & Shipments, Stock Alerts, Currency Rate, and module widgets.
- Unticking an option shows that dashboard item again. This makes it easy to hide or restore dashboard sections whenever needed.

---

### Products - Product Images

What users can do now:
- Product images can now be assigned automatically by SKU. Save the image with the same name as the product SKU and the system will connect it to that product.
- Use .jpeg images for this feature. For example, if the product SKU is 0052, save the image as 0052.jpeg.
- Place the image in the product image folder for that business. Once the matching product is added or updated, the image will appear on the product automatically.
- Existing product images are kept safe. If a product already has its own image, it will not be replaced by mistake.

---

## Version 8.88.106 - 2026-06-01

### Sale Return

What is easier now:
- Sale Return now requires at least one returned item quantity. If all return quantities are zero, the return will not be saved and the user will be asked to add a return quantity.
- Sale Return activity history now shows payment actions more clearly. When a payment is added while saving a sale return, the activity will show "Payment Added" instead of "Payment Edited".

### POS - Sale Screen

What is easier now:
- POS actions are now available from a right-side menu. The menu stays closed by default and can be opened from the MENU tab on the right side of the screen.
- The right-side menu can also be opened by swiping left. This makes it easier to use on touch screens.
- The old POS top menu has been removed. Its actions now appear inside the right-side menu with icons and clear labels.
- The POS menu is shown in a simple vertical list. Common actions are easier to find, including Go Back, Open Cash Drawer, Sale Return, Add Expense, Open Cash Skim, Register Details, Close Register, Payment Receiving, Payment to Supplier, Add Production, Calculator, and Full Screen.
- Business location selection is cleaner. The location icon now appears beside the location dropdown, without an extra heading above it.
- User name and date/time now appear in one row. This keeps the menu header compact and easier to read.
- Quick Menu buttons inside the right-side menu now wrap to the next line. They no longer create horizontal scrolling when there are many buttons.
- The right-side menu is now slimmer. It takes less space on the POS screen.
- Quick Menu selection and Edit Menu option now stay in one row where possible. This keeps the menu controls easier to use.
- Keyboard Shortcut has been removed from the POS side menu. The menu now only shows the needed POS actions.
- Add Production now shows with its label in the POS side menu. Users can identify the action clearly.
- Quick Menu edit mode is clearer. Edit and delete icons now appear inside each assigned product button, so users can update or remove the correct button.

---

## Version 8.88.105 - 2026-05-31

### Dashboard - Total Sales Overview

What users can do now:
- New due cards added to the Total Sales Overview. Users can now see Suppliers Due, Customer Due, and Barterer Due directly on the dashboard.
- Due amounts include the complete contact balance. The shown amount includes all-time sales, purchases, returns, payments, ledger discounts, advance deposits, and opening balance.

What is easier now:
- Helpful tooltips added to the new due cards. Users can hover over the info icon to understand what is included in each due amount.
- Dashboard location filter also works with these due cards. When a location is selected, the due cards show values for that location.

---

### Reports - Stock Value Report

What works correctly now:
- Stock Value Report now opens without staying stuck on Processing. The report loads faster and shows the stock value list properly.
- A clear message is shown if the report cannot load. Users will no longer be left waiting without knowing what happened.

What is easier now:
- Report filters now work more completely. Users can filter the Stock Value Report by location, supplier, category, brand, gender, procurement source, unit, stock quantity options, and price type.
- The report works better from the normal browser link. Users can open the Stock Value Report as usual and the list will still load.

What users can do now:
- New Locations tab added to the Stock Value Report. Users can review stock value grouped by business location, including opening stock, purchases, returns, manufacturing, transfers, adjustments, sales, current stock, and totals.
- Grand totals are shown in the Locations tab. This helps users compare all locations in one place.

---

### Reports - Stock Quantity Report

What users can do now:
- New Locations tab added to the Stock Quantity Report. Users can review stock quantities grouped by business location.
- Each location shows product count, variation count, and quantity totals. Quantities are shown with their units so mixed stock units remain easy to read.
- Stock values are shown where allowed. Users with permission can also see purchase value, sale value, and possible profit by location.

---

### Contacts - Add Contact

What works correctly now:
- Shipping Address map search now works when adding a contact. Users can type an address, choose a suggestion, press Enter, or move out of the address box, and the map will move to the selected location.
- Address suggestions now show properly inside the Add Contact popup. This makes it easier to choose the correct address without closing the popup.

What is easier now:
- The contact map saves the selected position more reliably. This helps keep the contact's shipping location accurate.

---

### POS - Sale Screen

What is easier now:
- Staff/Agent selection is clearer on the sale screen. The dropdown now shows "Select Staff/Agent" so users know what to choose.

---

## Version 8.88.103 - 2026-05-27

### Offline Sync - Branch Settings

What works correctly now:
- Offline Sync now follows the correct branch settings. When a workstation is linked with a branch, sync options now match that branch instead of the general business settings.

How to use or check it:
- Go to Offline Sync.
- Run the required sync, or use Sync All.
- After syncing, check that the workstation follows the correct branch rules.

---

## Version 8.88.102 to 8.88.78 - 2026-05-26

### Branch-wise Settings Across Daily Work Screens

What works correctly now:
- Branch settings now appear correctly across daily screens. Users working in one branch will see that branch's rules, labels, receipt settings, payment options, product options, and stock rules.
- Restaurant, kitchen, and table screens now follow the selected branch. Kitchen order details, preparation warnings, and table choices now match the branch being used.
- Reports now follow the selected branch more reliably. Activity Log, Opening Stock, Product Purchase, Stock Transfer, Stock Consumption, Product Sell, Product Serial, Product Status, Lot, Sale Invoices, Profit/Loss, and commission reports now show branch-based options correctly.
- POS, Sales, Direct Sales, Sell Returns, and Sale Details now use the correct branch settings. Warranty, customer notes, quotations, sales orders, tax rows, discount rows, lot numbers, expiry, and receipt options now match the sale location.
- Purchases, Purchase Returns, Purchase Orders, and purchase print views now use the correct branch settings. Supplier search, product search, purchase status, tax columns, lot numbers, expiry, and purchase receipt labels now match the purchase location.
- Stock Transfers and Stock Adjustments now use the correct branch settings. Stock issue/receive labels, stock category options, lot numbers, expiry, overselling rules, and product row options now follow the selected location.
- Products screens now use the correct branch settings. Product list, add/edit product, quick edit, product view, product search, serial number details, product variations, and product stock history now show the right branch-based fields and labels.
- Contacts and ledgers now use the correct branch settings. Contact list, add/edit contact, contact profile, contact ledger, ledger PDF, due amount, ageing footer text, ledger discount, and contact payment screens now follow the branch being viewed or used.
- Payment screens now follow the correct branch. Cash denomination, cheque posting, payment headers, payment footers, contact deposits, supplier due payments, and payment print views now match the payment location.
- Receipts and printed documents now follow the transaction branch. Sale receipts, purchase receipts, expense vouchers, contact ledgers, and POS sale details now use the correct branch text, labels, and language settings.
- Cash Register screens now follow branch settings. Opening register, register details, and close register screens now show the correct cash and payment options for the branch.
- Other modules now follow branch settings where needed. CRM customer orders, customer display, warranty dropdowns, hotel bookings, payroll payment rows, repair screens, accounting ledger, Truckmate invoices, warehouse transfers, manufacturing production, gym subscriptions, and restaurant screens now use the correct branch choices.

How to use or check it:
- Set branch-specific options from Settings > Business Settings > Location-based Settings.
- Choose the correct Business Location before saving branch settings.
- When opening sales, purchases, payments, reports, receipts, or stock screens, select the correct location if the page has a location filter.
- If a staff member works from a branch, make sure their default location and register location are correct.
- Use the page normally. The system will now show the correct branch settings automatically.

---

## Version 8.88.77 to 8.88.13 - 2026-05-26

### Branch-wise Settings In Sales, Purchases, POS, Payments, Reports, and Stock

What is easier now:
- Branch-specific settings have been applied to more everyday workflows. This includes direct sales, sell returns, purchase entry, stock transfers, stock adjustments, product rows, lot and expiry controls, reward points, commission settings, receipts, payment rows, customer search, and stock mapping.
- POS receipts and customer-facing displays now use the correct branch details. Receipt text, language/font choices, FBR-related receipt information, and customer display settings now better match the active sales location.
- Sales and purchase forms now show branch-based fields more accurately. Tax, discount, warranty, lot number, expiry, commission, product expiry, and edit-window rules now follow the transaction location.
- Payments and cash handling now match branch rules. Payment rows, cash denomination, contact due payments, supplier due payments, and close register details now follow the branch setup.
- Reports and ledgers now respect branch choices. Contact ledgers, ledger PDFs, cheque posting, contact due calculations, product stock history, and purchase/sale reports now use the right branch settings.
- Stock and inventory actions are safer across branches. Stock transfers, stock adjustments, warehouse transfers, purchase returns, stock issue/receive, lot numbers, expiry, and product row options now follow the selected location.

How to use or check it:
- Use the Business Location filter when the screen provides one.
- For sales, purchases, returns, payments, and stock work, confirm the location before saving.
- For printed receipts or ledgers, re-open the document after selecting the right location if needed.
- Review Settings > Business Settings > Location-based Settings if any branch option looks different than expected.

---

## Version 8.88.12 - 2026-05-26

### Business Settings - Display Screen Images By Location

What is easier now:
- Each branch can now keep its own customer display images. This helps different shops show different screen images for customers.
- Saved image names are shown clearly. Users can check which image is already saved for each image slot.

How to use or check it:
- Go to Settings > Business Settings.
- Choose the required Business Location.
- Open Display Screen settings.
- Upload or update the carousel images for that branch.
- Save the settings.

---

## Version 8.88.11 - 2026-05-26

### Business Settings - Date Range Settings

What is easier now:
- Date Range settings are now placed with branch-based settings. This makes it clearer that each branch can have its own date range preference.

How to use or check it:
- Go to Settings > Business Settings.
- Choose the required Business Location.
- Open Date Range settings and save the required option.

---

## Version 8.88.10 - 2026-05-26

### Business Settings - Display Screen and Payment By Location

What is easier now:
- Display Screen settings can now be saved per branch. Each location can keep its own customer display options.
- Payment settings can now be saved per branch. Each location can keep its own payment-related text and options.

How to use or check it:
- Go to Settings > Business Settings.
- Choose the required Business Location.
- Open Display Screen or Payment settings.
- Enter the settings needed for that branch and save.

---

## Version 8.88.9 - 2026-05-26

### Business Settings - Display Screen and Payment Tabs

What looks different:
- Display Screen and Payment are now shown under Location-based Settings. These settings are related to each shop or branch, so they are easier to find with the other branch settings.
- The Location-based Settings tabs are now arranged in a clearer order: Tax, Product, Contact, Sale, POS, Display Screen, Payment, Purchase, and Reward Point.

How to use or check it:
- Go to Settings > Business Settings.
- Use the Location-based Settings section for branch-level setup.
- Use Global Settings only for options shared by the whole business.

---

## Version 8.88.8 - 2026-05-26

### Business Settings - Global and Location-based Sections

What looks different:
- Business Settings is now split into two clear sections. Global Settings are for the whole business. Location-based Settings are for individual branches.
- The Business Location dropdown is now inside the Location-based Settings section. This makes it clearer which settings change by branch.
- Tabs are grouped by purpose. This makes the settings page easier to understand and reduces accidental changes to the wrong branch.

How to use or check it:
- Go to Settings > Business Settings.
- Use Global Settings for business-wide options.
- Use Location-based Settings when a branch needs its own setup.
- Choose the branch before editing location-based settings.

---

## Version 8.88.7 - 2026-05-26

### Business Settings - More Branch-based Options

What users can do now:
- POS, Sale, Purchase, and Product settings can now be saved separately for each branch. This gives each location more control over its own daily workflow.
- Branch options now include many common sale, purchase, product, and POS choices. Examples include customer display, KOT printing, default customers, quotations, sales orders, payment links, default purchase status, product fields, serial/IMEI fields, tax options, discount options, and stock-related choices.

How to use or check it:
- Go to Settings > Business Settings.
- Choose the branch from Business Location.
- Open POS, Sale, Purchase, or Product settings.
- Update the branch settings and save.
- Repeat for other branches only when they need different rules.

---

## Version 8.88.6 - 2026-05-26

### Business Locations - Location ID Numbering

What works correctly now:
- New branch IDs no longer restart from BL0001. If your business already has BL0001, BL0002, and BL0003, the next branch will now correctly become BL0004.

How to use or check it:
- Go to Settings > Business Locations.
- Add a new business location.
- Check that the Location ID continues from the highest existing branch ID.

---

### Business Settings - Location-based Settings

What users can do now:
- Business Settings can now be saved separately for each branch. A Business Location dropdown lets users choose which branch they are setting up.
- Settings can be copied from one branch to another. This is useful when opening a new branch that should use the same setup as an existing branch.
- Single-location businesses do not see unnecessary branch controls. The page stays simple when there is only one location.

What works correctly now:
- Business Settings opens more safely for admin users. The page no longer shows an error in cases where no active business is selected.

How to use or check it:
- Go to Settings > Business Settings.
- Choose the Business Location you want to update.
- Change the settings for that branch.
- Click Save.
- Use Copy settings from another location when one branch should copy another branch's setup.

---

### Sales - Add Sale Product Search

What works correctly now:
- The F10 Product Search popup on Add Sale no longer gets stuck on Processing. Products load normally so users can continue the sale.

How to use or check it:
- Go to Sales > Add Sale.
- Press F10 or open Product Search.
- Search and select the product as normal.

---

### Stock Transfer - Load Ingredients From Production

What users can do now:
- Stock Transfer can now load ingredients from a Manufacturing Production. Users can select a production and fill the transfer with the ingredients used in that production.
- Load Ingredients from Demand Order is also available while editing a stock transfer. Users can update an existing transfer more easily.

How to use or check it:
- Go to Stock Transfers > Add or Edit Stock Transfer.
- Select Location From.
- Choose a Production from the Production (Manufacturing) dropdown.
- Click Load Ingredients.
- Review the loaded products and quantities before saving.

---
## Version 8.89.3 - 2026-05-22

### Reference Numbers - Existing Records

What works correctly now:
- Contact, Warehouse, Username and Subscription package codes no longer reset to 1 after updating. After updating, the next code continues from the previous number. For example, a business with 46 existing contacts will correctly start the next one at 47.
- Older number records are tidied up automatically during the update, so numbering stays clean.

What is easier now:
- All existing sales, purchases, payments, returns, transfers and other transaction numbers are kept exactly as they are. The new numbering only applies to new transactions created after the upgrade. Nothing in your historical records is rewritten or changed in any way.
- Old and new format transaction numbers will appear side-by-side in your ledger after the upgrade. This is normal - both formats are fully supported across receipts, reports and tax exports.

Important for users:
- Your old records are not changed. Sales, purchases, payments, ledgers, and account entries stay as they were.
- Keep the Contact Payment prefix the same for all branches unless your process needs separate prefixes. This keeps contact payment editing simple and consistent.

---

## Version 8.89.2 - 2026-05-22

### Reference Numbers - Per-Location Transaction Numbering

What users can do now:
- Transaction numbers are now generated per business location. New numbers include the prefix, location code, year, and running number. This works for purchases, returns, payments, stock transfers, stock adjustments, expenses, subscriptions, tokens, cash register entries, voucher prints, and more.
- Numbering restarts on January 1st each year for every location. Each branch gets its own fresh sequence at the start of the year.
- Each location can have its own prefix. If a location has its own prefix set on the Prefixes tab, that prefix is used; otherwise the business-wide prefix is used. This lets you keep one prefix scheme globally while overriding individual branches when needed.

What is easier now:
- Contact codes, Warehouse codes, Usernames and Subscription package codes stay on the existing global format. These are not branch-specific by design.
- The system picks the right location automatically based on the location you're working in. No screens or workflows need to change to benefit from the new numbering.

Important for users:
- Already-issued transaction numbers are untouched. Only new transactions use the new format.
- Each branch starts its own new sequence for each transaction type. Old and new number styles may appear together, and that is normal.

---

## Version 8.89.1 - 2026-05-22

### Business Location Settings - Per-Location Prefixes

What users can do now:
- Reference number prefixes are now set per business location. A new Prefixes tab has been added inside *Business Location Settings* (Settings > Business Locations > Settings on any location). Every prefix that used to live on the global *Business Settings > Prefixes* tab - Purchase, Purchase Order, Purchase Return, Sell Payment, Sell Return, Stock Transfer, Stock Adjustment, Expense, Contact, Token, Cash Register and all voucher labels - can now be set per location so each branch can have its own prefix scheme.

What is easier now:
- The global Prefixes tab has been removed from *Business Settings*.
- Each location keeps the prefixes that were previously saved at business level, so no prefix is lost.

Important for users:
- Prefixes can now be edited from each business location. Use this page to prepare or adjust branch prefixes.
- New transaction numbers fully follow branch-wise prefixes in the later numbering update.

### User Profile - Email Sending Settings

What users can do now:
- Email sending settings are now saved per user. Each staff member can set their own outgoing email details from My Profile > Email Settings. A Test email configuration button lets you send a test message before saving.

What is easier now:
- The Email Settings tab has been removed from *Business Settings*.
- Outgoing notification emails now use the logged-in user's own email settings instead of a single shared business setting.

Important for users:
- Each user should enter their own email settings from My Profile > Email Settings.
- For automatic emails, make sure the business owner account email settings are filled in correctly.

---

## Version 8.89.0 - 2026-05-22

### Sales - Layby (Lay-by-away)

What users can do now:
- Layby sale workflow added. Cashiers can now mark a sale as a Layby at the point of sale. A new Sub Status dropdown appears on the Add Sale screen - choose Layby to reserve stock for a customer who pays in instalments. When Layby is chosen, a new Layby Due Date field appears (auto-filled with today + the default number of days set in Sales settings) so the agreed final-payment date is captured up front.
- Stock is reserved while the customer pays. Selecting Layby behaves like a normal final sale for stock: the goods are deducted from available stock immediately so they cannot be sold to anyone else while the layby is active.
- Automatic stock release after the due date. If the customer has not paid the balance in full by the Layby Due Date, the system automatically releases the reserved items back into stock so they are available for sale again. The invoice itself stays in the system marked as Layby Released - the outstanding balance remains so any further payments / refunds can still be processed manually, and the customer history is fully preserved.
- Feature is opt-in per business. Layby is disabled by default. Enable it from Settings > Business Settings > Sales with the new toggle Enable Layby sales, and configure Default Layby Due Days (default 30) on the same screen.

What looks different:
- Sub Status dropdown shown next to Sale Status on the Add Sale screen, only when Layby is enabled in Sales settings and the form is not a draft / quotation. Selecting Layby reveals the Layby Due Date picker.

---

### POS - Quick Menu Buttons & Product Suggestion

What works correctly now:
- Quick menu product buttons now show the correct price for each business location. If a business location has a Default Selling Price Group set (configured under *Business Locations > Edit > Default Selling Price Group*), the price shown on each product button in the quick menu panel now comes from that location's price group - not the product's default selling price. Previously, every location always showed the default selling price on the buttons, regardless of which price group was assigned to that location.
- Product suggestion tiles also now show the correct location price. The same fix applies to the Show Product Suggestion POS layout - product tiles in the suggestion panel now display the price from the current location's price group when one is set, falling back to the default price only when no price group is configured for the location.

---

### User Management - Roles & Permissions

What users can do now:
- Control which business locations a staff member can see suppliers from. On the Role create and edit pages, inside the Contacts tab under the Supplier section, two new radio button options are now available: View all Locations supplier - the user can see suppliers from every business location; and View Locations own supplier - the user can only see suppliers linked to their own location. Select whichever option fits the role.
- Control which business locations a staff member can see customers from. In the same Contacts tab under the Customer section, two matching options are now available: View all Locations Customer - the user can see customers from every location; and View Locations own Customer - the user can only see customers belonging to their own location. Use this to prevent staff from one branch viewing another branch's customer list.

---

### Offline Sync - Download

What is easier now:
- Selling price groups are now downloaded as part of the Products Sync. When you press Sync Products on the Synchronization > Download tab, the system now also downloads all your Selling Price Groups (your named pricing tiers, e.g. "Wholesale", "VIP", "Retail") into the offline terminal. Previously, price group names could be missing after a fresh sync, which caused price-group dropdowns to appear empty on the POS.
- Group / tier prices on each product are now included in offline product updates. Every special price set per price group on a product (for example, a lower wholesale price or a VIP price) is downloaded with the product. After syncing, cashiers can choose any price group during a sale and the right price will appear without needing an internet connection.

---

## Version 8.88.0 - 2026-05-21

### Reports - Product Sale Report & Combo Items Report

What works correctly now:
- Product search now shows clean names in the filter bar. On both the Product Sale Report and Combo Items Report filters, product suggestions are now readable and no longer include extra symbols mixed into the product name.

---

### Products - Categories

What users can do now:
- "Not for selling" option added to product categories. A new Not for selling checkbox now appears on the Add Category and Edit Category pop-ups (under Products > Categories). It is unticked by default. When you tick it for a category, that category is hidden from the POS Sale screen - it will no longer show in the Product Suggestion category dropdown or as a tile on the Big Buttons touchscreen layout. The category continues to appear normally everywhere else, including the product list, reports, and purchase screens, so the products inside it stay categorised as before. This is useful for back-office-only categories (such as raw materials or internal-use items) that you do not want cashiers to see during a sale.

---

### POS - Big Buttons Touchscreen Layout

What users can do now:
- New "Big Buttons" POS screen layout. A fourth option has been added to *Settings > Business Settings > POS > POS Screen Interface*, alongside *Simple*, *Show Product Suggestion*, and *Enable Quick Buttons*. When you choose Big Buttons, the POS Sale screen turns into a full touchscreen till designed for 15-inch shop counter screens, with everything visible in one window - no page scrolling needed.
- Large category tiles for quick item lookup, automatically built from your product categories. Tap a category to load its products.
- Built-in numpad and quick-cash buttons - full 1-9 / 0 / 00 / CE pad with GBP 5, GBP 10, GBP 20, GBP 30, GBP 40, GBP 50, and GBP 100 quick-cash buttons.
- Helper buttons - Misc. Item, EXACT (auto-fills Tendered with the Total Payable), and Subtotal.
- Tendered and Last Change fields so cashiers can see the cash given and change due at a glance.
- Large action buttons - colour-coded PAY (cash), CARD, and Voucher buttons, sized for easy touch.
- Top header bar showing the cashier name, business location, HOME shortcut, a big search field, Clear button, customer selector, and a live clock.
- Footer utility bar with EXIT, Logout, Setup, Sales, Open Till, Payouts, Fullscreen, Lookup Item, and Show/Hide Keyboard shortcuts.
- Hold and Resume buttons for parking a sale and bringing it back later.

What is easier now:
- The Big Buttons screen keeps the normal POS features, including product search, taxes, discounts, customer group pricing, suspend / draft, multi-payment, offline sync, and printing.
- PAY opens the standard Multi-Pay finalize flow, CARD runs the express card payment flow, and Lookup Item opens the existing product search pop-up - so there is one consistent payment process across all interfaces.
- The other three layouts (Simple, Show Product Suggestion, Enable Quick Buttons) are unchanged. Big Buttons only activates when it is selected for a business location.

What looks different:
- High-contrast UK till colour scheme - navy header and footer, yellow search field, red PAY, blue CARD, and amber Payouts - for clear visibility under shop lighting.
- All buttons are sized for finger touch, with primary PAY and CARD buttons made extra large for accurate tapping.
- The full till fits in one screen so cashiers do not need to scroll. On tablets and phones, the layout switches to a single column so it remains usable.

---

### Products - Stock Maintenance

What users can do now:
- New "Stock Maintenance" button at the bottom of the Products list. Tick one or more products in the list, then click Stock Maintenance to apply a bulk action to all of them at once.
- Bulk Tax Assignment. Inside Stock Maintenance, choose Tax as the maintenance type, pick the tax rate from the dropdown, and click Apply - the selected tax is set on all chosen products in one step.
- Bulk Tax Removal. The same Tax dropdown also has a None (Remove Tax) option. Pick it and click Apply to remove the tax from all selected products in one go.

---

### Stock Transfer

What is easier now:
- Editing a stock transfer now updates stock at both locations correctly. When you save changes to a transfer, the system first cancels the previous stock movement at both the From and To locations, then re-applies the movement based on your updated products and quantities. Adding, removing, or changing the quantity of any item is reflected accurately at both ends - with no double-counting and no leftover stock.
- Destination cost is now worked out from the source location's real cost. The purchase price recorded at the destination is calculated automatically from the oldest stock at the source location (using FIFO), instead of using the price typed in the form. This keeps your cost-of-goods and profit reports accurate after a transfer. If the source has no purchase history, the system uses the price you entered as a fallback.
- Edits to completed transfers now keep cost history clean. The internal links between sold items and the source purchase lines they came from are properly rebuilt when you edit, so FIFO / LIFO / Average cost reports continue to match what was actually moved.

What works correctly now:
- Editing a stock transfer and adding or removing products now keeps the destination stock records clean.
- Changing the quantity on an in-transit transfer now moves the correct stock amount when the transfer is completed.
- The Stock Transfer Edit page now opens more cleanly when showing the added-by user list.

What looks different:
- On the Stock Transfer Edit page, the Stock Type, Category, and Load Products controls are no longer locked when a transfer is marked Completed - so you can revise them as part of an edit.

---

### Stock Transfer - List

What works correctly now:
- On the Stock Transfers list, the Update Status dropdown now opens clearly on top of the popup.
- The Edit button on the Stock Transfers list now also appears for transfers in the Completed status. Previously it was hidden for completed transfers, even though the Edit page itself supported editing them.

---

### User Management - Roles & Permissions

What users can do now:
- New "Edit Stock Transfer" permission added to the Stock Transfers tab on the Role create/edit page. You can now grant the ability to edit existing stock transfers separately from the "Add Stock Transfer" permission. Go to Roles > Edit a role > Stock Transfers tab and tick Edit Stock Transfer for the roles that need it.

What is easier now:
- The Edit button on the Stock Transfers list and the Edit Stock Transfer page now check the new dedicated permission. Existing roles that already had Add Stock Transfer continue to work as before, so nothing needs to be reconfigured.

---

### Manufacturing - Recipe

What works correctly now:
- Ingredient cost now shows correctly when a manufactured product is used inside another recipe. If a product has its own recipe (for example, "Sada Barfi" is itself manufactured), and you use that product as an ingredient inside another recipe, the Price column for that ingredient was showing Rs 0.00. It now correctly shows the cost calculated from its own recipe.

What looks different:
- Product SKU is now shown in brackets next to the product name on the Recipe edit page. For example, the heading now reads "Product: Yellow Cham Cham - Only Demand (1096)" - so you can confirm at a glance which product you are editing without going back to the recipe list.

---

### Manufacturing - Productions Report

What users can do now:
- Productions Report redesigned with three tabs. Instead of one long table, the report is now split into three focused views you can switch between with a single click:
  - Totals - a day-by-day summary showing how many productions ran, how many were finalised vs. draft, and the combined labour cost, overhead, and total value for each day.
  - Production Detail - one row per production, showing the batch number, status, priority, expected and actual quantities, yield efficiency, due date, and all cost figures.
  - Raw Materials Used - a breakdown of every ingredient used across the selected productions, with quantities, waste, net quantity, unit cost, and total cost.

What is easier now:
- Quantity columns now follow your Quantity Decimals setting. All quantity fields (Expected Qty, Actual Qty, Total Qty, Waste Qty, Net Qty) display the same number of decimal places set in Business Settings > Business > Quantity Decimals.
- Currency symbol shown only in the heading, not on every row. Cost columns (Labour Cost, Overhead Cost, Total Cost, Unit Cost) show clean numbers in each row; the currency symbol appears once in the heading - making reports easier to read.
- All number columns are right-aligned across the three tabs for cleaner reading.
- The date filter now defaults to Today when you first open the report.
- The Raw Materials tab has the same standard controls as other reports - choose how many rows to show, search or filter the list, and export to CSV, Excel, or PDF.

What looks different:
- Removed the Print button from the filter bar where it was incorrectly placed.

---

### Manufacturing - Production

What is easier now:
- Change a production's status straight from the Production list - no need to open the record. Each status badge (Planned, In Progress, Quality Check, On Hold, Cancelled) in the list is now clickable. Click it to open a small pop-up, choose the new status, and save in one click. The list refreshes automatically after saving. Productions that are already Completed cannot be changed from the list, and their badge stays non-clickable.

---

### Reports - Product Purchase Report

What users can do now:
- Two new tabs added: "By Sub-Category" and "By Sub2-Category". The Product Purchase Report now has two additional grouped views alongside the existing "By Category" tab.
  - By Sub-Category - purchases grouped by the second level of your categories. For each sub-category you can see the total quantity purchased and the total purchase value - useful for comparing spend at the sub-category level.
  - By Sub2-Category - the same view grouped by the third level, giving a more detailed breakdown if your business uses three category levels.
  These tabs appear automatically when Sub-Categories and Sub2-Categories are turned on in business settings. All filters in the report - date range, location, supplier, brand, category, and the sub-category dropdowns - apply to these tabs in the same way.

---

## Version 8.87.6 - 2026-05-18

### Reports - Report 607 (Sale)

What works correctly now:
- Footer totals on the Report 607 (Sale) page now reset correctly when a filter has no sales. If a date range or filter has no matching sales, the Total, Discount, and Tax amounts show 0 instead of keeping the previous totals.

---

## Version 8.87.6 - 2026-05-18

### Manufacturing - Dashboard

What users can do now:
- Manufacturing Dashboard has a completely new modern look. The dashboard has been redesigned with a clean, professional style. Key numbers such as Total Productions, Total Production Value, QC Pass Rate, and Overdue Productions are now displayed as large, colour-coded cards at the top of the page so you can see the most important information at a glance.

- Production Status chart added to the dashboard. A visual doughnut chart now shows how your productions are spread across all statuses - Planned, In Progress, Quality Check, Completed, On Hold, and Cancelled - so you can instantly see the overall picture without reading rows of numbers.

- Priority breakdown chart added to the dashboard. A horizontal bar chart now shows how many active productions are in each priority level (Urgent, High, Normal, Low), making it easy to spot if there are too many urgent or overdue items piling up.

- Quality Control summary now includes a pass-rate progress bar. The QC section now shows Passed, Failed, and Pending counts side by side with a colour-coded progress bar that visually indicates the overall pass rate percentage.

- "Added By" column added to the Production list. The Production list now shows who created each production record in the last column, so you can easily track which team member added each entry.

- "Added By" column added to the Demand Order list. The Demand Order list now shows who created each demand order in the last column, making it easier to follow up with the right person.

What is easier now:
- Business Location filter and Date Range filter on the dashboard now apply immediately. Previously, you had to click the Refresh button after selecting a location or date range for the data to update. Now, as soon as you pick a date range or choose a location, the dashboard automatically reloads and shows the filtered results - no extra button click needed.

- The selected Business Location is remembered after filtering. After filtering the dashboard by a specific location, the dropdown now stays set to that location when the page reloads, instead of resetting back to "All".

---

## Version 8.87.6 - 2026-05-17

### Manufacturing - Security & Permissions

What works correctly now:
- Manufacturing Reports were visible to users who had no report permission. Users such as cashiers who only had production or dashboard access could still see the full Reports section (Manufacturing Report, Recipe Report, Demand Order Report, Demand Ingredient Report) in the Manufacturing menu. The Reports section now only appears if at least one report permission - "Access Manufacturing Reports", "View Manufacturing Report", "View Recipe Report", "View Demand Order Report", or "View Demand Ingredient Report" - is specifically enabled in the user's security role.

- Demand Ingredient Report was accessible to any user with Demand Order access. A user who had the "Access Demand Orders" permission could open the Demand Ingredient Report even without the "View Demand Ingredient Report" permission. These two permissions are now fully independent. Opening the Demand Ingredient Report now requires either "View Demand Ingredient Report" or "Access Manufacturing Reports" to be enabled.

- Demand order status could be changed by users without the Approve permission. Cashier users could click the status badge on the Demand Order list and move a demand order to any status - including "Approved" - even though the "Approve Demand Order" permission was not enabled in their security role. Now, changing a demand order's status (to any value, including Approved, In Production, or Completed) requires the "Approve Demand Order" permission. The "Edit Demand Order" permission continues to cover editing the order's content - items, quantities, dates, and notes - but no longer controls status changes.

---

## Version 8.87.6 - 2026-05-17

### Manufacturing - Production

What is easier now:
- Production status now automatically changes to "Completed" when you tick Finalize. Previously, if you had manually set the production status to something other than "Completed" (for example "In Progress" or "Quality Check"), ticking the Finalize checkbox and saving would finalize the stock - but the status badge on the list would still show the old status. Now, whenever you tick Finalize and save (on both the Add Production and Edit Production pages), the production status is automatically set to Completed regardless of what was selected in the status field. This keeps the status badge and the actual finalized state in sync without any extra steps.

---

## Version 8.87.6 - 2026-05-17

### Manufacturing - Production

What works correctly now:
- Recipe Instructions now appear when you select a product on the Production Create page. Previously, the Recipe Instructions field would always stay blank even after choosing a product. It now correctly fills in with the instructions saved on the recipe as soon as a product is selected.

- Recipe Instructions on the Production Edit page now load correctly. Opening an existing production record will now show the instructions that were saved with it, instead of showing a blank field.

- Switching products no longer leaves old instructions behind. If you change the selected product (or clear the product field) on the Production Create page, the Recipe Instructions field now clears automatically. Previously, it would keep showing the previous product's instructions.

What is easier now:
- Recipe Instructions field is now editable on both Create and Edit pages. You can now type, paste, or update the instructions directly in the field - for example, to add notes specific to this production run. Previously the field was locked (read-only) and could not be typed in.

- Instructions you enter are saved with the production record. Whatever you type in the Recipe Instructions field is now saved when you submit the form. When you later open the same record to edit it, your instructions will be shown exactly as you entered them.

---

## Version 8.87.5 - 2026-05-16

### Manufacturing - Production List

What users can do now:
- "Selling Price" column added to the Production List. The Production list now shows a Selling Price column next to the Total Cost column. This displays the total expected selling value for each production run - calculated by multiplying the product's selling price by the quantity produced - so you can immediately compare what a batch costs to make versus what it can sell for.

- Footer totals now appear at the bottom of the Production List. The list now shows running totals at the bottom of the page. You can see the combined Total Cost and combined Total Selling Price for all production entries currently on screen - without having to add them up manually.

What looks different:
- Numeric value columns are now right-aligned in the Production List. The Quantity, Total Cost, and Selling Price columns now display their values aligned to the right, making it easier to read and compare numbers down the column at a glance.

---

### Manufacturing - Recipe Report

What users can do now:
- Filter bar added to the Recipe Report. The Recipe Report now has a filter panel at the top - just like other reports in the system. You can narrow down the recipes shown on screen before viewing or exporting.

- Filter by Category. Select a product category from the dropdown to show only the recipes that belong to that category.

- Filter by Sub Category. After choosing a category, a Sub Category dropdown appears so you can drill down further. The sub-category list automatically updates to match the selected category.

- Filter by Sub2 Category. If your business uses a third level of categories, a Sub2 Category dropdown also appears after you select a sub category.

- Search by product name. Type any part of a product name in the Search Product box. The autocomplete will suggest matching products as you type - select one to show only that product's recipe.

- Searching an ingredient now shows the recipes it belongs to. If the product you search is used as an ingredient in a recipe (not the final product), the report will still show you every recipe that uses it - so you can see which recipes depend on that ingredient.

- Rows-per-page selector added to the table. You can now choose how many rows to show at a time (10, 25, 50, 100, or All) directly above the table, matching the layout of other reports in the system.

What looks different:
- Numeric value columns are now right-aligned in the Recipe List. The Quantity, Price, and Unit Price columns now display their values aligned to the right for easier reading and comparison.

---

### Manufacturing - Demand Orders

What looks different:
- Numeric value columns are now right-aligned in the Demand Orders list. The Total Items, Estimated Cost, and Selling Price columns now display their values aligned to the right.

- Currency symbol moved to headings for cost and selling price columns. The currency symbol, such as Rs, now appears only in the Estimated Cost and Selling Price headings instead of repeating on every row - making the list cleaner and easier to scan.

- Footer totals now appear at the bottom of the Demand Orders list. The list now shows running totals at the bottom of the page. You can see the combined Total Items, Estimated Cost, and Total Selling Price for all entries currently on screen - without adding them up manually.

---

### Manufacturing - Demand Ingredient Report

What is easier now:
- Category, Sub Category, and Sub2 Category columns are now shown on all report tabs. Every tab in the Demand Ingredient Report - Product-wise Summary, Category-wise Summary, All Ingredients Summary, All Ingredients Detail, and Batch Ingredients Summary - now includes three separate columns showing the Category, Sub Category, and Sub2 Category of each product or ingredient, so you can clearly see which category level each item belongs to.

- The Category / Sub Category / Sub2 Category filters now correctly narrow down the report. Selecting a category or sub-category in the report filters now limits all tabs to only show products that belong to the selected category. Previously, all products appeared regardless of the filter chosen.

- Sub Category and Sub2 Category columns now display the correct values. The Sub Category and Sub2 Category columns were previously empty for all products. They now correctly show the sub-category and sub2-category names as saved on each product, matching what you see in the product list.

What looks different:
- Currency symbol moved to the Selling Price heading across all report tabs. The currency symbol, such as Rs, now appears only in the Selling Price heading instead of repeating inside every row - keeping the numbers clean and easy to read. This applies to all five report tabs: Product-wise Summary, Category-wise Summary, All Ingredients Summary, All Ingredients Detail, and Batch Ingredients Summary.

---

### Reports - Sale Invoices Report

What users can do now:
- Two new filter options added to the "Type" dropdown in the Sale Invoices Report. You can now filter the report by Sales Order or Quotation in addition to Sales Invoices and Sales Return.

  - Sales Order - Select this to view all products and quantities listed on Sales Orders. This option only appears if Sales Orders are enabled in Business Settings > Sales.

  - Quotation - Select this to view all products and quantities listed on Quotations. This option only appears if Quotations are enabled in Business Settings > Sales.

---

### Reports - Types of Service Report

What users can do now:
- A new "Types of Service Report" has been added under Reports. This report gives you a full breakdown of all sales that were placed using a Type of Service (such as Dine In, Take Away, Delivery, etc.). You can find it under POS Reports if the POS module is turned on, or under Sales Reports if it is not.

- Filter the report by date range, business location, and type of service. Use the filter bar at the top to narrow down results - choose a date range, a specific business location, or a particular type of service to focus on exactly what you need.

- Three report views in one page - Total, Summary, and Detail.

  - Total tab - Shows a day-by-day breakdown. For each date, you can see how many orders were placed using a type of service and the total sales amount for that day.

  - Summary tab - Shows a grouped view by type of service name. For each service type, you can see the total number of orders, the total amount collected, and the average order value. Useful for comparing which service type brings in the most business.

  - Detail tab - Shows every individual transaction. Each row displays the date, invoice number, customer name, invoice total, the type of service used, and the service charge amount collected for that order.

- Footer totals appear at the bottom of every tab. Each tab automatically adds up the quantities and amounts shown on screen so you can see the running totals without manually adding them up.

- Access controlled by role permission. Go to Settings > Security Roles, open a role, and look under the Reports section. Enable View Types of Service Report, then choose Own Location or All Locations under that permission.

---

### Reports - Sell Payment Report

What is easier now:
- Payment Method filter dropdown now shows the exact names you set for each business location. The list of payment methods in the filter now matches the names configured in your Business Location's Payment Options - for example, if you named a custom method "E-Wallet" or "Online Transfer", that exact name now appears in the filter instead of a generic label.

---

### Reports - Purchase Payment Report

What users can do now:
- Payment Method filter added to the Purchase Payment Report. You can now filter the Purchase Payment Report by payment method - the same way you can on the Sell Payment Report. Select a specific method from the new dropdown to show only payments made using that method. The dropdown shows the exact method names set in your Business Location's Payment Options.

---

### Labels

What users can do now:
- You can now print the Product Category on labels. In Labels > Information to show in Labels, a new Product Category option has been added. Tick it before previewing or printing, and the category name assigned to the product will appear on each printed label. You can also set the font size for it, just like the other label fields.

---

### Product Catalogue

What works correctly now:
- Discount badge now appears only on the right products. If a discount is set for one product, brand, or category, the badge appears only where that discount applies.

What is easier now:
- Product cards now show the discounted price when a discount is active. When a product has an active discount, its card in the catalogue now displays the original price with a strikethrough and the discounted price highlighted in red below it. This makes it easy for customers to see the saving at a glance before opening the product details.

---

### Accounting - Journal Entry

What is easier now:
- "Narration" column now appears on the Journal Entry list. The Journal Entry list now shows a dedicated Narration column (placed just before the Additional Notes column). This displays the description you entered for each account line when creating or editing a journal entry, so you can read the purpose of each entry at a glance - without having to open it.

---

## Version 8.87.4 - 2026-05-15

### Accounting - Bank Reconciliation

What users can do now:
- A new "Bank Reconciliation" section has been added to the Accounting module. You can find it in the Accounting menu under Bank Reconciliation. This feature lets you compare your bank statement with the transactions recorded in the system - and tick off the ones that match - so you can confirm your books are accurate at the end of each period.

- Start a new reconciliation in seconds. Click + New Reconciliation, choose the bank account, enter the closing balance shown on your bank statement, and set the statement date. The system automatically fills in the opening balance from your previous reconciliation (if one exists) so you do not have to enter it manually.

- Mark transactions as cleared directly on screen. The reconciliation worksheet shows two columns side by side - Deposits / Credits on the left and Payments / Debits on the right. Tick the checkbox next to each transaction that appears on your bank statement. The totals and the outstanding difference update instantly as you tick.

- Live difference indicator shows whether your books balance. A summary bar at the top of the worksheet shows the bank statement balance, cleared totals, and the current difference. When the difference reaches zero, a green "Balanced" indicator appears and the Complete Reconciliation button becomes active.

- Add bank-only entries without leaving the reconciliation. If your bank statement includes a charge, fee, or deposit that has not yet been entered into the system (such as a bank service fee), click Add Bank-Only Entry, enter the amount, date, and description, and it will be included in the reconciliation and automatically ticked as cleared.

- Outstanding transactions are shown at a glance. Below the worksheet, the system lists all transactions that were not ticked - these are deposits or payments recorded in the system but not yet appearing on the bank statement. This helps you spot anything that may need follow-up.

- Finalise and lock completed reconciliations. Once balanced, click Complete Reconciliation to mark it as done. You can then Lock it to prevent any further changes, keeping your records secure and auditable.

- Print or save a formal Reconciliation Statement. Every completed reconciliation has a printable report showing the statement period, opening and closing balances, all cleared deposits and payments, outstanding items, and signature lines for authorisation. Open any reconciliation from the list and click Print.

- Full history of past reconciliations. The Bank Reconciliation list shows all previous reconciliations with their status (Draft, Completed, or Locked), the bank account, statement date, and whether they balanced. You can filter by account, status, or date range.

- Access controlled by role permission. Go to Settings > Security Roles and look under the Accounting section to enable Manage Bank Reconciliation for the roles that need it.

---

### Dashboard

What is easier now:
- "Top 10 Selling Products" widget no longer includes items marked as "Not for Selling". Any product you have flagged as "Not for Selling" on its product page will no longer appear in this dashboard list, keeping it accurate and limited to what you actually sell.

---

### Reports

What users can do now:
- Each report now has its own separate permission to allow staff to see data for all locations. Previously, a staff member linked to one location could only see that location's data in reports. You can now grant permission per individual report - for example, let a user see all locations in the Profit & Loss report while keeping them restricted to their own location in the Stock report. Go to Settings > Security Roles, open a role, and look under the Reports section - each report's "View for All Locations" option appears directly below its main "View" option.

  Reports that now have this per-report control:

  | Section | Reports included |
  |---|---|
  | Admin Reports | Profit & Loss, Purchase & Sell, Tax, Expense |
  | POS Reports | Register Report, Summary Income Report, Sales Representative Report |
  | Sales Reports | Sale Invoices, Sales Returns, Product Sell, Sales Analysis, Trending Products |
  | Stock Reports | All stock reports (Stock Quantity, Stock Value, Reorder, Expiry, Transfers, Adjustments, etc.) |
  | Purchase Reports | Purchase Invoices, Purchase Returns, Product Purchase, Purchase Analysis |
  | General Reports | Contacts (Supplier & Customer) Report |

---

### Point of Sale (POS)

What is easier now:
- POS screen is faster when you scan or tap several products quickly one after another. Products now load into the sale with less delay, so you can keep adding items without waiting.
- Customer group pricing and discounts are applied without any pause. If a customer belongs to a group with special prices, those prices now appear immediately - no noticeable delay during the sale.
- Product unit choices (e.g. Piece, Box, Dozen) appear faster during a sale. Selecting a unit on any product row is quicker, especially when the same unit is used more than once in the same transaction.
- Service staff list in POS appears faster. The list of staff available to assign to a table or order loads more quickly each time it is needed on the same screen.

---

### User Management

What users can do now:
- The Users page is now divided into two separate sections: "All Users" and "All Employees".
  - All Users - lists only staff who have a system login (those with "Allow Login" turned on). Their username, role, and login-related actions are shown here.
  - All Employees - lists staff who do not have a system login (those with "Allow Login" turned off). These are typically field staff or workers tracked in the system but not given access to sign in.

  This makes it much easier to manage login-access staff and non-login employees separately without them being mixed together in one long list. This split also appears on the Superadmin > Business detail page.

---

### Navigation Bar (Top Bar)

What looks different:
- "Add Sale" shortcut icon in the top bar is now hidden for users who do not have the Add Sale permission. The icon now only appears for users whose role includes permission to add a sale.
- "Add Product" shortcut icon in the top bar is now correctly shown or hidden based on the user's permission. Only users with the "Create Product" permission in their role will see this icon.

---

### Manufacturing - Demand Orders

What users can do now:
- A "Batch Quantity" field has been added to each product line in demand orders. When creating or editing a demand order, you can now enter a batch quantity per line to specify how many batches are needed - making production planning clearer at a glance.
- Batch Quantity is now shown when viewing or printing a demand order. The batch quantity column appears in the demand order detail view and on printed copies, so nothing is missing from your records.
- A new "Batch Ingredients Summary" tab has been added to the Demand Order Report. This tab shows a combined summary of how much of each ingredient is needed across all demand orders for the selected period, grouped by batch - without having to check each order separately.

What is easier now:
- SKU search in Manufacturing now finds all product types. Scanning or typing a product SKU in the manufacturing search now correctly finds both weight-code products and regular simple products, so you can add any product to a recipe or demand order without browsing manually.

What works correctly now:
- Recipe Report opens normally again. The Recipe Report under Manufacturing > Reports now shows recipe information as expected.

---

### Manufacturing - Demand Ingredient Report

What works correctly now:
- Quantity values in the Demand Ingredient Report now display the correct number of decimal places. All quantity columns across all tabs (Product-wise Summary, Category-wise Summary, All Ingredients Summary, All Ingredients Detail, and Batch Ingredients Summary) now respect the Quantity Decimal setting configured in Settings > Business Settings > Business tab. Previously, quantities were always displayed using the currency decimal setting regardless of how many decimal places were set for quantities.

---

### Layout / Display

What looks different:
- The Save and Update buttons on several pages have been moved to the bottom footer bar. Instead of appearing at the bottom of the page content - where you had to scroll down to reach them - these buttons now stay visible at the bottom of the screen. This applies to the following pages:
  - Barcode Settings > Add New Setting - the Save button is now in the bottom bar.
  - Barcode Settings > Edit Setting - the Update button is now in the bottom bar.
  - Users > User Settings - the Update button is now in the bottom bar.
  - HRM > Settings - the Update button is now in the bottom bar.
  - Manufacturing > Settings - the Update button is now in the bottom bar.
  - Manufacturing > Demand Orders > Create - the Save and Save & Print buttons are now in the bottom bar.
  - Manufacturing > Demand Orders > Edit - the Update and Update & Print buttons are now in the bottom bar.

---

## Version 8.87.3 - 2026-05-14

### Reports - General Reports

What users can do now:
- New Bookings Report added under Reports > General Reports. View all restaurant/table bookings in one place. The report shows booking start and end time, customer name, phone number, table, business location, service staff, booking status (Waiting, Booked, Completed, or Cancelled), and any notes. Use the filters at the top to narrow results by date range, location, status, or customer, then print with one click.

---

### Layout / Display

What looks different:
- Empty space on the right side of pages on large or widescreen monitors has been removed. On extra-large screens and LED displays, pages now stretch to fill the full width instead of leaving a blank gap on the right side.

---

### Manufacturing - Demand Orders

What users can do now:
- Selling Price column added to the Demand Order list. Each demand order in the list now shows the total selling value of the finished products alongside the estimated cost.
- Selling Price column added to the Demand Order detail view and print. When you open or print a demand order, each product line now shows its selling price next to the estimated cost, with a total selling price in the footer.

What is easier now:
- Filters can now be saved on the Demand Order list page. Use the new Save button in the filter bar to remember your selected Business Location, Date Range, and Status. Your saved filters will be applied automatically the next time you open the Demand Order list. Click Reset to clear all filters back to default.

What looks different:
- The Action button (View / Print / Edit / Delete / Approve) is now the first column in the Demand Order list. You no longer need to scroll to the right to take action on a record.
- Date range filter opens on Today automatically. When you open the Demand Orders list, the date is already set to today so any order you just created appears straight away without needing to change the date.
- "Demand Order" is now a direct link in the Manufacturing sidebar menu. The previous "+ Add Demand Order" shortcut has been replaced with a "Demand Order" link that opens the full Demand Order list. From there you can view, search, filter, add, edit, approve, and print demand orders - all in one place. The "Add Demand Order" button is still available inside the list page.

What works correctly now:
- Demand Order list now loads correctly for all users who have access - not just Admin. Non-admin users with the "Access Demand Order" permission were seeing a blank, empty table. The list now shows all demand orders for the business, as expected.
- The Edit button on the Demand Order list is now only shown to users who have edit permission. Previously, the Edit button appeared for all users, but clicking it caused a "not allowed" error for those without the permission. The button is now hidden for those users.
- Demand Order link no longer appears twice in the menu. It was showing up in both the main navigation bar and the Reports dropdown at the same time for some users. It now appears only in one place based on the user's permissions.
- Orders created today now appear in the list immediately. Previously, because the date filter defaulted to yesterday, any order added today would not show up until the following day. The filter now defaults to today so newly created orders are visible right away.
- Clicking a status in the Demand Order list now shows all available status options. Previously, only 2 options appeared - Pending and Cancelled - regardless of the order's current status. The full list of statuses is now shown so you can move an order to any stage directly without going through each step one at a time.

---

### Manufacturing - Demand Ingredient Report

What users can do now:
- Selling Price column added to all four report tabs. The Demand Ingredient Report now shows a Selling Price column across the Product-wise Summary, Category-wise Summary, All Ingredients Summary, and All Ingredients Detail tabs - so you can compare ingredient cost against selling value on one screen.

What is easier now:
- Filters can now be saved on the Demand Ingredient Report. Use the new Save button to remember your selected Business Location, Date Range, Demand Orders, Category, Sub Category, Sub2 Category, and Status filters. They will be restored automatically next time you open the report. Click Reset to clear all filters.

What looks different:
- Date range filter opens on Yesterday automatically. When you open the Demand Ingredient Report, the date is already set to yesterday.

---

### Manufacturing - Recipe

What is easier now:
- Filters can now be saved on the Recipe list page. Use the new Save button to remember your selected Category, Sub Category, and Sub2 Category filters. They will be applied automatically the next time you open the Recipe page. Click Reset to clear all filters back to default.

---

### Manufacturing - Production

What is easier now:
- Filters can now be saved on the Production list page. Use the new Save button to remember your selected Business Location, Date Range, Production Status, Category, Sub Category, and Sub2 Category filters. They will be restored automatically the next time you open the Production page. Click Reset to clear all filters at once.
- Recipe instructions are now shown directly on the production form. When you select a recipe while adding or editing a production entry, the recipe instructions appear automatically on screen - no need to open the recipe separately to check them.

---

### Manufacturing - Dashboard

What looks different:
- Date filter opens on Today automatically. When you open the Manufacturing Dashboard, today's date is already selected - no need to manually pick a date before viewing the day's activity.

---

### Manufacturing

What works correctly now:
- Deleting a recipe now works correctly. The delete button on a recipe was not doing anything - no confirmation appeared and nothing was removed. It now shows a confirmation prompt and removes the recipe as expected.
- Product stock history no longer includes quantities from unfinished production batches. The "Manufacturing (In)" quantity shown in a product's stock history was previously counting production batches that had not yet been completed, making stock figures appear higher than they should. Only fully completed batches are now counted.

---

### Reports - Stock Value Report

What users can do now:
- Manufacturing quantities and values now appear as separate columns in the Stock Value Report. Two new columns - Manufacturing (In) and Manufacturing Value - have been added, giving a complete picture of how stock was built up through production.

What works correctly now:
- Manufactured stock now appears in the correct columns. Purchase columns show only supplier purchases, and manufactured stock appears only in the Manufacturing columns.
- Opening Stock now shows the correct figure even when sales are higher than purchases. The report no longer changes those products to 0 automatically.

---

### Contacts - Contact Payment

What looks different:
- "Outstanding" heading removed from the Contact Payment window. The bold label above the due invoices section has been removed to keep the layout clean and uncluttered.
- Location filter renamed to "Outstanding Invoices by". The filter that narrows the due invoices list by business location now has a clearer, self-explanatory label.
- Date range filters now sit next to the location filter. The From and To date fields are now shown in the same row as the location filter, making it faster to set your filters without scrolling.
- Location and User fields now sit side by side. These two fields are now displayed in one row instead of stacked on top of each other, saving vertical space in the payment form.

---

## Version 8.87.1 - 2026-05-13

### Reports / Products

What is easier now:
- Product Stock Details section now shows a Total row at the bottom. When viewing a product's stock details, a new totals row shows the combined Current Stock Quantity, Total Stock Price, Total Units Sold, Total Units Transferred, and Total Units Adjusted across all variations and locations.
- Opening Stock Report footer totals now show the correct grand total across all pages. Previously these totals only added up the rows visible on screen. They now always reflect the full filtered result, no matter how many pages the report spans.
- Add / Edit Opening Stock now shows footer totals for Quantity and Quantity Remaining. Each location table in the Opening Stock form now has a totals row that updates automatically as you enter values.

What works correctly now:
- Stock quantities now match for products with multiple variations. The Product list, Stock Quantity Report, and Product Stock Details window now show the same correct figures.

---

## Version 8.87.2 - 2026-05-05

### Business Location Settings

What users can do now:
- New "Map & Location" tab added to Business Location settings. Administrators can now set a precise map location for each business location. Search for an address, click anywhere on the map to drop a pin, or tap "Use My Current Location" to fill in the coordinates automatically. The saved location is used as the starting point on the live delivery map.

---

### Delivery Management

What is easier now:
- Live Map now opens centred on your business location. Each business location with saved coordinates appears as a store pin on the live tracking map. The map no longer opens on a random point on the world map.

---

### HRM - Attendance (Biometric Push Devices)

What users can do now:
- Newer ZKTeco biometric devices can now send attendance records directly to the system in real time. Models such as SenseFace 2A, 4A, 7C, ProFace X, SpeedFace M5, G4 and similar can send attendance records automatically - no extra attendance software or scheduled sync is required.
- New "ADMS / SenseFace Devices" management page added under HRM > Attendance > Import Attendance. Administrators can register devices by serial number, manage security keys, monitor the last-seen time and IP address, and enable or disable any device.
- Each device has its own security key that is checked on every attendance push, preventing unauthorised records from being submitted.
- Step-by-step Live Push Setup guide is shown directly on the Import Attendance page with the system's address already filled in, so you can configure the device without leaving the screen.

What looks different:
- Import Attendance page now groups compatible devices into four clear categories: Fingerprint/RFID, Multi-bio, iClock/SpeedFace, and ADMS Push - with a note indicating which models are officially tested.
- Quick-access "ADMS / SenseFace Devices" button added to the Import Attendance page alongside the existing Download buttons.

---

## Version 8.87.1 - 2026-05-05

### Business Settings - Modules

What users can do now:
- Delivery Management module can now be turned on or off. A new "Delivery Management (Riders & Live Map)" option has been added under Settings > Business Settings > Modules tab. When turned off, the Delivery menu and all delivery pages are hidden from all users. When turned on, the full Delivery suite is available.

---

## Version 8.87.0 - 2026-05-05

### Delivery Management (New Module)

What users can do now:
- A complete Delivery Management module is now available under a new Delivery menu (shown to users who have delivery access).
- Live Map: Real-time map showing every active rider's current position with colour-coded status pins (Available / On Delivery / On Break / Offline). Click any rider pin to see their name, phone number, vehicle, current speed, last-seen time, and the details of their active delivery. The map refreshes automatically every 10 seconds.
- Dashboard summary cards: A quick overview showing Total Riders, Available, On Delivery, Today's Orders, Active Assignments, and Delivered Today.
- Riders directory: Add and manage delivery riders. Capture vehicle type, plate number, colour, driving licence number and expiry date, emergency contact, maximum load, base delivery fee, per-km rate, and a photo. View the full list with each rider's current status and last-seen time.
- Per-rider Track screen: View a 24-hour map trail of GPS location updates for any individual rider.
- Assignments: Create and manage delivery tasks linked to a sale invoice (the customer's address fills in automatically from the contact record) or as a standalone delivery. Filter by status, rider, and date range.
- Automatic distance and fee calculation: Drop-off distance is calculated automatically. The delivery fee is computed as base fee + (distance x per-km rate) and can be overridden manually for each assignment.
- Delivery status tracking: Pending > Accepted > Picked Up > On The Way > Delivered (with Failed and Cancelled options available). Each step is recorded with a timestamp.
- Performance Report: Per-rider summary over any date range - showing total assignments, delivered, cancelled, success rate, total km travelled, total fees earned, and average delivery time.

What looks different:
- New Delivery sidebar menu (truck icon) with four sections: Live Map, Riders, Assignments, and Performance Report.

---

## Version 8.86.3 - 2026-05-04

### Purchase Returns

What works correctly now:
- Purchase Return list now shows the correct amount for each entry. Each purchase return displays its real grand total.
- Purchase Return footer totals now show the correct totals. Grand Total and Payment Due at the bottom of the list show the combined total across all matching records.

---

### Dashboard - Today at a Glance

What works correctly now:
- Today's Revenue and Total Due Amount now correctly subtract returns. Today's Revenue was previously showing gross sales without deducting sale returns, and Total Due was not offsetting outstanding return amounts. Both figures are now correct net amounts.

---

### Sales - Sale Returns

What works correctly now:
- Sale Return detail view now shows the returned products. Opening a sale-return record shows the correct products, quantities, unit prices, and subtotals.
- Sale Return list footer totals now cover all pages - not just the visible page. The Grand Total and Payment Due amounts in the footer now show the correct combined total across all records, regardless of how many pages the list has.

---

### Reports - Profit & Loss

What works correctly now:
- Total Sale Return now matches the Sale Return list. The Profit & Loss report shows the same sale return amount users see on the Sale Return list.

---

### Reports - Sales & Returns Report

What works correctly now:
- Sales & Returns Report footer totals now show net sales correctly. Sale returns are deducted from sales instead of being added.

---

### Reports - Sale Invoices Report

What works correctly now:
- Sale Return quantities now show correctly on the Totals tab. The Item Quantity column shows the returned quantity instead of 0.

---

### Settings - Modules

What users can do now:
- New "Custom Designer" toggle added under Settings > Business Settings > Modules tab. When turned on, the Invoice Designer and Label Designer options appear in the sidebar. When turned off, these options are hidden. This toggle is off by default.

---

### Products

What works correctly now:
- Group Price now appears in the Product list. Products with selling group prices show those prices in the list.

---

### Manufacturing - Sidebar Menu

What looks different:
- Manufacturing sidebar menu reordered for a clearer, step-by-step workflow. The menu now follows the natural production lifecycle: Dashboard > Recipe > Production > Add Demand Order > Reports > Settings.
- New "Reports" group added to the Manufacturing sidebar. All reporting screens (Demand Order Report, Demand Ingredient Report, Manufacturing Report, and Recipe Report) are now grouped together under a single Reports menu item.
- "Add Demand Order" is now a top-level shortcut in the sidebar. You can create a new demand order in one click directly from the sidebar.

---

## Version 8.86.2 - 2026-05-03

### Settings - Invoice / Receipt Design

What users can do now:
- New receipt layout "Slim 4" added for 80mm thermal printers. Available under Settings > Invoice Settings > Layout. Each product is displayed across two lines - the first line shows the item number and product name, and the second line shows the quantity, unit price, discount, and subtotal - making items easier to read on narrow 80mm receipt paper.

---

### HRM - Payroll

What works correctly now:
- Employee list now updates when a location is selected in Advance Payment. The Employee dropdown shows only employees from the selected location.

---

## Version 8.85.2 - 2026-05-02

### Manufacturing - Recipe Import

What users can do now:
- "Download Excel" button added to the Recipe list page. Clicking this button exports all your existing recipes in the same spreadsheet format used by the Recipe Importer. You can edit the downloaded file and re-upload it to update existing recipes or add new ones.
- Simpler recipe import spreadsheet format. Each ingredient now has its own row. Simply repeat the same Product SKU for every ingredient that belongs to the same recipe - no complex coding or special formatting is required.
- Recipe-level details only need to be entered on the first row. Fields such as Total Quantity, Recipe Unit, Extra Cost, and Instructions only need to be filled in on the first row of each recipe. The rows that follow will automatically use the same recipe-level values.
- Blank fields use sensible defaults. If you leave Total Quantity blank it defaults to 1. Production Cost Type defaults to Fixed. Units default to the product's base unit. This means you can create a working import file with minimal effort.
- Improved downloadable template. The Excel template now includes a styled header row, three worked examples (a cake recipe, a juice recipe, and a single-ingredient pack), and a built-in instructions section inside the sheet.
- "Download Sample (with example data)" button added. This downloads a fully populated sample workbook with 5 realistic recipes (Chocolate Cake, Vanilla Cupcake, Mango Juice, Veg Burger, Sugar Pack) that you can use as a reference when building your own import file.

What looks different:
- The Import Recipes page now clearly labels which columns are required and which only apply to the first row. A short tip box at the top of the page summarises the format in three simple bullet points.

---

### Sales / POS / Discounts

What works correctly now:
- "Buy For Quantity" discounts now charge the correct total at POS. For example, a "2 for GBP 9.99" deal charges GBP 9.99 for two units. If a customer buys 3 items, POS charges one bundle price plus one unit at the standard price.

---

### Fiji FRCS Integration (New Module)

What users can do now:
- New Fiji FRCS module added to help businesses in Fiji send sales receipts to the Fiji Revenue & Customs Service (FRCS) in real time.
- Register your fiscal device (EFD). A dedicated screen lets you enrol your shop's device with FRCS using the activation code from the FRCS portal. Switch between Sandbox mode (for testing) and Production mode (for live sales) with a single click.
- Sales receipts are sent to FRCS automatically. Every sale and refund processed at the POS is submitted to FRCS automatically. Supported types include Normal Sale, Refund / Credit Note, Training, and Proforma.
- Choose how receipts are sent. Select the mode that suits your business - Instant (sent at the moment of sale), Queued (sent in the background), Daily (sent once a day), or Manual (you click a button to send).
- Works even when the internet is down. If FRCS cannot be reached, receipts are saved locally and sent automatically once the connection is restored.
- X-Reports and Z-Reports. Generate the daily X-Report (read-only summary) and the end-of-day Z-Report (closes the business day and sends the data to FRCS). Z-Reports can also be generated automatically each night at a set time.
- FRCS QR code printed on every receipt. Once a receipt is accepted by FRCS, the official verification code and QR are stored and printed on the customer's copy so customers can verify it directly with FRCS.
- Settings page. From one screen you can configure your TIN, VAT number, sending mode, whether a buyer's TIN is required, QR code on/off, automatic Z-Report time, and an email address for error notifications.
- Submission history and audit trail. A dedicated page lists every receipt sent to FRCS with its current status (Pending / Submitted / Accepted / Failed). Search, filter, view details, and re-send any failed receipt with a single click.
- "Submit All Pending" button. Pushes all unsent receipts to FRCS in one go.
- Separate staff permissions for FRCS: Access the Fiji FRCS module, Manage EFD device onboarding, Submit fiscal receipts, and Generate X / Z Reports.

---

### Accounting - Chart of Accounts

What works correctly now:
- Parent Account dropdown now lists available parent accounts. Users can choose the correct parent account when adding or editing an account.
- Non-posting accounts can now be selected as parent accounts. Active non-posting accounts appear in the Parent Account dropdown.

---

### POS - Quick Menu Buttons

What works correctly now:
- Quick menu buttons now increase the existing product quantity correctly. When "Increase item quantity if it already exists" is turned on, repeated clicks increase the quantity on the same row.
- Quick menu buttons now use quantity 1 when no quantity is set. Products are no longer added with a blank quantity.

---

### Purchases

What is easier now:
- Purchase details popup now shows Gross Profit % and Sell Price. When these fields are enabled in settings, the purchase detail view shows GP% and Sell Price alongside the Subtotal column, so you can review pricing without opening the edit screen.

---

### Accounting - Chart of Account Report

What users can do now:
- Chart of Account Report added under Accounting > Reports. Lists all accounts organised by type (Asset, Liability, Equity, Income, Expenses) with columns for GL Code, Account Name, Account Sub Type, and Status.
- "Show Balances" option. Tick the Show Balances checkbox and click Apply Filters to add a live balance column showing the current balance for each account, plus totals grouped by sub-type and account type.
