<?php

require_once __DIR__ . '/../core/Database.php';

class Order
{
	private mysqli $conn;

	public function __construct()
	{
		$this->conn = Database::connect();
	}

	public function findByUserId(int $user_id)
	{
		$stmt = $this->conn->prepare('SELECT orders.id AS id, book_id, user_id, author, title FROM orders
			INNER JOIN books ON orders.book_id = books.id
			WHERE user_id = ?');
		$stmt->bind_param('i', $user_id);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}

	public function placeOrder(int $book_id, int $user_id): bool
	{
		try {
			$this->conn->begin_transaction();
			// decrement available
			$stmt = $this->conn->prepare('UPDATE books SET available = available - 1 WHERE id = ?');
			$stmt->bind_param('i', $book_id);
			$stmt->execute();
			if ($stmt->affected_rows == 0) {
				throw new Exception();
			}
			// insert order
			$stmt = $this->conn->prepare('INSERT INTO orders (book_id, user_id) VALUES (?, ?)');
			$stmt->bind_param('ii', $book_id, $user_id);
			$stmt->execute();
			if ($stmt->affected_rows == 0) {
				throw new Exception();
			}

			$this->conn->commit();
		} catch (Exception) {
			$this->conn->rollback();
			return false;
		} finally {
			$this->conn->autocommit(true);
			$stmt->close();
		}
		return true;
	}

	public function isOrdered(int $book_id, int $user_id)
	{
		$stmt = $this->conn->prepare('SELECT * FROM orders WHERE book_id = ? AND user_id = ?');
		$stmt->bind_param('ii', $book_id, $user_id);
		$stmt->execute();
		$order = $stmt->get_result();
		return $order->num_rows > 0;
	}

	public function isAvailable(int $book_id): bool
	{
		$stmt = $this->conn->prepare('SELECT available FROM books WHERE id = ? LIMIT 1');
		$stmt->bind_param('i', $book_id);
		$stmt->execute();
		$book = $stmt->get_result()->fetch_assoc();
		$stmt->close();
		return $book['available'] > 0;
	}

	public function returnOrder(int $order_id, int $book_id)
	{
		try {
			$this->conn->begin_transaction();
			// insert order
			$stmt = $this->conn->prepare('DELETE FROM orders WHERE id = ?');
			$stmt->bind_param('i', $order_id);
			$stmt->execute();
			if ($stmt->affected_rows == 0) {
				throw new Exception();
			}
			// decrement available
			$stmt = $this->conn->prepare('UPDATE books SET available = available + 1 WHERE id = ?');
			$stmt->bind_param('i', $book_id);
			$stmt->execute();
			if ($stmt->affected_rows == 0) {
				throw new Exception();
			}

			$this->conn->commit();
		} catch (Exception) {
			$this->conn->rollback();
		} finally {
			$this->conn->autocommit(true);
			$stmt->close();
		}
	}
}