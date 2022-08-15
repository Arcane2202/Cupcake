<?php
session_start();
//unset($_SESSION['user']);
include("connect.php");
include("loginUser.php");
include("userInformation.php");
include("createPost.php");

$log = new loginUser();
$userData = $log->loginCheck($_SESSION['user']);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['dp']['name']) && $_FILES['dp']['name'] != "") {
        if ($_FILES['dp']['type'] == "image/jpeg") {
            $mediaName = "mediaStorage/" . $_FILES['dp']['name'];
            move_uploaded_file($_FILES['dp']['tmp_name'], $mediaName);
            if (file_exists($mediaName)) {
                $database = new connectDatabase();
                $quer = "UPDATE USERS SET dp = '$mediaName' WHERE userID = '$userData[userID]' limit 1";
                $database->write($quer);
                header("Location:ProfilePage.php");
                die;
            }
        }
    }
    else {

    }
}

?>

<!DOCTYPE html>

<html>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Cupcake|Change DP</title>
    <link rel="icon" type="image/png" href="images/logo.png">
</head>

<body class="textsizeCorrect">
    <?php include('navBar.php'); ?>
    <div id="bodyContainer">
        <div style="display: flex;">

            <div id="condivcontainer2">
                <form method="post" enctype="multipart/form-data">
                <div id="containposter">
                    <input type="file" name="dp">
                    <input class="btn-with-hover" id="submitButton" type="submit" value="Upload">
                    <br>

                </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>