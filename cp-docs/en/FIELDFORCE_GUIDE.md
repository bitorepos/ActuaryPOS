# Field Force Module — User Guide

## 1. Overview

The **Field Force** module is a field-staff management solution for businesses whose teams work outside the office — sales representatives, delivery agents, service technicians, collection officers, and surveyors. It provides visit scheduling, GPS-based check-in/check-out, contact-meeting tracking, photo evidence capture, and performance dashboards.

### Key Capabilities

| Feature | Description |
|---|---|
| Visit Management | Create, assign, reschedule and track field visits |
| GPS Check-In/Out | Capture agent location at visit start and end |
| Contact Meeting | Record who was met, mobile number, designation |
| Photo Evidence | Upload photos from the field (camera capture) |
| Priority & Type | Categorise visits by urgency and purpose |
| Follow-Up Tracking | Flag visits that need a follow-up with a target date |
| Dashboard & KPIs | Real-time metrics — success rate, overdue visits, avg visits/day |
| Visits by User Report | Admin table showing per-agent visit breakdown |
| Multi-User Assignment | Assign visits to any staff member in the business |
| Map Integration | One-click Google Maps link for visit and visited addresses |

---

## 2. Accessing the Module

1. Navigate to the **sidebar** and expand the **Field Force** dropdown.
2. Sub-menu items:
   - **Dashboard** — KPI widgets, personal stats, admin-level overview.
   - **Visits** — Full visit list with filters and CRUD operations.

> **Note:** The module must be enabled in the business subscription. Contact your administrator if you don't see the Field Force menu.

---

## 3. Dashboard

The dashboard is divided into three zones:

### 3.1 Personal Status Cards (All Users)

| Card | Colour | Meaning |
|---|---|---|
| Assigned | Aqua | Visits assigned to you, not yet completed |
| Met Contact | Green | Visits where you met the contact |
| Did Not Meet | Red | Visits where you could not meet the contact |

### 3.2 My Visits Table (All Users)

Breaks down your visits into **Contact** vs **Others** for three periods:
- Today
- Yesterday
- This Month

### 3.3 Admin KPI Row (Admin Only)

| KPI | Icon | Description |
|---|---|---|
| Overdue Visits | Red triangle | Visits still "assigned" whose scheduled date has passed |
| Success Rate | Green % | Percentage of completed visits where the contact was actually met (this month) |
| Visits This Week | Yellow calendar | Total visits scheduled for the current week |
| Avg Visits / Day | Aqua chart | Average number of visits completed per active day this month |

### 3.4 Admin All-Time & Today Panels

Eight info-box cards split into two rows:
- **All-time:** Total Visits, Assigned, Met Contact, Did Not Meet
- **Today:** Same four metrics filtered to today

Each card links directly to the Visits list pre-filtered by the relevant status.

### 3.5 Visits by User Table (Admin Only)

A server-side DataTable showing per-agent breakdown:

| Column | Description |
|---|---|
| User | Agent full name |
| Contact Visits Today | Visits to contacts completed today |
| Others Visits Today | Visits to non-contacts completed today |
| Contact Visits Yesterday | Same for yesterday |
| Others Visits Yesterday | Same for yesterday |
| Contact Visits This Month | Same for current month |
| Others Visits This Month | Same for current month |
| Total Visits | All-time visited count for this agent |

---

## 4. Managing Visits

### 4.1 Creating a Visit

1. Go to **Field Force → Visits**.
2. Click the **+ Add** button (top-right).
3. In the modal:
   - **Who to visit:** Choose "Contact" (searchable dropdown of your contacts) or "Others" (free-text person/company + address).
   - **Assigned To:** Select the staff member.
   - **Visit On:** Date and time the visit is scheduled for.
   - **Purpose of Visiting:** Free-text description.
4. Click **Save**. The visit is created with status **Assigned** and a unique Visit ID (auto-generated).

### 4.2 Editing a Visit

1. In the Visits table, click the **Edit** button on the row.
2. Update the contact, assigned agent, date, or purpose.
3. Click **Update**.

> Only users with the **Edit Visit** permission (and either **View Own Visits** or **View All Visits**) can edit.

### 4.3 Deleting a Visit

1. Click the red **Delete** button.
2. Confirm the SweetAlert prompt.

> Requires the **Delete Visit** permission.

### 4.4 Filtering Visits

The index page provides four filters:

| Filter | Description |
|---|---|
| Contact | Search and select a specific contact |
| Assigned To | Filter by agent (admin: all users; regular: own only) |
| Status | Assigned / Met Contact / Did Not Meet |
| Date Range | Date-range picker for Visit On or Visited On |

### 4.5 Visit Statuses

| Status | Badge | Description |
|---|---|---|
| `assigned` | Yellow | Visit is scheduled, not yet executed |
| `met_contact` | Green | Agent met the intended contact |
| `did_not_meet_contact` | Red | Agent visited but could not meet the contact |
| `in_progress` | Blue | Agent has checked in, visit in progress |
| `cancelled` | Grey | Visit was cancelled |
| `rescheduled` | Orange | Visit was moved to a new date |

---

## 5. Updating Visit Status (Field Agent Workflow)

When an agent is on-location, they update the visit status:

1. In the Visits table, the **Update Status** button appears on visits assigned to the current user.
2. Click it to open the status modal.
3. Fill in:
   - **Did you meet with the contact?** — Yes / No radio.
   - If **No**, enter the **Reason** for not meeting.
   - **Meet With** table — up to 3 persons you met with, including name, mobile number, and designation.
   - **Visited Address** — click **Get Current Location** to auto-capture GPS coordinates and reverse-geocode the address.
   - **Discussions** — free-text notes about the conversation.
   - **Photo** — capture or upload a photo of the contact or visited place.
4. Click **Update**.

### 5.1 GPS Location Capture

When the agent clicks **Get Current Location**:
- The browser asks for permission to access the device's location.
- The exact location (latitude and longitude) is saved.
- The address is automatically looked up from the coordinates and filled in.

---

## 6. Visit Types

Visits can be categorised by type for better reporting:

| Type | Use Case |
|---|---|
| Sales | Sales calls, product demos, pitching |
| Service | After-sales service, repairs, maintenance |
| Collection | Payment collection, invoice follow-up |
| Delivery | Product or document delivery |
| Survey | Market research, feedback collection |
| Follow Up | Re-visit from a previous engagement |
| Other | Any visit not covered above |

---

## 7. Priority Levels

Each visit can be assigned a priority:

| Priority | Suggested SLA |
|---|---|
| Low | Complete within the week |
| Medium | Complete within 2–3 days (default) |
| High | Complete within 24 hours |
| Urgent | Complete immediately / same day |

---

## 8. Check-In / Check-Out

The enhanced Field Force module supports GPS-verified check-in/check-out:

- **Check In:** When an agent arrives at the visit location, their GPS coordinates and timestamp are recorded.
- **Check Out:** When the agent leaves, a second GPS stamp is taken.
- **Duration:** The system automatically calculates visit duration in minutes.
- **Coordinates:** Both check-in and visited-address coordinates are stored independently for audit.

---

## 9. Follow-Up Tracking

After completing a visit, agents can flag whether a follow-up is needed:

| Field | Description |
|---|---|
| Follow-up Required | Boolean toggle — yes/no |
| Follow-up Date | Target date for the next visit |
| Next Action | Free-text description of the planned next step |

Dashboard KPI "Overdue Visits" tracks visits that were assigned but their scheduled date has passed without completion.

---

## 10. Photo Evidence

- The status update form includes a file upload field.
- On mobile devices, the file upload opens the device camera directly.
- Photos are stored via the application's Media system and displayed in the Visit Details modal.
- Supports image files (JPEG, PNG, etc.).

---

## 11. Viewing Visit Details

Click the **View** button on any visit row to see a full-detail modal:

- **Contact/Person:** Who was being visited
- **Assigned To:** The agent
- **Address:** With Google Maps link
- **Visit On:** Scheduled date/time
- **Purpose:** Text description
- **Visited On:** When the agent actually visited
- **Status:** With colour badge
- **Visited Address:** With Map link (if GPS captured)
- **Discussions:** Meeting notes
- **Meet With table:** Up to 3 persons met — name, mobile, designation
- **Photo:** Captured image

---

## 12. Map Integration

Two types of map links appear in visit details:

1. **Plan Address:** Built from the contact's address fields → Google Maps search.
2. **Visited Address:** Uses the GPS latitude/longitude captured during check-in → Google Maps pin.

---

## 13. Permissions

| Permission | Description |
|---|---|---|
| **View All Visits** | See visits assigned to all agents |
| **View Own Visits** | See only visits assigned to yourself |
| **Create Visit** | Create new field visits |
| **Edit Visit** | Edit existing visit details |
| **Delete Visit** | Remove a visit record |

- **View All Visits** and **View Own Visits** are mutually exclusive (you pick one or the other).
- Admin users automatically see all visits and dashboard admin panels.

### Permission Summary

| Action | View All | View Own | Create | Edit | Delete |
|---|---|---|---|---|---|
| See Visits list | Yes | Yes (own) | Yes | — | — |
| Dashboard personal stats | Yes | Yes | — | — | — |
| Dashboard admin panels | Admin | — | — | — | — |
| Create visit | — | — | Yes | — | — |
| Edit visit | — | — | — | Yes | — |
| Update status | Own | Own | — | — | — |
| Delete visit | — | — | — | — | Yes |

---

## 14. Enabling the Module

The Field Force module must be enabled in the business subscription:

- **Package Setting:** The Field Force feature must be included in the business subscription package.
- **Installation:** Your administrator navigates to Module Manager → Field Force → Install.
- **Update:** When a new version is available, the administrator can click Update.
- **Uninstall:** The administrator can remove the module; your data is kept safe.

---

## 15. Best Practices

1. **Always capture GPS** — Train field agents to allow location permission and click "Get Current Location" for every visit.
2. **Use visit types** — Categorise every visit so reports are meaningful.
3. **Set priorities** — Mark urgent visits as "High" or "Urgent" so agents prioritise correctly.
4. **Flag follow-ups** — If a deal needs a return visit, set Follow-up Required with a date so nothing slips.
5. **Photo evidence** — Require agents to upload at least one photo per visit for proof of visit.
6. **Review KPIs weekly** — Use the Success Rate and Avg Visits/Day metrics to identify underperformers.
7. **Address overdue visits** — Monitor the Overdue Visits KPI and reassign or reschedule promptly.
8. **Daily route planning** — Create all visits for the day in advance and assign in geographic clusters.

---

## 16. Troubleshooting

| Issue | Solution |
|---|---|
| GPS not working | Ensure browser location permission is granted; your website must use a secure (HTTPS) connection |
| "Unauthorized action" | Check user permissions in **User Management → Roles → Field Force** section |
| Module not visible | Verify the subscription includes the Field Force feature |
| Visits not appearing | Check the date-range filter; clear filters to see all visits |
| Photo upload fails | Ensure the file is an image and server upload limits are sufficient |
| Map link incorrect | Verify the contact's address fields are populated, or capture GPS on-site |

---

*This guide covers the Field Force module. For technical questions, contact your system administrator.*
