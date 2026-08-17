<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\DojoPaymentService;
use Illuminate\Support\Facades\Http;
use Exception;

/**
 * Dojo Payment Service Tests
 * 
 * Test the Dojo Payment Service integration with proper API versioning
 * 
 * @package Tests\Feature
 */
class DojoPaymentServiceTest extends TestCase
{
    /**
     * Test service initialization
     * 
     * @return void
     */
    public function testServiceInitialization()
    {
        $service = new DojoPaymentService();
        
        // Verify API version is set
        $this->assertEquals('2025-09-10', $service->getApiVersion());
        
        // Verify version is supported
        $this->assertTrue($service->isVersionSupported('2025-09-10'));
    }

    /**
     * Test supported versions configuration
     * 
     * @return void
     */
    public function testSupportedVersions()
    {
        $service = new DojoPaymentService();
        $versions = $service->getSupportedVersions();
        
        // Should have at least one version
        $this->assertNotEmpty($versions);
        
        // Current version should be in supported versions
        $this->assertContains('2025-09-10', $versions);
    }

    /**
     * Test changelog retrieval
     * 
     * @return void
     */
    public function testChangelogRetrieval()
    {
        $service = new DojoPaymentService();
        $changelog = $service->getChangelog();
        
        // Should have changelog entries
        $this->assertNotEmpty($changelog);
        
        // Should contain current version info
        $this->assertArrayHasKey('2025-09-10', $changelog);
    }

    /**
     * Test payment intent builder
     * 
     * @return void
     */
    public function testBuildPaymentIntentRequest()
    {
        $service = new DojoPaymentService();
        
        $payload = $service->buildPaymentIntentRequest(
            amount: 1000,
            currencyCode: 'GBP',
            reference: 'Test_Order_123',
            description: 'Test payment'
        );
        
        // Verify payload structure
        $this->assertArrayHasKey('amount', $payload);
        $this->assertArrayHasKey('reference', $payload);
        $this->assertArrayHasKey('description', $payload);
        $this->assertArrayHasKey('captureMode', $payload);
        
        // Verify amount formatting
        $this->assertEquals(1000, $payload['amount']['value']);
        $this->assertEquals('GBP', $payload['amount']['currencyCode']);
        
        // Verify reference and description
        $this->assertEquals('Test_Order_123', $payload['reference']);
        $this->assertEquals('Test payment', $payload['description']);
    }

    /**
     * Test payment intent builder with optional parameters
     * 
     * @return void
     */
    public function testBuildPaymentIntentWithOptionalParams()
    {
        $service = new DojoPaymentService();
        
        $payload = $service->buildPaymentIntentRequest(
            amount: 2000,
            currencyCode: 'GBP',
            reference: 'Manual_Capture_Test',
            description: 'Manual capture payment',
            optionalParams: [
                'captureMode' => 'Manual',
                'customerEmail' => 'test@example.com',
            ]
        );
        
        // Verify optional parameters are included
        $this->assertEquals('Manual', $payload['captureMode']);
        $this->assertEquals('test@example.com', $payload['customerEmail']);
    }

    /**
     * Test API version header is mandatory
     * 
     * This test verifies that every request includes the version header
     * as required by Dojo API specification
     * 
     * @return void
     */
    public function testVersionHeaderInRequests()
    {
        // Mock HTTP to capture requests
        Http::fake([
            'api.dojo.tech/*' => Http::response([
                'id' => 'pi_test123',
                'status' => 'Active',
            ]),
        ]);
        
        $service = new DojoPaymentService();
        
        $payload = $service->buildPaymentIntentRequest(
            amount: 1000,
            currencyCode: 'GBP',
            reference: 'Version_Test',
            description: 'Test version header'
        );
        
        try {
            $service->createPaymentIntent($payload);
        } catch (Exception $e) {
            // Expected if API key is not configured
        }
        
        // Verify a request was made
        Http::assertSent(function ($request) {
            // Check that version header is present
            return $request->hasHeader('version');
        });
    }

    /**
     * Test error handling with meaningful messages
     * 
     * @return void
     */
    public function testErrorHandling()
    {
        // Mock an API error response
        Http::fake([
            'api.dojo.tech/*' => Http::response([
                'error' => [
                    'message' => 'Invalid amount',
                ]
            ], 400),
        ]);
        
        $service = new DojoPaymentService();
        
        $payload = $service->buildPaymentIntentRequest(
            amount: 0, // Invalid
            currencyCode: 'GBP',
            reference: 'Error_Test',
            description: 'Error handling test'
        );
        
        // Should throw an exception
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/Dojo API Error/');
        
        try {
            $service->createPaymentIntent($payload);
        } catch (Exception $e) {
            // Verify error includes status code
            $this->assertStringContainsString('Status:', $e->getMessage());
            throw $e;
        }
    }

    /**
     * Test controller endpoint for payment intent creation
     * 
     * @return void
     */
    public function testCreatePaymentIntentEndpoint()
    {
        // Mock Dojo API response
        Http::fake([
            'api.dojo.tech/payment-intents' => Http::response([
                'id' => 'pi_mock_123',
                'status' => 'Active',
                'amount' => ['value' => 1000, 'currencyCode' => 'GBP'],
                'reference' => 'Order_123456',
            ]),
        ]);
        
        // Make request to endpoint
        $response = $this->postJson('/api/dojo/payment-intents', [
            'amount' => 1000,
            'currency_code' => 'GBP',
            'reference' => 'Order_123456',
            'description' => 'Test payment',
        ]);
        
        // Verify response
        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    'id',
                    'status',
                    'amount',
                ],
                'api_version',
            ])
            ->assertJson([
                'success' => true,
                'api_version' => '2025-09-10',
            ]);
    }

    /**
     * Test version info endpoint
     * 
     * @return void
     */
    public function testVersionInfoEndpoint()
    {
        $response = $this->getJson('/api/dojo/version-info');
        
        $response->assertStatus(200)
            ->assertJsonStructure([
                'current_version',
                'supported_versions',
                'environment',
                'changelog',
            ])
            ->assertJson([
                'current_version' => '2025-09-10',
            ]);
    }

    /**
     * Test request validation
     * 
     * @return void
     */
    public function testPaymentIntentValidation()
    {
        // Missing required fields
        $response = $this->postJson('/api/dojo/payment-intents', [
            'amount' => 1000,
            // Missing: currency_code, reference, description
        ]);
        
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['currency_code', 'reference', 'description']);
    }

    /**
     * Test amount validation (must be positive)
     * 
     * @return void
     */
    public function testAmountValidation()
    {
        $response = $this->postJson('/api/dojo/payment-intents', [
            'amount' => -100, // Invalid: negative
            'currency_code' => 'GBP',
            'reference' => 'Test_123',
            'description' => 'Test',
        ]);
        
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['amount']);
    }
}
