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
	 * @param $relative_path
	 * @return string
	 */
	public function get_path($relative_path) {
		if (empty($this->base_theme_path)) {
			$this->base_theme_path = '/inc/theme/' . $this->di->get->setting('theme');
		}

		return $this->base_theme_path . $relative_path;
	}

	public function get_theme_setting() {
		if (empty($this->theme_settings)) {
			$this->theme_settings = parse_ini_file(root . '/.conf/default.ini', true, INI_SCANNER_RAW);
		}

		return $this->theme_settings;
	}
}