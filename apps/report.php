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
</html><style>
    #graphModule1 {
        max-width: 400px;
        margin: 0 auto;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "edusearch";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the data from the database
    $sql = 'SELECT COUNT(*) AS total_users FROM User';
    $result = $conn->query($sql);
    $totalUsers = ($result && $result->num_rows > 0) ? $result->fetch_assoc()['total_users'] : 0;

    $sql = 'SELECT COUNT(*) AS total_experts FROM Expert';
    $result = $conn->query($sql);
    $totalExperts = ($result && $result->num_rows > 0) ? $result->fetch_assoc()['total_experts'] : 0;

    // Close the database connection
    $conn->close();
    ?>

    var totalUsers = <?php echo $totalUsers; ?>;
    var totalExperts = <?php echo $totalExperts; ?>;

    var userGraphCanvas = document.getElementById('graphModule1');

    var userGraph = new Chart(userGraphCanvas, {
        type: 'bar',
        data: {
            labels: ['Total Users', 'Total Experts'],
            datasets: [{
                label: 'Number of Users',
                data: [totalUsers, totalExperts],
                backgroundColor: ['#36a2eb', '#ff6384'],
                borderColor: ['#36a2eb', '#ff6384'],
                borderWidth: 1,
                barThickness: 50
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 1.5,
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        drawBorder: false
                    },
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10
                }
            },
            categorySpacing: 0.2
        }
    });
</script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>