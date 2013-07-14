<?php
/**
 * User: Aran
 * Date: 13/07/13
 * Time: 09:27
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */

class coreTest extends PHPUnit_Framework_TestCase {

	/**
	 *
	 */
	public function __construct() {
		$this->di = new di();
		$this->core = $this->di->load_class('core');
	}


	/**
	 * @test
	 * Tests ajax action handling
	 */
	public function test_init() {
		define('ajax', true);
		$this->assertNull(@$this->core->__init()); // Can't find a way to assert trigger_error()

		$_REQUEST['act'] = 'mock_pages';
		$_REQUEST['handler'] = 'ajax_test';
		$this->assertEquals('PHPUnit Test', $this->core->__init());
	}

	/**
	 * @test
	 */
	public function test_get_url_parts() {
		define('uri', '/test1/test2/test3/test4');
		$url_parts = $this->core->get_url_parts();

		$this->assertEquals(4, count($url_parts));
	}
}
