<?php 
require '../src/core/init.php';

$url = "http://php.pro/upload";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);
curl_close ($ch);

function get_html_title($str){
    if(strlen($str)>0){
        preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title);
        return $title[1];
    }
}

var_dump(get_html_title($result));


echo serialize(new DateTime());
