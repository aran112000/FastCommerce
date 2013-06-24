<?
require(root . '/inc/config.php');
define('cms', false);

// Crucial autoloaders
spl_autoload_register(function($class) {
	if (file_exists(root . '/inc/core/' . $class . '.php')) {
		require(root . '/inc/core/' . $class . '.php');
	} else if (file_exists(root . '/inc/core/fields/' . $class . '.php')) {
		require(root . '/inc/core/fields/' . $class . '.php');
	}
});

if (!defined('load_core') || load_core) {
	$di = new di();

	// Secondary autoloaders
	spl_autoload_register(function($class) use ($di) {
		$object_dir = root . $di->asset->get_object_dir();
		if (file_exists($object_dir . $class . '.php')) {
			require($object_dir . $class . '.php');
			return true;
		}

		$module_dir = root . $di->asset->get_module_dir();
		if (file_exists($module_dir . $class . '/' . $class . '.php')) {
			require($module_dir . $class . '/' . $class . '.php');
			return true;
		}

		return false;
	});

	$memcached_servers = array(
		'server1' => array($host = '127.0.0.1', $port = 11211, $weight = 100),
	);
	$di->cache->connect($memcached_servers);

	$di->core = $di->load_class('core');
	$di->core->set_di($di);

	if (!ajax) {
		$di->core->load_theme();
	}
}