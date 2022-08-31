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

        <div  id="NameHeader" style="color: var(--col9); margin-bottom:-3%">
            <a href="ProfilePage.php?id=<?php echo $posterUs['userID']; ?>" style="color: antiquewhite; text-decoration:none">
                <img src="<?php echo $media->preview($posterUs['dp'], 'dp') ?>" style="border-radius:50%; width:10%;">
            </a>
            <a href="ProfilePage.php?id=<?php echo $posterUs['userID']; ?>" style="margin-left:2vw; margin-right:1vw; color: antiquewhite; text-decoration:none;">
                <span class="textsizeCorrect texthover2"><?php echo $posterUs['firstName'] . " " . $posterUs['lastName'];
                                        $name = $posterUs['firstName'] . " " . $posterUs['lastName'];

                                        ?></span>
            </a>
            <span class="textsizeCorrect" style="color: var(--col8); font-weight:normal; font-size:1.3vw;">
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
                        style='margin-left: calc(11% + 2vw);margin-top:-50%; color: var(--col8);'>Edit</span></a>
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
                    echo "<img src='$image' style='width:98%;border-radius:20px; margin-bottom:15px'/>";
                } else {
                    echo "<img src='$image' style='width:98%;border-radius:20px; margin-bottom:15px'/>";
                }
            }
            echo "</a>";
            ?>
            <?php ?>

            <div class="textsizeCorrect" id="reactShow" >
                <?php
                $color = "antiquewhite";
                $likes = "";
                $database = new connectDatabase();
                $post = new createPosts();
                $res = $post->getReactors($val['postId'], 'post');
                $reacters = [];
                $flag = false;
                echo "<a id='reactors_$val[postId]' class='react-data' href='showReactors.php?type=post&postid=$val[postId]'>";
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
                        $color = "brown";
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
                        $color = "antiquewhite";
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
                <div id="flex" style="padding-left: 19%;padding-right: 8%">
                    <?php
                    $reactCount = "";
                    if ($val['reacts'] > 0) {
                        $reactCount = "(" . $val['reacts'] . ")";
                    }
                    ?>
                    <a id="heart_icon" class="react_icon" style="color:<?php echo $color ?>" onclick='getData(event)' href="react.php?type=post&postid=<?php echo $val['postId'] ?>">
                        <i class="fa fa-heart fa-2x " style="font-size:calc(1em + 0.5vw); " aria-hidden="true">
                            <?php echo $reactCount ?></i>
                    </a>
                </div>
                <div id="flex" style="padding-left: 27%;padding-right: 8%;border-left: solid thin;">
                <?php
                $postidd = $val['postId']; 
                $quer = "SELECT * FROM `comments` WHERE postid ='$postidd'";
                $new = new connectDatabase();
                $res = count($new->read($quer));
                if($res==0){
                    $res="";
                }
                else{
                    $res = "(".$res.")";
                }
                $posts = htmlspecialchars($val['post']);
                echo "<a href='postView.php?postId=$postId&postId=$val[postId]&date=$val[date]&reacts=$val[reacts]&image=$val[image]&name=$name&userID=$posterUs[userID]&dp=$posterUs[dp]&post=$posts' class='react_icon'>
                        <i class='fa fa-comments fa-2x' style='font-size:calc(1em + 0.5vw)' aria-hidden='true'>$res</i>
                    </a>
                ";?>
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
                var temp = document.getElementById("heart_icon");
                
                tag.parentElement.style.color = obj.color;
                
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