<?
// Global defines
define('ip', (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '000.000.000.000'));
if (!defined('root')) define('root', $_SERVER['DOCUMENT_ROOT']);
define('host', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'Unknown host'));
define('uri', (isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/'));
define('ssl', (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on'));
define('user_agent', (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown User Agent'));
define('debug', (strstr(ip, '127.0.0.1')));
define('ajax', (isset($_REQUEST['act']) && !empty($_REQUEST['act'])));
define('cms', false);
define('gc_support', function_exists('gc_enable'));
if (debug) {
	// Capture MySQL query times for current page load
	define('mysql_benchmark', true);
	define('show_mysql_benchmark', true); // Output from core->get_html_footer() if true
}
if (gc_support && !gc_enabled()) {
	gc_enable();
}

// Set PHP error reporting - TODO - Add error handler override so that only `debug` users see errors, others need to be logged
ini_set('display_errors', E_ALL);
error_reporting(E_ALL);

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

	$di->core = new core();
	$di->core->set_di($di);

	if (!ajax) {
		$di->core->load_theme();
	}
}