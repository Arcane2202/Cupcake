<?php
session_start();
//unset($_SESSION['user']);
include("connect.php");
include("loginUser.php");
include("userInformation.php");
include("createPost.php");

$log = new loginUser();
$userData = $log->loginCheck($_SESSION['user']);
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    print_r($_POST);
    $userId = $_SESSION['user'];
    $poster = new createPosts();
    $res = $poster->createPost($_POST, $userId);

    if ($res == "") {
        header("Location: ProfilePage.php");
        die;
    }
}
$userId = $_SESSION['user'];
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
    <title>Cupcake|Home</title>
    <link rel="icon" type="image/png" href="images/logo.png">
</head>

<body class="textsizeCorrect">
    <?php include('navBar.php');?>
    <div id="bodyContainer">
        <div style="display: flex;">

            <div id="condivcontainer1">
                <div id="content">

                    <div id="rowAdd">
                        <a href="ProfilePage.php" style="color: antiquewhite; text-decoration:none">
                            <img src="images/profilepic.jpg" id="homeProfileImage" alt="Friend 1"> <br>
                            <span class="texthover"><?php echo $userData['firstName']." ".$userData['lastName'] ?></span>
                        </a>
                    </div>

                    <div id="rowAdd">
                        <a href="" style="color: antiquewhite; text-decoration:none">
                            <i class="fas fa-user-friends fa-2x" style="padding-left: 5%; padding-right: 5%"></i>
                            <span class="texthover">Friends</span>
                        </a>
                    </div>
                    <div id="rowAdd">
                        <a href="" style="color: antiquewhite; text-decoration:none">
                            <i class="fa fa-users fa-2x" aria-hidden="true" style="padding-left: 5%; padding-right: 5%"></i>
                            <span class="texthover">Groups</span>
                        </a>
                    </div>

                    <div id="rowAdd">
                        <a href="" style="color: antiquewhite; text-decoration:none">
                            <i class="fa fa-caret-down fa-2x" aria-hidden="true" style="padding-left: 8%; padding-right:8%"></i>
                            <span class="texthover">See More</span>
                        </a>
                    </div>
                </div>
            </div>
            <div id="condivcontainer2">

                <div id="containposter">

                    <textarea placeholder="What's on your mind?"></textarea>
                    <button class="btn btn-with-hover">
                        <img src="images/addpic.png" width="20" />
                    </button>
                    <button class="btn btn-with-hover">
                        <img src="images/addvdo.png" width="20" />
                    </button>
                    <input class="btn-with-hover" id="submitButton" type="submit" value="Post">
                    <br>

                </div>

                <div id="statusBar">

                    <div id="status">

                        <div>
                            <a href="" style="color: antiquewhite; text-decoration:none">
                                <img src="images/profilepic.jpg" style=" width: 55%; margin-top:5%; margin-right: 1%;">
                            </a>
                        </div>

                        <div>

                            <div class="texthover" id="NameHeader" style="color: var(--col9);">
                                <a href="" style="color: antiquewhite; text-decoration:none">
                                    <span class="texthover">Lelouch Lamperouge</span>
                                    <br>
                                </a>
                            </div>
                            <div style="margin-left: 2%;">
                                Lelouch is a handsome young man with black hair and violet eyes, which he inherited from
                                his mother. Lelouch is somewhat scrawny, having little muscle, and like most characters
                                in the series, is rather thin. In spite of this, Lelouch is considerably tall, standing
                                at least a head taller than Kallen, and apparently being slightly taller than Suzaku.
                                Lelouch usually wears the Ashford Academy uniform, or the Zero uniform. Outside of
                                Ashford, his primary casual outfit is a red jacket with a black shirt underneath and
                                grey trousers, though he has occasionally worn other clothing. As Emperor, he wears a
                                white robe with gold accents and a matching hat; both sport a red eye motif, referencing
                                his Geass power.

                                <br> <br>
                                <div id="reactSec">
                                    <div id="flex" style="padding-left: 18%;">

                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div id="flex">
                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-comment fa-2x" aria-hidden="true"></i>

                                        </a>
                                    </div>
                                    <div id="flex">
                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-share fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="status">

                        <div>
                            <a href="" style="color: antiquewhite; text-decoration:none">
                                <img src="images/profilepic.jpg" style=" width: 55%; margin-top:5%; margin-right: 1%;">
                            </a>
                        </div>

                        <div>

                            <div id=" NameHeader" style="color: var(--col9);">
                                <a href="" style="color: antiquewhite; text-decoration:none">
                                    <span class="texthover">Lelouch Lamperouge</span>
                                    <br>
                                </a>
                            </div>
                            <div style="margin-left: 2%;">
                                Lelouch is a handsome young man with black hair and violet eyes, which he inherited from
                                his mother. Lelouch is somewhat scrawny, having little muscle, and like most characters
                                in the series, is rather thin. In spite of this, Lelouch is considerably tall, standing
                                at least a head taller than Kallen, and apparently being slightly taller than Suzaku.
                                Lelouch usually wears the Ashford Academy uniform, or the Zero uniform. Outside of
                                Ashford, his primary casual outfit is a red jacket with a black shirt underneath and
                                grey trousers, though he has occasionally worn other clothing. As Emperor, he wears a
                                white robe with gold accents and a matching hat; both sport a red eye motif, referencing
                                his Geass power.

                                <br> <br>
                                <div id="reactSec">
                                    <div id="flex" style="padding-left: 18%;">

                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div id="flex">
                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-comment fa-2x" aria-hidden="true"></i>

                                        </a>
                                    </div>
                                    <div id="flex">
                                        <a href="" class="btn-with-hover" style="color: var(--col8);">
                                            <i class="fa fa-share fa-2x" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>