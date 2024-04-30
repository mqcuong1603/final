<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($_POST['formType'] === 'admin') {
        if ($email === 'admin@gmail.com' && $password === 'admin') {
            $_SESSION['username'] = 'admin';
            $_SESSION['is_admin'] = true;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password. Please try again.";
            echo "<script>alert('$error');</script>";
        }

    } elseif ($_POST['formType'] === 'salesperson') {
        if ($email === 'dat@gmail.com' && $password === 'dat') {
            $_SESSION['username'] = 'salesperson';
            $_SESSION['is_admin'] = false;
            header("Location: sales_dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password for salesperson. Please try again.";
            echo "<script>alert('$error');</script>";
        }
    }
}
?>

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
        <form id="admin-form" class="form-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
            <h3>Admin Login</h3>
            <div class="form-wrapper">
                <input required placeholder="Email" type="email" name="email" id="email" autocomplete="off">
            </div>
            <div class="form-wrapper">
                <input required placeholder="Password" type="password" name="password" id="password" autocomplete="off">
            </div>
            <input type="hidden" name="formType" value="admin">
            <button type="submit">Login</button>
        </form>
        <form id="salesperson-form" class="form-container" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off" style="display: none;">
            <h3>Salesperson Login</h3>
            <div class="form-wrapper">
                <input required placeholder="Email" type="email" name="email" id="email" autocomplete="off">
            </div>
            <div class="form-wrapper">
                <input required placeholder="Password" type="password" name="password" id="password" autocomplete="off">
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
