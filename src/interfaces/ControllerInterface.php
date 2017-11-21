<?php
namespace Interfaces;

interface ControllerInterface
{
	public function doGet($get_params);
	public function doPost($post_params);
}