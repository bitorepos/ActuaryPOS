# Foodpanda Integration - Complete Implementation Guide

**Date:** January 31, 2026  
**Version:** 1.0  
**Status:** Implementation Complete

## Table of Contents

1. [Overview](#overview)
2. [Architecture](#architecture)
3. [Installation & Setup](#installation--setup)
4. [Configuration](#configuration)
5. [Webhook Integration](#webhook-integration)
6. [Order Processing Flow](#order-processing-flow)
7. [API Client Usage](#api-client-usage)
8. [Database Schema](#database-schema)
9. [Error Handling & Logging](#error-handling--logging)
10. [Testing](#testing)
11. [Deployment](#deployment)

---

## Overview

The Foodpanda integration enables BitorePOS to:

- **Receive orders** from Foodpanda delivery platform automatically
- **Send order status updates** back to Foodpanda (accepted, prepared, completed, canceled)
- **Manage vendor availability** and menu items
- **Log all API interactions** for auditing and debugging
- **Handle authentication** securely using encrypted credentials
- **Implement retry logic** for failed operations

### Supported Flows

- **Direct Integration**: Orders go directly to the POS system for acceptance
- **Indirect Integration**: Orders are managed through Delivery Hero's vendor app first

---

## Architecture

### Module Structure

```
modules/Foodpanda/
├── Services/
│   ├── FoodpandaApiClient.php      (API communication)
│   ├── OrderSyncService.php        (Order processing)
│   └── StatusUpdateService.php     (Status management)
├── Models/
│   ├── FoodpandaOrder.php          (Order tracking)
│   └── FoodpandaLog.php            (API logging)
├── Http/
│   ├── Controllers/
│   │   ├── WebhookController.php   (Receive webhooks)
│   │   └── FoodpandaController.php (Management UI)
│   └── Requests/
│       ├── OrderDispatchRequest.php
│       └── OrderStatusUpdateRequest.php
├── Traits/
├── routes.php
└── Database Migrations/
```

### Key Components

#### 1. **FoodpandaApiClient** (`Services/FoodpandaApiClient.php`)
- Handles all API communication with Foodpanda
- Manages authentication and token refresh
- Logs all requests and responses
- Methods:
  - `authenticate()`: Get/refresh access token
  - `updateOrderStatus()`: Send order status updates
  - `markOrderPrepared()`: Mark order as prepared
  - `submitCatalog()`: Upload menu items
  - `updateItemAvailability()`: Update product availability
  - `updateVendorAvailability()`: Update store availability

#### 2. **OrderSyncService** (`Services/OrderSyncService.php`)
- Processes incoming orders from Foodpanda
- Validates and sanitizes order data
- Creates transactions in BitorePOS
- Maps Foodpanda order fields to internal models
- Implements retry logic for failed orders

#### 3. **StatusUpdateService** (`Services/StatusUpdateService.php`)
- Sends order status updates to Foodpanda API
- Handles order acceptance, rejection, and completion
- Manages vendor and item availability updates
- Synchronizes transaction status with Foodpanda

#### 4. **WebhookController** (`Http/Controllers/WebhookController.php`)
- Receives webhook events from Foodpanda
- Validates incoming payloads
- Sanitizes data before processing
- Routes to appropriate services

#### 5. **FoodpandaController** (`Http/Controllers/FoodpandaController.php`)
- Dashboard for managing Foodpanda orders
- Allows manual order acceptance/rejection
- Displays API logs
- Provides integration status

---

## Installation & Setup

### Step 1: Copy Module Files

The Foodpanda module is located in `modules/Foodpanda/`. All files have been created during implementation.

### Step 2: Run Database Migrations

Execute the database migrations to create required tables:

```bash
php artisan migrate
```

This creates:
- `foodpanda_orders` table
- `foodpanda_logs` table
- Adds columns to `business` table

### Step 3: Update Business Model

The `Business` model should include the following casts (already added):

```php
protected $casts = [
    'foodpanda_vendor_mappings' => 'json',
    'enable_foodpanda_integration' => 'boolean',
    'foodpanda_auto_accept_orders' => 'boolean',
];
```

### Step 4: Register Module Routes

Add to your route loading mechanism (in `routes/web.php` or your routing configuration):

```php
require_once base_path('modules/Foodpanda/routes.php');
```

### Step 5: Publish Language Files

Ensure language files are available:

```bash
php artisan vendor:publish --tag=translations
```

---

## Configuration

### Enable Integration in Business Settings

1. Navigate to: **Settings → Business → Foodpanda Integration**
2. **Enable Foodpanda Integration**: Check this box
3. Select **Environment**: 
   - `staging` for testing
   - `production` for live
4. Enter **API Credentials**:
   - API Username
   - API Password
5. Set **Plugin Base URL**: Your HTTPS webhook endpoint
6. Configure **Integration Details**:
   - Integration Code
   - Chain Code
   - Default Currency
7. Add **Vendor Mappings**: Map Foodpanda vendor codes to your remote IDs
8. **Test Connection**: Click "Test Connection" button to verify API access

### Configuration File Parameters

All configuration is stored in the `business` table:

| Column | Type | Description |
|--------|------|-------------|
| `enable_foodpanda_integration` | boolean | Enable/disable integration |
| `foodpanda_environment` | string | 'staging' or 'production' |
| `foodpanda_api_username` | string | API username |
| `foodpanda_api_password` | string | Encrypted API password |
| `foodpanda_api_token` | text | Current access token |
| `foodpanda_token_expires_at` | timestamp | Token expiration time |
| `foodpanda_integration_code` | string | Integration identifier |
| `foodpanda_chain_code` | string | Restaurant chain identifier |
| `foodpanda_plugin_base_url` | string | Webhook base URL |
| `foodpanda_vendor_mappings` | json | Vendor → Remote ID mappings |
| `foodpanda_auto_accept_orders` | boolean | Auto-accept orders |
| `foodpanda_order_sync_interval` | integer | Sync interval in minutes |
| `foodpanda_default_currency` | string | Default currency code |
| `foodpanda_last_sync` | timestamp | Last sync time |

---

## Webhook Integration

### Webhook URLs

Configure these URLs in your Foodpanda integration settings:

```
POST /foodpanda/webhook/order-dispatch
POST /foodpanda/webhook/order-status-update
POST /foodpanda/webhook/catalog-import-status
POST /foodpanda/webhook/menu-import-request
```

### Incoming Webhook Payloads

#### Order Dispatch Webhook

```json
POST /foodpanda/webhook/order-dispatch
{
  "order_token": "unique_order_token",
  "vendor_code": "vendor_123",
  "remote_id": "location_456",
  "order_id": "FP_12345",
  "customer_name": "John Doe",
  "customer_phone": "+1234567890",
  "customer_email": "john@example.com",
  "delivery_address": "123 Main St, City",
  "order_total": 50.00,
  "currency": "USD",
  "items": [
    {
      "id": "item_1",
      "name": "Burger",
      "quantity": 2,
      "unit_price": 20.00,
      "item_price": 40.00
    }
  ],
  "notes": "Extra sauce",
  "special_instructions": "Ring doorbell twice"
}
```

#### Order Status Update Webhook

```json
POST /foodpanda/webhook/order-status-update
{
  "order_token": "unique_order_token",
  "status": "order_accepted|order_rejected|order_canceled|order_completed|order_prepared",
  "reason": "out_of_stock|no_delivery_available|restaurant_busy|technical_error|other",
  "additional_info": {
    "timestamp": "2026-01-31T10:30:00Z",
    "details": "Extra information"
  }
}
```

#### Catalog Import Status Webhook

```json
POST /foodpanda/webhook/catalog-import-status
{
  "vendor_code": "vendor_123",
  "status": "success|failed",
  "message": "Catalog import completed successfully"
}
```

#### Menu Import Request Webhook

```json
POST /foodpanda/webhook/menu-import-request
{
  "vendor_code": "vendor_123",
  "timestamp": "2026-01-31T10:30:00Z"
}
```

### IP Whitelist Requirements

Whitelist these IPs in your firewall to receive webhooks from Foodpanda:

**Production:**
- Europe: 63.32.162.210, 34.255.237.245, 63.32.145.112
- Latin America: 54.161.200.26, 54.174.130.155, 18.204.190.239
- Middle East: 63.32.225.161, 18.202.96.85, 52.208.41.152
- Asia Pacific: 3.0.217.166, 3.1.134.42, 3.1.56.76

**Staging:**
- 34.246.34.27, 18.202.142.208, 54.72.10.41

---

## Order Processing Flow

### Direct Integration Flow

```
1. Customer orders on Foodpanda
   ↓
2. Foodpanda sends order via webhook (order-dispatch)
   ↓
3. WebhookController receives and validates order
   ↓
4. OrderSyncService processes order:
   - Creates FoodpandaOrder record
   - Gets/creates customer contact
   - Creates Transaction (if auto-accept enabled)
   - Creates TransactionSellLines for items
   ↓
5. If auto-accept disabled: Operator manually accepts/rejects
   ↓
6. StatusUpdateService sends status to Foodpanda API
   - order_accepted
   - order_prepared
   - order_completed
   ↓
7. Delivery partner picks up order
   ↓
8. Order marked as completed in both systems
```

### Order Status Lifecycle

```
pending → accepted → prepared → completed
                   ↓
               (if rejected)
                   ↓
                rejected
```

### Automatic Retry Logic

Failed orders trigger:
1. **Initial Sync**: When order received
2. **First Retry**: After 10 minutes (if failed)
3. **Subsequent Retries**: Every 10 minutes until 5 attempts
4. **Manual Intervention**: After 5 failed attempts, requires manual sync

---

## API Client Usage

### Using FoodpandaApiClient

```php
use App\Business;
use Modules\Foodpanda\Services\FoodpandaApiClient;

$business = Business::find($businessId);

// Initialize client
$apiClient = (new FoodpandaApiClient())
    ->initializeFromBusiness($business);

// Authenticate
$token = $apiClient->authenticate();

// Update order status
$response = $apiClient->updateOrderStatus(
    $orderToken,
    'order_accepted',
    ['prepared_at' => now()->addMinutes(30)->toIso8601String()]
);

// Mark prepared
$apiClient->markOrderPrepared($orderToken);

// Submit catalog
$catalogData = [
    'categories' => [...],
    'items' => [...],
];
$apiClient->submitCatalog($vendorCode, $catalogData);

// Update item availability
$items = [
    'item_1' => ['status' => 'available'],
    'item_2' => ['status' => 'unavailable'],
];
$apiClient->updateItemAvailability($vendorCode, $items);

// Update vendor availability
$apiClient->updateVendorAvailability($vendorCode, true);
```

### Using OrderSyncService

```php
use App\Business;
use Modules\Foodpanda\Services\OrderSyncService;

$business = Business::find($businessId);
$syncService = (new OrderSyncService())
    ->initializeWithBusiness($business);

// Process incoming order
$orderData = $request->validated();
$foodpandaOrder = $syncService->processIncomingOrder($orderData);

// Sync to transaction manually
$transaction = $syncService->syncOrderToTransaction($foodpandaOrder);

// Handle status update
$syncService->handleOrderStatusUpdate($orderToken, 'order_accepted');

// Retry failed order
$syncService->retrySyncFailedOrder($foodpandaOrder);

// Get retry-able failed orders
$failedOrders = $syncService->getFailedOrders();
```

### Using StatusUpdateService

```php
use App\Business;
use Modules\Foodpanda\Services\StatusUpdateService;

$business = Business::find($businessId);
$statusService = (new StatusUpdateService())
    ->initializeWithBusiness($business);

// Accept order
$statusService->acceptOrder($foodpandaOrder, $preparedAt);

// Reject order
$statusService->rejectOrder($foodpandaOrder, 'out_of_stock');

// Mark prepared
$statusService->markPrepared($foodpandaOrder);

// Mark completed
$statusService->markCompleted($foodpandaOrder);

// Cancel order
$statusService->cancelOrder($foodpandaOrder, 'restaurant_request');

// Update vendor availability
$statusService->updateVendorAvailability($vendorCode, true);

// Update item availability
$items = ['item_1' => ['status' => 'unavailable']];
$statusService->updateItemAvailability($vendorCode, $items);
```

---

## Database Schema

### foodpanda_orders Table

```sql
CREATE TABLE foodpanda_orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    business_id INT NOT NULL,
    vendor_code VARCHAR(255),
    remote_id VARCHAR(255),
    order_token VARCHAR(255) UNIQUE NOT NULL,
    order_id VARCHAR(255),
    order_data JSON,
    order_total DECIMAL(10,2) DEFAULT 0,
    currency VARCHAR(3),
    status VARCHAR(50) DEFAULT 'pending',
    status_reason TEXT,
    received_at TIMESTAMP,
    accepted_at TIMESTAMP,
    prepared_at TIMESTAMP,
    completed_at TIMESTAMP,
    canceled_at TIMESTAMP,
    transaction_id INT,
    sync_attempts INT DEFAULT 0,
    last_sync_attempt TIMESTAMP,
    sync_error TEXT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    deleted_at TIMESTAMP,
    
    FOREIGN KEY (business_id) REFERENCES business(id),
    FOREIGN KEY (transaction_id) REFERENCES transactions(id),
    INDEX (vendor_code),
    INDEX (order_token),
    INDEX (status),
    INDEX (created_at)
);
```

### foodpanda_logs Table

```sql
CREATE TABLE foodpanda_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    business_id INT NOT NULL,
    endpoint VARCHAR(255),
    method VARCHAR(10) DEFAULT 'GET',
    request_payload TEXT,
    response_payload TEXT,
    response_code INT,
    status VARCHAR(50) DEFAULT 'pending',
    error_message TEXT,
    retry_count INT DEFAULT 0,
    retry_reason TEXT,
    related_order_token VARCHAR(255),
    ip_address VARCHAR(45),
    response_time_ms INT,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    
    FOREIGN KEY (business_id) REFERENCES business(id),
    INDEX (business_id),
    INDEX (endpoint),
    INDEX (status),
    INDEX (created_at),
    INDEX (related_order_token)
);
```

### Business Table Additions

```sql
ALTER TABLE business ADD COLUMN (
    enable_foodpanda_integration BOOLEAN DEFAULT false,
    foodpanda_api_username VARCHAR(255),
    foodpanda_api_password VARCHAR(255),
    foodpanda_api_token TEXT,
    foodpanda_token_expires_at TIMESTAMP,
    foodpanda_integration_code VARCHAR(255),
    foodpanda_chain_code VARCHAR(255),
    foodpanda_environment VARCHAR(20) DEFAULT 'staging',
    foodpanda_plugin_base_url VARCHAR(255),
    foodpanda_vendor_mappings JSON,
    foodpanda_order_sync_interval INT DEFAULT 60,
    foodpanda_auto_accept_orders BOOLEAN DEFAULT false,
    foodpanda_default_currency VARCHAR(3),
    foodpanda_last_sync TIMESTAMP
);
```

---

## Error Handling & Logging

### Logging Strategy

All API calls are logged to `foodpanda_logs` table with:
- Request payload
- Response payload
- Status code
- Response time
- Error messages
- Related order token
- IP address
- Timestamp

### Error Handling

The system implements:
1. **Request Validation**: Validates incoming payloads against schema
2. **Data Sanitization**: Cleans all user input
3. **Try-Catch Blocks**: Comprehensive error handling
4. **Retry Logic**: Exponential backoff for failed operations
5. **Logging**: All errors logged for debugging
6. **Exceptions**: Clear exception messages for debugging

### Common Error Scenarios

| Error | Cause | Solution |
|-------|-------|----------|
| Authentication failed | Invalid credentials | Verify API username/password in settings |
| Token expired | Credentials invalid or permissions revoked | Refresh token manually by saving settings |
| Order not found | Invalid order token | Check webhook payload and order token |
| Duplicate order | Same order token sent twice | System prevents duplicate processing |
| Sync failed | Network/API issue | Auto-retry runs every 10 minutes |
| Invalid payload | Malformed JSON from webhook | Check request format matches schema |

### Accessing Logs

**UI Route**: `/foodpanda/logs`
- View all API interactions
- Filter by status, endpoint, date
- See request/response payloads

**Query Logs Programmatically**:

```php
use Modules\Foodpanda\Models\FoodpandaLog;

// Get recent failures
$failures = FoodpandaLog::where('business_id', $businessId)
    ->where('status', 'failed')
    ->recent(120)
    ->get();

// Get logs for specific order
$orderLogs = FoodpandaLog::where('related_order_token', $orderToken)
    ->latest()
    ->get();
```

---

## Testing

### Unit Tests

Test files should be created in `tests/Unit/Modules/Foodpanda/`:

```php
class FoodpandaApiClientTest extends TestCase
{
    public function testAuthentication()
    {
        // Test token retrieval
    }

    public function testUpdateOrderStatus()
    {
        // Test status update API call
    }

    public function testOrderSyncValidation()
    {
        // Test order payload validation
    }
}
```

### Feature Tests

```php
class FoodpandaWebhookTest extends TestCase
{
    public function testOrderDispatchWebhook()
    {
        // Test receiving order via webhook
        $response = $this->postJson('/foodpanda/webhook/order-dispatch', $payload);
        $this->assertDatabaseHas('foodpanda_orders', [...]);
    }

    public function testOrderStatusUpdateWebhook()
    {
        // Test receiving status update via webhook
    }
}
```

### Manual Testing Checklist

- [ ] Enable integration in Business Settings
- [ ] Configure API credentials
- [ ] Test connection button returns success
- [ ] Receive test order via webhook
- [ ] Order appears in Foodpanda Orders dashboard
- [ ] Accept order manually
- [ ] Verify API call logged in Logs
- [ ] Create order via auto-accept
- [ ] Check transaction created in POS
- [ ] Verify order status updates sent
- [ ] Test rejection with various reasons
- [ ] Test vendor availability update
- [ ] Test item availability update
- [ ] Verify all errors are logged

---

## Deployment

### Pre-Deployment Checklist

- [ ] All migrations run successfully
- [ ] Database tables created
- [ ] Routes registered
- [ ] Language files included
- [ ] Views accessible
- [ ] Module directories have proper permissions
- [ ] API credentials configured
- [ ] Webhook URL whitelisted at Foodpanda
- [ ] SSL certificate valid (webhook requires HTTPS)
- [ ] Firewall IP addresses whitelisted

### Production Deployment Steps

1. **Switch to Production Environment**
   - Update `foodpanda_environment` to 'production'
   - Use production API credentials

2. **Configure Webhook URL**
   - Set `foodpanda_plugin_base_url` to your production domain
   - Example: `https://yourpos.com/foodpanda/webhook/`

3. **Set Up Monitoring**
   - Monitor error logs: `storage/logs/laravel.log`
   - Check API logs: `/foodpanda/logs` dashboard
   - Set up alerts for failed orders

4. **Test with Pilot Vendor**
   - Foodpanda typically requires testing with one vendor first
   - Monitor order flow and API logs
   - Verify order status updates work correctly

5. **Enable Auto-Accept** (if desired)
   - After successful testing
   - Set `foodpanda_auto_accept_orders` to true
   - Orders will automatically create transactions

6. **Train Staff**
   - Show order dashboard
   - Demonstrate manual order management
   - Explain API logs and troubleshooting

### Rollback Plan

If issues occur:
1. Set `enable_foodpanda_integration` to false
2. Pending orders won't be received
3. Restore previous settings
4. Contact Foodpanda support for investigation

---

## References

- [Foodpanda Integration Documentation](https://integration.foodpanda.com/en/documentation/)
- [API Middleware Documentation](https://integration-middleware.stg.restaurant-partners.com/apidocs/pos-middleware-api)
- [Plugin API Documentation](https://integration-middleware.stg.restaurant-partners.com/apidocs/pos-plugin-api)

---

**End of Implementation Guide**
