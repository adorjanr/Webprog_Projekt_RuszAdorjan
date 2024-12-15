<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MVC Library | Order</title>
	<link rel="stylesheet" href="<?= Constant::BASE_URL ?>/public/styles/general.css">
	<link rel="stylesheet" href="<?= Constant::BASE_URL ?>/public/styles/order.css">
</head>
<body>
	<main>
		<?php if ($success): ?>
			<h1>THANK YOU FOR YOUR ORDER</h1>
			<p><?= $_POST['book'][1] ?>: <span><?= $_POST['book'][2] ?></span></p>
		<?php else: ?>
			<h1>SORRY, SOMETHING WENT WRONG</h1>
		<?php endif; ?>
		<a href="<?= Constant::BASE_URL ?>/home"><button>Back</button></a>
	</main>
</body>
</html>