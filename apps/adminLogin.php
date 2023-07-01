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

    // Connect to the MySQL database
    $servername = "localhost";
    $usernameDB = "root"; // Replace with your MySQL username
    $passwordDB = ""; // Replace with your MySQL password
    $database = "edusearch";

    $conn = mysqli_connect($servername, $usernameDB, $passwordDB, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the admin data from the database
        $row = mysqli_fetch_assoc($result);

        // Set the logged-in user in the session
        $_SESSION['loggedInUser'] = $row['username'];

        // Redirect to the admin dashboard or another page
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password'); window.location.href = 'adminLoginPage.php';</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
