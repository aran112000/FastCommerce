<?
/**
 * Class db
 */
final class db extends dependency {
	/**
	 * @var PDO null
	 */
	public $conn = NULL;
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
				$host = ($host == 'localhost' ? '127.0.0.1' : $host);
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
	 * @return bool
	 */
	public function query($sql, array $params = array()) {
		try {
			if ($this->benchmark) {
				$this->di->benchmark->start('mysql', $sql);
			}
			if (!empty($params)) {
				$res = $this->conn->prepare($sql);
				if ($res->execute($params)) {
					if ($this->benchmark) {
						$this->di->benchmark->stop('mysql', $sql);
					}
					return $res;
				}
			} else {
				if ($this->benchmark) {
					$this->di->benchmark->stop('mysql', $sql);
				}
				return $this->conn->query($sql);
			}
		} catch (Exception $e) {
			trigger_error('MySQL query error: ' . $e->getMessage() . ' - Query: ' . $sql);
		}

		return false;
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