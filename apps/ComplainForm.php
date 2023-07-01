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

    </body>
</html>
<h4 class="fw-bolder d-flex align-items-center justify-content-center">Complaint Form</h4>

    <!-- Complaint form -->
    <div class="d-flex align-items-center justify-content-center" id="complaint-form">
        
        <form id="complaint-form" action="submit_complaint.php" method="POST">
            <div class="mb-3">
                <label for="complaint-id" class="form-label">ID:</label>
                <input type="text" class="form-control" id="complaint-id" name="complaint-id" required>
            </div>
            <div class="mb-3">
                <label for="complaint-date" class="form-label">Date:</label>
                <input type="text" class="form-control" id="complaint-date" name="complaint-date" required>
            </div>
            <div class="mb-3">
                <label for="complaint-email" class="form-label">Email:</label>
                <input type="text" class="form-control" id="complaint-email" name="complaint-email" required>
            </div>
            <div class="mb-3">
                <label for="complaint-password" class="form-label">Password:</label>
                <input type="text" class="form-control" id="complaint-password" name="complaint-password" required>
            </div>
            <div class="mb-3">
                <label for="complaint-phone-number" class="form-label">Phone Number:</label>
                <input type="text" class="form-control" id="complaint-phone-number" name="complaint-phone-number" required>
            </div>
            <div class="mb-3">
                <label for="complaint-type-complaint" class="form-label">Type of Complaint:</label>
                <input type="text" class="form-control" id="complaint-type-complaint" name="complaint-type-complaint" required>
            </div>
            <div class="mb-3">
                <label for="complaint-description" class="form-label">Complaint Desription:</label>
                <textarea class="form-control" id="complaint-description" name="complaint-description" rows="5" required></textarea>
            </div>

            <div>    
                <div id="push-buttons">
                    <button type="button" class="btn btn-primary" onclick="updateForm()">Update</button>
                    <button type="button" class="btn btn-secondary mr-2" onclick="resetForm()">Reset</button>
                    <button type="button" class="btn btn-secondary" onclick="cancelForm()">Cancel</button>
                </div>
            </div>
            
        </form>
    
    </div>
</div>
