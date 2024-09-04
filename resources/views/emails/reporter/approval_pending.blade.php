<!DOCTYPE html>
<html>

<head>
    <title>New Reporter Registration</title>
</head>

<body>
    <p>Dear Admin,</p>

    <p>A new reporter has registered on the platform. Here are the details:</p>

    <p>
        Name: {{ $data->name }}<br>
        Email: {{ $data->email }}
    </p>

    <p>Please verify and approve the reporter in the admin panel.</p>

    <p>Thank you,</p>
    <p>PHM</p>
</body>

</html>
