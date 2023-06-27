<?php
    session_start();
    require "config/connection.php";

    if (isset($_SESSION['Expert_ID'])) {
        $expertId = $_SESSION['Expert_ID'];
    }

    $expertId = 1; //dummy data
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
                <button class="btn btn-transparent btn-sm" name="myrating">
                    <img src="assets/img/return.png" alt="back" style="width: 30px;">
                </button>
                <h5 class="text-uppercase fw-bolder" style="margin-top: 5px;">VISUALIZE RATING</h5>
            </div>
            <div style="padding: 20px 0px 0px 40px">
                <div>
                    <h5 class="fw-bolder">YOUR RATING</h5>
                    <div class="d-flex">
                    <div id="ratebox">
                        <?php
                            $sql = "SELECT Rating_Val FROM rating WHERE Expert_ID = :expertId";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':expertId', $expertId);
                            $stmt->execute();

                            $totalRating = 0;
                            $rowCount = $stmt->rowCount();
                            while ($row2 = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $totalRating += $row2["Rating_Val"];
                            }
                            $averageRating = $rowCount > 0 ? $totalRating / $rowCount : 0;
                            $formattedRating = number_format($averageRating, 1);

                            if($totalRating = 0) {
                                $formattedRating = 0;
                            }

                            echo "<span class='h1 fw-bolder'>$formattedRating</span>";
                        ?>
                    </div>
                        &nbsp;&nbsp;&nbsp;
                        <img src="assets/img/star.png" alt="star" id="starshow">
                    </div>
                </div>
                <br>
                <div>
                    <?php echo "<span class='h2 fw-bolder'>Total Rating is $rowCount</span>"; ?>
                    <br>
                    <?php
                        $ratingCounts = array(0, 0, 0, 0, 0);
                        $sql = "SELECT COUNT(*) AS count, Rating_Val FROM rating WHERE Expert_ID = :expertId GROUP BY Rating_Val";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':expertId', $expertId);
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $rating = $row["Rating_Val"];
                            $count = $row["count"];

                            if ($rating >= 0 && $rating < 1) {
                                $ratingCounts[0] += $count;
                            } elseif ($rating >= 1 && $rating < 2) {
                                $ratingCounts[1] += $count;
                            } elseif ($rating >= 2 && $rating < 3) {
                                $ratingCounts[2] += $count;
                            } elseif ($rating >= 3 && $rating < 4) {
                                $ratingCounts[3] += $count;
                            } elseif ($rating >= 4 && $rating <= 5) {
                                $ratingCounts[4] += $count;
                            }
                        }
                    ?>
                    <div style="width: 70%;">
                        <canvas id="ratingChart"></canvas>
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
        $(document).ready(function() {
            var ratingChart;

            function createChart() {
                var chartCanvas = document.getElementById('ratingChart');
                var chartContainer = $('.chart-container');

                ratingChart = new Chart(chartCanvas, {
                    type: 'bar',
                    data: {
                        labels: ['0-1', '1-2', '2-3', '3-4', '4-5'],
                        datasets: [{
                            label: 'Total Ratings',
                            data: <?php echo json_encode($ratingCounts); ?>,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        },
                        maintainAspectRatio: false,
                        responsive: true
                    }
                });
                resizeChart();
            }

            function resizeChart() {
                var chartContainer = $('.chart-container');
                var containerWidth = chartContainer.width();
                var canvas = chartContainer.find('canvas');

                canvas.width(containerWidth);
                canvas.height(containerWidth * 0.6);

                ratingChart.resize();
            }

            $(window).on('resize', function() {
                resizeChart();
            });

            createChart();
        });
    </script>
</body>
</html>