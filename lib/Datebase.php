<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Datebase extends PDO {
	
	public function __construct() {
		parent::__construct(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET,DB_USER,DB_PASS);
	}
}

?>