<?php

/**
 * 16.02.2022 Jury Spolokh
 * Trait для работы с авторизированным пользователем
 */

namespace traits;

trait Users
{
    public function getUser($key = 'userid') : int
	{
		return \Session::get($key);
    }

	public function getLogin($key = 'username') : string
	{
		return \Session::get($key);
    }

	public function getGroup($key = 'usergroup') : int
	{
		return \Session::get($key);
    }

	public function isAuth() : bool
	{
		return \Session::has('isauth');
	}

	public function getAvatar($ext = '.jpg') : string
	{
		$login = $this->getLogin();
		return file_exists(root .'/img/' . $login . $ext) ? $login . $ext : 'default.png';
    }

	/**
	 * Generate a random string, using a cryptographically secure 
	 * pseudorandom number generator (random_int)
	 * 
	 * For PHP 7, random_int is a PHP core function
	 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
	 * 
	 * @param int $length      How many characters do we want?
	 * @param string $keyspace A string of all possible characters
	 *                         to select from
	 * @return string
	 */
	private function generateRandomPassword( int $length = 64, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string
	{
		if ($length < 1) {
			throw new \Exception("Length must be a positive integer");
		}

		$pieces = [];

		$max = mb_strlen($keyspace, '8bit') - 1;
		for ($i = 0; $i < $length; $i++) {
			$pieces[]= $keyspace[random_int(0, $max)];
		}
		return implode('', $pieces);
	}
}
