#!/bin/bash

# =============================================================================
# Midtrans Test Runner
# =============================================================================
# 
# Script untuk menjalankan semua test Midtrans
# 
# Usage:
# chmod +x scripts/run-midtrans-tests.sh
# ./scripts/run-midtrans-tests.sh
#
# =============================================================================

echo "🧪 Midtrans Test Suite"
echo "======================"
echo ""

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    if [ $2 -eq 0 ]; then
        echo -e "${GREEN}✅ $1${NC}"
    else
        echo -e "${RED}❌ $1${NC}"
    fi
}

# Test 1: Configuration Test
echo -e "${BLUE}1. Running Configuration Test...${NC}"
php scripts/test-midtrans.php
CONFIG_TEST_RESULT=$?
print_status "Configuration Test" $CONFIG_TEST_RESULT

echo ""

# Test 2: Artisan Commands Test
echo -e "${BLUE}2. Testing Artisan Commands...${NC}"

# Test status command
php artisan midtrans:status > /dev/null 2>&1
STATUS_CMD_RESULT=$?
print_status "Status Command" $STATUS_CMD_RESULT

# Test switch command (sandbox)
php artisan midtrans:switch sandbox > /dev/null 2>&1
SWITCH_SANDBOX_RESULT=$?
print_status "Switch to Sandbox" $SWITCH_SANDBOX_RESULT

# Test switch command (production)
php artisan midtrans:switch production > /dev/null 2>&1
SWITCH_PRODUCTION_RESULT=$?
print_status "Switch to Production" $SWITCH_PRODUCTION_RESULT

# Switch back to sandbox
php artisan midtrans:switch sandbox > /dev/null 2>&1

echo ""

# Test 3: PHPUnit Tests
echo -e "${BLUE}3. Running PHPUnit Tests...${NC}"
if [ -f "vendor/bin/phpunit" ]; then
    vendor/bin/phpunit --filter=MidtransTest
    PHPUNIT_RESULT=$?
    print_status "PHPUnit Tests" $PHPUNIT_RESULT
else
    echo -e "${YELLOW}⚠️  PHPUnit not found. Install with: composer install${NC}"
    PHPUNIT_RESULT=1
fi

echo ""

# Test 4: Configuration Validation
echo -e "${BLUE}4. Validating Configuration...${NC}"

# Check if .env file exists
if [ -f ".env" ]; then
    print_status ".env file exists" 0
else
    print_status ".env file exists" 1
fi

# Check if config is cached
if [ -f "bootstrap/cache/config.php" ]; then
    echo -e "${YELLOW}⚠️  Config is cached. Run 'php artisan config:clear' if needed${NC}"
else
    print_status "Config cache cleared" 0
fi

echo ""

# Test 5: Service Test
echo -e "${BLUE}5. Testing Service Class...${NC}"
php -r "
try {
    require 'vendor/autoload.php';
    \$app = require 'bootstrap/app.php';
    \$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
    
    \$service = new \App\Services\MidtransService();
    echo 'Service class loaded successfully' . PHP_EOL;
    exit(0);
} catch (Exception \$e) {
    echo 'Service class failed: ' . \$e->getMessage() . PHP_EOL;
    exit(1);
}
"
SERVICE_TEST_RESULT=$?
print_status "Service Class" $SERVICE_TEST_RESULT

echo ""

# Summary
echo -e "${BLUE}📋 Test Summary${NC}"
echo "=================="

TOTAL_TESTS=5
PASSED_TESTS=0

if [ $CONFIG_TEST_RESULT -eq 0 ]; then
    ((PASSED_TESTS++))
fi

if [ $STATUS_CMD_RESULT -eq 0 ] && [ $SWITCH_SANDBOX_RESULT -eq 0 ] && [ $SWITCH_PRODUCTION_RESULT -eq 0 ]; then
    ((PASSED_TESTS++))
fi

if [ $PHPUNIT_RESULT -eq 0 ]; then
    ((PASSED_TESTS++))
fi

if [ -f ".env" ]; then
    ((PASSED_TESTS++))
fi

if [ $SERVICE_TEST_RESULT -eq 0 ]; then
    ((PASSED_TESTS++))
fi

echo "Tests Passed: $PASSED_TESTS/$TOTAL_TESTS"

if [ $PASSED_TESTS -eq $TOTAL_TESTS ]; then
    echo -e "${GREEN}🎉 All tests passed! Midtrans is ready to use.${NC}"
    exit 0
else
    echo -e "${RED}❌ Some tests failed. Please check the configuration.${NC}"
    exit 1
fi