<?php
/**
 * Class categories
 */
final class categories extends core_module {

	/**
	 * @param null $table
	 */
	public function __init($table = NULL) {
		parent::__init('cat');
	}

	/**
	 * @param $path_parts
	 * @param $path_count
	 *
	 * @return bool|string
	 */
	public function __controller(array $path_parts, $path_count) {
		if ($path_count == 1) {
			$this->di->pages->__controller($path_parts, $path_count);
			$this->current = $this->di->pages->current;

			return $this->get_view('all_categories');
		}

		$this->set_current((isset($path_parts[$this->fn_path_number]) ? $path_parts[$this->fn_path_number] : ''));

		return parent::__controller($path_parts, $path_count);
	}

	/**
	 * @param int    $parent_cid
	 * @param string $class
	 * @return string
	 */
	public function get_list($parent_cid = 0, $class = 'list') {
		$html = '';
		$cats = $this->di->cat->do_retrieve(array(), array('where' => 'parent_cid=:parent_cid', 'params' => array('parent_cid' => $parent_cid)));
		if (!empty($cats)) {
			$html .= '<ul id="cat" class="' . $class . '">'."\n";
			foreach ($cats as $cat) {
				$html .= '<li>'."\n";
					$html .= '<a href="' . $cat->get_url() . '" title="' . $cat->title . '">'."\n";
						$html .= '<span class="padded_img"><img src="http://placehold.it/230x290" alt="' . $cat->title . '" width="230" height="290" /></span>'."\n";
						$html .= '<strong class="title">' . $cat->title . '</strong>'."\n";
					$html .= '</a>'."\n";
				$html .= '</li>'."\n";
			}
			$html .= '</ul>'."\n";
		}

		return $html;
	}
}