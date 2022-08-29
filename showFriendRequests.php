<?php
    session_start();
    include("connect.php");
    include("loginUser.php");
    include("userInformation.php");
    include("createPost.php");
    include("media.php");
    $media = new media();

    $log = new loginUser();
    $userData = $log->loginCheck($_SESSION['user']);
    $database = new connectDatabase();
    $requests = new userData();
    $res = $requests->getFriendRequests($_GET['id']);
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
    <link rel="icon" type="img/svg" href="img/cupcake-wh.svg">
</head>

<body class="textsizeCorrect">
    <?php include('navBar.php');?>
    <div id="bodyContainer">
        <div style="display: flex;">

            
            <div id="condivcontainer2">

                <div id="containposter">

                    <?php
                         if(is_array($res)) {
                                $type = "friendRequests";
                                $users = new userData();
                                foreach($res as $value) {
                                    $val = $users->fetchData($value['userID']);
                                    include("listRequest.php");
                                }
                         }

                    ?>

                </div>

                
            </div>
        </div>
    </div>

</body>



</html>