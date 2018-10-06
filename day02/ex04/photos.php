#!/usr/bin/php
<?php

function getHtml($url)
{
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$html = curl_exec($curl);
	curl_close($curl);
	return ($html);
}

if ($argc == 2)
{
	$base = substr($argv[1], 8);
	$file = getHtml($argv[1]);
	$images = array();
	$i = 0;
	while ($file[$i] != '')
	{
		if ($file[$i] == 'g')
		{
			$test = substr($file, $i - 3, 10);
			if (strcmp(substr($file, $i - 3, 4), "<img") == 0)
			{
				echo "found img\n";
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
		}
		$i++;
	}
	
	foreach ($images as $imagesrc)
	{
		$fp = $base.$imagesrc;
		$i = 0;
		while ($fp[$i] != '')
			$i++;
		while ($fp[$i] != '/')
			$i--;
		$fp = substr($fp, 0, $i);
		if (!file_exists($fp))
			mkdir($fp, 0777, true);
		$img = getHtml($argv[1].$imagesrc);
		file_put_contents($base.$imagesrc, $img);
	}
}

