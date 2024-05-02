<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <h1>Logging out...</h1>

    <p>You will be redirected to the login page in a few seconds...</p>

    <script>
        setTimeout(function() {
            window.location.href = "{{ route('login') }}";
        }, 3000);
    </script>
</body>
</html>