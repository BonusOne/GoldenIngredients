<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Login extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
        $this->view->set('TitlePage', "Golden Test - Login");
        $this->view->js = array('login/js/js.js');
		$this->view->render('login/index', 1); /** render the file without include regular header and footer */
	}
	
	function loginDo() {
		$this->model->loginDo();
	}
	
    function logout() {
		Session::destroy();
		header("Location: /login");
		exit;
	}
    
}

?>