<?php

class IndexController extends Controller
{
	const TITLE = 'Телефоный справочник';

	private $data = [];

	public function __construct()
	{
		$this->model = new IndexModel();
		$this->view  = new View();
	}
	
	public function index()
	{
		// echo Session::get('isLogget')? Session::get('usermail'): '';
		$this->view->render('index.view.php', 'template.view.php', [
			'title' => self::TITLE,
			'email' => $this->isEmail,
			'login' => $this->model->isAuthorize 
		]);
	}
}
