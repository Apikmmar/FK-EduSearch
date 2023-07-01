<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['loggedInUser'])) {
    // Redirect to the appropriate dashboard or another page based on user type
    $userType = $_SESSION['loggedInUser']['userType'];
    if ($userType === 'student') {
        header("Location: student_dashboard.php");
        exit();
    } elseif ($userType === 'lecturer') {
        header("Location: lecturer_dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Student Dashboard</title>
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
        <h2>Student Dashboard</h2>

        <div class="welcome-message">
            <p>Welcome, <?php echo isset($_SESSION['loggedInUser']) ? $_SESSION['loggedInUser']['username'] : ''; ?>!</p>
        </div>

        <div class="logout-button">
            <form method="post" action="userLogout.php">
                <input type="submit" value="Logout">
            </form>
        </div>

        <!-- Place your dashboard content here -->

    </div>

</body>

</html>