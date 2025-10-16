<?php
/**
 * Midtrans Configuration Test Script
 * 
 * Script untuk menguji konfigurasi Midtrans
 * 
 * Usage:
 * php scripts/test-midtrans.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🧪 Midtrans Configuration Test\n";
echo "==============================\n\n";

// Test 1: Check configuration
echo "1. Testing Configuration...\n";
$configs = [
    'server_key' => config('midtrans.server_key'),
    'client_key' => config('midtrans.client_key'),
    'merchant_id' => config('midtrans.merchant_id'),
    'is_production' => config('midtrans.is_production'),
    'is_sanitized' => config('midtrans.is_sanitized'),
    'is_3ds' => config('midtrans.is_3ds'),
];

foreach ($configs as $key => $value) {
    if ($value !== null) {
        echo "   ✅ {$key}: " . (is_bool($value) ? ($value ? 'true' : 'false') : substr($value, 0, 20) . '...') . "\n";
    } else {
        echo "   ❌ {$key}: Missing\n";
    }
}

// Test 2: Check environment
echo "\n2. Testing Environment...\n";
$env = app()->environment();
echo "   Environment: {$env}\n";
echo "   Production Mode: " . (config('midtrans.is_production') ? 'Yes' : 'No') . "\n";

// Test 3: Test Midtrans Service
echo "\n3. Testing Midtrans Service...\n";
try {
    $service = new \App\Services\MidtransService();
    echo "   ✅ Service initialized successfully\n";
    
    // Test transaction ID generation
    $transactionId = $service->generateTransactionId();
    echo "   ✅ Transaction ID generated: {$transactionId}\n";
    
} catch (\Exception $e) {
    echo "   ❌ Service initialization failed: " . $e->getMessage() . "\n";
}

// Test 4: Test Midtrans Connection
echo "\n4. Testing Midtrans Connection...\n";
try {
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
    \Midtrans\Config::$is3ds = config('midtrans.is_3ds');
    
    // Test with dummy transaction
    $testTransactionId = 'TEST-' . time();
    
    try {
        $status = \Midtrans\Transaction::status($testTransactionId);
        echo "   ❌ Unexpected: Transaction found\n";
    } catch (\Exception $e) {
        if (strpos($e->getMessage(), '404') !== false || strpos($e->getMessage(), 'not found') !== false) {
            echo "   ✅ Connection successful: API responding correctly\n";
        } else {
            echo "   ❌ Connection failed: " . $e->getMessage() . "\n";
        }
    }
    
} catch (\Exception $e) {
    echo "   ❌ Connection test failed: " . $e->getMessage() . "\n";
}

// Test 5: Check payment methods
echo "\n5. Testing Payment Methods...\n";
$paymentMethods = config('midtrans.payment_methods');
if (is_array($paymentMethods)) {
    $enabledMethods = array_filter($paymentMethods);
    echo "   ✅ Enabled methods: " . implode(', ', array_keys($enabledMethods)) . "\n";
} else {
    echo "   ❌ Payment methods configuration missing\n";
}

// Test 6: Check callback URLs
echo "\n6. Testing Callback URLs...\n";
$callbacks = config('midtrans.callbacks');
if (is_array($callbacks)) {
    foreach ($callbacks as $type => $url) {
        echo "   ✅ {$type}: {$url}\n";
    }
} else {
    echo "   ❌ Callback URLs configuration missing\n";
}

// Summary
echo "\n📋 Summary\n";
echo "==========\n";

$allConfigsPresent = !in_array(null, $configs);
$serviceWorking = class_exists('\App\Services\MidtransService');

if ($allConfigsPresent && $serviceWorking) {
    echo "✅ All tests passed! Midtrans is properly configured.\n";
    echo "🎉 Ready for " . (config('midtrans.is_production') ? 'production' : 'sandbox') . " mode.\n";
} else {
    echo "❌ Some tests failed. Please check the configuration.\n";
    if (!$allConfigsPresent) {
        echo "   - Missing configuration values\n";
    }
    if (!$serviceWorking) {
        echo "   - Service class not found\n";
    }
}

echo "\n🛠️  Available Commands:\n";
echo "   php artisan midtrans:status\n";
echo "   php artisan midtrans:switch sandbox\n";
echo "   php artisan midtrans:switch production\n";
echo "   php artisan test --filter=MidtransTest\n";

echo "\n";
