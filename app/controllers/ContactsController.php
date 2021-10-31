<?php

class ContactsController extends Controller
{
	const TITLE  = 'Контакты';
	const MODULE = 'contacts.view.php';
	const LAYOUT = 'template.view.php';

	protected $view;
	protected $model;

	function __construct()
	{
		$this->view  = new View();
		$this->model = new ContactsModel();
	}

	function index()
	{
        $this->view->render(self::MODULE, self::LAYOUT,
        [
            'title' 	=> self::TITLE,
			'login' 	=> $this->model->isAuthorize,
            'isLogin' 	=> $this->model->isLogin,
			'isEmail' 	=> $this->model->isEmail
		]);
	}
}
