<?php

    class media {
        public function cropMedia($media, $cropMedia, $width, $height) {

            if(file_exists($media)) {
                $med = imagecreatefromjpeg($media);
                $sw = imagesx($med);
                $sh = imagesy($med);
                if($sh > $sw) {
                    $rat = $width/$sw;
                    $cWidth = $width;
                    $cHeight = $sh*$rat;
                } else {
                    $rat = $height/$sh;
                    $cHeight = $height;
                    $cWidth = $sw*$rat;
                }
            }
            if($width != $height) {
                if($height>$width) {
                    if($height>$cHeight) {
                        $adj = $height/$cHeight;
                    } else {
                        $adj = $cHeight/$height;
                    }
                    $cHeight *= $adj;
                    $cWidth *= $adj;
                } else {
                    if($width>$cWidth) {
                        $adj = $width/$cWidth;
                    } else {
                        $adj = $cWidth/$width;
                    }
                    $cHeight *= $adj;
                    $cWidth *= $adj;
                }
            }
            $nImg = imagecreatetruecolor($cWidth,$cHeight);
            imagecopyresampled($nImg,$med,0,0,0,0,$cWidth,$cHeight,$sw,$sh);
            imagedestroy($med);
            if($height==$width) {
                if($cHeight > $cWidth) {
                    $y = round(($cHeight - $cWidth)/2);
                    $x = 0;
                } else {
                    $x = round(($cWidth - $cHeight)/2);
                    $y = 0;
                }  
            } else {
                if($width > $height) {
                    $y = round((abs($cHeight - $height))/2);
                    $x = 0;
                } else {
                    $x = round((abs($cWidth - $width))/2);
                    $y = 0;
                }
            }
            $ncImg = imagecreatetruecolor($width,$height);
            imagecopyresampled($ncImg, $nImg, 0, 0, $x, $y, $width, $height,$width, $height);
            imagedestroy($nImg);
            imagejpeg($ncImg,$cropMedia,100);
            imagedestroy($ncImg);
        }
        public function mediaName($userID,$media) {
            $range = rand(10,100);
            $name = $userID."_".$media."_";
            for($i=0;$i<$range;$i++) {
                $name.=rand(0,9);
            }
            return $name;
        }
    }
?>