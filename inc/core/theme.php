<?
/**
 * Class theme
 */
final class theme {

	/**
	 * @var string
	 */
	private $base_theme_path = '';

	/**
	 * @var array
	 */
	private $theme_settings = array();

	/**
	 * @param null $di
	 */
	public function __construct($di = NULL) {
		$this->di = ($di !== NULL ? $di : new di());
		$this->base_theme_path = '/inc/theme/' . $this->di->get->setting('theme');
		$this->get_theme_setting();
	}

	/**
	 * @param $relative_path
	 * @return string
	 */
	public function get_path($relative_path) {
		return $this->base_theme_path . $relative_path;
	}

	/**
	 * @return array
	 */
	public function get_theme_setting() {
		if (empty($this->theme_settings)) {
			$settings_file = root . $this->base_theme_path . '/inc/settings.ini';
			if (is_readable($settings_file)) {
				$this->theme_settings = parse_ini_file($settings_file, true, INI_SCANNER_RAW);
			}
		}

		return $this->theme_settings;
	}
}