# Permissions Guide — Access Control

This guide explains how {application_name} manages permissions, roles, and who can access what.

---

## What You'll Learn

- How the permission system works
- How to create and configure roles
- How to assign granular permissions
- How superadmin access differs from regular roles
- Best practices for access control

---

## Permission System Overview

{application_name} uses a **role-based permission system**. Here's how it works:

| Concept | Description |
|---|---|
| **Permission** | A single ability (e.g., "View products", "Create a sale") |
| **Role** | A collection of permissions grouped together (e.g., "Cashier", "Manager") |
| **User** | A person assigned to one role |
| **Superadmin** | A special administrator with full unrestricted access |

---

## Superadmin vs Regular Roles

| Feature | Superadmin | Regular Roles |
|---|---|---|
| Access all businesses | ✅ Yes | ❌ No |
| Manage subscriptions | ✅ Yes | ❌ No |
| System settings | ✅ Yes | ❌ No |
| Module management | ✅ Yes | ❌ No |
| Override permissions | ✅ Yes | ❌ No |
| Defined by | System configuration (set by your administrator) | Assigned via User Management |

### How Superadmin Access is Set Up

Superadmin access is configured by your system administrator during initial setup. If you need superadmin access, contact the person who installed the system.

---

## Permission Categories

### Core Permissions

| Category | What You Can Control |
|---|---|
| **Products** | View, add, edit, and delete products |
| **Purchases** | View, add, edit, and delete purchase orders |
| **Sales** | View, add, edit, and delete sales and POS transactions |
| **Contacts** | View and add suppliers and customers |
| **Expenses** | Access expense tracking |
| **Reports** | Access reports and data analysis |

### Module Permissions

| Module | What You Can Control |
|---|---|
| **Essentials** | Staff management (HRM), reminders, to-do lists |
| **Accounting** | Financial accounts, journal entries |
| **Manufacturing** | Recipes, production, quality control, dashboard, status management |
| **CRM** | Follow-ups, proposals, and lead management |
| **Repair** | Repair jobs and device management |

---

## Creating a Role

1. Go to **User Management > Roles**
2. Click **Add Role**
3. Enter role name (e.g., "Store Manager")
4. Select permissions for each category
5. Click **Save**

### Recommended Role Templates

**Cashier:**
- POS access
- View own sales
- Cash register open/close

**Store Manager:**
- All sales and purchases
- Stock management
- View reports
- Manage cash registers

**Accountant:**
- View all transactions
- Access reports
- Manage expenses
- Payment accounts

---

## Location-Based Access

You can restrict users to specific business locations:

1. Edit the user profile
2. Under **Allowed Locations**, select specific locations
3. The user will only see data from those locations

---

## Best Practices

1. **Least Privilege** — Give users only the permissions they need
2. **Role-Based** — Create roles for job functions, not individuals
3. **Regular Audit** — Review permissions periodically
4. **Separate Admin** — Don't use the superadmin account for daily operations
5. **Location Restriction** — Limit multi-location users to relevant branches

---

## Troubleshooting

| Issue | Solution |
|---|---|
| User can't access a page | Check their role has the required permission |
| "Unauthorized" error | The permission is not assigned to the user's role |
| Can't see certain locations | Check location access settings in user profile |
| Superadmin features missing | Verify username is in `ADMINISTRATOR_USERNAMES` |

---

> **Tip:** Changes to permissions take effect immediately. Users may need to refresh their browser to see updated access.
