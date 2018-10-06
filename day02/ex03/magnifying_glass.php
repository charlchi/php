#!/usr/bin/php
<?php

// Mardi 12 Novembre 2013 12:02:21

if ($argc == 2)
{
	if (file_exists($argv[1]) === false)
		exit();
	$file = file_get_contents($argv[1]);
	$i = 0;
	while ($file[$i])
	{
		if ($file[$i] == '"' && strcmp(substr($file, $i - 6, 6), "title=") == 0)
		{
			$i++;
			while ($file[$i] != '"')
			{
				$file[$i] = strtoupper($file[$i]);
				$i++;
			}
		}
		$i++;
	}
	$i = 0;
	while ($file[$i])
	{
		if (strcmp(substr($file, $i, 2), "<a") == 0)
		{
			while ($file[$i] != '>')
				$i++;
			$i++;
			while (strcmp(substr($file, $i, 4), "</a>") != 0)
			{
				if ($file[$i] == '<')
				{
					$i++;
					while ($file[$i] != '>')
						$i++;
				}
				$file[$i] = strtoupper($file[$i]);
				$i++;
			}
		}
		$i++;
	}
	echo "$file\n";
}

