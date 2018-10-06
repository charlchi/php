#!/usr/bin/php
<?php

// Mardi 12 Novembre 2013 12:02:21

if ($argc == 2)
{
	setlocale(LC_ALL, "fr_FR");
	$d = strptime($argv[1], "%A %e %B %Y %H:%M:%S");
	if ($d === FALSE)
	{
		echo "Wrong Format\n";
		exit();
	}
	$timestamp = mktime(
		$d[ "tm_hour" ],
		$d["tm_min"],
		$d["tm_sec"],
		$d["tm_mon"],
		$d["tm_mday"],
		$d["tm_year"]+1900
	);
	if ($timestamp === false)
	{
		echo "Wrong Format\n";
		exit();	
	}
	echo "$timestamp";
	echo "\n";
}
