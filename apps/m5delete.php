<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Enable error reporting
try {
    require '../Module1/config/db.php';

    if (isset($_GET['Complaint_ID'])) {
        $complaint_ID = $_GET['Complaint_ID']; // Retrieve the Complaint_ID from the query parameter

        // Prepare the SQL statement
        $stmt = $conn->prepare('DELETE FROM complaint WHERE Complaint_ID = ?');

        // Bind the parameter
        $stmt->bind_param('s', $complaint_ID);

        // Execute the statement
        $stmt->execute();

        // Check if any row was affected by the deletion
        if ($stmt->affected_rows > 0) {
            echo "<script>alert('Record deleted successfully');</script>";
        } else {
            echo "<script>alert('Record not found');</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>alert('Invalid Complaint ID');</script>";
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}

// Redirect back to the view page
header("Location: displayComplaintPage.php");
exit();
?>
