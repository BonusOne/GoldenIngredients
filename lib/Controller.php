<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Controller {
	
	function __construct() {
	   Session::init(); /** Checking if session is on use is in Session.php file */
        $this->view = new View();
	}
	
	public function loadModel($name) {
		
		$path = 'model/'.$name.'_model.php';
		
		if(file_exists($path)) {
			require 'model/'.$name.'_model.php';
			
			$modelName = $name.'_Model';
			$this->model = new $modelName;
		}
		
	}
	
	
	
}

?>