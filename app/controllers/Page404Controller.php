<?php

class Page404Controller extends Controller
{
        public function __construct()
	{
	}

	public function index()
	{
		(new View())->render('404.view.php', 'template.view.php');
	}

}
