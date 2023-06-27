<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['loggedInUser'])) {
    // Redirect to the admin dashboard or another page
    header("Location: admin_dashboard.php");
    exit();
}

// Check if the login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the admin's credentials (replace with your own validation logic)
    if ($username === "admin" && $password === "password") {
        // Set the logged-in user in the session
        $_SESSION['loggedInUser'] = $username;

        // Redirect to the admin dashboard or another page
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $loginError = "Invalid username or password";
    }
}
?>



