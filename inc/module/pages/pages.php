<?
/**
 * Class pages
 */
final class pages extends core_module {

	/**
	 * @param null $page
	 */
	public function __construct($page) {
		parent::__construct('page');
	}

	/**
	 * @param $path_parts
	 * @param $path_count
	 * @return bool|string
	 */
	public function __controller($path_parts, $path_count) {
		if ($path_count > 2) {
			run::header_redir('/' . $path_parts[0], 301);
		}

		if ($path_parts[0] == 404) {
			run::http_status(404);
			return $this->get_view('404');
		}

		if ($path_count == 1 && empty($path_parts[0])) {
			$params = array('pid' => 1, 'fn' => '');
		} else {
			$params = array('pid' => $path_parts[0], 'fn' => $path_parts[1]);
		}
		if (!$this->current = $this->do_retrieve(array(), array('where' => 'pid=:pid AND fn=:fn', 'params' => $params, 'limit' => 1))) {
			run::header_redir('/404', 404);
		}

		parent::__controller($path_parts, $path_count);

		return $this->get_view('default');
	}

	public function get_nav($id, array $options = array()) {
		$html = '';
		if (!isset($this->di->page)) {
			$this->di->page = new page();
		}
		$pages = $this->di->page->do_retrieve(array(), array($options));
		if (!empty($pages)) {
			$html .= '<nav id="' . $id . '">'."\n";
			$html .= '<ul>'."\n";
			foreach ($pages as $page) {
				$html .= '<li><a href="' . $page->get_url() . '" title="' . $page->title . '"><span>' . (!empty($page->nav_title) ? $page->nav_title : $page->title) . '</span></a></li>'."\n";
			}
			$html .= '</ul>'."\n";
			$html .= '</nav>'."\n";
		}

		return $html;
	}
}