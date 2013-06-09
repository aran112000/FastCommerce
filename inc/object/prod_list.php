<?
/**
 * Class prod_list
 */
final class prod_list {

	/**
	 * Construct
	 */
	public function __construct() {
		$this->di = new di();
	}

	/**
	 * @param array $options
	 * @return bool
	 */
	public function get_list(array $options) {
		$prods = $this->di->prod->do_retrieve(array(), $options);
		if (!empty($prods)) {
			return $prods;
		}

		return false;
	}

	public function get_list_from_cat($cid) {
		return $this->get_list(
			array(
				'join' => array(
					'prod_link_cat' => 'prod_link_cat.pid = prod.pid',
					'cat' => 'cat.cid = prod_link_cat.link_cid AND cat.cid=:cid AND cat.live=:live AND cat.deleted=:deleted',
				),
				'order' => 'prod_link_cat.position DESC',
				'params' => array(
					'cid' => (int) $cid
				)
			)
		);
	}
}