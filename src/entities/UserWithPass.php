<?php

namespace Entities;

class UserWithPass extends User
{
	protected $password;
	public function getPassword(){
		return $this->password;
	}
	public function setPassword($newVal){
		$this->password=$newVal;
	}
	public function getSimpleUser()
	{
		$simpleUser = new User();
		$simpleUser->setId($this->getId());
		$simpleUser->setEmail($this->getEmail());
		$simpleUser->setUsername($this->getUsername());
		return $simpleUser;
	}
}