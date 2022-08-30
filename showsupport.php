<?php

session_start();
//unset($_SESSION['user']);
include("connect.php");
include("loginUser.php");
include("userInformation.php");
include("createPost.php");
include("media.php");
include("getProfile.php");

$user = $_SESSION['user'];
$media = new media();
$log = new loginUser();
$userData = $log->loginCheck($_SESSION['user']);


?>

<!DOCTYPE html>
<html>

<head>
    <title>Assignment 2</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/navStyle.css">
</head>

<?php

$quer = "SELECT * FROM support";
$database = new connectDatabase();
$res = $database->read($quer);

?>

<body>
    <?php include("navBar.php");?>
    <div class="container table-container">
        <div class="row">
            <div class="msg">
                <?php
                if (isset($msg)) {
                ?> <p> <?php echo $msg; ?> </p> <?php } ?>
            </div>
            <table class="table table-dark table-hover">
                <tr>
                    <th width="14%">User Id</th>
                    <th width="14%">Name</th>
                    <th width="14%">Email</th>
                    <th width="14%">Phone</th>
                    <th width="30%">Message</th>
                </tr>
                <?php
                foreach($res as $valluk) {
                ?>
                    <tr>
                        

                        <td><?php echo $valluk['userid'] ?></td>
                        <td><?php echo $valluk['name'] ?></td>
                        <td><?php echo $valluk['email'] ?></td>
                        <td><?php echo $valluk['phone'] ?></td>
                        <td><?php echo $valluk['message'] ?></td>

      
                    </tr>
                <?php } ?>
            </table>
            <div class="back-button">
                <form action="" method="post" class="icon-button btn">
                    <input type="submit" class="button" value="" />
                </form>
            </div>
        </div>
    </div>
</body>