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
	public $ignore_fields = array('live', 'deleted');

	/**
	 * @var bool
	 */
	public $retrieve_nonlive = false;

	/**
	 * Leave NULL for to inherit DB table name from calling class, this should only be used if you need to alias
	 *
	 * @var null
	 */
	public $mysql_table_name = NULL;

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
		$this->table = ($this->mysql_table_name !== NULL ? $this->mysql_table_name : get_called_class());
		if (!empty($this->table)) {
			$this->fields = table_cache::get_table_definition($this->table);
		}
	}

	public function do_retrieve_from_id(array $fields = array(), $id, array $options = array()) {
		if (empty($fields)) {
			$fields = $this->get_default_select_fields();
		}

		$sql = 'SELECT `' . implode('`, `', $fields) . '` FROM `' . $this->table . '`';

		$where = array(
			'`' . key($this->fields) . '` = :id'
		);
		if (!$this->retrieve_nonlive) {
			if (isset($this->fields['live'])) {
				$where[] = 'live = 1';
			}
			if (isset($this->fields['deleted'])) {
				$where[] = 'deleted = 0';
			}
		}
		if (isset($options['where']) && !empty($options['where'])) {
			if (is_array($options['where'])) {
				$where = array_merge($where, $options['where']);
			} else {
				$where[] = $options['where'];
			}
		}
		if (!empty($where)) {
			$sql .= ' WHERE ' . implode(' AND ', $where);
		}

		$params = array(
			'id' => (int) $id,
		);
		if (!empty($options['params']) && is_array($options['params'])) {
			$params = array_merge($params, $options['params']);
		}
		$sql .= ' LIMIT 1';

		$tres = db::query($sql, $params);
		if ($tres && db::num($tres) == 1) {
			return db::fetch_class($tres, $this->table);
		}

		return false;
	}

	private function get_default_select_fields() {
		$fields = array();
		if (!empty($this->fields)) {
			foreach ($this->fields as $field => $opts) {
				if (!in_array($field, $this->ignore_fields)) {
					$fields[] = $field;
				}
			}
		}

		return $fields;
	}
}