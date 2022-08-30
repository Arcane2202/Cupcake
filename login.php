<?php

session_start();
if(isset($_SESSION['user'])) {
    header("Location:HomePage.php");
}
session_start();
    include("connect.php");
    include("loginUser.php");
    $email = "";
    $password = "";
    $error = "";
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $enter = new loginUser();
        $error = "";
        $attemptLogin = $enter->validateData($_POST);
        if($attemptLogin!="") {
            $error = $attemptLogin;
        } else {
            $error = "";
            header("Location: ProfilePage.php");
            die;
        }
        $email = $_POST['email'];
        $password = $_POST['password'];
    }
?>

<!DOCTYPE html>

<html>
    <head>
        <link rel="icon" type="img/svg" href="img/cupcake-wh.svg">
        <title>CupCake|Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="./css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
        
    </head>

    <body style="background-color: var(--col4);color: antiquewhite;">
    <div class="row">
        <div class="col-lg-8 col">
            <div class="co-left-childd">
                <div>
                    <h1 class="tubelight"> Cupcake </h1>

                    <div class="marquee">
                        <div>A platform for the youth to resurrect the friendship</div>                 
                    </div>
                </div>         
                

            </div>         
        </div>

        <div class="col-lg-4 col">
            <div class="co-right-childd">
            <div class="form-box brdr" align="center" >
                
                <h1 align="center">Login Form</h1>
                <form method="post" action="">
                    <div class="input-box">
                        <i class="fa fa-envelope" style="position: absolute; margin-top:5px;"></i>
                        <input style="margin-left: 20px;" type="email" name="email" value="<?php echo $email ?>" placeholder="Email ID">
                    </div>
                    <div class="input-box">
                        <i class="fa fa-key" style="position: absolute; margin-top:5px;"></i>
                        <input style="margin-left: 20px;" type="password" name="password" value="<?php echo $password ?>" placeholder="Password" id="myInput">
                        <span class="eye" onclick="hidetoggle()" style="margin-left: -25px;">
                            <i id="hide1" class="fa fa-eye"></i>
                            <i id="hide2" class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                    <div style="padding-top: 5%;">
                        <span class="error start" style="font-size: 95%; color:red"> <?php echo $error?></span>
                        <input type="submit" id="button" class="login-btn" value="LOG IN">
                    </div>
                </form>
<!--
                <a class="hyper" href="#">Forgotten password</a>

                <div class="input-box"></div>
                    <h6>OR</h6><p>Log in with:</p><br>
                <div>
                    <a><i class="fa-brands fa-square-google-plus google" > </i></a>         
                </div>
                <div class="input-box"></div>
-->
                <div align="center">
                    <a href="signup.php">
                        <button type="submit" id="signup_btn">Create a New Account</button>
                    </a>
                </div>
            </div>
            </div>
            
        </div>
    </div>
    
    
    <script>
        function hidetoggle(){
            var x = document.getElementById("myInput");
            var y = document.getElementById("hide1");
            var z = document.getElementById("hide2");
            
            if(x.type == 'password'){
                x.type = "text";
                y.style.display = "block";
                z.style.display = "none";
            }
            else{
                x.type = "password";
                y.style.display = "none";
                z.style.display = "block";
            }
        }

    </script>
    </body>
</html>