<?php
require_once("functions.php");

if (!supports_gd()) {
    fatal_error("GD not supported");
}

use GDText\Box;
use GDText\Color;

// HTTP VARS
// ---
$text = trim(html_entity_decode($_GET["text"] ?? ""));
$size = intval($_GET["size"] ?? 20);
$font = strtoupper($_GET["font"] ?? "ARIAL");
$n    = intval($_GET["n"] ?? 1);
$k    = substr($_GET["k"] ?? "", 0, 1);
// ---

$src_img_file = "millionaire{$n}-{$k}.".EXTENSION;
$font_file = __DIR__."/{$font}.TTF";

if (!is_readable($src_img_file)) {
    fatal_error("No such image");
}
if (!is_readable($font_file)) {
    fatal_error("No such font");
}

$src_img = imagecreatefrompng($src_img_file);
$width = imagesx($src_img);
$height = imagesy($src_img);
$im = imagecreatetruecolor($width, $height);
imagealphablending($im, false);
imagesavealpha($im, true);
imagecopy($im, $src_img, 0, 0, 0, 0, $width, $height);
imageresolution($im, 100, 100);

$box = new Box($im);
$box->setFontFace($font_file);
$box->setFontColor(new Color(255, 255, 255));
$box->setFontSize($size);
$box->setTextAlign("center", "center");
$box->setBox(0, 0, $width, $height);
$box->draw($text);

header("Content-type: ".MIME_TYPE);
imagepng($im);
imagedestroy($im);
?>