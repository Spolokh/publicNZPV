<?php

class RegistrationController extends Controller
{
	const TITLE  = 'Регистрация';
	const MODULE = 'registration.view.php';
	const LAYOUT = 'template.view.php';
	
	function __construct()
	{
		$this->view  = new View;
		$this->model = new RegistrationModel;
	}

	function index()
	{
		$this->view->render(self::MODULE, self::LAYOUT, [
			'title' => self::TITLE,
			'login' => $this->model->isAuthorize
		]);
	}
}
