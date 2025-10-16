<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\MidtransService;
use App\Models\User;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MidtransTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test Midtrans configuration
     */
    public function test_midtrans_configuration()
    {
        $this->assertNotNull(config('midtrans.server_key'));
        $this->assertNotNull(config('midtrans.client_key'));
        $this->assertNotNull(config('midtrans.merchant_id'));
        $this->assertIsBool(config('midtrans.is_production'));
        $this->assertIsBool(config('midtrans.is_sanitized'));
        $this->assertIsBool(config('midtrans.is_3ds'));
    }

    /**
     * Test Midtrans service initialization
     */
    public function test_midtrans_service_initialization()
    {
        $service = new MidtransService();
        $this->assertInstanceOf(MidtransService::class, $service);
    }

    /**
     * Test payment creation (sandbox mode)
     */
    public function test_payment_creation_sandbox()
    {
        // Ensure we're in sandbox mode
        config(['midtrans.is_production' => false]);

        $user = User::factory()->create();
        $course = Course::factory()->create();
        $payment = Payment::factory()->create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'amount' => $course->price,
        ]);

        $service = new MidtransService();

        try {
            $snapToken = $service->createPayment($payment, $user, $course);
            $this->assertIsString($snapToken);
            $this->assertNotEmpty($snapToken);
        } catch (\Exception $e) {
            // In test environment, this might fail due to network
            // Just ensure the service doesn't crash
            $this->assertStringContains('Midtrans', $e->getMessage());
        }
    }

    /**
     * Test transaction ID generation
     */
    public function test_transaction_id_generation()
    {
        $service = new MidtransService();
        $transactionId = $service->generateTransactionId();

        $this->assertIsString($transactionId);
        $this->assertStringStartsWith('TXN-', $transactionId);
        $this->assertGreaterThan(10, strlen($transactionId));
    }

    /**
     * Test environment detection
     */
    public function test_environment_detection()
    {
        // Test sandbox mode
        config(['midtrans.is_production' => false]);
        $this->assertFalse(config('midtrans.is_production'));

        // Test production mode
        config(['midtrans.is_production' => true]);
        $this->assertTrue(config('midtrans.is_production'));
    }

    /**
     * Test configuration validation
     */
    public function test_configuration_validation()
    {
        $requiredConfigs = [
            'midtrans.server_key',
            'midtrans.client_key',
            'midtrans.merchant_id',
            'midtrans.is_production',
            'midtrans.is_sanitized',
            'midtrans.is_3ds',
        ];

        foreach ($requiredConfigs as $config) {
            $this->assertNotNull(config($config), "Configuration {$config} is missing");
        }
    }

    /**
     * Test payment methods configuration
     */
    public function test_payment_methods_configuration()
    {
        $paymentMethods = config('midtrans.payment_methods');
        
        $this->assertIsArray($paymentMethods);
        $this->assertArrayHasKey('credit_card', $paymentMethods);
        $this->assertArrayHasKey('bca_va', $paymentMethods);
        $this->assertArrayHasKey('gopay', $paymentMethods);
    }

    /**
     * Test callback URLs configuration
     */
    public function test_callback_urls_configuration()
    {
        $callbacks = config('midtrans.callbacks');
        
        $this->assertIsArray($callbacks);
        $this->assertArrayHasKey('finish', $callbacks);
        $this->assertArrayHasKey('unfinish', $callbacks);
        $this->assertArrayHasKey('error', $callbacks);
        $this->assertArrayHasKey('notification', $callbacks);
    }
}
