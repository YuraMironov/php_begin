<?php

namespace Interfaces;

interface ImageInterface 
{
	public function __construct($filename);
	public function save($filename, $image_type=IMAGETYPE_JPEG);
	public function output();
	public function getWidth();
	public function getHeight();
	public function cutUpAndDown($center_height);
	public function cutLeftAndRight($center_width);
	public function resizeToHeight($height);
	public function resizeToWidth($width);
	public function scale($scale);
	public function resize($width,$height);
    public function getMimeType();
}