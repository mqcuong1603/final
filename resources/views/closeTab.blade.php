<!DOCTYPE html>
<html>
<head>
    <title>Check Email</title>
</head>
<body>
    <div style="margin-top: 100px" class="container">
        <div class="border rounded-3">
            <h1 class="text-center text-success">Notice</h1>
            <h4 class="text-center mt-3">A email has been sent to you</h4>
            <p class="text-center mt-3" id="countdown">This tab will be close in <span
                    style="font-weight: bold" id="seconds">5</span> seconds.</p>
        </div>
    </div>

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