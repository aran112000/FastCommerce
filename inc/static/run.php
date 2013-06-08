<?
/**
 * Class run
 */
final class run {

	/**
	 * @param $path
	 * @param $http_code
	 */
	public static function header_redir($path, $http_code) {
		self::http_status($http_code);
		header('Location: ' . $path, true);

		exit();
	}

	/**
	 * @param $http_code
	 */
	public static function http_status($http_code) {
		switch ($http_code) {
			case 200:
				$status_text = 'OK';
				break;
			case 201:
				$status_text = 'Created';
				break;
			case 202:
				$status_text = 'Accepted';
				break;
			case 301:
				$status_text = 'Moved Permanently';
				break;
			case 304:
				$status_text = 'Not Modified';
				break;
			case 403:
				$status_text = 'Forbidden';
				break;
			case 404:
				$status_text = 'Not Found';
				break;
			default:
				$status_text = 'OK';
		}
		header('HTTP/1.1 ' . $http_code . ' ' . $status_text, true, $http_code);
	}
}