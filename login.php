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
                <h1 style="color:#9a463d;">Cup Cake</h1>
                <p style="color:#c6c9d8bf;">A platform for the yooth to resurrect the friendship</p>


            </div>

            
                
                
            </div>

            <div style="
            flex:1;
            padding:5%;

            ">
                <div class="form-box" align="center" >
                    <h1 align="center">Login Form</h1>
                    <div class="input-box">
                        <i class="fa fa-envelope"></i>
                        <input type="email" placeholder="Email ID">
                    </div>
                    <div class="input-box">
                        <i class="fa fa-key"></i>
                        <input type="password" placeholder="Password" id="myInput">
                        <span class="eye" onclick="hidetoggle()">
                            <i id="hide1" class="fa fa-eye"></i>
                            <i id="hide2" class="fa fa-eye-slash"></i>
                        </span>
                    </div>

                    <button type="button" class="login-btn">LOG IN</button>
                    <br>
                    <a class="hyper" href="#">Forgotten password</a>

                    <div class="input-box"></div>
                    <h6>OR</h6><p>Log in with:</p><br>
                    <div>
                        <a>
                        <i class="fa-brands fa-square-google-plus google" ></i>
                        </a>
                        <a>
                        <i class="fa-brands fa-square-facebook facebook" ></i>
                        </a>
                        <a>
                        <i class="fa-brands fa-square-twitter twitter" ></i>
                        </a>
                        
                    </div>
                    


                    <div class="input-box"></div>
                    <div align="center">
                        <button type="submit" id="signup_btn">Create a New Account</button>

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