<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MVC Library</title>
	<link rel="stylesheet" href="<?= Constant::BASE_URL ?>/public/styles/general.css">
	<link rel="stylesheet" href="<?= Constant::BASE_URL ?>/public/styles/login.css">
</head>
<body>
	<main>
		<h1>REGISTER</h1>
		<span><?php if (isset($error)) echo $error ?></span>
		<form action="<?= Constant::BASE_URL ?>/register" method="POST">
			<label for="email">E-mail</label>
			<input type="email" name="email" id="email" required>
			<label for="password">Password</label>
			<input type="password" name="password" id="password" required>
			<button type="submit">Register</button>
		</form>
		<a href="<?= Constant::BASE_URL ?>/"><button>Back</button></a>
	</main>
</body>
</html>