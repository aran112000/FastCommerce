<?
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
			try {
				$host = $this->di->get->conf('db', 'host');
				$host = ($host == 'localhost' ? '127.0.0.1' : $host); // Avoid hostname lookup where possible
				$this->conn = new PDO('mysql:host=' . $host . ';dbname=' . $this->di->get->conf('db', 'db'), $this->di->get->conf('db', 'user'), $this->di->get->conf('db', 'pass'), array(
					PDO::ATTR_PERSISTENT => true
				));
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				return true;
			} catch (Exception $e) {
				trigger_error('MySQL connect error: ' . $e->getMessage());
			}
		}

		return false;
	}

	/**
	 * @param       $sql
	 * @param array $params
	 * @param bool  $benchmark
	 * @return bool|PDOStatement
	 */
	public function query($sql, array $params = array(), $benchmark = true) {
		if (!$this->benchmark) {
			$benchmark = false;
		}
		try {
			if ($benchmark) {
				$this->di->benchmark->start('mysql', $sql);
			}
			$res = $this->conn->prepare($sql);
			$res->execute($params);
			if ($benchmark) {
				$this->di->benchmark->stop('mysql', $sql);
				$this->do_log_query_benchmark($sql, $params);
			}
			return $res;
		} catch (Exception $e) {
			trigger_error('MySQL query error: ' . $e->getMessage() . ' - Query: ' . $sql);
		}

		return false;
	}


	/**
	 * @param string $sql
	 * @param array  $params
	 */
	protected function do_log_query_benchmark($sql, array $params = array()) {
		if (strtolower(substr($sql, 0, 6)) == 'select') {
			$res = $this->query('EXPLAIN ' . $sql, $params, $benchmark = false);
			if ($res && $this->num($res) > 0) {
				$i = 0;
				$table_uses_insert_sqls = $table_uses_insert_params = array();
				$index_recommendation_insert_sqls = $index_recommendation_insert_params = array();
				while ($row = $this->fetch_array($res)) { $i++;
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
					$this->query($sql, $table_uses_insert_params, $benchmark = false);
				}

				if (!empty($index_recommendation_insert_sqls)) {
					$sql = 'INSERT DELAYED INTO `_mysql_table_index_recommendations` (`tbl`, `index_recommendation`, `count`) VALUES' . implode(',', $index_recommendation_insert_sqls) . ' ON DUPLICATE KEY UPDATE `count`=`count`+1';
					$this->query($sql, $index_recommendation_insert_params, $benchmark = false);
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
		$res->setFetchMode(PDO::FETCH_OBJ);
		return $res->fetch();
	}

	/**
	 * @param PDOStatement $res
	 * @param              $class_name
	 * @return bool|mixed
	 */
	public function fetch_class(PDOStatement $res, $class_name) {
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