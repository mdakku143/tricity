<!DOCTYPE html>
<html>

<head>
    <title>New Reporter Registration</title>
</head>

<body>
    <p>Dear {{ $data->name }},</p>

    <p>Thank you for registering as a reporter. Please verify your email address by clicking the link below:</p>

    <p>
        <a href="{{ route('reporter.verification.verify', ['id' => $data->id, 'hash' => sha1($data->email)]) }}">
            Verify Email Address
        </a>
    </p>

    <p>If you did not create an account, no further action is required.</p>

    <p>Thank you,<br>Your Application Team</p>
</body>

</html>
