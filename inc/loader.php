<?
// Global defines
define('ip', (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '000.000.000.000'));
define('root', $_SERVER['DOCUMENT_ROOT']);
define('host', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'Unknown host'));
define('user_agent', (isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'Unknown User Agent'));
define('debug', (strstr(ip, '127.0.0.1')));
define('ajax', (isset($_REQUEST['act']) && !empty($_REQUEST['act'])));

// Set PHP error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

spl_autoload_register(function($class) {
	if (file_exists(root . '/inc/module/' . $class . '.php')) {
		require(root . '/inc/module/' . $class . '.php');
	} else if (file_exists(root . '/inc/object/' . $class . '.php')) {
		require(root . '/inc/object/' . $class . '.php');
	} else if (file_exists(root . '/inc/static/' . $class . '.php')) {
		require(root . '/inc/static/' . $class . '.php');
	} else if (file_exists(root . '/inc/' . $class . '.php')) {
		require(root . '/inc/' . $class . '.php');
	}
});

if (!defined('load_core') || !load_core) {
	$core = new core();

	if (!ajax) {
		$core->get_theme();
	}
}