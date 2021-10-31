<?php

abstract class Model
{
	protected $member = [];
	protected $username;
	protected $password;

	public $isLogin;
	public $isEmail;
	public $isAuthorize;

	public function __construct() 
	{
		$this->logOut();
		$this->isAuthorize = Session::has('username')
			? Session::get('username')
			: $this->checkLogin();

		$this->isLogin = Session::get('username');
		$this->isEmail = Session::get('usermail');
	}

	public function checkLogin($k = 'isLogget')
	{
		$this->username = $_POST['username'] ?? null;
		$this->password = $_POST['password'] ?? null;

		if ( !isset($this->username, $this->password) ) 
		{
			return false;
		}
		
		$member = ORM::forTable('users')
			->select(['id', 'mail', 'username', 'password'])
			->where(['username' => $this->username])
			->findOne(); 

		if ( !empty($member) and password_verify($this->password, $member->password))
		{
			Session::set('username', $member->username);
			Session::set('usermail', $member->mail);
			Session::set('userid', 	$member->id);
			Session::set($k, true);
			return $member->username;
		} 
		
		return false;
	}

	public function isAuth()
	{
		return Session::has('userid');
	}

	public function logOut()
	{
		if (isset($_GET['exit']))
		{
			unset($_SESSION['username'], $_SESSION['usermail']);
			Session::destroy();
			header('Location: /');
			exit;
		}
	}

	/**
	 * Запись ошибок
	 */

	protected function logWrite($message, $write = false)
	{
		if ($write === false)
		{
			return;
		}

		$output = date('d.m.Y H:i:s') . PHP_EOL . $message . PHP_EOL . '-------------------------' . PHP_EOL;
		file_put_contents(root . '/logs.txt', $output, FILE_APPEND | LOCK_EX);
	}
}
