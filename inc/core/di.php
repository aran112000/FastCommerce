<?
/**
 * Class di
 */
final class di {

	/**
	 * Construct
	 *
	 * Used within DI to define any defaults
	 */
	public function __construct() {
		$this->add('asset', function() {
			$am = new asset_manager();
			$am->di = $this;

			return $am;
		});
	}

	/**
	 * @param $name
	 * @return mixed
	 * @throws Exception
	 */
	public function __get($name) {
		if (isset(di_container::$registrants[$name])) {
			$val = di_container::$registrants[$name];
			if (gettype($val) == 'object' && is_callable($val)) {
				// Functions stored within DI aren't executed unless required to save on memory and once executed once the resulting value is stored in it's place
				$val = $val();
				di_container::$registrants[$name] = $val;
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
		return isset(di_container::$registrants[$name]);
	}

	/**
	 * @param $name
	 */
	public function __unset($name) {
		if (isset($this->$name)) {
			unset(di_container::$registrants[$name]);
		}
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function add($name, $value) {
		di_container::$registrants[$name] = $value;
	}
}

/**
 * Class di_container
 * 	Used for storage of items within di() to ensure they persist accross classes
 */
final class di_container {
	/**
	 * @var array
	 */
	public static $registrants = array();
}