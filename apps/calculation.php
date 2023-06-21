<?php
// ... Existing code for login and session handling ...

// Function to calculate the total number of users based on user types
function calculateUserCount($userType)
{
    // Replace this logic with your own database query or data retrieval mechanism
    // to get the count of users based on user type
    $userCount = 0;

    // Return the user count
    return $userCount;
}

// Calculate the total number of users for each user type
$studentCount = calculateUserCount('student');
$lecturerCount = calculateUserCount('lecturer');
$expertCount = calculateUserCount('expert');
?>

<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
    body {
    background-color: rgb(205, 247, 239);
}

.sidenav {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: rgb(11, 117, 117);
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
}
  
.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.5s;
}
  
.sidenav a:hover {
    color: #f1f1f1;
}
  
.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}
  
#maincontentpage {
    transition: margin-left .5s;
}
  
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}

#navbarset {
    background-color: rgb(11, 117, 117);
    height: 50px;
    align-items: center;
}

#logofkedu {
    display: flex;
    width: 250px;
    height: 50px;
    justify-content: center;
    align-items: center;
    border: 1px solid black;
}

.navbar-button {
    margin-left: 5px;
    background-color: transparent;
    border: none;
    color: #ffffff;
    cursor: pointer;
    font-size: 30px;
}

#navbarimg {
    width: 30px;
}

#logoedu {
    width: 100px;
}

.btnusername {
    background-color: rgb(239, 212, 116);
    color: rgb(113, 0, 0);
}

.contentpart {
    margin-top:50px;
}
</style>
</head>
<body>
    <div class="container">
        <h2>User List</h2>
        <div>
            <h3>Number of Students: <?php echo $studentCount; ?></h3>
            <h3>Number of Lecturers: <?php echo $lecturerCount; ?></h3>
            <h3>Number of Experts: <?php echo $expertCount; ?></h3>
            <!-- Display other relevant calculations or user types -->
        </div>
    </div>
</body>
</html>
