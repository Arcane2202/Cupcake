<?php

    class loginUser {
        private $errorMsg="";
        function validateData($value) {
            if(empty($value['email'])) {
                $this->errorMsg.="Enter Email<br>";
            } elseif(empty($value['password'])) {
                $this->errorMsg.="Enter Password<br>";
            }
            if($this->errorMsg!="") {
                return $this->errorMsg;
            }
            $email=addslashes($value['email']);
            $password=addslashes($value['password']);
            $quer = "SELECT *FROM USERS WHERE email = '$email' limit 1";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if($res) {
                $val = $res[0];
                if($password==password_hash($val['password'],PASSWORD_ARGON2I)) {
                    $this->errorMsg="";
                    $_SESSION['user'] = $val['userID'];
                    return;
                } else {
                    $this->errorMsg.="Wrong Password!<br>";
                }
            }  else {
                $this->errorMsg.="No User Found with this email!<br>";
            }
            return $this->errorMsg;
        }
    }
?>