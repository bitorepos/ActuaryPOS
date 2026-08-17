# Foodpanda Integration - Architecture Diagram

**Date:** January 31, 2026  
**System:** BitorePOS 5.02 + Foodpanda Delivery Platform

---

## System Overview

```
┌────────────────────────────────────────────────────────────────┐
│                    FOODPANDA PLATFORM                          │
│              (Delivery Hero Integration API)                   │
│                                                                │
│  - Customer Orders → Foodpanda receives orders                │
│  - Order Management → Foodpanda vendor app or direct          │
│  - Delivery Management → Delivery partners                    │
└────────────────────────────────────────────────────────────────┘
                              │
                    ┌─────────┼─────────┐
                    │         │         │
            Webhook Requests  │     API Requests
                    │         │         │
                    ▼         ▼         ▼
┌────────────────────────────────────────────────────────────────┐
│                 BITORPOS SYSTEM (Your Server)                  │
│                   https://yourpos.com                          │
├────────────────────────────────────────────────────────────────┤
│                                                                │
│  ┌──────────────────────────────────────────────────────────┐ │
│  │  FOODPANDA MODULE (modules/Foodpanda/)                  │ │
│  │                                                          │ │
│  │  ┌─────────────────────────────────────────────────────┐│ │
│  │  │ WEBHOOK LAYER (Http/Controllers/WebhookController) ││ │
│  │  ├─────────────────────────────────────────────────────┤│ │
│  │  │ POST /foodpanda/webhook/order-dispatch              ││ │
│  │  │ POST /foodpanda/webhook/order-status-update         ││ │
│  │  │ POST /foodpanda/webhook/catalog-import-status       ││ │
│  │  │ POST /foodpanda/webhook/menu-import-request         ││ │
│  │  │                                                      ││ │
│  │  │ → Receives & validates incoming payloads            ││ │
│  │  │ → Sanitizes data (XSS, SQL injection prevention)   ││ │
│  │  │ → Routes to appropriate services                   ││ │
│  │  └──────────────┬──────────────────────────────────────┘│ │
│  │                │                                         │ │
│  │                ▼                                         │ │
│  │  ┌─────────────────────────────────────────────────────┐│ │
│  │  │ SERVICE LAYER (Services/)                           ││ │
│  │  ├─────────────────────────────────────────────────────┤│ │
│  │  │                                                      ││ │
│  │  │  OrderSyncService                                   ││ │
│  │  │  ├─ processIncomingOrder()                         ││ │
│  │  │  ├─ syncOrderToTransaction()                       ││ │
│  │  │  ├─ handleOrderStatusUpdate()                      ││ │
│  │  │  └─ retrySyncFailedOrder()                         ││ │
│  │  │                                                      ││ │
│  │  │  StatusUpdateService                               ││ │
│  │  │  ├─ acceptOrder()                                  ││ │
│  │  │  ├─ rejectOrder()                                  ││ │
│  │  │  ├─ markPrepared()                                 ││ │
│  │  │  ├─ markCompleted()                                ││ │
│  │  │  ├─ cancelOrder()                                  ││ │
│  │  │  └─ updateVendorAvailability()                     ││ │
│  │  │                                                      ││ │
│  │  │  FoodpandaApiClient                                ││ │
│  │  │  ├─ authenticate()                                 ││ │
│  │  │  ├─ updateOrderStatus()                            ││ │
│  │  │  ├─ markOrderPrepared()                            ││ │
│  │  │  ├─ submitCatalog()                                ││ │
│  │  │  └─ updateItemAvailability()                       ││ │
│  │  │                                                      ││ │
│  │  └──────────────┬──────────────────────────────────────┘│ │
│  │                │                                         │ │
│  │                ▼                                         │ │
│  │  ┌─────────────────────────────────────────────────────┐│ │
│  │  │ MODEL LAYER (Models/)                               ││ │
│  │  ├─────────────────────────────────────────────────────┤│ │
│  │  │                                                      ││ │
│  │  │  FoodpandaOrder                                     ││ │
│  │  │  ├─ order_token (unique identifier)                ││ │
│  │  │  ├─ vendor_code (Foodpanda vendor)                 ││ │
│  │  │  ├─ order_data (full JSON payload)                 ││ │
│  │  │  ├─ status (pending, accepted, prepared, etc)      ││ │
│  │  │  ├─ transaction_id (linked to BitorePOS)          ││ │
│  │  │  ├─ sync_error (for failed orders)                 ││ │
│  │  │  └─ timestamps (received, accepted, prepared, etc) ││ │
│  │  │                                                      ││ │
│  │  │  FoodpandaLog                                       ││ │
│  │  │  ├─ endpoint (API endpoint called)                  ││ │
│  │  │  ├─ request_payload (what was sent)                ││ │
│  │  │  ├─ response_payload (what was returned)           ││ │
│  │  │  ├─ status (success, failed, timeout)              ││ │
│  │  │  ├─ response_time_ms (performance metric)          ││ │
│  │  │  └─ error_message (if failed)                      ││ │
│  │  │                                                      ││ │
│  │  └──────────────┬──────────────────────────────────────┘│ │
│  │                │                                         │ │
│  │                ▼                                         │ │
│  │  ┌─────────────────────────────────────────────────────┐│ │
│  │  │ DATA LAYER (Database)                               ││ │
│  │  ├─────────────────────────────────────────────────────┤│ │
│  │  │                                                      ││ │
│  │  │  foodpanda_orders table                             ││ │
│  │  │  └─ Order tracking and syncing                      ││ │
│  │  │                                                      ││ │
│  │  │  foodpanda_logs table                               ││ │
│  │  │  └─ API call audit trail                            ││ │
│  │  │                                                      ││ │
│  │  │  business table (updated)                           ││ │
│  │  │  └─ Foodpanda settings & credentials               ││ │
│  │  │                                                      ││ │
│  │  └─────────────────────────────────────────────────────┘│ │
│  │                                                          │ │
│  │  ┌─────────────────────────────────────────────────────┐│ │
│  │  │ MANAGEMENT LAYER (Controllers/FoodpandaController)  ││ │
│  │  ├─────────────────────────────────────────────────────┤│ │
│  │  │ GET  /foodpanda/orders          (Order dashboard)   ││ │
│  │  │ POST /foodpanda/orders/{id}/accept                  ││ │
│  │  │ POST /foodpanda/orders/{id}/reject                  ││ │
│  │  │ POST /foodpanda/orders/{id}/prepared                ││ │
│  │  │ GET  /foodpanda/logs            (API logs viewer)   ││ │
│  │  │ GET  /foodpanda/api/summary     (Statistics)        ││ │
│  │  └─────────────────────────────────────────────────────┘│ │
│  │                                                          │ │
│  └──────────────────────────────────────────────────────────┘ │
│                                                                │
│  ┌──────────────────────────────────────────────────────────┐ │
│  │  EXISTING BITORPOS SYSTEM                                │ │
│  ├──────────────────────────────────────────────────────────┤ │
│  │                                                          │ │
│  │  Transactions (app/Transaction.php)                     │ │
│  │  ├─ Sell type for POS orders                           │ │
│  │  └─ Linked via foodpanda_orders.transaction_id          │ │
│  │                                                          │ │
│  │  Contacts (app/Contact.php)                            │ │
│  │  └─ Auto-created from customer info                    │ │
│  │                                                          │ │
│  │  Products (app/Product.php)                            │ │
│  │  └─ Auto-created from menu items                       │ │
│  │                                                          │ │
│  │  Business (app/Business.php)                           │ │
│  │  └─ Stores Foodpanda settings & credentials            │ │
│  │                                                          │ │
│  │  Business Settings UI                                  │ │
│  │  └─ Configure integration in settings_foodpanda.blade  │ │
│  │                                                          │ │
│  └──────────────────────────────────────────────────────────┘ │
│                                                                │
└────────────────────────────────────────────────────────────────┘
                              │
                    ┌─────────┴──────────┐
                    │                    │
                    ▼                    ▼
        ┌──────────────────┐  ┌──────────────────┐
        │ Application Logs │  │  Browser Access  │
        │                  │  │                  │
        │ storage/logs/    │  │ /foodpanda/      │
        │ laravel.log      │  │ /foodpanda/logs  │
        └──────────────────┘  └──────────────────┘
```

---

## Order Processing Flow

```
CUSTOMER PLACES ORDER ON FOODPANDA
           │
           ▼
FOODPANDA SENDS WEBHOOK (order-dispatch)
           │
           ▼
┌──────────────────────────────────────────────┐
│ WebhookController.handleOrderDispatch()      │
│                                              │
│ 1. Validate payload                          │
│ 2. Sanitize data                             │
│ 3. Find business by vendor code              │
│ 4. Check integration enabled                 │
└──────────────────────────────────────────────┘
           │
           ▼
┌──────────────────────────────────────────────┐
│ OrderSyncService.processIncomingOrder()      │
│                                              │
│ 1. Validate order data                       │
│ 2. Check for duplicates                      │
│ 3. Create FoodpandaOrder record              │
│ 4. Get or create customer (Contact)          │
│ 5. If auto-accept:                           │
│    - syncOrderToTransaction()                │
│    - Create Transaction                      │
│    - Create TransactionSellLines             │
│    - markAccepted()                          │
└──────────────────────────────────────────────┘
           │
           ▼
    ┌──────────────────┐
    │ Status: pending  │  (if not auto-accept)
    │ OR              │
    │ Status: accepted │  (if auto-accept)
    └──────────────────┘
           │
           ▼
OPERATOR REVIEWS ORDER IN DASHBOARD (/foodpanda/orders)
           │
       ┌───┴────┐
       │        │
       ▼        ▼
    ACCEPT   REJECT
       │        │
       │        ▼
       │   ┌──────────────────────────────┐
       │   │StatusUpdateService.          │
       │   │rejectOrder()                 │
       │   │                              │
       │   │1. Call API: updateOrderStatus│
       │   │2. FoodpandaOrder.markRejected│
       │   │3. Log API call               │
       │   └──────────────────────────────┘
       │        │
       │        ▼
       │   Order shows "rejected" on Foodpanda
       │
       ▼
┌──────────────────────────────────────────────┐
│StatusUpdateService.acceptOrder()             │
│                                              │
│1. Call API: updateOrderStatus                │
│   (order_accepted with prep time)            │
│2. FoodpandaOrder.markAccepted()              │
│3. log API call in foodpanda_logs             │
│4. Transaction already created (or create now)│
└──────────────────────────────────────────────┘
           │
           ▼
ORDER SHOWS "ACCEPTED" ON FOODPANDA
           │
STAFF PREPARES FOOD
           │
           ▼
┌──────────────────────────────────────────────┐
│StatusUpdateService.markPrepared()            │
│                                              │
│1. Call API: markOrderPrepared()              │
│2. FoodpandaOrder.markPrepared()              │
│3. Log API call                               │
└──────────────────────────────────────────────┘
           │
           ▼
ORDER SHOWS "PREPARED" ON FOODPANDA
           │
DELIVERY PARTNER PICKS UP
           │
           ▼
ORDER SHOWS "COMPLETED" ON FOODPANDA
           │
           ▼
FoodpandaOrder.status = "completed"
Transaction in BitorePOS (for accounting)
```

---

## API Authentication Flow

```
FIRST REQUEST OR TOKEN EXPIRED
           │
           ▼
┌──────────────────────────────────────────────┐
│FoodpandaApiClient.authenticate()             │
│                                              │
│1. Check if token exists and is valid         │
│2. If valid and not expired: return token     │
│3. If expired or missing: refresh              │
└──────────────────────────────────────────────┘
           │
           ▼
POST /api/v2/auth/login
{
  "username": "your_username",
  "password": "your_password"
}
           │
           ▼
FOODPANDA RETURNS
{
  "access_token": "token_string",
  "expires_in": 3600
}
           │
           ▼
┌──────────────────────────────────────────────┐
│Store in Database:                            │
│ business.foodpanda_api_token = token_string  │
│ business.foodpanda_token_expires_at = time+1h│
└──────────────────────────────────────────────┘
           │
           ▼
USE TOKEN FOR SUBSEQUENT REQUESTS
Authorization: Bearer token_string
```

---

## Data Flow: Order to Transaction

```
FOODPANDA ORDER JSON
{
  "order_token": "FP_12345",
  "vendor_code": "vendor_001",
  "customer_name": "John Doe",
  "customer_phone": "+1234567890",
  "order_total": 50.00,
  "currency": "USD",
  "items": [
    {
      "name": "Burger",
      "quantity": 2,
      "unit_price": 20.00
    }
  ]
}
           │
           ▼ OrderSyncService
┌──────────────────────────────────────────────┐
│ CREATE RECORDS                               │
├──────────────────────────────────────────────┤
│                                              │
│ 1. FoodpandaOrder                            │
│    - order_token: FP_12345                   │
│    - vendor_code: vendor_001                 │
│    - order_data: { full JSON }               │
│    - status: pending                         │
│                                              │
│ 2. Contact (Customer)                        │
│    - name: John Doe                          │
│    - mobile: +1234567890                     │
│    - type: customer                          │
│                                              │
│ 3. Product (if not exists)                   │
│    - name: Burger                            │
│    - sku: FP_burger_hash                     │
│                                              │
│ 4. Transaction (if auto-accept)              │
│    - type: sell                              │
│    - contact_id: (from customer)             │
│    - invoice_no: (auto-generated)            │
│    - ref_no: FP_12345                        │
│    - total_amount: 50.00                     │
│                                              │
│ 5. TransactionSellLine                       │
│    - product_id: (from product)              │
│    - quantity: 2                             │
│    - unit_price: 20.00                       │
│    - line_amount: 40.00                      │
│                                              │
│ Link: FoodpandaOrder.transaction_id          │
└──────────────────────────────────────────────┘
           │
           ▼
TRANSACTION APPEARS IN BITORPOS
├─ Sales history
├─ Customer ledger
├─ Inventory tracking
└─ Accounting reports
```

---

## Error Handling Flow

```
OPERATION FAILS (Network, API error, validation)
           │
           ▼
┌──────────────────────────────────────────────┐
│ Catch Exception                              │
│                                              │
│ Try: API call or data operation              │
│ Catch: \Exception                            │
└──────────────────────────────────────────────┘
           │
           ▼
┌──────────────────────────────────────────────┐
│ Log & Record Error                           │
│                                              │
│ 1. Log to Laravel: Log::error()              │
│ 2. Create FoodpandaLog record:               │
│    - endpoint                                │
│    - status: 'failed'                        │
│    - error_message                           │
│    - response_code                           │
│ 3. FoodpandaOrder.recordSyncError()          │
│    - sync_error: error message               │
│    - sync_attempts++                         │
│    - last_sync_attempt: now()                │
└──────────────────────────────────────────────┘
           │
           ▼
┌──────────────────────────────────────────────┐
│ Retry Logic                                  │
│                                              │
│ If sync_attempts < 5:                        │
│   - Scheduled job checks every 10 minutes    │
│   - Retries failed orders                    │
│   - Logs each attempt                        │
│                                              │
│ If sync_attempts >= 5:                       │
│   - Requires manual intervention             │
│   - Dashboard shows as 'failed'              │
│   - Admin can manually retry                 │
└──────────────────────────────────────────────┘
```

---

## Logging Architecture

```
ALL OPERATIONS LOG TO MULTIPLE PLACES

Operation
   │
   ├─ APPLICATION LOG
   │  └─ storage/logs/laravel.log
   │     Contains: Full stack trace, context
   │
   ├─ DATABASE LOG (FoodpandaLog)
   │  └─ foodpanda_logs table
   │     Contains: Request, response, timing, status
   │
   ├─ MODEL LOG (FoodpandaOrder)
   │  └─ foodpanda_orders table
   │     Contains: Order status, errors, sync attempts
   │
   └─ BUSINESS LOG (Business model)
       └─ business table
          Contains: Last sync time, token expiry
```

---

## Security Layers

```
┌────────────────────────────────────────────────────────┐
│ EXTERNAL SECURITY (Firewall)                          │
│ - IP whitelist: Allow only Foodpanda IPs              │
│ - HTTPS enforcement: TLS 1.2+                         │
│ - SSL certificate validation                          │
└────────────────────────────────────────────────────────┘
           │
           ▼
┌────────────────────────────────────────────────────────┐
│ INPUT VALIDATION (FormRequest)                        │
│ - OrderDispatchRequest validates schema               │
│ - OrderStatusUpdateRequest validates status enum      │
│ - Rejects invalid payloads (422)                      │
└────────────────────────────────────────────────────────┘
           │
           ▼
┌────────────────────────────────────────────────────────┐
│ DATA SANITIZATION (WebhookController)                 │
│ - XSS prevention: strip_tags()                        │
│ - HTML escaping: trim()                               │
│ - Email validation: filter_var()                      │
│ - Phone sanitization: regex clean                     │
└────────────────────────────────────────────────────────┘
           │
           ▼
┌────────────────────────────────────────────────────────┐
│ BUSINESS LOGIC VALIDATION (Services)                  │
│ - Duplicate order check                               │
│ - Status transition validation                        │
│ - Amount validation                                   │
│ - Business context verification                       │
└────────────────────────────────────────────────────────┘
           │
           ▼
┌────────────────────────────────────────────────────────┐
│ API AUTHENTICATION (FoodpandaApiClient)               │
│ - Token-based (Bearer token)                          │
│ - Automatic token refresh                            │
│ - Credential encryption in database                  │
└────────────────────────────────────────────────────────┘
           │
           ▼
┌────────────────────────────────────────────────────────┐
│ DATABASE SECURITY                                     │
│ - Foreign key constraints                            │
│ - Soft deletes for audit trail                       │
│ - Encrypted password fields                          │
│ - Index optimization for performance                 │
└────────────────────────────────────────────────────────┘
```

---

## Deployment Architecture

```
┌──────────────────────────────────────────────────┐
│ DEVELOPMENT                                      │
│ - Local testing with ngrok or local HTTPS       │
│ - Staging API credentials                       │
│ - Database: local development copy               │
└──────────────────────────────────────────────────┘
           │ (Code pushed after testing)
           ▼
┌──────────────────────────────────────────────────┐
│ STAGING                                          │
│ - Full replica of production setup               │
│ - Staging API credentials from Foodpanda        │
│ - Test orders from Foodpanda                    │
│ - End-to-end testing                            │
│ - Performance monitoring                         │
└──────────────────────────────────────────────────┘
           │ (After successful testing)
           ▼
┌──────────────────────────────────────────────────┐
│ PRODUCTION                                       │
│ - Live orders from Foodpanda                    │
│ - Production API credentials                    │
│ - Real transactions in system                   │
│ - Continuous monitoring & logging               │
│ - Regular backups                               │
└──────────────────────────────────────────────────┘
```

---

## Monitoring & Alerts

```
PRODUCTION SYSTEM RUNNING
           │
           ├─ Every API Call
           │  └─ Logged to foodpanda_logs
           │
           ├─ Every Order
           │  └─ Logged to foodpanda_orders
           │
           ├─ Every Error
           │  └─ Logged to laravel.log
           │
           ▼
┌──────────────────────────────────────────┐
│ MONITORING                               │
│                                          │
│ Check Every Hour:                        │
│ - /foodpanda/logs (recent calls)         │
│ - /foodpanda/orders (pending status)     │
│ - laravel.log (errors)                   │
│                                          │
│ Check Daily:                             │
│ - Summary stats (/foodpanda/api/summary) │
│ - Failed orders                          │
│ - API performance metrics                │
│                                          │
│ Check Weekly:                            │
│ - Log archive and cleanup                │
│ - Database performance                   │
│ - Order sync success rate                │
└──────────────────────────────────────────┘
           │
           ▼
    ┌──────────────────┐
    │ Issue Detected?  │
    └──────────────────┘
       │              │
       YES            NO
       │              │
       ▼              ▼
    Contact      Continue
    Support      Monitoring
```

---

**This architecture ensures:**
- ✅ Secure API communication
- ✅ Reliable order synchronization
- ✅ Complete audit trail
- ✅ Error recovery and retry
- ✅ Production-grade monitoring
- ✅ Easy troubleshooting
