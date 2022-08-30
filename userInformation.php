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
            $table = $userId."table";
            $quer = "SELECT * FROM users WHERE userID in (SELECT friendid FROM $table WHERE state = 'friends')";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if($res) {
                return $res;
            } else {
                return false;
            }
        }
        public function getFriendRequests($userId) {
            $table = $userId."table";
            $quer = "SELECT * FROM users WHERE userID in (SELECT friendid FROM $table WHERE state = 'got request')";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if($res) {
                return $res;
            } else {
                return false;
            }
        }
        public function getPeople($userId) {
            $table = $userId."table";
            $quer = "SELECT * FROM users WHERE userID != $_SESSION[user]";
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