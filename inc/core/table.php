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

	/**
	 * @param array $fields
	 * @param       $id
	 * @param array $options
	 *
	 * @return bool|mixed
	 */
	public function do_retrieve_from_id(array $fields = array(), $id, array $options = array()) {
		if (!isset($options['where'])) $options['where'] = array();
		if (!isset($options['params'])) $options['params'] = array();

		$options['where'][] = '`' . key($this->fields) . '` = :id';
		$options['params']['id'] = (int)$id;
		$options['limit'] = 1;

		$results = $this->do_retrieve($fields, $options);
		if (!empty($results)) {
			return $results[0];
		}

		return false;
	}

	/**
	 * @param array $fields
	 * @param array $options
	 *
	 * @return bool|mixed
	 */
	public function do_retrieve(array $fields = array(), array $options = array()) {
		if (empty($fields)) {
			$fields = $this->get_default_select_fields();
		}

		$wheres = array();
		$params = (isset($options['params']) ? $options['params'] : array());
		$join = '';
		if (!$this->retrieve_nonlive) {
			if (isset($this->fields['live'])) {
				$wheres[] = 'live = :live';
				$params['live'] = 1;
			}
			if (isset($this->fields['deleted'])) {
				$wheres[] = 'deleted = :deleted';
				$params['deleted'] = 0;
			}
		}
		if (isset($options['join']) && !empty($options['join'])) {
			foreach ($fields as &$field) {
				$field = (!strstr($field, '.') ? $this->table . '`.`' . $field : $field);
			}
			foreach ($wheres as &$where) {
				$where = (!strstr($where, '.') ? '`' . $this->table . '`.' . $where : $where);
			}
			foreach ($options['join'] as $table => $condition) {
				$join .= ' JOIN `' . $table . '` ON ' . $condition;
			}
		}

		$sql = 'SELECT `' . implode('`, `', $fields) . '` FROM `' . $this->table . '`';
		$sql .= $join;

		if (isset($options['where']) && !empty($options['where'])) {
			if (is_array($options['where'])) {
				$wheres = array_merge($wheres, $options['where']);
			} else {
				$wheres[] = $options['where'];
			}
		}
		if (!empty($wheres)) {
			$sql .= ' WHERE ' . implode(' AND ', $wheres);
		}
		if (!empty($options['params']) && is_array($options['params'])) {
			$params = array_merge($params, $options['params']);
		}
		if (isset($options['group_by']) && !empty($options['group_by'])) {
			$sql .= ' GROUP BY `' . (string)$options['group_by'] . '`';
		} else {
			$sql .= ' GROUP BY `' . (string)key($this->fields) . '`';
		}
		if (isset($options['order_by']) && !empty($options['order_by'])) {
			$sql .= ' ORDER BY `' . (string)$options['order_by'] . '`';
		}
		if (isset($options['limit']) && is_numeric($options['limit'])) {
			$sql .= ' LIMIT ' . (int)$options['limit'];
		}

		$tres = db::query($sql, $params);
		if ($tres && db::num($tres) > 0) {
			if (isset($options['limit']) && $options['limit'] == 1) {
				$result = db::fetch_class($tres, $this->table);
				return $result[0];
			}
			return db::fetch_class($tres, $this->table);
		}

		return false;
	}

	/**
	 * @return array
	 */
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

/**
 * Class table_cache
 */
final class table_cache {

	/**
	 * @var array
	 */
	protected static $table_definitions = array();

	/**
	 * @var array
	 */
	private static $mysql_field_mapping = array(
		'varchar' => 'string',
		'text' => 'string',
		'tinyint' => 'int',
	);

	/**
	 * @param $table
	 * @return bool
	 */
	public static function get_table_definition($table) {
		if (isset(self::$table_definitions[$table])) {
			return self::$table_definitions[$table];
		}

		$tres = db::query('SHOW COLUMNS FROM `' . db::esc($table) . '`');
		if ($tres && db::num($tres) > 0) {
			self::$table_definitions[$table] = array();
			while ($trow = db::fetch_array($tres)) {
				$mysql_field_details = self::do_split_mysql_field($trow['Type']);
				if (!empty($mysql_field_details)) {
					self::$table_definitions[$table][$trow['Field']] = array(
						'field_type' => self::get_field_type($mysql_field_details['mysql_field']),
						'max_length' => $mysql_field_details['max_length'],
					);
				} else {
					trigger_error('Error fetching field details for ' . $table . ':' . $trow['Field']);
				}
			}

			return self::$table_definitions[$table];
		}

		return false;
	}

	/**
	 * @param $mysql_field
	 * @return array
	 */
	private static function do_split_mysql_field($mysql_field) {
		$mysql_field_parts = explode('(', $mysql_field);

		return array(
			'mysql_field' => (isset($mysql_field_parts[0]) ? $mysql_field_parts[0] : $mysql_field),
			'max_length' => (isset($mysql_field_parts[1]) ? str_replace(')', '', $mysql_field_parts[1]) : 0),
		);
	}

	/**
	 * @param $mysql_field_type
	 * @return mixed
	 */
	private static function get_field_type($mysql_field) {
		if (isset(self::$mysql_field_mapping[$mysql_field])) {
			return self::$mysql_field_mapping[$mysql_field];
		}

		return $mysql_field;
	}
}