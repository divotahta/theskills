<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Midtrans\Config;
use Midtrans\Transaction;

class MidtransStatusCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'midtrans:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show current Midtrans configuration and test connection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Midtrans Configuration Status');
        $this->line('');

        // Show current configuration
        $this->table(
            ['Setting', 'Value', 'Status'],
            [
                [
                    'Mode',
                    config('midtrans.is_production') ? 'Production' : 'Sandbox',
                    config('midtrans.is_production') ? '🔴 Production' : '🟢 Sandbox'
                ],
                [
                    'Server Key',
                    substr(config('midtrans.server_key'), 0, 20) . '...',
                    config('midtrans.server_key') ? '✅ Set' : '❌ Missing'
                ],
                [
                    'Client Key',
                    substr(config('midtrans.client_key'), 0, 20) . '...',
                    config('midtrans.client_key') ? '✅ Set' : '❌ Missing'
                ],
                [
                    'Merchant ID',
                    config('midtrans.merchant_id'),
                    config('midtrans.merchant_id') ? '✅ Set' : '❌ Missing'
                ],
                [
                    'Sanitized',
                    config('midtrans.is_sanitized') ? 'Yes' : 'No',
                    config('midtrans.is_sanitized') ? '✅ Enabled' : '⚠️ Disabled'
                ],
                [
                    '3DS',
                    config('midtrans.is_3ds') ? 'Yes' : 'No',
                    config('midtrans.is_3ds') ? '✅ Enabled' : '⚠️ Disabled'
                ],
            ]
        );

        // Test connection
        $this->line('');
        $this->info('🧪 Testing Midtrans Connection...');

        try {
            // Initialize Midtrans config
            Config::$serverKey = config('midtrans.server_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // Test with a dummy transaction ID
            $testTransactionId = 'TEST-' . time();
            
            try {
                $status = Transaction::status($testTransactionId);
                $this->error('❌ Connection test failed: Transaction found (unexpected)');
            } catch (\Exception $e) {
                if (strpos($e->getMessage(), '404') !== false || strpos($e->getMessage(), 'not found') !== false) {
                    $this->info('✅ Connection test successful: API responding correctly');
                } elseif (strpos($e->getMessage(), '401') !== false || strpos($e->getMessage(), 'Unknown Merchant') !== false) {
                    $this->warn('⚠️  Connection test failed: Invalid server key or merchant ID');
                    $this->warn('   Please check your Midtrans configuration');
                } else {
                    $this->error('❌ Connection test failed: ' . $e->getMessage());
                }
            }

        } catch (\Exception $e) {
            $this->error('❌ Connection test failed: ' . $e->getMessage());
        }

        // Show recommendations
        $this->line('');
        $this->info('💡 Recommendations:');

        if (!config('midtrans.is_production')) {
            $this->line('🟢 Sandbox mode is active - safe for development and testing');
        } else {
            $this->warn('🔴 Production mode is active - make sure you have production keys!');
        }

        if (!config('midtrans.is_sanitized')) {
            $this->warn('⚠️  Sanitized mode is disabled - consider enabling for security');
        }

        if (!config('midtrans.is_3ds')) {
            $this->warn('⚠️  3DS is disabled - consider enabling for better security');
        }

        // Show available commands
        $this->line('');
        $this->info('🛠️  Available Commands:');
        $this->line('  php artisan midtrans:switch sandbox     - Switch to sandbox mode');
        $this->line('  php artisan midtrans:switch production  - Switch to production mode');
        $this->line('  php artisan midtrans:status             - Show this status');

        return 0;
    }
}
