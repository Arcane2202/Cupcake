<?php

    $img = "";
    if($val['gender']=="Male") {
        $img .= "images/manDummy.jpg";
    } elseif($val['gender']=="Female") {
        $img .= "images/girlDummy.jpg";
    }
?>

<div id="friendLister">
    <a href="" style="color: antiquewhite; text-decoration:none">
        <img src="<?php echo $img ?>" id="friendimgcontainer" alt="Friend 1"> <br>
        <span class="texthover">

            <?php echo $val['firstName']." ".$val['lastName'] ?>

        </span>
    </a>
</div>