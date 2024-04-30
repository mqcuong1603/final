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
        if ($email === 'dat@gmail.com' && $password === 'kk') {
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


