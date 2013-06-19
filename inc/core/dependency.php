<?
/**
 * Class dependency
 */
class dependency {

	/**
	 * @var di
	 */
	public $di;

	/**
	 * @param $di
	 */
	public function set_di(di &$di) {
		$this->di = $di;
		//if ($this->di->get->method_exists($this, '__init')) {
		if (method_exists($this, '__init')) {
			$this->table = $this->di->get->singular(get_called_class());
			$this->__init();
		}
	}
}