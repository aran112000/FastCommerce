<?
/**
 * Class core_module
 */
class core_module extends seo {

	/**
	 * @param null $table
	 */
	public function __construct($table = NULL) {
		$this->di = new di();
		if ($table !== NULL) {
			$this->table = $table;
			$this->fields = table_cache::get_table_definition($this->table);
		}
	}


	/**
	 * @param $path_parts
	 * @param $path_count
	 *
	 * @return bool|string
	 */
	public function __controller($path_parts, $path_count) {
		if ($path_count > 1) {
			run::header_redir('/' . $path_parts[0], 301);
		} else {
			if ($path_parts[0] == 404) {
				// TODO - These need to be noindex,follow
				run::http_status(404);
				return $this->get_view('404');
			} else {
				if (!$this->current = $this->do_retrieve(array(), array('where' => 'fn=:fn', 'params' => array('fn' => $path_parts[0])))) {
					run::header_redir('/404', 404);
				}

				parent::__controller($path_parts, $path_count);

				return $this->get_view('default');
			}
		}

	}

	/**
	 * @param string $view
	 *
	 * @return bool|string
	 */
	public function get_view($view = 'default') {
		if (is_readable(root . '/inc/module/' . $this->table . '/view/' . $view . '.php')) {
			ob_start();
			require(root . '/inc/module/' . $this->table . '/view/' . $view . '.php');
			$html = ob_get_contents();
			ob_end_clean();

			return $html;
		} else {
			return false;
		}
	}
}