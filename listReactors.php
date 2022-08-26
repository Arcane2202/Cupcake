
<?php
    $img = $media->preview($val['dp'],'dp');
?>

<div id="reactorLister">
    <a href="ProfilePage.php?id=<?php echo $val['userID']; ?>" style="color: antiquewhite; text-decoration:none">
        <img src="<?php echo $img ?>" id="reactorimgcontainer" alt="reactor">
        <span class="texthover reactor">
            <?php echo $val['firstName']." ".$val['lastName'] ?>
        </span>
    </a>

    <?php

        if($_GET['type']=='friendRequests') {

            $id = $val['userID'];

            echo "
                <a href=''>
                    <input class='btn-with-hover' id='submitButton' type='submit' value='Delete'
                        style='border-radius: 10px;margin-top:1.5%;margin-right:2%;'> </a>

                <a href='react.php?type=friendsCount&postid=$id'>
                    <input class='btn-with-hover' id='submitButton' type='submit' value='Confirm'
                        style='border-radius: 10px;margin-top:1.5%;margin-right:2%'> </a>

                
            
            ";
        }

    ?>

                            

</div>