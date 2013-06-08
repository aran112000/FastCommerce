<?
/**
 * Class db
 */
final class db {
	/**
	 * @var PDO null
	 */
	public static $conn = NULL;

	/**
	 * @return bool
	 */
	private static function connect() {
		if (self::$conn === NULL) {
			try {
				$host = get::conf('db', 'host');
				$host = ($host == 'localhost' ? '127.0.0.1' : $host);
				self::$conn = new PDO('mysql:host=' . $host . ';dbname=' . get::conf('db', 'db'), get::conf('db', 'user'), get::conf('db', 'pass'), array(
					PDO::ATTR_PERSISTENT => true
				));
				self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
	public static function query($sql, array $params = array()) {
		if (self::$conn === NULL) {
			self::connect();
		}

		try {
			if (!empty($params)) {
				$res = self::$conn->prepare($sql);
				if ($res->execute($params)) {
					return $res;
				}
			} else {
				return self::$conn->query($sql);
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
	public static function num(PDOStatement $res) {
		return $res->rowCount();
	}

	/**
	 * @param PDOStatement $res
	 * @return bool|mixed
	 */
	public static function fetch_array(PDOStatement $res) {
		$res->setFetchMode(PDO::FETCH_ASSOC);
		return $res->fetch();
	}

	/**
	 * @param PDOStatement $res
	 * @return bool|mixed
	 */
	public static function fetch_object(PDOStatement $res) {
		$res->setFetchMode(PDO::FETCH_OBJ);
		return $res->fetch();
	}

	/**
	 * @param PDOStatement $res
	 * @param              $class_name
	 * @return bool|mixed
	 */
	public static function fetch_class(PDOStatement $res, $class_name) {
		$res->setFetchMode(PDO::FETCH_CLASS, $class_name);
		return $res->fetch();
	}

	/**
	 * @param PDOStatement $res
	 * @return bool
	 */
	public static function get_last_insert_id(PDOStatement $res) {
		return self::$conn->lastInsertId($res);
	}

	/**
	 * @param $term
	 * @return string
	 */
	public static function esc($term) {
		return addcslashes($term, "\\\000\n\r'\"\032%_");
	}

	/**
	 * @return bool
	 */
	public static function close() {
		self::$conn = NULL;
		return true;
	}
}