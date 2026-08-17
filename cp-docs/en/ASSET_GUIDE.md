# Asset Management Module — User Guide

> **Navigation:** Sidebar → **Asset Management** (dropdown)

---

## Table of Contents

1. [Overview](#1-overview)
2. [Getting Started](#2-getting-started)
3. [Dashboard](#3-dashboard)
4. [Managing Assets](#4-managing-assets)
5. [Asset Allocation](#5-asset-allocation)
6. [Asset Revocation](#6-asset-revocation)
7. [Asset Maintenance](#7-asset-maintenance)
8. [Warranty Management](#8-warranty-management)
9. [Asset Condition & Status Tracking](#9-asset-condition--status-tracking)
10. [Insurance & Disposal](#10-insurance--disposal)
11. [Depreciation & Book Value](#11-depreciation--book-value)
12. [Settings & Configuration](#12-settings--configuration)
13. [User Permissions](#13-user-permissions)
14. [Notifications](#14-notifications)
15. [Reports & Analytics](#15-reports--analytics)
16. [Best Practices](#16-best-practices)
17. [Troubleshooting](#17-troubleshooting)

---

## 1. Overview

The **Asset Management** module provides a complete lifecycle management solution for your organisation's physical and digital assets. It covers everything from acquisition and allocation through maintenance, depreciation tracking, and eventual disposal.

### Key Features
- **Full lifecycle tracking** — Acquire → Allocate → Maintain → Dispose
- **Real-time dashboard** with KPIs for total asset value, depreciation, maintenance, and more
- **Flexible allocation** system to assign assets to employees with time limits
- **Revocation** workflow to recover allocated assets
- **Maintenance management** with priorities, statuses, types, and cost tracking
- **Multi-warranty support** per asset with active/expiring/expired indicators
- **Condition & status tracking** (new, good, fair, poor, damaged / active, inactive, disposed, under maintenance)
- **Insurance tracking** with policy numbers and expiry dates
- **Depreciation calculation** with useful life and salvage value
- **Categorised assets** using the built-in Category taxonomy
- **Granular permissions** — 11 distinct permission levels
- **Email notifications** for maintenance events

---

## 2. Getting Started

### Prerequisites
1. **Subscription** — The business must have the Asset Management feature active in their subscription plan.
2. **Permissions** — At least the **View Assets** permission is required.
3. **Asset Categories** — It is recommended to set up asset categories first via **Settings → Asset categories**.

### First-time Setup
1. Navigate to **Asset Management → Settings**.
2. Configure code prefixes:
   | Setting | Default | Example Output |
   |---------|---------|----------------|
   | Asset Code Prefix | (auto) | AST-0001 |
   | Allocation Code Prefix | (auto) | ALC-0001 |
   | Revoke Code Prefix | (auto) | RVK-0001 |
   | Maintenance Prefix | (auto) | MNT-0001 |
3. Configure email notification recipients and templates.
4. Create asset categories relevant to your business.
5. Start adding assets!

---

## 3. Dashboard

Navigate to **Asset Management → Dashboard**.

### Admin View (KPIs)
| Metric | Description |
|--------|-------------|
| **Total Assets** | Sum of all asset quantities across the business |
| **Total Asset Value** | Sum of (quantity × unit price) for all assets |
| **Total Depreciation** | Cumulative depreciation amount across all assets |
| **Assets Allocated (all users)** | Net allocated quantity (allocations − revocations) |
| **Assets Under Maintenance** | Count of open maintenance records (new + in-progress) |
| **Assets by Category** | Quantity breakdown per asset category |
| **Assets by Condition** | Count of assets in each condition state |
| **Assets by Status** | Count of assets in each status |
| **Maintenance Summary** | Breakdown of maintenance records by status |
| **Expiring Warranties** | Assets with warranties expiring within 30 days |

### Employee View
| Metric | Description |
|--------|-------------|
| **Assets Allocated to You** | Net quantity currently allocated to the logged-in user |
| **Allocation by Category** | Category-wise breakdown of your allocated assets |

---

## 4. Managing Assets

### Creating an Asset

1. Go to **Asset Management → All Assets**.
2. Click **+ Add Asset**.
3. Fill in the form:

| Field | Required | Description |
|-------|----------|-------------|
| Asset Code | Auto | Auto-generated if left empty; uses configured prefix |
| Name | ✅ | Descriptive name of the asset |
| Quantity | ✅ | Number of units |
| Model/Series | – | Model name or series number |
| Serial Number | – | Unique serial identifier |
| Category | – | Select from asset categories |
| Location | – | Business location where asset is kept |
| Purchase Date | – | Date of acquisition |
| Purchase Type | – | Owned / Rented / Leased |
| Unit Price | ✅ | Cost per unit |
| Depreciation | – | Annual depreciation amount |
| Is Allocatable | – | Toggle whether this asset can be assigned to users |
| Condition | – | New / Good / Fair / Poor / Damaged |
| Status | – | Active / Inactive / Disposed / Under Maintenance |
| Vendor Name | – | Supplier / vendor name |
| Insurance Policy | – | Policy number |
| Insurance Expiry | – | Policy expiry date |
| Useful Life (Years) | – | Expected useful life span |
| Salvage Value | – | Estimated residual value after useful life |
| Description | – | Detailed notes about the asset |
| Notes | – | Additional internal notes |
| Image | – | Upload asset photo |

4. **Warranty** — Add one or more warranty periods:
   - Start Date
   - Duration (months) → End date is auto-calculated
   - Additional Cost
   - Notes

5. Click **Save**.

### Editing an Asset
- In the All Assets list, click the **Edit** button on any row.
- All fields can be updated; warranties can be added, modified, or removed.

### Deleting an Asset
- Click the **Delete** action from the dropdown.
- The asset and all associated media will be removed.

### Filtering & Searching
Use the filter controls at the top of the All Assets list:
- **Location** — Filter by business location
- **Category** — Filter by asset category
- **Purchase Type** — Owned / Rented / Leased
- **Is Allocatable** — Yes / No

---

## 5. Asset Allocation

Allocation assigns assets to specific employees/users.

### Creating an Allocation

1. Navigate to **Asset Management → Allocations** (or click **Allocate** from an asset's action menu).
2. Click **+ Allocate Asset**.
3. Fill in:

| Field | Required | Description |
|-------|----------|-------------|
| Allocation Code | Auto | Auto-generated if left empty |
| Asset | ✅ | Select from allocatable assets (shows available quantity) |
| Quantity | ✅ | Number of units to allocate |
| Allocate To | ✅ | Select the receiving user |
| Date/Time | ✅ | Allocation date and time |
| Allocated Upto | – | Optional return-by date |
| Reason | – | Why the asset is being allocated |

4. Click **Save**.

### Editing an Allocation
- Only allocations that are **not fully revoked** can be edited.
- Modify the receiver, quantity, asset, or dates.

### Viewing Allocations
The allocation list shows:
- Reference number, asset name, model, category
- Receiver name, provider name
- Quantity allocated, quantity revoked
- Allocation date, allocated-upto date
- Action buttons: Edit, Delete, Revoke

---

## 6. Asset Revocation

Revocation recovers assets previously allocated to users.

### Creating a Revocation

1. Navigate to **Asset Management → Allocations**.
2. On an allocation row, click **Revoke** from the action dropdown.
3. Fill in the revocation form:

| Field | Required | Description |
|-------|----------|-------------|
| Revoke Code | Auto | Auto-generated if left empty |
| Quantity | ✅ | Number of units to revoke (≤ remaining allocated) |
| Date/Time | ✅ | Revocation date and time |
| Reason | – | Why the asset is being revoked |

4. Click **Save**.

### Viewing Revocations
Navigate to **Asset Management → Revocations** to see all historical revocations with:
- Reference, original allocation code
- Asset name, model, category
- Revoked-for (user), revoked-by (admin)
- Quantity, revocation date, reason

---

## 7. Asset Maintenance

Track and manage repair, servicing, and preventive maintenance.

### Creating a Maintenance Record

1. From an asset's action menu on the All Assets page, click **Send to Maintenance**.
2. Fill in:

| Field | Required | Description |
|-------|----------|-------------|
| Status | ✅ | New / In Progress / Completed / Cancelled |
| Priority | ✅ | High / Medium / Low |
| Maintenance Type | – | Preventive / Corrective / Emergency |
| Due Date | – | Expected completion date |
| Estimated Cost | – | Budgeted maintenance cost |
| Maintenance Note | – | Details about the issue |
| Attachments | – | Upload photos/documents |

3. Click **Save**. A notification is sent to configured recipients.

### Editing Maintenance
1. Go to **Asset Management → Maintenance**.
2. Click **Edit** on any record.
3. You can update:
   - Status and Priority
   - Assign a technician (**Assigned To**)
   - Add details and attachments
   - Record actual cost and completed date
4. If the **Assigned To** user changes, a notification is sent to the new assignee.

### Filtering Maintenance
Filter the list by:
- **Status** — New / In Progress / Completed / Cancelled
- **Priority** — High / Medium / Low
- **Assigned To** — Select a specific user

### Maintenance Statuses

| Status | Colour | Description |
|--------|--------|-------------|
| New | Blue | Just created, not started |
| In Progress | Yellow | Work has begun |
| Completed | Green | Work finished |
| Cancelled | Red | Maintenance cancelled |

### Maintenance Types

| Type | When to Use |
|------|-------------|
| **Preventive** | Scheduled/routine maintenance to prevent breakdowns |
| **Corrective** | Fixing a known issue or malfunction |
| **Emergency** | Urgent unplanned repair |

---

## 8. Warranty Management

Each asset can have **multiple warranty periods**.

### Adding Warranties
During asset creation or editing:
1. In the **Warranty** section, click **Add More**.
2. Enter:
   - **Start Date** — When the warranty begins
   - **Duration (Months)** — The system calculates the end date automatically
   - **Additional Cost** — Extra warranty cost (if any)
   - **Notes** — Warranty terms or provider info

### Warranty Indicators
In the asset list and maintenance views:
- 🟢 **In Warranty** — At least one warranty covers today's date (shows days remaining)
- 🔴 **Not in Warranty** — No active warranty

### Expiry Alerts
The dashboard highlights assets with warranties expiring within 30 days.

---

## 9. Asset Condition & Status Tracking

### Condition
Tracks the physical state of an asset:

| Condition | Use Case |
|-----------|----------|
| **New** | Just acquired, unused |
| **Good** | Fully functional, minor wear |
| **Fair** | Functional but showing age |
| **Poor** | Barely functional, needs repair |
| **Damaged** | Non-functional, awaiting disposal or repair |

### Status
Tracks the operational state:

| Status | Use Case |
|--------|----------|
| **Active** | Currently in use or available |
| **Inactive** | Temporarily out of service |
| **Disposed** | Permanently removed from inventory |
| **Under Maintenance** | Currently being serviced |

---

## 10. Insurance & Disposal

### Insurance
Track insurance information per asset:
- **Insurance Policy** — Policy number or reference
- **Insurance Expiry** — When the policy expires

### Disposal
When an asset reaches end-of-life:
1. Edit the asset.
2. Set **Status** = "Disposed".
3. Fill in:
   - **Disposal Date** — When the asset was disposed
   - **Disposal Method** — Sold / Scrapped / Donated / Recycled
   - **Disposal Value** — Amount recovered from disposal

---

## 11. Depreciation & Book Value

### Configuration Per Asset
| Field | Description |
|-------|-------------|
| **Unit Price** | Original cost per unit |
| **Depreciation** | Annual depreciation amount |
| **Useful Life (Years)** | Expected lifespan |
| **Salvage Value** | Residual value at end of useful life |

### Calculation
The system uses **straight-line depreciation**:

$$\text{Book Value} = (\text{Quantity} \times \text{Unit Price}) - (\text{Annual Depreciation} \times \text{Years Elapsed})$$

The book value never falls below the salvage value.

### Dashboard View
Admins see:
- **Total Asset Value** — Sum of all asset costs
- **Total Depreciation** — Cumulative depreciation

---

## 12. Settings & Configuration

Navigate to **Asset Management → Settings**.

### Code Prefixes
| Setting | Purpose |
|---------|---------|
| Asset Code Prefix | Prefix for auto-generated asset codes |
| Allocation Code Prefix | Prefix for allocation reference numbers |
| Revoke Code Prefix | Prefix for revocation reference numbers |
| Maintenance Prefix | Prefix for maintenance IDs |

### Notification Templates
Configure email templates for:

1. **Asset Sent for Maintenance**
   - Subject and body with tags: `{asset_code}`, `{maintenance_id}`, `{status}`, `{priority}`, `{maintenance_note}`, `{created_by}`
   - Select recipients who should receive this notification
   - Enable/disable email delivery

2. **Asset Assigned for Maintenance**
   - Sent to the assigned technician when they are assigned
   - Subject and body with the same tags as above

---

## 13. User Permissions

| Permission | Description |
|------------|-------------|
| **View Assets** | View asset list and details |
| **Create Assets** | Create new assets |
| **Edit Assets** | Edit existing assets |
| **Delete Assets** | Delete assets |
| **Allocate Assets** | Allocate assets to users |
| **Revoke Assets** | Revoke allocated assets |
| **Manage Maintenance** | Create, edit, and delete maintenance records |
| **View All Maintenance** | View all maintenance records (select this or View Own) |
| **View Own Maintenance** | View only your own maintenance records (select this or View All) |
| **Manage Settings** | Access and modify asset settings |
| **View Reports** | Access asset reports and analytics |

### Permission Notes
- **View All Maintenance** and **View Own Maintenance** are mutually exclusive — a user gets one or the other.
- Admin/superadmin users have full access regardless of permission settings.
- The subscription must include the Asset Management feature for any permission to take effect.

---

## 14. Notifications

### Types

| Notification | Trigger | Recipients |
|-------------|---------|------------|
| **Asset Sent for Maintenance** | New maintenance record created | Users configured in Settings |
| **Asset Assigned for Maintenance** | Assigned-to user changed on maintenance record | The newly assigned user |

### Channels
- **Database** — Always active; appears in the notification bell
- **Email** — Can be toggled on/off in Settings for each notification type

### Template Tags
Available placeholders for notification templates:

| Tag | Replaced With |
|-----|---------------|
| `{asset_code}` | Asset code (e.g., AST-0001) |
| `{maintenance_id}` | Maintenance reference number |
| `{status}` | Current maintenance status label |
| `{priority}` | Priority label (High/Medium/Low) |
| `{maintenance_note}` | Note text from the maintenance form |
| `{send_for_maintenance_details}` | Details field content |
| `{created_by}` | Full name of the user who created the record |

---

## 15. Reports & Analytics

### Dashboard Reports
The admin dashboard provides visual summaries:
- **Assets by Category** — Quantity distribution across categories
- **Assets by Condition** — Breakdown by physical condition
- **Assets by Status** — Breakdown by operational status
- **Maintenance Summary** — Status distribution of maintenance records
- **Expiring Warranties** — List of assets with warranties ending within 30 days

### DataTable Exports
All asset lists (assets, allocations, revocations, maintenance) support:
- **Searching** — Global text search across visible columns
- **Sorting** — Click column headers to sort
- **Filtering** — Use dropdown filters for status, category, location, etc.

---

## 16. Best Practices

### Asset Onboarding
1. Create **categories** before adding assets (e.g., IT Equipment, Furniture, Vehicles).
2. Upload an **image** for visual identification.
3. Set up **warranty details** immediately upon purchase.
4. Fill in **insurance** information for high-value assets.
5. Set **useful life** and **salvage value** for depreciation tracking.

### Allocation Workflow
1. Mark assets as **allocatable** to enable the allocation feature.
2. Always record the **reason** for allocation (audit trail).
3. Set **allocated upto** dates for temporary assignments.
4. Use the **revocation** workflow to formally return assets.

### Maintenance Workflow
1. Use **Preventive** type for scheduled maintenance.
2. Assign a **responsible person** to track accountability.
3. Record **estimated cost** before work begins, **actual cost** after completion.
4. Update **status** promptly — this appears on the dashboard.
5. Use **attachments** to document before/after photos.

### Disposal Workflow
1. Change asset status to **Disposed**.
2. Record **disposal date**, **method**, and **value**.
3. Keep the record for audit and tax depreciation purposes.

---

## 17. Troubleshooting

| Issue | Solution |
|-------|----------|
| "Unauthorized action" error | Ensure the user has the required permission AND the business subscription includes the Asset Management feature |
| Asset not showing in allocation dropdown | Check that the asset is marked as **allocatable** and has available quantity (not fully allocated) |
| Warranty badge shows "Not in Warranty" | Verify the warranty start/end dates cover today's date |
| Notifications not received | Check Settings → notification recipients list and ensure email delivery is enabled |
| Asset code not auto-generating | Ensure the asset code prefix is configured in Settings |
| Cannot edit allocation | The allocation may be fully revoked; only partially-revoked allocations can be edited |
| Dashboard KPIs show zero | Ensure assets exist and have proper quantity and price values |
| Maintenance records not visible | Check that you have either `view_all_maintenance` or `view_own_maintenance` permission |

---

*This guide covers the Asset Management module (Enhanced version). For technical questions, contact your system administrator.*
