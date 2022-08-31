<?php 
  session_start();
    include_once "config.php";
    include("media.php");
    $media = new media();
    if(!isset($_SESSION['user'])){
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cupcake|Chatbox</title>
    <link rel="stylesheet" href="css/chat.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css" />
</head>

<body>
<!--
<nav class="fixed-top">
    <div class="menu-icon">
        <span class="fas fa-bars"></span>
    </div>


    <a href="HomePage.php" class="basic">
        <div class="logo floating">
            Cupcake
        </div>
    </a>

    <div class="nav-items">
        <li class="li_icons"><a href="getMessagePage.php" class="basic icons"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
        <li class="li_icons"><a href="" class="basic icons"><i class="fa fa-bell" aria-hidden="true"></i></a></li>
        <li class="li_img"><a href="ProfilePage.php">
                <img src=<?php echo $media->preview($userData['dp'],'dp') ?> class="propic" id="profilepic" alt="profilepic">
            </a>

            <div class="dropdown">
                <ul>
                    <li class="dropdown-link"> <a href="ProfilePage.php"> Profile <i class="fa fa-user stickers" aria-hidden="true"></i></a> </li>
                    <li class="dropdown-link"> <a href="./ContactForm.php"> Help <i class="fa fa-question-circle stickers" aria-hidden="true"></i></a> </li>
                    <li class="dropdown-link"> <a href="logout.php"> Logout <i class="fa fa-sign-out stickers" aria-hidden="true"></i></a> </li>
                </ul>
            <div>

        </li>
    </div>
    <div class="search-icon">
        <span class="fas fa-search"></span>
    </div>
    <div class="cancel-icon">
        <span class="fas fa-times"></span>
    </div>

    <form action="#">
        <input type="search" class="search-data" placeholder="Search" required>
        <button type="submit" class="fas fa-search"></button>
    </form>
       
</nav>
-->
<div id="bodyContainer" >
    <div class="wrapper">
        <section class="chat-area">
            <a style="text-decoration:none;color:antiquewhite;" href="ProfilePage.php?id=<?php echo $_GET['id']; ?>"><header>
                <?php 
          
          $user_id = mysqli_real_escape_string($conn, $_GET['id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE userID = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
                
                <img src="<?php echo $media->preview($row['dp'], 'dp') ?>" style="border-radius:50%; width:50px;">
                <div class="details" style="margin-left:1%">
                    <span><?php echo $row['firstName']. " " . $row['lastName'] ?></span>
                </div>
            </header></a>
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
</div>



<script>
    const form = document.querySelector(".typing-area"),
        incoming_id = form.querySelector(".incoming_id").value,
        inputField = form.querySelector(".input-field"),
        sendBtn = form.querySelector("button"),
        chatBox = document.querySelector(".chat-box");

    form.onsubmit = (e) => {
        e.preventDefault();
    }

    inputField.focus();
    inputField.onkeyup = () => {
        if (inputField.value != "") {
            sendBtn.classList.add("active");
        } else {
            sendBtn.classList.remove("active");
        }
    }

    sendBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "insert-chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = "";
                    scrollToBottom();
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
    chatBox.onmouseenter = () => {
        chatBox.classList.add("active");
    }

    chatBox.onmouseleave = () => {
        chatBox.classList.remove("active");
    }

    setInterval(() => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "get-chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    chatBox.innerHTML = data;
                    if (!chatBox.classList.contains("active")) {
                        scrollToBottom();
                    }
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("incoming_id=" + incoming_id);
    }, 500);

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    </script>


</body>

</html>