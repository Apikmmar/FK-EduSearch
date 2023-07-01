<?php
session_start(); // Start the session

// Check if the user is already logged in
if (isset($_SESSION['loggedInUser'])) {
    // Redirect to the appropriate dashboard or another page based on user type
    $userType = $_SESSION['loggedInUser'];
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
    $sql = "SELECT * FROM users WHERE User_Name = '$username' AND User_Password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Fetch the user data from the database
        $row = mysqli_fetch_assoc($result);
        $userType = $row['User_Role'];

        // Set the logged-in user in the session
        $_SESSION['loggedInUser'] = array(
            'username' => $username,
            'userType' => $userType
        );

        // Redirect to the appropriate dashboard or another page based on user type
        if ($userType == 0) {
            header("Location: student_dashboard.php");
            exit();
        } elseif ($userType == 1) {
            header("Location: lecturer_dashboard.php");
            exit();
        }
    } else {
        // Display an alert message for invalid username or password
        echo "<script>alert('Invalid username or password'); window.location.href = 'userLoginPage.php';</script>";
        exit();
    }

    // Close the database connection
    mysqli_close($conn);
}
