#!/usr/bin/php
<?php

if ($argc == 2)
{
	$array = array_filter(explode(' ', $argv[1]));
	foreach ($array as $arg)
	{
		echo "$arg ";	
	}
	echo "\n";
}

?>
