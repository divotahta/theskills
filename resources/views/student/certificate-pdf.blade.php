<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate - {{ $certificate->certificate_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .certificate-container {
            background: white;
            width: 100%;
            max-width: 800px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
        }
        
        .certificate-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
        }
        
        .certificate-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.3;
        }
        
        .certificate-logo {
            position: relative;
            z-index: 1;
        }
        
        .certificate-logo h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .certificate-logo p {
            font-size: 1.1rem;
            opacity: 0.9;
        }
        
        .certificate-body {
            padding: 60px 40px;
            text-align: center;
        }
        
        .certificate-title {
            font-size: 2rem;
            color: #2d3748;
            margin-bottom: 20px;
            font-weight: 600;
        }
        
        .certificate-subtitle {
            font-size: 1.2rem;
            color: #4a5568;
            margin-bottom: 40px;
        }
        
        .certificate-name {
            font-size: 2.5rem;
            color: #2d3748;
            font-weight: bold;
            margin-bottom: 20px;
            text-decoration: underline;
            text-decoration-color: #667eea;
            text-underline-offset: 8px;
        }
        
        .certificate-course {
            font-size: 1.5rem;
            color: #4a5568;
            margin-bottom: 40px;
            font-weight: 500;
        }
        
        .certificate-details {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            padding-top: 40px;
            border-top: 2px solid #e2e8f0;
        }
        
        .certificate-detail {
            text-align: center;
        }
        
        .certificate-detail h4 {
            font-size: 1rem;
            color: #4a5568;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .certificate-detail p {
            font-size: 0.9rem;
            color: #718096;
        }
        
        .certificate-number {
            background: #f7fafc;
            padding: 15px;
            border-radius: 10px;
            margin: 30px 0;
            border-left: 4px solid #667eea;
        }
        
        .certificate-number h4 {
            font-size: 1rem;
            color: #4a5568;
            margin-bottom: 5px;
        }
        
        .certificate-number p {
            font-size: 1.2rem;
            color: #2d3748;
            font-weight: bold;
            font-family: 'Courier New', monospace;
        }
        
        .certificate-footer {
            background: #f8fafc;
            padding: 30px 40px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        
        .certificate-footer p {
            color: #718096;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .certificate-footer .website {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
        }
        
        .certificate-footer .website:hover {
            text-decoration: underline;
        }
        
        .verification-info {
            background: #edf2f7;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #4a5568;
        }
        
        .verification-info h5 {
            font-weight: bold;
            margin-bottom: 10px;
            color: #2d3748;
        }
        
        .verification-info p {
            margin-bottom: 5px;
        }
        
        .verification-info .url {
            color: #667eea;
            font-family: 'Courier New', monospace;
            word-break: break-all;
        }
        
        @media print {
            body {
                background: white;
                padding: 0;
            }
            
            .certificate-container {
                box-shadow: none;
                border-radius: 0;
            }
        }
        
        @page {
            margin: 0;
            size: A4 landscape;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <!-- Header -->
        <div class="certificate-header">
            <div class="certificate-logo">
                <h1>TheSkills</h1>
                <p>Certificate of Completion</p>
            </div>
        </div>
        
        <!-- Body -->
        <div class="certificate-body">
            <h2 class="certificate-title">Certificate of Completion</h2>
            <p class="certificate-subtitle">This is to certify that</p>
            
            <h1 class="certificate-name">{{ $certificate->user->name }}</h1>
            
            <p class="certificate-course">has successfully completed the course</p>
            <h3 class="certificate-course" style="color: #667eea; font-weight: bold;">{{ $certificate->course->title }}</h3>
            
            <div class="certificate-number">
                <h4>Certificate Number</h4>
                <p>{{ $certificate->certificate_number }}</p>
            </div>
            
            <div class="certificate-details">
                <div class="certificate-detail">
                    <h4>Issued Date</h4>
                    <p>{{ $certificate->issued_at->format('F d, Y') }}</p>
                </div>
                <div class="certificate-detail">
                    <h4>Expires Date</h4>
                    <p>{{ $certificate->expires_at->format('F d, Y') }}</p>
                </div>
                <div class="certificate-detail">
                    <h4>Instructor</h4>
                    <p>{{ $certificate->course->instructor->name }}</p>
                </div>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="certificate-footer">
            <p>This certificate is issued by TheSkills Academy</p>
            <p>For verification, visit: <a href="{{ config('app.url') }}" class="website">{{ config('app.url') }}</a></p>
            
            <div class="verification-info">
                <h5>Certificate Verification</h5>
                <p><strong>Certificate ID:</strong> {{ $certificate->certificate_number }}</p>
                <p><strong>Student Name:</strong> {{ $certificate->user->name }}</p>
                <p><strong>Course:</strong> {{ $certificate->course->title }}</p>
                <p><strong>Verification URL:</strong> <span class="url">{{ config('app.url') }}/verify/certificate/{{ $certificate->certificate_number }}</span></p>
            </div>
        </div>
    </div>
</body>
</html>
