# Foodpanda Integration — Testing Guide

This guide covers how to test the Foodpanda integration before going live with real orders.

---

## Testing Environments

| Environment | Purpose |
|---|---|
| **Staging** | For testing with sample orders (no real charges) |
| **Production** | For live, real customer orders |

> **Important:** Always test thoroughly in staging before switching to production.

---

## Before You Start Testing

### 1. Enable Staging Mode
1. Go to **Settings → Business → Foodpanda Integration**
2. Set **Environment** to **Staging**
3. Enter your staging API credentials (provided by Foodpanda)
4. Click **Save**

### 2. Verify Your Setup
- [ ] Foodpanda module is enabled in Business Settings → Modules
- [ ] Staging credentials are entered correctly
- [ ] At least one business location is selected
- [ ] You have products with selling prices in your catalogue

---

## Test Scenarios

### Test 1: Connection Check

**Goal:** Confirm your system can talk to Foodpanda.

**Steps:**
1. Go to the Foodpanda settings page
2. Click **Test Connection**
3. You should see a success message

---

### Test 2: Menu Sync

**Goal:** Make sure your products appear correctly on Foodpanda.

**Steps:**
1. Create a test product with a selling price
2. Trigger a menu sync from settings
3. Check the Foodpanda staging dashboard for the product

**What to verify:**
- [ ] Product name appears correctly
- [ ] Price matches what you set
- [ ] Product image shows up (if you uploaded one)
- [ ] Category is correct

---

### Test 3: Receiving an Order

**Goal:** Confirm that Foodpanda orders appear in your POS.

**Steps:**
1. Place a test order through the Foodpanda staging portal
2. Wait a moment for the order to arrive
3. Check **Sell → All Sales** for the new transaction

**What to verify:**
- [ ] Transaction is created with the correct items
- [ ] Prices match the Foodpanda order
- [ ] Customer information is recorded
- [ ] Order status shows correctly

---

### Test 4: Updating Order Status

**Goal:** Make sure status changes go back to Foodpanda.

**Steps:**
1. Accept the test order in your POS
2. Mark it as **Preparing**, then **Completed**
3. Check the Foodpanda staging dashboard for each status change

**What to verify:**
- [ ] Each status change appears on Foodpanda
- [ ] No duplicate updates are sent

---

### Test 5: Cancelling an Order

**Goal:** Confirm cancellation works in both systems.

**Steps:**
1. Place a new test order
2. Cancel it from your POS
3. Check that it shows as cancelled on Foodpanda

**What to verify:**
- [ ] Order is marked as cancelled in both systems
- [ ] Stock quantities are restored (if applicable)
- [ ] No payment is recorded for the cancelled order

---

### Test 6: Error Handling

**Goal:** Make sure the system handles mistakes gracefully.

**Steps:**
1. Temporarily enter incorrect API credentials
2. Try a menu sync or status update — it should fail with a clear error
3. Fix the credentials and try again — it should work normally

**What to verify:**
- [ ] A clear error message appears
- [ ] No data is lost or corrupted
- [ ] The system recovers after credentials are fixed

---

## Going Live Checklist

After all tests pass in staging:

- [ ] Switch environment to **Production** in settings
- [ ] Enter your production API credentials
- [ ] Ask your administrator to confirm the production webhook is set up
- [ ] Place one real test order to confirm everything works end-to-end
- [ ] Monitor the Logs page closely for the first 24 hours

---

## Test Results Template

Use this to track your results:

| Test | Date | Result | Notes |
|---|---|---|---|
| Connection | | Pass / Fail | |
| Menu Sync | | Pass / Fail | |
| Incoming Order | | Pass / Fail | |
| Status Updates | | Pass / Fail | |
| Cancellation | | Pass / Fail | |
| Error Handling | | Pass / Fail | |

---

> **Tip:** Keep the staging environment configured even after going live. It's useful for testing new features or troubleshooting issues later.
