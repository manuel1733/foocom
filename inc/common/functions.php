<?php

function resize_image($image_path, $new_path, $new_width) {
    $size = getimagesize($image_path);
    $width = $size[0];
    $height = $size[1];
    $new_height = intval($height * $new_width / $width);

    if (function_exists('gd_info')) {
        $tmp = gd_info();
        $imgsup = ($tmp['GIF Create Support'] ? 1 : 2);
    } else {
        $imgsup = 2;
    }

    if ($size[2] < $imgsup || $size[2] > 3) {
        return false;
    }

    if ($size[2] == 1) {
        $image = imagecreatefromgif($image_path);
    } elseif ($size[2] == 2) {
        $image = imagecreatefromjpeg($image_path);
    } elseif ($size[2] == 3) {
        $image = imagecreatefrompng($image_path);
    }

    if (function_exists('imagecreatetruecolor') && $size[2] != 1) {
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    } else {
        $new_image=imageCreate($new_width, $new_height);
        imageCopyResized($new_image, $image,0,0,0,0, $new_width, $new_height, $width, $height);
    }

    if ($size[2] == 1) {
        ImageGIF($new_image, $new_path);
    }	elseif ($size[2] == 2) {
        ImageJPEG($new_image, $new_path);
    } elseif ( $size[2] == 3 ) {
        ImagePNG($new_image, $new_path);
    }
    return true;
}
