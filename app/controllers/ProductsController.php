<?php

class ProductsController extends Controller
{
	const TITLE  = 'Products';
	const MODULE = 'products.view.php';
	const LAYOUT = 'template.view.php';

	public function __construct()
	{
		$this->view  = new View;
		$this->model = new ProductsModel;
	}

	public function index()
	{
		echo $this->view->render(self::MODULE, self::LAYOUT, [
			'title' => self::TITLE,
			'count' => $this->model->count(),
			'login' => $this->model->isLogin
		]);
	}

	public function show()
	{
		print $this->model->show(new Request);
	}
}
