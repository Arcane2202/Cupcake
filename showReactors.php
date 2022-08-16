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
    if(isset($_GET['postid'])&& isset($_GET['type'])) {
        $database = new connectDatabase();
        $post = new createPosts();
        $res = $post->getReactors($_GET['postid'],$_GET['type']);
    }
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
    <?php include('navBar.php');?>
    <div id="bodyContainer">
        <div style="display: flex;">

            
            <div id="condivcontainer2">

                <div id="containposter">

                    <?php
                         if(is_array($res)) {
                                $users = new userData();
                                foreach($res as $value) {
                                  
                                    $val = $users->fetchData($value['reactor']);
                                    include("listReactors.php");
                                    
                                }
                         }

                    ?>

                </div>

                
            </div>
        </div>
    </div>

</body>

</html>