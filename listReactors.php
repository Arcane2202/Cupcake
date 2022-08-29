
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

</div>