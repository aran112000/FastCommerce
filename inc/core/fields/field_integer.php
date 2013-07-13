<?php
/**
 * Class field_integer
 * TODO
 */
class field_integer extends field {

	/**
	 * @param string $label_title
	 * @return string
	 */
	public function get_html($label_title = '') {
		$html = $this->get_label($label_title);
		$html .= '<div class="controls">'."\n";
			$html .= '<input id="' . $this->id . '" name="' . $this->id . '" type="text"' . (!empty($this->value) ? ' value="' . $this->value . '"' : '') . ($this->required ? ' required' : '') . ' class="input-mini" />'."\n";
		$html .= '</div>';

		return $html;
	}
}