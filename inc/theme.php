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
	 * @param $relative_path
	 * @return string
	 */
	public function get_path($relative_path) {
		if (empty($this->base_theme_path)) {
			$this->base_theme_path = '/inc/theme/' . get::setting('theme');
		}

		return $this->base_theme_path . $relative_path;
	}
}