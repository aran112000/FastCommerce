<?
/*
 * TODOs
 *  - More core into DI when loaded for any items such as SEO tags can go directly in from any object or module
 * */


/**
 * Class core
 */
final class core {

	/**
	 * Holds all the page details required by the main theme (/theme/[theme_name]/index.php) to display the site content
	 *
	 * @var array
	 */
	private $page = array();

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->di = new di();
		if (ajax) {
			// TODO - Create ajax handler in PHP & JS
		} else {
			$this->__controller();
		}
	}

	public function __controller() {
		$url_parts = $this->get_url_parts();
		if (!empty($url_parts)) {
			$module_name = $url_parts[0];
			$module_aliases = get::conf('module_aliases');
			if (isset($module_aliases[$module_name])) {
				$module_name = $module_aliases[$module_name];
			}

			if (is_readable(root . '/inc/module/' . $module_name . '/' . $module_name . '.php')) {
				// TODO test this block
				$this->di->$module_name = new $module_name($module_name);
				if (get::method_exists($this->di->$module_name, '__controller')) {
					$this->page['body'] = $this->di->$module_name->__controller($url_parts, count($url_parts));
				} else {
					trigger_error('No controller found for module: ' . $module_name);
				}
			} else {
				$this->di->page = new page('page');
				$this->page['body'] = $this->di->page->__controller($url_parts, count($url_parts));
			}
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
	 * @return array
	 */
	private function get_url_parts() {
		return explode('/', substr(uri, 1, strlen(uri)));
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
		return (isset($this->page['body']) ? $this->page['body'] : '');
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