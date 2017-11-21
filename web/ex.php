<?php 
require '../src/core/init.php';



header("Content-type: image/png");
$string = 'ddddd';

$im = imagecreatetruecolor(200, 100);
$bg = imagecolorallocate($im, 255, 255, 255);
imagefill($im, 0, 0, $bg);
$color = imagecolorallocate($im, 0 , 0, 0);
$px     = (imagesx($im) - 19 * strlen($string)) / 2;
// imagestring($im, 3, $px, 40, $string, $color);
imagefttext($im, 45, -2, $px, 65, $color, 'css/CorkiRegular.ttf', $string);
imagejpeg($im, 'img/captcha/1.jpg');
imagedestroy($im);



// use Model\SingletonCat;

// // echo "<pre>";
// $cat = SingletonCat::getCat();
// $cat->setVoice("mrrrrrr");
// $catf = SingletonCat::getCat();

// $cat->setVoice("rrrrr");
// var_dump($cat->getVoice(), $catf->getVoice());


