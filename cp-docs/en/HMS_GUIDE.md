# HMS (Hotel Management System) - User Manual

## Table of Contents
1. [Overview](#overview)
2. [Dashboard](#dashboard)
3. [Room Types & Rooms](#room-types--rooms)
4. [Pricing](#pricing)
5. [Bookings](#bookings)
6. [Calendar View](#calendar-view)
7. [Check-In & Check-Out](#check-in--check-out)
8. [Extras (Additional Services)](#extras-additional-services)
9. [Coupons](#coupons)
10. [Room Unavailability](#room-unavailability)
11. [Housekeeping](#housekeeping)
12. [Reports](#reports)
13. [Amenities](#amenities)
14. [Email Notifications](#email-notifications)
15. [PDF & Print Settings](#pdf--print-settings)
16. [Settings](#settings)
17. [Permissions](#permissions)

---

## Overview

The **HMS (Hotel Management System)** module is a comprehensive hotel/accommodation management solution integrated into BitorePOS. It enables you to manage room types, individual rooms, dynamic pricing, guest bookings, check-in/check-out workflows, extras, coupons, housekeeping, and detailed reporting — all from a single unified interface.

### Key Features
- **Room & Room Type Management** — Create accommodation categories (Single, Double, Suite, etc.) with room counts, occupancy limits, amenities, and images.
- **Dynamic Pricing** — Set day-of-week pricing and guest-count-based special pricing per room type.
- **Booking Management** — Full lifecycle from creation to confirmation, check-in, check-out, and payment tracking.
- **Calendar View** — Visual calendar showing room availability and bookings at a glance.
- **Revenue Dashboard** — KPI metrics including Occupancy Rate, ADR (Average Daily Rate), RevPAR, and revenue breakdowns.
- **Housekeeping** — Track room cleanliness status (available, occupied, cleaning, maintenance).
- **Extras & Coupons** — Additional services and promotional discount codes.
- **Guest Notifications** — Automated booking confirmation emails to customers.
- **Reports** — Comprehensive booking statistics with date range filtering.
- **PDF Booking Invoices** — Printable booking confirmations with customizable branding.

### Accessing HMS
Navigate to **HMS** in the sidebar menu or click the hotel icon. The HMS module has its own sub-navigation bar with quick access to all sections: Dashboard, Rooms, Prices, Bookings, Calendar, Extras, Coupons, Unavailables, Housekeeping, Reports, Amenities, and Settings.

---

## Dashboard

The HMS Dashboard provides a real-time overview of your hotel operations.

### Revenue KPI Cards (Top Row)
Six key performance indicators displayed at the top:
- **Today's Revenue** — Total revenue from bookings created today.
- **Monthly Revenue** — Total revenue for the current month.
- **Occupancy Rate** — Percentage of rooms currently booked vs. total rooms. A healthy hotel targets 70-85%.
- **Avg. Daily Rate (ADR)** — Average revenue per booking this month. Calculated as Monthly Revenue ÷ Number of Bookings.
- **RevPAR** — Revenue Per Available Room. Calculated as Monthly Revenue ÷ (Total Rooms × Days in Month). A core hotel industry metric.
- **Checked In Now** — Number of guests currently checked in (arrived but not departed).

### Room Status Summary (Left Column)
- **Rooms Booked Today** — Count of rooms with confirmed bookings covering today's date.
- **Pending Rooms Today** — Rooms with pending (unconfirmed) bookings for today.
- **Available Rooms Today** — Rooms not booked for today.
- **Available Rooms by Type** — Breakdown showing how many unbooked rooms exist per room type.

### Guest Statistics (Left Column)
- **Staying Tonight** — Total guests (adults + children) with active bookings covering tonight.
- **Arriving Today** — Guests expected to arrive today.
- **Leaving Today** — Guests expected to depart today.

### Arrivals, Departures & Latest (Center Column)
Three tabs showing:
- **Arrivals** — Bookings arriving today (with guest name, room details).
- **Departures** — Bookings departing today.
- **Latest** — The 5 most recent bookings created.

### Booking Charts (Right Column)
Two tabs with line charts:
- **Upcoming Bookings** — Booking count for the next 7 days.
- **Past Bookings** — Booking count for the previous 7 days.

### Revenue by Room Type (Bottom Row)
A table showing monthly revenue and booking count broken down by each room type. Helps identify your most profitable accommodations.

### Monthly Summary (Bottom Row)
A table summarizing:
- Total Rooms
- Monthly Revenue
- Monthly Collected (payments received)
- Monthly Outstanding (unpaid balance)
- ADR and RevPAR

---

## Room Types & Rooms

### Room Types
Room types represent categories of accommodation (e.g., Single Room, Double Room, Deluxe Suite, Family Room).

#### Adding a Room Type
1. Navigate to **HMS → Rooms**.
2. Click the **Add** button.
3. Fill in the form:
   - **Accommodation Type** — Name of the room category (e.g., "Deluxe Double").
   - **No of Adults** — Standard adult capacity.
   - **No of Children** — Standard child capacity.
   - **Max Occupancy** — Maximum total guests allowed.
   - **Floor** — Optionally specify the floor level.
   - **Description** — Detailed description of the room type features.
   - **Images** — Upload photos of the room type.
   - **Amenities** — Select amenities available (Wi-Fi, AC, Mini Bar, etc.).
4. Click **Save** or **Save and Add Price** to proceed directly to pricing.

#### Adding Rooms
Within each room type, you can add individual physical rooms:
1. In the room type form, scroll to the **Rooms** section.
2. Enter room numbers (e.g., 101, 102, 103).
3. Click **Add More** to add additional rooms.
4. Each room number must be unique across all room types.

#### Editing Room Types
Click the **Edit** button on any room type to modify its details, add/remove rooms, or update images.

---

## Pricing

### Default Pricing
Set the base price per night for each room type. Pricing can be configured differently for each day of the week (e.g., higher rates on weekends).

#### Setting Prices
1. Navigate to **HMS → Prices**.
2. Select a room type to configure.
3. For each day of the week (Monday through Sunday):
   - Set the **Default price per night**.
4. Click **Save**.

### Guest-Based Special Pricing
You can set different prices based on the number of guests:
1. Enable "Set different prices based on number of guests".
2. For each day, configure prices for combinations of adults and children:
   - **Adult 1 Price**, **Adult 2 Price**, **Adult 3 Price**
   - **Child 1 Price**, **Child 2 Price**, **Child 3 Price**
3. The system will automatically apply the correct price based on the number of adults and children in a booking.

> **Tip:** Leave special prices blank to use the default price for all guest counts.

---

## Bookings

### Creating a Booking
1. Navigate to **HMS → Bookings**.
2. Click **Add**.
3. Fill in the booking form:
   - **Customer** — Select or create a customer. Optionally assign a customer group.
   - **Status** — Pending, Confirmed, or Cancelled.
   - **Arrival Date & Time** — When the guest arrives.
   - **Departure Date & Time** — When the guest departs.
   - **Booking Source** — How the booking was made (Walk-In, Phone, Email, Online, Travel Agent, Other).
   - **Guest Notes** — Internal notes about the guest.
   - **Special Requests** — Guest's special requirements.
4. **Add Rooms:**
   - Click **Add Room**.
   - Select the room type and a specific room number.
   - Specify the number of adults and children.
   - The system automatically calculates the price based on your pricing configuration.
   - Add multiple rooms for group bookings.
5. **Add Extras** — Optionally add extras (breakfast, parking, etc.) with automatic price calculation.
6. **Apply Coupon** — Enter a coupon code (if available) for discounts.
7. **Payment** — Add payment details (amount, method, account).
8. **ID Proof** — Upload guest identification documents (up to 3 customizable ID fields).
9. Click **Save**.

### Booking List
The bookings table displays:
- **Booking ID** — Unique reference with your configured prefix.
- **Stay** — Arrival → Departure dates.
- **Customer** — Guest name.
- **Status** — Pending (yellow), Confirmed (green), Cancelled (red).
- **Payment Status** — Paid, Due, Partial, or Overdue.
- **Payment Method** — How the guest paid.
- **Total Amount** — Full booking cost.
- **Total Paid** — Amount received.
- **Due** — Outstanding balance.
- **Created At** — When the booking was made.

### Booking Actions
Each booking row has action buttons:
- **Edit** — Modify booking details (requires `hms.edit_booking` permission).
- **Check-In** — Mark guest as arrived (only for confirmed, not-yet-checked-in bookings).
- **Check-Out** — Mark guest as departed (only for checked-in guests).
- **View** — View full booking details in a modal.
- **Print** — Generate PDF invoice for the booking.
- **Delete** — Remove the booking entirely (requires `hms.delete_booking` permission).
- **Add Payment** — Record a payment (shown when balance is due).
- **View Payments** — See all payment transactions for this booking.

### Filters
Use the filter bar to narrow results:
- **Customer** — Filter by specific customer.
- **Status** — Filter by booking status (Pending, Confirmed, Cancelled).
- **Payment Status** — Filter by payment status (Paid, Due, Partial, Overdue).

---

## Calendar View

The calendar provides a visual, drag-friendly overview of all bookings.

1. Navigate to **HMS → Calendar**.
2. The calendar displays bookings as colored bars spanning their arrival-to-departure dates.
3. **Navigation:**
   - Use arrow buttons to scroll forward/backward in time.
   - Use the **Jump to** date picker to go to a specific date.
4. **Click on a booking** bar to view its details.
5. **Color coding** indicates booking status:
   - Green = Confirmed
   - Yellow = Pending
   - Red = Cancelled

> **Tip:** The calendar is ideal for quickly identifying availability gaps and overbooking risks.

---

## Check-In & Check-Out

### Check-In
1. From the bookings list, find a confirmed booking that hasn't been checked in.
2. Click the **Check-In** button (green button with door icon).
3. A modal will appear for confirmation with the current date/time.
4. Confirm to record the check-in timestamp.
5. The room status can then be updated to "Occupied" in Housekeeping.

### Check-Out
1. From the bookings list, find a checked-in booking.
2. Click the **Check-Out** button (red button with door icon).
3. If payment is not fully settled, a warning will appear.
4. Confirm to record the check-out timestamp.
5. After check-out, update the room status to "Cleaning" in Housekeeping.

> **Note:** Check-in is only available for confirmed bookings. Check-out is only available for checked-in bookings.

---

## Extras (Additional Services)

Extras are additional services or items guests can add to their booking (e.g., breakfast, airport transfer, parking, spa treatment).

### Adding an Extra
1. Navigate to **HMS → Extras**.
2. Click **Add Extra**.
3. Fill in:
   - **Name** — Service name (e.g., "Continental Breakfast").
   - **Description** — Details about the service.
   - **Price** — Cost of the service.
   - **Price Per** — How pricing is calculated:
     - **Per Day** — Charged for each night of stay.
     - **Per Booking** — Flat fee per booking.
     - **Per Person** — Charged per guest.
     - **Per Day Per Person** — Charged per guest per night.
   - **Category** — Optional grouping category.
4. Click **Save**.

### Managing Extras
- **Edit** — Click the edit button to modify an extra's details.
- **Delete** — Click the delete button to remove an extra.
- Extras added to existing bookings will retain their original pricing.

---

## Coupons

Coupons provide promotional discounts that guests can apply during booking.

### Adding a Coupon
1. Navigate to **HMS → Coupons**.
2. Click **Add Coupon**.
3. Fill in:
   - **Room Type** — Select which room type this coupon applies to.
   - **Coupon Code** — The code guests will enter (e.g., "SUMMER20").
   - **Discount** — The discount value.
   - **Discount Type** — Percentage or Fixed amount.
   - **Date From** — Start date when the coupon becomes valid.
   - **Date To** — End date when the coupon expires.
   - **Usage Limit** — Maximum number of times this coupon can be used (leave blank for unlimited).
   - **Min. Stay Nights** — Minimum number of nights required to use this coupon.
   - **Active** — Toggle the coupon on/off.
4. Click **Save**.

### Applying a Coupon
When creating or editing a booking:
1. Enter the coupon code in the **Apply Coupon** field.
2. Click **Apply**.
3. If valid, the discount will be applied to the booking total.
4. Invalid or expired codes will show an error message.

---

## Room Unavailability

Mark rooms as unavailable for specific periods (e.g., maintenance, renovation, seasonal closure).

### Adding Unavailability
1. Navigate to **HMS → Unavailables**.
2. Click **Add Unavailable**.
3. Fill in:
   - **Room** — Select the room to mark as unavailable.
   - **Date From** — Start of unavailability period.
   - **Date To** — End of unavailability period.
   - **Unavailable Type** — Reason category (e.g., Maintenance, Renovation, Blocked).
   - **Reason** — Detailed explanation.
4. Click **Save**.

### Effect on Bookings
- Rooms marked as unavailable will **not appear** in the available rooms list when creating bookings for overlapping dates.
- The calendar will show unavailable periods for easy visibility.

---

## Housekeeping

The Housekeeping section provides a visual overview of all rooms and their current cleanliness/availability status.

### Accessing Housekeeping
Navigate to **HMS → Housekeeping** from the navigation bar.

### Status Overview
Four summary cards show the count of rooms in each status:
- **Available** (Green) — Room is clean and ready for guests.
- **Occupied** (Red) — Guest is currently staying.
- **Maintenance** (Yellow) — Room is under repair or maintenance.
- **Cleaning** (Blue) — Room needs cleaning or is being cleaned.

### Room Status Grid
Rooms are displayed as color-coded cards grouped by room type:
- Each card shows the room number and current status.
- Three action buttons on each card allow quick status updates:
  - **Green check** — Mark as Available (clean and ready).
  - **Blue broom** — Mark as Cleaning (needs housekeeping).
  - **Yellow wrench** — Mark as Maintenance.

### Recommended Workflow
1. When a guest **checks out**, mark the room as **Cleaning**.
2. After housekeeping staff completes cleaning, mark as **Available**.
3. When a guest **checks in**, mark as **Occupied**.
4. For maintenance issues, mark as **Maintenance** and create an unavailability period.

---

## Reports

### Generating a Report
1. Navigate to **HMS → Reports**.
2. Select a **Date Range** (from and to dates).
3. Click **Generate**.

### Report Sections
The report displays comprehensive statistics:

#### Overall Statistics
- **Total Bookings Received** — All bookings in the date range.
- **Total Guests** — Sum of all adults and children.
- **Total Nights Booked** — Sum of all stay durations.
- **Total Amount** — Sum of all booking values.

#### By Status
Separate breakdowns for Confirmed, Cancelled, and Pending bookings, each showing:
- Booking count
- Guest count
- Nights count

#### Room Type Breakdown
Revenue and booking statistics per room type.

#### Rooms Per Booking
Distribution of bookings by room count (1 room, 2 rooms, 2+ rooms).

#### Nights Per Booking
Distribution of bookings by stay duration (1 night through 6+ nights).

#### Guests Per Booking
Distribution of bookings by adult guest count (1 through 6+ guests).

---

## Amenities

Amenities are facilities available in rooms (e.g., Wi-Fi, Air Conditioning, Mini Bar, Swimming Pool, Gym Access).

### Managing Amenities
1. Navigate to **HMS → Amenities**.
2. Click **Add** to create a new amenity.
3. Enter the amenity name.
4. Click **Save**.
5. These amenities can then be selected when creating or editing room types.

---

## Email Notifications

### Booking Confirmation Emails
The HMS module can send automated email notifications to customers when bookings are created.

### Configuring Email Templates
1. Navigate to **HMS → Settings**.
2. Click the **Customer Notifications** tab.
3. Configure the email template:
   - **Subject** — Email subject line.
   - **Body** — Email content with template tags.
4. Available template tags:
   - `{business_name}` — Your business name.
   - `{customer_name}` — Guest's name.
   - `{booking_ref}` — Booking reference number.
   - `{arrival_date}` — Check-in date.
   - `{departure_date}` — Check-out date.
   - `{total_amount}` — Total booking cost.
   - And other standard template tags.

---

## PDF & Print Settings

### Configuring PDF Layout
1. Navigate to **HMS → Settings**.
2. Click the **Print PDF** tab.
3. Configure:
   - **Upload Logo** — Upload your hotel logo for PDF headers.
   - **Footer Text** — Custom footer text on each page.
   - **Address** — Hotel address.
   - **Phone Number** — Contact phone.
   - **Email** — Contact email.
   - **Website** — Hotel website URL.
4. Click **Save**.

### Printing a Booking
From the bookings list, click the **Print** button on any booking to generate a PDF with:
- Hotel branding (logo, address, contact info)
- Booking details (reference, dates, status)
- Room details (type, room numbers, occupancy)
- Extra services
- Pricing breakdown
- Payment information
- Guest ID proof details
- Custom footer text

---

## Settings

### Booking Settings
1. Navigate to **HMS → Settings**.
2. In the **Booking** tab:
   - **Booking Prefix** — Set the prefix for booking reference numbers (e.g., "BK-" results in BK-0001, BK-0002).
   - **ID Proof Labels** — Customize the labels for up to 3 ID proof fields:
     - Label 1 (e.g., "Passport Number")
     - Label 2 (e.g., "Driver's License")
     - Label 3 (e.g., "National ID")
3. Click **Save**.

---

## Permissions

The HMS module uses role-based permissions to control access. Assign these permissions to user roles in **Settings → Roles**:

| Permission | Description |
|---|---|
| **Manage Rooms** | Create, edit, and view room types and rooms |
| **Manage Pricing** | Configure room pricing |
| **Manage Unavailability** | Manage room unavailability periods |
| **Manage Extras** | Create and manage extra services |
| **Manage Coupons** | Create and manage coupons |
| **Add Booking** | Create new bookings |
| **Edit Booking** | Edit existing bookings |
| **Delete Booking** | Delete bookings |
| **Manage Amenities** | Manage amenity types |
| **Manage Settings** | Access HMS settings |
| **Add Booking Payment** | Add payments to bookings |
| **Edit Booking Payment** | Edit booking payments |
| **Delete Booking Payment** | Delete booking payments |

> **Tip:** Super Admin users have access to all features regardless of permissions.

---

## Frequently Asked Questions

### How do I set weekend rates?
Navigate to Pricing and set different prices for Saturday and Sunday compared to weekday rates.

### Can I create bookings for multiple rooms?
Yes, click "Add Room" multiple times during booking creation to add as many rooms as needed with different room types and guest counts.

### What happens when I cancel a booking?
The booking status changes to "Cancelled" and the associated rooms become available for new bookings. Payments already received will remain on record.

### How do I track revenue?
The Dashboard shows today's revenue, monthly revenue, ADR, RevPAR, and occupancy rate. For detailed analysis, use the Reports section with custom date ranges.

### Can I restrict access to certain features?
Yes, use the Permissions system. Assign specific HMS permissions to user roles to control who can manage rooms, create bookings, access settings, etc.

### How does the coupon system work?
Create coupons with codes, validity dates, and discount amounts. Guests (or staff) enter the coupon code during booking to apply the discount. Coupons can be limited by room type, usage count, and minimum stay nights.
