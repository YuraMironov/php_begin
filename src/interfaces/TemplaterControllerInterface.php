<?php

namespace Interfaces;

interface TemplaterControllerInterface 
{
	public function getTemplaterParams();
	public function setTemplaterParams(array $params);
	public function addTemplaterParam($name, $val);
}