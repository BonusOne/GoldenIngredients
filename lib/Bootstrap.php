<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Bootstrap {
	
	function __construct() {
		
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = explode('/', $url);
        
        if(isset($_COOKIE['AcceptCookies'])) {
            setcookie("AcceptCookies", true, time()+(60*60*24*30), '/', $_SERVER['HTTP_HOST'], false);
        }
        
		
		if (empty($url[0])) {
			require 'controllers/index.php';
			$controller = new Index();
            $controller->loadModel('index');
			$controller-> { 'index' }();
			return false;
		}
		
		$file = 'controllers/'.$url[0].'.php';
        
		if (file_exists($file)) {
			require $file;
		} else {
            if(method_exists($controller, $url[0])){
                $controller ->  { 'index' } ($url[0]);
            } else {
    			$this->error("Za chwil&#281; zostaniesz przeniesiony na stron&#281; g&#322;&#243;wn&#261;.");
                header('Refresh: 2; url=/');
                exit;
            }
		}
        
        //$url[0] = str_replace("-","_",$url[0]);
		
		$controller = new $url[0];
		$controller->loadModel($url[0]);
        
		
        (int)$ilPodstron = count($url)-1;

		if (isset($url[$ilPodstron]) and $ilPodstron >= 1) {
            
            if ($url[0] == 'admin' and $url[1] == 'ingredients' and isset($url[2]) ) {
                if($url[2] == 'addIngredient'){
                    $controller ->  { 'addIngredient' } ();
                } else {
				    $controller ->  { 'ingredients' } ($url[2]);
                }
			} elseif ($url[0] == 'admin' and $url[1] == 'nutrients' and isset($url[2]) ) {
                if($url[2] == 'addNutrient'){
                    $controller ->  { 'addNutrient' } ();
                } else {
				    $controller ->  { 'nutrients' } ($url[2]);
                }
			} elseif ($url[0] == 'admin' and $url[1] == 'addNutrientIngredients' and isset($url[2]) ) {
                $controller ->  { 'addNutrientIngredients' } ($url[2]);
			} elseif ($url[0] == 'admin' and $url[1] == 'products' and isset($url[2]) ) {
                if($url[2] == 'addProduct'){
                    $controller ->  { 'addProduct' } ();
                } else {
				    $controller ->  { 'products' } ($url[2]);
                }
			} elseif ($url[0] == 'admin' and $url[1] == 'addProductIngredients' and isset($url[2]) ) {
                $controller ->  { 'addProductIngredients' } ($url[2]);
			} elseif ($url[0] == 'admin' and $url[1] == 'users' and isset($url[2]) ) {
			    if($url[2] == 'addUser'){
                    $controller ->  { 'addUser' } ();
                } else {
				    $controller ->  { 'users' } ($url[2]);
                }
			} elseif (method_exists($controller, $url[$ilPodstron])) {
				$controller ->  { $url[$ilPodstron] } ();
			} else {
				$this->error();
			}
            
            
            
		} else {
				$controller->index();
		}
		
	}
	
	function error($param = "") {
		require_once('controllers/error.php');
		$controller = new Errors();
		$controller->index($param);
		return false;
	}
}

?>