<?php


    session_start();
    //unset($_SESSION['user']);
    include("connect.php");
    include("loginUser.php");
    include("userInformation.php");
    include("createPost.php");
    include("media.php");
    include("getProfile.php");
    
    $user = $_SESSION['user'];
    $media = new media();
    $log = new loginUser();
    $userData=$log->loginCheck($_SESSION['user']);
   if(isset($_GET['id'])) {
    $prof = new getProfile();
    $profData = $prof->getData($_GET['id']);
    if(is_array($profData)) {
        $userData = $profData[0];
    }
   }
    
    
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $userId = $_SESSION['user'];
        $poster = new createPosts();
        $res = $poster->createPost($_POST,$userId,$_FILES);

        if($res == "") {
            header("Location: ProfilePage.php");
            die;
        }
    }
    $userId = $userData['userID'];
    $poster = new createPosts();
    $userPosts = $poster->getPosts($userId);

    $use = new userData();
    $friends = $use->getFriendData($userId);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Cupcake|Profile</title>
    <link rel="icon" type="image/png" href="images/logo.png">
</head>

<body class="textsizeCorrect">
    <?php /*include('navBar.php');*/?>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php 
          $user_id = $_GET['user_id'];
          $database = new connectDatabase();
          $quer = "SELECT * FROM users WHERE userID = $user_id";
          $res = $database->read($quer);
          $row = $res[0];
        ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="<?php echo $media->preview($row['dp'],'dp') ?>" alt="">
                <div class="details">
                    <span><?php echo $row['firstName']. " " . $row['lastName'] ?></span>
                    <!--<p><?php /*echo $row['status'];*/ ?></p>-->
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..."
                    autocomplete="off" style="background: #111; color:#fff;">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

</body>

</html>