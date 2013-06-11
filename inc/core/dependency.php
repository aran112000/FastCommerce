<?
/**
 * Class dependency
 */
class dependency {

	/**
	 * di @var
	 */
	protected $di;

	/**
	 * @param $di
	 */
	public function set_di(di &$di) {
		$this->di = $di;
		//if ($this->di->get->method_exists($this, '__init')) {
		if (method_exists($this, '__init')) {
			$this->__init();
		}
	}
}