<?php
    include("connect.php");
    include("storeUser.php");
    $fName = "";
    $sName = "";
    $email = "";
    $phone = "";
    $password = "";
    $dob = "";
    $error = "";
    if($_SERVER['REQUEST_METHOD']=='POST') {
        $store = new createUser();
        $error = "";
        $attemptStore = $store->validateData($_POST);
        if($attemptStore!="") {
            $error = $attemptStore;
        } else {
            $error = "";
            header("Location:ProfilePage.php");
            die;
        }
        $fName = $_POST['firstName'];
        $sName = $_POST['surName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $dob = $_POST['dob'];
    }


?>

<!DOCTYPE html>

<html>
    <head>
        <title>CupCake|SignUp</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="./css/main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
        

    </head>

    <body style="background-color: var(--col4);
    color: antiquewhite;">


            <div class="form-box2" align="center" style="margin: 6% auto;">
                <h1 style="color:#9a463d;">CupCake</h1>
                    <h2 align="center"><i>Sign Up Form</i></h2>
                    <form method="post" action="">
                    <div style="display: flex;">
                        <div style="flex:1">
                            <div class="input-box">
                                <input name="firstName" value="<?php echo $fName?>" type="text" placeholder="First Name">
                            </div>  
                        </div>

                        <div style="flex:1">
                            <div class="input-box">
                                <input name="surName" value="<?php echo $sName?>" type="text" placeholder="Sur Name">
                            </div> 
                        </div>
                    </div>
                    
                    <div style="display: flex;">
                        <div style="flex:1">
                            <div class="input-box2">
                                <input name="email" type="email" value="<?php echo $email?>" placeholder="Email Address">
                            </div>  
                        </div>

                        <!--<div style="flex:0.2; padding-top:35px;">
                            OR 
                        </div>--->

                        <div style="flex:1">
                            <div class="input-box2">
                                <input name="phone" value="<?php echo $phone?>" type="number" placeholder="Mobile Number">
                            </div> 
                        </div>
                    </div>
                    <div style="display: flex;">
                   
                    <div class="input-box">
                        <input name="password"value="<?php echo $password?>" type="password" placeholder="Password" id="myInput">
                        <span class="eye" onclick="hidetoggle()">
                            <i id="hide1" class="fa fa-eye"></i>
                            <i id="hide2" class="fa fa-eye-slash"></i>
                        </span>
                    </div>
                  
                    </div>

                    <label style="color:#c6c9d8bf">Birth Date : </label>
                    <input name="dob" value="<?php echo $dob?>" type="date" placeholder="Birth Date" >

                    <div style="display: flex; padding-top:25px;" >
                        <div style="flex: 0.2; color:#c6c9d8bf;">Sex : </div>

                        <div style="flex:1;">
                            <div style="display: flex;" align="left">
                                <div style="flex: 0.3;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Male" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Male
                                        </label>
                                    </div>                           
                                </div>
                                <div style="flex: 0.3;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Female" name="flexRadioDefault" id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Female
                                        </label>
                                    </div>                            
                                </div>
                                <div style="flex: 0.3;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" value="Prefer Not to Say" name="flexRadioDefault" id="flexRadioDefault3" checked>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Prefer Not to Say
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div style="padding-top: 5%;">
                        <span class="error start" style="font-size: 95%; color:red"> <?php echo $error?></span>
                  
                    
                        <input type="submit" id="button" class="login-btn" value="Sign Up">

                    </div>
                    </form>

                    
                    
                    

                    <!--<button type="button" class="login-btn">Sign Up</button>-->
                    <br>
                    <a class="hyper" href="#">Already Got an account? Sign In</a>

                    <div class="input-box"></div>
                    <h6>OR</h6><p>Sign Up with:</p><br>
                    <div>
                        <a>
                        <i class="google fa-brands fa-square-google-plus" style="font-size: 4vw;margin-right:3%;"></i>
                        </a>
                        <a>
                        <i class="facebook fa-brands fa-square-facebook" style="font-size: 4vw;margin-right:3%;"></i>
                        </a>
                        <a>
                        <i class="twitter fa-brands fa-square-twitter" style="font-size: 4vw;"></i>
                        </a>
                        
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