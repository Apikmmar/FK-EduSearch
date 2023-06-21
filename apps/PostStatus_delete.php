<?php
// Assuming you have already defined the database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'module2';

// Create a new MySQLi object and establish a connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the delete button is clicked
    if (isset($_POST['delete'])) {
        // Delete the post from the database
        $deleteQuery = "DELETE FROM post WHERE id = 1"; // Modify the query according to your database structure
        
        if ($mysqli->query($deleteQuery)) {
            echo "Post deleted successfully";
        } else {
            echo "Error deleting post: " . $mysqli->error;
        }
    }
}

// Close the database connection
$mysqli->close();
?>


    <!-- Head section code goes here -->
</head>
<body>
    <!-- HTML code for the rest of the page goes here -->

    
    <!-- JavaScript and other HTML code goes here -->

</body>
</html>
