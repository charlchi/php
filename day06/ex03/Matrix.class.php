<?php

require_once '../ex01/Vertex.class.php';
require_once '../ex02/Vector.class.php';

class Matrix
{
	static $verbose = false;
	
	const IDENTITY = 'identity';
	const SCALE = 'scale';
	const RX = 'rotation_x';
	const RY = 'rotation_y';
	const RZ = 'rotation_z';
	const TRANSLATION = 'translation';
	const PROJECTION  = 'projection';

	public $_mat = array();
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
		$presets = array('identity', 'scale', 'rotation_x', 'rotation_y', 'rotation_z', 'translation', 'projection');
		foreach ($vars as $k)
			$this->{'_'.$k} = array_key_exists($k, $param) ? $param[$k] : NULL;
		$this->identity();
		$this->{$this->_preset}();
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
		return (vsprintf($format, $this->_mat));
	}
	
	public static function doc()
	{
		echo PHP_EOL;
		$doctxt = file("Matrix.doc.txt");
		foreach ($doctxt as $line)
			echo $line;
	}

	public function mult($rhs)
	{
		$mat = new Matrix(array('preset' => self::IDENTITY));
		for ($j = 0; $j < 4; $j++) {
			$j4 = $j * 4;
			$mat->_mat[$j4 + 0] = $this->_mat[$j4] * $rhs->_mat[0] + $this->_mat[$j4 + 1] * $rhs->_mat[0 + 4] + $this->_mat[$j4 + 2] * $rhs->_mat[0 + 8] + $this->_mat[$j4 + 3] * $rhs->_mat[0 + 12];
			$mat->_mat[$j4 + 1] = $this->_mat[$j4] * $rhs->_mat[1] + $this->_mat[$j4 + 1] * $rhs->_mat[1 + 4] + $this->_mat[$j4 + 2] * $rhs->_mat[1 + 8] + $this->_mat[$j4 + 3] * $rhs->_mat[1 + 12];
			$mat->_mat[$j4 + 2] = $this->_mat[$j4] * $rhs->_mat[2] + $this->_mat[$j4 + 1] * $rhs->_mat[2 + 4] + $this->_mat[$j4 + 2] * $rhs->_mat[2 + 8] + $this->_mat[$j4 + 3] * $rhs->_mat[2 + 12];
			$mat->_mat[$j4 + 3] = $this->_mat[$j4] * $rhs->_mat[3] + $this->_mat[$j4 + 1] * $rhs->_mat[3 + 4] + $this->_mat[$j4 + 2] * $rhs->_mat[3 + 8] + $this->_mat[$j4 + 3] * $rhs->_mat[3 + 12];
		}
		return $mat;
	}
	
	public function transformVertex($vtx)
	{
		$v = new Vertex(array(
			'x' => ($vtx->getX() * $this->_mat[0]) + ($vtx->getY() * $this->_mat[1]) + ($vtx->getZ() * $this->_mat[2]) + ($vtx->getW() * $this->_mat[3]),
			'y' => ($vtx->getX() * $this->_mat[4]) + ($vtx->getY() * $this->_mat[5]) + ($vtx->getZ() * $this->_mat[6]) + ($vtx->getW() * $this->_mat[7]),
			'z' => ($vtx->getX() * $this->_mat[8]) + ($vtx->getY() * $this->_mat[9]) + ($vtx->getZ() * $this->_mat[10]) + ($vtx->getW() * $this->_mat[11]),
			'w' => ($vtx->getX() * $this->_mat[11]) + ($vtx->getY() * $this->_mat[13]) + ($vtx->getZ() * $this->_mat[14]) + ($vtx->getW() * $this->_mat[15]),
			'color' => $vtx->getColor()
		));
		return $v;
	}

	private function identity()
	{
		for ($i = 0; $i < 16; $i++)
			$this->_mat[$i] = $i % 5 == 0 ? 1.0 : 0.0;	
	}

	private function scale()
	{
		$this->_mat[0] = $this->_scale;
		$this->_mat[5] = $this->_scale;
		$this->_mat[10] = $this->_scale;
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
