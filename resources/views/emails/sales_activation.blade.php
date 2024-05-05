<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify account</title>
</head>
<body>
    <h1>Verify your account</h1>
    <p>Click the link below to verify your account</p>
    <a href="{{ route('sales.activate', $user->activation_token) }}">Verify account</a>
    <p>Thank you</p>
</body>
</html>