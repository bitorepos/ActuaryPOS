## Version 8.94.9

**Release Date:** 2026-08-17

---

### Module: Users & Roles - POS Buttons

#### What Works Correctly Now
- **Subdomain users now see the correct POS footer buttons according to their own role.**
- **Role settings from another customer or main domain no longer affect the POS buttons for the current customer.**
- **If a role allows Cash, Card, Multipay, Draft, Quotation, or Credit Sale, those buttons can show normally on the POS screen.**
- **Buttons that are intentionally hidden from the role, such as Suspend or Takeaway, remain hidden as expected.**
- **After updating a customer subdomain, users can log in again and see the correct POS button access.**

#### Guide
- **Go to Settings > User Management > Roles.**
- **Open the user role you want to check.**
- **Go to the POS permissions section.**
- **Review the Payment Buttons options.**
- **Tick only the buttons you want to hide from that role.**
- **Save the role.**
- **Ask the user to refresh the POS screen or log in again.**
- **Go to POS and check that the footer buttons match the saved role settings.**

---

### Module: Purchases - Edit Purchase

#### What Works Correctly Now
- **Purchases with many products can now be updated more safely.**
- **When a purchase has 40, 50, or more product rows, the system keeps all product rows during update.**
- **Newly added products on a large purchase can be saved without the purchase dropping older products from the list.**
- **If all product rows are not available during save, the purchase is not saved as incomplete.**
- **Users will see a clear message and can refresh the page before trying again.**

#### Guide
- **Go to Purchases > Purchases List.**
- **Open the purchase you want to edit.**
- **Add or update products as needed.**
- **Click Update or Update and Print.**
- **After saving, open the purchase details and check that all products are still shown.**
- **If a message says the purchase was not saved because product rows were missing, refresh the page and try again.**

---

### Module: Update - User Role Access

#### What Works Correctly Now
- **After running the system update, user role access is checked and corrected automatically.**
- **Admins no longer need to open and save a role just to refresh user permissions after an update.**
- **Businesses on the main domain and customer subdomains can keep their own role access after update.**
- **Sales and POS permissions stay aligned for users who are allowed to work on those screens.**

#### Guide
- **Login as Admin or Superadmin.**
- **Go to the system update page.**
- **Run the update as usual.**
- **After the update finishes, ask users to refresh the page or log in again.**
- **Check the user's screen, such as POS or Sales, to confirm the allowed buttons and actions are visible.**

---

### Module: Products - Merge Products

#### What Works Correctly Now
- **The Merge Products button on the Products List now opens normally.**
- **Users can search and select the product they want to merge from.**
- **Users can search and select the product they want to merge into.**
- **The merge popup can be used without the page showing an error message.**

#### Guide
- **Go to Products > Products List.**
- **Click Merge Products from the bottom action buttons.**
- **Select the product in Merge From.**
- **Select the product in Merge To.**
- **Click Submit to merge the selected products.**

---

### Module: Sales - Unpaid Invoice Save

#### What Works Correctly Now
- **Sales invoices can now be saved without taking payment when the customer is allowed to buy on credit.**
- **If the payment amount is 0.00, the invoice is saved as unpaid instead of showing a payment missing message.**
- **Customers with no credit limit can still have unpaid invoices saved normally.**
- **The unpaid amount will remain visible as the customer's balance due.**

#### Guide
- **Go to Sales > Add Sale.**
- **Select the customer.**
- **Add the products to the invoice.**
- **Keep the payment amount as 0.00 if the customer will pay later.**
- **Click Save or Save and Print.**
- **Open the invoice or customer ledger to check that the amount is shown as due.**

---

## Version 8.94.8

**Release Date:** 2026-08-14

---

### Module: POS - Table Orders

#### What Works Correctly Now
- **The Table Orders popup now shows the total number of selected orders in the footer.**
- **The Table Orders popup now shows the total amount in the footer, so users can check it easily before checkout or bill print.**
- **When a table has many orders, the POS now shows a clear processing message while loading the orders.**
- **When users click Print Bill for a large table order, the screen now shows that the bill is being prepared.**
- **When users click Checkout for a large table order, the screen now shows that checkout is being prepared.**
- **When users click Cash to finalize a large table order, the screen now shows that the sale is being finalized.**
- **Table order totals now stay consistent when opening the order, printing the bill, and checking out.**
- **Repeated products in a large table order now load with the correct quantity and amount.**
- **The system now avoids creating unpaid final bills if payment details are not received properly.**
- **If payment information is missing, the user will see a message and the sale will not be finalized incomplete.**

#### Guide
- **Go to POS.**
- **Open a table that has table orders.**
- **Check the Table Orders popup footer for Orders and Total.**
- **Select the required table order or bill.**
- **Click Print Bill and wait while the processing message is shown.**
- **Click Checkout and wait while the order is loaded on the POS screen.**
- **Check that the POS total matches the table order bill total.**
- **Click Cash to finalize the sale.**
- **Wait for the processing message to finish before clicking another button.**
- **After checkout, open Recent Transactions > Final Paid and confirm that only the completed paid bill is shown for that checkout.**

---

### Module: Sales - Drafts List

#### What Works Correctly Now
- **The Drafts List now shows the Type of Services Value beside the Total Amount.**
- **Users can now filter draft bills by table from the report filters.**
- **The Drafts List now shows footer totals at the bottom for total items, total amount, and type of services value.**
- **It is easier to review draft bills by table and quickly check the total value shown in the list.**

#### Guide
- **Go to Sales > Drafts List.**
- **Use the Table filter if you want to see draft bills for one table only.**
- **Check the Type of Services Value column beside Total Amount.**
- **Check the bottom row of the table to see the totals for the visible draft bills.**

---

### Module: Reports - Purchase Payment Report

#### What Works Correctly Now
- **Purchase Payment Report totals now match the supplier ledger more closely.**
- **Supplier payments that include Ledger Discount 2 or Ledger Discount 3 now show the correct net payment amount.**
- **The Summary tab now shows the correct number of payment transactions and payment amount for the selected supplier and date range.**
- **The Supplier Summary tab now follows the same correct supplier payment totals.**
- **The Detail tab footer now shows the payment count and total amount correctly.**
- **The Detail tab footer totals now line up under the correct columns.**
- **The payment count now appears under Payment No., and the amount total now appears under Amount.**
- **The Detail tab now shows only one footer row, so the totals area is cleaner and easier to read.**
- **Printed, PDF, and Excel copies of the Purchase Payment Report follow the same corrected totals.**

#### Guide
- **Go to Reports > Purchase Payment Report.**
- **Select the required supplier.**
- **Select the required date range.**
- **Check the Summary tab for payment method totals.**
- **Open the Detail tab and check that the footer shows the correct payment count and amount total.**
- **Check that the footer values are shown under the correct columns.**
- **Compare the report with the supplier ledger if needed. The totals should now match for supplier payments that include ledger discounts.**

---

### Module: Sales - Large Quotations and Drafts

#### What Works Correctly Now
- **Sales quotations and drafts with many products now save more safely.**
- **When a quotation or draft has 40 or more products, the system no longer saves only part of the product list silently.**
- **If all product rows cannot be saved properly, the user will see a warning and the sale will not be saved incomplete.**
- **Users can add many products on the Add Sale screen with more confidence.**

#### Guide
- **Go to Sales > Add Sale.**
- **Add a large number of products, such as 40 or more items.**
- **Save the sale as Draft or Quotation.**
- **Open the saved Draft or Quotation again and check that all products are still listed.**
- **If a warning appears, reload the page and save again so the sale is not saved with missing products.**

---

### Module: Sales - Quotations and Drafts

#### What Works Correctly Now
- **Creating quotations and drafts from Add Sale is smoother when many products are added.**
- **After adding 30 or more products, the screen should stay more responsive while the user continues adding items.**
- **Users can continue product entry without the page slowing down badly because of draft saving in the background.**
- **Draft and quotation saving still works, but it waits better while the user is busy adding products.**

#### Guide
- **Go to Sales > Add Sale.**
- **Choose Draft or Quotation.**
- **Add many products one after another.**
- **Continue entering products normally.**
- **Save the Draft or Quotation and check that the product list is complete.**

---

### Module: Sales and POS - POS Disabled Businesses

#### What Works Correctly Now
- **If POS is turned off in Business Settings, users are no longer sent to the POS screen by mistake.**
- **If POS is turned off, users are no longer sent to the Open Cash Register page while working on Add Sale.**
- **Sales quotations and drafts can still be created from Add Sale when POS is turned off.**
- **Cash Register opening is now kept for POS use only.**
- **Add Sale continues to work separately from POS.**

#### Guide
- **Go to Settings > Business Settings > Modules.**
- **Turn off POS Sale if the business does not use the POS screen.**
- **Go to Sales > Add Sale.**
- **Create a Draft or Quotation as usual.**
- **Check that the system stays on the sales screen and does not ask to open a cash register.**

---

### Module: POS - Draft Bills

#### What Works Correctly Now
- **Draft bills now use the current date and time when they are finalized.**
- **Finalized draft bills now appear in today's Final Paid list and POS sales list.**
- **After a draft bill is paid, it is removed from the Draft list and can be found under Final Paid.**
- **Opening a draft bill from Recent Transactions > Draft now opens the bill normally.**
- **Draft bills no longer stay hidden under the old draft date after payment.**

#### Guide
- **Go to POS and click Recent.**
- **Open the Draft tab.**
- **Select a draft bill and click Edit.**
- **Check that the bill opens with the current date and time.**
- **Take payment and save the bill.**
- **Open Recent > Final Paid and check that the paid bill is shown there.**
- **Check the POS sales list for the same bill under today's date.**

---

### Module: POS Menu - Load Products

#### What Works Correctly Now
- **Load Products is now available in the POS Menu for all POS users.**
- **If a user does not have Sale Return or Direct Return permission, they can still open Sale Return in the POS Menu and use Load Products.**
- **Users without return permission will only see the invoice number field and Load Products option.**
- **Sale Return and Direct Return options are still shown only to users who have those permissions.**

#### Guide
- **Go to User Management > Roles.**
- **Create or edit a role.**
- **Open the POS tab and check the Sale Return permissions.**
- **If Sale Return and Direct Return permissions are not selected, save the role.**
- **Login with that user and open POS.**
- **Open the POS Menu and click Sale Return.**
- **Enter the invoice number and click Load Products.**

---

### Module: Settings - Invoice / Receipt Design

#### What Users Can Do Now
- **A new Draft Ref No label setting has been added in the Invoice Header section.**
- **A new Show Draft Ref No checkbox has been added.**
- **When a draft bill is finalized, the receipt can show the old draft bill number as a reference number.**
- **Users can choose the label name for this reference, such as Ref. or Draft Ref.**
- **If the checkbox is turned off, the draft reference number is not printed on the receipt.**

#### Guide
- **Go to Settings > Invoice Settings.**
- **Open the required invoice layout.**
- **Go to section 3 - Invoice Header to be shown.**
- **Enter the label you want for the draft reference number.**
- **Tick Show Draft Ref No if you want finalized draft bills to print the old draft bill number.**
- **Save the layout and print a finalized draft bill to check the receipt.**

---

### Module: Manufacturing - Production

#### What Works Correctly Now
- **Production list category filters now show the correct products.** When users select a Category and Sub Category, products saved under that Sub Category's Sub2 Category now appear correctly in the list.
- **Products no longer disappear when using the Sub Category filter.** For example, a product under BAKERY > SWEETS SECTION > Barfi will still show when BAKERY and SWEETS SECTION are selected.

#### Guide
- **Go to Manufacturing > Production.**
- **Select a Category.**
- **Select a Sub Category.**
- **Leave Sub2 Category as All if you want to see all products under that Sub Category.**
- **Check that products from the matching Sub2 Categories are also shown in the Production list.**

---

### Module: Reports - Daily Closing Report

#### What Works Correctly Now
- **Daily Closing Report print preview now moves between pages properly.**
- **Daily Closing Report pages now use the available page space better, so pages do not show large empty areas unnecessarily.**
- **Daily Closing Report PDF export now follows the print preview more closely.**
- **Stock value rows in the Daily Closing Report are arranged more evenly across pages.**
- **The PDF export no longer creates almost empty pages when only a few rows are left for a location.**

#### Guide
- **Go to Reports > Admin Reports > Daily Closing Report.**
- **Select the required date and filters.**
- **Open the print preview.**
- **Use the page buttons to move between pages.**
- **Click PDF to export the report.**
- **Check that the exported PDF pages are filled neatly and match the preview more closely.**

---

### Module: Contacts - Contact Ledger

#### What Works Correctly Now
- **Contact Ledger PDF export now keeps the right-side amount columns properly aligned.**
- **Debit, Credit, and Balance amounts now stay readable in the exported PDF.**
- **The exported Contact Ledger PDF now looks closer to the browser preview.**
- **Ledger rows and amount columns no longer squeeze or break badly on the right side of the PDF.**

#### Guide
- **Open a contact and go to the Ledger tab.**
- **Choose the required date range and ledger format.**
- **Open the print preview.**
- **Click PDF to export the ledger.**
- **Check that Debit, Credit, and Balance columns are aligned and easy to read.**

---

### Module: Contacts - Contact Ledger Format 2

#### What Works Correctly Now
- **Ledger Format 2 is now easier to read in print preview and PDF.**
- **The Date column now keeps the full date on one line and shows the time below it.**
- **The Number column now shows the transaction name first and the transaction number below it.**
- **Transaction numbers such as LID012026-000012 now stay together instead of breaking after the dash.**
- **Long Ref. No. details now wrap neatly inside the Ref. No. column.**
- **Comma-separated Ref. No. details now show a space after each comma.**
- **Date, Number, Quantity, Amount, and Balance columns now use only the space they need.**
- **Extra table space is now given to the Ref. No. column.**
- **Ledger Format 2 now looks better in both browser print preview and downloaded PDF.**

#### Guide
- **Open a contact and go to the Ledger tab.**
- **Choose Format 2.**
- **Open the print preview in portrait if needed.**
- **Check that Date, Number, and amount columns are compact and readable.**
- **Check that long Ref. No. details use the extra space and wrap neatly.**
- **Click PDF to download the ledger.**
- **Check that the downloaded PDF keeps the same columns neat and aligned.**

---

### Module: Contacts - Contact Ledger Format 1

#### What Works Correctly Now
- **Ledger Format 1 now gives more space to the Ref. No. column.**
- **Long Ref. No. details now wrap neatly inside the Ref. No. column.**
- **Comma-separated Ref. No. details now show a space after each comma.**
- **Date, Number, Payment, and amount columns now stay compact and readable.**
- **Ledger Format 1 print preview and PDF are easier to read when Ref. No. details are long.**
- **Ledger Format 1 downloaded PDF now keeps the columns aligned like the preview.**

#### Guide
- **Open a contact and go to the Ledger tab.**
- **Choose Format 1.**
- **Open the print preview or download the PDF.**
- **Check that the Ref. No. column has more room for long details.**
- **Check that the other columns stay compact and aligned.**

---

### Module: Manufacturing - Demand Ingredient Report

#### What Users Can Do Now
- **Product-wise Summary now has a Status column before Demand Qty.**
- **Users can click the status badge to change the status for that product row.**
- **Available status options are Planned, In Progress, Quality Check, Completed, On Hold, and Cancelled.**
- **Each user can keep their own status for this report, without changing anything on the Production page.**
- **The selected status stays saved when the report is opened again.**
- **The filter now clearly says Demand Order Status, so users can tell it is filtering demand orders.**

#### Guide
- **Go to Manufacturing > Reports > Demand Ingredient Report.**
- **Generate the report with the required filters.**
- **Use Demand Order Status if you want to show only demand orders with selected statuses.**
- **Open the Product-wise Summary tab.**
- **Click the status badge beside a product.**
- **Select the required status from the dropdown.**
- **Click Update Status.**
- **Refresh or open the report again to confirm the selected status is still shown.**

#### What Works Correctly Now
- **Product-wise Summary now prints on an upright page and fits neatly.**
- **Category-wise Summary is now easier to read in print preview and PDF.**
- **All Ingredients Summary now fits more lines on each page.**
- **All Ingredients Detail now keeps the full table inside the page more clearly.**
- **Batch Ingredients Summary now prints on an upright page and fits neatly.**
- **Report pages now show less empty space at the bottom.**
- **Demand Ingredient Report tables are easier to read on screen.**

#### Guide
- **Go to Manufacturing > Reports > Demand Ingredient Report.**
- **Select the required date range and demand orders.**
- **Open Product-wise Summary and check that the page is filled neatly.**
- **Open Category-wise Summary and check that the table is easier to read.**
- **Open All Ingredients Summary and check that more lines fit on the page.**
- **Open All Ingredients Detail and check that the full table stays inside the page.**
- **Open Batch Ingredients Summary and check that the page is filled neatly.**
- **Click the red PDF button to export the report.**
- **Check the exported PDF to confirm the table is readable and the page does not have large empty areas.**

---

### Module: Contacts - Contact List

#### What Users Can Do Now
- **The contact list now shows Number of Transactions before Added On.**
- **Users can quickly see how many ledger transactions exist for each supplier, customer, or combined contact.**
- **Long contact list headings are easier to read because important headings now appear on two lines.**
- **Headings such as Contact ID, Business Name, Tax number, Opening Balance, Advance Balance, Ledger Discount, Total Due, Return Due, Credit Limit, Customer Group, and Business Locations now take less width.**

#### Guide
- **Go to Contacts and open Suppliers, Customers, or Both.**
- **Check the new Number of Transactions column before Added On.**
- **Use this number to quickly identify contacts with more or fewer ledger transactions.**
- **Read the two-line table headings to review balances, dues, business locations, and contact groups more comfortably.**

---

### Module: Manufacturing - Recipe and Production

#### What Users Can Do Now
- **The recipe Add Ingredients page now shows the product SKU beside the product name.**
- **Users can quickly confirm the exact product before adding or editing recipe ingredients.**
- **The "Allow edit on Production" option now appears only when "Disable editing ingredients quantity in production" is ticked in Manufacturing Settings.**
- **When "Disable editing ingredients quantity in production" is unticked, ingredient quantities can be edited directly while adding or editing production.**
- **When "Disable editing ingredients quantity in production" is ticked, each recipe can control production editing with "Allow edit on Production".**
- **If "Allow edit on Production" is ticked for that recipe, production ingredient quantities can be changed.**
- **If "Allow edit on Production" is unticked for that recipe, production ingredient quantities stay locked.**

#### Guide
- **Go to Manufacturing > Settings.**
- **Tick "Disable editing ingredients quantity in production" if you want to control editing recipe by recipe.**
- **Go to Manufacturing > Recipe and open Add Ingredients for a product.**
- **Check the product SKU shown beside the product name.**
- **Tick "Allow edit on Production" only for recipes where staff may change ingredient quantities during production.**
- **Go to Manufacturing > Production > Add or edit a production entry.**
- **Check that ingredient quantities are editable only for the recipes where editing is allowed.**

---

### Module: Reports - Daily Closing Report

#### What Users Can Do Now
- **Users can sort the Daily Closing Report tables by clicking any table heading.**
- **Clicking a heading once sorts the table from smallest to largest or A to Z.**
- **Clicking the same heading again sorts it the other way.**
- **Users can sort purchase invoice details by Date, Ref No, Supplier, Type, Location, Payment Status, Total Amount, Paid, Payment Method, Due, and Others.**
- **Users can sort product detail rows inside purchase invoices.**
- **Users can sort stock value detail tables by any visible column.**
- **Totals stay at the bottom while users sort the report.**
- **Purchase invoice detail rows stay connected to their invoice when sorting.**

#### Guide
- **Go to Reports > Admin Reports > Daily Closing Report.**
- **Wait for the Purchase Invoices Report - Detailed and Stock Value Report - Detailed sections to load.**
- **Click any table heading to sort that table.**
- **Click the same heading again to change the sorting direction.**
- **Use this to quickly find the highest amount, lowest amount, earliest date, latest date, supplier name, product name, or location.**
- **Change filters if needed, then sort the newly loaded tables again.**

---

### Module: Discounts - Date and Time Range

#### What Works Correctly Now
- **Discounts now follow the selected time range correctly on POS and sales screens.**
- **A discount set from 02:00 AM to 05:29 AM only works during that time.**
- **The discount no longer applies at night or evening when the selected time range has already ended.**
- **Date range and discount days still decide which dates the discount can be used.**

#### Guide
- **Go to Discounts.**
- **Open the discount you want to check or edit.**
- **Set the Start Date and Start Time.**
- **Set the End Date and End Time.**
- **For daily time offers, choose the start and end time when the discount should work each day.**
- **Select the discount days that should be allowed.**
- **Make sure Is active is ticked.**
- **Save the discount.**
- **Open POS or the sales screen during the selected time and check that the discount is applied.**
- **Open POS or the sales screen outside the selected time and check that the discount is not applied.**

---

## Version 8.94.7

**Release Date:** 2026-08-13

---

### Module: Products - Products List

#### What Works Correctly Now
- **Products List now opens normally instead of staying stuck on Processing.**
- **Products now appear in the list as expected.**
- **Users can search products by name or SKU after the list opens.**
- **Users can choose how many products to show on one page.**
- **Export buttons and product action buttons can be used normally.**
- **Bulk action buttons are easier to use because they stay visible under the product list.**

#### Guide
- **Go to Products > Products List.**
- **Wait for the product list to load.**
- **Use the Search box to find a product by name or SKU.**
- **Use the Show entries dropdown if you want to see more or fewer products on one page.**
- **Select products from the checkbox column if you want to use any bulk action button.**
- **Use Bulk Edit, Add to location, Remove from location, Merge Products, Deactivate Selected, Reactivate Selected, Print Labels, or Stock Maintenance as needed.**

---

### Module: Users & Roles - Sales Permissions

#### What Works Correctly Now
- **Non-admin users now see the correct Sales action options according to their role.**
- **Users who are allowed to edit sales can see the Edit option again in Sales > Sales List.**
- **Cashiers and staff only see the sales actions allowed for their role.**
- **When an admin changes a role, the Sales options remain easier to review and manage.**

#### Guide
- **Go to Settings > User Management > Roles.**
- **Open the role you want to check, such as Cashier.**
- **Review the Sales and POS sale permissions for that role.**
- **Tick the sales actions that this role should be allowed to use.**
- **Save the role.**
- **Ask the user to refresh the page or log in again.**
- **Go to Sales > Sales List.**
- **Open the Actions menu on a sale invoice and check that the allowed options, such as Edit, are visible.**

---

### Module: Purchases - Edit Purchase

#### What Works Correctly Now
- **Users can update an existing purchase even when the supplier is already selected on the page.**
- **The page no longer asks for Supplier again when the supplier name is already showing.**
- **Old purchases with a selected supplier can be edited and updated more smoothly.**
- **The selected supplier stays with the purchase during update.**

#### Guide
- **Go to Purchases > Purchases List.**
- **Search the purchase transaction number, such as PI012026-000596.**
- **Open Actions > Edit.**
- **Check that the supplier name is already selected.**
- **Make the required purchase changes.**
- **Click Update or Update and print.**
- **If a message appears, read it on the same page and complete only the missing information shown.**

---

### Module: Software Update

#### What Works Correctly Now
- **Admins can open the Software Update page and use the I Understand, Update button normally.**
- **The update can continue even if some new features were already added during an earlier update attempt.**
- **The update flow is smoother for systems that already have Delivery Notes features available.**
- **The update flow is smoother for systems that already have Slaughterhouse features available.**
- **After the update finishes, users can continue using the software normally.**

#### Guide
- **Sign in with an Admin user.**
- **Click the red UPDATE button if it appears, or open the Software Update page.**
- **Read the warning on the update page.**
- **Click I Understand, Update.**
- **Wait until the update finishes.**
- **After the update finishes, open the dashboard and check that the normal menus are available.**

---

### Module: Backup - Auto Backup Time

#### What Works Correctly Now
- **Users can save the auto backup time from the Backup page without the page stopping with an error.**
- **The selected backup time stays saved after updating.**
- **The Backup page shows the saved auto backup time clearly.**

#### Guide
- **Go to Backup.**
- **Choose the time when automatic backup should run.**
- **Click Save.**
- **Check that the selected time is shown on the Backup page.**

---

### Module: About Page

#### What Works Correctly Now
- **The About page now opens normally.**
- **The Last Updated date shows in a clear and readable format.**
- **A wrong date setting no longer stops users from opening the software.**

#### Guide
- **Open the About page from the menu.**
- **Check the Last Updated date shown on the page.**
- **Use the Version History link if you want to read the recent changes.**

---

## Version 8.93.12

**Release Date:** 2026-08-12

---

### Module: Sales - Add Sale from Quotation

#### What Works Correctly Now
- **Products loaded from a quotation now keep the same quantity that was entered on the quotation.**
- **If a quotation product has no stock available, the sale page shows a clear stock warning instead of silently changing the quantity.**
- **The stock warning now points to the affected product row, so users can easily see which item needs attention.**
- **If more than one quotation product has no stock, the sale page can show the warning for all affected products.**

#### Guide
- **Go to Sales > Add Sale.**
- **Use Load Products from Quotation to select the quotation.**
- **Check that the product quantities match the quotation.**
- **If any product is not available in stock, review the warning shown beside that product.**
- **Adjust the product or stock as needed before saving the sale invoice.**

---

### Module: Sales - Quotations List

#### What Works Correctly Now
- **Completed quotation status can now be changed from the Quotations List.**
- **Users can click the Completed status, open the status popup, and change it to Pending when needed.**
- **The status popup opens clearly on the page and can be closed normally.**
- **After updating the status, the Quotations List refreshes and shows the latest status.**

#### Guide
- **Go to Sales > Quotations List.**
- **Find the quotation that shows Completed in the Status column.**
- **Click Completed.**
- **In the popup, choose Pending from the Status dropdown.**
- **Click Update.**
- **Check that the quotation now shows Pending in the list.**

---

### Module: Sales - Sale Invoice Edit

#### What Works Correctly Now
- **Sale invoices made from the Add Sale screen now open on the normal Sale Edit page.**
- **Sales no longer open on the POS edit page by mistake when the POS module is turned off.**
- **The Sales List now keeps these invoices under the correct Sale screen workflow.**
- **Older sale invoices can also be opened from Sales as expected.**

#### Guide
- **Go to Sales > Sales List.**
- **Search the invoice number you want to edit.**
- **Click Actions > Edit.**
- **Check that the invoice opens on the normal Sale Edit page.**
- **Edit and update the invoice as usual.**

---

## Version 8.93.11

**Release Date:** 2026-08-11

---

### Module: Purchases - Add and Edit Purchase

#### What Works Correctly Now
- **Purchase forms now show the exact missing-field message on the same page if something is incomplete.**
- **The purchase page no longer clears all entered products when a save message appears.**
- **Users can review the message, complete the missing information, and save again without starting the purchase from the beginning.**
- **Products loaded from a quotation now stay in the purchase form after applying product discount.**
- **Product discount applied from the discount column can be saved with the purchase normally.**
- **Purchase total, net total, and payable amount are kept ready for saving after quotation products and discounts are added.**
- **Editing an old purchase no longer asks for Supplier again when the supplier is already selected.**

#### Guide
- **Go to Purchases > Add Purchase.**
- **Select the supplier and other required purchase details.**
- **Use Load Products from Quotation if you want to bring quotation products into the purchase.**
- **Click the Unit Discount column heading if you want to apply one discount to all products.**
- **Enter the discount, such as 45%, and apply it.**
- **Check that the product rows, net total, and total payable amount are showing.**
- **Click Save or Save and print.**
- **If a message appears, read it on the same page, complete the missing detail, and save again.**
- **When editing an existing purchase, check the selected supplier and click Update as usual.**

---

## Version 8.93.10

**Release Date:** 2026-08-11

---

### Module: Home Dashboard - Business Analytics

#### What Works Correctly Now
- **Business Analytics on the Home Dashboard now loads properly.**
- **Recent Transactions no longer stays stuck on Loading.**
- **Dashboard charts and insight cards now continue showing even when product, customer, or location names use Urdu or other non-English text.**
- **Users can review recent sales, purchases, payment method sales, hourly sales, top products, and business health from the dashboard as expected.**

#### Guide
- **Go to Home / Dashboard.**
- **Open the Business Analytics & Insights section.**
- **Check that Recent Transactions shows the latest activity instead of staying on Loading.**
- **Check that the dashboard charts and Business Health card are visible.**
- **Change the date or business location if needed and confirm the dashboard refreshes normally.**

---

### Module: Sales - Invoice Totals

#### What Works Correctly Now
- **Final sale invoices no longer save with zero total when the bill has products and amount.**
- **The Sales list can show the correct Total Amount and Sale Due again for affected invoices.**
- **Sale Details now shows the correct Total Receivable and Total remaining for affected invoices.**
- **Old affected invoices can be corrected so users do not see zero values for real sales.**

#### Guide
- **Go to Sales and search the invoice number.**
- **Check that Total Amount and Sale Due show the real sale amount.**
- **Open Sale Details and check that Total Receivable and Total remaining show the real sale amount.**
- **If an old invoice still shows zero, ask admin or support to run the one-time zero invoice repair and refresh the Sales list.**

---

## Version 8.93.9

**Release Date:** 2026-08-11

---

### Module: POS - Draft Bills

#### What Works Correctly Now
- **Draft bill print now shows the correct Total after bill discount on Slim receipt layouts.**
- **When a draft bill has a bill discount, the printed draft no longer shows Total as zero by mistake.**
- **Slim receipt designs now show the draft total more clearly after subtotal and discount.**

#### Guide
- **Go to POS and open a draft bill.**
- **Apply the required bill discount.**
- **Print or preview the draft bill.**
- **Check that Subtotal, Discount, and Total show the correct amounts.**

---

### Module: POS - Auto Saved Drafts

#### What Works Better Now
- **Empty auto-saved drafts with zero amount no longer appear in the Draft transactions list.**
- **When a cashier updates an existing draft, the system keeps the same draft bill instead of showing extra empty draft bills.**
- **The Draft transactions popup is cleaner because only useful draft bills are shown.**

#### Guide
- **Go to POS and open Recent Transactions.**
- **Open the Draft tab.**
- **Check that empty zero-value auto-saved drafts are not shown.**
- **Open the correct draft bill and continue editing or updating it as usual.**

---

### Module: POS - Draft Bill Update

#### What Works Correctly Now
- **Bill discount changes are now saved when updating an existing draft bill.**
- **After updating a draft bill, the Draft transactions list shows the latest total.**
- **The draft bill time is refreshed after update, so users can easily see the latest saved draft.**
- **The same draft number is updated correctly instead of creating confusion with old values.**

#### Guide
- **Go to POS and open Recent Transactions.**
- **Open the Draft tab and select the draft bill you want to edit.**
- **Change the bill discount if needed.**
- **Click Update.**
- **Open the Draft tab again and check that the total and time show the latest saved bill.**

---

## Version 8.93.8

**Release Date:** 2026-08-06

---

### Module: POS - Invoice Printing

#### What Works Correctly Now
- **Classic sale invoices now print with the correct layout from the POS screen.**
- **Invoice text and details stay arranged properly when printing after completing a POS sale.**
- **Reprinted invoices and newly printed POS invoices now look consistent.**
- **Slim receipt layouts now adjust better when printed on normal A4 paper.**
- **Slim receipt text and tables no longer stay squeezed into a small strip when A4 paper is selected.**

#### Guide
- **Go to POS and create a sale.**
- **Complete the sale and open the print preview.**
- **Check that the Classic invoice layout appears properly before printing.**
- **If using a Slim receipt layout with A4 paper, check that the receipt uses the page width properly before printing.**

---

### Module: Sales - Product Delete Confirmation

#### What Works Better Now
- **Sale Create and Sale Edit now ask before removing a product from the bill.**
- **The popup shows the product name, so users can confirm they are deleting the correct item.**
- **If the user cancels the popup, the product stays on the bill.**

#### Guide
- **Go to Sales > Add Sale or open an existing sale for editing.**
- **Click the cross button beside any product row.**
- **Read the confirmation popup and choose OK only if you want to remove that product.**

---

### Module: Truckmate - Sidebar Menu

#### What Works Correctly Now
- **Truckmate now shows again in the sidebar when the business has Truckmate access.**
- **Users can open Truckmate pages from the sidebar as expected.**

#### Guide
- **Open the main dashboard.**
- **Check the left sidebar menu.**
- **Truckmate should be available for users who have Truckmate access.**

---

### Module: Truckmate - Date Calendars

#### What Works Better Now
- **Truckmate date calendars now open in the correct place beside the selected date field.**
- **The full calendar is now visible, including the month and year area at the top.**
- **Users can select dates more easily on Job Sheet, Vehicle, Driver, and Invoice pages.**
- **Start Date, End Date, Invoice Date, and vehicle/driver date fields no longer show a hidden or cut-off calendar.**

#### Guide
- **Open any Truckmate page that has a date field, such as Add Job Sheet, Edit Job Sheet, Add Vehicle, Edit Vehicle, Add Driver, Edit Driver, Add Invoice, or Edit Invoice.**
- **Click the date field.**
- **Use the calendar to choose the required date.**
- **Use the month and year area at the top of the calendar when you need to move to another month.**

---

### Module: Truckmate - Job Sheets

#### What Looks Better Now
- **The Job Sheets page has less empty space above the table.**
- **The Add button, export buttons, search box, and table now appear closer together and are easier to use.**
- **The Edit Status popup on Dashboard Jobs can now be closed normally.**

#### Guide
- **Go to Truckmate > Job Sheets to view the cleaner list page.**
- **Go to Truckmate > Dashboard Jobs and open Edit Status.**
- **Click Close or the cross button to close the popup.**

---

### Module: Truckmate - Settings

#### What Works Correctly Now
- **The Add Status popup can now be closed normally from Truckmate Settings.**
- **The Edit Status popup can also be closed normally.**
- **Users no longer need to refresh the page to leave the status popup.**

#### Guide
- **Go to Truckmate > Settings.**
- **Click Add Status or Edit on an existing status.**
- **Click Close or the cross button to close the popup.**

---

### Module: Truckmate - Invoices

#### What Works Better Now
- **The Add Invoice page now opens normally.**
- **Add Invoice and Edit Invoice top details are now arranged neatly in one row where space is available.**
- **Customer, Pay Term, Invoice Date, and Invoice Number are easier to read and fill in.**
- **The invoice date calendar now opens fully, with the month and year area visible.**

#### Guide
- **Go to Truckmate > Add Invoice.**
- **Fill in the top invoice details from left to right.**
- **Click Invoice Date and select the required date from the full calendar.**
- **For an existing invoice, open Edit Invoice and check the same improved layout.**

---

### Module: User Security - Users List

#### What Works Better Now
- **When no user limit is set, the Users List no longer shows a fixed limit at the top.**
- **This means the user count area stays simple when unlimited users are allowed.**
- **The warning about maximum users no longer appears when there is no fixed user limit.**

#### Guide
- **Go to User Security > Users List.**
- **Check the top of the users table.**
- **If unlimited users are allowed, the list will not show a user limit count.**
- **Click Add to create a new user as usual.**

---

### Module: Backup - Auto Backup Time

#### What Users Can Do Now
- **Backup page now clearly shows when auto backup time is not set.** If no auto backup time is defined, users will see **Not Define** instead of a default time.
- **Users can now set the auto backup time directly from the Backup page.**
- **After saving the time, the selected time appears on the Backup page as the current auto backup time.**

#### Guide
- **Go to Backup.**
- **Check Auto Backup Time at the top of the page.**
- **If it shows Not Define, choose the required time from the time field.**
- **Click Save Time.**
- **The saved time will be used for automatic backup.**

---

### Module: Backup - Google Drive Settings

#### What Works Correctly Now
- **Google Drive setup details now stay open when an Admin clicks them.**
- **Admins can now check or enter Google Drive details without the section closing immediately.**
- **The Google Drive setup guide still opens normally on the same page.**

#### Guide
- **Go to Backup > Google Drive.**
- **Click Google Drive setup details.**
- **Check or enter the required Google Drive details.**
- **Click Save if any changes are made.**

---

### Module: POS - Final Sale Total

#### What Works Correctly Now
- **POS now keeps the final payable amount shown on the checkout screen when completing a sale.**
- **Finalized sales no longer change to a different total when the cashier has already checked the bill amount.**
- **Sales that include service charges or packing charges can be completed more smoothly.**
- **If the bill total needs review, the cashier can still continue without unnecessary interruption.**

#### Guide
- **Open POS and create or edit a sale as usual.**
- **Apply any discount, service, packing, shipping, reward, or round-off amount needed for the bill.**
- **Check the final payable amount shown on the POS screen.**
- **Complete the sale.**
- **Open the invoice again and confirm that the saved total matches the POS checkout total.**

---

### Module: POS - Edit Sale Screen

#### What Works Better Now
- **Existing product set rows load more reliably when opening a sale in edit mode.**
- **Product set headers are added only after the edit page is ready, helping prevent display issues on slower page loads.**
- **Discount fields now behave more reliably when editing a sale.**

#### Guide
- **Open POS or Sales and edit an existing sale.**
- **If the sale contains product sets, check that the set header and its products appear correctly.**
- **Update item discounts or quantities as needed.**
- **Save the sale and confirm the edit screen responds normally.**

---

## Version 8.93.7

**Release Date:** 2026-08-03

### Module: Manufacturing - Recipe Production Editing

#### What Users Can Do Now
- **Recipes can now control whether ingredient quantities may be changed during production.**
- **When the setting "Disable editing ingredients quantity in production" is turned off, a new "Allow edit on Production" option appears on the recipe Add Ingredients page.**
- **Only recipes with "Allow edit on Production" selected will allow ingredient quantity changes while adding or editing production.**
- **Recipes without this option selected will keep ingredient quantities locked during production.**
- **If "Disable editing ingredients quantity in production" is turned on in Manufacturing Settings, ingredient quantities stay locked for all recipes.**

#### Guide
- **Go to Manufacturing > Settings.**
- **Make sure "Disable editing ingredients quantity in production" is turned off if you want to allow editing for selected recipes.**
- **Go to Manufacturing > Recipe.**
- **Add a new recipe or edit an existing recipe.**
- **Tick "Allow edit on Production" only for recipes where production staff are allowed to change ingredient quantities.**
- **Save the recipe.**
- **When adding or editing production for that recipe, ingredient quantities can be changed only if this option was selected.**

---

### Module: Invoice Layout - Add and Edit Page

#### What Looks Better Now
- **Invoice Layout Add and Edit pages now show the same product detail options.**
- **Options such as Show Product Note, Show Other Product Name, Show product description, and Show Discount in Percentage are now available while adding a new invoice layout.**
- **Product detail options are now arranged in the same order on both Add and Edit pages, so users can find settings more easily.**

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Click Add to create a new layout, or Edit to update an existing layout.**
- **Open 4 - Product details to be shown.**
- **Choose the product detail options you want to show on the invoice.**
- **Save the invoice layout.**

---

### Module: HRM - Payroll Group Payment

#### What Looks Better Now
- **The Paid On calendar is now fully visible while adding payroll group payments.**
- **Users can pick the payroll payment date and time without the calendar being hidden behind the payment form.**

#### Guide
- **Go to HRM > Payroll.**
- **Open a payroll group and click Add Payment.**
- **Click the Paid On date field.**
- **Select the required date and time from the calendar.**
- **Complete the payment details and save.**

---

### Module: POS - Change Return and Customer Balance

#### What Works Correctly Now
- **POS now handles extra paid amount as Change Return.** If the customer pays more than the bill total, the extra amount is treated as change given back to the customer.
- **Customer Due no longer becomes negative because of extra POS payment.** Walk-In Customer and other customers should not show a minus balance only because change return was missed.
- **Bills with extra payment now stay Paid instead of Overpaid when the extra amount is returned as change.**
- **Previous POS bills that caused a negative customer balance have been corrected.**

#### Guide
- **Open POS and make a sale as usual.**
- **Enter the amount received from the customer.**
- **If the received amount is more than the bill total, check the Change Return amount.**
- **Finalize the sale.**
- **Open the customer on POS again and check that Customer Due does not show a minus amount because of that sale.**

---

### Module: POS - Footer Buttons

#### What Looks Better Now
- **Credit Sale button is easier to read on the POS screen.** The button now shows Credit on the first line and Sale on the second line.
- **Multiple Pay button is easier to read on the POS screen.** The button now shows Multiple on the first line and Pay on the second line.
- **POS footer buttons now have the same height.** The footer buttons look even and aligned across the bottom of the POS screen.

#### Guide
- **Open the POS screen.**
- **Check the footer buttons at the bottom of the screen.**
- **Credit Sale should appear on two lines.**
- **Multiple Pay should appear on two lines.**
- **All footer buttons should appear with equal height.**

---

### Module: Business Settings - Drafts Date Range

#### What Works Better Now
- **Drafts List now follows the date range selected in Business Settings.**
- **Users can choose the starting date range for saved draft sales from Business Settings > Date Range.**
- **When users open Drafts List, the date filter is already set to the saved option, such as Today, This Year, Current Financial Year, or All Time.**
- **Users can still change the date range on the Drafts List whenever they need to check older or different draft bills.**

#### Guide
- **Go to Business Settings > Date Range.**
- **Choose the required date range for Drafts.**
- **Save the settings.**
- **Open POS > Drafts List.**
- **Check that the Date Range filter opens with the saved option already selected.**
- **Change the Date Range on the Drafts List if you need to view another period.**

---

### Module: Products - Product List Search

#### What Works Better Now
- **Product list search is clearer after searching.** When users search for a product, the table moves back to the main product columns so SKU and product name are easy to see.
- **Products found from the F10 Product Search window are easier to check on the Products page.**
- **Users can search with product words or SKU and review the matching product without needing to scroll the table sideways first.**

#### Guide
- **Go to Products.**
- **Type the product name or SKU in the Search box, such as PEACH 200.**
- **Check the SKU and Product columns on the left side of the table.**
- **If you open Product Search with F10 and select a product, the Products page will also show the matching product more clearly.**

---

### Module: Products - Stock Quantity Checking

#### What Works Correctly Now
- **Product stock quantity now stays consistent across the Products page.** Users should see the same current stock when checking the Product list, Stock Quantity Report tab, F10 Product Search popup, and the Quantity button.
- **The Quantity button now matches the product stock shown in the product search and report views.** This makes it easier to confirm available stock without confusion.
- **Location-wise stock is easier to trust.** When a product has stock in more than one shop or branch, users can open the Quantity button and compare the quantity shown for each location.

#### Guide
- **Go to Products.**
- **Open the Stock Quantity Report tab and search the product SKU.**
- **Press F10 and search the same SKU in the Product Search popup.**
- **Select the product and click Quantity.**
- **Compare the current stock shown in the report, product search popup, and Quantity window.**

---

### Module: Contacts - Large Contact Ledger

#### What Works Better Now
- **Large contact ledgers now open more reliably, especially Walk-In Customer ledgers with many sales and payments.**
- **The Ledger tab now loads the statement in smaller pages instead of showing a red error message.**
- **Users can continue using Previous and Next to move through large ledger records.**
- **Print, PDF, and Excel options are still available when a full ledger copy is needed.**

#### Guide
- **Open Contacts and select the customer or supplier.**
- **Go to the Ledger tab.**
- **Choose the required date range and ledger format.**
- **If the ledger has many records, use Previous and Next to view the pages.**
- **Use Print, Export to PDF, or Export to Excel when you need a full copy.**

---

### Module: Purchases - Tax Type Tooltip

#### What Users Can See Now
- **Purchase Create and Purchase Edit now show the product Tax Type when the mouse is placed on the Tax column.**
- **Users can check whether the selected product is Inclusive, Inclusive on Selling Price, Inclusive on the shown group price name, Exclusive, or None without leaving the purchase screen.**
- **This helps users confirm the product tax style while entering or checking purchase lines.**

#### Guide
- **Open Purchase Create or Purchase Edit.**
- **Add or review a product line.**
- **Move the mouse over the Tax column for that product.**
- **Check the shown Tax Type before saving if needed.**

---

### Module: Products - Tax Type on Product List

#### What Users Can Do Now
- **Product list now shows Tax Type after the Tax column.** Users can quickly see whether a product is Inclusive, Inclusive on Selling Price, Inclusive on the shown group price name, Exclusive, or None.
- **Product filters now include Tax Type.** Users can filter the Products page by the tax type they want to review.
- **The Tax Type filter also helps when checking product cards and stock report details from the Products page.**
- **Stock Maintenance can now change product Tax Type in bulk.**
- **If products are selected, users only choose To Tax Type and apply it to the selected products.**
- **If no products are selected, users choose From Tax Type and To Tax Type, then all products with the From Tax Type are changed to the To Tax Type.**

#### Guide
- **Go to Products.**
- **Check the Tax Type column after Tax to review each product's tax type.**
- **Use the Tax Type filter if you want to see only products with one tax type.**
- **To change selected products, tick the products, click Stock Maintenance, choose Tax Type Change, select To Tax Type, and click Apply.**
- **To change all products of one tax type, do not tick any product, click Stock Maintenance, choose Tax Type Change, select From Tax Type and To Tax Type, and click Apply.**
- **After applying, review the Tax Type column to confirm the products are updated.**

---

### Module: Products - Tax Type on Group Price

#### What Users Can Do Now
- **Products can now use tax inclusive on a group price such as MRP.**
- **Product Create and Product Edit now show an Inclusive on MRP style tax option when an active selling price group named MRP exists.**
- **This helps businesses calculate product tax from the selected group price instead of only purchase price or selling price.**

#### Guide
- **Go to Products > Add Product or Products > Edit Product.**
- **Make sure a selling price group named MRP exists if you want this option to appear.**
- **In Selling Price Tax Type, select Inclusive on MRP or the shown group price name.**
- **Save the product.**

---

### Module: Purchases - MRP / Group Price Column

#### What Users Can Do Now
- **Purchase Create and Purchase Edit can now show an MRP or group price column.**
- **Users can enter or update the MRP/group price directly while adding purchase products.**
- **The purchase line keeps the entered group price, so the value stays available when editing the purchase later.**
- **When the MRP price is entered, the product variation's MRP selling price group is also updated.**
- **Purchase tax calculation now supports products whose tax type is Inclusive on MRP/group price.**

#### Guide
- **Create or keep an active selling price group named MRP.**
- **Turn on Enable editing product price from purchase if the business uses purchase-based price editing.**
- **Open Purchase Create or Purchase Edit.**
- **Add a product and enter the required MRP/group price in the new column.**
- **If the product tax type is Inclusive on MRP, check that tax is calculated from the MRP/group price.**
- **Save the purchase.**

---

### Module: Purchases - Product Table Columns

#### What Looks Clearer Now
- **Purchase, Purchase Order, and Purchase Return product tables now show long column names on clearer lines.**
- **Labels such as Scheme Qty, Unit Discount, Total Discount, Total Discount 2, Discounted Cost, Cost Inc. Tax, and Lot Number are easier to read in narrow columns.**
- **The MRP/group selling price column now appears after Pack Price on Purchase Create and Purchase Edit, so price columns follow a more natural order.**

#### Guide
- **Open Purchase Create, Purchase Edit, Purchase Order, or Purchase Return.**
- **Check the product table header row.**
- **Use the clearer column names to enter quantity, discounts, costs, pack price, MRP/group price, tax, and lot details as usual.**

---

### Module: Reports - Stock Reindex Notifications

#### What Looks Clearer Now
- **Stock reindex completion notifications now show elapsed time when available.**
- **Cancelled stock reindex notifications also show elapsed time when available.**
- **The reindex notification keeps its original start time while progress updates continue.**

#### Guide
- **Start a stock quantity reindex from the related report screen.**
- **Wait for the success or cancelled notification.**
- **Check the message to see how long the reindex took.**

---

### Module: User Email Settings - SMTP Password

#### What Works Better Now
- **User mail passwords are now kept more safely when saving email settings.**
- **If the password field is left blank while updating email settings, the existing password is kept.**
- **Existing saved mail passwords continue working until the user changes the password.**

#### Guide
- **Go to the user email settings screen.**
- **Enter a mail password when setting SMTP for the first time or changing the password.**
- **Leave the password blank when editing other email settings and keeping the same password.**
- **Save the user settings.**

---

### Module: POS and Sales - Tax Inclusive Draft Bills

#### What Works Correctly Now
- **Draft bills now keep the same tax style they were created with.**
- **If a POS draft bill is created as tax inclusive, it opens again as tax inclusive when edited or finalized.**
- **If a POS draft bill is created as tax exclusive, it opens again as tax exclusive when edited or finalized.**
- **Updating a draft bill again no longer changes the bill total from inclusive to exclusive.**
- **Draft bill totals now update immediately when product quantity is typed or changed with the plus and minus buttons.**
- **Products can now be removed from an opened draft bill, and the bill total updates after removal.**
- **After opening a draft bill, changing product quantity and clicking Update now saves the draft again.**
- **After clicking Update on an opened draft bill, the draft closes and POS opens ready for a new sale.**
- **When draft auto save is enabled, opened draft bills now continue saving changes automatically.**
- **The bill amount shown before saving a draft and after reopening the draft now stays the same.**
- **Drafts List now shows the correct bill amount instead of showing 0.00 for saved draft bills.**
- **Sales edit pages now follow the saved bill tax style instead of changing because of current contact or business settings.**

#### Guide
- **Open POS and create the bill as usual.**
- **Save the bill as Draft.**
- **Open Recent Transactions and select the draft bill.**
- **Check that the total amount is the same as when the draft was saved.**
- **Change quantity by typing, or by using the plus and minus buttons, and check the total amount.**
- **Remove a product if needed and check the total amount again.**
- **If draft auto save is enabled, wait a few seconds after a change and the draft saves automatically.**
- **Change a product quantity if needed, then click Update.**
- **After the success message, POS opens again ready for a new sale.**
- **Click Update if you need to save the draft again.**
- **Open the draft again and confirm the amount still stays the same.**
- **Open POS > Drafts List and check that the Total Amount column shows the saved bill amount.**
- **Finalize the bill when ready.**

---

### Module: Purchases - Tax Inclusive Edit Pages

#### What Works Correctly Now
- **Purchase and purchase return edit pages now keep the same tax style used when the transaction was created.**
- **Tax inclusive purchase records open again as tax inclusive.**
- **Tax exclusive purchase records open again as tax exclusive.**
- **Purchase return amounts stay consistent when opening and saving the return again.**

#### Guide
- **Open an existing purchase or purchase return.**
- **Check the tax inclusive option and product totals before saving.**
- **Save or update the page.**
- **Open the same record again and confirm the amount has not changed.**

---

### Module: Purchases - Scheme Quantity Tax

#### What Works Correctly Now
- **Scheme Qty tax now follows the product's selling price when the product is set to Inclusive on Selling Price.**
- **The tax amount for Scheme Qty now matches the same selling price tax rule used for normal purchase quantity.**
- **If Purchase Qty is zero, the normal purchase tax amount shows zero instead of showing tax for one item.**
- **Scheme Qty tax can still be calculated when Scheme Qty is entered, even if Purchase Qty is zero.**

#### Guide
- **Open Purchase Add or Purchase Edit.**
- **Add a product that has tax selected and Selling Price Tax Type set to Inclusive on Selling Price.**
- **Enter Scheme Qty and select the Scheme Qty tax if needed.**
- **Check that the Scheme Qty tax is calculated from the selling price.**
- **If Purchase Qty is zero, check that the normal purchase tax amount remains zero.**

---

## Version 8.93.6

**Release Date:** 2026-08-01

---

### Module: Software Update

#### What Works Better Now
- **Only Admin users can run the software update.** Regular staff users cannot open or submit the update page.
- **Staff users can sign out from the update notice page.** If a staff user sees the update required message, they can click **Sign Out** and let an Admin user log in.
- **The update button refreshes saved website files more reliably.** When an Admin user clicks **I Understand, Update**, the browser is asked to clear old saved files for this website.
- **Users should see the latest screens after the update finishes.** This helps avoid old page files staying in the browser after new files are uploaded.

#### Guide
- **After uploading new files, log in as an Admin user.**
- **Open the software update page.**
- **Click I Understand, Update.**
- **Wait until the update finishes.**
- **Open the dashboard and check that the latest screen is showing.**

---

### Module: Products - Product Stock History

#### What Looks Clearer Now
- **Product Stock History now shows Profit and Total Profit after Sell Total.**
- **Profit is green when the sale makes profit and red when the sale makes loss.**
- **Total Profit shows the running sale profit balance.**
- **Purchase, Opening Stock, Stock Adjustment, and Stock Transfer rows do not show profit because these are stock movements, not completed sales profit.**
- **Opening Stock now uses the product selling price from the product page, so Sell Price and Sell Total are easier to understand.**
- **A help icon on Total Profit explains how the running total works.**

#### Guide
- **Open Products and go to Product Stock History.**
- **Check the Profit column to see profit or loss for each sale.**
- **Check Total Profit to see the running sale profit balance.**
- **Use the help icon beside Total Profit if you need a quick reminder.**

---

### Module: Reports - Opening Stock Report

#### What Users Can Do Now
- **Opening Stock Report now has a Reindex Stock Quantities button inside Report Filters.**
- **Users can reindex opening stock rows directly from the report.**
- **The reindex works only on the rows currently shown in the report table.**
- **Users can choose how many products to refresh at one time from Show entries.**
- **Up to 500 products can be refreshed in one run, helping the report stay easier to use.**
- **A progress bar shows the reindex progress while it is running.**
- **After reindexing finishes, the report refreshes so users can check the updated values.**

#### Guide
- **Go to Reports > Stock Reports > Opening Stock Report.**
- **Use Report Filters to select the required location, product, category, brand, or date range.**
- **Use Show entries to choose how many rows to reindex in one run.**
- **If the system is busy, choose a smaller number first.**
- **Click Reindex Stock Quantities.**
- **Wait until the progress bar finishes before changing filters or moving to another page.**
- **To reindex more rows, go to the next page of the report and click Reindex Stock Quantities again.**

---

### Module: Purchases - Product Prices

#### What Looks Clearer Now
- **Purchase Create and Purchase Edit pages can now show both Selling Price and Pack Price.**
- **Selling Price shows the price of one single base unit, such as one PCS.**
- **Pack Price shows the price of the selected pack or sub unit, such as 10 PCS.**
- **Pack Price is shown only when Enable inline selling price and Enable Sub Units are both turned on.**
- **If either setting is turned off, the Pack Price column stays hidden.**

#### Guide
- **Go to Business Settings and turn on Enable inline selling price.**
- **Turn on Enable Sub Units if your products use packs, cartons, boxes, or other related units.**
- **Open Purchase Create or Purchase Edit.**
- **Add a product that has related sub units.**
- **Select the required unit in the Qty column.**
- **Check Selling Price for the single unit price and Pack Price for the selected pack price.**

---

### Module: Product Notes - Report Filter

#### What Users Can Do Now
- **Users can filter Product Notes by supplier.**
- **The supplier filter uses the supplier selected on the product create or edit page.**
- **This makes it easier to find notes for products from one supplier.**

#### Guide
- **Go to Products > Products Note.**
- **Open the report filters.**
- **Select the required supplier.**
- **Click Apply Filters or wait for the list to refresh.**
- **Use Reset to clear the supplier filter when needed.**

---

### Module: Security Roles - Product Note Access

#### What Users Can Do Now
- **Product Note access can now be controlled separately from product access.**
- **Admins can allow a user to view, add, edit, or delete Product Notes.**
- **Users only see and use Product Note options allowed by their role.**

#### Guide
- **Go to User Management > Roles.**
- **Open Add Role or Edit Role.**
- **Open the Product tab.**
- **Find the Product Note section.**
- **Tick View, Add, Edit, or Delete as needed for that role.**
- **Save the role.**

---

### Module: POS - Product Notes

#### What Users Can Do Now
- **Cashiers can add a Product Note directly from the POS right-side menu.**
- **The Add Product Note option appears after Sale Return.**
- **Users can select a product, choose the note priority, write the note, and save it without leaving POS.**

#### Guide
- **Open POS.**
- **Open the right-side POS Menu.**
- **Click Add Product Note.**
- **Select the product.**
- **Choose the priority.**
- **Write the note and click Save.**

---

### Module: POS - Bill Printing

#### What Works Correctly Now
- **POS bill printing should no longer open a blank print preview after finalizing a sale.**
- **The system now keeps the bill print data ready until the print window has finished loading.**
- **Cashiers should be able to print the bill normally after finalizing a sale.**

#### Guide
- **Open POS and create a bill.**
- **Finalize the bill with printing.**
- **Wait for the print preview to load.**
- **Check that the bill details are visible before clicking Print.**

---

### Module: POS - Multi Payment

#### What Looks Clearer Now
- **Payment method buttons in the Multi Payment window now show with a clear blue color.**
- **Cashiers can more easily see and tap payment options such as Cash, Card, bank, or wallet payments.**

#### Guide
- **Open POS.**
- **Click Multi Pay.**
- **Check the payment method buttons on the left side of each payment row.**
- **Tap the required payment method button and enter the amount as usual.**

---

### Module: POS - Close Register

#### What Works Correctly Now
- **Total Cash now shows the same amount in Close Register and Register Details.**
- **Bank or other non-cash payments are no longer added into Total Cash.**
- **Cashiers can now close the register with the correct cash balance after deducting cash expenses.**
- **Close and Print now opens the closed register details and starts printing automatically.**
- **This helps avoid missing register closing printouts during shift closing.**

#### Guide
- **Open POS.**
- **Click Register Details to check Total Cash.**
- **Click Close Register.**
- **Check that Total Cash matches the cash balance shown in Register Details.**
- **Use Close and Print when you need the closing printout immediately.**
- **Wait for the print window to open before leaving the screen.**
- **Count the cash in the drawer and close the register as usual.**

---

### Module: POS - Cash Register Details

#### What Works Correctly Now
- **Net Difference now shows the correct sign when counted cash is short.**
- **If the drawer has less cash than expected, the Net Difference now stays negative.**
- **Cashiers can clearly see whether cash is short or extra after entering denominations.**
- **Bank transfer amount now shows in Register Details even if the bank transfer slip count is left as 0.**
- **Card slip amount also shows in Register Details even if the card slip count is left as 0.**

#### Guide
- **Open POS.**
- **Close the register and enter the cash denominations.**
- **Enter a bank transfer amount or card slip amount if needed.**
- **The slip count can stay 0 if there is no slip to count.**
- **Open Register Details after closing.**
- **Check that the entered amount is visible in the details.**
- **Check Cash Short or Cash Excess.**
- **Net Difference will now show the same direction as the cash difference.**

---

### Module: POS - Combo Products

#### What Works Correctly Now
- **Combo products can now be added on POS when Allow Sale if No Stock is turned on for the selected location.**
- **Cashiers should no longer see a wrong Product out of stock message for combo items when the branch is allowed to sell without stock.**
- **Combo items that have old or unavailable ingredients can still be added to the bill when the branch setting allows sale without stock.**

#### Guide
- **Go to Business Settings > Location Based Settings.**
- **Select the required location.**
- **Open the Sales tab.**
- **Tick Allow Sale if No Stock.**
- **Save the settings.**
- **Open POS for that location and add the combo product to the bill.**

---

### Module: Business Settings - POS Product Search

#### What Works Correctly Now
- **Disable product search on POS Screen now works separately for each location.**
- **One branch can hide the POS product search box while another branch can keep it visible.**
- **The saved setting is followed when users open the POS screen for that location.**

#### Guide
- **Go to Business Settings > Location Based Settings.**
- **Select the required location.**
- **Open the POS tab.**
- **Tick Disable product search on POS Screen if that location should not show the product search box.**
- **Untick it if that location should allow product search on POS.**
- **Save the settings.**
- **Open POS for that location and check that the product search box follows the selected setting.**

---

### Module: POS - Bill Save and Finalize

#### What Works Correctly Now
- **POS bills with combo or package items can now be saved without the screen getting stuck.**
- **Cashiers can save a large bill as Draft and continue it later.**
- **Bills with many items, such as long customer orders, can be protected by saving them as Draft before final payment.**
- **This helps avoid losing a punched bill when the cashier needs more time to complete payment.**

#### Guide
- **Open POS and add the customer items.**
- **If the bill is not ready for payment, click Draft.**
- **To continue the bill later, open Recent Transactions and select Draft.**
- **Open the draft bill, check the items, and complete payment when ready.**
- **If the bill is ready, use the normal payment option and save the invoice.**

---

### Module: POS - Two Decimal Currency Bills

#### What Works Correctly Now
- **POS bills now save correctly when Currency Decimals is set to 2 in Business Settings.**
- **Cashiers should no longer need to change Currency Decimals to 3 just to save a POS bill.**
- **The payable total shown on POS now matches correctly with the saved invoice total when using two decimal places.**
- **The invoice total mismatch warning no longer stops a cashier from saving a correct POS bill.**

#### Guide
- **Go to Business Settings > Business.**
- **Set Currency Decimals to 2.**
- **Save the settings.**
- **Open POS and create the bill normally.**
- **Check the Total Payable amount.**
- **Enter the payment and save the invoice.**
- **If the entered payment matches the payable amount, the bill should save normally.**

---

### Module: Business Settings - Ledger Date Range

#### What Works Correctly Now
- **The Ledger date range selected in Business Settings now saves properly.**
- **When users open a contact ledger, the date range starts with the saved Ledger option.**
- **Ledger date range options such as Today, This Year, Current Financial Year, and All Time now open correctly.**
- **Branch-based Ledger date range settings are followed when opening the ledger.**

#### Guide
- **Go to Business Settings > Date Range.**
- **Choose the required option for Ledger.**
- **Click Update Settings.**
- **Open a customer or supplier ledger.**
- **Check that the ledger date range opens with the saved Ledger option.**
- **Change the ledger date range anytime if you need to view another period.**

---

### Module: Business Settings - Stock Transfer

#### What Users Can Do Now
- **Stock Transfer settings can now be managed separately for each business location.**
- **Users can hide Stock Type and Select Category on the Stock Transfer screen when they are not needed for a location.**
- **Users can hide Demand Order on the Stock Transfer screen for locations that do not use demand orders.**
- **Users can hide Production (Manufacturing) on the Stock Transfer screen for locations that do not load items from production.**
- **This helps keep the Stock Transfer screen simpler for each location.**

#### Guide
- **Go to Business Settings.**
- **Open Location-based Settings.**
- **Select the required business location.**
- **Open the Stock Transfer tab.**
- **Tick the options you want to hide for that location.**
- **Save the settings.**
- **Open Stock Transfer and check that the selected options are hidden.**

---

### Module: Stock Transfers - Location Access

#### What Works Correctly Now
- **Add Stock Transfer and Edit Stock Transfer now follow the user's allowed locations.**
- **If a role is set to Own Location, the user will only see the locations selected for that user.**
- **If a role is set to All Locations, the user can select from all business locations.**
- **This helps staff transfer stock only between the branches they are allowed to use.**

#### Guide
- **Go to User Management > Users.**
- **Add or edit the user and select the locations this user can access.**
- **Go to User Management > Roles.**
- **Open the Stock Transfers tab.**
- **Choose Own Location if the user should only use their selected locations.**
- **Choose All Locations if the user should use every business location.**
- **Save the role and open Add Stock Transfer or Edit Stock Transfer with that user.**
- **The Location From and Location To lists should show only the locations allowed for that user.**

---

### Module: Security Roles - Project Expense Permissions

#### What Works Correctly Now
- **Project permissions are easier to review because they are grouped into clear sections.**
- **Project expenses now have their own role permissions inside the Project tab.**
- **Admins can separately allow Add Expense, Edit Expense, and Delete Expense for project work.**
- **Staff can be allowed to manage project expenses without giving them full expense access for all expenses.**

#### Guide
- **Go to Settings > Security Roles.**
- **Open Add Role or Edit Role.**
- **Open the Project tab.**
- **Find the Expenses section.**
- **Tick Add Expense, Edit Expense, or Delete Expense as needed for that role.**
- **Save the role.**
- **Open a project and check the Expenses tab to confirm the allowed actions are available.**

---

### Module: User Management - Security Roles

#### What Users Can See Now
- **Security Roles list now shows which users are assigned to each role.**
- **A new Users column appears before the Action column.**
- **If more than one user has the same role, their names are shown together, such as USER1, USER2, USER3.**
- **This makes it easier to check who is using each role before editing or deleting it.**

#### Guide
- **Go to User Management > Roles.**
- **Check the Users column beside each role.**
- **Use this column to see which users are assigned to that role.**
- **If the column is empty, no user is currently assigned to that role.**

---

### Module: POS Sales - Report Filter

#### What Works Correctly Now
- **Business Settings now has a separate date range option for the POS Sales list.**
- **The POS Sales report filter follows the POS Index date range selected in Business Settings.**
- **Users can still choose another date range when they need to check older POS sales.**
- **The Sales list date range now follows the Sales date range selected in Business Settings.**

#### Guide
- **Go to Business Settings > Date Range.**
- **Choose the needed date range for POS Index.**
- **Choose the needed date range for Sales.**
- **Save the settings.**
- **Open POS Sales or Sales.**
- **The list should open with the selected date range already applied.**

---

### Module: Foodpanda Integration

#### What Works Correctly Now
- **Foodpanda Integration is shown only when it is included in the business package.**
- **Businesses without Foodpanda Integration in their package will not see the Foodpanda menu or dashboard shortcut.**
- **This keeps the dashboard and menu cleaner for businesses that do not use Foodpanda.**

#### Guide
- **Go to Dashboard.**
- **Check the shortcut buttons shown near the top.**
- **Open the left menu and check Foodpanda Integration.**
- **If the business package includes Foodpanda Integration, the option will be available.**
- **If the package does not include Foodpanda Integration, the option will stay hidden.**

---

### Module: Subscription Packages - Custom Package Creation

#### What Works Correctly Now
- **A package without any extra module will be treated as a Standard Package.**
- **A package will be treated as an Advance Package only when an extra module is actually selected.**
- **Empty module selections are no longer counted as selected modules.**
- **This helps avoid a package showing as Advance when no extra module was chosen.**

#### Guide
- **Go to the package selection or subscription page.**
- **Select only the base software if no extra module is needed.**
- **Create the package.**
- **The package name should show as Standard Package when no extra module is selected.**
- **Select an extra module only when the business should receive that feature.**

---

### Module: Subscription Packages - Quantity Selection

#### What Works Correctly Now
- **Location, user, workstation, and warehouse quantities can be changed only with the plus and minus buttons.**
- **Users cannot type directly inside the quantity box.**
- **This helps prevent accidental wrong quantities while creating a package.**

#### Guide
- **Go to the package selection or subscription page.**
- **Use the plus button to increase the quantity.**
- **Use the minus button to decrease the quantity.**
- **Check the package summary before creating or subscribing to the package.**

---

### Module: POS Sales - List View

#### What Works Correctly Now
- **The POS Sales list shows correctly for admins and allowed users.**
- **The bottom POS Sales list is visible again on the POS Sales page.**
- **Recent Transactions on the POS screen now follows the user's POS Sales access.**
- **Users with View All POS sell can see all POS sales.**
- **Users with View Own POS sell can see only their own POS sales.**

#### Guide
- **Go to User Management > Roles.**
- **Open the POS tab for the required role.**
- **Choose either View All POS sell or View Own POS sell.**
- **Save the role.**
- **Open POS Sales and check the sales list at the bottom of the page.**
- **Open the POS screen and check Recent Transactions.**
- **The user should only see the sales allowed by the selected role option.**

---

### Module: Security Roles - POS Sales Access

#### What Works Correctly Now
- **The POS tab in Security Roles now has two clear choices for POS sale viewing.**
- **View All POS sell allows the user to see every POS sale.**
- **View Own POS sell allows the user to see only POS sales created by that user.**
- **Only one of these two choices can be selected at a time.**
- **When Select All is used, View All POS sell is selected automatically.**

#### Guide
- **Go to User Management > Roles.**
- **Add a new role or edit an existing role.**
- **Open the POS tab.**
- **Choose View All POS sell if the user should see all POS sales.**
- **Choose View Own POS sell if the user should see only their own POS sales.**
- **Save the role.**

---

### Module: POS Sales - Ref No

#### What Users Can See Now
- **POS sales are easier to identify from the Ref No column.**
- **If a POS sale has no other reference number, the Ref No column shows POS.**
- **If a POS sale has a token number or another reference number, it shows with POS first.** For example, users will see POS > 55, POS > DR01202600025, or POS > 254.
- **The sale details popup also shows the same POS reference.**
- **The sale details popup opens faster and shows the needed sale details.**

#### Guide
- **Go to POS Sales or Sales.**
- **Check the Ref No column.**
- **For a POS sale with token number 55, the Ref No should show POS > 55.**
- **Look for POS to quickly identify sales created from the POS screen.**
- **Open the sale details popup and check the Ref No there too.**

---

### Module: Products - Stock Quantity Report Tab

#### What Works Correctly Now
- **The Stock Quantity Report tab on the Products page now opens normally.** Users can view stock quantities without the page staying on Processing.
- **The report follows the selected product filters more completely.** Users can filter stock by product options such as category, sub-category, unit, tax, supplier, brand, gender, procurement source, and product type.
- **The stock report columns now match the enabled product settings.** Users only see the product grouping columns that are turned on for the business.

#### Guide
- **Go to Products.**
- **Open the Stock Quantity Report tab.**
- **Select the required filters from Report Filters.**
- **Check the stock quantity list after it loads.**

---

### Module: Products - Products Card Tab

#### What Works Correctly Now
- **Products Card tab is hidden when no variation template is available.** Users will only see this tab after at least one variation template has been created.
- **The Products page looks cleaner for businesses that do not use product variations.**

#### Guide
- **Go to Products.**
- **If no variation template exists, only the normal product list and allowed stock report tabs are shown.**
- **To use Products Card, first create a variation template from Products > Variations.**
- **Return to Products and the Products Card tab will be available.**

---

### Module: Products - PCT/HSN Code

#### What Works Correctly Now
- **PCT/HSN Code is hidden from the Product list when it is not enabled.** If the business has turned off Enable PCT/HSN Code, users will not see the PCT/HSN Code column on the Products page.
- **PCT/HSN Code options are hidden when the feature is off.** Users will not see Add PCT/HSN Code or Update PCT/HSN Code in product maintenance when the business does not use this code.
- **The Product list stays cleaner for businesses that do not need PCT/HSN Code.**

#### Guide
- **Go to Settings > Business Settings > Product.**
- **Turn Enable PCT/HSN Code on if the business needs to use PCT/HSN Code.**
- **Turn Enable PCT/HSN Code off if the business does not use it.**
- **Open Products.**
- **When the setting is off, the PCT/HSN Code column should not appear.**
- **When the setting is on, the PCT/HSN Code column and related product maintenance options should be available.**

---

### Module: Reports - Tax Report

#### What Users Can Do Now
- **Users can open a sale invoice directly from the Tax Collected tab.** Click the invoice number to preview the transaction.
- **Users can open a purchase transaction directly from the Tax Paid tab.** Click the transaction number to preview the purchase or purchase return.
- **Tax checking is faster because users do not need to leave the report to confirm invoice details.**

#### Guide
- **Go to Reports > Tax Report.**
- **Open the Tax Collected tab.**
- **Click an invoice number to preview the sale transaction.**
- **Open the Tax Paid tab.**
- **Click a transaction number to preview the purchase transaction.**
- **Close the preview to return to the tax report.**

---

### Module: Contacts - Login Access

#### What Works Correctly Now
- **Customer login fields stay closed until Allow Login is selected.**
- **Username and password boxes are only active when login access is allowed for that contact.**
- **The Save password message no longer appears when adding or editing a contact.** Users can save contact details without Chrome asking to save a password by mistake.
- **This helps users avoid entering login details by mistake when creating or editing contacts.**

#### Guide
- **Go to Contacts.**
- **Create a new contact or edit an existing contact.**
- **Tick Allow Login only when the contact should be able to log in.**
- **Enter the username and password after the login fields appear.**
- **Leave Allow Login unticked if the contact should not have login access.**
- **Save the contact.**
- **Chrome should no longer show the Save password message after saving the contact.**

---

### Module: Invoice Layout - Slim 3

#### What Works Correctly Now
- **Inline product tax total label now shows correctly on the printed invoice.** If a label is entered in the invoice layout, it appears in the product table and totals area.
- **Subtotal excluding tax label now shows correctly.** The subtotal excluding tax option in the layout is now reflected on the printed invoice.
- **FBR Digital Invoicing logo now appears correctly when previewing or printing invoices.**
- **Business name, address, and contact information are closer to the logo.** The top part of the invoice uses space better and avoids extra blank gaps.
- **FBR logo, QR code, invoice number, and date are placed more neatly on the right side.**
- **Invoice No. and Date are easier to read.** Their labels now stay close to their values.
- **Customer ID, NTN No., and Contact are shown in a cleaner order.** Customer ID and NTN No. appear before the contact number.
- **Product table columns are better aligned.** Quantity, price, tax, and total columns fit more neatly on the printout.
- **Tax total labels now use the tax name from Tax Rates.** The totals area now matches the tax names shown in the GST Summary.

#### What Users Can Do Now
- **Tax groups can be shown as separate product tax columns.** If a tax group has two or more taxes, each tax can be shown separately in the product table.
- **Tax group totals can also be shown separately.** Each tax from the tax group can appear as its own total in the invoice totals area.

#### Guide
- **Go to Settings > Invoice Settings > Layout.**
- **Open the Slim 3 invoice layout.**
- **Set the product tax labels as needed.**
- **Turn on Show Tax Group Columns Separately if you want each tax inside a tax group to show in its own column.**
- **Save the layout.**
- **Print or preview an invoice and check the product table, totals area, GST Summary, customer details, and FBR section.**

---

### Module: Sales and POS Sales Lists

#### What Works Correctly Now
- **FBR Invoice No. is hidden when the business does not use FBR POS or FBR DI.** Sales lists look cleaner for businesses that do not have these features in their package.
- **FBR Invoice No. still appears for businesses that use FBR POS or FBR DI.** Users can continue checking FBR invoice numbers from the Sales and POS Sales lists when the feature is available.
- **Sales list columns stay aligned after the FBR Invoice No. column is hidden.** Totals and table information remain easy to read.

#### Guide
- **Go to Sales > All Sales.**
- **Check whether FBR Invoice No. is shown after Invoice No.**
- **Go to POS Sales and check the same column.**
- **If the business package does not include FBR POS or FBR DI, this column should not appear.**
- **If the business package includes FBR POS or FBR DI, this column should remain visible.**

---

### Module: POS - Invoice Finalization

#### What Works Correctly Now
- **POS invoices with service charges can be finalized correctly.** If the bill total and payment total match, the invoice can be saved normally.
- **Invoices using tax and service charges no longer show a false total mismatch warning.** This helps cashiers complete the bill without changing the amount again and again.
- **Three-decimal totals are handled more clearly on POS payments.** Cashiers can save invoices where the shown payable amount uses three decimal places.

#### Guide
- **Open POS and add the sale items.**
- **Select the service charge if it applies.**
- **Open Multiple Pay or the normal payment option.**
- **Enter the payment amount shown in Total Payable.**
- **Click Save or Save and print.**
- **If the bill total and payment total are the same, the invoice should finalize normally.**

---

### Module: POS - PRA Submission

#### What Works Correctly Now
- **A saved invoice remains finalized even if PRA is not reachable at that moment.** The sale is not cancelled when PRA does not return an invoice number.
- **Cashiers see a clearer PRA pending message.** This tells the user that the sale was saved, but PRA submission still needs to be completed.
- **Pending PRA invoices can be submitted again later.** Users can retry PRA submission from the existing Sync PRA Sales option.

#### Guide
- **Finalize the POS invoice as usual.**
- **If a PRA pending message appears, do not create the same invoice again.**
- **Open the Sales list when the internet or PRA service is available.**
- **Click Sync PRA Sales.**
- **Check the invoice again and confirm the PRA invoice number appears.**

---

## Version 8.93.5 P1

**Release Date:** 2026-07-31

### Module: Delivery Notes - Due and Partial Invoice Control

#### What Users Can Do Now
- **Admins can control whether users may create delivery notes for due or partially paid invoices.**
- **A new role permission, Allow Due/Partial Invoice Delivery Note, is available in roles.**
- **Users without this permission can create delivery notes only for paid or overpaid invoices.**
- **If a user without permission tries to create a delivery note from a due or partial invoice, the system asks for approval.**
- **An Admin or a user with the new permission can approve the action and open the delivery note screen.**
- **The approval is used only for that selected invoice and is cleared after the delivery note is created.**

#### Guide
- **Go to User Management > Roles.**
- **Open Add Role or Edit Role.**
- **Find the Delivery Note permissions.**
- **Tick Allow Due/Partial Invoice Delivery Note only for users allowed to deliver unpaid or partially paid invoices.**
- **Save the role.**
- **Go to Sales and open the Actions menu for a final invoice.**
- **For paid invoices, click Create Delivery Note as usual.**
- **For due or partially paid invoices, complete the approval popup if the logged-in user does not have direct permission.**

---

## Version 8.93.5 P2

**Release Date:** 2026-07-31

### Module: Invoice Layout - Slim 3 Receipt

#### What Looks Clearer Now
- **FBR, FBR DI, PRA, and invoice QR codes now appear near the top of the Slim 3 receipt.**
- **The invoice heading has better spacing and a clearer font size.**
- **Customer details and invoice details are arranged side by side.**
- **Customer information, customer tax number, customer ID, reward points, and customer note are grouped together on the left side.**
- **Invoice number, date, reference number, due date, token number, sales person, workstation, commission agent, repair details, service staff, table, shipping fields, and sale order details are grouped on the right side.**
- **The business header aligns better when a logo is used.**
- **Footer barcode, footer logo, footer text, and branding still remain at the bottom of the receipt.**

#### Guide
- **Go to Settings > Invoice Settings > Layout.**
- **Open or select the Slim 3 receipt layout.**
- **Print or preview a sale invoice.**
- **Check that FBR/PRA information and QR codes appear near the top.**
- **Check that customer details appear on the left and invoice details appear on the right.**
- **Confirm that footer barcode, footer logo, footer text, and branding still show at the bottom when enabled.**

---

## Version 8.93.5

**Release Date:** 2026-07-31

---

### Module: POS - Security Role Permissions

#### What Users Can Do Now
- **Admins can choose who sees all POS sales and who sees only their own POS sales.**
- **The old View POS sell option is now named View All POS sell.** Use this when a user should see every POS sale allowed for their location access.
- **A new View Own POS sell option is available.** Use this when a user should only see POS sales made by that same user.
- **The POS Sales list follows the selected role permission.** Users with own access see only their own POS sales.
- **Recent Transactions on the POS screen also follows the selected role permission.** Users with own access see only their own recent POS transactions.

#### Guide
- **Go to User Management > Roles.**
- **Create a new role or edit an existing role.**
- **Open the POS tab.**
- **Select View All POS sell if the user should see all POS sales.**
- **Select View Own POS sell if the user should see only their own POS sales.**
- **Save the role.**
- **Log in as that user and open POS Sales or Recent Transactions on POS to confirm the correct sales are shown.**

---

### Module: Software Update

#### What Works Correctly Now
- **The software update page handles pending update work more reliably.** Admins can use the normal update page even when several update steps are waiting.
- **Admins are guided to the update page after login when an update is waiting.** This helps them finish the update before opening the dashboard.
- **Admins can finish the waiting update work from the normal update page after uploading new files.**
- **The system should open normally after the update finishes.** This helps avoid the error page that could appear before the update was completed.

#### Guide
- **After uploading new files, log in to the software.**
- **If the software asks for an update, open or continue to the software update page.**
- **Click I Understand, Update.**
- **Wait until the update finishes.**
- **Log in again if the software asks you to.**
- **Open the main dashboard and check that the software opens normally.**

---

### Module: Sales - Invoice Location

#### What Users Can Do Now
- **Invoice location can be changed from the Sales list.** If a business has more than one location, allowed users can change a sale invoice from one location to another.
- **Paid and partially paid invoices can also be moved.** Users can choose to move existing payments to the new location when changing the invoice location.
- **Only permitted users can use this option.** The option can be enabled or disabled from the security role settings.
- **Location changes are recorded for checking later.** Users can review the change in the Activity Log report.

#### Guide
- **Go to User Management > Roles.**
- **Open the role you want to allow.**
- **Tick Change sell location under the sales permissions.**
- **Save the role.**
- **Go to Sales.**
- **Open the Actions menu for the invoice.**
- **Click Change sale location.**
- **Choose the new location.**
- **For paid or partially paid invoices, keep Move existing payments to the new location selected if the payments should follow the invoice.**
- **Click Update.**
- **Go to Reports > Activity Log and choose Sale location changed from the Action filter to review the change.**

---

### Module: Backup - Google Drive

#### What Works Correctly Now
- **Create Backup now works from the Google Drive Backup page.** Users can create a new backup from **Backup > Google Drive** without seeing the Method Not Allowed error.
- **Backup creation now works from both backup pages.** Users can use either **Backup > Create New Backup** or **Backup > Google Drive > Create Backup**.

#### Guide
- **Go to Backup > Google Drive.**
- **Click Create Backup.**
- **Wait for the backup to finish.**
- **Check the Backup Files list to confirm the new backup appears.**
- **If Google Drive is connected, use the sync option when you want to send the backup to Google Drive.**

---

### Module: Products - Image Gallery

#### What Users Can Do Now
- **Images can be linked to products by SKU.** If image names match product SKUs, users can link them to the correct products more quickly.
- **Old single-image names can also be linked.** If the product SKU is `3265`, an image named `3265` can be linked as that product's main image.
- **Numbered image names can be linked as main and gallery images.** If the product SKU is `3265`, `3265_1` can be linked as the main image and `3265_2` can be linked as a gallery image.
- **Selected images can be linked to one SKU.** Users can select images, enter the product SKU, and link those images to that product.
- **Main image and extra gallery images are handled more clearly.** The first image can become the main product image, and the next images can be added as gallery images.
- **A result message is shown after linking.** Users can see how many images were linked, already linked, skipped, or not matched.

#### Guide
- **Go to Products > Image Gallery.**
- **Use Link Images By SKU if image filenames already match product SKUs.** For example, use this when files are named like `3265`, `3265_1`, or `3265_2`.
- **Use a plain SKU filename for one old image.** For example, `3265` can become the main image for product SKU `3265`.
- **Use numbered SKU filenames for more than one image.** For example, `3265_1` can become the main image and `3265_2` can become a gallery image.
- **For selected images, tick the images you want to link.**
- **Enter the product SKU in the SKU box.**
- **Click Link To SKU.**
- **Read the result message after the action finishes.**
- **Open the product edit page to confirm the main image and gallery images are correct.**

---

### Module: Website Home Page

#### What Works Correctly Now
- **The website home page opens more safely when content is missing.** If the home page title, text, image, or page details have not been set yet, the page can still open.
- **Visitors should see a cleaner fallback instead of a broken page.** This helps new or partially configured websites stay viewable.

#### Guide
- **Go to the website home page.**
- **Check that the page opens normally.**
- **If the home page text or image is missing, update it from the CMS page settings.**
- **Refresh the website and confirm the updated content appears.**

---

### Module: WooCommerce

#### What Works Correctly Now
- **WooCommerce setup and updates are smoother.** When WooCommerce is enabled but setup is not fully ready yet, the system avoids showing setup-related errors to users.
- **Connected stores continue to work after setup is complete.** Users can keep using WooCommerce normally once the store settings are available.

#### Guide
- **Go to WooCommerce only after the business setup is complete.**
- **Open the WooCommerce connection or settings page.**
- **Confirm the store connection details are saved.**
- **Use the WooCommerce sync options as usual.**

---

## Version 8.93.4 P1

**Release Date:** 2026-07-30

### Module: Delivery Notes

#### What Users Can Do Now
- **Delivery Notes can now be managed from the Sales menu when Delivery Notes are enabled in business settings.**
- **Users can create delivery notes from final sale invoices.**
- **Delivery note numbers can be entered manually or generated automatically with the DN prefix.**
- **Customer name and shipping address are filled from the sale/contact when available.**
- **Users can enter delivered quantities for each sale item.**
- **The system checks delivered quantity against the remaining balance quantity.**
- **Delivery notes can be viewed, edited, deleted, and printed based on role permissions.**
- **The delivery note print view now shows business details, location details, customer details, shipping details, product lines, delivered quantities, and signature areas.**

#### What Works Correctly Now
- **Users cannot deliver more quantity than the invoice balance quantity.**
- **Pending delivery notes can still have quantities edited.**
- **Processed delivery notes cannot be changed back to Pending.**
- **Quantities on processed delivery notes are protected from editing.**
- **Stock held quantity is reduced when a delivery note is processed and adjusted safely when the note is updated or deleted.**
- **The old Shipments menu is hidden when Delivery Notes are enabled, so users have one clear delivery workflow.**

#### Guide
- **Go to Business Settings and enable Delivery Notes if this option is used by the business.**
- **Go to User Management > Roles.**
- **Open Add Role or Edit Role.**
- **Under Delivery Note, allow Access, Create, Edit, or Delete as needed.**
- **Go to Sales > Delivery Notes to see the delivery note list.**
- **Click Add or use Create Delivery Note from a sale invoice action menu.**
- **Select the invoice, enter delivered quantities, shipping address, delivered-to name, and status.**
- **Save the delivery note.**
- **Use View to print the delivery note when needed.**

---

## Version 8.93.4

**Release Date:** 2026-07-29

---

### Module: Dashboard

#### What Is Faster Now
- **Dashboard opens faster after login.** The main dashboard cards and charts should become ready more quickly.
- **The Processing message should stay for less time.** Users can start checking daily sales, revenue, purchases, and business insights sooner.
- **Dashboard information still follows the selected date and location filters.** Users can keep using the same filters as before.

#### Guide
- **Go to Dashboard.**
- **Wait for the dashboard cards and charts to load.**
- **Use the date range or location filter if you want to check a specific day, branch, or period.**
- **Refresh the page if old loading results were already open before the update.**

---

### Module: Sales List

#### What Is Faster Now
- **Sales list opens faster.** The Sales page now starts with today's sales, so users do not have to wait for a full year of records to load first.
- **Users can still view older sales when needed.** The date range can be changed from today's sales to any required period.
- **Searching and checking recent sales is easier.** The page becomes ready sooner for daily work.

#### Guide
- **Go to Sales.**
- **The list opens with today's sales by default.**
- **Change the Date Range if you need to view this month, this year, or any older sales.**
- **Use Search or other filters after the list is loaded.**

---

### Module: Superadmin - All Businesses

#### What Is Faster Now
- **All Businesses opens faster for Superadmin users.**
- **Business date filters respond more quickly.** Superadmin can check businesses with or without transaction activity without long waiting.
- **The business list remains easier to use when many records are available.**

#### Guide
- **Go to Superadmin > All Businesses.**
- **Open Report Filters if you want to narrow the list.**
- **Use the transaction date filter when you want to find businesses by activity.**
- **Review the filtered business list after it refreshes.**

---

### Module: Users List

#### What Users Can Do Now
- **Users List now has Report Filters like other reports.** Users can filter the list more easily from the top of the page.
- **Users can filter by business location.** The location filter starts with All locations selected.
- **Users can search by username or employee name.** This helps find a specific user or employee faster.
- **Users can choose whether to view Users or Employees.** This makes the list easier to review when the business has both login users and employees.

#### Guide
- **Go to Users.**
- **Open Report Filters.**
- **Choose a Business Location if you want to see users for one location only.**
- **Leave Business Location as All locations if you want to see every location you can access.**
- **Enter a username or employee name if you want to find one person.**
- **Choose Users or Employees from Type if you want to view only one group.**

---

### Module: Register Report

#### What Users Can Do Now
- **Register Report now has a Business Location filter.** Users can view register records for one location or all locations.
- **The location filter starts with All locations selected.** Users can keep the full report view unless they want to narrow it down.
- **Location filtering works with the existing report filters.** Users can combine location with user, status, and date range.

#### Guide
- **Go to Reports > Register Report.**
- **Open Report Filters.**
- **Choose a Business Location if you want to check one location only.**
- **Leave Business Location as All locations if you want to see all locations you can access.**
- **Select User, Status, or Date Range if needed.**
- **Review the Register Report table after the filters refresh.**

---

### Module: POS - Cash Register Details

#### What Works Correctly Now
- **Details of products sold now shows the correct products for the current cash register.** Cashiers can check the sold item list from the register details window and see the products sold during that register opening.
- **Sold quantities now match the register session more closely.** The product quantity list follows the cash register opening time until the current time or closing time.
- **Credit sales are also included in the sold product details.** If a sale was saved as due during the register session, its products are still shown in the sold item list.
- **Product variation names are shown clearly.** Variable products show their variation details in the sold item list.

#### Guide
- **Open the POS screen.**
- **Open the Cash Register details window.**
- **Go to Details of products sold.**
- **Check the products, quantities, and amounts sold during the current register session.**
- **For a closed register, open the register details and review the sold product list for that register.**

---

### Module: Products - Related Sub Units

#### What Works Correctly Now
- **Related Sub Units keep the correct order after Excel export and import.** If Pack Size is selected before Base Unit on the product page, the same order stays after downloading and uploading the product Excel sheet.
- **Products that already showed the wrong order can be corrected.** Items that changed to Base Unit first after an earlier Excel import can be fixed so Pack Size appears first again.
- **Product unit selection is clearer for daily use.** Users can open the product edit page and see the expected Related Sub Units order.

#### Guide
- **Go to Products and edit the required product.**
- **Check the Related Sub Units field.**
- **If Pack Size should be used first, confirm it appears before Base Unit.**
- **If the order is wrong on old products, ask the admin to run the correction for affected products.**
- **After correction, download and reimport the product Excel sheet only if another product update is needed.**
- **Open the product again and confirm the Related Sub Units order is still correct.**

---

### Module: Shopify

#### What Works Correctly Now
- **Shopify setup now shows the correct application name and title.** The Add Shopify Connection page first uses the name and title saved in Application Settings. If those settings are not available, it uses the application name and title saved in the system file.

#### Guide
- **Go to Shopify > Connections.**
- **Click Add Connection.**
- **Check the Simple idea note and setup instructions.**
- **Confirm the page shows the correct application name and title.**
- **If the name or title is not correct, ask the admin to update it from Superadmin > Settings > Application Settings.**

---

### Module: Products - Product Images

#### What Users Can Do Now
- **Product images are easier to organise.** When product images are added or updated, the image names can follow the product SKU, such as `3465_1`, `3465_2`, and `3465_3`.
- **A product can have one main image and extra gallery images.** The main image is used as the featured product image, and the extra images appear in the product gallery.
- **Gallery images can be made the main image.** On the Edit Product page, users can click **Make featured** on a gallery image.
- **Deleting a gallery image removes it properly.** If a user deletes a gallery image from the Product Image Gallery or from the Edit Product page, the image is removed from the product and from the image folder.
- **Product images stay inside the correct business image area.** Images for one business are kept separate from other businesses.

#### Guide
- **Go to Products.**
- **Add a new product or edit an existing product.**
- **Choose a Product image if you want to set the main product image.**
- **Choose Product gallery images if you want to add extra images for a single product.**
- **Click Save or Update.**
- **Open the product view to check the main image and gallery images.**
- **On the Edit Product page, click Make featured if one of the gallery images should become the main image.**
- **Click the red delete button on a gallery image if you want to remove it.**

---

### Module: Products - Image Gallery

#### What Users Can Do Now
- **Businesses can view product images in one gallery screen.** Users can see how many product images are available for the current business.
- **The gallery shows main product images and extra product gallery images.**
- **Users can upload images from the gallery screen.**
- **Users can select multiple images and delete them together.**
- **The search box now searches while typing.** Users no longer need to click the search button every time.
- **Image labels show whether an image is linked to a product or is not linked.**

#### Guide
- **Go to Products > Image Gallery.**
- **Type in the Search filename box to find an image.**
- **Wait a short moment after typing and the gallery will refresh automatically.**
- **Use Upload Images if you want to add image files to the business gallery.**
- **Tick one or more images if you want to delete them.**
- **Click Delete Selected to remove the selected images.**
- **Check the labels under each image to see whether it is linked to a product or not linked.**

---

### Module: Superadmin - Maintenance Tools

#### What Superadmin Can Do Now
- **Fix Uploads Folder can move old uploaded files into the correct business folders.** This helps keep business files organised.
- **Fix Default Product Image Repeats can correct products that were using repeated or missing default images.**
- **Rename Product Images By SKU can rename existing product images using the product SKU style.** This helps old images follow the same naming style as new product images.
- **The maintenance tools show a result after running.** Superadmin can review how many items were checked, fixed, skipped, or already correct.

#### Guide
- **Go to Superadmin > Settings.**
- **Open the Maintenance Tools tab.**
- **Click Fix Uploads Folder if old uploaded files need to be moved into the correct business folders.**
- **Click Fix Default Product Image Repeats if products are showing repeated or missing default images.**
- **Click Rename Product Images By SKU if existing product images need SKU-style names.**
- **Read the result message after the tool finishes.**
- **Test with a few products first before running a large cleanup on live data.**

---

## Version 8.93.3

**Release Date:** 2026-07-28

---

### Module: Shopify

#### What Users Can Do Now
- **Shopify setup is easier to understand.** The Add Shopify Connection page now explains the connection in simple words, so users can see which option to use before connecting a store.
- **Users can choose between Easy Connection and Manual Token Connection.** Easy Connection is for stores that can approve access through Shopify. Manual Token Connection is for users who already have manual connection details from Shopify.
- **The connection page now shows simple step-by-step instructions.** Users can follow the guide on the page without needing separate technical notes.
- **Helpful setup URLs are shown on the page.** Users can copy the App URL, Redirect URL, and Webhook URL when Shopify asks for them during setup.
- **Manual token users can test the connection before saving.** This helps confirm that the store name and token are correct.
- **Shopify Products, Orders, and Customers pages are now available from the Shopify menu.** Users can open these pages to review information imported from Shopify.
- **Shopify order details can be reviewed more clearly.** Users can open an order, view its line items, and convert it into a POS sale when the products are matched.
- **Shopify product details can be reviewed more clearly.** Users can open a product and check its variants, SKU, price, cost, stock, and barcode.
- **Shopify customer details can be reviewed more clearly.** Users can open a customer and check their contact information, order count, and order history.
- **Product mapping is easier to check.** Users can see the Shopify product, variant, and inventory item references in one place.
- **Shopify syncing is more reliable for normal store data.** Products, orders, and customers with some missing optional details are less likely to stop the sync.
- **Shopify app uninstall is handled more cleanly.** If the app is removed from Shopify, the store connection is marked inactive.

#### Guide
- **Go to Shopify > Connections.**
- **Click Add Connection.**
- **Read the Simple idea note at the top of the page.**
- **Use Easy Connection if you want Shopify to ask for approval and return you back to the application automatically.**
- **Enter your Shopify store address, such as `abc-fashion.myshopify.com`.**
- **Click Start Easy Connection.**
- **Approve the connection in Shopify when Shopify opens.**
- **Use Manual Token Connection only if you already have the required manual connection details from Shopify.**
- **For manual connection, enter the store name, paste the connection key, and keep the suggested version selected unless advised otherwise.**
- **Click Test Connection before saving a manual token connection.**
- **After the store is connected, go to Shopify > Products, Shopify > Orders, or Shopify > Customers to review imported Shopify data.**
- **Go to Shopify > Mappings > Products if you need to match POS products with Shopify products before pushing stock or converting orders.**
- **Open a Shopify order and use Convert to POS Sale only after the order products are matched with POS products.**

---

## Version 8.93.2

**Release Date:** 2026-07-27

---

### Module: POS - Shipping Charges

#### What Is Easier Now
- **Shipping charges can now be entered from the POS footer.** When Disable Shipping is unticked in Business Settings, the POS screen shows Shipping with an edit option.
- **Cashiers can click the edit option beside Shipping to add or change shipping charges.**
- **The entered shipping charge is included in the POS total.**
- **If Disable Shipping is ticked, the shipping option stays hidden from POS as expected.**

#### Guide
- **Go to Settings > Business Settings.**
- **Open the POS tab.**
- **Untick Disable Shipping if shipping charges should be used on POS.**
- **Save the settings.**
- **Open the POS screen.**
- **Add products to the bill.**
- **In the footer, click the edit option beside Shipping.**
- **Enter the shipping charge and update.**
- **Check that the Shipping amount and Total are updated on the POS screen.**

---

### Module: Dashboard - Add New Contact

#### What Works Correctly Now
- **Add a new contact now opens properly from the Dashboard.** When users click Add a new contact, the contact window stays clearly in front and can be filled normally.
- **The contact form buttons are easier to use.** Save, Close, and other contact form options are no longer hidden behind the page shade.

#### Guide
- **Go to Dashboard.**
- **Click Add a new contact.**
- **Fill in the contact details.**
- **Click Save to add the contact, or Close to return to the Dashboard.**

---

### Module: Products - Excel Import and Export

#### What Works Correctly Now
- **Related Sub Units keep the same order after Excel export and reimport.** If Pack Size is selected before Base Unit on the product page, the same order is kept after downloading the product Excel sheet and uploading it again.
- **Product unit selection is easier to trust after reimport.** The Related Sub Units field no longer changes the selected order unexpectedly.
- **Already affected products can be corrected.** Products that were reimported earlier and now show Base Unit before Pack Size can be repaired so the preferred order appears again.

#### Guide
- **Open the product edit page and check Related Sub Units.**
- **If Pack Size should be used first, make sure Pack Size appears before Base Unit.**
- **Download the product Excel sheet if you need to update products in bulk.**
- **Upload the edited Excel sheet again.**
- **Open the product again and confirm the Related Sub Units order is still the same.**
- **For products already showing the wrong order, ask the system admin to run the repair for affected products.**

---

### Module: Units - Number of Products

#### What Users Can See Now
- **Units list now shows Number of products after Allow decimal.** Users can quickly see how many products are using each unit.
- **Related Sub Units are also counted.** If a product uses a unit in Related Sub Units, that product is included in the unit's product count.
- **The count is easier to check from one place.** Users do not need to open each product one by one to confirm which units are being used.

#### Guide
- **Go to Units.**
- **Check the Number of products column after Allow decimal.**
- **Open any product edit page if you want to confirm the product's Unit and Related Sub Units.**
- **If a unit is selected in Related Sub Units, that product should be included in the unit's Number of products.**

---

## Version 8.93.1

**Release Date:** 2026-07-24

---

### Module: Accounting - Business Location Payment Options

#### What Works Correctly Now
- **Default Account dropdown now shows only the correct Chart of Accounts entries.** If only one account is available, such as MEEZAN BANK 1, the Business Location payment options will no longer show an extra old account name.
- **Payment method account selection is now easier to trust.** Users can select the default account without seeing duplicate or unwanted account names.

#### Guide
- **Go to Business Settings > Business Locations.**
- **Edit the required business location.**
- **Open Payment Options.**
- **Check the Default Account dropdown for each payment method.**
- **Select the correct account and save.**
- **If an account should not be used, make sure it is not selected in the payment method settings.**

---

### Module: Accounting - Transactions and Cash Flow Report

#### What Works Correctly Now
- **Cash Flow Report now keeps the correct cash balance after Remap Defaults.** When users remap all Accounting Transactions tabs, Cash in Hand no longer changes incorrectly because of the same payment being counted again.
- **Contact Payments now show the correct final cash effect.** If a Contact Payment includes amounts that cancel each other, the Cash Flow Report shows the net amount instead of adding both sides.
- **Zero-value Contact Payments now stay zero in Cash Flow.** For example, if one line is 200,000.00 and another line is -200,000.00, Cash in Hand shows 0.00 effect.
- **Advance Deposits now follow the correct cash direction.** Customer and supplier advance deposit payments now increase or decrease Cash in Hand correctly after remapping.
- **The Accounting Transactions tabs are now arranged in a better remapping order.** This helps users remap step by step in the order that is easier to understand.
- **Contact Payments should be remapped at the end.** This helps avoid confusion because Contact Payments can be linked with other payment tabs.

#### Guide
- **Go to Accounting > Transactions.**
- **When remapping all tabs, follow the tabs from left to right.**
- **Start with Opening Balance and Opening Stock.**
- **Remap Purchases and Purchase Return before Sales and Sale Returns.**
- **Remap payment tabs after the main transaction tabs.**
- **Remap Contact Payments last.**
- **After remapping, go to Accounting > Reports > Cash Flow Report.**
- **Select the Cash in Hand account and the required date range.**
- **Check that the Closing Balance matches the expected cash balance.**
- **For Contact Payments, open the payment preview if needed and compare the final amount with Cash Flow.**

---

### Module: Manufacturing - Production

#### What Works Correctly Now
- **Ingredient cost is now picked correctly on Production Create.** When users select a location and production product, the ingredient total uses the correct available stock cost for that selected location.
- **This applies to all production products and ingredients.** If an ingredient has more than one stock cost available, the production page now picks the correct cost in stock order.
- **Production cost now matches the product stock history more closely.** Users can compare an ingredient's cost with Product History for the same location and see the expected cost on the production page.
- **Manually added ingredients also follow the same cost rule.** Ingredients added from the Select Ingredient field use the correct cost for the selected location.

#### Guide
- **Go to Manufacturing > Production > Add.**
- **Select the required Location.**
- **Select the production Product.**
- **Check the Ingredients table.**
- **Review the Total Price for each ingredient.**
- **If needed, open the ingredient's Product History for the same location and compare the cost.**
- **Add any extra ingredient if required. Its cost should also follow the selected location's available stock cost.**

---

### Module: Products

#### What Users Can Do Now
- **PCT/HSN Code can now be added to selected products from Stock Maintenance.** Users can select products from the Product list, open Stock Maintenance, choose Add PCT/HSN Code, enter the code, and apply it.
- **Add PCT/HSN Code only fills products where the code is missing.** Products that already have a PCT/HSN Code are not changed.
- **Products with PCT/HSN Code saved as 0 are treated as missing.** If a selected product only has `0` saved in PCT/HSN Code, Add PCT/HSN Code will replace it with the entered code.
- **PCT/HSN Code can also be updated for all selected products.** Users can choose Update PCT/HSN Code when they want the entered code to replace the code on every selected product.
- **Product list now shows PCT/HSN Code after Tax.** Users can quickly check each product's PCT/HSN Code directly from the Product list.

#### Guide
- **Go to Products.**
- **Select the products you want to change.**
- **Click Stock Maintenance.**
- **Choose Add PCT/HSN Code if you only want to fill missing codes.**
- **Enter the PCT/HSN Code and click Apply.**
- **Choose Update PCT/HSN Code if you want to replace the code on all selected products.**
- **Enter the PCT/HSN Code and click Apply.**
- **Check the selected products to confirm the PCT/HSN Code is updated as needed.**
- **Review the Product list after Tax to see the PCT/HSN Code for each product.**

---

### Module: Stock Quantity Report

#### What Users Can Do Now
- **Stock Quantity Report now shows product grouping columns based on Business Settings.** Users can see Category, Sub-Category, Sub2-Category, Brand, Sub Brand, Gender, Sub Gender, Procurement Source, and Sub Procurement Source when those options are enabled from Business Settings > Product.
- **Only enabled product options are shown in the report.** If a product option is turned off in Business Settings, its column is not shown in the Stock Quantity Report.
- **Sub option filters follow the business settings.** Sub Brand, Sub Gender, and Sub Procurement Source filters appear only when their matching sub option is enabled.
- **Column Visibility includes the new product grouping columns.** Users can hide or show these columns from the report column visibility settings.

#### Guide
- **Go to Settings > Business Settings > Product.**
- **Turn on the product options the business uses, such as Categories, Sub-Categories, Sub2-Categories, Brands, Sub Brands, Gender, Sub Gender, Procurement Source, and Sub Procurement Source.**
- **Save the business settings.**
- **Go to Reports > Stock Reports > Stock Quantity Report.**
- **Check the Details table. The enabled product grouping columns should be visible.**
- **Use the report filters to narrow the stock list by the enabled product options.**
- **Go to Column Visibility if you want to hide or show any of these columns for your own view.**

---

### Module: Purchase

#### What Users Can Do Now
- **Scheme Quantity can now have its own tax in Purchase Add and Edit.** Users can select tax for Scheme Quantity from the new Tax column shown after Scheme Qty.
- **Scheme Quantity tax is included in the final payable amount.** When Scheme Qty is entered, its tax is counted in Scheme Tax, Total After Tax, and Net Total Amount.
- **Purchase totals now show Scheme Quantity separately.** Users can see Scheme Quantity below Total Quantity.
- **Purchase totals now show Scheme Tax separately.** Users can see Scheme Tax below Total Tax.
- **Product tax is selected automatically when adding products.** If tax is selected in the product setup, it is picked automatically when the product is added on purchase and sale screens.
- **Scheme Quantity tax also follows the product's selected tax.** When a product is added in purchase, the Scheme Qty Tax is selected automatically from the product setup.
- **Tax can be applied to all Scheme Qty lines at once.** Users can click the Scheme Qty Tax heading and choose one tax to apply to all product rows.
- **Scheme Qty Tax follows the Purchase tax setting.** The Scheme Qty Tax column appears only when the normal purchase tax columns are enabled from Business Settings > Purchase.
- **Scheme Qty Tax is included in Paid Tax reports.** Users can see the Scheme Qty Tax amount counted in Reports > Tax Report > Paid Tax.
- **Scheme Qty Tax is included in Accounting reports.** Purchase tax amounts, including Scheme Qty Tax, are counted in Accounting > Trial Balance when purchase tax is mapped in Accounting settings.
- **Purchase product totals are cleaner.** Extra currency symbols have been removed from the product totals area.

#### Guide
- **Go to Settings > Business Settings > Purchase.**
- **Turn on Enable Inline Tax in purchase if purchase tax columns should be shown.**
- **Turn on Scheme Quantity if Scheme Qty should be used in purchase.**
- **Open Purchase Add or Purchase Edit.**
- **Add a product.**
- **Check the Tax column after Scheme Qty. It should appear when purchase tax columns are enabled.**
- **Enter Scheme Qty and select the required Scheme Qty Tax if needed.**
- **Check Total Quantity, Scheme Quantity, Total Tax, Scheme Tax, Total After Tax, and Net Total Amount.**
- **Click the Scheme Qty Tax heading if you want to apply the same scheme tax to all product rows.**
- **Go to Reports > Tax Report and check Paid Tax. Scheme Qty Tax should be included.**
- **Go to Accounting > Trial Balance and check the mapped purchase tax account. Scheme Qty Tax should be included there too.**
- **Review the product totals area. Amounts should be easier to read without repeated currency symbols.**

---

### Module: Contact Ledger

#### What Users Can Do Now
- **Column Visibility is now available on all Contact Ledger formats.** Users can hide or show ledger columns in Format 1, Format 2, Format 3, Format 4, Format 5, and Format 6.
- **Column choices are remembered separately for each ledger format.** Users can keep different visible columns for different ledger formats.
- **The Transaction No heading is now shown as Number.** This shorter heading is used in all Contact Ledger formats.
- **The Description column is easier to read.** Long description details now stay inside a fixed-width column and wrap onto the next line instead of making the table too wide.
- **Downloaded ledger PDFs are neater.** The ledger title, generated date, Total label, and total amounts are aligned to the right side for easier reading.
- **The Hide Account Summary on Ledger checkbox is now available on the other ledger formats that show Account Summary.** Users can hide the Account Summary directly from the ledger screen.
- **The Hide Account Summary checkbox follows the saved business setting by default.** If the business setting is already enabled, the checkbox is selected and the Account Summary is hidden when the ledger opens.
- **Long invoice and payment numbers are easier to read.** Numbers such as `PI012026-000116` and `CP2026/0926` now split onto two lines in the Number column.
- **Brought Forward is easier to read in narrow ledger columns.** It now appears on two lines where needed.
- **Contact Ledger PDF now uses the page space better.** Ledger rows are less likely to move to the next page while empty space is still available.
- **Portrait and Landscape ledger PDFs are cleaner.** Users can download the ledger PDF in either page direction with better row spacing.
- **Ageing totals stay with the ledger when there is room.** In Portrait PDF, the ageing totals no longer move to a new page unnecessarily when space is available below the ledger totals.
- **Ledger PDF page numbers are easier to trust.** The page number shown in the PDF matches the actual pages in the downloaded file.
- **Each ledger format can now be marked as default.** Users can tick Is Default under the format they want to open automatically.
- **Default ledger format is saved separately for customers, suppliers, and barterers.** For example, customers can open with Format 2, suppliers with Format 5, and barterers with Format 3.
- **The ledger opens with the correct default format automatically.** When a supplier ledger is opened, the supplier default format is selected by itself. Customer and barterer ledgers work the same way.

#### Guide
- **Open a contact.**
- **Go to the Ledger tab.**
- **Choose the required ledger format.**
- **Tick Is Default under that format if you want this type of contact to open with the same format next time.**
- **Set defaults separately from a customer, supplier, and barterer ledger if each type should use a different format.**
- **Reopen the ledger and check that the saved default format opens automatically.**
- **Click Column Visibility to hide or show columns for that format.**
- **Check the Number column. It should show the shorter Number heading.**
- **Review the Description column. Long details should wrap neatly inside the column.**
- **Download the ledger PDF and check the heading and total row. They should line up neatly on the right side.**
- **Tick Hide Account Summary on Ledger if you do not want to show the Account Summary.**
- **Untick Hide Account Summary on Ledger if you want to show it again.**
- **Review the Number and Type columns. Long numbers and Brought Forward should now fit more neatly.**
- **Click Print A4 and choose Portrait or Landscape as needed.**
- **Click PDF from the print preview to download the ledger copy.**
- **Check that ledger rows, footer totals, ageing totals, and page numbers appear neatly on the PDF pages.**

---

### Module: Invoice Layout - Header Settings

#### What Works Correctly Now
- **Logo and Header Text are now shown in Layout Header settings.** When users add or edit an invoice layout, the Invoice Logo, Show Logo, and Header Text options are visible under 2 - Layout Header to be shown.
- **Letterhead no longer hides the normal header options.** Users can still choose a letterhead, and they can also review or change the logo and header text from the same page.
- **The logo preview is shown in the correct place.** When users select an invoice logo, they can see the preview while setting up the layout.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new invoice layout or edit an existing one.**
- **Open 2 - Layout Header to be shown.**
- **Check that Invoice Logo, Show Logo, and Header Text are visible.**
- **Tick Show letter head only if you want to use a full letterhead image.**
- **Upload or change the invoice logo if needed.**
- **Enter or update the Header Text if needed.**
- **Save the invoice layout and print or preview an invoice to check the header.**

---

### Module: Software Update - Security Roles

#### What Works Correctly Now
- **Staff security roles continue working after a software update.** Users who are not Admin should keep their allowed menus and actions after the update is completed.
- **Security Role options stay available for staff access setup.** The Users and Security Roles permissions remain available when creating or editing a role.
- **Admins can run the normal update page to repair missing role options.** If the role options were missing after a previous update, running the update again restores them without changing the saved role choices.
- **Admin access is unchanged.** Admin users can continue opening the system as before.

#### Guide
- **Log in as an Admin user.**
- **Open the software update page.**
- **Click I Understand, Update.**
- **Wait until the update finishes.**
- **Go to Settings > Security Roles.**
- **Open a non-admin role, such as Cashier or another staff role.**
- **Check that the needed Users and Security Roles permissions are visible.**
- **Save the role only if you want to change that role's access.**
- **Ask a staff user to log in and confirm their menus and allowed actions are visible again.**

---

## Version 8.93.0

**Release Date:** 2026-07-23

---

### Module: FBR, PRA, and FBR DI Invoices

#### What Users Can Do Now
- **FBR POS works with online POS IDs.** Online POS businesses should use an FBR POS ID that is registered for online POS use in the FBR portal.
- **Receipts show the FBR invoice number and QR code when FBR accepts the sale.** If the QR code is missing, first check that the business location has the correct online FBR POS ID.
- **Sales and POS Sale lists now show FBR Invoice No after Invoice No.** Users can quickly see which sales have an FBR invoice number.
- **Bulk Sync PRA is available from the Sales and POS Sale filters.** This button appears only when the business package includes the FBR POS/PRA module.
- **Bulk Sync FBR DI is available separately.** This button appears only when the business package includes the FBR DI module.
- **Bulk Sync FBR POS has been removed.** FBR POS invoices should be submitted when the sale is created, so the receipt can show the FBR invoice number and QR code.
- **Business Settings > Product now includes If PCT/HSN Code Missing Send 0.** Enable this only when the business wants missing PCT/HSN codes to be sent as 0.
- **Correct product PCT/HSN codes are still recommended.** The new setting helps prevent missing-code invoice issues, but product master data should be completed whenever possible.

#### Guide
- **Open the FBR portal and check the POS Type for the business.**
- **If the POS Type is not for online POS use, create or update the POS registration for online POS use.**
- **Copy the online POS ID.**
- **Go to Business Location in the POS system.**
- **Paste the POS ID in FBR POS ID and save.**
- **Create a new sale and print the receipt.**
- **Check that the FBR invoice number and QR code appear on the receipt.**
- **Open Sales or POS Sale list.**
- **Check the new FBR Invoice No column after Invoice No.**
- **Use Bulk Sync PRA only for PRA invoices when available.**
- **Use Bulk Sync FBR DI only for FBR DI invoices when available.**
- **Do not look for Bulk Sync FBR POS, because it is no longer available.**
- **Go to Settings > Business Settings > Product if missing PCT/HSN codes should be sent as 0.**
- **Turn on If PCT/HSN Code Missing Send 0 only when the business wants this option.**
- **Update correct PCT/HSN codes in product master whenever possible.**

---

## Version 8.92.7

**Release Date:** 2026-07-22

### Module: Contacts - FBR DI Tax Number

#### What Works Correctly Now
- **FBR DI tax numbers are no longer shortened when saving a contact.**
- **The contact tax number is kept exactly as entered for FBR DI checks and invoice submission.**
- **The Check Reg. Type result now returns the same tax number that was checked.**
- **FBR DI submission now sends the buyer tax number from the contact without changing it.**
- **Seller registration number is also sent from the business tax number without extra shortening.**
- **The contact form help text now explains that FBR DI can use a 7-character NTN format such as A234567, or a 13-digit CNIC without dashes.**

#### Guide
- **Go to Contacts and add or edit a customer.**
- **Enter the customer's FBR DI tax number exactly as required.**
- **For NTN, use the accepted 7-character format without dashes.**
- **For CNIC, enter 13 digits without dashes.**
- **Click Check Reg. Type if FBR DI integration is enabled.**
- **Save the contact and use it on an FBR DI sale.**

---

### Module: Sales - Payment Form Layout

#### What Looks Clearer Now
- **Payment method dropdowns in sale payment rows use cleaner spacing.**
- **Change return payment method dropdown now aligns better with the rest of the payment form.**
- **The direct sale page layout keeps the export and payment sections inside the correct form structure.**

#### Guide
- **Open Add Sale.**
- **Check the payment section and change return payment method when a change return is used.**
- **If export fields are enabled, confirm they still appear in the correct place before saving the sale.**

---

## Version 8.92.6

**Release Date:** 2026-07-20

---

### Module: Reports - Daily Closing Report

#### What Users Can Do Now
- **Daily Closing Report is now available under Admin Reports.** Users can open it from Reports > Admin Reports > Daily Closing Report.
- **The report opens with yesterday selected by default.** This helps users quickly check the latest closing position without selecting the date every time.
- **The report shows Purchase Invoices and Stock Value in one place.** Users can review purchase invoice details and stock value details together on the same report screen.
- **Purchase invoices are shown location by location.** Each business location is shown separately, so users can easily check purchases for Store/Warehouse, Production Depot, and other branches.
- **Purchase invoice dates follow the closing date.** If yesterday is selected, the purchase section shows today's purchase activity. If an older date is selected, the purchase section shows purchases from the next day up to today.
- **Stock Value Report - Detailed is also shown location by location.** Each location has its own stock value table.
- **Location names now include the location code.** For example, users can see names like Store/Warehouse (BL0001), making the report easier to match with branches.
- **Locations are shown in the same order in both sections.** Purchase Invoices and Stock Value use the same location order, so comparing both sections is easier.
- **The Stock Value Report - Detailed section no longer shows a final Grand Total at the end of Daily Closing Report.** Users see totals by location without an extra combined total line.
- **Print A4 is available for Daily Closing Report.** Users can open a print preview with page controls, zoom, Print A4, PDF, Excel, and Close options, similar to other reports.
- **Daily Closing Report has its own column visibility settings.** Users can hide or show columns for the Stock Value Report - Detailed section without changing the normal Stock Value Report settings.
- **Column choices can be set separately for each location.** Users can choose different visible columns for Store/Warehouse, Production Depot, and other locations.
- **The settings are available under Admin Reports in the Profile page.** Users can open Reports Column Visibility and select Daily Closing Report - Stock Value Report (Detailed).
- **The checkbox order now matches the report column order.** This makes it easier to find the same column in settings and in the report.
- **Hidden purchase and purchase return columns only affect the stock value section.** The Purchase Invoices Report - Detailed section stays separate.
- **Empty locations are no longer shown in the purchase invoice section.** Locations without purchase or purchase return activity are skipped, so the report is easier to read.

#### Guide
- **Go to Reports > Admin Reports > Daily Closing Report.**
- **Check the As of Date. It should show yesterday by default.**
- **Select another date if you want to review closing information from an earlier date.**
- **Use Business Location if you want to check one location only, or leave All locations selected.**
- **Review Purchase Invoices Report - Detailed to see purchase activity by location.**
- **Review Stock Value Report - Detailed to see stock value by location.**
- **Check the location name and code on each section heading to confirm the correct branch.**
- **Click Print A4 to open the printable report preview.**
- **Use Print A4, PDF, or Excel from the preview as needed.**
- **Go to User Profile.**
- **Open Reports Column Visibility.**
- **Open Admin Reports.**
- **Select Daily Closing Report - Stock Value Report (Detailed).**
- **Choose the required location tab.**
- **Tick the columns you want to hide for that location.**
- **Click Update to save.**
- **Go to Reports > Daily Closing Report and review the Stock Value Report - Detailed section.**

---

### Module: Reports - Sale and Purchase Invoices Reports

#### What Works Correctly Now
- **Sale Invoices Report and Purchase Invoices Report now follow the Product Tax Fields setting.** When Enable product tax fields is turned off, tax-related columns are hidden from these reports.
- **Purchase Invoices Report is cleaner when product tax fields are off.** The Summary tab hides Tax and Total (Inc. tax), and the Detailed tab hides tax-related product columns such as Tax and Unit Cost Price (After Tax).
- **Sale Invoices Report is cleaner when product tax fields are off.** The Summary tab hides Tax and Total (Inc. tax), and the Detailed tab hides tax-related product columns such as Tax, Exc. tax, and Unit Cost (Exc Tax).
- **Detailed report totals stay properly aligned.** Product totals and invoice totals now line up correctly after tax-related columns are hidden.
- **Print, PDF, and Excel copies follow the same display.** Hidden tax-related columns are also hidden when users print or export these reports.
- **When Enable product tax fields is turned on again, the tax-related columns are shown again.**

#### Guide
- **Go to Settings > Business Settings.**
- **Open the Product tab.**
- **Untick Enable product tax fields if the business does not use product-level tax fields.**
- **Click Update Settings.**
- **Go to Reports > Purchase Invoices Report or Reports > Sale Invoices Report.**
- **Open the Summary or Detailed tab and review the columns.**
- **Use Print A4, PDF, or Excel if you need a copy with the same visible columns.**
- **Tick Enable product tax fields again if you want the tax-related columns to appear again.**

---

### Module: Reports - Stock Value Report

#### What Works Correctly Now
- **The As of Date now starts from yesterday by default.** When users open the Stock Value Report, the date is set to the previous day automatically.
- **Products with no stock activity are hidden by default.** Products that have no purchase, sale, return, transfer, manufacturing, or stock adjustment activity will not appear unless users choose to show them.
- **Show Zero Quantity still works normally.** Users can tick Show Zero Quantity to see products with zero current stock when those products have stock activity.
- **Show without History Products can be used when needed.** Users can tick this option if they also want to see products that do not have any stock activity.
- **The report list is cleaner by default.** Users see products with real stock movement first, without extra empty products filling the report.

#### Guide
- **Go to Reports > Stock Value Report.**
- **Check the As of Date. It should show yesterday by default.**
- **Leave Show without History Products unticked if you only want products with stock activity.**
- **Tick Show Zero Quantity if you also want to include products with zero current stock.**
- **Tick Show without History Products only when you want to include products that have no stock activity.**
- **Review the Details, Categorized, Locations, or Location Details tab as needed.**

---

### Module: Sales Settings - Required Quotation and Sales Order

#### What Users Can Do Now
- **Quotation can now be required before creating a sale invoice.** A new Is Quotation Required option is available with Enable Quotations.
- **Sales Order can now be required before creating a sale invoice.** A new Is Sales Order Required option is available with Enable Sales Order.
- **If Quotation is required, the cashier must select a quotation before saving the invoice as final.**
- **If Sales Order is required, the cashier must select a sales order before saving the invoice as final.**
- **If both options are required, both selections must be made before the invoice can be completed.**
- **A clear warning is now shown when a required Quotation or Sales Order is missing.**
- **The missing field is also highlighted in red beside Sales Order or Load Products from Quotation, so the cashier knows what to select.**

#### Guide
- **Go to Settings > Business Settings > Sales tab.**
- **Turn on Enable Quotations if the business uses quotations.**
- **Tick Is Quotation Required if a quotation must be selected before creating a final sale invoice.**
- **Turn on Enable Sales Order if the business uses sales orders.**
- **Tick Is Sales Order Required if a sales order must be selected before creating a final sale invoice.**
- **Save the settings.**
- **When creating a sale invoice, select the required Sales Order and/or Load Products from Quotation before completing the invoice.**
- **If a required selection is missing, read the red warning and select the missing item before saving again.**

---

### Module: Sales and POS - Reprint Invoice Layout

#### What Users Can Do Now
- **Users can choose a different invoice layout only when reprinting.** This helps print an old sale in another receipt or invoice format when needed.
- **Change Layout is available from the Actions button.** Users can open it from both the Sales list and the POS sales list.
- **A layout selection window opens after clicking Change Layout.** Users can choose the required invoice layout from the dropdown.
- **The saved invoice layout stays unchanged.** Choosing a layout from this option does not update the original sale.
- **The saved layout is selected by default.** When the Change Layout window opens, it first shows the layout already linked with that invoice.
- **The window has Print and Close buttons at the bottom.** Users can print with the selected layout or close the window without printing.

#### Guide
- **Go to Sales > All Sales or POS Sales.**
- **Find the invoice you want to reprint.**
- **Click Actions and choose Change Layout.**
- **Select the layout you want to use for this reprint.**
- **Click Print to print the invoice with the selected layout.**
- **Click Close if you do not want to print.**
- **The original invoice layout remains the same after printing.**

---

### Module: Business Registration - Date and Time Settings

#### What Works Correctly Now
- **New businesses now follow the Date Format saved in Business Settings.** If the business uses dd/mm/yyyy, newly registered businesses will also start with dd/mm/yyyy.
- **New businesses now follow the Time Format saved in Business Settings.** If the business uses 12 Hour time, newly registered businesses will also start with 12 Hour time.
- **Users do not need to change these settings again after registering a new business.** The saved format is applied automatically.

#### Guide
- **Go to Settings > Business Settings > Business tab.**
- **Choose the required Date Format and Time Format.**
- **Save the Business Settings.**
- **Register a new business.**
- **Open the new business and check Settings > Business Settings > Business tab.**
- **The Date Format and Time Format should match the saved settings.**

---

### Module: Invoice Layout - Sale Print Options

#### What Users Can Do Now
- **Products can now be grouped by rack on sale invoices.** When Group Products by Rack is selected in an invoice layout, the printed sale groups products under their rack names.
- **Rack grouping is available on Slim 6 and all Classic sale designs.** This includes Classic, Classic 2, Classic 3, Classic 4, Classic 5, Classic 6, and Classic 7.
- **Products without a rack are shown under No Rack.** This makes it easy to find items that still need rack information.
- **Products can still be grouped by category.** The category grouping option continues to work on the supported print layouts.
- **Slim 6 now shows product categories correctly when Show Category is selected.** If the option is on, the category appears on the printed receipt.
- **Unit can now be shown as a separate column on Classic sale invoices.** Users can set the Unit label and tick Show Unit, similar to the SKU label and Show SKU option.
- **Show Unit applies to Classic sale designs only.** It works on Classic, Classic 2, Classic 3, Classic 4, Classic 5, Classic 6, and Classic 7.
- **Subtotal bold options now work on all print designs.** If Bold is selected, the subtotal title and amount print in bold. If Bold is not selected, they print in normal text.
- **Classic invoice headers are more compact.** Extra blank space around the shop heading, Invoice title, and invoice details has been reduced.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new layout or edit an existing layout.**
- **To group products by rack, tick Group Products by Rack and save the layout.**
- **To group products by category, tick Group Products by Categories and save the layout.**
- **To show product categories on Slim 6, tick Show Category and save the layout.**
- **To print Unit as a separate Classic column, enter the Unit label and tick Show Unit.**
- **To make subtotal lines bold on any print design, tick Bold beside the required subtotal label. Leave it unticked for normal text.**
- **Print or preview a sale invoice with the selected layout to check the result.**

---

### Module: Sales - Sale Return Payments

#### What Works Correctly Now
- **Sale returns without payment no longer show a 0.00 payment receipt.** If the payment amount is left as 0, the system saves the sale return without adding a payment entry.
- **Sale returns stay Due when no payment is entered.** Users can clearly see that the return amount is still unpaid.
- **The receipt/payment list now shows only real payments.** Users will not see an extra 0.00 sale return payment line.
- **Actual sale return payments still save normally.** If a payment amount is entered, it appears in the payment list as expected.

#### Guide
- **Go to Sales > Sale Returns.**
- **Create a sale return and add the returned products.**
- **If no payment or refund is being made, leave the payment amount as 0 or blank.**
- **Save the sale return.**
- **Open the payment/receipt view. No 0.00 payment line should appear.**
- **If a payment or refund is made, enter the amount in the payment section before saving.**

---

### Module: Accounting - Cash Flow Report

#### What Works Correctly Now
- **Contact Payments now show the correct cash effect in the Cash Flow Report.** When a payment includes both a sale amount and a matching sale return amount, the report now shows the final net amount.
- **Payments that cancel each other now show as 0.00.** For example, if a customer payment has 1,000.00 received and 1,000.00 adjusted against a sale return, the Cash Flow Report shows 0.00 instead of adding both amounts.
- **The Cash Flow Report now matches the Contact Payment preview.** Users can open the payment preview and see the same final amount shown in accounting.
- **Printed and exported Cash Flow Reports follow the same correct amount.**

#### Guide
- **Go to Accounting > Reports > Cash Flow Report.**
- **Select the required cash account, location, and date range.**
- **Find the Contact Payment reference number.**
- **Open the payment preview if you want to compare the details.**
- **The amount in Cash Flow should now match the final amount shown in the payment preview.**

---

### Module: Sales - Direct Sale Returns and Invoice Printing

#### What Works Correctly Now
- **Product discounts are calculated correctly when editing a direct sale return.** The discount, product subtotal, and final return amount now match the values entered for each returned product.
- **Saved direct sale returns keep the correct discount amounts.** Opening a return again shows the same product calculations that were shown when it was created.
- **Sale-return invoices now show product discounts correctly.** The printed invoice can show the unit discount, total product discount, and discount percentage when their labels are enabled.
- **Classic invoices now follow the discount labels saved in the invoice layout.** Each enabled discount label appears as its own clear column on the invoice.
- **Sale-return invoice links open and print normally.** Users can view the invoice without receiving a general error message.

#### Guide
- **Go to Sales > Sale Returns and create or edit a direct sale return.**
- **Enter the product quantity, price, and discount.**
- **Check the product subtotal and final return amount, then save the return.**
- **To choose the discount columns shown on an invoice, go to Settings > Invoice Settings > Invoice Layouts.**
- **Create or edit a Classic layout and enter the required Unit Discount, Discount Total, and Discount Percentage labels.**
- **Save the layout, then open or print the sale-return invoice. Only the labels you entered will appear as columns.**

---

### Module: Contacts - Ledger Columns and A4 Printing

#### What Users Can Do Now
- **Column Visibility is now available in all six contact ledger formats.** Users can choose which ledger columns they want to see.
- **Column choices are remembered for each contact and ledger format.** Users can return to a ledger without selecting the same columns again.
- **Hidden columns can be shown again at any time.** Users can open Column Visibility again and select the column they want to bring back.
- **Print A4 follows the visible ledger columns.** Any column hidden before printing is also left out of the printed ledger.
- **Converted-currency ledger tables follow the same column choices when printing.** Both ledger tables stay consistent on the printed copy.
- **Print A4 now asks for Portrait or Landscape.** Users can choose the page direction before opening the print preview.
- **The previous page direction is remembered.** The last Portrait or Landscape choice is highlighted the next time Print A4 is used.
- **The selected page direction is also followed when downloading a PDF from the print preview.**

#### Guide
- **Go to Contacts and open the required contact.**
- **Open the Ledger tab and choose any ledger format from Format 1 to Format 6.**
- **Click Column Visibility and select the columns you want to show.**
- **To show a hidden column again, click Column Visibility again and select that column.**
- **Click Print A4.**
- **Choose Portrait or Landscape.**
- **Review the preview and print the ledger. Hidden columns will not appear on the printed copy.**

---

### Module: Reports - Sale Invoices Report Filters

#### What Works Correctly Now
- **The Date Range filter now updates the Detailed tab correctly.** Users can change or clear the date range without reopening the report.
- **All report filters now work while the Detailed tab is open.** This includes type, payment status, payment method, location, product, invoices, invoice range, customer, customer group, city, state, country, brand, time range, and duplicate sales.
- **The Brand filter now applies to the Detailed report.** The selected brand is also followed when printing or exporting the Detailed report to Excel.
- **The latest filter selection is shown when filters are changed quickly.** Older results no longer replace the newly filtered report.
- **Filtered Detailed reports load more reliably.**

#### Guide
- **Go to Reports > Sale Invoices Report.**
- **Open the Detailed tab.**
- **Choose the required date range and any other filters.**
- **Review the updated Detailed report.**
- **Use Print A4 or Export to Excel when you need a copy with the same selected filters.**

---

### Module: Stock Transfers - Cost and Selling Values

#### What Users Can Do Now
- **Cost and sale values are easier to understand on stock transfers.** The price headings now use Cost Price, Cost Total, Sale Price, and Sale Total.
- **Price and total amounts are arranged more clearly.** The value columns are easy to scan and compare while creating, editing, or reviewing a stock transfer.
- **Add Stock Transfer shows both cost and sale information for every product.** Users can review the Cost Price, Cost Total, Sale Price, and Sale Total before saving the transfer.
- **Add Stock Transfer shows both overall values at the bottom.** Total Cost Value and Total Selling Value make it easier to compare the transfer's cost and sale values.
- **Edit Stock Transfer shows the Sale Price alongside the cost values.** Users can review the product's Cost Price, Cost Total, and Sale Price while editing a transfer.
- **The Stock Transfers list shows Total Cost Value and Total Selling Value.** Users can compare both values without opening each transfer.
- **The Stock Transfer Report shows both values throughout the report.** Total Cost Value and Total Selling Value are available in the Totals, Summary, Detailed, and Product Summary views.
- **Printed and exported Stock Transfer Reports include the same values.** The updated headings and totals are also shown when printing or exporting the report to PDF or Excel.
- **Users can choose whether to show these value columns on the Stock Transfers list.** Total Cost Value and Total Selling Value can be hidden from the user's column visibility settings when required.

#### Guide
- **Go to Stock Transfers and click Add.**
- **Add the products and enter the required quantities.**
- **Review Cost Price, Cost Total, Sale Price, and Sale Total for each product.**
- **Review Total Cost Value and Total Selling Value at the bottom, then save the transfer.**
- **Open the Stock Transfers list to compare the two total values for saved transfers.**
- **Go to Reports > Stock Transfer Report to review the Totals, Summary, Detailed, or Product Summary view.**
- **Use Print A4, PDF, or Excel when you need a printed or exported copy with the same values.**
- **To hide a value on the Stock Transfers list, open your Profile settings and use Stock Transfers Index Column Visibility.**

---

### Module: Reports - Stock Value Report

#### What Works Correctly Now
- **Current Stock Value now shows the correct amount in the Details tab.** Products with a current stock quantity no longer show a zero value when a purchase price is available.
- **Opening and current stock values can now be compared correctly.** Users can review both amounts together when checking product stock value.

#### Guide
- **Go to Reports > Stock Value Report.**
- **Open the Details tab.**
- **Search for the required product or SKU.**
- **Review Current Stock Quantity and Current Stock Value.**

---

### Module: Products - Actions Menu

#### What Works Correctly Now
- **Product Stock History now opens with a cleaner screen.** After users choose Product Stock History from the Actions button, the old action menu does not stay open.
- **Duplicate Product now opens with a cleaner screen.** After users choose Duplicate Product from the Actions button, the old action menu does not stay open.

#### Guide
- **Go to Products > Products List.**
- **Click the Actions button for the product.**
- **Choose Product Stock History or Duplicate Product.**
- **The selected page or popup opens without the old Actions menu left behind.**

---

### Module: Products - Add/Edit Alternate SKU

#### What Works Correctly Now
- **Add/Edit Alternate SKU now opens more cleanly from the Products list.** When users choose this option from the Actions button, the action menu closes and the popup is easier to view.
- **The Products list stays clearer while the popup is open.** Users no longer see the old Actions menu left open behind the Alternate SKU popup.

#### Guide
- **Go to Products > Products List.**
- **Click the Actions button for the product.**
- **Choose Add/Edit Alternate SKU.**
- **Add or update the alternate SKU details.**
- **Click Save.**

---

### Module: Products - Add/Edit Opening Stock

#### What Works Correctly Now
- **Add/Edit Opening Stock now opens properly from the Products list.** When users choose this option from the Actions button, the popup appears clearly on the screen.
- **The opening stock form is no longer covered by the dark background.** Users can view, enter, and save opening stock without the popup looking blocked.

#### Guide
- **Go to Products > Products List.**
- **Click the Actions button for the product.**
- **Choose Add/Edit Opening Stock.**
- **Enter or update the opening stock details.**
- **Save the changes.**

---

### Module: POS - Product Entry and Shortcuts

#### What Works Correctly Now
- **POS product entry is smoother from the keyboard.** After adding a product, the product search stays ready so the cashier can scan or type the next item.
- **F2 now moves to the latest product quantity.** Cashiers can press F2 to quickly edit the quantity of the most recently added product row.
- **Shift + P now works more reliably on POS.** The shortcut can be used even when the cursor is already inside the product search box.
- **POS shortcuts work better while scanning or typing products.** Common POS shortcut keys can be used without first clicking somewhere else on the screen.

#### Guide
- **Open POS.**
- **Scan or type a product and add it to the bill.**
- **Continue scanning or typing the next product from the product search box.**
- **Press F2 if you need to change the latest product quantity.**
- **Press Shift + P when you want to move back to product search.**

---

### Module: POS - Finalizing Bills

#### What Works Correctly Now
- **Bills can be completed more reliably.** The system is less likely to show Something went wrong while finalizing a bill.
- **Cashiers can complete payment and save the bill normally.** The sale should finish without needing to repeat the same bill.
- **Finalized bills remain available for review and printing.** Users can check the completed sale from the Sales list when needed.

#### Guide
- **Create the bill in POS as usual.**
- **Choose the payment option.**
- **Finalize the bill.**
- **If needed, open Sales > All Sales to review or reprint the completed bill.**

---

### Module: Purchases and Purchase Orders - Product Quantity Entry

#### What Works Correctly Now
- **Tab now moves to the product quantity on purchase screens.** After entering a product, users can press Tab from the product search box to go directly to that product's quantity field.
- **The latest product row is selected correctly.** If a second product is entered, pressing Tab moves to the second product's quantity field.
- **Add Purchase and Edit Purchase follow the same keyboard flow.** Users can use the same Tab behavior while creating or editing purchases.
- **Add Purchase Order and Edit Purchase Order follow the same keyboard flow.** Users can use the same Tab behavior while creating or editing purchase orders.

#### Guide
- **Open Add Purchase, Edit Purchase, Add Purchase Order, or Edit Purchase Order.**
- **Scan or type the product in Product Search.**
- **Press Tab to move to that product's quantity field.**
- **Enter the quantity.**
- **Go back to Product Search and add the next product.**
- **Press Tab again to move to the new product's quantity field.**

---

### Module: Sales Invoice - Go Back Button

#### What Users Can Do Now
- **A Go Back button is now shown on the invoice page.** After creating or reprinting a sale invoice, users can quickly return to the Sales list.
- **The button appears at the top with Print and New Invoice.** Users do not need to use the browser back button.
- **Printed invoices stay clean.** The Go Back button is only for screen use and does not appear on printed invoices.

#### Guide
- **Create a sale or reprint an invoice.**
- **On the invoice page, click Go Back at the top.**
- **The system opens Sales > All Sales.**

---

## Version 8.92.5 P2

**Release Date:** 2026-07-18

### Module: Contacts - Ledger Footer Buttons

#### What Users Can Do Now
- **Contact Ledger actions are now available from the main footer when the Ledger tab is open.**
- **Users can export the ledger to Excel from the footer.**
- **Users can export the ledger to PDF from the footer.**
- **Print and Send Email remain available with the ledger actions.**
- **The footer buttons change with the selected contact tab, so ledger buttons only appear while viewing the Ledger tab.**

#### Guide
- **Open a customer, supplier, or barterer contact.**
- **Go to the Ledger tab.**
- **Use the footer buttons to Print, Export to Excel, Export to PDF, or Send Email.**
- **Switch to another contact tab and confirm the footer changes to the actions for that tab.**

---

## Version 8.92.5

**Release Date:** 2026-07-18

### Module: FBR, PRA, and FBR DI Invoices

#### What Works Correctly Now
- **Inclusive sales now calculate further tax more accurately for FBR submissions.**
- **Further Tax from tax groups is now included in the item total sent to FBR POS.**
- **FBR DI inclusive invoice lines now include Further Tax when working out value before tax, sales tax, and total value.**
- **FBR invoice totals now better match the sale when a tax group includes Further Tax.**

#### Guide
- **Create a sale with inclusive tax and a tax group that includes Further Tax.**
- **Finalize the sale and submit it to FBR/FBR DI as usual.**
- **Check the FBR response or receipt and confirm the invoice is accepted with the correct tax totals.**

---

### Module: POS - Product Quantity Entry

#### What Works Better Now
- **After adding or scanning a product in POS, the quantity field is selected automatically.**
- **Cashiers can change the quantity immediately after the product is added.**
- **This works when adding to an existing product row and when a new product row is created.**

#### Guide
- **Open POS.**
- **Scan or search and add a product.**
- **After the product is added, type the required quantity if it needs to change.**
- **Continue adding the next product as usual.**

---

### Module: Stock Report - Reindex Stock Quantities

#### What Works Better Now
- **Stock reindex now refreshes products in smaller groups, so it is easier to complete on busy systems.**
- **Reindex All now starts more smoothly, even when many products are included.**
- **Mismatch reindex now checks purchase, sale, and current stock quantities more clearly.**
- **Progress updates are saved while reindex is running, so users can see the current location, product, count, and total.**
- **Progress updates are less noisy and refresh at a steadier pace.**

#### Guide
- **Start Reindex Stock Quantities from the stock report or related reindex screen.**
- **Watch the progress message for the current location, product, and percentage.**
- **Wait for the completed notification before checking stock quantities again.**

---

## Version 8.92.4

**Release Date:** 2026-07-17

---

### Module: Product Search - F10 Keyboard Use

#### What Users Can Do Now
- **F10 Product Search is easier to use from the keyboard.** When the search window opens, the cursor is ready in Search Text.
- **F10 opens Product Search on sales, purchase, return, and stock screens.** Users can use it on POS, Add Sale, Edit Sale, Add Purchase, Edit Purchase, Purchase Return, Sale Return, Stock Adjustment, and Stock Transfer screens.
- **F10 no longer moves focus to the browser menu.** Pressing F10 now opens Product Search on these screens instead of moving to the browser's menu.
- **Down Arrow now moves from Search Text to the product list.** Users can type a product name or SKU, press Down Arrow, and the first matching product row is highlighted.
- **Up Arrow and Down Arrow can move between products.** This lets users choose a product without using the mouse.
- **Enter adds the highlighted product.** After moving to the product row, users can press Enter to add the product to the bill, purchase, return, adjustment, or transfer.
- **The highlighted product row is easier to see.** The selected row is shown clearly in the product list.

#### Guide
- **Open POS, Add Sale, Edit Sale, Add Purchase, Edit Purchase, Purchase Return, Sale Return, Stock Adjustment, or Stock Transfer.**
- **Press F10 to open Product Search.**
- **Type the product name or SKU in Search Text.**
- **Press Down Arrow to move to the product list.**
- **Use Up Arrow or Down Arrow to choose the product.**
- **Press Enter to add the highlighted product.**

---

### Module: Expenses - Project Filters

#### What Users Can Do Now
- **Expenses can now be filtered by Project.** Users can choose a project on the Expenses page and see only expenses linked to that project.
- **Expenses can now be filtered by Project Step.** After choosing a project, users can choose a step to see expenses for that specific stage of work.
- **Project expenses can be hidden from the main Expenses list.** Users can tick **Hide Project's Expenses** when they want to review only normal expenses that are not linked to projects.
- **The Expenses list now shows the Project column.** Users can see the project name and step name directly in the expense table.
- **Print A4 follows the selected project filters.** When users print the Expenses list, the print view follows the selected project, project step, or hide project expenses option.

#### Guide
- **Go to Expenses.**
- **Use the Project filter to choose the required project.**
- **Use the Project Step filter if you want to narrow the list to one step.**
- **Tick Hide Project's Expenses if you want to hide all project-linked expenses.**
- **Check the Project column in the table to see which project and step each expense belongs to.**
- **Click Print A4 if you want to print the filtered expense list.**

---

### Module: Purchases - Product Row Discounts

#### What Users Can Do Now
- **Purchase product rows now have clearer discount names.** The old inline Discount column is now shown as Unit Discount, so users can understand that it is applied per unit.
- **The Purchase settings label is clearer.** The setting is now called Enable Inline Unit Discount in purchase.
- **Users can add a Total Discount on each purchase product row.** When enabled, a Total Discount column appears after Unit Discount on Add Purchase and Edit Purchase.
- **Total Discount updates the Line Total automatically.** Users can enter a fixed amount or a percentage, and the row total changes based on the discount.
- **Discount 2 is still available separately.** The existing Enable Inline Discount 2 in purchase setting is not changed.
- **Users can add a Total Discount 2 on each purchase product row.** When enabled, a Total Discount 2 column appears after Discount 2.
- **Total Discount 2 also updates the Line Total automatically.** This gives users another whole-row discount option after Discount 2.
- **Purchase row totals are easier to review.** The purchase page shows separate totals for Unit Discount, Total Discount, Discount 2, and Total Discount 2 when those options are enabled.

#### Guide
- **Go to Settings > Business Settings > Purchase tab.**
- **Turn on Enable Inline Unit Discount in purchase to use a per-unit discount column.**
- **Turn on Enable Inline Total Discount in purchase to add a whole-row Total Discount column.**
- **Turn on Enable Inline Discount 2 in purchase if you need the second per-unit discount column.**
- **Turn on Enable Inline Total Discount 2 in purchase if you need a second whole-row discount column.**
- **Choose Fixed or Percentage as the default type for each discount option.**
- **Open Add Purchase or Edit Purchase.**
- **Enter the product quantity and discounts. The Line Total and purchase totals update automatically.**

---

### Module: Stock Report - Reindex Stock Quantities

#### What Users Can Do Now
- **Stock quantity reindex is easier to control from the Stock Report.** Users can choose whether to reindex all stock quantities or only the default mismatch check.
- **Only one stock reindex can run at a time.** This helps prevent repeated clicks from starting the same long reindex many times.
- **Reindex progress is shown in the notification bell.** Users can check the bell icon to see the current reindex status.
- **Users can cancel an active reindex safely.** The system finishes the current item first, then stops, so stock data is not left halfway updated.
- **Cancel is available from the Stock Report and from the notification bell.** Active reindex notifications now show a Cancel option.
- **Old stuck reindex notifications are clearer.** If an old reindex did not finish, it is shown as not completed instead of looking like it is still running.
- **Stock reindex focuses on stock-managed products.** Products that do not track stock are not included in the reindex.

#### Guide
- **Go to Reports > Stock Report.**
- **Click Reindex Stock Quantities.**
- **Choose All if you want to recheck all stock-managed products.**
- **Choose Default if you only want the normal mismatch check.**
- **Open the notification bell to view the reindex status.**
- **To stop it, click Cancel Reindex on the Stock Report or click Cancel inside the active bell notification.**
- **Wait until the notification shows that the reindex was cancelled or completed before starting another reindex.**

---

### Module: Reports - Purchase Payment Report

#### What Works Correctly Now
- **The Detail tab now opens normally.** Users can view purchase payment details without the table staying on Processing.
- **Purchase payment records load with the selected filters.** Date range, supplier, payment location, transaction location, and payment method filters continue to apply.
- **Summary and Detail tabs can be checked together.** Users can move between the report tabs and review the information they need.

#### Guide
- **Go to Reports > Purchase Payment Report.**
- **Choose the date range and filters you want to check.**
- **Open the Detail tab.**
- **Review the payment list after it loads.**

---

### Module: User Security - Expense Category Permissions

#### What Users Can Do Now
- **Expense Category permissions can now be set separately.** Roles now have separate options for Add Expense Category, Edit Expense Category, and Delete Expense Category.
- **Staff can be given only the category access they need.** For example, a user can be allowed to add categories without also being allowed to delete them.
- **Expense Category buttons now follow the user's role.** Add, Edit, Delete, and Restore options appear only for users who are allowed to use them.
- **Expense Category access can be managed from the Expenses tab in Roles.** This keeps all expense-related role settings in one place.

#### Guide
- **Go to User Management > Roles.**
- **Add a new role or edit an existing role.**
- **Open the Expenses tab.**
- **Tick Add Expense Category, Edit Expense Category, or Delete Expense Category as needed.**
- **Save the role.**
- **Open Expenses > Expense Categories to check the available buttons for that user.**

---

### Module: Sales - All Sales Action Button

#### What Works Correctly Now
- **The Actions button on All Sales now opens for allowed non-admin users.** Users do not need to be Admin just to open the action menu.
- **Allowed users can view sales from the Actions menu.** Users with permission to view their own sales or assigned sales can open the sale details.
- **The Actions menu shows only the options the user is allowed to use.** Each role sees the available View, Print, Payment, Return, or other actions based on its permissions.

#### Guide
- **Go to Sales > All Sales.**
- **Find the sale you want to check.**
- **Click Actions.**
- **Choose the available option, such as View or Print, depending on your role permission.**

---

### Module: Reports - Activity Log

#### What Is Easier Now
- **Activity Log can now be filtered by Transaction Type.** Users can choose Sales, Purchase, Sale Return, Purchase Return, Expense, Stock Adjustment, and other transaction types from the report filters.
- **Subject Type and Transaction Type are now separate filters.** Users can first choose whether they want to see contacts, users, roles, transactions, or payments, then narrow the list by transaction type when needed.
- **The search box now finds activity log records correctly.** Users can search by invoice number, reference number, payment reference number, product name, SKU, user name, action, or words shown in the note.
- **Print A4 now follows the same search and filters.** If users filter or search the Activity Log before printing, the A4 print report shows the same matching records.

#### Guide
- **Go to Reports > Activity Log.**
- **Use Transaction Type to show only the type of activity you need, such as Sales or Purchase.**
- **Use the search box to find a specific invoice, reference number, payment number, product, SKU, user, or note.**
- **Click Print A4 if you want to print the filtered or searched results.**

---

### Module: POS and Sales - Completed Invoices

#### What Works Correctly Now
- **Completed invoices stay completed.** After a sale is finished, an old open POS page will no longer change that sale back into a draft by mistake.
- **Finished sales stay visible in the Sales list.** Completed invoices should remain available from the normal sales list after saving.
- **Invoice numbers are safer after printing.** A completed sale is less likely to disappear from the list because of an old screen still open in the background.
- **Printed invoice totals should match the saved sale.** Users can reprint the invoice from the saved sale record when needed.

#### Guide
- **Complete the sale as usual from POS or Add Sale.**
- **After printing the invoice, check Sales > All Sales if you need to view or reprint it.**
- **If the invoice is not visible, check the selected date range and invoice search first.**
- **Avoid continuing work from an old browser tab for a sale that has already been completed.**

---

### Module: Sales List - Deleted Sales

#### What Works Correctly Now
- **Show Only Deleted now shows removed sales correctly.** When this option is ticked, the Sales list shows deleted sales instead of normal active sales.
- **Deleted sales can be reviewed separately.** This makes it easier for allowed users to check removed invoices without mixing them with normal sales.
- **The date filter still applies.** If no deleted sale exists in the selected date range, the table will correctly show no records.
- **Restore is available for deleted sales.** Allowed users can bring a deleted sale back from the deleted sales list.

#### Guide
- **Go to Sales > All Sales.**
- **Choose the date range you want to check.**
- **Tick Show Only Deleted.**
- **If no deleted sales appear, increase the date range and search again.**
- **Use Restore if a deleted sale needs to be brought back.**

---

### Module: POS and Sales - Negative Quantity / Sale Return

#### What Works Correctly Now
- **Negative quantity items now work like sale returns.** If a product is entered with a negative quantity, the sale amount, bill total, stock, cost, and profit are handled as a return.
- **Mixed bills now work correctly.** A bill can include normal sale items and return items together, and the final bill amount stays correct.
- **Only return bills also work correctly.** One product or many products can be entered with negative quantities, and the stock is added back correctly.
- **Sell Create and Sell Edit pages follow the same behavior.** Negative quantity return entries work the same way on POS, Add Sale, and Edit Sale.

#### Guide
- **Open POS, Add Sale, or Edit Sale.**
- **Add the product normally.**
- **Enter a negative quantity for the item being returned, such as -1.**
- **Complete the bill as usual.**
- **Check stock and reports after saving to confirm the returned quantity has been added back.**

---

### Module: POS and Sales - Zero Stock Products

#### What Works Correctly Now
- **Zero-stock products can still be selected when selling without stock is not allowed.** The product is added with quantity 0 so the cashier can see it, but it cannot be finalized as a normal sale with a positive quantity.
- **A clear Product out of Stock warning is shown.** If a cashier tries to sell a zero-stock product with a positive quantity, the system shows a warning with the product SKU.
- **Positive quantity is stopped when stock is not available.** The sale cannot be completed with a positive quantity for an out-of-stock product when selling without stock is disabled.
- **Negative quantity is still allowed for returns.** Out-of-stock products can be entered with a negative quantity when the customer is returning the item.
- **When selling without stock is allowed, products are added normally.** The system follows the business setting and does not force the product quantity to 0.

#### Guide
- **Go to Settings > Business Settings > Sales tab.**
- **If Allow Sale if No Stock is disabled, zero-stock products can be selected but should stay at quantity 0 unless it is a return.**
- **For a sale, add stock first or choose another product.**
- **For a return, enter the quantity as a negative number.**
- **If Allow Sale if No Stock is enabled, continue selling the product normally.**

---

### Module: Product Search Popup

#### What Works Correctly Now
- **Text search in the F10 product search popup now works correctly.** Users can type a product name or SKU and the product list will update.
- **The F10 product search popup now shows fresher stock figures.** When the popup opens, it reloads the latest product list and quantity.
- **Location stock is clearer on POS and Sales pages.** The popup shows quantity for the selected selling location where allowed.
- **Product quantity in the popup now matches the product stock history more closely.** This helps users choose the correct product before adding it to a bill.
- **Products marked as not for sale stay hidden on selling screens.** This keeps the selling list cleaner for cashiers and sales staff.

#### Guide
- **Open POS, Add Sale, or Edit Sale.**
- **Press F10 to open Products Search.**
- **Type the product name or SKU in Search Text to find the product.**
- **Check the Quantity column before selecting a product.**
- **If the quantity does not look right, close and reopen the popup to refresh the list.**

---

### Module: Product History, Cost, and Profit

#### What Works Correctly Now
- **Product history now shows cost for negative quantity sale entries.** Return-style sale lines no longer show missing cost when the product has a saved purchase cost.
- **If there is no purchase or opening stock record, the product's saved cost is used.** This helps product history still show a useful cost value.
- **Profit figures now stay correct for negative quantity sale entries.** Reports treat these entries like sale returns.
- **Edited and finalized sales now refresh the related cost and profit figures.** After a sale is changed, reports show the latest values.

#### Guide
- **Open the product's stock history.**
- **Check sale and return rows for Quantity Change, Cost Price, Cost Total, Sell Price, and Sell Total.**
- **If a product has no purchase history, check the product's saved cost on the product create/edit page.**
- **Review profit reports after saving or editing a sale to confirm the return effect is included.**

---

### Module: Accounting - Ledgers and Refund Payments

#### What Works Correctly Now
- **Accounting ledgers now show cost values for negative quantity sale entries.** Return-style sale entries are reflected correctly in the ledger.
- **Refund payments now appear on the correct side of the selected payment account.** A negative payment, such as a cash refund, is shown on the payment-out / credit side.
- **Accounting reports now match the sale return effect more clearly.** This helps users compare sales, returns, payments, stock, cost, and profit.

#### Guide
- **Complete the sale or return entry.**
- **Open the related Accounting ledger.**
- **Check that the cost and payment amounts are shown on the correct side.**
- **For a refund, check the selected cash or bank account to confirm the amount is shown as money paid out.**

---

### Module: Payment Accounts

#### What Works Correctly Now
- **The Account Types tab now opens correctly.** Users can switch from Accounts to Account Types without the page getting stuck on the Accounts list.
- **The selected tab is now highlighted correctly.** It is clearer which tab is currently open.

#### Guide
- **Go to Account > Account.**
- **Click the Account Types tab.**
- **Add, edit, delete, or restore account types from this tab as needed.**
- **Click the Accounts tab to return to the payment account list.**

---

## Version 8.92.1 P2

**Release Date:** 2026-07-16

### Module: POS - Dojo Payments

#### What Works Better Now
- **Dojo payment settings are now used more consistently during the full payment process.**
- **Dojo payments, cancellations, terminal checks, refunds, and signature checks now follow the same saved setup.**
- **This makes Dojo terminal payments easier to manage from the user's normal payment settings.**

#### Guide
- **Open the Dojo payment settings.**
- **Check that the Dojo setup details are saved correctly.**
- **Open POS and process a Dojo payment as usual.**
- **If using a Dojo terminal, test the terminal connection from the payment settings.**

---

### Module: Stock Report - Reindex Stock Quantities

#### What Looks Clearer Now
- **Stock reindex progress now updates based on time instead of every fixed percentage step.**
- **The progress message now includes the current product name while reindex is running.**
- **If reindex cannot finish, the notification now clearly shows that it failed and explains the reason.**
- **Users get clearer feedback instead of a reindex notification appearing stuck.**

#### Guide
- **Start Reindex Stock Quantities from the stock report or related screen.**
- **Open the notification bell while it is running.**
- **Check the current location, percentage, item count, and product name.**
- **If reindex fails, read the notification message before starting another reindex.**

---

### Module: Offline Sync - Access Token

#### What Works Correctly Now
- **Generating a new offline access key no longer stops existing valid keys automatically.**
- **Older active keys can continue working while a new key is created with the correct expiry date.**
- **This helps avoid accidentally disconnecting another offline workstation when creating a new key.**

#### Guide
- **Go to Offline Sync or the offline access screen.**
- **Generate a new access key for the required user.**
- **Use the new key on the intended workstation.**
- **Existing workstations should continue using their current valid keys.**

---

### Module: Accounting - Purchase Mapping

#### What Works Correctly Now
- **Purchase accounting mapping now handles free-of-cost quantity more safely.**
- **Purchases with zero quantity no longer risk a calculation error while adjusting free-of-cost unit cost.**
- **Purchase account mapping stays more reliable when product-level purchase accounts and FOC quantities are used together.**

#### Guide
- **Create or review a purchase that includes free-of-cost quantity.**
- **If product-level purchase accounts are mapped, open Accounting reports after saving.**
- **Check that the purchase values are mapped without calculation errors.**

---

## Version 8.92.1

**Release Date:** 2026-07-16

---

### Module: Product SKU Scanning

#### What Works Correctly Now
- **Alphanumeric product SKUs can now be scanned correctly.** SKUs with letters and numbers, such as `FN368463427566`, are accepted in product search fields.
- **Purchase product scanning now works correctly.** Users can scan this type of SKU on the Add Purchase screen.
- **POS product scanning now works correctly in both product scan fields.** Users can scan the SKU in the SKU scan box or the normal product search box.
- **The scanner no longer opens the wrong popup while scanning.** The full SKU stays in the search box and the product can be selected or added normally.
- **The same scanning improvement is available on other product search screens.** This includes Sales, Purchase Orders, Purchase Returns, Stock Adjustment, Stock Transfer, and product search popups.

#### Guide
- **Open the screen where you want to add a product.**
- **Click inside the product search or SKU scan box.**
- **Scan the product barcode.**
- **Check that the full SKU appears, including letters.**
- **Press Enter if the product is not added automatically.**
- **If the product still does not appear, confirm that the same SKU is saved in the product record.**

---

### Module: User Roles - Sale Return Payments

#### What Works Correctly Now
- **Sale return payment option now appears when it is allowed in the role.** If a user role has **Add sale return payment (SRP)** selected, the Add Payment section is shown on sale return pages.
- **Staff can add payment details while creating or editing a sale return.** The payment area is available at the bottom of the sale return page for users who have this role permission.

#### Guide
- **Go to Settings > User Management > Roles.**
- **Create a new role or edit an existing role.**
- **Open the Sales tab.**
- **In Sale Return permissions, tick Add sale return payment (SRP).**
- **Save the role.**
- **Open a sale return create or edit page.**
- **Check the bottom of the page to add the sale return payment.**

---

## Version 8.92.0

**Release Date:** 2026-07-14

---

### Module: HRM - Attendance Import

#### What Users Can Do Now
- **Attendance can now be imported using User ID.** Users should enter the User ID shown in the Users List instead of entering an email address.
- **The attendance import template now starts with User ID.** The first column in the Excel file is now clear and matches the User ID column on the Users List page.
- **The template includes an example row.** Users can see the correct way to fill User ID, clock-in time, clock-out time, shift, notes, and IP address.
- **Email is no longer needed for attendance import.** This makes the import easier when employee emails are missing or changed.

#### Guide
- **Go to User Management > Users List.**
- **Note the employee's User ID from the User ID column.**
- **Go to HRM > Attendance > Import Attendance.**
- **Download the attendance import template.**
- **Replace the example row with the real attendance details.**
- **Enter the User ID in the first column.**
- **Enter Clock-in Time and Clock-out Time in this format: `YYYY-MM-DD HH:MM:SS`.**
- **Enter Shift only if that shift name already exists, otherwise leave it blank.**
- **Upload the completed Excel file and click Submit.**

---

### Module: Home Dashboard - Module Shortcuts

#### What Users Can Do Now
- **Module buttons are now shown above the quick action buttons on the Home Dashboard.** Users can quickly open the dashboard of available modules such as HRM, Installment, Project, Accounting, Warehouse, and other active modules.
- **Clicking a module button opens that module's dashboard or main page.** Users no longer need to search through the side menu for common module dashboards.
- **Module buttons now have colorful styling.** The buttons are easier to notice and match the quick action buttons below them.
- **Accounting now appears in the dashboard module buttons when it is available for the business.** If Accounting is included and visible in the side menu, users can also open it from the Home Dashboard shortcut.
- **Manufacturing now appears in the dashboard module buttons when it is available for the business.** If Manufacturing is included and visible in the side menu, users can also open it from the Home Dashboard shortcut.

#### Guide
- **Go to Home / Dashboard.**
- **Look below the greeting box and above Add Sale / Add Purchase.**
- **Click any module name button to open that module's dashboard or main page.**
- **Use the Add Sale, Add Purchase, Add Product, Add Contact, and Add Expense buttons below for quick daily actions.**

---

### Module: Expenses - Expense Categories

#### What Is Easier Now
- **Budget is now shown as Monthly Budget.** Users can clearly understand that the amount is for one month.
- **The list now shows Remaining Budget.** Users can quickly see how much budget is still left for the current month.
- **Remaining Budget starts fresh every month.** At the start of a new month, the remaining amount begins again from the monthly budget and then reduces as expenses are added.
- **Expense refunds are included in the remaining budget.** If an expense refund is recorded, the remaining budget is adjusted.

#### Guide
- **Go to Expenses > Expense Categories.**
- **Click Add to create a new category, or Edit to update an existing one.**
- **Enter the Monthly Budget amount if needed.**
- **Click Save or Update.**
- **Check the Remaining Budget column to see how much is left for the current month.**
- **When a new month starts, the remaining amount starts again from the Monthly Budget.**

---

### Module: FBR Digital Invoicing - Customer Tax Number

#### What Is Easier Now
- **Customer Tax Number entry is clearer for FBR Digital Invoicing.** A help tooltip is shown on the customer add/edit form to guide users about the correct number format.
- **Users can enter the buyer NTN or CNIC in the correct FBR format.** Use 7 digit NTN without dash/check digit, or 13 digit CNIC without dashes.
- **The Check Reg. Type button helps confirm the customer registration type.** Users can check whether the customer is Registered or Unregistered before saving.
- **Sales can be submitted to FBR after the correct customer tax number is saved.**

#### Guide
- **Go to Merchants > Customers.**
- **Add a new customer or edit an existing customer.**
- **Enter the Tax number as required by FBR.**
- **For NTN, enter only the 7 digit number before the dash. Example: if the NTN is 4454284-0, enter 4454284.**
- **For CNIC, enter all 13 digits without dashes.**
- **Click Check Reg. Type.**
- **Confirm the Sale Tax Reg. Type is correct, then save the customer.**
- **Create the sale again and submit it to FBR.**

---

### Module: FBR Digital Invoicing - Sale Submission

#### What Users Can Do Now
- **FBR Digital Invoicing has its own submission button.** Businesses with FBR Digital Invoicing included in their package will see the FBR DI Submission button.
- **The old Sync FBR/PRA Sales button remains available.** Users can still use the existing button where it is needed.
- **Users can submit pending sales to FBR Digital Invoicing from the sales list.** The button sends sales that have not already received an FBR invoice number.
- **Users can use the date filter before submitting.** This helps submit only the required sales for the selected period.
- **A result message shows how many sales were submitted and if any failed.**

#### Guide
- **Go to Sales > All Sales or POS Sales.**
- **Use the date filter if you only want to submit sales for a selected period.**
- **Click FBR DI Submission.**
- **Confirm the message on screen.**
- **Review the result message after submission finishes.**

---

### Module: Sales - Draft Auto Save

#### What Works Correctly Now
- **Draft Auto Save now saves draft sales properly.** When this setting is enabled, products added on the draft sale screen are saved automatically.
- **Auto-saved draft sales now appear in the Drafts list.** If the user closes the browser window after the sale has been auto-saved, the draft can still be found later.
- **The same draft keeps updating while the user continues editing.** This helps avoid missing or duplicate draft bills.

#### Guide
- **Go to Settings > Business Settings > Sales tab.**
- **Turn on Enable Draft Auto Save.**
- **Open Sales > Draft or create a sale as Draft.**
- **Add the customer and products.**
- **Wait a few seconds for the auto-save to complete.**
- **Open the Drafts list to continue the saved draft later.**

---

### Module: Sales - Sale Details

#### What Users Can See Now
- **Layout Name is now shown when viewing a sale.** Users can quickly see which invoice or receipt layout is linked with the sale.
- **Table bills also show the correct layout name.** This helps users confirm which bill format was used for restaurant table bills.

#### Guide
- **Go to Sales > All Sales.**
- **Find the sale you want to check.**
- **Click Actions and then View.**
- **Check the sale details window for Layout Name near the invoice and payment information.**

---

### Module: POS - Draft Auto Save

#### What Users Can Do Now
- **POS can now auto-save the current bill as a draft.** When Enable Draft Auto Save is turned on, adding products on POS saves the bill in the background.
- **The POS screen stays quiet while saving.** Users can keep billing without extra auto-save messages appearing on screen.
- **Closing POS after auto-save will keep the draft available.** The saved draft can be opened again from the draft list or recent transactions.
- **Finishing the sale uses the saved draft.** When the user completes checkout, the draft becomes the final sale instead of leaving an extra draft behind.

#### Guide
- **Go to Settings > Business Settings > Sales tab.**
- **Turn on Enable Draft Auto Save.**
- **Open POS.**
- **Select the customer and add products to the bill.**
- **Wait a few seconds while the bill is saved in the background.**
- **Open Recent > Draft or the Drafts list to find the saved draft.**
- **Complete checkout as usual when the customer is ready to pay.**

---

### Module: POS - Recent Transactions Draft Tab

#### What Works Correctly Now
- **Auto-saved draft bills now show their correct total in POS Recent Transactions.** The Draft tab no longer shows 0.00 for a saved draft bill that has products.
- **Auto-saved draft bills now show an Auto Saved label.** Users can quickly identify which draft was saved automatically.
- **The Draft tab total now includes the correct draft bill amount.**

#### Guide
- **Open POS.**
- **Click Recent.**
- **Open the Draft tab.**
- **Check the bill amount and the Auto Saved label beside auto-saved draft bills.**
- **Select the draft and click Edit to continue the bill.**

---

### Module: Invoice Layout - Subtotal Labels

#### What Users Can Do Now
- **Subtotal labels can now be printed in bold.** Users can choose bold printing separately for Subtotal Exc. Tax and Subtotal Inc. Tax.
- **The Bold option is shown beside each subtotal label field.** This makes it easier to turn bold printing on or off while editing the invoice layout.
- **When Bold is selected, both the title and amount print in bold.** This helps important subtotal lines stand out on the printed invoice or receipt.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new invoice layout or edit an existing one.**
- **Open the Total Details section.**
- **Enter the Subtotal Exc. Tax Label or Subtotal Inc. Tax Label.**
- **Tick Bold beside the label you want to highlight.**
- **Save the invoice layout and print an invoice to see the bold subtotal line.**

---

### Module: Invoice Layout - Total Balance Due Label

#### What Looks Cleaner Now
- **Total Balance Due Label is easier to use on invoice layout Add and Edit pages.**
- **The Print option is now shown beside the Total Balance Due Label field.** Users can turn printing on or off from the same line.
- **The old long option name has been changed to Print.** This makes the setting simpler to understand.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new invoice layout or edit an existing one.**
- **Open the Total Details section.**
- **Find Total Balance Due Label (Sales List).**
- **Tick Print if you want the total balance due to appear on the invoice.**
- **Save the invoice layout.**

---

### Module: Invoice Layout - Commission Agent

#### What Looks Cleaner Now
- **Commission agent settings are now easier to use.** The Show commission agent option is shown beside the Commission agent label field.
- **Users can turn the commission agent name on or off from the same line where they set its label.** This keeps the invoice layout form cleaner and easier to understand.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new invoice layout or edit an existing one.**
- **Find Commission agent label.**
- **Enter the label name you want to print.**
- **Tick Show commission agent if you want the commission agent to appear on the invoice.**
- **Save the invoice layout.**

---

### Module: Invoice Layout - Sales Person

#### What Looks Cleaner Now
- **Sales person settings are now easier to use.** The Show Sales Person option is shown beside the Sales Person Label field.
- **Users can turn the sales person name on or off from the same line where they set its label.** This keeps the invoice layout form cleaner and easier to understand.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new invoice layout or edit an existing one.**
- **Find Sales Person Label.**
- **Enter the label name you want to print.**
- **Tick Show Sales Person if you want the sales person to appear on the invoice.**
- **Save the invoice layout.**

---

### Module: Invoice Layout - SKU

#### What Looks Cleaner Now
- **SKU settings are now easier to use.** The Show SKU option is shown beside the SKU Label field.
- **Users can turn SKU printing on or off from the same line where they set its label.** This keeps the invoice layout form cleaner and easier to understand.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new invoice layout or edit an existing one.**
- **Find SKU Label.**
- **Enter the label name you want to print.**
- **Tick Show SKU if you want the SKU to appear on the invoice.**
- **Save the invoice layout.**

---

### Module: Invoice Layout - Alternate SKU

#### What Looks Cleaner Now
- **Alternate SKU settings are now easier to use.** The Show Alternate SKU option is shown beside the Alternate SKU Label field.
- **Users can turn alternate SKU printing on or off from the same line where they set its label.** This keeps the invoice layout form cleaner and easier to understand.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new invoice layout or edit an existing one.**
- **Find Alternate SKU Label.**
- **Enter the label name you want to print.**
- **Tick Show Alternate SKU if you want the alternate SKU to appear on the invoice.**
- **Save the invoice layout.**

---

### Module: Invoice Layout - Second Tax

#### What Looks Cleaner Now
- **Second tax settings are now easier to use.** The Show Second Tax on Bill option is shown beside the Select Second Tax field.
- **Users can choose the second tax and turn it on for the bill from the same line.** This keeps the invoice layout form cleaner and easier to understand.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new invoice layout or edit an existing one.**
- **Find Select Second Tax.**
- **Choose the tax you want to use as the second tax.**
- **Tick Show Second Tax on Bill if you want it to appear on the bill.**
- **Save the invoice layout.**

---

### Module: Invoice Layout - Customer Information

#### What Looks Cleaner Now
- **Customer information settings are now easier to use.** The Show Customer information option is shown beside the Customer Label field.
- **Users can turn customer information on or off from the same line where they set its label.** This keeps the invoice layout form cleaner and easier to understand.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add a new invoice layout or edit an existing one.**
- **Find Customer Label.**
- **Enter the label name you want to print.**
- **Tick Show Customer information if you want customer details to appear on the invoice.**
- **Save the invoice layout.**

---

### Module: Purchases - Product Table

#### What Looks Cleaner Now
- **Purchase product tables now have easier column names.** Columns such as Qty, Scheme Qty, Unit Cost, Discounted Cost, Tax, Tax Amount, Cost Inc. Tax, Line Total, and GP % are easier to understand at a glance.
- **Tax selection is now clearer.** The Tax column is used for choosing the tax, while Tax Amount and Line Total are shown separately.
- **Tax amounts are easier to read.** Product tax amounts now show as plain numbers without repeating the currency symbol in each row.
- **Price headings are cleaner.** Currency symbols now appear neatly under most price headings, while Sell Price stays compact on one line.
- **Quantity columns use space better.** Quantity and Scheme Quantity columns now adjust more naturally instead of taking unnecessary width.
- **The same cleaner table is available across purchase work.** These improvements apply on Add Purchase, Edit Purchase, Add Purchase Order, and Edit Purchase Order.

#### Guide
- **Go to Purchases > Add Purchase or edit an existing purchase.**
- **You can also open Add Purchase Order or edit an existing purchase order.**
- **Add or review products in the product table.**
- **Use the shorter column names to enter quantity, cost, discount, tax, and totals more easily.**
- **Select tax from the Tax column and review the tax amount beside it.**

---

### Module: Purchases - Add Purchase Table

#### What Looks Cleaner Now
- **Quantity unit boxes are now smaller on Purchase and Purchase Order forms.** The unit beside Quantity and Scheme Quantity now takes less space, similar to the discount type box.
- **Product rows have more room for prices and totals.** This makes the purchase table easier to read on smaller screens.

#### Guide
- **Go to Purchases > Add Purchase, edit a purchase, or open Purchase Order add/edit.**
- **Add or review products in the table.**
- **Check the Quantity and Scheme Quantity columns.**
- **The unit box beside each quantity now appears in a compact size.**

---

### Module: Purchases - Product Tax

#### What Users Can Do Now
- **Users can apply one product tax to all products on Purchase and Purchase Order forms.** Click the Tax column heading, select the tax, and apply it to all product rows together.
- **The purchase totals update after the tax is applied.** Each product line recalculates using the selected tax.

#### Guide
- **Go to Purchases > Add Purchase, edit a purchase, or open Purchase Order add/edit.**
- **Add or review products in the table.**
- **Click the Tax column heading.**
- **Select the tax.**
- **Click Apply to update all products.**

---

### Module: POS - Keyboard Shortcuts Help

#### What Works Correctly Now
- **Keyboard shortcuts help window now opens properly on POS.** When users press F7, the shortcut help window appears clearly on screen.
- **Users can review POS shortcut keys without the window being hidden by the page overlay.**

#### Guide
- **Open POS.**
- **Press F7.**
- **Review the available shortcut keys.**
- **Close the window when finished.**

---

### Module: Sales, Purchases and Stock - Product Search

#### What Works Better Now
- **Product Search now opens faster on sales, purchase, and stock screens.** Users see the product search window with less waiting.
- **Users can search and select products more quickly while entering sales, returns, purchases, purchase orders, stock transfers, and stock adjustments.**
- **Opening Product Search again on the same page feels smoother.**

#### Guide
- **Open POS, Add Sale, Edit Sale, Add Sale Return, Edit Sale Return, Add Purchase, Edit Purchase, Add Purchase Order, Edit Purchase Order, Stock Transfer, or Stock Adjustment.**
- **Press F10 or click the Product Search button.**
- **Type the product name or SKU.**
- **Select the product and continue your work.**

---

### Module: POS - Product Discounts

#### What Works Correctly Now
- **Bulk product discount window now opens properly on POS.** When users click the Discount column heading, the discount window appears clearly on screen.
- **Users can apply one discount to all products in the sale.** Enter the discount once and apply it to all product rows together.

#### Guide
- **Open POS.**
- **Add products to the sale.**
- **Click the Discount column heading.**
- **Enter the discount.**
- **Click Apply to update all products in the sale.**

---

### Module: POS - Product Tax

#### What Works Correctly Now
- **Bulk product tax window now opens properly on POS.** When users click the Tax column heading, the tax window appears clearly on screen.
- **Users can apply one tax selection to all products in the sale.** Select the tax once and apply it to all product rows together.

#### Guide
- **Open POS.**
- **Add products to the sale.**
- **Click the Tax column heading.**
- **Select the tax.**
- **Click Apply to update all products in the sale.**

---

### Module: Purchases - Product Discounts

#### What Works Correctly Now
- **Bulk product discount window now opens properly on Purchase and Purchase Order forms.** When users click the Discount column heading, the discount window appears clearly on screen.
- **Users can apply one discount to all products.** Enter the discount percentage once and update all product rows together.

#### Guide
- **Go to Purchases > Add Purchase, edit a purchase, or open Purchase Order add/edit.**
- **Add or review products in the table.**
- **Click the Discount column heading.**
- **Enter the discount percentage.**
- **Click Update to apply the discount to all products.**

---

### Module: Invoice Layout - Receipt Designs

#### What Users Can Do Now
- **New receipt layout Slim 6 is now available.** Users can select it from Invoice Layout design options.
- **Slim 6 follows the Slim 4 receipt style with clearer boxed product and totals sections.** This makes product lines and bill totals easier to read on 80mm receipt prints.

#### What Looks Cleaner Now
- **Invoice heading spacing is now tighter on Slim receipt designs.** The Invoice title no longer leaves extra blank space above or below it.
- **Extra blank space after Total Due has been reduced.** Receipt notes now appear closer to the totals section.
- **KOT and POS Bill prints now use the same cleaner spacing.** This helps kitchen and POS bill receipts look shorter and neater.
- **Slim for Purchase and Slim for Expense prints also have cleaner spacing.** Extra blank receipt space has been removed from these designs.

#### Guide
- **Go to Settings > Invoice Settings > Invoice Layout.**
- **Add or edit an invoice layout.**
- **Open the Invoice Layout tab.**
- **Choose Slim 6 if you want the new boxed receipt style.**
- **Use Slim, KOT, POS Bill, Slim for Purchase, or Slim for Expense as usual to see the cleaner spacing on prints.**

---

### Module: Sales - Offline Workstation

#### What Users Can Do Now
- **Offline workstations can now continue sales even when an item has no stock.** Cashiers will not be stopped by the Allow Sale if No Stock setting while working on the offline system.
- **Sales can be completed first and reviewed after sync.** This helps the branch keep billing customers when live stock is not fully updated.

#### Guide
- **Open POS or Sales on the offline workstation.**
- **Add the customer and products as usual.**
- **Complete the sale even if the product stock is showing zero or less.**
- **Sync the offline workstation later so the sale is sent to the live system.**

---

### Module: Products - Products Note

#### What Users Can Do Now
- **Products Note is now available under Products after Add Product.** Users can open it directly from the sidebar.
- **Product-specific notes can now be recorded with a priority status.** Each note stores the selected product, priority, note text, creator, and created date.
- **The Product Notes list includes report filters.** Users can filter notes by product, priority status, and deleted records.
- **Notes can be added and edited in a modal.** Users select a product, choose Low, Medium, High, or Urgent priority, and enter the note text.
- **Deleted notes can be reviewed and restored.** Enable Show Deleted to see removed notes.

#### Guide
- **Go to Products > Products Note.**
- **Click Add.**
- **Select the product.**
- **Choose the priority status.**
- **Enter the note and click Save.**
- **Use the filters to review notes by product or priority.**

---

### Module: Merchants - Walk-In Customer Ledger

#### What Works Better Now
- **Walk-In Customer ledger now opens properly even when it has many sales.** Users can view the ledger without the page staying blank.
- **Large ledgers are easier to browse.** The ledger is shown in smaller pages, so users can move through the records using Previous and Next buttons.
- **A loading message is shown while the ledger is opening.** Users can see that the system is working instead of waiting on an empty area.
- **Print and PDF options still show the full ledger statement.** Users can continue printing or saving the complete ledger when needed.

#### Guide
- **Go to Merchants > Customers.**
- **Open Walk-In Customer.**
- **Open the Ledger tab.**
- **Select the date range and business location if needed.**
- **Use the Previous and Next buttons to move through the ledger records.**
- **Click Print A4 or PDF when you need the full ledger statement.**

---

### Module: Merchants - Contact Ledger Print

#### What Looks Cleaner Now
- **Contact ledger print title is now shorter.** The print page now shows only the ledger name and format, such as Ledger - Format 1.
- **Important ledger details are shown in one line.** Users can see Contact ID, contact type, ledger format, and date range together at the top.
- **Contact name and mobile are no longer repeated at the top.** These details remain available in the To section of the ledger print.
- **The extra line above the ledger table has been removed.** The print page no longer repeats the message about showing invoices and payments between dates.
- **A4 print pages now use space better.** Small sections such as ageing details can appear on the previous page when there is enough space.
- **Empty extra sections no longer add unnecessary pages.** This helps avoid blank-looking pages in the ledger print preview.

#### Guide
- **Go to Merchants > Suppliers or Merchants > Customers.**
- **Open the contact ledger.**
- **Select the date range and ledger format.**
- **Click Print A4.**
- **Review the cleaner heading, one-line filter information, and page layout before printing.**

---

### Module: Reports - Profit / Loss PDF Export

#### What Works Correctly Now
- **Profit / Loss PDF export now fits properly on the page.** The right-side report title, table heading, and amount column no longer cut off in the exported PDF.
- **Product profit report PDFs are easier to read.** Product names and gross profit amounts stay inside the printable page area.

#### Guide
- **Go to Reports > Profit / Loss Report.**
- **Open the Products tab.**
- **Select the date range and location if needed.**
- **Click PDF to export the report.**
- **Open the PDF and check that the right-side amounts are fully visible.**

---

### Module: Reports - Print A4 PDF Export

#### What Works Better Now
- **Print A4 PDF exports now fit better across reports.** Reports that use the Print A4 style now keep headings, tables, totals, and page numbers inside the printable page area.
- **Right-side columns are less likely to cut off in exported PDFs.** Amount columns and report titles now have safer spacing when saved as PDF.
- **PDF pages now match the A4 page size more closely.** This helps printed reports look closer to the on-screen Print A4 preview.

#### Guide
- **Open any report that has Print A4 or PDF export.**
- **Choose the filters you need.**
- **Click PDF to export the report.**
- **Open the PDF and confirm the right-side headings and amount columns are fully visible.**

---

## Version 8.91.9

**Release Date:** 2026-07-13

---

### Module: Superadmin - Business List

#### What Works Correctly Now
- **Login as button is now disabled for inactive businesses.** Superadmin users will not be logged out by mistake when a business is inactive.
- **Inactive businesses still show the Activate button.** Activate the business first if you need to open it.
- **After the business is active, Login as username can be used normally.**

#### Guide
- **Go to Superadmin > Businesses.**
- **Find the business you want to open.**
- **If the business is inactive, click Activate first.**
- **After activation, click Login as username.**

---

### Module: Contacts - Ledger Print

#### What Works Correctly Now
- **Contact Ledger A4 preview now opens in proper pages.** Users no longer see the ledger as one very long page.
- **Downloaded Contact Ledger PDF now keeps the table aligned.** The ledger rows stay inside the page and do not shift to the side.
- **Contact Ledger PDF pages now continue neatly.** The PDF no longer splits one page into broken pieces.
- **Page numbers are easier to follow.** The page count shown in the ledger copy matches the pages in the PDF.

#### Guide
- **Open Contacts.**
- **Open the customer or supplier.**
- **Go to the Ledger tab.**
- **Choose the date range and ledger format.**
- **Click Print A4 to check the page preview.**
- **Click PDF if you need to download a PDF copy.**

---

### Module: Reports - Payment Reports

#### What Works Correctly Now
- **Sale Payment Report Detail print now opens normally.** Users can open the detail print view even when no customer, location, or payment method is selected.
- **Sale Payment Report PDF now fits on the page.** Right-side columns such as Customer Group and Payment Note stay visible.
- **Sale Payment Report PDF no longer adds a blank extra page when the report fits on one page.**
- **Purchase Payment Report print and PDF copies also follow the same cleaner page layout.**

#### Guide
- **Go to Reports > Sale Payment Report.**
- **Open the Detail tab.**
- **Choose the date range and filters if needed.**
- **Click Print A4 to check the print preview.**
- **Click PDF if you need to download a PDF copy.**
- **For supplier payments, use Reports > Purchase Payment Report and follow the same steps.**

---

### Module: Sales - Add Sale Payment

#### What Users Can Do Now
- **More than one payment row can now be added on the Add Sale page.** This helps when a customer pays the same sale using more than one payment method.
- **Each payment row can have its own amount, payment date, and payment method.**
- **The new row starts with the remaining balance.** This makes it quicker for staff to complete split payments.

#### Guide
- **Go to Sales > Add Sale.**
- **Add the customer and sale items.**
- **Scroll to the Add Payment section.**
- **Click Add Payment Row.**
- **Enter the amount and choose the payment method for the new row.**
- **Add more rows if the customer is paying in more than one way.**
- **Save the sale when all payments are entered.**

---

### Module: POS - Big Buttons Screen

#### What Users Can Do Now
- **Big Buttons POS screen is easier to use for checkout.** The payment buttons are now shown clearly as Pay, Card, and Cash.
- **Cash is now available as Express Checkout.** Click Cash to finish a cash sale directly without opening the payment window.
- **Card can now finish the sale directly.** Click Card to complete a card sale without opening the multi-pay window.
- **Pay still opens the Multi-Pay payment window.** Use Pay when the customer is paying with more than one payment method.
- **The Keyboard button can open the Windows on-screen keyboard.** This helps touchscreen users enter product names, customer names, and other details.
- **The number keypad can type into the selected field.** Tap a quantity, search, or amount field, then use the on-screen number buttons to enter values.
- **The Logout button signs the user out directly.** After logout, the system returns to the login page.
- **The Home button takes the user back to the dashboard/home page.**
- **Product cards now show current stock on hand.** Users can see available quantity such as **5.00 PCS** before adding an item to the bill.

#### What Looks Different
- **Cash button is light green.** It is easier to recognize as the quick cash checkout button.
- **Pay, Card, and Cash buttons now stay in one row.** The buttons adjust their width to fit the screen and should not move to the next line.
- **Checkout buttons are clearer for staff.** Pay is used for Cash / Multi-pay, Card is used for Chip & PIN, and Cash is used for Express Checkout.

#### What Works Correctly Now
- **Pay button opens the Multi-Pay payment window properly.** The screen no longer appears stuck when Pay is clicked.
- **Payment errors are easier to see while using Multi-Pay.** If something is missing or incorrect, the message appears on the payment window so staff know what to fix.
- **Product list loads normally on the Big Buttons screen.** Users should no longer see a failed-to-load message when opening or refreshing product buttons.
- **Products with available stock can be added to the bill.** The system no longer shows an out-of-stock message for items that still have stock available.

#### Guide
- **Go to Settings > Business Settings > POS tab.**
- **Set POS Screen Interface to Big Buttons.**
- **Open the POS screen.**
- **Click a product card to add the item to the bill.**
- **Check the stock label on the product card before adding items.**
- **Click Pay to use Multi-Pay.**
- **Click Card to finish a card payment directly.**
- **Click Cash to finish a cash payment directly.**
- **Click Keyboard when the Windows on-screen keyboard is needed.**
- **Click any quantity, search, or amount field, then use the number keypad to enter values.**
- **Click Home to return to the dashboard/home page.**
- **Click Logout to sign out and return to the login page.**

---

### Module: Business Settings - Payments

#### What Users Can Do Now
- **User selection can now be required on payment screens.** A new **Is User required on payments** option is available in Business Settings.
- **When this option is turned on, staff must choose a user before saving a payment.**
- **This applies when adding or editing payments.** It works for advance deposits, customer payments, supplier payments, and purchase payments.

#### What Works Correctly Now
- **Payments cannot be saved without a user when the setting is enabled.** Staff will need to select a user first.
- **Edited payments keep or update the selected user properly.**

#### Guide
- **Go to Settings > Business Settings > Payment tab.**
- **Tick Is User required on payments.**
- **Save the settings.**
- **Open any payment window.**
- **Choose a user before saving the payment.**

---

### Module: POS - Cash Drawer

#### What Users Can Do Now
- **Cash drawer can now be enabled per workstation.** Admins can choose which counter or computer is allowed to open the cash drawer.
- **Manual cash drawer opening can be password protected.** If enabled, the cashier must enter their password before opening the drawer manually.
- **Cash drawer access can now be allowed per user.** Admins can choose which cashiers are allowed to open the drawer from POS.
- **The cash drawer now opens before receipt printing starts.** This helps the cashier prepare change while the receipt is printing.
- **The Big Buttons screen Open Till button now opens the cash drawer.** Cashiers using the Big Buttons POS screen can open the till from the footer button.

#### What Is Easier Now
- **Password entry is faster.** When the password box opens, the cursor is already inside the password field.
- **Cashiers can press Enter after typing the password.** The Open button is selected automatically, so the cashier does not need to use the mouse.
- **Cash drawer settings are clearer.** Workstation settings and user POS settings now show separate options for drawer hardware and cashier permission.

#### Guide
- **Go to Business Location > Settings.**
- **Open the Workstation tab.**
- **Add or edit the workstation used by the counter.**
- **Turn on Enable Cash Drawer (POS Printer).**
- **Turn on Password Protected to Open Cash Drawer if a password should be required.**
- **Go to Users > Settings > POS for the cashier.**
- **Turn on Allow to Open Cash Drawer.**
- **Save the settings.**
- **Open POS and use the cash drawer button or the Big Buttons Open Till button.**

---

### Module: Documentation - Desktop App Guide

#### What Users Can Do Now
- **A new {application_name} Desktop App guide has been added to Documentation.**
- **Users can now read simple setup help for the desktop app, connection settings, printer selection, cash drawer setup, and local transaction export.**
- **The guide uses the app name saved in Superadmin > Application Settings.** It does not list different desktop app brand names.

#### Guide
- **Go to Documentation.**
- **Open the {application_name} Desktop App section.**
- **Read the setup steps for connection, printers, cash drawer, and local export.**

---

### Module: Products and POS - Edit Price on Sale

#### What Users Can Do Now
- **Product prices can be changed at the time of sale.** A new **Edit Price on Sale** option is available on the Add Product and Edit Product screens.
- **POS shows the current selling price before adding the item.** When this option is enabled for a product, adding that product on POS opens a price window with the current selling price already filled in.
- **Cashiers can type a new price and press Enter.** The entered price is applied to that product line on the current sale.
- **The saved product price is not changed.** The new price is used only for that sale line.
- **The same product can be added more than once with different prices.** If **Edit Price on Sale** is enabled, POS adds the product as a new line each time instead of increasing the old line quantity.
- **This works even when Sales Item Addition Method is set to increase the item quantity if it already exists.**

#### Guide
- **Go to Products > Add Product or Products > Edit Product.**
- **Tick Edit Price on Sale.**
- **Save the product.**
- **Open POS.**
- **Add that product to the sale.**
- **When the price window opens, keep the existing price or enter a new price.**
- **Press Enter or click Update.**
- **The product appears on the sale with the selected price.**
- **Add the same product again if you need another line with a different price.**

---

## Version 8.91.8

**Release Date:** 2026-07-12

---

### Module: Roles - Manufacturing Location Access

#### What Users Can Do Now
- **Manufacturing permissions now have location choices.** Production, Demand Order, Demand Order Report, Demand Ingredient Report, Manufacturing Report, Productions Report, and Productions & Stock Transfers Product Summary can be set to Own Location or All Locations.
- **Own Location keeps users limited to their assigned business locations.**
- **All Locations lets users view records from every business location for the selected Manufacturing permission.**
- **Manufacturing pages and report popups/prints follow the same role setting.**

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Manufacturing tab.**
- **Tick the Manufacturing permission this role should use.**
- **Choose Own Location or All Locations under that permission.**
- **Save the role and open the matching Manufacturing page or report with that user.**

---

### Module: Sales and POS - Report Filters

#### What Users Can Do Now
- **Station filter is now included inside Sources.** Users no longer need to use a separate Station dropdown on the Sales list and POS Sales list.
- **Sales can be filtered from one place.** Open Sources and choose either a sale source or a station/workstation.
- **The filter area is cleaner and easier to use.** Station and Sources are now handled together, so users have fewer separate boxes to check.

#### Guide
- **Open Sales list or POS Sales list.**
- **Open Report Filters.**
- **Use the Sources dropdown.**
- **Choose All to see every sale.**
- **Choose a source to see sales from that source.**
- **Choose a station/workstation to see sales from that station.**

---

### Module: Roles - Main List Location Access

#### What Users Can Do Now
- **Expense, Stock Adjustment, Stock Transfer, Purchases, Sales, and POS tabs now have their own location choice.** Users can select Own Location or All Locations under each tab.
- **Own Location keeps users limited to their assigned business locations.**
- **All Locations lets users view records from every business location on that tab's main list.**
- **Stock Transfer Own Location includes transfers sent from or received into the user's allowed location.**

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Expense, Stock Adjustment, Stock Transfers, Purchases, Sales, or POS tab.**
- **Choose Own Location or All Locations at the top of the tab.**
- **Save the role and open the matching list with that user.**

---

### Module: Roles - Accounting Report Access

#### What Users Can Do Now
- **Accounting Reports no longer use one single View Reports permission.** Each accounting report can now be allowed separately.
- **Each accounting report now has its own location choice.** Users can select Own Location or All Locations for the report they are allowed to view.
- **The Accounting Reports page only shows reports the user is allowed to open.**
- **Ledger, Cash Flow, Trial Balance, Balance Sheet, Profit and Loss, ageing reports, Daily Transactions, and Chart of Account Report can now be controlled separately.**

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Accounting tab.**
- **Go to Reports.**
- **Tick only the accounting reports this role should use.**
- **Choose Own Location or All Locations under each selected report.**
- **Save the role and open Accounting Reports with that user.**

---

### Module: Roles - Accounting Entry List Access

#### What Users Can Do Now
- **Journal Entry list now has its own location choice.** Under View Journal, users can select Own Location or All Locations.
- **Transfer Entry list now has its own location choice.** Under View Transfer, users can select Own Location or All Locations.
- **Own Location keeps users limited to their assigned business locations.**
- **All Locations lets users view entries from every business location on these lists.**

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Accounting tab.**
- **Go to Journal Entry or Transfer.**
- **Choose Own Location or All Locations under the View permission.**
- **Save the role and open the Journal Entry or Transfer Entry list with that user.**

---

### Module: Roles - Project and Installment Permissions

#### What Users Can Do Now
- **Project permissions are now grouped into clear sections.** Dashboard, Projects, Tasks, Time Logs, Documents & Notes, Stock, Invoices, Reports, and Settings are easier to review.
- **Installment permissions are now grouped into clear sections.** Dashboard, Installment access, Installment Plans, Collection, Reports, and Settings are easier to review.
- **The permissions themselves stay the same.** The role screen is cleaner, but saved access works the same way.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Project tab or Installment tab.**
- **Use each section's Select all option when you want to allow the full section.**
- **Save the role after choosing the needed permissions.**

---

### Module: Roles - Profit / Loss Report Access

#### What Users Can Do Now
- **Profit / Loss Report now has its own location choice.** Under View profit/loss report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Profit / Loss report permission.
- **The same choice applies when using the report.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Admin Reports.**
- **Tick View profit/loss report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Profit / Loss Report with that user and confirm the location access.**

---

### Module: Roles - Purchase & Sell Report Access

#### What Users Can Do Now
- **Purchase & Sell Report now has its own location choice.** Under View purchase & sell report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Purchase & Sell report permission.
- **The same choice applies when using the report.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Admin Reports.**
- **Tick View purchase & sell report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Purchase & Sell Report with that user and confirm the location access.**

---

### Module: Roles - Tax Report Access

#### What Users Can Do Now
- **Tax Report now has its own location choice.** Under View Tax report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Tax Report permission.
- **The same choice applies when using the report.** The report screen, location filter, print, PDF, Excel, and GST report screens follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Admin Reports.**
- **Tick View Tax report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Tax Report with that user and confirm the location access.**

---

### Module: Roles - Expense Report Access

#### What Users Can Do Now
- **Expense Report now has its own location choice.** Under View expense report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Expense Report permission.
- **The same choice applies when using the report.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Admin Reports.**
- **Tick View expense report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Expense Report with that user and confirm the location access.**

---

### Module: Roles - Activity Log Report Access

#### What Users Can Do Now
- **Activity Log Report now has its own location choice.** Under View Activity Log Report, users can select Own Location or All Locations.
- **All-location access is easier to manage.** Admin users can set Activity Log Report location access directly below the main report permission.
- **The same choice applies when using the report.** The report screen, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Admin Reports.**
- **Tick View Activity Log Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Activity Log Report with that user and confirm the location access.**

---

### Module: Roles - POS Report Location Access

#### What Users Can Do Now
- **Register Report now has its own location choice.** Under View register report, users can select Own Location or All Locations.
- **Summary Income Report now has its own location choice.** Under View summary income report, users can select Own Location or All Locations.
- **Sales Representative Report now has its own location choice.** Under View sales representative report, users can select Own Location or All Locations.
- **Types of Service Report now has its own location choice.** Under View Types of Service Report, users can select Own Location or All Locations.
- **The old separate All Locations checkboxes have been removed.** Location access is now selected directly under each main report permission.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to POS Reports.**
- **Tick the report the user should access.**
- **Choose Own Location or All Locations under that report.**
- **Save the role.**
- **Open the report with that user and confirm the location access.**
- **For Types of Service Report, check Sales Reports if it is not shown under POS Reports.**

---

### Module: Roles - Report 606 Purchase Access

#### What Users Can Do Now
- **Report 606 (Purchase) now has its own location choice.** Under Report 606 (Purchase), users can select Own Location or All Locations.
- **Report 606 location access can be managed separately.** Giving All Locations for the Purchase & Sell Report no longer has to control Report 606.
- **The same choice applies when using Report 606.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Purchase Reports.**
- **Tick Report 606 (Purchase).**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Report 606 (Purchase) with that user and confirm the location access.**

---

### Module: Roles - Report 607 Sale Access

#### What Users Can Do Now
- **Report 607 (Sale) now has its own location choice.** Under Report 607 (Sale), users can select Own Location or All Locations.
- **Report 607 location access can be managed separately.** Giving All Locations for the Purchase & Sell Report no longer has to control Report 607.
- **The same choice applies when using Report 607.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Sales Reports.**
- **Tick Report 607 (Sale).**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Report 607 (Sale) with that user and confirm the location access.**

---

### Module: Roles - Sale Invoices Report Access

#### What Users Can Do Now
- **Sale Invoices Report now has its own location choice.** Under View Sale Invoices Report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Sale Invoices Report permission.
- **Cost value and profit can be hidden.** Use Hide Cost value & Profit to stop users from seeing cost, purchase, and profit amounts in the detailed Sale Invoices Report, print, PDF, and Excel output.
- **The same choice applies across the report.** Totals, Summary, Detailed view, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Sales Reports.**
- **Tick View Sale Invoices Report.**
- **Choose Own Location or All Locations.**
- **Tick Hide Cost value & Profit if this user should not see cost or profit amounts.**
- **Save the role.**
- **Open Sale Invoices Report with that user and confirm the location and value access.**

---

### Module: Roles - Sales Reports Access

#### What Users Can Do Now
- **Sale Invoices Report now has its own location choice.** Users can select Own Location or All Locations under the main report permission.
- **Sales & Returns Report now has its own location choice.** Users can select Own Location or All Locations under the main report permission.
- **Product Sale Report now has its own location choice.** Users can select Own Location or All Locations under the main report permission.
- **Sale Payment Report now has its own location choice.** Users can select Own Location or All Locations under the main report permission.
- **Sales Analysis Report now has its own location choice.** Users can select Own Location or All Locations under the main report permission.
- **Trending Product Report now has its own location choice.** Users can select Own Location or All Locations under the main report permission.
- **Payment Recovery Report now has its own location choice.** Users can select Own Location or All Locations under the main report permission.
- **Discounts Report now has its own location choice.** Users can select Own Location or All Locations under the main report permission.
- **Stock Performance Report now has its own location choice.** Users can select Own Location or All Locations under the main report permission.
- **Old separate All Locations checkboxes have been removed.** Location access is now selected directly under each report permission.
- **Sale Invoices Report can hide cost and profit values.** Use Hide Cost value & Profit to hide cost, purchase, and profit amounts from users.
- **Product Sale Report can hide values separately.** Use Hide Cost value & Profit to hide cost and profit amounts, and Hide Sale value to hide sale amount columns.
- **Stock Performance Report can hide cost and profit values.** Use Hide Cost value & Profit to hide cost, stock value, average cost, profit, and gross profit values.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Sales Reports.**
- **Tick the report the user should access.**
- **Choose Own Location or All Locations under that report.**
- **Tick the Hide value options if the user should not see those amounts.**
- **Save the role.**
- **Open the report with that user and confirm the location and value access.**

---

### Module: Roles - Purchase Invoices Report Access

#### What Users Can Do Now
- **Purchase Invoices Report now has its own location choice.** Under View Purchase Invoices Report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Purchase Invoices Report permission.
- **The same choice applies across the report.** The report screen, summary, detailed view, totals, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Purchase Reports.**
- **Tick View Purchase Invoices Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Purchase Invoices Report with that user and confirm the location access.**

---

### Module: Roles - Purchase Analysis Report Access

#### What Users Can Do Now
- **Purchase Analysis Report now has its own location choice.** Under View Purchase Analysis report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Purchase Analysis Report permission.
- **The same choice applies when using the report.** The report screen and print output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Purchase Reports.**
- **Tick View Purchase Analysis report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Purchase Analysis Report with that user and confirm the location access.**

---

### Module: Roles - Purchases & Returns Report Access

#### What Users Can Do Now
- **Purchases & Returns Report now has its own location choice.** Under View Purchases & Returns Report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Purchases & Returns Report permission.
- **The same choice applies when using the report.** The report screen, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Purchase Reports.**
- **Tick View Purchases & Returns Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Purchases & Returns Report with that user and confirm the location access.**

---

### Module: Roles - Product Purchase Report Access

#### What Users Can Do Now
- **Product Purchase Report now has its own location choice.** Under View Product Purchase Report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Product Purchase Report permission.
- **The same choice applies across the report.** Summary, Detailed, group-wise, Not Purchased, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Purchase Reports.**
- **Tick View Product Purchase Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Product Purchase Report with that user and confirm the location access.**

---

### Module: Roles - Purchase Payment Report Access

#### What Users Can Do Now
- **Purchase Payment Report now has its own location choice.** Under View Purchase Payment Report, users can select Own Location or All Locations.
- **The same choice applies across the report.** Summary, Supplier Summary, Detail, print, PDF, and Excel output follow the selected Own Location or All Locations access.
- **Advance payment rows also follow the selected location access.** Users with Own Location only see advance payment rows for their allowed locations.
- **All-location access is easier to manage.** Admin users can set Purchase Payment Report location access directly below the main report permission.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Purchase Reports.**
- **Tick View Purchase Payment Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Purchase Payment Report with that user and confirm the location access.**

---

### Module: Roles - Supplier & Customer Report Access

#### What Users Can Do Now
- **Supplier & Customer report now has its own location choice.** Under View Supplier & Customer report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Supplier & Customer report permission.
- **The same choice applies when using the report.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to General Reports.**
- **Tick View Supplier & Customer report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Supplier & Customer report with that user and confirm the location access.**

---

### Module: Roles - Customer Groups Report Access

#### What Users Can Do Now
- **Customer Groups Report now has its own location choice.** Under View Customer Groups Report, users can select Own Location or All Locations.
- **All-location access is easier to manage.** Admin users can set Customer Groups Report location access directly below the main report permission.
- **The same choice applies when using the report.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to General Reports.**
- **Tick View Customer Groups Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Customer Groups Report with that user and confirm the location access.**

---

### Module: Roles - Cheque Clearance Report Access

#### What Users Can Do Now
- **Cheque Clearance Report now has its own location choice.** Under View Cheque Clearance Report, users can select Own Location or All Locations.
- **All-location access is easier to manage.** Admin users can set Cheque Clearance Report location access directly below the main report permission.
- **The same choice applies when using the report.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to General Reports.**
- **Tick View Cheque Clearance Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Cheque Clearance Report with that user and confirm the location access.**

---

### Module: Roles - Items Report Access

#### What Users Can Do Now
- **Items Report now has its own location choice.** Under View Items Report, users can select Own Location or All Locations.
- **All-location access is easier to manage.** Admin users can set Items Report location access directly below the main report permission.
- **The same choice applies when using the report.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to General Reports.**
- **Tick View Items Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Items Report with that user and confirm the location access.**

---

### Module: Roles - Bookings Report Access

#### What Users Can Do Now
- **Bookings Report now has its own location choice.** Under View Bookings Report, users can select Own Location or All Locations.
- **All-location access is easier to manage.** Admin users can set Bookings Report location access directly below the main report permission.
- **The same choice applies when using the report.** The report screen, location filter, print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to General Reports.**
- **Tick View Bookings Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Bookings Report with that user and confirm the location access.**

---

## Version 8.91.7

**Release Date:** 2026-07-11

---

### Module: Roles - Product History Access

#### What Users Can Do Now
- **Product History can now be controlled from the product role permissions.** Businesses can decide which users are allowed to open product stock history.
- **Purchase price and cost details stay hidden when the user is not allowed to view purchase price.** This applies on the product history page and product history popup.
- **Product history access is easier to manage.** Admin users can give history access without automatically showing sensitive cost or purchase price information.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Product permissions section.**
- **Tick View product history if the user should be allowed to open product history.**
- **Only tick View Purchase Price for users who should see purchase price or cost information.**
- **Save the role.**
- **When that user opens Product History, purchase price and cost details will only show if View Purchase Price is allowed.**

---

### Module: Roles - Stock Quantity Report Access

#### What Users Can Do Now
- **Stock Quantity Report location access is easier to choose.** Under View Stock Quantity Report, users can now select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Stock Quantity Report permission.
- **Cost values can be hidden from the Stock Quantity Report.** Use Hide Cost value to stop users from seeing purchase-value stock amounts.
- **Sale values can be hidden from the Stock Quantity Report.** Use Hide Sale value to stop users from seeing sale-value stock amounts.
- **Stock Quantity Report follows the selected location access properly.** Users with Own Location only see their allowed locations, while users with All Locations can see all stock locations.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Stock Quantity Report.**
- **Choose Own Location or All Locations.**
- **Tick Hide Cost value if this user should not see cost or purchase value amounts.**
- **Tick Hide Sale value if this user should not see sale value amounts.**
- **Save the role.**
- **Open Stock Quantity Report with that user and confirm the location and value access.**

---

### Module: Roles - Stock Value Report Access

#### What Users Can Do Now
- **Stock Value Report now has its own location choice.** Under View Stock value Report, users can select Own Location or All Locations.
- **Cost values can be hidden from the Stock Value Report.** Use Hide Cost value to hide cost-side stock values from the report.
- **Sale values can be hidden from the Stock Value Report.** Use Hide Sale value to hide sale-side stock values from the report.
- **Stock Value Report access is cleaner.** The old View product stock value and Hide Stock / Value Report Prices checkboxes are no longer shown on the role setup page.
- **The setting applies across the Stock Value Report.** The same access is used on the main report, categorized view, location view, location details, print, PDF, and Excel export.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Stock value Report.**
- **Choose Own Location or All Locations.**
- **Tick Hide Cost value if this user should not see cost value amounts.**
- **Tick Hide Sale value if this user should not see sale value amounts.**
- **Save the role.**
- **Open Stock Value Report with that user and check the report, print, and export views.**

---

### Module: Roles - Opening Stock Report Access

#### What Users Can Do Now
- **Opening Stock Report now has its own location choice.** Under View Opening Stock Report, users can select Own Location or All Locations.
- **Opening stock cost amounts can be hidden.** Use Hide Cost value to hide Unit Price and Subtotal amounts from the Opening Stock Report.
- **Opening Stock Report now has the same value access options as the other stock reports.** Hide Cost value and Hide Sale value are shown under the report permission.
- **The setting applies across the Opening Stock Report.** The same access is used on the main report, print, PDF, and Excel export.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Opening Stock Report.**
- **Choose Own Location or All Locations.**
- **Tick Hide Cost value if this user should not see opening stock cost amounts.**
- **Tick Hide Sale value if this user should not see sale value amounts.**
- **Save the role.**
- **Open Opening Stock Report with that user and check the report, print, and export views.**

---

### Module: Roles - Product Reorder Report Access

#### What Users Can Do Now
- **Product Reorder Report now has its own location choice.** Under View Product Reorder Report, users can select Own Location or All Locations.
- **Product Reorder Report no longer depends on Stock Quantity Report for location access.** Admin users can manage Product Reorder Report location access separately.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Product Reorder Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Product Reorder Report with that user and confirm the correct locations are shown.**

---

### Module: Roles - Mismatch Quantity Report Access

#### What Users Can Do Now
- **Mismatch Quantity Report location access is easier to choose.** Under View Mismatch Quantity Report, users can select Own Location or All Locations.
- **The old separate All Locations checkbox has been removed.** Location access is now selected directly under the main Mismatch Quantity Report permission.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Mismatch Quantity Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Mismatch Quantity Report with that user and confirm the correct locations are shown.**

---

### Module: Roles - Lot Report Access

#### What Users Can Do Now
- **Lot Report now has its own location choice.** Under View Lot Report, users can select Own Location or All Locations.
- **Lot Report no longer depends on Stock Quantity Report for location access.** Admin users can manage Lot Report location access separately.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Lot Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Lot Report with that user and confirm the correct locations are shown.**

---

### Module: Roles - Stock Expiry Report Access

#### What Users Can Do Now
- **Stock Expiry Report now has its own location choice.** Under View Stock Expiry Report, users can select Own Location or All Locations.
- **Stock Expiry Report no longer depends on Stock Quantity Report for location access.** Admin users can manage Stock Expiry Report location access separately.
- **The same location choice is used when printing the report.** Print, PDF, and Excel output follow the selected Own Location or All Locations access.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Stock Expiry Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Stock Expiry Report with that user and confirm the correct locations are shown.**

---

### Module: Roles - Product Serial Report Access

#### What Users Can Do Now
- **Product Serial Report now has its own location choice.** Under View Product Serial Report, users can select Own Location or All Locations.
- **Product Serial Report no longer depends on Stock Quantity Report for location access.** Admin users can manage Product Serial Report location access separately.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Product Serial Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Product Serial Report with that user and confirm the correct locations are shown.**

---

### Module: Roles - Product Status Report Access

#### What Users Can Do Now
- **Product Status Report now has its own location choice.** Under View Product Status Report, users can select Own Location or All Locations.
- **Product Status Report no longer depends on Stock Quantity Report for location access.** Admin users can manage Product Status Report location access separately.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Product Status Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Product Status Report with that user and confirm the correct locations are shown.**

---

### Module: Roles - Combo Items Report Access

#### What Users Can Do Now
- **Combo Items Report now has its own location choice.** Under View Combo Items Report, users can select Own Location or All Locations.
- **Combo Items Report no longer depends on Stock Quantity Report for location access.** Admin users can manage Combo Items Report location access separately.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Combo Items Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Combo Items Report with that user and confirm the correct locations are shown.**

---

### Module: Roles - Stock Take Report Access

#### What Users Can Do Now
- **Stock Take Report now has its own location choice.** Under View Stock Take Report, users can select Own Location or All Locations.
- **Stock Take Report no longer depends on Stock Quantity Report for location access.** Admin users can manage Stock Take Report location access separately.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Stock Take Report.**
- **Choose Own Location or All Locations.**
- **Save the role.**
- **Open Stock Take Report with that user and confirm the correct locations are shown.**

---

### Module: Roles - Stock Adjustment Report Access

#### What Users Can Do Now
- **Stock Adjustment Report now has its own location choice.** Under View Stock Adjustment Report, users can select Own Location or All Locations.
- **Cost values can be hidden from the Stock Adjustment Report.** Use Hide Cost value to hide adjustment amount, unit price, subtotal, and other cost amounts.
- **Recovered sale value can be hidden from the Stock Adjustment Report.** Use Hide Sale value to hide the recovered amount.
- **Stock Adjustment Report now has the same value access options as the other stock reports.** Hide Cost value and Hide Sale value are shown under the report permission.
- **The setting applies across the Stock Adjustment Report.** The same access is used on the main report, summary, detailed view, product summary, print, PDF, and Excel export.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Stock Adjustment Report.**
- **Choose Own Location or All Locations.**
- **Tick Hide Cost value if this user should not see stock adjustment cost amounts.**
- **Tick Hide Sale value if this user should not see sale value amounts.**
- **Save the role.**
- **Open Stock Adjustment Report with that user and check the report, print, and export views.**

---

### Module: Roles - Stock Transfer Report Access

#### What Users Can Do Now
- **Stock Transfer Report now has its own location choice.** Under View Stock Transfer Report, users can select Own Location or All Locations.
- **Cost values can be hidden from the Stock Transfer Report.** Use Hide Cost value to hide transfer amount, unit price, subtotal, and product summary value.
- **Sale or charge values can be hidden from the Stock Transfer Report.** Use Hide Sale value to hide shipping charges.
- **The setting applies across the Stock Transfer Report.** The same access is used on the main report, totals, summary, detailed view, product summary, print, PDF, and Excel export.
- **Stock Consumption Report follows the Stock Transfer location choice.** If a user has Own Location, the Stock Consumption Report stays limited to their allowed locations. If a user has All Locations, they can use all locations.
- **Stock Consumption detailed view is safer to open.** Users can open it with Category set to All without getting an error.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **Go to Stock Reports.**
- **Tick View Stock Transfer Report.**
- **Choose Own Location or All Locations.**
- **Tick Hide Cost value if this user should not see stock transfer cost amounts.**
- **Tick Hide Sale value if this user should not see shipping charge amounts.**
- **Save the role.**
- **Open Stock Transfer Report and Stock Consumption Report with that user and check the report, print, and export views.**

---

### Module: Roles - Separate Stock Report Permissions

#### What Users Can Do Now
- **Stock Performance Report now has its own permission.** It no longer depends on the Stock Quantity Report permission.
- **Mismatch Quantity Report now has its own permission.** It can be allowed or blocked separately from Stock Quantity Report.
- **Each report can have its own location access.** Admin users can choose whether users see only their own locations or all locations for each report.
- **Report access is easier to understand.** Giving access to one stock report no longer automatically gives access to the other stock reports.

#### Guide
- **Go to Settings > Roles.**
- **Add a new role, or edit an existing role.**
- **Open the Reports tab.**
- **For Stock Performance Report, go to Sales Reports and tick View Stock Performance Report.**
- **For Mismatch Quantity Report, go to Stock Reports and tick View Mismatch Quantity Report.**
- **Choose the needed location access for each report.**
- **Save the role.**
- **Log in as that user and confirm only the allowed reports are visible.**

---

### Module: Roles - Permission Search

#### What Users Can Do Now
- **Permissions are easier to find while adding or editing a role.** A search box is now shown at the top of the Add Role and Edit Role pages.
- **Users can quickly jump to the permission they need.** Search for a permission name or section, then select the matching result.
- **The correct permission section opens automatically.** The page moves to the matching area and highlights it, so users do not need to scroll through the full role form.
- **Role setup is faster for large permission lists.** This helps when setting access for sales, purchases, products, reports, users, settings, and other sections.

#### Guide
- **Go to Settings > Roles.**
- **Click Add Role, or edit an existing role.**
- **Use the search box at the top of the page.**
- **Type the permission or section name you want to find.**
- **Select the matching result from the list.**
- **Review or tick the needed permission.**
- **Save the role when finished.**

---

### Module: Main Menu - Mobile Top Shortcuts

#### What Users Can Do Now
- **Top shortcut buttons are easier to use on mobile.** When users tap the three-dot menu, the shortcut buttons stay in one neat row.
- **Users can swipe the shortcut buttons left or right.** This makes it easier to reach all available shortcut buttons on small screens.
- **Shortcut buttons no longer hide behind the right side of the screen.** The menu now uses the available space better.
- **The shortcut buttons are easier to see and tap.** The buttons have more height and are not cut off.
- **The three-dot button is easier to reach.** Its position is adjusted for a better mobile view.

#### Guide
- **Open the software on a mobile screen or small browser size.**
- **Tap the three-dot button in the top menu.**
- **Swipe the shortcut button row left or right to see more options.**
- **Tap any shortcut button you want to use.**
- **Tap the close button to hide the shortcut row again.**

---

### Module: Business Settings - Date Range Defaults

#### What Users Can Do Now
- **Default date ranges can now be set from one place.** Users can open Business Settings and choose the starting date range for the dashboard, lists, and reports.
- **Each important page can have its own date range.** For example, Purchases can open on Today, Sales Reports can open on This Year, and Activity Log can open on Today.
- **Report filters are easier to use.** When a report is opened, the date filter starts with the saved default instead of needing to be changed every time.
- **Users can still change the date manually.** The saved option only controls what date range appears first when the page or report opens.

#### Pages Covered
- **Home / Dashboard.**
- **Sales pages:** Sale Returns and Draft Sales.
- **Purchase pages:** Purchases, Purchase Returns, Purchase Orders, and Stock Transfers.
- **Installment pages:** Installment Sales and Installment Reports.
- **HRM pages:** Leave, All Attendance, and Attendance by Date.
- **Accounting pages:** Journal Entry, Transfer, and Cash Flow.
- **Accounts pages:** Payment Account Report.
- **Other daily work pages:** To Do, Expenses, and Profit / Loss Report.

#### Reports Covered
- **Admin Reports:** Profit / Loss Report, Purchase & Sale, Tax Report, Expense Report, and Activity Log.
- **POS Reports:** Register Report, Summary Income Report, Sales Representative Report, Service Staff Report, Table Report, and Types of Service Report.
- **Sales Reports:** Report 607 (Sale), Sale Invoices Report, Sales & Returns Report, Product Sale Report, Sale Payment Report, Sales Analysis, Trending Products, Payment Recovery Report, Discounts Report, Stock Performance Report, and Product Booking Report.
- **Purchase Reports:** Report 606 (Purchase), Purchase Invoices Report, Purchases & Returns Report, Product Purchase Report, Purchase Payment Report, and Purchase Analysis.
- **Stock Reports:** Stock Quantity Report, Stock Value Report, Stock Reorder Report, Opening Stock Report, Mismatch Quantity Report, Stock Adjustment Report, Stock Take Report, Stock Transfer Report, Combo Items Report, Stock Consumption Report, Product Status Report, and Product Serial Report.
- **General Reports:** Supplier & Customer Report, Contact's Opening Balance Report, Contact's Advance Deposit Report, Customer Groups Report, Cheque Clearance Report, Items Report, and Bookings Report.
- **Accounting Reports:** Ledger Report, Cash Flow Report, Trial Balance, Balance Sheet, Profit / Loss, and Daily Transactions Report.

#### Guide
- **Go to Settings > Business Settings.**
- **Open the Date Range tab.**
- **Choose the default date range for each page or report you use.**
- **Click Update Settings.**
- **Open the page or report again. The date filter should now start with the saved date range.**
- **Change the date filter on the page anytime if you need a different period for that visit.**

---

### Module: Contacts - Contact List

#### What Users Can Do Now
- **Contact lists now open in Contact ID order.** Suppliers, customers, and combined contacts show the smaller Contact IDs first when the Contact ID column is visible.
- **Supplier IDs are easier to follow.** For example, CO0002 will appear before CO0193 on the supplier list.
- **Users can still change the order when needed.** Click any column heading to sort the list another way.

#### Guide
- **Go to Contacts and open Suppliers, Customers, or Both.**
- **Check the Contact ID column.**
- **The list should start from the smaller Contact IDs first.**
- **Click the Contact ID heading again if you want to reverse the order.**

---

### Module: Invoice Layout - Slim 4 Receipt

#### What Users Can Do Now
- **Slim 4 receipt labels now print in normal text.** Token, reference, and similar title labels no longer appear bold on the printed receipt.
- **The receipt looks cleaner and more even.** The label text now matches the regular invoice, date, and customer labels.

#### Guide
- **Go to Settings > Invoice Settings.**
- **Open the Layout tab.**
- **Use a layout with Slim 4 design.**
- **Print or preview a POS invoice.**
- **Check the Token or Ref label. It should now print in normal text.**

---

### Module: POS - Final Bill Edit

#### What Users Can Do Now
- **Token No can be entered again while editing a final POS bill.** If the token number was missing, the cashier can add it before saving the edited bill.
- **Existing Token No can be changed while editing.** If the bill already has a token number, it appears in the prompt and can be updated.
- **The Draft button is hidden on final bill edit.** Users editing a completed POS bill now see only the relevant save and payment actions.

#### Guide
- **Open POS sales and edit a completed bill.**
- **Make the needed changes.**
- **Click the final save or payment button.**
- **When the Token No box appears, enter a new token number or change the existing one.**
- **Press Enter to continue and save the bill.**
- **The Draft button will not show on the final bill edit page.**

---

### Module: POS - Close Register

#### What Users Can Do Now
- **Close Register now works properly for restricted cashiers after approval.** When a cashier needs approval to close the register, the approval login opens and accepts the authorized user's username and password.
- **The Close Register form opens after successful approval.** Cashiers can continue the closing process without refreshing the POS screen.
- **The POS screen no longer stays stuck after approval.** After the authorized user approves, the cashier can complete the register closing normally.
- **If closing is not allowed yet, users see a clear warning.** For example, if offline sales still need to be synced, the system shows a message instead of leaving the screen stuck.

#### Guide
- **Open the POS screen.**
- **Open the POS Menu from the right side.**
- **Click Close Register.**
- **Enter the authorized user's username and password when approval is required.**
- **After approval, fill in the Close Register form and close the register as usual.**
- **If a warning appears, follow the message shown on the screen, then try Close Register again.**

---

### Module: Discounts - Date Limit

#### What Users Can Do Now
- **Discounts can now be saved without a Start Date or End Date.** If both dates are left blank, the discount has no date limit.
- **Open-ended discounts can be used at any time.** These discounts can apply on POS and sales screens without needing a fixed date range.
- **Existing discount dates can be removed easily.** On the discount edit page, users can click the date or time field and press Delete or Backspace to clear it.
- **The discount list shows No Limit for blank dates.** This helps users quickly understand which discounts do not have a date limit.

#### Guide
- **Go to Discounts.**
- **Click Add, or edit an existing discount.**
- **Leave Start Date and End Date blank if the discount should have no date limit.**
- **If an old date is already selected, click the date or time field and press Delete or Backspace to remove it.**
- **Save the discount.**
- **Use POS or sales as usual. The discount can apply without a date limit.**

---

### Module: Products - Discount Promo Date Limit

#### What Users Can Do Now
- **Product Discount Promo dates are now blank by default.** When adding a product, Start Date and End Date are no longer filled automatically.
- **Product promos can be saved without a date limit.** If Start Date and End Date are left blank, the promo can apply at any time.
- **Existing product promo dates can be removed easily.** On the product edit page, users can click the promo date field and press Delete or Backspace to clear it.
- **Users can still set dates when needed.** If a promo should run for a limited period, users can select Start Date and End Date as before.

#### Guide
- **Go to Products and click Add Product, or edit an existing product.**
- **Go to the Discount Promo section near the bottom of the product form.**
- **Choose the discount type and enter the needed promo details.**
- **Leave Start Date and End Date blank if the promo should have no date limit.**
- **If an old date is already selected, click the date field and press Delete or Backspace to remove it.**
- **Save the product.**
- **Open POS and add the product. The promo can apply without a date limit.**

---

## Version 8.91.6

**Release Date:** 2026-07-10

---

### Module: POS - Item Discount

#### What Users Can Do Now
- **Default Item Discount Type now works on the POS screen.** When Fixed is selected, the item discount is treated as an amount. When Percentage is selected, the item discount is treated as a percent.
- **New POS items follow the selected default discount type.** Cashiers do not need to change the item discount type manually for every product.
- **Inline item discount is easier to use during sales.** Businesses can choose the discount style that matches their normal billing process.

#### Guide
- **Go to Settings > Business Settings.**
- **Open the Sales tab.**
- **Turn on Enable Inline Discount in Sales.**
- **Choose Default Item Discount Type: Fixed or Percentage.**
- **Save the settings.**
- **Open the POS screen and add a product.**
- **Check the item discount field. It should now use the selected default type.**

---

### Module: POS - Buy for Quantity Discount

#### What Users Can Do Now
- **Buy for Quantity discounts are clearer on the POS screen.** When an offer is set with a total price, the discount field now shows the discount as a percent instead of showing a small per-item rupee amount.
- **The subtotal still matches the offer total.** For example, if 12 items are set to sell for Rs 2,000, the POS subtotal stays Rs 2,000.
- **Cashiers can understand the discount field more easily.** The discount value and discount type now match each other, so users do not see a rupee sign beside a percentage-style value.

#### Guide
- **Go to Discounts.**
- **Create or edit a discount.**
- **Choose Buy For as the discount type.**
- **Enter the quantity and total offer price.**
- **Save the discount.**
- **Open the POS screen and add the same product.**
- **Enter the offer quantity.**
- **Check that the discount field shows a percent and the subtotal shows the offer total.**

---

### Module: Products - Discount Promo

#### What Users Can Do Now
- **Product add and edit pages now support all discount promo types.** Users can choose Fixed, Percentage, Buy For, Buy For Unit Price, or Buy Get Free directly from the product page.
- **Buy For offer fields are available on the product page.** Users can enter the offer quantity and total offer price without opening the separate Discounts page.
- **Buy For Unit Price offer fields are available on the product page.** Users can enter the offer quantity and unit offer price for the product.
- **Buy Get Free offer fields are available on the product page.** Users can enter the buy quantity and free quantity in the same Discount Promo section.
- **Discount promos saved from the product edit page now work on the POS screen.** Users can add an offer on the product page and use it during billing.

#### Guide
- **Go to Settings > Business Settings.**
- **Open the Product tab.**
- **Turn on Enable Discount Promo.**
- **Open Products and create or edit a product.**
- **Go to the Discount Promo section near the bottom of the product form.**
- **Choose the discount type you want to use.**
- **Fill in the fields shown for that discount type.**
- **Save the product.**
- **Open POS, add the product, and enter the offer quantity.**
- **The saved promo should apply while the selected dates are active.**

---

### Module: Contacts - Ledger

#### What Users Can Do Now
- **Contact ledger pages open normally.** Users can open a customer, supplier, or contact ledger without seeing an error page.
- **Ledger date filters load correctly.** The saved date range settings are ready when the ledger page opens.
- **Users can continue checking contact balances, invoices, and payments without refreshing or logging in again.**

#### Guide
- **Go to Contacts.**
- **Open the customer or supplier you want to check.**
- **Open the Ledger tab.**
- **Review the ledger details and use the date or location filters as needed.**
- **Print or download the ledger if a copy is required.**

---

### Module: POS - Sales List Navigation

#### What Users Can Do Now
- **Users can return to the POS sales list without an error.** When a cashier goes back from the POS screen, the POS sales list opens normally.
- **The POS sales list filters are ready to use.** Date, location, customer, and payment filters load normally when the page opens.
- **Cashiers can continue working without refreshing the page or logging in again.**

#### Guide
- **Open the POS screen.**
- **Use the Back button or open the POS sales list from the menu.**
- **Check that the sales list and filters appear normally.**
- **Continue searching, viewing, or adding POS sales as needed.**

---

### Module: Business Settings - Admin Access

#### What Users Can Do Now
- **Admin users can open Business Settings normally.** The Business Settings page is available from the sidebar for admin users without showing an unauthorized message.
- **The sidebar menu now matches admin access.** If an admin user is allowed to manage business settings, the Business Settings menu option stays visible and opens correctly.

#### Guide
- **Login with an admin user.**
- **Go to Settings > Business Settings from the sidebar.**
- **The Business Settings page should open normally.**
- **Use the available tabs to review or update business setup options.**

---

### Module: Products - Product Tax Fields

#### What Users Can Do Now
- **Product tax fields can now be turned on or off from Business Settings.** A new option, Enable product tax fields, is available in the Product tab.
- **When this option is turned on, product tax choices are shown on product add and edit pages.** Users can select Applicable Tax, Selling Price Tax Type, and Tax Not Applicable while creating or editing products.
- **When this option is turned off, product tax choices are hidden.** This keeps the product form simpler for businesses that do not use product-level tax.
- **Product price fields follow the same setting.** Tax-related price fields appear only when product tax fields are enabled.
- **New taxes can be added directly from the product page.** Users can click the plus button beside Applicable Tax to add a new tax rate without leaving the product add or edit page.

#### Guide
- **Go to Settings > Business Settings.**
- **Open the Product tab.**
- **Tick Enable product tax fields if you want to use tax on products.**
- **Click Update Settings.**
- **Go to Products > Add Product or edit an existing product.**
- **Use Applicable Tax, Selling Price Tax Type, and Tax Not Applicable as needed.**
- **Click the plus button beside Applicable Tax if you need to add a new tax rate.**
- **Untick Enable product tax fields if your business does not need product tax fields on product pages.**

---

### Module: Contact Payments - Payment Details

#### What Users Can Do Now
- **Customer to supplier payments are easier to understand.** The payment view now clearly shows when a customer payment is used to pay a supplier.
- **The payment title is clearer.** These payments now show the title Customer to Supplier Payment, so users can quickly understand the payment purpose.
- **From and To details are shown in the correct order.** The From contact is shown at the top, and the To contact is shown below.
- **Printed payment details are easier to follow.** Users can check who the payment came from and who it was paid to before printing or sharing the payment details.

#### Guide
- **Open the contact payment you want to check.**
- **Click View on the payment.**
- **Check that the title shows Customer to Supplier Payment.**
- **Review the From section at the top.**
- **Review the To section below it.**
- **Print or share the payment details if needed.**

---

## Version 8.91.5

**Release Date:** 2026-07-09

---

### Module: Expenses - Expense Categories

#### What Users Can Do Now
- **Expense categories can now have a monthly budget.** Users can enter a monthly budget amount while adding or editing an expense category.
- **Expense categories can be organised as sub-categories.** Users can tick Add as sub category and select a parent category when needed.
- **The Expense Categories list is easier to read.** Category Code is now shown first, followed by Category Name, Monthly Budget, Remaining Budget, and Action.
- **Users can quickly see how much monthly budget is left.** The Remaining Budget column shows the amount left for the current month.
- **Remaining Budget starts fresh every month.** When a new month starts, the remaining amount begins again from the monthly budget.
- **Expense refunds reduce the used amount.** If a refund is recorded, the remaining budget is adjusted accordingly.
- **Main categories and sub-categories still stay grouped together.** Users can expand or collapse categories to review them neatly.

#### Guide
- **Go to Expenses > Expense Categories.**
- **Click Add to create a new category, or Edit to update an existing one.**
- **Enter the Category Name, Category Code, and Monthly Budget if needed.**
- **To make it a sub-category, tick Add as sub category and select the parent category.**
- **Click Save or Update.**
- **Check the list to review Category Code, Category Name, Monthly Budget, and Remaining Budget.**
- **Use Collapse All or Expand All to show or hide sub-categories.**

---

### Module: HRM - Holidays, Leave, and Role Access

#### What Users Can Do Now
- **Holiday access can now be controlled separately.** Admins can decide who can only view holidays and who can add, edit, or delete holidays.
- **The Holiday menu is shown only to allowed users.** Staff without holiday access will not see the Holiday option.
- **The Holiday page shows actions based on access.** Users with view access can check holidays, while users with manage access can add, edit, and delete them.
- **The HRM Dashboard now follows each user's access.** Leave and holiday information is shown only to users who are allowed to view it.
- **Leave access is clearer for staff and approvers.** Staff who can apply for leave can use the Add button, and leave approvers can review leave requests.
- **HRM menus now match each user's role.** Leave, Holidays, Attendance, Employee Documents, Warnings, Awards, Announcements, and Leave Quotas are shown only to allowed users.
- **Shift management is limited to allowed HRM users.** Only users with the correct access can manage shifts.

#### Guide
- **Go to Settings > Roles.**
- **Create a new role or edit an existing role.**
- **Open the HRM / Essentials access section.**
- **Under Holidays, tick View Holidays for users who only need to see holidays.**
- **Tick Add, Edit, and Delete Holidays for users who should manage holidays.**
- **For Leave, give the user the needed leave access, such as applying for leave or approving leave.**
- **Save the role.**
- **Ask the user to open HRM and check that only the allowed HRM options are visible.**

---

### Module: Reports - Stock Transfer Report

#### What Users Can Do Now
- **The Detailed tab now shows footer totals at the bottom.** Users can see the total shipping charges, total amount, total item quantity, and product subtotal without adding them manually.
- **Amount columns now show the currency symbol in the column heading.** The values stay clean and easy to read because the currency symbol is no longer repeated beside every amount.
- **Number and amount values are now aligned to the right.** This makes totals, quantities, and amounts easier to compare across all report tabs.
- **The same clean format is used in report print and Excel output.** Users see the currency in the heading and plain numeric values in the rows.

#### Guide
- **Go to Reports > Stock Transfer Report.**
- **Open the Totals, Summary, Detailed, or Products Summary tab.**
- **Check the column headings to see the currency symbol.**
- **Read the numeric values from the right side of each number column.**
- **Open the Detailed tab to see footer totals at the bottom of the report.**
- **Use Print A4 or Export to Excel when a copy of the report is needed.**

---

### Module: Purchase Orders - Stock Level Product Load

#### What Users Can Do Now
- **Products can be prepared with Low, Medium, High, and Max stock levels.** These levels help the system know how much quantity should be ordered when stock becomes low.
- **A default supplier can be selected on the product add and edit pages.** This helps the system know which supplier should be used for each product.
- **Purchase Order add and edit pages can now load products by stock level.** Users can choose a supplier, location, and stock level, then load matching products into the purchase order.
- **Only products that have reached low stock are loaded.** If a product still has enough stock, it will not be added by the load button.
- **The selected stock level decides the order quantity.** For example, if Low is 5, Medium is 10, High is 20, and Max is 30, selecting High will load the product with quantity 20 when the product has reached low stock.
- **Supplier products are loaded based on the product's default supplier.** This helps users order only the products linked with the selected supplier.
- **Already added products are updated instead of added again.** If the same product is already in the purchase order, its quantity is changed to the selected stock level quantity.

#### Guide
- **Go to Products and add or edit a product.**
- **Select the Default Supplier for the product.**
- **Enter Low Stock Level, Medium Stock Level, High Stock Level, and Max Stock Level as needed.**
- **Save the product.**
- **Go to Purchases > Purchase Order.**
- **Click Add or edit an existing purchase order.**
- **Select the supplier and business location.**
- **Select the stock level you want to order up to, such as Low, Medium, High, or Max.**
- **Click Load Products.**
- **Check the loaded products and quantities before saving the purchase order.**

---

### Module: Settings - Search

#### What Users Can Do Now
- **Business Settings search now helps users find settings even when the typed words are not exact.** If the user types similar text, the page shows the closest matching setting.
- **Invoice Layout add and edit pages now also have a settings search field.** Users can search layout options from the top of the page instead of scrolling through all sections.
- **The best matching setting is shown under the search field.** Users can click the suggested match to go directly to that setting.
- **The correct section opens automatically.** When a setting is selected, the page opens the right tab or layout section and highlights the setting.
- **Users can see when no close match is found.** This helps users know they should try a different word.

#### Guide
- **Go to Settings > Business Settings to search business settings.**
- **Type the setting name or similar words in the search field.**
- **Check the Best match suggestion under the search field.**
- **Click the suggestion or select a result from the search list.**
- **The page will move to the matching setting and highlight it.**
- **Go to Settings > Invoice Settings > Layout tab.**
- **Click Add or Edit on an invoice layout.**
- **Use the search field at the top to find layout settings in the same way.**

---

### Module: HRM - Employee Documents

#### What Users Can Do Now
- **Employee documents can now be uploaded while adding a document.** Users can attach the document file directly from the Add Employee Document form.
- **New employee document entries appear in the list right after saving.** Users no longer need to refresh the page to see the new entry.
- **Employee document entries can now be edited.** Users can open an existing employee document, change the details, and replace the attached file if needed.
- **Users can view attached employee documents from the list.** A View button is shown when a file is attached.
- **Download is only shown when a file is attached.** If no file is attached, the View and Download buttons stay hidden so users do not click empty actions.
- **Employee document files are saved in the correct business folder.** This keeps uploaded HRM files organised for each business.

#### Guide
- **Go to HRM > More > Employee Documents.**
- **Click Add.**
- **Select the employee and enter the document details.**
- **Attach the document file.**
- **Click Save.**
- **Check the list to see the new entry immediately.**
- **Use the View button to open an attached file.**
- **Use the Download button to download an attached file.**
- **Use the Edit button to update the entry or replace the file.**
- **If no file is attached, View and Download will not be shown.**

---

### Module: Superadmin - Fix Uploads Folder

#### What Users Can Do Now
- **Fix Uploads Folder now organises more uploaded files into the correct business folder.** This includes employee documents, display screen carousel images, and quick menu images.
- **Old selected upload folders can now be cleaned up.** The tool can move files from old shared folders into the correct business folder and remove empty old folders after cleanup.
- **Display screen carousel images continue to open after cleanup.** Users can still see their saved carousel images from the Display Screen settings and customer display screen.
- **Quick menu images continue to show after cleanup.** Quick menu images remain visible on POS buttons and edit screens after files are moved.
- **The tool avoids guessing when files cannot be safely matched.** If files cannot be matched to one business automatically, the tool leaves them for review instead of moving them to the wrong place.

#### Guide
- **Go to Superadmin > Settings.**
- **Open the Maintenance Tools tab.**
- **Click Fix Uploads Folder.**
- **Wait until the page shows the cleanup result.**
- **Check Employee Documents, Display Screen carousel images, and Quick Menu images after the cleanup.**
- **If the result says some files were left for review, check those files before moving them manually.**

---

### Module: User Management - Users and Employees

#### What Users Can Do Now
- **The All users section now shows the user limit.** Users can see how many login users are already added and how many are allowed in the current package, for example All users 7/10.
- **The All Employees section now shows the employee limit when HRM & Essentials is included.** Users can see how many employees are already added and how many are allowed in the current package.
- **Businesses without HRM & Essentials no longer see the All Employees section.** This keeps the Users List focused on the features available in the package.
- **The All Merchants section is only shown when contact login records exist.** If no contact login has been created, the empty merchants section is hidden.
- **Unlimited packages are shown clearly.** If the package allows unlimited users or employees, the heading shows Unlimited instead of a number.
- **It is easier to know before adding more users or employees.** Users can quickly check the heading and understand whether there is still space in the package.

#### Guide
- **Go to Users List.**
- **Check the All users heading to see the current login user count and package limit.**
- **If HRM & Essentials is included, check the All Employees heading to see the current employee count and package limit.**
- **If contact logins exist, check the All Merchants section to view them.**
- **Use these numbers before adding a new user or employee.**

---

### Module: Superadmin - Packages

#### What Users Can Do Now
- **Employee limit is only shown for packages that include HRM & Essentials.** Packages without HRM & Essentials no longer show the employee limit line.
- **The employee limit label is easier to understand.** When it is shown, it appears as the number of employees instead of a warning message.

#### Guide
- **Go to Superadmin > Packages.**
- **Open or check a package card.**
- **If the package includes HRM & Essentials, the employee limit is shown.**
- **If the package does not include HRM & Essentials, the employee limit is hidden.**

---

## Version 8.91.2

**Release Date:** 2026-07-07

---

### Module: Superadmin - Maintenance Tools

#### What Users Can Do Now
- **Maintenance Tools now has its own tab in Superadmin Settings.** Superadmin users can find repair tools in one clear place instead of looking at the bottom of other settings tabs.
- **Fix Uploads Folder is available from the Maintenance Tools tab.** This helps move old uploaded files into the correct business folders.
- **Fix Default Product Image Repeats and Fix Quantity Mismatch are also available from the Maintenance Tools tab.** Superadmin users can use these repair buttons from the same screen.

#### Guide
- **Go to Superadmin > Settings.**
- **Open the Maintenance Tools tab.**
- **Click Fix Uploads Folder if uploaded files need to be moved into the correct business folders.**
- **Click Fix Default Product Image Repeats if repeated default product images need to be corrected.**
- **Click Fix Quantity Mismatch if product quantities need to be checked and corrected.**

---

### Module: Sales - Edit Sale

#### What Users Can Do Now
- **Sale invoice number can now be changed from the Edit Sale page.** Users can open an existing sale and update the Invoice No. / Transaction No. when needed.
- **The invoice number field is now visible on the Edit Sale page.** Users do not need to turn on a separate setting to see it.
- **Duplicate invoice numbers are checked before saving.** If the same number is already used on another sale, the system shows a warning so the user can choose a different number.

#### Guide
- **Go to Sales > All Sales.**
- **Find the sale you want to update.**
- **Click Actions > Edit.**
- **Change the Invoice No. / Transaction No. field if needed.**
- **Click Save.**
- **If a duplicate number warning appears, enter a different number and save again.**

---

### Module: User Security - Users and Employees

#### What Users Can Do Now
- **Adding users and adding employees can now be controlled separately.** Business owners can allow a staff member to add login users, add employees, or both.
- **The All users Add button and All Employees Add button now follow separate access settings.** Staff will only see the Add button they are allowed to use.
- **Employee records stay as employees when added from All Employees.** This helps avoid creating a login user by mistake.

#### Guide
- **Go to Settings > Security Roles.**
- **Create a new role or edit an existing role.**
- **Open the User Security tab.**
- **Tick Add user if the staff member should add login users.**
- **Tick Add employee if the staff member should add employees without login access.**
- **Save the role.**
- **Go to Users List and check the All users and All Employees sections.**

---

### Module: Products and POS - Alternate SKU

#### What Users Can Do Now
- **Product View now shows alternate SKUs with the main SKU.** Users can open a product and quickly see its saved alternate SKU or barcode.
- **POS SKU search now works with alternate SKUs.** Cashiers can scan or type an alternate SKU in the SKU search box and the correct product is added to the sale.
- **Checkout is easier when products have more than one SKU.** Users do not need to remember only the main SKU.

#### Guide
- **Go to Products.**
- **Open Actions > View on a product to check its main SKU and alternate SKU.**
- **Turn on Enable SKU Based Product Search from Business Settings if it is not already enabled.**
- **Open POS.**
- **Scan or type the main SKU or alternate SKU in the SKU search box.**
- **The matching product is added to the sale.**

---

### Module: Sales - Sale Returns

#### What Users Can Do Now
- **Sale Returns list is easier to read.** Column headings now line up neatly with the return details below them.
- **Actions are now easier to find.** The Actions button is shown as the first column, so users can open View, Edit, Print, or Delete without scrolling to the right.
- **Sale returns save faster after changes.** Users should wait less when updating an existing sale return, especially when it has several items.
- **Stock stays more accurate when a sale return is edited.** Changes in date, item quantity, or removed items are now reflected more reliably.

#### Guide
- **Go to Sales > Sale Returns.**
- **Use the Actions button in the first column to view, edit, print, or delete a sale return.**
- **Check the list columns to read sale return details clearly.**
- **To update a sale return, click Actions > Edit.**
- **Make the needed changes and click Save.**
- **Wait for the success message before leaving the page.**

---

### Module: Reports - Profit / Loss

#### What Users Can Do Now
- **Sale returns now show correctly in the Profit / Loss report.** Returned products reduce the profit amount properly, so users see a more accurate report.
- **Product returns entered from the Sale Returns screen are also included.** Users can trust the profit figures when returned products are added from Sale Returns.
- **Profit breakdown tabs now open properly.** Users can check profit by product, category, brand, location, invoice, date, customer, and day without the screen staying on Processing.

#### Guide
- **Go to Reports > Profit / Loss.**
- **Select the date range and location you want to check.**
- **Review Gross Profit and Net Profit.**
- **If sale returns were made in that period, they are now included in the profit amount.**
- **Use the profit breakdown tabs at the bottom to review profit in different ways.**
- **If you change the date range or location, wait for the tab to refresh and show the updated result.**

---

### Module: Home - Today's Profit

#### What Users Can Do Now
- **Today's Profit popup is wider and easier to read.** Users can view the report details with more space on the screen.
- **The popup still adjusts to smaller screens.** Users can open it on different screen sizes without the content going outside the page.

#### Guide
- **Click the Today's Profit button from the top menu.**
- **Review the profit details in the wider popup.**
- **Click Close when you are finished.**

---

### Module: Reports - Product Sale Report

#### What Users Can Do Now
- **Product returns are now shown correctly in the Product Sale Report.** Returned products reduce quantity, amount, cost, and profit instead of being missed.
- **Sold quantity now shows after returns.** For example, if 2 quantities were sold and 1 quantity was returned, the report shows 1 quantity sold.
- **Sale return cost now stays correct.** If a product is purchased again later at a different cost, the old sale return still shows the correct cost in the report.
- **Summary and Grouped tabs now match the Detailed result.** Users can check profit from any tab and get the same correct result.
- **Detailed (With purchase) now also shows sale return rows.** Returned items appear with a minus quantity, so users can see where the returned item is included.
- **Printed and exported Product Sale Reports show the same result.** Users can print or export the report and still see the return effect clearly.
- **Loss checking is easier.** Users can review products where returns or costs caused a loss.

#### Guide
- **Go to Reports > Product Sale Report.**
- **Choose the needed date range, location, product, category, or other filters.**
- **Open the Detailed tab, Summary tab, Grouped tab, or Detailed (With purchase) tab.**
- **Check the quantity, subtotal, cost, and profit columns.**
- **In Detailed (With purchase), sale return rows are shown as minus quantity and marked as Sale Return.**
- **Use Print or Export if you need a copy for review.**

---

### Module: Reports - Sale Invoices Report

#### What Users Can Do Now
- **Sale return profit is now shown correctly in the Sale Invoices Report.** When users filter the report by Sale Returns and open the Detailed tab, the profit now follows the correct returned item cost.
- **Ledger Discount 3 is now included in sale return profit.** If a discount was added on selected purchase invoices, the Sale Invoices Report now shows profit in line with the Product Sale Report and Profit / Loss report.
- **Net profit checking is clearer.** Users can compare Sales Invoices profit with Sales Return profit and get the correct net profit after discounts.
- **Old sale returns stay correct after new purchases.** If the same product is purchased later at a new cost, old sale return profit does not change incorrectly.

#### Guide
- **Go to Reports > Sale Invoices Report.**
- **Select Sales Invoices in the report filter and open the Detailed tab to check sale profit.**
- **Select Sale Returns in the report filter and open the Detailed tab to check return profit.**
- **If Ledger Discount 3 was added, check the cost and profit columns after saving the discount.**
- **Compare sale profit minus return profit to review the net profit.**

---

### Module: Contacts - Ledger Discount 3

#### What Users Can Do Now
- **Ledger Discount 3 can now be saved with Submit and Reindex.** This helps users save the discount and refresh the selected purchase invoices in one step.
- **Submit and Reindex is available while adding and editing Ledger Discount 3.** Users can use the same option when creating a new discount or changing an existing discount.
- **The edit popup now stays in front properly.** Users can open and work in the Ledger Discount 3 edit popup without it hiding behind the page.
- **A clear processing message appears while the stock refresh is running.** Users can wait until the save is finished without clicking again.
- **If no purchase invoice is selected, users now see a clear message.** This helps avoid saving a discount without choosing the purchases it belongs to.
- **Users can still save normally.** Use the regular Submit button when a stock refresh is not needed.

#### Guide
- **Open the required contact.**
- **Open the Ledger Discount 3 option.**
- **Select the purchase invoices that should receive the discount.**
- **Click Submit to save normally.**
- **Click Submit and Reindex when you also want the selected purchase invoices to refresh.**
- **Use the same Submit and Reindex button when editing an existing Ledger Discount 3 entry.**
- **Wait for the success message before closing the popup.**

---

### Module: Sales - POS and Direct Sale

#### What Users Can Do Now
- **After saving a direct sale, the system now opens the correct Sales list.** This helps users return to the sale list smoothly after saving.
- **Booking reminders now continue to the correct Sales list.** Users are taken to the right page after completing the reminder step.

#### Guide
- **Go to POS or Direct Sale.**
- **Create or update the sale as usual.**
- **Save the sale.**
- **After the success message, the system opens the correct Sales list page.**

---

## Version 8.90.7

**Release Date:** 2026-07-06

---

### Module: Sales - Sales List

#### What Users Can Do Now
- **Sales list now shows when a sale was last updated.** Users can check the Updated At column to see the latest change time for each sale.
- **Updated At appears before Created At.** This makes it easy to compare when a sale was first made and when it was last changed.

#### Guide
- **Go to Sales > List Sales.**
- **Scroll to the right side of the list if needed.**
- **Check the Updated At column before Created At.**
- **Use Updated At to see when the sale was last changed.**
- **Use Created At to see when the sale was first added.**

---

### Module: Sales - Sale Returns List

#### What Users Can Do Now
- **Sale Returns list now shows Created At and Updated At.** Users can see when each sale return was added and when it was last changed.
- **The new date columns are shown on the right side of the list.** This keeps the main sale return details in place while still showing the extra timing information.

#### Guide
- **Go to Sales > Sale Returns.**
- **Scroll to the right side of the list if needed.**
- **Check Created At to see when the sale return was first added.**
- **Check Updated At to see when the sale return was last changed.**

---

### Module: Offline Sync - Products, Contacts and Sales

#### What Users Can Do Now
- **Offline Sync now checks that the offline company and cloud company are the same before syncing.** This helps stop products, contacts, or sales from being synced to the wrong company.
- **Users now see a clear warning if the wrong company is logged in.** The message tells users to login to the matching offline company before syncing.
- **Product sync is safer for offline workstations.** Users should only sync products after confirming they are logged into the same company that is connected on cloud.
- **Sales sync is safer when contacts are involved.** This helps avoid a sale showing under the wrong customer after syncing.
- **Slow or failed sync attempts show clearer messages.** Users can understand whether they need to check internet, login, or company selection.

#### Guide
- **Go to Synchronization / Offline Sync.**
- **Check the warning message at the top of the page before syncing.**
- **If it says the offline company and cloud company do not match, logout from the offline system.**
- **Login again using the correct company user.**
- **After the correct company name appears on the screen, sync Products, Contacts, and Sales again.**
- **If the warning still appears, ask the admin to check the cloud connection details for this workstation.**

---

## Version 8.90.6

**Release Date:** 2026-06-29

---

### Module: Sales and Purchases - View Details

#### What Users Can Do Now
- **Sale Details now shows the customer Contact ID.** When users open a sale invoice, the Contact ID appears above the customer name.
- **Purchase Details now shows the supplier Contact ID.** When users open a purchase, the Contact ID appears above the supplier details.
- **Customer and supplier checking is easier.** Staff can quickly confirm the correct contact before reviewing products, payments, or totals.

#### Guide
- **Go to Sales > List Sales.**
- **Open the View option for any sale invoice.**
- **Check the customer section. The Contact ID is shown above the customer name.**
- **Go to Purchases.**
- **Open the View option for any purchase.**
- **Check the supplier section. The Contact ID is shown above the supplier details.**

---

### Module: Products - Product Stock History

#### What Users Can Do Now
- **Product stock history now shows a loading bar while opening.** Users can see that the page is working when a product has many stock records.
- **Large stock histories open more smoothly.** This helps users wait with confidence instead of seeing an empty area during loading.
- **The stock history screen keeps the same layout after loading.** Users can review the same stock summary, location tabs, filters, and history table as before.

#### Guide
- **Go to Products and open Product Stock History for the required product.**
- **If the history takes a little time, wait for the loading bar to finish.**
- **After loading, check the stock summary, location tabs, and history table as usual.**
- **Use the type filter if you want to view only purchases, sales, transfers, or other stock movements.**

---

### Module: Backup - Transaction Backup

#### What Users Can Do Now
- **Transactions can now be exported by date range.** Users can choose a start and end date from the Transaction Backup page and export only the transactions from that period.
- **The export uses the Local Transaction Export Path.** Users can check or enter the local folder path on the same page before exporting.
- **The export works on localhost and with the {application_name} Desktop App.** On live/cloud, users can keep the desktop app open so the export files are saved on their computer.
- **Users can see a clear export message.** After export, the page shows how many transactions were exported or prepared for the desktop app.

#### Guide
- **Go to Backup > Transaction Backup.**
- **Check the Local Transaction Export Path.**
- **Go to the Export Transactions With Date Range section at the bottom.**
- **Select the date range you want to export.**
- **Click Export Transactions.**
- **On localhost, check the selected local export folder.**
- **On live/cloud, keep the {application_name} Desktop App open and check the same local export folder on your computer.**

---

### Module: Superadmin - Hard Reset Options

#### What Users Can Do Now
- **Accounting reset options are now separated.** Superadmin can reset accounting mappings without resetting accounting vouchers and bank records.
- **Reset Accounting Mapping is available as its own option.** Use this when you only want to clear mappings from Accounting > Transactions.
- **Reset Accounting Transactions is available as its own option.** Use this when you want to clear Journal Voucher, Transfer Voucher, Cheque Book, and Bank Reconciliation records.
- **This makes accounting reset safer and easier to choose.** Superadmin can now select only the accounting reset area that is needed.

#### Guide
- **Go to Superadmin > All Businesses.**
- **Open the required business.**
- **Open Hard Reset Options.**
- **In Transactions Hard Delete, choose Reset Accounting Mapping if you only want to reset mappings from Accounting > Transactions.**
- **Choose Reset Accounting Transactions if you want to reset Journal Voucher, Transfer Voucher, Cheque Book, and Bank Reconciliation records.**
- **Select any other reset options needed, then confirm the reset.**

---

### Module: Accounting - Transactions

#### What Users Can Do Now
- **Transaction tabs now show totals at the bottom of the list.** Users can quickly check the total amount for each tab without adding the rows manually.
- **Sales now show Total Amount and Total Paid at the bottom.** This makes it easier to review the sale value and received amount in one place.
- **Payment tabs now show the total payment amount.** Users can check the total for sales payments, purchase payments, expense payments, contact payments, and other payment tabs from the bottom row.
- **Purchase, purchase return, and expense tabs now show amount totals and due totals.** Users can quickly see the grand total and pending amount for the selected list.
- **Stock adjustment now shows total amount and recovered amount.** Users can compare both values directly from the bottom of the tab.
- **Opening balance, opening stock, advance deposit, payroll, payroll advance, production, and reverse production tabs now show their amount totals.**
- **Totals change with the selected list.** When users apply filters, choose a date range, or search in the table, the bottom totals update for the visible results.
- **Payroll transactions can now be mapped from the Payroll tab using the default payroll accounts selected in Accounting Settings.**
- **Payroll Remap Defaults is now available.** Users can filter payroll records first, then remap only the matching payroll transactions.
- **Payroll list filters are easier to use.** Users can filter payroll by location, payment status, mapping status, and date range.
- **Payroll Payments now use the selected payment method account when mapping.** This keeps cash, bank, card, and other payroll payments linked to the correct account.
- **Payroll Payments can also be remapped from the Payroll Payments tab.** Users can filter the list first, then click Remap Defaults for the matching payments.

#### Guide
- **Go to Accounting > Transactions.**
- **Open the tab you want to review, such as Sales, Purchases, Expenses, Payments, Opening Stock, or Payroll.**
- **Use the date range, filters, or search box if you want to narrow the list.**
- **Check the bottom row of the table to see the total amount for that tab.**
- **For tabs with more than one amount column, check each total shown at the bottom of its column.**
- **For Payroll mapping, first select the Payroll Credit and Payroll Debit accounts in Accounting Settings.**
- **Then go to Accounting > Transactions > Payroll, apply the needed filters, and click Remap Defaults.**
- **For Payroll Payments, make sure each payment method has the correct Default Account in the business location payment options.**
- **Then go to Accounting > Transactions > Payroll Payments, apply the needed filters, and click Remap Defaults.**

---

### Module: Reports - General Reports

#### What Users Can Do Now
- **New "Contact's Opening Balance Report" added under Reports > General Reports.** Users can now see contacts who have an opening balance saved from the contact add or edit screen.
- **Contacts without an opening balance are not shown in this report.** This keeps the list focused only on contacts where an opening balance was entered.
- **Opening balance details are easier to check in one place.** The report shows the contact, contact type, business location, opening balance date, debit or credit type, opening balance amount, amount paid, remaining due amount, and added by user.
- **Opening balance amount columns are easier to read.** The currency symbol now appears in the column heading, and the amount values show as clean numbers.
- **Opening balance amounts line up neatly.** Opening Balance, Amount Paid, and Opening Balance Due values are aligned to the right so users can compare them more easily.
- **The report can be filtered and printed.** Users can filter by location, contact type, contact, opening balance type, and date range, then print the report in A4 format.
- **Users can also export the report.** From the print preview, users can save the report as PDF or export it to Excel.
- **New "Contact's Advance Deposit Report" added under Reports > General Reports.** Users can now check advance deposits for customers and suppliers in one place.
- **Advance deposit details are easier to review.** The report shows the contact, contact type, business location, date, reference number, debit or credit type, payment method, payment status, deposit amount, adjusted amount, balance, and added by user.
- **Users can quickly find open or completed advance deposits.** The report can be filtered by location, contact type, contact, advance deposit type, payment status, and date range.
- **The advance deposit report can be printed or exported.** Users can print the report in A4 format, save it as PDF, or export it to Excel.

#### Guide
- **Go to Reports > General Reports > Contact's Opening Balance Report.**
- **Use the filters at the top if you want to check a specific location, contact, date range, or opening balance type.**
- **Check the Opening Balance, Amount Paid, and Opening Balance Due columns to review the balance.**
- **Read the currency from the column heading, then compare the right-aligned amount values.**
- **Click Print A4 to open the print preview.**
- **From the print preview, print the report, save it as PDF, or export it to Excel.**
- **Go to Reports > General Reports > Contact's Advance Deposit Report.**
- **Use the filters at the top if you want to check a specific location, contact, date range, advance deposit type, or payment status.**
- **Check the Deposit Amount, Adjusted Amount, and Advance Deposit Balance columns to review the deposit.**
- **Use the Payment Status filter if you want to see only due, partial, paid, or overpaid advance deposits.**
- **Click Print A4 to open the print preview.**
- **From the print preview, print the report, save it as PDF, or export it to Excel.**

---

### Module: Reports - Opening Stock Report

#### What Users Can Do Now
- **Products with 0 opening quantity are no longer shown in the Opening Stock Report.** This keeps the report focused only on products where opening stock was actually entered.
- **Opening stock totals are easier to review.** The total quantity, quantity left, and subtotal now match the products shown in the report.
- **Opening stock numbers line up neatly.** Quantity, Quantity Left, Unit Price, and Subtotal values are aligned to the right so users can compare rows and totals more easily.
- **Print and export copies follow the same list.** Products with 0 opening quantity stay hidden when users print or export the report.

#### Guide
- **Go to Reports > Stock Reports > Opening Stock Report.**
- **Use the date, location, category, brand, or product filters if needed.**
- **Check the report list. Products with 0 opening quantity will not appear.**
- **Compare Quantity, Quantity Left, Unit Price, and Subtotal values from the right side of each column.**
- **Use Print A4 if you want to print, save as PDF, or export the same clean report.**

---

### Module: User Management - Merchant List

#### What Users Can Do Now
- **The Users page now has a separate "All Merchants" section.** Merchants are no longer mixed with regular users or employees.
- **The Superadmin business detail page also shows "All Merchants".** Superadmin can open a business and view that business's merchants in their own section.
- **All Users, All Employees, and All Merchants are now easier to check separately.** This helps users find the right person list faster.

#### Guide
- **Go to Users.**
- **Check the three sections: All Users, All Employees, and All Merchants.**
- **Use All Merchants to view merchant logins separately.**
- **For Superadmin, go to Superadmin > All Businesses.**
- **Open the required business and check All Merchants on the business detail page.**

---

### Module: Sales - Classic Receipt Print

#### What Users Can Do Now
- **Sale and quotation print copies now show a clearer right-side border.** The product table border looks even from left to right.
- **The total amount box now looks neater on print and PDF copies.** Its right-side border now matches the rest of the box.

#### Guide
- **Go to Sales and open a sale or quotation that uses the Classic print layout.**
- **Print the copy or save it as PDF.**
- **Check the product table and total amount box.**
- **The right-side border should now look clear and even.**

---

### Module: Contacts - Ledger Discount View

#### What Users Can Do Now
- **Deleted ledger discounts now show a success message.** When users delete a Ledger Discount, Ledger Discount 2, or Ledger Discount 3 from the contact ledger view popup, the system confirms the deletion.
- **The discount view popup now closes properly after delete.** Users no longer need to refresh the page to see that the discount was removed.
- **New Ledger Discount 3 entries now appear in the view popup.** After adding Ledger Discount 3, users can open the view popup and see the saved entry.
- **Ledger Discount and Ledger Discount 2 entries also show correctly in their view popups.** Saved discount records are no longer hidden from users.

#### Guide
- **Go to Contacts and open the customer or supplier ledger.**
- **Click View Ledger Discount, View Ledger Discount 2, or View Ledger Discount 3.**
- **Check the saved discount entries in the popup.**
- **To remove an entry, click the Delete icon and confirm.**
- **After deletion, check the success message and updated ledger balance.**

---

### Module: Contacts - Ledger Print

#### What Users Can Do Now
- **Ledger print copies now show number values on the right side in all ledger formats.** Amounts, quantities, debit, credit, balance, ageing amounts, and cheque clearing amounts are easier to compare.
- **Product detail numbers inside the ledger print are also easier to read.** Quantities, prices, discounts, tax, and subtotals now line up neatly.
- **Printed ledgers look more consistent across different formats.** Users can switch formats and still read number columns in the same clear way.

#### Guide
- **Go to Contacts and open the required customer or supplier.**
- **Open the Ledger tab.**
- **Choose the ledger format you want to print.**
- **Open the print copy.**
- **Check the amount and quantity columns. The numbers should now appear on the right side.**

---

### Module: Expenses - Draft and Final Status

#### What Users Can Do Now
- **Expenses can now be saved as Draft or Final.** Users can save an expense as Draft when it is not ready yet, or Final when it is complete.
- **Final is selected automatically when adding a new expense.** Users can keep Final or change it to Draft before saving.
- **Expense status is shown near the top on Add Expense and Edit Expense.** Users can choose the status without scrolling to the payment area.
- **Draft expenses do not show payment entry.** This helps users save incomplete expenses without adding payment details.
- **The Expenses list now shows the expense status.** Users can quickly see which expenses are Draft and which are Final.
- **Expense status can be changed from the Expenses list when no payment has been entered.** Users can open the status popup and move an expense between Draft and Final when allowed.
- **Expense status is protected after payment is entered or paid.** Once an expense has a payment, the status cannot be changed.
- **Admins can choose who may change expense status.** A user can be allowed to edit expenses without being allowed to change Draft or Final status.
- **Payments are only added for Final expenses.** The Add Payment option appears when the expense is Final and still has an unpaid amount.
- **Changing status from the Expenses list now stays smooth.** The page no longer gets stuck on processing after a status change.
- **Expense payment access can now be controlled from Roles.** Admins can choose who may add, edit, or delete expense payments.

#### Guide
- **Go to Expenses > Add Expense.**
- **Check Expense Status near the top of the form.**
- **Keep Final if the expense is complete and payment can be added.**
- **Select Draft if the expense is not ready for payment yet.**
- **When Draft is selected, the payment section will stay hidden.**
- **To update an existing expense, open Edit and check the Expense Status near the top.**
- **Go to Expenses to view the saved expense status in the list.**
- **Click the status label to update the expense status when no payment has been entered.**
- **If payment has already been entered or paid, keep the current status. The system will not allow the status to be changed.**
- **After changing an expense to Final, add payment if payment is due.**
- **To allow a role to change expense status, go to Roles, open the Expense tab, and tick Update Status for that role.**
- **To allow a role to manage expense payments, go to Roles, open the Expense tab, and tick Add Expense Payment, Edit Expense Payment, or Delete Expense Payment as needed.**

---

### Module: Projects - Project Expenses Tab

#### What Users Can Do Now
- **Projects now have an Expenses tab.** Users can open a project and see expenses linked to that project in one place.
- **Project expenses can be filtered by project step.** Users can choose a step to see only expenses for that step.
- **Add Expense from a project now fills the project automatically.** When users add an expense from the project page, the expense is linked to that project.
- **Add Expense from a selected step now fills that step automatically.** Users can select a project step first, then click Add Expense to create an expense for that step.
- **Project expense entry opens as Draft by default.** This helps users review the expense before making it final or adding payment.
- **Project expenses can now be added in a popup.** Users can add an expense without leaving the project page.
- **The popup shows Status, Project, and Project Step.** Users can confirm or update these details before saving.
- **The project expense list updates after saving.** Users can see the new expense in the Expenses tab.

#### Guide
- **Go to Projects and open the required project.**
- **Open the Expenses tab.**
- **Use the Project Step dropdown if you want to view or add expenses for one step only.**
- **Click Add Expense to create a new expense for the project.**
- **The Add Expense popup will open on the same page.**
- **Check that Expense Status is Draft by default.**
- **Check that the Project and Project Step are correct.**
- **Save the expense and check the Expenses tab list.**

---

### Module: Superadmin - Business Reset

#### What Users Can Do Now
- **Reset All Transactions now completes more smoothly from the business reset screen.** Superadmin users can reset transaction data without getting a general error when Truckmate activity is included.
- **Truckmate-related transaction records are handled during the reset.** This helps Superadmin clear business transaction activity from one place.

#### Guide
- **Go to Superadmin > All Businesses.**
- **Open the required business.**
- **Open Hard Reset Options.**
- **In Transactions Hard Delete, select the reset options needed.**
- **Click Reset Data and confirm the action.**
- **After reset, check that the success message appears.**

---

### Module: Products - Combo Products

#### What Users Can Do Now
- **Combo product edit page now shows the ingredients and pricing section properly.** Users can open an existing combo product and review its ingredient list, quantities, units, total cost, profit percentage, and selling price.
- **Users can copy ingredients from another combo product while creating or editing a combo product.** This saves time when two combo items use a similar recipe.
- **Old combo products are easier to edit.** If one old ingredient is no longer available, users can still open the combo product and update the remaining ingredients.

#### Guide
- **Go to Products > List Products.**
- **Open Edit for a combo product.**
- **Scroll to the Product Type area.**
- **Check the ingredients and pricing section below Product Type.**
- **To copy ingredients, select a product from Copy ingredients from combo.**
- **Confirm the message if you want to replace the current ingredients.**
- **Review the loaded ingredients, quantities, units, and selling price.**
- **Click Update to save the combo product.**

---

### Module: Reports - Product Purchase Report

#### What Users Can Do Now
- **Bottom totals now work on more purchase report tabs.** Users can see correct totals on By Category, By Sub-Category, By Sub2 Category, By Brand, By Gender, and By Procurement Source.
- **Search works smoothly on these tabs.** Users can type in the search box without the report getting stuck on processing.
- **Sub2 Category is now available as its own tab.** Users can check purchase details by the second level of sub-category.
- **Amount columns are easier to read.** The currency symbol appears in the column heading, and the values appear as clean numbers.
- **Number values are right aligned.** This makes quantities, prices, subtotals, and totals easier to compare.

#### Guide
- **Go to Reports > Product Purchase Report.**
- **Select the filters you need, such as date range, category, brand, gender, or procurement source.**
- **Open By Category, By Sub-Category, By Sub2 Category, By Brand, By Gender, or By Procurement Source.**
- **Use the Search box to quickly find matching records.**
- **Check the total row at the bottom of the tab.**
- **Read amount columns by checking the currency symbol in the heading and the number value in the row.**

---

### Module: Reports - Product Sale Report

#### What Users Can Do Now
- **The Detailed tab now matches the other report tabs.** Users can use Show entries, Search, export buttons, Print, and Column visibility on the Detailed tab.
- **The buttons and search area on the Detailed tab are easier to use.** They appear in the same style and position as the other Product Sale Report tabs.
- **Amount columns are easier to read across the Product Sale Report.** The currency symbol appears in the column heading, and the values appear as clean numbers.
- **Number values are right aligned.** This makes quantities, prices, discounts, tax, totals, costs, profit, and profit percentage easier to compare.
- **Print and export headings are clearer.** Amount columns show the currency in the heading instead of repeating it inside every value.

#### Guide
- **Go to Reports > Product Sale Report.**
- **Select the filters you need, such as date range, customer, supplier, category, brand, gender, or procurement source.**
- **Open the Detailed tab.**
- **Use Show entries to choose how many rows appear on the screen.**
- **Use Search to quickly find matching sales records.**
- **Use the export, print, and column visibility buttons when needed.**
- **Check amount columns by reading the currency symbol in the heading and the number value in the row.**

---

### Module: Reports - Payment Reports

#### What Users Can Do Now
- **Purchase Payment Report now has a Supplier Summary tab.** Users can see supplier-wise payment totals and the number of payment entries for each supplier.
- **Sell Payment Report now has a Customer Summary tab.** Users can see customer-wise payment totals and the number of payment entries for each customer.
- **Customer Summary includes customers and barterers.** This helps users check normal customer payments and barter customer payments in one place.
- **All payment report tabs now have Show entries and Search.** Users can choose how many rows to show and search inside Summary, Supplier Summary, Customer Summary, and Detail tabs.
- **Payment report tables are easier to use on smaller screens.** Wide tables fit better and can be scrolled when needed.
- **New summary tabs can be printed in A4 format.** Users can print Supplier Summary or Customer Summary with the selected filters.

#### Guide
- **Go to Reports > Purchase Payment Report.**
- **Use the filters if needed, such as date range, supplier, payment method, payment location, or transaction location.**
- **Open Supplier Summary to see supplier-wise payment totals.**
- **Go to Reports > Sell Payment Report.**
- **Use the filters if needed, such as date range, customer, customer group, payment method, payment location, or transaction location.**
- **Open Customer Summary to see customer-wise payment totals, including barterers.**
- **Use Show entries to choose how many rows appear on the screen.**
- **Use Search to quickly find a supplier, customer, payment type, or amount.**
- **Click Print A4 on any tab when a print copy is needed.**

---

### Module: Manufacturing - Demand Ingredient Report Print

#### What Users Can Do Now
- **Demand Ingredient Report print copy is easier to read.** Wide report sections now fit better on the print page.
- **Product-wise, category-wise, ingredient summary, and batch ingredient sections are cleaner in print.** Users can check long ingredient lists without the columns becoming too squeezed.
- **Totals remain visible at the bottom of each printed section.** This helps users review quantities and costs after printing.

#### Guide
- **Go to Manufacturing > Reports > Demand Ingredient Report.**
- **Select the filters needed for the report.**
- **Open the print view.**
- **Check each section before printing or saving as PDF.**
- **Use the printed copy to review ingredient quantities, costs, and totals.**

---

### Module: Backup - Create Backup

#### What Users Can Do Now
- **Create Backup works normally on live sites when no special backup path is needed.** Admins can leave the backup path empty if their hosting already supports backup creation.
- **The Backup page no longer shows an error page just because the backup path is left empty.** This makes the normal backup flow smoother for admins.

#### Guide
- **Go to Backup.**
- **Click Create Backup.**
- **Wait for the backup process to finish.**
- **Download or keep the backup file as needed.**
- **If backup still does not start, ask hosting support to check the backup setup for the site.**

---

### Module: Lists and Reports - Amount Columns

#### What Users Can Do Now
- **Amount columns are easier to read across lists and reports.** Currency symbols are now shown in the column headings, and the amount values are shown as clean numbers.
- **Number values are right aligned.** This makes it easier to compare amounts, dues, totals, payments, tax, stock values, and other money columns.
- **Footer totals are clearer.** Total rows now follow the same style as the table values, so users can read totals without repeated currency symbols.
- **All related tabs follow the same display style.** Reports with multiple tabs now show amount columns in the same clear format on every tab.

#### Pages Covered
- **Accounting Payment Account Report.**
- **Accounting Cash Flow.**
- **Accounting Accounts list.**
- **Profit and Loss Report, all tabs.**
- **Tax Report.**
- **Expense Report.**
- **Register Report.**
- **Sales Representative Report, all tabs.**
- **POS sales list.**
- **Sales Drafts.**
- **Sales list.**
- **Sales Quotations.**
- **Purchase Orders.**
- **Purchases list.**
- **Purchase Returns list.**
- **Stock Adjustments list.**
- **Stock Transfers list.**
- **Expenses list.**

#### Guide
- **Open any of the pages listed above.**
- **Check the amount or value columns.**
- **The currency symbol appears in the column heading.**
- **The values inside the column appear as numbers only.**
- **Amounts and totals are aligned to the right for easier reading and comparison.**

---

### Module: Contacts - Stock Quantity Report Tab

#### What Users Can Do Now
- **The Stock Quantity Report tab on a supplier contact now shows total values at the bottom.** Users can quickly see totals for purchased quantity, sold quantity, transferred quantity, returned quantity, current stock, and total stock price.
- **Totals change with the selected number of shown entries.** If users choose to show 10, 25, 50, or more entries, the bottom totals update for the rows currently shown on the screen.
- **The table is easier to read.** SKU now appears first, Product appears after SKU, and Unit has its own separate column.
- **Quantity values are cleaner.** Unit names are no longer repeated inside quantity values because the Unit column already shows the unit.
- **Stock price is easier to compare.** The currency symbol is shown in the column heading, and the values are shown as numbers only.
- **Number columns are right aligned.** This makes quantities and stock price values easier to compare row by row.

#### Guide
- **Go to Contacts and open a supplier.**
- **Open the Stock Quantity Report tab.**
- **Use Business Location if you want to view one location or all locations.**
- **Use the Show entries option to choose how many rows appear on the screen.**
- **Check the total row at the bottom.**
- **The totals will match the rows currently shown on the screen.**

---

### Module: Live Site Update

#### What Users Can Do Now
- **Existing live sites open normally after new version files are uploaded.** Admins can continue the normal update process without extra manual steps.
- **The site no longer sends an already installed business to the first-time install page by mistake.** This keeps the update process clear for existing users.
- **Admins can log in and open the update page as usual.** The regular **I Understand, Update** button flow remains the same.

#### Guide
- **Upload the new version files to the live site.**
- **Open the live site in the browser.**
- **Log in with an admin account.**
- **Go to the update page.**
- **Click I Understand, Update to complete the update.**

---

## Version 8.90.5

**Release Date:** 2026-06-27

---

### Module: Expenses - Add and Edit Expense

#### What Users Can Do Now
- **Add Expense and Edit Expense pages now show only the normal Save or Update button in the footer.** Extra Print A4 and Print A5 buttons are no longer shown on these pages.
- **Expense entry stays simple for staff.** Users can save a new expense or update an existing expense from the footer without extra print choices on the form.

#### Guide
- **Go to Expenses > Add Expense.**
- **Enter the expense details and click Save from the footer.**
- **Open an existing expense if you need to change it.**
- **Click Update from the footer after making changes.**
- **Use the regular expense print option from the expense record or list when a print copy is needed.**

---

### Module: Expenses - Expense List Print

#### What Users Can Do Now
- **Expense List can now be printed in A4 format.** Users can click **Print A4** from the Expenses page and open a clean print preview.
- **The print preview follows the selected filters.** Date range, location, category, sub category, contact, payment status, added by, expense for, and job sheet filters are included when printing.
- **Detailed and Summary views are available together.** Users can check the full expense list and a category-wise summary in the same print preview.
- **Users can print, save as PDF, or export to Excel from the preview.**
- **Expense refunds are shown clearly.** Refund amounts are shown as negative values so totals are easier to understand.

#### Guide
- **Go to Expenses.**
- **Select the filters you need.**
- **Click Print A4.**
- **Check the preview page.**
- **Use Print, PDF, or Export to Excel as needed.**

---

### Module: Project - Location

#### What Users Can Do Now
- **Each project now has a Location tab.** Users can open a project and save its address details in one place.
- **Project address fields are easier to manage.** Address Line 1, Address Line 2, City, State, Country, Zip Code, and Map Address can be added or updated.
- **Map search is available when the map is available.** Users can search the map address and save the selected map location with the project.
- **Users without edit access can still view the location details.** Only users with project edit access can update the location.

#### Guide
- **Go to Project and open a project.**
- **Open the Location tab.**
- **Enter the address details.**
- **Use the Map Address field to search the map location, if the map is available.**
- **Click Update to save the project location.**

---

### Module: Project - Email Notifications

#### What Users Can Do Now
- **Project leads can now receive email updates when a project is created or edited.** This helps the lead person stay informed when project details are added or changed.
- **Project leads can now receive email updates when a project task is created or edited.** This helps the lead person follow task changes without checking the project screen again and again.
- **Project email messages can be changed from Notify Templates.** Users can update the subject and message wording for Project and Project Task emails.
- **Project emails include useful details.** The email can show project name, status, customer, location, dates, budget, members, task name, task status, priority, due date, and a link to open the project.
- **Auto Send Email can be turned on or off.** If Auto Send Email is selected, the email is sent automatically when the project or task is saved.

#### Guide
- **Go to Settings > Notify Templates.**
- **Open the Project Notifications section.**
- **Open Project to edit the email used for project create and edit updates.**
- **Open Project Task to edit the email used for task create and edit updates.**
- **Keep Auto Send Email selected if the email should be sent automatically.**
- **Create or edit a project, or create or edit a project task.**
- **The project lead person will receive the email if their email address is saved in their user profile.**

---

### Module: Project - Settings

#### What Users Can Do Now
- **Hard Reset option has been removed from the Project screens.** This keeps the Project area safer for daily users.
- **Project settings are now simpler.** Users will only see the normal Project options they need for regular work.
- **Project reset is now handled by Superadmin from the business view page.** This keeps reset work in one safer place for the system owner.

#### Guide
- **Go to Project.**
- **Use the available menus such as Projects, Tasks, Stock, Reports, Categories, and Settings.**
- **The Hard Reset option will no longer appear in the Project menu or settings area.**
- **For reset work, Superadmin can go to Superadmin > Businesses, open the business, and use Hard Reset Options there.**

---

### Module: Installment - Settings

#### What Users Can Do Now
- **Hard Reset option has been removed from the Installment screens.** This keeps the Installment area safer for daily users.
- **Installment settings are now simpler.** Users will only see the normal Installment options they need for regular work.
- **Installment reset is now handled by Superadmin from the business view page.** This keeps reset work in one safer place for the system owner.

#### Guide
- **Go to Installment.**
- **Use the available menus such as Installments, Customers, Reports, and Settings.**
- **The Hard Reset option will no longer appear in the Installment menu or settings area.**
- **For reset work, Superadmin can go to Superadmin > Businesses, open the business, and use Hard Reset Options there.**

---

### Module: Installment - Installment Plans

#### What Users Can Do Now
- **Installment Plans now opens with a clearer page name.** Users can open the plans page from the Installment menu without seeing the old System wording.
- **The Installment Plans menu item is easier to understand.** Staff can quickly find where installment plan names, number of installments, payment period, interest, and description are managed.

#### Guide
- **Go to Installment > Installment Plans.**
- **Use Add to create a new installment plan.**
- **Use Edit if an existing installment plan needs changes.**
- **Use Delete only when the plan is no longer needed.**

---

### Module: Installment - Reports

#### What Users Can Do Now
- **Installment Reports and All Installments are now available on one Reports page.** Users can switch between the two views using tabs.
- **One Report Filters section is used for both tabs.** Customer, installment status, date from, and date to filters now apply to both report views.
- **The Reports page is easier to use.** Users do not need to open separate pages to check installment details and customer-wise installment totals.
- **Customer balance is shown from the shared filter area.** When a customer is selected, users can quickly see the total money owed.

#### Guide
- **Go to Installment > Reports.**
- **Select the customer, installment status, and date range you need.**
- **Open the Installment Reports tab to check individual installment details.**
- **Open the All Installments tab to check customer-wise installment totals.**
- **Change the filters once at the top, and both tabs will follow the same filter choices.**

---

### Module: Installment - A4 Printing

#### What Users Can Do Now
- **Installment Reports can now be printed in A4 format.** Users can print the current tab or print all report tabs together.
- **Customer Installments can now be printed in A4 format.** Users can open a clean print preview for the customer installment list.
- **Installment Sales can now be printed in A4 format.** The print copy follows the selected filters such as location, customer, payment status, date range, staff, and shipping status.
- **Installment Plans can now be printed in A4 format.** Users can print the plan list, including plan name, number of installments, payment period, interest, interest type, and description.
- **Print previews include useful actions.** Users can print the A4 copy, save it as PDF, or export it to Excel from the preview page.
- **Search and filters are kept when printing.** The printed copy matches the list or report the user is viewing.

#### Guide
- **Go to Installment.**
- **Open Reports, Customers, Sales, or Installment Plans.**
- **Select the filters or search text you need.**
- **Click Print A4 Current Tab to print the active view.**
- **Click Print A4 All Tabs when you want all available tabs together.**
- **On pages with only one list, both print buttons open the same current list.**
- **Use Print A4, PDF, or Export to Excel from the preview page.**

---

### Module: Accounting - Settings

#### What Users Can Do Now
- **Chart of Accounts Order now opens in the correct default order.** New businesses will see the order as **Asset, Liability, Equity, Income, Expenses** when Accounting is used for the first time.
- **First-time settings save keeps the correct order.** If users save Accounting Settings without changing the order, the same default order is saved automatically.

#### Guide
- **Go to Accounting > Settings.**
- **Check Chart of Accounts Order.**
- **The default order should be Asset, Liability, Equity, Income, Expenses.**
- **Save the settings as usual if no change is needed.**

---

### Module: Sales - Sale Return Details Popup

#### What Is Easier Now
- **SKU is now shown in the sale return product list.** When users open a sale return, each returned product now shows its SKU next to the product number.
- **Returned products are easier to identify.** Staff can quickly match the returned item with the correct product code before checking quantity and amount.

#### Guide
- **Go to Sales > Sale Return.**
- **Open the View popup for any sale return.**
- **Check the product table.**
- **The SKU column appears after the # column for each returned product.**

---

### Module: Sales - Sale Details Popup

#### What Works Correctly Now
- **Sale Details now shows the correct Total before discount.** When an invoice has inline product discounts, the popup now shows the original total first, then the discount amount, and then the final receivable amount after discount.
- **Discount checking is easier for staff.** Users can now clearly see how much was discounted and confirm that the final invoice amount is correct.

#### Guide
- **Go to Sales > List Sales.**
- **Open the Sale Details popup for an invoice that has inline discount.**
- **Check the Total, Inline Discount, and Total Receivable rows.**
- **The Total row shows the amount before discount, and Total Receivable shows the final amount after discount.**

---

### Module: Reports - Payment Recovery Report

#### What Works Correctly Now
- **Summary total now shows the full correct amount.** If the Cash amount is **759,070.53**, the footer total now uses the full amount instead of showing only **759**.
- **Date Range now updates the Summary tab properly.** When users select a range like Last 30 Days, the Summary rows and footer totals both follow the selected dates.
- **Type names now follow the Payment Method names set for the business location.** If payment methods are renamed from the business location settings, the Payment Recovery Report shows those same names.
- **Amount columns are easier to read.** The currency symbol is shown in the Amount heading, and the amount values are shown as clean numbers.
- **Number and amount values are right aligned.** This makes totals easier to compare in the Summary and Detail tabs.
- **Print and export copies follow the same clear amount heading.** Users see the currency symbol in the heading instead of inside each amount value.

#### Guide
- **Go to Reports > Payment Recovery Report.**
- **Select the required Payment Location, Payment Method, Customer, Staff, or Date Range.**
- **Open the Summary tab.**
- **Check the Type names, No of Transactions, Amount, and footer Total.**
- **The Type names should match the Payment Method names saved in the selected business location.**
- **The footer Total should match the amounts shown for the selected date range.**
- **Open the Detail tab if you need to check the individual recovered payments.**

---

### Module: Roles & Permissions - Sale Return

#### What Is Easier Now
- **Sale Return permissions are now easier to control.** Admins can give separate access for sale returns made against an invoice and direct sale returns.
- **Own and all access can be managed separately.** A user can be allowed to see only their own sale returns, or all sale returns, for each sale return type.
- **Sale Return now has its own permission section.** In the Sales tab, Sale Return permissions appear under a separate Sale Return heading, similar to the Shipments section.
- **Edit and Delete can now be controlled separately.** Admins can allow a user to view sale returns without also allowing them to edit or delete them.
- **Sale Return Payment permissions are now separate.** Admins can separately allow users to add, edit, or delete sale return payments.
- **Sale Return permissions are still available when the Sales module is turned off.** If POS is enabled but Sales is disabled, the Sale Return permission section appears in the POS tab on the role screen.

#### Guide
- **Go to Settings > Roles.**
- **Open Add Role or Edit Role.**
- **If the Sales module is enabled, open the Sales tab and find the Sale Return section.**
- **If the Sales module is disabled and POS is enabled, open the POS tab and find the Sale Return section there.**
- **Select the Sale Return access, edit, delete, and payment options needed for that role.**
- **Click Save or Update.**

---

### Module: Sales Report - Workstation Sales

#### What Is Easier Now
- **Workstation sales now show the correct Added By name after syncing to cloud.** If a sale is created by a cashier on Workstation 01, the Sales list keeps showing that same cashier name after the sale is synced.
- **Station filtered sales are easier to trust.** When users filter the Sales list by workstation, the Added By column now matches the user who actually made the sale.

#### Guide
- **Go to Sales > List Sales.**
- **Use the Station or Workstation filter if needed.**
- **Check the Added By column.**
- **For synced workstation sales, this name should be the cashier who created the sale on the workstation.**

---

### Module: Reports - Stock Value Report

#### What Is Easier Now
- **Stock used in manufacturing is now shown clearly in the Stock Value Report.** When a product is used as an ingredient, the report now shows it separately as **Ingredients (Out)** instead of making the stock look like it reduced without a clear reason.
- **Opening Stock is easier to understand.** If stock was already used as an ingredient before the selected date, that usage is now included in the opening calculation so the opening quantity matches the real stock position.
- **Current Stock is easier to check.** Users can now compare Opening Stock, stock coming in, stock going out, and Ingredients (Out) to understand why the current stock is lower.
- **Ingredient value is also shown.** The report shows the value of ingredient stock used in manufacturing, so stock value totals are clearer.
- **Print and Excel copies now include the same ingredient information.** Users can download or print the report and still see why stock was reduced.

#### Guide
- **Go to Reports > Stock Value Report.**
- **Select the required date, location, product, or SKU.**
- **Check the Opening Stock and Current Stock columns.**
- **If the Current Stock is lower than expected, check the Ingredients (Out) column.**
- **If Ingredients (Out) has a quantity, it means that stock was used in manufacturing.**
- **Use Print or Export to Excel if you need to share or keep the report.**

---

### Module: Reports - Stock Quantity and Stock Value Reports

#### What Is Easier Now
- **Variation column is now hidden when no variations are saved.** If the business has not added any variation template, the Stock Quantity Report and Stock Value Report will not show the Variation column.
- **Reports are cleaner for simple products.** Businesses that do not use sizes, colors, or other variations will now see fewer empty columns.
- **Printed and exported reports follow the same rule.** Print, PDF, and Excel copies also hide the Variation column when no variations are saved.

#### Guide
- **Go to Products > Variations and check if any variation is saved.**
- **If no variation is saved, open Reports > Stock Quantity Report or Reports > Stock Value Report.**
- **The Variation column will not appear in the report.**
- **If you add a variation later, the Variation column will appear again where it is needed.**
- **Use Print, PDF, or Export to Excel as usual. The same column layout will be used.**

---

## Version 8.90.4

**Release Date:** 2026-06-26

---

### Module: Business Settings - Default Customer

#### What Is Easier Now
- **Sales and POS default customers now follow their own settings.** If the Sales tab default customer is left as **Please Select**, the Add Sale screen now opens with no customer selected.
- **POS default customer is handled separately from Sales default customer.** Changing the default customer for POS will not change the Add Sale screen customer, and changing the Sales default customer will not change the POS customer.
- **Branch-wise default customer settings now work correctly.** Each business location can keep its own Sales and POS default customer choice.

#### Guide
- **Go to Business Settings > Location-based Settings.**
- **Select the business location you want to set.**
- **Open the Sale tab and choose the Default Customer for Add Sale.**
- **Open the POS tab and choose the Default Customer for POS.**
- **Choose Please Select if you want the cashier to select a customer manually.**
- **Save the settings, then open Add Sale or POS to check the customer field.**

---

### Module: Reports - Print, PDF, and Excel

#### What Users Can Do Now
- **Print options have been added to more reports.** Users can open a clean report preview directly from the report screen.
- **Reports can now be printed, saved as PDF, or exported to Excel from the preview page.**
- **Selected filters are followed in the preview.** For example, if a user selects a location, category, supplier, product, date, or other filter, the printed report shows the same filtered result.
- **Report buttons are easier to find.** Print and export buttons are now placed near the top of the report area where they are needed.
- **Wide reports are easier to read in print preview.** Long tables are adjusted so columns fit better on the page.
- **Report page navigation works better in the preview.** Users can move between preview pages using the page buttons.
- **Report captions now show proper names.** Labels such as All Locations and Tab: Detail now appear clearly instead of showing missing language text.
- **Sale Invoices Report detailed print preview now opens normally.** Users can print the detailed invoice view without seeing an error page.
- **Product Sell Report Not Sold tab now shows products correctly when matching data is available.**
- **Stock Value Report preview page buttons now work better for Categorized and Location Details views.**
- **Expense Report print preview now includes the chart and the table.** Users can print the same chart view they see on the report screen.
- **Trending Products print preview now includes the chart and product list.** Users can print or export the same filtered trending products view.
- **Activity Log is easier to read.** The Note column now gets more space, and other columns stay compact and left aligned.

#### Reports Covered
- **Profit / Loss Report:** Summary and profit-by tabs.
- **Purchase & Sale Report.**
- **Purchase Report:** Supplier, reference, purchase date, payment date, payment method, and purchase totals.
- **Purchase Invoices Report:** Totals, Summary, and Detailed tabs.
- **Purchases & Returns Report:** Purchase and purchase return list with supplier, payment, date, and location filters.
- **Product Purchase Report:** Summary, Detailed, group-wise, and Not Purchased tabs with product, supplier, location, category, brand, gender, procurement, and date filters.
- **Purchase Payment Report:** Summary and Detail tabs with supplier, payment method, payment location, transaction location, and date filters.
- **Purchase Analysis Report:** Yearly, monthly, weekly, daily, day-of-week, and hourly views.
- **Sale Report:** Sales list with customer, payment, date, location, user, station, and related filters.
- **Sale Invoices Report:** Totals, Summary, Detailed, and Scheme detail tabs where available.
- **Sales & Returns Report:** Summary tab with sale and return filters.
- **Product Sell Report:** Summary, combo, detailed, grouped, category-wise, brand-wise, gender-wise, procurement-wise, and not-sold tabs.
- **Sell Payment Report:** Summary and Detail tabs.
- **Payment Recovery Report:** Summary and Detail tabs.
- **Discounts Report:** Summary and Detail tabs.
- **Sales Analysis Report:** Yearly, monthly, weekly, daily, day-of-week, and hourly views.
- **Trending Products Report:** Top trending products chart and product list.
- **Tax Report:** Tax Paid, Tax Collected, Expense Tax, and Project Invoice Tax where available.
- **Expense Report:** Chart and category-wise expense table.
- **Activity Log Report.**
- **Account Book:** Account ledger with date and transaction type filters.
- **Cash Flow Report:** Cash flow summary and payment ledger with location, account, date, and transaction type filters.
- **Payment Account Report:** Payment list with account, date, and linked account filters.
- **Contact Detail Page:** Ledger formats, purchases, stock, sales, payments, notes, rewards, and activity tabs.
- **Customer & Supplier Report:** Contact balances with location, type, contact, customer group, and date filters.
- **Customer Group Report:** Customer group sales totals with location, customer group, and date filters.
- **Cheque Clearance Report:** Pending and cleared cheque payments with contact, status, payment location, and date filters.
- **Stock Quantity Report:** Details, Categorized, and Locations.
- **Stock Value Report:** Details, Categorized, Locations, and Location Details.
- **Stock Reorder Report.**
- **Stock Performance Report:** Summary and Average Sold tabs.
- **Opening Stock Report.**
- **Mismatch Report.**
- **Stock Expiry Report.**
- **Stock Adjustment Report.**
- **Stock Take Report.**
- **Stock Transfer Report.**
- **Items Report:** Purchase, sale, supplier, customer, location, date, and manufacturing item filters.
- **Combo Items Report.**
- **Product Status Report.**
- **Product Serial Report.**
- **Lot Report.**

#### Guide
- **Open the required report from the Reports menu.**
- **Select the filters you need, such as date, location, product, category, brand, supplier, or serial number.**
- **Open the report tab you want, if the report has tabs.**
- **Click Print at the top of the report area.**
- **Check the preview that opens in the new tab.**
- **Use Print, PDF, or Export to Excel from the preview page as needed.**
- **Use the page buttons in the preview when the report has more than one page.**

---

### Module: Reports - Product Serial Report

#### What Is Easier Now
- **Product Serial Report now opens without getting stuck on Processing.** The report should load normally, even when there are many sale and purchase serial number records.
- **The All, Sell, and Purchase filters now work smoothly.** Users can view all serial number activity together, or show only sales or only purchases.
- **Purchase invoice links now open the correct purchase details.** Sale rows open sale details, and purchase rows open purchase details.
- **Discount percentage now shows safely even when the item price is 0.** The report will not stop loading because of a zero-price item.

#### Guide
- **Go to Reports > Product Serial Report.**
- **Use the filters for date, location, product, contact, supplier, type, or serial number.**
- **Wait for the report table to load.**
- **Click an invoice number to open the related sale or purchase details.**

---

## Version 8.90.3

**Release Date:** 2026-06-25

---

### Module: Reports - Stock Report

#### What Users Can Do Now
- **Stock Report can now be printed from the Details tab.** The Print button opens a clean preview with the business logo, business name, location, report title, date and selected filters.
- **Users can print, save as PDF, or export to Excel from the preview.**
- **The preview follows the filters selected on the Stock Report.** Location, category, supplier, brand, product details, quantity options and price options stay the same in the printed or exported copy.
- **Wide stock reports are easier to read.** The preview is arranged for A4 landscape printing and includes clear page controls.
- **Grand totals are included.** The final page shows the overall total for the report.

#### Guide
- **Go to Reports > Stock Report.**
- **Open the Details tab.**
- **Select the filters you need.**
- **Click Print.**
- **Use the preview buttons to print, save as PDF, export to Excel, zoom, or move between pages.**

---

### Module: CMS - Public Landing Page

#### What Users Can See Now
- **The public homepage now has an Advanced Modules section.** It shows useful add-on modules such as AI Assistance, Manufacturing, CRM, HRM, Project, Repair, Accounting, Warehouse, Online Store, Asset Management, Rental and Connector.
- **The module cards slide automatically and work on desktop, tablet and mobile screens.**

- **Homepage wording is clearer and more professional.** It explains the business benefits of POS, inventory, accounting, CRM, HR and AI tools in simple sales language.
- **The homepage now presents the platform as one complete business system instead of only a basic POS.**

- **The homepage now uses the configured application name.** The page feels branded for the installed business or product name.
- **The landing page design is more modern.** Sections, cards, buttons, testimonials, FAQs and call-to-action areas are easier to read and more polished.

#### Guide
- **Open the public website homepage.**
- **Scroll to the Advanced Modules section to view available modules.**
- **Use the slider dots or wait for the cards to move automatically.**
- **Review the feature, industry, testimonial, FAQ and call-to-action sections for the updated content.**

---

### Module: Offline Sync

#### What Is Easier Now
- **Local installations stay faster when the internet is off.** POS and normal pages no longer wait too long for an online connection.
- **Cashiers can keep using POS during internet problems.** The system quickly notices connection problems and lets local work continue.
- **The Offline Sync page opens faster when there is no internet.**
- **Standalone local installs behave better with weak or missing internet.** Users see fewer delays and fewer login or notification problems.
- **The app works better in both browser and desktop app mode.** Local pages, styles, redirects and printing behave more reliably.

#### Guide
- **If the internet is off, continue using POS as normal on the local system.**
- **Open Offline Sync only when you want to check or start syncing.**
- **When internet comes back, use the sync options as usual.**
- **For desktop users, printing and workstation features should continue to work in the desktop app.**

---

### Module: Software Update Page

#### What Is Easier Now
- **Software updates are easier for administrators.** After clicking **I Understand, Update**, the system finishes the normal update work automatically.
- **Admins no longer need to do extra steps after updating.**
- **The update page should finish faster and feel less stuck during normal updates.**
- **The system should run smoother after the update is completed.**

#### Guide
- **Go to the Software Update page.**
- **Read the update confirmation message.**
- **Click I Understand, Update.**
- **Wait until the update finishes and returns you to the login screen.**
- **Log in again and continue using the system.**

---

## Version 8.89.12

**Release Date:** 2026-06-24

### Module: Products - Import Products

#### What Is Easier Now
- **Import Products now saves a selling price of 0 from Excel.** If **Update Existing Products** is ticked and the SKU already exists, entering **0** in the Selling Price column will update the product selling price to 0.
- **Blank Selling Price still works as before.** If the Selling Price cell is left blank, the system will calculate the selling price from the purchase price and profit margin.

#### Guide
- **Go to Products > Import Products.**
- **Choose your Excel file.**
- **Tick Update Existing Products.**
- **Enter 0 in the Selling Price column if the product price should become 0.**
- **Import the file and check the product to confirm the new selling price.**

---

### Module: Reports - Stock Value Report

#### What Works Correctly Now
- **Opening Stock now shows the correct quantity when an As of Date is selected.** The quantity now matches the Product Stock History for the same product and location.
- **Manufactured products are now counted correctly in Opening Stock.** If stock was made before the selected date, it is included in the opening quantity.
- **Wrong negative Opening Stock quantities are now corrected.** Products should no longer show an incorrect negative opening quantity when the history shows a positive balance.

#### Guide
- **Go to Reports > Stock Value Report.**
- **Select the required As of Date.**
- **Search the product or SKU you want to check.**
- **Check the Opening Stock column for the selected location.**
- **If needed, open Product Stock History for the same product and location to confirm the quantity matches.**

---

## Version 8.89.11

**Release Date:** 2026-06-23

### Module: Software Update Page

#### What Users Can Do Now
- **A red UPDATE button now appears in the main software navbar when a new software update is available.** Users can quickly see that the system needs to be updated.
- **The UPDATE button opens the Software Update page.** Users do not need to remember or type the update page link.
- **The update can now be completed from the Software Update page.** Users can click I Understand, Update and follow the on-screen update flow.
- **After the update is completed once, the UPDATE button is hidden for everyone.** Other businesses and users will no longer see the button after the system has already been updated.
- **User roles continue working after the update.** Cashier and other staff roles should keep their access without needing to edit and save the role again.

#### Guide
- **When the red UPDATE button appears in the main navbar, click UPDATE.**
- **Read the warning on the Software Update page.**
- **Take a backup before continuing.**
- **Click I Understand, Update.**
- **Wait until the update is completed.**
- **After the update is completed, log in again if the software asks you to.**
- **Check that staff users can still open their normal screens, such as sales, purchases, products, and reports.**

---

### Module: Superadmin Menu Access

#### Guide
- **The Superadmin menu is shown only to users who have Superadmin access.**
- **If the Superadmin menu is not visible, log in with the correct Superadmin user account.**
- **If the menu is still not visible, ask the system owner to check that your username is allowed for Superadmin access.**

---

## Version 8.89.10

**Release Date:** 2026-06-22

### Module: Superadmin - Registration Link

#### What Is Easier Now
- **A Registration URL field has been added beside Allow Registration.** Superadmin can now choose where the Register Now buttons should send new users.
- **The normal registration page is still used by default.** If no other link is entered, users will continue to go to the normal business registration page.
- **Register Now buttons now follow the saved Registration URL.** Login pages, website buttons, pricing package buttons, repair status pages, truckmate status pages, and scanner pages all use the same saved link.
- **Package and language choices are carried forward when possible.** If a user clicks register from a package card or changes language, the selected information is passed to the registration link.
- **Opening the old registration page can also send users to the saved registration link.** This helps keep all registrations going to the same place.

#### Guide
- **Go to Superadmin > Settings.**
- **Open the Application Settings tab.**
- **Tick Allow Registration if new businesses should be allowed to register.**
- **In Registration URL, keep the default registration page or enter another link, such as `https://register.bitorepos.com/`.**
- **Click Update Settings.**
- **Now users who click Register Now will be sent to the saved registration link.**

---

### Module: Project - Reset Options

#### What Users Can Do Now
- **Hard Reset Options has been added to the Project module.** Project managers can now open a separate reset page from the Project menu.
- **Project transactions can be reset separately.** This is useful when project activity needs to be cleared before starting fresh.
- **Project data can be reset separately.** This is useful when project setup records need to be removed after project activity has already been cleared.
- **A warning and confirmation message is shown before reset.** Users must confirm before selected project data is permanently removed.

#### Guide
- **Go to Project > Hard Reset Options.**
- **Tick Reset Project Transactions if project transaction activity should be removed.**
- **Tick Reset Project if project records and setup should be removed.**
- **Click Reset Data.**
- **Read the warning carefully and confirm only if you are sure.**

---

### Module: Truckmate - Reset Options

#### What Users Can Do Now
- **Hard Reset Options has been added to the Truckmate module.** Users can now open a reset page from the Truckmate menu.
- **Truckmate transactions can be reset separately.** This helps clear Truckmate job or transaction activity when a fresh start is needed.
- **Truckmate setup data can be reset separately.** This helps remove Truckmate records after the related activity has already been cleared.
- **A warning and confirmation message is shown before reset.** Users must confirm before selected Truckmate data is permanently removed.

#### Guide
- **Go to Truckmate > Hard Reset Options.**
- **Tick Reset Truckmate Transactions if Truckmate transaction activity should be removed.**
- **Tick Reset Truckmate if Truckmate records and setup should be removed.**
- **Click Reset Data.**
- **Read the warning carefully and confirm only if you are sure.**

---

### Module: Installment - Reset Options

#### What Users Can Do Now
- **Hard Reset Options has been added to the Installment module.** Users can now open a reset page from the Installment menu.
- **Installment transactions can be reset separately.** This helps clear installment payment activity when a fresh start is needed.
- **Installment setup data can be reset separately.** This helps remove installment settings and records after installment activity has already been cleared.
- **A warning and confirmation message is shown before reset.** Users must confirm before selected installment data is permanently removed.

#### Guide
- **Go to Installment > Hard Reset Options.**
- **Tick Reset Installment Transactions if installment transaction activity should be removed.**
- **Tick Reset Installment if installment records and setup should be removed.**
- **Click Reset Data.**
- **Read the warning carefully and confirm only if you are sure.**

---

### Module: Warehouse - Reset Options

#### What Users Can Do Now
- **Hard Reset Options has been added to the Warehouse module.** Users can now open a reset page from the Warehouse menu.
- **Warehouse transactions can be reset separately.** This helps clear warehouse transfer, movement, and stock activity when a fresh start is needed.
- **Warehouse setup data can be reset separately.** This helps remove warehouse records after warehouse activity has already been cleared.
- **A warning and confirmation message is shown before reset.** Users must confirm before selected warehouse data is permanently removed.

#### Guide
- **Go to Warehouse > Hard Reset Options.**
- **Tick Reset Warehouse Transactions if warehouse transaction activity should be removed.**
- **Tick Reset Warehouse if warehouse records and setup should be removed.**
- **Click Reset Data.**
- **Read the warning carefully and confirm only if you are sure.**

---

### Module: Superadmin - Business Reset

#### What Is Easier Now
- **More reset choices are now available from the Superadmin business reset screen.** Superadmin can reset Truckmate, Installment, Warehouse, and Project data while managing a business.
- **Each supported area has separate choices for transactions and setup data.** Superadmin can clear only the part that is needed instead of resetting everything at once.

#### Guide
- **Go to Superadmin > All Businesses.**
- **Open the required business.**
- **Find the reset options section.**
- **In Transactions Hard Delete, tick the required option such as Reset Truckmate Transactions, Reset Installment Transactions, Reset Warehouse Transactions, or Reset Project Transactions.**
- **In Data Entry Hard Delete, tick the required option such as Reset Truckmate, Reset Installment, Reset Warehouse, or Reset Project.**
- **Confirm the reset only after checking the selected business and selected options.**

---

### Module: Rental Management - Navigation

#### What Is Easier Now
- **Rental Management now has a cleaner top menu.** Users can move between Dashboard, Rental Items, Agreements, Returns, Payments, Calendar, Damage Reports, Maintenance, Reports, and Settings from one clear menu.
- **The active Rental page is easier to identify.** The Rental menu now highlights the current section more clearly.
- **The Rental menu is easier to use on smaller screens.** The menu can collapse neatly when there is less screen space.

#### Guide
- **Go to Rental Management.**
- **Use the top menu to open the required rental area.**
- **Look for the highlighted menu item to know which page you are currently viewing.**

---

### Module: Rental Management - Page Access and Settings

#### What Works Correctly Now
- **Rental pages now open normally.** Settings, Maintenance, Calendar, Agreements, and Add Rental Item pages no longer show an error page.
- **Rental Settings now saves properly.** When users click Save, the page responds and the saved choices are kept.
- **Reminder and overdue notice choices now save correctly.** Users can turn these options on or off from Rental Settings.
- **Default rental terms now save correctly.** Users can save the standard terms they want to use for rental work.

#### What Looks Different
- **The Rental Settings Save button is now shown in the main software footer.** This keeps the save button in the same place users see on other software screens.

#### Guide
- **Go to Rental Management > Settings.**
- **Change the required rental settings.**
- **Click Save from the main software footer.**
- **Open Settings again if you want to confirm the saved choices are still selected.**

---

### Module: Rental Management - Agreements

#### What Is Easier Now
- **Rental Agreements list now shows clearer information.** Users can see agreement number, customer, location, rental period, total amount, balance due, status, and payment status in one table.
- **Agreement filters are easier to use.** Users can filter agreements by status, business location, date range, and payment status.
- **Rental Calendar can now be filtered by location and status.** This helps users view only the rental bookings they need to check.
- **The Return and Print buttons on agreement details now open the correct screens.** Users can process returns or print an agreement from the agreement detail page more smoothly.

#### Guide
- **Go to Rental Management > Agreements.**
- **Use the Status, Business Location, Date Range, and Payment Status filters to narrow the list.**
- **Click an agreement number to open the agreement details.**
- **Use Process Return when rental items are coming back.**
- **Use Print when you need a printed copy of the agreement.**
- **Go to Rental Management > Calendar and use the Location or Status filters to check bookings on the calendar.**

---

### Module: Rental Management - Maintenance

#### What Is Easier Now
- **Maintenance entries can now be added from the Maintenance page.** Users with maintenance access can click Add and create a new maintenance record.
- **Maintenance list filters are improved.** Users can filter by maintenance type, status, and priority.
- **Maintenance types are clearer.** Users can choose Routine, Repair, Inspection, Cleaning, or Replacement.
- **Priority choices are clearer.** Users can choose Low, Normal, High, or Urgent.
- **Maintenance can be assigned to a staff member.** The Assigned To field now uses a staff list, making it easier to choose the right person.
- **The Maintenance list now shows the assigned staff member by name.** Users can quickly see who is responsible for each maintenance job.

#### Guide
- **Go to Rental Management > Maintenance.**
- **Click Add to create a maintenance record.**
- **Select the rental item, maintenance type, priority, scheduled date, cost, and assigned staff member.**
- **Save the record.**
- **Use the Type, Status, and Priority filters to find maintenance records later.**
- **Use Edit to update an open maintenance record or Mark Completed when the work is done.**

---

### Module: Rental Management - Form Buttons

#### What Looks Different
- **Rental Item form buttons are now in the main software footer.** Users can add or edit a rental item and click Save from the footer.
- **Rental Agreement form buttons are now in the main software footer.** Users can Save as Draft, Confirm Agreement, or Update from the footer when those actions are available.
- **Rental Maintenance form buttons are now in the main software footer.** Users can add or edit maintenance records and click Save from the footer.
- **Agreement buttons still follow the agreement status.** Draft agreements show draft and confirm choices, while confirmed agreements show the update choice.

#### Guide
- **Go to Rental Management > Rental Items and add or edit an item.**
- **Click Save from the main software footer.**
- **Go to Rental Management > Agreements and add or edit an agreement.**
- **Use Save as Draft, Confirm Agreement, or Update from the main software footer, depending on what is shown.**
- **Go to Rental Management > Maintenance and add or edit a maintenance record.**
- **Click Save from the main software footer.**

---

### Module: Business Settings - Transaction Edit Days

#### What Works Correctly Now
- **Transaction Edit Days now follows the value saved in Global Settings.** If the business sets this to 399 days, users can edit allowed transactions within 399 days instead of being stopped after 30 days.
- **The setting now applies business-wide across every location.** Users do not need to update the same value separately for each branch.
- **Purchase editing now follows the saved Transaction Edit Days value.** Older purchases can be edited when they are still inside the allowed number of days.
- **The same edit-day rule is also followed on sales, repairs, truckmate sales, and stock transfers.** Users will see the same rule across these transaction screens.

#### Guide
- **Go to Business Settings > Global Settings > Business.**
- **Enter the required number in Transaction Edit Days.**
- **Click Update Settings.**
- **Open the transaction you want to edit, such as a purchase, sale, repair, truckmate sale, or stock transfer.**
- **If the transaction date is within the saved number of days, the edit screen will open normally.**
- **If the transaction is older than the saved number of days, the system will show that editing is not allowed.**

---

### Module: Administer Backup

#### What Is Easier Now
- **Old backup files are now removed automatically after 72 hours.** This helps keep the backup list clean and avoids keeping very old backup files for too long.
- **The backup list now shows Deletion Time.** Users can see when each backup file is expected to be removed.
- **Backup date and age are easier to understand.** Users can check when the backup was created and how much time is left before it is deleted.

#### Guide
- **Go to Administer Backup from the sidebar menu.**
- **Check the Deletion Time column to see when each backup file will be removed.**
- **Download any backup file before its deletion time if you need to keep a copy.**
- **Create a new backup when you need a fresh backup file.**

---

### Module: Security Roles - Administer Backup Access

#### What Is Easier Now
- **Administer Backup now has its own role permission.** Business owners can allow selected staff to open the Administer Backup page without giving them full admin access.
- **The permission is available in Security Roles.** This makes it easier to control who can see and use the backup page.
- **Staff with this permission can see Administer Backup in the sidebar menu.** Staff without permission will not see or open the page unless they already have allowed access.

#### Guide
- **Go to Settings > Security Roles.**
- **Create a new role or edit an existing role.**
- **Open the Settings section.**
- **Tick Access administer backup.**
- **Save the role.**
- **Assign this role to the staff members who need Administer Backup access.**

---

## Version 8.89.9

**Release Date:** 2026-06-21

### Module: Reports - Stock Value Report

#### What Is Easier Now
- **Export to Excel and Print buttons are now available on the Locations tab.** Users can download or print the location-wise stock value summary directly from the report.
- **A new Location Details tab has been added.** Users can now see products grouped under each business location, making it easier to review stock value location by location.
- **Each location section shows its own totals.** Users can check opening stock, purchases, returns, sales, current stock, stock value, and other totals for one location before moving to the next location.
- **Grand totals are shown at the bottom of Location Details.** Users can still see the overall totals for all shown locations in one place.
- **Location Details can also be exported to Excel or printed.** Users can save or print the location-wise product detail report for checking, sharing, or record keeping.

#### Guide
- **Go to Reports > Stock Value Report.**
- **Use the filters at the top to choose the required location, supplier, category, brand, unit, or stock options.**
- **Open the Locations tab to see the location-wise stock value summary.**
- **Click Export to Excel or Print on the Locations tab if you need a downloaded or printed copy.**
- **Open the Location Details tab to see each location with its own product list and section totals.**
- **Click Export to Excel or Print on the Location Details tab if you need the full location-wise product detail report.**

---

### Module: Product Stock History

#### What Works Correctly Now
- **The Type filter now works correctly on Product Stock History.** When users choose a type, the history table shows only matching entries.
- **Manufacturing (In) now shows only manufactured product entries.** Other transactions such as stock transfers and stock adjustments are no longer mixed into this view.
- **Only completed production appears in Manufacturing (In).** Planned or pending production will not appear in Product Stock History until it is completed.
- **The selected location tab stays easier to follow while changing the Type filter.** Users can check a location such as Production Depot without losing their place.

#### Guide
- **Open Products and go to Product Stock History.**
- **Select the required product.**
- **Choose Manufacturing (In) from the Type filter to see completed manufactured entries.**
- **Click a production number to open its production details.**
- **Complete/finalize production when it should be added to stock.**

---

### Module: Offline Sync - User Settings

#### What Works Correctly Now
- **User settings changed on live/cloud now work on the offline workstation after sync.** The workstation follows the same settings as the live system for the synced user.
- **The Recent Transactions Total setting now works correctly on the workstation.** If this setting is turned off for a user, the Recent Transactions popup follows the same choice offline.
- **User settings linked with locations, quick menus, selling price groups, and drug classes now stay matched after sync.** This helps the workstation show the same choices and access as live/cloud.

#### Guide
- **Go to Offline Sync.**
- **Click Sync All for the easiest update.**
- **If syncing one by one, sync Business Locations, Users, Drug Classes, Quick Menu, and Products.**
- **If the current logged-in user's settings were changed, log out and log in again after sync.**
- **Open POS or User Settings on the workstation to confirm the same settings are now applied.**

---

### Module: Offline Sync - Transaction Backup Settings

#### What Is Easier Now
- **Transaction Backup settings can now be synced to the offline workstation.** The workstation can receive the backup on/off setting and saved backup folders from live/cloud.
- **A Sync Settings button is now available on the Transaction Backup page in offline mode.** Users can update backup settings without entering them again by hand.
- **Transaction Backup Settings is also available on the Offline Sync page.** Users can sync it together with other workstation settings.

#### Guide
- **Go to Offline Sync and click Sync for Transaction Backup Settings.**
- **Or go to Backup > Transaction Backup and click Sync Settings.**
- **After syncing, check that the backup option and folder fields are correct.**
- **Use Save Settings only if you need to change anything on the workstation.**

---

### Module: Offline Sync - Products

#### What Works Correctly Now
- **Product prices changed on live/cloud now update correctly on the offline workstation.** After Products sync, the workstation shows the latest selling price.
- **Products sync is faster again for normal use.** The workstation no longer spends extra time checking every product price when it is not needed.
- **A deeper price check is still available when an old price needs to be checked again.** This can be used only when required.

#### Guide
- **Go to Offline Sync.**
- **Click Sync for Products.**
- **After sync, open the product or POS screen on the workstation and check the latest price.**
- **If a price still looks old, run Products sync again or ask support to run the deeper price check.**

---

### Module: Reports - Customer/Supplier Report

#### What Is Easier Now
- **Ledger Discount column now uses the label set in Business Settings.** If users rename Ledger Discount from the Merchants tab, the Customer/Supplier Report shows the same name.
- **Ledger Discount 2 and Ledger Discount 3 columns are now available in the Customer/Supplier Report.** These columns appear only when they are enabled from Business Settings.
- **Ledger Discount 2 and Ledger Discount 3 use their own labels from Business Settings.** This makes the report wording match the names used by the business.
- **Total Due now considers all enabled ledger discount types.** Users can see a more complete customer or supplier balance when Ledger Discount 2 or Ledger Discount 3 is used.

#### Guide
- **Go to Business Settings > Merchants.**
- **Set the required labels for Ledger Discount, Ledger Discount 2, and Ledger Discount 3.**
- **Enable Ledger Discount 2 or Ledger Discount 3 if the business uses them.**
- **Go to Reports > Customer/Supplier Report.**
- **Check the discount columns and Total Due amount in the report.**

---

### Module: Contacts - Contact Payment

#### What Works Correctly Now
- **Ledger Discount 2 and Ledger Discount 3 can now be adjusted in Contact Payment.** Users can adjust these discount rows together with a purchase invoice from the Contact Payment screen.
- **Saving Contact Payment with Ledger Discount 2 or Ledger Discount 3 no longer shows an error.** Users can save the payment normally after entering the required Today Pay amounts.

#### Guide
- **Open a supplier contact.**
- **Click Contact Payment.**
- **Select the purchase invoice and any Ledger Discount, Ledger Discount 2, or Ledger Discount 3 rows that need adjustment.**
- **Use Auto Apply or enter the Today Pay amounts manually.**
- **Click Save to record the payment.**

---

### Module: Contacts - Contact Ledger

#### What Is Easier Now
- **Edit and Delete buttons are no longer shown inside Ledger Discount rows in the ledger.** The ledger now looks cleaner and users will not see these action buttons directly inside the ledger line.
- **Ledger Discount records can still be managed from the Ledger Discount list.** Users can use the normal View Ledger Discounts option when they need to review or manage discount entries.

#### Guide
- **Open a contact and view the ledger.**
- **Ledger Discount rows will show as ledger entries without inline Edit or Delete buttons.**
- **Use View Ledger Discounts when you need to open the discount list.**

---

### Module: Reports - Payment Recovery Report

#### What Is Easier Now
- **Staff filter has been added to the Payment Recovery Report.** Users can now view recovered payments for one selected staff member.
- **The Summary and Detail tabs both follow the selected staff filter.** This helps users check staff-wise payment recovery totals and payment details from the same report.

#### Guide
- **Go to Reports > Payment Recovery Report.**
- **Use the Staff filter to select the required staff member.**
- **Check the Summary tab for staff-wise totals.**
- **Open the Detail tab to see the payment recovery entries for that staff member.**
- **Clear the Staff filter to view payment recovery for all staff again.**

---

### Module: Contacts - Advance Deposit

#### What Is Easier Now
- **Advance Deposit now has separate View and Add buttons on the View Contact page.** Users can open the deposit list or add a new advance deposit directly from the top button area.
- **The View Advance Deposit button opens the previous advance deposits list.** Users can check old advance deposits without opening the add form.
- **The Add Advance Deposit button opens the new advance deposit form.** Users can record a new advance deposit without first going through the list.

#### Guide
- **Go to Contacts and open the required customer or supplier.**
- **On the View Contact page, look at the top-right button area.**
- **Click View Advance Deposit to check previous advance deposits.**
- **Click Add Advance Deposit to record a new advance deposit.**

---

### Module: POS - Recent Transactions

#### What Is Easier Now
- **Recent Transaction Total is now shown at the bottom of the Transactions popup.** Users can see the total near the footer buttons without looking inside the transaction list.
- **The total stays visible while reviewing transactions.** This makes it easier to check the total amount while scrolling through recent sales.
- **The total changes with the selected tab.** When users open another tab, the bottom total shows the amount for that tab.

#### Guide
- **Go to the POS screen.**
- **Click Transactions to open the Recent Transactions popup.**
- **Check the Recent Transaction Total at the bottom of the popup.**
- **Open another tab, such as Credit Sale, Draft, or Return, to see that tab's total.**

---

## Version 8.89.8

**Release Date:** 2026-06-20

### Module: Stock Transfer - Manufacturing Option

#### What Is Easier Now
- **Production (Manufacturing) is now shown only for businesses that have Manufacturing in their package.** Businesses without Manufacturing will no longer see this option on the Add Stock Transfer or Edit Stock Transfer page.
- **Stock Transfer pages are cleaner for non-manufacturing businesses.** Users only see the options that apply to their package.

#### Guide
- **Go to Stock Transfers > Add Stock Transfer.**
- **If your package includes Manufacturing, you can use Production (Manufacturing) to load production ingredients.**
- **If your package does not include Manufacturing, the Production (Manufacturing) option will not appear.**

---

### Module: Manufacturing - Production

#### What Is Easier Now
- **Ingredient current stock is now shown while creating production.** When users select a product recipe, each ingredient row shows the available stock for the selected business location.
- **Extra ingredients also show current stock.** If users add another ingredient manually, its available stock is shown under the ingredient name.
- **Stock quantity follows the selected ingredient unit.** If users change the ingredient unit, the shown stock quantity updates to match that unit.

#### Guide
- **Go to Manufacturing > Production > Add.**
- **Select the Business Location and Product.**
- **Check the Current stock Quantity shown under each ingredient name.**
- **Use this stock quantity to confirm whether enough raw material is available before saving production.**
- **If you add another ingredient manually, check its stock quantity under the ingredient name before continuing.**

---

### Module: Reports - Stock Transfer Report

#### What Users Can Do Now
- **Products Summary tab has been added to the Stock Transfer Report.** Users can now see product-wise stock transfer totals in one place.
- **Users can check how many transfers included each product.** The report also shows the total quantity transferred and the total value for each product.
- **The Products Summary tab follows the selected filters.** Date range, Location From, Location To, status, category, brand, gender, and procurement source filters update the product summary.

#### Guide
- **Go to Reports > Stock Transfer Report.**
- **Use the filters at the top of the page to select the required date, locations, status, or product group.**
- **Open the Products Summary tab.**
- **Check each product's transfer count, total quantity, and total value.**

---

## Version 8.89.7

**Release Date:** 2026-06-19

### Module: Sales - Duplicate Invoice Numbers

#### What Works Correctly Now
- **Fix Duplicates now corrects repeated sale invoice numbers without removing any sale.** If different sales were given the same invoice number, the system can now give the extra sales new invoice numbers safely.
- **Product sale details stay unchanged.** Product quantities, sale amounts, payments, and customer records remain the same.
- **The sales list refreshes after fixing duplicates.** Users can immediately check that the duplicate invoice numbers are cleared.
- **If there are no duplicate invoice numbers, the system shows a clear message.** Users do not need to guess whether anything was changed.

#### Guide
- **Go to Sales > List Sales.**
- **Tick Show Only Duplicates to view sales with repeated invoice numbers.**
- **Click Fix Duplicates.**
- **Wait for the success message.**
- **The list will refresh automatically.**
- **Tick Show Only Duplicates again if needed to confirm that no duplicate invoice numbers remain.**

---

### Module: Reports - Sale Invoices Report

#### What Is Easier Now
- **Show Only Duplicates is now available in the Sale Invoices Report filters.** Users can quickly view duplicate sale invoices from the report screen.
- **The Detailed tab now has an Export to Excel button at the bottom.** Users can download the detailed sale invoice report for checking, sharing, or record keeping.
- **The Detailed Excel file now follows the same invoice layout shown on screen.** Each invoice is shown first, with its product details and totals listed underneath.
- **The Excel file follows the selected filters.** Date, location, customer, payment, invoice range, city, state, country, and duplicate filter choices are included when exporting.
- **The Excel file includes invoice and product details.** Users can review invoice totals, paid amount, due amount, payment method, product quantity, price, discount, tax, cost, and profit information in one file.

#### Guide
- **Go to Reports > Sale Invoices Report.**
- **Use the filters at the top of the page to select the required date, location, customer, product, payment method, or invoice range.**
- **Tick Show Only Duplicates if you want to see only duplicate sale invoices.**
- **Open the Detailed tab to view invoice-wise details.**
- **Click Export to Excel at the bottom of the Detailed tab to download the report.**
- **Open the downloaded Excel file to review or share the filtered sale invoice details in the same invoice-wise style.**

---

### Module: Lists - Created At Information

#### What Is Easier Now
- **Created At information is now shown on the Purchases list.** Users can see when each purchase entry was created.
- **Created At information is now shown on the Expenses list.** Users can see when each expense entry was created.
- **Created At information is now shown on the Stock Adjustments list.** Users can see when each stock adjustment was created.
- **Created At information is now shown on the Stock Transfers list.** Users can see when each stock transfer was created.
- **Created At information is now shown on the Accounts list.** Users can see when each account was created.

#### Guide
- **Open the required list page, such as Purchases, Expenses, Stock Adjustments, Stock Transfers, or Accounts.**
- **Look at the last column named Created At.**
- **Use this column to check the actual date and time the record was entered in the system.**
- **The normal Date column still shows the transaction date selected by the user. Created At shows when the record was made.**

---

### Module: Contacts - Contact Payment

#### What Works Correctly Now
- **Customer Contact Payment can now be saved when returning an advance deposit amount to the customer.** Users can enter a negative amount for the advance deposit row and save the payment without seeing a date error.
- **The Paid on date now works more smoothly in Contact Payment.** The payment can be saved even when the date is shown in a different common date style.
- **Cash Contact Payments no longer need a clearance date.** Users paying by Cash can save normally without filling any extra date field.
- **Save and Print now opens the Contact Payment receipt after saving.** Users can save the payment and print the receipt in one flow.

#### Guide
- **Go to Merchants > Customers.**
- **Find the customer and open Contact Payment from the Actions menu.**
- **Select the Location, Payment Method, Paid on date, and Amount.**
- **Enter the amount in Today Pay, or use Auto Apply where suitable.**
- **For Cash payment, no clearance date is needed.**
- **Click Save to record the payment, or Save and Print to record and print the receipt.**

---

### Module: Stock Adjustments - Excel Import

#### What Works Correctly Now
- **Stock Take Excel import now accepts products with 0 counted quantity.** If a product is counted as 0 during Stock Take, users can import it from Excel and continue the stock take normally.
- **Stock Adjustment Excel import does not allow 0 quantity.** If the selected type is Stock Adjustment, users must enter a quantity greater than 0 in the Excel sheet.

#### What Is Easier Now
- **The import instructions now explain how to enter numeric SKUs in Excel.** Users are told to set the SKU column type to Text and put an apostrophe before SKU numbers, for example '196382.

#### Guide
- **Go to Stock Adjustments > Add.**
- **Select Stock Take if you are importing counted stock.**
- **Use SKU in column 1 and Counted quantity in column 2.**
- **For numeric SKUs, set the SKU column to Text and type an apostrophe before the number, for example '196382.**
- **A counted quantity of 0 is allowed for Stock Take.**
- **For Stock Adjustment, do not use 0 quantity in the Excel sheet.**

---

### Module: Stock Adjustments - Stock Take Save

#### What Works Correctly Now
- **Stock Take can now be saved when the counted quantity is 0.** If the product shows negative stock and the actual counted quantity is 0, users can save the stock take normally.
- **Large negative stock quantities no longer stop Stock Take from saving.** Users can correct products that show very low or negative stock without seeing an error page.
- **After saving, users return to the Stock Adjustments list.** This makes it easier to confirm the saved entry and continue work.
- **Opening the Login page while already signed in no longer interrupts work.** If the user is already signed in, the system takes them back to the page they were opening.

#### Guide
- **Go to Stock Adjustments > Add.**
- **Select Stock Take.**
- **Load or search the product.**
- **Enter the actual counted quantity. Use 0 if no stock is found.**
- **Click Save.**
- **After saving, check the saved entry on the Stock Adjustments list.**

---

### Module: Transaction Numbers - Location Wise Numbering

#### What Works Correctly Now
- **New transaction numbers now include the location code after the prefix.** For example, numbers like SRP2026_0001, PR2026_0001, and CR2026_0001 will now be created with the branch code included after the prefix.
- **Purchase Return numbers now follow the branch-wise format.** Each location will get its own number series, using its location code such as 01, 02, or 03.
- **Sell Return Payment numbers now follow the branch-wise format.** This makes it easier to know which branch created the payment.
- **Cash Register numbers now follow the branch-wise format.** New cash register numbers will show the branch code after CR.
- **Payment and voucher numbers now use the selected transaction location.** This helps keep branch-wise records clear when receiving or making payments.
- **Old cash register numbers received from offline or synced data are corrected when saved.** If an old-style cash register number is received, the system will save it in the branch-wise format where possible.

#### Guide
- **Go to Business Settings > Business Locations.**
- **Check that each location has a location code, such as 01, 02, or 03.**
- **When creating a transaction, select the correct business location.**
- **The new number will show the location code after the prefix.**
- **Example: if the prefix is PR and the location code is 03, the new number will start with PR03.**
- **Use the number to quickly identify which branch created the transaction, payment, or cash register.**

---

### Module: Stock Report - Reindex Stock Quantities

#### What Works Correctly Now
- **Reindex Stock Quantities now updates stock history costs more reliably.** When users reindex a product, Stock Adjustment and Stock Transfer history can now show the correct cost price and cost total.
- **Stock Adjustment cost can now be picked from the product's earlier purchase.** For example, if a product was purchased and later adjusted, reindex can use that purchase cost for the adjustment history.
- **Stock Transfer cost is updated for both outgoing and incoming transfer history.** This helps users see the same product cost clearly when stock is moved from one branch to another.
- **Quantity Report reindex and Purchase action reindex now give more consistent results.** Users should not need to reindex from Purchase again just to fix missing Stock Adjustment cost.

#### What Is Easier Now
- **Reindex from Stock Quantity Report now checks all active locations for the product.** This helps when a product was purchased in one location and transferred to another.
- **Product Stock History now has a Reindex Stock Quantities button.** Users can open Product Stock History and reindex the selected product directly from that page.
- **Purchase edit page Re-Index Stock checkbox now refreshes related stock history after saving.**
- **Purchase list action menu Reindex Stock Quantities now refreshes related stock history.**
- **Opening Stock edit page Re-Index Stock checkbox now refreshes related stock history after saving.**

#### Guide
- **Go to Reports > Stock Report or Stock Quantity Report.**
- **Find the product and click Reindex Stock Quantities.**
- **Open Product Stock History to check the result.**
- **Cost Price and Cost Total should now appear for related Stock Adjustment and Stock Transfer rows when purchase cost is available.**
- **For transfer-out rows, New Quantity may show 0 if all stock was moved out from that location. This is normal.**
- **To check received stock, open the destination location tab in Product Stock History.**
- **If editing a purchase or opening stock, tick Re-Index Stock before saving when you want stock history to be refreshed.**

---

### Module: Project Management

#### What Works Correctly Now
- **Project menu buttons now open the correct pages.** Users can click Dashboard, Projects, Kanban Board, My Tasks, Stock, Project Reports, Project Category, and Settings without menu problems.
- **The Project Stock tab now opens correctly when clicked.** Users can open the Stock section from a project page and view the available stock options.
- **Request Stock and Return Stock buttons now work from the Project Stock tab.** Users can open the stock forms, enter details, save, or close the form normally.
- **Project create and edit windows now close properly.** The top close icon and footer Close button now work as expected.
- **Dropdown fields in project forms now open correctly.** Customer, Business Location, Status, Lead, Team Members, and Category lists can now be selected inside the project form.
- **The project budget field now works properly in create and edit forms.** Users can enter or update a project budget normally.
- **The Task tab now opens without warning messages.** Users can open project tasks from a project card or project page without an error popup.
- **The Project Task page layout is now aligned better.** Extra blank space on the right side has been reduced so the page is easier to use.
- **Task create forms now close and open dropdowns correctly.** Users can select priority, status, members, and close the form without refreshing the page.
- **Time Log forms now close and open dropdowns correctly.** Users can select task, user, date/time details, save, or close the form normally.
- **Project card action menu now works.** The three-dot menu on project cards now opens its options correctly.
- **Project edit form now works correctly when opened from the Stock tab.** Users can edit a project from Project > Stock and use all dropdowns and close buttons normally.

#### What Is Easier Now
- **Project Dashboard has been improved for owners.** The dashboard now gives a clearer view of projects, tasks, hours, team members, project status, task priority, recent projects, and upcoming tasks.
- **Project pages now better match the OneDash style.** The module has a cleaner layout and more consistent menu design.
- **Project cards have a modern design.** Cards now show project name, status, category, progress, lead, task count, and quick actions in a cleaner way.
- **Project create and edit windows now keep the header and footer visible.** If the form has many fields, users can scroll the form body while the title and Save/Close buttons stay easy to reach.
- **Project work is now business-location based.** Projects can be linked with a business location, helping businesses manage project work branch by branch.
- **Project stock work is now location-aware.** Stock requests, returns, and project stock records follow the selected project location.
- **Project role permissions are now more complete.** Business owners can give staff access only to the project features they need, such as dashboard, projects, tasks, time logs, documents, stock, reports, invoices, categories, and settings.

#### Guide
- **Go to Project > Dashboard to view the improved project summary.**
- **Go to Project > Projects to view the modern project cards.**
- **Use the three-dot menu on a project card to open View, Edit, Task, Time Logs, Stock, and other options.**
- **Click New Project to create a project and select the correct Business Location.**
- **Open a project and click Stock to request stock, return stock, or view stock history.**
- **Open a project and click Task to create or manage project tasks.**
- **Open a project and click Time Logs to add work time for team members.**
- **Go to Settings > Security Roles and open the Project tab to control which project features each staff role can use.**

---

### Module: Installment Management

#### What Works Correctly Now
- **Installment menu is now available on all Installment pages.** Users can move between Dashboard, Installment Plans, Sale Invoices, Customer Installments, Reports, All Installments, and Settings without losing the module menu.
- **Installment table action buttons now show correctly.** Edit, Delete, View, Collection, Print, and other action buttons now appear as normal buttons instead of showing unreadable text.
- **Missing action headings have been added.** Action columns on Installment Plans, Customer Installments, Installment Customers, and related pages are now easier to understand.
- **Sale Invoice payment status now shows correct wording.** Missing or unclear payment status text has been cleaned up.
- **Customer Installments now show all customers when no customer is selected.** Users can leave the customer filter empty to see all installment customer records.
- **Installment dates now show in a simple date format.** Start dates, due dates, and payment dates are easier to read.
- **Installment report rows now show status and action buttons correctly.** Paid, Due, Late, Print, Collection, and Delete Collection are shown clearly.
- **The Delete button is no longer shown for every installment row.** Users cannot accidentally delete an installment schedule row from the report table.
- **Buttons in the installment action column now have better spacing.** Print, Collection, and Delete Collection buttons are easier to click.
- **Sale invoices that already have an installment plan no longer show the Add Installment Plan option again.** This helps avoid duplicate plans for the same invoice.
- **Sale invoices with an attached installment plan are separated from normal due/credit sales.** This keeps the regular Sales list cleaner.
- **View Payment now handles installment plans correctly.** When an invoice has an installment plan, users can edit or delete the full plan from the payment window.
- **Edit Plan now opens the edit plan window directly.** Users no longer land on the report page when editing a plan from View Payment.
- **Add Payment is hidden when an invoice already has an installment plan.** Collection should be done from the installment collection screen instead.
- **Opening a payment receipt from View Payment now appears in front.** The receipt popup no longer opens behind the payment window.
- **Deleting an installment collection now updates both places.** If a collection is deleted from View Payment or from the Installment report, the paid status and Delete Collection button are updated correctly.
- **Installment collection amount is protected from manual editing.** The Total Paid field in the collection window is now read-only.
- **Account selection follows Business Settings.** If Payment Accounts are turned off, the Account dropdown is hidden in the installment collection window.
- **Payment Status on Installment Sale Invoices now shows the installment plan name.** Users can quickly see which plan is attached to the invoice.
- **The plan name in Payment Status no longer disturbs the page layout.** It is shown as information only, so the sidebar and page design stay normal.

#### What Is Easier Now
- **Installment Dashboard and module menu now follow the Project module style.** The menu is easier to scan and use across the Installment module.
- **Add and Edit Installment Plan windows are wider and easier to work with.** They now give more room for plan details.
- **Add Installment Plan window keeps its heading and buttons visible.** If the form has many fields, users can scroll the middle area while the title and Save/Close buttons stay easy to reach.
- **The Advance Payment option has been removed from Add Installment Plan.** Users only see the fields needed for creating the installment plan.
- **Installment Collection window is wider and easier to use.** Users have more space when collecting an installment payment.
- **Installment collection numbers now use a separate Installment Payment prefix.** New installment collections use the prefix saved in Installment Settings, with IP as the default.
- **Normal sale payment numbers stay separate from installment collection numbers.** Sale payments continue to use their normal sale payment prefix, while installment collections use the installment payment prefix.
- **Normal, partial, early settlement, and bulk installment collections all follow the same collection prefix setting.**
- **Older installment collection records keep their old numbers.** Only new collections use the latest prefix saved in Installment Settings.
- **Installment collection records remain visible in payment records.** Users can still review installment collection payments from the payment history.
- **Installment permissions are now more complete.** Business owners can control access to each important part of the Installment module.
- **Separate permissions are available for dashboard, reports, customer installments, installment customers, sale invoices, installment plans, printing, collections, partial payments, early settlement, and bulk payments.**
- **Installment menu items now appear based on staff permission.** Staff only see the Installment pages they are allowed to use.
- **Installment pages are better protected by role access.** If a staff member does not have permission for a page or action, they will not be able to open or use it.

#### Guide
- **To create an installment plan, go to Installment > Sale Invoices.**
- **Find the due or partial sale invoice and click Action > Sell Installment.**
- **Select the installment plan, check the amount and dates, then save.**
- **After a plan is added, the same invoice will show the plan name in the Payment Status column.**
- **Use Action > Plan to open the installment schedule for that invoice.**
- **To collect an installment, open Installment > All Installments or Installment > Installment Reports and click Collection.**
- **Check the due date, fine amount if any, and payment method, then click Add.**
- **To change the installment collection prefix, go to Installment > Settings and update Prefix for Collection.**
- **Use IP for installment payments if you want installment collection numbers to be separate from normal sale payments.**
- **To edit or delete a full installment plan, open View Payment for the invoice and use Edit Plan or Delete Plan.**
- **To control staff access, go to Settings > Security Roles, open the Installment tab, tick the allowed features, and save the role.**

---

## Version 8.89.6

**Release Date:** 2026-06-17

### Module: Products - Combo Products

#### What Users Can Do Now
- **Copy ingredients from another combo product while creating a combo.** On the Add Product page, choose Combo as the Product Type and select an existing combo from Copy ingredients from combo.
- **Copied combo ingredients are filled into the ingredient table automatically.** Product names, quantities, units, purchase prices, total amounts, and selling price totals are loaded for review.

#### What Is Easier Now
- **The combo ingredient area is easier to use.** Search Product is shown on the left and Copy ingredients from combo is shown on the right, so users can either add ingredients one by one or load an existing combo recipe.

#### Guide
- **Go to Products > Add Product.**
- **Select Combo in Product Type.**
- **Use Search Product to add ingredients manually, or select a product from Copy ingredients from combo to load an existing combo's ingredients.**
- **Review the loaded ingredients, quantities, prices, and total amount.**
- **Save the combo product when everything is correct.**

---

## Version 8.89.5

**Release Date:** 2026-06-16

### Module: Manufacturing - Productions and Stock Transfers Product Summary

#### What Users Can Do Now
- **New product summary report added in Manufacturing Reports.** Users can now compare produced products and stock transferred products in one report.
- **The report shows product-wise produced quantity, transferred quantity, and difference.** This helps users quickly check how much was produced and how much was moved to other locations.
- **Value comparison is also shown.** Users can compare production value, transfer value, and the remaining difference.
- **Useful filters are available.** Users can filter by date range, location from, location to, stock transfer status, production final/draft status, and product category.

#### What Is Easier Now
- **Manufacturing is now easier to open from the left sidebar.** The Manufacturing menu now opens like the Accounting menu and shows its main pages inside the sidebar.
- **The new report is available from Manufacturing > Reports.** Users can open it from the top Manufacturing Reports dropdown and from the left Manufacturing sidebar menu.
- **A separate role permission is available for the new report.** Business owners can allow selected staff to view only this report without giving access to all Manufacturing reports.
- **The Productions Report permission is also available in role settings.** This makes Manufacturing report access clearer when creating or editing user roles.

#### Guide
- **Go to Settings > Security Roles.**
- **Create a new role or edit an existing role.**
- **Open the Manufacturing tab.**
- **In the Reports section, tick View Productions & Stock Transfers Product Summary.**
- **Save the role and assign it to the required staff.**
- **Go to Manufacturing > Reports > Productions & Stock Transfers Product Summary.**
- **Select the required filters and review the product comparison.**

---

## Version 8.89.4

**Release Date:** 2026-06-16

### Module: Security Roles - Transaction Backup Access

#### What Is Easier Now
- **Transaction Backup now has its own role permission.** Business owners can allow selected staff to open the Transaction Backup page without giving them full admin access.
- **The permission is available in the Settings tab when creating or editing a role.** This makes it easier to control who can manage transaction backup settings.
- **Users who have this permission will see the Transaction Backup option in the menu.** Users without permission will not see or open this page.

#### Guide
- **Go to Settings > Security Roles.**
- **Create a new role or edit an existing role.**
- **Open the Settings tab.**
- **Tick Access transaction backup.**
- **Save the role.**
- **Assign this role to the staff members who need Transaction Backup access.**

---

## Version 8.89.1

**Release Date:** 2026-06-14

### Module: Business Settings - Location Based Sales Settings

#### What Works Correctly Now
- **Allow Sale if No Stock now works separately for each business location.** Each branch can now have its own setting for allowing sales when stock is not available.
- **Changing this option for one branch no longer affects other branches.** For example, Branch A can allow sale without stock while Branch B can still block sale without stock.
- **The selected branch now shows the correct saved setting.** When users switch location in Business Settings, the Sales tab shows the option saved for that location.

#### Guide
- **Go to Business Settings.**
- **In Location Based Settings, select the business location.**
- **Open the Sales tab.**
- **Tick Allow Sale if No Stock if that branch should allow sale without stock.**
- **Untick it if that branch should stop sale when stock is not available.**
- **Click Update Settings.**

---

### Module: Superadmin - Business List

#### What Is Easier Now
- **Quick login button added for each business.** Superadmin users can now log in to a business directly from the Business list.
- **The button uses the first admin user of that business.** This makes it faster to open a business account for checking settings, support, or daily work.
- **The button is shown only when an admin login is available.** If the business does not have an active admin user who can log in, the quick login button will not appear.

#### Guide
- **Go to Superadmin > Business.**
- **Find the business you want to open.**
- **In the Action column, click Login as username.**
- **The system opens that business using its admin account.**

---

### Module: Login

#### What Is Easier Now
- **Continue as option added on the Login page.** If a user is already signed in and opens the Login page again, the system now shows a Continue as option with the current user's name/email.
- **Users can quickly return to their account.** Click Continue as to go back into the system without entering the username and password again.
- **Users can still switch accounts.** If someone wants to use a different account, they can sign out from the current account and log in with another username and password.

#### Guide
- **Open the Login page while already signed in.**
- **Click Continue as to enter the system with the current account.**
- **Click the close/sign-out option beside the account if you want to use another account.**

---

### Module: POS / Sales - Product Search

#### What Works Correctly Now
- **"Not for selling" products are now hidden from the F10 Product Search popup on sale screens.** When cashiers open product search from POS, Add Sale, or Edit Sale, products marked as Not for selling will no longer appear in the list.
- **Cashiers now see only products that can be sold.** This helps avoid selecting internal-use, purchase-only, or blocked sale products by mistake.

#### Guide
- **Open POS, Add Sale, or Edit Sale.**
- **Press F10 to open Product Search.**
- **Search or select products as usual.**
- **Products marked as Not for selling will not appear in this sale search list.**

---

### Module: POS - Cash Skim

#### What Works Correctly Now
- **Cash Skim warning now waits for the selected warning interval after Cancel.** If Cash Skim Warning Interval is set to 30 minutes, the warning will come back after 30 minutes instead of showing again after a few minutes.
- **The warning still comes back if the register cash is over the limit.** This helps cashiers delay the reminder for the correct time without missing the cash skim warning completely.

#### Guide
- **Go to Business Settings > Payment.**
- **Set Cash Skim Warning Interval to the number of minutes you want.**
- **On the POS screen, when the Cash Skim warning appears, click Cancel if you want to delay it.**
- **The warning will show again after the selected time if the register cash is still over the limit.**

---

### Module: POS - Close Register

#### What Works Correctly Now
- **Close Register now opens correctly after manager approval.** When a cashier clicks Close Register from the POS side menu and enters the required username and password, the Close Register screen now opens normally.
- **The POS screen no longer stays dim after approval.** Cashiers can continue the close register process without needing to refresh the page.

#### Guide
- **Open the POS screen.**
- **Open the POS Menu from the right side.**
- **Click Close Register.**
- **Enter the required username and password for approval.**
- **After approval, complete the Close Register form as usual.**

---

### Module: Superadmin - Registration Settings

#### What Users Can Do Now
- **New "Is email required" option added in Superadmin settings.** This option is available under Superadmin > Settings > Application Settings.
- **Email is optional by default.** If "Is email required" is not ticked, the registration form works as before and users can register without email verification.
- **Email verification starts only when "Is email required" is ticked.** When this option is enabled, new users must enter an email address during registration.
- **New users must verify their email before logging in.** After registration, the user sees a Check Your Email page and receives a verification email.
- **Resend verification email option added.** If the email is not received, the user can request the verification email again from the Check Your Email page.
- **Email verified confirmation page added.** After clicking the verification link, the user sees a success message and can go to the Login page.
- **This feature is for Superadmin setups only.** If the Superadmin module is not installed, registration continues as normal.

#### Guide
- **Go to Superadmin > Settings > Application Settings.**
- **Tick Is email required if you want new registrations to verify their email.**
- **Save the settings.**
- **When a new user registers, they must enter an email address.**
- **After registration, ask the user to open their email and click the verification link.**
- **Once the email is verified, the user can go to Login and sign in normally.**
- **Leave Is email required unticked if you do not want email verification during registration.**

---

## Version 8.89.0

**Release Date:** 2026-06-11

### Module: Fuel Station Management

#### What Users Can Do Now
- **New Fuel Station Management module.** Petrol and diesel station teams can manage daily fuel station work inside the system.
- **Fuel Tanks.** Register underground or above-ground tanks with capacity, opening stock, minimum-stock alerts, graph colour and a linked inventory product, with live current-stock tracking and fill-percentage display.
- **Dispensers and Nozzles.** Maintain fuel dispensers (pumps) and their nozzles; each nozzle links to a tank and inherits its product, with meter (reading) tracking.
- **Shift Management.** Open a shift with opening meter readings, then close it by entering closing readings, test quantities, and collected cash, card, bank, or credit amounts. The system shows litres sold, total sales, expected cash, and any cash short or extra amount.
- **Credit / Fleet Sales capture.** Credit amounts collected during a shift are recorded for credit-customer reporting.
- **Tank Stock Calculation.** Current stock is recalculated automatically from opening stock, refills, transfers, sales and approved adjustments.
- **Tank Refills, Adjustments and Transfers.** Record supplier refills (with weighted-average purchase price), tank-to-tank transfers, and stock adjustments (leakage, loss, gain, testing, evaporation, calibration) with an approval workflow.
- **Dispenser setup options are available.** Users can record dispenser connection details and test readings where supported.
- **Dashboard.** View today's sales, litres sold, active shifts, pending approvals, tank stock, low-stock alerts, cash short or extra amounts, sales charts, product charts, and dispenser sales.
- **Reports.** Eleven reports: Daily Sales, Shift Closing, Nozzle Reading, Tank Stock, Tank Refill, Tank Adjustment, Dispenser Sales, Staff Sales, Credit Customer, Cash Short/Excess and Integration Log - each filterable by location and date range and print-friendly.

#### What Is Easier Now
- **Role access is more detailed.** Admins can decide which staff can view the dashboard, manage tanks, manage dispensers, open or close shifts, approve shifts, manage refills, manage tank changes, manage tank transfers, and view reports.
- **Fuel station work uses existing business records.** Products, locations, suppliers, users, roles, and reports can be used without entering the same information again.

#### What Looks Different
- **Fuel Station has its own menu and page tabs.** Staff see only the options allowed for their role.
- **Charts continue working in offline setups.** Users can still view the important dashboard and report charts when the local setup is being used.

---

## Version 8.88.12

**Release Date:** 2026-06-12

### Module: Stock Adjustments - Stock Take Import

#### What Works Correctly Now
- **Imported counted quantities now appear correctly in Stock Take.** When users import an Excel file with SKU in the first column and Counted quantity in the second column, the Counted column on the stock adjustment screen now fills automatically.
- **Zero counted quantity can now be imported.** If the counted quantity is 0, it will still be accepted and shown correctly.
- **The adjustment quantity now updates from the imported count.** The system uses the imported Counted quantity and the current On Hand quantity to show the correct adjustment quantity.

#### Guide
- **Go to Stock Adjustments > Add.**
- **Select Stock Take as the adjustment type.**
- **Click Import Product.**
- **Upload the Excel file with SKU in column 1 and Counted quantity in column 2.**
- **After import, check that the Counted column is filled with the quantity from the Excel file.**

---

## Version 8.88.11

**Release Date:** 2026-06-12

### Module: Manufacturing - Add Production

#### What Is Easier Now
- **Current stock is now shown after selecting a product for production.** When adding a production entry, users can see the selected product's available stock quantity directly under the Product field.
- **The stock quantity changes with the selected product and business location.** This helps users check the available quantity before continuing with production.

#### Guide
- **Go to Manufacturing > Production > Add.**
- **Select the Business Location.**
- **Select the Product.**
- **Check the Current stock Quantity shown under the Product field.**

---

## Version 8.88.10

**Release Date:** 2026-06-11

### Module: Manufacturing - Productions Report

#### What Works Correctly Now
- **Raw Materials Used now shows each material only once when All locations is selected.** The same raw material will no longer appear as duplicate rows just because productions came from different business locations.
- **Raw Materials Used totals now match the visible list.** The ingredient count, quantity, waste, and cost totals are easier to check from the table.

#### Guide
- **Go to Manufacturing > Productions Report.**
- **Select All locations in the Business Location filter.**
- **Open the Raw Materials Used tab.**
- **Generate the report to review each raw material once with the correct totals.**

---

## Version 8.88.9

**Release Date:** 2026-06-10

### Module: Manufacturing - Productions Report

#### What Is Easier Now
- **Production Detail tab now opens normally.** The tab no longer stays stuck on "Processing" when viewing production details.
- **Product search in Production Detail now works properly.** Users can search by product name and see the matching production records.

#### Guide
- **Go to Manufacturing > Productions Report.**
- **Open the Production Detail tab.**
- **Use the filters or search box to find the required production records.**

---

### Module: Reports - Stock Transfer Report

#### What Users Can Do Now
- **Print button added to the Detailed tab.** Users can now print the full detailed stock transfer report directly from the Detailed tab.
- **Export to Excel button added to the Detailed tab.** Users can now download the detailed stock transfer report as an Excel file.
- **Product item details are included in the export.** The Excel file includes the stock transfer details and the product lines under each transfer.

#### Guide
- **Go to Reports > Stock Transfer Report.**
- **Open the Detailed tab.**
- **Apply the required filters, such as date range, location from, location to, or status.**
- **Click Print to print the detailed report.**
- **Click Export to Excel to download the detailed report.**

---

## Version 8.88.8

**Release Date:** 2026-06-05

### Module: Purchases - Classic Print Layout

#### What Works Correctly Now
- **Classic purchase invoice printing no longer produces a blank extra page.** The Classic, Classic 2, and Classic 6 purchase layouts previously forced the printable area to a full page height, which pushed a small overflow onto a second blank sheet. Printed output now flows to the natural content height and ends on the last used page.

#### Guide
- **Open Purchases List, print any purchase using the Classic (or Classic 2 / Classic 6) layout.** Confirm the print preview now shows a single page when the content fits.

---

### Module: Contacts - Ledger Discount 2

#### What Works Correctly Now
- **Ledger Discount 2 adjustment can now be saved when serial numbers are not enabled.** The system no longer asks for serial numbers on products that do not need them.
- **The serial number option is now hidden in Ledger Discount 2 adjustment when serial numbers are turned off.**
- **Edited Ledger Discount 2 amounts now update Accounting reports correctly.** When quantity or adjustment amount is changed, Trial Balance now shows the updated discount amount.

#### Guide
- **Add the product, enter quantity and adjustment amount, then save as usual.** Serial numbers are only needed when serial numbers are enabled and required.

---

### Module: Contact Payments

#### What Is Easier Now
- **Ledger Discount 3 now works in Contact Payment the same way as the existing ledger discount.** When paying supplier or customer dues, Ledger Discount 3 is now included in the payable amount, invoice adjustment list, auto apply, and saved payment details.
- **Ledger Discount 3 rows are easier to identify in payment adjustment lists.** They now show as LD3 in the payment table.
- **Supplier payments now show the correct net effect in Accounting reports when Ledger Discount 2 or Ledger Discount 3 is included.** For example, if a purchase is 1,000 and discounts reduce the payable amount to 993, Accounting now reduces the supplier payable and cash by 993 only.
- **Ledger Discount 2 and Ledger Discount 3 payments now follow the same Trial Balance effect as the existing Ledger Discount.**

#### Guide
- **After adding Ledger Discount 3, open Contact Payment again to see the updated due amount and adjustment row.**
- **Use Auto Apply as usual; Ledger Discount 3 is now included with the other due adjustments.**
- **After saving a supplier payment, open Accounting > Reports > Trial Balance to check the updated Cash in Hand and Trade Creditors balances.**

---

### Module: Accounting - Settings

#### What Is Easier Now
- **Map Transactions location tabs now stay selected correctly.** When users click another business location, the selected tab now remains highlighted and the matching settings are shown.
- **Default accounts now appear for every business location after creating a fresh Chart of Accounts.** Locations that were showing "Select Credit Account" or "Select Debit Account" now show the expected default accounts such as Sales, Trade Debters (A/R), Cash in Hand, Stock Inventory, and Cost of Goods Sold - COGS.

#### Guide
- **Go to Accounting > Settings > Map Transactions to review default accounts for each business location.**
- **Click each location tab and confirm the default accounts are selected before saving.**

---

### Module: Reports - Ledger Discount 3 Profit Accuracy

#### What Is Easier Now
- **Product Sale Report now shows profit using the updated product cost after Ledger Discount 3.** This applies across the Summary, Summary Combo, Detailed, Grouped, and all "By" tabs such as By Category, By Brand, By Location, and similar views.
- **Stock Performance Report now shows cost, stock value, profit, and average cost using the updated product cost after Ledger Discount 3.**
- **Profit & Loss Report now uses the updated product cost after Ledger Discount 3 when showing gross profit, net profit, and Profit By tabs.**
- **Profit figures are now more consistent between Sale Invoices Detail, Product Sale Report, Stock Performance Report, and Profit & Loss Report.**

#### Guide
- **After entering Ledger Discount 3 for a purchase, open these reports again to see the updated profit figures.**
- **Use these reports when checking product profit, stock profit, and overall business profit after supplier cost discounts.**

---

### Module: Contacts - Ledger Ageing

#### What Is Easier Now
- **Contact Ledger ageing now shows the correct due amount after Ledger Discount 3.** The ageing boxes at the bottom now match the ledger balance when a supplier discount is entered.

#### Guide
- **After adding Ledger Discount 3, reopen the contact ledger to check the updated ageing amount.**

---

### Module: Accounting Reports - Ledger Discount 3

#### What Is Easier Now
- **Accounting Trial Balance now includes Ledger Discount 3.** Supplier discounts now appear in accounting balances after the discount is entered.
- **Accounting Balance Sheet now reflects Ledger Discount 3.** Supplier balances and retained profit now stay aligned with the discount.
- **Accounting Profit and Loss now reflects Ledger Discount 3.** Product cost and profit now use the updated cost after the supplier discount.

#### Guide
- **After entering Ledger Discount 3, open Accounting Reports again to see the updated Trial Balance, Balance Sheet, and Profit and Loss.**
- **If an older sale still shows old profit, refresh its accounting mapping and open the report again.**

---

### Module: Home Dashboard

#### What Users Can Do Now
- **Stock Transfer Between Locations chart added to the dashboard.** Users can now see stock movement from one business location to another directly on the Home Dashboard.
- **The stock transfer chart shows useful totals.** It shows how many transfers were made, how many items were moved, and the total stock value transferred between locations.
- **Recent Transactions now includes more activity.** Manufacturing productions and stock transfers now appear in Recent Transactions along with sales and purchases.
- **Dashboard summary cards are now clickable.** Users can click the main dashboard cards to open the matching list or report.

#### Guide
- **Click Total Sales to open the Sales list.**
- **Click Invoice Due to open the Sales list with due invoices.**
- **Click Total Sale Return to open the Sale Return list.**
- **Click Total Purchase to open the Purchase list.**
- **Click Purchase Due to open the Purchase list with due purchases.**
- **Click Total Purchase Return to open the Purchase Return list.**
- **Click Expense to open the Expense list.**
- **Click Suppliers Due to open supplier dues.**
- **Click Customer Due to open customer dues.**
- **Click Barterer Due to open barterer dues.**
- **Click Net to open the Profit / Loss report.**
- **When a dashboard date range or business location is selected, the opened list follows the same selection where available.**

#### What Is Easier Now
- **Stock transfer data is now easier to find on the dashboard.** Recent transfers can still be reviewed even when the dashboard first opens on today's date.

---

### Module: Sales Menu

#### What Is Easier Now
- **Drafts List is now available under the Sales menu when POS is turned off.** If POS is disabled from **Settings > Business Settings > Global Settings > Modules**, users can still open their saved draft sales from the Sales menu.
- **Drafts List still follows user permission.** Only users who are allowed to view drafts will see this option.
- **When POS is turned on, Drafts List stays in the POS menu as before.**

#### Guide
- **To view saved drafts when POS is turned off, go to Sales > Drafts List.**

---

### Module: Products - Product Images

#### What Users Can Do Now
- **Multiple images can now be added to a Single product.** On the Add Product and Edit Product pages, users can upload more than one gallery image for the same product.
- **One image can be selected as the main product image.** Users can keep a main featured image for the product and also keep extra gallery images.
- **Gallery images are shown on the Product View popup.** The main image is shown first, and the extra product images are shown below it as small previews.
- **Existing gallery images can be made the main image.** On the Edit Product page, click **Make featured** on a gallery image to use it as the product's main image.
- **Newly selected gallery images can also be chosen as the main image before saving.** When choosing multiple new images, select the image marked as **Featured** to make it the main product image.
- **Gallery images can be removed one by one.** Users can delete only the image they no longer need without removing the other product images.

#### What Is Easier Now
- **The Product Edit page now clearly shows the current main product image.** This makes it easier to compare the main image with the gallery images.
- **Gallery image buttons are now neatly aligned.** The delete button and **Make featured** button stay inside each image box.
- **WooCommerce product image sync now includes product gallery images.** When product image sync is enabled, the main product image and the extra gallery images are sent to WooCommerce.
- **Existing product images remain safe.** The old main product image feature continues to work as before.

---

## Version 8.88.7

**Release Date:** 2026-06-02

### Module: Expense - Payment Section Visibility By Location

#### What Looks Different
- **The "Add Payment" section on the Add Expense page now shows or hides based on the selected Business Location's payment options.** When every payment method is disabled for a location (Business Location > Edit > Payment Options > Enable column all unticked), the payment section is hidden. If at least one payment method is enabled, the section is shown.
- **The payment section updates instantly when the Business Location is changed on the Add Expense page**, without reloading, reflecting the newly selected location's payment settings.

#### What Works Correctly Now
- **The payment section appears correctly on the Add Expense page.** If the selected business location has at least one payment method enabled, the payment section is shown. If all payment methods are disabled, it stays hidden.

---

### Module: Business Settings - Disable Ledger Discount Setting

#### What Works Correctly Now
- **"Disable Ledger Discount" now saves correctly when unticked.** If a user turns it off from Location Based Settings > Merchants and saves, it stays off the next time the page is opened.

#### Guide
- **Go to Settings > Business Settings > Location Based Settings > Merchants.**
- **Untick Disable Ledger Discount.**
- **Click Save and reopen the page to confirm the setting stayed off.**

---

## Version 8.88.6

**Release Date:** 2026-06-02

### Module: Reports - Stock Transfer Report

#### What Works Correctly Now
- **Business Location filter now correctly filters data in the Summary tab.** Previously, selecting a Business Location in the report filters had no effect on the Summary tab - it always showed transfers from all locations. It now shows only the transfers that match the selected location.

#### What Is Easier Now
- **Business Location filter now has an "All Locations" option.** Previously, a location was required. You can now leave the location blank to view transfers across all business locations.
- **Two separate location filters are now available: "Location From" and "Location To".** You can filter stock transfers by where the stock was sent from, where it was sent to, or both at the same time. These filters apply across all three tabs - Totals, Summary, and Detailed.

---

## Version 8.88.5

**Release Date:** 2026-05-26

### Module: Purchase - Create Purchase

#### What Works Correctly Now
- **The Purchase Date calendar no longer closes on its own.** Previously, when you clicked to open the date/time picker on the Create Purchase page, it would close automatically after a couple of seconds. It now stays open until you manually close it or pick a date.

---

### Module: POS - Sale Screen

#### What Users Can Do Now
- **New "Show Total Profit" option added in User Settings.** Go to **User Settings > POS tab** and tick **Show Total Profit** to enable this feature. It is turned off by default.
- **Total Profit now shows live on the POS screen.** When the option is turned on, the right-side POS menu displays a **Total Profit** value below the user name. This value updates automatically as products are added, quantities are changed, or prices are adjusted.

---

## Version 8.88.107

**Release Date:** 2026-06-01

### Module: Business Settings - Dashboard

#### What Users Can Do Now
- **Dashboard sections can now be hidden from Business Settings.** Go to **Settings > Business Settings > Global Settings > Dashboard** and tick the dashboard items you want to hide.
- **All dashboard hide options are off by default.** If no boxes are ticked, the dashboard will continue to show normally.
- **Each dashboard option has its own clear label.** Users can choose exactly what to hide, such as Quick Actions, Today at a Glance, Business Analytics, Sales Overview, Sales Charts, Reports, Payment Dues, Orders & Shipments, Stock Alerts, Currency Rate, and module widgets.
- **Unticking an option shows that dashboard item again.** This makes it easy to hide or restore dashboard sections whenever needed.

---

### Module: Products - Product Images

#### What Users Can Do Now
- **Product images can now be assigned automatically by SKU.** Save the image with the same name as the product SKU and the system will connect it to that product.
- **Use .jpeg images for this feature.** For example, if the product SKU is 0052, save the image as 0052.jpeg.
- **Place the image in the product image folder for that business.** Once the matching product is added or updated, the image will appear on the product automatically.
- **Existing product images are kept safe.** If a product already has its own image, it will not be replaced by mistake.

---

## Version 8.88.106

**Release Date:** 2026-06-01

### Module: Sale Return

#### What Is Easier Now
- **Sale Return now requires at least one returned item quantity.** If all return quantities are zero, the return will not be saved and the user will be asked to add a return quantity.
- **Sale Return activity history now shows payment actions more clearly.** When a payment is added while saving a sale return, the activity will show "Payment Added" instead of "Payment Edited".

### Module: POS - Sale Screen

#### What Is Easier Now
- **POS actions are now available from a right-side menu.** The menu stays closed by default and can be opened from the MENU tab on the right side of the screen.
- **The right-side menu can also be opened by swiping left.** This makes it easier to use on touch screens.
- **The old POS top menu has been removed.** Its actions now appear inside the right-side menu with icons and clear labels.
- **The POS menu is shown in a simple vertical list.** Common actions are easier to find, including Go Back, Open Cash Drawer, Sale Return, Add Expense, Open Cash Skim, Register Details, Close Register, Payment Receiving, Payment to Supplier, Add Production, Calculator, and Full Screen.
- **Business location selection is cleaner.** The location icon now appears beside the location dropdown, without an extra heading above it.
- **User name and date/time now appear in one row.** This keeps the menu header compact and easier to read.
- **Quick Menu buttons inside the right-side menu now wrap to the next line.** They no longer create horizontal scrolling when there are many buttons.
- **The right-side menu is now slimmer.** It takes less space on the POS screen.
- **Quick Menu selection and Edit Menu option now stay in one row where possible.** This keeps the menu controls easier to use.
- **Keyboard Shortcut has been removed from the POS side menu.** The menu now only shows the needed POS actions.
- **Add Production now shows with its label in the POS side menu.** Users can identify the action clearly.
- **Quick Menu edit mode is clearer.** Edit and delete icons now appear inside each assigned product button, so users can update or remove the correct button.

---

## Version 8.88.105

**Release Date:** 2026-05-31

### Module: Dashboard - Total Sales Overview

#### What Users Can Do Now
- **New due cards added to the Total Sales Overview.** Users can now see Suppliers Due, Customer Due, and Barterer Due directly on the dashboard.
- **Due amounts include the complete contact balance.** The shown amount includes all-time sales, purchases, returns, payments, ledger discounts, advance deposits, and opening balance.

#### What Is Easier Now
- **Helpful tooltips added to the new due cards.** Users can hover over the info icon to understand what is included in each due amount.
- **Dashboard location filter also works with these due cards.** When a location is selected, the due cards show values for that location.

---

### Module: Reports - Stock Value Report

#### What Works Correctly Now
- **Stock Value Report now opens without staying stuck on Processing.** The report loads faster and shows the stock value list properly.
- **A clear message is shown if the report cannot load.** Users will no longer be left waiting without knowing what happened.

#### What Is Easier Now
- **Report filters now work more completely.** Users can filter the Stock Value Report by location, supplier, category, brand, gender, procurement source, unit, stock quantity options, and price type.
- **The report works better from the normal browser link.** Users can open the Stock Value Report as usual and the list will still load.

#### What Users Can Do Now
- **New Locations tab added to the Stock Value Report.** Users can review stock value grouped by business location, including opening stock, purchases, returns, manufacturing, transfers, adjustments, sales, current stock, and totals.
- **Grand totals are shown in the Locations tab.** This helps users compare all locations in one place.

---

### Module: Reports - Stock Quantity Report

#### What Users Can Do Now
- **New Locations tab added to the Stock Quantity Report.** Users can review stock quantities grouped by business location.
- **Each location shows product count, variation count, and quantity totals.** Quantities are shown with their units so mixed stock units remain easy to read.
- **Stock values are shown where allowed.** Users with permission can also see purchase value, sale value, and possible profit by location.

---

### Module: Contacts - Add Contact

#### What Works Correctly Now
- **Shipping Address map search now works when adding a contact.** Users can type an address, choose a suggestion, press Enter, or move out of the address box, and the map will move to the selected location.
- **Address suggestions now show properly inside the Add Contact popup.** This makes it easier to choose the correct address without closing the popup.

#### What Is Easier Now
- **The contact map saves the selected position more reliably.** This helps keep the contact's shipping location accurate.

---

### Module: POS - Sale Screen

#### What Is Easier Now
- **Staff/Agent selection is clearer on the sale screen.** The dropdown now shows "Select Staff/Agent" so users know what to choose.

---

## Version 8.88.103

**Release Date:** 2026-05-27

### Module: Offline Sync - Branch Settings

#### What Works Correctly Now
- **Offline Sync now follows the correct branch settings.** When a workstation is linked with a branch, sync options now match that branch instead of the general business settings.

#### Guide
- **Go to Offline Sync.**
- **Run the required sync, or use Sync All.**
- **After syncing, check that the workstation follows the correct branch rules.**

---

## Version 8.88.102 to 8.88.78

**Release Date:** 2026-05-26

### Module: Branch-wise Settings Across Daily Work Screens

#### What Works Correctly Now
- **Branch settings now appear correctly across daily screens.** Users working in one branch will see that branch's rules, labels, receipt settings, payment options, product options, and stock rules.
- **Restaurant, kitchen, and table screens now follow the selected branch.** Kitchen order details, preparation warnings, and table choices now match the branch being used.
- **Reports now follow the selected branch more reliably.** Activity Log, Opening Stock, Product Purchase, Stock Transfer, Stock Consumption, Product Sell, Product Serial, Product Status, Lot, Sale Invoices, Profit/Loss, and commission reports now show branch-based options correctly.
- **POS, Sales, Direct Sales, Sell Returns, and Sale Details now use the correct branch settings.** Warranty, customer notes, quotations, sales orders, tax rows, discount rows, lot numbers, expiry, and receipt options now match the sale location.
- **Purchases, Purchase Returns, Purchase Orders, and purchase print views now use the correct branch settings.** Supplier search, product search, purchase status, tax columns, lot numbers, expiry, and purchase receipt labels now match the purchase location.
- **Stock Transfers and Stock Adjustments now use the correct branch settings.** Stock issue/receive labels, stock category options, lot numbers, expiry, overselling rules, and product row options now follow the selected location.
- **Products screens now use the correct branch settings.** Product list, add/edit product, quick edit, product view, product search, serial number details, product variations, and product stock history now show the right branch-based fields and labels.
- **Contacts and ledgers now use the correct branch settings.** Contact list, add/edit contact, contact profile, contact ledger, ledger PDF, due amount, ageing footer text, ledger discount, and contact payment screens now follow the branch being viewed or used.
- **Payment screens now follow the correct branch.** Cash denomination, cheque posting, payment headers, payment footers, contact deposits, supplier due payments, and payment print views now match the payment location.
- **Receipts and printed documents now follow the transaction branch.** Sale receipts, purchase receipts, expense vouchers, contact ledgers, and POS sale details now use the correct branch text, labels, and language settings.
- **Cash Register screens now follow branch settings.** Opening register, register details, and close register screens now show the correct cash and payment options for the branch.
- **Other modules now follow branch settings where needed.** CRM customer orders, customer display, warranty dropdowns, hotel bookings, payroll payment rows, repair screens, accounting ledger, Truckmate invoices, warehouse transfers, manufacturing production, gym subscriptions, and restaurant screens now use the correct branch choices.

#### Guide
- **Set branch-specific options from Settings > Business Settings > Location-based Settings.**
- **Choose the correct Business Location before saving branch settings.**
- **When opening sales, purchases, payments, reports, receipts, or stock screens, select the correct location if the page has a location filter.**
- **If a staff member works from a branch, make sure their default location and register location are correct.**
- **Use the page normally. The system will now show the correct branch settings automatically.**

---

## Version 8.88.77 to 8.88.13

**Release Date:** 2026-05-26

### Module: Branch-wise Settings In Sales, Purchases, POS, Payments, Reports, and Stock

#### What Is Easier Now
- **Branch-specific settings have been applied to more everyday workflows.** This includes direct sales, sell returns, purchase entry, stock transfers, stock adjustments, product rows, lot and expiry controls, reward points, commission settings, receipts, payment rows, customer search, and stock mapping.
- **POS receipts and customer-facing displays now use the correct branch details.** Receipt text, language/font choices, FBR-related receipt information, and customer display settings now better match the active sales location.
- **Sales and purchase forms now show branch-based fields more accurately.** Tax, discount, warranty, lot number, expiry, commission, product expiry, and edit-window rules now follow the transaction location.
- **Payments and cash handling now match branch rules.** Payment rows, cash denomination, contact due payments, supplier due payments, and close register details now follow the branch setup.
- **Reports and ledgers now respect branch choices.** Contact ledgers, ledger PDFs, cheque posting, contact due calculations, product stock history, and purchase/sale reports now use the right branch settings.
- **Stock and inventory actions are safer across branches.** Stock transfers, stock adjustments, warehouse transfers, purchase returns, stock issue/receive, lot numbers, expiry, and product row options now follow the selected location.

#### Guide
- **Use the Business Location filter when the screen provides one.**
- **For sales, purchases, returns, payments, and stock work, confirm the location before saving.**
- **For printed receipts or ledgers, re-open the document after selecting the right location if needed.**
- **Review Settings > Business Settings > Location-based Settings if any branch option looks different than expected.**

---

## Version 8.88.12

**Release Date:** 2026-05-26

### Module: Business Settings - Display Screen Images By Location

#### What Is Easier Now
- **Each branch can now keep its own customer display images.** This helps different shops show different screen images for customers.
- **Saved image names are shown clearly.** Users can check which image is already saved for each image slot.

#### Guide
- **Go to Settings > Business Settings.**
- **Choose the required Business Location.**
- **Open Display Screen settings.**
- **Upload or update the carousel images for that branch.**
- **Save the settings.**

---

## Version 8.88.11

**Release Date:** 2026-05-26

### Module: Business Settings - Date Range Settings

#### What Is Easier Now
- **Date Range settings are now placed with branch-based settings.** This makes it clearer that each branch can have its own date range preference.

#### Guide
- **Go to Settings > Business Settings.**
- **Choose the required Business Location.**
- **Open Date Range settings and save the required option.**

---

## Version 8.88.10

**Release Date:** 2026-05-26

### Module: Business Settings - Display Screen and Payment By Location

#### What Is Easier Now
- **Display Screen settings can now be saved per branch.** Each location can keep its own customer display options.
- **Payment settings can now be saved per branch.** Each location can keep its own payment-related text and options.

#### Guide
- **Go to Settings > Business Settings.**
- **Choose the required Business Location.**
- **Open Display Screen or Payment settings.**
- **Enter the settings needed for that branch and save.**

---

## Version 8.88.9

**Release Date:** 2026-05-26

### Module: Business Settings - Display Screen and Payment Tabs

#### What Looks Different
- **Display Screen and Payment are now shown under Location-based Settings.** These settings are related to each shop or branch, so they are easier to find with the other branch settings.
- **The Location-based Settings tabs are now arranged in a clearer order:** Tax, Product, Contact, Sale, POS, Display Screen, Payment, Purchase, and Reward Point.

#### Guide
- **Go to Settings > Business Settings.**
- **Use the Location-based Settings section for branch-level setup.**
- **Use Global Settings only for options shared by the whole business.**

---

## Version 8.88.8

**Release Date:** 2026-05-26

### Module: Business Settings - Global and Location-based Sections

#### What Looks Different
- **Business Settings is now split into two clear sections.** Global Settings are for the whole business. Location-based Settings are for individual branches.
- **The Business Location dropdown is now inside the Location-based Settings section.** This makes it clearer which settings change by branch.
- **Tabs are grouped by purpose.** This makes the settings page easier to understand and reduces accidental changes to the wrong branch.

#### Guide
- **Go to Settings > Business Settings.**
- **Use Global Settings for business-wide options.**
- **Use Location-based Settings when a branch needs its own setup.**
- **Choose the branch before editing location-based settings.**

---

## Version 8.88.7

**Release Date:** 2026-05-26

### Module: Business Settings - More Branch-based Options

#### What Users Can Do Now
- **POS, Sale, Purchase, and Product settings can now be saved separately for each branch.** This gives each location more control over its own daily workflow.
- **Branch options now include many common sale, purchase, product, and POS choices.** Examples include customer display, KOT printing, default customers, quotations, sales orders, payment links, default purchase status, product fields, serial/IMEI fields, tax options, discount options, and stock-related choices.

#### Guide
- **Go to Settings > Business Settings.**
- **Choose the branch from Business Location.**
- **Open POS, Sale, Purchase, or Product settings.**
- **Update the branch settings and save.**
- **Repeat for other branches only when they need different rules.**

---

## Version 8.88.6

**Release Date:** 2026-05-26

### Module: Business Locations - Location ID Numbering

#### What Works Correctly Now
- **New branch IDs no longer restart from BL0001.** If your business already has BL0001, BL0002, and BL0003, the next branch will now correctly become BL0004.

#### Guide
- **Go to Settings > Business Locations.**
- **Add a new business location.**
- **Check that the Location ID continues from the highest existing branch ID.**

---

### Module: Business Settings - Location-based Settings

#### What Users Can Do Now
- **Business Settings can now be saved separately for each branch.** A Business Location dropdown lets users choose which branch they are setting up.
- **Settings can be copied from one branch to another.** This is useful when opening a new branch that should use the same setup as an existing branch.
- **Single-location businesses do not see unnecessary branch controls.** The page stays simple when there is only one location.

#### What Works Correctly Now
- **Business Settings opens more safely for admin users.** The page no longer shows an error in cases where no active business is selected.

#### Guide
- **Go to Settings > Business Settings.**
- **Choose the Business Location you want to update.**
- **Change the settings for that branch.**
- **Click Save.**
- **Use Copy settings from another location when one branch should copy another branch's setup.**

---

### Module: Sales - Add Sale Product Search

#### What Works Correctly Now
- **The F10 Product Search popup on Add Sale no longer gets stuck on Processing.** Products load normally so users can continue the sale.

#### Guide
- **Go to Sales > Add Sale.**
- **Press F10 or open Product Search.**
- **Search and select the product as normal.**

---

### Module: Stock Transfer - Load Ingredients From Production

#### What Users Can Do Now
- **Stock Transfer can now load ingredients from a Manufacturing Production.** Users can select a production and fill the transfer with the ingredients used in that production.
- **Load Ingredients from Demand Order is also available while editing a stock transfer.** Users can update an existing transfer more easily.

#### Guide
- **Go to Stock Transfers > Add or Edit Stock Transfer.**
- **Select Location From.**
- **Choose a Production from the Production (Manufacturing) dropdown.**
- **Click Load Ingredients.**
- **Review the loaded products and quantities before saving.**

---
## Version 8.89.3

**Release Date:** 2026-05-22

### Module: Reference Numbers - Existing Records

#### What Works Correctly Now
- **Contact, Warehouse, Username and Subscription package codes no longer reset to 1 after updating.** After updating, the next code continues from the previous number. For example, a business with 46 existing contacts will correctly start the next one at 47.
- Older number records are tidied up automatically during the update, so numbering stays clean.

#### What Is Easier Now
- **All existing sales, purchases, payments, returns, transfers and other transaction numbers are kept exactly as they are.** The new numbering only applies to new transactions created after the upgrade. Nothing in your historical records is rewritten or changed in any way.
- Old and new format transaction numbers will appear side-by-side in your ledger after the upgrade. This is normal - both formats are fully supported across receipts, reports and tax exports.

#### Important For Users
- **Your old records are not changed.** Sales, purchases, payments, ledgers, and account entries stay as they were.
- **Keep the Contact Payment prefix the same for all branches unless your process needs separate prefixes.** This keeps contact payment editing simple and consistent.

---

## Version 8.89.2

**Release Date:** 2026-05-22

### Module: Reference Numbers - Per-Location Transaction Numbering

#### What Users Can Do Now
- **Transaction numbers are now generated per business location.** New numbers include the prefix, location code, year, and running number. This works for purchases, returns, payments, stock transfers, stock adjustments, expenses, subscriptions, tokens, cash register entries, voucher prints, and more.
- **Numbering restarts on January 1st each year for every location.** Each branch gets its own fresh sequence at the start of the year.
- **Each location can have its own prefix.** If a location has its own prefix set on the Prefixes tab, that prefix is used; otherwise the business-wide prefix is used. This lets you keep one prefix scheme globally while overriding individual branches when needed.

#### What Is Easier Now
- **Contact codes, Warehouse codes, Usernames and Subscription package codes stay on the existing global format.** These are not branch-specific by design.
- **The system picks the right location automatically** based on the location you're working in. No screens or workflows need to change to benefit from the new numbering.

#### Important For Users
- **Already-issued transaction numbers are untouched.** Only new transactions use the new format.
- **Each branch starts its own new sequence for each transaction type.** Old and new number styles may appear together, and that is normal.

---

## Version 8.89.1

**Release Date:** 2026-05-22

### Module: Business Location Settings - Per-Location Prefixes

#### What Users Can Do Now
- **Reference number prefixes are now set per business location.** A new **Prefixes** tab has been added inside *Business Location Settings* (Settings > Business Locations > Settings on any location). Every prefix that used to live on the global *Business Settings > Prefixes* tab - Purchase, Purchase Order, Purchase Return, Sell Payment, Sell Return, Stock Transfer, Stock Adjustment, Expense, Contact, Token, Cash Register and all voucher labels - can now be set per location so each branch can have its own prefix scheme.

#### What Is Easier Now
- The global **Prefixes** tab has been removed from *Business Settings*.
- During the upgrade, each location is automatically filled with the prefixes you previously had at the business level, so no prefix is lost.

#### Important For Users
- **Prefixes can now be edited from each business location.** Use this page to prepare or adjust branch prefixes.
- **New transaction numbers fully follow branch-wise prefixes in the later numbering update.**

### Module: User Profile - Email Sending Settings

#### What Users Can Do Now
- **Email sending settings are now saved per user.** Each staff member can set their own outgoing email details from **My Profile > Email Settings**. A **Test email configuration** button lets you send a test message before saving.

#### What Is Easier Now
- The **Email Settings** tab has been removed from *Business Settings*.
- Outgoing notification emails now use the logged-in user's own email settings instead of a single shared business setting.

#### Important For Users
- **Each user should enter their own email settings from My Profile > Email Settings.**
- **For automatic emails, make sure the business owner account email settings are filled in correctly.**

---

## Version 8.89.0

**Release Date:** 2026-05-22

### Module: Sales - Layby (Lay-by-away)

#### What Users Can Do Now
- **Layby sale workflow added.** Cashiers can now mark a sale as a **Layby** at the point of sale. A new **Sub Status** dropdown appears on the Add Sale screen - choose **Layby** to reserve stock for a customer who pays in instalments. When Layby is chosen, a new **Layby Due Date** field appears (auto-filled with today + the default number of days set in Sales settings) so the agreed final-payment date is captured up front.
- **Stock is reserved while the customer pays.** Selecting Layby behaves like a normal final sale for stock: the goods are deducted from available stock immediately so they cannot be sold to anyone else while the layby is active.
- **Automatic stock release after the due date.** If the customer has not paid the balance in full by the **Layby Due Date**, the system automatically releases the reserved items back into stock so they are available for sale again. The invoice itself stays in the system marked as **Layby Released** - the outstanding balance remains so any further payments / refunds can still be processed manually, and the customer history is fully preserved.
- **Feature is opt-in per business.** Layby is disabled by default. Enable it from **Settings > Business Settings > Sales** with the new toggle **Enable Layby sales**, and configure **Default Layby Due Days** (default 30) on the same screen.

#### What Looks Different
- **Sub Status** dropdown shown next to **Sale Status** on the Add Sale screen, only when Layby is enabled in Sales settings and the form is not a draft / quotation. Selecting **Layby** reveals the **Layby Due Date** picker.

---

### Module: POS - Quick Menu Buttons & Product Suggestion

#### What Works Correctly Now
- **Quick menu product buttons now show the correct price for each business location.** If a business location has a **Default Selling Price Group** set (configured under *Business Locations > Edit > Default Selling Price Group*), the price shown on each product button in the quick menu panel now comes from that location's price group - not the product's default selling price. Previously, every location always showed the default selling price on the buttons, regardless of which price group was assigned to that location.
- **Product suggestion tiles also now show the correct location price.** The same fix applies to the **Show Product Suggestion** POS layout - product tiles in the suggestion panel now display the price from the current location's price group when one is set, falling back to the default price only when no price group is configured for the location.

---

### Module: User Management - Roles & Permissions

#### What Users Can Do Now
- **Control which business locations a staff member can see suppliers from.** On the Role create and edit pages, inside the **Contacts** tab under the Supplier section, two new radio button options are now available: **View all Locations supplier** - the user can see suppliers from every business location; and **View Locations own supplier** - the user can only see suppliers linked to their own location. Select whichever option fits the role.
- **Control which business locations a staff member can see customers from.** In the same **Contacts** tab under the Customer section, two matching options are now available: **View all Locations Customer** - the user can see customers from every location; and **View Locations own Customer** - the user can only see customers belonging to their own location. Use this to prevent staff from one branch viewing another branch's customer list.

---

### Module: Offline Sync - Download

#### What Is Easier Now
- **Selling price groups are now downloaded as part of the Products Sync.** When you press **Sync Products** on the **Synchronization > Download** tab, the system now also downloads all your **Selling Price Groups** (your named pricing tiers, e.g. "Wholesale", "VIP", "Retail") into the offline terminal. Previously, price group names could be missing after a fresh sync, which caused price-group dropdowns to appear empty on the POS.
- **Group / tier prices on each product are now included in offline product updates.** Every special price set per price group on a product (for example, a lower wholesale price or a VIP price) is downloaded with the product. After syncing, cashiers can choose any price group during a sale and the right price will appear without needing an internet connection.

---

## Version 8.88.0

**Release Date:** 2026-05-21

### Module: Reports - Product Sale Report & Combo Items Report

#### What Works Correctly Now
- **Product search now shows clean names in the filter bar.** On both the Product Sale Report and Combo Items Report filters, product suggestions are now readable and no longer include extra symbols mixed into the product name.

---

### Module: Products - Categories

#### What Users Can Do Now
- **"Not for selling" option added to product categories.** A new **Not for selling** checkbox now appears on the Add Category and Edit Category pop-ups (under Products > Categories). It is unticked by default. When you tick it for a category, that category is hidden from the POS Sale screen - it will no longer show in the **Product Suggestion** category dropdown or as a tile on the **Big Buttons** touchscreen layout. The category continues to appear normally everywhere else, including the product list, reports, and purchase screens, so the products inside it stay categorised as before. This is useful for back-office-only categories (such as raw materials or internal-use items) that you do not want cashiers to see during a sale.

---

### Module: POS - Big Buttons Touchscreen Layout

#### What Users Can Do Now
- **New "Big Buttons" POS screen layout.** A fourth option has been added to *Settings > Business Settings > POS > POS Screen Interface*, alongside *Simple*, *Show Product Suggestion*, and *Enable Quick Buttons*. When you choose **Big Buttons**, the POS Sale screen turns into a full touchscreen till designed for 15-inch shop counter screens, with everything visible in one window - no page scrolling needed.
- **Large category tiles** for quick item lookup, automatically built from your product categories. Tap a category to load its products.
- **Built-in numpad and quick-cash buttons** - full 1-9 / 0 / 00 / CE pad with GBP 5, GBP 10, GBP 20, GBP 30, GBP 40, GBP 50, and GBP 100 quick-cash buttons.
- **Helper buttons** - **Misc. Item**, **EXACT** (auto-fills Tendered with the Total Payable), and **Subtotal**.
- **Tendered and Last Change fields** so cashiers can see the cash given and change due at a glance.
- **Large action buttons** - colour-coded **PAY** (cash), **CARD**, and **Voucher** buttons, sized for easy touch.
- **Top header bar** showing the cashier name, business location, **HOME** shortcut, a big search field, **Clear** button, customer selector, and a live clock.
- **Footer utility bar** with **EXIT**, **Logout**, **Setup**, **Sales**, **Open Till**, **Payouts**, **Fullscreen**, **Lookup Item**, and **Show/Hide Keyboard** shortcuts.
- **Hold and Resume** buttons for parking a sale and bringing it back later.

#### What Is Easier Now
- The Big Buttons screen keeps the normal POS features, including product search, taxes, discounts, customer group pricing, suspend / draft, multi-payment, offline sync, and printing.
- **PAY** opens the standard Multi-Pay finalize flow, **CARD** runs the express card payment flow, and **Lookup Item** opens the existing product search pop-up - so there is one consistent payment process across all interfaces.
- The other three layouts (**Simple**, **Show Product Suggestion**, **Enable Quick Buttons**) are unchanged. Big Buttons only activates when it is selected for a business location.

#### What Looks Different
- High-contrast UK till colour scheme - navy header and footer, yellow search field, red **PAY**, blue **CARD**, and amber **Payouts** - for clear visibility under shop lighting.
- All buttons are sized for finger touch, with primary **PAY** and **CARD** buttons made extra large for accurate tapping.
- The full till fits in one screen so cashiers do not need to scroll. On tablets and phones, the layout switches to a single column so it remains usable.

---

### Module: Products - Stock Maintenance

#### What Users Can Do Now
- **New "Stock Maintenance" button at the bottom of the Products list.** Tick one or more products in the list, then click **Stock Maintenance** to apply a bulk action to all of them at once.
- **Bulk Tax Assignment.** Inside Stock Maintenance, choose **Tax** as the maintenance type, pick the tax rate from the dropdown, and click **Apply** - the selected tax is set on all chosen products in one step.
- **Bulk Tax Removal.** The same Tax dropdown also has a **None (Remove Tax)** option. Pick it and click **Apply** to remove the tax from all selected products in one go.

---

### Module: Stock Transfer

#### What Is Easier Now
- **Editing a stock transfer now updates stock at both locations correctly.** When you save changes to a transfer, the system first cancels the previous stock movement at both the From and To locations, then re-applies the movement based on your updated products and quantities. Adding, removing, or changing the quantity of any item is reflected accurately at both ends - with no double-counting and no leftover stock.
- **Destination cost is now worked out from the source location's real cost.** The purchase price recorded at the destination is calculated automatically from the oldest stock at the source location (using FIFO), instead of using the price typed in the form. This keeps your cost-of-goods and profit reports accurate after a transfer. If the source has no purchase history, the system uses the price you entered as a fallback.
- **Edits to completed transfers now keep cost history clean.** The internal links between sold items and the source purchase lines they came from are properly rebuilt when you edit, so FIFO / LIFO / Average cost reports continue to match what was actually moved.

#### What Works Correctly Now
- Fixed an issue where editing a stock transfer and adding or removing products could leave leftover (orphaned) records at the destination.
- Fixed an issue where changing the quantity on an in-transit transfer and then completing it could move the wrong amount of stock.
- Fixed a small warning message on the Stock Transfer Edit page when loading the "added by" user list.

#### What Looks Different
- On the Stock Transfer Edit page, the **Stock Type**, **Category**, and **Load Products** controls are no longer locked when a transfer is marked **Completed** - so you can revise them as part of an edit.

---

### Module: Stock Transfer - List

#### What Works Correctly Now
- Fixed an issue on the Stock Transfers list where the **Update Status** pop-up's dropdown options were appearing behind the pop-up. The status dropdown now opens correctly on top.
- The **Edit** button on the Stock Transfers list now also appears for transfers in the **Completed** status. Previously it was hidden for completed transfers, even though the Edit page itself supported editing them.

---

### Module: User Management - Roles & Permissions

#### What Users Can Do Now
- **New "Edit Stock Transfer" permission added to the Stock Transfers tab on the Role create/edit page.** You can now grant the ability to edit existing stock transfers separately from the "Add Stock Transfer" permission. Go to **Roles > Edit a role > Stock Transfers tab** and tick **Edit Stock Transfer** for the roles that need it.

#### What Is Easier Now
- The **Edit** button on the Stock Transfers list and the Edit Stock Transfer page now check the new dedicated permission. Existing roles that already had **Add Stock Transfer** continue to work as before, so nothing needs to be reconfigured.

---

### Module: Manufacturing - Recipe

#### What Works Correctly Now
- **Ingredient cost now shows correctly when a manufactured product is used inside another recipe.** If a product has its own recipe (for example, "Sada Barfi" is itself manufactured), and you use that product as an ingredient inside another recipe, the Price column for that ingredient was showing Rs 0.00. It now correctly shows the cost calculated from its own recipe.

#### What Looks Different
- **Product SKU is now shown in brackets next to the product name on the Recipe edit page.** For example, the heading now reads "Product: Yellow Cham Cham - Only Demand (1096)" - so you can confirm at a glance which product you are editing without going back to the recipe list.

---

### Module: Manufacturing - Productions Report

#### What Users Can Do Now
- **Productions Report redesigned with three tabs.** Instead of one long table, the report is now split into three focused views you can switch between with a single click:
  - **Totals** - a day-by-day summary showing how many productions ran, how many were finalised vs. draft, and the combined labour cost, overhead, and total value for each day.
  - **Production Detail** - one row per production, showing the batch number, status, priority, expected and actual quantities, yield efficiency, due date, and all cost figures.
  - **Raw Materials Used** - a breakdown of every ingredient used across the selected productions, with quantities, waste, net quantity, unit cost, and total cost.

#### What Is Easier Now
- **Quantity columns now follow your Quantity Decimals setting.** All quantity fields (Expected Qty, Actual Qty, Total Qty, Waste Qty, Net Qty) display the same number of decimal places set in **Business Settings > Business > Quantity Decimals**.
- **Currency symbol shown only in the heading, not on every row.** Cost columns (Labour Cost, Overhead Cost, Total Cost, Unit Cost) show clean numbers in each row; the currency symbol appears once in the heading - making reports easier to read.
- **All number columns are right-aligned** across the three tabs for cleaner reading.
- **The date filter now defaults to Today** when you first open the report.
- **The Raw Materials tab has the same standard controls as other reports** - choose how many rows to show, search or filter the list, and export to CSV, Excel, or PDF.

#### What Looks Different
- Removed the **Print** button from the filter bar where it was incorrectly placed.

---

### Module: Manufacturing - Production

#### What Is Easier Now
- **Change a production's status straight from the Production list - no need to open the record.** Each status badge (Planned, In Progress, Quality Check, On Hold, Cancelled) in the list is now clickable. Click it to open a small pop-up, choose the new status, and save in one click. The list refreshes automatically after saving. Productions that are already **Completed** cannot be changed from the list, and their badge stays non-clickable.

---

### Module: Reports - Product Purchase Report

#### What Users Can Do Now
- **Two new tabs added: "By Sub-Category" and "By Sub2-Category".** The Product Purchase Report now has two additional grouped views alongside the existing "By Category" tab.
  - **By Sub-Category** - purchases grouped by the second level of your categories. For each sub-category you can see the total quantity purchased and the total purchase value - useful for comparing spend at the sub-category level.
  - **By Sub2-Category** - the same view grouped by the third level, giving a more detailed breakdown if your business uses three category levels.
  These tabs appear automatically when Sub-Categories and Sub2-Categories are turned on in business settings. All filters in the report - date range, location, supplier, brand, category, and the sub-category dropdowns - apply to these tabs in the same way.

---

## Version 8.87.6

**Release Date:** 2026-05-18

### Module: Reports - Report 607 (Sale)

#### What Works Correctly Now
- **Footer totals on the Report 607 (Sale) page now reset correctly when a filter has no sales.** If a date range or filter has no matching sales, the Total, Discount, and Tax amounts show 0 instead of keeping the previous totals.

---

## Version 8.87.6

**Release Date:** 2026-05-18

### Module: Manufacturing - Dashboard

#### What Users Can Do Now
- **Manufacturing Dashboard has a completely new modern look.** The dashboard has been redesigned with a clean, professional style. Key numbers such as Total Productions, Total Production Value, QC Pass Rate, and Overdue Productions are now displayed as large, colour-coded cards at the top of the page so you can see the most important information at a glance.

- **Production Status chart added to the dashboard.** A visual doughnut chart now shows how your productions are spread across all statuses - Planned, In Progress, Quality Check, Completed, On Hold, and Cancelled - so you can instantly see the overall picture without reading rows of numbers.

- **Priority breakdown chart added to the dashboard.** A horizontal bar chart now shows how many active productions are in each priority level (Urgent, High, Normal, Low), making it easy to spot if there are too many urgent or overdue items piling up.

- **Quality Control summary now includes a pass-rate progress bar.** The QC section now shows Passed, Failed, and Pending counts side by side with a colour-coded progress bar that visually indicates the overall pass rate percentage.

- **"Added By" column added to the Production list.** The Production list now shows who created each production record in the last column, so you can easily track which team member added each entry.

- **"Added By" column added to the Demand Order list.** The Demand Order list now shows who created each demand order in the last column, making it easier to follow up with the right person.

#### What Is Easier Now
- **Business Location filter and Date Range filter on the dashboard now apply immediately.** Previously, you had to click the Refresh button after selecting a location or date range for the data to update. Now, as soon as you pick a date range or choose a location, the dashboard automatically reloads and shows the filtered results - no extra button click needed.

- **The selected Business Location is remembered after filtering.** After filtering the dashboard by a specific location, the dropdown now stays set to that location when the page reloads, instead of resetting back to "All".

---

## Version 8.87.6

**Release Date:** 2026-05-17

### Module: Manufacturing - Security & Permissions

#### What Works Correctly Now
- **Manufacturing Reports were visible to users who had no report permission.** Users such as cashiers who only had production or dashboard access could still see the full Reports section (Manufacturing Report, Recipe Report, Demand Order Report, Demand Ingredient Report) in the Manufacturing menu. The Reports section now only appears if at least one report permission - "Access Manufacturing Reports", "View Manufacturing Report", "View Recipe Report", "View Demand Order Report", or "View Demand Ingredient Report" - is specifically enabled in the user's security role.

- **Demand Ingredient Report was accessible to any user with Demand Order access.** A user who had the "Access Demand Orders" permission could open the Demand Ingredient Report even without the "View Demand Ingredient Report" permission. These two permissions are now fully independent. Opening the Demand Ingredient Report now requires either "View Demand Ingredient Report" or "Access Manufacturing Reports" to be enabled.

- **Demand order status could be changed by users without the Approve permission.** Cashier users could click the status badge on the Demand Order list and move a demand order to any status - including "Approved" - even though the "Approve Demand Order" permission was not enabled in their security role. Now, changing a demand order's status (to any value, including Approved, In Production, or Completed) requires the "Approve Demand Order" permission. The "Edit Demand Order" permission continues to cover editing the order's content - items, quantities, dates, and notes - but no longer controls status changes.

---

## Version 8.87.6

**Release Date:** 2026-05-17

### Module: Manufacturing - Production

#### What Is Easier Now
- **Production status now automatically changes to "Completed" when you tick Finalize.** Previously, if you had manually set the production status to something other than "Completed" (for example "In Progress" or "Quality Check"), ticking the Finalize checkbox and saving would finalize the stock - but the status badge on the list would still show the old status. Now, whenever you tick **Finalize** and save (on both the Add Production and Edit Production pages), the production status is automatically set to **Completed** regardless of what was selected in the status field. This keeps the status badge and the actual finalized state in sync without any extra steps.

---

## Version 8.87.6

**Release Date:** 2026-05-17

### Module: Manufacturing - Production

#### What Works Correctly Now
- **Recipe Instructions now appear when you select a product on the Production Create page.** Previously, the Recipe Instructions field would always stay blank even after choosing a product. It now correctly fills in with the instructions saved on the recipe as soon as a product is selected.

- **Recipe Instructions on the Production Edit page now load correctly.** Opening an existing production record will now show the instructions that were saved with it, instead of showing a blank field.

- **Switching products no longer leaves old instructions behind.** If you change the selected product (or clear the product field) on the Production Create page, the Recipe Instructions field now clears automatically. Previously, it would keep showing the previous product's instructions.

#### What Is Easier Now
- **Recipe Instructions field is now editable on both Create and Edit pages.** You can now type, paste, or update the instructions directly in the field - for example, to add notes specific to this production run. Previously the field was locked (read-only) and could not be typed in.

- **Instructions you enter are saved with the production record.** Whatever you type in the Recipe Instructions field is now saved when you submit the form. When you later open the same record to edit it, your instructions will be shown exactly as you entered them.

---

## Version 8.87.5

**Release Date:** 2026-05-16

### Module: Manufacturing - Production List

#### What Users Can Do Now
- **"Selling Price" column added to the Production List.** The Production list now shows a **Selling Price** column next to the Total Cost column. This displays the total expected selling value for each production run - calculated by multiplying the product's selling price by the quantity produced - so you can immediately compare what a batch costs to make versus what it can sell for.

- **Footer totals now appear at the bottom of the Production List.** The list now shows running totals at the bottom of the page. You can see the combined **Total Cost** and combined **Total Selling Price** for all production entries currently on screen - without having to add them up manually.

#### What Looks Different
- **Numeric value columns are now right-aligned in the Production List.** The **Quantity**, **Total Cost**, and **Selling Price** columns now display their values aligned to the right, making it easier to read and compare numbers down the column at a glance.

---

### Module: Manufacturing - Recipe Report

#### What Users Can Do Now
- **Filter bar added to the Recipe Report.** The Recipe Report now has a filter panel at the top - just like other reports in the system. You can narrow down the recipes shown on screen before viewing or exporting.

- **Filter by Category.** Select a product category from the dropdown to show only the recipes that belong to that category.

- **Filter by Sub Category.** After choosing a category, a Sub Category dropdown appears so you can drill down further. The sub-category list automatically updates to match the selected category.

- **Filter by Sub2 Category.** If your business uses a third level of categories, a Sub2 Category dropdown also appears after you select a sub category.

- **Search by product name.** Type any part of a product name in the Search Product box. The autocomplete will suggest matching products as you type - select one to show only that product's recipe.

- **Searching an ingredient now shows the recipes it belongs to.** If the product you search is used as an ingredient in a recipe (not the final product), the report will still show you every recipe that uses it - so you can see which recipes depend on that ingredient.

- **Rows-per-page selector added to the table.** You can now choose how many rows to show at a time (10, 25, 50, 100, or All) directly above the table, matching the layout of other reports in the system.

#### What Looks Different
- **Numeric value columns are now right-aligned in the Recipe List.** The **Quantity**, **Price**, and **Unit Price** columns now display their values aligned to the right for easier reading and comparison.

---

### Module: Manufacturing - Demand Orders

#### What Looks Different
- **Numeric value columns are now right-aligned in the Demand Orders list.** The **Total Items**, **Estimated Cost**, and **Selling Price** columns now display their values aligned to the right.

- **Currency symbol moved to headings for cost and selling price columns.** The currency symbol, such as Rs, now appears only in the **Estimated Cost** and **Selling Price** headings instead of repeating on every row - making the list cleaner and easier to scan.

- **Footer totals now appear at the bottom of the Demand Orders list.** The list now shows running totals at the bottom of the page. You can see the combined **Total Items**, **Estimated Cost**, and **Total Selling Price** for all entries currently on screen - without adding them up manually.

---

### Module: Manufacturing - Demand Ingredient Report

#### What Is Easier Now
- **Category, Sub Category, and Sub2 Category columns are now shown on all report tabs.** Every tab in the Demand Ingredient Report - Product-wise Summary, Category-wise Summary, All Ingredients Summary, All Ingredients Detail, and Batch Ingredients Summary - now includes three separate columns showing the Category, Sub Category, and Sub2 Category of each product or ingredient, so you can clearly see which category level each item belongs to.

- **The Category / Sub Category / Sub2 Category filters now correctly narrow down the report.** Selecting a category or sub-category in the report filters now limits all tabs to only show products that belong to the selected category. Previously, all products appeared regardless of the filter chosen.

- **Sub Category and Sub2 Category columns now display the correct values.** The Sub Category and Sub2 Category columns were previously empty for all products. They now correctly show the sub-category and sub2-category names as saved on each product, matching what you see in the product list.

#### What Looks Different
- **Currency symbol moved to the Selling Price heading across all report tabs.** The currency symbol, such as Rs, now appears only in the **Selling Price** heading instead of repeating inside every row - keeping the numbers clean and easy to read. This applies to all five report tabs: Product-wise Summary, Category-wise Summary, All Ingredients Summary, All Ingredients Detail, and Batch Ingredients Summary.

---

### Module: Reports - Sale Invoices Report

#### What Users Can Do Now
- **Two new filter options added to the "Type" dropdown in the Sale Invoices Report.** You can now filter the report by **Sales Order** or **Quotation** in addition to Sales Invoices and Sales Return.

  - **Sales Order** - Select this to view all products and quantities listed on Sales Orders. This option only appears if Sales Orders are enabled in **Business Settings > Sales**.

  - **Quotation** - Select this to view all products and quantities listed on Quotations. This option only appears if Quotations are enabled in **Business Settings > Sales**.

---

### Module: Reports - Types of Service Report

#### What Users Can Do Now
- **A new "Types of Service Report" has been added under Reports.** This report gives you a full breakdown of all sales that were placed using a Type of Service (such as Dine In, Take Away, Delivery, etc.). You can find it under **POS Reports** if the POS module is turned on, or under **Sales Reports** if it is not.

- **Filter the report by date range, business location, and type of service.** Use the filter bar at the top to narrow down results - choose a date range, a specific business location, or a particular type of service to focus on exactly what you need.

- **Three report views in one page - Total, Summary, and Detail.**

  - **Total tab** - Shows a day-by-day breakdown. For each date, you can see how many orders were placed using a type of service and the total sales amount for that day.

  - **Summary tab** - Shows a grouped view by type of service name. For each service type, you can see the total number of orders, the total amount collected, and the average order value. Useful for comparing which service type brings in the most business.

  - **Detail tab** - Shows every individual transaction. Each row displays the date, invoice number, customer name, invoice total, the type of service used, and the service charge amount collected for that order.

- **Footer totals appear at the bottom of every tab.** Each tab automatically adds up the quantities and amounts shown on screen so you can see the running totals without manually adding them up.

- **Access controlled by role permission.** Go to **Settings > Security Roles**, open a role, and look under the **Reports** section. Enable **View Types of Service Report**, then choose **Own Location** or **All Locations** under that permission.

---

### Module: Reports - Sell Payment Report

#### What Is Easier Now
- **Payment Method filter dropdown now shows the exact names you set for each business location.** The list of payment methods in the filter now matches the names configured in your Business Location's Payment Options - for example, if you named a custom method "E-Wallet" or "Online Transfer", that exact name now appears in the filter instead of a generic label.

---

### Module: Reports - Purchase Payment Report

#### What Users Can Do Now
- **Payment Method filter added to the Purchase Payment Report.** You can now filter the Purchase Payment Report by payment method - the same way you can on the Sell Payment Report. Select a specific method from the new dropdown to show only payments made using that method. The dropdown shows the exact method names set in your Business Location's Payment Options.

---

### Module: Labels

#### What Users Can Do Now
- **You can now print the Product Category on labels.** In **Labels > Information to show in Labels**, a new **Product Category** option has been added. Tick it before previewing or printing, and the category name assigned to the product will appear on each printed label. You can also set the font size for it, just like the other label fields.

---

### Module: Product Catalogue

#### What Works Correctly Now
- **Discount badge now appears only on the right products.** If a discount is set for one product, brand, or category, the badge appears only where that discount applies.

#### What Is Easier Now
- **Product cards now show the discounted price when a discount is active.** When a product has an active discount, its card in the catalogue now displays the original price with a strikethrough and the discounted price highlighted in red below it. This makes it easy for customers to see the saving at a glance before opening the product details.

---

### Module: Accounting - Journal Entry

#### What Is Easier Now
- **"Narration" column now appears on the Journal Entry list.** The Journal Entry list now shows a dedicated Narration column (placed just before the Additional Notes column). This displays the description you entered for each account line when creating or editing a journal entry, so you can read the purpose of each entry at a glance - without having to open it.

---

## Version 8.87.4

**Release Date:** 2026-05-15

### Module: Accounting - Bank Reconciliation

#### What Users Can Do Now
- **A new "Bank Reconciliation" section has been added to the Accounting module.** You can find it in the Accounting menu under **Bank Reconciliation**. This feature lets you compare your bank statement with the transactions recorded in the system - and tick off the ones that match - so you can confirm your books are accurate at the end of each period.

- **Start a new reconciliation in seconds.** Click **+ New Reconciliation**, choose the bank account, enter the closing balance shown on your bank statement, and set the statement date. The system automatically fills in the opening balance from your previous reconciliation (if one exists) so you do not have to enter it manually.

- **Mark transactions as cleared directly on screen.** The reconciliation worksheet shows two columns side by side - **Deposits / Credits** on the left and **Payments / Debits** on the right. Tick the checkbox next to each transaction that appears on your bank statement. The totals and the outstanding difference update instantly as you tick.

- **Live difference indicator shows whether your books balance.** A summary bar at the top of the worksheet shows the bank statement balance, cleared totals, and the current difference. When the difference reaches zero, a green "Balanced" indicator appears and the **Complete Reconciliation** button becomes active.

- **Add bank-only entries without leaving the reconciliation.** If your bank statement includes a charge, fee, or deposit that has not yet been entered into the system (such as a bank service fee), click **Add Bank-Only Entry**, enter the amount, date, and description, and it will be included in the reconciliation and automatically ticked as cleared.

- **Outstanding transactions are shown at a glance.** Below the worksheet, the system lists all transactions that were not ticked - these are deposits or payments recorded in the system but not yet appearing on the bank statement. This helps you spot anything that may need follow-up.

- **Finalise and lock completed reconciliations.** Once balanced, click **Complete Reconciliation** to mark it as done. You can then **Lock** it to prevent any further changes, keeping your records secure and auditable.

- **Print or save a formal Reconciliation Statement.** Every completed reconciliation has a printable report showing the statement period, opening and closing balances, all cleared deposits and payments, outstanding items, and signature lines for authorisation. Open any reconciliation from the list and click **Print**.

- **Full history of past reconciliations.** The Bank Reconciliation list shows all previous reconciliations with their status (Draft, Completed, or Locked), the bank account, statement date, and whether they balanced. You can filter by account, status, or date range.

- **Access controlled by role permission.** Go to **Settings > Security Roles** and look under the **Accounting** section to enable **Manage Bank Reconciliation** for the roles that need it.

---

### Module: Dashboard

#### What Is Easier Now
- **"Top 10 Selling Products" widget no longer includes items marked as "Not for Selling".** Any product you have flagged as "Not for Selling" on its product page will no longer appear in this dashboard list, keeping it accurate and limited to what you actually sell.

---

### Module: Reports

#### What Users Can Do Now
- **Each report now has its own separate permission to allow staff to see data for all locations.** Previously, a staff member linked to one location could only see that location's data in reports. You can now grant permission per individual report - for example, let a user see all locations in the Profit & Loss report while keeping them restricted to their own location in the Stock report. Go to **Settings > Security Roles**, open a role, and look under the **Reports** section - each report's "View for All Locations" option appears directly below its main "View" option.

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

### Module: Point of Sale (POS)

#### What Is Easier Now
- **POS screen is faster when you scan or tap several products quickly one after another.** Products now load into the sale with less delay, so you can keep adding items without waiting.
- **Customer group pricing and discounts are applied without any pause.** If a customer belongs to a group with special prices, those prices now appear immediately - no noticeable delay during the sale.
- **Product unit choices (e.g. Piece, Box, Dozen) appear faster during a sale.** Selecting a unit on any product row is quicker, especially when the same unit is used more than once in the same transaction.
- **Service staff list in POS appears faster.** The list of staff available to assign to a table or order loads more quickly each time it is needed on the same screen.

---

### Module: User Management

#### What Users Can Do Now
- **The Users page is now divided into two separate sections: "All Users" and "All Employees".**
  - **All Users** - lists only staff who have a system login (those with "Allow Login" turned on). Their username, role, and login-related actions are shown here.
  - **All Employees** - lists staff who do **not** have a system login (those with "Allow Login" turned off). These are typically field staff or workers tracked in the system but not given access to sign in.

  This makes it much easier to manage login-access staff and non-login employees separately without them being mixed together in one long list. This split also appears on the Superadmin > Business detail page.

---

### Module: Navigation Bar (Top Bar)

#### What Looks Different
- **"Add Sale" shortcut icon in the top bar is now hidden for users who do not have the Add Sale permission.** The icon now only appears for users whose role includes permission to add a sale.
- **"Add Product" shortcut icon in the top bar is now correctly shown or hidden based on the user's permission.** Only users with the "Create Product" permission in their role will see this icon.

---

### Module: Manufacturing - Demand Orders

#### What Users Can Do Now
- **A "Batch Quantity" field has been added to each product line in demand orders.** When creating or editing a demand order, you can now enter a batch quantity per line to specify how many batches are needed - making production planning clearer at a glance.
- **Batch Quantity is now shown when viewing or printing a demand order.** The batch quantity column appears in the demand order detail view and on printed copies, so nothing is missing from your records.
- **A new "Batch Ingredients Summary" tab has been added to the Demand Order Report.** This tab shows a combined summary of how much of each ingredient is needed across all demand orders for the selected period, grouped by batch - without having to check each order separately.

#### What Is Easier Now
- **SKU search in Manufacturing now finds all product types.** Scanning or typing a product SKU in the manufacturing search now correctly finds both weight-code products and regular simple products, so you can add any product to a recipe or demand order without browsing manually.

#### What Works Correctly Now
- **Recipe Report opens normally again.** The Recipe Report under Manufacturing > Reports now shows recipe information as expected.

---

### Module: Manufacturing - Demand Ingredient Report

#### What Works Correctly Now
- **Quantity values in the Demand Ingredient Report now display the correct number of decimal places.** All quantity columns across all tabs (Product-wise Summary, Category-wise Summary, All Ingredients Summary, All Ingredients Detail, and Batch Ingredients Summary) now respect the **Quantity Decimal** setting configured in **Settings > Business Settings > Business tab**. Previously, quantities were always displayed using the currency decimal setting regardless of how many decimal places were set for quantities.

---

### Module: Layout / Display

#### What Looks Different
- **The Save and Update buttons on several pages have been moved to the bottom footer bar.** Instead of appearing at the bottom of the page content - where you had to scroll down to reach them - these buttons now stay visible at the bottom of the screen. This applies to the following pages:
  - **Barcode Settings > Add New Setting** - the **Save** button is now in the bottom bar.
  - **Barcode Settings > Edit Setting** - the **Update** button is now in the bottom bar.
  - **Users > User Settings** - the **Update** button is now in the bottom bar.
  - **HRM > Settings** - the **Update** button is now in the bottom bar.
  - **Manufacturing > Settings** - the **Update** button is now in the bottom bar.
  - **Manufacturing > Demand Orders > Create** - the **Save** and **Save & Print** buttons are now in the bottom bar.
  - **Manufacturing > Demand Orders > Edit** - the **Update** and **Update & Print** buttons are now in the bottom bar.

---

## Version 8.87.3

**Release Date:** 2026-05-14

### Module: Reports - General Reports

#### What Users Can Do Now
- **New Bookings Report added under Reports > General Reports.** View all restaurant/table bookings in one place. The report shows booking start and end time, customer name, phone number, table, business location, service staff, booking status (Waiting, Booked, Completed, or Cancelled), and any notes. Use the filters at the top to narrow results by date range, location, status, or customer, then print with one click.

---

### Module: Layout / Display

#### What Looks Different
- **Empty space on the right side of pages on large or widescreen monitors has been removed.** On extra-large screens and LED displays, pages now stretch to fill the full width instead of leaving a blank gap on the right side.

---

### Module: Manufacturing - Demand Orders

#### What Users Can Do Now
- **Selling Price column added to the Demand Order list.** Each demand order in the list now shows the total selling value of the finished products alongside the estimated cost.
- **Selling Price column added to the Demand Order detail view and print.** When you open or print a demand order, each product line now shows its selling price next to the estimated cost, with a total selling price in the footer.

#### What Is Easier Now
- **Filters can now be saved on the Demand Order list page.** Use the new **Save** button in the filter bar to remember your selected Business Location, Date Range, and Status. Your saved filters will be applied automatically the next time you open the Demand Order list. Click **Reset** to clear all filters back to default.

#### What Looks Different
- **The Action button (View / Print / Edit / Delete / Approve) is now the first column in the Demand Order list.** You no longer need to scroll to the right to take action on a record.
- **Date range filter opens on Today automatically.** When you open the Demand Orders list, the date is already set to today so any order you just created appears straight away without needing to change the date.
- **"Demand Order" is now a direct link in the Manufacturing sidebar menu.** The previous "+ Add Demand Order" shortcut has been replaced with a "Demand Order" link that opens the full Demand Order list. From there you can view, search, filter, add, edit, approve, and print demand orders - all in one place. The "Add Demand Order" button is still available inside the list page.

#### What Works Correctly Now
- **Demand Order list now loads correctly for all users who have access - not just Admin.** Non-admin users with the "Access Demand Order" permission were seeing a blank, empty table. The list now shows all demand orders for the business, as expected.
- **The Edit button on the Demand Order list is now only shown to users who have edit permission.** Previously, the Edit button appeared for all users, but clicking it caused a "not allowed" error for those without the permission. The button is now hidden for those users.
- **Demand Order link no longer appears twice in the menu.** It was showing up in both the main navigation bar and the Reports dropdown at the same time for some users. It now appears only in one place based on the user's permissions.
- **Orders created today now appear in the list immediately.** Previously, because the date filter defaulted to yesterday, any order added today would not show up until the following day. The filter now defaults to today so newly created orders are visible right away.
- **Clicking a status in the Demand Order list now shows all available status options.** Previously, only 2 options appeared - Pending and Cancelled - regardless of the order's current status. The full list of statuses is now shown so you can move an order to any stage directly without going through each step one at a time.

---

### Module: Manufacturing - Demand Ingredient Report

#### What Users Can Do Now
- **Selling Price column added to all four report tabs.** The Demand Ingredient Report now shows a Selling Price column across the Product-wise Summary, Category-wise Summary, All Ingredients Summary, and All Ingredients Detail tabs - so you can compare ingredient cost against selling value on one screen.

#### What Is Easier Now
- **Filters can now be saved on the Demand Ingredient Report.** Use the new **Save** button to remember your selected Business Location, Date Range, Demand Orders, Category, Sub Category, Sub2 Category, and Status filters. They will be restored automatically next time you open the report. Click **Reset** to clear all filters.

#### What Looks Different
- **Date range filter opens on Yesterday automatically.** When you open the Demand Ingredient Report, the date is already set to yesterday.

---

### Module: Manufacturing - Recipe

#### What Is Easier Now
- **Filters can now be saved on the Recipe list page.** Use the new **Save** button to remember your selected Category, Sub Category, and Sub2 Category filters. They will be applied automatically the next time you open the Recipe page. Click **Reset** to clear all filters back to default.

---

### Module: Manufacturing - Production

#### What Is Easier Now
- **Filters can now be saved on the Production list page.** Use the new **Save** button to remember your selected Business Location, Date Range, Production Status, Category, Sub Category, and Sub2 Category filters. They will be restored automatically the next time you open the Production page. Click **Reset** to clear all filters at once.
- **Recipe instructions are now shown directly on the production form.** When you select a recipe while adding or editing a production entry, the recipe instructions appear automatically on screen - no need to open the recipe separately to check them.

---

### Module: Manufacturing - Dashboard

#### What Looks Different
- **Date filter opens on Today automatically.** When you open the Manufacturing Dashboard, today's date is already selected - no need to manually pick a date before viewing the day's activity.

---

### Module: Manufacturing

#### What Works Correctly Now
- **Deleting a recipe now works correctly.** The delete button on a recipe was not doing anything - no confirmation appeared and nothing was removed. It now shows a confirmation prompt and removes the recipe as expected.
- **Product stock history no longer includes quantities from unfinished production batches.** The "Manufacturing (In)" quantity shown in a product's stock history was previously counting production batches that had not yet been completed, making stock figures appear higher than they should. Only fully completed batches are now counted.

---

### Module: Reports - Stock Value Report

#### What Users Can Do Now
- **Manufacturing quantities and values now appear as separate columns in the Stock Value Report.** Two new columns - Manufacturing (In) and Manufacturing Value - have been added, giving a complete picture of how stock was built up through production.

#### What Works Correctly Now
- **Manufactured stock now appears in the correct columns.** Purchase columns show only supplier purchases, and manufactured stock appears only in the Manufacturing columns.
- **Opening Stock now shows the correct figure even when sales are higher than purchases.** The report no longer changes those products to 0 automatically.

---

### Module: Contacts - Contact Payment

#### What Looks Different
- **"Outstanding" heading removed from the Contact Payment window.** The bold label above the due invoices section has been removed to keep the layout clean and uncluttered.
- **Location filter renamed to "Outstanding Invoices by".** The filter that narrows the due invoices list by business location now has a clearer, self-explanatory label.
- **Date range filters now sit next to the location filter.** The From and To date fields are now shown in the same row as the location filter, making it faster to set your filters without scrolling.
- **Location and User fields now sit side by side.** These two fields are now displayed in one row instead of stacked on top of each other, saving vertical space in the payment form.

---

## Version 8.87.1

**Release Date:** 2026-05-13

### Module: Reports / Products

#### What Is Easier Now
- **Product Stock Details section now shows a Total row at the bottom.** When viewing a product's stock details, a new totals row shows the combined Current Stock Quantity, Total Stock Price, Total Units Sold, Total Units Transferred, and Total Units Adjusted across all variations and locations.
- **Opening Stock Report footer totals now show the correct grand total across all pages.** Previously these totals only added up the rows visible on screen. They now always reflect the full filtered result, no matter how many pages the report spans.
- **Add / Edit Opening Stock now shows footer totals for Quantity and Quantity Remaining.** Each location table in the Opening Stock form now has a totals row that updates automatically as you enter values.

#### What Works Correctly Now
- **Stock quantities now match for products with multiple variations.** The Product list, Stock Quantity Report, and Product Stock Details window now show the same correct figures.

---

## Version 8.87.2

**Release Date:** 2026-05-05

### Module: Business Location Settings

#### What Users Can Do Now
- **New "Map & Location" tab added to Business Location settings.** Administrators can now set a precise map location for each business location. Search for an address, click anywhere on the map to drop a pin, or tap "Use My Current Location" to fill in the coordinates automatically. The saved location is used as the starting point on the live delivery map.

---

### Module: Delivery Management

#### What Is Easier Now
- **Live Map now opens centred on your business location.** Each business location with saved coordinates appears as a store pin on the live tracking map. The map no longer opens on a random point on the world map.

---

### Module: HRM - Attendance (Biometric Push Devices)

#### What Users Can Do Now
- **Newer ZKTeco biometric devices can now send attendance records directly to the system in real time.** Models such as SenseFace 2A, 4A, 7C, ProFace X, SpeedFace M5, G4 and similar can send attendance records automatically - no extra attendance software or scheduled sync is required.
- **New "ADMS / SenseFace Devices" page** added under HRM > Attendance > Import Attendance. Administrators can register devices, check when they were last seen, and enable or disable any device.
- **Each device has its own safety key** to help prevent attendance records from unknown devices.
- **Step-by-step live attendance setup guide** is shown directly on the Import Attendance page, so users can set up the device without leaving the screen.

#### What Looks Different
- **Import Attendance page now groups compatible devices into four clear categories:** Fingerprint/RFID, Multi-bio, iClock/SpeedFace, and ADMS Push - with a note indicating which models are officially tested.
- **Quick-access "ADMS / SenseFace Devices" button** added to the Import Attendance page alongside the existing Download buttons.

---

## Version 8.87.1

**Release Date:** 2026-05-05

### Module: Business Settings - Modules

#### What Users Can Do Now
- **Delivery Management module can now be turned on or off.** A new "Delivery Management (Riders & Live Map)" option has been added under Settings > Business Settings > Modules tab. When turned off, the Delivery menu and all delivery pages are hidden from all users. When turned on, the full Delivery suite is available.

---

## Version 8.87.0

**Release Date:** 2026-05-05

### Module: Delivery Management (New Module)

#### What Users Can Do Now
- **A complete Delivery Management module is now available** under a new Delivery menu (shown to users who have delivery access).
- **Live Map:** Real-time map showing every active rider's current position with colour-coded status pins (Available / On Delivery / On Break / Offline). Click any rider pin to see their name, phone number, vehicle, current speed, last-seen time, and the details of their active delivery. The map refreshes automatically every 10 seconds.
- **Dashboard summary cards:** A quick overview showing Total Riders, Available, On Delivery, Today's Orders, Active Assignments, and Delivered Today.
- **Riders directory:** Add and manage delivery riders. Capture vehicle type, plate number, colour, driving licence number and expiry date, emergency contact, maximum load, base delivery fee, per-km rate, and a photo. View the full list with each rider's current status and last-seen time.
- **Per-rider Track screen:** View a 24-hour map trail of GPS location updates for any individual rider.
- **Assignments:** Create and manage delivery tasks linked to a sale invoice (the customer's address fills in automatically from the contact record) or as a standalone delivery. Filter by status, rider, and date range.
- **Automatic distance and fee calculation:** Drop-off distance is calculated automatically. The delivery fee is computed as base fee + (distance x per-km rate) and can be overridden manually for each assignment.
- **Delivery status tracking:** Pending > Accepted > Picked Up > On The Way > Delivered (with Failed and Cancelled options available). Each step is recorded with a timestamp.
- **Performance Report:** Per-rider summary over any date range - showing total assignments, delivered, cancelled, success rate, total km travelled, total fees earned, and average delivery time.

#### What Looks Different
- **New Delivery sidebar menu** (truck icon) with four sections: Live Map, Riders, Assignments, and Performance Report.

---

## Version 8.86.3

**Release Date:** 2026-05-04

### Module: Purchase Returns

#### What Works Correctly Now
- **Purchase Return list now shows the correct amount for each entry.** Each purchase return displays its real grand total.
- **Purchase Return footer totals now show the correct totals.** Grand Total and Payment Due at the bottom of the list show the combined total across all matching records.

---

### Module: Dashboard - Today at a Glance

#### What Works Correctly Now
- **Today's Revenue and Total Due Amount now correctly subtract returns.** Today's Revenue was previously showing gross sales without deducting sale returns, and Total Due was not offsetting outstanding return amounts. Both figures are now correct net amounts.

---

### Module: Sales - Sale Returns

#### What Works Correctly Now
- **Sale Return detail view now shows the returned products.** Opening a sale-return record shows the correct products, quantities, unit prices, and subtotals.
- **Sale Return list footer totals now cover all pages - not just the visible page.** The Grand Total and Payment Due amounts in the footer now show the correct combined total across all records, regardless of how many pages the list has.

---

### Module: Reports - Profit & Loss

#### What Works Correctly Now
- **Total Sale Return now matches the Sale Return list.** The Profit & Loss report shows the same sale return amount users see on the Sale Return list.

---

### Module: Reports - Sales & Returns Report

#### What Works Correctly Now
- **Sales & Returns Report footer totals now show net sales correctly.** Sale returns are deducted from sales instead of being added.

---

### Module: Reports - Sale Invoices Report

#### What Works Correctly Now
- **Sale Return quantities now show correctly on the Totals tab.** The Item Quantity column shows the returned quantity instead of 0.

---

### Module: Settings - Modules

#### What Users Can Do Now
- **New "Custom Designer" toggle** added under Settings > Business Settings > Modules tab. When turned on, the Invoice Designer and Label Designer options appear in the sidebar. When turned off, these options are hidden. This toggle is off by default.

---

### Module: Products

#### What Works Correctly Now
- **Group Price now appears in the Product list.** Products with selling group prices show those prices in the list.

---

### Module: Manufacturing - Sidebar Menu

#### What Looks Different
- **Manufacturing sidebar menu reordered for a clearer, step-by-step workflow.** The menu now follows the natural production lifecycle: Dashboard > Recipe > Production > Add Demand Order > Reports > Settings.
- **New "Reports" group added to the Manufacturing sidebar.** All reporting screens (Demand Order Report, Demand Ingredient Report, Manufacturing Report, and Recipe Report) are now grouped together under a single Reports menu item.
- **"Add Demand Order" is now a top-level shortcut in the sidebar.** You can create a new demand order in one click directly from the sidebar.

---

## Version 8.86.2

**Release Date:** 2026-05-03

### Module: Settings - Invoice / Receipt Design

#### What Users Can Do Now
- **New receipt layout "Slim 4" added for 80mm thermal printers.** Available under Settings > Invoice Settings > Layout. Each product is displayed across two lines - the first line shows the item number and product name, and the second line shows the quantity, unit price, discount, and subtotal - making items easier to read on narrow 80mm receipt paper.

---

### Module: HRM - Payroll

#### What Works Correctly Now
- **Employee list now updates when a location is selected in Advance Payment.** The Employee dropdown shows only employees from the selected location.

---

## Version 8.85.2

**Release Date:** 2026-05-02

### Module: Manufacturing - Recipe Import

#### What Users Can Do Now
- **"Download Excel" button added to the Recipe list page.** Clicking this button exports all your existing recipes in the same spreadsheet format used by the Recipe Importer. You can edit the downloaded file and re-upload it to update existing recipes or add new ones.
- **Simpler recipe import spreadsheet format.** Each ingredient now has its own row. Simply repeat the same Product SKU for every ingredient that belongs to the same recipe - no complex coding or special formatting is required.
- **Recipe-level details only need to be entered on the first row.** Fields such as Total Quantity, Recipe Unit, Extra Cost, and Instructions only need to be filled in on the first row of each recipe. The rows that follow will automatically use the same recipe-level values.
- **Blank fields use sensible defaults.** If you leave Total Quantity blank it defaults to 1. Production Cost Type defaults to Fixed. Units default to the product's base unit. This means you can create a working import file with minimal effort.
- **Improved downloadable template.** The Excel template now includes a styled header row, three worked examples (a cake recipe, a juice recipe, and a single-ingredient pack), and a built-in instructions section inside the sheet.
- **"Download Sample (with example data)" button added.** This downloads a fully populated sample workbook with 5 realistic recipes (Chocolate Cake, Vanilla Cupcake, Mango Juice, Veg Burger, Sugar Pack) that you can use as a reference when building your own import file.

#### What Looks Different
- **The Import Recipes page now clearly labels which columns are required and which only apply to the first row.** A short tip box at the top of the page summarises the format in three simple bullet points.

---

### Module: Sales / POS / Discounts

#### What Works Correctly Now
- **"Buy For Quantity" discounts now charge the correct total at POS.** For example, a "2 for GBP 9.99" deal charges GBP 9.99 for two units. If a customer buys 3 items, POS charges one bundle price plus one unit at the standard price.

---

### Module: Fiji FRCS Integration (New Module)

#### What Users Can Do Now
- **New Fiji FRCS module** added to help businesses in Fiji send sales receipts to the Fiji Revenue & Customs Service (FRCS) in real time.
- **Register your fiscal device (EFD).** A dedicated screen lets you enrol your shop's device with FRCS using the activation code from the FRCS portal. Switch between Sandbox mode (for testing) and Production mode (for live sales) with a single click.
- **Sales receipts are sent to FRCS automatically.** Every sale and refund processed at the POS is submitted to FRCS automatically. Supported types include Normal Sale, Refund / Credit Note, Training, and Proforma.
- **Choose how receipts are sent.** Select the mode that suits your business - Instant (sent at the moment of sale), Queued (sent in the background), Daily (sent once a day), or Manual (you click a button to send).
- **Works even when the internet is down.** If FRCS cannot be reached, receipts are saved locally and sent automatically once the connection is restored.
- **X-Reports and Z-Reports.** Generate the daily X-Report (read-only summary) and the end-of-day Z-Report (closes the business day and sends the data to FRCS). Z-Reports can also be generated automatically each night at a set time.
- **FRCS QR code printed on every receipt.** Once a receipt is accepted by FRCS, the official verification code and QR are stored and printed on the customer's copy so customers can verify it directly with FRCS.
- **Settings page.** From one screen you can configure your TIN, VAT number, sending mode, whether a buyer's TIN is required, QR code on/off, automatic Z-Report time, and an email address for error notifications.
- **Submission history and audit trail.** A dedicated page lists every receipt sent to FRCS with its current status (Pending / Submitted / Accepted / Failed). Search, filter, view details, and re-send any failed receipt with a single click.
- **"Submit All Pending" button.** Pushes all unsent receipts to FRCS in one go.
- **Separate staff permissions for FRCS:** Access the Fiji FRCS module, Manage EFD device onboarding, Submit fiscal receipts, and Generate X / Z Reports.

---

### Module: Accounting - Chart of Accounts

#### What Works Correctly Now
- **Parent Account dropdown now lists available parent accounts.** Users can choose the correct parent account when adding or editing an account.
- **Non-posting accounts can now be selected as parent accounts.** Active non-posting accounts appear in the Parent Account dropdown.

---

### Module: POS - Quick Menu Buttons

#### What Works Correctly Now
- **Quick menu buttons now increase the existing product quantity correctly.** When "Increase item quantity if it already exists" is turned on, repeated clicks increase the quantity on the same row.
- **Quick menu buttons now use quantity 1 when no quantity is set.** Products are no longer added with a blank quantity.

---

### Module: Purchases

#### What Is Easier Now
- **Purchase details popup now shows Gross Profit % and Sell Price.** When these fields are enabled in settings, the purchase detail view shows GP% and Sell Price alongside the Subtotal column, so you can review pricing without opening the edit screen.

---

### Module: Accounting - Chart of Account Report

#### What Users Can Do Now
- **Chart of Account Report added under Accounting > Reports.** Lists all accounts organised by type (Asset, Liability, Equity, Income, Expenses) with columns for GL Code, Account Name, Account Sub Type, and Status.
- **"Show Balances" option.** Tick the Show Balances checkbox and click Apply Filters to add a live balance column showing the current balance for each account, plus totals grouped by sub-type and account type.
