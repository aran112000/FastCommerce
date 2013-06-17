<?
/**
 * Class core
 */
class core extends dependency {

	/**
	 * @var string
	 */
	public $page_prefix = '/';

	/**
	 * Holds all the page details required by the main theme (/theme/[theme_name]/index.php) to display the site content
	 *
	 * @var array
	 */
	public $page = array();

	/**
	 * Constructor
	 */
	public function __init() {
		if (ajax) {
			if ($this->di->get->class_exists($_REQUEST['act'])) {
				$this->di->{$_REQUEST['act']} = new $_REQUEST['act'];
				$this->di->{$_REQUEST['act']}->set_di($this->di);
				if ($this->di->get->method_exists($this->di->{$_REQUEST['act']}, $_REQUEST['handler'])) {
					$this->di->{$_REQUEST['act']}->$_REQUEST['handler']();
				}
			}
		}
	}

	/**
	 * @var array
	 */
	public $footer_js_files = array();

	/**
	 * @var array
	 */
	public $inline_js = array();

	/**
	 * @return mixed
	 */
	protected function get_module_aliases() {
		return $this->di->get->conf('module_aliases');
	}

	/**
	 *
	 */
	public function __controller() {
		$url_parts = $this->get_url_parts();
		if (!empty($url_parts)) {
			$module_name = $url_parts[0];
			$module_aliases = $this->get_module_aliases();
			if (isset($module_aliases[$module_name])) {
				$module_name = $module_aliases[$module_name];
			}

			$this->di->set('pages', function() {
				$pages = new pages('pages');
				$pages->set_di($this->di);

				return $pages;
			});

			if (is_readable(root . $this->di->asset->get_module_dir() . $module_name . '/' . $module_name . '.php')) {
				if (!isset($this->di->$module_name)) {
					$this->di->$module_name = new $module_name($module_name);
					$this->di->$module_name->set_di($this->di);
				}
				if ($this->di->get->method_exists($this->di->$module_name, '__controller')) {
					$this->page['body'] = $this->di->$module_name->__controller($url_parts, count($url_parts));
				} else {
					trigger_error('No controller found for module: ' . $module_name);
				}
			} else {
				$this->page['body'] = $this->di->pages->__controller($url_parts, count($url_parts));
			}
		}
	}


	/**
	 * @return bool
	 */
	public function load_theme() {
		$this->__controller();
		$theme = $this->di->theme->get_theme();
		if ($theme) {
			return require(root . $this->di->asset->get_theme_dir() . $theme . '/index.php');
		}

		trigger_error('Please specify a valid theme & make sure the directory is readable');
		return false;
	}

	/**
	 * @return array
	 */
	public function get_url_parts() {
		return explode('/', substr(uri, 1, strlen(uri)));
	}

	/**
	 * @return string
	 */
	public function get_html_header() {
		$html = '<!DOCTYPE html>'."\n";
		$html .= '<html>'."\n";
		$html .= '<head>'."\n";
		$html .= "\t".'<meta charset="' . $this->di->get->conf('site_settings', 'charset', '') . '" />'."\n";
		$html .= "\t".'<link rel="dns-prefetch" href="http' . (ssl ? 's' : '') . '://' . host . '" />'."\n";
		$html .= "\t".'<link rel="stylesheet" type="text/css" href="' . $this->di->theme->get_path('/css/style.css') . '" />'."\n";
		$html .= "\t".'<title>' . (isset($this->page['title_tag']) ? $this->page['title_tag'] : '') . '</title>'."\n";
		if (isset($this->page['meta_description']) && !empty($this->page['meta_description'])) {
			$html .= "\t".'<meta name="description" content="' . $this->page['meta_description'] . '" />'."\n";
		}
		$html .= "\t".'<meta name="robots" content="' . (isset($this->page['robots']) ? $this->page['robots'] : 'index,follow') . '" />'."\n";
		if (isset($this->page['social_meta_tags']) && !empty($this->page['social_meta_tags'])) {
			foreach ($this->page['social_meta_tags'] as $tag) {
				$html .= "\t".$tag."\n";
			}
		}
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
		$html = '';
		if (!empty($this->footer_js_files)) {
			$html .= '<script>';
			$html .= 'function __ls(b,c){(function(){if(0!=b.length){var d=b.shift(),e=arguments.callee,a=document.createElement(\'script\');a.src=d;a.onload=a.onreadystatechange=function(){a.onreadystatechange=a.onload=null;e()};(document.getElementsByTagName(\'head\')[0]||document.body).appendChild(a)}else c&&c()})()};__ls([' . "\n" . '"' . implode('",'."\n".'"', $this->footer_js_files) . '"'."\n".']';
			if (!empty($this->inline_js)) {
				$html .= ',function(){$(document).ready(function(){';
				$html .= implode("\n", $this->inline_js);
				$html .= '});});';
			} else {
				$html .= ');';
			}
			$html .= '</script>'."\n";
		} else if (!empty($this->inline_js)) {
			$html .= '<script>'."\n";
			$html .= '$(document).ready(function(){'."\n";
			$html .= implode("\n", $this->inline_js);
			$html .= '});'."\n";
			$html .= '</script>'."\n";
		}
		$html .= '</body>'."\n";
		$html .= '</html>'."\n";

		return $html;
	}

	/**
	 * Destructor
	 */
	public function __destruct() {
		if (ajax) {
			$this->di->ajaxify->do_serve();
		}
		$this->di->db->close();
		if (gc_support) {
			gc_collect_cycles();
		}
	}
}