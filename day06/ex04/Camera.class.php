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
		$str =  "Camera( \n".
				"+ Origine: ".$this->_origin."\n".
				"+ tT:\n".$this->_tT."\n".
				"+ tR:\n".$this->_tR."\n".
				"+ tR->mult( tT ):\n".$this->_tR->mult($this->_tT)."\n".
				"+ Proj:\n".$this->_proj."\n)";
		return ($str);
	}
	
	public static function doc()
	{
		echo PHP_EOL;
		$doctxt = file("Camera.doc.txt");
		foreach ($doctxt as $line)
			echo $line;
		echo PHP_EOL;
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
