<?php

function validate_form($p)
{
	if ($p['login'] && $p['passwd'])
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

$dir = '../private';
$file = '../private/passwd';

if (!file_exists($dir))
	mkdir($dir);
if (!file_exists($file))
	file_put_contents($file, null);

$valid = validate_form($_POST);
$logins = false;
if (file_exists($file))
	$logins = unserialize(file_get_contents($file));

echo $valid."hey".$file."<br/>";
echo $logins."hey".$file."<br/>";

if ($valid && !(account_exists($logins, $_POST['login'])))
{
	$account['login'] = $_POST['login'];
	$account['passwd'] = hash('whirlpool', $_POST['passwd']);
	$logins[] = $account;
	file_put_contents($file, serialize($logins));

} else { }

?>