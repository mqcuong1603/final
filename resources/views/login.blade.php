<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Point of Sale</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
        body {
            background-color: #c2e2f4;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .wrapper {
            width: 400px;
            text-align: center;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            position: relative;
            display: none;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .form-button {
            display: flex;
            justify-content: space-around;
            background: #0077B2;
            padding: 10px;
        }

        .form-button button {
            background: none;
            border: none;
            color: white;
            font-size: 16px;
            cursor: pointer;
            padding: 10px 20px;
            transition: background 0.3s, color 0.3s;
        }

        .form-button button:hover {
            background: #4CAF50;
            color: white;
        }

        .active-button {
            background: #4CAF50;
            color: white;
        }

        .form-container {
            padding: 20px;
            display: none;
            opacity: 0;
            transform: translateX(100%);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .form-container.active {
            display: block;
            opacity: 1;
            transform: translateX(0);
        }

        .form-wrapper {
            margin-bottom: 15px;
        }

        .form-wrapper input {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-container button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .form-container button[type="submit"]:hover {
            background: #45a049;
        }

        .present-wrapper {
            text-align: center;
        }

        .present {
            width: 150px;
            height: 150px;
            background-color: #0077B2;
            margin: 0 auto;
            border-radius: 10px;
            position: relative;
            top: 0;
            transition: top 0.5s ease;
        }

        .present:before,
        .present:after {
            content: '';
            position: absolute;
            background: #4CAF50;
        }

        .present:before {
            width: 100%;
            height: 20px;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
        }

        .present:after {
            height: 100%;
            width: 20px;
            left: 50%;
            top: 0;
            transform: translateX(-50%);
        }

        .open-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            margin-top: 5%;
        }
    </style>
</head>

<body>
    <div class="present-wrapper" id="presentWrapper">
        <div class="present" id="present"></div>
        <button class="open-button" id="openButton">Open</button>
    </div>
    <div class="wrapper" id="loginWrapper">
        <div class="form-button">
            <button class="admin-button active-button" onclick="showForm('admin')">Admin</button>
            <button class="salesperson-button" onclick="showForm('salesperson')">Salesperson</button>
        </div>
        <form id="admin-form" class="form-container" method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <h3>Admin Login</h3>
            <div class="form-wrapper">
                <input required placeholder="Username" name="username" id="adminUsername" autocomplete="off">
            </div>
            <div class="form-wrapper">
                <input required placeholder="Password" type="password" name="password" id="adminPassword" autocomplete="off">
            </div>
            <input type="hidden" name="formType" value="admin">
            <button type="submit">Login</button>
        </form>
        <form id="salesperson-form" class="form-container" action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <h3>Salesperson Login</h3>
            <div class="form-wrapper">
                <input required placeholder="Username" name="username" id="saleUsername" autocomplete="off">
            </div>
            <div class="form-wrapper">
                <input required placeholder="Password" type="password" name="password" id="salePassword" autocomplete="off">
            </div>
            <input type="hidden" name="formType" value="salesperson">
            <button type="submit">Login</button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <script>
        function showForm(type) {
            var activeForm = document.querySelector('.form-container.active');
            if (activeForm) {
                activeForm.classList.remove('active');
                setTimeout(function() {
                    activeForm.style.display = 'none';
                    var newForm = document.getElementById(type + '-form');
                    newForm.style.display = 'block';
                    setTimeout(function() {
                        newForm.classList.add('active');
                    }, 10);
                }, 300); // Adjust this duration to match the transition time
            } else {
                var newForm = document.getElementById(type + '-form');
                newForm.style.display = 'block';
                setTimeout(function() {
                    newForm.classList.add('active');
                }, 10);
            }

            var buttons = document.querySelectorAll('.form-button button');
            buttons.forEach(function(button) {
                button.classList.remove('active-button');
            });
            document.querySelector('.' + type + '-button').classList.add('active-button');
        }

        document.getElementById('openButton').addEventListener('click', function() {
            var present = document.getElementById('present');
            var loginWrapper = document.getElementById('loginWrapper');
            var presentWrapper = document.getElementById('presentWrapper');

            present.style.top = '-200px';
            setTimeout(function() {
                presentWrapper.style.display = 'none';
                loginWrapper.style.display = 'block';
                setTimeout(function() {
                    loginWrapper.style.opacity = '1';
                    loginWrapper.style.transform = 'scale(1)';
                }, 10);
                showForm('admin');
            }, 500);
        });

        window.onload = function() {
            var hasErrors = document.querySelector('.alert');
            if (hasErrors) {
                document.getElementById('presentWrapper').style.display = 'none';
                var loginWrapper = document.getElementById('loginWrapper');
                loginWrapper.style.display = 'block';
                setTimeout(function() {
                    loginWrapper.style.opacity = '1';
                    loginWrapper.style.transform = 'scale(1)';
                }, 10);
                showForm('admin');
            }
        };
    </script>
</body>

</html>