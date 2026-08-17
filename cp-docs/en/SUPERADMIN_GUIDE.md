# Superadmin Module — User Manual

Welcome to the **{application_name} Superadmin Module**. This guide covers every feature available to the Superadmin — the platform-level administrator who manages all businesses, subscriptions, packages, coupons, messaging, and system settings.

---

## Table of Contents

1. [Overview](#overview)
2. [Accessing the Superadmin Panel](#accessing-the-superadmin-panel)
3. [Dashboard](#dashboard)
4. [Business Management](#business-management)
5. [Subscription Packages](#subscription-packages)
6. [Subscriptions](#subscriptions)
7. [Coupons](#coupons)
8. [Communicator (Messaging)](#communicator-messaging)
9. [Settings](#settings)
10. [Pricing Page](#pricing-page)
11. [Tips & Best Practices](#tips--best-practices)

---

## Overview

The Superadmin module turns **{application_name}** into a **SaaS (Software as a Service)** platform. As a Superadmin you can:

- Register and manage multiple businesses from a single panel
- Create subscription packages with different feature limits
- Monitor subscriptions, revenue, and business health in real time
- Communicate with business owners via in-app messaging
- Offer coupon discounts on subscription packages
- Configure payment gateways, email settings, and system-wide preferences

> 💡 **Note:** Only users with the **Superadmin** permission can access this module. Regular business users will never see the Superadmin menu.

---

## Accessing the Superadmin Panel

1. Log in with a user account that has **Superadmin** privileges.
2. In the left sidebar, look for the **Superadmin** menu (red background).
3. Click to expand the sub-menu and select any section.

📸 *[Screenshot: Sidebar with the Superadmin menu expanded showing Dashboard, All Businesses, Subscriptions, Packages, Coupons, Settings, Communicator]*

The sidebar gives you quick access to:

| Menu Item | Description |
|---|---|
| **Superadmin (Dashboard)** | Platform-wide KPIs and analytics |
| **All Businesses** | List, search, and manage registered businesses |
| **Package Subscription** | View and manage all subscriptions |
| **Packages** | Create and edit subscription packages |
| **Coupons** | Manage discount coupons |
| **Settings** | System-wide configuration |
| **Communicator** | Send messages to business owners |

---

## Dashboard

The Superadmin Dashboard provides a **real-time overview** of your entire platform at a glance.

### Key Performance Indicators (KPIs)

The dashboard displays these metrics in easy-to-read cards:

| KPI | What It Means |
|---|---|
| **Total Businesses** | Total number of registered businesses |
| **Active Businesses** | Businesses with at least one active subscription |
| **Inactive Businesses** | Businesses with no active subscription |
| **Active Subscriptions** | Currently running (non-expired) approved subscriptions |
| **Expiring Soon** | Subscriptions expiring within the next 7 days |
| **Pending Approvals** | Subscriptions waiting for your approval (offline payments) |
| **MRR (Monthly Recurring Revenue)** | Estimated monthly revenue from active subscriptions |
| **Total Revenue** | Lifetime revenue from all approved subscriptions |

📸 *[Screenshot: Dashboard KPI cards showing all 8 metrics]*

### Revenue Chart

Below the KPIs, a **12-month revenue chart** shows subscription revenue trends over time. Use the date range selector to filter the period.

📸 *[Screenshot: Revenue trend chart with date filters]*

### Top Packages

A ranking widget shows your **top 5 packages** by active subscriber count, helping you understand which plans are most popular.

### Quick Actions

Six shortcut buttons let you quickly navigate to common tasks:

- **Add Business** — Register a new business
- **Add Package** — Create a new subscription package
- **Send Message** — Open the Communicator
- **Subscriptions** — View all subscriptions
- **Add Coupon** — Create a new discount coupon
- **Settings** — Open Superadmin settings

📸 *[Screenshot: Quick Actions grid with 6 shortcut buttons]*

### Subscription Rate

A summary card shows the percentage of businesses with active subscriptions versus total registered businesses.

---

## Business Management

Navigate to **Superadmin → All Businesses** to manage every registered business.

### Business List

The business list shows all registered businesses in a searchable, sortable DataTable with columns:

- Business Name
- Owner
- Contact Information (email, phone)
- Location (city, state, country)
- Current Package
- Subscription Start / End Dates
- Status
- Registration Date

📸 *[Screenshot: Business listing table with search and filters]*

### Filtering & Search

- Use the **search bar** at the top to find businesses by name, owner, or email.
- Use the **Package** and **Subscription Status** dropdown filters to narrow results.
- Click column headers to sort ascending/descending.

### Export to CSV

Click the **Export CSV** button in the top-right corner to download the complete business list as a CSV file. The export respects any active filters, so you can:

1. Filter by a specific package or status
2. Click **Export CSV**
3. Open the downloaded file in Excel or Google Sheets

📸 *[Screenshot: Export CSV button highlighted]*

### View Business Details

Click on a business name to open the **Business Detail** page, which shows:

- **Business Information** — Name, logo, owner details, contact info
- **Business Locations** — All registered locations for the business
- **Subscription History** — Every subscription the business has taken
- **Quick Actions** — Manage password, add subscription, delete business

📸 *[Screenshot: Business detail page with tabs]*

### Add a New Business

1. Click **Add Business** from the dashboard Quick Actions or the business list page.
2. Fill in the required fields: Business Name, Owner Name, Email, Password.
3. Optionally assign a subscription package.
4. Click **Save**.

> 💡 **Tip:** The business owner can change their own business details after logging in. You only need to set the initial registration info.

### Manage Password

For any business, you can reset the owner's password:

1. Go to the Business Detail page.
2. Click **Manage Password**.
3. Enter a new password or generate one.
4. Click **Update Password**.

The owner will receive a notification with their new credentials.

### Delete a Business

1. On the Business Detail page, click **Delete Business**.
2. Confirm the deletion in the popup.

> ⚠️ **Warning:** Deleting a business is **permanent** and removes all its data. You cannot delete the business you are currently logged into.

---

## Subscription Packages

Navigate to **Superadmin → Packages** to manage your subscription plans.

### Package Overview

Packages are displayed as **visual cards** showing:

- Package name and price
- Badges: Popular, Active/Inactive, Private, One-Time
- Feature limits: Locations, Users, Products, Invoices
- Trial days (if applicable)
- Custom permissions
- **Active Subscribers** count — how many businesses use this package
- **Revenue** — total revenue generated by this package

📸 *[Screenshot: Package cards with subscriber counts and revenue indicators]*

### Create a Package

1. Click **Add Package** (or the **+** button).
2. Fill in the fields:

| Field | Description |
|---|---|
| **Name** | Display name of the package |
| **Description** | Short description shown to customers |
| **Price** | Subscription price (0 = free) |
| **Interval** | Billing frequency (days, months, years) |
| **Interval Count** | Number of intervals (e.g., 1 month, 6 months) |
| **Trial Days** | Free trial period in days (0 = no trial) |
| **Location Count** | Max business locations (0 = unlimited) |
| **User Count** | Max active users (0 = unlimited) |
| **Product Count** | Max products (0 = unlimited) |
| **Invoice Count** | Max invoices (0 = unlimited) |
| **Sort Order** | Display order on pricing page |
| **Is Active** | Enable/disable the package |
| **Mark as Popular** | Highlight as a recommended plan |
| **Private** | Only visible to Superadmin (not on pricing page) |
| **One-Time** | Business can only subscribe to this plan once |

3. Configure **Custom Permissions** to enable/disable specific features for this plan.
4. Click **Save**.

📸 *[Screenshot: Package creation form with all fields]*

### Edit a Package

1. On the package card, click the **Edit** button.
2. Modify any fields.
3. Check **Update existing subscriptions** if you want changes to apply to current subscribers.
4. Click **Save**.

> 💡 **Tip:** Updating existing subscriptions will modify the feature limits for businesses currently on that package.

### Delete a Package

1. Click the **Delete** button on the package card.
2. Confirm the deletion.

> ⚠️ **Warning:** Deleting a package does not cancel existing subscriptions, but new businesses cannot subscribe to it.

### Search Packages

Use the search bar above the cards to quickly find packages by name. The search auto-submits after a brief pause.

---

## Subscriptions

Navigate to **Superadmin → Package Subscription** to manage all subscriptions across your platform.

### Summary Cards

At the top of the page, four summary cards provide an instant overview:

| Card | Description |
|---|---|
| **Total Subscriptions** | Lifetime count of all subscriptions |
| **Active Subscriptions** | Currently running approved subscriptions |
| **Waiting** | Subscriptions pending your approval |
| **Total Revenue** | Lifetime revenue from approved subscriptions |

📸 *[Screenshot: Subscription summary cards]*

### Subscription Table

The main table lists every subscription with columns:

- Business Name
- Package Name
- Status (Approved / Waiting / Declined)
- Created Date
- Start Date
- Trial End Date
- End Date
- Coupon Code (if used)
- Original Price
- Paid Amount
- Paid Via (payment method)
- Payment Transaction ID
- Actions

### Filtering Subscriptions

Use the filter bar above the table to narrow results:

- **Package** — Select a specific package
- **Status** — Filter by Approved, Waiting, or Declined
- **Date Range** — Select a date range for the created date

📸 *[Screenshot: Subscription filters with package dropdown and date picker]*

### Approve / Decline Subscriptions

For **offline payment** subscriptions that are in "Waiting" status:

1. Click the **Status** button next to the subscription.
2. In the modal, select **Approved** or **Declined**.
3. Click **Update**.

📸 *[Screenshot: Status change modal]*

### Edit a Subscription

1. Click the **Edit** button next to any subscription.
2. Modify the start date, end date, or status.
3. Click **Save**.

### Add a Manual Subscription

From the **Business Detail** page:

1. Click **Add Subscription**.
2. Select a package and payment gateway.
3. Click **Subscribe**.

---

## Coupons

Navigate to **Superadmin → Coupons** to manage discount coupons for subscription packages.

### Coupon List

The coupon list displays all coupons in a DataTable with:

- Coupon Code
- Discount Type (fixed or percentage)
- Discount Amount
- Expiry Date
- Applied Packages
- Applied Businesses
- Status (Active/Inactive)

📸 *[Screenshot: Coupon listing table]*

### Create a Coupon

1. Click **Add New Coupon**.
2. Fill in the fields:

| Field | Description |
|---|---|
| **Coupon Code** | Unique code that customers enter at checkout |
| **Discount Type** | Fixed amount or percentage |
| **Discount** | The discount value |
| **Expiry Date** | When the coupon expires |
| **Applied Packages** | Restrict to specific packages (empty = all) |
| **Applied Businesses** | Restrict to specific businesses (empty = all) |
| **Is Active** | Enable or disable the coupon |

3. Click **Save**.

📸 *[Screenshot: Coupon creation form]*

### Edit / Delete Coupons

- Click **Edit** to modify an existing coupon.
- Click **Delete** and confirm to remove a coupon.

> 💡 **Tip:** Coupons that are restricted to specific packages will only work during checkout for those packages. Leave the "Applied on packages" field empty to make the coupon work for all packages.

---

## Communicator (Messaging)

Navigate to **Superadmin → Communicator** to send messages to business owners.

### Compose a Message

1. **Select Recipients** — Use the multi-select dropdown to choose businesses. Use **Select All** / **Deselect All** buttons for bulk selection.
   - A live counter shows how many recipients are currently selected.
2. **Subject** — Enter the message subject line.
3. **Message** — Write your message in the rich text editor (supports formatting, links, images).
4. Click **Send**.
5. Confirm in the popup dialog.

📸 *[Screenshot: Compose message form with recipient counter]*

### Message History

Below the compose form, a **Message History** table lists all previously sent messages with:

- Subject
- Message content
- Date sent

📸 *[Screenshot: Message history table]*

> 💡 **Tip:** Messages are delivered as in-app notifications to selected business owners. They will see the message the next time they log in.

---

## Settings

Navigate to **Superadmin → Settings** to configure system-wide preferences.

### Application Settings

| Setting | Description |
|---|---|
| **App Name** | The application name displayed throughout the system |
| **App Title** | Browser tab title |
| **Default Language** | Default language for new businesses |
| **Allow Registration** | Enable/disable self-registration for new businesses |
| **Disable Pricing** | Hide the pricing page from public |
| **Enable Terms & Conditions** | Show T&C checkbox during registration |

📸 *[Screenshot: Application settings form]*

### Email / SMTP Settings

Configure the email system so your platform can send emails (welcome messages, notifications, etc.):

| Setting | Description |
|---|---|
| **Mail Driver** | The email service to use (e.g., SMTP) |
| **Mail Host** | Your email server address (provided by your email service) |
| **Mail Port** | Connection port number (usually 587 or 465) |
| **Username / Password** | Your email account login details |
| **Encryption** | Security type (TLS or SSL) |
| **From Address / Name** | The sender name and email that appears on outgoing emails |

📸 *[Screenshot: SMTP settings form]*

> 💡 **Tip:** Enable **Allow businesses to use Superadmin email configuration** to share your SMTP settings with all businesses. They won't see the credentials, but their emails will be sent through your server.

### Payment Gateways

Configure one or more payment gateways so businesses can pay for their subscriptions online. Each gateway requires specific credentials that you get when you sign up with that payment provider:

| Gateway | What You Need |
|---|---|
| **Stripe** | Your Stripe account keys (get them from your Stripe dashboard) |
| **PayPal** | Your PayPal app credentials (get them from PayPal developer portal) |
| **Razorpay** | Your Razorpay account keys |
| **Pesapal** | Your Pesapal account credentials |
| **Paystack** | Your Paystack account keys |
| **Flutterwave** | Your Flutterwave account keys |
| **JazzCash** | Your JazzCash merchant credentials |
| **Easypaisa** | Your Easypaisa merchant credentials |
| **Meezan** | Your Meezan merchant credentials |
| **Offline Payment** | Enable manual bank transfer with instructions |

📸 *[Screenshot: Payment gateway configuration]*

> ⚙️ **Important (PayPal):** Make sure to switch to **Live** mode when accepting real payments. The test (Sandbox) mode is only for trying things out. After switching, enter your live PayPal credentials.

### Notification Settings

Control which email notifications are sent:

- **New Business Registration** — Email sent to Superadmin when a new business registers
- **Welcome Email** — Email sent to the new business owner
- **New Subscription** — Email sent to Superadmin when a subscription is created

Customise the **Welcome Email** template with subject and body fields.

### Subscription Settings

| Setting | Description |
|---|---|
| **Package Expiry Alert Days** | Number of days before expiry to send an alert |
| **Enable Business-Based Username** | Suffix business ID to usernames for uniqueness |
| **Enable Custom Subscription Link** | Custom URL and text for subscription buttons |

### Live Notifications (Pusher)

For real-time pop-up notifications (so users see updates instantly without refreshing), you can set up a Pusher account. Enter the credentials from your Pusher dashboard:

- App ID, App Key, App Secret, App Cluster

> 💡 **Tip:** Pusher is optional. Without it, notifications still work but users need to refresh the page to see new ones.

### Additional Customisation

Add custom code that will appear on every page. This is useful for:

- Adding tracking tools (like Google Analytics or similar)
- Custom styling or branding adjustments
- Third-party widgets (like chat tools)

> 💡 **Tip:** If you're not sure what to put here, you can safely skip this section. Ask a web developer if you need help adding custom code.

### Backup

Configure automatic database backups:

- **Backup Disk** — Local, Dropbox, or other storage
- **Dropbox Access Token** — For cloud backup storage

---

## Pricing Page

The public **Pricing Page** shows all active, non-private packages to potential customers. The page is automatically generated from your packages.

- **Popular** packages are highlighted with a badge
- Each package shows its features and price
- Customers can click **Subscribe** to register and pay

You can **hide the pricing page** from **Settings → Application Settings → Disable Pricing**.

---

## Tips & Best Practices

### Package Strategy

- **Free Tier** — Always offer a free package with limited features to attract new businesses.
- **Popular Package** — Mark your most-subscribed plan as "Popular" for social proof.
- **Private Packages** — Use private packages for special deals or enterprise clients.
- **One-Time Packages** — Use for migration offers or lifetime deals.

### Revenue Monitoring

- Check the **Dashboard MRR** daily to track revenue health.
- Watch the **Expiring Soon** count and proactively reach out to businesses near expiry.
- Review the **Pending Approvals** count regularly to avoid delayed activations.

### Communication

- Use the **Communicator** to announce new features, maintenance, or promotions.
- Send targeted messages to businesses on specific packages.

### Data Export

- Regularly **export business data** to CSV for offline analysis or reporting.
- Use subscription filters to generate reports by package, status, or date range.

### Security

- Regularly update Superadmin passwords.
- Use strong SMTP credentials and enable TLS encryption.
- Review business registrations for suspicious activity.

---

## Frequently Asked Questions

**Q: Can I have multiple Superadmin users?**
A: Yes. Any user with the "superadmin" permission can access the Superadmin module.

**Q: What happens when a subscription expires?**
A: The business owner sees an expiry notice and is redirected to the subscription/pricing page. Their data is preserved but access is limited until they renew.

**Q: How do offline payments work?**
A: When a business selects "Offline Payment," the subscription enters "Waiting" status. You review and **Approve** or **Decline** from the Subscriptions page.

**Q: Can I change a package's price after businesses have subscribed?**
A: Yes. By default, existing subscriptions keep their original price. Check **Update existing subscriptions** when editing to apply changes to current subscribers.

**Q: How do coupon codes work?**
A: Businesses enter the coupon code during checkout. The discount is applied to the package price. You can restrict coupons to specific packages or businesses.

---

*This guide covers {application_name} Superadmin Module. For other features, please refer to the respective module documentation.*
