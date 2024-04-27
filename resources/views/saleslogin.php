<?php
session_start();
if(isset($_SESSION['admin'])) {
    header('Location: admin_dashboard.php');
    exit();


}
?>
<?php


define('ADMIN_EMAIL', 'admin@gmail.com');
define('ADMIN_PASSWORD', 'admin');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        if ($email === ADMIN_EMAIL && $password === ADMIN_PASSWORD) {
            $error = "This email and password is not valid due to your current jurisdiction!";
            exit();
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Email and password are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Point of Sale</title>
    <link rel="stylesheet" href="styles.css">
    
    <style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: -apple-system, BlinkMacSystemFont, "San Francisco", Helvetica, Arial, sans-serif;
    font-weight: 300;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #f3f2f2;
}

.session {
    display: flex;
    width: 100%;
    max-width: 800px;
    background-color: #ffffff;
    box-shadow: 0px 2px 6px -1px rgba(0,0,0,.12);
    border-radius: 4px;
}

.left {
    flex: 1;
    padding: 20px;
    background-image: url("https://images.pexels.com/photos/114979/pexels-photo-114979.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
    background-size: cover;
}

.log-in {
    flex: 1;
    padding: 40px 30px;
}

h4 {
    font-size: 24px;
    font-weight: 600;
    color: #000;
    opacity: 0.85;
    margin-bottom: 20px;
}

p {
    font-size: 14px;
    line-height: 1.5;
    color: #000;
    opacity: 0.65;
    margin-bottom: 20px;
}

input {
    width: 100%;
    height: 50px;
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid rgba(0,0,0,0.1);
}

button {
    width: 100%;
    height: 50px;
    border: none;
    border-radius: 25px;
    background-color: pink;
    color: #fff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.3s ease;
}

button:hover {
    transform: translateY(-3px);
}

.icon {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
}

.discrete {
    color: rgba(0,0,0,0.4);
    font-size: 14px;
    text-decoration: none;
    margin-top: 20px;
    display: block;
    text-align: center;
}

    </style>
</head>
<body>
<div class="session">
    <div class="left">
        <svg>></svg>
    </div>
    <form action="" method="post" class="log-in" autocomplete="off">
        <h4>Login - Admin</h4>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <div class="floating-label">
            <input required placeholder="Email" type="email" name="email" id="email" autocomplete="off">
            <label for="email"></label>
        </div>
        <div class="floating-label">
            <input required placeholder="Password" type="password" name="password" id="password" autocomplete="off">
            <label for="password"></label>
        </div>
        <button type="submit">Log in</button>
    </form>
</div>
</body>
</html>
