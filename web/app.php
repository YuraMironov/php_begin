<?php
require_once "../src/core/init.php";

use Symfony\Component\HttpFoundation\Request;
use Controllers\MainHandler;

$handler = $container['handler'];
$handler->handleRequest($container);