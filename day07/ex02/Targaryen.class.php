<?php

class Targaryen
{
	public function getBurned()
	{
		return ($this->resistsFire() ?
			"emerges naked but unharmed" : "burns alive");
	}

	public function resistsFire()
	{
		return false;
	}

}

?>