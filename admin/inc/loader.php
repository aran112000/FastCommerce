<?
require(root . '/inc/config.php');
define('cms', true);

// Crucial autoloaders
spl_autoload_register(function($class) {
	if (file_exists(root . '/inc/core/' . $class . '.php')) {
		require(root . '/inc/core/' . $class . '.php');
	} else if (file_exists(root . '/admin/inc/' . $class . '.php')) {
		require(root . '/admin/inc/' . $class . '.php');
	} else if (file_exists(root . '/inc/core/fields/' . $class . '.php')) {
		require(root . '/inc/core/fields/' . $class . '.php');
	}
});

if (!defined('load_core') || load_core) {
	$di = new di();

	$di->asset->set_module_dir('/admin/inc/module/');
	$di->asset->set_object_dir('/admin/inc/object/');
	$di->asset->set_theme_dir('/admin/inc/theme/');

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

	$di->core = $di->load_class('cms');;

	if (!ajax) {
		$di->core->load_theme();
	}
}