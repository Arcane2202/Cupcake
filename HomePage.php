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
    print_r($_POST);
    $userId = $_SESSION['user'];
    $poster = new createPosts();
    $res = $poster->createPost($_POST, $userId,$_FILES);

    if ($res == "") {
        header("Location: ProfilePage.php");
        die;
    }
}
$userId = $_SESSION['user'];
$poster = new createPosts();
$userPosts = $poster->getPosts($userId);

$use = new userData();
$friends = $use->getFriendData($userId);

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Cupcake|Home</title>
    <link rel="icon" type="img/svg" href="img/cupcake-wh.svg">
</head>

<body class="textsizeCorrect">
    <?php include('navBar.php');?>
    <div id="bodyContainer">
        <div style="display: flex;">

            <div id="condivcontainer1">
                <div id="content">

                    <div id="rowAdd">
                        <a href="ProfilePage.php" style="color: antiquewhite; text-decoration:none">
                            <?php
                                if(file_exists($userData['dp'])) {
                                    $dp = $media->preview($userData['dp'],'dp');
                                }
                            ?>
                            <img src=<?php echo $dp ?> id="homeProfileImage" alt=""> <br>
                            <span
                                class="texthover"><?php echo $userData['firstName']." ".$userData['lastName'] ?></span>
                        </a>
                    </div>

                    <div id="rowAdd">
                        <a href="" style="color: antiquewhite; text-decoration:none">
                            <i class="fas fa-user-friends fa-2x" style="padding-left: 5%; padding-right: 5%"></i>
                            <span class="texthover">Friends</span>
                        </a>
                    </div>
                    <div id="rowAdd">
                        <a href="" style="color: antiquewhite; text-decoration:none">
                            <i class="fa fa-users fa-2x" aria-hidden="true"
                                style="padding-left: 5%; padding-right: 5%"></i>
                            <span class="texthover">Groups</span>
                        </a>
                    </div>

                    <div id="rowAdd">
                        <a href="" style="color: antiquewhite; text-decoration:none">
                            <i class="fa fa-caret-down fa-2x" aria-hidden="true"
                                style="padding-left: 8%; padding-right:8%"></i>
                            <span class="texthover">See More</span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="condivcontainer2">

                <div id="containposter" >

                    <form method="post" enctype="multipart/form-data">
                        <textarea name="posts" placeholder="What's on your mind?"></textarea>
                        
                        <div class="imgPrevPost" id="imgPrevPost">
                            <img src="" class="imgPrevImg" id="imgPrevImg" alt="img">
                        </div>
                        
                        <label for="dp">
                                <!--<img id='addPic' src="images/addpic.png" width="20" />-->
                                <i id='addPic' class='fa fa-file-image-o icon' aria-hidden='true' style='font-size: 20px;'></i>
                            </label>
                            <input type='file' name='dp' id='dp' class='showNone'></input>
                            <button style='background-color:transparent; border:none;' id='submitButton' type='submit'><i id='submitButton' class='fa fa-floppy-o icon' aria-hidden='true' style='font-size: 20px;'></i> </button>
                            <!--<i id="submitButton" type="submit" value="Post" class="fa fa-floppy-o icon" aria-hidden="true" style="font-size: 20px;"></i>-->

                        <br>
                    </form>

                </div>

                <div id="statusBar">

                <?php

                    $database = new connectDatabase();
                    $user = new userData();
                    $poster = new createPosts();
                    $media = new media();
                    $friends = $poster->getReactors($_SESSION['user'],"friendsCount");
                    $friendId = "";
                    if(is_array($friends)) {
                        $friendId = array_column($friends,"reactor");
                        $friendId = implode("','", $friendId);
                        if($friendId) {
                            $me = $_SESSION['user'];
                            $quer = "SELECT * FROM posts WHERE userId in ('".$me."','" .$friendId. "') ORDER BY id DESC";
                            $userPosts = $database->read($quer);
                        }
                    }
                    if($userPosts) {
                        foreach($userPosts as $val) {
                            $us = new userData();
                            $wid = 'home';
                            $posterUs = $us->fetchData($val['userId']);
                            include('postData.php');
                        }
                    }        
                ?>

                </div>
            </div>
        </div>
    </div>

    <script>

        const dp = document.getElementById("dp");
        const div = document.getElementById("imgPrevPost");
        const img = div.querySelector(".imgPrevImg");
        const txt = div.querySelector(".imgPrevtext");

        dp.addEventListener("change",function() {
            const file = this.files[0];
            if(file) {
                const reader = new FileReader();
                img.style.display = "block";
                div.style.display = "flex";


                reader.addEventListener("load",function() {
                    img.setAttribute("src",this.result);
                });
                reader.readAsDataURL(file);
            } else {
                img.setAttribute("src","");
                img.style.display = null;
                div.style.display = null;
            }
        });

    </script>

</body>

</html>