<?php
namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;
use Models\TemplaterController;

class CaptchaController extends TemplaterController implements ControllerInterface
{	
	public function __construct(){
		$this->addTemplaterParam('pageName', "Hello page");
	}
	public function doGet($get_params)
	{	
		$a = Utils::getCaptcha();
		$this->addTemplaterParam('src', $a[0]);
		return $this->getTemplaterParams();	
	}
	public function doPost($post_params)
	{

	}
}