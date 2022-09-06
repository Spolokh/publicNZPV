<?php

class UsersModel extends Model
{
  	const OFFSET = 0;
	const NUMBER = 10;
	const TABLE  = 'users';

	public function __construct ()
	{
		parent:: __construct();
	}
	
	public function query() // Здесь реальные данные.
	{
		$offset = $_GET['skip'] ?? self::OFFSET;

		return ORM::forTable('users')
			->limit (self::NUMBER)
			->offset(self::OFFSET)
			->orderByAsc('id');
	}

	public function user()
	{
		return ORM::forTable('users');
	}

	
	public function json( $json = [], $query = null ) 
	{
		$draw 	= $_GET['draw'];
		$offset = $_GET['start'] ?? 0;
		$number = $_GET['length'] ?? 10;
		$search = $_GET['search']['value'];
		
		$query = ORM::forTable(self::TABLE)->select(['id', 'username', 'mail', 'date', 'avatar']);
		$total = $query->count();

		if (!empty($search))
		{
			$query = $query->whereLike('username', '%'.$search.'%');
		}

		$query = $query
			->limit ($number)
			->offset($offset)
			->orderByAsc('id')
		;
		
		foreach ($query->findArray() AS $k => $row)
		{
			$data[] = [
				'id'		=> $row['id'],
				'mail' 		=> $row['mail'],
				'date'  	=> $row['date'],
				'username' 	=> $row['username'],
				'avatar' 	=> $row['avatar'] ? $row['username']. '.' .$row['avatar'] : 'default.png'
			];
		}
		return json_encode([
			'draw' => $draw,
			'recordsTotal' => $total,
			'recordsFiltered' => $total,
			'data' => $data
		]);
	}
}
