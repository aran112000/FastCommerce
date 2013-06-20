<?
/**
 * Class field_string
 */
class field_slug extends field {

	/**
	 *
	 */
	public function set_from_request() {
		parent::set_from_request();
		$this->value = $this->di->get->slug($this->value);
	}
}