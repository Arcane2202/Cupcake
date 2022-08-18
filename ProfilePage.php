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
    $userData=$log->loginCheck($_SESSION['user']);
   if(isset($_GET['id'])) {
    $prof = new getProfile();
    $profData = $prof->getData($_GET['id']);
    if(is_array($profData)) {
        $userData = $profData[0];
    }
   }
    
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $userId = $_SESSION['user'];
        $poster = new createPosts();
        $res = $poster->createPost($_POST,$userId,$_FILES);

        if($res == "") {
            header("Location: ProfilePage.php");
            die;
        }
    }
    $userId = $userData['userID'];
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

    <?php 
        if(isset($_GET['id'])) {
            $prof = new getProfile();
            $profData = $prof->getData($_GET['id']);
            if(is_array($profData)) {
                $userData = $profData[0];
            }
        }
    ?>

    <div id="bodyContainer">

        <div id="profileImagesContainer">

            <a href="" style="color: antiquewhite; text-decoration:none">
                <span>
                    <?php
                      if(file_exists($userData['cover'])) {
                          $cover = $media->preview($userData['cover'],'cover');
                          echo "<img src=$cover style='margin-bottom:-2%; width: 100%;' alt='coverpic'> </a>";
                      }
                      if($userData['userID'] == $_SESSION['user']) {
                        echo "<a href='changeDP.php?change=cover'><i class='fa fa-camera'
                        style='font-size:24px;color:antiquewhite; margin-top:-18%; margin-left:96%'></i></a> <br>";
                      }
                    ?>

                    <!--<a href="changeDP.php?change=cover"><i class="fa fa-camera"
                    style="font-size:24px;color:antiquewhite; margin-top:-18%; margin-left:96%"></i></a> <br>-->
                </span>

                <a href="" style="color: antiquewhite; text-decoration:none">
                    <span>

                        <?php
                        if(file_exists($userData['dp'])) {
                            $dp = $media->preview($userData['dp'],'dp');
                            echo "<img id='profilepicmain' src=$dp style='margin-bottom:-2%' alt='profilepic'> </a> <br>";
                        }
                        if($userData['userID'] == $_SESSION['user']) {
                            echo "<a href='changeDP.php?change=dp'><i class='fa fa-camera'style='font-size:24px;color:antiquewhite; margin-top:-8%; margin-left:12%'></i></a>";
                        }

                    ?>

                        <!--<a href="changeDP.php?change=dp"><i class="fa fa-camera"
                    style="font-size:24px;color:antiquewhite; margin-top:-8%; margin-left:12%"></i></a>-->



                    </span>
                    <br>
                    <div style="font-size: 1.5vw">
                        <b><?php echo $userData['firstName']." ".$userData['lastName'] ?></b>
                    </div>

                <?php

                        if($userData['userID'] != $_SESSION['user']) { 


                            $id = $userData['userID'];
                            $text = "Add Friend";
                            $poster = new createPosts();
                            $friend = $poster->getReactors($_SESSION['user'],"friendsCount");
                            if(is_array($friend)) {
                                $friendId = array_column($friend, 'reactor');
                                if(in_array($userData['userID'],$friendId)) {
                                    $text = "Unfriend";
                                }
                            }
                            
                            
                            echo "
                            
                            
                            <a href='react.php?type=friendRequests&postid=$id'>
                                <input class='btn-with-hover' id='submitButton' type='submit' value='$text'
                                    style='border-radius: 10px;margin-top:-4%;margin-right:10%'>
                            </a>
                            <a href='message.php?user_id=$id'>
                                <input class='btn-with-hover' id='submitButton' type='submit' value='Message'
                                    style='border-radius: 10px;margin-top:-4%;margin-right:10px'></a>

                        ";

                        }

                ?>



                <br>
                <div id="profButtons"> <a href="HomePage.php" class="texthover"
                        style="color: var(--col8); text-decoration:none">Timeline </a> </div>
                <div id="profButtons"><a href="" class="texthover"
                        style="color: var(--col8); text-decoration:none">About</a> </div>
                <?php

                    if($userData['userID'] == $_SESSION['user']) { 


                        $id = $userData['userID'];
                        echo "
                        <div id='profButtons'><a href='showReactors.php?type=friendRequests&postid=$id' class='texthover'
                            style='color: var(--col8); text-decoration:none'>Friend Requests</a> </div> ";
                    }

                ?>
                       
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
                <?php 
                    if($userData['userID'] == $_SESSION['user']) {   
                        echo "<div id='containposter' style='margin-bottom:3%'>
                            <form method='post' enctype='multipart/form-data'>
                                <textarea name='posts' placeholder='What is on your mind?'></textarea>
                                
                                <div class='imgPrevPost' id='imgPrevPost'>
                                    <img src='' class='imgPrevImg' id='imgPrevImg' alt='img'>
                                </div>
                                
                                <label for='dp'>
                                        <img src='images/addpic.png' width='20' />
                                    </label>
                                    <input type='file' name='dp' id='dp' class='showNone'></input>
                                    <input class='btn-with-hover' id='submitButton' type='submit' value='Post'>
                                <br> 
                            </form>

                        </div>";
                    }
                ?>

                <div id="statusBar" style="display:inline-block">

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
    <script>
    const dp = document.getElementById("dp");
    const div = document.getElementById("imgPrevPost");
    const img = div.querySelector(".imgPrevImg");
    const txt = div.querySelector(".imgPrevtext");

    dp.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            img.style.display = "block";
            div.style.display = "flex";


            reader.addEventListener("load", function() {
                img.setAttribute("src", this.result);
            });
            reader.readAsDataURL(file);
        } else {
            img.setAttribute("src", "");
            img.style.display = null;
            div.style.display = null;
        }
    });
    </script>


</body>

</html>