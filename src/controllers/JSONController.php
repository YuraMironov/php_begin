<?php
use Symfony\Component\HttpFoundation\Request;
use JsonServer\JsonServer;

/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 05.12.2017
 * Time: 16:19
 */
class JSONController extends \Models\TemplaterController implements \Interfaces\ControllerInterface
{

    public function doGet($uri)
    {
//        $data = Request::all();                                             //request data
//        $method = Request::method();                                        //request method
//        $jsonServer = new JsonServer();                                     //create new JsonServer instance
//        $response = $jsonServer->handleRequest($method, $uri, $data);
    }

    public function doPost($post_params)
    {
    }
}