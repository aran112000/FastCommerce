<?php
/**
 * Class pages
 */
class pages extends core_module {

	/**
	 * @param null $page
	 */
	public function __init($page = NULL) {
		parent::__init('page');
	}

	/**
	 * @param $path_parts
	 * @param $path_count
	 * @return bool|string
	 */
	public function __controller(array $path_parts, $path_count) {
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
		$module_groups = $this->di->cms_module_group->do_retrieve(array(), array($options));
		$pnum = count($module_groups);
		if ($pnum > 0) {
			$i = 0;
			$html .= '<nav id="' . $id . '">'."\n";
			$html .= '<ul>'."\n";
			foreach ($module_groups as $module_group) { $i++;
				$html .= '<li' . ($i == $pnum ? ' class="last"' : '') . '>'."\n";
				$html .= '<a href="#" title="' . $module_group->title . '">' . (!empty($module_group->nav_title) ? $module_group->nav_title : $module_group->title) . '</a>'."\n";
				$modules = $this->di->cms_module->do_retrieve(array('table_name', 'title'), array('where' => 'mgid=:mgid', 'params' => array('mgid' => $module_group->mgid)));
				if (!empty($modules)) {
					$html .= '<ul>'."\n";
					foreach ($modules as $module) {
						$html .= '<li><a href="' . $this->di->core->page_prefix . 'module/' . $module->table_name . '">' . $module->title . '</a></li>'."\n";
					}
					$html .= '</ul>'."\n";
				}
				$html .= '</li>'."\n";
			}
			$html .= '</ul>'."\n";
			$html .= '</nav>'."\n";
		}

		return $html;
	}
}