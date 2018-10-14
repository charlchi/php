<?php

class UnholyFactory
{
	
	private $parentname = "Fighter";
	private $recruits = array();
	
	public function absorb($rec)
	{
		if (get_parent_class($rec) != $this->parentname)
		{
			echo "(Factory can't absorb this, it's not a fighter)" . PHP_EOL;
		}
		else if (array_key_exists($rec->type, $this->recruits))
		{
			echo "(Factory already absorbed a fighter of type " . $rec->type . ")" . PHP_EOL;
		}
		else
		{
			$this->recruits[$rec->type] = $rec;
			echo "(Factory absorbed a fighter of type " . $rec->type . ")" . PHP_EOL;
		}
	}

	public function fabricate($rf)
	{
		if (array_key_exists($rf, $this->recruits) == false)
		{
			print("(Factory hasn't absorbed any fighter of type " . $rf . ")" . PHP_EOL);
			return null;
		}
		print("(Factory fabricates a fighter of type " . $rf . ")" . PHP_EOL);
		return (clone $this->recruits[$rf]);
	}
}

?>