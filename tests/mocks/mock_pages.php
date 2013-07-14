<?php
/**
 * Class mock_pages
 */
class mock_pages extends pages {
	/**
	 * @test
	 * @return string
	 *
	 * Used from PHPUnit for testing ajax action handling
	 */
	public function ajax_test() {
		return 'PHPUnit Test';
	}
}