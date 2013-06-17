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
		$items = $this->di->{$this->current->table_name}->do_retrieve();
		if (!empty($items)) {
			$html = '<table id="example-datatables" class="table table-striped table-bordered table-hover">'."\n";
			$html .= '<thead>'."\n";
				$html .= '<tr>'."\n";
					$html .= '<th class="span1"></th>'."\n";
					$html .= '<th class="span1 hidden-phone">#</th>'."\n";
					$html .= '<th>Username</th>'."\n";
					$html .= '<th>Email</th>'."\n";
					$html .= '<th>Status</th>'."\n";
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
						$html .= '<td class="span1 hidden-phone">' . $item->{$this->current->primary_key} . '</td>'."\n";
						$html .= '<td><a href="javascript:void(0)">' . $item->title . '</a></td>'."\n";
						$html .= '<td class="hidden-phone hidden-tablet">user1@example.com</td>'."\n";
						$html .= '<td><span class="label label-important">Unapproved</span></td>'."\n";
					$html .= '</tr>'."\n";
				}
			$html .= '</tbody>'."\n";
		$html .= '</table>'."\n";
		}

		return $html;
	}
}