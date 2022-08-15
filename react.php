<?php 
    session_start();
    include("connect.php");
    include("loginUser.php");
    include("userInformation.php");
    include("createPost.php");
    include("media.php");
    include("getProfile.php");

    $log = new loginUser();
    $userData=$log->loginCheck($_SESSION['user']);

    $ret = "ProfilePage.php";
    if(isset($_SERVER['HTTP_REFERER'])) {
        $ret = $_SERVER['HTTP_REFERER'];
    }
    if(isset($_GET['postid'])&& isset($_GET['type']) && is_numeric($_GET['postid'])) {
        $ar[] = 'post';
        $ar[] = 'comment';
        if(in_array($_GET['type'],$ar)) {
            $storeReact = new createPosts();
            $storeReact->reactPost($_GET['postid'],$_GET['type'],$_SESSION['user']);
        }
    }
    header("Location: ".$ret);
    die;