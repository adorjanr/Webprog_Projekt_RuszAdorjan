<?php

require_once __DIR__ . '/../core/Constant.php';
require_once __DIR__ . '/../models/Catalogue.php';

class CatalogueController
{
	private Catalogue $model;

	public function __construct()
	{
		$this->model = new Catalogue();
		session_start();
		if (!isset($_SESSION['user'])) {
			header('Location:' . Constant::BASE_URL . '/login');
			exit();
		}
	}

	public function home(): void
	{
		$filterAuthors = $_SESSION['authors'] ?? [];
		$filterGenres = $_SESSION['genres'] ?? [];
		$filterTitle = $_SESSION['title'] ?? '';
		
		if (!empty($filterTitle)) {
			$filterTitle = "%$filterTitle%"; 
			$books = $this->model->findByTitle($filterTitle);
			$authors = $this->model->findAuthors();
			$genres = $this->model->findGenres();
		}
		// all books
		elseif (empty($filterAuthors) && empty($filterGenres)) {
			$books = $this->model->find();
			$authors = $this->model->findAuthors();
			$genres = $this->model->findGenres();
		}
		// books by author
		elseif (!empty($filterAuthors) && empty($filterGenres)) {
			$books = $this->model->findByAuthor($filterAuthors);
			$authors = $this->model->findAuthors();
			$genres = $this->model->findGenresByAuthor($filterAuthors);
		}
		// books by genre
		elseif (empty($filterAuthors) && !empty($filterGenres)) {
			$books = $this->model->findByGenre($filterGenres);
			$authors = $this->model->findAuthorsByGenre($filterGenres);
			$genres = $this->model->findGenres();
		}
		// books by both
		else {
			$books = $this->model->findByBoth($filterAuthors, $filterGenres);
			$authors = $this->model->findAuthorsByBoth($filterGenres, $filterAuthors);
			$genres = $this->model->findGenresByBoth($filterAuthors, $filterGenres);
			
			$books = $books->fetch_all(MYSQLI_ASSOC);
			$authors = $authors->fetch_all(MYSQLI_ASSOC);
			$genres = $genres->fetch_all(MYSQLI_ASSOC);
		
			$authorsName = array_column($authors, 'name');
			$genresName = array_column($genres, 'name');
			
			$toDeleteFromFilterAuthors = array_diff($filterAuthors, $authorsName);
			$toDeleteFromFilterGenres = array_diff($filterGenres, $genresName);
			
			if (!empty($toDeleteFromFilterAuthors) || !empty($toDeleteFromFilterGenres)) {
				$_SESSION['authors'] = array_diff($filterAuthors, $toDeleteFromFilterAuthors);
				$_SESSION['genres'] = array_diff($filterGenres, $toDeleteFromFilterGenres);
				
				$filterAuthors = $_SESSION['authors'] ?? [];
				$filterGenres = $_SESSION['genres'] ?? [];
				
				// books by author
				if (!empty($filterAuthors) && empty($filterGenres)) {
					$books = $this->model->findByAuthor($filterAuthors);
					$authors = $this->model->findAuthors();
					$genres = $this->model->findGenresByAuthor($filterAuthors);
				}
				// books by genre
				elseif (empty($filterAuthors) && !empty($filterGenres)) {
					$books = $this->model->findByGenre($filterGenres);
					$authors = $this->model->findAuthorsByGenre($filterGenres);
					$genres = $this->model->findGenres();
				}
				// books by both
				else {
					$books = $this->model->findByBoth($filterAuthors, $filterGenres);
					$authors = $this->model->findAuthorsByBoth($filterGenres, $filterAuthors);
					$genres = $this->model->findGenresByBoth($filterAuthors, $filterGenres);
				}
			}
		}
		require_once __DIR__ . '/../views/home.php';
	}
		
	
	public function byAuthor() 
	{
		unset($_SESSION['title']);
		if (isset($_SESSION['authors'])) {
			if (!in_array($_POST['author'], $_SESSION['authors'])) {
				$_SESSION['authors'][] = $_POST['author'];
			} else {
				unset($_SESSION['authors'][array_search($_POST['author'], $_SESSION['authors'])]);
			}
		} else {
			$_SESSION['authors'][] = $_POST['author'];
		}
		header('Location:' . Constant::BASE_URL . '/home');
		exit();
	}
	
	public function byGenre() 
	{
		unset($_SESSION['title']);
		if (isset($_SESSION['genres'])) {
			if (!in_array($_POST['genre'], $_SESSION['genres'])) {
				$_SESSION['genres'][] = $_POST['genre'];
			} else {
				unset($_SESSION['genres'][array_search($_POST['genre'], $_SESSION['genres'])]);
			}
		} else {
			$_SESSION['genres'][] = $_POST['genre'];
		}
		header('Location:' . Constant::BASE_URL . '/home');
		exit();
	}
	
	public function byTitle()
	{
		unset($_SESSION['authors']);
		unset($_SESSION['genres']);
		$_SESSION['title'] = $_POST['title'];
		header('Location:' . Constant::BASE_URL . '/home');
		exit();
	}

	public function reset()
	{
		unset($_SESSION['authors']);
		unset($_SESSION['genres']);
		unset($_SESSION['title']);
		header('Location:' . Constant::BASE_URL . '/home');
	}
}