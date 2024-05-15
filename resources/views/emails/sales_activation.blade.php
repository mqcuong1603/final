<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        .button {
            display: inline-block;
            color: #fff;
            background-color: #3490dc;
            border-radius: 3px;
            padding: 10px 20px;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <p>Hello {{ $salesman->fullName }},</p>

        <p>An account has been created for you. Please click the link below to activate your account:</p>

        <p><a href="{{ route('sales.changePassword', $token) }}" class="button">Activate Account</a></p>

        <p>This link will expire in 1 minute.</p>

        <p>If you did not request this, please ignore this email.</p>

        <p>if the link is expired. Please click the link below to resend email:</p>

        <p><a href="{{ route('sales.resendActivation', $salesman->email) }}" class="button">Resend Activation Link</a></p>
    </div>
</body>

</html>