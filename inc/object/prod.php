<?
/**
 * Class prod
 */
final class prod extends table {

	/**
	 * @return string
	 */
	public function get_url() {
		return '/prod/' . $this->fn;
	}
}