<?php



$container = new Pimple\Container();



// OtherObjects

$container['PDBC'] = function ($c) {
	return new Core\PDBC();
};
$container['request'] = function ($c) {
	$request = Symfony\Component\HttpFoundation\Request::createFromGlobals();
	return $request;
};
$container['handler'] = function ($c) {
	return new Controllers\MainHandler($c['request'], $c);
};
 
//twig
$container['twigLoader'] = function($c) {
	return new Twig_Loader_Filesystem('view/twig');
};
$container['twig'] = function($c) {
	return new Twig_Environment($c['twigLoader']);
};

// Repositories

$container['userRepository'] = function ($c) {
	return new Repositories\UserRepository();
};



// Controllers

$container['RegController'] = function ($c) {
	return new Controllers\RegController($c['userRepository']);
};
$container['LoginController'] = function ($c) {
	return new Controllers\LoginController($c['userRepository']);
};
$container['ProfileController'] = function ($c) {
	return new Controllers\ProfileController();
};
$container['LogoutController'] = function ($c) {
	return new Controllers\LogoutController();
};
$container['HelloController'] = function ($c) {
	return new Controllers\HelloController();
};
$container['TwitterController'] = function ($c) {
	return new Controllers\TwitterController();
};
$container['UploadController'] = function ($c) {
	return new Controllers\UploadController();
};
$container['CaptchaController'] = function ($c) {
	return new Controllers\CaptchaController();
};