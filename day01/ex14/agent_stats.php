#!/usr/bin/php
<?php

// test params
if ($argc != 2)
	exit();
$test = 0;
if (strcmp($argv[1], "average") == 0)
	$test = 1;
elseif (strcmp($argv[1], "average_user") == 0)
	$test = 2;
elseif (strcmp($argv[1], "variance_moulinette") == 0)
	$test = 3;
else
	exit();

// filter out header
$input = fgets(STDIN);

// read file
$file = array();
$input = fgets(STDIN);
while ($input)
{
	array_push($file, $input);
	$input = fgets(STDIN);
}


if ($test == 1) // average
{
	$i = 0.0;
	$sum = 0.0;
	foreach ($file as $line)
	{
		$arr = array_filter(explode(";", $line));
		if ((count($arr) == 4) != 0)
		{
			$i += 1.0;
			$sum += floatval($arr[1]);
		}
	}
	echo $sum / $i;
	echo "\n";
}
elseif ($test == 2) // average_user
{
	$names = array();
	$counts = array();
	foreach ($file as $line)
	{
		$arr = array_filter(explode(";", $line));
		if ((count($arr) == 4) && !array_key_exists($arr[0], $names))
		{
			$names[$arr[0]] = floatval($arr[1]);
			$counts[$arr[0]] = 1;
		}
		elseif (count($arr) == 4)
		{
			$names[$arr[0]] += floatval($arr[1]);
			$counts[$arr[0]]++;	
		}
	}
	ksort($names);
	ksort($counts);
	foreach ($names as $key => $value)
	{
		echo "$key:";
		echo $value / $counts[$key];
		echo "\n";
	}
}

?>
