<!-- FUNCTION BUT HAVE PROBLEM -->
<?php
    session_start();
    require "config/connection.php";

    if (isset($_SESSION['Expert_ID'])) {
        $expertId = $_SESSION['Expert_ID'];
    }

    $expertId = 1; //dummy data

    if (isset($_POST["submitprofileupdate"])) {
        // Get form input values
        $expertName = $_POST['Expert_Name'];
        $expertAge = $_POST['Expert_Age'];
        $expertAddress = $_POST['Expert_Address'];
        $expertHP = $_POST['Expert_HP'];
        $expertEmail = $_POST['Expert_Email'];
        $expertPassword = $_POST['Expert_Pass'];
        $expertCV = $_POST['Expert_CV'];

        // Update expert profile query
        $sql = "UPDATE expert e
                JOIN users u ON e.User_ID = u.User_ID
                SET u.User_Name = :expertName, e.Expert_Age = :expertAge, e.Expert_Address = :expertAddress, e.Expert_HP = :expertHP, 
                    u.User_Email = :expertEmail, u.User_Password = :expertPassword, e.Expert_CV_FilePath = :expertCV
                WHERE e.Expert_ID = :expertId";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Bind the updated values
        $stmt->bindParam(':expertName', $expertName);
        $stmt->bindParam(':expertAge', $expertAge);
        $stmt->bindParam(':expertAddress', $expertAddress);
        $stmt->bindParam(':expertHP', $expertHP);
        $stmt->bindParam(':expertEmail', $expertEmail);
        $stmt->bindParam(':expertPassword', $expertPassword);
        $stmt->bindParam(':expertCV', $expertCV);
        $stmt->bindParam(':expertId', $expertId);

        // Execute the update
        if ($stmt->execute()) {
            echo "<script>alert('Profile is updated');window.location.href='m3_updateexpertise.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to update profile');</script>";
        }
    } elseif (isset($_POST["submitaddpublication"])) {
        // Insert publication
        $Publication_Title = $_POST['Publication_Title'];
        $Publication_Date = $_POST['Publication_Date'];
        
        // Insert publication query
        $insertStmt = $conn->prepare("INSERT INTO publication (Publication_Title, Publication_Date, Expert_ID) VALUES (:title, :date, :expertId)");
        $insertStmt->bindParam(':title', $Publication_Title);
        $insertStmt->bindParam(':date', $Publication_Date);
        $insertStmt->bindParam(':expertId', $expertId);
        
        if ($insertStmt->execute()) {
            echo "<script>alert('Publication added successfully');window.location.href='m3_updateexpertise.php';</script>";
        } else {
            echo "<script>alert('Failed to add publication');</script>";
        }
    } elseif (isset($_POST["submitaddsocmed"])) {
        // Insert social media
        $SMA_Username = $_POST['SMA_Username'];
        $SMA_AccType = $_POST['SMA_AccType'];
        
        // Insert social media query
        $insertStmt = $conn->prepare("INSERT INTO socmedacc (SMA_Username, SMA_AccType, Expert_ID) VALUES (:username, :accType, :expertId)");
        $insertStmt->bindParam(':username', $SMA_Username);
        $insertStmt->bindParam(':accType', $SMA_AccType);
        $insertStmt->bindParam(':expertId', $expertId);
        
        if ($insertStmt->execute()) {
            echo "<script>alert('Social media entry added successfully');window.location.href='m3_updateexpertise.php';</script>";
        } else {
            echo "<script>alert('Failed to add social media entry');</script>";
        }
    }
    
    // NOT DELETE DATA IN DB
    if (isset($_POST["deletepublication"])) {
        $publicationId = $_POST["Publication_ID"];
    
        // Delete publication query
        $deleteStmt = $conn->prepare("DELETE FROM publication WHERE Publication_ID = :publicationId AND Expert_ID = :expertid");
        $deleteStmt->bindParam(':publicationId', $publicationId);
        $deleteStmt->bindParam(':expertid', $expertId);
        
        if ($deleteStmt->execute()) {
            echo "<script>alert('Publication deleted');window.location.href='m3_updateexpertise.php';</script>";
        } else {
            echo "<script>alert('Failed to delete publication');</script>";
        }

    } elseif(isset($_POST["deletesocmed"])) {
        $socmedAccId = $_POST["SMA_ID"];

        // Delete social media account query
        $deleteStmt = $conn->prepare("DELETE FROM socmedacc WHERE SMA_ID = :socmedAccId AND Expert_ID = :expertId");
        $deleteStmt->bindParam(':socmedAccId', $socmedAccId);
        $deleteStmt->bindParam(':expertId', $expertId);

        if ($deleteStmt->execute()) {
            echo "<script>alert('Social media account deleted');window.location.href='m3_updateexpertise.php';</script>";
        } else {
            echo "<script>alert('Failed to delete social media account');</script>";
        }
    } 
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
                <h5 class="text-uppercase fw-bolder" style="margin-top:5px;">UPDATE EXPERTISE</h5>
            </div>
            <div>
                <div style="margin: 30px 0px 0px 30px;">
                    <div>
                        <form action="m3_updateexpertise.php" method="post">
                            <h5 class="text-uppercase fw-bolder" style="padding-bottom: 20px;">PROFILE</h5>
                            <?php
                                $sql = "SELECT e.*, u.* FROM expert e 
                                        JOIN users u ON e.User_ID = u.User_ID
                                        WHERE e.Expert_ID = :expertId";
                    
                                $stmt = $conn->prepare($sql);
                                $stmt->bindParam(":expertId", $expertId, PDO::PARAM_INT);
                                $stmt->execute();
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                $row = $result[0];

                                $Expert_Name = $row['User_Name'];
                                $Expert_Age = $row['Expert_Age'];
                                $Expert_Address = $row['Expert_Address'];
                                $Expert_HP = $row['Expert_HP'];
                                $Expert_Email = $row['User_Email'];
                                $Expert_Password = $row['User_Password'];
                                $Expert_CV = $row['Expert_CV_FilePath'];
                            ?>
                            <div class="d-flex flex-row">
                                <div style="width: 600px">
                                    <div>
                                        <label class="h6">Expert ID :</label>&nbsp;&nbsp;&nbsp;
                                        <p class="h6" style="margin: 0; display: inline;"><?php echo $expertId; ?></p>
                                    </div>
                                    <div style="padding-top: 15px;">
                                        <label>Expert Name :</label>&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Expert Name" value="<?php echo htmlspecialchars($Expert_Name) ?>" name="Expert_Name" >
                                    </div>
                                    <div style="padding-top: 15px;">
                                        <label>Expert Age :</label>&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Expert Age" value="<?php echo htmlspecialchars($Expert_Age) ?>" name="Expert_Age" >
                                    </div>
                                    <div style="padding-top: 15px;">
                                        <label>Expert Email :</label>&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Expert Email" value="<?php echo htmlspecialchars($Expert_Email) ?>" name="Expert_Email" >
                                    </div>
                                </div>
                                <div style="width: 600px">
                                    <div>
                                        <label>Expert Address :</label>&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Expert Address" value="<?php echo htmlspecialchars($Expert_Address) ?>" name="Expert_Address" >
                                    </div>
                                    <div style="padding-top: 15px;">
                                        <label>Expert Phone Number :</label>&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Expert Phone Number" value="<?php echo htmlspecialchars($Expert_HP) ?>" name="Expert_HP" >
                                    </div>
                                    <div style="padding-top: 15px;">
                                        <label>Expert Password :</label>&nbsp;&nbsp;&nbsp;
                                        <input type="text" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Expert Password" value="<?php echo htmlspecialchars($Expert_Password) ?>" name="Expert_Pass" >
                                    </div>
                                    <div style="padding-top: 15px;">
                                        <label>Expert CV :</label>&nbsp;&nbsp;&nbsp;
                                        <input class="form-control form-control-sm" id="inputboxstyle" type="file"placeholder="Enter Expert CV" value="<?php echo htmlspecialchars($Expert_CV) ?>" name="Expert_CV" >
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary" name="submitprofileupdate">UPDATE PROFILE</button>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="reset" class="btn btn-danger" name="reset">RESET ALL</button>
                            </div>
                            <br>
                            <div>
                                <h5 class="text-uppercase fw-bolder" style="padding-bottom: 15px;">CREDENTIALS</h5>
                                <h6 class="text-uppercase fw-bolder">CURRENT RESEARCH AREA :</h6>
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM research_area WHERE expert_id = :expertId");
                                    $stmt->bindParam(':expertId', $expertId);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    $row = $result[0];
                                    $ResearchArea = $row['ResearchArea_Name'];
                                ?>
                                <input type="text" class="form-control fw-bolder text-uppercase" id="inputboxstyle" value="<?= $ResearchArea ?>" disabled>
                            </div>
                            <br>
                            <div>
                                <h6 class="text-uppercase fw-bolder">PUBLICATION</h6>
                                <table style="width:60%;" class="table table-bordered" align="center">
                                <thead>
                                    <tr style="background-color: #D3D3D3;">
                                        <th scope="col"style="width: 50px;">No</th>
                                        <th scope="col"style="width: 100px;">Date</th>
                                        <th scope="col"style="width: 300px;">Publication</th>
                                        <th scope="col"style="width: 40px;">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM publication WHERE Expert_ID = :expertId");
                                    $stmt->bindParam(':expertId', $expertId);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $counter = 0;
                                ?>

                                <?php
                                    foreach ($result as $row): 
                                    $counter++;
                                ?>
                                    <tr>
                                        <td><?= $counter ?></td>
                                        <td><?= $row['Publication_Date'] ?></td>
                                        <td><?= $row['Publication_Title'] ?></td>
                                        <td class="d-flex justify-content-around">
                                            <button class="btn btn-transparent" name="deletepublication">
                                                <img src="assets/img/dustbin.png" alt="view" class="imgintable">
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                </table>
                                <div style="padding-top: 10px;">
                                    <label>Publication Name :</label>&nbsp;&nbsp;&nbsp;
                                    <input type="text" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Publication Name" name="Publication_Title" >
                                </div>
                                <div style="padding-top: 15px;">
                                    <label>Publication Date :</label>&nbsp;&nbsp;&nbsp;
                                    <input type="date" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Publication Date" name="Publication_Date">
                                    <em>yyyy-mm-dd</em>
                                </div>
                                <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary" name="submitaddpublication">ADD PUBLICATION</button>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="reset" class="btn btn-secondary" name="gotovisualpublication">VISUALIZE PUBLICATION</button>
                                </div>
                            </div>
                            <br>
                            <div>
                                <h5 class="text-uppercase fw-bolder">SOCIAL MEDIA</h5>
                                <table style="width:50%;" class="table table-bordered" align="center">
                                <thead>
                                    <tr style="background-color: #D3D3D3;">
                                        <th scope="col"style="width: 50px;">No</th>
                                        <th scope="col"style="width: 100px;">Username</th>
                                        <th scope="col"style="width: 100px;">Type</th>
                                        <th scope="col"style="width: 40px;">DELETE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $stmt = $conn->prepare("SELECT * FROM socmedacc WHERE Expert_ID = :expertId");
                                    $stmt->bindParam(':expertId', $expertId);
                                    $stmt->execute();
                                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    $counter = 0;
                                ?>

                                <?php
                                    foreach ($result as $row): 
                                    $counter++;
                                ?>
                                    <tr>
                                        <td><?= $counter ?></td>
                                        <td><?= $row['SMA_AccType'] ?></td>
                                        <td><?= $row['SMA_Username'] ?></td>
                                        <td class="d-flex justify-content-around">
                                            <button class="btn btn-transparent" name="deletesocmed">
                                                <img src="assets/img/dustbin.png" alt="view" class="imgintable">
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                                </table>
                                <br>
                                <h6>ADD SOCIAL MEDIA ACCOUNT</h6>
                                <div style="padding-top: 10px;">
                                    <label>Username :</label>&nbsp;&nbsp;&nbsp;
                                    <input type="text" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Username" name="SMA_Username" >
                                </div>
                                <div style="padding-top: 10px;">
                                    <label>Social Media Type :</label>&nbsp;&nbsp;&nbsp;
                                    <input type="text" class="form-control form-control-sm" id="inputboxstyle" placeholder="Enter Social Media Type" name="SMA_AccType" >
                                    &nbsp;&nbsp;&nbsp;
                                    <button type="submit" class="btn btn-primary" name="submitaddsocmed">ADD SOCIAL MEDIA</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="assets/js/javascript.js" defer></script>
    <script src="assets/js/module3js.js" defer></script>

    </body>
</html>