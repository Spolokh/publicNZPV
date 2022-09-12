<?php

class usersController extends Controller
{
	const TITLE = 'Телефонная книга';
	const MODULE = 'users.view.php';
	const LAYOUT = 'template.view.php';

	protected $user;
	protected $view;
	protected $model;
	protected $login;

	public function __construct()
	{
		$this->view  = new View;
		$this->model = new usersModel;
	}

	public function index()
	{
		echo $this->view->render(self::MODULE, self::LAYOUT, [
			'title' => self::TITLE,
			'count' => $this->model->count(),
			'login' => $this->model->isAuthorize
		]);
	}

	public function json()
	{
		print $this->model->json();
	}

	public function user()
	{
		$this->user = $_GET['user'] ?? null;
		if (!isset($this->user))
		{
			return;
		}

		echo $this->view->render('user.view.php', self::LAYOUT, [
			'title' => self::TITLE,
			'query' => $this->model->user()->findOne($this->user),
			'login' => $this->model->isAuthorize
		]);
	}
}
