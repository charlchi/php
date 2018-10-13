<?php

require_once '../ex01/Vertex.class.php';
require_once '../ex02/Vector.class.php';
require_once '../ex03/Matrix.class.php';

class Camera
{
	static $verbose = false;

	private $_origin;
	private $_orientation;
	private $_hw;
	private $_hh;
	private $_ratio;
	private $_fov;
	private $_near;
	private $_far;
	private $_tT;
	private $_tR;
	private $_proj;

	public function __construct($param)
	{
		$this->_origin = $param['origin'];
		$this->_orientation = $param['orientation'];
		$this->_hw = floatval($param['width']) / 2.0;
		$this->_hh = floatval($param['height']) / 2.0;
		$this->_ratio = $this->_hw / $this->_hh;
		$this->_fov = $param['fov'];
		$this->_near = $param['near'];
		$this->_far = $param['far'];
		$this->_tT = new Matrix(array(
			'preset' => Matrix::TRANSLATION,
			'vtc' => $this->_origin->opposite()
		));
		$this->_tR = $this->diagsym($this->_orientation);
		$this->_proj = new Matrix(array(
			'preset' => Matrix::PROJECTION,
			'ratio' => $this->_ratio,
			'fov' => $this->_fov,
			'near' => $this->_near,
			'far' => $this->_far
		));
		if (self::$verbose)
			echo ("Camera instance constructed\n");
	}

	public function __destruct()
	{
		if (self::$verbose)
			echo ("Camera instance destructed\n");
	}

	public function diagsym($mat)
	{
		$new = array();
		for ($i = 0; $i < 4; $i++)
			for ($j = 0; $j < 4; $j++)
				$new[(3 - $i) + (3 - $j) * 4] = $mat->_mat[$i + $j * 4];
		$mat->_mat = $new;
		return $mat;
	}

	public function __toString()
	{
		$str =  "Camera( " . PHP_EOL .
				"+ Origine: ".$this->_origin . PHP_EOL .
				"+ tT:" . PHP_EOL .".$this->_tT" . PHP_EOL .
				"+ tR:" . PHP_EOL .".$this->_tR" . PHP_EOL .
				"+ tR->mult( tT ):" . PHP_EOL . $this->_tR->mult($this->_tT) . PHP_EOL .
				"+ Proj:" . PHP_EOL . $this->_proj . PHP_EOL;
		return ($str);
	}
	
	public static function doc()
	{
		echo PHP_EOL;
		$doctxt = file("Camera.doc.txt");
		foreach ($doctxt as $line)
			echo $line;
	}

	public function watchVertex($worldVertex)
	{
		$tr = $this->_tr->transformVertex($worldVertex);
		$v = $this->_proj->transformVertex($tr);
		$v->setX($this->_width / 2.0 + $v->getX());
		$v->setY($this->_height / 2.0 + $v->getY());
		return ($v);
	}
}
?>
