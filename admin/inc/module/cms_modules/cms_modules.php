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
	 * @param array $path_parts
	 * @param int   $path_count
	 * @return bool|string
	 */
	public function __controller(array $path_parts, $path_count) {
		if ($path_count >= 2) {
			if (!isset($this->module) || empty($this->module)) {
				$table_name = (isset($path_parts[$this->fn_path_number]) ? $path_parts[$this->fn_path_number] : '');
				if (!empty($table_name)) {
					if (!$this->module = $this->di->{$this->table}->do_retrieve(array(), array('where' => 'table_name=:table_name', 'params' => array('table_name' => $table_name), 'limit' => 1))) {
						trigger_error('CMS Module not found');
						return false;
					}
				}
			}
			if ($path_count == 2) {
				return $this->get_view('list');
			}
		}
		if ($path_count == 4 && $path_parts[2] == 'edit') {
			if (is_numeric($path_parts[3]) && $path_parts[3] > 0) {
				$item_id = (int) $path_parts[3];
				if (!isset($this->current) || empty($this->current)) {
					if (!$this->current = $this->di->{$this->module->table_name}->do_retrieve(array(), array('where' => $this->module->primary_key . '=:id', 'params' => array('id' => $item_id), 'limit' => 1))) {
						trigger_error('No record found for this item item ID');
					}
				}
				return $this->get_view('edit');
			} else {
				trigger_error('Please supply a valid module item ID');
			}
		}

		return false;
	}

	/**
	 * @return string
	 */
	public function get_module_list() {
		$html = '';
		$items = $this->di->{$this->module->table_name}->do_retrieve();
		if (!empty($items)) {
			$html = '<table id="module_item_list" class="table table-striped table-bordered table-hover">'."\n";
				$html .= '<thead>'."\n";
					$html .= '<tr>'."\n";
						$html .= '<th class="span1"></th>'."\n";
						$i = 0;
						foreach ($this->di->{$this->module->table_name}->fields as $field => $opt) { $i++;
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
									$html .= '<a href="' . $this->di->core->page_prefix . 'module/' . $this->module->table_name . '/edit/' . $item->{$this->module->primary_key} . '" data-toggle="tooltip" title="Edit" class="btn btn-mini btn-success"><i class="icon-pencil"></i></a>'."\n";
									$html .= '<a href="#" data-toggle="tooltip" title="Delete" class="btn btn-mini btn-danger"><i class="icon-remove"></i></a>'."\n";
								$html .= '</div>'."\n";
							$html .= '</td>'."\n";
							foreach ($this->di->{$this->module->table_name}->fields as $field => $opt) { $i++;
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

	/**
	 * @return mixed
	 */
	public function get_module_form() {
		$this->di->form->fields = $this->get_module_form_fields();
		$this->di->form->title = 'Edit ' . $this->di->get->singular($this->module->title) . ': ' . $this->current->title;
		return $this->di->form->get_html();
	}

	/**
	 * @return array
	 */
	protected function get_module_form_fields() {
		$form_fields = array();
		$fields = $this->di->{'cms_field_' . $this->module->table_name}->do_retrieve(array(), array('order_by' => 'position'));
		if (!empty($fields)) {
			foreach ($fields as $field) {
				$field_type = 'field_' . $field->field_type;
				$form_fields[$field->title] = new $field_type($field->field);
			}
		}

		return $form_fields;
	}
}