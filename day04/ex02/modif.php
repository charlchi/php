<?php

function validate_form($p)
{
	if ($p['login'] && $p['oldpw'] && $p['newpw'] && $p['submit'])
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

function find_user($logins, $login, $oldhash)
{
	foreach ($logins as $k => $v)
		if ($v['login'] == $login && $v['passwd'] == $oldhash)
			return $k;
	return false;
}

$file = '../private/passwd'; 
$valid = validate_form($_POST);
$logins = read_logins($file);

if ($valid && $logins)
{
	$oldhash = hash('whirlpool', $_POST['oldpw']);
	if (($user = find_user($logins, $_POST['login'], $oldhash)))
	{
		$logins[$user]['passwd'] = hash('whirlpool', $_POST['newpw']);
		file_put_contents($file, serialize($logins));
	}
	else { echo "ERROR\n"; }
}
else { echo "ERROR\n"; }

?>