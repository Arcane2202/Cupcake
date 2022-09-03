<?php
include("connect.php");
include("userInformation.php");
$user = "";
$query = "SELECT * FROM users";
$db = new connectDatabase();
$us = $db->read($query);
$query = "SELECT * FROM posts";
$res2 = $db->read($query);
$query = "SELECT * FROM comments";
$res3 = $db->read($query);
$query = "SELECT * FROM reacts";
$res4 = $db->read($query);
$user = count($us);
$post = count($res2);
$comment = count($res3);
$react = count($res4);
$quer = "SELECT * FROM support";
$res = $db->read($quer);
$cnt=0;
include("media.php");
$media = new media();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="img/svg" href="img/cupcake-wh.svg">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css">


    <title>Cupcake|Admin Panel</title>
</head>

<body>
    <div class="side-menu">
        <div class="brand-name ">
            <h1 class="tubelight">Cupcake</h1>
            <h3 class="tubelight" style="font-size:20px;">Admin Panel</h3>
        </div>

        <ul class="ul-spacing">
            <li class="Dashboard"><i class="fas fa-chart-line"></i>Dashboard</li>
            <li class="Feedback"><i class="far fa-comment-alt"></i>Feedback</li>
            <li class="Handle"><i class="fas fa-user-cog"></i>User Handle</li>

        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
                <h1 style="color:brown;">WELCOME TO CUPCAKE, Admin!</h1>
                <div class="user" style="float:right;">
                    <a href="#" class="btn">LOG OUT</a>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="cards">
                <div class="cards-content">
                    <div class="card">
                        <div class="box">
                            <h1><?php echo $user ?></h1>
                            <h3>USERS</h3>
                        </div>
                        <div class="icon-case">
                            <i class="fas fa-users floating"></i>
                        </div>
                    </div>

                    <div class="card">
                        <div class="box">
                            <h1><?php echo $post ?></h1>
                            <h3>POSTS</h3>
                        </div>
                        <div class="icon-case">
                            <i class="fas fa-mail-bulk floating"></i>
                        </div>
                    </div>

                    <div class="card">
                        <div class="box">
                            <h1><?php echo $react ?></h1>
                            <h3>REACTS</h3>
                        </div>
                        <div class="icon-case">
                            <i class="fas fa-heart floating"></i>
                        </div>
                    </div>

                    <div class="card">
                        <div class="box">
                            <h1><?php echo $comment ?></h1>
                            <h3>COMMENTS</h3>
                        </div>
                        <div class="icon-case">
                            <i class="fas fa-comment-alt floating"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="content-2">-->
                <div class="recent-feedbacks">
                    <div class="title">
                        <h2> Recent Feedbacks </h2>
                        <a href="#" class="btn">View all</a> 
                    </div>
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>E-Mail</th>
                            <th>Phone Number</th>
                            <th>Message</th>
                        </tr>
                        <?php
                        foreach ($res as $valluk) {
                        ?>
                            <tr>


                                <td><?php echo $valluk['userid'] ?></td>
                                <td><?php echo $valluk['name'] ?></td>
                                <td><?php echo $valluk['email'] ?></td>
                                <td><?php echo $valluk['phone'] ?></td>
                                <td><?php echo $valluk['message'] ?></td>


                            </tr>
                        <?php } ?>
                    </table>
                </div>
                <div class="new-users">
                    <div class="title">
                        <h2> New Users </h2>
                        <a href="#" class="btn">View all</a>
                    </div>
                    <table>
                        <tr>
                            <th>User DP</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>User E-Mail</th>
                            <th>User Phone Number</th>
                            <th>User Gender</th>
                            <th>User Friend Count</th>
                            <th>User Friend Request</th>
                            <th>User React Count</th>
                            <th>User Join Date</th>
                        </tr>
                        <?php
                        foreach ($us as $valluk) {
                            $img = $media->preview($valluk['dp'], 'dp');
                        ?>
                            <tr>
                                <td><img id="" src="<?php echo $img ?>" style="width:50px;border-radius:50%;"></td>

                                <td><?php echo $valluk['userID'] ?></td>
                                
                                <td><?php echo $valluk['firstName'] . " " . $valluk['lastName'] ?></td>
                                <td><?php echo $valluk['email'] ?></td>
                                <td><?php echo $valluk['phone'] ?></td>
                                <td><?php echo $valluk['gender'] ?></td>
                                <td><?php echo $valluk['friendsCount'] ?></td>
                                <td><?php echo $valluk['friendRequests'] ?></td>
                                <?php
                                $quer = "SELECT reacts FROM reacts";
                                $ress = $db->read($quer);
                                $resAr = json_decode($ress[0]['reacts'], true);
                                $cnt = 0;
                                foreach ($resAr as $value) {
                                    if ($value['reactor'] == $valluk['userID']) {
                                        $cnt++;
                                    }
                                }
                                ?>
                                <td><?php echo $cnt ?></td>
                                <td><?php echo $valluk['date'] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                    

                </div>
            <!--</div>-->
        </div>

    </div>




    <script>
        const Handle = document.querySelector(".Handle");
        const Dashboard = document.querySelector(".Dashboard");
        const Feedback = document.querySelector(".Feedback");
        const cards = document.querySelector(".cards");
        const feedbacks = document.querySelector(".recent-feedbacks");
        const users = document.querySelector(".new-users");


        Dashboard.onclick = () => {

            Feedback.classList.remove("active");
            Handle.classList.remove("active");
            Dashboard.classList.add("active");
            cards.classList.add("show");
            cards.classList.remove("hide");
            feedbacks.classList.add("hide");
            feedbacks.classList.remove("show");
            users.classList.remove("show");
            users.classList.add("hide");

        }

        Feedback.onclick = () => {
            Dashboard.classList.remove("active");
            Handle.classList.remove("active");
            Feedback.classList.add("active");
            cards.classList.add("hide");
            cards.classList.remove("show");
            feedbacks.classList.add("show");
            feedbacks.classList.remove("hide");
            users.classList.remove("show");
            users.classList.add("hide");

        }
        Handle.onclick = () => {
            Dashboard.classList.remove("active");
            Feedback.classList.remove("active");
            Handle.classList.add("active");
            cards.classList.add("hide");
            cards.classList.remove("show");
            feedbacks.classList.add("hide");
            feedbacks.classList.remove("show");
            users.classList.remove("hide");
            users.classList.add("show");
        }
    </script>
</body>



</html>