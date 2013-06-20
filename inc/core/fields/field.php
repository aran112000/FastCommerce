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
	protected $value;

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
		$this->set_from_request();
	}


	/**
	 * @param string $label_title
	 * @return string
	 */
	public function get_html($label_title = '') {
		$label = (!empty($label_title) ? $label_title : $this->label);
		$html = '<label for="' . $this->id . '" class="control-label">' . $label . '</label>'."\n";
		$html .= '<div class="controls"><input id="' . $this->id . '" name="' . $this->id . '" type="text" /></div>';

		return $html;
	}

	/**
	 *
	 */
	public function is_valid() {
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