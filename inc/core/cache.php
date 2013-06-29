<?
/**
 * Class cache
 */
class cache extends dependency {

	/**
	 * @var Memcached|Memcache
	 */
	protected $cache;

	/**
	 * @var int
	 */
	protected $default_cache_time_hours = 0; // The item never expires (although it may be deleted my the Memcached server make place for other items)

	/**
	 * @var bool
	 */
	private $use_memcached = false;

	/**
	 *
	 */
	public function connect(array $servers = array('server1' => array('127.0.0.1', 11211, 100))) {
		if ($this->di->get->class_exists('memcached') && !$this->use_memcached) {
			// When in a Unix environment, we always advise installing Memcached over Memcache
			$this->cache = new Memcached('fc_memcached_pool');
			$this->cache->addServers($servers);
			$this->cache->setOption(Memcached::OPT_COMPRESSION, true);
			$this->cache->setOption(Memcached::OPT_PREFIX_KEY, str_replace('http' . (ssl ? 's' : '') . '://', '', host));
			$this->cache->setOption(Memcached::OPT_BUFFER_WRITES, false);
			$this->cache->setOption(Memcached::OPT_TCP_NODELAY, true);
			//$this->cache->setOption(Memcached::OPT_CACHE_LOOKUPS, true);
			$this->use_memcached = true;
		} else if ($this->di->get->class_exists('memcache') && !$this->use_memcached) {
			// When in a Windows environment Memcache is the simpler option as no up-to-date Memcached DLLs are available for PHP unless you wish to compile your own
			$this->cache = new Memcache;
			foreach ($servers as $server) {
				$this->cache->addServer($host = $server[0], $port = $server[1], $persistent = true, $weight = $server[2]);
			}
			$this->cache->setCompressThreshold(20000, 0.2);
			$this->use_memcached = true;
		}
	}

	/**
	 * @param string $key
	 * @return bool
	 */
	public function get($key) {
		if ($this->use_memcached) {
			return $this->cache->get($key);
		}

		return false;
	}

	/**
	 * @param string $key
	 * @param string $value
	 * @return bool
	 */
	public function set($key, $value) {
		if ($this->use_memcached) {
			return $this->cache->set($key, $value);
		}

		return false;
	}
}