# =============================================================================
# Midtrans Test Runner (PowerShell)
# =============================================================================
# 
# Script untuk menjalankan semua test Midtrans di Windows PowerShell
# 
# Usage:
# .\scripts\run-midtrans-tests.ps1
#
# =============================================================================

Write-Host "🧪 Midtrans Test Suite" -ForegroundColor Blue
Write-Host "======================" -ForegroundColor Blue
Write-Host ""

# Function to print colored output
function Write-Status {
    param(
        [string]$Message,
        [bool]$Success
    )
    
    if ($Success) {
        Write-Host "✅ $Message" -ForegroundColor Green
    } else {
        Write-Host "❌ $Message" -ForegroundColor Red
    }
}

# Test 1: Configuration Test
Write-Host "1. Running Configuration Test..." -ForegroundColor Blue
$configTest = php scripts\test-midtrans.php
$configTestResult = $LASTEXITCODE -eq 0
Write-Status "Configuration Test" $configTestResult

Write-Host ""

# Test 2: Artisan Commands Test
Write-Host "2. Testing Artisan Commands..." -ForegroundColor Blue

# Test status command
php artisan midtrans:status > $null 2>&1
$statusCmdResult = $LASTEXITCODE -eq 0
Write-Status "Status Command" $statusCmdResult

# Test switch command (sandbox)
php artisan midtrans:switch sandbox > $null 2>&1
$switchSandboxResult = $LASTEXITCODE -eq 0
Write-Status "Switch to Sandbox" $switchSandboxResult

# Test switch command (production)
php artisan midtrans:switch production > $null 2>&1
$switchProductionResult = $LASTEXITCODE -eq 0
Write-Status "Switch to Production" $switchProductionResult

# Switch back to sandbox
php artisan midtrans:switch sandbox > $null 2>&1

Write-Host ""

# Test 3: PHPUnit Tests
Write-Host "3. Running PHPUnit Tests..." -ForegroundColor Blue
if (Test-Path "vendor\bin\phpunit.bat") {
    vendor\bin\phpunit --filter=MidtransTest
    $phpunitResult = $LASTEXITCODE -eq 0
    Write-Status "PHPUnit Tests" $phpunitResult
} else {
    Write-Host "⚠️  PHPUnit not found. Install with: composer install" -ForegroundColor Yellow
    $phpunitResult = $false
}

Write-Host ""

# Test 4: Configuration Validation
Write-Host "4. Validating Configuration..." -ForegroundColor Blue

# Check if .env file exists
if (Test-Path ".env") {
    Write-Status ".env file exists" $true
} else {
    Write-Status ".env file exists" $false
}

# Check if config is cached
if (Test-Path "bootstrap\cache\config.php") {
    Write-Host "⚠️  Config is cached. Run 'php artisan config:clear' if needed" -ForegroundColor Yellow
} else {
    Write-Status "Config cache cleared" $true
}

Write-Host ""

# Test 5: Service Test
Write-Host "5. Testing Service Class..." -ForegroundColor Blue
$serviceTest = php -r "try { require 'vendor/autoload.php'; `$app = require 'bootstrap/app.php'; `$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap(); `$service = new \App\Services\MidtransService(); echo 'Service class loaded successfully' . PHP_EOL; exit(0); } catch (Exception `$e) { echo 'Service class failed: ' . `$e->getMessage() . PHP_EOL; exit(1); }"
$serviceTestResult = $LASTEXITCODE -eq 0
Write-Status "Service Class" $serviceTestResult

Write-Host ""

# Summary
Write-Host "📋 Test Summary" -ForegroundColor Blue
Write-Host "==================" -ForegroundColor Blue

$totalTests = 5
$passedTests = 0

if ($configTestResult) { $passedTests++ }
if ($statusCmdResult -and $switchSandboxResult -and $switchProductionResult) { $passedTests++ }
if ($phpunitResult) { $passedTests++ }
if (Test-Path ".env") { $passedTests++ }
if ($serviceTestResult) { $passedTests++ }

Write-Host "Tests Passed: $passedTests/$totalTests"

if ($passedTests -eq $totalTests) {
    Write-Host "🎉 All tests passed! Midtrans is ready to use." -ForegroundColor Green
} else {
    Write-Host "❌ Some tests failed. Please check the configuration." -ForegroundColor Red
}

Write-Host ""
Write-Host "🛠️  Available Commands:" -ForegroundColor Blue
Write-Host "   php artisan midtrans:status"
Write-Host "   php artisan midtrans:switch sandbox"
Write-Host "   php artisan midtrans:switch production"
Write-Host "   php artisan test --filter=MidtransTest"
Write-Host ""

Read-Host "Press Enter to continue"
