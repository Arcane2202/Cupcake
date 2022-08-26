<?php 

    if(!isset($_SESSION['user'])) {
        die;
    }
    
    $quer = explode("?",$data->ref);
    $quer = end($quer);
    
    
    $s = explode("&",$quer);
    
    foreach($s as $val) {
        $val = explode("=",$val);
        $_GET[$val[0]] = $val[1];
    }
    if(isset($_GET['postid'])&& isset($_GET['type']) && is_numeric($_GET['postid'])) {
       $storeReact = new createPosts();
        $ar[] = 'post';
        $ar[] = 'comment';
        $ar[] = 'friendRequests';
        $ar[] = 'friendsCount';
        if(in_array($_GET['type'],$ar)) {
            $storeReact = new createPosts();
            $storeReact->reactPost($_GET['postid'],$_GET['type'],$_SESSION['user']);
        }

        $reacts = $storeReact->getReactors($_GET['postid'],$_GET['type']);
        $obj = (object)[];
        $obj->react = count($reacts);
        $obj->act = "reactPost";
        echo json_encode($obj);
    }