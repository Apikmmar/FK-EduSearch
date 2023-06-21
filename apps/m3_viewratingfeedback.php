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
            <div class="p-2 mb-1 bg-primary text-white">
                <h5 class="text-uppercase fw-bolder">FEEDBACK AND RATING</h5>
            </div>
            <div style="padding: 20px 0px 0px 40px">
                <div>
                    <div>
                        <h5 class="fw-bolder">YOUR RATING</h5>
                        <div class="d-flex">
                            <div id="ratebox" >
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
                                ?>
                                <span class="h1 fw-bolder"><?php echo $formattedRating; ?></span>
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <img src="assets/img/star.png" alt="star" id="starshow">
                        </div>
                        <br>
                        <button type="btn" class="btn btn-secondary" name="rateview">VISUALIZE RATING</button>
                    </div>
                    <br><br>
                    <div>
                        <h5 class="fw-bolder">FEEDBACK</h5>
                        <div>
                        <?php
                            $sql = "SELECT R.Rating_Feedback, U.User_Name FROM rating R
                                    JOIN users U ON R.User_ID = U.User_ID
                                    WHERE R.Expert_ID = :expert_id";

                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':expert_id', $expertId, PDO::PARAM_INT);
                            $stmt->execute();

                            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            $counter = 0;

                            foreach ($results as $row) {
                                $ratingFeedback = $row['Rating_Feedback'];
                                $userName = $row['User_Name'];

                                echo '<div id="feedbackbox">';
                                echo '<p>' . $ratingFeedback . '</p>';
                                echo '<p style="float: right; padding-right: 10px;">FROM USER ' . $userName . '</p>';
                                echo '</div>';

                                $counter++;

                                if ($counter === 3) {
                                    break;
                                }
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <br>
                <button type="btn" class="btn fw-bolder btnusername" id="" name="viewallfeedrate">VIEW ALL<br>FEEDBACK</button>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="assets/js/javascript.js" defer></script>
    <script src="assets/js/module3js.js" defer></script>

    </body>
</html>