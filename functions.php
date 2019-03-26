<?php
require_once("lib/gd-text/HorizontalAlignment.php");
require_once("lib/gd-text/VerticalAlignment.php");
require_once("lib/gd-text/TextWrapping.php");
require_once("lib/gd-text/Box.php");
require_once("lib/gd-text/Color.php");

define("MIME_TYPE", "image/png");
define("EXTENSION", "png");

function supports_gd() {
    return function_exists("imagecreate");
}

function fatal_error($str) {
    $font    = 5;
    $padding = 5;
    
    $message = "Error: {$str}.";

    if (!supports_gd()) {
        header("Content-type: text/plain");
        exit($message);
    }

    $w = imagefontwidth($font) * strlen($message) + $padding * 2;
    $h = imagefontheight($font) + $padding * 2;

    if ($im = imagecreate($w, $h)) {
        $bg = imagecolorallocate($im, 255, 255, 255);
        $fg = imagecolorallocate($im, 0, 0, 0);

        imagestring($im, $font, $padding, $padding, $message, $fg);
        
        header("Content-type: ".MIME_TYPE);
        imagepng($im);
        imagedestroy($im);
        exit;
    }
}
?>