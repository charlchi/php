<?php

require_once '../ex01/Vertex.class.php';

class Vector
{
	private $_x;
	private $_y;
	private $_z;
	private $_w;
	private $_color;
	static $verbose = false;

	public function __construct($param)
	{
		if (isset($param['dest']))
		{
			$orig = isset($param['orig']) ? $param['orig'] : $orig = new Vertex(array('x' => 0, 'y' => 0, 'z' => 0));
			$dest = $param['dest'];
			$this->_x = $dest->getX() - $orig->getX();
			$this->_y = $dest->getY() - $orig->getY();
			$this->_z = $dest->getZ() - $orig->getZ();
			$this->_w = 0;
		}
		if (Self::$verbose)
		{
			$format = $this." constructed\n";
			printf($format, $this->_x, $this->_y, $this->_z, $this->_w);
		}
	}

	function __destruct()
	{
		if (Self::$verbose)
		{
			$format = $this." destructed\n";
			printf($format, $this->_x, $this->_y, $this->_z, $this->_w);
		}
	}

	function __toString()
	{
		$format = "Vector( x:%0.2f, y:%0.2f, z:%0.2f, w:%0.2f )";
		return (sprintf($format, $this->_x, $this->_y, $this->_z, $this->_w));
	}

	public static function doc()
	{
		echo PHP_EOL;
		$doctxt = file("Vector.doc.txt");
		foreach ($doctxt as $line)
			echo $line;
	}

	public function magnitude()
	{
		return (float)sqrt($this->dotProduct($this));
	}

	public function normalize()
	{
		$mag = $this->magnitude();
		$v = new Vertex(array(
			'x' => $this->_x / $mag,
			'y' => $this->_y / $mag,
			'z' => $this->_z / $mag
		));
		return new Vector(array('dest' => $v));
	}

	public function add(Vector $rhs)
	{
		$v = new Vertex(array(
			'x' => $this->_x + $rhs->_x,
			'y' => $this->_y + $rhs->_y,
			'z' => $this->_z + $rhs->_z
		));
		return new Vector(array('dest' => $v));
	}
	public function sub(Vector $rhs)
	{
		$v = new Vertex(array(
			'x' => $this->_x - $rhs->_x,
			'y' => $this->_y - $rhs->_y,
			'z' => $this->_z - $rhs->_z
		));
		return new Vector(array('dest' => $v));
	}

	public function opposite()
	{
		$v = new Vertex(array(
			'x' => -$this->_x,
			'y' => -$this->_y,
			'z' => -$this->_z
		));
		return new Vector(array('dest' => $v));
	}

	public function scalarProduct($k)
	{
		$v = new Vertex(array(
			'x' => $this->_x * $k,
			'y' => $this->_y * $k,
			'z' => $this->_z * $k
		));
		return new Vector(array('dest' => $v));
	}

	public function dotProduct(Vector $rhs)
	{
		return (float)(($this->_x * $rhs->_x) + ($this->_y * $rhs->_y) + ($this->_z * $rhs->_z));
	}

	public function crossProduct(Vector $rhs)
	{
		$v = new Vertex(array(
			'x' => $this->_y * $rhs->getZ() - $this->_z * $rhs->getY(),
			'y' => $this->_z * $rhs->getX() - $this->_x * $rhs->getZ(),
			'z' => $this->_x * $rhs->getY() - $this->_y * $rhs->getX()
		));
		return new Vector(array('dest' => $v));
	}

	public function cos(Vector $rhs)
	{
		return ($this->dotProduct($rhs) / ($this->magnitude() * $rhs->magnitude()));
	}

	public function getX()
	{
		return $this->_x;
	}
	public function getY()
	{
		return $this->_y;
	}
	public function getZ()
	{
		return $this->_z;
	}
	public function getW()
	{
		return $this->_w;
	}
}
?>
