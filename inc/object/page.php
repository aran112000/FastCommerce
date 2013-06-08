<?
/**
 * Class page
 */
final class page extends table {

	/**
	 * @return string
	 */
	public function get_url() {
		if (!empty($this->direct_link)) {
			return $this->direct_link;
		}
		return '/' . ($this->pid == 1 ? '' : $this->pid . '/' . $this->fn);
	}
}