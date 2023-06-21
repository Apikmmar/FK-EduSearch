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

// Check if the login form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Validate the user's credentials (replace with your own validation logic)
    if ($username === "student1" && $password === "student123") {
        // Set the logged-in user in the session with user type as 'student'
        $_SESSION['loggedInUser'] = array(
            'username' => $username,
            'userType' => 'student'
        );

        // Redirect to the student dashboard or another page
        header("Location: student_dashboard.php");
        exit();
    } elseif ($username === "lecturer1" && $password === "lecturer123") {
        // Set the logged-in user in the session with user type as 'lecturer'
        $_SESSION['loggedInUser'] = array(
            'username' => $username,
            'userType' => 'lecturer'
        );

        // Redirect to the lecturer dashboard or another page
        header("Location: lecturer_dashboard.php");
        exit();
    } else {
        $loginError = "Invalid username or password";
    }
}
?>
