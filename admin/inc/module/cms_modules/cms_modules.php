<?
/**
 * Class cms_modules
 */
class cms_modules extends core_module {

	/**
	 * @var string
	 */
	public $fn_column = 'table_name';

	/**
	 * @return string
	 */
	public function get_module_list() {
		$html = '';
		$items = $this->di->{$this->current->table_name}->do_retrieve();
		if (!empty($items)) {
			$html = '<table id="module_item_list" class="table table-striped table-bordered table-hover">'."\n";
				$html .= '<thead>'."\n";
					$html .= '<tr>'."\n";
						$html .= '<th class="span1"></th>'."\n";
						$i = 0;
						foreach ($this->di->{$this->current->table_name}->fields as $field => $opt) { $i++;
							if ($field != 'live' && $field != 'deleted') {
								$html .= '<th>' . ($i == 1 ? '#' : $field) . '</th>'."\n";
							}
						}
					$html .= '</tr>'."\n";
				$html .= '</thead>'."\n";
				$html .= '<tbody>'."\n";
					foreach ($items as $item) {
						$html .= '<tr>'."\n";
							$html .= '<td class="span1">'."\n";
								$html .= '<div class="btn-group">'."\n";
									$html .= '<a href="javascript:void(0)" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>'."\n";
									$html .= '<a href="javascript:void(0)" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>'."\n";
								$html .= '</div>'."\n";
							$html .= '</td>'."\n";
							foreach ($this->di->{$this->current->table_name}->fields as $field => $opt) { $i++;
								if (isset($item->{$field})) {
									$html .= '<td><span>' . $item->{$field} . '</span></td>'."\n";
								}
							}
						$html .= '</tr>'."\n";
					}
				$html .= '</tbody>'."\n";
			$html .= '</table>'."\n";

			$this->di->core->inline_js['#module_item_list'] = '$(\'#module_item_list\').dataTable();';
		}

		return $html;
	}
}