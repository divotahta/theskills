@echo off
REM =============================================================================
REM Midtrans Test Runner (Windows)
REM =============================================================================
REM 
REM Script untuk menjalankan semua test Midtrans di Windows
REM 
REM Usage:
REM scripts\run-midtrans-tests.bat
REM
REM =============================================================================

echo 🧪 Midtrans Test Suite
echo ======================
echo.

REM Test 1: Configuration Test
echo 1. Running Configuration Test...
php scripts\test-midtrans.php
if %errorlevel% equ 0 (
    echo ✅ Configuration Test: PASSED
) else (
    echo ❌ Configuration Test: FAILED
)
echo.

REM Test 2: Artisan Commands Test
echo 2. Testing Artisan Commands...

REM Test status command
php artisan midtrans:status > nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ Status Command: PASSED
) else (
    echo ❌ Status Command: FAILED
)

REM Test switch command (sandbox)
php artisan midtrans:switch sandbox > nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ Switch to Sandbox: PASSED
) else (
    echo ❌ Switch to Sandbox: FAILED
)

REM Test switch command (production)
php artisan midtrans:switch production > nul 2>&1
if %errorlevel% equ 0 (
    echo ✅ Switch to Production: PASSED
) else (
    echo ❌ Switch to Production: FAILED
)

REM Switch back to sandbox
php artisan midtrans:switch sandbox > nul 2>&1
echo.

REM Test 3: PHPUnit Tests
echo 3. Running PHPUnit Tests...
if exist "vendor\bin\phpunit.bat" (
    vendor\bin\phpunit --filter=MidtransTest
    if %errorlevel% equ 0 (
        echo ✅ PHPUnit Tests: PASSED
    ) else (
        echo ❌ PHPUnit Tests: FAILED
    )
) else (
    echo ⚠️  PHPUnit not found. Install with: composer install
)
echo.

REM Test 4: Configuration Validation
echo 4. Validating Configuration...

REM Check if .env file exists
if exist ".env" (
    echo ✅ .env file exists
) else (
    echo ❌ .env file missing
)

REM Check if config is cached
if exist "bootstrap\cache\config.php" (
    echo ⚠️  Config is cached. Run 'php artisan config:clear' if needed
) else (
    echo ✅ Config cache cleared
)
echo.

REM Test 5: Service Test
echo 5. Testing Service Class...
php -r "try { require 'vendor/autoload.php'; $app = require 'bootstrap/app.php'; $app->make('Illuminate\Contracts\Console\Kernel')->bootstrap(); $service = new \App\Services\MidtransService(); echo 'Service class loaded successfully' . PHP_EOL; exit(0); } catch (Exception $e) { echo 'Service class failed: ' . $e->getMessage() . PHP_EOL; exit(1); }"
if %errorlevel% equ 0 (
    echo ✅ Service Class: PASSED
) else (
    echo ❌ Service Class: FAILED
)
echo.

REM Summary
echo 📋 Test Summary
echo ==================
echo.
echo 🎉 All tests completed!
echo.
echo 🛠️  Available Commands:
echo    php artisan midtrans:status
echo    php artisan midtrans:switch sandbox
echo    php artisan midtrans:switch production
echo    php artisan test --filter=MidtransTest
echo.

pause
