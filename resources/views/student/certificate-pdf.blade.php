<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 0;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .certificate {
            background: white;
            width: 1000px;
            height: 700px;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        
        .certificate::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(102, 126, 234, 0.1) 0%, transparent 70%);
            z-index: 0;
        }
        
        .certificate-content {
            position: relative;
            z-index: 1;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 15px;
        }
        
        .title {
            font-size: 42px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        
        .subtitle {
            font-size: 20px;
            color: #718096;
            margin-bottom: 30px;
        }
        
        .main-content {
            display: flex;
            flex: 1;
            gap: 40px;
        }
        
        .left-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }
        
        .right-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        .award-text {
            font-size: 22px;
            color: #4a5568;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .student-name {
            font-size: 36px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .course-info {
            background: #f7fafc;
            padding: 25px;
            border-radius: 15px;
            margin: 20px 0;
            border-left: 5px solid #667eea;
        }
        
        .course-title {
            font-size: 26px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 15px;
        }
        
        .course-details {
            font-size: 18px;
            color: #718096;
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
        }
        
        .course-details strong {
            color: #4a5568;
        }
        
        .certificate-number {
            font-size: 16px;
            color: #a0aec0;
            margin-top: 25px;
            text-align: center;
        }
        
        .date-info {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            font-size: 16px;
            color: #718096;
            padding: 0 20px;
        }
        
        .signature {
            text-align: center;
            margin-top: 30px;
        }
        
        .signature-line {
            border-top: 3px solid #667eea;
            width: 250px;
            margin: 15px auto;
        }
        
        .signature-text {
            font-size: 16px;
            color: #718096;
            font-weight: 500;
        }
        
        .border-decoration {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            bottom: 20px;
            border: 3px solid #667eea;
            border-radius: 15px;
            z-index: 0;
        }
        
        .corner-decoration {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 3px solid #667eea;
        }
        
        .corner-decoration.top-left {
            top: 30px;
            left: 30px;
            border-right: none;
            border-bottom: none;
        }
        
        .corner-decoration.top-right {
            top: 30px;
            right: 30px;
            border-left: none;
            border-bottom: none;
        }
        
        .corner-decoration.bottom-left {
            bottom: 30px;
            left: 30px;
            border-right: none;
            border-top: none;
        }
        
        .corner-decoration.bottom-right {
            bottom: 30px;
            right: 30px;
            border-left: none;
            border-top: none;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="border-decoration"></div>
        <div class="corner-decoration top-left"></div>
        <div class="corner-decoration top-right"></div>
        <div class="corner-decoration bottom-left"></div>
        <div class="corner-decoration bottom-right"></div>
        
        <div class="certificate-content">
            <div class="header">
                <div class="logo">TheSkills</div>
                <div class="title">Certificate of Completion</div>
                <div class="subtitle">This certifies that</div>
            </div>
            
            <div class="main-content">
                <div class="left-section">
                    <div class="award-text">
                        has successfully completed the course
                    </div>
                    
                    <div class="student-name">{{ $certificate->user->name }}</div>
                    
                    <div class="certificate-number">
                        Certificate Number: {{ $certificate->certificate_number }}
                    </div>
                </div>
                
                <div class="right-section">
                    <div class="course-info">
                        <div class="course-title">{{ $certificate->course->title }}</div>
                        <div class="course-details">
                            <span><strong>Category:</strong></span>
                            <span>{{ $certificate->course->category->name }}</span>
                        </div>
                        <div class="course-details">
                            <span><strong>Level:</strong></span>
                            <span>{{ $certificate->course->courseLevel->name }}</span>
                        </div>
                        <div class="course-details">
                            <span><strong>Instructor:</strong></span>
                            <span>{{ $certificate->course->instructor->name }}</span>
                        </div>
                    </div>
                    
                    <div class="signature">
                        <div class="signature-line"></div>
                        <div class="signature-text">{{ $certificate->course->instructor->name }}</div>
                        <div class="signature-text">Course Instructor</div>
                    </div>
                </div>
            </div>
            
            <div class="date-info">
                <div><strong>Issued on:</strong> {{ $certificate->issued_at->format('F d, Y') }}</div>
                <div><strong>Valid until:</strong> {{ $certificate->expires_at->format('F d, Y') }}</div>
            </div>
        </div>
    </div>
</body>
</html>
