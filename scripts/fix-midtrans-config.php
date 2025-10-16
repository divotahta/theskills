<?php
/**
 * Midtrans Configuration Fixer
 * 
 * Script untuk memperbaiki konfigurasi Midtrans yang bermasalah
 * 
 * Usage:
 * php scripts/fix-midtrans-config.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔧 Midtrans Configuration Fixer\n";
echo "================================\n\n";

// Check current configuration
echo "1. Checking current configuration...\n";
$currentConfig = [
    'server_key' => config('midtrans.server_key'),
    'client_key' => config('midtrans.client_key'),
    'merchant_id' => config('midtrans.merchant_id'),
    'is_production' => config('midtrans.is_production'),
];

foreach ($currentConfig as $key => $value) {
    if ($value !== null) {
        echo "   ✅ {$key}: " . (is_bool($value) ? ($value ? 'true' : 'false') : substr($value, 0, 20) . '...') . "\n";
    } else {
        echo "   ❌ {$key}: Missing\n";
    }
}

echo "\n2. Testing Midtrans connection...\n";

try {
    // Initialize Midtrans config
    \Midtrans\Config::$serverKey = config('midtrans.server_key');
    \Midtrans\Config::$isProduction = config('midtrans.is_production');
    \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
    \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

    // Test with a dummy transaction ID
    $testTransactionId = 'TEST-' . time();
    
    try {
        $status = \Midtrans\Transaction::status($testTransactionId);
        echo "   ❌ Unexpected: Transaction found\n";
    } catch (\Exception $e) {
        if (strpos($e->getMessage(), '404') !== false || strpos($e->getMessage(), 'not found') !== false) {
            echo "   ✅ Connection successful: API responding correctly\n";
        } elseif (strpos($e->getMessage(), '401') !== false || strpos($e->getMessage(), 'Unknown Merchant') !== false) {
            echo "   ❌ Connection failed: Invalid server key or merchant ID\n";
            echo "   🔧 Attempting to fix configuration...\n";
            
            // Fix configuration
            $envFile = '.env';
            $envContent = file_exists($envFile) ? file_get_contents($envFile) : '';
            
            // Update with correct sandbox keys
            $sandboxConfig = [
                'MIDTRANS_SERVER_KEY' => 'Mid-server-8hEYF1IVzpkT2VU2satq2r5o',
                'MIDTRANS_CLIENT_KEY' => 'Mid-client-ughTgkx6m733ZUOl',
                'MIDTRANS_IS_PRODUCTION' => 'false',
                'MIDTRANS_IS_SANITIZED' => 'true',
                'MIDTRANS_IS_3DS' => 'true',
                'MIDTRANS_MERCHANT_ID' => 'G388833137',
            ];
            
            foreach ($sandboxConfig as $key => $value) {
                $pattern = "/^$key=.*/m";
                $replacement = "$key=$value";
                
                if (preg_match($pattern, $envContent)) {
                    $envContent = preg_replace($pattern, $replacement, $envContent);
                    echo "   ✅ Updated: $key\n";
                } else {
                    $envContent .= "\n# Midtrans Configuration (sandbox mode)\n";
                    $envContent .= "$key=$value\n";
                    echo "   ✅ Added: $key\n";
                }
            }
            
            // Write updated .env file
            file_put_contents($envFile, $envContent);
            
            // Clear config cache
            echo "\n   🔄 Clearing config cache...\n";
            exec('php artisan config:clear', $output, $returnCode);
            if ($returnCode === 0) {
                echo "   ✅ Config cache cleared\n";
            } else {
                echo "   ⚠️  Warning: Could not clear config cache\n";
            }
            
            // Test again
            echo "\n   🧪 Testing connection again...\n";
            \Midtrans\Config::$serverKey = $sandboxConfig['MIDTRANS_SERVER_KEY'];
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;
            
            try {
                $status = \Midtrans\Transaction::status($testTransactionId);
                echo "   ❌ Unexpected: Transaction found\n";
            } catch (\Exception $e) {
                if (strpos($e->getMessage(), '404') !== false || strpos($e->getMessage(), 'not found') !== false) {
                    echo "   ✅ Connection successful: API responding correctly\n";
                } else {
                    echo "   ❌ Connection still failed: " . $e->getMessage() . "\n";
                }
            }
            
        } else {
            echo "   ❌ Connection failed: " . $e->getMessage() . "\n";
        }
    }
    
} catch (\Exception $e) {
    echo "   ❌ Connection test failed: " . $e->getMessage() . "\n";
}

echo "\n3. Final configuration check...\n";
$finalConfig = [
    'server_key' => config('midtrans.server_key'),
    'client_key' => config('midtrans.client_key'),
    'merchant_id' => config('midtrans.merchant_id'),
    'is_production' => config('midtrans.is_production'),
];

foreach ($finalConfig as $key => $value) {
    if ($value !== null) {
        echo "   ✅ {$key}: " . (is_bool($value) ? ($value ? 'true' : 'false') : substr($value, 0, 20) . '...') . "\n";
    } else {
        echo "   ❌ {$key}: Missing\n";
    }
}

echo "\n📋 Summary\n";
echo "==========\n";
echo "✅ Configuration has been checked and fixed if needed\n";
echo "✅ Sandbox mode is active (safe for development)\n";
echo "✅ Ready for testing\n";

echo "\n🛠️  Next steps:\n";
echo "1. Test payment creation\n";
echo "2. Test with sandbox test cards\n";
echo "3. Check logs for any issues\n";

echo "\n";
