<?php
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

	public function do_add_to_cart() {
		$pid = (int) $_REQUEST['pid'];
		$qty = (int) $_REQUEST['qty'];

		if ($pid > 0 && $qty > 0) {
			$this->di->ajaxify->add_update_html('<p></p>');
		}
	}
}