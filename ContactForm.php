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
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    print_r($_POST);
    if ($res == "") {
        header("Location: ContactForm.php");
        die;
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Cupcake|Contact Us</title>
    <link rel="icon" type="img/svg" href="img/cupcake-wh.svg">
</head>

<body class="textsizeCorrect">


    <?php include("navBar.php") ?>
    <div id="ContactbodyContainer">

        <div class="leftcol">
            <div class="container">
                <div class="biggerText" style="margin-bottom: 15%;">
                    Contact Us. <br><br>
                </div>

                <a href="" style="color: antiquewhite; text-decoration:none">
                    <i class="fa fa-map-marker" style="font-size:1.5vw;color:white"></i> <br>
                    Address <br>
                    <span class="smallerText"> Babar Road, Dhaka, Bangladesh</span> <br><br>
                </a>
                <a href="" style="color: antiquewhite; text-decoration:none">
                    <i class="fa fa-phone" style="font-size:1.5vw;color:white"></i> <br>
                    Lets Talk <br>
                    <span class="smallerText"> +8801963591222</span> <br><br>
                </a>

                <a href="" style="color: antiquewhite; text-decoration:none">
                    <i class="fa fa fa-paper-plane-o" style="font-size:1.5vw;color:white"></i>
                    <br>
                    General Support <br>
                    <span class="smallerText"> sendhelp@gmail.com</span> <br><br>
                </a>
            </div>

        </div>
        <div class="rightcol">
            <div class="container">
                <div class="biggerText" style="margin-bottom: 15%;">
                    Send us a message! <br><br>
                </div>

                <form method="post">
                    <div class="mb-5">
                        <label for="name" class="start smallerText">Tell us your name</label><br>
                        <input class="start contact" name="name" type="text" id="name" class="form-control textsizeCorrect"
                            placeholder="Your Name..." autocomplete="off">
                        <br>
                    </div>
                    <div class="mb-5">
                        <label for="name" class="start smallerText">Enter your e-mail</label><br>
                        <input class="start contact" name="email" type="email" id="email" class="form-control textsizeCorrect"
                            placeholder="Eg.example@gmail.com" autocomplete="off">
                        <br>
                    </div>
                    <div class="mb-5">
                        <label for="number" class="start smallerText">Enter your phone number</label><br>
                        <input class="start contact" name="number" type="number" id="number"
                            class="form-control textsizeCorrect" placeholder="Eg. +8801234567890" autocomplete="off">
                        <br>
                    </div>
                    <div class="mb-5">
                        <label for="message" class="start smallerText">Message</label><br>
                        <textarea class="start contact" name="message" rows="4" cols="1" class="form-control textsizeCorrect"
                            id="message" placeholder="Write us a Message"></textarea>
                        <br>
                    </div>
                    <div class="mb-5">
                        <input id="submitbutton" type="submit" name="submit" class="addhover main-btn"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>