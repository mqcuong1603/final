<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Point of Sale</title>
    <link rel="stylesheet" href="css/login.css">
    <style>
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

        .active-button {
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="form-button">
            <button class="active admin-button" onclick="showForm('admin')">Admin</button>
            <button class="choose salesperson-button" onclick="showForm('salesperson')">Salesperson</button>
        </div>
        <form id="admin-form" class="form-container" method="POST" action="{{ route('login') }}" autocomplete="off" style="display: none;">
            @csrf
            <h3>Admin Login</h3>
            <div class="form-wrapper">
                <input required placeholder="Username" name="username" id="adminUsername" autocomplete="off">
            </div>
            <div class="form-wrapper">
                <input required placeholder="Password" type="password" name="password" id="adminPassword"
                    autocomplete="off">
            </div>
            <input type="hidden" name="formType" value="admin">
            <button type="submit">Login</button>
        </form>
        <form id="salesperson-form" class="form-container" action="{{ route('login') }}" method="POST"
            autocomplete="off" style="display: none;">
            @csrf
            <h3>Salesperson Login</h3>
            <div class="form-wrapper">
                <input required placeholder="Username" name="username" id="saleUsername" autocomplete="off">
            </div>
            <div class="form-wrapper">
                <input required placeholder="Password" type="password" name="password" id="salePassword"
                    autocomplete="off">
            </div>
            <input type="hidden" name="formType" value="salesperson">
            <button type="submit">Login</button>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <script>
        function showForm(type) {
            var forms = document.querySelectorAll('.form-container');
            forms.forEach(function(form) {
                form.style.display = 'none';
            });
            document.getElementById(type + '-form').style.display = 'block';

            var buttons = document.querySelectorAll('.form-button button');
            buttons.forEach(function(button) {
                button.classList.remove('active-button');
            });
            document.querySelector('.' + type + '-button').classList.add('active-button');
        }

        showForm('admin');
    </script>
</body>