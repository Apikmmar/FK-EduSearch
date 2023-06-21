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
    // Check if the update button is clicked
    if (isset($_POST['update'])) {
        $newStatus = $_POST['w3review'];

        // Update the post status in the database
        $updateQuery = "UPDATE post SET postStatus = '$newStatus' WHERE id = 1"; // Modify the query according to your database structure
        
        if ($mysqli->query($updateQuery)) {
            echo "Post status updated successfully";
        } else {
            echo "Error updating post status: " . $mysqli->error;
        }
    }
}

// Close the database connection
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head section code goes here -->
</head>
<body>
    <!-- HTML code for the rest of the page goes here -->

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <table class="table table-bordered" align="center">
            <thead>
                <tr style="background-color: #D3D3D3;">
                    <th scope="col" style="width: 100px;"><label for="postStatus"> Post Status </label></th>
                    <br>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <textarea id="w3review" name="w3review" rows="4" cols="120">Calculus, susah.</textarea>
                        <input type="submit" name="update" value="Update">
                        <input type="submit" name="delete" value="Delete">
                    </td>
                </tr>
            </tbody>
        </table>
    </form>

    <!-- JavaScript and other HTML code goes here -->

</body>
</html>
