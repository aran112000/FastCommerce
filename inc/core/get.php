<?
/**
 * Class get
 */
final class get extends dependency {

	/**
	 * @var array
	 */
	private $conf_file = array();

	/**
	 * @var array
	 */
	private $fetched_settings = array();

	/**
	 * @var array
	 */
	private $method_exists_cache = array();

	/**
	 * @var array
	 */
	private $class_exists_cache = array();

	/**
	 * @param string $block
	 * @param string $key
	 * @param string $fallback_value
	 * @return string
	 */
	public function conf($block, $key = '', $fallback_value = '') {
		if (empty($this->conf_file)) {
			$this->conf_file = parse_ini_file(root . '/.conf/default.ini', true, INI_SCANNER_RAW);
		}

		if (!empty($key)) {
			if (isset($this->conf_file[$block][$key])) {
				return $this->conf_file[$block][$key];
			}
		} else {
			if (isset($this->conf_file[$block])) {
				return $this->conf_file[$block];
			}
		}

		return $fallback_value;
	}

	/**
	 * @param string $key
	 * @param string $fallback_value
	 * @return string
	 */
	public function setting($key, $fallback_value = '') {
		if (empty($this->fetched_settings)) {
			$sres = $this->di->db->query('SELECT `key`, `value` FROM setting');
			if ($this->di->db->num($sres) > 0) {
				while ($srow = $this->di->db->fetch_object($sres)) {
					$this->fetched_settings[$srow->key] = $srow->value;
				}
			}
		}

		if (isset($this->fetched_settings[$key])) {
			return $this->fetched_settings[$key];
		}

		return trim($fallback_value);
	}

	/**
	 * @param $object
	 * @param $method_name
	 *
	 * @return mixed
	 */
	public function method_exists($object, $method_name) {
		$class_name = get_class($object);
		if (!isset($this->method_exists_cache[$class_name][$method_name])) {
			$this->method_exists_cache[$class_name][$method_name] = (method_exists($object, $method_name));
		}

		return $this->method_exists_cache[$class_name][$method_name];
	}

	/**
	 * @param $class_name
	 *
	 * @return mixed
	 */
	public function class_exists($class_name) {
		if (!isset($this->class_exists_cache[$class_name])) {
			$this->class_exists_cache[$class_name] = (class_exists($class_name));
		}

		return $this->class_exists_cache[$class_name];
	}
}