<?php
$id = $val['userID'];
$text = "";
    $text2 = "";
    $type1 = "";
    $type2 = "";
    $img = $media->preview($val['dp'], 'dp');
    $show = "none";
if($id!=$_SESSION['user']) {
    
    
    $friendId = $id;
    $table = $_SESSION['user'] . "table";
    $text = "Add Friend";
    $text2 = "";
    $type1 = 1;
    $type2 = "";
    $show = "none";
    $query = "SELECT * FROM $table WHERE friendid = '$friendId' limit 1";
    $db = new connectDatabase();
    $res = $db->read($query);
    if ($res) {
        $res = $res[0];
        if ($res['state'] == "sent request") {
            $text = "Cancel Request";
            $type1 = 2;
        } elseif ($res['state'] == "got request") {
            $text = "Confirm";
            $type1 = 3;
            $text2 = "Delete";
            $type2 = 4;
        } else {
            $text = "Unfriend";
            $type1 = 5;
            $show = "block";
        }
    }
}
?>


<div id="friendLister" style="background-color:var(--col4);">
    <a href="ProfilePage.php?id=<?php echo $val['userID']; ?>" style="color: antiquewhite; text-decoration:none">
        <img id="reactorimgcontainer" src="<?php echo $img ?>" style="background-color:var(--col4); id="friendimgcontainer" alt="Friend 1">
        <span class="texthover">

            <?php echo $val['firstName'] . " " . $val['lastName'] ;
            
            $messageid = "messageButton".$val['userID'];
            $deleteid = "deleteButton".$val['userID'];
            $profid = "profileButton".$val['userID'];
            ?>
        </span>
        <button onclick='getData4(event,<?php echo  $type1 ?>,<?php echo  $friendId ?>)' class='btn-with-hover profileButton' id='<?php echo $profid?>' value='<?php echo $text ?>' style='border-radius: 10px;margin-top:2%;margin-right:5%'><?php echo $text ?></button>

        <?php
        
        if ($text2 != "") {
        ?>
            <button onclick='getData4(event,<?php echo  $type2 ?>,<?php echo  $friendId ?>)' class='btn-with-hover deleteButton' id='<?php echo $deleteid?>' value='<?php echo "$text2" ?>' style='border-radius: 10px;margin-top:2%;margin-right:4px'><?php echo $text2 ?></button>
        <?php
        }
        ?>
        <a href="message.php?id=<?php echo $userData['userID']; ?>">
            <button onclick='' class='btn-with-hover messageButton' id='<?php echo $messageid?>' value='' style='display:<?php echo $show ?>;border-radius: 10px;margin-top:2%;margin-right:4px'>
                Message</button></a>
    </a>

   
</div> 

<script type="text/javascript">
        function makeFriend4(data, task, tag, taskUser) {
            var ajax = new XMLHttpRequest();
            ajax.addEventListener('readystatechange', function() {
                if (ajax.readyState == 4 && ajax.status == 200) {
                    response4(ajax.responseText, task, tag,taskUser);
                }
            });
            data = JSON.stringify(data);
            ajax.open("ProfilePage", "ajax.php", true);
            ajax.send(data);
        }

        function getData4(e, task, taskUser) {
            e.preventDefault();
            var data = {};
            data.act = "makeFriend";
            data.task = task;
            data.taskUser = taskUser;
            data.text = e.target.innerHTML;
            makeFriend4(data, task, e.target, taskUser);
        }

        function response4(res, data, tag, taskUser) {
            if (res != "") {
                obj = JSON.parse(res);
                if (data == 4) {
                    second = document.getElementById("deleteButton"+taskUser);
                    second.style.display = "none";
                    profileButton = document.getElementById("profileButton"+taskUser);
                    document.getElementById("messageButton"+taskUser).innerHTML = obj.show;
                    profileButton.innerHTML = obj.text;
                } else if (data == 3) {
                    second = document.getElementById("deleteButton"+taskUser);
                    second.style.display = "none";
                    profileButton = document.getElementById("profileButton"+taskUser);
                    document.getElementById("messageButton"+taskUser).style.display = obj.show;
                    profileButton.innerHTML = obj.text;
                } else {
                    document.getElementById("messageButton"+taskUser).style.display = obj.show;
                    tag.innerHTML = obj.text;
                }
            }
        }
    </script>