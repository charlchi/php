#!/usr/bin/php
<?php

if ($argc > 1)
{
	array_shift($argv);
	foreach ($argv as $arg)
	{
		echo "$arg\n";	
	}
}

?>
