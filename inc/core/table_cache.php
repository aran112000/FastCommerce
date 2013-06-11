<?
/**
 * Class table_cache
 */
final class table_cache extends dependency {

	/**
	 * @var array
	 */
	private $mysql_field_mapping = array(
		'varchar' => 'string',
		'text' => 'string',
		'tinyint' => 'int',
	);

	/**
	 * @var array
	 */
	protected $table_definitions = array();

	/**
	 * @param $table
	 * @return bool
	 */
	public function get_table_definition($table) {
		if (isset($this->table_definitions[$table])) {
			return $this->table_definitions[$table];
		}

		$tres = $this->di->db->query('SHOW COLUMNS FROM `' . $this->di->db->esc($table) . '`');
		if ($tres && $this->di->db->num($tres) > 0) {
			$this->table_definitions[$table] = array();
			while ($trow = $this->di->db->fetch_array($tres)) {
				$mysql_field_details = $this->do_split_mysql_field($trow['Type']);
				if (!empty($mysql_field_details)) {
					$this->table_definitions[$table][$trow['Field']] = array(
						'field_type' => $this->get_field_type($mysql_field_details['mysql_field']),
						'max_length' => $mysql_field_details['max_length'],
					);
				} else {
					trigger_error('Error fetching field details for ' . $table . ':' . $trow['Field']);
				}
			}

			return $this->table_definitions[$table];
		}

		return false;
	}

	/**
	 * @param $mysql_field
	 * @return array
	 */
	private function do_split_mysql_field($mysql_field) {
		$mysql_field_parts = explode('(', $mysql_field);

		return array(
			'mysql_field' => (isset($mysql_field_parts[0]) ? $mysql_field_parts[0] : $mysql_field),
			'max_length' => (isset($mysql_field_parts[1]) ? str_replace(')', '', $mysql_field_parts[1]) : 0),
		);
	}

	/**
	 * @param $mysql_field
	 * @return mixed
	 */
	private function get_field_type($mysql_field) {
		if (isset($this->mysql_field_mapping[$mysql_field])) {
			return $this->mysql_field_mapping[$mysql_field];
		}

		return $mysql_field;
	}
}