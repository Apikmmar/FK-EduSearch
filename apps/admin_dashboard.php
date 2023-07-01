<?php
session_start(); // Start the session

// Check if the admin is logged in
if (!isset($_SESSION['loggedInUser'])) {
    // Redirect to the login page or another page
    header("Location: admin_login.php");
    exit();
}

// Get the logged-in admin's username
$username = $_SESSION['loggedInUser'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.3);
        }

        h2 {
            text-align: center;
        }

        .welcome-message {
            text-align: center;
            margin-bottom: 20px;
        }

        .logout-button {
            text-align: center;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Admin Dashboard</h2>

        <div class="welcome-message">
            <p>Welcome, <?php echo isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser'] : ''; ?>!</p>
        </div>

        <div class="logout-button">
            <form method="post" action="adminLogout.php">
                <input type="submit" value="Logout">
            </form>
        </div>

        <!-- Place your dashboard content here -->

    </div>

</body>

</html>