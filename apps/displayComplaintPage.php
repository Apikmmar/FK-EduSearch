<!-- Content -->
<link rel="stylesheet" href="style.css">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FK-EduSearch</title>
    <link rel="shortcut icon" href="assets/img/Emblem_of_Universiti_Malaysia_Pahang.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="asstes/css/module3.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="assets/js/javascript.js" defer></script>
    <script src="assets/js/module3js.js" defer></script>
</head>
<body>

    <!-- navbar -->
    <nav class="d-flex justify-content-between fixed-top" id="navbarset">
        <div style="display: flex; align-items: center;">
            <div id="logofkedu">
                <img src="assets/img/logofkedusearch.png" alt="fkedusearch"  id="logoedu">
                &nbsp;
                <h6 class="text-dark fw-bolder">FK-EduSearch</h6>
            </div>
            <div>
                <button class="navbar-button" id="menu-toggle">&#9776;</button>
            </div>
        </div>
        <div style="display: flex; align-items: center;">
            <div>
                <button type="button" class="btn fw-bolder btnusername" id="">USERNAME</button>
            </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <div>
                <button class="navbar-button">
                    <img src="assets/img/logout.png" alt="logout" id="navbarimg">
                </button>
            </div>
            &nbsp;&nbsp;
        </div>
    </nav>

    <div class="contentpart">
        <!-- sidebar -->
        <div class="sidenav" id="sidenavigation">
            <div>
                <div class="d-flex justify-content-center">
                    <div class="list-group" style="width: 14rem;">
                        <br>
                        <button class="btn fw-bolder btnusername" id="" onclick="window.location.href='m2_homepage.php';">HOME</button>
                    </div>
                </div>
                <br><br>
                <div class="d-flex justify-content-center">
                    <div class="list-group" style="width: 14rem;">
                        <br>
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="Profile">Profile</button>
                        <br>
                        <!-- <a href="m2_userDiscussionBoard.php"> -->
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="Discussion Board" onclick="window.location.href='m2_userDiscussionBoard.php';">Discussion Board</button>
                        <!-- <a href="m2_userReports.php"> -->
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="Reports" onclick="window.location.href='m2_userReports.php';">Reports</button>
                        <!-- <a href="m2_userRating&Feedback.php"> -->
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="Rating & Feedback"onclick="window.location.href='m2_userRating&Feedback.php';">Rating & Feedback</button>
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <?php
try {
    require './db_connection.php';

    // Retrieve the complaints from the database
    $stmt = $conn->prepare('SELECT * FROM complaint');
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if there are any complaints
    if ($result->num_rows > 0) {
        echo '<h4>Complaints</h4>';
        echo '<table class="complaint-table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Type</th>';
        echo '<th>Description</th>';
        echo '<th>Date</th>';
        echo '<th>Status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        // Loop through each complaint and display the details
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['Complaint_ID'] . '</td>';
            echo '<td>' . $row['Complaint_Type'] . '</td>';
            echo '<td>' . $row['Complaint_Description'] . '</td>';
            echo '<td>' . $row['Complaint_DateSubmit'] . '</td>';
            echo '<td>' . $row['Complaint_Status'] . '</td>';
            echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
    } else {
        echo 'No complaints found.';
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

<style>
    .complaint-table {
        width: 100%;
        border-collapse: collapse;
    }

    .complaint-table th,
    .complaint-table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .complaint-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
</style>


</body>
</html>