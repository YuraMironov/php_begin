<?php

namespace Controllers;

use Interfaces\ControllerInterface;
use Utils\Utils;
use Models\OAuthTwitter;
use Entities\User;


class TwitterController implements ControllerInterface
{
	public function doGet($uri)
	{
		$uri = parse_str($uri, $_GET);
		// Пример использования класса:
		if (!empty($_GET['denied'])) {
		    // Пользователь отменил авторизацию.
		    Utils::redirect('/');
		} elseif (empty($_GET['oauth_token']) || empty($_GET['oauth_verifier'])) {
		    // Самый первый запрос
		    OAuthTwitter::goToAuth();
		} else {
		    // Пришёл ответ без ошибок после запроса авторизации
		    $oauth_token = trim($_GET['oauth_token']);
		    $oauth_verifier = trim($_GET['oauth_verifier']);
		    if (!OAuthTwitter::getToken($oauth_token, $oauth_verifier)) {
		        die('Error - no token by code');
		    }

		        /*
		         * На данном этапе можно проверить зарегистрирован ли у вас Twitter-юзер с id = OAuthTwitter::$userId
		         * Если да, то можно просто авторизовать его и не запрашивать его данные.
		         */

		    $user = new User();
		    $user->setId(OAuthTwitter::getUser()['id']);
		    $user->setUsername(OAuthTwitter::getUser()['screen_name'] . ' (' . OAuthTwitter::getUser()['name'] . ')');
		    $_SESSION['user'] = $user;

		    Utils::redirect('/profile');
		    /*
		     * Вот и всё - мы узнали основные данные авторизованного юзера.
		     * $user в этом примере состоит из многих полей: id, name, screen_name и т.д.
			// 		     */
		}
	}
	public function doPost($post_params)
	{
		Utils::redirect('/err404');
	}
}