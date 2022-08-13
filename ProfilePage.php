<?php
    session_start();
    //unset($_SESSION['user']);
    include("connect.php");
    include("loginUser.php");
    include("userInformation.php");
    if(isset($_SESSION['user']) && is_numeric($_SESSION['user'])) {
        $userID = $_SESSION['user'];
        $log = new loginUser();
        $check = $log->loginCheck($userID);
        if($check) {
            $user = new userData();
            $userData = $user->fetchData($userID);
            if(!$userData) {
              header("Location: login.php");
              die;  
            } else {

            }
        } else {
            header("Location: login.php");
            die;
        }
    } else {
        header("Location: login.php");
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
    <title>Cupcake|Profile</title>
    <link rel="icon" type="image/png" href="images/logo.png">
</head>

<body class="textsizeCorrect">


    <div id="navBar">
        <div id="containMake">
            <a href="" style="color: antiquewhite; text-decoration:none"><img src="images/logo.png"
                    style="width: 5%; padding: -10%" alt="profilepic">Cupcake</a>
            <input type="text" id="searchBar" placeholder="Search...">
            <a href=""><img src="images/profilepic.jpg" id="profilepic" alt="profilepic"></a>
            <a href=""><img id="profilepic" src="images/messages.png" style="margin-right: 3%;"></a>
            <a href=""><img id="profilepic" src="images/notification.png" style="margin-right: 3%;"></a>
        </div>
    </div>

    <div id="bodyContainer">

        <div id="profileImagesContainer">

            <a href="" style="color: antiquewhite; text-decoration:none">
                <img src="images/cover.jpg" style="width: 100%;" alt="coverpic"> </a>
            <a href="" style="color: antiquewhite; text-decoration:none">
                <img id="profilepicmain" src="images/profilepic.jpg" alt="profilepic"> </a>
            <br>
            <div style="font-size: 1.5vw">
                <b><?php echo $userData['firstName']." ".$userData['lastName'] ?></b>
            </div>
            <br>
            <div id="profButtons"> <a href="" class="texthover" style="color: var(--col8); text-decoration:none"> Timeline </a> </div>
            <div id="profButtons"><a href="" class="texthover" style="color: var(--col8); text-decoration:none">About</a> </div>
            <div id="profButtons"><a href="" class="texthover" style="color: var(--col8); text-decoration:none">Friends</a> </div>
            <div id="profButtons"><a href="" class="texthover" style="color: var(--col8); text-decoration:none">Photos</a> </div>
            <div id="profButtons"><a href="" class="texthover" style="color: var(--col8); text-decoration:none">Settings</a> </div>

        </div>

        <div style="display: flex;">

            <div id="divcontainer1">
                <div id="friendscontainer">

                    <h2>Friends</h2>

                    <div id="friendLister">
                        <a href="" style="color: antiquewhite; text-decoration:none">
                            <img src="images/friend1.jpg" id="friendimgcontainer" alt="Friend 1"> <br>
                            <span class="texthover">Kakashi</span> 
                        </a>
                    </div>
                    <div id="friendLister">
                        <a href="" style="color: antiquewhite; text-decoration:none">
                            <img src="images/friend1.jpg" id="friendimgcontainer" alt="Friend 1"> <br>
                            <span class="texthover">Kakashi</span> 
                        </a>
                    </div>
                    <div id="friendLister">
                        <a href="" style="color: antiquewhite; text-decoration:none">
                            <img src="images/friend1.jpg" id="friendimgcontainer" alt="Friend 1"> <br>
                            <span class="texthover">Kakashi</span> 
                        </a>
                    </div>
                </div>
            </div>
            <div id="divcontainer2">

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
                            <a href=""  style="color: antiquewhite; text-decoration:none">
                                <img src="images/profilepic.jpg" style=" width: 55%; margin-top:5%; margin-right: 1%;">
                            </a>
                        </div>

                        <div>

                            <div " id="NameHeader" style="color: var(--col9);">
                                <a  href="" style="color: antiquewhite; text-decoration:none">
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