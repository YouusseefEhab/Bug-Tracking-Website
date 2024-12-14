<?php

require_once __DIR__ . '/../Controllers/usersController.php';

class User
{
	private $id;
	private $username;
	private $email;
	private $role;

	public function __construct($dbRow)
	{
		$this->id = $dbRow['id'];
		$this->username = $dbRow['username'];
		$this->email = $dbRow['email'];
		$this->role = UsersController::getRoleFromID($dbRow['role_id']);
	}

	public function getID()
	{
		return $this->id;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getRole()
	{
		return $this->role;
	}
}
