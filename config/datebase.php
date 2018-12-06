<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */
 
$whitelist = array(
    '127.0.0.1',
    '::1',
	'localhost'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'golden');
	define('DB_CHARSET', 'utf8');
	define('DB_USER', 'root');
	define('DB_PASS', '');
} else {
	define('DB_TYPE', 'mysql');
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'golden');
	define('DB_CHARSET', 'utf8');
	define('DB_USER', 'root');
	define('DB_PASS', '');
}

?>