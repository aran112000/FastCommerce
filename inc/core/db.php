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
	 */
	public function __init() {
		$this->connect();
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
			if (!empty($params)) {
				$res = $this->conn->prepare($sql);
				if ($res->execute($params)) {
					return $res;
				}
			} else {
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
		//return $resp = $res->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $class_name);
		$res->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, $class_name);
		$responses = array();
		while ($resp = $res->fetch()) {
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