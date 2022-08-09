<?php

    class loginUser {
        private $errorMsg="";
        function validateData($value) {

            $email=addslashes($value['email']);
            $password=addslashes($value['password']);
            $quer = "SELECT *FROM USERS WHERE email = '$email' limit 1";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if($res) {
                $val = $res[0];
                if($password==$val['password']) {

                } else {
                    $this->errorMsg.="Wrong Password!<br>";
                }
            }  else {
                $this->errorMsg.="No User Found with that email!<br>";
            }
            return $this->errorMsg;
        }
    }