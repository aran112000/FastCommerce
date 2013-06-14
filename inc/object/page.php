<?
/**
 * Class page
 */
final class page extends table {

	/**
	 * @return string
	 */
	public function get_url() {
		$page_path_prefix = $this->di->core->page_prefix;
		if (empty($page_path_prefix)) {
			$page_path_prefix = '/';
		}
		if (!empty($this->direct_link)) {
			return $page_path_prefix . ltrim($this->direct_link, '/');
		}
		return $page_path_prefix . ($this->pid == 1 ? '' : $this->pid . '/' . $this->fn);
	}
}