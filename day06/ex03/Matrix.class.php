<?php

require_once 'Vertex.class.php';
require_once 'Vector.class.php';
require_once 'Matrix.class.php';
require_once 'Vertex.class.php';

class Matrix
{
	static $verbose = false;
	
	const IDENTITY = 1;
	const SCALE = 2;
	const RX = 3;
	const RY = 4;
	const RZ = 5;
	const TRANSLATION = 6;
	const PROJECTION = 7;
	
	private $_mat = array();
	private $_preset;
	private $_scale;
	private $_angle;
	private $_vtc;
	private $_fov;
	private $_ratio;
	private $_near;
	private $_far;


	public function __construct($param)
	{
		$vars = array('preset', 'scale', 'angle', 'vtc', 'fov', 'ratio', 'near', 'far');
		foreach ($vars as $k)
			${'_'.$k} = in_array($k, $param) ? $param[$k] : NULL;
		for ($i = 0; $i < 16; $i++)
			$this->_mat[$i] = $i % 5 ? 0.0 : 1.0;
		if (self::$verbose)
		{
			if ($this->_preset == self::IDENTITY)
				echo "Matrix " . $this->_preset . " instance constructed\n";
			else
				echo "Matrix " . $this->_preset . " preset instance constructed\n";
		}
	}

	function __destruct()
	{
		if (self::$verbose)
			printf("Matrix instance destructed\n");
	}

	function __toString()
	{
		$format = "M | vtcX | vtcY | vtcZ | vtxO" . PHP_EOL;
		$format .= "-----------------------------" . PHP_EOL;
		$format .= "x | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL;
		$format .= "y | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL;
		$format .= "z | %0.2f | %0.2f | %0.2f | %0.2f" . PHP_EOL;
		$format .= "w | %0.2f | %0.2f | %0.2f | %0.2f";
		return (sprintf($format, $this->_mat));
	}
	
	public static function doc()
	{
		echo "\n";
		$doctxt = file("Matrix.doc.txt");
		foreach ($doctxt as $line)
			echo $line.'\n';
		echo "\n";
	}

	public function mult($rhs)
	{
		$mat = new Matrix();
		$m1 = $this->_mat;
		$m2 = $rhs->_mat;
		for ($i = 0; $i < 4; $i++)
			for ($j = 0; $j < 4; $j++)
				for ($p = 0; $p < 4; $p++)
					$mat->_mat[$i + $j * 4] += $m1[$i + $p * 4] * $m2[$p + $j * 4];
		return $mat;
	}
	
	public function transformVertex($vtx)
	{
		$v = new Vertex(array(
			'x' = ($vtx->getX() * $this->_mat[0]) + ($vtx->getY() * $this->_mat[1]) + ($vtx->getZ() * $this->_mat[2]) + ($vtx->getW() * $this->_mat[3]),
			'y' = ($vtx->getX() * $this->_mat[4]) + ($vtx->getY() * $this->_mat[5]) + ($vtx->getZ() * $this->_mat[6]) + ($vtx->getW() * $this->_mat[7]),
			'z' = ($vtx->getX() * $this->_mat[8]) + ($vtx->getY() * $this->_mat[9]) + ($vtx->getZ() * $this->_mat[10]) + ($vtx->getW() * $this->_mat[11]),
			'w' = ($vtx->getX() * $this->_mat[11]) + ($vtx->getY() * $this->_mat[13]) + ($vtx->getZ() * $this->_mat[14]) + ($vtx->getW() * $this->_mat[15])
			'color' = $vtx->getColor();
		));
		return $v;
	}

	private function identity($scale)
	{
		$this->_mat[0] = $scale;
		$this->_mat[5] = $scale;
		$this->_mat[10] = $scale;
		$this->_mat[15] = 1.0;
	}

	private function translation()
	{
		$this->_mat[3] = $this->_vtc->getX();
		$this->_mat[7] = $this->_vtc->getY();
		$this->_mat[11] = $this->_vtc->getZ();
	}

	private function rotation_x()
	{
		$this->_mat[0] = 1.0;
		$this->_mat[5] = cos($this->_angle);
		$this->_mat[6] = -sin($this->_angle);
		$this->_mat[9] = sin($this->_angle);
		$this->_mat[10] = cos($this->_angle);
	}

	private function rotation_y()
	{
		$this->_mat[0] = cos($this->_angle);
		$this->_mat[2] = sin($this->_angle);
		$this->_mat[5] = 1.0;
		$this->_mat[8] = -sin($this->_angle);
		$this->_mat[10] = cos($this->_angle);
	}

	private function rotation_z()
	{
		$this->_mat[0] = cos($this->_angle);
		$this->_mat[1] = -sin($this->_angle);
		$this->_mat[4] = sin($this->_angle);
		$this->_mat[5] = cos($this->_angle);
		$this->_mat[10] = 1.0;
	}

	private function projection()
	{
		$this->_mat[5] = 1 / tan(0.5 * deg2rad($this->_fov));
		$this->_mat[0] = $this->_mat[5] / $this->_ratio;
		$this->_mat[10] = -1 * (-$this->_near - $this->_far) / ($this->_near - $this->_far);
		$this->_mat[14] = -1;
		$this->_mat[11] = (2 * $this->_near * $this->_far) / ($this->_near - $this->_far);
		$this->_mat[15] = 1.0;
	}
}
?>