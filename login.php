<?php
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
        <title>CupCake|Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="./css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
        
    </head>

    <body style="background-color: var(--col4);
    color: antiquewhite;">
<!--
    <div id="navBar">
        <div id="containMake">
                <b>Cup Cake</b> 
            <button type="submit" id="signup_btn">Sign Up</button>
        </div>          
    </div>
-->
    <div style="overflow: hidden; display:flex;">
            <div style="
            flex:3;">

<!--
            <img src="./img/logo.png" style="width:30% ; height:30%;
            margin-top:20%; margin-left:10%;">
-->
                <div style="margin-top:20%; padding-left:20%;">         
                    <h1 class="tubelight"> Cupcake </h1>

                    <div class="marquee">
                        <div>A platform for the youth to resurrect the friendship</div>                 
                    </div>

                </div>         
            </div>

            <div style="
            flex:1;
            padding:5%;

            ">
                <div class="form-box" align="center" >
                    <h1 align="center">Login Form</h1>
                    <form method="post" action="">
                    <div class="input-box">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email ID">
                    </div>
                    <div class="input-box">
                        <i class="fa fa-key"></i>
                        <input type="password" name="password" value="<?php echo $password ?>" placeholder="Password" id="myInput">
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
                    <a class="hyper" href="#">Forgotten password</a>

                    <div class="input-box"></div>
                    <h6>OR</h6><p>Log in with:</p><br>
                    <div>
                        <a>
                        <i class="fa-brands fa-square-google-plus google" > </i>
                        </a>
                        
                        
                    </div>
                    


                    <div class="input-box"></div>
                    <div align="center">
                        <a href="signup.php">
                        <button type="submit" id="signup_btn">Create a New Account</button>
                        </a>
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