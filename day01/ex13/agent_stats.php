#!/usr/bin/php
<?php

if ($argc > 2)
{
	array_shift($argv);
	$search = $argv[0];
	array_shift($argv);
	$data = array();
	foreach ($argv as $str)
	{
		$keyval = explode(":", $str);
		$data[$keyval[0]] = $keyval[1];
	}
	if (array_key_exists($search, $data))
	{
		echo "$data[$search]\n";
	}
}

?>