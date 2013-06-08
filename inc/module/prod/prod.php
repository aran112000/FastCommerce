<?
final class prod extends table {
	public function __construct() {
		parent::__construct();

		echo '<p><pre>' . print_r($this->fields, true) . '</pre></p>'."\n";
	}
}