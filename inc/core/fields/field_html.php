<?php
/**
 * Class field_html
 * TODO
 */
class field_html extends field {

	/**
	 * @param string $label_title
	 * @return string
	 */
	public function get_html($label_title = '') {
		$html = $this->get_label($label_title);
		$html .= '<div class="controls">'."\n";
			$html .= '<textarea id="' . $this->id . '" name="' . $this->id . '" class="textarea-editor textarea-large" rows="10">' . (!empty($this->value) ? $this->value : '') . '</textarea>'."\n";
		$html .= '</div>';

		return $html;
	}
}