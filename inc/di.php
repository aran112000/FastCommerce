<?
final class di {

	public function __get($name) {
		if (isset(di_container::$registrants[$name])) {
			return di_container::$registrants[$name];
		}

		throw new Exception($name . ' not set, please check isset() before attempting to fetch');
	}

	public function __set($name, $value) {
		di_container::$registrants[$name] = $value;
	}

	public function __isset($name) {
		return isset(di_container::$registrants[$name]);
	}

	public function __unset($name) {
		if (isset($this->$name)) {
			unset(di_container::$registrants[$name]);
		}
	}
}