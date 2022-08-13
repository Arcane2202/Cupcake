<?php

    class createPosts {
        private $errorMessage="";
        
        public function createPost($data,$userId) {
            if(empty($data['posts'])) {
                $this->errorMessage.="Cannot create empty posts!!!";
            } else {
                $post = addslashes($data['posts']);
                $postId = $this->postIdGenerate();

                $quer = "INSERT INTO POSTS(postId,userId,post) VALUES('$postId','$userId','$post')";
                $database = new connectDatabase();
                $database->write($quer);
            
            }
            return $this->errorMessage;
        }

        private function postIdGenerate() {
            $len = rand(10,30); //DevSkim: ignore DS148264  
            $id = "";
            for($i=1;$i<=$len;$i++) {
                $id .= rand(0,9); //DevSkim: ignore DS148264 
            }
            return $id;
        }

        public function getPosts($userId){
            $quer = "SELECT * FROM POSTS WHERE userId = '$userId' ORDER BY id DESC";
            $database = new connectDatabase();
            $res = $database->read($quer);
            if($res) {
                return $res;
            } else {
                return false;
            }
        }
    }