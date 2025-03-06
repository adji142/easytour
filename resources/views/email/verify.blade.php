<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>Hello, {{ $user->name }}</h2>
    <p>Thank you for registering. Please click the button below to verify your email.</p>
    <a href="{{ $verificationUrl }}" style="display:inline-block; padding:10px 20px; background:#28a745; color:#fff; text-decoration:none; border-radius:5px;">
        Verify Email
    </a>
    <p>This link will expire in 60 minutes.</p>
</body>
</html>
