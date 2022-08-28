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

if(isset($_GET['postid'])) {
    $database = new connectDatabase();
    $post = new createPosts();
    $val = $post->getParticularPost($_GET['postid']);
}

if(!is_array($val)) {
    header("Location: ProfilePage.php");
    die;
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $results = $post->deletePost($val['postId']);
    header("Location: ProfilePage.php");
    die;
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
    <title>Cupcake|Delete</title>
    <link rel="icon" type="img/svg" href="img/cupcake-wh.svg">
</head>

<body class="textsizeCorrect">
    <?php include('navBar.php');?>
    <div id="bodyContainer">
        <div style="display: flex;">

            
            <div id="condivcontainer2">

                <div id="containposter">
                    <h4>Delete Post</h4><br>
                    <form method="post" enctype="multipart/form-data">
                        
                        <span style="margin-left: 2%">Are you sure you want to delete this post?</span>
                        <input class="btn-with-hover" id="submitButton" type="submit" value="Delete" style="margin-top: 0%;margin-right: 3%">
                        <?php 
                            $USER = new userData();
                            $posterUs = $USER->fetchData($val['userId']);
                            include("displayPostToDelete.php"); 
                        ?>
                        <input type="hidden" value="<?php echo $val['postId'] ?>" name="postId">
                        <br>
                    </form>

                </div>

                
            </div>
        </div>
    </div>

</body>

</html>