<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Model {
	
	function __construct() {
        try {
            $this->db = new Datebase();
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
	}
	
	public function set($name, $value) {
        $this->$name=$value;
    }
	
}

?>