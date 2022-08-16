<?php

class createPosts {
    private $errorMessage = "";

    public function createPost($data, $userId, $media) {
        if (empty($data['posts']) && empty($media['dp']['name']) && !isset($data['dp']) && !isset($data['cover'])) {
            $this->errorMessage .= "Cannot create empty posts!!!";
        }
        else {

            $image = "";
            $hasImage = 0;
            $dp = 0;
            $cover = 0;
            if(!isset($data['dp'])&&!isset($data['cover'])) {

                if (!empty($media['dp']['name'])) {
                    $hasImage = 1;
                    $directory = "mediaStorage/" . $userId . "/";
                    if (!file_exists($directory)) {
                        mkdir($directory, 0777, true);
                    }
                    $med = new media();
                    $mediaName = $directory . $med->mediaName($userId,'post') . ".jpg";
                    move_uploaded_file($_FILES['dp']['tmp_name'], $mediaName);
                    $med->resizeMedia($mediaName, $mediaName, 4000, 4000);
                }
            } else {
                $mediaName = $media;
                $hasImage = 1;
                if(isset($data['dp'])) {
                    $dp = 1;
                } else{
                    $cover = 1;
                }
            }
            $post = "";
            $post .= addslashes($data['posts']);
            $min=0;
            $max=10;
            $postId = $this->postIdGenerate($min,$max);
            $quer = "SELECT * FROM posts WHERE postId = '$postId'";
            $database = new connectDatabase();
            $res = $database->read($quer);
            while($res) {
                $postId .= $this->postIdGenerate($min,$max);
                $quer = "SELECT * FROM posts WHERE postId = '$postId'";
                $res = $database->read($quer);
            }
            $quer = "INSERT INTO POSTS(postId,userId,post,hasImage,image,dp,cover) VALUES('$postId','$userId','$post','$hasImage','$mediaName','$dp','$cover')";
            $database = new connectDatabase();
            $database->write($quer);
        }
        return $this->errorMessage;
    }

    private function postIdGenerate($min,$max) {
        $len = rand($min,$max); //DevSkim: ignore DS148264  
        $id = "";
        //$ar = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','xx','yy','zz'];
        for ($i = 1; $i <= $len; $i++) {
            $id .= rand(8, 14); //DevSkim: ignore DS148264
            $id .= rand(0, 8);
            //$id .= $ar[rand(0,25)];
        }
        return $id;
    }

    public function getPosts($userId) {
        $quer = "SELECT * FROM posts WHERE userId = '$userId' ORDER BY id DESC";
        $database = new connectDatabase();
        $res = $database->read($quer);
        if ($res) {
            return $res;
        }
        else {
            return false;
        }
    }

    public function getParticularPost($postId) {
        $quer = "SELECT * FROM posts WHERE postId = $postId limit 1";
        $database = new connectDatabase();
        $res = $database->read($quer);
        if ($res) {
            return $res[0];
        }
        else {
            return false;
        }
    }
    
    public function deletePost($postId) {
        $quer = "DELETE FROM posts WHERE postId = '$postId' limit 1";
        $database = new connectDatabase();
        $database->write($quer);
    }

    public function updatePost($data,$postId) {
        $post = "";
        $post .= addslashes($data['posts']);
        $quer = "UPDATE posts SET post = '$post' WHERE postId = '$postId' limit 1";
        $database = new connectDatabase();
        $res = $database->write($quer);
    }

    public function reactPost($postid,$type,$reactor) {
        if($type=='post') {
            $database = new connectDatabase;

            $quer = "SELECT reacts FROM reacts WHERE type = 'post' && postid = $postid limit 1";
            $res = $database->read($quer);

            if(!is_array($res[0])) {
                $ar['reactor'] = $reactor;
                $ar['timestamp'] = date("Y-m-d H:i:s");
                $resAr[] = $ar;
                $reactors = json_encode($resAr);
                $quer = "INSERT INTO reacts (type,postid,reacts) VALUES ('$type', $postid, '$reactors')";
                $database->write($quer);
                $quer = "UPDATE posts SET reacts = reacts + 1 WHERE postId = $postid limit 1";
                $database->write($quer);
            } else {
                $resAr = json_decode($res[0]['reacts'],true);
                $reactorIDs = array_column($resAr,'reactor');
                if(!in_array($reactor,$reactorIDs)) {
                    $ar['reactor'] = $reactor;
                    $ar['timestamp'] = date("Y-m-d H:i:s");
                    $resAr[] = $ar;
                    $reactors = json_encode($resAr);
                    $quer = "UPDATE reacts set reacts = '$reactors' WHERE type = 'post' && postid = $postid limit 1";
                    $database->write($quer);
                    $quer = "UPDATE posts SET reacts = reacts + 1 WHERE postId = $postid limit 1";
                    $database->write($quer);
                } else {
                    $index = array_search($reactor,$reactorIDs);
                    unset($resAr[$index]);
                    $reactors = json_encode($resAr);
                    $quer = "UPDATE reacts set reacts = '$reactors' WHERE type = 'post' && postid = $postid limit 1";
                    $database->write($quer);

                    $quer = "UPDATE posts SET reacts = reacts - 1 WHERE postId = $postid limit 1";
                    $database->write($quer);
                }
            }
        }
    }

    public function getReactors($postId, $type) {
        if($type=="post") {
            $database = new connectDatabase;
            $quer = "SELECT reacts FROM reacts WHERE type = 'post' && postid = $postId limit 1";
            $res = $database->read($quer);
            if(is_array($res)) {
                $resAr = json_decode($res[0]['reacts'],true);
                return $resAr;
            }
        }
        return false;
    }
}
