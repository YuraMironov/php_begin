<?php

namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;
use Entities\UserWithPass;
use Repositories\UserRepository;
use Models\TemplaterController;


class RegController extends TemplaterController implements ControllerInterface
{	
	private $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->addTemplaterParam('pageName', "Registration page");
		$this->setUserRepository($userRepository);
	}

	public function doGet($uri)
	{	
		return $this->getTemplaterParams();
	}

	public function doPost($post_params)
	{	
		if ($this->isCorrectRegistrationData($post_params)) {
		    $succes = $this->regUser($post_params);
		    if ($succes) {
			    setcookie('suc_reg', true, time() + 60);
			    $_SESSION['success'] = true;
		    } else {
		    	$this->setErrorData($post_params);
		    }
		} else {
		    $this->setErrorData($post_params);
		}
		Utils::redirect("/reg");
	}

	public function isCorrectRegistrationData($post_params)
	{
		$empty_field = true;
		foreach ($post_params as $val) {
		    $empty_field &= isset($val);
		}
		$correct_data = true;
		$correct_data &= strlen($post_params['name']) >= 3;
		$correct_data &= (bool)preg_match(EMAIL_PATTERN, $post_params['email']);
		$correct_data &= $post_params['password'] == $post_params['password2'];
		return $correct_data && $empty_field;
	}

	public function regUser($post_params){
		try {
		    $user = new UserWithPass();
		    $user->setUsername($post_params['name']);
		    $user->setEmail($post_params['email']);
		    $user->setPassword($post_params['password']);
		    $this->getUserRepository()->add($user);
	 	    return true;	
		} catch (PDOException $e) {
			echo 'Error regUser() method';
			return false;
		}
	}

	public function setErrorData($post_params)
	{
		$_SESSION['success'] = false;
	    if (isset($post_params['name'])) {
	        $_SESSION['name'] = $post_params['name'];
	    }
	    if (isset($post_params['email'])) {
	        $_SESSION['email'] = $post_params['email'];
	    }
	    if ($post_params['password'] != $post_params['password2']) {
	        $_SESSION['errPass'] = true;
	    } else {
	        $_SESSION['errPass'] = false;
	    }
	}

	public function getUserRepository()
	{
		return $this->userRepository;
	}

	public function setUserRepository(UserRepository $repository)
	{
		$this->userRepository = $repository;
	}

}