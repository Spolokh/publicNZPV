<?php

class AjaxController extends Controller
{
	public function __construct()
	{
		$this->model = new AjaxModel();
		$this->view  = new View();
	}

	public function index()
	{
		echo 'AjaxController';
	}

	public function registration()
	{
		$this->model->setRegistration();
	}

	public function addphone()
	{
		$this->model->setPhone();
	}

	public function delbook() 
	{
		$this->model->deleteBook();
	}

	public function contact() 
	{
		$this->model->contact();
	}
}
 