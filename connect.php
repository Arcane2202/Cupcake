<?php



class connectDatabase
{

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "cubcake";

    function cnct()
    {
        $con = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        return $con;
    }

    function read($quer)
    {
        $con = $this->cnct();
        $res = mysqli_query($con, $quer);
        if (!$res) {
            return false;
        }
        else {
            $val = [];
            while ($row = mysqli_fetch_assoc($res)) {
                $val[] = $row;
            }
            return $val;
        }
    }

    function write($quer)
    {
        $con = $this->cnct();
        $res = mysqli_query($con, $quer);

        if (!$res) {
            return false;
        }
        else {
            return true;
        }
    }
}

$connectDB = new connectDatabase();