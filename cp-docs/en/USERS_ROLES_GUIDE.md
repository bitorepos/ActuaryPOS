# Users & Roles — Managing Who Can Do What

Controlling who can access your system — and what they're allowed to do — is essential for security and smooth operations. This guide covers how to add users, create roles, and set permissions.

---

## What You'll Learn

- How to add new users
- How to create roles with specific permissions
- How to assign roles to users
- How to manage user access
- How to set up sales commission agents

---

## Understanding Users, Roles, and Permissions

| Term | What It Means |
|---|---|
| **User** | A person who logs in to {application_name} (e.g., a cashier, manager, or admin) |
| **Role** | A job title with a defined set of permissions (e.g., "Cashier", "Manager") |
| **Permission** | A specific ability (e.g., "Can add products", "Can view reports") |

Think of it this way:
- You create **Roles** (like job descriptions)
- Each role has **Permissions** (what that job is allowed to do)
- You assign a **Role** to each **User** (so they get the right access)

---

## How to Add a New User

1. Go to **User Management → Users** from the left sidebar.
2. Click **Add** at the top right.
3. Fill in the details:

### Personal Information
   - **Name Prefix** — Mr, Mrs, Ms, etc.
   - **First Name** — The user's first name
   - **Last Name** — The user's last name
   - **Email** — Their email address (used for notifications)

### Login Credentials
   - **Username** — What they'll use to log in (must be unique)
   - **Password** — A strong password (at least 8 characters)
   - **Confirm Password** — Enter the password again

### Access Settings
   - **Role** — Choose a role (e.g., "Cashier", "Manager", "Admin")
   - **Business Location** — Which location(s) this user can access
   - **Is Active?** — Turn on to allow login, turn off to block access

4. Click **Save**.

📸 *[Screenshot: The Add User form with all sections visible]*

> 💡 **Tip:** Always create individual accounts for each person. Never share login credentials — it's important for security and tracking.

---

## How to Edit or Deactivate a User

1. Go to **User Management → Users**.
2. Find the user in the list.
3. Click **Actions** → **Edit**.
4. Make your changes:
   - To **block** a user's access, uncheck **Is Active?**
   - To **change their role**, select a new one from the Role dropdown
   - To **reset their password**, enter a new password in the password field
5. Click **Update**.

📸 *[Screenshot: The user list with the Actions dropdown]*

> ⚠️ **Important:** Deactivating a user blocks their login immediately but preserves all their transaction history.

---

## How to Create a Role

Roles define what each type of user is allowed to do.

1. Go to **User Management → Roles**.
2. Click **Add** at the top right.
3. Enter a **Role Name** (e.g., "Cashier", "Stock Manager", "Branch Manager").
4. Check the permissions this role should have:

### Permission Categories

| Category | What It Controls |
|---|---|
| **User** | Manage users (view, add, edit, delete) |
| **Suppliers** | Manage supplier contacts |
| **Customers** | Manage customer contacts |
| **Products** | View, add, edit, delete products |
| **Purchases** | Create and manage purchases |
| **Sells (POS)** | Access the POS screen and make sales |
| **Sells (Direct)** | Create direct sales and invoices |
| **Stock Adjustment** | Adjust stock levels |
| **Stock Transfer** | Transfer stock between locations |
| **Expenses** | Add and manage expenses |
| **Reports** | View business reports |
| **Settings** | Access business settings |
| **Tax Rates** | Manage tax rates |
| **Payments** | Record payments |
| **Accounts** | Manage payment accounts |
| **Backup** | Access database backup |

5. For each permission, you'll see options like:
   - **View All** — See everything
   - **View Own** — Only see their own records
   - **Add** — Create new records
   - **Edit** — Modify existing records
   - **Delete** — Remove records

6. Click **Save**.

📸 *[Screenshot: The Add Role form showing permission checkboxes]*

### Example Roles

Here are some common role setups:

**Cashier:**
- ✅ POS Sale (view own, add)
- ✅ Cash Register (open, close)
- ❌ Everything else

**Stock Manager:**
- ✅ Products (view all, add, edit)
- ✅ Purchases (view all, add, edit)
- ✅ Stock Adjustment (view all, add)
- ✅ Stock Transfer (view all, add)
- ❌ Settings, Users, Reports

**Branch Manager:**
- ✅ Most features for their location
- ✅ Reports (view all)
- ❌ Settings, User Management, Backup

**Administrator:**
- ✅ Everything

---

## Sales Commission Agents

If your sales staff earn commission, you can set them up as commission agents:

1. Go to **User Management → Sales Commission Agents**.
2. Click **Add** to create a new agent.
3. Enter:
   - **Name Prefix**, **First Name**, **Last Name**
   - **Email** and **Contact Number**
   - **Address** details
   - **Commission Percentage** — How much they earn per sale (e.g., 5%)
4. Click **Save**.

When creating a sale, you can select a commission agent. Their commission is calculated automatically.

📸 *[Screenshot: The Add Commission Agent form]*

> 💡 **Tip:** View commission earnings in the **Sales Representative Report** under Reports.

---

## User Settings (Personal Preferences)

Each user can adjust their own settings:

1. Click your name at the top-right corner of the screen.
2. Select **Profile**.
3. You can change:
   - **Password** — Update your login password
   - **Language** — Switch the interface language
   - **Other preferences** — Based on role

📸 *[Screenshot: The user profile page]*

---

## Sign In As Another User

Administrators can temporarily log in as another user to troubleshoot issues:

1. Go to **User Management → Users**.
2. Click **Actions → Sign In As** next to the user.
3. You'll be logged in as that user.
4. To return, click **Back to Admin** or log out.

> ⚠️ **Important:** Use this feature only for troubleshooting. All actions will be logged under the user's account.

---

## Settings & Options

| Setting | What It Does | Where to Find It |
|---|---|---|
| **Username Prefix** | Adds a prefix to auto-generated usernames | **Settings → Business Settings → Prefixes** |
| **Commission Agent Setting** | Enable/disable commission agents | **Settings → Business Settings → Sale** |
| **User Management Module** | Enable/disable user management features | Always enabled by default |

---

## Common Questions

**Q: Can a user have multiple roles?**
A: Each user is assigned one role. To give someone broader access, create a custom role with all the needed permissions.

**Q: What happens when I deactivate a user?**
A: They can't log in anymore, but all their past work (sales, purchases, etc.) is preserved.

**Q: Can different users see different locations?**
A: Yes! When editing a user, you can assign them to specific business locations. They'll only see data from those locations.

**Q: How do I know who did what in the system?**
A: Check the **Activity Log** under Reports. It shows every action taken by every user.

---

## Tips & Best Practices

- 📌 Follow the **principle of least access** — only give users the permissions they need
- 📌 Create separate roles for different job functions instead of giving everyone admin access
- 📌 Review user accounts regularly and **deactivate** anyone who no longer works for you
- 📌 Use the **Activity Log** to monitor unusual activity
- 📌 Never share login credentials between users