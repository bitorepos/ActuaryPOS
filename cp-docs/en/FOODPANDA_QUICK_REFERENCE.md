# Foodpanda Integration — Quick Reference Guide

**Version:** 1.0 | **Last Updated:** January 31, 2026

## Quick Start (5 Minutes)

### 1. Enable Integration
- Go to **Settings → Business → Foodpanda Integration**
- Check **Enable Foodpanda Integration**

### 2. Configure Credentials
- **Environment**: Choose staging (for testing) or production (for live orders)
- **API Username**: Your Foodpanda username
- **API Password**: Your Foodpanda password
- **Plugin Base URL**: Your webhook address (ask your administrator if unsure)

### 3. Setup Integration
- **Integration Code**: Your unique restaurant identifier (e.g., myrestaurant-sg)
- **Chain Code**: Your restaurant chain code from Foodpanda
- **Default Currency**: Select your POS currency

### 4. Add Vendor Mappings
- **Vendor Code**: Your Foodpanda vendor code
- **Remote ID**: Your location ID in the POS

### 5. Test Connection
- Click the **Test Connection** button
- You should see "Connection successful"

### 6. Webhook Setup
- Ask your system administrator to set up the webhook URL in the Foodpanda portal so that orders are received automatically.

---

## Dashboard Pages

| Page | Purpose |
|------|---------|
| **Orders** | View all incoming Foodpanda orders |
| **Order Details** | View details and items for a specific order |
| **Logs** | View history of all communication with Foodpanda |

To access these, use the **Foodpanda** menu in your navigation sidebar.

---

## Common Tasks

### Receiving an Order

**If auto-accept is enabled:**
1. Orders arrive automatically from Foodpanda
2. A new transaction is created in your POS
3. The order appears in your Foodpanda Orders dashboard

**If auto-accept is disabled:**
1. The order arrives as "Pending"
2. A staff member reviews the order in the dashboard
3. Click **Accept** or **Reject**
4. The status is sent back to Foodpanda automatically

### Updating Order Status

| Status | What to Do | When |
|--------|------------|------|
| **Accepted** | Click **Accept** | Staff accepts the order |
| **Prepared** | Click **Mark as Prepared** | Food is ready for pickup |
| **Completed** | Happens automatically | Delivery partner collects the order |
| **Rejected** | Click **Reject** | Out of stock or unable to fulfil |

### Managing Store Availability
- To mark your store as **Closed**, use the store status option in your Business Settings.
- To mark individual menu items as **Unavailable**, update their availability from your Foodpanda settings page.

---

## Troubleshooting

### No Orders Received?

1. Make sure the integration is **enabled** in Business Settings
2. Check that your API credentials are correct (click **Test Connection**)
3. Ask your administrator to confirm the webhook URL is set up correctly

### Token Expired?

1. Go to **Settings → Business → Foodpanda Integration**
2. Click **Test Connection** — the token refreshes automatically
3. Click **Save**

### Orders Fail to Sync?

1. Check the **Logs** page in your Foodpanda dashboard for error details
2. Verify that the customer and product data is correct
3. Contact your system administrator if the problem continues

---

## Support

If you need further help:
1. Check the **Logs** page in your Foodpanda dashboard for error details
2. Contact your system administrator with the error information
3. Reach out to Foodpanda support at [integration.foodpanda.com](https://integration.foodpanda.com)
