<?php

namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;
use Entities\User;
use Entities\UserWithPass;
use Repositories\UserRepository;
use Models\TemplaterController;

class LoginController extends TemplaterController implements ControllerInterface
{	
	private $userRepository;

	public function __construct(UserRepository $userRepository)
	{
		$this->addTemplaterParam('pageName', 'Login page');
		$this->setUserRepository($userRepository);
	}

	public function doGet($uri)
	{	
		if (empty($_SESSION['user'])) {
			return $this->getTemplaterParams();	
		}
		Utils::redirect('/profile');
	}

	public function doPost($post_params)
	{		
		$user = $this->checkUserbyEmail($post_params['email']);

		if ($user instanceof UserWithPass) {
			if ($user->getPassword() === $post_params['password']) {
				$_SESSION['user'] = $user->getSimpleUser($user);
				Utils::redirect('/profile');
			} else {
				Utils::redirect('/login');
			}
		} else {
			Utils::redirect('/reg');
		}
	}


	public function checkUserbyEmail($email)
	{		
		if ((bool)preg_match(EMAIL_PATTERN, $email)) {
			return $this->getUserRepository()->getUserByEmail($email);
		}
		return false;
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