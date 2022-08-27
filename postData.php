<div id="status">

    <div style="width: 100%;">

        <div class="texthover" id="NameHeader" style="color: var(--col9); margin-bottom:-3%">
            <a href="ProfilePage.php?id=<?php echo $posterUs['userID']; ?>" style="color: antiquewhite; text-decoration:none">
                <img src="<?php echo $media->preview($posterUs['dp'], 'dp') ?>" style="border-radius:50px; width:10%;">
            </a>
            <a href="ProfilePage.php?id=<?php echo $posterUs['userID']; ?>" style="margin-left:2%; color: antiquewhite; text-decoration:none;">
                <span class="texthover"><?php echo $posterUs['firstName'] . " " . $posterUs['lastName'];
                                        $name = $posterUs['firstName'] . " " . $posterUs['lastName'];

                                        ?></span>
            </a>
            <span class="textsizeCorrect" style="color: var(--col8); font-weight:normal">
                <?php
                $pron = 'their';
                if ($posterUs['gender'] == "Male") {
                    $pron = 'his';
                } elseif ($posterUs['gender'] == "Female") {
                    $pron = 'her';
                }
                if ($val['dp']) {
                    echo " updated $pron profile picture";
                } elseif ($val['cover']) {
                    echo " updated $pron cover picture";
                } elseif ($val['hasImage']) {
                    echo " uploaded a picture";
                } else {
                    echo " updated $pron status";
                }
                ?>
            </span>
            <span class="smallestText" id="time" style="margin-top:5%; color: var(--col8); float:right"><?php echo $val['date'] ?></span>
            <br>
        </div>

        <?php
        $postId = $val['postId'];
        if ($posterUs['userID'] == $_SESSION['user']) {
            echo "
                <a href='editPost.php?postid=$postId' style='text-decoration:none'>
                <span class='smallerText' id='editPost'
                        style='margin-left:13%;margin-top:-50%; color: var(--col8);'>Edit</span></a>
                <a href='deletePost.php?postid=$postId' style='text-decoration:none'>
                <span class='smallerText' id='deletePost'
                        style='margin-left:5px;margin-top:-50%; color: var(--col8);'>Delete</span></a>";
        }

        ?>

        <div style="margin-left: 2%; margin-top:-3%; font-size:calc(0.5em + 0.5vw)">
            <div id="textPart">
                <?php
                $post = "";
                if ($val['post'] != "") {
                    $post = htmlspecialchars($val['post']);
                    echo "<p> $post<br></p>";
                }
                ?>
            </div>

            <?php
            echo "<a href='postView.php?postid=$postId&postId=$val[postId]&date=$val[date]&reacts=$val[reacts]&image=$val[image]&name=$name&userID=$posterUs[userID]&dp=$posterUs[dp]&post=$post'>";
            $_SESSION['val'] = $val;
            $_SESSION['posterUs'] = $posterUs;
            if (file_exists($val['image'])) {
                $image = $media->preview($val['image'], 'dp');
                if ($wid == "prof") {
                    echo "<img src='$image' style='width:45.5vw; border-radius:20px; margin-bottom:15px'/>";
                } else {
                    echo "<img src='$image' style='width:48.5vw;border-radius:20px; margin-bottom:15px'/>";
                }
            }
            echo "</a>";
            ?>
            <?php ?>

            <div class="textsizeCorrect" id="reactShow" style="margin-top: 2vh;padding-left: 4%;color:antiquewhite">
                <?php
                $likes = "";
                $database = new connectDatabase();
                $post = new createPosts();
                $res = $post->getReactors($val['postId'], 'post');
                $reacters = [];
                $flag = false;
                echo "<a id='reactors_$val[postId]' style='color:antiquewhite' href='showReactors.php?type=post&postid=$val[postId]'>";
                if ($res) {
                    $users = new userData();
                    foreach ($res as $value) {
                        $valu = $users->fetchData($value['reactor']);
                        $reacters[] = $valu['firstName'] . " " . $valu['lastName'];
                        if ($valu['userID'] == $_SESSION['user']) {
                            $flag = true;
                        }
                    }
                    $count = count($reacters);
                    if ($flag) {
                        $count = count($reacters) - 1;
                        if ($count > 0) {
                            if ($count == 1) {
                                $likes = "You and 1 other liked this post.";
                            } else {
                                $likes = "You and " . $count . "others liked this post.";
                            }
                        } else {
                            $likes = "You liked this post.";
                        }
                    } elseif ($count > 0) {
                        $count = count($reacters) - 1;
                        if ($count > 0) {
                            if ($count == 1) {
                                $likes = "$reacters[0] and 1 other liked this post.";
                            } else {
                                $likes = "$reacters[0] and " . $count . "others liked this post.";
                            }
                        } else {
                            $likes = "$reacters[0] liked this post.";
                        }
                    }
                }

                if ($likes != "") {
                    echo "<i class='fa fa-heart' style='padding-right: 5px;'>&nbsp$likes</i>";
                }
                echo "</a>";
                ?>

            </div>
            <div id="reactSec">
                <div id="flex" style="padding-left: 15%;padding-right: 8%">
                    <?php
                    $reactCount = "";
                    if ($val['reacts'] > 0) {
                        $reactCount = "(" . $val['reacts'] . ")";
                    }
                    ?>
                    <a onclick='getData(event)' href="react.php?type=post&postid=<?php echo $val['postId'] ?>" class="btn-with-hover" style="color: var(--col8); text-decoration:none;">
                        <i class="fa fa-heart fa-2x" style="font-size:calc(1em + 0.5vw)" aria-hidden="true">
                            <?php echo $reactCount ?></a></i>
                    </a>
                </div>
                <div id="flex" style="padding-left: 15%;padding-right: 8%;border-left: solid thin;">
                    <a href="" class="btn-with-hover" style="color: var(--col8);">
                        <i class="fa fa-comment fa-2x" style="font-size:calc(1em + 0.5vw)" aria-hidden="true"></i>
                    </a>
                </div>
                <div id="flex" style="padding-left: 15%;padding-right: 8%;border-left: solid thin;">
                    <a href="" class="btn-with-hover" style="color: var(--col8);">
                        <i class="fa fa-share fa-2x" style="font-size:calc(1em + 0.5vw)" aria-hidden="true"></i>
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
                var post = document.getElementById(obj.postId);
                post.innerHTML = obj.likes;
            }
        }
    }
</script>