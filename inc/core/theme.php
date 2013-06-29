<?
/**
 * Class theme
 */
final class theme extends dependency {

	/**
	 * @var string
	 */
	private $base_theme_path = '/inc/theme';

	/**
	 * @var array
	 */
	private $theme_settings = array();

	/**
	 * @var string
	 */
	protected $theme = '';

	/**
	 */
	public function __init() {
		$this->base_theme_path = $this->di->asset->get_theme_dir();
		$this->get_theme_setting();
		$this->set_resources();
	}

	/**
	 * @return mixed
	 */
	public function get_theme() {
		if (!empty($this->theme)) {
			return $this->theme;
		}
		$theme = $this->di->get->setting('theme', 'buyshop');
		if (!empty($theme)) {
			$theme_dir = root . $this->di->asset->get_theme_dir();
			if (is_readable($theme_dir . $theme . '/index.php')) {
				$this->theme = $theme;
				return $theme;
			}
		}

		// TODO - Write to error tbl, no visible error should be thrown for this
		$this->get_fallback_theme();

		return $this->theme;
	}

	/**
	 * @return bool
	 */
	protected function get_fallback_theme() {
		foreach (glob(root . $this->base_theme_path . '*', GLOB_ONLYDIR) as $dir) {
			if (!strstr($dir, '/_global')) {
				$theme_path_parts = explode('/', str_replace(root, '', $dir));
				$this->theme = end($theme_path_parts);

				return $this->theme;
			}
		}

		return false;
	}

	/**
	 * @param $relative_path
	 * @return string
	 */
	public function get_path($relative_path) {
		return $this->base_theme_path . $this->theme . '/' . $relative_path;
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

	/**
	 *
	 */
	private function set_resources() {
		foreach(glob(root . '/inc/theme/_global/js/*.js') as $js) {
			$this->di->core->footer_js_files[$js] = str_replace(root, '', $js);
		}
		foreach(glob(root . $this->base_theme_path . '_global/*.js') as $js) {
			$this->di->core->footer_js_files[$js] = str_replace(root, '', $js);
		}

		foreach (glob(root . $this->base_theme_path . $this->get_theme() . '/js/*.js') as $theme_js) {
			$theme_js = str_replace(root, '', $theme_js);
			$this->di->core->footer_js_files[$theme_js] = $theme_js;
		}
	}
}