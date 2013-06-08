<?
/**
 * Class get
 */
final class get {

	/**
	 * @var array
	 */
	private static $conf_file = array();

	/**
	 * @var array
	 */
	private static $fetched_settings = array();

	/**
	 * @var array
	 */
	private static $method_exists_cache = array();

	/**
	 * @var array
	 */
	private static $class_exists_cache = array();

	/**
	 * @param string $block
	 * @param string $key
	 * @param string $fallback_value
	 * @return string
	 */
	public static function conf($block, $key = '', $fallback_value = '') {
		if (empty(self::$conf_file)) {
			self::$conf_file = parse_ini_file(root . '/.conf/default.ini', true, INI_SCANNER_RAW);
		}

		if (!empty($key)) {
			if (isset(self::$conf_file[$block][$key])) {
				return self::$conf_file[$block][$key];
			}
		} else {
			if (isset(self::$conf_file[$block])) {
				return self::$conf_file[$block];
			}
		}

		return $fallback_value;
	}

	/**
	 * @param string $key
	 * @param string $fallback_value
	 * @return string
	 */
	public static function setting($key, $fallback_value = '') {
		if (empty(self::$fetched_settings)) {
			$sres = db::query('SELECT `key`, `value` FROM setting');
			if (db::num($sres) > 0) {
				while ($srow = db::fetch_object($sres)) {
					self::$fetched_settings[$srow->key] = $srow->value;
				}
			}
		}

		if (isset(self::$fetched_settings[$key])) {
			return self::$fetched_settings[$key];
		}

		return trim($fallback_value);
	}

	/**
	 * @param $object
	 * @param $method_name
	 *
	 * @return mixed
	 */
	public static function method_exists($object, $method_name) {
		$class_name = get_class($object);
		if (!isset(self::$method_exists_cache[$class_name][$method_name])) {
			self::$method_exists_cache[$class_name][$method_name] = (method_exists($object, $method_name));
		}

		return self::$method_exists_cache[$class_name][$method_name];
	}

	/**
	 * @param $class_name
	 *
	 * @return mixed
	 */
	public static function class_exists($class_name) {
		if (!isset(self::$method_exists_cache[$class_name])) {
			self::$method_exists_cache[$class_name] = (class_exists($class_name));
		}

		return self::$method_exists_cache[$class_name];
	}
}