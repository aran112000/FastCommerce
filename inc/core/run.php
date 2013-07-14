<?php
/**
 * Class run
 */
final class run extends dependency {

	/**
	 * @param $path
	 * @param $http_code
	 */
	public function header_redir($path, $http_code) {
		$this->http_status($http_code);
		header('Location: ' . $path, true);

		exit();
	}

	/**
	 * @param string $start_dir
	 * @param string $match_file_pattern
	 * @param bool   $recursive
	 * @return array
	 */
	public static function glob_pattern($start_dir, $match_file_pattern, $recursive = true) {
		$matches = array();
		$start_dir = rtrim(root . str_replace(root, '', $start_dir), '/') . '/';

		if ($recursive) {
			foreach (glob($start_dir . '*', GLOB_ONLYDIR) as $dir) {
				$matches = array_merge($matches, self::glob_pattern($dir, $match_file_pattern, $recursive));
			}
		}

		foreach (glob($start_dir . $match_file_pattern, GLOB_NOSORT) as $file) {
			$matches[] = $file;
		}

		return $matches;
	}

	/**
	 * @param       $start_dir
	 * @param array $match_file_extensions
	 * @param bool  $recursive
	 * @return array
	 */
	public static function glob_extensions($start_dir, array $match_file_extensions, $recursive = true) {
		$matches = array();
		$start_dir = rtrim(root . str_replace(root, '', $start_dir), '/') . '/';

		if ($recursive) {
			foreach (glob($start_dir . '*', GLOB_ONLYDIR) as $dir) {
				$matches = array_merge($matches, self::glob_extensions($dir, $match_file_extensions, $recursive));
			}
		}

		foreach (glob($start_dir . '*.{' . implode(',', $match_file_extensions) . '}', GLOB_BRACE) as $file) {
			$matches[] = $file;
		}

		return $matches;
	}

	/**
	 * @param $http_code
	 */
	public function http_status($http_code) {
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