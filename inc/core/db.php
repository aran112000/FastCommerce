<?php
/**
 * Class db
 */
final class db extends dependency {

	/**
	 * @var PDO null
	 */
	public $conn = NULL;

	/**
	 * @var bool
	 */
	public $benchmark;

	/**
	 */
	public function __init() {
		$this->connect();
		$this->benchmark = (defined('mysql_benchmark') && mysql_benchmark);
	}

	/**
	 * @return bool
	 */
	private function connect() {
		if ($this->conn === NULL) {
			$host = $this->di->get->conf('db', 'host');
			$host = ($host == 'localhost' ? '127.0.0.1' : $host); // Avoid hostname lookup where possible
			if ($this->conn = new PDO('mysql:host=' . $host . ';dbname=' . $this->di->get->conf('db', 'db'), $this->di->get->conf('db', 'user'), $this->di->get->conf('db', 'pass'), array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
			))) {
				return true;
			}

		}

		return false;
	}

	/**
	 * @param string $sql
	 * @param array  $params
	 * @param array  $options
	 * @internal param array $fetch
	 * @internal param array $tables
	 * @internal param bool $benchmark
	 * @return bool|PDOStatement
	 */
	public function query($sql, array $params = array(), array $options = array(
		'fetch' => 'array', // Options: 'array', 'class' or FALSE
		'class' => 'stdClass', // Only required if fetch type is 'class'
		'tables' => array(), // Used for cache breaking on MySQL query cache, please ensure all tables referenced are specified here
		'benchmark' => true, // Benchmark this query?
	)) {
		// Defaults
		if (!isset($options['fetch'])) $options['fetch'] = 'array';
		if (!isset($options['class'])) $options['class'] = 'stdClass';
		if (!isset($options['tables'])) $options['tables'] = array();
		if (!isset($options['benchmark'])) $options['benchmark'] = true;

		$query_cache_key = $this->get_query_cache_key($sql, $params, $options['tables']);
		if (!$cached_result = $this->di->cache->get($query_cache_key)) {
			//echo '<p>Not cached</p>'."\n";
			$benchmark = false;
			if ($this->benchmark && $options['benchmark']) {
				$benchmark = true;
				$this->di->benchmark->start('mysql', $sql);
			}
			$return = $cache_data = NULL;
			if ($res = $this->conn->prepare($sql, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false, PDO::MYSQL_ATTR_COMPRESS => true))) {
				if ($res->execute($params)) {
					if ($benchmark) {
						$this->di->benchmark->stop('mysql', $sql);
						$this->do_log_query_benchmark($sql, $params);
					}

					if ($res && $this->num($res) > 0) {
						if ($options['fetch'] === FALSE) {
							return $res;
						} else if ($options['fetch'] == 'class') {
							if (!isset($options['class']) || empty($options['class'])) {
								trigger_error('Please specify a valid class name to your result set into');
							} else {
								$return = $cache_data = $this->fetch_class($res, $options['class']);
								$i = 0;
								foreach ($cache_data as $row) {
									$res = array();
									foreach ($row as $key => $value) {
										if (!is_object($value)) {
											$res[$key] = $value;
										}
									}
									$cache_data[$i] = $res;
									$i++;
								}
							}
						} else if ($options['fetch'] == 'array') {
							$return = array();
							while ($row = $this->fetch_array($res)) {
								$return[] = $row;
							}
							$cache_data = $return;
						} else {
							trigger_error('Please specify a valid fetch method');
						}
					}
				}
			}

			$this->di->cache->set($query_cache_key, $cache_data);
		} else {
			if ($options['fetch'] == 'class') {
				$i = 0;
				$return = array();
				foreach ($cached_result as $row) {
					$return[$i] = new $options['class']();
					$class = $options['class'];
					if (!$this->di->get->class_exists($options['class'])) {
						$class = 'table';
					}
					if ($class != $options['class']) {
						$return[$i]->mysql_table_name = $options['class'];
					}
					$return[$i]->set_di($this->di);
					foreach ($row as $key => $value) {
						$return[$i]->{$key} = $value;
					}
					$i++;
				}
			} else {
				$return = $cached_result;
			}
		}

		if ($return == NULL) {
			return false;
		}
		return $return;
	}

	/**
	 * @param string $sql
	 * @param array  $prarms
	 * @param array  $tables
	 * @return int
	 */
	public function get_query_cache_key($sql, array $prarms = array(), array $tables = array()) {
		$query_key = $sql . '_' . implode('_', $prarms);
		$tot = count($tables);
		if ($tot > 0) {
			if ($dbrow = $this->query('SELECT last_mod FROM db_cache WHERE table IN(\'' . implode('\',\'', $tables) . '\') LIMIT ' . (int) $tot, array(), array('fetch' => 'array'))) {
				$namespace = '';
				foreach ($dbrow as $row) {
					$namespace .= $row['last_mod'];
				}

				return crc32($namespace . '_' . $query_key);
			}
		}

		$namespace = crc32(/*time()*/1);
		return crc32($namespace . '_' . $query_key);
	}

	/**
	 * @param string $sql
	 * @param array  $params
	 * @param array  $tables
	 */
	protected function do_log_query_benchmark($sql, array $params = array(), array $tables = array()) {
		if (strtolower(substr($sql, 0, 6)) == 'select') {
			if ($res = $this->query('EXPLAIN ' . $sql, $params, $tables, $benchmark = false, array(), array('fetch' => 'array'))) {
				$i = 0;
				$table_uses_insert_sqls = $table_uses_insert_params = array();
				$index_recommendation_insert_sqls = $index_recommendation_insert_params = array();
				foreach ($res as $row) { $i++;
					$table_uses_insert_params['table' . $i] = $row['table'];
					$table_uses_insert_sqls[] = '(:table' . $i . ', 1)';

					if (!empty($row['possible_keys']) && $row['possible_keys'] != $row['key']) {
						$index_recommendation_insert_params['table' . $i] = $row['table'];
						$index_recommendation_insert_params['recommendation' . $i] = $row['possible_keys'];
						$index_recommendation_insert_sqls[] = '(:table' . $i . ', :recommendation' . $i . ', 1)';
					}
				}

				if (!empty($table_uses_insert_sqls)) {
					$sql = 'INSERT DELAYED INTO `_mysql_table_uses` VALUES' . implode(',', $table_uses_insert_sqls) . ' ON DUPLICATE KEY UPDATE `uses`=`uses`+1';
					$this->query($sql, $table_uses_insert_params, array('fetch' => false, 'tables' => $tables, 'benchmark' => false));
				}

				if (!empty($index_recommendation_insert_sqls)) {
					$sql = 'INSERT DELAYED INTO `_mysql_table_index_recommendations` (`tbl`, `index_recommendation`, `count`) VALUES' . implode(',', $index_recommendation_insert_sqls) . ' ON DUPLICATE KEY UPDATE `count`=`count`+1';
					$this->query($sql, $index_recommendation_insert_params, array('fetch' => false, 'tables' => $tables, 'benchmark' => false));
				}
			}
		}
	}

	/**
	 * @param PDOStatement $res
	 * @return bool|int
	 */
	public function num(PDOStatement $res) {
		return $res->rowCount();
	}

	/**
	 * @param PDOStatement $res
	 * @return bool|mixed
	 */
	public function fetch_array(PDOStatement $res) {
		$res->setFetchMode(PDO::FETCH_ASSOC);
		return $res->fetch();
	}

	/**
	 * @param PDOStatement $res
	 * @return bool|mixed
	 */
	public function fetch_object(PDOStatement $res) {
		$res->setFetchMode(PDO::FETCH_LAZY);
		return $res->fetch();
	}

	/**
	 * @param PDOStatement $res
	 * @param string       $class_name
	 * @return bool|mixed
	 */
	public function fetch_class(PDOStatement$res, $class_name) {
		$class = $class_name;
		if (!$this->di->get->class_exists($class)) {
			$class = 'table';
		}
		$res->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $class);
		$responses = array();
		while ($resp = $res->fetch()) {
			if ($class != $class_name) {
				$resp->mysql_table_name = $class_name;
			}
			$resp->set_di($this->di);
			$responses[] = $resp;
		}

		return $responses;
	}

	/**
	 * @param PDOStatement $res
	 * @return bool
	 */
	public function get_last_insert_id(PDOStatement $res) {
		return $this->conn->lastInsertId($res);
	}

	/**
	 * @param $term
	 * @return string
	 */
	public function esc($term) {
		return addcslashes($term, "\\\000\n\r'\"\032%_");
	}

	/**
	 * @return bool
	 */
	public function close() {
		$this->conn = NULL;
		return true;
	}
}