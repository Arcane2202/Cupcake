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
?>