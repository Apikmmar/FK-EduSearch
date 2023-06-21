<?php
session_start(); // Start the session

// Check if the expert is already logged in
if (isset($_SESSION['loggedInUser'])) {
    // Redirect to the expert dashboard or another page
    header("Location: expert_dashboard.php");
    exit();
}

// Check if the login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the expert's credentials (replace with your own validation logic)
    if ($username === "expert1" && $password === "password") {
        // Set the logged-in expert in the session
        $_SESSION['loggedInUser'] = $username;

        // Redirect to the expert dashboard or another page
        header("Location: expert_dashboard.php");
        exit();
    } else {
        $loginError = "Invalid username or password";
    }
}
?>


