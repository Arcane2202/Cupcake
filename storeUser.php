<?php

    class createUser {

        private $errorMessage = "";

        function validateData($value) {
            foreach($value as $key=>$val) {
                if(empty($val)) {
                    $this->errorMessage.="*".$key." is empty!<br>";
                } elseif($key=="firstName" && (is_numeric($val)||strstr($val," "))) {
                        $this->errorMessage .= "*Invalid First Name! <br>";
                } elseif($key=="surName" && (is_numeric($val)||strstr($val," "))) {
                        $this->errorMessage .= "*Invalid Sur Name! <br>";
                } elseif($key=="surName" && is_numeric($val)) {
                        $this->errorMessage .= "*Invalid Sur Name! <br>";
                } elseif($key=="email" && !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$val)) {
                        $this->errorMessage .= "*Invalid Email! <br>";
                } elseif($key=="phone" && (!is_numeric($val) || (strlen($val)<6 || strlen($val)>15))) {
                        $this->errorMessage .= "*Invalid Phone! <br>";
                }
            }
            $age = $this->calculateAge($value['dob']);

            if(strlen($value['phone'])!=11 or $value['phone'][0]!='0' or $value['phone'][1]!='1'){
                $this->errorMessage .= "Invalid phone number!<br>";
            }

            if($age <18) {
                $this->errorMessage .= "Age must be 18+ <br>";
            }
            if($this->errorMessage=="") {
                $email = $value['email'];
                $quer = "SELECT * FROM USERS WHERE email = '$email'";
                $database = new connectDatabase();
                $get = $database->read($quer);
                if($get) {
                    $this->errorMessage .= "*Email Already In Use!";
                    return $this->errorMessage;
                } else {
                     $this->storeData($value);
                }
            } else {
                return $this->errorMessage;
            }
        }

        function storeData($value) {
            $userID=$this->userIdGenerate();
            $firstName=ucfirst($value['firstName']);
            $lastName=ucfirst($value['surName']);
            $email=$value['email'];
            $phone=$value['phone'];
            $gender=$value['flexRadioDefault'];
            $dob = $value['dob'];

            $password=password_hash($value['password'],PASSWORD_BCRYPT);
            $urlAdress=$this->urlGenearate($firstName,$lastName);
            if($gender=="Female") {
                $dp = "images/girlDummy.jpg";
            } else {
                $dp = "images/manDummy.jpg";
            }
            $cover = "images/coverDummy.jpg";
            $quer = "INSERT INTO USERS(userID,firstName,lastName,email,phone,gender,password,urlAdress,dp,cover,birthDate)
            VALUES('$userID','$firstName','$lastName','$email','$phone','$gender','$password','$urlAdress','$dp','$cover','$dob')";
            $database = new connectDatabase();
            $table = $userID."table";
            $database->write($quer);
            $quer = "CREATE TABLE IF NOT EXISTS $table (
                id bigint(20) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                userId varchar(100) ,
                friendid varchar(100) ,
                state varchar(100) ,
                date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
              )";
            $database->write($quer);
        }

        private function urlGenearate($fname, $lname) {
            $url = strtolower($fname)."_";
            $url .= strtolower($lname);
            $url.=rand(1,1000); //DevSkim: ignore DS148264 
            return $url;
        }

        private function userIdGenerate() {
            $len = rand(5,20); //DevSkim: ignore DS148264  
            $id = "";
            for($i=1;$i<=$len;$i++) {
                $id .= rand(1,9); //DevSkim: ignore DS148264 
            }
            return $id;
        }
        function calculateAge($birthDate) {
            
            $birthDate = explode("-", $birthDate);
            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
              ? ((date("Y") - $birthDate[0]) - 1)
              : (date("Y") - $birthDate[0]));
            return $age;
        }
    }

    ?>