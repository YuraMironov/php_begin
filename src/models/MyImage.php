<?php

namespace Models;

class MyImage extends ImageClass
{
	var $image;
	var $image_type;
	public function __construct($filename)
	{
		$im = new \Imagick($filename);
		$this->imageType = $im->getImageMimeType();
		$this->image = $im;
	}
	public function save($filename, $image_type=IMAGETYPE_JPEG)
	{	
		if( $image_type == IMAGETYPE_JPEG ) {
			$this->image->setImageFormat('jpeg');
		} elseif( $image_type == IMAGETYPE_GIF ) {
			$this->image->setImageFormat('gif');
		} elseif( $image_type == IMAGETYPE_PNG ) {
			$this->image->setImageFormat('png');
		}

		$this->image->writeImageFile(fopen($filename, "wb"));
	}
	public function output()
	{
		echo $this->image->getImageBlob();
	}
	public function getWidth()
	{
		return $this->image->getImageWidth();
	}
	public function getHeight()
	{
		return $this->image->getImageHeight();
	}
	public function cutUpAndDown($center_height)
	{
		$y = ($this->getHeight() - $center_height) / 2;
		$this->image->cropImage($this->getWidth(), $center_height, 0, $y);
	}
	public function cutLeftAndRight($center_width)
	{
		$x = ($this->getWidth() - $center_width) / 2;
		$this->image->cropImage($center_width, $this->getHeight(), $x, 0);
	}
	public function resize($width,$height)
	{
		return $this->image->resizeImage($width, $height, \Imagick::FILTER_UNDEFINED, 1);
	}
    public function getMimeType()
    {
        return $this->image_type;
    }
}
