<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modify Account</title>
	<link rel="stylesheet" href="style/style.css"/>
</head>
<body>
	<?php
		include_once('header.php');
	?>
	<form action="create1.php" method="POST">
		Username : <input type="text" name="login" value="" /><br />
		Password : <input type="password" name="passwd" value="" /><br />
		<input type="submit" name="submit" value="OK"/>
	</form>
</body>
</html>