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
	<form action="modif.php" method="POST">
		Username : <input type="text" name="login" value="" /><br />
		Old pass : <input type="password" name="oldpw" value="" /><br />
		New pass : <input type="password" name="newpw" value="" /><br />
		<input type="submit" name="submit" value="OK"/>
	</form>
</body>
</html>