<?
/**
 * Class page
 */
final class page extends core_module {

	/**
	 * @param string $table
	 */
	public function __construct($table = 'page') {
		$this->fn_path_number = 0;
		parent::__construct($table);
	}

	/**
	 * @param $path_parts
	 * @param $path_count
	 */
	public function __controller($path_parts, $path_count) {
		if ($path_count > 1) {
			run::header_redir('/' . $path_parts[0], 301);
		}
		return parent::__controller($path_parts, $path_count);
	}
}