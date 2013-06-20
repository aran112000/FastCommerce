<?
/**
 * Class form
 */
class form extends dependency {

	/**
	 * @var array
	 */
	public $classes = array('form-horizontal', 'form-box');

	/**
	 * @var string
	 */
	public $id;

	/**
	 * @var
	 */
	public $title;

	/**
	 *
	 */
	public function __construct() {
		$this->id = 'form_' . get_called_class();
	}

	/**
	 *
	 */
	public function get_html() {
		$html = '';
		if (!empty($this->fields)) {
			$html .= '<form action="#" method="post"' . $this->di->get->attributes(array('id' => $this->id, 'class' => $this->classes)) . ' enctype="multipart/form-data" novalidate>'."\n";
				if (!empty($this->title)) {
					$html .= '<h4 class="form-box-header">' . $this->title . '</h4>'."\n";
				}
				$html .= '<div class="form-box-content">'."\n";
					foreach ($this->fields as $field_title => $field) {
						$html .= '<div class="control-group">' . $field->get_html($field_title) . '</div>'."\n";
					}

					$html .= '<div class="form-actions">'."\n";
						$html .= '<input type="submit" class="btn btn-success" value="Save changes">'."\n";
					$html .= '</div>'."\n";
				$html .= '</div>'."\n";
			$html .= '</form>'."\n";
		}

		return $html;
	}

	/**
	 *
	 */
	public function is_valid() {

	}

	/**
	 *
	 */
	public function do_submit() {

	}
}