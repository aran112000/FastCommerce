<?
/**
 * Class core_module
 */
class core_module extends seo {

	/**
	 * The zero based number at which the item fn should appear within the module URL
	 *
	 * @var int
	 */
	public $fn_path_number = 1;

	/**
	 * @param null $table
	 */
	public function __construct($table = NULL, $di = NULL) {
		if (!isset($this->di)) {
			$this->di = ($di !== NULL ? $di : new di());
		}
		if ($table !== NULL) {
			$this->table = $table;
			$this->fields = $this->di->table_cache->get_table_definition($this->table);
		}
	}


	/**
	 * @param $path_parts
	 * @param $path_count
	 *
	 * @return bool|string
	 */
	public function __controller($path_parts, $path_count) {
		if (!isset($this->current) || empty($this->current)) {
			if ($path_parts[0] == 404) {
				run::http_status(404);
				return $this->get_view('404');
			}

			if (!$this->current = $this->di->{$this->table}->do_retrieve(array(), array('where' => 'fn=:fn', 'params' => array('fn' => (isset($path_parts[$this->fn_path_number]) ? $path_parts[$this->fn_path_number] : '')), 'limit' => 1))) {
				run::header_redir('/404', 404);
			}
		}

		parent::__controller($path_parts, $path_count);

		return $this->get_view('default');
	}

	/**
	 * @param string $view
	 *
	 * @return bool|string
	 */
	public function get_view($view = 'default') {
		$module_folder = get_called_class();
		if (is_readable(root . '/inc/module/' . $module_folder . '/view/' . $view . '.php')) {
			ob_start();
			require(root . '/inc/module/' . $module_folder . '/view/' . $view . '.php');
			$html = ob_get_contents();
			ob_end_clean();

			return $html;
		} else {
			return false;
		}
	}
}