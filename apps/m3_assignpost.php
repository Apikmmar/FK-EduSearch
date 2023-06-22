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
                <h5 class="text-uppercase fw-bolder">ASSIGN POST</h5>
            </div>
            <div>
                <div>
                    <div>
                        <table class="table table-bordered" align="center">
                        <thead>
                            <tr style="background-color: #D3D3D3;">
                                <th scope="col"style="width: 50px;">No</th>
                                <th scope="col"style="width: 150px;">Post ID</th>
                                <th scope="col"style="width: 150px;">Post Title</th>
                                <th scope="col"style="width: 150px;">Post Status</th>
                                <th scope="col"style="width: 200px;">Assign Expert</th>
                                <th scope="col"style="width: 80px;">Asign</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = $conn->prepare("SELECT Post_ID, Post_Title, Post_Status FROM post");
                                $stmt->execute();

                                $results = $stmt->fetchAll();

                                $counter = 0;

                                foreach ($results as $row) {
                                    $counter++;
                                    $Post_ID = $row['Post_ID'];
                                    $Post_Title = $row['Post_Title'];
                                    $Post_Status = $row['Post_Status'];
                            ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo $Post_ID; ?></td>
                                    <td><?php echo $Post_Title; ?></td>
                                    <td><?php echo $Post_Status; ?></td>
                                    <?php
                                        $sql = "SELECT e.Expert_ID, u.User_Name FROM expert e JOIN users u WHERE e.User_ID = u.User_ID";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->execute();

                                        $expertResults = $stmt->fetchAll();
                                    ?>
                                    <td>
                                        <div class="input-group">
                                            <select class="form-select expert-select" style="width: 200px;" data-post-id="<?php echo $Post_ID; ?>">
                                                <option value="">ASSIGN EXPERT</option>
                                                <?php
                                                    foreach ($expertResults as $expertRow) {
                                                        $AssignExpert_ID = $expertRow['Expert_ID'];
                                                        $Expert_Name = $expertRow['User_Name'];
                                                        echo "<option value='$AssignExpert_ID'> $Expert_Name </option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td class='d-flex justify-content-around'>
                                        <button class='btn btn-transparent assign-button' data-post-id="<?php echo $Post_ID; ?>">
                                            <img src='assets/img/paper.png' alt='assign' class='imgintable'>
                                        </button>
                                    </td>
                                    <?php
                                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            $Post_ID = $_POST['Post_ID'];
                                            $Expert_ID = $_POST['Expert_ID'];
                                    
                                            // Update the post with the assigned expert ID
                                            $stmt = $conn->prepare("UPDATE post SET Post_Status='Post Assign', Expert_ID=? WHERE Post_ID=?");
                                            $stmt->execute([$Expert_ID, $Post_ID]);
                                        }
                                    ?>
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
    <script>
        // assign expert to post 
        $(document).on("click", ".assign-button", function() {
            var postId = $(this).data('post-id');
            var selectElement = $('.expert-select[data-post-id="' + postId + '"]');
            var expertId = selectElement.val();

            // Perform AJAX request to update the post
            $.ajax({
                type: "POST",
                url: "m3_assignpost.php",
                data: {
                    Post_ID: postId,
                    Expert_ID: expertId
                },
                success: function(response) {
                    alert("Post Assigned to Expert ID: " + expertId);
                    location.reload();
                }
            });
        });
    </script>
    </body>
</html>


