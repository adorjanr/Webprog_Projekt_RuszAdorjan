<?php

class Constant
{
	public const BASE_URL = '/library';
	public const ROUTES = [
		['method' => 'GET', 'path' => '/', 'controller' => HomeController::class, 'action' => 'index'],
		['method' => 'GET', 'path' => '/login', 'controller' => HomeController::class, 'action' => 'login'],
		['method' => 'GET', 'path' => '/register', 'controller' => HomeController::class, 'action' => 'register'],
		['method' => 'POST', 'path' => '/login', 'controller' => UserController::class, 'action' => 'login'],
		['method' => 'POST', 'path' => '/register', 'controller' => UserController::class, 'action' => 'register'],
		['method' => 'GET', 'path' => '/logout', 'controller' => UserController::class, 'action' => 'logout'],
		['method' => 'GET', 'path' => '/home', 'controller' => CatalogueController::class, 'action' => 'home'],
		['method' => 'POST', 'path' => '/byauthor', 'controller' => CatalogueController::class, 'action' => 'byAuthor'],
		['method' => 'POST', 'path' => '/bygenre', 'controller' => CatalogueController::class, 'action' => 'byGenre'],
		['method' => 'POST', 'path' => '/bytitle', 'controller' => CatalogueController::class, 'action' => 'byTitle'],
		['method' => 'POST', 'path' => '/reset', 'controller' => CatalogueController::class, 'action' => 'reset'],
		['method' => 'POST', 'path' => '/order', 'controller' => OrderController::class, 'action' => 'order'],
		['method' => 'GET', 'path' => '/myorders', 'controller' => OrderController::class, 'action' => 'myOrders'],
		['method' => 'POST', 'path' => '/return', 'controller' => OrderController::class, 'action' => 'return'],
	];
	public const DB_HOST = 'localhost';
	public const DB_USER = 'root';
	public const DB_PASS = '';
	public const DB_NAME = 'library';
}
