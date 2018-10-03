#!/usr/bin/php
<?php

// Mardi 12 Novembre 2013 12:02:21

if ($argc == 2)
{
	setlocale(LC_ALL, "fr-FR");
	echo "$argv[1]\n";
	$d = strptime($argv[1], "%A %e %M %Y %H:%i:%s");
	if ($d === FALSE)
		exit();
	echo (mktime((int)d["tm_hour"], (int)d["tm_min"], (int)d["tm_sec"], (int)d["tm_mon"], (int)d["tm_mday"], (int)d["tm_year"]));
	echo "\n";
}