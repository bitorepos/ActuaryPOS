# CRM Module – User Manual

## Table of Contents
1. [Overview](#overview)
2. [Accessing CRM](#accessing-crm)
3. [Dashboard](#dashboard)
4. [Leads Management](#leads-management)
5. [Follow-Ups (Schedules)](#follow-ups-schedules)
6. [Campaigns](#campaigns)
7. [Proposals](#proposals)
8. [Call Log](#call-log)
9. [Reports](#reports)
10. [Contact Portal](#contact-portal)
11. [B2B Marketplace](#b2b-marketplace)
12. [Settings](#settings)
13. [Permissions Reference](#permissions-reference)
14. [Taxonomies (Sources, Life Stages, Follow-up Categories)](#taxonomies)
15. [Best Practices](#best-practices)

---

## Overview

The **CRM (Customer Relationship Management)** module transforms your POS system into a complete customer management platform. It provides tools for tracking leads, managing follow-ups, running marketing campaigns, generating proposals, logging calls, and analysing conversion metrics — all from a single integrated interface.

### Key Capabilities
| Feature | Description |
|---------|-------------|
| **Lead Management** | Create, assign, score, and convert leads with Kanban board and list views |
| **Follow-Ups** | Schedule one-time, recurring, and advance follow-ups with notifications |
| **Campaigns** | Send SMS and email campaigns to leads, customers, or both |
| **Proposals** | Create templates, send branded proposals, and track attachments |
| **Call Log** | Track inbound/outbound calls with outcomes and duration analytics |
| **Reports** | Follow-ups by user/contact, lead-to-customer conversion reports |
| **Contact Portal** | Allow contacts to log in, view orders, and place order requests |
| **B2B Marketplace** | Import leads automatically from ExportersIndia marketplace |
| **Dashboard KPIs** | Overdue follow-ups, conversion rate, new leads, open pipeline |

---

## Accessing CRM

### Navigation
After enabling the CRM module in your subscription, the sidebar shows a **CRM** dropdown menu with sub-items:

- **Dashboard** – KPI overview and summary widgets
- **Leads** – Manage all leads and Kanban board
- **Follow Ups** – Schedule and track follow-ups
- **Campaigns** – Create and send SMS/email campaigns
- **Proposals** – Proposal templates and sent proposals
- **Call Log** – View and manage call records *(if enabled)*
- **Reports** – Analytics and conversion reports
- **Settings** – Module configuration *(admin only)*

### Enabling the Module
1. Go to **Superadmin → Subscription Plans**
2. Enable the **CRM Module** permission for the desired plan
3. Assign the plan to the business

---

## Dashboard

The CRM Dashboard is your command center. It displays:

### Top KPI Row (All Users)
| Widget | Description |
|--------|-------------|
| **Overdue Follow-ups** | Count of your follow-ups past their end date that are still open/scheduled |
| **Conversion Rate** | Percentage of total contacts that are customers vs leads |
| **Open Follow-ups** | Total open/scheduled follow-ups across the business |
| **New Leads This Month** | Leads created during the current calendar month |

### Personal Stats
- **Today's Follow-ups** – Count of your follow-ups starting today
- **My Leads** – Total leads assigned to you
- **My Leads to Customer Conversion** – Number of leads you converted

### My Follow-ups Breakdown
A status breakdown table showing counts per status: Scheduled, Open, Cancelled, Completed.

### My Call Logs *(if call log enabled)*
- Calls Today / Yesterday / This Month

### Admin Section *(admin only)*
- Total Customers, Leads, Sources, Life Stages summary cards
- **Source-wise breakdown** table with lead count and conversion %
- **Life Stage distribution** for leads
- **Birthdays** – Today's and upcoming (30 days) for customers and leads

---

## Leads Management

### Overview
Leads are potential customers in your sales pipeline. The CRM module extends the standard contacts system with lead-specific features.

### Viewing Leads
Navigate to **CRM → Leads**. You can view leads in two modes:

1. **List View** – Sortable/filterable DataTable with columns for name, source, life stage, assigned users, last follow-up, and upcoming follow-up
2. **Kanban Board** – Drag-and-drop cards organized by Life Stage columns

### Creating a Lead
1. Click **Add Lead**
2. Fill in the required fields:
   - **Name** (First Name, Last Name)
   - **Business Name** (optional)
   - **Email / Mobile**
   - **Source** – Where the lead came from (e.g., Website, Referral, Social Media)
   - **Life Stage** – Current stage in the sales pipeline
   - **Assigned To** – Select users responsible for this lead
3. Click **Save**

### Editing a Lead
Click the **Edit** button in the lead's action column. Update any field and save.

### Converting a Lead to Customer
1. Open the lead's detail page
2. Click **Convert to Customer**
3. The lead's type changes from "lead" to "customer" and conversion is logged

### Lead Scoring
Leads have a **Lead Score** field (0-100) to prioritize high-value prospects. Higher scores indicate more engaged or valuable leads.

### Contact Persons
You can add up to 3 contact persons per lead with:
- Username & password (for Contact Portal login)
- Commission percentage (for sales attribution)

### Permissions
| Permission | Description |
|------------|-------------|
| **Access All Leads** | View and manage all leads |
| **Access Own Leads** | View and manage only assigned leads |

---

## Follow-Ups (Schedules)

### Overview
Follow-ups are scheduled activities (calls, meetings, emails, SMS) linked to leads or customers. They are the backbone of your sales process.

### Types of Follow-Ups

#### 1. One-time Follow-Up
Standard follow-up with a specific start/end datetime.

#### 2. Recurring Follow-Up
Automatically generates follow-ups at regular intervals. Set:
- **Follow-up By** – Payment status or customer activity
- **Recursion Days** – How often to regenerate

#### 3. Advance Follow-Up
Create follow-ups based on business rules:
- **Payment Status** – Target customers with due/partial/overdue invoices
- **Transaction Activity** – Target customers with/without recent transactions
- **Contact Names** – Manually select specific contacts

### Creating a Follow-Up
1. Go to **CRM → Follow Ups**
2. Click **Add Follow Up** (or choose Recurring / Advance)
3. Fill in:
   - **Title** – Brief description
   - **Customer/Lead** – Select from dropdown
   - **Start/End Datetime**
   - **Follow-up Type** – Call, SMS, Meeting, or Email
   - **Priority** – Low, Medium, High, or Urgent
   - **Status** – Scheduled, Open, Cancelled, or Completed
   - **Assigned To** – Select team members
   - **Follow-up Category** – Categorize for reporting
   - **Description** – Detailed notes
   - **Auto Notification** – Enable with notify-before time and channel (SMS/Email)
4. Click **Save**

### Follow-Up Logs
Each follow-up can have multiple log entries to track progress:
1. Click **View Follow Up** in the action menu
2. Click **Add Follow Up Log**
3. Record the log type, datetime, subject, and description

### Statuses
| Status | Meaning |
|--------|---------|
| **Scheduled** | Planned for a future date |
| **Open** | Currently active / in progress |
| **Completed** | Successfully finished |
| **Cancelled** | No longer needed |

### Permissions
| Permission | Description |
|------------|-------------|
| **Access All Follow-ups** | View and manage all follow-ups |
| **Access Own Follow-ups** | View and manage only your follow-ups |

---

## Campaigns

### Overview
Campaigns allow you to send bulk SMS or email messages to selected leads and customers.

### Creating a Campaign
1. Go to **CRM → Campaigns**
2. Click **Create Campaign**
3. Configure:
   - **Campaign Name**
   - **Campaign Type** – SMS or Email
   - **Recipients** – Select leads and/or customers
   - **Subject** (Email only)
   - **Email Body / SMS Body** – Use template tags:
     - `{contact_name}` – Recipient's name
     - `{campaign_name}` – Campaign name
     - `{business_name}` – Your business name
4. Choose to **Save** (as draft) or **Save & Send**

### Sending a Campaign
- Draft campaigns show a **Send Notification** button in the action column
- Once sent, the campaign is marked with a "Sent" badge and the send date is recorded
- Sent campaigns cannot be edited

### Campaign Types
| Type | Channel | Requirements |
|------|---------|-------------|
| **SMS** | Text message | SMS settings configured in Business Settings |
| **Email** | Email | SMTP/mail settings configured |

### Permissions
| Permission | Description |
|------------|-------------|
| **Access All Campaigns** | View and manage all campaigns |
| **Access Own Campaigns** | View and manage only your campaigns |

---

## Proposals

### Overview
Proposals are branded documents sent to contacts via email. They consist of a template (created once) and individual proposals sent from that template.

### Setting Up the Template
1. Go to **CRM → Proposals**
2. If no template exists, click **Create Template**
3. Fill in:
   - **Subject** – Proposal subject line
   - **Body** – Rich text proposal content
   - **CC / BCC** – Additional email recipients
   - **Attachments** – Upload files (PDFs, images, etc.)
4. Save the template

### Sending a Proposal
1. From the template view, click **Send Proposal**
2. Select the recipient contact
3. Optionally modify CC/BCC
4. Click **Send**
5. The proposal is emailed with the template body and attachments

### Viewing Sent Proposals
The **Proposals** tab lists all sent proposals with:
- Recipient name
- Subject
- Sent by (user)
- Date sent
- Status (Draft, Sent, Viewed, Accepted, Rejected, Expired)

### Permission
| Permission | Description |
|------------|-------------|
| **Access Proposals** | Access proposal templates and sending |

---

## Call Log

> **Note**: Call logging must be enabled by your administrator in the system settings.

### Overview
The Call Log tracks all phone interactions with contacts. Logs are automatically captured from integrated call systems or can be viewed here.

### Viewing Call Logs
1. Go to **CRM → Call Log**
2. Use filters:
   - **Contact** – Filter by specific contact
   - **User** – Filter by call agent
   - **Date Range** – Filter by time period
3. View columns: Contact, User, Call Type, Call Outcome, Mobile Number, Start/End Time, Duration, Created By

### All Users Call Log *(admin view)*
Admins can see a summary table of all users' call counts:
- Calls Today / Yesterday / All-time per user

### Mass Delete
1. Select call logs using checkboxes
2. Click **Mass Delete** to remove selected records

### Permissions
| Permission | Description |
|------------|-------------|
| **View All Call Logs** | View all users' call logs |
| **View Own Call Logs** | View only your own call logs |

---

## Reports

Navigate to **CRM → Reports** *(admin only)*.

### Available Reports

#### 1. Follow-ups by User
- Shows each user's follow-up counts broken down by status
- Filterable by **date range** and **follow-up category**
- Clickable links to view specific follow-ups in list view

#### 2. Follow-ups by Contact
- Shows each contact's follow-up counts broken down by status
- Displays business name and contact name

#### 3. Lead to Customer Conversion
- Lists users with their total conversion count
- Click on a user to see conversion details:
  - Contact name, converted date, previous type

---

## Contact Portal

### Overview
The Contact Portal allows your customers and leads to log in through a separate interface, view their orders, ledger, and place order requests.

### Setting Up Contact Login
1. Go to a contact's detail page
2. In the **Contact Login** tab, click **Add Login**
3. Set username and password for the contact
4. The contact can now log in through the **Contact Login** page on your website

### Portal Features
Once logged in, contacts can access:
- **Dashboard** – Order summary and profile
- **Orders/Purchases** – View their transactions
- **Ledger** – Account statement
- **Order Requests** – Place new order requests *(if enabled in CRM Settings)*
- **Bookings** – View their bookings
- **Profile** – Update their profile information

### Permission
| Permission | Description |
|------------|-------------|
| **Access Contact Login** | Manage contact login credentials |

---

## B2B Marketplace

> **Note**: B2B Marketplace must be enabled by your administrator in the system settings.

### Overview
The B2B Marketplace integration allows automatic import of leads from **ExportersIndia** into your CRM.

### Setup
1. Go to **CRM → Settings** or the Marketplace page
2. Enter your **Site Key** and **Site ID** from ExportersIndia
3. Select **Assigned Users** – Users who will be assigned imported leads
4. Select a **Source** – CRM source category for imported leads
5. Click **Save**

### Importing Leads
1. Click **Import Leads**
2. The system fetches inquiries from the ExportersIndia API
3. For each inquiry:
   - A new lead is created (if email doesn't already exist)
   - A follow-up is automatically created with inquiry details
4. Duplicate emails are skipped to prevent duplicates

### Permission
| Permission | Description |
|------------|-------------|
| **Access B2B Marketplace** | Access B2B Marketplace settings and import |

---

## Settings

Navigate to **CRM → Settings** *(admin only)*.

### Available Settings
| Setting | Description |
|---------|-------------|
| **Enable Order Request** | Allow contacts to place order requests through the Contact Portal |
| **Order Request Prefix** | Custom prefix for order request reference numbers |

---

## Permissions Reference

All CRM permissions are configured in **Settings → Roles → Edit Role**.

| Permission | Description |
|------------|-------------|
| **Access CRM** | Access the CRM module (needed to see it in the sidebar) |
| **Access All Follow-ups** | View and manage all follow-ups |
| **Access Own Follow-ups** | View and manage only your own follow-ups |
| **Access All Leads** | View and manage all leads |
| **Access Own Leads** | View and manage only your assigned leads |
| **Access All Campaigns** | View and manage all campaigns |
| **Access Own Campaigns** | View and manage only your own campaigns |
| **Access Contact Login** | Manage contact login credentials |
| **Access Sources** | Manage lead sources |
| **Access Life Stages** | Manage life stages |
| **Access Proposals** | Access proposals and templates |
| **View All Call Logs** | View all call logs |
| **View Own Call Logs** | View only your own call logs |
| **Access B2B Marketplace** | Access B2B marketplace integration |

---

## Taxonomies

### Sources
Sources identify where leads come from. Examples: Website, Phone, Referral, Social Media, Trade Show.

**Manage**: Go to **CRM → Dashboard** → click **Sources** in the navigation.

### Life Stages
Life stages define where a lead is in the sales pipeline. Examples: New, Contacted, Qualified, Proposal Sent, Won, Lost.

**Manage**: Go to the Life Stages section in CRM settings.

### Follow-up Categories
Categories for organizing follow-ups. Examples: Sales, Support, Onboarding, Renewal.

**Manage**: Go to the Follow-up Categories section in CRM settings.

---

## Best Practices

### Lead Management
1. **Define clear life stages** – Create 5-7 stages that match your sales process
2. **Assign leads immediately** – Every lead should have an owner
3. **Use lead scoring** – Prioritize high-score leads for follow-up
4. **Regular pipeline review** – Use the Kanban board weekly to review lead status

### Follow-Ups
1. **Schedule follow-ups promptly** – Create a follow-up within 24 hours of lead creation
2. **Use priorities** – Mark urgent items for same-day attention
3. **Log every interaction** – Add follow-up logs for calls, meetings, and emails
4. **Use recurring follow-ups** – For long sales cycles, set up recurring check-ins
5. **Monitor overdue items** – Check the dashboard daily for overdue follow-ups

### Campaigns
1. **Segment your audience** – Don't send the same message to all contacts
2. **Personalize with tags** – Use `{contact_name}` and `{business_name}` tags
3. **Test before sending** – Send to yourself first to check formatting
4. **Track results** – Review which campaigns drive the most engagement

### Reports
1. **Weekly reviews** – Check follow-ups by user to ensure team accountability
2. **Monthly conversion analysis** – Track lead-to-customer conversion trends
3. **Source analysis** – Identify which sources produce the highest-converting leads

---

*This guide covers all CRM module features. For technical support, contact your system administrator.*
