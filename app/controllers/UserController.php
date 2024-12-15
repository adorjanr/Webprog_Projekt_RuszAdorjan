<?php

require_once __DIR__ . '/../core/Constant.php';
require_once __DIR__ . '/../models/User.php';

class UserController
{
	private User $model;

	public function __construct()
	{
		$this->model = new User();
		session_start();
	}

	public function login(): void
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$user = $this->model->find($email, $password);

		if ($user) {
			$_SESSION['user'] = $user;
			header('Location:' . Constant::BASE_URL . '/home');
			exit();
		} else {
			$error = 'Invalid e-mail or password';
			require_once __DIR__ . '/../views/login.php';
		}
	}

	public function register(): void
	{
		$email = $_POST['email'];
		$password = $_POST['password'];
		
		$user = $this->model->findByEmail($email);

		if ($user === null) {
			$this->model->insert($email, $password);
			$user = $this->model->find($email, $password);
			$_SESSION['user'] = $user;
			header('Location:' . Constant::BASE_URL . '/home');
			exit();
		} else {
			$error = 'E-mail is already registered.';
			require_once __DIR__ . '/../views/register.php';
		}
	}

	public function logout(): never
	{
		session_destroy();
		header('Location:' . Constant::BASE_URL);
		exit();
	}
}
