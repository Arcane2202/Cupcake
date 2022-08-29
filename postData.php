<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userId = $_SESSION['user'];
    $poster = new createPosts();
    $res = $poster->createComment($_POST, $userId, $val['postId']);
    if ($res == "") {
        die;
    } else {
        echo $res;
    }
}
?>

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
                    $string = strip_tags($post);
                    if (strlen($string) > 450) {
                        $stringCut = substr($string, 0, 450);
                        $string = substr($stringCut, 0, strrpos($stringCut, ' ')) . '...<a style="text-decoration: none; font-weight: bold;color: antiquewhite;" onclick="seePost(event,' . $postId . ')" href="postData.php?postid=' . $postId . '">see more</a>';
                    }
                    echo "<p> $string<br></p>";
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
                    echo "<img src='$image' style='margin-left:2vh;width:43.6vw;border-radius:20px; margin-bottom:15px'/>";
                } else {
                    echo "<img src='$image' style='margin-left:2vh;width:46.7vw;border-radius:20px; margin-bottom:15px'/>";
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
            <div class="commentBox"style="height:45vh">
            <div class='commentposter' style='margin-bottom:3%'>
                <form method='post' enctype='multipart/form-data'>
                    <?php $text = "text" . $postId; ?>
                    <textarea id=<?php echo $text ?> name='comments' placeholder='Write a comment'></textarea>
                    <input onclick='comment(event,<?php echo $postId ?>)' class='btn-with-hover' style='width:3vw; font-size:100%;' id='submitButton' type='Button' value='Post'>
                    <br>
                </form>

                <?php

                    $query = "SELECT * FROM comments WHERE postid = '$postId'";
                    $db = new connectDatabase();
                    $res = $db->read($query);
                    if($res) {
                        foreach ($res as $val) {
                            $us = new userData();
                            $commentuser = $us->fetchData($val['commentuser']);
                            include('getComments.php');
                        }
                    }
                ?>
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

    function seePost(e, postId) {
        e.preventDefault();
        var data = {};
        data.act = "showpost";
        data.ref = postId;
        showPost(data, e.target.parentElement);
    }

    function showPost(data, tag) {
        var ajax = new XMLHttpRequest();
        ajax.addEventListener('readystatechange', function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                results(ajax.responseText, tag);
            }
        });
        data = JSON.stringify(data);
        ajax.open("postData", "ajax.php", true);
        ajax.send(data);
    }

    function results(res, tag) {
        obj = JSON.parse(res);
        tag.innerHTML = obj.post;
    }


    function comment(e, postid) {
        e.preventDefault();
        var text = document.getElementById("text" + postid);
        var data = {};
        data.act = "comment";
        data.ref = text.value;
        data.postid = postid;
        makecomment(data, postid, text);
    }

    function makecomment(data, postid, text) {
        var ajax = new XMLHttpRequest();
        ajax.addEventListener('readystatechange', function() {
            if (ajax.readyState == 4 && ajax.status == 200) {
                returnfromhere(ajax.responseText, postid, text);
            }
        });
        data = JSON.stringify(data);
        ajax.open("postData", "ajax.php", true);
        ajax.send(data);
    }

    function returnfromhere(res, postid, text) {
        obj = JSON.parse(res);
        text.value = "";
    }
</script>