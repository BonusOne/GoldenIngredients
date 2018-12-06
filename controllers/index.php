<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Index extends Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	function index() {
        $this->view->set('TitlePage', "Golden Test");
        $this->view->set('keywords', "GoldenS");
        $this->view->set('description', "Golden Test");
        $this->view->set('AllProducts', $this->model->getAllProductsPhp());
        
        //$this->view->Swipe = false;
        $this->view->js = array('index/js/js.js');
        $this->view->set('NavBold', "index");
		$this->view->render('index/index');
	}
    
    function acceptCookies(){
        $accept = htmlspecialchars(trim($_POST['acceptCookies']));
        if($accept == 1 || $accept == true){
            setcookie("AcceptCookies", true, time()+(60*60*24*30), '/', $_SERVER['HTTP_HOST'], false);
        }
    }
    
    function getAllProducts(){
        $this->model->getAllProducts();
    }
    
    function getProductContainsCountIngredientsNutrients(){
        $this->model->selectProductContainsCountIngredientsNutrients();
    }
    
}

?>