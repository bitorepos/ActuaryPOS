# Foodpanda Integration — Troubleshooting Guide

This guide helps you diagnose and fix common issues with the Foodpanda integration.

---

## Quick Checklist

Before looking at specific problems, check these basics:

- [ ] The **Foodpanda** menu is visible in your sidebar (if it's not, the add-on hasn't been activated for your business yet — request it from the Superadmin)
- [ ] API credentials (username and password) are correct
- [ ] You clicked **Test Connection** and it shows success
- [ ] Your system administrator has confirmed the webhook is set up

---

## Common Issues & Solutions

### 1. Orders Not Coming Through

**What you see:** Foodpanda shows orders on their end, but they don't appear in your POS.

| Possible Cause | What to Do |
|---|---|
| Add-on not active for your business | Open **Contact Superadmin** and ask for the **Foodpanda** add-on to be activated for your business |
| Wrong credentials | Re-enter your API username and password, then click Test Connection |
| Webhook not set up | Ask your system administrator to verify the webhook URL in the Foodpanda portal |
| Wrong environment | Make sure you're using **Production** credentials for live orders, or **Staging** for testing |

---

### 2. Login or Authentication Errors

**What you see:** Error messages like "Unauthorized" or "Forbidden" when testing the connection.

| Possible Cause | What to Do |
|---|---|
| Incorrect credentials | Double-check your API username and password in settings |
| Wrong environment selected | Make sure your staging/production setting matches the credentials you're using |
| Expired token | Click **Test Connection** — the system automatically refreshes the token |

---

### 3. Menu Not Syncing

**What you see:** Your products don't appear on Foodpanda, or prices look wrong.

| Issue | What to Do |
|---|---|
| Products missing on Foodpanda | Make sure products are marked as **Active** and have selling prices |
| Wrong prices | Check that your currency settings match what Foodpanda expects |
| Categories incorrect | Verify your product categories are mapped correctly to Foodpanda categories |
| Images not showing | Make sure product images are uploaded properly |

---

### 4. Order Status Not Updating

**What you see:** You change the status in your POS (e.g., mark as Prepared) but Foodpanda doesn't show the change.

| Possible Cause | What to Do |
|---|---|
| Connection issue | Click **Test Connection** to verify you can reach Foodpanda |
| Processing delay | Wait a moment and refresh — some updates take a few seconds |
| Persistent errors | Check the **Logs** page in Foodpanda for error details and contact your administrator |

---

### 5. Duplicate Orders

**What you see:** The same order appears more than once in your POS.

| Possible Cause | What to Do |
|---|---|
| Slow processing | Foodpanda may resend an order if it doesn't get a quick response — contact your administrator |
| System issue | Check the **Logs** page for details and contact your administrator |

---

## Checking the Logs

Your Foodpanda dashboard includes a **Logs** page that records all communication between your POS and Foodpanda. This is the best place to look when something goes wrong:

1. Navigate to the **Foodpanda → Logs** page
2. Look at the most recent entries
3. Error messages will explain what went wrong
4. Share this information with your system administrator if you need further help

---

## Getting Help

If problems continue after checking this guide:

1. Check the **Logs** page for specific error details
2. Note down the date, time, and error message
3. Contact your system administrator with this information
4. For Foodpanda-side issues, contact Foodpanda support directly

---

> **Tip:** Always test changes in Staging mode first before applying them to your live (Production) setup.
