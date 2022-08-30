<div style="border:1px solid rgba(165, 42, 42,0.4);height:auto; width:100%; padding-left:5%; padding-right: 5%; margin-top:20px; border-radius:5px; overflow-y:scroll">
    <div class="texthover" id="NameHeader" style="color: var(--col9); margin-bottom:0; ">
        <a href="ProfilePage.php?id=<?php echo $commentuser['userID']; ?>" style="color: antiquewhite; text-decoration:none">
            <img src="<?php echo $media->preview($commentuser['dp'], 'dp') ?>" style="border-radius:50px; width:10%;">
        </a>
        <a class="smallerText" href="ProfilePage.php?id=<?php echo $commentuser['userID']; ?>" style=" margin-left:2%; color: antiquewhite; text-decoration:none; text">
            <span class="texthover"><?php echo $commentuser['firstName'] . " " . $commentuser['lastName'];
                                    $name = $commentuser['firstName'] . " " . $commentuser['lastName'];

                                    ?></span>
        </a>


    </div>
    <div style="margin-left:10%; margin-top:5px; background-color:transparent">
        <?php
        $comment = "";
        if ($val['comment'] != "") {
            $comment = htmlspecialchars($val['comment']);
            echo "<p> $comment<br></p>";
        }
        ?>
    </div>
</div>
