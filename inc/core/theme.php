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
		$this->set_resources();
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
			$settings_file = root . $this->base_theme_path . '/settings.ini';
			if (is_readable($settings_file)) {
				$this->theme_settings = parse_ini_file($settings_file, true, INI_SCANNER_RAW);
			}
		}

		return $this->theme_settings;
	}

	private function set_resources() {
		if (isset($this->theme_settings['global_js'])) {
			foreach ($this->theme_settings['global_js'] as $js) {
				$this->di->core->footer_js_files[$js] = '/inc/theme/_global/js/' . $js;
			}
		}

		foreach (glob(root . $this->base_theme_path . '/js/*.js') as $theme_js) {
			$theme_js = str_replace(root, '', $theme_js);
			$this->di->core->footer_js_files[$theme_js] = $theme_js;
		}
	}
}