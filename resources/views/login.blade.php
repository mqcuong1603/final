<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Point of Sale</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="wrapper">
        <div class="form-button">
            <button class="active" onclick="showForm('admin')">Admin</button>
            <button class="choose" onclick="showForm('salesperson')">Salesperson</button>
        </div>
        <form id="admin-form" class="form-container" method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <h3>Admin Login</h3>
            <div class="form-wrapper">
                <input required placeholder="Email" type="email" name="email" id="adminEmail" autocomplete="off">
            </div>
            <div class="form-wrapper">
                <input required placeholder="Password" type="password" name="password" id="adminPassword" autocomplete="off">
            </div>
            <input type="hidden" name="formType" value="admin">
            <button type="submit">Login</button>
        </form>
        <form id="salesperson-form" class="form-container" action="{{ route('login') }}" method="POST" autocomplete="off" style="display: none;">
            @csrf
            <h3>Salesperson Login</h3>
            <div class="form-wrapper">
                <input required placeholder="Email" type="email" name="email" id="saleEmail" autocomplete="off">
            </div>
            <div class="form-wrapper">
                <input required placeholder="Password" type="password" name="password" id="salePassword" autocomplete="off">
            </div>
            <input type="hidden" name="formType" value="salesperson">
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        function showForm(type) {
            var forms = document.querySelectorAll('.form-container');
            forms.forEach(function(form) {
                form.style.display = 'none';
            });
            document.getElementById(type + '-form').style.display = 'block';
        }
    </script>
</body>

</html>
