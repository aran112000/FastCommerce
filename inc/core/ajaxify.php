<?php
/**
 * Class ajaxify
 */
class ajaxify extends dependency {

	/**
	 * @var array
	 */
	private $payload = array();

	/**
	 * @param $selector
	 * @param $html
	 */
	public function do_update($selector, $html) {
		$this->payload['update'][$selector] = $html;
	}

	/**
	 * @param $selector
	 * @param $html
	 */
	public function do_append($selector, $html) {
		$this->payload['append'][$selector] = $html;
	}

	/**
	 * @param $selector
	 * @param $html
	 */
	public function do_prepend($selector, $html) {
		$this->payload['prepend'][$selector] = $html;
	}

	/**
	 * @param $markup
	 */
	public function do_inject($markup) {
		$this->payload['inject'][] = $markup;
	}

	/**
	 * @param $dom_selector
	 */
	public function do_delete($dom_selector) {
		$this->payload['delete'][] = $dom_selector;
	}

	/**
	 * @param $javascript
	 */
	public function do_inject_script($javascript) {
		$this->payload['script'][] = $javascript;
	}

	/**
	 *
	 */
	public function __destruct() {
		if (defined('ajax') && ajax && !empty($this->payload)) {
			if (!empty($this->di->core->inline_js)) {
				$this->payload['script'] = array_merge((isset($this->payload['script']) ? $this->payload['script'] : array()), $this->di->core->inline_js);
			}
			die(json_encode($this->payload));
		}
	}
}