<?
/**
 * Class asset_manager
 *
 * This class is intended to be extended for those using CDNs
 */
class asset_manager extends dependency {

	/**
	 * @param $asset
	 * @return mixed
	 */
	public function get($asset) {
		return $asset;
	}
}