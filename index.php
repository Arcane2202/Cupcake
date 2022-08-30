<?php
session_start();
include("connect.php");
include("loginUser.php");
include("userInformation.php");


$user = $_SESSION['user'];
$log = new loginUser();
$userData = $log->loginCheck($_SESSION['user']);
header("Location:HomePage.php");