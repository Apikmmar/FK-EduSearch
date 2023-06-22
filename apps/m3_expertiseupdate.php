<?php
    session_start();
    require "config/connection.php";

    if (isset($_SESSION['Admin_ID'])) {
        $adminId = $_SESSION['Admin_ID'];
    }

    $adminId = 1; //dummy data
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
            <div class="p-2 mb-1 bg-primary text-white">
                <h5 class="text-uppercase fw-bolder">EXPERTISE UPDATE</h5>
            </div>
            <div>
                <div>
                    <div>
                        <table class="table table-bordered" align="center">
                        <thead>
                            <tr style="background-color: #D3D3D3;">
                                <th scope="col"style="width: 50px;">No</th>
                                <th scope="col"style="width: 100px;">Expert ID</th>
                                <th scope="col"style="width: 400px;">Expert Name</th>
                                <th scope="col"style="width: 150px;">Expert Status</th>
                                <th scope="col"style="width: 200px;">Last Interaction Date</th>
                                <th scope="col"style="width: 250px;">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $counter = 0;

                                $stmt = $conn->prepare("SELECT e.Expert_ID, e.Expert_Status, e.Expert_LastInteractionDate, u.User_Name FROM expert e JOIN users u WHERE e.User_ID = u.User_ID");
                                $stmt->execute();

                                $expertList = $stmt->fetchAll();

                                foreach ($expertList as $expertRow) {
                                    $counter++;
                                    $Expert_ID = $expertRow['Expert_ID'];
                                    $Expert_Status = $expertRow['Expert_Status'];
                                    $Expert_LastInteractionDate = $expertRow['Expert_LastInteractionDate'];
                                    $Expert_Name = $expertRow['User_Name'];

                                    $formattedDate = date('d F Y', strtotime($Expert_LastInteractionDate));
                            ?>
                            <tr>
                                <td> <?php echo $counter; ?></td>
                                <td> <?php echo $Expert_ID; ?></td>
                                <td> <?php echo $Expert_Name; ?></td>
                                <td> <?php echo $Expert_Status; ?></td>
                                <td> <?php echo $formattedDate; ?></td>
                                <td class="d-flex justify-content-around">
                                    <button class="btn btn-transparent" name="viewexpertiseupdatedetail">
                                        <img src="assets/img/evaluation.png" alt="view" class="imgintable">
                                    </button>
                                    <button class="btn btn-transparent">
                                        <img src="assets/img/approved.png" alt="approve" class="imgintable">
                                    </button>
                                    <button class="btn btn-transparent">
                                        <img src="assets/img/rejected.png" alt="delete" class="imgintable">
                                    </button>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                        </table>
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


