<?php

namespace Models;

use Interfaces\TemplaterControllerInterface;

class TemplaterController implements TemplaterControllerInterface
{
	protected $templaterParams;

	public function __construct(){
		$this->addTemplaterParam('pageName', 'Not constructor in controller');
	}
	public function getTemplaterParams()
	{
		return $this->templaterParams;
	}

	public function setTemplaterParams(array $params)
	{
		$this->templaterParams = $params;
	}
	public function addTemplaterParam($name = 0, $val = null)
	{
		$this->templaterParams[$name] = $val;
	}
}