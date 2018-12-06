<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class View {
	
	function __construct() {
		
	}
	
	public function render($nazwa, $noInclude = false) {
		
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = explode('/', $url);
		
		if($url[0] == 'admin') {
			require 'views/header_admin.php';
			require 'views/'.$nazwa.'.php';
			require 'views/footer.php';
		} else {
			if ($noInclude == true) {
				require 'views/'.$nazwa.'.php';
			} else {
				require 'views/header.php';
				require 'views/'.$nazwa.'.php';
				require 'views/footer.php';
			}
		}
	}
	
	public function data($nazwa, $noInclude = false) {
		
			require 'views/'.$nazwa.'.php';
	}
	
	public function set($name, $value) {
        $this->$name=$value;
    }
	
	public function get($name) {
        return $this->$name;
    }
	
}

?>