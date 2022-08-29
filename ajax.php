<?php
session_start();
include("connect.php");
include("loginUser.php");
include("userInformation.php");
include("createPost.php");
include("media.php");
include("getProfile.php");

$log = new loginUser();
$userData = $log->loginCheck($_SESSION['user']);

$data = file_get_contents("php://input");
if ($data != "") {
    $data = json_decode($data);
}
if (isset($data->act) && $data->act == "reactPost") {
    include("react.php");
}
if (isset($data->act) && $data->act == "showpost") {
    $quer = "SELECT post FROM posts WHERE postId = '$data->ref' limit 1";
    $database = new connectDatabase();
    $res = $database->read($quer);
    $val = $res[0];
    $obj = (object)[];
    $obj->post = "<p>". $val['post']."<br></p>";
    $obj->act = "showpost";
    echo json_encode($obj);
}
if (isset($data->act) && $data->act == "makeFriend") {
    include("makeFriend.php");
}
if (isset($data->act) && $data->act == "comment") {
    $userId = $_SESSION['user'];
    $poster = new createPosts();
    $postid = $data->postid;
    $res = $poster->createComment($data->ref, $userId,$postid);

    $obj = (object)[];
    $obj->act = "comment";
    echo json_encode($obj);
}
?>