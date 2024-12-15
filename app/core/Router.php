<?php

require_once __DIR__ . '/Constant.php';
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/CatalogueController.php';
require_once __DIR__ . '/../controllers/OrderController.php';

class Router
{
	public array $routes = Constant::ROUTES;

	public function route()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$path = str_replace(Constant::BASE_URL, '', $_SERVER['REQUEST_URI']);
		
		foreach ($this->routes as $route) {
			if ($route['method'] === $method && $route['path'] === $path) {
				$controller = new $route['controller']();
				$action = $route['action'];
				return $controller->$action();
			}
		}

		echo '404 - NOT FOUND';
	}
}
