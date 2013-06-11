<?
/**
 * Class table
 */
class table extends dependency {

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
	public function __init() {
		$this->table = ($this->mysql_table_name !== NULL ? $this->mysql_table_name : get_called_class());
		if (!empty($this->table)) {
			$this->fields = $this->di->table_cache->get_table_definition($this->table);
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
			$sql .= ' GROUP BY `' . (string) $options['group_by'] . '`';
		} else {
			$key = key($this->fields);
			if (!empty($key)) {
				$sql .= ' GROUP BY `' . (string) $key . '`';
			}
		}
		if (isset($options['order_by']) && !empty($options['order_by'])) {
			$sql .= ' ORDER BY `' . (string) $options['order_by'] . '`';
		}
		if (isset($options['limit']) && is_numeric($options['limit'])) {
			$sql .= ' LIMIT ' . (int) $options['limit'];
		}

		$tres = $this->di->db->query($sql, $params);
		if ($tres && $this->di->db->num($tres) > 0) {
			if (isset($options['limit']) && $options['limit'] == 1) {
				$result = $this->di->db->fetch_class($tres, $this->table);
				return $result[0];
			}
			return $this->di->db->fetch_class($tres, $this->table);
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