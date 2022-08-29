

    <div style="width:100%;border-bottom: solid thin;overflow-y:scroll">
    <div class="texthover" id="NameHeader" style="color: var(--col9); margin-bottom:-3%">
        <a href="ProfilePage.php?id=<?php echo $commentuser['userID']; ?>" style="color: antiquewhite; text-decoration:none">
            <img src="<?php echo $media->preview($commentuser['dp'], 'dp') ?>" style="border-radius:50px; width:6%;">
        </a>
        <a href="ProfilePage.php?id=<?php echo $commentuser['userID']; ?>" style="margin-left:2%; color: antiquewhite; text-decoration:none;">
            <span class="texthover"><?php echo $commentuser['firstName'] . " " . $commentuser['lastName'];
                                    $name = $commentuser['firstName'] . " " . $commentuser['lastName'];

                                    ?></span>
        </a>


    </div>
    <div id="textPart" style="margin-left:10%;margin-top:-7%">
        <?php
        $comment = "";
        if ($val['comment'] != "") {
            $comment = htmlspecialchars($val['comment']);
            echo "<p> $comment<br></p>";
        }
        ?>
    </div>
    </div>
