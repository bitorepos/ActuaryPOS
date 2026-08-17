# Manufacturing Module — Complete User Guide

The Manufacturing module allows you to manage recipes (bill of materials), track production orders, monitor quality, and analyse production costs — all from within {application_name}.

---

## What You'll Learn

- How to set up recipes with ingredients
- How to import recipes in bulk from a spreadsheet
- How to restore a deleted recipe
- How to create and manage production orders
- How to track production status and priorities
- How to use the Production Dashboard
- How to perform Quality Control inspections
- How to track yield and batch numbers
- How to manage production costs (ingredients, labour, overhead)
- How to add production notes and comments
- How to reverse a finalized production
- How to plan ahead with **Demand Orders** and the **Demand Ingredient Report**
- How to read the Manufacturing Report and Recipe Report
- How to configure module settings
- How to assign the right permissions to your team

---

## Module Overview

| Feature | Description |
|---|---|
| **Dashboard** | KPIs, status breakdown, cost analysis, and recent productions at a glance |
| **Recipes** | Define the ingredients and raw materials needed for each product (with bulk import & restore) |
| **Production** | Create production orders that consume ingredients and produce finished goods |
| **Reverse Production** | Undo a finalized production — return finished goods to raw materials |
| **Quality Control** | Inspect and approve/reject finished goods before they enter stock |
| **Settings** | Switch on/off optional features (status workflow, QC, batch, yield, labour/overhead, reverse production, auto-update product price, etc.) |
| **Manufacturing Report** | Production volumes, wastage and costs over a date range |
| **Recipe Report** | Recipe usage and ingredient consumption analysis |
| **Demand Orders** | Plan future production needs by location with approval workflow |
| **Demand Ingredient Report** | See exactly which raw materials are required to fulfil pending demand orders |
| **Status Workflow** | Track each production through Planned → In Progress → Quality Check → Completed |
| **Yield Tracking** | Compare expected vs actual output to measure efficiency |
| **Batch Tracking** | Assign batch numbers for traceability |
| **Enhanced Costs** | Track labour and overhead costs alongside ingredient costs |
| **Production Notes** | Keep a full activity log for every production order |

---

## Getting Started

### How Do I Get the Manufacturing Module?

Manufacturing is an **optional add-on**. It is **not** in the *Modules* tab of *Business Settings* (that tab only controls core base-software features like POS, Sales, Stock and Reports).

To get Manufacturing enabled for your business:

1. Look in the **left sidebar**. If you see a **Manufacturing** menu, the module is already active for your account — skip to *Initial Settings* below.
2. If you do **not** see Manufacturing, the add-on is not part of your current subscription plan. Open the **Contact Superadmin** page from the documentation menu (or contact your system administrator) and request that the **Manufacturing** module be enabled.
3. After the Superadmin activates it on your subscription / business package, **log out and log back in**. The new menu will appear.
4. Give your team access to the relevant features in **User Management → Roles** (see [Permissions](#permissions) below).

> 💡 **About activation:** Manufacturing is enabled per-business by the Superadmin via subscription packages — it is *not* a checkbox in your own Business Settings.

### Initial Settings

Once the module is active, navigate to **Manufacturing → Settings** to configure how it should behave for your business:

| Setting | Description |
|---|---|
| **Production Ref No. Prefix** | Custom prefix for production reference numbers (e.g., `MFG-`) |
| **Reverse Production Ref No. Prefix** | Prefix for reverse production references |
| **Enable Reverse Production** | Allow reversing finalized productions |
| **Disable Editing Ingredient Qty** | Prevent operators from changing ingredient quantities during production |
| **Update Product Price After Production** | Automatically update the product's purchase price when a production is finalized |
| **Enable Production Status Workflow** | Activate the 6-stage status tracking system |
| **Enable Quality Control** | Activate quality inspection features |
| **Enable Yield Tracking** | Track expected vs actual production quantities |
| **Enable Batch Number Tracking** | Add batch number fields to productions |
| **Enable Labour & Overhead Costs** | Add labour and overhead cost fields to productions |
| **Auto-generate Batch Numbers** | System generates batch numbers automatically |

📸 *[Screenshot: Manufacturing Settings page with enhanced options]*

---

## Recipes (Bill of Materials)

A **recipe** defines which ingredients (raw materials) are needed to manufacture a product, including quantities and optional step-by-step instructions.

### Creating a Recipe

1. Go to **Manufacturing → Recipe**.
2. Click **Add Recipe**.
3. Select the **finished product** you want to make.
4. Add **ingredients**:
   - Search for a product (raw material)
   - Set the **quantity** needed per unit of the finished product
   - Set the **waste percentage** (how much is typically lost during production)
   - Set the **price** (usually auto-filled from the product's purchase price)
5. Optionally add **production steps** — group ingredients into logical steps with names and descriptions.
6. Add **recipe instructions** for operators to follow.
7. Click **Save**.

📸 *[Screenshot: Creating a new recipe with ingredients and steps]*

### Recipe Details

| Field | Description |
|---|---|
| **Product** | The finished good this recipe produces |
| **Ingredients** | Raw materials needed, with quantities per unit |
| **Waste %** | Expected wastage percentage for each ingredient |
| **Total Price** | Calculated cost based on ingredient purchase prices |
| **Instructions** | Step-by-step production instructions |
| **Version** | Recipe version number (increments on changes) |

### Recipe Tips

- Recipes use **real-time ingredient prices** — the recipe cost updates when ingredient purchase prices change.
- You can **copy from recipe** when creating a production to pre-fill ingredients.
- One product can have only one active recipe at a time.

### Importing Recipes from a Spreadsheet

If you have many recipes to load (e.g. when first setting up the module), you can import them in bulk instead of typing each one.

1. Go to **Manufacturing → Recipe**.
2. Click **Import Recipes** (top-right area of the Recipe list).
3. Click **Download Template** to get the sample `.xlsx` / `.csv` file.
4. Open the template and fill in one row per ingredient:
   - **Product (SKU)** — the finished product
   - **Ingredient (SKU)** — the raw-material product
   - **Quantity** — quantity of the ingredient per unit of finished product
   - **Waste %** — expected wastage (optional)
   - **Sub Unit** — optional sub-unit code
   - **Step / Group** — optional grouping label
5. Save the file as `.xlsx` or `.csv` (UTF-8).
6. Back in the **Import Recipes** screen, click **Browse**, select your file, and click **Submit**.
7. The system will report how many rows imported successfully and list any rows that failed validation.

> ⚠️ **Important:** SKUs in the file must already exist in **Products**. Importing does **not** create products — it only links them as ingredients.

### Restoring a Deleted Recipe

If a recipe was deleted by mistake, an admin can recover it.

1. Go to **Manufacturing → Recipe**.
2. Toggle the **Show deleted** filter (or open the deleted-recipes list).
3. Find the recipe and click **Restore**.
4. The recipe is reactivated and becomes available for new production orders.

---

## Production Orders

Production orders are the core of the Manufacturing module. Each order consumes ingredients from stock and produces finished goods.

### Creating a Production

1. Go to **Manufacturing → Production**.
2. Click **Add** (top-right button).
3. Fill in the **header**:
   - **Business Location** — Where the production takes place
   - **Reference No.** — Auto-generated or enter your own
   - **Manufacturing Date** — Date and time of production
   - **Product** — Select the product to manufacture (must have a recipe)
   - **Quantity** — How many units to produce
   - **Sub Unit** — If the product uses sub-units (e.g., dozens)
4. Fill in the **Production Planning** section:
   - **Production Status** — Planned, In Progress, Quality Check, Completed, On Hold, or Cancelled
   - **Priority** — Low, Normal, High, or Urgent
   - **Due Date** — When the production should be completed
   - **Batch Number** — Unique identifier for this production batch
   - **Expected Quantity** — Target output for yield tracking
   - **Labour Cost** — Direct labour costs for this production
   - **Overhead Cost** — Indirect costs (utilities, equipment, etc.)
   - **Notes** — Any special instructions or comments
5. Review the **Ingredients** table:
   - Ingredients are pre-filled from the recipe
   - Adjust quantities if allowed by your settings
   - Review waste quantities and costs
6. Set **Waste Units**, **Production Cost**, and **Production Cost Type** (Fixed, Percentage, or Per Unit).
7. Optionally attach **documents** (photos, reports, etc.).
8. Check the **Finalize** checkbox if the production is complete (this deducts ingredients from stock and adds finished goods).
9. Click **Submit**.

📸 *[Screenshot: New production form with planning section]*

> ⚠️ **Important:** Once a production is **finalized**, it cannot be edited. The system immediately:
> - Deducts ingredient stock from the selected location
> - Adds finished goods to stock
> - Updates the production status to "Completed" (if no status was selected)

### Editing a Production

1. Go to **Manufacturing → Production**.
2. Find the production in the list and click **Edit** (only available for non-finalized productions).
3. Update any fields including the planning section.
4. Click **Submit**.

> **Note:** Finalized productions show only a **View** button. They cannot be edited or modified.

### Production List

The production list shows all your production orders with:

| Column | Description |
|---|---|
| **Date** | Manufacturing date |
| **Ref No** | Reference number (clickable to view details) |
| **Location** | Business location |
| **Product** | Finished product name |
| **Quantity** | Produced quantity with unit |
| **Production Status** | Colour-coded status badge |
| **Priority** | Colour-coded priority badge |
| **Total Cost** | Total production cost |
| **Action** | View, Edit, Delete buttons |

### Filtering Productions

Use the filters at the top of the production list:

- **Business Location** — Filter by specific location
- **Date Range** — Filter by manufacturing date range
- **Finalize** — Show only finalized productions
- **Production Status** — Filter by status (Planned, In Progress, Quality Check, Completed, On Hold, Cancelled)

📸 *[Screenshot: Production list with status and priority columns]*

---

## Production Status Workflow

Every production can be tracked through a multi-stage workflow. This helps managers understand what's happening on the production floor at any time.

### Status Stages

| Status | Colour | Description |
|---|---|---|
| **Planned** | 🔵 Blue (Info) | Production is scheduled but work hasn't started |
| **In Progress** | 🔷 Blue (Primary) | Production is actively being worked on |
| **Quality Check** | 🟡 Yellow (Warning) | Production is complete and awaiting quality inspection |
| **Completed** | 🟢 Green (Success) | Production is fully done and QC approved |
| **On Hold** | ⚪ Grey (Secondary) | Production is paused (e.g., waiting for materials) |
| **Cancelled** | 🔴 Red (Danger) | Production has been cancelled |

### Typical Workflow

```
Planned → In Progress → Quality Check → Completed
                ↓                            ↑
            On Hold ──────────────────────────┘
```

### Changing Status

**From the production form:**
1. Edit the production.
2. Change the **Production Status** dropdown.
3. Save.

**Via API (internal):**
The system can automatically change status:
- **Finalized** productions are auto-set to "Completed".
- **QC Passed** inspections auto-advance the production from "Quality Check" to "Completed".

Every status change is logged as a **Production Note** for full traceability.

---

## Production Priority

Priorities help you manage workload and urgency on the production floor.

| Priority | Colour | When to Use |
|---|---|---|
| **Low** | ⚪ Grey | Can be done whenever there's downtime |
| **Normal** | 🔵 Blue | Standard production, no special urgency |
| **High** | 🟡 Yellow | Needs attention soon — customer order or restocking |
| **Urgent** | 🔴 Red | Critical — must be done immediately |

Set the priority when creating or editing a production order. You can filter the production list by priority.

---

## Production Dashboard

The dashboard gives you a bird's-eye view of all production activity.

### Accessing the Dashboard

Navigate to **Manufacturing → Dashboard** from the sidebar or top navigation.

📸 *[Screenshot: Manufacturing Production Dashboard]*

### Dashboard Sections

#### KPI Cards (Top Row)

| Card | What It Shows |
|---|---|
| **Total Productions** | Number of production orders in the selected period |
| **Total Production Value** | Sum of all production costs in currency |
| **Avg. Yield Efficiency** | Average ratio of actual vs expected output (percentage) |
| **Overdue Productions** | Number of productions past their due date that are not completed |

> 💡 **Tip:** The Overdue card turns red when there are overdue productions to draw your attention.

#### Status & Priority Breakdown (Middle Left)

- **Production Status Overview** — Shows the count for each of the 6 statuses as colour-coded badges.
- **Priority Breakdown** — Shows counts for Urgent, High, Normal, and Low priorities.

#### Quality Control Summary (Middle Centre)

- **Total Inspections** — How many QC inspections have been conducted.
- **Passed/Failed/Pending** — Breakdown of inspection results.
- **Pass Rate** — Visual progress bar showing the percentage of passed inspections.

#### Cost Breakdown (Middle Right)

A table showing:
- Total Production Cost (sum of `final_total`)
- Total Labour Cost
- Total Overhead Cost

#### Recent Productions (Bottom)

A table of the most recent production orders with Ref No, Product, Date, Cost, Status, and Priority.

### Dashboard Filters

- **Location** — Filter by business location
- **Date Range** — Select a custom date range
- **Refresh** — Reload the dashboard data

---

## Quality Control (QC)

The Quality Control system lets you inspect production output before it's added to your inventory. This ensures only products that meet your standards reach customers.

### Accessing Quality Control

Navigate to **Manufacturing → Quality Control** from the sidebar or top navigation.

> **Note:** This feature requires the **Enable Quality Control** setting to be turned on in Manufacturing Settings, and the user must have the **Access Quality Control** permission.

### Quality Inspection List

The list shows all inspections with:

| Column | Description |
|---|---|
| **Date** | When the inspection was conducted |
| **Reference** | The production order reference number |
| **Inspector** | Who performed the inspection |
| **Status** | Pending, Passed, Failed, or Conditional |
| **Batch Number** | Batch identifier (if set) |
| **Action** | View, Edit, Delete buttons |

You can filter by:
- **Status** — Pending, Passed, Failed, Conditional
- **Date Range** — When the inspection occurred

📸 *[Screenshot: Quality Inspection list with filters]*

### Creating a Quality Inspection

1. Go to **Manufacturing → Quality Control**.
2. Click **Add Quality Inspection** (top-right).
3. Fill in the form:
   - **Select Production** (required) — Choose which production order to inspect
   - **Inspection Date** (required) — When the inspection is taking place
   - **Status** (required) — Initial status: Pending, Passed, Failed, or Conditional
   - **Inspector** — Select the person performing the inspection
   - **Batch Number** — The batch being inspected
   - **Notes** — Any observations or comments
4. Add **QC Parameters** — these are the specific checks you're performing:
   - Click **Add Parameter**
   - For each parameter, enter:
     - **Parameter Name** — What you're checking (e.g., "Weight", "Colour", "pH Level")
     - **Expected Value** — The target or standard (e.g., "500g ± 5g", "Clear", "6.5-7.5")
     - **Actual Value** — What was measured (e.g., "498g", "Clear", "7.0")
     - **Result** — Pass, Fail, or Pending for this specific check
   - Add as many parameters as needed
   - Click the red **×** button to remove a parameter row
5. Click **Save**.

📸 *[Screenshot: Quality Inspection form with QC parameters]*

### QC Parameter Examples

| Industry | Parameter Name | Expected Value | Example Actual | Result |
|---|---|---|---|---|
| Food | Weight | 500g ± 5g | 498g | Pass |
| Food | Temperature | < 5°C | 3°C | Pass |
| Pharma | pH Level | 6.5 - 7.5 | 7.0 | Pass |
| Pharma | Potency | ≥ 95% | 97% | Pass |
| Textile | Colour Match | Pantone 286C | Pantone 286C | Pass |
| General | Visual Defects | 0 | 0 | Pass |

### Inspection Statuses

| Status | Badge | Description |
|---|---|---|
| **Pending** | 🟡 Yellow | Inspection scheduled but not yet completed |
| **Passed** | 🟢 Green | All checks passed — product is approved |
| **Failed** | 🔴 Red | One or more checks failed — product needs rework or disposal |
| **Conditional** | 🔵 Blue | Passed with conditions (e.g., minor deviations accepted) |

### What Happens When QC Passes

When you set an inspection status to **Passed** and the production order is currently in **Quality Check** status, the system **automatically advances** the production to **Completed** status. This streamlines the workflow without manual intervention.

A production note is also added automatically recording the QC result.

### Viewing an Inspection

Click the **View** button on any inspection to see the full details in a modal, including all QC parameters in a table format.

### Editing an Inspection

Click **Edit** to update the inspection. Changes to the QC status are logged as production notes.

### Deleting an Inspection

Click **Delete** to soft-delete an inspection. The record is kept in the database but hidden from the list.

---

## Yield Tracking

Yield tracking compares what you **expected** to produce with what you **actually** produced, giving you a measure of efficiency.

### How It Works

| Measure | Description |
|---|---|
| **Expected Quantity** | How many units you planned to produce |
| **Actual Quantity** | How many usable units were actually produced (after waste) |
| **Yield Efficiency** | (Actual ÷ Expected) × 100% |

### Setting Up Yield Tracking

1. Enable **Yield Tracking** in Manufacturing Settings.
2. When creating a production, enter the **Expected Quantity** in the Production Planning section.
3. The **Actual Quantity** is calculated automatically from the production quantity minus waste.

### Reading Yield Efficiency

| Efficiency Range | Colour | Meaning |
|---|---|---|
| **≥ 95%** | 🟢 Green | Excellent — minimal waste |
| **80% – 94%** | 🟡 Yellow | Acceptable — some optimization possible |
| **< 80%** | 🔴 Red | Poor — significant waste, investigate causes |

### Where to See Yield Data

- **Production Detail (Show)** — Shows expected, actual, and efficiency percentage
- **Production Dashboard** — Average yield efficiency across all productions
- **Yield can be updated** — Via the production yield update feature

---

## Batch Tracking

Batch numbers provide traceability for manufactured goods — essential for recalls, quality issues, or regulatory compliance.

### How to Use Batch Numbers

1. Enable **Batch Number Tracking** in Manufacturing Settings.
2. When creating a production, enter a **Batch Number** in the Production Planning section.
3. The batch number is displayed in:
   - Production detail (Show modal)
   - Quality Control inspections
   - Production list (when viewing details)

> 💡 **Tip:** Enable **Auto-generate Batch Numbers** in settings to have the system create unique batch IDs automatically.

### Batch Number Format

- If entered manually: any text/number combination you prefer (e.g., `BATCH-2026-001`)
- If auto-generated: system generates a unique identifier

---

## Enhanced Cost Tracking

Beyond ingredient costs, you can now track additional production expenses.

### Cost Components

| Cost Type | Description | Set Where |
|---|---|---|
| **Ingredients Cost** | Cost of raw materials consumed | Calculated from recipe + ingredient prices |
| **Production Cost** | Extra cost (fixed, %, or per unit) | Production form — Production Cost field |
| **Labour Cost** | Direct labour cost for this production | Production form — Labour Cost field |
| **Overhead Cost** | Indirect costs (utilities, rent, equipment) | Production form — Overhead Cost field |
| **Total Cost** | Sum of all cost components | Auto-calculated |

### Enabling Enhanced Costs

1. Go to **Manufacturing → Settings**.
2. Check **Enable Labour & Overhead Costs**.
3. Save.

The Labour Cost and Overhead Cost fields will then appear in the Production Planning section of the production form.

### Viewing Cost Breakdown

- **Production Detail (Show)** — Full cost breakdown table with each component
- **Production Dashboard** — Aggregated cost summary in the Cost Breakdown widget

📸 *[Screenshot: Production detail showing cost breakdown with labour and overhead]*

---

## Production Notes

Production notes create a complete activity trail for each production order. Every significant event is logged automatically, and you can add manual comments.

### Automatic Notes

The system auto-creates notes when:
- **Status changes** — e.g., "Status changed from Planned to In Progress"
- **QC inspections** — e.g., "Quality inspection completed: Passed"
- **Yield updates** — e.g., "Yield updated: 95.5% efficiency"

### Adding Manual Notes

1. View a production order.
2. In the **Production Notes** section, type your comment.
3. Select a **Note Type**:
   - **Comment** — General observations
   - **Status Change** — Status-related notes
   - **Quality Check** — QC-related observations
   - **Cost Update** — Cost-related notes
   - **General** — Other notes
4. Click **Add Note**.

### Note Timeline

Notes are displayed as an activity timeline, showing:
- **Author** — Who added the note
- **Date/Time** — When it was added
- **Type** — Colour-coded note type badge
- **Content** — The note text

📸 *[Screenshot: Production notes timeline]*

---

## Reverse Production

Reverse production allows you to undo a finalized production — returning finished goods to raw materials.

### How It Works

1. Go to **Manufacturing → Reverse Production** (must be enabled in settings).
2. Click **Add**.
3. Select the original production order to reverse.
4. Review the quantities to be reversed.
5. Finalize the reversal.

> ⚠️ **Important:** Reverse production adds ingredient stock back and removes finished goods from stock. Use this when a production batch is rejected or when you need to undo a mistake.

---

## Demand Orders

**Demand Orders** let you plan ahead. A demand order says *“we need to produce this list of finished products by this date at this location.”* They feed into the **Demand Ingredient Report** so you can see exactly which raw materials need to be purchased or pulled from stock to satisfy them.

> This tab requires the **Access Demand Order** permission and is shown under the **Demand Orders** dropdown in the Manufacturing top navigation.

### Creating a Demand Order

1. Go to **Manufacturing → Demand Orders → Add Demand Order**.
2. Fill in the **Demand Order Details**:
   - **Business Location** *(required)* — Where the goods will be produced.
   - **Reference No.** — Auto-generated if left blank.
   - **Demand Date** *(required)* — The date the demand was raised (defaults to today).
   - **Required Date** — When the finished goods need to be ready.
   - **Status** — `Draft` (still being prepared) or `Pending` (submitted for approval).
   - **Priority** — Low, Normal, High, or Urgent.
   - **Notes** — Any context (e.g. customer name, event, sales forecast).
3. In **Demand Items**, pick a recipe-enabled product from the **Select Recipe Product** dropdown. The system adds a row showing:
   - On-hand quantity at the location
   - Quantity to demand
   - Unit and recipe link
   - Estimated unit cost and line total (auto-calculated from the recipe)
   - Optional line notes
4. Repeat for each product you need to plan for.
5. The **Total Estimated Cost** at the bottom gives an at-a-glance budget.
6. Click **Save**.

📸 *[Screenshot: Add Demand Order form with line items]*

### Demand Order Statuses

| Status | Badge | Meaning |
|---|---|---|
| **Draft** | ⚪ Grey | Being prepared — only visible to the creator/team; can still be edited or deleted. |
| **Pending** | 🟡 Yellow | Submitted and awaiting approval. |
| **Approved** | 🔵 Blue (Info) | A user with *Approve Demand Order* permission has signed off. Ready to be produced. |
| **In Production** | 🔷 Blue (Primary) | Linked production orders have started. |
| **Partially Completed** | 🟠 Orange | Some quantities have been produced but not all. |
| **Completed** | 🟢 Green | Every line item has been produced. |
| **Cancelled** | 🔴 Red | Demand cancelled — no longer to be produced. |

### Approving a Demand Order

1. Go to **Manufacturing → Demand Orders**.
2. Find a row with status **Pending**.
3. Click the green **Approve** button (only visible to users with *Approve Demand Order*).
4. The status moves to **Approved** and the order is ready for production planning.

### Changing Status Inline

Click the status badge in the list to change it directly (subject to permissions). Terminal statuses (Completed, Cancelled) cannot be changed back.

### Editing / Deleting

- A demand order can only be **edited** or **deleted** while it is in **Draft** or **Pending** status.
- Once approved or in production, the record becomes read-only to preserve traceability.

### Filtering Demand Orders

- **Location** — By business location
- **Status** — Draft / Pending / Approved / In Production / Partially Completed / Completed / Cancelled
- **Date Range** — By demand date
- **Priority** — Urgent / High / Normal / Low

---

## Demand Ingredient Report

The **Demand Ingredient Report** consolidates all open demand orders and tells you exactly **what raw materials you need to source** to fulfil them.

### Accessing the Report

Navigate to **Manufacturing → Demand Orders → Demand Ingredient Report** (under the same dropdown).

### What It Shows

For each ingredient (raw material) it lists:

| Column | Description |
|---|---|
| **Ingredient** | The raw-material product name and SKU |
| **Required Quantity** | Total quantity needed across all selected demand orders (after applying recipe waste %) |
| **Available Stock** | Current on-hand stock at the chosen location |
| **Shortage** | How much you still need to procure (Required − Available, never negative) |
| **Estimated Cost** | Required Qty × latest purchase price |

### Filters

- **Location** — Limit to one business location
- **Required Date Range** — Only include demand orders whose required date falls in the range
- **Status** — Typically `Pending` + `Approved` (defaults are tuned to show only “still to do” demand)

### How to Use It

1. After raising and approving the week's / month's demand orders, open the report.
2. Filter by your location and the relevant required-date range.
3. Use the **Shortage** column to create a purchase order for the missing raw materials.
4. Once stock arrives, run production orders against the demand to fulfil it.

📸 *[Screenshot: Demand Ingredient Report showing shortage column]*

> 💡 **Tip:** Export the report to Excel/CSV and send it directly to your purchasing team — it doubles as a procurement shopping list.

---

## Manufacturing Report

View production data, costs, and efficiency in report format.

1. Go to **Manufacturing → Report**.
2. Filter by date range, location, or product.
3. View columns including:
   - Product name
   - Total production quantity
   - Input quantity
   - Wastage percentage
   - Final quantity
   - Total price

📸 *[Screenshot: Manufacturing Report]*

---

## Recipe Report

The Recipe Report helps you analyse recipe usage and ingredient consumption.

1. Go to **Manufacturing → Recipe Report** (available from the navigation bar).
2. Filter by date range, location, or product.
3. View ingredient usage, costs, and production frequency.

This report is useful for identifying your most-produced items and tracking raw material consumption over time.

📸 *[Screenshot: Recipe Report]*

---

## Bulk Update Product Prices

You can update product purchase prices in bulk based on recipe calculations:

1. Go to **Manufacturing → Recipe**.
2. Click the **Update Product Prices** button.
3. The system recalculates each product's purchase price based on the current recipe ingredient costs.
4. Review the changes and confirm.

> **Note:** This updates the product's base purchase price to match the latest recipe cost. This is useful when ingredient prices change frequently.

📸 *[Screenshot: Update Product Prices confirmation]*

---

## Permissions

The Manufacturing module has its own set of permissions that control who can access each feature.

### Available Permissions

| Permission | What It Controls |
|---|---|
| **Access Recipe** | View the recipe list and details |
| **Add Recipe** | Create new recipes |
| **Edit Recipe** | Modify existing recipes |
| **Access Production** | View and manage production orders |
| **View Own Production** | User can only see productions they created (not others') |
| **Access Quality Control** | View and manage quality inspections |
| **Add Quality Inspection** | Create new quality inspections |
| **Access Manufacturing Dashboard** | View the production dashboard |
| **Manage Production Status** | Change production status via the workflow |
| **Access Demand Order** | View and create demand orders and the demand ingredient report |
| **Add Demand Order** | Create a new demand order |
| **Edit Demand Order** | Modify a draft / pending demand order |
| **Delete Demand Order** | Delete a draft / pending demand order |
| **Approve Demand Order** | Approve a pending demand order so it can move into production |

### Recommended Permission Sets

**Production Operator:**
- Access Production
- View Own Production

**Quality Inspector:**
- Access Production
- Access Quality Control
- Add Quality Inspection

**Production Manager:**
- Access Production
- Access Recipe
- Access Quality Control
- Add Quality Inspection
- Access Manufacturing Dashboard
- Manage Production Status

**Manufacturing Admin:**
- All of the above
- Add Recipe
- Edit Recipe

### Setting Permissions

1. Go to **User Management → Roles**.
2. Select or create a role.
3. Scroll to the **Manufacturing** section.
4. Check the desired permissions.
5. Save the role.

---

## Troubleshooting

| Issue | Solution |
|---|---|
| "Unauthorized action" error | Ensure the user's role has the required Manufacturing permission |
| Can't see Dashboard or QC in menu | Check that the user has `Access Manufacturing Dashboard` or `Access Quality Control` permission |
| Production Planning fields not showing | Enable the corresponding settings in Manufacturing → Settings |
| Can't edit a production | Only non-finalized (draft) productions can be edited |
| QC doesn't auto-advance status | The production must be in "Quality Check" status and the inspection must be set to "Passed" |
| Yield efficiency shows 0% | Make sure you've entered an Expected Quantity greater than 0 |
| Batch number field not visible | Enable "Batch Number Tracking" in Manufacturing Settings |
| Labour/Overhead cost fields hidden | Enable "Labour & Overhead Costs" in Manufacturing Settings |
| Dashboard shows no data | Check the selected date range and location filters |
| Production notes not loading | Ensure the production exists and hasn't been deleted |

---

## Tips & Best Practices

- 📌 **Set up recipes first** — Create all your recipes before starting production orders
- 📌 **Use the status workflow** — Move productions through each stage for full visibility
- 📌 **Enable QC for regulated products** — If you manufacture food, pharma, or regulated goods
- 📌 **Track yield consistently** — Always enter expected quantities to build efficiency data over time
- 📌 **Use batch numbers** — Even if not required by law, they help trace issues back to specific runs
- 📌 **Check the dashboard regularly** — It highlights overdue productions and efficiency trends
- 📌 **Add notes for context** — Future you will thank you when investigating production issues
- 📌 **Review costs monthly** — Use the dashboard cost breakdown to identify savings opportunities
- 📌 **Limit permissions** — Give operators only what they need; managers get the full picture
- 📌 **Don't finalize too early** — Once finalized, stock changes are permanent (unless you use reverse production)

---

## Quick Reference

### Navigation Paths

| Feature | Path |
|---|---|
| Dashboard | Manufacturing → Dashboard |
| Recipe List | Manufacturing → Recipe |
| Add Recipe | Manufacturing → Recipe → Add Recipe |
| Recipe Report | Manufacturing → Recipe Report |
| Update Product Prices | Manufacturing → Recipe → Update Product Prices |
| Production List | Manufacturing → Production |
| Add Production | Manufacturing → Production → Add |
| Quality Control | Manufacturing → Quality Control |
| Add QC Inspection | Manufacturing → Quality Control → Add Quality Inspection |
| Reverse Production | Manufacturing → Reverse Production |
| Manufacturing Report | Manufacturing → Report |
| Demand Orders List | Manufacturing → Demand Orders → Demand Orders |
| Add Demand Order | Manufacturing → Demand Orders → Add Demand Order |
| Demand Ingredient Report | Manufacturing → Demand Orders → Demand Ingredient Report |
| Import Recipes | Manufacturing → Recipe → Import Recipes |
| Settings | Manufacturing → Settings |

### Keyboard Shortcuts

The Manufacturing module uses standard {application_name} keyboard shortcuts. No additional shortcuts are defined.

---

> **Module Version:** 4.0
