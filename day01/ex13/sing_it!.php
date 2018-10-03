#!/usr/bin/php
<?php
if ($argc == 2)
{
	if (strcmp($argv[1], "Why this demo ?") == 0)
	{
		echo "To avoid people noticing this while going over the subject briefly\n";
	}
	elseif (strcmp($argv[1], "Why this song ?") == 0)
	{
		echo "Because we're all children inside\n";
	}
	elseif (strcmp($argv[1], "really ?") == 0)
	{
		if (rand(0, 1000) < 500)
		{
			echo "No it's because it's april's fool\n";
		}
		else
		{
			echo "Yeah we really are all children inside\n";
		}
	}
}
?>
