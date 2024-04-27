<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        .settings-icon {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .popover {
            display: none; /* Hidden by default */
            position: absolute;
            top: 50px;
            right: 10px;
            padding: 10px;
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .popover.visible {
            display: block; /* Show when 'visible' class is added */
        }
    </style>
</head>
<body>
    <h1>Welcome, Admin!</h1>
    <h2>Admin Profile</h2>
    <p>Username: <?php echo $_SESSION['username']; ?></p>
    <div class="settings-icon" onclick="togglePopover()">⚙️</div>

    <div id="popover" class="popover">
        <p><strong>Change password</strong></p>
        <p>New password:</p>
        <form action="change_password.php" method="post">
            <input type="password" id="new_password" name="new_password" required>
            <button type="submit">Submit</button>
        </form>
    </div>

    <a href="logout.php">Logout</a>

    <script>
        function togglePopover() {
            var popover = document.getElementById('popover');
            popover.classList.toggle('visible'); // Toggle 'visible' class
        }

        // Close popover when clicking outside of it
        window.onclick = function(event) {
            var popover = document.getElementById('popover');
            var settingsIcon = document.querySelector('.settings-icon');

            if (!settingsIcon.contains(event.target) && event.target !== settingsIcon) {
                popover.classList.remove('visible'); // Hide popover
            }
        }
    </script>
</body>
</html>
