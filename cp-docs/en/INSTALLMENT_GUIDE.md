# Installment Module — Complete User Guide

The Installment module lets you sell products on credit by splitting the total amount into multiple scheduled payments. Whether your customer wants to pay in weekly, monthly, or yearly installments, this module handles everything — from calculating interest to tracking payments and sending reminders.

---

## What You'll Learn

- How to set up installment plan templates (systems)
- How to create an installment plan for a sale
- How to collect installment payments
- How to use the installment dashboard
- How to handle partial payments, bulk payments, and early settlement
- How to view installment reports
- How to configure grace periods and late fines
- How to set up automated payment reminders

---

## Part 1: Setting Up Installment Plans (Systems)

Before you can sell on installments, you need to create **Installment Plan Templates** (called "Systems"). These templates define the rules — how many payments, how often, what interest rate, and what happens if a customer pays late.

### How to Create an Installment Plan Template

1. Go to **Installment → Installment Plans** from the left sidebar.
2. Click the **Add** button at the top right.
3. A form will appear. Fill in the following:

   - **Plan Name** — Give the plan a clear name (e.g., "12 Month Plan", "Weekly Payment Plan")
   - **Number of Installments** — How many payments the customer will make (e.g., 6, 12, 24)
   - **Payment Period** — How much time between each payment (e.g., 1)
   - **Period Type** — The unit for the payment period: **Days**, **Months**, or **Years**
   - **Interest Rate (%)** — The interest rate to charge. Enter 0 for interest-free plans
   - **Interest Type** — Choose how interest is calculated:
     - **Simple Interest** — Interest is calculated on the original amount only. This means you pay the same interest every period.
     - **Compound Interest** — Interest is calculated on the total amount so far (including previously added interest). This results in slightly higher total payments.
   - **Late Fine (%)** — The penalty percentage charged when a payment is overdue
   - **Late Fine Type** — Whether the late fine is **Fixed** or calculated per period
   - **Grace Period (Days)** — The number of days after the due date before late fines start. Set to 0 for no grace period
   - **Early Settlement Discount (%)** — The discount given to customers who pay off all remaining installments early. Set to 0 for no discount
   - **Description** — Optional notes about this plan

4. Click **Save**.

📸 *[Screenshot: The Add Installment Plan form showing all fields including grace period and early settlement discount]*

> 💡 **Tip:** Create multiple plan templates for different scenarios — for example, a "3 Month Interest-Free" plan, a "12 Month Standard" plan, and a "24 Month Extended" plan.

---

### How to Edit an Installment Plan Template

1. Go to **Installment → Installment Plans**.
2. Find the plan you want to edit.
3. Click the **Edit** button (pencil icon) in the Actions column.
4. Update any fields you need to change.
5. Click **Update**.

📸 *[Screenshot: The Edit Installment Plan form with existing data]*

> ⚠️ **Warning:** Editing a plan template only affects **future** installments created with that plan. Existing installment agreements are not affected.

---

### How to Delete an Installment Plan Template

1. Go to **Installment → Installment Plans**.
2. Find the plan you want to remove.
3. Click the **Delete** button (trash icon) in the Actions column.
4. Confirm the deletion.

> ⚠️ **Warning:** Only delete a plan if no active installments are using it.

---

## Part 2: Creating an Installment for a Sale

When a customer wants to buy on installments, you create the installment agreement directly from their sale invoice.

### How to Add an Installment Plan to a Sale

1. First, make a sale as normal through **POS** or **Add Sale**.
2. Go to **Installment → Customer Installments** from the left sidebar.
3. Find the customer and locate their sale invoice.
4. Click the **Add Installment** button next to the invoice.
5. A form appears showing:
   - **Client Name** — The customer's name (auto-filled)
   - **Total Bill** — The total sale amount (auto-filled, read-only)
   - **Total Paid** — Amount already paid (auto-filled, read-only)
   - **Payment Due** — The remaining amount to be financed (auto-filled, read-only)

6. Select an **Installment Plan** from the dropdown (this loads the plan template you created earlier).
7. The following fields auto-fill from the selected plan:
   - **Number of Installments**
   - **Payment Period** and **Type**
   - **Interest Rate** and **Type**
   - **Late Fine Rate** and **Type**

8. Set the **First Payment Date** — when the first installment is due.
9. Optionally select a **Payment Account** — the bank/cash account where payments will go.
10. Add any **Notes** about the agreement.

11. The system automatically calculates and shows:
    - **Installment Amount** — How much each payment will be
    - **Total with Interest** — The total amount including interest
    - **A preview table** showing every installment with its due date and amount

12. Review the details and click **Save**.

📸 *[Screenshot: The Add Installment form with a sale invoice, showing the calculated installment breakdown]*

> 💡 **Tip:** The system rounds the last installment automatically to avoid tiny rounding differences. For example, if the total is $1,000 split into 3 payments, the first two might be $333.33 and the last one $333.34.

---

### Understanding Interest Calculations

**Simple Interest Example:**
- Sale amount: $1,000
- Interest rate: 12% per year
- 12 monthly installments
- Total interest = $1,000 × 12% × 1 year = $120
- Total to pay = $1,120
- Monthly payment = $93.33

**Compound Interest Example:**
- Sale amount: $1,000
- Interest rate: 12% per year
- 12 monthly installments
- Rate per month = 12% ÷ 12 = 1%
- Total = $1,000 × (1.01)^12 = $1,126.83
- Monthly payment = $93.90

> 💡 **Tip:** Simple interest is more common for short-term plans (3–6 months). Compound interest is typically used for longer-term plans (12+ months).

---

## Part 3: Collecting Installment Payments

When a customer comes to make a payment, you record it through the installment system.

### How to Record a Payment

1. Go to **Installment → Installment Reports** from the left sidebar.
2. Find the customer's installment using the **Customer** dropdown filter.
3. You'll see a table showing all installments with columns for:
   - **Installment Number**
   - **Due Date**
   - **Amount Due**
   - **Status** (Paid / Due / Overdue)
4. Click the **Collect** button (money icon) next to the installment you want to record payment for.

5. The **Payment Form** appears showing:
   - **Installment Amount** — The amount due
   - **Interest Amount** — The interest component
   - **Late Fine** — Any late fine (calculated automatically based on days overdue and grace period)
   - **Total Payment** — The total amount the customer needs to pay
   - **Payment Method** — Choose: Cash, Card, Cheque, Bank Transfer, or Other
   - **Payment Account** — Select the destination account
   - **Payment Note** — Optional notes

6. If the plan has a **Grace Period**, you'll see a message like: *"Grace period: 5 days (late fines apply after grace period)"*

7. Click **Save** to record the payment.

📸 *[Screenshot: The payment collection form showing amount breakdown with late fine and payment method]*

> 💡 **Tip:** The payment note automatically includes a breakdown: "Principal: $83.33, Interest: $10.00, Late Fine: $5.00" — useful for accounting records.

---

### Understanding Late Fines

Late fines are calculated automatically when a customer pays after the due date:

1. The system checks the **due date** against today's date.
2. If a **Grace Period** is set (e.g., 5 days), late fines only start after the grace period expires.
3. The late fine is calculated based on the **Late Fine Rate** and **Late Fine Type** set in the plan template.

**Example:** Due date is January 1, grace period is 3 days, late fine is 2%.
- Paying on January 3: No fine (within grace period)
- Paying on January 5: Fine calculated for 2 days (5 - 3 = 2 days late)

---

### Payment Status Colours

| Colour | Status | Meaning |
|---|---|---|
| 🟢 **Green** | Paid | Payment has been collected |
| 🟡 **Yellow** | Due | Payment is due but not yet late |
| 🔴 **Red** | Overdue | Payment is past its due date |

---

## Part 4: Installment Dashboard

The dashboard gives you a complete overview of all installment activity at a glance.

### How to Access the Dashboard

1. Go to **Installment → Dashboard** from the left sidebar.
2. You'll see the following sections:

**Summary Cards (Row 1):**
- **Active Plans** — Number of installment agreements currently running
- **Completed Plans** — Number of fully paid-off agreements
- **Paid Installments** — Total number of individual payments received
- **Unpaid Installments** — Total number of payments still pending

**Alert Cards (Row 2):**
- **Due Within 7 Days** — Payments coming up in the next week
- **Overdue Installments** — Payments that are past their due date

**Financial Summary (Row 3):**
- **Total Expected** — Total amount expected from all plans
- **Total Collected** — Total amount actually received
- **Overdue Amount** — Total unpaid amount past due date
- **Total Late Fines** — Total late fine charges accrued
- **Today's Collections** — Payments received today
- **This Month's Collections** — Payments received this calendar month
- **Collection Rate** — Percentage of expected payments that have been collected

**Plans Overview Table:**
- Shows all active plans with customer name, total amount, payments made, and progress

**Quick Actions Panel:**
- Direct links to create new plans, view reports, and manage settlements

📸 *[Screenshot: The Installment Dashboard showing summary cards, financial stats, and collection progress]*

> 💡 **Tip:** Check the dashboard daily to see which payments are coming due and which are overdue. This helps you follow up with customers promptly.

---

## Part 5: Advanced Payment Features

### How to Make a Partial Payment

If a customer can't pay the full installment amount, you can record a partial payment:

1. Go to the installment's payment form.
2. Instead of paying the full amount, the system allows recording a **partial amount**.
3. Enter the amount the customer is paying.
4. Click **Save**.
5. The partial amount is tracked against the installment.
6. When partial payments add up to the full installment amount, the installment is automatically marked as **Paid**.

> 💡 **Tip:** Partial payments are useful for customers facing temporary financial difficulties. The system keeps track of all partial amounts.

---

### How to Process a Bulk Payment

When a customer wants to pay multiple installments at once:

1. Go to **Installment → Installment Reports**.
2. Find the customer and click the **Bulk Payment** button.
3. A page appears listing all **unpaid installments** with checkboxes.
4. **Select** the installments you want to pay:
   - Click individual checkboxes, OR
   - Click **Select All** to choose all unpaid installments
5. The **Selected Total** updates automatically as you tick boxes.
6. Choose a **Payment Method** and **Payment Account**.
7. Click **Pay Selected**.
8. Confirm the bulk payment in the popup.
9. All selected installments are marked as paid in one transaction.

📸 *[Screenshot: The Bulk Payment page with multiple installments selected and the total showing]*

> 💡 **Tip:** Bulk payment is perfect for customers who've missed several payments and want to catch up in one go.

---

### How to Process an Early Settlement

If a customer wants to pay off all remaining installments at once (with an optional discount):

1. Go to the customer's installment plan in **Installment Reports**.
2. Click the **Early Settlement** button.
3. The **Settlement Calculator** appears showing:
   - **Customer Name** and plan details
   - **Remaining Installments** — How many payments are left
   - **Remaining Principal** — The outstanding principal amount
   - **Remaining Interest** — The outstanding interest amount
   - **Discount** — The early settlement discount (if configured in the plan template)
   - **Settlement Amount** — The final amount after discount

4. Choose a **Payment Method** and **Payment Account**.
5. Click **Confirm Settlement**.
6. Confirm in the popup: "Are you sure you want to process early settlement?"
7. All remaining installments are marked as paid, and the plan is marked as **Completed**.

📸 *[Screenshot: The Early Settlement calculator showing remaining amount, discount, and final settlement amount]*

**Example:** Customer has 6 remaining installments totalling $600 with 5% early settlement discount.
- Discount = $600 × 5% = $30
- Settlement amount = $600 − $30 = $570

> 💡 **Tip:** Early settlement discounts encourage customers to pay off their balance sooner, improving your cash flow.

---

## Part 6: Installment Reports

### How to View and Filter Reports

1. Go to **Installment → Installment Reports** from the left sidebar.
2. Use the filters to narrow down results:

   - **Customer** — Select a specific customer or view all
   - **Status** — Filter by payment status:
     - **All** — Show everything
     - **Paid** — Only completed payments
     - **Due** — Only upcoming payments
     - **Late** — Only overdue payments
   - **Date Range From / To** — Filter installments by due date range

3. The report table shows:
   - **Customer Name**
   - **Installment Number**
   - **Due Date**
   - **Installment Amount** (Principal)
   - **Interest Amount**
   - **Late Fine**
   - **Total Amount**
   - **Payment Status** (with colour coding)
   - **Actions** (Collect, Bulk Pay, Early Settle)

4. The **Total Money Owed** field at the top shows the total outstanding balance for the selected customer.

📸 *[Screenshot: The Installment Reports page with filters applied showing a mix of paid, due, and overdue items]*

---

### How to Print or Export Reports

1. Use the built-in DataTable buttons above the report table:
   - **Copy** — Copy table data to clipboard
   - **Excel** — Download as Excel file
   - **CSV** — Download as CSV file
   - **PDF** — Download as PDF
   - **Print** — Print the report
   - **Column Visibility** — Show/hide specific columns

📸 *[Screenshot: The export buttons above the report table]*

---

## Part 7: Automated Payment Reminders

The system can automatically send reminders to customers about upcoming and overdue payments.

### How Reminders Work

- **Upcoming Reminders** — Sent to customers when a payment is due within the next few days
- **Overdue Reminders** — Sent on the first day a payment is late, and then every 7 days it remains unpaid
- **Payment Confirmations** — Sent when a payment is successfully recorded

### How to Set Up Automated Reminders

To enable automated reminders, ask your system administrator to set up a daily scheduled task on the server. The administrator can configure how many days in advance reminders are sent (the default is 3 days before a payment is due).

Once set up, reminders will be sent automatically every day without any action needed from you.

> 💡 **Tip:** Automated reminders significantly reduce late payments. Most customers simply forget — a friendly reminder brings them in on time.

---

## Part 8: User Permissions

The Installment module has granular permissions to control who can do what:

| Permission | What It Allows |
|---|---|
| **Installment Show** | View installment data, reports, and dashboard |
| **Add Installment** | Create new installment plans for sales |
| **Edit Installment** | Modify existing installment details |
| **Delete Installment** | Remove installment records |
| **Installment Collection** | Record payments against installments |
| **Delete Collection** | Remove recorded payments |
| **Add System** | Create new installment plan templates |
| **Edit System** | Modify existing plan templates |
| **Delete System** | Remove plan templates |

### How to Set Permissions

1. Go to **User Management → Roles** from the left sidebar.
2. Click **Edit** on the role you want to configure.
3. Scroll down to the **Installment** section.
4. Check the boxes for the permissions you want to grant.
5. Click **Update**.

📸 *[Screenshot: The Roles page showing Installment permission checkboxes]*

> 💡 **Tip:** For cashiers, typically enable "Installment Show" and "Installment Collection" only. Reserve "Add System" and "Delete" permissions for managers.

---

## Part 9: Grace Period & Late Fines — Best Practices

### What is a Grace Period?

A grace period is a set number of days **after** the due date during which no late fine is charged. This protects customers from being penalised for minor delays (like weekends or bank processing time).

**Example Setup:**
| Plan | Grace Period | Late Fine | Effect |
|---|---|---|---|
| Standard Plan | 0 days | 2% | Fine starts immediately after due date |
| Flexible Plan | 5 days | 1.5% | Customer has 5 extra days before fines apply |
| Premium Plan | 10 days | 1% | 10-day buffer with lower penalty |

### Recommended Settings

| Business Type | Grace Period | Late Fine | Early Settlement Discount |
|---|---|---|---|
| **Retail / Electronics** | 3–5 days | 1–2% | 2–5% |
| **Furniture / Appliances** | 5–7 days | 1.5–3% | 3–5% |
| **Vehicles / High Value** | 7–10 days | 2–5% | 5–10% |
| **Interest-Free Plans** | 0–3 days | 2–3% | 0% |

---

## Common Questions

**Q: Can I create an installment plan for any sale?**
A: Yes, you can create an installment plan for any sale invoice, whether it was made through POS or Direct Sale.

**Q: What happens if a customer misses a payment?**
A: The installment shows as **Overdue** (red) in the reports. If a late fine is configured, it's automatically calculated when the customer eventually pays. Automated reminders can be sent to notify them.

**Q: Can I change the due dates after creating a plan?**
A: Individual due dates cannot be changed after creation. If you need different dates, delete the plan and create a new one.

**Q: What happens when all installments are paid?**
A: The plan is automatically marked as **Completed**. It appears in the "Completed Plans" count on the dashboard.

**Q: Can a customer pay more than one installment at a time?**
A: Yes! Use the **Bulk Payment** feature to pay multiple installments in one transaction. Or use **Early Settlement** to pay everything at once with a possible discount.

**Q: Does the system handle interest-free installment plans?**
A: Yes. Simply set the **Interest Rate** to 0% when creating the plan template. Only the principal amount will be split across payments.

**Q: Can I run installments for suppliers too?**
A: Yes, the module includes a **Supplier Installments** section for managing installments on purchases.

**Q: Where do installment payments show in my accounts?**
A: Each payment creates a **Transaction Payment** record and (if an account is selected) an **Account Transaction** entry. Payments appear in your Payment Accounts and accounting reports.

**Q: What is the difference between Simple and Compound Interest?**
A: **Simple Interest** calculates interest only on the original amount. **Compound Interest** calculates interest on the accumulated total (interest on interest). Compound interest results in a slightly higher total payment.

**Q: How does the early settlement discount work?**
A: When a customer wants to pay off all remaining installments at once, the system calculates the total remaining amount and applies the discount percentage. For example, $500 remaining with 5% discount = $475 settlement amount.

---

## Tips & Best Practices

- 📌 **Start with plan templates** — Set up your common installment plans before making your first credit sale
- 📌 **Use grace periods wisely** — A 3–5 day grace period reduces customer complaints while still encouraging timely payment
- 📌 **Check the dashboard daily** — The dashboard shows you exactly what's due today and what's overdue
- 📌 **Set up reminders** — Automated reminders dramatically reduce late payments
- 📌 **Offer early settlement discounts** — A small discount encourages customers to pay off faster, improving your cash flow
- 📌 **Use bulk payment for catch-ups** — When a customer comes to pay multiple missed installments, bulk payment saves time
- 📌 **Keep interest fair** — Compare your rates with local market rates to stay competitive
- 📌 **Match permissions to roles** — Cashiers should collect payments; only managers should create or delete plans
- 📌 **Review reports weekly** — Regular review helps catch overdue accounts before they become problems
- 📌 **Use payment accounts** — Always link payments to a payment account for accurate financial tracking

---

## Quick Reference

| Task | Where to Go |
|---|---|
| Create a plan template | **Installment → Installment Plans → Add** |
| View all plan templates | **Installment → Installment Plans** |
| Create installment for a sale | **Installment → Customer Installments → Add Installment** |
| Collect a payment | **Installment → Installment Reports → Collect** |
| View dashboard | **Installment → Dashboard** |
| Bulk pay multiple installments | **Installment → Installment Reports → Bulk Payment** |
| Settle early | **Installment → Installment Reports → Early Settlement** |
| Filter reports | **Installment → Installment Reports** (use filters) |
| Set permissions | **User Management → Roles → Edit → Installment section** |
| Configure reminders | Ask your system administrator to set up automated reminders |

---

## Glossary

| Term | Definition |
|---|---|
| **Installment Plan Template (System)** | A reusable template that defines the rules for installment agreements |
| **Installment Plan (Agreement)** | An actual installment agreement created for a specific sale |
| **Installment** | A single scheduled payment within a plan |
| **Principal** | The original sale amount being financed |
| **Interest** | The additional amount charged for paying in installments |
| **Simple Interest** | Interest calculated only on the original principal amount |
| **Compound Interest** | Interest calculated on the accumulated amount (principal + accrued interest) |
| **Grace Period** | Days after due date before late fines apply |
| **Late Fine** | Penalty charged on overdue payments |
| **Early Settlement** | Paying off all remaining installments at once, often with a discount |
| **Bulk Payment** | Paying multiple installments in a single transaction |
| **Partial Payment** | Paying less than the full installment amount |
| **Collection Rate** | Percentage of expected payments that have been collected |
