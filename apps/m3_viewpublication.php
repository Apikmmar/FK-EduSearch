<?php
    session_start();
    require "config/connection.php";

    if (isset($_SESSION['Expert_ID'])) {
        $expertId = $_SESSION['Expert_ID'];
    }

    // $expertId = 1; //dummy data
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
                        <button class="btn fw-bolder btnusername" id="experthomebutton">HOME</button>
                    </div>
                </div>
                <br><br>
                <div class="d-flex justify-content-center">
                    <div class="list-group" style="width: 14rem;">
                        <br>
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="updateexpertise">UPDATE EXPERTISE</button>
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="managepost">MANAGE POST</button>
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="myrating">MY RATING</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->
        <div id="maincontentpage">
            <div class="d-flex p-2 mb-1 bg-primary text-white">
                <button class="btn btn-transparent btn-sm" name="updateexpertise">
                    <img src="assets/img/return.png" alt="back" style="width: 30px;">
                </button>
                <h5 class="text-uppercase fw-bolder" style="margin-top:5px;">VIEW PUBLICATION</h5>
            </div>
            <div>
                <div style="margin: 30px 0px 0px 30px;">
                    <div>
                        <?php
                            $stmt = $conn->prepare("SELECT COUNT(*) AS count, Publication_Title FROM publication WHERE Expert_ID = :expertId GROUP BY Publication_Title");
                            $stmt->bindParam(':expertId', $expertId);
                            $stmt->execute();

                            $totalCount = 0;

                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $count = $row["count"];

                                $totalCount += $count;
                            }
                        ?>
                        <h5>TOTAL PUBLICATION IS <?php echo $totalCount; ?></h5>
                    </div>
                    <br>
                    <div style="width: 60%;">
                        <?php
                            // Prepare the SQL statement
                            $stmt = $conn->prepare("SELECT COUNT(*) AS count, YEAR(Publication_Date) AS publicationYear FROM publication WHERE Expert_ID = :expertId GROUP BY publicationYear");
                            $stmt->bindParam(':expertId', $expertId);
                            $stmt->execute();

                            $data = array();
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $count = $row["count"];
                                $year = $row["publicationYear"];

                                $data[$year] = $count;
                            }
                        ?>
                        <canvas id="yearChart"></canvas>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="assets/js/javascript.js" defer></script>
    <script src="assets/js/module3js.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    $(document).ready(function() {
        var data = <?php echo json_encode($data); ?>;

        // Prepare the data for the chart
        var labels = Object.keys(data);
        var years = [];
        var counts = [];

        // Extract the years and counts
        labels.forEach(function(label) {
            var count = data[label];
            years.push(label);
            counts.push(count);
        });

        // Create the chart
        var ctx = document.getElementById('yearChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: years,
                datasets: [{
                    label: 'Publication Count',
                    data: counts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#ccc'
                        },
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
    </script>
    </body>
</html>