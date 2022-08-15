<?php
    session_start();
    //unset($_SESSION['user']);
    include("connect.php");
    include("loginUser.php");
    include("userInformation.php");
    include("createPost.php");
    
    $log = new loginUser();
    $userData=$log->loginCheck($_SESSION['user']);
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        print_r($_POST);
        $userId = $_SESSION['user'];
        $poster = new createPosts();
        $res = $poster->createPost($_POST,$userId);

        if($res == "") {
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
    <title>Cupcake|Profile</title>
    <link rel="icon" type="image/png" href="images/logo.png">
</head>

<body class="textsizeCorrect">


    <?php include('navBar.php');?>

    <div id="bodyContainer">

        <div id="profileImagesContainer">

            <a href="" style="color: antiquewhite; text-decoration:none">
                <span>
                  
                  <?php
                      $cover = "";
                      if(file_exists($userData['cover'])) {
                          $cover = $userData['cover'];
                      }
                  ?>
                    <img src=<?php echo $cover?> style="margin-bottom:-2%; width: 100%;" alt="coverpic"> </a>
                    <a href="changeDP.php?change=cover"><i class="fa fa-camera" style="font-size:24px;color:antiquewhite; margin-top:-18%; margin-left:96%"></i></a> <br>
                </span>
                
            <a href="" style="color: antiquewhite; text-decoration:none">
                <span>
                  
                <?php
                    $dp = "";
                    if(file_exists($userData['dp'])) {
                        $dp = $userData['dp'];
                    }
                ?>
                
                <img id="profilepicmain" src=<?php echo $dp?> style="margin-bottom:-2%" alt="profilepic"> </a> <br>
                   
                
                <a href="changeDP.php?change=dp"><i class="fa fa-camera" style="font-size:24px;color:antiquewhite; margin-top:-8%; margin-left:12%"></i></a>
                </span>
            <br>
            <div style="font-size: 1.5vw">
                <b><?php echo $userData['firstName']." ".$userData['lastName'] ?></b>
            </div>
            <br>
            <div id="profButtons"> <a href="HomePage.php" class="texthover" style="color: var(--col8); text-decoration:none">
                    Timeline </a> </div>
            <div id="profButtons"><a href="" class="texthover"
                    style="color: var(--col8); text-decoration:none">About</a> </div>
            <div id="profButtons"><a href="" class="texthover"
                    style="color: var(--col8); text-decoration:none">Friends</a> </div>
            <div id="profButtons"><a href="" class="texthover"
                    style="color: var(--col8); text-decoration:none">Photos</a> </div>
            <div id="profButtons"><a href="" class="texthover"
                    style="color: var(--col8); text-decoration:none">Settings</a> </div>

        </div>

        <div style="display: flex;">

            <div id="divcontainer1">
                <div id="friendscontainer">

                    <h2>Friends</h2>
                    <?php 
                        if($friends) {
                            foreach($friends as $val) {
                                include('friendlist.php');
                            }
                        }    
                    ?>
                    
                    
                </div>
            </div>
            <div id="divcontainer2">

                <div id="containposter">
                    <form method="post">
                        <textarea name="posts" placeholder="What's on your mind?"></textarea>
                        <button class="btn btn-with-hover">
                            <img src="images/addpic.png" width="20" />
                        </button>
                        <button class="btn btn-with-hover">
                            <img src="images/addvdo.png" width="20" />
                        </button>
                        <input class="btn-with-hover" id="submitButton" type="submit" value="Post">
                        <br>
                    </form>

                </div>

                <div id="statusBar">

                   <?php

                        if($userPosts) {
                            foreach($userPosts as $val) {
                                $us = new userData();
                                $posterUs = $us->fetchData($val['userId']);
                                include('postData.php');
                            }
                        }        
                   ?>

                </div>

            </div>
        </div>

    </div>


</body>

</html>