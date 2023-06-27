<?php
try {
    require './db_connection.php';
    if (isset($_POST['create'])) {
        // Get the user input from the form
        $complaint_type = $_POST['complaint_type'];
        $complaint_description = $_POST['complaint_description'];
        $complaint_dateSubmit = $_POST['complaint_dateSubmit'];
        $complaint_status = $_POST['complaint_status'];

        // Prepare the SQL statement
        $stmt = $conn->prepare('INSERT INTO complaint (Complaint_Type, Complaint_Description, Complaint_DateSubmit, Complaint_Status) VALUES (?, ?, ?, ?)');

        // Bind the parameters
        $stmt->bind_param('ssss', $complaint_type, $complaint_description, $complaint_dateSubmit, $complaint_status);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();

        echo "<script>alert('New record created successfully'); window.location.href='displayComplaintPage.php';</script>";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
}

$conn->close();
?>


