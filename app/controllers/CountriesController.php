<?php

use Traits\Users;

class countriesController extends Controller
{
    use Users;

    const TITLE  = 'Список стран';
    const LAYOUT = 'template.view.php';
    const MODULE = 'countries.view.php';

    private $select = ['id', 'countryName', 'countryCode', 'capital'];

	public function __construct()
	{
		$this->view = new View;
	}

	public function index()
	{
        $limit = 10;
        $query = ORM::forTable('countries');
        $total = $query->count();

        $offset = (new Request)->Get('page', 0)->toInteger();
        $offset = !empty($offset) ? (( $offset - 1 ) * $limit): 0;

        $query = $query->select($this->select)
            ->limit($limit)
            ->offset($offset)
            ->findMany()
        ;

        $pages = new Pagination([ 
            'total' => $total, 
            'limit' => $limit
        ]);

        $this->view->render(self::MODULE, self::LAYOUT, [
			'query' => $query,
            'pages' => $pages,
            'login' => $this->getLogin(),
            'title' => self::TITLE
		]);
    }
}
