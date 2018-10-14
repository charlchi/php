public class Weapons
{

	private $_name;
	private $_alive;
	private $_x;
	private $_y;
	private $_name;
	private $_width;
	private $_height;
	private $_HP; // health
	private $_SP; // shield
	private $_EP; // engine power
	private $_maxspeed;
	private $_speed;
	private $_color; // faction
	private $_handling;
	private $_weapons = ;

	private $_speed;
	public function __construct($params)
	{
		$this->_name = $params['name'];
		$this->_x = $params['x'];
		$this->_y = $params['y'];
		$this->_name = $params['name'];
		$this->_width = $params['width'];
		$this->_height = $params['height'];
		$this->_HP = $params['HP'];
		$this->_SP = $params['SP'];
		$this->_EP = $params['EP'];
		$this->_maxspeed = $params['maxspeed'];
		$this->_color = $params['color'];
		$this->_handling = $params['handling'];
		$this->_weapons = $params['weapons'];
		$this->_speed = $this->_maxspeed;
		$this->_alive = 1;
	}

	public function move($game, $dir)
	{
		if ($dir == 'up')
			$this->_y -= $this->_speed;
		else if ($dir == 'down')
			$this->_y += $this->_speed;
		else if ($dir == 'left')
			$this->_x -= $this->_speed;
		else if ($dir == 'right')
			$this->_x += $this->_speed;
	}
}