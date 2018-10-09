<?php
class Color
{
	public $red;
	public $green;
	public $blue;

	static $verbose = false;

	public function __construct($color)
	{
		if (isset($color['red']) && isset($color['green']) && isset($color['blue']))
		{
			$this->red = intval($color['red']);
			$this->green = intval($color['green']);
			$this->blue = intval($color['blue']);
		} else if (isset($color['rgb'])) {
			$rgb = intval($color["rgb"]);
			$this->red   = ($rgb >> 16) & 255;
			$this->green = ($rgb >> 8)  & 255;
			$this->blue   = $rgb        & 255;
		}
		if (Self::$verbose)
		{
			$format = "Color( red: %3d, green: %3d, blue: %3d ) constructed.\n";
			printf($format, $this->red, $this->green, $this->blue);
		}
	}
	function __destruct()
	{
		if (Self::$verbose)
		{
			$format = "Color( red: %3d, green: %3d, blue: %3d ) destructed.\n";
			printf($format, $this->red, $this->green, $this->blue);
		}
	}
	
	function __toString()
	{
		$format = "Color( red: %3d, green: %3d, blue: %3d )";
		return (sprintf($format, $this->red, $this->green, $this->blue));
	}
	public static function doc()
	{
		echo "\n";
		$doctxt = file("Color.doc.txt");
		foreach ($doctxt as $line)
			echo $line.'\n';
		echo "\n";
	}
	public function add($Color)
	{
		$retarr = array(
			'red' => $this->red + $Color->red,
			'green' => $this->green + $Color->green,
			'blue' => $this->blue + $Color->blue
		);
		return (new Color($retarr));
	}

	public function sub($Color)
	{
		$retarr = array(
			'red' => $this->red - $Color->red,
			'green' => $this->green - $Color->green,
			'blue' => $this->blue - $Color->blue
		);
		return (new Color($retarr));
	}

	public function mult($fact)
	{
		$retarr = array(
			'red' => $this->red * $fact,
			'green' => $this->green * $fact,
			'blue' => $this->blue * $fact
		);
		return (new Color($retarr));
	}
}	
?>
