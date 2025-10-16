<?php
/**
 * Midtrans Environment Switcher
 * 
 * Script untuk memudahkan switching antara sandbox dan production mode
 * 
 * Usage:
 * php scripts/midtrans-switch.php sandbox
 * php scripts/midtrans-switch.php production
 */

if ($argc < 2) {
    echo "Usage: php scripts/midtrans-switch.php [sandbox|production]\n";
    exit(1);
}

$mode = $argv[1];

if (!in_array($mode, ['sandbox', 'production'])) {
    echo "Error: Mode must be 'sandbox' or 'production'\n";
    exit(1);
}

$envFile = '.env';
$backupFile = '.env.backup';

// Backup current .env file
if (file_exists($envFile)) {
    copy($envFile, $backupFile);
    echo "✅ Backup created: $backupFile\n";
}

// Read current .env file
$envContent = file_exists($envFile) ? file_get_contents($envFile) : '';

// Configuration for each mode
$configs = [
    'sandbox' => [
        'MIDTRANS_SERVER_KEY' => 'Mid-server-8hEYF1IVzpkT2VU2satq2r5o',
        'MIDTRANS_CLIENT_KEY' => 'Mid-client-ughTgkx6m733ZUOl',
        'MIDTRANS_IS_PRODUCTION' => 'false',
        'MIDTRANS_IS_SANITIZED' => 'true',
        'MIDTRANS_IS_3DS' => 'true',
        'MIDTRANS_MERCHANT_ID' => 'G388833137',
    ],
    'production' => [
        'MIDTRANS_SERVER_KEY' => 'Mid-server-nDpveX7Ge1fsrIbLnBRtdoTo',
        'MIDTRANS_CLIENT_KEY' => 'Mid-client-69zuGbdK7P9tdFtd',
        'MIDTRANS_IS_PRODUCTION' => 'true',
        'MIDTRANS_IS_SANITIZED' => 'true',
        'MIDTRANS_IS_3DS' => 'true',
        'MIDTRANS_MERCHANT_ID' => 'G388833137',
    ]
];

$config = $configs[$mode];

// Update or add each configuration
foreach ($config as $key => $value) {
    $pattern = "/^$key=.*/m";
    $replacement = "$key=$value";
    
    if (preg_match($pattern, $envContent)) {
        // Update existing
        $envContent = preg_replace($pattern, $replacement, $envContent);
        echo "✅ Updated: $key=$value\n";
    } else {
        // Add new
        $envContent .= "\n# Midtrans Configuration ($mode mode)\n";
        $envContent .= "$key=$value\n";
        echo "✅ Added: $key=$value\n";
    }
}

// Write updated .env file
file_put_contents($envFile, $envContent);

// Clear Laravel config cache
echo "\n🔄 Clearing Laravel config cache...\n";
exec('php artisan config:clear', $output, $returnCode);
if ($returnCode === 0) {
    echo "✅ Config cache cleared\n";
} else {
    echo "⚠️  Warning: Could not clear config cache. Run 'php artisan config:clear' manually.\n";
}

echo "\n🎉 Successfully switched to $mode mode!\n";
echo "📝 Don't forget to update production keys in .env file if switching to production.\n";
echo "🔄 Restart your web server if needed.\n";
