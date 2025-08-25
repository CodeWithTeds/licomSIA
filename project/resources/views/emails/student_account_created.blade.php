<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Account</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; }
    </style>
</head>
<body>
    <h2>Hello {{ $name }},</h2>
    <p>Your student account has been created. Here are your login details:</p>
    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>You can log in here: <a href="{{ $loginUrl }}">Student Login</a></p>
    <p>For security, please change your password after logging in.</p>
    <p>Thank you.</p>
</body>
<!-- Note: Consider moving to Markdown mailable in future for nicer styling -->
</html>


