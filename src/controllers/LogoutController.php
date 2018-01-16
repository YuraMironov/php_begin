<?php

namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;


class LogoutController implements ControllerInterface
{
	public function doGet($uri)
	{
		unset($_SESSION['user']);
		Utils::redirect('/login');
	}
	
	public function doPost($post_params)
	{
		Utils::redirect('/err404');
	}
}
