#!/usr/bin/php
<?php

if ($argc == 2)
{
	$stripped = str_replace(" ", "", $argv[1]);
	$val1 = intval($stripped, 10);
	if ($val1 == 0)
	{
		echo "Syntax Error\n";
		exit();
	}
	$op = substr($stripped, strlen((string)$val1), 1);
	if (strpos("+-*/%", $op[0]) === false)
	{
		echo "Syntax Error\n";
		exit();
	}
	$str2 = substr($stripped, strlen((string)$val1) + 1);
	if (!is_numeric($str2))
	{
		echo "Syntax Error\n";
		exit();
	}
	$val2 = intval($str2);
	if ($op[0] == '+')
		echo $val1 + $val2;
	if ($op[0] == '-')
		echo $val1 - $val2;
	if ($op[0] == '*')
		echo $val1 * $val2;
	if ($op[0] == '/')
		echo $val1 / $val2;
	if ($op[0] == '%')
		echo $val1 % $val2;
	echo "\n";
}
else
{
	echo "Incorrect Parameters\n";
}

?>
