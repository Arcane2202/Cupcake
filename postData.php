<div id="status">

    <div style="width: 100%;">

        <div class="texthover" id="NameHeader" style="color: var(--col9);">
            <a href="" style="color: antiquewhite; text-decoration:none">
                <img src="<?php echo $media->preview($posterUs['dp'],'dp') ?>" style="border-radius:50px; width:10%;">
            </a>
            <a href="" style="margin-left:2%; color: antiquewhite; text-decoration:none;">
                <span class="texthover"><?php echo $posterUs['firstName']." ".$posterUs['lastName'] ?></span>
            </a>
            <span class="textsizeCorrect" style="color: var(--col8); font-weight:normal">
                <?php 
                    $pron = 'their';
                        if($posterUs['gender']=="Male") {
                            $pron = 'his';
                        } elseif($posterUs['gender']=="Female") {
                            $pron = 'her';
                        }
                        if($val['dp']) {
                            echo " updated $pron profile picture";
                        } elseif($val['cover']) {
                            echo " updated $pron cover picture";
                        } elseif($val['hasImage']) {
                            echo " updloaded a picture";
                        } else {
                            echo " updated $pron status";
                        }
                ?>
            </span>
            <span class="smallestText" id="time"
                style="margin-top:5%; color: var(--col8); float:right"><?php echo $val['date'] ?></span>
        </div>
        <div style="margin-left: 2%;">
            <?php echo htmlspecialchars($val['post']) ?>
            <br> <br>
            <?php 
                    if(file_exists($val['image'])) {
                        $image = $media->preview($val['image'],'dp');
                        echo "<img src='$image' style='width:31vw; margin-bottom:15px'/>";
                    }
                ?>
            <div id="reactSec">
                <div id="flex" style="padding-left: 18%;">
                    <?php
                        $reactCount = "";
                        if($val['reacts']>0) {
                            $reactCount = $val['reacts'];
                        }
                    ?>
                    <a href="react.php?type=post&postid=<?php echo $val['postId']?>" class="btn-with-hover"
                        style="color: var(--col8);">
                        <i class="fa fa-heart fa-2x" aria-hidden="true"></i>
                        <span> <?php echo $reactCount ?></span>
                    </a>
                </div>
                <div id="flex">
                    <a href="" class="btn-with-hover" style="color: var(--col8);">
                        <i class="fa fa-comment fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
                <div id="flex">
                    <a href="" class="btn-with-hover" style="color: var(--col8);">
                        <i class="fa fa-share fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>