<?
/**
 * Class cat
 */
final class cat extends table {

	/**
	 * @return string
	 */
	public function get_url() {
		return '/cat/' . $this->fn;
	}
}