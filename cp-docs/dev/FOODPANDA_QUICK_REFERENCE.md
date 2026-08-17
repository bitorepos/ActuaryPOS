# Foodpanda Integration - Quick Reference Guide

**Version:** 1.0 | **Last Updated:** January 31, 2026

## Quick Start (5 Minutes)

### 1. Enable Integration
- Go to **Settings → Business → Foodpanda Integration**
- Check **Enable Foodpanda Integration**

### 2. Configure Credentials
- **Environment**: Choose staging (test) or production
- **API Username**: Your Foodpanda username
- **API Password**: Your Foodpanda password
- **Plugin Base URL**: Your HTTPS webhook endpoint

### 3. Setup Integration
- **Integration Code**: Unique identifier (e.g., myrestaurant-sg)
- **Chain Code**: Your restaurant chain code
- **Default Currency**: Select your POS currency

### 4. Add Vendor Mappings
- **Vendor Code**: Foodpanda vendor code
- **Remote ID**: Your location ID in the POS

### 5. Test Connection
- Click **Test Connection** button
- Should show "Connection successful"

### 6. Configure Webhooks in Foodpanda
- Set webhook URL: `https://yourpos.com/foodpanda/webhook/order-dispatch`
- Whitelist your IP in Foodpanda firewall settings

---

## Dashboard Routes

| Page | URL | Purpose |
|------|-----|---------|
| Orders | `/foodpanda/orders` | View all incoming orders |
| Order Details | `/foodpanda/orders/{id}` | View order details and items |
| API Logs | `/foodpanda/logs` | View all API calls and responses |
| Log Details | `/foodpanda/logs/{id}` | View detailed log information |

---

## Common Tasks

### Receive an Order

**Automatic** (if auto-accept enabled):
1. Order received via webhook
2. Transaction created automatically
3. Order appears in Orders dashboard

**Manual** (if auto-accept disabled):
1. Order received as "pending"
2. Staff reviews order in dashboard
3. Click "Accept" or "Reject"
4. Status sent to Foodpanda

### Update Order Status

| Status | Action | When |
|--------|--------|------|
| **Accepted** | Click Accept | Staff accepts the order |
| **Prepared** | Click Mark as Prepared | Food is ready for pickup |
| **Completed** | Auto | When delivery partner collects order |
| **Rejected** | Click Reject | Out of stock or unable to fulfill |

### Manage Availability

```php
// Via API
$statusService->updateVendorAvailability($vendorCode, false);

// Via Business Settings
// Check "Closed" status in store settings
```

### Update Menu Availability

```php
// Mark items as unavailable
$items = [
    'item_1' => ['status' => 'unavailable'],
    'item_2' => ['status' => 'unavailable'],
];

$statusService->updateItemAvailability($vendorCode, $items);
```

---

## API Endpoints (For Developers)

### Webhooks Received (Foodpanda → Your System)

```
POST /foodpanda/webhook/order-dispatch
POST /foodpanda/webhook/order-status-update
POST /foodpanda/webhook/catalog-import-status
POST /foodpanda/webhook/menu-import-request
```

### Management API (Your System → Foodpanda)

```
GET  /foodpanda/api/test-connection       - Test API connectivity
GET  /foodpanda/api/summary                - Get order statistics
POST /foodpanda/orders/{id}/accept         - Accept order
POST /foodpanda/orders/{id}/reject         - Reject order
POST /foodpanda/orders/{id}/prepared       - Mark prepared
```

---

## Code Examples

### Accept Order via API

```php
use Modules\Foodpanda\Services\StatusUpdateService;
use App\Business;

$business = Business::find($businessId);
$statusService = (new StatusUpdateService())
    ->initializeWithBusiness($business);

// Accept order with 30-minute preparation time
$statusService->acceptOrder($foodpandaOrder, now()->addMinutes(30)->toIso8601String());
```

### Reject Order with Reason

```php
$statusService->rejectOrder($foodpandaOrder, 'out_of_stock');
```

### Get Failed Orders for Retry

```php
use Modules\Foodpanda\Services\OrderSyncService;

$syncService = (new OrderSyncService())->initializeWithBusiness($business);
$failedOrders = $syncService->getFailedOrders();

foreach ($failedOrders as $order) {
    $syncService->retrySyncFailedOrder($order);
}
```

### Submit Menu Items to Foodpanda

```php
$catalogData = [
    'categories' => [
        [
            'id' => 'cat_1',
            'name' => 'Burgers',
            'description' => 'Fresh burgers',
            'items' => [
                [
                    'id' => 'item_1',
                    'name' => 'Cheeseburger',
                    'price' => 8.99,
                    'description' => 'With cheese',
                    'image_url' => 'https://...',
                ]
            ]
        ]
    ]
];

$apiClient->submitCatalog($vendorCode, $catalogData);
```

---

## Order Object Reference

### FoodpandaOrder Model

```php
$order = FoodpandaOrder::find($orderId);

// Attributes
$order->business_id              // Business ID
$order->vendor_code              // Foodpanda vendor code
$order->remote_id                // Local location ID
$order->order_token              // Unique order identifier
$order->order_data               // Full order JSON
$order->order_total              // Order amount
$order->currency                 // Order currency
$order->status                   // pending|accepted|prepared|completed|canceled
$order->status_reason            // Reason for rejection/cancellation
$order->transaction_id           // Linked POS transaction ID

// Timestamps
$order->received_at              // When order received
$order->accepted_at              // When order accepted
$order->prepared_at              // When marked prepared
$order->completed_at             // When completed
$order->canceled_at              // When canceled

// Sync Status
$order->sync_attempts            // Number of sync attempts
$order->last_sync_attempt        // Last attempt time
$order->sync_error               // Error message if any

// Relationships
$order->business()               // Business instance
$order->transaction()            // Linked Transaction

// Helper Methods
$order->getCustomerDetails()     // Extract customer info
$order->getOrderItems()          // Extract order items
$order->markAccepted()           // Mark as accepted
$order->markRejected($reason)    // Mark as rejected
$order->markPrepared()           // Mark as prepared
$order->markCompleted()          // Mark as completed
$order->markCanceled($reason)    // Mark as canceled
$order->recordSyncError($error)  // Record error
$order->clearSyncError()         // Clear error
```

### Query Orders

```php
// All pending orders
$pending = FoodpandaOrder::where('business_id', $businessId)
    ->pending()
    ->get();

// Accepted orders
$accepted = FoodpandaOrder::where('business_id', $businessId)
    ->accepted()
    ->get();

// Failed orders
$failed = FoodpandaOrder::where('business_id', $businessId)
    ->failed()
    ->get();

// Orders for specific vendor
$vendorOrders = FoodpandaOrder::where('vendor_code', 'vendor_123')
    ->latest()
    ->get();

// Recent orders (last 24 hours)
$recent = FoodpandaOrder::where('business_id', $businessId)
    ->where('created_at', '>', now()->subDay())
    ->get();
```

---

## Troubleshooting

### No Orders Received

**Check:**
1. ✅ Integration is enabled in Business Settings
2. ✅ API credentials are correct (test connection)
3. ✅ Webhook URL is correct and HTTPS
4. ✅ Firewall allows Foodpanda IPs
5. ✅ Vendor code matches configuration

**Debug:**
```php
// Check if integration is enabled
$business = Business::find($businessId);
if (!$business->enable_foodpanda_integration) {
    echo "Integration is disabled";
}

// Check recent logs
$logs = FoodpandaLog::where('business_id', $businessId)
    ->latest()
    ->limit(10)
    ->get();
    
foreach ($logs as $log) {
    echo $log->endpoint . " - " . $log->status . "\n";
    if ($log->error_message) {
        echo "Error: " . $log->error_message . "\n";
    }
}
```

### Orders Fail to Sync

**Check:**
1. ✅ Look in `/foodpanda/logs` dashboard
2. ✅ Check error message in order details
3. ✅ Verify customer/product data

**Retry:**
```php
$syncService = (new OrderSyncService())
    ->initializeWithBusiness($business);

$failedOrders = $syncService->getFailedOrders();
foreach ($failedOrders as $order) {
    try {
        $syncService->retrySyncFailedOrder($order);
        echo "Order {$order->order_token} synced successfully\n";
    } catch (\Exception $e) {
        echo "Failed: " . $e->getMessage() . "\n";
    }
}
```

### API Token Expired

**Solution:**
1. Go to **Settings → Business → Foodpanda Integration**
2. Click **Test Connection**
3. Token automatically refreshes
4. Save settings

### Webhook Not Received

**Verify:**
1. Webhook URL in Foodpanda admin settings
2. HTTPS certificate is valid
3. Server logs show incoming request: `tail -f storage/logs/laravel.log`
4. Check application logs for errors

---

## Database Queries

### View Recent Orders

```sql
SELECT * FROM foodpanda_orders 
WHERE business_id = 1 
ORDER BY created_at DESC 
LIMIT 20;
```

### Find Failed Orders

```sql
SELECT * FROM foodpanda_orders 
WHERE business_id = 1 
AND sync_error IS NOT NULL 
ORDER BY created_at DESC;
```

### Order Statistics

```sql
SELECT 
    status,
    COUNT(*) as count
FROM foodpanda_orders
WHERE business_id = 1
GROUP BY status;
```

### API Call Statistics

```sql
SELECT 
    endpoint,
    status,
    COUNT(*) as count,
    AVG(response_time_ms) as avg_time
FROM foodpanda_logs
WHERE business_id = 1
AND created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)
GROUP BY endpoint, status;
```

---

## Important URLs

| Env | API Base URL |
|-----|--------------|
| Staging | `https://integration-middleware.stg.restaurant-partners.com/api/v2` |
| Production | `https://integration-middleware.restaurant-partners.com/api/v2` |

---

## Support

For issues or questions:
1. Check `/foodpanda/logs` dashboard for error details
2. Review `FOODPANDA_IMPLEMENTATION.md` for detailed documentation
3. Contact Foodpanda: [integration.foodpanda.com](https://integration.foodpanda.com)

---

**For complete documentation, see [FOODPANDA_IMPLEMENTATION.md](FOODPANDA_IMPLEMENTATION.md)**
