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
	 * @var array
	 */
	public $footer_js_files = array();

	/**
	 * @var array
	 */
	public $inline_js = array();

	/**
	 * @var array
	 */
	public $css_files = array();

	/**
	 * @var array
	 */
	public $less_files = array();

	/**
	 * @var
	 */
	public $css_last_mod_time;

	/**
	 * Constructor
	 */
	public function __init() {
		if (ajax) {
			if ($this->di->get->class_exists($_REQUEST['act'])) {
				$this->di->{$_REQUEST['act']} = $this->di->load_class($_REQUEST['act']);
				if ($this->di->get->method_exists($this->di->{$_REQUEST['act']}, $_REQUEST['handler'])) {
					$this->di->{$_REQUEST['act']}->$_REQUEST['handler']();
				}
			}
		}
	}

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

			if (is_readable(root . $this->di->asset->get_module_dir() . $module_name . '/' . $module_name . '.php')) {
				if (!isset($this->di->$module_name)) {
					$this->di->$module_name = $this->di->load_class($module_name);
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
		$html .= "\t".'<link rel="stylesheet" type="text/css" href="' . $this->di->asset->get('/css/' . $this->get_css_last_mod_time() . '.css') . '" />'."\n";
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

		if (debug) {
			$html .= '<div id="live_edit_splitter">'."\n";
				$html .= '<div id="editor_pane">'."\n";
					$html .= $this->di->code_editor->get_editor_pane('less', '/inc/theme/buyshop/css/main.less');
				$html .= '</div>'."\n";

				$html .= '<div id="website_pane">'."\n";
		}

		return $html;
	}

	/**
	 *
	 */
	public function show_css() {
		$css = $this->get_css_contents();
		if (!empty($css)) {
			$last_mod_file = $this->get_css_last_mod_time();
			$cache_key = crc32($last_mod_file . '_' . implode('_', $this->css_files) . '_' . implode('_', $this->less_files));
			$css = '/*' . $cache_key . "*/\n" . $css;

			header('Pragma: public', true);
			header('Cache-Control: max-age=' . (60 * 60 * 24 * 31 * 12), true);
			header('Last-modified: ' . date('D, d M Y H:i:s', $last_mod_file) . ' GMT', true);
			header('Expires: ' . date('D, d M Y H:i:s', $last_mod_file + (60 * 60 * 24 * 31 * 12)) . ' GMT', true);
			if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) && ($last_mod_file <= strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']))) {
				header($_SERVER['SERVER_PROTOCOL'].' 304 Not Modified', true, 304);
			}
			header('Content-type: text/css', true);
			exit($css);
		}
	}

	/**
	 * @return string
	 *
	 * Gets the contents of all our CSS files (including LESS files) - Designed to be used dynamically for developers
	 * to allow rapid development. In production environments this needs to be rendered out and ideally pushed to a CDN
	 *
	 * TODO - Render contents
	 */
	public function get_css_contents() {
		$this->get_css_files();
		$this->get_less_files();

		$css = $less_css = '';
		foreach ($this->css_files as $file_root_path => $file) {
			$css .= file_get_contents($file_root_path);
		}

		foreach ($this->less_files as $file_root_path => $file) {
			$less_css .= file_get_contents($file_root_path);
		}

		if (!empty($less_css)) {
			if (is_readable(root . '/inc/lib/less/lessc.php')) {
				require_once(root . '/inc/lib/less/lessc.php');

				$less = new lessc;
				$less->setFormatter('compressed');
				try {
					$css .= $less->compile($less_css);
				} catch (exception $e) {
					trigger_error('Fatal error compiling LESS css: ' . $e->getMessage());
				}
			} else {
				trigger_error('Error loading lessc lib');
			}
		}


		return $css;
	}

	/**
	 * @return int
	 *
	 * This will return a timestamp of the last know CSS files change (includes LESS files)
	 * Used for cache breaking on non-rendered CSS files
	 */
	public function get_css_last_mod_time() {
		$this->get_css_files();
		$this->get_less_files();

		if ($this->css_last_mod_time > 0) {
			return $this->css_last_mod_time;
		}

		foreach ($this->css_files as $file_root_path => $file) {
			$time = filemtime($file_root_path);
			if ($time > $this->css_last_mod_time) {
				$this->css_last_mod_time = $time;
			}
		}

		foreach ($this->less_files as $file_root_path => $file) {
			$time = filemtime($file_root_path);
			if ($time > $this->css_last_mod_time) {
				$this->css_last_mod_time = $time;
			}
		}

		return $this->css_last_mod_time;
	}

	/**
	 * @param string $file_extension
	 * @return array
	 */
	public function get_css_files($file_extension = 'css') {
		if (!empty($this->{$file_extension . '_files'})) {
			return $this->{$file_extension . '_files'};
		}

		$module_dir = $this->di->asset->get_module_dir();
		$theme_dir = $this->di->asset->get_theme_dir();

		if (is_readable(root . $theme_dir . '_global/css/vars.' . $file_extension)) {
			$this->{$file_extension . '_files'}[root . $theme_dir . '_global/css/vars.' . $file_extension] = $theme_dir . '_global/css/vars.' . $file_extension;
		}

		// Global CSS
		foreach (glob(root . $theme_dir . '_global/css/*.' . $file_extension) as $file) {
			$relative_file = str_replace(root, '', $file);
			$this->{$file_extension . '_files'}[$file] = $relative_file;
		}

		// Theme CSS
		foreach (glob(root . $theme_dir . $this->di->theme->get_theme() . '/css/*.' . $file_extension) as $file) {
			$relative_file = str_replace(root, '', $file);
			$this->{$file_extension . '_files'}[$file] = $relative_file;
		}

		// Module specific CSS
		foreach (glob(root . $module_dir . '*', GLOB_ONLYDIR) as $module_folder) {
			foreach (glob($module_folder . '/css/*.' . $file_extension) as $file) {
				$relative_file = str_replace(root, '', $file);
				$this->{$file_extension . '_files'}[$file] = $relative_file;
			}
		}

		return $this->{$file_extension . '_files'};
	}

	/**
	 * @return array
	 */
	public function get_less_files() {
		return $this->get_css_files('less');
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
		if (debug) {
			$html .= '</div></div>'."\n"; // End of live edit frame wrapper

			if (defined('show_mysql_benchmark') && show_mysql_benchmark) {
				echo '<div id="mysql_benchmark" style="background-color:#fff;padding:20px;">' . $this->di->benchmark->get_benchmark_formatted('mysql') . '</div>';
			}
		}
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