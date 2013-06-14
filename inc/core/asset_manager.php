<?
/**
 * Class asset_manager
 *
 * This class is intended to be extended for those using CDNs
 */
class asset_manager extends dependency {

	/**
	 * @var string
	 */
	private $module_dir = '/inc/module/';

	/**
	 * @var string
	 */
	private $object_dir = '/inc/object/';

	/**
	 * @param $asset
	 * @return mixed
	 */
	public function get($asset) {
		return $asset;
	}

	/**
	 * @param $path
	 * @return bool
	 */
	public function set_module_dir($path) {
		$path = str_replace(root, '', $path);
		if (is_readable(root . $path)) {
			$this->module_dir = rtrim($path, '/');
			return true;
		}

		trigger_error('Please ensure the module path you\'ve specified is both valid & readable');
		return false;
	}

	/**
	 * @return string
	 */
	public function get_module_dir() {
		return $this->module_dir;
	}

	/**
	 * @param $path
	 * @return bool
	 */
	public function set_object_dir($path) {
		$path = str_replace(root, '', $path);
		if (is_readable(root . $path)) {
			$this->object_dir = rtrim($path, '/');
			return true;
		}

		trigger_error('Please ensure the object path you\'ve specified is both valid & readable');
		return false;
	}

	/**
	 * @return string
	 */
	public function get_object_dir() {
		return $this->object_dir;
	}
}