<?php
namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;
use Models\TemplaterController;

class UploadController extends TemplaterController implements ControllerInterface
{
	public function __construct(){
		$this->addTemplaterParam('pageName', "Uploading");
	}
	public function doGet($get_params)
	{
		return $this->getTemplaterParams();
	}
	public function doPost($post_params)
	{
		$files = $post_params['files'];
		unset($post_params['files']);
		$uploaddir = 'img/';
		$urldir = '/img/';
		$uploadfile = $uploaddir . basename($files['userfile']->getClientOriginalName());
		$urlfile = $urldir . basename($files['userfile']->getClientOriginalName());
		if (move_uploaded_file($files['userfile']->getRealPath(), $uploadfile)) {
		    $this->addTemplaterParam('message', "Файл корректен и был успешно загружен. ");
		    $this->addTemplaterParam('url', $urlfile );
		} else {
		    $this->addTemplaterParam('message', "Возможная атака с помощью файловой загрузки!\n");
		    $this->addTemplaterParam('url', '/err404');
		}
		return $this->getTemplaterParams();
	}
}