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
	 * @param string $block
	 * @param string $key
	 * @param string $fallback_value
	 * @return string
	 */
	public static function conf($block, $key, $fallback_value = '') {
		if (empty(self::$conf_file)) {
			self::$conf_file = parse_ini_file(root . '/.conf/default.ini', true, INI_SCANNER_RAW);
		}

		if (isset(self::$conf_file[$block][$key])) {
			return trim(self::$conf_file[$block][$key]);
		}

		return trim($fallback_value);
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
}