<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Salesperson Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $username; ?>!</h2>
    <!-- Dashboard content here -->
    <p>Salesperson Dashboard Content Here</p>
</body>
</html>
