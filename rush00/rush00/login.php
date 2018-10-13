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

	&nbsp;&nbsp;&nbsp;Login<br/><br/>
	<form action="login1.php" method="POST">
		Username : <input type="text" name="login" value="" /><br />
		Old pass : <input type="password" name="passwd" value="" /><br />
		<input type="submit" name="submit" value="OK"/>
	</form>
	<br/>
	<a href="modif.php">Modify account</a><br />
	

</body>
</html>
