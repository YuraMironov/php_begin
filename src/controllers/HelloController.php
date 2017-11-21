<?php

namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;
use Models\TemplaterController;

class HelloController extends TemplaterController implements ControllerInterface
{	
	public function __construct(){
		$this->addTemplaterParam('pageName', "Hello page");
	}
	public function doGet($get_params)
	{	
		$params = explode('/', $get_params);
		if ($params[1] >= 1) {
			$this->addTemplaterParam('word', $params[0]);
			$this->addTemplaterParam('count', $params[1]);
			return $this->getTemplaterParams();
		} else {
			// $this->doPost("");
		}
	}
	public function doPost($post_params)
	{		
		Utils::redirect("/err404");
	}
}