<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admission Qualification Notice</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1a5f7a;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 8px 8px;
            border: 1px solid #eee;
        }
        .congratulations {
            font-size: 24px;
            color: #1a5f7a;
            margin-bottom: 20px;
            text-align: center;
        }
        .next-steps {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border: 1px solid #eee;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #1a5f7a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Admission Qualification Notice</h1>
    </div>
    
    <div class="content">
        <div class="congratulations">
            Congratulations, {{ $studentName }}!
        </div>

        <p>We are delighted to inform you that you have been found <strong>QUALIFIED</strong> for admission to {{ $programName }} at Libon Community College!</p>

        <p>This is a significant achievement, and we are excited about the prospect of having you join our academic community. Your academic credentials and qualifications have met our admission requirements.</p>

        <div class="next-steps">
            <h3>🎓 Next Steps:</h3>
            <ol>
                <li>Complete your enrollment process</li>
                <li>Submit any remaining required documents</li>
                <li>Attend the student orientation (details will be provided)</li>
                <li>Get ready to start your academic journey!</li>
            </ol>
        </div>

        <p>Your Admission ID: <strong>{{ $admissionId }}</strong></p>
        <p>Please keep this ID for future reference.</p>

        <p>If you have any questions about the next steps or need assistance, please don't hesitate to contact our Admissions Office:</p>
        <ul>
            <li>Email: admissions@licomsia.edu.ph</li>
            <li>Phone: (123) 456-7890</li>
        </ul>

        <center>
            <a href="{{ route('student.login') }}" class="button">Access Student Portal</a>
        </center>
    </div>

    <div class="footer">
        <p>Libon Community College<br>
        Nurturing Tomorrow's Leaders Today</p>
    </div>
</body>
</html>
