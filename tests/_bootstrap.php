<?php
define('root', (isset($_SERVER['pwd']) ? $_SERVER['pwd'] : str_replace('\tests\\', '', end($_SERVER['argv']))));
define('cms', false);

// Class autoloaders
spl_autoload_register(function($class) {
	if (file_exists(root . '/inc/core/' . $class . '.php')) {
		require(root . '/inc/core/' . $class . '.php');
	} else if (file_exists(root . '/inc/core/fields/' . $class . '.php')) {
		require(root . '/inc/core/fields/' . $class . '.php');
	}
});
$di = new di();
spl_autoload_register(function($class) use ($di) {

	// Test case mocks
	if (file_exists(root . '/tests/mocks/' . $class . '.php')) {
		require(root . '/tests/mocks/' . $class . '.php');
	}

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

/*$di->cache->connect(array(
	'server1' => array($host = '127.0.0.1', $port = 11211, $weight = 100),
));*/