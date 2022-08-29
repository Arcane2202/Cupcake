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
if (isset($_GET['id'])) {
    $prof = new getProfile();
    $profData = $prof->getData($_GET['id']);
    if (is_array($profData)) {
        $userData = $profData[0];
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userId = $_SESSION['user'];
    $poster = new createPosts();
    $res = $poster->createPost($_POST, $userId, $_FILES);

    if ($res == "") {
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
    <link rel="icon" type="img/svg" href="img/cupcake-wh.svg">
</head>

<body class="textsizeCorrect">


    <?php include('navBar.php'); ?>

    <?php
    if (isset($_GET['id'])) {
        $prof = new getProfile();
        $profData = $prof->getData($_GET['id']);
        if (is_array($profData)) {
            $userData = $profData[0];
        }
    }
    ?>

    <div id="bodyContainer">

        <div id="profileImagesContainer">
            <?php
            $quer = "SELECT * FROM posts WHERE cover = 1 AND userId = '$userId' ORDER BY id DESC limit 1";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if ($res) {


                $valu = $res[0];
                $name = $userData['firstName'] . " " . $userData['lastName'];
                $quer = "SELECT * FROM posts WHERE dp = 1 AND userId = '$userId' ORDER BY id DESC limit 1";
                $res2 = $database->read($quer);
                $val = $res2[0];
                echo "
                <a href='postView.php?postId=$valu[postId]&date=$valu[date]&reacts=$valu[reacts]&image=$valu[image]&name=$name&userID=$userData[userID]&dp=$val[image]&post=$valu[post]' style='color: antiquewhite; text-decoration:none'>";
            } ?>
            <span>
                <?php
                if (file_exists($userData['cover'])) {
                    $cover = $media->preview($userData['cover'], 'cover');
                    echo "<img src=$cover style='margin-bottom:-2%; width: 100%;' alt='coverpic'> </a>";
                }
                if ($userData['userID'] == $_SESSION['user']) {
                    echo "<a href='changeDP.php?change=cover'><i class='fa fa-camera'
                        style='font-size:24px;color:antiquewhite; margin-top:-18%; margin-left:96%'></i></a> <br>";
                }
                ?>

                <!--<a href="changeDP.php?change=cover"><i class="fa fa-camera"
                    style="font-size:24px;color:antiquewhite; margin-top:-18%; margin-left:96%"></i></a> <br>-->
            </span>


            <?php
            $quer = "SELECT * FROM posts WHERE dp = 1 AND userId = '$userId' ORDER BY id DESC limit 1";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if ($res) {
                $val = $res[0];
                $name = $userData['firstName'] . " " . $userData['lastName'];

                echo "
                <a href='postView.php?postId=$val[postId]&date=$val[date]&reacts=$val[reacts]&image=$val[image]&name=$name&userID=$userData[userID]&dp=$val[image]&post=$val[post]' style='color: antiquewhite; text-decoration:none'>";
            } ?>
            <span>

                <?php
                if (file_exists($userData['dp'])) {
                    $dp = $media->preview($userData['dp'], 'dp');
                    echo "<img id='profilepicmain' src=$dp style='margin-bottom:-2%' alt='profilepic'> </a> <br>";
                }
                if ($userData['userID'] == $_SESSION['user']) {
                    echo "<a href='changeDP.php?change=dp'><i class='fa fa-camera'style='font-size:24px;color:antiquewhite; margin-top:-8%; margin-left:12%'></i></a>";
                }

                ?>

                <!--<a href="changeDP.php?change=dp"><i class="fa fa-camera"
                    style="font-size:24px;color:antiquewhite; margin-top:-8%; margin-left:12%"></i></a>-->



            </span>
            <br>
            <div style="font-size: 1.5vw">
                <b><?php echo $userData['firstName'] . " " . $userData['lastName'] ?></b>
            </div>

            <?php
            if ($userData['userID'] != $_SESSION['user']) {
                $friendId = $userData['userID'];
                $table = $_SESSION['user'] . "table";
                $text = "Add Friend";
                $text2 = "";
                $type1 = 1;
                $type2 = "";
                $show = "none";
                $query = "SELECT * FROM $table WHERE friendid = '$friendId' limit 1";
                $db = new connectDatabase();
                $res = $db->read($query);
                if ($res) {
                    $res = $res[0];
                    if ($res['state'] == "sent request") {
                        $text = "Cancel Request";
                        $type1 = 2;
                    } elseif ($res['state'] == "got request") {
                        $text = "Confirm";
                        $type1 = 3;
                        $text2 = "Delete";
                        $type2 = 4;
                    } else {
                        $text = "Unfriend";
                        $type1 = 5;
                        $show = "block";
                    }
                }
            ?>

                <button onclick='getData2(event,<?php echo  $type1 ?>,<?php echo  $friendId ?>)' 
                class='btn-with-hover' id='profileButton' value='<?php echo $text ?>' 
                style='border-radius: 10px;margin-top:-2%;margin-right:5%'><?php echo $text ?></button>

                <?php
                if ($text2 != "") {
                ?>
                    <button onclick='getData2(event,<?php echo  $type2 ?>,<?php echo  $friendId ?>)' 
                    class='btn-with-hover' id='deleteButton' value='<?php echo $text2 ?>' 
                    style='border-radius: 10px;margin-top:-2%;margin-right:4px'><?php echo $text2 ?></button>
                <?php
                }
                ?>
                <button onclick='' class='btn-with-hover' id='messageButton' value='' 
                style='display:<?php echo $show ?>;border-radius: 10px;margin-top:-2%;margin-right:4px'>
                Message</button>
            <?php
            }

            ?>
            <br>
            <div id="profButtons"> <a href="HomePage.php" class="texthover" style="color: var(--col8); text-decoration:none">Timeline </a> </div>
            <div id="profButtons"><a href="" class="texthover" style="color: var(--col8); text-decoration:none">About</a> </div>
            <?php

            if ($userData['userID'] == $_SESSION['user']) {


                $id = $userData['userID'];
                echo "
                        <div id='profButtons'><a href='showFriendRequests.php?type=friendRequests&id=$id' class='texthover'
                            style='color: var(--col8); text-decoration:none'>Friend Requests</a> </div> ";
            }

            ?>

            <div id="profButtons"><a href="showAllUsers.php?type=friendRequests&id=$id" class="texthover" style="color: var(--col8); text-decoration:none">Find People</a> </div>
            <div id="profButtons"><a href="" class="texthover" style="color: var(--col8); text-decoration:none">Photos</a> </div>
            <div id="profButtons"><a href="" class="texthover" style="color: var(--col8); text-decoration:none">Settings</a> </div>

        </div>

        <div style="display: flex;" id="restPart">

            <div id="divcontainer1">
                <?php
                $style = "";
                if ($userData['userID'] == $_SESSION['user']) {
                    $style = "height:115vh;";
                }
                ?>
                <div class="" id="friendscontainer" style="<?php echo $style ?>">

                    <h2>Friends</h2>
                    <?php
                    if ($friends) {
                        foreach ($friends as $val) {
                            include('friendlist.php');
                        }
                    }
                    ?>
                </div>
            </div>

            <div id="divcontainer2">
                <?php
                if ($userData['userID'] == $_SESSION['user']) {
                    echo "<div id='containposter' style='margin-bottom:3%'>
                            <form method='post' enctype='multipart/form-data'>
                                <textarea name='posts' placeholder='What is on your mind?'></textarea>
                                
                                <div class='imgPrevPost' id='imgPrevPost'>
                                    <img src='' class='imgPrevImg' id='imgPrevImg' alt='img'>
                                </div>
                                
                                <label for='dp'>
                                        <img id='addPic' src='images/addpic.png' width='20' />
                                </label>
                                <input type='file' name='dp' id='dp' class='showNone'></input>
                                <input class='btn-with-hover' id='submitButton' type='submit' value='Post'>
                                <br> 
                            </form>

                        </div>
                            <div id='statusBar' style='display:inline-block'>";
                } else {
                    echo "<div id='statusBar' style='height:87vh; display:inline-block'>";
                }
                ?>

                <?php

                if ($userPosts) {
                    foreach ($userPosts as $val) {
                        $us = new userData();
                        $wid = 'prof';
                        $posterUs = $us->fetchData($val['userId']);
                        include('postData.php');
                    }
                }
                ?>

            </div>

        </div>
    </div>

    </div>

    <script type="text/javascript">
        function makeFriend(data,task, tag) {
            var ajax = new XMLHttpRequest();
            ajax.addEventListener('readystatechange', function() {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    response2(ajax.responseText,task,tag);
                }
            });
            data = JSON.stringify(data);
            ajax.open("ProfilePage", "ajax.php", true);
            ajax.send(data);
        }

        function getData2(e, task, taskUser) {
            e.preventDefault();
            var data = {};
            data.act = "makeFriend";
            data.task = task;
            data.taskUser = taskUser;
            data.text = e.target.innerHTML;
            makeFriend(data,task, e.target);
        }

        function response2(res,data,tag) {
            if (res != "") {
                obj = JSON.parse(res); 
                if(data == 4) {
                    second = document.getElementById("deleteButton");
                    second.style.display = "none";
                    profileButton = document.getElementById("profileButton");
                    document.getElementById("messageButton").innerHTML = obj.show;
                    profileButton.innerHTML = obj.text;
                } else if(data==3) {
                    second = document.getElementById("deleteButton");
                    second.style.display = "none";
                    profileButton = document.getElementById("profileButton");
                    document.getElementById("messageButton").style.display = obj.show;
                    profileButton.innerHTML = obj.text;
                } else {
                    document.getElementById("messageButton").style.display = obj.show;
                    tag.innerHTML = obj.text;
                }
            }
        }
    </script>

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