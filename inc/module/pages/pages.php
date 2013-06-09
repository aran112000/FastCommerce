<?
/**
 * Class pages
 */
final class pages extends core_module {

	/**
	 * @param null $page
	 * @param null $di
	 */
	public function __construct($page, $di) {
		parent::__construct('page', $di);
	}

	/**
	 * @param $path_parts
	 * @param $path_count
	 * @return bool|string
	 */
	public function __controller($path_parts, $path_count) {
		if ($path_count > 2) {
			$this->di->run->header_redir('/' . $path_parts[0], 301);
		}

		if ($path_parts[0] == 404) {
			$this->di->run->http_status(404);
			return $this->get_view('404');
		}

		if ($path_count == 1 && empty($path_parts[0])) {
			$params = array('pid' => 1, 'fn' => '');
		} else {
			$params = array('pid' => (isset($path_parts[0]) ? $path_parts[0] : 0), 'fn' => (isset($path_parts[1]) ? $path_parts[1] : ''));
		}
		$params['direct_link'] = uri;
		if (!$this->current = $this->di->{$this->table}->do_retrieve(array(), array('where' => '(pid=:pid AND fn=:fn) OR (direct_link = :direct_link)', 'params' => $params, 'limit' => 1))) {
			$this->di->run->header_redir('/404', 404);
		}

		parent::__controller($path_parts, $path_count);

		return $this->get_view('default');
	}

	/**
	 * @param       $id
	 * @param array $options
	 * @return string
	 */
	public function get_nav($id, array $options = array()) {
		$html = '';
		$pages = $this->di->page->do_retrieve(array(), array($options));
		$pnum = count($pages);
		if ($pnum > 0) {
			$i = 0;
			$html .= '<nav id="' . $id . '">'."\n";
			$html .= '<ul>'."\n";
			foreach ($pages as $page) { $i++;
				$url = $page->get_url();
				$html .= '<li' . ($i == $pnum ? ' class="last"' : '') . '><a href="' . $url . '" title="' . $page->title . '"' . ($url == uri ? ' class="sel"' : '') . '><span>' . (!empty($page->nav_title) ? $page->nav_title : $page->title) . '</span></a></li>'."\n";
			}
			$html .= '</ul>'."\n";
			$html .= '</nav>'."\n";
		}

		return $html;
	}
}