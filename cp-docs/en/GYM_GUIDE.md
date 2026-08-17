# Gym Module — Complete User Guide

The Gym module turns your POS into a full-featured gym management system. Manage members, sell membership packages, track attendance with biometric terminals, record body measurements, assign diet plans, schedule classes, and freeze/unfreeze memberships — all from one dashboard.

---

## What You'll Learn

- How to configure gym settings and biometric terminal integration
- How to create and manage gym members
- How to set up membership packages and classes
- How to create, edit, and manage subscriptions
- How to freeze and unfreeze memberships
- How to track daily attendance (manual and biometric)
- How to record health measurements and body metrics
- How to assign personalized diet plans
- How to use the gym dashboard for real-time insights
- How to generate and scan member ID cards with QR codes

---

## Part 1: Gym Settings

Before using the Gym module, configure your gym's contact details and (optionally) your biometric attendance terminal.

### How to Configure General Settings

1. Go to **Gym → Settings** from the left sidebar.
2. On the **General** tab, fill in:

   - **Phone** — Your gym's contact number
   - **Email** — Your gym's email address
   - **Website** — Your gym's website URL
   - **Address** — Full street address of the gym

3. Click **Save**.

📸 *[Screenshot: General settings tab with phone, email, website, and address fields]*

### How to Set Up a Biometric Attendance Terminal

If you use a ZKTeco biometric terminal for automated attendance, configure it here:

1. Go to **Gym → Settings**.
2. Switch to the **Attendance Terminal** tab.
3. Enter the **API Key** and **API Secret** from your terminal device.
4. Click **Save**.

Once credentials are saved, you will see action buttons:

- **Sync Attendance** — Imports attendance data from the biometric terminal
- **Clear Attendance Data** — Clears stored data on the terminal
- **Show Enrolled Members** — Displays members registered on the terminal
- **Download ZKTeco API** — Downloads the connector software needed for terminal integration

📸 *[Screenshot: Attendance terminal tab with API key fields and action buttons]*

> 💡 **Tip:** The biometric terminal connects through a local software running on the same computer as the terminal. Make sure the ZKTeco connector software is running before syncing attendance.

#### Compatible ZKTeco Models

The bundled connector uses the standard ZKTeco TCP/IP push protocol, so most network-enabled ZKTeco terminals are supported. The full list shown in **HRM → Attendance → Import Attendance** includes:

- **Fingerprint / RFID:** ZKT K14, K20, K30, K40, **K50**, K60, K70, K90, F18, F19, F22
- **Multi-bio (face + fingerprint):** ZKT MB20, MB160, MB360, **MB460**, MB560
- **iClock / SpeedFace / Network terminals:** iClock 360, 660, 880, 990, SpeedFace V5L, SpeedFace H5L, UA300, UA760
- **ADMS / BioSecurity push (visible-light face):** **SenseFace 2A**, SenseFace 4A, SenseFace 7C, ProFace X, SpeedFace M5, G4

> ✅ **Officially tested:** ZKT K50 and ZKT MB460 (TCP/IP) and SenseFace 2A (ADMS push). Other listed models share the same protocol family and work with the bundled connector or ADMS push. Cloud-only or proprietary OEM units are not guaranteed.

#### Live Push Setup (SenseFace 2A and other ADMS / BioSecurity terminals)

Newer ZKTeco face-recognition terminals push attendance to the application in real time — no Python connector or scheduled sync is needed.

1. In the application, open **HRM → Attendance → Import Attendance** and click **ADMS / SenseFace Devices**.
2. Click **Add Device**, enter the device's **Serial Number** (Menu → System Info on the terminal), keep *Generate push secret* checked, and save. Copy the displayed push token.
3. For each employee that punches in on the terminal, set their **Attendance UID** (on the user form) equal to the **User ID / PIN** enrolled on the device.
4. On the terminal, open **Comm. → Cloud Server / ADMS Setting** and configure:
    - **Server Mode:** ADMS
    - **Server Address:** *your application host* (e.g. `pos.example.com`)
    - **Server Port:** the port the application listens on (usually 80)
    - **HTTPS:** OFF (most ZK devices do not support HTTPS push)
    - **URL Path:** `/iclock/cdata?token=<push-token>`
5. Save settings and reboot the terminal. Within ~30 seconds, the **Last Seen** column on the device list will update.
6. Punch in on the device to verify — the record appears instantly under **HRM → Attendance**.

> 🔐 The push token is checked on every request. You can rotate it any time from the device list.

---

## Part 2: Managing Gym Members

Members are the core of your gym. Each member is a customer contact with additional gym-specific information.

### How to Add a New Member

1. Go to **Gym → Members** from the left sidebar.
2. Click the **Add** button at the top right.
3. Fill in the member form:

   - **Prefix** — Title (Mr., Mrs., Ms., etc.) — optional
   - **First Name** — Required
   - **Middle Name** — Optional
   - **Last Name** — Optional
   - **Mobile** — Required — the primary contact number
   - **Alternate Number** — Optional secondary number
   - **Landline** — Optional
   - **Email** — Optional
   - **Date of Birth** — Optional — date picker (cannot be a future date)
   - **Gender** — Male / Female / Other
   - **Address Line 1** — Required
   - **Address Line 2** — Optional
   - **City, State, Country, Zip Code** — Optional
   - **Profile Photo** — Optional — upload a member photo

4. Choose a save option:
   - **Save** — Creates the member and returns to the member list
   - **Save and Add Health** — Creates the member and immediately opens the health tracking form

📸 *[Screenshot: The Add Member form showing personal details, contact info, and address fields]*

> 💡 **Tip:** Use "Save and Add Health" for new members so you can record their initial body measurements right away during onboarding.

### How to Edit a Member

1. Go to **Gym → Members**.
2. Find the member in the list.
3. Click the **Actions** dropdown and select **Edit**.
4. Update the fields as needed.
5. Click **Update**.

### Member Actions

From the member list, each member has an **Actions** dropdown with:

| Action | What It Does |
|---|---|
| **Health** | Opens the health tracking page to record body measurements |
| **Profile** | Views the member's full profile page |
| **Edit** | Opens the edit form |
| **Subscription** | Creates a new subscription for this member |
| **Diets** | Opens the diet plan form for this member |

### Member Profile

The profile page shows a comprehensive view of a member, including:
- Personal information and photo
- Current subscription and package details
- Attendance history
- Health tracking records
- Diet plan

📸 *[Screenshot: Member profile page showing personal info, subscription status, and attendance]*

### Printing a Member ID Card

1. Go to **Gym → Members**.
2. Click the **Actions** dropdown on any member.
3. Select **Profile**.
4. On the profile page, find and click the **Print ID Card** option.

The ID card includes:
- Member photo
- Member name and contact ID
- Gym branding
- A **QR code** for quick scanning

📸 *[Screenshot: A printed member ID card with QR code]*

---

## Part 3: QR Code Scanner

The Gym module includes a built-in QR code scanner for quick member lookups at the front desk.

### How to Use the QR Scanner

1. Navigate to the QR scanner page (accessible from the gym menu).
2. Point your device camera at a member's ID card QR code.
3. The system reads the code and opens the member's details page.

The member details page shows:
- Personal information
- Current package and subscription status
- Recent attendance records
- Latest health measurements
- Upcoming classes
- Current diet plan

> 💡 **Tip:** The QR scanner works on mobile devices too — perfect for front-desk tablets at your gym entrance.

---

## Part 4: Membership Packages

Packages define what you sell — the membership type, price, duration, and included classes.

### How to Create a Package

1. Go to **Gym → Packages** from the left sidebar.
2. Click **Add** to open the package form.
3. Fill in:

   - **Name** — Package name (e.g., "Monthly Basic", "Annual Premium")
   - **Amount** — The price of the package
   - **Duration** — Choose from:
     - **Monthly** — 1 month from start date
     - **Quarterly** — 3 months from start date
     - **Half-Yearly** — 6 months from start date
     - **Yearly** — 1 year from start date
     - **Lifetime** — No expiry date
     - **Custom** — You set the end date manually when creating a subscription
   - **Classes** — Select which gym classes are included in this package (checkboxes)
   - **Notes** — Optional description or terms
   - **Enable** — Check to make the package available for sale
   - **Freeze Allowed** — Check to allow members on this package to freeze their membership
   - **Freeze Max Days** — Maximum total days a member can freeze (leave empty for unlimited)

4. Click **Save**.

📸 *[Screenshot: The Add Package form with name, amount, duration, classes, and freeze settings]*

### How to Edit a Package

1. Go to **Gym → Packages**.
2. Click the **Edit** button (pencil icon) on the package row.
3. Update the fields.
4. Click **Update**.

### How to Delete a Package

1. Go to **Gym → Packages**.
2. Click **Delete** on the package row.

> ⚠️ **Important:** You can only delete a package if it has **no subscriptions** linked to it. If members have subscribed to this package, the delete button will be hidden.

---

## Part 5: Gym Classes

Classes are scheduled activities (yoga, spinning, CrossFit, etc.) that can be included in packages.

### How to Create a Class

1. Go to **Gym → Classes** from the left sidebar.
2. Click **Add** to open the class form.
3. Fill in:

   - **Name** — Class name (e.g., "Morning Yoga", "Evening CrossFit")
   - **Description** — Optional details about the class
   - **Instructor** — Name of the instructor
   - **Start Time** — When the class begins
   - **End Time** — When the class ends
   - **Days of Week** — Which days this class runs (multi-select)
   - **Capacity** — Maximum number of members per session
   - **Status** — Active or Inactive

4. Click **Save**.

📸 *[Screenshot: The Add Class form with time, days, instructor, and capacity fields]*

### How to Edit or Delete a Class

- **Edit**: Click the edit button on the class row, update fields, click **Update**.
- **Delete**: Click the delete button on the class row and confirm.

> 💡 **Tip:** After creating classes, go to **Packages** and link them by checking the class checkboxes. Members on that package can then see their included classes.

---

## Part 6: Subscriptions

Subscriptions connect members to packages, creating a financial transaction with payment tracking.

### How to Create a Subscription

**Method 1: From the Subscriptions Page**

1. Go to **Gym → Subscriptions** from the left sidebar.
2. Click **Add** at the top right.
3. Fill in the subscription form:

   - **Business Location** — Select the gym location
   - **Customer** — Search for a member by name or phone. You can also add a new customer from here.
   - **Package** — Select the membership package. The price and duration auto-fill based on the package.
   - **Start Date** — When the membership begins
   - **End Date** — Auto-calculated from the package duration (read-only for non-custom packages)
   - **Is Recurring** — Enable for auto-recurring invoices (optional)
   - **Discount %** — Percentage discount on the package price (optional)
   - **Payment Method** — Cash, card, cheque, bank transfer, etc.
   - **Payment Amount** — How much the member is paying now

4. Review the **Summary Panel** on the right:
   - Package Name and Price
   - Discount amount
   - Total after discount
   - Change return
   - Balance due

5. Choose a save option:
   - **Save** — Creates the subscription
   - **Save and Print** — Creates the subscription and prints the invoice

**Method 2: From the Member List**

1. Go to **Gym → Members**.
2. Click the **Actions** dropdown on a member.
3. Select **Subscription**.
4. The form opens with the member pre-selected and any outstanding dues shown.

📸 *[Screenshot: The subscription creation form with customer, package, dates, and payment fields]*

### How to View a Subscription

1. Go to **Gym → Subscriptions**.
2. Click the **Actions** dropdown on a subscription.
3. Select **View**.

The view modal shows:
- Customer name and reference number
- Package name, start date, end date, and days remaining
- Included classes with their scheduled times
- Payment status and invoice number
- Total amount, amount paid, and balance due

### How to Edit a Subscription

1. Go to **Gym → Subscriptions**.
2. Click the **Actions** dropdown and select **Edit**.
3. Update the package, dates, payment, or other fields.
4. Click **Update**.

### How to Add a Payment to a Subscription

1. Go to **Gym → Subscriptions**.
2. Find a subscription with a **Due** or **Partial** payment status.
3. Click the **Actions** dropdown and select **Add Payment**.
4. Enter the payment amount and method in the modal.
5. Click **Save**.

### How to Print an Invoice

1. Go to **Gym → Subscriptions**.
2. Click the **Actions** dropdown and select **Print Invoice**.
3. The invoice opens in a new tab ready for printing.

### Subscription List Filters

The subscription list can be filtered by:
- **Customer** — Search for a specific member
- **Package** — Filter by membership package
- **Payment Status** — Paid, Due, Partial, or Overdue
- **Date Range** — Filter by subscription creation date

The footer row shows totals for **Total Amount**, **Total Paid**, and **Total Due** across all displayed subscriptions.

📸 *[Screenshot: Subscription list with filters, status badges, and action buttons]*

### Understanding Subscription Status Badges

Each subscription shows status badges in the Package column:

| Badge | Meaning |
|---|---|
| **X days remaining** | Active subscription with days until expiry |
| **Expired** (red) | Subscription has passed its end date |
| **Starts in X days** | Subscription hasn't started yet |
| **Lifetime** | No expiry date |
| **Frozen** (blue snowflake) | Membership is currently frozen/paused |
| **Cancelled** (red) | Subscription has been cancelled |

---

## Part 7: Freezing and Unfreezing Memberships

The freeze feature lets members temporarily pause their membership (e.g., for travel, injury, or vacation). The end date is automatically extended by the freeze period so members don't lose time.

### Prerequisites

- The member's package must have **Freeze Allowed** enabled
- The subscription must be **active** (not expired, not already frozen)
- If the package has a **Freeze Max Days** limit, the member must have remaining freeze days

### How to Freeze a Membership

1. Go to **Gym → Subscriptions**.
2. Find the active subscription you want to freeze.
3. Click the **Actions** dropdown.
4. Click **Freeze Membership** (snowflake icon).
5. A modal opens showing:
   - Package name
   - Maximum freeze days allowed
   - Total freeze days already used
   - Remaining freeze days available
6. Fill in:
   - **Freeze Start Date** — When the freeze begins
   - **Freeze End Date** — When the freeze ends
   - **Freeze Reason** — Optional reason for the freeze
7. Click **Freeze Membership**.

📸 *[Screenshot: The freeze membership modal with date pickers and package info]*

**What happens when you freeze:**
- The subscription status changes to **Frozen**
- The subscription end date is **extended** by the number of freeze days
- The freeze start date, end date, and total freeze days are recorded

> **Example:** A member has a subscription ending on March 31. They freeze for 10 days (March 1–10). Their new end date becomes April 10.

### How to Unfreeze a Membership

1. Go to **Gym → Subscriptions**.
2. Find the frozen subscription (shown with a blue **Frozen** badge).
3. Click the **Actions** dropdown.
4. Click **Unfreeze Membership** (play icon).
5. Confirm the action in the popup.

**What happens when you unfreeze early:**
- If the original freeze end date hasn't arrived yet, unused days are **reclaimed**
- The subscription end date is **shrunk back** by the unused days
- The total freeze days counter is reduced by the unused days
- The subscription status returns to **Active**

> **Example:** A member froze for 10 days (March 1–10) but unfreezes on March 6. Only 5 days were used, so 5 days are reclaimed and the end date is adjusted back by 5 days.

> 💡 **Tip:** The freeze feature requires the `gym.manage_freeze` permission. Make sure your staff roles have this permission if they need to manage freezes.

---

## Part 8: Attendance Tracking

Track when members arrive and leave the gym — manually or with biometric terminals.

### Manual Attendance (Daily View)

1. Go to **Gym → Attendance** from the left sidebar.
2. You'll see a list of all members with today's date.
3. For each member:
   - Click the **In Time** button to record their check-in time
   - Click the **Out Time** button to record their check-out time
4. A modal opens with a time picker. Select the time and click **Save**.

📸 *[Screenshot: Daily attendance view with In Time and Out Time buttons for each member]*

> 💡 **Tip:** If a member's time is already recorded, the button shows the recorded time. Click it again to edit.

### Biometric Attendance (Automatic)

If you have a ZKTeco biometric terminal configured:

1. Go to **Gym → Settings → Attendance Terminal** tab.
2. Click **Sync Attendance**.
3. The system contacts your biometric terminal, downloads all attendance events, and creates records automatically.

The sync process:
- **Check-in events** from the terminal create a new attendance record with the arrival time
- **Check-out events** from the terminal update the record with the departure time
- Duplicate records for the same member on the same day are prevented

### Attendance Report

1. Go to **Gym → Attendance Report** from the left sidebar.
2. Filter by:
   - **Member** — Select a specific member
   - **Date Range** — Choose a date range
3. The report shows:
   - Date
   - Member name
   - Contact ID
   - Email and Mobile
   - In-time and Out-time

📸 *[Screenshot: Attendance report with date range filter and member details]*

---

## Part 9: Health Tracking

Record body measurements and health metrics over time to help members track their fitness progress.

### How to Record Health Measurements

1. Go to **Gym → Members**.
2. Click the **Actions** dropdown on a member.
3. Select **Health**.
4. Fill in the measurement form:

   | Field | Description |
   |---|---|
   | **Date** | Date of measurement |
   | **Weight** | Body weight in kg |
   | **Height** | Height in cm |
   | **BMI** | Body Mass Index |
   | **Body Fat %** | Body fat percentage |
   | **Visceral Fat** | Visceral fat level |
   | **Subcutaneous Fat** | Subcutaneous fat level |
   | **Muscle Mass %** | Muscle mass percentage |
   | **Neck** | Neck circumference |
   | **Left Arm / Right Arm** | Arm circumference |
   | **Chest** | Chest circumference |
   | **Shoulders** | Shoulder width |
   | **Upper Waist / Lower Waist** | Waist measurements |
   | **Hips** | Hip circumference |
   | **Left Thigh / Right Thigh** | Thigh circumference |
   | **Calf** | Calf circumference |
   | **Remarks** | Free-form notes |

5. Click **Save**.

📸 *[Screenshot: Health tracking form with body measurement fields]*

### Viewing Health History

Below the measurement form, you'll see a table of all previous health records for the member, sorted by date. This lets you:

- Track weight changes over time
- Monitor body composition improvements
- Compare measurements between sessions

> 💡 **Tip:** The system automatically calculates **BMI** from weight and height, classifies it (Underweight / Normal / Overweight / Obese), and calculates **BMR** (how many calories your body burns at rest). Weight change compared to the previous record is also tracked automatically.

---

## Part 10: Diet Plans

Assign personalized daily nutrition plans to help members reach their fitness goals.

### How to Create or Update a Diet Plan

1. Go to **Gym → Members**.
2. Click the **Actions** dropdown on a member.
3. Select **Diets**.
4. Fill in the 10 meal slots:

   | Meal Slot | Example |
   |---|---|
   | **Morning** | Warm lemon water, 5 soaked almonds |
   | **Breakfast** | Oatmeal with fruits, 2 boiled eggs |
   | **Before Lunch** | Green tea, mixed nuts |
   | **Lunch** | Grilled chicken breast, brown rice, salad |
   | **Afternoon** | Protein shake, apple |
   | **Evening** | Vegetable soup, whole wheat toast |
   | **Dinner** | Grilled fish, steamed vegetables |
   | **Before Sleep** | Warm milk with turmeric |
   | **Before Workout** | Banana, peanut butter toast |
   | **After Workout** | Whey protein, banana |
   | **Remarks** | Drink 3–4 liters of water daily |

5. Click **Save**.

📸 *[Screenshot: Diet plan form with 10 meal slots and remarks]*

> 💡 **Tip:** Each member has exactly one diet plan. If a plan already exists, the form loads the existing plan for editing. Saving always updates the existing plan.

---

## Part 11: Gym Dashboard

The dashboard provides a real-time overview of your gym operations at a glance.

### Dashboard Metrics

**Row 1 — Membership Overview:**
| Metric | Description |
|---|---|
| Total Members | Total registered gym members |
| Active Members | Members with a current (non-expired) subscription |
| New This Month | Members registered in the current month |
| Expired Members | Members whose subscriptions have expired |

**Row 2 — Revenue & Attendance:**
| Metric | Description |
|---|---|
| Total Revenue | Sum of all subscription payments received |
| Monthly Revenue | Revenue collected in the current month |
| Total Due | Outstanding balance across all subscriptions |
| Today's Attendance | Number of members currently inside the gym |

**Row 3 — Quick Counts:**
| Metric | Description |
|---|---|
| Total Packages | Number of packages available |
| Total Classes | Number of classes defined |
| Today's Check-ins | Total check-ins recorded today |
| Avg Daily Attendance | Average daily attendance over the last 30 days |

**Row 4 — Analytics:**
- **Package Popularity** — Top 5 most subscribed packages with subscriber count
- **Gender Distribution** — Breakdown of members by gender (Male / Female / Other)

**Row 5 — Growth:**
- **Monthly Membership Growth** — New member registrations over the last 6 months

**Row 6 — Today's Activity:**
- **Today's Attendance List** — Members checked in today with in/out times
- **Expiring Soon** — Subscriptions expiring within the next 7 days with member name, package, and end date

📸 *[Screenshot: Gym dashboard showing all metric cards, tables, and charts]*

---

## Part 12: Permissions

The Gym module uses role-based permissions to control access. Assign these permissions to user roles as needed:

| Permission | Controls |
|---|---|
| **Manage Members** | Create, edit, view members; profile and ID card |
| **Manage Health** | Record and view health measurements |
| **Manage Attendance** | Check-in/out, sync terminal, view attendance report |
| **Manage Packages** | Create, edit, delete packages |
| **Manage Classes** | Create, edit, delete classes |
| **Manage Diets** | Create and edit diet plans |
| **Manage Freezes** | Freeze and unfreeze memberships |
| **Manage Settings** | Configure gym settings |
| **View Sales** | View subscription details |
| **Edit Sales** | Edit subscriptions |
| **Delete Sales** | Delete subscriptions |
| **Manage Payments** | Add, view, and edit payments on subscriptions |
| **Print Invoice** | Print subscription invoices |

> 💡 **Tip:** Go to **User Management → Roles** to assign Gym permissions to your staff roles.

---

## Frequently Asked Questions

### Can a member have multiple active subscriptions?

Yes. A member can have multiple subscriptions to different packages at the same time. Each subscription is tracked independently.

### What happens when a subscription expires?

The subscription status shows as **Expired** with a red badge. The member can still be seen in the member list, but they will need a new subscription to continue.

### Can I offer a discount on a subscription?

Yes. When creating or editing a subscription, enter a **Discount %** value. The discount is applied to the package price, and the total is recalculated.

### Can I track partial payments?

Yes. When creating a subscription, you can enter a partial payment amount. The subscription will show as **Partial** payment status. You can add more payments later from the subscription list.

### How does the biometric terminal sync work?

The system connects to a ZKTeco device running a local connector software on the same computer. Check-in events create attendance records, and check-out events update them. Duplicate entries are prevented automatically.

### Can I freeze a Lifetime membership?

Yes, as long as the package has **Freeze Allowed** enabled. Since lifetime memberships have no end date, the freeze is recorded but the end date extension doesn't apply.

### How do I see which classes are included in a package?

View any subscription linked to that package — the subscription detail modal shows all included classes with their names and scheduled times.

### Can I print reports?

The attendance report and subscription list pages support browser printing. Use your browser's print function (Ctrl+P) to print any page with data tables.

---

## Quick Reference: Navigation

| Menu Item | Where It Goes |
|---|---|
| Gym → Dashboard | Overview of all gym metrics |
| Gym → Members | Member list and management |
| Gym → Subscriptions | Subscription list and management |
| Gym → Packages | Package configuration |
| Gym → Classes | Class scheduling |
| Gym → Attendance | Daily attendance tracking |
| Gym → Attendance Report | Historical attendance report |
| Gym → Settings | Gym settings and terminal config |
