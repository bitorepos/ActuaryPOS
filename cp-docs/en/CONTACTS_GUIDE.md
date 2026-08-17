# Managing Your Contacts (Customers & Suppliers)

**Contacts** are the people and businesses you deal with — your **customers** who buy from you, and your **suppliers** who sell to you. This guide covers everything you need to know about managing contacts in {application_name}.

---

## What You'll Learn

- How to add customers and suppliers
- How to view and edit contact details
- How to import contacts from a file
- How to manage customer groups
- How to view a contact's ledger (transaction history)
- How to record payments

---

## Understanding Contact Types

| Type | What It Means | Where You'll Find Them |
|---|---|---|
| **Customer** | Someone who buys products or services from you | **Contacts → Customers** |
| **Supplier** | Someone who sells products to you (your vendor) | **Contacts → Suppliers** |
| **Both** | A contact that acts as both a customer and a supplier (e.g. you sell to them *and* buy from them, or you exchange goods/services with them) | **Contacts → Barterer** |

> 💡 **About "Both" / Barterer:** When you save a contact with the type **Both**, the system treats them as a **Barterer** — a trading partner you both buy from and sell to. They appear in a dedicated **Contacts → Barterer** menu (in addition to being filterable as a customer or supplier in their respective lists).

---

## How to Add a New Contact

1. Go to **Contacts** from the left sidebar.
2. Click **Suppliers**, **Customers**, or **Barterer** depending on what type you want to add.
3. Click the **Add** button (+ icon) at the top right.
4. Fill in the details:

### Basic Information
   - **Contact Type** — Choose **Customer**, **Supplier**, or **Both**
     - Choosing **Both** turns this contact into a **Barterer** (a partner you trade with in both directions). The same contact will then be visible under **Contacts → Customers**, **Contacts → Suppliers**, and **Contacts → Barterer**.
     - You need both *Add Customer* and *Add Supplier* permissions to see the **Both** option.
   - **Business Name** — The company name (optional for individual customers)
   - **Name Prefix** — Mr, Mrs, Ms, etc.
   - **First Name** — The contact's first name
   - **Last Name** — The contact's last name
   - **Mobile** — Primary phone number
   - **Email** — Email address
   - **Contact ID** — A unique code (auto-generated or enter your own)

### Tax & Business Details
   - **Tax Number** — VAT/GST/NTN number (if applicable)
   - **Pay Term** — Payment terms (e.g., 30 days, 60 days)
   - **Opening Balance** — If this contact owes you (or you owe them) from before you started using {application_name}
   - **Credit Limit** — Maximum amount you'll sell to them on credit

### Address
   - **Address Line 1** — Street address
   - **Address Line 2** — Additional address info
   - **City, State, Country, Zip Code**

5. Click **Save** to create the contact.

📸 *[Screenshot: The Add Contact form with key fields highlighted]*

> 💡 **Tip:** You can add **custom fields** if you need to track extra information. Ask your administrator to set these up in Business Settings.

---

## How to View and Edit Contacts

1. Go to **Contacts → Customers** (or **Suppliers**).
2. You'll see a list of all contacts with key details:
   - Name, mobile number, total purchase/sale, and balance due
3. Click the **Actions** button next to any contact.
4. Choose **Edit** to modify their details.
5. Make your changes and click **Update**.

📸 *[Screenshot: The contact list with the Actions dropdown visible]*

---

## How to View a Contact's Ledger

The **Ledger** shows a contact's complete transaction history — every purchase, sale, payment, and outstanding balance.

1. Go to **Contacts → Customers** (or **Suppliers**).
2. Click the **Actions** button next to the contact.
3. Select **Ledger**.
4. You'll see a timeline of all transactions with this contact:
   - Sale or purchase amounts
   - Payments received or made
   - Running balance

📸 *[Screenshot: A contact's ledger showing transactions and running balance]*

> 💡 **Tip:** Use the date filter to see transactions for a specific time period.

---

## How to Record a Payment

### Receiving Payment from a Customer

1. Go to **Contacts → Customers**.
2. Click the **Actions** button next to the customer.
3. Select **Pay** (or go to **Sale → Pay Customer**).
4. Enter the payment details:
   - **Amount** — How much is being paid
   - **Payment Method** — Cash, Card, Bank Transfer, Cheque, etc.
   - **Payment Note** — Any reference information
5. Click **Pay** to record the payment.

📸 *[Screenshot: The customer payment popup with amount and method fields]*

### Paying a Supplier

1. Go to **Contacts → Suppliers**.
2. Click the **Actions** button next to the supplier.
3. Select **Pay** (or go to **Purchases → Pay Supplier**).
4. Enter the payment details.
5. Click **Pay** to record it.

📸 *[Screenshot: The supplier payment popup]*

---

## How to Import Contacts from a File

If you have a large list of contacts in a spreadsheet, you can import them all at once:

1. Go to **Contacts → Import Contacts**.
2. Download the **sample file** by clicking the template link — this shows you the correct format.
3. Fill in your contacts using the same column layout as the sample.
4. Save your file as **.csv** or **.xlsx** format.
5. Click **Browse** and select your file.
6. Click **Submit** to start the import.
7. The system will show a summary of how many contacts were imported.

📸 *[Screenshot: The import contacts page with the file upload area]*

> ⚠️ **Important:** Make sure your file matches the template format exactly. Extra columns or wrong headers may cause errors.

---

## Managing Customer Groups

Customer groups let you organise customers into categories (e.g., "Wholesale", "Retail", "VIP") and offer group-specific pricing.

### How to Create a Customer Group

1. Go to **Contacts → Customer Groups**.
2. Click **Add** at the top right.
3. Enter:
   - **Group Name** — e.g., "Wholesale Buyers"
   - **Calculation Percentage** — A discount percentage for this group (e.g., 10% off for wholesale)
4. Click **Save**.

📸 *[Screenshot: The Add Customer Group form]*

### How to Assign a Customer to a Group

1. Edit the customer's contact details.
2. Look for the **Customer Group** field.
3. Select the appropriate group from the list.
4. Click **Update**.

---

## Contact Map

If your contacts have addresses, you can view them on a map:

1. Go to **Contacts → Contact Map**.
2. You'll see pins on the map for each contact with a valid address.
3. Click any pin to see the contact's name and details.

📸 *[Screenshot: The contact map view with location pins]*

---

## Settings & Options

| Setting | What It Does | Where to Find It |
|---|---|---|
| **Contact ID Prefix** | Sets a prefix for auto-generated contact IDs (e.g., "CU" → CU0001) | **Settings → Business Settings → Prefixes** |
| **Credit Limit** | Maximum amount a customer can owe you before the system warns you | Set per contact when editing |
| **Pay Terms** | Default payment terms for new contacts | Set per contact or in Business Settings |
| **Custom Fields** | Extra fields to track additional information | **Settings → Business Settings → Custom Labels** |

---

## Common Questions

**Q: Can I delete a contact?**
A: You can only delete contacts that don't have any transactions. If a contact has transactions, you can make them inactive instead.

**Q: How do I find a contact quickly?**
A: Use the search bar at the top of the contacts list. You can search by name, phone number, or contact ID.

**Q: What does "Opening Balance" mean?**
A: This is the amount a contact owed you (or you owed them) from before you started using {application_name}. It helps you track your complete payment history.

**Q: Can I export my contacts list?**
A: Yes! Look for the **Export** buttons (CSV, Excel, PDF, Print) above the contacts table.

---

## Tips & Best Practices

- 📌 Always enter an email address — it's needed for sending invoices and notifications
- 📌 Use **Customer Groups** to easily apply wholesale vs. retail pricing
- 📌 Set **Credit Limits** to prevent over-selling on credit
- 📌 Review the **Ledger** regularly to follow up on overdue payments
- 📌 Import contacts from a spreadsheet when first setting up — it saves hours of manual entry