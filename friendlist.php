<?php
$img = $media->preview($val['dp'],'dp');
?>

<div id="friendLister">
    <a href="ProfilePage.php?id=<?php echo $val['userID']; ?>" style="color: antiquewhite; text-decoration:none">
        <img src="<?php echo $img ?>" id="friendimgcontainer" alt="Friend 1"> <br>
        <span class="texthover">

            <?php echo $val['firstName']." ".$val['lastName'] ?>

        </span>
    </a>
</div>