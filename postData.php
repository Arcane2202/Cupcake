<div id="status">

    <div style="width: 100%;">

        <div class="texthover" id="NameHeader" style="color: var(--col9); margin-bottom:-3%">
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
                            echo " uploaded a picture";
                        } else {
                            echo " updated $pron status";
                        }
                ?>
            </span>
            <span class="smallestText" id="time"
                style="margin-top:5%; color: var(--col8); float:right"><?php echo $val['date'] ?></span>
            <br>
        </div>

        <?php 

            if($posterUs['userID']==$_SESSION['user']) {
                $postId = $val['postId'];
                echo "
                <a href='editPost.php?postid=$postId' style='text-decoration:none'>
                <span class='smallerText' id='editPost'
                        style='margin-left:13%;margin-top:-50%; color: var(--col8);'>Edit</span></a>
                <a href='deletePost.php?postid=$postId' style='text-decoration:none'>
                <span class='smallerText' id='deletePost'
                        style='margin-left:5px;margin-top:-50%; color: var(--col8);'>Delete</span></a>";
            }

        ?>

        <div style="margin-left: 2%; margin-top:5%">
            <?php echo htmlspecialchars($val['post']) ?>
            <br> <br>
            <?php 
                    if(file_exists($val['image'])) {
                        $image = $media->preview($val['image'],'dp');
                        if($wid=="prof") {
                            echo "<img src='$image' style='width:45.5vw; margin-bottom:15px'/>";
                        } else {
                            echo "<img src='$image' style='width:48.5vw; margin-bottom:15px'/>";
                        }
                    }
            ?>
            <!--<?php

                /*$likes = "";
                $database = new connectDatabase();
                $post = new createPosts();
                $res = $post->getReactors($val['postId'], 'post');
                $reacters = [];
                $flag = false;
                if ($res) {
                    $users = new userData();
                    foreach ($res as $value) {
                        $valu = $users->fetchData($value['reactor']);
                        $reacters[] = $valu['firstName'] . $valu['lastName'];
                        if ($valu['userID'] == $_SESSION['user']) {
                            $flag = true;
                        }
                    }
                    if ($flag) {
                        $count = count($reacters) - 1;
                        if ($count > 0) {
                            if ($count == 1) {
                                $likes = "You and 1 other liked this post.";
                            }
                            else {
                                $likes = "You and " . $count . "others liked this post.";
                            }
                        }
                        else {
                            $likes = "You liked this post.";
                        }
                    }
                    elseif ($count > 0) {
                        $count = count($reacters) - 1;
                        if ($count > 0) {
                            if ($count == 1) {
                                $likes = "$reacters[0] and 1 other liked this post.";
                            }
                            else {
                                $likes = "$reacters[0] and " . $count . "others liked this post.";
                            }
                        }
                        else {
                            $likes = "$reacters[0] liked this post.";
                        }
                    }
                }*/

            ?>
            <div id='reacters' style="padding-left: 4%;">
                <?php /*if($likes!="") {
                    echo "<i class='fa fa-heart' style='padding-right: 5px;font-size:1.7vh'>&nbsp$likes</i>";
                }*/ ?>
            </div>-->
            <div id="reactSec">
                <div id="flex" style="padding-left: 18%;">
                    <?php
                        $reactCount = "";
                        if($val['reacts']>0) {
                            $reactCount = "(".$val['reacts'].")";
                        }
                    ?>
                    <a onclick='getData(event)' href="react.php?type=post&postid=<?php echo $val['postId']?>"
                        class="btn-with-hover" style="color: var(--col8); text-decoration:none;">
                        <i class="fa fa-heart fa-2x">
                            <?php echo $reactCount ?></a></i>
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

<script type="text/javascript">
function reacter(data, tag) {
    var ajax = new XMLHttpRequest();
    ajax.addEventListener('readystatechange', function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            response(ajax.responseText, tag);
        }
    });
    data = JSON.stringify(data);
    ajax.open("postData", "ajax.php", true);
    ajax.send(data);
}

function getData(e) {
    e.preventDefault();
    var data = {};
    data.act = "reactPost";
    data.ref = e.target.parentElement.href;


    reacter(data, e.target);
}
function response(res, tag) {

    if (res != "") {
        obj = JSON.parse(res);
        if (typeof obj.act != undefined) {
            var reactCount = "";

            if (parseInt(obj.react) > 0) {
                reactCount = " (" + obj.react + ")";
            }
            tag.innerHTML = reactCount;
        }
    }
}
</script>