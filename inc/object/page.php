<?
/**
 * Class page
 */
final class page extends table {

	/**
	 * @return string
	 */
	public function get_url() {
		return '/' . ($this->pid == 1 ? '' : $this->pid . '/' . $this->fn);
	}
}