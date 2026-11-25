# Restaurant Features

If your business serves food or beverages, {application_name} includes a full set of restaurant features: **table management**, **kitchen orders**, **service staff**, **bookings**, **modifiers**, and more.

> 💡 These features are available when the **Restaurant Module** is enabled. If you don't see them, ask your administrator to turn on the Restaurant module in **Business Settings → Modules**.

---

## What You'll Learn

- How to set up and manage tables
- How to use kitchen orders & the Kitchen Display
- How to assign service staff (waiters)
- How to manage bookings / reservations
- How to add modifiers (extras, add-ons)
- How to use Types of Service

---

## Mobile Take Away checkout and workstation printing

1. In **User Security → Security Roles**, edit the cashier's role. Under **POS → Payment Buttons**, tick **Hide Cash Button**, **Hide Card Button**, **Hide Multipay Button**, and **Hide Credit Sale Button**. Leave **Hide Takeaway Button** unticked and enable Take Away for the POS location.
2. On the updated mobile app, sign in as the cashier. At checkout, choose a payment method in the dropdown and tap **Take Away**. **Finalize and Share** and **Finalize and Print** are hidden for this role.
3. For workstation printing, pair the app with the Windows Hardware Service and configure the receipt and kitchen printer destinations. With bill and KOT printing enabled, a Take Away sale sends both jobs. Placing an order on a table sends the KOT.
4. On the workstation, open **Offline Sync → Download → Invoice Settings** to download the invoice layout and its logo, footer logo, and letterhead. When the app can reach the workstation invoice, the bill uses its configured receipt design and font. If the invoice is unavailable, the app can use its local receipt template. The KOT uses the kitchen ticket layout.

### Workstation synchronization

- To download the table catalog, open **Offline Sync → Download → Tables**. If the cloud returns **403**, verify **Access tables** and Connector API access for the cloud account used by the workstation's sync token. The download includes occupied tables in that account's permitted locations.
- On the workstation, leave the offline **POS** page open for automatic sales uploads every **10 minutes** and settings downloads every **30 minutes**. Use **Offline Sync** to run a manual sync when needed.

## 1. Table Management

Tables help you organise your dine-in orders. Each table can be linked to a sale.

### How to Add a Table

1. Go to **Restaurant** → **Tables** from the left sidebar.
2. Click **+ Add Table**.
3. Enter the **Table Number** or **Table Name** (e.g. "T1", "Patio 3").
4. Optionally set a **Description** (e.g. "Near window, seats 4").
5. Click **Save**.

📸 *[Screenshot: The Add Table form with number and description fields]*

### How to Edit or Remove a Table

1. Go to **Restaurant** → **Tables**.
2. Click the **Edit** (pencil) button next to the table you want to change.
3. Make your changes and click **Update**.
4. To delete, click the **Delete** (trash) button and confirm.

📸 *[Screenshot: The tables list with edit and delete buttons]*

### Using Tables at POS

1. Open the **POS** screen.
2. Before scanning items, select a **Table** from the table dropdown.
3. The order is now linked to that table.
4. When the order is complete, the table becomes available again.

📸 *[Screenshot: POS screen with the table dropdown highlighted]*

---

## 2. Kitchen Orders & Kitchen Display

The kitchen display shows chefs what to prepare, in real time.

### How It Works

1. A cashier creates an order on the POS screen.
2. The order appears on the **Kitchen** screen automatically.
3. The kitchen staff prepares the food.
4. Once done, they mark the order as **Ready** on the kitchen screen.
5. The waiter/cashier sees the order is ready and serves the customer.

### How to Open the Kitchen Display

1. Go to **Restaurant** → **Kitchen** from the left sidebar.
2. You'll see all pending orders displayed as cards.
3. Each card shows the table number, items, and any special notes.

📸 *[Screenshot: The Kitchen Display showing pending order cards]*

### How to Mark an Order as Ready

1. On the Kitchen Display, find the order card.
2. Click the **Mark as Ready** (or **Complete**) button.
3. The card moves to the "Ready" section or disappears.

📸 *[Screenshot: Clicking the Mark as Ready button on an order card]*

---

## 3. Service Staff (Waiters)

You can assign **service staff** to tables and orders. This helps track who served which customer (useful for tips and performance).

### How to Add Service Staff

1. Go to **Restaurant** → **Service Staff** from the left sidebar.
2. Click **+ Add**.
3. Select an existing **User** from the list (they must already have a user account).
4. Click **Save**.

📸 *[Screenshot: The Add Service Staff form]*

### How to Assign Service Staff to a Sale

1. Open the **POS** screen.
2. Select a **Service Staff** (waiter) from the dropdown.
3. Complete the sale as normal.
4. The sale record will show which staff member served the order.

📸 *[Screenshot: POS screen with the Service Staff dropdown]*

---

## 4. Bookings / Reservations

Manage future reservations so you can plan your seating.

### How to Create a Booking

1. Go to **Restaurant** → **Bookings** from the left sidebar.
2. Click **+ Add Booking**.
3. Fill in the details:
   - **Customer Name** — who the booking is for
   - **Contact Number** — their phone number
   - **Date & Time** — when they're arriving
   - **Number of Guests** — how many people
   - **Table** — which table to reserve (optional)
   - **Notes** — any special requests
4. Click **Save**.

📸 *[Screenshot: The Add Booking form with all fields]*

### How to View and Manage Bookings

1. Go to **Restaurant** → **Bookings**.
2. You'll see a list of all upcoming bookings.
3. Use the **Edit** button to change details.
4. Use the **Delete** button to cancel a booking.

📸 *[Screenshot: The bookings list with date, customer, and table columns]*

---

## 5. Modifiers (Extras & Add-ons)

Modifiers let you add extras to menu items — for example, "Extra Cheese", "No Onions", or "Large Size".

### How to Create a Modifier Set

1. Go to **Restaurant** → **Modifiers** from the left sidebar.
2. Click **+ Add Modifier Set**.
3. Enter a **Name** for the set (e.g. "Pizza Toppings").
4. Add individual modifiers:
   - **Modifier Name** (e.g. "Extra Cheese")
   - **Price** (e.g. 50.00) — leave blank or 0 if no extra charge
5. Add as many modifiers as needed.
6. Click **Save**.

📸 *[Screenshot: The Add Modifier Set form with modifier rows]*

### How to Link a Modifier Set to a Product

1. Go to **Products** → find the product you want (e.g. "Margherita Pizza").
2. Click **Edit**.
3. In the **Modifier Sets** section, select the modifier set(s) to attach.
4. Click **Update**.

📸 *[Screenshot: Product edit form with the Modifier Sets section]*

### How Modifiers Appear at POS

1. When scanning the product at POS, a popup asks which modifiers to apply.
2. Select the modifiers the customer wants.
3. The price adjusts automatically based on your modifier prices.

📸 *[Screenshot: POS modifier popup when adding a product with modifiers]*

---

## 6. Types of Service

Types of Service lets you categorise orders — for example, **Dine In**, **Take Away**, **Home Delivery**.

### How to Create a Type of Service

1. Go to **Types of Service** from the left sidebar (or **Restaurant** → **Types of Service**).
2. Click **+ Add**.
3. Enter a **Name** (e.g. "Dine In").
4. Optionally set:
   - **Description**
   - **Packing Charge** — extra fee for takeaway/delivery packaging
   - **Packing Charge Type** — fixed amount or percentage
5. Click **Save**.

📸 *[Screenshot: The Add Type of Service form]*

### How to Select a Type of Service at POS

1. Open the **POS** screen.
2. Select the **Type of Service** from the dropdown at the top.
3. Any packing charges are added automatically to the total.
4. Complete the sale as normal.

📸 *[Screenshot: POS screen with the Type of Service dropdown highlighted]*

---

## 7. Quick Menu

The Quick Menu displays your most popular items as easy-to-tap buttons on the POS screen — perfect for fast-paced environments.

### How to Set Up Quick Menu

1. Go to **Restaurant** → **Quick Menu** from the left sidebar.
2. Add items by selecting products from your catalogue.
3. Arrange them in the order you want them to appear.
4. Items will appear as buttons on the POS screen for quick selection.

📸 *[Screenshot: The Quick Menu setup page]*

---

## Mobile Table Orders and Offline Use

Android cashiers with **Access tables** can create and work with table orders from Mobile POS. The mobile table list shows only the orders owned by the signed-in cashier.

### Table order status and order

The table-order list groups work in this practical order:

1. **Running** — an order has been placed and remains open.
2. **Bill Printed** — a browser POS user printed the table bill.
3. **Checkout** — the table has been settled.

Each table line shows its table name and outstanding total. Sale-history entries for a table draft also identify the table, so cashiers can distinguish a normal draft from a table order.

### Offline use

Before a device goes offline, run the relevant synchronization while it can reach the workstation. The device keeps its downloaded products, permitted locations, tables, and eligible table orders locally. It can continue to select products, create cart lines, and place table orders while Wi-Fi or the workstation is temporarily unavailable.

When connectivity returns, use the app's sync action. Pending sales and print jobs are uploaded/processed according to the workstation and print-queue configuration. Do not clear app data or uninstall the app while it has unsynchronized work.

### Restaurant security on Mobile POS

- **Access tables** controls whether the table-order entry points and table list are shown.
- **Allow Table Order Delete** controls deletion of eligible orders.
- **Disable Table Order Checkout** prevents final checkout from Mobile POS.
- **Disable Table Order Move** prevents moving an order to another table.
- **Disable Table KOT Reprint** prevents KOT reprint actions.

These controls are assigned in **User Management → Roles → Restaurant**. Synchronize role changes before testing an offline cashier device.

---

## Settings & Options

| Setting | What It Does | Where to Find It |
|---|---|---|
| **Enable Restaurant Module** | Turn on all restaurant features | Business Settings → Modules |
| **Kitchen / Service Staff / Bookings** | Toggle specific sub-features | Business Settings → Modules |
| **Table Dropdown** | Show table selection on POS | POS Settings |
| **Service Staff Dropdown** | Show waiter selection on POS | POS Settings |
| **Type of Service Dropdown** | Show service type selection on POS | POS Settings |
| **Order Status** | Enable kitchen order status tracking | Business Settings → Modules |
| **Modifiers** | Enable product add-ons/extras | Business Settings → Modules |

---

## Common Questions

**Q: I don't see the Restaurant menu. How do I enable it?**
A: Go to **Business Settings → Modules** and turn on the **Restaurant Module**. You may need admin privileges.

**Q: Can I have different tables for different locations?**
A: Yes, each business location can have its own set of tables.

**Q: How do kitchen staff see orders?**
A: Open the Kitchen Display on a tablet or screen in the kitchen. Orders appear automatically as they're placed.

**Q: Can modifiers be free (no extra charge)?**
A: Yes, just set the modifier price to 0. It will appear as an option but won't add to the total.

**Q: Can I track which waiter generated the most sales?**
A: Yes, the **Service Staff Report** (under Reports) shows sales by service staff.

---

## Tips & Best Practices

- 📌 **Set up tables** before your first day of dine-in service
- 📌 **Use the Kitchen Display** on a dedicated screen in the kitchen
- 📌 **Train service staff** on how to use the POS with table and staff selection
- 📌 **Create modifier sets** for common customisations to speed up ordering
- 📌 **Use Types of Service** to separate dine-in, takeaway, and delivery revenue in your reports
