# Notification Templates

{application_name} can send automatic messages to customers and suppliers at key moments — like after a sale, when a payment is received, or when stock is running low. You can customise exactly what these messages say.

---

## What You'll Learn

- What notification templates are
- How to customise email and SMS notifications
- Which tags (placeholders) you can use in messages
- How to enable or disable specific notifications

---

## What Are Notification Templates?

Notification templates are **pre-written messages** that {application_name} sends automatically when certain events happen. For example:

- A customer receives a "Thank You" email after a purchase
- A supplier gets notified about a new payment
- A staff member receives a reminder about low stock

You can customise the **wording**, **subject line**, and **format** of these messages.

---

## How to Find Notification Templates

1. Go to **Notification Templates** from the left sidebar.
2. You'll see a list of templates, organised by **type**:
   - **Email Notifications**
   - **SMS Notifications**
3. Each template shows its **name**, **subject**, and whether it's **active**.

📸 *[Screenshot: The Notification Templates page showing the list of available templates]*

---

## How to Edit a Notification Template

1. Go to **Notification Templates**.
2. Find the template you want to change.
3. Click the **Edit** (pencil) button.
4. You'll see:
   - **Subject** — the email subject line (for email notifications)
   - **Body** — the message content
   - **Available Tags** — a list of placeholder tags you can use
5. Edit the subject and body as needed.
6. Use **tags** (like `{contact_name}` or `{invoice_number}`) to insert dynamic information.
7. Click **Save**.

📸 *[Screenshot: The notification template editor showing subject, body, and available tags]*

---

## Available Notification Types

| Notification | When It's Sent | Channels |
|---|---|---|
| **New Sale** | After a sale is completed | Email, SMS |
| **Payment Received** | When a payment is recorded | Email, SMS |
| **Payment Reminder** | When a customer has an outstanding balance | Email, SMS |
| **New Purchase Order** | When a purchase order is created | Email, SMS |
| **Purchase Payment** | When a payment to a supplier is made | Email, SMS |
| **New Quotation** | When a quotation is created | Email, SMS |
| **Stock Alert** | When stock falls below reorder level | Email |
| **Items in Stock** | When out-of-stock items are restocked | Email |
| **Customer Birthday** | On the customer's birthday | Email, SMS |

---

## Using Tags in Templates

Tags are placeholders that get replaced with real data when the message is sent.

### Common Tags

| Tag | What It Becomes |
|---|---|
| `{contact_name}` | Customer or supplier name |
| `{business_name}` | Your business name |
| `{invoice_number}` | The sale/purchase reference number |
| `{total_amount}` | The total amount of the transaction |
| `{paid_amount}` | Amount already paid |
| `{due_amount}` | Remaining balance |
| `{transaction_date}` | Date of the transaction |
| `{business_logo}` | Your business logo (in emails) |
| `{location_name}` | The business location name |

> 💡 **Tip:** The full list of available tags is shown on the editor page when you edit each template.

### Example Template

**Subject:** Thank you for your purchase — Invoice {invoice_number}

**Body:**

```
Dear {contact_name},

Thank you for shopping with {business_name}!

Your invoice number is {invoice_number}.
Total amount: {total_amount}
Paid: {paid_amount}

We appreciate your business!

Best regards,
{business_name}
```

---

## How to Enable or Disable Notifications

1. Go to **Notification Templates**.
2. Find the notification you want to toggle.
3. Use the **Auto Send** toggle to turn it on or off.
   - **ON** — message is sent automatically
   - **OFF** — message is not sent (but the template is saved for later)

📸 *[Screenshot: The Auto Send toggle on the notification templates page]*

---

## Email Setup

For email notifications to work, your system must have email configured:

1. Go to **Business Settings** → **Email** tab.
2. Enter your email settings:
   - **Mail Driver** (SMTP, Mailgun, etc.)
   - **SMTP Host** and **Port**
   - **Username** and **Password**
   - **From Address** — the email address that appears as the sender
   - **From Name** — the name that appears as the sender
3. Click **Save**.

📸 *[Screenshot: Business Settings Email tab with mail configuration fields]*

> ⚠️ If email settings are not configured, email notifications won't be sent. Ask your system administrator for the correct settings.

---

## SMS Setup

For SMS notifications to work:

1. Go to **Business Settings** → **SMS** tab.
2. Select your **SMS Gateway** (Nexmo, Twilio, etc.).
3. Enter your gateway credentials (API key, API secret, etc.).
4. Enter a **Sender ID** — the name or number recipients see.
5. Click **Save**.

📸 *[Screenshot: Business Settings SMS tab with gateway selection and credentials]*

---

## Common Questions

**Q: Why aren't my notifications being sent?**
A: Check: (1) Is the template set to Auto Send? (2) Are your email/SMS settings configured correctly? (3) Does the contact have an email/phone number?

**Q: Can I send a notification manually?**
A: Specific sales and transactions have a "Send Notification" button that lets you resend the notification.

**Q: Can I use HTML in email templates?**
A: Yes, email templates support basic HTML formatting (bold, italic, links, tables).

**Q: Will customers receive both email and SMS?**
A: Only if both channels are enabled and the customer has both an email address and phone number on file.

---

## Tips & Best Practices

- 📌 **Personalise your templates** — use tags to include the customer's name and invoice details
- 📌 **Keep messages short** especially for SMS — SMS has character limits
- 📌 **Test before going live** — send a test notification to yourself first
- 📌 **Set up Payment Reminders** to automatically remind customers about outstanding balances
- 📌 **Update templates** when you rebrand or change contact details