<?php
// Assuming you have a MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "module2";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the form data
$rating = $_POST['w3review'];
$feedback = $_POST['feedBack'];

// Prepare and execute the SQL query to insert data into the "post" table
$sql = "INSERT INTO feedback (yourRating, feedBack) VALUES ('$rating', '$feedback')";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
