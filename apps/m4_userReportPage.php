<?php
session_start();
include './config/connection.php';

//user
$sql = "SELECT COUNT(*) as count FROM complaint WHERE Complaint_Status = 'In Investigation'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$investigationcount = $row['count'];

//expert
$sql = "SELECT COUNT(*) as count FROM complaint WHERE Complaint_Status = 'On Hold'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$holdcount = $row['count'];

//admin
$sql = "SELECT COUNT(*) as count FROM complaint WHERE Complaint_Status = 'Resolved'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$resolvedcount = $row['count'];
?>

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
    <link rel="stylesheet" href="assets/css/module3.css">
</head>

<body>

    <!-- navbar -->
    <nav class="d-flex justify-content-between fixed-top" id="navbarset">
        <div style="display: flex; align-items: center;">
            <div id="logofkedu">
                <img src="assets/img/logofkedusearch.png" alt="fkedusearch" id="logoedu">
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
                        <button class="btn fw-bolder btnusername" name="adminhome">COMPLAINT REPORT</button>
                    </div>
                </div>
                <br><br>
                <div class="d-flex justify-content-center">
                    <div class="list-group" style="width: 14rem;">
                        <br>
                        <a class="btn btn-primary text-white mb-2" href="./m4_userReportPage.php">USER REPORT</a>
                        <a class="btn btn-primary text-white mb-2" href="./m4_postReportPage.php">POST REPORT</a>
                        <a class="btn btn-primary text-white mb-2" href="./m4_complaintReportPage.php">COMPLAINT REPORT</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->
        <div id="maincontentpage">
            <div class="p-2 mb-1 bg-primary text-white">
                <h5 class="text-uppercase fw-bolder">COMPLAINT REPORT</h5>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <div>
                    <h3 class="fw-bolder">WELCOME TO FK-EduSearch(<em>Knowledge Sharing System</em>)</h3>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <label for="">Total In Investigation</label>
                            </div>
                            <div class="card-body">
                                <?php echo $investigationcount; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <label for="">Total On Hold</label>
                            </div>
                            <div class="card-body">
                                <?php echo $holdcount; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <label for="">Total Resolved</label>
                            </div>
                            <div class="card-body">
                                <?php echo $resolvedcount; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 my-3">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="assets/js/javascript.js" defer></script>
    <script src="assets/js/module3js.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['In Investigation', 'On Hold', 'Resolved'],
                datasets: [{
                    label: 'Total',
                    data: [<?php echo $investigationcount ?>, <?php echo $holdcount ?>, <?php echo $resolvedcount ?>],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>