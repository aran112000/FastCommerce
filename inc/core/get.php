<?
/**
 * Class get
 */
final class get extends dependency {

	/**
	 * @var array
	 */
	private $conf_file = array();

	/**
	 * @var array
	 */
	private $fetched_settings = array();

	/**
	 * @var array
	 */
	private $method_exists_cache = array();

	/**
	 * @var array
	 */
	private $class_exists_cache = array();

	/**
	 * @param string $block
	 * @param string $key
	 * @param string $fallback_value
	 * @return string
	 */
	public function conf($block, $key = '', $fallback_value = '') {
		if (empty($this->conf_file)) {
			$this->conf_file = parse_ini_file(root . '/.settings/default.ini', true, INI_SCANNER_RAW);
		}

		if (!empty($key)) {
			if (isset($this->conf_file[$block][$key])) {
				return $this->conf_file[$block][$key];
			}
		} else {
			if (isset($this->conf_file[$block])) {
				return $this->conf_file[$block];
			}
		}

		return $fallback_value;
	}

	/**
	 * @param string $key
	 * @param string $fallback_value
	 * @return string
	 */
	public function setting($key, $fallback_value = '') {
		if (empty($this->fetched_settings)) {
			$sres = $this->di->db->query('SELECT `key`, `value` FROM setting');
			if ($this->di->db->num($sres) > 0) {
				while ($srow = $this->di->db->fetch_object($sres)) {
					$this->fetched_settings[$srow->key] = $srow->value;
				}
			}
		}

		if (isset($this->fetched_settings[$key])) {
			return $this->fetched_settings[$key];
		}

		return trim($fallback_value);
	}

	/**
	 * @param $object
	 * @param $method_name
	 *
	 * @return mixed
	 */
	public function method_exists($object, $method_name) {
		$class_name = get_class($object);
		if (!isset($this->method_exists_cache[$class_name][$method_name])) {
			$this->method_exists_cache[$class_name][$method_name] = (method_exists($object, $method_name));
		}

		return $this->method_exists_cache[$class_name][$method_name];
	}

	/**
	 * @param $class_name
	 *
	 * @return mixed
	 */
	public function class_exists($class_name) {
		if (!isset($this->class_exists_cache[$class_name])) {
			$this->class_exists_cache[$class_name] = (class_exists($class_name));
		}

		return $this->class_exists_cache[$class_name];
	}

	/**
	 * @var array
	 */
	private $grammar_plural = array(
        '/(quiz)$/i'               => "$1zes",
        '/^(ox)$/i'                => "$1en",
        '/([m|l])ouse$/i'          => "$1ice",
        '/(matr|vert|ind)ix|ex$/i' => "$1ices",
        '/(x|ch|ss|sh)$/i'         => "$1es",
        '/([^aeiouy]|qu)y$/i'      => "$1ies",
        '/(hive)$/i'               => "$1s",
        '/(?:([^f])fe|([lr])f)$/i' => "$1$2ves",
        '/(shea|lea|loa|thie)f$/i' => "$1ves",
        '/sis$/i'                  => "ses",
        '/([ti])um$/i'             => "$1a",
        '/(tomat|potat|ech|her|vet)o$/i'=> "$1oes",
        '/(bu)s$/i'                => "$1ses",
        '/(alias)$/i'              => "$1es",
        '/(octop)us$/i'            => "$1i",
        '/(ax|test)is$/i'          => "$1es",
        '/(us)$/i'                 => "$1es",
        '/s$/i'                    => "s",
        '/$/'                      => "s"
    );

	/**
	 * @var array
	 */
	private $grammar_singular = array(
		'/(quiz)zes$/i'             => "$1",
		'/(matr)ices$/i'            => "$1ix",
		'/(vert|ind)ices$/i'        => "$1ex",
		'/^(ox)en$/i'               => "$1",
		'/(alias)es$/i'             => "$1",
		'/(octop|vir)i$/i'          => "$1us",
		'/(cris|ax|test)es$/i'      => "$1is",
		'/(shoe)s$/i'               => "$1",
		'/(o)es$/i'                 => "$1",
		'/(bus)es$/i'               => "$1",
		'/([m|l])ice$/i'            => "$1ouse",
		'/(x|ch|ss|sh)es$/i'        => "$1",
		'/(m)ovies$/i'              => "$1ovie",
		'/(s)eries$/i'              => "$1eries",
		'/([^aeiouy]|qu)ies$/i'     => "$1y",
		'/([lr])ves$/i'             => "$1f",
		'/(tive)s$/i'               => "$1",
		'/(hive)s$/i'               => "$1",
		'/(li|wi|kni)ves$/i'        => "$1fe",
		'/(shea|loa|lea|thie)ves$/i'=> "$1f",
		'/(^analy)ses$/i'           => "$1sis",
		'/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i'  => "$1$2sis",
		'/([ti])a$/i'               => "$1um",
		'/(n)ews$/i'                => "$1ews",
		'/(h|bl)ouses$/i'           => "$1ouse",
		'/(corpse)s$/i'             => "$1",
		'/(us)es$/i'                => "$1",
		'/s$/i'                     => ""
	);

	/**
	 * @var array
	 */
	private $grammar_irregular = array(
		'move'   => 'moves',
		'foot'   => 'feet',
		'goose'  => 'geese',
		'sex'    => 'sexes',
		'child'  => 'children',
		'man'    => 'men',
		'tooth'  => 'teeth',
		'person' => 'people'
	);

	/**
	 * @var array
	 */
	private $grammar_uncountable = array(
		'sheep',
		'fish',
		'deer',
		'series',
		'species',
		'money',
		'rice',
		'information',
		'equipment'
	);

	/**
	 * @param $term
	 * @return mixed
	 */
	public function singular($term) {
		if (in_array(strtolower($term), $this->grammar_uncountable)) {
			return $term;
		}

		foreach ($this->grammar_irregular as $result => $pattern) {
			$pattern = '/' . $pattern . '$/i';

			if (preg_match($pattern, $term)) {
				return preg_replace($pattern, $result, $term);
			}
		}

		foreach ($this->grammar_singular as $pattern => $result) {
			if (preg_match($pattern, $term)) {
				return preg_replace($pattern, $result, $term);
			}
		}

		return $term;
	}

	/**
	 * @param $term
	 * @return mixed
	 */
	public function plural($term) {
		if (in_array(strtolower($term), $this->grammar_uncountable)) {
			return $term;
		}

		foreach ($this->grammar_irregular as $pattern => $result) {
			$pattern = '/' . $pattern . '$/i';

			if (preg_match($pattern, $term)) {
				return preg_replace($pattern, $result, $term);
			}
		}

		foreach ($this->grammar_plural as $pattern => $result) {
			if (preg_match($pattern, $term)) {
				return preg_replace($pattern, $result, $term);
			}
		}

		return $term;
	}

	/**
	 * @param array $attributes
	 * @return string
	 */
	public function attributes(array $attributes) {
		$attribute = '';
		foreach ($attributes as $attr => $values) {
			$attribute .= ' ' . $this->attribute($attr, $values);
		}

		return $attribute;
	}

	/**
	 * @param  string        $attribute
	 * @param  array|string  $values
	 * @return string
	 */
	public function attribute($attribute, $values) {
		if (is_array($values)) {
			return ' ' . $attribute . '="' . strtolower(trim(implode(' ', $values))) . '"';
		} else {
			return ' ' . $attribute . '="' . strtolower(trim($values)) . '"';
		}
	}

	/**
	 * @param $string
	 * @return string
	 */
	public function slug($string) {
		$string = trim(strtolower($string));
		$string = str_replace(array(' & ', ' ', '_'), '-', $string);
		$string = preg_replace('/[^-^a-z^0-9]+/', '', $string);
		$string = str_replace(array('---', '--'), '-', $string);

		return addslashes($string);
	}
}