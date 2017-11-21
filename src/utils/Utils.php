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
}