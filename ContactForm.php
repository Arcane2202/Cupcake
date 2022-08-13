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
                        <input class="start" name="name" type="text" id="name" class="form-control textsizeCorrect"
                            placeholder="Your Name..." autocomplete="off">
                        <br>
                    </div>
                    <div class="mb-5">
                        <label for="name" class="start smallerText">Enter your e-mail</label><br>
                        <input class="start" name="email" type="email" id="email" class="form-control textsizeCorrect"
                            placeholder="Eg.example@gmail.com" autocomplete="off">
                        <br>
                    </div>
                    <div class="mb-5">
                        <label for="number" class="start smallerText">Enter your phone number</label><br>
                        <input class="start" name="number" type="number" id="number"
                            class="form-control textsizeCorrect" placeholder="Eg. +8801234567890" autocomplete="off">
                        <br>
                    </div>
                    <div class="mb-5">
                        <label for="message" class="start smallerText">Message</label><br>
                        <textarea class="start" name="message" rows="4" cols="1" class="form-control textsizeCorrect"
                            id="message" placeholder="Write us a Message"></textarea>
                        <br>
                    </div>
                    <div class="mb-5">
                        <input id="submitbutton" type="submit" name="submit" class=" main-btn"></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</body>

</html>