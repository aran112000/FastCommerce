<?
/**
 * Class field_bool
 * TODO
 */
class field_bool extends field {

	/**
	 * @param string $label_title
	 * @return string
	 */
	public function get_html($label_title = '') {
		$html = $this->get_label($label_title);
		$html .= '<div class="controls">'."\n";
			$html .= '<div class="input-switch" data-on="success" data-off="danger" data-on-label="<i class=\'icon-ok icon-white\'></i>" data-off-label="<i class=\'icon-remove\'></i>">'."\n";
				$html .= '<input id="' . $this->id . '" name="' . $this->id . '" value="1" type="checkbox"' . ($this->value ? ' checked' : '') . '>'."\n";
			$html .= '</div>'."\n";
		$html .= '</div>';

		return $html;
	}
}