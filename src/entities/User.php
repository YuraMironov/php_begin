<?php

namespace Entities;

class User
{
	protected $id;
	public function getId(){
		return $this->id;
	}
	public function setId($newVal){
		$this->id=$newVal;
	}
	protected $username;
	public function getUsername(){
		return $this->username;
	}
	public function setUsername($newVal){
		$this->username=$newVal;
	}
	protected $email;
	public function getEmail(){
		return $this->email;
	}
	public function setEmail($newVal){
		$this->email=$newVal;
	}
}