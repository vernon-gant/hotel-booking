<?php
// Load config
require_once 'config/config.php';
// Load Helpers
require_once 'helpers/general.php';
require_once 'helpers/validation.php';
require_once 'helpers/session.php';
require_once 'helpers/dataPreparing.php';
// Autoload core libraries
spl_autoload_register(function ($className) {
	$path_to_file = APPROOT . '/libraries/' . $className . '.php';
	if (file_exists($path_to_file)) {
		require_once $path_to_file;
	}
});
spl_autoload_register(function ($className) {
	$path_to_file = APPROOT . '/models/' . $className . '.php';
	if (file_exists($path_to_file)) {
		require_once $path_to_file;
	}
});
spl_autoload_register(function ($className) {
	$path_to_file = APPROOT . '/helpers/' . $className . '.php';
	if (file_exists($path_to_file)) {
		require_once $path_to_file;
	}
});