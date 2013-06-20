<?
/**
 * Class field
 */
class field extends dependency {

	/**
	 * @var string
	 */
	protected $id;

	/**
	 * @var
	 */
	public $value;

	/**
	 * @var bool
	 */
	public $required = true;

	/**
	 * @var array
	 */
	public $errors = array();

	/**
	 * @param string $id
	 */
	public function __construct($id) {
		$this->id = get_called_class() . '_' . $id;
		$this->label = ucfirst(trim(str_replace('_', ' ', $id)));
	}

	/**
	 * @param string $label_title
	 * @return string
	 */
	public function get_label($label_title = '') {
		$label = (!empty($label_title) ? $label_title : $this->label);
		return '<label for="' . $this->id . '" class="control-label">' . $label . '</label>'."\n";
	}

	/**
	 * @param string $label_title
	 * @return string
	 */
	public function get_html($label_title = '') {
		$html = $this->get_label($label_title);
		$html .= '<div class="controls">'."\n";
			$html .= '<input id="' . $this->id . '" name="' . $this->id . '" type="text"' . (!empty($this->value) ? ' value="' . $this->value . '"' : '') . ($this->required ? ' required' : '') . ' />'."\n";
		$html .= '</div>';

		return $html;
	}

	/**
	 *
	 */
	public function is_valid() {
		$this->set_from_request();
		if ($this->required && empty($this->value)) {
			$this->errors[$this->id] = 'is a required field';
			return false;
		}

		return true;
	}

	/**
	 *
	 */
	public function set_from_request() {
		$this->value = filter_var((isset($_REQUEST['field_string_' . $this->id]) ?: ''), FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	}

	/**
	 * @return bool
	 */
	public function get_error() {
		$html = '';
		foreach ($this->errors as $error) {
			$html .= '<li><strong>' . $this->label . '</strong> ' . $error . '</li>';
		}

		return false;
	}
}