<?php
namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;
use Models\TemplaterController;
use Models\GDImage;
use Models\MyImage;

class UploadController extends TemplaterController implements ControllerInterface
{
	public function __construct(){
		$this->addTemplaterParam('pageName', "Uploading");
	}
	public function doGet($uri)
	{
		return $this->getTemplaterParams();
	}
	public function doPost($post_params)
	{
		$userfile = $post_params['files']['userfile'];
		if (!isset($userfile)) {
			$this->addTemplaterParam('message', 'Error');
			return $this->getTemplaterParams();
		}
		unset($post_params['files']);
		$uploaddir = 'img/upload/';
		// $uploadfile = $uploaddir . basename($userfile->getClientOriginalName());
		$uploadfile = $uploaddir . explode('.' , explode('\\', $userfile->getRealPath())[3])[0] . '.jpg';
		$urlfile = '/' . $uploadfile;

		// if (move_uploaded_file($files['userfile']->getRealPath(), $uploadfile)) {
		if (is_uploaded_file($userfile)) {
		    $this->addTemplaterParam('message', "Файл корректен и был успешно загружен. ");
		    $this->addTemplaterParam('url', $urlfile );
		} else {
		    $this->addTemplaterParam('message', "Возможная атака с помощью файловой загрузки!\n");
		    $this->addTemplaterParam('url', '/err404');
		}

		$newWidth = 200;
		$newHeight = 100;

//		 $im = new MyImage($userfile->getRealPath());
		$im = new GDImage($userfile->getRealPath());
		$this->addTemplaterParam('mime', $im->getMimeType());
		if ($im->getWidth() > $im->getHeight()) {
			if ($im->getWidth() / $im->getHeight() <= $newWidth / $newHeight) {
				$im->resizeToWidth($newWidth);
				//cut for height
				$im->cutUpAndDown($newHeight);
			} else {
				$im->resizeToHeight($newHeight);
				//cut for width
				$im->cutLeftAndRight($newWidth);
			}
		} else {
			$im->resizeToWidth($newWidth);
			//cut for height
			$im->cutUpAndDown($newHeight);
		}
		$im->save($uploadfile);

		return $this->getTemplaterParams();
	}
}