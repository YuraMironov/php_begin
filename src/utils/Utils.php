<?php 

namespace Utils;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Pimple\Container;

class Utils 
{
    public static function redirect($uri = '/err404') 
    {
            $response = new RedirectResponse($uri);
            $response->send();
    }
    public static function viewLoaderByHandlerName()
    {   
        $a = strtolower(HANDLER_NAME);
    	require_once  './view/php/' . $a . '.php';
    }
    public static function twigViewLoaderByHandlerName(Container $container, $params)
    {
        $twig = $container['twig'];
        $twig->addGlobal("session", $_SESSION);
        $twig->addGlobal("cookies", $_COOKIE);
        echo $twig->render(HANDLER_NAME . '.twig', $params);
    }
    public static function getCaptcha()
    {
        $string = self::generateCode();
        $width = 200;
        $height = 100;
        $im = imagecreatetruecolor($width, $height);
        $bg = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $bg);
        $color = imagecolorallocate($im, 0 , 0, 0);
        $px     = (imagesx($im) - 19 * strlen($string)) / 2;
        // imagestring($im, 3, $px, 40, $string, $color);
        imagefttext($im, 45, -2, $px, $height * 0.65, $color, 'css/CorkiRegular.ttf', $string);
        $j = rand(0,4);
        for ($i = 0; $i < 13; $i++) {
            if ($i > 13 - $j) {
                imagesetthickness($im , 5);
            }
            imageline($im, rand(0, $width), 0, rand(0,$width), $width, $color);
            imageline($im, 0, rand(0, $height), $width, rand(0, $height), $color);
        }
        imagefilter($im, IMG_FILTER_EMBOSS);
        $path = 'img/captcha/' . self::generateCode() . '.jpg';
        imagejpeg($im, $path);
        imagedestroy($im);
        return array($path, $string);
    }

   public static function generateCode() 
    {    
          $chars = 'abdefhknrstyz23456789'; // Задаем символы, используемые в капче. Разделитель использовать не надо.
          $length = rand(4, 7); // Задаем длину капчи, в нашем случае - от 4 до 7
          $numChars = strlen($chars); // Узнаем, сколько у нас задано символов
          $str = '';
          for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, rand(1, $numChars) - 1, 1);
          } 
            $array_mix = preg_split('//', $str, -1, PREG_SPLIT_NO_EMPTY);
            srand ((float)microtime()*1000000);
            shuffle ($array_mix);
        return implode("", $array_mix);
    }
}