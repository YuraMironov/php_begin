<?php

namespace Models;	

use Interfaces\ImageInterface;

class ImageClass implements ImageInterface
{
	public function __construct($filename){}
	public function save($filename, $image_type=IMAGETYPE_JPEG){}
	public function output(){}
	public function getWidth(){}
	public function getHeight(){}
	public function cutUpAndDown($center_height){}
	public function cutLeftAndRight($center_width){}
    public function getMimeType(){}
	public function resizeToHeight($height)
	{
		$ratio = $height / $this->getHeight();
		$width = $this->getWidth() * $ratio;
		$this->resize($width,$height);
	}
	public function resizeToWidth($width) 
	{
		$ratio = $width / $this->getWidth();
		$height = $this->getheight() * $ratio;
		$this->resize($width,$height);
	}
	public function scale($scale) 
	{
		$width = $this->getWidth() * $scale/100;
		$height = $this->getheight() * $scale/100;
		$this->resize($width,$height);
	}
	public function resize($width,$height){}
   
}