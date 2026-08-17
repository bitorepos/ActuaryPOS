<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\XeroAuthService;
use App\Services\XeroSyncService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Exception;

/**
 * Xero Integration Tests
 * 
 * Test Xero OAuth flow and API integration
 * 
 * @package Tests\Feature
 */
class XeroIntegrationTest extends TestCase
{
    /**
     * Test OAuth authorization URL generation
     * 
     * @return void
     */
    public function testGenerateAuthorizationUrl()
    {
        $authService = new XeroAuthService(1);
        $authUrl = $authService->getAuthorizationUrl();
        
        // Verify URL contains required parameters
        $this->assertStringContainsString('response_type=code', $authUrl);
        $this->assertStringContainsString('client_id=', $authUrl);
        $this->assertStringContainsString('redirect_uri=', $authUrl);
        $this->assertStringContainsString('scope=', $authUrl);
        $this->assertStringContainsString('login.xero.com', $authUrl);
    }

    /**
     * Test code exchange for tokens
     * 
     * @return void
     */
    public function testExchangeCodeForToken()
    {
        Http::fake([
            'identity.xero.com/connect/token' => Http::response([
                'access_token' => 'test_access_token_123',
                'refresh_token' => 'test_refresh_token_456',
                'expires_in' => 3600,
                'token_type' => 'Bearer',
                'tenant_id' => 'tenant_uuid_123',
            ]),
        ]);
        
        $authService = new XeroAuthService(1);
        session(['xero_oauth_state' => 'test_state']);
        
        $tokens = $authService->exchangeCodeForToken('auth_code_123', 'test_state');
        
        // Verify token response
        $this->assertArrayHasKey('access_token', $tokens);
        $this->assertArrayHasKey('refresh_token', $tokens);
        $this->assertEquals('test_access_token_123', $tokens['access_token']);
    }

    /**
     * Test invalid state parameter (CSRF protection)
     * 
     * @return void
     */
    public function testInvalidStateParameter()
    {
        $authService = new XeroAuthService(1);
        session(['xero_oauth_state' => 'valid_state']);
        
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Invalid state parameter');
        
        $authService->exchangeCodeForToken('code', 'invalid_state');
    }

    /**
     * Test connection status
     * 
     * @return void
     */
    public function testConnectionStatus()
    {
        $authService = new XeroAuthService(1);
        
        // Before connection
        $this->assertFalse($authService->isConnected());
        
        // After simulating connection
        DB::table('xero_tokens')->updateOrCreate(
            ['user_id' => 1],
            [
                'access_token' => 'token',
                'refresh_token' => 'refresh',
                'expires_at' => now()->addHours(1),
                'tenant_id' => 'tenant_123',
            ]
        );
        
        $authService = new XeroAuthService(1);
        $this->assertTrue($authService->isConnected());
    }

    /**
     * Test get contacts from Xero
     * 
     * @return void
     */
    public function testGetContacts()
    {
        Http::fake([
            'api.xero.com/*' => Http::response([
                'Contacts' => [
                    [
                        'ContactID' => 'contact_1',
                        'Name' => 'ABC Corporation',
                        'EmailAddress' => 'contact@abc.com',
                        'ContactStatus' => 'ACTIVE',
                    ],
                ],
            ]),
        ]);
        
        // Setup token
        DB::table('xero_tokens')->updateOrCreate(
            ['user_id' => 1],
            [
                'access_token' => 'token',
                'refresh_token' => 'refresh',
                'expires_at' => now()->addHours(1),
                'tenant_id' => 'tenant_123',
            ]
        );
        
        $authService = new XeroAuthService(1);
        $syncService = new XeroSyncService($authService, 1);
        
        $contacts = $syncService->getContacts();
        
        // Verify response
        $this->assertArrayHasKey('Contacts', $contacts);
        $this->assertCount(1, $contacts['Contacts']);
        $this->assertEquals('ABC Corporation', $contacts['Contacts'][0]['Name']);
    }

    /**
     * Test create contact in Xero
     * 
     * @return void
     */
    public function testCreateContact()
    {
        Http::fake([
            'api.xero.com/*' => Http::response([
                'Contacts' => [
                    [
                        'ContactID' => 'new_contact_id',
                        'Name' => 'New Company',
                        'EmailAddress' => 'new@company.com',
                    ],
                ],
            ]),
        ]);
        
        DB::table('xero_tokens')->updateOrCreate(
            ['user_id' => 1],
            [
                'access_token' => 'token',
                'refresh_token' => 'refresh',
                'expires_at' => now()->addHours(1),
                'tenant_id' => 'tenant_123',
            ]
        );
        
        $authService = new XeroAuthService(1);
        $syncService = new XeroSyncService($authService, 1);
        
        $contact = $syncService->createContact([
            'name' => 'New Company',
            'email' => 'new@company.com',
        ]);
        
        // Verify response
        $this->assertArrayHasKey('Contacts', $contact);
        $this->assertEquals('New Company', $contact['Contacts'][0]['Name']);
    }

    /**
     * Test build invoice payload
     * 
     * @return void
     */
    public function testBuildInvoicePayload()
    {
        DB::table('xero_tokens')->updateOrCreate(
            ['user_id' => 1],
            [
                'access_token' => 'token',
                'refresh_token' => 'refresh',
                'expires_at' => now()->addHours(1),
                'tenant_id' => 'tenant_123',
            ]
        );
        
        $authService = new XeroAuthService(1);
        $syncService = new XeroSyncService($authService, 1);
        
        $invoiceData = [
            'contact_name' => 'ABC Corp',
            'invoice_number' => 'INV-001',
            'date' => '2024-01-20',
            'line_items' => [
                [
                    'description' => 'Consulting',
                    'quantity' => 1,
                    'unit_amount' => 500,
                    'account_code' => '200',
                ]
            ],
        ];
        
        // Test that invoice can be built (via reflection to access private method)
        $reflection = new \ReflectionClass($syncService);
        $method = $reflection->getMethod('buildInvoicePayload');
        $method->setAccessible(true);
        
        $payload = $method->invoke($syncService, $invoiceData);
        
        // Verify payload structure
        $this->assertArrayHasKey('Type', $payload);
        $this->assertArrayHasKey('Contact', $payload);
        $this->assertArrayHasKey('LineItems', $payload);
        $this->assertEquals('INV-001', $payload['InvoiceNumber']);
    }

    /**
     * Test rate limit retry logic
     * 
     * @return void
     */
    public function testRateLimitRetry()
    {
        // Simulate rate limit then success
        $attempts = 0;
        Http::fake(function ($request) use (&$attempts) {
            $attempts++;
            
            if ($attempts <= 2) {
                return Http::response(['error' => 'Rate limited'], 429);
            }
            
            return Http::response([
                'Contacts' => [
                    ['ContactID' => 'id', 'Name' => 'Test'],
                ],
            ]);
        });
        
        DB::table('xero_tokens')->updateOrCreate(
            ['user_id' => 1],
            [
                'access_token' => 'token',
                'refresh_token' => 'refresh',
                'expires_at' => now()->addHours(1),
                'tenant_id' => 'tenant_123',
            ]
        );
        
        $authService = new XeroAuthService(1);
        $syncService = new XeroSyncService($authService, 1);
        
        $contacts = $syncService->getContacts();
        
        // Should succeed after retries
        $this->assertArrayHasKey('Contacts', $contacts);
        $this->assertGreaterThan(2, $attempts); // At least 3 attempts
    }

    /**
     * Test controller authorize endpoint
     * 
     * @return void
     */
    public function testAuthorizeEndpoint()
    {
        $response = $this->actingAs($this->createUser())
            ->get('/api/xero/authorize');
        
        $response->assertRedirect();
        $this->assertStringContainsString('login.xero.com', $response->headers->get('Location'));
    }

    /**
     * Test webhook signature verification
     * 
     * @return void
     */
    public function testWebhookSignatureVerification()
    {
        $payload = json_encode(['events' => []]);
        $key = config('xero.webhooks.signature_key');
        $signature = base64_encode(hash_hmac('sha256', $payload, $key, true));
        
        $response = $this->postJson('/api/xero/webhook', ['events' => []], [
            'X-Xero-Signature' => $signature,
        ]);
        
        // Should accept valid signature
        $response->assertStatus(200);
    }

    /**
     * Helper to create test user
     * 
     * @return \App\Models\User
     */
    private function createUser()
    {
        return \App\Models\User::factory()->create();
    }
}
