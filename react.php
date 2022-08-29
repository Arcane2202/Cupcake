<?php

if (!isset($_SESSION['user'])) {
    die;
}

$quer = explode("?", $data->ref);
$quer = end($quer);


$s = explode("&", $quer);

foreach ($s as $val) {
    $val = explode("=", $val);
    $_GET[$val[0]] = $val[1];
}
if (isset($_GET['postid']) && isset($_GET['type']) && is_numeric($_GET['postid'])) {
    $storeReact = new createPosts();
    $ar[] = 'post';
    $ar[] = 'comment';
    $ar[] = 'friendRequests';
    $ar[] = 'friendsCount';
    if (in_array($_GET['type'], $ar)) {
        $storeReact = new createPosts();
        $storeReact->reactPost($_GET['postid'], $_GET['type'], $_SESSION['user']);
    }
    $color = "antiquewhite";
    $likes = $info = "";
    $database = new connectDatabase();
    $post = new createPosts();
    $res = $post->getReactors($_GET['postid'], $_GET['type']);
    $reacters = [];
    $flag = false;
    if ($res) {
        $users = new userData();
        foreach ($res as $value) {
            $valu = $users->fetchData($value['reactor']);
            $reacters[] = $valu['firstName'] ." ". $valu['lastName'];
            if ($valu['userID'] == $_SESSION['user']) {
                $flag = true;
            }
        }
        $count = count($reacters);
        if ($flag) {
            $color = "brown";
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
        $likes =  "<i class='fa fa-heart' style='padding-right: 5px;font-size:1.7vh'>&nbsp$likes</i>";
    }

    $reacts = $storeReact->getReactors($_GET['postid'], $_GET['type']);
    $obj = (object)[];
    $obj->react = count($reacts);
    $obj->act = "reactPost";
    $obj->likes = $likes;
    $obj->postId = "reactors_$_GET[postid]";
    $obj->color = $color;
    echo json_encode($obj);
}
