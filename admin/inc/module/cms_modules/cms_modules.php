<?
/**
 * Class cms_modules
 */
class cms_modules extends core_module {

	/**
	 * @param array $path_parts
	 * @param int   $path_count
	 * @return bool|string
	 */
	public function __controller(array $path_parts, $path_count) {
		$this->fn_column = 'table_name';
		return parent::__controller($path_parts, $path_count);
	}
}