<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Library | Home</title>
	<link rel="stylesheet" href="<?= Constant::BASE_URL ?>/public/styles/general.css">
	<link rel="stylesheet" href="<?= Constant::BASE_URL ?>/public/styles/home.css">
</head>
<body>
	<header>
		<nav>
			<h2>HOME</h2>
			<div class="links">
				<a href="<?= Constant::BASE_URL ?>/myorders">My Orders</a>
				<a href="<?= Constant::BASE_URL ?>/logout">Log out</a>
			</div>
		</nav>
	</header>
	<section class="hero">
		<h1>Welcome to MVC Library</h1>
		<p>Where borrowing books is a breeze...</p>
	</section>
	<main>
		<section class="filters">
			<h2>Filters</h2>
			<form action="<?= Constant::BASE_URL ?>/reset" method="POST">
				<input type="submit" name="reset" id="reset" value="Reset filters">
			</form>

			<form action="<?= Constant::BASE_URL ?>/bytitle" method="POST">
				<input type="text" name="title" id="searchinput" placeholder="search...">
				<input type="submit" name="submit" id="search" value="Search">
			</form>

			<form action="<?= Constant::BASE_URL ?>/byauthor" method="POST">
				<input type="checkbox" name="filtertitle[]" id="authors-title" value="a"
				<?php if (!isset($_SESSION['authors'])) echo 'checked'; ?>>
				<label for="authors-title"><h4>Authors</h4></label>
				<?php if ($authors): foreach ($authors as $author): ?>
					<div class="author">
						<input type="submit" name="author" value="<?= $author['name'] ?>"
						<?php
						if (isset($_SESSION['authors']))
							if (in_array($author['name'], $_SESSION['authors']))
								echo 'class="selected"'; 
						?>>
						<span>(<?= $author['count'] ?>)</span>
					</div>
				<?php endforeach; endif; ?>
			</form>

			<form action="<?= Constant::BASE_URL ?>/bygenre" method="POST">
				<input type="checkbox" name="filtertitle[]" id="genres-title" value="g"
				<?php if (!isset($_SESSION['genres'])) echo 'checked'; ?>>
				<label for="genres-title"><h4>Genres</h4></label>
				<?php if ($genres): foreach ($genres as $genre): ?>
					<div class="genre">
						<input type="submit" name="genre" value="<?= $genre['name'] ?>"
						<?php
						if (isset($_SESSION['genres']))
							if (in_array($genre['name'], $_SESSION['genres']))
								echo 'class="selected"'; 
						?>>
						<span>(<?= $genre['count'] ?>)</span>
					</div>
				<?php endforeach; endif; ?>
			</form>

		</section>

		<section class="books">
			<?php if($books): if ($books instanceof mysqli_result):?>
				<p>Total: <?= $books->num_rows ?></p>
			<?php else: ?>
				<p>Total: <?= count($books) ?></p>
			<?php endif; endif; ?>
			<?php if ($books): foreach ($books as $book): ?>
				<form action="<?= Constant::BASE_URL ?>/order" method="POST">
					<div class="book">
						<input type="hidden" name="book[]" value="<?= $book['id'] ?>">
						<input type="hidden" name="book[]" value="<?= $book['author'] ?>">
						<input type="hidden" name="book[]" value="<?= $book['title'] ?>">
						<h3><?= $book['title'] ?></h3>
						<p><?= $book['author'] ?></p>
						<p class="gray"><?= $book['genre'] ?></p>
						<div class="info">
							<input type="submit" name="submit" value="Reserve">
							<p class="gray">Available: <?= $book['available'] ?></p>
						</div>
					</div>
				</form>
			<?php endforeach; endif; ?>
		</section>
	</main>
</body>
</html>