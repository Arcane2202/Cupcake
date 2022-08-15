<?php

class loginUser
{
    private $errorMsg = "";
    function validateData($value)
    {
        if (empty($value['email'])) {
            $this->errorMsg .= "Enter Email<br>";
        } elseif (empty($value['password'])) {
            $this->errorMsg .= "Enter Password<br>";
        }
        if ($this->errorMsg != "") {
            return $this->errorMsg;
        }
        $email = $value['email'];
        $password = $value['password'];
        $quer = "SELECT *FROM USERS WHERE email = '$email' limit 1";
        $database = new connectDatabase();
        $res = $database->read($quer);
        if ($res) {
            $val = $res[0];
            //if($val['password']==password_hash($paspassword_verify($password, $val['password'])sword,PASSWORD_ARGON2I)) {
            $storedPass = $val['password'];
            $check = password_verify($password, $storedPass);
            if ($check) {
                $this->errorMsg = "";
                $_SESSION['user'] = $val['userID'];
                return;
            } else {
                $this->errorMsg .= "Wrong Password!<br>";
            }
        } else {
            $this->errorMsg .= "No User Found with this email!<br>";
        }
        return $this->errorMsg;
    }

    public function loginCheck($userID)
    {
        if (is_numeric($userID)) {
            $quer = "SELECT * FROM USERS WHERE userID = '$userID' limit 1";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if ($res) {
                return $res[0];
            }else {
                header("Location: login.php");
                die;
            }
        } else {
            header("Location: login.php");
            die;
        }
    }
}
