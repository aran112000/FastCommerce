<?php
/**
 * Class html
 */
class html extends dependency {

	/**
	 * @param array $options
	 * @return string
	 */
	public function get_table(array $options) {
		if (isset($options['columns']) && isset($options['data'])) {
			$html = '<table' . (isset($options['id']) ? $this->di->get->attribute('id', $options['id']) : '') . (isset($options['class']) ? $this->di->get->attribute('class', $options['class']) : '') . '>';
			$html .= '<thead><tr>';
			foreach ($options['columns'] as $key => $column) {
				$html .= '<th class="' . $key . '">' . $column . '</th>';
			}
			$html .= '</tr></thead>';
			$html .= '<tbody>'."\n";
			foreach ($options['data'] as $data) {
				$html .= '<tr>'."\n";
				foreach ($options['columns'] as $key => $column) {
					$value = $data[$key];
					if (is_float($value)) {
						if ($value < 5) {
							$value = number_format($value, 7, '.', '');
						} else {
							$value = round($value, 2);
						}
					}
					$html .= '<td class="' . $key . '">' . $value . '</td>'."\n";
				}
				$html .= '</tr>'."\n";
			}
			$html .= '</tbody>'."\n";
			$html .= '</table>';

			return $html;
		}

		trigger_error('Please supply a valid array containing both columns & data');
		return '';
	}

	/**
	 * @param array $data
	 * @param array $opts
	 * @return string
	 */
	public function get_list(array $data, array $opts = array()) {
		$tot = count($data);
		if ($tot > 0) {
			$i = 0;
			$row_cnt = 0;
			$html = '<ul' . (isset($opts['attr']) ? $this->di->get->attributes($opts['attr']) : '') . '>';
			foreach ($data as $class => $row) { $i++; $row_cnt++;
				$classes = array();
				if (!is_numeric($class)) $classes[] = $class;
				if ($i == 1) $classes[] = 'first';
				if ($tot == $i) $classes[] = 'last';
				if (isset($opts['cols']) && $row_cnt == $opts['cols']) {
					$classes[] = 'end';
					$row_cnt = 0;
				}

				$html .= "\t".'<li' . $this->di->get->attribute('class', $classes) . '>'."\n";
				$html .= "\t\t".$row."\n";
				$html .= "\t".'</li>'."\n";
			}
			$html .= '</ul>'."\n";

			return $html;
		}

		return '';
	}
}