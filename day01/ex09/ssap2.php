#!/usr/bin/php
<?php

if ($argc > 1)
{
	array_shift($argv);
	$out1 = array();
	$out2 = array();
	$out3 = array();
	foreach ($argv as $arg)
	{
		$array = array_filter(explode(' ', $arg));
		foreach ($array as $item)
		{
			if (ctype_upper($item[0]))
				array_push($out1, $item);
			elseif (ctype_lower($item[0]))
				array_push($out2, $item);
			else
				array_push($out3, $item);
		}
	}
	sort($out1, SORT_STRING);
	sort($out2, SORT_STRING);
	sort($out3, SORT_STRING);
	foreach ($out1 as $str)
		echo "$str\n";
	foreach ($out2 as $str)
		echo "$str\n";
	foreach ($out3 as $str)
		echo "$str\n";
}

?>
