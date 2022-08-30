<?php
$img = $media->preview($val['dp'], 'dp');
$id = $val['userID'];
$text2 = "Message";
$type1 = 5;
$text = "Unfriend";
$type2 = "";
$friendId = $val['userID'];
$img = $media->preview($val['dp'], 'dp');
?>

<div id="reactorLister">
    <a href="ProfilePage.php?id=<?php echo $val['userID']; ?>" style="color: antiquewhite; text-decoration:none">
        <img id="reactorimgcontainer" src="<?php echo $img ?>" id="friendimgcontainer" alt="Friend 1">
        <span class="texthover">

            <?php echo $val['firstName'] . " " . $val['lastName'] ?>
        </span>
        <button onclick='getData2(event,<?php echo  $type1 ?>,<?php echo  $friendId ?>)' class='btn-with-hover' id='profileButton' value='' style='border-radius: 10px;margin-top:1.5%;margin-right:2%;'>
            <?php echo $text ?></button>
        <a href="message.php?id=<?php echo $val['userID']; ?>">
        <button onclick='getData2(event,<?php echo  $type2 ?>,<?php echo  $friendId ?>)' class='btn-with-hover' id='messageButton' value='' style='border-radius: 10px;margin-top:1.5%;margin-right:2%'>
            <?php echo $text2 ?></button></a>
    </a>

</div>