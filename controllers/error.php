<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Errors extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index($param = NULL) {
        if($param === NULL) {
            $this->view->msg = 'Ta strona nie istnieje';
        } else {
            $this->view->msg = 'Ta strona nie istnieje<br />'.$param;
        }
        $this->view->set('TitlePage', "Golden Test - Error");
		$this->view->render('error/index',true);
	}
}

?>