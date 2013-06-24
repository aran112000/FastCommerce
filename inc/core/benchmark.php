<?
/**
 * Class benchmark
 */
class benchmark extends dependency {

	/**
	 * @var array
	 */
	protected $benchmarks = array();

	/**
	 * @param string $id
	 * @param string $group
	 * @return bool
	 */
	public function start($group, $id) {
		if (isset($this->benchmarks[$group]) && isset($this->benchmarks[$group][$id])) {
			//trigger_error('Benchmark ' . $group . '->' . $id . ' is already in use');
			return false;
		}

		if (!isset($this->benchmarks[$group])) {
			$this->benchmarks[$group] = $this->benchmarks[$group][$id] = array();
		} else if (!isset($this->benchmarks[$group][$id])) {
			$this->benchmarks[$group][$id] = array();
		}
		$this->benchmarks[$group][$id]['key'] = $id;
		$this->benchmarks[$group][$id]['start'] = $this->get_time();

		return true;
	}

	/**
	 * @param string $id
	 * @param string $group
	 * @return bool
	 */
	public function stop($group, $id) {
		$this->benchmarks[$group][$id]['stop'] = $this->get_time();
		$this->benchmarks[$group][$id]['time'] = ($this->benchmarks[$group][$id]['stop'] - $this->benchmarks[$group][$id]['start']);
	}

	/**
	 * @param $group
	 * @return mixed
	 */
	public function get_benchmark_formatted($group) {
		$data = (isset($this->benchmarks[$group]) ? $this->benchmarks[$group] : array());

		if (!empty($data)) {
			return $this->di->html->get_table(
				array(
					'columns' => array(
						'key' => ucwords($group) . ' Key',
						'start' => 'Start Time',
						'stop' => 'Completion Time',
						'time' => 'Execution Time'
					),
					'data' => $data
				)
			);
		}

		return '';
	}

	/**
	 * @param string $group
	 * @param string $id
	 * @return array
	 */
	public function get_benchmark_data($group, $id) {
		if (!empty($group)) {
			return $this->benchmarks[$group][$id];
		} else if ($id) {
			return $this->benchmarks[$id];
		}

		return $this->benchmarks;
	}

	/**
	 * @param bool $formatted
	 * @return float
	 */
	protected function get_time($formatted = false) {
		$time = microtime(true);
		if (!$formatted) {
			return $time;
		}

		return ($time / 1000000000) . 's'; // Time in seconds
	}
}