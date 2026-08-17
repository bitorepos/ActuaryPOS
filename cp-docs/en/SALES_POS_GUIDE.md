# Sales & POS (Point of Sale)

Sales are how your business earns money. {application_name} gives you two ways to sell: the fast **POS Screen** for counter sales, and the detailed **Direct Sale** form for more complex transactions. This guide covers both.

---

## What You'll Learn

- How to make a sale using the POS screen
- How to make a direct sale
- How to manage quotations and sales orders
- How to process returns and refunds
- How to handle discounts and promotions
- How to manage the cash register

---

## Part 1: POS (Point of Sale) — Quick Counter Sales

The POS screen is designed for fast, face-to-face sales — like at a shop counter or restaurant.

### How to Make a POS Sale

1. Go to **POS Sale → POS Sale** from the left sidebar.
2. The POS screen opens with:
   - A **Search Bar** at the top to find products
   - **Product Suggestions** on the right (if enabled)
   - A **Cart** on the left showing added items

3. **Add products** to the cart:
   - Type the product name in the search bar and click the result, OR
   - Scan a barcode with your scanner, OR
   - Click a product from the suggestion grid

4. **Adjust quantities**: Click the quantity number to change it, or use the + / − buttons.

5. **Apply discounts** (optional): Click the discount icon next to an item to add a per-item discount.

6. Click the **Pay** button (or press the keyboard shortcut).

7. The **Payment Screen** appears:
   - Enter the **Amount Received** from the customer
   - Choose the **Payment Method**: Cash, Card, Cheque, Bank Transfer, Custom
   - The system shows the **Change Due** automatically
   - Add a **Payment Note** if needed

8. Click **Finalise** to complete the sale.

9. The **Receipt** appears:
   - Click **Print** to print the receipt
   - Click **Email** to send it to the customer
   - Click **New Sale** to start the next transaction

📸 *[Screenshot: The POS screen with products in cart and the Pay button highlighted]*

📸 *[Screenshot: The payment popup showing amount received, change due, and payment method]*

---

### POS Keyboard Shortcuts

Speed up your work with these shortcuts:

| Shortcut | Action |
|---|---|
| `F2` | Open the payment screen |
| `F4` | Cancel the current sale |
| `F5` | Hold / Suspend the sale |
| `F7` | Add a new customer |
| `F9` | Quick add product |
| `Ctrl + P` | Print last receipt |

> 💡 **Tip:** These shortcuts can be customised in **Settings → Business Settings → POS Sale → Keyboard Shortcuts**.

---

### How to Suspend and Resume a Sale

If a customer needs to step away:

1. During a sale, click **Suspend** (or press `F5`).
2. The sale is saved as a draft.
3. To resume, go to **POS Sale → List Drafts**.
4. Click **Resume** on the suspended sale.
5. Continue where you left off.

📸 *[Screenshot: The Drafts list with the Resume button]*

---

### How to Open and Close the Cash Register

**Opening the Register:**
1. When you start the POS, you'll be asked to **Open Register** if one isn't already open.
2. Enter the **Opening Cash Amount** — the money already in the drawer.
3. Click **Open Register**.

**Closing the Register:**
1. Click the **Close Register** button on the POS screen.
2. Count your cash and enter the **Closing Amount**.
3. The system compares your count with what it expects.
4. Review any differences.
5. Click **Close Register** to finish your shift.

📸 *[Screenshot: The Close Register screen showing expected vs. actual cash amounts]*

---

## Part 2: Direct Sales — Detailed Sales

The direct sale form gives you more control for invoices, shipments, and detailed transactions.

### How to Create a Direct Sale

1. Go to **Sale → Add Sale** from the left sidebar.
2. Fill in:
   - **Customer** — Choose or search for a customer
   - **Business Location** — Which shop/warehouse
   - **Sale Date** — When the sale was made
   - **Invoice Number** — Auto-generated
3. Add products by searching or scanning.
4. For each product, set:
   - **Quantity**
   - **Unit Price** — Can override the default
   - **Discount** — Per-item discount
   - **Tax** — Per-item tax
5. Add any **overall discount** or **shipping charges**.
6. In the **Payment** section, enter payment details.
7. Click **Save** to record the sale.

📸 *[Screenshot: The direct sale form with customer, products, and payment sections]*

---

## Quotations

A quotation is a price estimate you give to a customer before they decide to buy.

### How to Create a Quotation

1. Go to **Sale → Add Quotation**.
2. Fill out the form just like a sale, but the status will be "Quotation".
3. Click **Save**.

### How to Convert a Quotation to a Sale

1. Go to **Sale → List Quotations**.
2. Find the quotation and click **Actions → Convert to Sale**.
3. Review and adjust if needed.
4. Click **Save** to finalise the sale.

📸 *[Screenshot: The quotation list with Actions → Convert to Sale option]*

---

## Sales Orders

Sales orders track confirmed orders that haven't been delivered yet.

1. Go to **Sale → Sales Orders** to view all orders.
2. Click **Add Sale** and set the sale type to **Sales Order**.
3. Once you deliver the products, mark the order as **Completed**.

📸 *[Screenshot: The Sales Orders list with status indicators]*

---

## Sell Returns & Refunds

When a customer returns a product:

1. Go to **Sale → List Sell Returns** (or find the sale and click **Actions → Return**).
2. Click **Add** to create a new return.
3. Select the original sale.
4. Enter the quantity being returned for each product.
5. Choose how to refund:
   - **Cash** refund
   - **Credit** to the customer's account
6. Click **Save**.

Stock will be restored and the customer's balance will be updated.

📸 *[Screenshot: The sell return form showing items being returned]*

---

## Discounts & Promotions

### Per-Item Discount
- While creating a sale, click the **Discount** field next to any product and enter a percentage or fixed amount.

### Overall Discount
- At the bottom of the sale form, find the **Order Discount** field and enter the overall discount.

### Managed Discounts
1. Go to **POS Sale → Discounts** (or **Sale → Discounts**).
2. Create a discount with:
   - **Name** — e.g., "Summer Sale 10%"
   - **Discount Type** — Percentage or Fixed
   - **Amount** — The discount value
   - **Start Date** and **End Date** — When the discount is active
   - **Priority** and **Applicable Products** — Fine-tune which products qualify
3. Click **Save**. The discount applies automatically.

📸 *[Screenshot: The Discounts list and Add Discount form]*

---

## Shipments

Track deliveries for your sales:

1. Go to **Sale → Shipments**.
2. View all pending and completed shipments.
3. Update the shipping status as orders are delivered.

📸 *[Screenshot: The Shipments page with status tracking]*

---

## Settings & Options

| Setting | What It Does | Where to Find It |
|---|---|---|
| **POS Interface** | Choose Simple, Product Suggestion, or Quick Button layout | **Settings → Business Settings → POS Sale** |
| **Default Customer** | The customer used for walk-in sales | **Settings → Business Settings → POS Sale** |
| **Require Customer** | Force staff to select a customer for every sale | **Settings → Business Settings → POS Sale** |
| **Sale Prefix** | Prefix for sale invoice numbers (e.g., "INV") | **Settings → Business Settings → Prefixes** |
| **Enable Sales Orders** | Show/hide the Sales Orders feature | **Settings → Business Settings → Sale** |
| **Enable Quotations** | Show/hide the Quotations feature | **Settings → Business Settings → Sale** |
| **Enable Shipping** | Show/hide shipping fields on sales | **Settings → Business Settings → Sale** |
| **Sale Price Tax** | Whether selling prices include tax or not | **Settings → Business Settings → Sale** |

---

## Common Questions

**Q: Can I edit a sale after it's been recorded?**
A: Yes, if your administrator has allowed it. Go to the sale and click **Actions → Edit**. Changes are only allowed within the number of days set in **Transaction Edit Days** setting.

**Q: How do I reprint a receipt?**
A: Go to the sale in the list, click **Actions → Print Invoice**. You can also use `Ctrl + P` on the POS right after a sale.

**Q: Can a customer pay with multiple methods?**
A: Yes! On the payment screen, add multiple payment rows — for example, part cash and part card.

**Q: What's the difference between POS and Direct Sale?**
A: POS is designed for fast counter sales with a visual interface. Direct Sale is a form-based option for detailed invoicing and complex transactions. Both record sales the same way.

---

## Tips & Best Practices

- 📌 Use the **POS screen** for quick retail sales and the **Direct Sale** for wholesale or invoice-based sales
- 📌 Open and close your **Cash Register** at the start and end of every shift
- 📌 Use **Quotations** to give customers price estimates before they commit
- 📌 Set up **keyboard shortcuts** to speed up POS operations
- 📌 Train your staff on the **POS screen** — it's designed to be quick and easy