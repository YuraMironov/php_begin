<?php
namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;
use Models\TemplaterController;

class CaptchaController extends TemplaterController implements ControllerInterface
{	
	public function __construct(){
		$this->addTemplaterParam('pageName', "Captcha page");
	}
	public function doGet($uri)
	{	
		$a = Utils::getCaptcha();
		$this->addTemplaterParam('src', $a[0]);
		$_SESSION['capVal'] = $a[1];
		return $this->getTemplaterParams();	
	}
	public function doPost($post_params)
	{
		if (isset($post_params['check']) && $post_params['check'] == $_SESSION['capVal']) {
			$this->addTemplaterParam('message','Correct value!');
			unset($_SESSION['capVal']);
		} else {
			$this->addTemplaterParam('message', 'Error!!!');
		}
		$this->doGet(array());
		return $this->getTemplaterParams();
	}
}