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
    if(!$val) {
        header("Location: ProfilePage.php");
    }
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
    <link rel="icon" type="image/png" href="images/logo.png">
</head>

<body class="textsizeCorrect">
    <?php include('navBar.php');?>
    <div id="bodyContainer">
        <div style="display: flex;">

            
            <div id="condivcontainer2">

                <div id="containposter">
                    <h4>Delete Post</h4><br>
                    <form method="post" enctype="multipart/form-data">
                        
                        Are you sure you want to delete this post?
                        <?php 
                            $USER = new userData();
                            $posterUs = $USER->fetchData($val['userId']);
                            include("displayPostToDelete.php"); 
                        ?>
                        <input class="btn-with-hover" id="submitButton" type="submit" value="Delete">
                        <br>
                    </form>

                </div>

                
            </div>
        </div>
    </div>

    <script>

        const dp = document.getElementById("dp");
        const div = document.getElementById("imgPrevPost");
        const img = div.querySelector(".imgPrevImg");
        const txt = div.querySelector(".imgPrevtext");

        dp.addEventListener("change",function() {
            const file = this.files[0];
            if(file) {
                const reader = new FileReader();
                img.style.display = "block";
                div.style.display = "flex";


                reader.addEventListener("load",function() {
                    img.setAttribute("src",this.result);
                });
                reader.readAsDataURL(file);
            } else {
                img.setAttribute("src","");
                img.style.display = null;
                div.style.display = null;
            }
        });

    </script>

</body>

</html>