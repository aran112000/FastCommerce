<?
/**
 * Class field_email
 */
class field_email extends field_string {

	/**
	 * @return bool
	 */
	public function is_valid() {
		$valid = parent::is_valid();
		if ($valid) {
			return filter_var($this->value, FILTER_VALIDATE_EMAIL);
		}

		return $valid;
	}
}