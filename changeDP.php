<?php
session_start();
//unset($_SESSION['user']);
include("connect.php");
include("loginUser.php");
include("userInformation.php");
include("createPost.php");
include("media.php");

$log = new loginUser();
$userData = $log->loginCheck($_SESSION['user']);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['dp']['name']) && $_FILES['dp']['name'] != "") {
        if ($_FILES['dp']['type'] == "image/jpeg"||$_FILES['dp']['type'] == "image/png") {
            $directory = "mediaStorage/".$userData['userID']."/";
            if(!file_exists($directory)) {
                mkdir($directory,0777,true);
            }
            $med = new media();     
            $change = "dp";       
            if(isset($_GET['change'])) {
                $change = $_GET['change'];
            }
            $mediaName = $directory . $med->mediaName($userData['userID'],$change).".jpg";
            move_uploaded_file($_FILES['dp']['tmp_name'], $mediaName);
            if($change == "dp") {
                $quer = "UPDATE USERS SET dp = '$mediaName' WHERE userID = '$userData[userID]' limit 1";
                $med->cropMedia($mediaName, $mediaName, 1280, 1280);
            } else {
                $quer = "UPDATE USERS SET cover = '$mediaName' WHERE userID = '$userData[userID]' limit 1";
                $med->cropMedia($mediaName, $mediaName, 3840, 1442);
            }
            if (file_exists($mediaName)) {
                $database = new connectDatabase();
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