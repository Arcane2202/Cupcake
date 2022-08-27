<?php
session_start();
//unset($_SESSION['user']);
include("connect.php");
include("loginUser.php");
include("userInformation.php");
include("createPost.php");
include("media.php");
$media = new media();
$log = new loginUser();
$userData = $log->loginCheck($_SESSION['user']);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['dp']['name']) && $_FILES['dp']['name'] != "") {
        if ($_FILES['dp']['type'] == "image/jpeg") {
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
                $med->resizeMedia($mediaName, $mediaName, 4000, 4000);
                $_POST['dp'] = 1;
            } else {
                $quer = "UPDATE USERS SET cover = '$mediaName' WHERE userID = '$userData[userID]' limit 1";
                $med->resizeMedia($mediaName, $mediaName, 4000, 4000);
                $_POST['cover'] = 1;
            }
            if (file_exists($mediaName)) {
                $database = new connectDatabase();
                $database->write($quer);
                $postPic = new createPosts();
                $postPic->createPost($_POST,$userData['userID'],$mediaName);

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
                    <div class="imgPrevDiv" id = "imgPrevDiv">
                        <?php if($_GET['change'] == "dp") {
                            echo "<img src='' class='imgPrevImg' id='imgPrevImg' alt='img'>";
                        } else {
                            echo "<img src='' class='imgPrevImg' style='border-radius:2px' id='imgPrevImg' alt='img'>";
                        } ?>
                        <span class="imgPrevtext">Selected Image will appear here!</span>
                    </div>
                    <input type="file" name="dp" id="dp">
                    <input class="btn-with-hover" id="submitButton" type="submit" value="Upload">
                    <br>
                </div>
                </form>

            </div>
        </div>
    </div>

    <script>

        const dp = document.getElementById("dp");
        const div = document.getElementById("imgPrevDiv");
        const img = div.querySelector(".imgPrevImg");
        const txt = div.querySelector(".imgPrevtext");

        dp.addEventListener("change",function() {
            const file = this.files[0];
            if(file) {
                const reader = new FileReader();
                img.style.display = "block";
                txt.style.display = "none";

                reader.addEventListener("load",function() {
                    img.setAttribute("src",this.result);
                });
                reader.readAsDataURL(file);
            } else {
                img.setAttribute("src","");
                img.style.display = null;
                txt.style.display = null;
            }
        });

    </script>

</body>

</html>