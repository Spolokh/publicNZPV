<?php
/**
 * Класс для определения запрашиваемой страницы.
*/

class Route
{
	public static function start()
	{
		$contrName = "Index";
		$modelName = "Index";
		$action    = "index";

		$modelName = $modelName.'Model';
		$contrName = $contrName.'Controller';

		$routes = strtok ($_SERVER["REQUEST_URI"], '?');
		$routes = explode('/', $routes);

		// получаем имя контроллера
		if (!empty($routes[1]))
		{	
			$contrName = ucfirst($routes[1]. 'Controller');
			$modelName = ucfirst($routes[1]. 'Model');
		}

		// получаем имя экшена
		if (!empty($routes[2]))
		{
			$action = $routes[2];
		}

		// подцепляем файл с классом модели (файла модели может и не быть)
		$modelFile = MODEL_PATH .DIRECTORY_SEPARATOR. $modelName.'.php';

		if ( file_exists($modelFile) )
		{
			include_once $modelFile;
		}

		// подцепляем файл с классом контроллера
		$contrFile = CONTR_PATH . DIRECTORY_SEPARATOR . $contrName . '.php';

		if ( file_exists($contrFile) )
		{
			include_once $contrFile;
		}
		else
		{
			self::Page404();
		}
		
		// контроллер
		$controller = new $contrName();

		method_exists($controller, $action) ? $controller->$action() : Route::ErrorPage404();
	}

	public static function loader()
    {
        spl_autoload_register(function ($class) 
		{   
			$file = VENDOR . DIRECTORY_SEPARATOR . str_replace('\\', '/', $class).'.php';
            
			if ( file_exists($file) )
			{
                require_once $file;
                if ( class_exists($class) ) 
				{
					return true;
				}
            }
            return false;
        });
    }

	public static function Page404()
	{
		$host = 'http://'.$_SERVER['HTTP_HOST'];
		header('HTTP/1.1 404 Not Found');
		header('Location: '.$host.'/page404');
		exit;
    }
}
