<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MidtransSwitchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'midtrans:switch {mode : The mode to switch to (sandbox|production)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Switch Midtrans between sandbox and production mode';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $mode = $this->argument('mode');

        if (!in_array($mode, ['sandbox', 'production'])) {
            $this->error('Mode must be either "sandbox" or "production"');
            return 1;
        }

        $envFile = base_path('.env');
        $backupFile = base_path('.env.backup.' . date('Y-m-d-H-i-s'));

        // Check if .env file exists
        if (!File::exists($envFile)) {
            $this->error('.env file not found!');
            return 1;
        }

        // Create backup
        File::copy($envFile, $backupFile);
        $this->info("✅ Backup created: {$backupFile}");

        // Read current .env content
        $envContent = File::get($envFile);

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
                $this->line("✅ Updated: $key=$value");
            } else {
                // Add new
                $envContent .= "\n# Midtrans Configuration ($mode mode)\n";
                $envContent .= "$key=$value\n";
                $this->line("✅ Added: $key=$value");
            }
        }

        // Write updated .env file
        File::put($envFile, $envContent);

        // Clear config cache
        $this->info("\n🔄 Clearing Laravel config cache...");
        $this->call('config:clear');

        // Show current configuration
        $this->info("\n📋 Current Midtrans Configuration:");
        $this->table(
            ['Setting', 'Value'],
            [
                ['Mode', $mode],
                ['Server Key', substr($config['MIDTRANS_SERVER_KEY'], 0, 20) . '...'],
                ['Client Key', substr($config['MIDTRANS_CLIENT_KEY'], 0, 20) . '...'],
                ['Production', $config['MIDTRANS_IS_PRODUCTION']],
                ['Merchant ID', $config['MIDTRANS_MERCHANT_ID']],
            ]
        );

        if ($mode === 'production') {
            $this->warn("\n⚠️  IMPORTANT: Update your production keys in .env file!");
            $this->warn("⚠️  Make sure to test thoroughly before going live!");
        }

        $this->info("\n🎉 Successfully switched to {$mode} mode!");
        $this->info("🔄 Restart your web server if needed.");

        return 0;
    }
}
