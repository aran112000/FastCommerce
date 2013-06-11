<?
/**
 * Class ajaxify
 */
class ajaxify extends dependency {

	/**
	 * @var array
	 */
	private $payload = array();

	/**
	 * @param $html
	 * @return bool
	 */
	public function add_update_html($html) {
		$this->payload['add_html'][$html] = $html;

		return true;
	}

	/**
	 * @param $html
	 * @return bool
	 */
	public function add_inject_html($html) {
		$this->payload['inject_html'][$html] = $html;

		return true;
	}

	/**
	 * @param $dom_selector
	 */
	public function delete_html($dom_selector) {
		$this->payload['delete_node'][$dom_selector] = $dom_selector;
	}

	/**
	 * @param $javascript
	 * @return bool
	 */
	public function add_script($javascript) {
		$this->payload['script'][$javascript] = $javascript;

		return true;
	}

	/**
	 *
	 */
	public function do_serve() {
		if (!empty($this->payload)) {
			die(json_encode($this->payload));
		}
	}
}