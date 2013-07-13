<?php
/**
 * Class di
 */
final class di {

	/**
	 * @var array
	 */
	public $always_in_di = array(
		'db',
		'get',
		'run',
		'ajaxify',
		'asset' => 'asset_manager',
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
					$this->load_class($class_name, $register_name);
				}
			}
		}
	}

	/**
	 * @param        $class_name
	 * @param string $register_class_name
	 * @param array  $constructor_arguments
	 * @return mixed
	 */
	public function load_class($class_name, $register_class_name = '', $constructor_arguments = array()) {
		if (isset($this->$class_name)) {
			return $this->$class_name;
		}
		if (empty($constructor_arguments)) {
			$class = new $class_name();
		} else {
			$reflection_class = new ReflectionClass($class_name);
			$class = $reflection_class->newInstanceArgs($constructor_arguments);
		}
		$class->set_di($this);
		$this->set((!empty($register_class_name) ? $register_class_name : $class_name), $class);

		return $class;
	}

	/**
	 * @param $name
	 * @return mixed
	 * @throws Exception
	 */
	public function __get($name) {
		return $this->get($name);
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function __set($name, $value) {
		$this->set($name, $value);
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
	public function set($name, $value) {
		$this->registrants[$name] = $value;
	}

	/**
	 * @param $name
	 * @return mixed
	 * @throws Exception
	 */
	public function get($name) {
		if (!empty($name)) {
			if (isset($this->registrants[$name])) {
				$val = $this->registrants[$name];
				if (is_callable($val)) {
					// Functions stored within DI aren't executed unless required to save on memory and once executed once the resulting value is stored in it's place
					$val = $val();
					$this->registrants[$name] = $val;
				}
				return $val;
			}

			// If $name is a module or object then we will auto create it
			if ((isset($this->asset) && (is_readable(root . $this->asset->get_module_dir() . $name . '/' . $name . '.php') || is_readable(root . $this->asset->get_object_dir() . $name . '.php'))) || is_readable(root . '/inc/core/' . $name . '.php')) {
				$val = $this->load_class($name);
				$this->set($name, $val);

				return $val;
			}

			$val = new table();
			$val->mysql_table_name = $name;
			$val->set_di($this);
			$this->set($name, $val);

			return $val;

		} else {
			trigger_error('Please supply a valid name to ' . __METHOD__);
		}

		return false;
	}
}