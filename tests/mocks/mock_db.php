<?php
/**
 * Class mock_db
 */
class mock_db extends db {

	const TRAVIS_CI_DB = 'ecom';
	const TRAVIS_CI_DB_HOST = '127.0.0.1';
	const TRAVIS_CI_DB_USERNAME = 'travis';
	const TRAVIS_CI_DB_PASSWORD = '';

	/**
	 * @return bool
	 */
	protected function connect() {
		if (!travis_ci) {
			return parent::connect();
		} else {
			if ($this->conn === NULL) {
				if ($this->conn = new PDO('mysql:host=' . self::TRAVIS_CI_DB_HOST . ';dbname=' . self::TRAVIS_CI_DB, self::TRAVIS_CI_DB_USERNAME, self::TRAVIS_CI_DB_PASSWORD, array(
					PDO::ATTR_PERSISTENT => true,
					PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
				))) {
					return true;
				}
			}
		}

		return false;
	}

	public function import_mysql_tables() {
		$mysql_dump = root . '/.sql/ecom.sql';
		if (is_readable($mysql_dump)) {
			$this->query(file_get_contents($mysql_dump));
		} else {
			trigger_error('Unable to access MySQL import data in: ' . $mysql_dump, E_ERROR);
		}
	}
}