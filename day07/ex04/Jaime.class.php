<?php

class Jaime
{
	public function sleepWith($classtype)
	{
		if ($classtype instanceof Tyrion)
			echo "Not event if I'm drunk !" . PHP_EOL;
		else if ($classtype instanceof Sansa)
			echo "Let's do this." . PHP_EOL;
		else if ($classtype instanceof Cersei)
			echo "With pleasure, but only in a tower in Winterfell, then." . PHP_EOL;
	}
}

?>