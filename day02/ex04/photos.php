#!/usr/bin/php
<?php

if ($argc == 2)
{
	$base = substr($argv[1], 8);
	$curl = curl_init($argv[1]);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$file = curl_exec($curl);
	if (file_exists($argv[1]) === false)
		exit();
	$file = file_get_contents($argv[1]);
	$images = array();
	$i = 0;
	while ($file[$i])
	{
		if ($file[$i] == 'g' && strcmp(substr($file, $i - 3, 5), "<img ") == 0)
		{
			$i += 2;
			$s = 0;
			while ($file[$i] != ">")
			{
				if (strcmp(substr($file, $i - 5, 5), "src=\"") == 0)
				{
					while ($file[$i] != '"')
					{
						$i++;
						$s++;
					}
					array_push($images, substr($file, $i - $s, $s));
				}
				$i++;
			}
		}
		$i++;
	}
	if (!file_exists($base))
		mkdir($base);
	foreach ($images as $imagesrc) {
		echo "$imagesrc\n";
		$curl = curl_init($argv[1]."/".imagesrc);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$img = curl_exec($curl);
		file_put_contents($base."/".imagesrc, $img);
	}
}

