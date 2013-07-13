<?php
/**
 * Class field_price_vat
 * TODO
 */
class field_price_vat extends field {

	/**
	 * @param string $label_title
	 * @return string
	 */
	public function get_html($label_title = '') {
		$html = $this->get_label($label_title);
		$html .= '<div class="controls">'."\n";
			$html .= '<div class="input-prepend">'."\n";
				$html .= '<span class="add-on">&#163;</span>'."\n"; // TODO - Multi-currency
				$html .= '<input type="text" id="' . $this->id . '" name="' . $this->id . '" class="input-small"' . (!empty($this->value) ? ' value="' . round($this->value, 2) . '"' : '') . ' />'."\n";
			$html .= '</div>'."\n";
		$html .= '</div>';

		return $html;
	}
}