<?php

require_once('auth.php');

session_start();

$login = $_POST['login'];
$passwd = $_POST['passwd'];
echo $login."</br>";
echo $passwd."</br>";
if ($login && $passwd && auth($login, $passwd))
{
	$_SESSION['logged_on_user'] = $login;
	echo 'OK\n';
}
else
{
	$_SESSION['logged_on_user'] = '';
	echo 'ERROR\n';
}
header( "Location: index.php" );

?>