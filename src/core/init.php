<?php
/**
 * Created by PhpStorm.
 * User: Yura
 * Date: 24.10.2017
 * Time: 21:47
 */
require 'error_handler.php';
require '../vendor/autoload.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
define('CORE_PATH', realpath(__DIR__));
define('SRC_PATH', str_replace('core', '', CORE_PATH));
define('CONTROLLER_PATH', SRC_PATH . 'controller/');
define('EMAIL_PATTERN', "/[a-zA-Z0-9_\-.+]+@[a-zA-Z0-9\-]+.[a-zA-Z]+/");

require 'container_cfg.php';

