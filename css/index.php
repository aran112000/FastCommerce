<?
define('root', $_SERVER['DOCUMENT_ROOT']);
define('load_core', false);
require(root . '/inc/loader.php');
$di->core->show_css();