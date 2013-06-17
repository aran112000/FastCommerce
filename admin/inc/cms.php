<?
/**
 * Class cms
 */
final class cms extends core {

	/**
	 * @var string
	 */
	public $page_prefix = '/admin/';

	/**
	 * @return array
	 */
	public function get_url_parts() {
		$parts = explode('/', substr(uri, 1, strlen(uri)));
		if (isset($parts[0])) {
			$this->page_prefix = '/' . $parts[0] . '/';
			unset($parts[0]);
			$parts = array_values($parts);
		}

		return $parts;
	}

	/**
	 * @return mixed
	 */
	protected function get_module_aliases() {
		$cms_module_aliases = array(
			'module' => 'cms_modules',
		);
		return array_merge($this->di->get->conf('module_aliases'), $cms_module_aliases);
	}

	/**
	 * @return string
	 */
	public function get_html_header() {
		$html = '<!DOCTYPE html>'."\n";
		$html .= '<html>'."\n";
		$html .= '<head>'."\n";
			// TODO - CSS files
			$html .= '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic">'."\n";
        	$html .= '<link rel="stylesheet" href="' . $this->di->theme->get_path('css/bootstrap.css') . '">'."\n";
        	$html .= '<link rel="stylesheet" href="' . $this->di->theme->get_path('css/plugins.css') . '">'."\n";
        	$html .= '<link rel="stylesheet" href="' . $this->di->theme->get_path('css/main.css') . '">'."\n";
        	$html .= '<link rel="stylesheet" href="' . $this->di->theme->get_path('css/themes.css') . '">'."\n";
			$html .= "\t".'<meta charset="' . $this->di->get->conf('site_settings', 'charset', '') . '" />'."\n";
			$html .= "\t".'<meta name="robots" content="noindex,nofollow" />'."\n";
			$html .= "\t".'<meta name="viewport" content="width=device-width,initial-scale=1">'."\n";
			$html .= "\t".'<link rel="dns-prefetch" href="http' . (ssl ? 's' : '') . '://' . host . '" />'."\n";
			$html .= "\t".'<title>' . (isset($this->page['title_tag']) ? $this->page['title_tag'] : '') . ' | FastCommerce Admin</title>'."\n";
			$html .= "\t".'<script src="' . $this->di->theme->get_path('js/modernizr-2.6.2-respond-1.1.0.min.js') . '"></script>'."\n"; // TODO change
		$html .= '</head>'."\n";
		$html .= '<body>'."\n";

		return $html;
	}
}