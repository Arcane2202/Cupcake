<?php

    class userData {

        public function fetchData($userID) {
            $quer = "SELECT * FROM USERS WHERE userID = $userID limit 1";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if($res) {
                $ans = $res[0];
                return $ans;
            } else {
                return false;
            }
        }

        public function getFriendData($userId) {
            $quer = "SELECT * FROM USERS WHERE userID != $userId";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if($res) {
                return $res;
            } else {
                return false;
            }
        }
    }

    ?>