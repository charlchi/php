#!/usr/bin/php
<?php

if ($argc > 1)
{
	array_shift($argv);
	$out = array();
	foreach ($argv as $arg)
	{
		$array = array_filter(explode(' ', $arg));
		foreach ($array as $item)
		{
			array_push($out, $item);
		}
	}
	sort($array, SORT_STRING);
	foreach ($out as $str)
	{
		echo "$str\n";
	}
}

?>
