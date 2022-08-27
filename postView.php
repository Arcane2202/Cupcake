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
$use = new userData();
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Cupcake</title>
    <link rel="icon" type="image/png" href="images/logo.png">
</head>


<body class="textsizeCorrect">

    <?php include('navBar.php'); ?>

    <body class="textsizeCorrect">
        <?php include('navBar.php'); ?>
        <div id="bodyContainer" style="height: 100vh;margin-bottom: 0;padding-bottom: 0;">
            <div style="display: flex;min-height: 100vh;margin-bottom: 0;padding-bottom: 0;">

                <div style="height: 100vh;background-color:var(--col2);flex: 2.5;margin-top: 2%;margin-bottom: 0;padding-bottom: 0;">

                    <div class="outer-wrapper">
                        <div class="frame">
                            <?php
                            echo "<img src='$_GET[image]'/>";
                            ?>
                        </div>
                    </div>

                </div>

                <div style="height: 100vh;background-color:var(--col3);flex: 1;margin-top: 2%;margin-bottom: 0;padding-bottom: 0;overflow:scroll">

                    <div id="status">

                        <div style="width: 100%;">

                            <div class="texthover" id="NameHeader" style="color: var(--col9); margin:15px; margin-bottom:0">
                                <a href="ProfilePage.php?id=<?php echo $_GET['userID']; ?>" style="color: antiquewhite; text-decoration:none">
                                    <img src="<?php echo $media->preview($_GET['dp'], 'dp') ?>" style="border-radius:50px; width:10%;">
                                </a>
                                <a href="ProfilePage.php?id=<?php echo $_GET['userID']; ?>" style="margin-left:2%; color: antiquewhite; text-decoration:none;">
                                    <span class="texthover"><?php echo $_GET['name'] ?></span>
                                </a>
                                <span class="smallestText" id="time" style="margin-top:5%; color: var(--col8); float:right"><?php echo $_GET['date'] ?></span>
                                <br>
                            </div>

                            <?php

                            if ($_GET['userID'] == $_SESSION['user']) {
                                $postId = $_GET['postId'];
                                echo "<a href='editPost.php?postid=$postId' style='text-decoration:none'>
                                    <span class='smallerText' id='editPost'
                                            style='margin-left:13%;margin-top:-50%; color: var(--col8);'>Edit</span></a>
                                    <a href='deletePost.php?postid=$postId' style='text-decoration:none'>
                                    <span class='smallerText' id='deletePost'
                                            style='margin-left:5px;margin-top:-50%; color: var(--col8);'>Delete</span></a>";
                            }

                            ?>
                            <?php
                            $post = "";
                            if ($_GET['post'] != "") {
                                $quer = "SELECT * FROM posts WHERE postId = '$postId' limit 1";
                                $database = new connectDatabase();
                                $res = $database->read($quer);
                                $valu = $res[0];
                                $post = htmlspecialchars($valu['post']);
                            } ?>
                            <div style="margin-left: 2%; margin-top:-3%; font-size:calc(0.5em + 0.5vw)">
                                <div id="textPart">
                                    <?php
                                    if ($post != "") {
                                        $string = strip_tags($post);
                                        if (strlen($string) > 450) {
                                            $stringCut = substr($string, 0, 450);
                                            $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...<a style="text-decoration: none; font-weight: bold;color: antiquewhite;" onclick="seePost(event,' . $postId . ')" href="postData.php?postid=' . $postId . '">see more</a>';
                                        }
                                        echo "<p> $string<br></p>";
                                    }
                                    ?>
                                </div>



                                <div class="textsizeCorrect" id="reactShow" style="margin-top: 2vh;padding-left: 4%;color:antiquewhite">
                                    <?php
                                    $likes = "";
                                    $database = new connectDatabase();
                                    $post = new createPosts();
                                    $res = $post->getReactors($_GET['postId'], 'post');
                                    $reacters = [];
                                    $flag = false;
                                    echo "<a id='reactors_$_GET[postId]' class='smallerText' style='color:antiquewhite' href='showReactors.php?type=post&postid=$_GET[postId]'>";
                                    if ($res) {
                                        $users = new userData();
                                        foreach ($res as $value) {
                                            $valu = $users->fetchData($value['reactor']);
                                            $reacters[] = $valu['firstName'] . " " . $valu['lastName'];
                                            if ($valu['userID'] == $_SESSION['user']) {
                                                $flag = true;
                                            }
                                        }
                                        $count = count($reacters);
                                        if ($flag) {
                                            $count = count($reacters) - 1;
                                            if ($count > 0) {
                                                if ($count == 1) {
                                                    $likes = "You and 1 other liked this post.";
                                                } else {
                                                    $likes = "You and " . $count . "others liked this post.";
                                                }
                                            } else {
                                                $likes = "You liked this post.";
                                            }
                                        } elseif ($count > 0) {
                                            $count = count($reacters) - 1;
                                            if ($count > 0) {
                                                if ($count == 1) {
                                                    $likes = "$reacters[0] and 1 other liked this post.";
                                                } else {
                                                    $likes = "$reacters[0] and " . $count . "others liked this post.";
                                                }
                                            } else {
                                                $likes = "$reacters[0] liked this post.";
                                            }
                                        }
                                    }

                                    if ($likes != "") {
                                        echo "<i class='fa fa-heart' style='padding-right: 5px;'>&nbsp$likes</i>";
                                    }
                                    echo "</a>";
                                    ?>

                                </div>
                                <div id="reactSec">
                                    <div id="flex" style="padding-left: 15%;padding-right: 8%">
                                        <?php
                                        $reactCount = "";
                                        if ($_GET['reacts'] > 0) {
                                            $reactCount = "(" . $_GET['reacts'] . ")";
                                        }
                                        ?>
                                        <a onclick='getData(event)' href="react.php?type=post&postid=<?php echo $_GET['postId'] ?>" class="btn-with-hover" style="color: var(--col8); text-decoration:none;">
                                            <i class="fa fa-heart fa-2x" style="font-size:calc(0.30em + 0.5vw)" aria-hidden="true">
                                                <?php echo $reactCount ?></a></i>
                                        </a>
                                    </div>
                                    <div id="flex" style="padding-left: 15%;padding-right: 8%;border-left: solid thin;">
                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-comment fa-2x" style="font-size:calc(0.30em + 0.5vw)" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div id="flex" style="padding-left: 15%;padding-right: 8%;border-left: solid thin;">
                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-share fa-2x" style="font-size:calc(0.30em + 0.5vw)" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <script type="text/javascript">
            function reacter(data, tag) {
                var ajax = new XMLHttpRequest();
                ajax.addEventListener('readystatechange', function() {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        response(ajax.responseText, tag);
                    }
                });
                data = JSON.stringify(data);
                ajax.open("postView", "ajax.php", true);
                ajax.send(data);
            }

            function getData(e) {
                e.preventDefault();
                var data = {};
                data.act = "reactPost";
                data.ref = e.target.parentElement.href;
                reacter(data, e.target);
            }

            function response(res, tag) {

                if (res != "") {
                    obj = JSON.parse(res);
                    if (typeof obj.act != undefined) {
                        var reactCount = "";

                        if (parseInt(obj.react) > 0) {
                            reactCount = " (" + obj.react + ")";
                        }
                        tag.innerHTML = reactCount;
                        var post = document.getElementById(obj.postId);
                        post.innerHTML = obj.likes;
                    }
                }
            }

            function seePost(e, postId) {
                e.preventDefault();
                var data = {};
                data.act = "showpost";
                data.ref = postId;
                showPost(data, e.target.parentElement);
            }

            function showPost(data, tag) {
                var ajax = new XMLHttpRequest();
                ajax.addEventListener('readystatechange', function() {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        results(ajax.responseText, tag);
                    }
                });
                data = JSON.stringify(data);
                ajax.open("postView", "ajax.php", true);
                ajax.send(data);
            }

            function results(res, tag) {
                obj = JSON.parse(res);
                tag.innerHTML = obj.post;
            }
        </script>

    </body>


</html