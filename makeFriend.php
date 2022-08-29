<?php
    $userid = $_SESSION['user'];
    $table1 = $userid."table";
    $table2 = $data->taskUser."table";
    if($data->text=="Add Friend") {
            $db = new connectDatabase();
            $quer = "CREATE TABLE IF NOT EXISTS $table1 (
                id bigint(20) AUTO_INCREMENT PRIMARY KEY NOT NULL,
                userId varchar(100) ,
                friendid varchar(100) ,
                state varchar(100) ,
                date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
              )";
            $db->write($quer);
        

        $query = "INSERT INTO $table1 (userId, friendid, state) VALUES ($userid,$data->taskUser,'sent request')";
        $db->write($query);
        

            $quer = "CREATE TABLE IF NOT EXISTS $table2 (
                id bigint(20) AUTO_INCREMENT PRIMARY KEY,
                userId varchar(100) ,
                friendid varchar(100) ,
                state varchar(100) ,
                date timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
              )";
            $db->write($quer);
        
        $query = "INSERT INTO $table2 (userId, friendid, state) VALUES ($data->taskUser,$userid,'got request')";
        $db->write($query);
        $obj = (object)[];
        $obj->act = "sentRequest";
        $obj->text = "Cancel Request";
        $obj->text2 = "";
        $obj->show = "none";
        echo json_encode($obj);
    } elseif($data->text=="Cancel Request" || $data->text=="Delete" || $data->text=="Unfriend") {
        $userid = $_SESSION['user'];
        $table1 = $userid."table";
        $table2 = $data->taskUser."table";
        $db = new connectDatabase();
        $query = "DELETE FROM $table1 WHERE userId = '$userid' AND friendid = '$data->taskUser' limit 1";
        $db->write($query);
        $query = "DELETE FROM $table2 WHERE userId = '$data->taskUser' AND friendid = '$userid' limit 1";
        $db->write($query);
        $obj = (object)[];
        $obj->act = "canceledRequest";
        $obj->text = "Add Friend";
        $obj->text2 = "";
        $obj->show = "none";
        echo json_encode($obj);
    } else {
        $userid = $_SESSION['user'];
        $table1 = $userid."table";
        $table2 = $data->taskUser."table";
        $db = new connectDatabase();

        $query = "DELETE FROM $table1 WHERE userId = '$userid' AND friendid = '$data->taskUser' limit 1";
        $db->write($query);

        $query = "INSERT INTO $table1 (userId, friendid, state) VALUES ($userid,$data->taskUser,'friends')";
        $db->write($query);

        $query = "DELETE FROM $table2 WHERE userId = '$data->taskUser' AND friendid = '$userid' limit 1";
        $db->write($query);

        $query = "INSERT INTO $table2 (userId, friendid, state) VALUES ($data->taskUser,$userid,'friends')";
        $db->write($query);

        $obj = (object)[];
        $obj->act = "acceptedRequest";
        $obj->text = "Unfriend";
        $obj->text2 = "";
        $obj->show = "block";
        echo json_encode($obj);
    }
