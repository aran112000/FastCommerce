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

		if (!empty($params)) {
			if (!self::$conn->prepare($sql)) {
				trigger_error(self::$conn->errorInfo());
			}
			return self::$conn->execute($params);
		} else {
			return self::$conn->query($sql);
		}
	}

	/**
	 * @param PDOStatement $res
	 * @return bool|int
	 */
	public static function num(PDOStatement $res) {
		if ($res) {
			return $res->rowCount();
		}

		return false;
	}

	/**
	 * @param PDOStatement $res
	 * @return bool|mixed
	 */
	public static function fetch_array(PDOStatement $res) {
		if ($res) {
			$res->setFetchMode(PDO::FETCH_ASSOC);
			return $res->fetch();
		}

		return false;
	}

	/**
	 * @param PDOStatement $res
	 * @return bool|mixed
	 */
	public static function fetch_object(PDOStatement $res) {
		if ($res) {
			$res->setFetchMode(PDO::FETCH_OBJ);
			return $res->fetch();
		}

		return false;
	}

	/**
	 * @param PDOStatement $res
	 * @param              $class_name
	 * @return bool|mixed
	 */
	public static function fetch_class(PDOStatement $res, $class_name) {
		if ($res) {
			$res->setFetchMode(PDO::FETCH_CLASS, $class_name);
			return $res->fetch();
		}

		return false;
	}

	/**
	 * @param PDOStatement $res
	 * @return bool
	 */
	public static function get_last_insert_id(PDOStatement $res) {
		if ($res) {
			return $res->lastInsertId();
		}

		return false;
	}

	/**
	 * @return bool
	 */
	public static function close() {
		self::$conn = NULL;
		return true;
	}
}