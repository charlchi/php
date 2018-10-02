#!/usr/bin/php
<?php

if ($argc == 4)
{
	$arg1 = (int)rtrim($argv[1]);
	$arg2 = rtrim($argv[2]);
	$arg3 = (int)rtrim($argv[3]);
	if ($arg2[0] == '+')
		echo $arg1 + $arg3;
	if ($arg2[0] == '-')
		echo $arg1 - $arg3;
	if ($arg2[0] == '*')
		echo $arg1 * $arg3;
	if ($arg2[0] == '/')
		echo $arg1 / $arg3;
	if ($arg2[0] == '%')
		echo $arg1 % $arg3;
	echo "\n";
}
else
{
	echo "Incorrect Parameters\n";
}

?>
