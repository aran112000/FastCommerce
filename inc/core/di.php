<?
/**
 * Class di
 */
final class di {

	/**
	 * @var array
	 */
	public $always_in_di = array(
		'db',
		'asset' => 'asset_manager',
		'get',
		'run',
	);

	/**
	 * @var array
	 *
	 * Used for storage of items within di() to ensure they persist across classes
	 */
	private $registrants = array();

	/**
	 * Construct
	 *
	 * Used within DI to define any defaults
	 */
	public function __construct() {
		if (!empty($this->always_in_di)) {
			foreach ($this->always_in_di as $register_name => $class_name) {
				$register_name = (!is_numeric($register_name) ? $register_name : $class_name);
				if (!isset($this->$register_name)) {
					$this->add($register_name, function() use ($class_name) {
						$class = new $class_name($this);
						$class->di = $this;

						return $class;
					});
				}
			}
		}
	}

	/**
	 * @param $name
	 * @return mixed
	 * @throws Exception
	 */
	public function __get($name) {
		if (isset($this->registrants[$name])) {
			$val = $this->registrants[$name];
			if (gettype($val) == 'object' && is_callable($val)) {
				// Functions stored within DI aren't executed unless required to save on memory and once executed once the resulting value is stored in it's place
				$val = $val();
				$this->registrants[$name] = $val;
			}
			return $val;
		}

		// If $name is a module or object then we will auto create it
		if (is_readable(root . '/inc/module/' . $name . '/' . $name . '.php') || is_readable(root . '/inc/object/' . $name . '.php') || is_readable(root . '/inc/core/' . $name . '.php')) {
			$val = new $name($this);
			$this->add($name, $val);

			return $val;
		}

		throw new Exception($name . ' not set, please check isset() before attempting to fetch');
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function __set($name, $value) {
		$this->add($name, $value);
	}

	/**
	 * @param $name
	 * @return bool
	 */
	public function __isset($name) {
		return isset($this->registrants[$name]);
	}

	/**
	 * @param $name
	 */
	public function __unset($name) {
		if (isset($this->$name)) {
			unset($this->registrants[$name]);
		}
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function add($name, $value) {
		$this->registrants[$name] = $value;
	}
}