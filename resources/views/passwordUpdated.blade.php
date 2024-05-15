<!DOCTYPE html>
<html>
<head>
    <title>Password Updated</title>
</head>
<body>
    <h1>Your password has been updated!</h1>
    <p id="countdown">You will be redirected to the login page in <span id="seconds">5</span> seconds.</p>

    <script type="text/javascript">
        var seconds = 5;
        var countdown = document.getElementById('seconds');

        function updateCountdown() {
            seconds--;
            countdown.innerHTML = seconds;
            if (seconds <= 0) {
                window.location.href = "{{ route('login') }}";
            }
        }

        setInterval(updateCountdown, 1000);
    </script>
</body>
</html>