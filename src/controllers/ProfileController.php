<?php

namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;
use Models\TemplaterController;


class ProfileController extends TemplaterController implements ControllerInterface
{
	public function __construct()
	{
		$this->addTemplaterParam('pageName', 'Profile page');
	}
	public function doGet($get_params)
	{
		if (isset($_SESSION['user'])) {
			return $this->getTemplaterParams();
		} else {
			self::doPost('');
		}
	}
	public function doPost($post_params)
	{
		Utils::redirect('/err404');
	}
}