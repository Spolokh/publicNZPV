<?php

class GuestController extends Controller
{
	const TITLE = 'Гостивая книга';

	function __construct()
	{
		$this->model = new GuestModel();
		$this->view  = new View();
	}

	function index()
	{
        $query = $this->model->getData();

        $this->view->render('guest.view.php', 'template.view.php',
        [
			'title' => self::TITLE,
			'query' => $this->model->sortData($query)
		]);
	}
}
