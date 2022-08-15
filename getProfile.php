<?php

    class getProfile {
        function getData($userId) {
            $database = new connectDatabase();
            $quer = "SELECT * FROM USERS WHERE userID = '$userId' limit 1";
            return  $database->read($quer);
        }
    }

?>