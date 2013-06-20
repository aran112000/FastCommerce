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
	 * @var string
	 */
	public $fn_column = 'fn';

	/**
	 * @var null
	 */
	public $table = NULL;

	/**
	 * @var array
	 */
	protected $fields = array();

	/**
	 * @var null
	 */
	public $current = NULL;

	/**
	 * @param null $table
	 */
	public function __init($table = NULL) {
		if ($table !== NULL) {
			$this->table = $table;
			$this->fields = $this->di->table_cache->get_table_definition($this->table);
		}

		if (uri == 404) {
			$this->di->run->http_status(404);
			$this->get_view('404');
		}
	}

	/**
	 * @param array $path_parts
	 * @param int   $path_count
	 * @return bool|string
	 */
	public function __controller(array $path_parts, $path_count) {
		if (!isset($this->current) || empty($this->current)) {
			$this->set_current($fn = (isset($path_parts[$this->fn_path_number]) ? $path_parts[$this->fn_path_number] : ''));
		}

		parent::__controller($path_parts, $path_count);

		return $this->get_view('default');
	}

	/**
	 * @param       $fn
	 * @param array $fields
	 * @param array $opts
	 * @return bool
	 */
	public function set_current($fn, array $fields = array(), array $opts = array('where' => 'fn=:fn', 'limit' => 1)) {
		$opts['where'] = str_replace('fn=:fn', $this->fn_column . '=:fn', $opts['where']);
		$opts['params']['fn'] = $fn;
		if (!$this->current = $this->di->{$this->table}->do_retrieve($fields, $opts)) {
			$this->di->run->header_redir('/404', 404);
		}

		return true;
	}

	/**
	 * @param string $view
	 *
	 * @return bool|string
	 */
	public function get_view($view = 'default') {
		$module_folder = get_called_class();
		if (is_readable(root . $this->di->asset->get_module_dir() . $module_folder . '/view/' . $view . '.php')) {
			ob_start();
			require(root . $this->di->asset->get_module_dir() . $module_folder . '/view/' . $view . '.php');
			$html = ob_get_contents();
			ob_end_clean();

			return $html;
		} else {
			return false;
		}
	}
}