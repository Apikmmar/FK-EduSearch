<?php
var_dump($_POST);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable error reporting
try {
    require '../Module1/config/db.php';

    if (isset($_POST['update'])) {
        $complaint_ID = $_GET['complaint_ID']; // Retrieve the Complaint_ID from the query parameter
    
        // Retrieve other updated fields from the form
        $complaint_type = $_POST['complaint_type'];
        $complaint_description = $_POST['complaint_description'];
    
        // Prepare the SQL statement
        $stmt = $conn->prepare('UPDATE complaint SET Complaint_Type = ?, Complaint_Description = ? WHERE Complaint_ID = ?');
        
    
        // Bind the parameters
        $stmt->bind_param('sss', $complaint_type, $complaint_description, $complaint_ID);
    
        // Execute the statement
        $stmt->execute();
    
        echo "<script>alert('Record updated successfully');</script>";
    } 

} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}

// Redirect back to the view page
header("Location: displayComplaintPage.php");
exit();
?>
