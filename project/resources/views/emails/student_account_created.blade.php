<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your LicomSIA Student Account</title>
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
        .credentials {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border: 1px solid #eee;
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
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
        .important {
            color: #d63939;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Your Student Account Details</h1>
    </div>
    
    <div class="content">
        <h2>Welcome to LicomSIA, {{ $name }}!</h2>
        <p>Congratulations on your admission! Your student account has been created. Here are your login credentials:</p>

        <div class="credentials">
            <h3>🔐 Login Details</h3>
            <p><strong>Email:</strong> {{ $email }}</p>
            <p><strong>Password:</strong> <span class="important">{{ $password }}</span></p>
        </div>

        <p><strong>Important:</strong> For security reasons, please change your password after your first login.</p>

        <center>
            <a href="{{ $loginUrl }}" class="button">Login to Student Portal</a>
        </center>

        <p style="margin-top: 30px;">If you need any assistance, please contact our IT support:</p>
        <ul>
            <li>Email: support@licomsia.edu.ph</li>
            <li>Phone: (123) 456-7890</li>
        </ul>
    </div>

    <div class="footer">
        <p>Libon Community College<br>
        Nurturing Tomorrow's Leaders Today</p>
    </div>
</body>
</html>


