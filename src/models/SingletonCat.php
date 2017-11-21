<?php 

namespace Models;

class SingletonCat
{
	private static $voice = null;
	private static $instance = null;
	private function __construct(){}
	private function __clone(){}

	static public function getCat()
	{
		if (self::$instance == null) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function setVoice($newVoice)
	{
		self::$voice = $newVoice;
	}

	public function getVoice()
	{
		return self::$voice;;
	}
}