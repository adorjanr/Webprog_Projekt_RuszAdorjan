<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MVC Library | My Order</title>
	<link rel="stylesheet" href="<?= Constant::BASE_URL ?>/public/styles/general.css">
	<link rel="stylesheet" href="<?= Constant::BASE_URL ?>/public/styles/myorders.css">
</head>
<body>
	<main>
		<h1>MY ORDERS</h1>
		<?php if ($orders): foreach ($orders as $order): ?>
			<form action="<?= Constant::BASE_URL ?>/return" method="POST">
				<input type="hidden" name="order_id" value="<?= $order['id'] ?>">
				<input type="hidden" name="book_id" value="<?= $order['book_id'] ?>">
				<p><?= $order['author']?>: <span><?= $order['title'] ?></span></p>
				<button type="submit">Return Book</button>
			</form>
		<?php endforeach; else: ?>
			<h1>error</h1>
		<?php endif; ?>
		<a href="<?= Constant::BASE_URL ?>/home"><button>Back</button></a>
	</main>
</body>
</html>