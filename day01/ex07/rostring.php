#!/usr/bin/php
<?php

if ($argc > 1)
{
	array_shift($argv);
	$str1 = array_shift($argv);
	$array = array_filter(explode(' ', $str1));
	$first = array_shift($array);
	foreach ($array as $item)
		echo "$item ";
	echo "$first\n";
}

?>
