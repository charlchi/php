<?php

class NightsWatch implements IFighter
{
	
	private $recruits = array();
	
	public function recruit($rec)
	{
		array_push($this->recruits, $rec);
	}

	function fight()
	{
		foreach ($this->recruits as $rec)
			if (method_exists(get_class($rec), 'fight'))
				$rec->fight();
	}

}

?>