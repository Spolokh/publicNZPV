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
	
	public function count()
	{
		return ORM::forTable(self::TABLE)
			->select(['id'])
			->count();
	}

	public function user()
	{
		return ORM::forTable(self::TABLE);
	}

	
	public function json( $json = [] ) 
	{
		$draw 	= $_GET['draw'];
		$offset = $_GET['start'] ?? 0;
		$number = $_GET['length'] ?? 10;
		$search = $_GET['search']['value'];
		
		$query = ORM::forTable(self::TABLE)
			->select(['id', 'usergroup', 'username', 'name', 'mail', 'date', 'avatar'])
			->where('deleted', 0)
		;
		$total = $query->count();
		$query = $query
			->whereRaw('(`username` LIKE ? OR `mail` LIKE ?)', [
				$search.'%', $search.'%'
			])
			->offset($offset)
			->limit ($number)
			->orderByAsc('id')
			->findMany()
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
