<?php

class Tyrion
{
	public function sleepWith($classtype)
	{
		if ($classtype instanceof Jaime)
			echo "Not event if I'm drunk !" . PHP_EOL;
		else if ($classtype instanceof Sansa)
			echo "Let's do this." . PHP_EOL;
		else if ($classtype instanceof Cersei)
			echo "Not event if I'm drunk !" . PHP_EOL;
	}
}

?>