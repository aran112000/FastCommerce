<?
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