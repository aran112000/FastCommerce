<?
final class db {
	public static $conn = NULL;

	private static function connect() {
		if (self::$conn === NULL) {
			try {
				$host = get::conf('db', 'host');
				$host = ($host == 'localhost' ? '127.0.0.1' : $host);
				self::$conn = new PDO('mysql:host=' . $host . ';dbname=' . get::conf('db', 'db'), get::conf('db', 'user'), get::conf('db', 'pass'), array(
					PDO::ATTR_PERSISTENT => true
				));
				self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (Exception $e) {
				trigger_error('MySQL connect error: ' . $e->getMessage());
			}
		}
	}

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

		return false;
	}

	public static function num(PDOStatement $res) {
		if ($res) {
			return $res->rowCount();
		}

		return false;
	}

	public static function fetch_array(PDOStatement $res) {
		if ($res) {
			$res->setFetchMode(PDO::FETCH_ASSOC);
			return $res->fetch();
		}

		return false;
	}

	public static function fetch_object(PDOStatement $res) {
		if ($res) {
			$res->setFetchMode(PDO::FETCH_OBJ);
			return $res->fetch();
		}

		return false;
	}

	public static function fetch_class(PDOStatement $res, $class_name) {
		if ($res) {
			$res->setFetchMode(PDO::FETCH_CLASS, $class_name);
			return $res->fetch();
		}

		return false;
	}

	public static function get_last_insert_id(PDOStatement $res) {
		if ($res) {
			return $res->lastInsertId();
		}

		return false;
	}

	public static function close() {
		self::$conn = NULL;
	}
}