# Xero Accounting Integration

## Overview

This documentation covers the complete Xero integration in {application_name}, including OAuth 2.0 authentication, API access, and bi-directional data synchronisation.

## Table of Contents

1. [Setup](#setup)
2. [OAuth 2.0 Authentication](#oauth-20-authentication)
3. [Configuration](#configuration)
4. [API Integration](#api-integration)
5. [Data Synchronisation](#data-synchronisation)
6. [Usage Examples](#usage-examples)
7. [Webhooks](#webhooks)
8. [Best Practices](#best-practices)

## Setup

### 1. Register Application on Xero Developer Portal

1. Visit [Xero Developer Portal](https://developer.xero.com/)
2. Create an application with the following details:
   - **App Name**: {application_name}
   - **Company Name**: Your Business
   - **Application Type**: Web / Mobile / Desktop
   - **Redirect URL**: `http://localhost/BitorePOS502/public/api/xero/callback`

3. Copy the generated credentials:
   - **Client ID**
   - **Client Secret**

### 2. Environment Configuration

Add the following to your `.env` file:

```env
# Xero OAuth Configuration
XERO_CLIENT_ID=your_client_id_here
XERO_CLIENT_SECRET=your_client_secret_here
XERO_REDIRECT_URI=http://localhost/BitorePOS502/public/api/xero/callback
XERO_API_URL=https://api.xero.com/api.xro/2.0
XERO_TENANT_ID=your_tenant_id_here
XERO_ENVIRONMENT=sandbox
XERO_WEBHOOK_KEY=your_webhook_key_here
```

**Configuration Details:**
- `XERO_CLIENT_ID`: OAuth 2.0 Client ID from Xero Developer
- `XERO_CLIENT_SECRET`: OAuth 2.0 Client Secret (keep secure!)
- `XERO_REDIRECT_URI`: Callback URL after user authorisation
- `XERO_TENANT_ID`: Xero organisation ID (obtained during OAuth flow)
- `XERO_ENVIRONMENT`: `sandbox` for testing, `production` for live
- `XERO_WEBHOOK_KEY`: Key for verifying incoming webhooks

### 3. Database Migration

Create a migration for storing OAuth tokens:

```bash
php artisan make:migration create_xero_tokens_table
```

Add the following to the migration:

```php
Schema::create('xero_tokens', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->longText('access_token');
    $table->longText('refresh_token');
    $table->timestamp('expires_at');
    $table->string('tenant_id')->nullable();
    $table->string('token_type')->default('Bearer');
    $table->timestamps();
    
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

php artisan migrate
```

## OAuth 2.0 Authentication

### Understanding OAuth 2.0 Flow

Xero uses the **Authorization Code Grant** flow for user authorisation:

```
1. User clicks "Connect to Xero"
   ↓
2. Redirect to Xero login
   ↓
3. User grants permissions
   ↓
4. Xero redirects to callback URL with authorization code
   ↓
5. Exchange code for access and refresh tokens
   ↓
6. Store tokens securely
   ↓
7. Use access token for API requests
```

### Authentication Flow in Action

```php
use App\Services\XeroAuthService;

// Step 1: Initiate authorization
$authService = new XeroAuthService(auth()->id());
$authUrl = $authService->getAuthorizationUrl();

// Redirect user to $authUrl
redirect($authUrl);

// Step 2: Handle callback
$authService->exchangeCodeForToken($code, $state);

// Step 3: Use service for API requests
$accessToken = $authService->getAccessToken(); // Auto-refreshes if expired
```

## Configuration

### Location: `config/xero.php`

Key configuration sections:

```php
// OAuth Configuration
'oauth' => [
    'client_id' => env('XERO_CLIENT_ID', ''),
    'client_secret' => env('XERO_CLIENT_SECRET', ''),
    'redirect_uri' => env('XERO_REDIRECT_URI', ''),
    'scope' => 'offline_access openid profile email accounting.transactions accounting.contacts',
],

// API Configuration
'api' => [
    'base_url' => env('XERO_API_URL', 'https://api.xero.com/api.xro/2.0'),
    'version' => '2.0',
    'timeout' => 30,
],

// Rate Limits
'rate_limits' => [
    'requests_per_minute' => 60,
    'retry_attempts' => 3,
    'retry_backoff_ms' => 1000,
],

// Data Sync Configuration
'sync' => [
    'enabled' => true,
    'interval' => 15, // Minutes
    'entities' => [
        'contacts' => ['enabled' => true, 'direction' => 'bi-directional'],
        'invoices' => ['enabled' => true, 'direction' => 'bi-directional'],
        'payments' => ['enabled' => true, 'direction' => 'inbound'],
    ],
],
```

## API Integration

### XeroAuthService

Handles OAuth 2.0 authentication and token management.

```php
use App\Services\XeroAuthService;

$authService = new XeroAuthService($userId);

// Get authorization URL
$authUrl = $authService->getAuthorizationUrl($state);

// Exchange code for tokens
$tokens = $authService->exchangeCodeForToken($code, $state);

// Get valid access token (auto-refreshes if expired)
$accessToken = $authService->getAccessToken();

// Get tenant ID
$tenantId = $authService->getTenantId();

// Check connection status
if ($authService->isConnected()) {
    // User is connected to Xero
}

// Disconnect
$authService->disconnect();
```

### XeroSyncService

Handles data synchronisation with Xero.

```php
use App\Services\XeroSyncService;

$syncService = new XeroSyncService($authService, $userId);

// Fetch contacts from Xero
$contacts = $syncService->getContacts();

// Create a contact
$contact = $syncService->createContact([
    'name' => 'ABC Corp',
    'email' => 'contact@abccorp.com',
    'contact_number' => 'CO123',
]);

// Fetch invoices
$invoices = $syncService->getInvoices();

// Create an invoice
$invoice = $syncService->createInvoice([
    'contact_name' => 'ABC Corp',
    'invoice_number' => 'INV-001',
    'line_items' => [
        [
            'description' => 'Product A',
            'quantity' => 2,
            'unit_amount' => 100,
            'account_code' => '200',
        ]
    ],
]);

// Fetch payments
$payments = $syncService->getPayments();

// Get financial reports
$balanceSheet = $syncService->getReport('BalanceSheet');
$profitAndLoss = $syncService->getReport('ProfitAndLoss');
```

## Data Synchronisation

### Inbound Sync (Xero → Your App)

Pull updated data from Xero and store in local database:

```php
use Carbon\Carbon;

$syncService = new XeroSyncService($authService, $userId);

// Sync all contacts
$syncService->syncContactsFromXero();

// Sync contacts modified after specific date
$modifiedAfter = Carbon::now()->subHours(24);
$result = $syncService->syncContactsFromXero($modifiedAfter);

// Returns
[
    'synced' => 45,
    'failed' => 2,
]
```

### Outbound Sync (Your App → Xero)

Send data from your system to Xero:

```php
// Create a new contact in Xero
$syncService->createContact([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'contact_number' => 'CUST001',
]);

// Create an invoice in Xero
$syncService->createInvoice([
    'contact_name' => 'John Doe',
    'invoice_number' => 'INV-2024-001',
    'date' => '2024-01-20',
    'due_date' => '2024-02-20',
    'line_items' => [
        [
            'description' => 'Consulting Services',
            'quantity' => 1,
            'unit_amount' => 500,
            'account_code' => '200', // Xero account code
            'tax_type' => 'Tax on Sales',
        ]
    ],
]);
```

### Bi-Directional Sync

Configure entities to sync in both directions:

```php
// config/xero.php
'sync' => [
    'entities' => [
        'contacts' => [
            'enabled' => true,
            'direction' => 'bi-directional', // Syncs both ways
        ],
        'invoices' => [
            'enabled' => true,
            'direction' => 'bi-directional',
        ],
    ],
],
```

## Usage Examples

### Example 1: Connect User to Xero

```php
// routes/api.php
Route::post('/xero/authorize', [XeroIntegrationController::class, 'authorize']);
Route::get('/xero/callback', [XeroIntegrationController::class, 'callback']);

// Controller handles OAuth flow automatically
```

### Example 2: Fetch and Display Contacts

```php
$syncService = new XeroSyncService($authService, auth()->id());
$contacts = $syncService->getContacts();

// Response format
[
    'Contacts' => [
        [
            'ContactID' => 'uuid-123',
            'Name' => 'ABC Corporation',
            'EmailAddress' => 'contact@abc.com',
            'ContactStatus' => 'ACTIVE',
        ]
    ]
]
```

### Example 3: Create and Sync Invoice

```php
// Create locally
$invoice = Invoice::create([
    'customer_id' => 1,
    'reference' => 'INV-001',
    'total' => 1000,
]);

// Push to Xero
$xeroInvoice = $syncService->createInvoice([
    'contact_name' => $invoice->customer->name,
    'invoice_number' => $invoice->reference,
    'line_items' => $invoice->items->map(fn($item) => [
        'description' => $item->description,
        'quantity' => $item->quantity,
        'unit_amount' => $item->price,
        'account_code' => $item->xero_account_code,
    ])->toArray(),
]);

// Store Xero ID for future reference
$invoice->update(['xero_id' => $xeroInvoice['InvoiceID']]);
```

### Example 4: Schedule Periodic Sync

```php
// app/Console/Kernel.php
protected function schedule(Schedule $schedule)
{
    $schedule->call(function () {
        $users = User::whereHas('xeroTokens')->get();
        
        foreach ($users as $user) {
            $authService = new XeroAuthService($user->id);
            $syncService = new XeroSyncService($authService, $user->id);
            
            $syncService->syncContactsFromXero();
            $syncService->syncInvoicesFromXero();
        }
    })->everyFifteenMinutes();
}
```

## Webhooks

### Setup Webhook in Xero Developer Portal

1. Go to your Xero application settings
2. Configure webhook URL: `http://localhost/BitorePOS502/public/api/xero/webhook`
3. Copy the **Webhook Signing Key**
4. Set in environment: `XERO_WEBHOOK_KEY=your_key`

### Subscribe to Events

Configure which events you want to receive:

```php
// config/xero.php
'webhooks' => [
    'enabled' => true,
    'events' => [
        'INVOICES.CREATE',
        'INVOICES.UPDATE',
        'CONTACTS.CREATE',
        'CONTACTS.UPDATE',
        'PAYMENTS.CREATE',
    ],
],
```

### Handle Webhook Events

```php
// routes/api.php
Route::post('/xero/webhook', [XeroIntegrationController::class, 'webhook']);

// Events are automatically verified and processed
```

## Best Practices

### 1. **Secure Token Storage**

✔ Always encrypt tokens at rest
✔ Use database encryption with `config('xero.token_storage.encryption' => true)`
✔ Never commit credentials to version control

```php
// config/xero.php
'token_storage' => [
    'driver' => 'database',
    'encryption' => true,
],
```

### 2. **Handle Rate Limits**

✔ Implement backoff/retry strategy
✔ Monitor API rate: 60 requests/minute
✔ Use queued jobs for bulk operations

```php
// Automatic retry with exponential backoff
$syncService->createInvoice($data); // Retries up to 3 times
```

### 3. **Map Data Correctly**

✔ Define clear mapping between your data and Xero
✔ Test with sandbox before production
✔ Handle currency and tax calculations

```php
// Define mapping
'mapping' => [
    'contact_types' => ['customer' => 'CONTACT'],
    'invoice_types' => ['sales_invoice' => 'ACCREC'],
    'tax_treatment' => ['tax_on_sales' => 'Tax on Sales'],
],
```

### 4. **Log All Operations**

✔ Enable detailed logging
✔ Track sync success/failures
✔ Audit trail for compliance

```php
// config/xero.php
'logging' => [
    'enabled' => true,
    'log_requests' => true,
    'mask_sensitive_data' => true,
],
```

### 5. **Test with Sandbox First**

```env
XERO_ENVIRONMENT=sandbox  # Test environment
XERO_CLIENT_ID=sandbox_client_id
```

### 6. **Handle Partial Sync Failures**

```php
$result = $syncService->syncContactsFromXero();

if ($result['failed'] > 0) {
    // Log failed contacts and retry later
    Log::warning("Failed to sync {$result['failed']} contacts");
}
```

## Troubleshooting

### "Invalid state parameter"

**Issue:** CSRF validation failed

**Solution:** Ensure `session()` is working correctly and state matches

### "Max retries exceeded"

**Issue:** API request failed after retries

**Solution:**
- Check API rate limits: 60 requests/minute
- Verify credentials and permissions
- Check Xero system status

### "Tenant ID not found"

**Issue:** Can't identify which Xero organisation to access

**Solution:**
- Complete OAuth flow to get tenant ID
- Verify `XERO_TENANT_ID` is set in `.env`

### "Token expired or invalid"

**Issue:** Access token is no longer valid

**Solution:**
- Tokens auto-refresh automatically
- If fails, user must re-authorize
- Check database for stored tokens

## References

- [Xero Developer Documentation](https://developer.xero.com/)
- [Xero OAuth 2.0 Flow](https://developer.xero.com/documentation/oauth2/)
- [Xero API Resources](https://developer.xero.com/documentation/api/accounting/overview/)
- Configuration: [config/xero.php](../../config/xero.php)
- Auth Service: [app/Services/XeroAuthService.php](../../app/Services/XeroAuthService.php)
- Sync Service: [app/Services/XeroSyncService.php](../../app/Services/XeroSyncService.php)
- Controller: [app/Http/Controllers/XeroIntegrationController.php](../../app/Http/Controllers/XeroIntegrationController.php)
