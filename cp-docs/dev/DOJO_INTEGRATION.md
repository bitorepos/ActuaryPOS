# Dojo Payment Gateway Integration

## Overview

This documentation covers the Dojo Payment Gateway integration in BitorePOS, with emphasis on API versioning and proper implementation patterns.

## Table of Contents

1. [Setup](#setup)
2. [API Versioning](#api-versioning)
3. [Configuration](#configuration)
4. [Usage Examples](#usage-examples)
5. [Version Management](#version-management)
6. [Best Practices](#best-practices)

## Setup

### 1. Environment Configuration

Add the following variables to your `.env` file:

```env
# Dojo Payment Gateway Configuration
DOJO_API_URL=https://api.dojo.tech
DOJO_API_KEY=sk_prod_your_key_here
DOJO_API_VERSION=2025-09-10
DOJO_ENVIRONMENT=sandbox
```

**Configuration Details:**
- `DOJO_API_URL`: Base URL for Dojo API (production endpoint)
- `DOJO_API_KEY`: Your Dojo API secret key (starts with `sk_prod_` or `sk_test_`)
- `DOJO_API_VERSION`: Current API version in YYYY-MM-DD format
- `DOJO_ENVIRONMENT`: Either `sandbox` (testing) or `production` (live)

### 2. Configuration File

The configuration is managed through `config/dojo.php`, which includes:
- API endpoints
- Versioning strategy
- Supported versions
- Changelog tracking
- Header defaults

## API Versioning

### Understanding Dojo's Versioning Scheme

Dojo uses a **strict date-based versioning** system:

```
Format: YYYY-MM-DD (e.g., 2025-09-10)
```

### Mandatory Version Header

Every API request MUST include the `version` header:

```php
'version: 2025-09-10'
```

### Breaking vs. Non-Breaking Changes

**Non-Breaking Changes** (automatically applied):
- Adding new optional headers
- Adding new HTTP methods to endpoints
- Introducing new optional request/response fields
- Expanding enum values with defaults

**Breaking Changes** (require explicit version upgrade):
- Modifying endpoint URL format
- Changing parameter from optional to required
- Deleting or renaming resource fields
- Altering authentication mechanisms
- Changing resource types or structures

## Configuration

### Location: `config/dojo.php`

Key configuration sections:

```php
// API URL and Authentication
'api_url' => env('DOJO_API_URL', 'https://api.dojo.tech'),
'api_key' => env('DOJO_API_KEY', ''),

// API Version (mandatory for all requests)
'version' => env('DOJO_API_VERSION', '2025-09-10'),

// Environment
'environment' => env('DOJO_ENVIRONMENT', 'sandbox'),

// API Endpoints
'endpoints' => [
    'payment_intents' => '/payment-intents',
    'payment_intents_detail' => '/payment-intents/{id}',
    'authorize' => '/payment-intents/{id}/authorize',
    'capture' => '/payment-intents/{id}/capture',
    'refund' => '/payment-intents/{id}/refund',
],

// Capture mode
'capture_mode' => 'Auto', // 'Auto' or 'Manual'
```

## Usage Examples

### 1. Create a Payment Intent (Auto-Capture)

```php
use App\Services\DojoPaymentService;

$dojo = new DojoPaymentService();

$payload = $dojo->buildPaymentIntentRequest(
    amount: 1000, // Amount in pence (£10.00)
    currencyCode: 'GBP',
    reference: 'Order_123456',
    description: 'General payment'
);

$response = $dojo->createPaymentIntent($payload);

// Response includes:
// - id: Payment intent ID
// - status: Current status
// - amount: Payment amount
// - reference: Your reference
```

### 2. Handle Manual Capture (Authorization)

```php
// Step 1: Create payment intent with Manual capture
$payload = $dojo->buildPaymentIntentRequest(
    amount: 2000,
    currencyCode: 'GBP',
    reference: 'Order_789012',
    description: 'Manual capture example',
    optionalParams: ['captureMode' => 'Manual']
);

$response = $dojo->createPaymentIntent($payload);
$intentId = $response['id'];

// Step 2: Later, capture the payment
$dojo->capturePayment($intentId);
```

### 3. Process a Refund

```php
$intentId = 'pi_abc123xyz';

// Full refund
$dojo->refundPayment($intentId);

// Partial refund
$dojo->refundPayment($intentId, ['amount' => 500]); // Refund £5.00
```

### 4. Retrieve Payment Intent Details

```php
$response = $dojo->getPaymentIntent('pi_abc123xyz');

// Contains current status, amount, reference, etc.
```

### 5. Using the Controller

```php
// Create payment intent via HTTP endpoint
POST /api/dojo/payment-intents
Content-Type: application/json

{
    "amount": 1000,
    "currency_code": "GBP",
    "reference": "Order_123456",
    "description": "Payment for order",
    "customer_email": "customer@example.com",
    "capture_mode": "Auto"
}

// Response:
{
    "success": true,
    "data": {
        "id": "pi_1234567890",
        "status": "Active",
        "amount": {...},
        "reference": "Order_123456"
    },
    "api_version": "2025-09-10"
}
```

## Version Management

### Current Version

The current supported API version is **2025-09-10**.

### Checking Version Support

```php
$dojo = new DojoPaymentService();

// Get current version
$version = $dojo->getApiVersion();

// Check if version is supported
if ($dojo->isVersionSupported('2025-09-10')) {
    // Version is supported
}

// Get all supported versions
$versions = $dojo->getSupportedVersions();

// Get changelog
$changelog = $dojo->getChangelog();
```

### Upgrading to a New Version

When Dojo releases a new API version:

1. **Test in sandbox first:**
   - Set `DOJO_ENVIRONMENT=sandbox`
   - Update `DOJO_API_VERSION` to new version
   - Run integration tests

2. **Update configuration:**
   ```php
   // config/dojo.php - update changelog
   'changelog' => [
       '2025-09-10' => [...],
       '2025-10-15' => [ // New version
           'description' => 'New features and breaking changes',
           'breaking' => true,
           'features' => [...],
       ],
   ],
   
   // Update supported versions
   'supported_versions' => [
       '2025-09-10',
       '2025-10-15', // Add new version
   ],
   ```

3. **Deploy to production:**
   - Update `DOJO_API_VERSION` in production `.env`
   - Monitor logs for any compatibility issues

## Best Practices

### 1. **Use Configuration Constants**

Always reference versions through configuration:

```php
// ✅ Good
$version = config('dojo.version');

// ❌ Avoid
$version = '2025-09-10'; // Hardcoded
```

### 2. **Handle Version Headers Explicitly**

The service automatically includes version headers in all requests. Verify this in logs:

```
[2024-01-20 10:30:45] local.INFO: Dojo API Request
{
    "method": "POST",
    "url": "https://api.dojo.tech/payment-intents",
    "version": "2025-09-10",
    "environment": "sandbox"
}
```

### 3. **Monitor API Changes**

- Subscribe to Dojo changelog for breaking changes
- Test new versions in sandbox before production deployment
- Keep `DOJO_API_VERSION` in your version control tracked

### 4. **Log All Requests**

Enable request logging to audit version usage:

```php
// config/dojo.php
'versioning' => [
    'log_versions' => true, // Logs all version headers
],
```

### 5. **Error Handling**

```php
use App\Services\DojoPaymentService;
use Exception;

try {
    $dojo = new DojoPaymentService();
    $response = $dojo->createPaymentIntent($payload);
} catch (Exception $e) {
    // Log includes API version for debugging
    Log::error('Payment failed: ' . $e->getMessage());
    
    // Check if it's a version-related error
    if (strpos($e->getMessage(), 'version') !== false) {
        // Handle version mismatch
    }
}
```

### 6. **Integration Testing**

```php
use Tests\TestCase;
use App\Services\DojoPaymentService;

class DojoPaymentTest extends TestCase
{
    public function testPaymentIntentCreation()
    {
        $dojo = new DojoPaymentService();
        
        // Verify version header is included
        $this->assertEquals('2025-09-10', $dojo->getApiVersion());
        
        // Test payment creation
        $response = $dojo->createPaymentIntent([
            'amount' => ['value' => 1000, 'currencyCode' => 'GBP'],
            'reference' => 'Test_123',
            'description' => 'Test payment',
        ]);
        
        $this->assertArrayHasKey('id', $response);
    }
}
```

## Troubleshooting

### Missing Version Header Error

**Error:** `"version header is required"`

**Solution:** Ensure `DOJO_API_KEY` is set in `.env` and the service is instantiated correctly.

### Version Not Supported Error

**Error:** `"API version 2025-09-10 is not supported"`

**Solution:**
1. Check if version is in `config/dojo.php` `supported_versions` array
2. Verify Dojo hasn't deprecated the version
3. Contact Dojo support if version is newer than supported list

### Authentication Errors

**Error:** `"Invalid API key"`

**Solution:**
1. Verify `DOJO_API_KEY` starts with `sk_prod_` or `sk_test_`
2. Check the key matches your environment (sandbox vs. production)
3. Regenerate key from Dojo dashboard if expired

## References

- [Dojo API Documentation](https://dojo.tech/docs)
- Configuration: [config/dojo.php](../../config/dojo.php)
- Service: [app/Services/DojoPaymentService.php](../../app/Services/DojoPaymentService.php)
- Controller: [app/Http/Controllers/DojoPaymentController.php](../../app/Http/Controllers/DojoPaymentController.php)
