<?php

require_once __DIR__ . '/../core/Database.php';

class User
{
	private mysqli $conn;

	public function __construct()
	{
		$this->conn = Database::connect();
	}

	public function find(string $email, string $password): array|bool|null
	{
		$stmt = $this->conn->prepare('SELECT id, email FROM users WHERE email = ? AND password = ?');
		$stmt->bind_param('ss', $email, $password);
		$stmt->execute();
		$result = $stmt->get_result()->fetch_assoc();
		$stmt->close();
		return $result;
	}

	public function findByEmail(string $email): array|bool|null
	{
        $stmt = $this->conn->prepare('SELECT id, email FROM users WHERE email = ?');
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$result = $stmt->get_result()->fetch_assoc();
		$stmt->close();
		return $result;
    }

	public function insert(string $email, string $password): bool
	{
		$stmt = $this->conn->prepare('INSERT INTO users (email, password) VALUES (?, ?)');
		$stmt->bind_param('ss', $email, $password);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}
}
