<?php

function validate_form($p)
{
	if ($p['login'] && $p['passwd'] && $p['submit'])
		if ($p['submit'] === 'OK')
			return true;
	return false;
}

function read_logins($file)
{
	if (file_exists(file))
		return unserialize(file_get_contents($file));
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
$logins = read_logins($file);
if ($valid && !(account_exists($logins, $login)))
{
	$account['login'] = $_POST['login'];
	$account['passwd'] = hash('whirlpool', $_POST['passwd']);
	$logins[] = $account;
	file_put_contents($file, serialize($logins));
	echo "OK\n";
} else { echo "ERROR\n"; }

?>