<!-- NOT PRINT TIME YET -->
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
                <button type="btn" class="btn fw-bolder btnusername" id="">USERNAME</button>
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
                <h5 class="text-uppercase fw-bolder">POST</h5>
            </div>
            <div style="padding-top: 20px;">
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                    <?php
                        $sql = "SELECT Post_ID, Post_Title, Post_Description FROM post WHERE expert_id = :expert_id AND Post_Status = 'Post Assign'"; //Post_Status = 'NEW POST'
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':expert_id', $expertId, PDO::PARAM_INT);
                        $stmt->execute();

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $post_id = $row['Post_ID'];
                    ?>
                        <div id="postingbox">
                            <div class="d-flex justify-content-between" id="postingboxpadset1">
                                <h5 id="postingboxpadset2" class="fw-bolder">NEW POST!</h5>
                                <div id="postingboxpadset3">time remaining: <?php echo "hh:mm"; ?></div>
                            </div>
                            <hr>
                            <h6 name="Post_Title"><?php echo $row['Post_Title']; ?></h6>
                            <p name="Post_Description"><?php echo $row['Post_Description']; ?></p>
                            <?php
                                $queryParams = array('Post_ID' => $post_id);
                                $url = 'm3_respondpost.php?' . http_build_query($queryParams);
                            ?>
                            <a href="<?php echo $url; ?>" class="btn fw-bolder btnanspost btnusername" id="respondpost">ANSWER NOW</a>
                        </div>
                        <br>
                    <?php
                        }
                    ?>
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