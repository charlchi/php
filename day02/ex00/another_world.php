#!/usr/bin/php
<?php

if ($argc > 1)
{
	$str = array_filter(explode(" ", str_replace("\t", " ", $argv[1])));
	foreach ($str as $item)
		echo "$item ";
	echo "\n";
}

?>
