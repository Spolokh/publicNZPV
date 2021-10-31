<?php

abstract class Controller
{
	protected $view;
	protected $model;
	
	function __construct()
	{
		$this->model = new Model();
		$this->view  = new View();
	}
	
	// действие вызываемое по умолчанию
	public function index()
	{
	
	}
}
