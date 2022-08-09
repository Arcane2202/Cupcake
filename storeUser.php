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
                }
                elseif($key=="surName" && is_numeric($val)) {
                        $this->errorMessage .= "*Invalid Sur Name! <br>";
                } elseif($key=="email" && !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$val)) {
                        $this->errorMessage .= "*Invalid Email! <br>";
                } elseif($key=="phone" && (!is_numeric($val) || (strlen($val)<6 || strlen($val)>15))) {
                        $this->errorMessage .= "*Invalid Phone! <br>";
                }
            }
            if($this->errorMessage=="") {
                $this->storeData($value);
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
            $password=$value['password'];
            $urlAdress=$this->urlGenearate($firstName,$lastName);
            $quer = "INSERT INTO USERS(userID,firstName,lastName,email,phone,gender,password,urlAdress)
            VALUES('$userID','$firstName','$lastName','$email','$phone','$gender','$password','$urlAdress')";
            $database = new connectDatabase();
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
    }

    ?>