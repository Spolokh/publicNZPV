<?php

class ProductsModel extends Model
{
	const TABLE  = 'products';

	public function __construct ()
	{
		parent:: __construct();
	}
	
	public function count() // Здесь реальные данные.
	{
		return ORM::forTable(self::TABLE)
			->select(['id'])
			->count()
        	;
	}
	
	public function show(Request $request, $data = [], $query = null) 
	{
		$draw 	= $request->Get('draw');
		$offset = $request->Get('start', 0)->toInteger();
		$number = $request->Get('length', 10)->toInteger();
		$search = $_GET['search']['value'];

		$query = ORM::forTable(self::TABLE)
			->whereRaw('(`mark` LIKE ? OR `model` LIKE ? OR `generation` LIKE ? OR `year` LIKE ? OR `run` LIKE ? OR `color` LIKE ? OR `transmission` LIKE ? OR `body-type` LIKE ? OR `engine-type` LIKE ? OR `gear-type` LIKE ?)', [
				$search.'%', $search.'%',  $search.'%', $search.'%', $search.'%', $search.'%', $search.'%', $search.'%', $search.'%', $search.'%'
			]);
		$total = $query->count();

		$query = $query
		      ->offset($offset)
		      ->limit ($number)
		      ->orderByAsc('id')
		      ->findArray()
		;
		
		foreach ($query AS $k => $row)
		{
			$data[] = [
				'id'   => $row['id'],
				'mark' => $row['mark'],
				'model' => $row['model'],
				'generation' => $row['generation'],
				'year' => $row['year'],
				'run' => $row['run'],
				'color' => $row['color'],
				'body'  => $row['body-type'],
				'engine' => $row['engine-type'],
				'transmission' => $row['transmission'],
				'gear' => $row['gear-type']
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
