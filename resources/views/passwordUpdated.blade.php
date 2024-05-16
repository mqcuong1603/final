<!DOCTYPE html>
<html>

<head>
    <title>Password Updated</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</head>

<body>
    <div style="margin-top: 100px" class="container">
        <div class="border rounded-3">
            <h1 class="text-center text-success">Welcome</h1>
            <h4 class="text-center mt-3">Your password has been updated and now you are able to login!</h4>
            <p class="text-center mt-3" id="countdown">You will be redirected to the login page in <span
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
                window.location.href = "{{ route('login') }}";
            }
        }

        setInterval(updateCountdown, 1000);
    </script>
</body>

</html>