<?
/**
 * Class cms_module
 */
final class cms_module extends table {

	/**
	 * @return string
	 */
	public function get_url() {
		if (!empty($this->direct_link)) {
			return $this->direct_link;
		}
		$page_path_prefix = $this->di->core->page_prefix;
		if (empty($page_path_prefix)) {
			$page_path_prefix = '/';
		}
		return $page_path_prefix . ($this->pid == 1 ? '' : $this->pid . '/' . $this->fn);
	}
}