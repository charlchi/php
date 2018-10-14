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
	function validate_form($p)
	{
		if ($p['login'] && $p['passwd'] && $p['cpasswd'])
			return true;
		return false;
	}
	
	function account_exists($logins, $login)
	{
		foreach ($logins as $k => $v)
			if ($v['login'] == $login)
				return true;
		return false;
	}

	$message = "";
	if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['start'] == OK)
	{
		$game = new Game();
	}
	?>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
		<div class= "block">
			<h1>Register</h1><br>
    		<label for="login"><b>Username</b></label>
    		<input type="text" placeholder="Enter Username" name="login" required>
    		<label for="passwd"><b>Password</b></label>
    		<input type="password" placeholder="Enter Password" name="passwd" required>
    		<input type="password" placeholder="Confirm Password" name="cpasswd" required>
    		<?php echo "<b style='color:red;'>".$message."</b><br>"; ?>
    		<button type="submit">Register</button>
		</div>
	</form>
</body>
</html>