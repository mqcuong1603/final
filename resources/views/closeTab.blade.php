<!DOCTYPE html>
<html>
<head>
    <title>Check Email</title>
</head>
<body>
    <h1>Please check your email again!</h1>
    <p id="countdown">This tab will close in <span id="seconds">5</span> seconds.</p>

    <script type="text/javascript">
        var seconds = 5;
        var countdown = document.getElementById('seconds');

        function updateCountdown() {
            seconds--;
            countdown.innerHTML = seconds;
            if (seconds <= 0) {
                window.close();
            }
        }

        setInterval(updateCountdown, 1000);
    </script>
</body>
</html>