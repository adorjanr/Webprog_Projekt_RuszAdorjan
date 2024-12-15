<?php

require_once __DIR__ . '/../core/Constant.php';
require_once __DIR__ . '/../models/Order.php';

class OrderController
{
	private Order $model;

	public function __construct()
	{
		$this->model = new Order();
		session_start();
		if (!isset($_SESSION['user'])) {
			header('Location:' . Constant::BASE_URL . '/login');
			exit();
		}
	}

	public function order()
	{	
		$success = false;
		$ordered = $this->model->isOrdered($_POST['book'][0], $_SESSION['user']['id']);
		if (!$ordered) {
			$available = $this->model->isAvailable($_POST['book'][0]);
			if ($available) {
				$success = $this->model->placeOrder($_POST['book'][0], $_SESSION['user']['id']);
			}
		}
		require_once __DIR__ . '/../views/order.php';
	}

	public function myOrders()
	{
		$orders = $this->model->findByUserId($_SESSION['user']['id']);
		require_once __DIR__ . '/../views/myorders.php';
	}

	public function return()
	{
		$order_id = $_POST['order_id'];
		$book_id = $_POST['book_id'];
		$this->model->returnOrder($order_id, $book_id);
		header('Location:' . Constant::BASE_URL . '/myorders');
	}
}