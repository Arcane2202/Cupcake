<?php
    $log = new loginUser();
    $userData=$log->loginCheck($_SESSION['user']);
?>
<link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css" />
<link rel="stylesheet" href="css/navStyle.css" />

<!--
<div class="menu-bar textsizeCorrect">
<div id="containMake">
    <ul>
        <li>
            <a href="HomePage.php" class="basic">
            <div class="floating">
                Cupcake
            </div>
            </a>
        </li>
        <li><input type="text" id="searchBar" placeholder="Search..."></li>


        <li><a href="" class="basic icons"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
        <li><a href="" class="basic icons"><i class="fa fa-bell" aria-hidden="true"></i></a></li>
        <li><a href="ProfilePage.php">
                <img src=<?php /*echo $media->preview($userData['dp'],'dp') */?> class="propic" id="profilepic" alt="profilepic"></a>
            <div class="sub-menu">
                <ul>
                    <li> <a href="ProfilePage.php"> Profile</a> </li>
                    <li> <a href="./ContactForm.php"> Help</a> </li>
                    <li> <a href="logout.php"> Logout</a> </li>
                </ul>
            <div>

        </li>
    </ul>
</div>
</div>
-->

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
        <li class="li_icons"><a href="" class="basic icons"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>
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

<script>
    const menuBtn = document.querySelector(".menu-icon span");
    const searchBtn = document.querySelector(".search-icon");
    const cancelBtn = document.querySelector(".cancel-icon");
    const items = document.querySelector(".nav-items");
    const form = document.querySelector("form");
    const pp = document.querySelector(".propic");
    const dropdown = document.querySelector(".dropdown");
   
    menuBtn.onclick = () => {
        items.classList.add("active");
        menuBtn.classList.add("hide");
        searchBtn.classList.add("hide");
        cancelBtn.classList.add("show");
    }

    cancelBtn.onclick = () => {
        items.classList.remove("active");
        menuBtn.classList.remove("hide");
        searchBtn.classList.remove("hide");
        cancelBtn.classList.remove("show");
        form.classList.remove("active");
    }
    searchBtn.onclick = () => {
        form.classList.add("active");
        searchBtn.classList.add("hide");
        cancelBtn.classList.add("show");
    }

</script>
