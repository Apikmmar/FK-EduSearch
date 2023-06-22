<!-- FUNCTION BUT HAVE PROBLEM -->
<!-- NOT PRINT TIME YET -->
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
                <button class="btn btn-transparent btn-sm" name="managepost">
                    <img src="assets/img/return.png" alt="back" style="width: 30px;">
                </button>
                <h5 class="text-uppercase fw-bolder" style="margin-top:5px;">RESPOND POST</h5>
            </div>
            <div style="padding-top: 20px;">
                <div class="d-flex justify-content-center align-items-center">
                    <div id="postingbox">
                        <div class="d-flex justify-content-between" id="postingboxpadset1">
                            <h5 id="postingboxpadset2" class="fw-bolder">NEW POST!</h5>
                            <div id="postingboxpadset3">time remaining : hh:mm</div>
                        </div>
                        <hr>
                        <?php
                            if (isset($_GET['Post_ID'])) {
                                $Post_ID = $_GET['Post_ID'];

                                $sql = "SELECT Post_Title, Post_Description FROM post WHERE Expert_ID = :Expert_ID AND Post_ID = :Post_ID";
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(':Expert_ID', $expertId);
                                $stmt->bindParam(':Post_ID', $Post_ID);
                                $stmt->execute();

                                $Post_ID = '';
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    // $Post_ID = $row['Post_ID'];
                                    echo "<h6 name='Post_Title'>" . $row['Post_Title'] . "</h6>";
                                    echo "<p name='Post_Description'>" . $row['Post_Description'] . "</p>";
                                }
                            }
                        ?>
                    </div>
                </div>
                <br><br>
                <div align="center">
                    <h5 class="fw-bolder">ANSWER POST</h5>
                    <form action="m3_respondpost.php" method="POST">
                        <input type="text" class="form-control form-control-sm" id="titlerespond" placeholder="Enter Respond Title" name="PA_Title" required>
                        <br>
                        <textarea class="respondexpert" placeholder="Enter your respond" name="PA_Desc" required></textarea>
                        <br><br>
                        <button type="submit" class="btn fw-bolder" id="btnusername" name="submitrespond">POST NOW</button>

                        <?php
                            if (isset($_POST['submitrespond'])) {
                                $PA_Title = $_POST["PA_Title"];
                                $PA_Desc = $_POST["PA_Desc"];

                                // FUNCTION BUT Post_ID not save to table postanswer then not Post_Status not update
                                $stmt = $conn->prepare("INSERT INTO postanswer (PA_Title, PA_Desc, Post_ID, Expert_ID) VALUES (:PA_Title, :PA_Desc, :Post_ID, :Expert_ID)");
                                $stmt->bindParam(':PA_Title', $PA_Title);
                                $stmt->bindParam(':PA_Desc', $PA_Desc);
                                $stmt->bindParam(':Post_ID', $Post_ID);
                                $stmt->bindParam(':Expert_ID', $expertId);
                                $stmt->execute();

                                $updatePostStatus = "UPDATE post SET Post_Status = 'Post Answered' WHERE Post_ID = :Post_ID";
                                $updateStmt = $conn->prepare($updatePostStatus);
                                $updateStmt->bindParam(':Post_ID', $Post_ID, PDO::PARAM_INT);
                                $updateStmt->execute();
                                
                                $currentDate = date('Y-m-d');
                                $updateInteractionStmt = $conn->prepare("UPDATE expert SET Expert_LastInteractionDate = :currentDate WHERE Expert_ID = :Expert_ID");
                                $updateInteractionStmt->bindParam(':currentDate', $currentDate);
                                $updateInteractionStmt->execute();

                                echo "<script>alert('Your Respond Is Submit'); window.location.href='m3_acceptpost.php';</script>";
                            }
                        ?>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="assets/js/javascript.js" defer></script>
    <script src="assets/js/module3js.js" defer></script>

</body>

</html>