<?
/**
 * Class core
 */
final class core {

	/**
	 * Constructor
	 */
	public function __construct() {
		if (!isset($this->di)) {
			$this->di = new di();
		}
		if (ajax) {

		}
	}

	/**
	 * @throws Exception
	 */
	public function get_theme() {
		$theme = get::setting('theme', 'buyshop');
		if (!empty($theme)) {
			if (is_readable(root . '/inc/theme/' . $theme . '/index.php')) {
				$this->theme = $theme;
				$this->di->theme_class = function() {
					return new theme();
				};
				require(root . '/inc/theme/' . $theme . '/index.php');
			}
		} else {
			throw new Exception('No site theme specified');
		}
	}

	/**
	 * @return string
	 */
	public function get_html_header() {
		$html = '<!DOCTYPE html>'."\n";
		$html .= '<html>'."\n";
		$html .= '<head>'."\n";
		$html .= "\t".'<link rel="stylesheet" type="text/css" href="' . $this->di->theme_class->get_path('/css/style.css') . '" />'."\n";
		$html .= "\t".'<title>My E-commerce Store</title>'."\n"; // TODO
		$html .= '</head>'."\n";
		$html .= '<body>'."\n";

		return $html;
	}

	/**
	 * @return string
	 */
	public function get_html_content() {
		return ''; // TODO
	}

	/**
	 * @return string
	 */
	public function get_html_footer() {
		$html = '</body>'."\n";
		$html .= '<script src="' . $this->di->theme_class->get_path('/js/jquery.min.js') . '"></script>'."\n";
		$html .= '</html>'."\n";

		return $html;
	}

	/**
	 * Destructor
	 */
	public function __destruct() {
		db::close();
	}
}