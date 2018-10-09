<?php

require_once 'Color.class.php';

class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w;
	private $_color;
	static $verbose = false;

	public function __construct($param)
	{
		if (isset($param['x']) && isset($param['y']) && isset($param['z']))
		{
			$this->_x = intval($param['z']);
			$this->_y = intval($param['y']);
			$this->_z = intval($param['z']);
		}
		$this->_w = isset($param['w']) ? $param['w'] : 1; 
		$this->_color = isset($param['color']) ? $param['color'] : new Color(array('rgb' => 0xFFFFFF));
		if (Self::$verbose)
		{
			$format = "Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, ".$this->_color." ) constructed\n";
			printf($format, $this->_x, $this->_y, $this->_z, $this->_w);
		}
	}
	function __destruct()
	{
		if (Self::$verbose)
		{
			$format = "Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, ".$this->_color." ) destructed\n";
			printf($format, $this->_x, $this->_y, $this->_z, $this->_w);
		}
	}

	function __toString()
	{
		if (Self::$verbose)
		{
			$format = "Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, ".$this->_color." ) )";
			return (sprintf($format, $this->_x, $this->_y, $this->_z, $this->_w));
		}
		$format = "Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )";
		return (sprintf($format, $this->_x, $this->_y, $this->_z, $this->_w));
	}
	public static function doc()
	{
		echo "\n";
		$doctxt = file("Vertex.doc.txt");
		foreach ($doctxt as $line)
			echo $line.'\n';
		echo "\n";
	}
	public function getX()
	{
		return $this->_x;
	}
	public function setX($x)
	{
		$this->_x = $x;
	}
	public function getY()
	{
		return $this->_y;
	}
	public function setY($y)
	{
		$this->_y = $y;
	}
	public function getZ()
	{
		return $this->_z;
	}
	public function setZ($z)
	{
		$this->_z = $z;
	}
	public function getW()
	{
		return $this->_w;
	}
	public function setW($w)
	{
		$this->_w = $w;
	}
	public function getColor()
	{
		return $this->_color;
	}
	public function setColor($color)
	{
		$this->_color = $color;
	}
}
?>