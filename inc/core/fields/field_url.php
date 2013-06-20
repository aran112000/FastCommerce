<?
/**
 * Class field_url
 * TODO
 */
class field_url extends field_slug {

	/**
	 * @param string $label_title
	 * @return string
	 */
	public function get_html($label_title = '') {
		$html = $this->get_label($label_title);
		$html .= '<div class="controls">'."\n";
			$html .= '<div class="input-prepend">'."\n";
				$html .= '<span class="add-on"><i class="icon-globe"></i></span>'."\n";
				$html .= '<input id="' . $this->id . '" name="' . $this->id . '" type="url"' . (!empty($this->value) ? ' value="' . $this->value . '"' : '') . ($this->required ? ' required' : '') . ' class="input-large" />'."\n";
			$html .= '</div>'."\n";
		$html .= '</div>';

		return $html;
	}
}