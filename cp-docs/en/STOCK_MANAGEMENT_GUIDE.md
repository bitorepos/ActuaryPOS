# Stock Management — Adjustments & Transfers

Keeping your stock accurate is essential for a smooth-running business. This guide covers how to adjust your stock when things change and how to transfer products between your locations.

---

## What You'll Learn

- How to adjust stock levels (damaged, lost, or found items)
- How to transfer stock between locations
- How to check current stock levels
- How to set reorder alerts

---

## Stock Adjustments

Stock adjustments let you correct your stock when the physical count doesn't match the system — for example, when products are damaged, expired, lost, or found.

### How to Add a Stock Adjustment

1. Go to **Stock Adjustment → Add Stock Adjustment** from the left sidebar.
2. Fill in:
   - **Business Location** — Which location's stock you're adjusting
   - **Reference Number** — Auto-generated or enter your own
   - **Adjustment Date** — When the adjustment was discovered
   - **Adjustment Type**:
     - **Normal** — Standard adjustment (damage, loss, etc.)
     - **Abnormal** — Unusual circumstances (theft, disaster, etc.)
   - **Reason** — Brief explanation of why the adjustment is needed
3. Search for products and add them to the list.
4. For each product, enter:
   - **Quantity** — How many to adjust
   - **Action** — Choose:
     - **Remove from stock** — Reduce the count (e.g., damaged items)
     - **Add to stock** — Increase the count (e.g., found items)
5. Click **Save**.

📸 *[Screenshot: The Add Stock Adjustment form with products and quantities]*

> ⚠️ **Important:** Stock adjustments directly change your stock levels. Always double-check the quantities before saving.

---

### How to View Stock Adjustments

1. Go to **Stock Adjustment → List Stock Adjustments**.
2. View all adjustments with date, reference, location, and total amount.
3. Click **Actions → View** to see the full details of any adjustment.

📸 *[Screenshot: The stock adjustments list]*

---

## Stock Transfers

If you have multiple business locations, you can transfer stock from one to another.

### How to Add a Stock Transfer

1. Go to **Stock Transfers → Add Stock Transfer** from the left sidebar.
2. Fill in:
   - **From Location** — Where the stock is coming from
   - **To Location** — Where the stock is going to
   - **Transfer Date** — When the transfer happens
   - **Reference Number** — Auto-generated or enter your own
   - **Status**:
     - **In Transit** — Products are on the way
     - **Completed** — Products have arrived
     - **Pending** — Transfer is planned but not started
3. Search for products and add them.
4. Enter the **Quantity** for each product.
5. Click **Save**.

📸 *[Screenshot: The Add Stock Transfer form showing from/to locations and products]*

> 💡 **Tip:** Use the **In Transit** status when products are being shipped between locations. Update to **Completed** when they arrive.

---

### How to View Stock Transfers

1. Go to **Stock Transfers → List Stock Transfers**.
2. View all transfers with source, destination, status, and date.
3. Click **Actions → View** to see details.
4. Click **Actions → Edit** to update the status.

📸 *[Screenshot: The stock transfer list with status indicators]*

---

## Checking Current Stock Levels

### Stock Report

1. Go to **Reports → Stock Report**.
2. You'll see every product with:
   - **Current Stock** — What's available now
   - **Total Purchased** — Total bought
   - **Total Sold** — Total sold
   - **Total Transferred** — Moved between locations
   - **Total Adjusted** — Stock adjustments
3. Use filters to narrow by location, category, brand, or unit.

📸 *[Screenshot: The Stock Report with filtering options]*

### Stock Value Report

1. Go to **Reports → Stock Value Report**.
2. See the total financial value of your current stock.
3. Useful for accounting and insurance purposes.

---

## Stock Alerts & Reorder Levels

### How to Set Reorder Levels

1. Edit any product (**Products → List Products → Edit**).
2. Find the **Alert Quantity** field.
3. Enter the minimum stock level (e.g., 10). When stock falls below this number, you'll get an alert.
4. Click **Update**.

### Where to See Stock Alerts

- **Dashboard** — The Stock Alerts section shows low-stock products
- **Reports → Stock Reorder Report** — A complete list of products below their reorder level

📸 *[Screenshot: The Stock Alerts section on the Dashboard]*

---

## Settings & Options

| Setting | What It Does | Where to Find It |
|---|---|---|
| **Stock Adjustment Prefix** | Prefix for adjustment reference numbers | **Settings → Business Settings → Prefixes** |
| **Stock Transfer Prefix** | Prefix for transfer reference numbers | **Settings → Business Settings → Prefixes** |
| **Enable Stock Expiry** | Track expiry dates on products | **Settings → Business Settings → Product** |
| **Allow Overselling** | Allow sales even when stock is zero | **Settings → Business Settings → Sale** |

---

## Common Questions

**Q: Can I adjust stock without affecting my accounts?**
A: Stock adjustments are recorded as a cost to your business. The value of the adjustment is tracked for accounting purposes.

**Q: What happens to the stock at the source location after a transfer?**
A: The stock is immediately reduced at the source location and increased at the destination when the transfer status is set to "Completed".

**Q: Can I undo a stock adjustment?**
A: You can't undo an adjustment, but you can create a new adjustment in the opposite direction (add stock if you previously removed it).

---

## Tips & Best Practices

- 📌 Do **regular stock counts** and use adjustments to keep the system accurate
- 📌 Always include a **reason** when making adjustments — it helps with auditing
- 📌 Use **stock transfers** instead of making separate adjustments at each location
- 📌 Set **reorder levels** for your most important products to avoid running out
- 📌 Review the **Stock Report** at least once a week