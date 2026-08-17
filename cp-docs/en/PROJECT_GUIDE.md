# Project Module – User Guide

## Table of Contents

1. [Overview](#overview)
2. [Key Features](#key-features)
3. [Getting Started](#getting-started)
4. [Navigation & Sidebar](#navigation--sidebar)
5. [Projects](#projects)
   - [Project List View](#project-list-view)
   - [Kanban Board View](#kanban-board-view)
   - [Create a Project](#create-a-project)
   - [Edit a Project](#edit-a-project)
   - [Project Detail / Show Page](#project-detail--show-page)
   - [Project Status Management](#project-status-management)
6. [Tasks](#tasks)
   - [Task List & Kanban](#task-list--kanban)
   - [Create a Task](#create-a-task)
   - [Task Detail View](#task-detail-view)
   - [Task Status & Priority](#task-status--priority)
   - [Sub-Tasks](#sub-tasks)
   - [My Tasks](#my-tasks)
7. [Time Logs](#time-logs)
   - [Log Time](#log-time)
   - [Billable vs Non-Billable](#billable-vs-non-billable)
   - [Time Log Reports](#time-log-reports)
8. [Task Comments & Attachments](#task-comments--attachments)
9. [Documents & Notes](#documents--notes)
10. [Project Invoices](#project-invoices)
    - [Create an Invoice](#create-an-invoice)
    - [Invoice Status & Payments](#invoice-status--payments)
11. [Reports](#reports)
    - [Time Log by Project](#time-log-by-project)
    - [Time Log by Employee](#time-log-by-employee)
    - [Tax Report Integration](#tax-report-integration)
12. [Project Settings (Per-Project)](#project-settings-per-project)
13. [Module Settings (Global)](#module-settings-global)
14. [Categories](#categories)
15. [Custom Fields](#custom-fields)
16. [Dashboard KPIs](#dashboard-kpis)
17. [Notifications](#notifications)
18. [Activity Log](#activity-log)
19. [User Permissions](#user-permissions)
20. [Frequently Asked Questions](#frequently-asked-questions)
21. [Tips & Best Practices](#tips--best-practices)

---

## Overview

The **Project Module** is a comprehensive project-management add-on that lets you plan, track, and invoice projects directly inside your POS/ERP system. It is designed for businesses that deliver services, custom orders, or any work that needs to be organized into projects, broken into tasks, tracked by time, and billed to customers.

Whether you run a consultancy, a creative agency, a construction firm, or a professional-services team, this module gives you a single place to manage all project work without switching to external tools.

---

## Key Features

| Feature | Description |
|---|---|
| **Project Management** | Create projects with start/end dates, leads, members, budgets, priorities, and categories. |
| **Kanban Board** | Drag-and-drop project or task boards grouped by status (Not Started → In Progress → On Hold → Completed). |
| **Task Management** | Create tasks within projects, assign to members, set priorities, due dates, and estimated hours. |
| **Sub-Task Support** | Break large tasks into sub-tasks with parent-child hierarchy. |
| **Time Logging** | Team members log time against tasks; supports billable/non-billable flagging and hourly rates. |
| **Project Invoicing** | Generate invoices directly from project work with line items, taxes, and discounts. |
| **Comments & Attachments** | Collaborate on tasks with threaded comments and file attachments. |
| **Documents & Notes** | Attach project-level documents and notes with privacy controls. |
| **Reports** | Time-log reports by project and by employee with date-range filtering. |
| **Notifications** | Real-time notifications when assigned to a project, task, or when comments are posted. |
| **Activity Log** | Full audit trail of all project, task, document, and time-log changes. |
| **Dashboard KPIs** | At-a-glance stats: total projects, active, completed, overdue, hours logged, invoiced, and paid. |
| **Custom Fields** | Up to 4 custom fields each on projects and tasks for business-specific data. |
| **Granular Permissions** | 9 role-based permissions controlling who can create, edit, delete, view reports, manage invoices, etc. |
| **Custom Dashboard Widget** | A "My Tasks" widget available on the main application dashboard. |
| **Tax Report Integration** | Project invoice taxes automatically appear in the global tax report. |

---

## Getting Started

### Prerequisites

- The Project Module must be installed and activated by your administrator.
- The module must be enabled in your subscription/package.
- Users need at least the **View Projects** permission to access the module.

### Installation

1. Your system administrator installs the module via **Settings → Modules → Project**.
2. Once installed, permissions can be assigned to user roles as needed.

---

## Navigation & Sidebar

After installation, the sidebar shows a **Project** dropdown menu containing:

| Menu Item | Description |
|---|---|
| **All Projects** | List view of all projects you have access to. |
| **Kanban Board** | Visual board of projects grouped by status. |
| **My Tasks** | Tasks assigned to you across all projects. |
| **Reports** | Project and time-log reporting (admin/permission required). |
| **Settings** | Module-level settings (admin/permission required). |

> **Tip:** Admins and users with **View Reports** permission see the Reports link. Users with **Manage Settings** permission see the Settings link.

---

## Projects

### Project List View

Access via **Project → All Projects**.

The list shows paginated project cards with:
- Project name, status, priority
- Progress bar (completion percentage)
- Lead name, customer name
- Member avatars
- Category tags
- Start date, end date
- Quick-action links (view, edit, delete)

**Filters available:**
- **Status** – Not Started, In Progress, On Hold, Cancelled, Completed
- **Due Date** – Overdue, Today, Less than 1 week
- **Category** – Filter by project category

### Kanban Board View

Access via **Project → Kanban Board**.

Projects are displayed as cards on a board with columns for each status. Admins see all projects; regular members see only their assigned projects.

Each card shows:
- Project name
- Customer name
- Lead name
- Member avatars
- Category tags
- End date (highlighted if overdue)

### Create a Project

1. Click **+ New Project** (you need the **Create Project** permission).
2. Fill in:
   - **Name** (required) – Descriptive project name.
   - **Lead** (required) – The person responsible for managing the project.
   - **Members** – Team members who will work on the project. The lead is automatically added.
   - **Customer** – Link to an existing customer/contact.
   - **Status** – Default is "Not Started".
   - **Priority** – Low, Medium, High, or Critical.
   - **Start Date / End Date** – Plan the project timeline.
   - **Budget** – Planned budget amount.
   - **Estimated Hours** – Total estimated effort.
   - **Color Code** – Hex color for visual identification.
   - **Tags** – Comma-separated labels for grouping/filtering.
   - **Description** – Rich text project description.
   - **Category** – Assign one or more project categories.
   - **Custom Fields 1-4** – Business-specific additional data.
3. Click **Save**.

All selected members receive a notification about the new project.

### Edit a Project

1. Click the **Edit** icon on any project card (you need the **Edit Project** permission).
2. Update any fields and save.
3. Newly added members receive assignment notifications.

### Project Detail / Show Page

Click on a project name to open its detail page. The page has these tabs:

| Tab | Contents |
|---|---|
| **Overview** | Project summary, member list, customer info, completion stats, time logged, invoice totals. |
| **Tasks** | Task list or kanban for this project. |
| **Time Logs** | All time entries logged against this project's tasks. |
| **Documents & Notes** | Project-level files and notes. |
| **Invoices** | All invoices created for this project. |
| **Activity** | Full audit trail of changes. |
| **Settings** | Per-project feature toggles and preferences. |

### Project Status Management

You can change the project status from the detail page by clicking the current status badge. Available statuses:

| Status | Meaning |
|---|---|
| **Not Started** | Project has been created but work hasn't begun. |
| **In Progress** | Active work is underway. |
| **On Hold** | Temporarily paused. |
| **Cancelled** | Project has been abandoned. |
| **Completed** | All work is finished. |

---

## Tasks

Tasks are the actionable work items within a project. Each task can be assigned to specific team members, given a priority and due date, and tracked via time logs and comments.

### Task List & Kanban

Within a project's **Tasks** tab, you can toggle between:
- **List View** – Sortable DataTable with columns for Subject, Task ID, Project, Members, Priority, Status, Start Date, Due Date, Created By.
- **Kanban Board** – Cards grouped by status columns.

The view preference is stored in the project settings.

### Create a Task

1. Inside a project, go to **Tasks** tab → click **Create Task**.
2. Fill in:
   - **Subject** (required) – Short descriptive name.
   - **Members** – Assign one or more project members.
   - **Priority** – Low, Medium, High, Urgent.
   - **Status** – Default is "Not Started".
   - **Start Date / Due Date** – Plan the task timeline.
   - **Estimated Hours** – Expected effort for this task.
   - **Description** – Detailed task description (supports rich text editing).
   - **Custom Fields 1-4** – Extra data fields.
3. Click **Save**.

A unique Task ID is generated automatically (e.g., `#1`, `#2`) using the project's configured prefix.

### Task Detail View

Click on a task name to open it. The detail view shows:
- Task subject and ID
- Status badge (clickable to change)
- Priority badge
- Assigned members with avatars
- Full description (editable inline)
- **Comments** section (threaded discussion)
- **Time Logs** section (entries logged against this task)
- Created-by information and timestamps

### Task Status & Priority

**Statuses:** Not Started, In Progress, On Hold, Cancelled, Completed

**Priorities with color coding:**
| Priority | Color |
|---|---|
| Low | Green |
| Medium | Yellow |
| High | Orange |
| Urgent | Red |

Click the status badge on any task to quick-change its status without opening the edit form.

### Sub-Tasks

Tasks support a parent-child structure. This lets you break down complex tasks:

- When creating/editing a task, select a **Parent Task** to make it a sub-task.
- Sub-tasks inherit the project context but can have independent status, priority, and assignees.
- Use sub-tasks for milestones, phases, or detailed breakdowns.

### My Tasks

Access via **Project → My Tasks** in the sidebar.

This page shows a cross-project view of all tasks assigned to you (or all tasks for admins). Features:
- Filter by Project, User, Status, Priority, Due Date.
- List view with DataTables.
- Kanban board view grouped by status.

---

## Time Logs

Time logging tracks how much effort is spent on each task. This data feeds into reports and can be used for billable invoicing.

### Log Time

1. From a project's **Time Logs** tab or from a task detail page, click **Add Time Log**.
2. Fill in:
   - **Task** – Select the task this time was spent on.
   - **User** – Admins/leads can log time for other members; regular members log for themselves.
   - **Start Date/Time** – When work started.
   - **End Date/Time** – When work ended.
   - **Note** – Description of work done.
   - **Billable** – Toggle whether this entry is billable to the customer.
   - **Hourly Rate** – Override rate for this specific entry.
3. Click **Save**.

### Billable vs Non-Billable

Each time entry has a **billable** flag:
- **Billable** entries count toward client invoicing and revenue reports.
- **Non-billable** entries (internal meetings, training, etc.) are tracked for utilization analysis but not invoiced.

### Time Log Reports

See the [Reports](#reports) section for detailed time-log reporting by project and employee.

---

## Task Comments & Attachments

### Adding Comments

1. Open a task detail view.
2. Scroll to the **Comments** section.
3. Type your comment and optionally attach files using the file upload area.
4. Click **Save Comment**.

All task members (except the commenter) receive a notification.

### Attachments

- Files are uploaded using a dropzone interface.
- Supported file types depend on server configuration.
- Attachments are linked to individual comments and can be viewed/downloaded from the comment thread.

### Deleting Comments

Click the delete icon on any comment to remove it along with its attachments (requires appropriate permission).

---

## Documents & Notes

Each project has a **Documents & Notes** tab accessible from the project detail page. This uses the core application's DocumentAndNote system.

**Privacy control:**
- **Public notes** are visible to all project members.
- **Private notes** are only visible to the creator.

**Permission levels:**
- Admins and leads can create, view, and delete all notes.
- Members can view public notes. If `members_crud_note` is enabled in project settings, members can also create and delete notes.

---

## Project Invoices

### Create an Invoice

1. Open a project → go to the **Invoices** tab.
2. Click **Create Invoice**.
3. Fill in:
   - **Title** – Invoice title/description.
   - **Customer** – Pre-filled from the project's customer.
   - **Invoice Date** – Date of the invoice.
   - **Invoice Scheme** – Select the numbering scheme.
   - **Status** – Draft or Final.
   - **Business Location** – The issuing location.
   - **Line Items** – Add rows with Task name, Description, Rate, Quantity, Tax.
   - **Discount** – Fixed amount or percentage.
   - **Staff Note / Additional Notes** – Internal and external notes.
4. Click **Create**.

### Invoice Status & Payments

- **Draft** – Not yet finalized; can be edited freely.
- **Final** – Locked for editing (amounts are fixed).

Payment statuses track invoice collection:
- **Due** – Full amount unpaid.
- **Partial** – Some payment received.
- **Paid** – Fully collected.

Add payments via the **Add Payment** action on each invoice row. View all payments using **View Payments**.

---

## Reports

Access via **Project → Reports** in the sidebar (requires the **View Reports** permission or admin access).

### Time Log by Project

Shows time logged grouped by project with task-level detail.

**Filters:**
- Project (multi-select)
- Date range

### Time Log by Employee

Shows time logged grouped by employee across all their projects.

**Filters:**
- Employee (multi-select)
- Project (multi-select)
- Date range

### Tax Report Integration

Project invoice taxes automatically integrate with the application's global **Tax Report**. A dedicated "Project Invoice" tab appears in the tax report view showing:
- Invoice number and date
- Customer name and tax number
- Tax breakdowns by tax rate
- Total before tax and discount

---

## Project Settings (Per-Project)

Each project has its own **Settings** tab (accessible to admins and project leads):

| Setting | Description |
|---|---|
| **Enable Time Log** | Allow time logging for this project. |
| **Enable Document & Note** | Allow documents/notes for this project. |
| **Enable Invoice** | Allow invoicing for this project. |
| **Members Can CRUD Task** | Allow regular members to create/edit/delete tasks. |
| **Members Can CRUD Notes** | Allow regular members to manage documents. |
| **Members Can CRUD Time Log** | Allow regular members to log/edit/delete time. |
| **Task View** | Default view: List View or Kanban Board. |
| **Task ID Prefix** | Prefix for auto-generated task IDs (default: `#`). |

---

## Module Settings (Global)

Access via **Project → Settings** in the sidebar (requires the **Manage Settings** permission or admin access).

Configure custom field labels for projects. These labels appear on project create/edit forms.

---

## Categories

Project categories help organize projects by type, department, or purpose.

**Manage categories via:** Settings → Categories → Project Categories tab.

- Create, edit, and delete project categories.
- Assign multiple categories to a project during creation or editing.
- Filter the project list by category.

---

## Custom Fields

### Project Custom Fields

Up to 4 custom fields available on projects, configurable through Module Settings:
- Custom Field 1-4: Free-text fields that appear on project create/edit forms.

### Task Custom Fields

Up to 4 custom fields available on tasks:
- Custom Field 1-4: Free-text fields on task create/edit forms.

---

## Dashboard KPIs

The project index page displays key performance indicators at the top:

| KPI | Description |
|---|---|
| **Total Projects** | Total number of projects in the system. |
| **Active Projects** | Projects currently in progress. |
| **Completed Projects** | Projects marked as completed. |
| **Overdue Projects** | Projects past their end date that aren't completed/cancelled. |
| **Total Logged Hours** | Aggregate hours logged across all projects. |
| **Total Invoiced** | Sum of all finalized project invoices. |
| **Total Paid** | Sum of all payments received on project invoices. |

Status-wise project counts are also displayed as visual cards for quick overview.

### Custom Dashboard Widget

A **My Tasks** widget can be added to the main application dashboard via Dashboard Configuration. It shows task counts by status (completed, not started, in progress, on hold, cancelled, total) with optional date-range filtering.

---

## Notifications

The module sends real-time notifications for these events:

| Event | Recipients | Icon |
|---|---|---|
| **New Project Assigned** | All newly added project members (except creator) | Green check circle |
| **New Task Assigned** | All newly assigned task members (except creator) | Green tasks icon |
| **New Comment on Task** | All task members (except commenter) | Green comment icon |

Notifications appear in the application's notification bell and support broadcast/real-time channels.

---

## Activity Log

Every project has an **Activity** tab showing a full audit trail:

- Project created/updated/deleted
- Task created/updated/deleted
- Time log created/updated/deleted
- Document/note created/updated/deleted
- Settings changes (with old → new value comparison)

Each entry shows who made the change, what was changed, and when. Use **Load More** to paginate through history.

---

## User Permissions

The module provides 9 permissions that can be assigned to user roles:

| Permission | Description |
|---|---|
| **View Projects** | View projects assigned to the user. |
| **View All Projects** | View all projects regardless of membership. |
| **Create Project** | Create new projects. |
| **Edit Project** | Edit existing projects. |
| **Delete Project** | Delete projects. |
| **Manage Invoices** | Create, edit, and delete project invoices. |
| **View Reports** | Access the Reports section. |
| **Manage Settings** | Access the global Settings section. |
| **Manage Time Logs** | Full access to time logs regardless of project role. |

**Role hierarchy within a project:**
1. **Admin** – Full access to everything across all projects.
2. **Project Lead** – Full access within their assigned project.
3. **Project Member** – Access controlled by per-project settings (members_crud_task, members_crud_note, members_crud_timelog).

---

## Frequently Asked Questions

### Q: How do I see only my assigned projects?
**A:** Non-admin users automatically see only projects where they are a member. Admins see all projects.

### Q: Can team members create tasks in a project?
**A:** By default, only leads and admins can create tasks. Enable the **Members Can CRUD Task** toggle in the project's Settings tab to allow all members to create/edit/delete tasks.

### Q: How does the task ID auto-numbering work?
**A:** Each project maintains its own task counter. The ID is created automatically with a prefix and a number (e.g., #1, #2, #3). The prefix defaults to "#" but can be changed in project settings. You can also use custom prefixes like "WEB-", "APP-", etc.

### Q: Can I bill a customer for project work?
**A:** Yes! Use the **Invoices** tab within a project to create invoices with line items, taxes, and discounts. The invoice is linked to the POS transaction system, so payments can be tracked normally.

### Q: How do time logs relate to invoices?
**A:** Time logs track effort; invoices track billing. You manually create invoice line items — they are not auto-generated from time logs. However, time log data helps you determine what to bill.

### Q: Can I track project budgets?
**A:** Yes. Set the **Budget** and **Estimated Hours** fields when creating/editing a project. The Actual Cost field tracks spending. Use the dashboard KPIs to monitor budget utilization.

### Q: What happens when I delete a project?
**A:** Deleting a project removes the project record. All related tasks, time logs, and comments are also removed. Invoices (sales records) remain in the system but will no longer be linked to the project.

### Q: How are project categories different from product categories?
**A:** Project categories are a separate taxonomy type. They are managed in **Settings → Categories** under the "Project Categories" tab and only apply to projects.

---

## Tips & Best Practices

1. **Set up categories first** – Create categories like "Internal", "Client Work", "R&D" before creating projects for better organization.

2. **Use task prefixes wisely** – For multi-project environments, use different prefixes per project (e.g., `WEB-`, `APP-`, `MKT-`) to quickly identify tasks.

3. **Enable per-project permissions thoughtfully** – Only allow members to CRUD tasks/time logs if your workflow requires it. Keeping it restricted to leads ensures accountability.

4. **Log time consistently** – Encourage all team members to log time daily. Accurate time data enables better reporting and fairer invoicing.

5. **Monitor overdue projects** – The dashboard KPIs highlight overdue projects. Review them weekly and update timelines or statuses accordingly.

6. **Use the Kanban board for standups** – The visual kanban view is ideal for daily standup meetings. Group tasks by status and review progress at a glance.

7. **Leverage custom fields** – Use custom fields for data your business needs: cost center codes, external reference numbers, client PO numbers, etc.

8. **Track billable vs non-billable** – Flag time entries correctly to get accurate utilization and profitability metrics.

9. **Review activity logs** – When questions arise about project changes, the Activity tab provides a complete audit trail of who changed what and when.

10. **Use project budgets** – Setting budgets and estimated hours helps prevent scope creep and keeps financial expectations aligned between your team and clients.
