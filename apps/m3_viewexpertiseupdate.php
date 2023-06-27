<?php
    session_start();
    require "config/connection.php";

    if (isset($_SESSION['Admin_ID'])) {
        $adminId = $_SESSION['Admin_ID'];
    }

    $adminId = 444; //dummy data
    $expertId = 1; //dummy data

    $stmt = $conn->prepare("SELECT U.User_Name FROM Users U INNER JOIN Admin A ON U.User_ID = A.User_ID WHERE A.User_ID = :adminId");
    $stmt->bindParam(':adminId', $adminId, PDO::PARAM_INT);
    $stmt->execute();

    $username = $stmt->fetchColumn();
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
                <button type="button" class="btn fw-bolder btnusername" style="width: 150px" id=""><?php echo "$username"; ?></button>
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
                        <button class="btn fw-bolder btnusername" name="adminhome">HOME</button>
                    </div>
                </div>
                <br><br>
                <div class="d-flex justify-content-center">
                    <div class="list-group" style="width: 14rem;">
                        <br>
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="expertupdate">EXPERTISE UPDATE</button>
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="assignpost">ASSIGN POST</button>
                        <button class="btn fw-bolder mb-2 btnusername" id="" name="allrating">ALL RATING</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->
        <div id="maincontentpage">
            <div class="d-flex p-2 mb-1 bg-primary text-white">
                <button class="btn btn-transparent btn-sm" name="backtoexpertiseupdate">
                    <img src="assets/img/return.png" alt="back" style="width: 30px;">
                </button>
                <h5 class="text-uppercase fw-bolder" style="margin-top:5px;">EXPERTISE UPDATE</h5>
            </div>
            <div>
                <div style="padding: 30px 0px 0px 30px">
                    <h4 class="text-uppercase  fw-bolder">EXPERT ID :</h4>
                    <h4 class="text-uppercase fw-bolder">EXPERT NAME :</h4>
                    <h4 class="text-uppercase fw-bolder">UPDATE TYPE :</h4>
                </div>
                <div style="padding-top: 30px;">
                    <table class="table table-bordered" align="center">
                    <thead>
                        <tr style="background-color: #D3D3D3;">
                            <th scope="col"style="width: 50px;">No</th>
                            <th scope="col"style="width: 100px;">Type</th>
                            <th scope="col"style="width: 150px;">Old Data</th>
                            <th scope="col"style="width: 150px;">New Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Mark</td>
                            <td>Mark</td>
                            <td>Mark</td>
                            <td>Mark</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary btn-lg fw-bold">APPROVE</button>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger btn-lg fw-bold">REJECT</button>
            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="assets/js/javascript.js" defer></script>
    <script src="assets/js/module3js.js" defer></script>

    </body>
</html>


