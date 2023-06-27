<?php
// Check if the user ID is provided in the query string
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Retrieve the user data from the database or any other storage mechanism
    $user = [
        'id' => $userId,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        // Add more user data fields as needed
    ];

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Process the form data and update the user
        $name = $_POST['name'];
        $email = $_POST['email'];

        // Update the user data in the database or any other storage mechanism

        // Redirect to the user list page after successful update
        header('Location: index.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update User</title>
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
        <h2>Update User</h2>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required>

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
