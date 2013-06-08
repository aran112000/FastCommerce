<?
/**
 * Class table
 */
class table {

	/**
	 * Fields to not select by default from your DB, typically this should be live & deleted as these are
	 * only for filtering result sets
	 *
	 * @var array
	 */
	public $mysql_select_ignore_fields = array('live', 'deleted');

	/**
	 * @var array
	 */
	protected $fields = array();

	/**
	 * @var string
	 */
	protected $table = '';

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->di = new di();
		$this->table = get_called_class();
		if (!empty($this->table)) {
			$this->fields = table_cache::get_table_definition($this->table);
		}
	}

}