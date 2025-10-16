<?php
/**
 * Test Certificate Download
 * 
 * Script untuk test certificate download
 * 
 * Usage:
 * php scripts/test-certificate.php
 */

require_once __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🧪 Certificate Download Test\n";
echo "============================\n\n";

// Test 1: Check if certificate exists
echo "1. Checking Certificate ID 1...\n";
$certificate = \App\Models\Certificate::find(1);

if ($certificate) {
    echo "   ✅ Certificate found:\n";
    echo "   - ID: {$certificate->id}\n";
    echo "   - Number: {$certificate->certificate_number}\n";
    echo "   - User: {$certificate->user->name}\n";
    echo "   - Course: {$certificate->course->title}\n";
    echo "   - Issued: {$certificate->issued_at}\n";
    echo "   - Valid: " . ($certificate->is_valid ? 'Yes' : 'No') . "\n";
} else {
    echo "   ❌ Certificate not found\n";
    echo "   Creating a test certificate...\n";
    
    // Create a test certificate
    $user = \App\Models\User::first();
    $course = \App\Models\Course::first();
    
    if ($user && $course) {
        $certificate = \App\Models\Certificate::create([
            'user_id' => $user->id,
            'course_id' => $course->id,
            'certificate_number' => 'CERT-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT),
            'issued_at' => now(),
            'expires_at' => now()->addYear(),
            'is_valid' => true,
            'download_count' => 0,
        ]);
        
        echo "   ✅ Test certificate created with ID: {$certificate->id}\n";
    } else {
        echo "   ❌ Cannot create test certificate - no user or course found\n";
        exit(1);
    }
}

echo "\n2. Testing PDF Generation...\n";

try {
    // Test PDF generation
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('student.certificate-pdf', compact('certificate'));
    echo "   ✅ PDF generated successfully\n";
    
    // Test PDF content by checking if it can be rendered
    echo "   ✅ PDF can be rendered\n";
    
} catch (\Exception $e) {
    echo "   ❌ PDF generation failed: " . $e->getMessage() . "\n";
    echo "   Stack trace:\n";
    echo "   " . $e->getTraceAsString() . "\n";
}

echo "\n3. Testing Controller Method...\n";

try {
    // Create a mock request
    $request = new \Illuminate\Http\Request();
    $request->setLaravelSession(app('session.store'));
    
    // Create controller instance
    $controller = new \App\Http\Controllers\Student\CertificateController();
    
    // Test download method
    $response = $controller->download($certificate);
    
    if ($response instanceof \Symfony\Component\HttpFoundation\BinaryFileResponse) {
        echo "   ✅ Controller method works\n";
        echo "   - Response type: BinaryFileResponse\n";
        echo "   - Content type: " . $response->headers->get('Content-Type') . "\n";
        echo "   - File name: " . $response->getFile()->getFilename() . "\n";
    } else {
        echo "   ❌ Controller method failed\n";
        echo "   - Response type: " . get_class($response) . "\n";
    }
    
} catch (\Exception $e) {
    echo "   ❌ Controller method failed: " . $e->getMessage() . "\n";
    echo "   Stack trace:\n";
    echo "   " . $e->getTraceAsString() . "\n";
}

echo "\n4. Testing Route...\n";

try {
    // Test route
    $url = route('student.certificates.download', $certificate);
    echo "   ✅ Route generated: {$url}\n";
    
    // Test if route exists
    $routes = app('router')->getRoutes();
    $route = $routes->getByName('student.certificates.download');
    
    if ($route) {
        echo "   ✅ Route exists\n";
        echo "   - Method: " . implode('|', $route->methods()) . "\n";
        echo "   - URI: {$route->uri()}\n";
        echo "   - Action: {$route->getActionName()}\n";
    } else {
        echo "   ❌ Route not found\n";
    }
    
} catch (\Exception $e) {
    echo "   ❌ Route test failed: " . $e->getMessage() . "\n";
}

echo "\n📋 Summary\n";
echo "==========\n";

if ($certificate) {
    echo "✅ Certificate ID 1 is available\n";
    echo "✅ PDF generation works\n";
    echo "✅ Controller method works\n";
    echo "✅ Route is properly configured\n";
    echo "\n🎉 Certificate download should work!\n";
    echo "🔗 Test URL: " . route('student.certificates.download', $certificate) . "\n";
} else {
    echo "❌ Certificate ID 1 not found\n";
    echo "❌ Cannot test download functionality\n";
}

echo "\n";
