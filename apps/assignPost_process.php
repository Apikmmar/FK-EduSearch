<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "module2";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $postTitle = $_POST["postTitle"];
    $postDescription = $_POST["postDescription"];


    // SQL query to insert the data into the "post" table
    $sql = "INSERT INTO post (postTitle, postDescription) VALUES ('$postTitle', '$postDescription')";


    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}




// Close the database connection
mysqli_close($conn);
?>




