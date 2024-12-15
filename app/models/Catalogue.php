<?php

require_once __DIR__ . '/../core/Database.php';

class Catalogue
{
	private mysqli $conn; 

	public function __construct()
	{
		$this->conn = Database::connect();
	}

	// FIND BOOKS
	public function find(): bool|mysqli_result
	{
		$query = 'SELECT * FROM books WHERE available > 0';
		return $this->conn->query($query);
	}

	public function findByAuthor(array $authors)
	{
		$params = str_repeat('?, ', count($authors) - 1) . '?';
		$types = str_repeat('s', count($authors));
		$stmt = $this->conn->prepare("SELECT * FROM books WHERE available > 0 AND author IN ($params)");
		$stmt->bind_param($types, ...$authors);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}

	public function findByGenre(array $genres)
	{
		$params = str_repeat('?, ', count($genres) - 1) . '?';
		$types = str_repeat('s', count($genres));
		$stmt = $this->conn->prepare("SELECT * FROM books WHERE available > 0 AND genre IN ($params)");
		$stmt->bind_param($types, ...$genres);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}

	public function findByBoth(array $authors, array $genres)
	{
		$paramsAuthor = str_repeat('?, ', count($authors) - 1) . '?';
		$paramsGenre = str_repeat('?, ', count($genres) - 1) . '?';
		$types = str_repeat('s', count($authors) + count($genres));
		$stmt = $this->conn->prepare("SELECT * FROM books
			WHERE available > 0 AND author IN ($paramsAuthor) AND genre IN ($paramsGenre)");
		$stmt->bind_param($types, ...$authors, ...$genres);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}

	public function findByTitle(string $title)
	{
		$stmt = $this->conn->prepare("SELECT * FROM books
			WHERE available > 0 AND title LIKE ?");
		$stmt->bind_param('s', $title);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}

	// FIND AUTHORS
	public function findAuthors()
	{
		$query = 'SELECT author AS name, COUNT(author) AS count FROM books
			WHERE available > 0 GROUP BY author ORDER BY author';
		return $this->conn->query($query);
	}

	public function findAuthorsByGenre(array $genres)
	{
		$params = str_repeat('?, ', count($genres) - 1) . '?';
		$types = str_repeat('s', count($genres));
		$stmt = $this->conn->prepare("SELECT author AS name, COUNT(author) AS count FROM books
			WHERE available > 0 AND genre IN ($params)
			GROUP BY author ORDER BY author");
		$stmt->bind_param($types, ...$genres);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}

	public function findAuthorsByBoth(array $genres, array $include)
	{
		$paramsGenre = str_repeat('?, ', count($genres) - 1) . '?';
		$paramsInclude = str_repeat('?, ', count($include) - 1) . '?';
		$types = str_repeat('s', count($genres) + count($include));
		$stmt = $this->conn->prepare("SELECT author AS name, COUNT(author) AS count FROM books
			WHERE available > 0 AND genre IN ($paramsGenre) OR author IN ($paramsInclude)
			GROUP BY author ORDER BY author");
		$stmt->bind_param($types, ...$genres, ...$include);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}

	// FIND GENRES
	public function findGenres()
	{
		$query = 'SELECT genre AS name, COUNT(genre) AS count FROM books
			WHERE available > 0 GROUP BY genre ORDER BY genre';
		return $this->conn->query($query);
	}

	public function findGenresByAuthor(array $authors)
	{
		$params = str_repeat('?, ', count($authors) - 1) . '?';
		$types = str_repeat('s', count($authors));
		$stmt = $this->conn->prepare("SELECT genre AS name, COUNT(genre) AS count FROM books
			WHERE available > 0 AND author IN ($params)
			GROUP BY genre ORDER BY genre");
		$stmt->bind_param($types, ...$authors);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}

	public function findGenresByBoth(array $authors, array $include)
	{
		$paramsAuthor = str_repeat('?, ', count($authors) - 1) . '?';
		$paramsInclude = str_repeat('?, ', count($include) - 1) . '?';
		$types = str_repeat('s', count($authors) + count($include));
		$stmt = $this->conn->prepare("SELECT genre AS name, COUNT(genre) AS count FROM books
			WHERE available > 0 AND author IN ($paramsAuthor) OR author IN ($paramsInclude)
			GROUP BY genre ORDER BY genre");
		$stmt->bind_param($types, ...$authors, ...$include);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();
		return $result;
	}
}