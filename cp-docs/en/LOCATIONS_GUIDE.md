# Multi-Location Management

If your business has more than one branch or store, {application_name} lets you manage **all locations** from a single system. You can track sales, stock, and expenses separately for each location while still seeing the big picture.

---

## What You'll Learn

- How to add a new business location
- How to manage location-specific settings
- How to transfer stock between locations
- How to view reports by location
- How to control user access by location

---

## How to Add a New Location

1. Go to **Business Settings** from the left sidebar.
2. Click the **Business Locations** tab (or go to **Business Settings → Locations**).
3. Click **+ Add Location**.
4. Fill in the details:
   - **Location Name** — a friendly name (e.g. "Main Store", "Downtown Branch")
   - **Landmark** — nearby recognised landmark (optional)
   - **City / State / Country / Zip** — full address
   - **Mobile / Alternate Number / Email** — contact details for this location
   - **Invoice Scheme** — which invoice numbering to use at this location
   - **Invoice Layout** — which receipt/invoice design to use
   - **Default Payment Accounts** — default cash/bank accounts for this location
5. Click **Save**.

📸 *[Screenshot: The Add Location form with all fields]*

---

## How to Switch Between Locations

1. Look at the **top navigation bar** — you'll see a **location dropdown**.
2. Click it and select the location you want to work with.
3. All screens (POS, products, stock, reports) will now show data for that location.

📸 *[Screenshot: The top navigation showing the location dropdown]*

> 💡 **Tip:** Users with access to multiple locations can switch freely. Users assigned to a single location will only see their own location's data.

---

## Location-Specific Settings

Each location can have its own:

| Setting | What It Controls |
|---|---|
| **Invoice Scheme** | Invoice number format (e.g. "MAIN-0001" vs "DT-0001") |
| **Invoice Layout** | Receipt/invoice design and content |
| **Payment Accounts** | Default cash register and bank accounts |
| **Price Group** | Different selling prices per location |
| **Tax Rates** | Location-specific tax rules |
| **Product Prices** | Each product can have different prices at different locations |

---

## Stock Management Across Locations

### Viewing Stock by Location

1. Go to **Reports** → **Stock Report**.
2. Filter by **Location** to see stock levels at a specific branch.
3. You can compare stock levels across all locations.

📸 *[Screenshot: Stock report filtered by location]*

### Transferring Stock Between Locations

1. Go to **Stock Transfers** from the left sidebar.
2. Click **+ Add Stock Transfer**.
3. Select the **From Location** (source) and **To Location** (destination).
4. Add products and quantities to transfer.
5. Add a **Reference Number** and any notes.
6. Set the **Status**:
   - **Pending** — transfer is planned but not yet shipped
   - **In Transit** — goods are on the way
   - **Completed** — goods have arrived at the destination
7. Click **Save**.

📸 *[Screenshot: The Add Stock Transfer form showing from/to locations and products]*

> 💡 Stock is deducted from the source location and added to the destination location based on the transfer status.

---

## Reports by Location

Most reports in {application_name} can be filtered by location:

1. Open any report (Sales, Purchases, Stock, Expenses, etc.).
2. Look for the **Location** filter at the top.
3. Select a specific location or "All Locations".
4. The report updates to show data for that location only.

📸 *[Screenshot: A report page with the location filter dropdown highlighted]*

### Key Location Reports

- **Profit/Loss by Location** — see which branch is most profitable
- **Sales by Location** — compare sales across branches
- **Stock by Location** — check stock levels at each branch
- **Expense by Location** — track spending per branch

---

## Controlling User Access by Location

You can restrict users to specific locations:

1. Go to **User Management** → **Users**.
2. Edit the user you want to restrict.
3. In the **Access Locations** section, select which locations this user can access.
4. Click **Save**.

📸 *[Screenshot: User edit form showing location access checkboxes]*

- **All Locations** — user can see and work with data from any branch
- **Specific Locations** — user only sees data from their assigned location(s)

> ⚠️ This is important for security — cashiers should only see their own branch.

---

## Common Questions

**Q: Can each location have different products?**
A: Yes, you can control which products are available at each location through the product settings.

**Q: Can I set different prices for each location?**
A: Yes, use **Selling Price Groups** to set location-specific pricing.

**Q: Can a customer buy from one location and return at another?**
A: This depends on your return policy settings. By default, returns are processed at the selling location.

**Q: Can I see combined reports for all locations?**
A: Yes, select "All Locations" in the location filter to see combined data.

**Q: How do stock transfers affect my reports?**
A: Stock transfers move inventory between locations. They do not count as sales or purchases — they're internal movements.

---

## Tips & Best Practices

- 📌 **Name locations clearly** — use names everyone recognises (not codes)
- 📌 **Set default payment accounts** for each location during setup
- 📌 **Restrict user access** — cashiers should only see their own branch
- 📌 **Review location reports weekly** — compare performance across branches
- 📌 **Use stock transfers** to keep all locations properly stocked