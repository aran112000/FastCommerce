<?
final class theme {

	private $base_theme_path = '';

	public function get_path($relative_path) {
		if (empty($this->base_theme_path)) {
			$this->base_theme_path = '/inc/theme/' . get::setting('theme');
		}

		return $this->base_theme_path . $relative_path;
	}
}