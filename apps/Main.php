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

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="assets/js/javascript.js" defer></script>
    <script src="assets/js/module3js.js" defer></script>

    <h4 class="fw-bolder d-flex align-items-center justify-content-center">Complaint</h4>

    <section data-bs-version="5.1" class="features23 cid-tGlXRxw7hZ" id="features23-15">
    <div class="container">
        <div class="card-wrapper">
            <div class="card-box align-left">
            </div>
        </div>
        <!-- col-12 col-md-6 col-lg-4 -->
        <div class="row justify-content-center content-row mt-4">
            <div class="card p-4 p-md-3 col-md-6 col-lg-4">
                <div class="card-box">
                    <div class="title">
                    <?php
                    try {
                        require './db_connection.php';

                        // Get total user count
                        $stmt = $conn->prepare('SELECT COUNT(*) AS total_complaint FROM complaint');
                        $stmt->execute();
                        $stmt->bind_result($totalComplaint);

                        if ($stmt->fetch()) {
                            echo '<span class="num mbr-fonts-style display-1"><strong>' . $totalComplaint . '</strong></span>';
                        } else {
                            echo 'Error: Unable to fetch the total complaint count.';
                        }

                        $stmt->close();
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                    ?>

                    </div>
                    <h4 class="card-title mbr-fonts-style display-5"><strong>Total Complaint</strong></h4>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Complaint List -->
    <div class="d-flex align-items-center justify-content-center" id="complaint-list">

        <form id="complaint-list" action="submit_complaint.php" method="POST"></form>

    </div>
    <div class="table-container">
    <section data-bs-version="5.1" class="content15 cid-tGraXulyro" id="content15-1e"> 
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="card col-md-12 col-lg-12">
                <div class="card-wrapper">
                    <div class="card-box align-left">
                        <h4 class="card-title mbr-fonts-style mbr-white mb-3 display-5"><strong>Status</strong></h4>
                        <?php
try {
    require './db_connection.php';

    // Retrieve data from the complaint table
    $stmt = $conn->prepare('SELECT * FROM complaint');
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<table>';
    echo '<tr style="background-color: blue;">';
    echo '<th class="text-center">No.</th>'; // Add a new column for the number of complaints
    echo '<th class="text-center">Complaint Type</th>';
    echo '<th class="text-center">Description</th>';
    echo '<th class="text-center">Submit Date</th>';
    echo '<th class="text-center">Status</th>';
    echo '<th class="text-center">User ID</th>';
    echo '<th class="text-center">Actions</th>'; // Add a new column for actions
    echo '</tr>';

    // Fetch and display the data if available
    if (mysqli_num_rows($result) > 0) {
        $complaintCount = 1; // Initialize the complaint count
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td class="text-center">' . $complaintCount . '</td>'; // Display the complaint count in the table
            echo '<td>' . $row['Complaint_Type'] . '</td>';
            echo '<td>' . $row['Complaint_Description'] . '</td>';
            echo '<td>' . $row['Complaint_DateSubmit'] . '</td>';
            echo '<td>' . $row['Complaint_Status'] . '</td>';
            echo '<td>' . $row['User_ID'] . '</td>';
            echo '<td>';
            echo '<a href="updatePage.php?id=' . $row['Complaint_ID'] . '" class="btn btn-primary btn-sm">EDIT</a>';
            echo '</td>';
            echo '</tr>';

            $complaintCount++; // Increment the complaint count
        }
    } else {
        // Display a message if no records are found
        echo '<tr>';
        echo '<td colspan="7">No records found.</td>';
        echo '</tr>';
    }

    // End the table
    echo '</table>';

    // Close the statement
    $stmt->close();

} catch (PDOException $e) {
    echo $e->getMessage();
}
?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <div class="d-flex align-items-center justify-content-center" id="complaint-form">
    <div>    
                <div id="push-buttons">
                    <button type="button" class="btn btn-primary" onclick="updateForm()">Update</button>
                    <button type="button" class="btn btn-secondary mr-2" onclick="resetForm()">Reset</button>
                    <button type="button" class="btn btn-secondary" onclick="cancelForm()">Cancel</button>
                </div>
            </div>
                         
                            </div>
    </div>
    </div>
    </body>
    </html>
