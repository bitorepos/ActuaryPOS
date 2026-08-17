# Repair Module - User Manual

## Table of Contents
1. [Overview](#overview)
2. [Dashboard](#dashboard)
3. [Job Sheets](#job-sheets)
4. [Repair Invoices](#repair-invoices)
5. [Device Models](#device-models)
6. [Repair Statuses](#repair-statuses)
7. [Customer Repair Status Check](#customer-repair-status-check)
8. [Priority & Triage](#priority--triage)
9. [Parts Management](#parts-management)
10. [Checklists](#checklists)
11. [Notifications (SMS & Email)](#notifications-sms--email)
12. [Warranty Tracking](#warranty-tracking)
13. [Labels & Printing](#labels--printing)
14. [Document Uploads](#document-uploads)
15. [Collection Info](#collection-info)
16. [Settings](#settings)
17. [Permissions](#permissions)
18. [Tips & Best Practices](#tips--best-practices)

---

## Overview

The **Repair Module** is a complete workshop management solution integrated into BitorePOS. It is designed for businesses that offer device repair services — mobile phone repair shops, computer service centres, electronics repair workshops, and similar service-oriented businesses.

### Key Features
- **Job Sheet Management** — Full lifecycle tracking from device intake to customer collection, with service type support (carry-in, pick-up, on-site).
- **Priority & Triage** — Assign urgency levels (Low, Normal, High, Urgent) to repair jobs for efficient workshop scheduling.
- **Repair Invoice Integration** — Seamlessly create POS-based repair invoices linked to job sheets, with automatic parts and labour billing.
- **Status Workflow** — Customisable status pipeline with colour coding, sort order, and per-status SMS/email templates for customer notifications.
- **Device & Brand Catalogue** — Manage device types, brands, and device models with per-model checklists and standard repair costs.
- **Dashboard KPIs** — Real-time metrics: open jobs, overdue count, average turnaround time, monthly revenue, completion rate, and trending charts.
- **Customer Self-Service** — Public-facing repair status check page where customers can look up their repair by job sheet number, invoice number, or mobile number.
- **Warranty Tracking** — Link product warranties to repairs and automatically calculate expiry dates.
- **Label & PDF Printing** — Print job sheet PDFs and barcode labels in configurable sizes.
- **Document Uploads** — Attach photos and documents to job sheets (before/after repair images, customer ID copies, etc.).
- **Technician Assignment** — Assign service staff to each repair and track workload by technician.
- **Multi-Location Support** — Repairs are scoped to business locations with location-based filtering.

### Accessing the Repair Module
Navigate to **Repair** in the sidebar menu. The dropdown sub-menu provides quick access to:
- **Dashboard** — Overview & KPIs
- **Job Sheets** — Create, view, and manage job sheets
- **Repair Invoices** — View repair billing records
- **Device Models** — Manage device model catalogue
- **Statuses** — Configure repair status workflow
- **Settings** — Module configuration

---

## Dashboard

The Repair Dashboard provides a real-time overview of your workshop operations.

### KPI Summary Cards (Top Section)
Eight key performance indicators displayed in colour-coded info boxes:

| Card | Description |
|------|-------------|
| **Open Jobs** | Total job sheets currently in progress (not marked as completed) |
| **Completed This Month** | Number of repairs completed in the current calendar month |
| **Overdue Jobs** | Job sheets past their expected delivery date that are still open |
| **Avg. Turnaround** | Average number of days from job creation to completion (this month) |
| **Revenue This Month** | Total value of finalised repair invoices for the current month |
| **Created Today** | Number of new job sheets created today |
| **Priority Breakdown** | Open jobs grouped by priority level (Low / Normal / High / Urgent) |

### Charts & Reports
Below the KPI cards, the dashboard displays:

1. **Job Sheets by Status** — Colour-coded status boxes showing count of jobs in each workflow stage.
2. **Job Sheets by Service Staff** — Table showing technician workload distribution.
3. **Trending Brands** — Bar chart of most frequently repaired brands.
4. **Trending Devices** — Bar chart of most frequently repaired device types.
5. **Trending Device Models** — Bar chart of most frequently repaired specific models.

---

## Job Sheets

Job sheets are the primary workflow document for tracking a repair from intake to completion.

### Creating a Job Sheet
1. Navigate to **Repair > Job Sheets** and click **Add Job Sheet**.
2. Fill in the required fields:
   - **Customer** — Select an existing customer or create a new one inline.
   - **Service Type** — Choose from Carry In, Pick Up, or On-Site.
   - **Priority** — Set the urgency level (Low, Normal, High, Urgent).
   - **Location** — Select the business location handling the repair.
   - **Device / Brand / Model** — Classify the device being repaired.
   - **Serial Number** — Enter the device serial/IMEI number.
   - **Status** — Set the initial repair status (defaults to your configured default).
3. Optional fields:
   - **Estimated Cost** — Quoted repair price.
   - **Diagnostic Fee** — Fee charged for initial diagnosis.
   - **Delivery Date** — Expected date the device will be ready for collection.
   - **Estimated Completion Date** — Internal target completion date.
   - **Security Password / Pattern** — Device unlock credentials (stored securely).
   - **Defects** — Customer-reported defects and symptoms.
   - **Product Configuration** — Current device settings/configuration.
   - **Product Condition** — Physical condition at intake.
   - **Pre-Repair Checklist** — Tick checklist items based on device model.
   - **Technician** — Assign a service staff member.
   - **Commission Agent** — Assign a sales commission agent.
   - **Internal Notes** — Staff-only notes not visible to the customer.
   - **Custom Fields** — Up to 5 configurable custom fields.
4. **Send Notification** — Optionally send SMS and/or email notification to the customer based on the selected status template.
5. Choose a save action:
   - **Save** — Save and view the job sheet.
   - **Save & Add Parts** — Save and go to the parts management screen.
   - **Save & Upload Docs** — Save and go to the document upload screen.

### Viewing Job Sheets
The job sheet list screen shows all job sheets with:
- Job sheet number, customer name, device/brand/model
- Technician assigned, delivery date, estimated cost
- Current status (colour-coded badge)
- Linked repair invoice numbers
- Service type, location, creation date, custom fields

**Filters available:**
- Location, Customer, Technician, Status
- Completed / Open toggle tabs

### Job Sheet Actions
Each job sheet row has an actions dropdown:
- **View** — Full detail view with activity log, parts, documents, and status history.
- **Add Invoice** — Create a repair POS invoice linked to this job sheet (pre-fills device info and parts).
- **Edit** — Modify job sheet details.
- **Add Parts** — Manage parts/spares used in the repair.
- **Upload Docs** — Attach images and documents.
- **Print** — Generate a PDF of the job sheet.
- **Change Status** — Quick status update with optional notification.
- **Delete** — Soft-delete the job sheet.

### Job Sheet Detail View
The detail view shows:
- All device and customer information
- Current status with colour badge
- Linked invoices
- Parts used with quantities
- Activity log (status changes with timestamps, notes, and who made the change)
- Uploaded media/documents
- Job sheet settings (PDF/label configuration)

---

## Repair Invoices

Repair invoices are sales receipts specifically created for repair jobs. They include additional repair-specific information alongside the standard billing details.

### Creating a Repair Invoice
1. Navigate to **Repair > Repair Invoices** and click **Add** (or use **Add Invoice** from a job sheet).
2. The POS screen opens with a **Repair** sidebar showing:
   - Brand / Device / Model selectors
   - Serial number
   - Repair status
   - Pre-repair checklist
   - Security info
   - Completion date and due date
   - Warranty selection
3. Add products/services as line items.
4. Complete the sale as usual (payment, tax, discount, etc.).
5. The repair status, serial number, and other repair details are saved to the transaction.

### Repair Invoice List
The list shows all finalised repair invoices with:
- Invoice number, date, customer
- Repair status (colour badge with clickable status change)
- Service staff, brand, device model
- Payment status, total, paid amount, due amount
- Warranty name and expiry countdown
- Job sheet number (clickable link)
- SMS notification indicator (✓✓ if sent)
- Collection info

**Filters:** Location, Customer, Date Range, Service Staff, Status, Payment Status, Sales Representative.

### Invoice Actions
- **View** — Modal showing full repair details, line items, payments, taxes, activity log, and checklist.
- **Edit** — Re-open in POS editor.
- **Delete** — Delete the transaction.
- **Print** — Standard invoice print.
- **Print Customer Copy** — Repair-specific customer receipt.
- **Update Collection Info** — Set collection date and notes.
- **Change Status** — Update repair status with notification options.
- **Add Payment** — Record a payment against the invoice.
- **View Payments** — See all payments made.
- **Sell Return** — Process a return for the repair.
- **Print Label** — Generate a barcode label for the repair.

---

## Device Models

Device models allow you to maintain a catalogue of specific models you service, with associated checklists and repair standards.

### Managing Device Models
Navigate to **Repair > Device Models**.

**Create a Device Model:**
1. Click **Add**.
2. Enter the model name (e.g., "iPhone 14 Pro", "Galaxy S23 Ultra").
3. Select the device type (category) and brand.
4. Enter the repair checklist items separated by `|` (pipe character).
5. Optionally set:
   - **Average Repair Hours** — Typical repair time for this model.
   - **Standard Repair Cost** — Default quoted price for repairs.
6. Save.

**Features:**
- Filter by Brand or Device to find models quickly.
- Checklists auto-populate when a device model is selected on a job sheet or repair invoice.
- Models are available in a dropdown across job sheets, repair invoices, and product screens.

---

## Repair Statuses

Statuses define the workflow stages a repair passes through.

### Managing Statuses
Navigate to **Repair > Statuses**.

**Create a Status:**
1. Click **Add Status**.
2. Enter:
   - **Name** — e.g., "Received", "Diagnosing", "Waiting for Parts", "In Repair", "Testing", "Ready for Collection", "Completed".
   - **Colour** — Pick a colour for the status badge.
   - **Sort Order** — Numeric order in which statuses appear.
   - **Is Completed Status** — Check if this status marks the repair as done.
   - **Auto-Notify Customer** — Automatically send notification when this status is applied.
3. **Notification Templates** — Configure per-status templates:
   - **SMS Template** — SMS body text with placeholder tags.
   - **Email Subject** — Email subject line.
   - **Email Body** — Email HTML body with placeholder tags.
   - **WhatsApp Template** — WhatsApp message template.

### Available Template Tags
Use these placeholder tags in notification templates:

| Tag | Description |
|-----|-------------|
| `{customer_name}` | Customer's full name |
| `{job_sheet_no}` | Job sheet reference number |
| `{status}` | Current repair status name |
| `{serial_number}` | Device serial/IMEI number |
| `{delivery_date}` | Expected delivery date |
| `{service_staff}` | Assigned technician name |
| `{brand}` | Device brand |
| `{device}` | Device type |
| `{device_model}` | Device model name |
| `{business_name}` | Your business name |

### Recommended Workflow
A typical repair shop status pipeline:
1. **Received** (default) — Device accepted from customer
2. **Diagnosing** — Fault investigation in progress
3. **Waiting for Parts** — Parts ordered, awaiting delivery
4. **In Repair** — Active repair work
5. **Quality Check** — Post-repair testing
6. **Ready for Collection** — Customer notified to collect
7. **Completed** *(marked as completed)* — Device collected, case closed

---

## Customer Repair Status Check

A public-facing page allows customers to check their repair status without logging in.

### How It Works
1. Navigate to your website's **Repair Status** page (your web address followed by /repair-status).
2. The customer selects a search method:
   - **Job Sheet Number** — Enter the job sheet reference number.
   - **Invoice Number** — Enter the repair invoice number.
   - **Mobile Number** — Enter the phone number used during intake.
3. Optionally enter the **Serial Number** for additional verification.
4. Click **Check Status**.

The page displays:
- Current repair status with colour badge
- Device details (brand, model, device type)
- Serial number
- Activity log showing all status changes with timestamps
- Related invoices

> **Tip:** Include the job sheet number on printed receipts and labels so customers can easily check their repair status online.

---

## Priority & Triage

The priority system helps workshops manage workload and meet customer expectations.

### Priority Levels

| Level | Use Case |
|-------|----------|
| **Low** | No rush — customer has a backup device |
| **Normal** | Standard turnaround time expected |
| **High** | Customer needs device soon, expedite |
| **Urgent** | Emergency repair, same-day if possible |

### Setting Priority
- Set priority when creating or editing a job sheet.
- Priority is visible in the job sheet list for quick triage.
- Dashboard shows priority breakdown for open jobs.

### Best Practices
- Use **Urgent** sparingly to maintain its significance.
- Review the overdue jobs KPI daily and re-prioritise as needed.
- Assign high-priority jobs to your most experienced technicians.

---

## Parts Management

Track which spare parts and components are used in each repair.

### Adding Parts to a Job Sheet
1. Open a job sheet and click **Add Parts** (or choose "Save & Add Parts" when creating).
2. Search for a product/variation from your inventory.
3. Set the quantity for each part.
4. Save parts.

Parts are stored with the job sheet and can be automatically added as line items when creating a repair invoice from the job sheet.

> **Note:** Parts track variation IDs and quantities. The stock is not deducted until a repair invoice is finalised through the POS.

---

## Checklists

Pre-repair checklists help technicians systematically document device condition during intake.

### Types of Checklists
1. **Default Checklist** — Set in Repair Settings; applies to all repairs.
2. **Device Model Checklist** — Set per device model; supplements the default checklist.

### Configuring Checklists
- **Default:** Go to **Repair > Settings** and enter checklist items separated by `|`.
- **Per Model:** Go to **Repair > Device Models**, edit a model, and enter checklist items separated by `|`.

When a device model is selected on a job sheet or repair invoice, both the default and model-specific checklists are merged and displayed as checkboxes.

---

## Notifications (SMS & Email)

Keep customers informed at every stage of their repair.

### How Notifications Work
1. Each **repair status** can have SMS, email, and WhatsApp templates.
2. When a status is changed (on job sheets or invoices), you can choose to send notifications.
3. Notification content is personalised using template tags (see [Template Tags](#available-template-tags)).

### Sending Notifications
- **On Status Change:** A modal appears with SMS body and email subject/body pre-filled from the status template. Check "Send SMS" and/or "Send Email" to send.
- **On Job Sheet Create/Edit:** Check notification checkboxes before saving.

### Requirements
- **SMS:** Configure your SMS gateway in the business settings (Nexmo, Twilio, etc.).
- **Email:** Configure SMTP settings in your mail configuration.

---

## Warranty Tracking

Link product warranties to repair invoices for post-repair guarantee tracking.

### Setting Up Warranties
Warranties are managed in the main product warranty settings. When creating a repair invoice:
1. Select a warranty from the dropdown.
2. The warranty duration and type are recorded with the transaction.

### Warranty Display
- Repair invoice list shows the warranty name and an "Expires In" countdown.
- The countdown calculates from the transaction date plus the warranty duration.
- Once expired, the countdown shows the elapsed time since expiry.

---

## Labels & Printing

### Job Sheet PDF
Click **Print** on any job sheet to generate a PDF including:
- Business logo and details
- Customer information
- Device details (brand, model, serial)
- Checklist status
- Parts used
- Technician and status info
- Terms & conditions

### Job Sheet Label
Print compact barcode labels for attaching to devices:
- Configurable label width and height (default: 75mm × 50mm).
- Shows: job sheet number (as barcode), customer name, device info, status, technician, due date.
- Customise which fields appear in **Repair > Settings > Jobsheet PDF & Label**.

### Repair Invoice Label
Print barcode labels from the repair invoice for tracking.

### Customer Copy
Print a customer-facing receipt from a repair invoice with the repair-specific layout.

---

## Document Uploads

Attach supporting documents and images to job sheets.

### Uploading Documents
1. Open a job sheet and click **Upload Docs**.
2. Upload one or more images/files.
3. Files are associated with the job sheet and visible in the detail view.

### Deleting Documents
Click the delete button next to any uploaded file in the job sheet view.

> **Tip:** Photograph the device condition before and after repair for dispute resolution.

---

## Collection Info

Track when and how a completed repair is collected.

### Updating Collection Info
1. From the repair invoice list, click the **Update Collection Info** action.
2. Enter:
   - **Collection Note** — Any notes about collection (e.g., "Collected by spouse with authorisation").
   - **Collection Date** — Date and time of actual collection.
3. Save.

Collection info is displayed in the repair invoice list.

---

## Settings

Configure the Repair module to match your workshop operations.

### General Settings
Navigate to **Repair > Settings**:

| Setting | Description |
|---------|-------------|
| **Default Status** | The status automatically applied to new repairs/job sheets |
| **Job Sheet Prefix** | Prefix for auto-generated job sheet numbers (e.g., "JS-") |
| **Default Product** | Default product to appear in repair POS transactions |
| **Barcode Type** | Barcode format for repair labels |
| **Barcode Sticker Setting** | Select a barcode sticker template for label printing |
| **Terms & Conditions** | Text shown on job sheet PDFs |
| **Default Repair Checklist** | Pipe-separated checklist items for all repairs |
| **Problem Reported by Customer** | Label configuration |
| **Product Condition** | Label configuration |
| **Product Configuration** | Label configuration |
| **Custom Fields 1-5** | Configure labels for up to 5 custom fields |

### Jobsheet PDF & Label Settings
Configure how job sheet PDFs and labels are generated:
- Customer section labels (name, address, phone, email)
- Client ID and tax number labels
- Contact custom fields visibility
- Label dimensions (width × height in mm)
- Fields to show on printed labels (customer info, barcode, status, technician, problem, serial number, brand, location, password)

---

## Permissions

The Repair module defines the following permission controls:

| Permission | Description |
|------------|-------------|
| **Add Invoice** | Create repair invoices |
| **Edit Invoice** | Edit existing repair invoices |
| **View All Invoice** | See all repair invoices (radio: choose this OR View Own) |
| **View Own Invoice** | See only your own repair invoices |
| **Delete Invoice** | Delete repair invoices |
| **Change Invoice Status** | Update the status of a repair invoice |
| **Access Job Sheet Status** | Access the repair status management screen |
| **Add Job Sheet** | Create new job sheets |
| **Edit Job Sheet** | Edit existing job sheets |
| **Delete Job Sheet** | Delete job sheets |
| **View Assigned Job Sheet** | See only job sheets assigned to you (radio: choose this OR View All) |
| **View All Job Sheet** | See all job sheets |
| **Access Repair Dashboard** | View the repair dashboard and KPIs |
| **Access Repair Settings** | Manage repair module settings |

### Setting Permissions
1. Go to **User Management > Roles**.
2. Edit a role.
3. Scroll to the **Repair** section.
4. Enable the desired permissions.
5. Save.

> **Tip:** Technicians typically need: View Assigned Job Sheet, Edit Job Sheet, Add Parts, Change Status. Give supervisors View All + Dashboard access.

---

## Tips & Best Practices

### Workshop Workflow
1. **Intake:** Customer drops off device → Create job sheet (carry-in) → Print label and attach to device → Set status to "Received".
2. **Diagnosis:** Technician picks up job → Changes status to "Diagnosing" → Records defects and checklist → Sets priority.
3. **Parts:** If parts needed → Change status to "Waiting for Parts" → Add required parts to job sheet.
4. **Repair:** Parts arrive → Change status to "In Repair" → Technician performs repair.
5. **Testing:** Change status to "Quality Check" → Run through checklist items.
6. **Ready:** Change status to "Ready for Collection" → Customer receives SMS/email notification.
7. **Completion:** Customer collects device → Create repair invoice from job sheet → Collect payment → Change status to "Completed" → Update collection info.

### Efficiency Tips
- **Use Device Model Checklists** — Pre-configure checklists for your most common device models to speed up intake.
- **Set Default Status** — Configure a default status in settings so technicians don't have to select it every time.
- **Use Priority Levels** — Visible priority flags help technicians decide which job to pick up next.
- **Monitor Overdue KPI** — Check the dashboard daily for overdue jobs and escalate as needed.
- **Document Everything** — Upload before/after photos for high-value device repairs.
- **Job Sheet Prefix** — Use a meaningful prefix (e.g., "REP-" or your shop's initials) for easy identification.
- **Template Tags in Notifications** — Use all available tags to send professional, personalised status updates.
- **Customer Self-Service** — Share your repair status URL on receipts and your website to reduce "where's my device?" calls.
