<?php

namespace Repositories;

use Models\CRUDRepository;
use Entities\User;
use Entities\UserWithPass;
use \PDO;

class UserRepository extends CRUDRepository
{	
	public function add($item)
	{	
		if ($item instanceof UserWithPass && $item->getPassword() != '' && !(self::getUserByEmail($item->getEmail()) instanceof User)) {
			try {
				//for updating user
				if ($item->getId() > 0) {
					$results = $this->connection->prepare("insert into users values (:id, :username, :email)");
					$results->bindParam('id', $item->getId());
				} else { //for adding user
					$results = $this->connection->prepare("insert into users (username, email) values (:username, :email)");
				}
				$results->bindParam('username', $item->getUsername());
				$results->bindParam('email', $item->getEmail());
				if ($results->execute()) {
					$item->setId($item->getId() > 0 ? $item->getId() : $this->connection->lastInsertId());	
					unset($results);
					$results = $this->connection->prepare("insert into passwords (user_id, password) values (:id, :password)");
					$results->bindParam('id', $item->getId());
					$results->bindParam('password', $item->getPassword());
					$results->execute();
				}
			} catch (PDOException $e) {
				self::delete($item);
				return false;
			}
			return true;
		} 
		return false;
	}
	public function get()
	{
		self::getAll();
	}
	public function getAll()
	{
		$user = new User();
		$results = $this->connection->prepare("select * from users;");
		$results->execute();
		$results->setFetchMode(PDO::FETCH_CLASS, 'Entities\User');
		echo "<pre>";
		// while($obj = $results->fetch()) {  
		//     var_dump($obj);
		// }
		$a = null;
		print_r($a = $results->fetchAll());
		return $a;
	}

	public function update($item, $newitem)
	{	
		if ($newitem instanceof User && !($newitem instanceof UserWithPass)) {
			$user = new UserWithPass();
			$user->setEmail($newitem->getEmail());
			$user->setUserName($newitem->getUsername());
			$newitem = $user;
		}
		if ($item instanceof User && $newitem instanceof UserWithPass && $item->getEmail() != null) {
			// var_dump($item, $newitem);
			try {
				$results = $this->connection->prepare("select users.id, email, username, password" .
					" from users join passwords where users.id = passwords.user_id AND email = (:email);");
				$results->bindParam('email', $item->getEmail());
				$results->execute();
				$results->setFetchMode(PDO::FETCH_CLASS, 'Entities\UserWithPass');
				$resultUser = $results->fetch();
				if ($resultUser != null) {
					self::delete($resultUser);
					$newitem->setId($resultUser->getId());
					if ($newitem->getPassword() == null) {
						$newitem->setPassword($resultUser->getPassword());
					} 
					if ($newitem->getUsername() == null) {
						$newitem->setUsername($resultUser->getUsername());
					}
					self::add($newitem);
					return true;
				}
				return false;
			} catch (PDOException $e) {
				return false;
			}
		}
		return false;
	}
	public function delete($item)
	{
		if (!($item instanceof User)) {
			return false;
		}
		try {
			$results = $this->connection->prepare('select id from users where email = (:email);');
			$results->bindParam('email', $item->getEmail());
			$results->execute();
			$results->setFetchMode(PDO::FETCH_ASSOC);
			$userId = $results->fetch();
			if ($userId > 0) {
				$results = $this->connection->prepare('delete from users where email = (:email);');
				$results->bindParam('email', $item->getEmail());
				$results->execute();
				$results = $this->connection->prepare('delete from passwords where user_id = (:id);');
				$results->bindParam('id', $userId['id']);
				$results->execute();
				return true;
			}
			return false;
		} catch (PDOException $e) {
			return false;
		}

	}

	public function getUserbyId($id)
	{
		if ($id != null ) {
			try {
				$results = $this->connection->prepare('select * from users where id = (:id);');
				$results->bindParam('email', $id);
				$results->execute();
				$results->setFetchMode(PDO::FETCH_CLASS, 'Entities\User');
				$a = $results->fetch();
				if ($a instanceof User) {
					return $a;
				} else {
					return false;
				}
			} catch (PDOEception $e) {
				return false;
			}
		}
		return false;
	}
	public function getUserByEmail($email)
	{	
		if ($email != null ) {
			try {
				$results = $this->connection->prepare("select users.id, email, username, password" .
					" from users join passwords where users.id = passwords.user_id AND email = (:email);");
				$results->bindParam('email', $email);
				$results->execute();
				$results->setFetchMode(PDO::FETCH_CLASS, 'Entities\UserWithPass');
				$a = $results->fetch();
				if ($a instanceof UserWithPass) {
					return $a;
				} else {
					return false;
				}
			} catch (PDOEception $e) {
				return false;
			}
		}
		return false;
	}
}