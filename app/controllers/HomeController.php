<?php

class HomeController
{
	public function index(): void
	{
		require_once __DIR__ . '/../views/index.php';
	}

	public function login(): void
	{
		require_once __DIR__ . '/../views/login.php';
	}

	public function register(): void
	{
		require_once __DIR__ . '/../views/register.php';
	}
}
