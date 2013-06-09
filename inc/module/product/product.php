<?
/**
 * Class product
 */
final class product extends core_module {

	/**
	 * @param string $table
	 */
	public function __construct($table = NULL, $di) {
		parent::__construct('prod', $di);
	}
}