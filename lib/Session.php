<?php

/**
 * @author Pawe³ Liwocha
 * @copyright 2018
 */

class Session {
	
	public static function init() {
	   if(session_status() == PHP_SESSION_NONE) {
            ini_set('session.gc_maxlifetime', 3600);
            session_set_cookie_params(3600);
            @session_start();
	   }         
	}
	
	public static function set($key, $value) {
		$_SESSION[$key] = $value;
	}
	
	public static function get($key) {
		if(isset($_SESSION[$key]))
		return $_SESSION[$key];
	}
    
    public static function uset($key) {
        if(isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
	}
	
	public static function destroy() {
		session_destroy();
	}
	
}

?>