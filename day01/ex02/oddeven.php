#!/usr/bin/php
<?php

echo "Enter a number: ";
$input = rtrim(fgets(STDIN));
while ($input)
{
	if (is_numeric($input))
	{
		$val = (int)$input;
		if ($val % 2 == 0)
		{
			echo "The number $val is even\n";
		}
		else
		{
			echo "The number $val is odd\n";
		}
	}
	else
	{
		echo "'$input' is not a number\n";
	}
	echo "Enter a number: ";
	$input = rtrim(fgets(STDIN));
}
echo "^D\n";
?>
