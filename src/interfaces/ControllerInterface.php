<?php
namespace Interfaces;

interface ControllerInterface
{
	public function doGet($uri);
	public function doPost($post_params);
}