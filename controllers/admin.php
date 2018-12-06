<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Admin extends Controller {
	
	function __construct() {
		parent::__construct();
        Session::init();
		$logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
		if($logged == false) {
			Session::destroy();
			header("Location: /login");
			exit;
		}
	}
	
	function index() {
	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }
		
        $this->view->set('TitlePage', "Golden Admin");
        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->set('countData', $this->model->getcountData());
        //$this->view->set('countViewsVideo', $this->model->getcountViewsVideo());
        //$this->view->set('countCopyVideo', $this->model->getcountCopyVideo());
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "index");
		$this->view->render('admin/index');
	}
    
    function ingredients($ingredient = '') {
        if(isset($_POST['submit'])){
            $IngredientsName = $_POST['ingredientsname'];
            
            $CheckEdit = $this->model->editIngredient($ingredient,$IngredientsName);
            if($CheckEdit['info'] == 'Edited'){
                Session::set('EditApply', $CheckEdit['info']);
            } else {
                Session::set('EditError', $CheckEdit['info']);
                Session::set('EditIngredientsName', $IngredientsName);
            }
        }

	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }

        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "ingredient");
        if($ingredient == '' || $ingredient == NULL){
            $this->view->set('TitlePage', "Golden Admin - Ingredients");
            $this->view->set('AllIngredients', $this->model->getAllIngredients());
            $this->view->render('admin/ingredients');
        } else {
            $this->view->set('TitlePage', "Golden Admin - Ingredient");
            $this->view->set('Ingredient', $this->model->getIngredient($ingredient));
            $this->view->render('admin/ingredient');
        }

	}
    
    function addIngredient() {
        if(isset($_POST['submit'])){
            $IngredientsName = $_POST['ingredientsname'];
            
            $CheckAdd = $this->model->addIngredient($IngredientsName);
            if($CheckAdd['info'] == 'Ingredient added'){
                Session::set('AddApply', $CheckAdd['info']);
            } else {
                Session::set('AddError', $CheckAdd['info']);
                Session::set('AddIngredientsName', $IngredientsName);
            }
        }

	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }
		
        $this->view->set('TitlePage', "Golden Admin - Ingredient");
        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "ingredient");
        $this->view->render('admin/addingredient');

	}
    
    function nutrients($nutrients = '') {
        if(isset($_POST['submit'])){
            $NutrientsName = $_POST['nutrientsname'];
            
            $CheckEdit = $this->model->editNutrients($nutrients,$NutrientsName);
            if($CheckEdit['info'] == 'Edited'){
                Session::set('EditApply', $CheckEdit['info']);
            } else {
                Session::set('EditError', $CheckEdit['info']);
                Session::set('EditNutrientsName', $NutrientsName);
            }
        }

	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }

        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "nutrients");
        if($nutrients == '' || $nutrients == NULL){
            $this->view->set('TitlePage', "Golden Admin - Nutrients");
            $this->view->set('AllNutrients', $this->model->getAllNutrients());
            $this->view->render('admin/nutrients');
        } else {
            $this->view->set('TitlePage', "Golden Admin - Nutrient");
            $this->view->set('Nutrient', $this->model->getNutrient($nutrients));
            $this->view->render('admin/nutrient');
        }

	}
    
    function addNutrient() {
        if(isset($_POST['submit'])){
            $NutrientName = $_POST['nutrientsname'];
            
            $CheckAdd = $this->model->addNutrient($NutrientName);
            if($CheckAdd['info'] == 'Nutrient added'){
                Session::set('AddApply', $CheckAdd['info']);
            } else {
                Session::set('AddError', $CheckAdd['info']);
                Session::set('AddNutrientName', $NutrientName);
            }
        }

	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }
		
        $this->view->set('TitlePage', "Golden Admin - Nutrient");
        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "nutrient");
        $this->view->render('admin/addnutrient');

	}
    
    function addNutrientIngredients($ingredient = ''){
        if(isset($_POST['submit'])){
            $nutrientID = $_POST['nutrientid'];
            $grams = $_POST['grams'];
            
            $CheckAdd = $this->model->addIngredientContains($ingredient,$nutrientID,$grams);
            if($CheckAdd['info'] == 'Ingredient with nutrient added'){
                Session::set('AddApply', $CheckAdd['info']);
            } else {
                Session::set('AddError', $CheckAdd['info']);
                Session::set('AddNutrientID', $nutrientID);
                Session::set('AddGrams', $grams);
            }
        }

	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }
		
        $this->view->set('Ingredient', $this->model->getIngredient($ingredient));
        $this->view->set('AllNutrients', $this->model->getAllNutrients());
        $this->view->set('TitlePage', "Golden Admin - Add nutrient to ingredients");
        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "ingredient");
        $this->view->render('admin/addnutrientingredients');
    }
    
    function products($products = '') {
        if(isset($_POST['submit'])){
            $ProductsName = $_POST['productsname'];
            
            $CheckEdit = $this->model->editProduct($products,$ProductsName);
            if($CheckEdit['info'] == 'Edited'){
                Session::set('EditApply', $CheckEdit['info']);
            } else {
                Session::set('EditError', $CheckEdit['info']);
                Session::set('EditProductsName', $ProductsName);
            }
        }

	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }

        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "products");
        if($products == '' || $products == NULL){
            $this->view->set('TitlePage', "Golden Admin - Products");
            $this->view->set('AllProducts', $this->model->getAllProducts());
            $this->view->render('admin/products');
        } else {
            $this->view->set('TitlePage', "Golden Admin - Product");
            $this->view->set('Product', $this->model->getProduct($products));
            $this->view->render('admin/product');
        }

	}
    
    function addProduct() {
        if(isset($_POST['submit'])){
            $ProductsName = $_POST['productsname'];
            
            $CheckAdd = $this->model->addProduct($ProductsName);
            if($CheckAdd['info'] == 'Product added'){
                Session::set('AddApply', $CheckAdd['info']);
            } else {
                Session::set('AddError', $CheckAdd['info']);
                Session::set('AddProductName', $ProductsName);
            }
        }

	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }
		
        $this->view->set('TitlePage', "Golden Admin - Product");
        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "products");
        $this->view->render('admin/addproduct');

	}
    
    function addProductIngredients($product = ''){
        if(isset($_POST['submit'])){
            $IngredientID = $_POST['ingredientid'];
            $grams = $_POST['grams'];
            
            $CheckAdd = $this->model->addProductContains($product,$IngredientID,$grams);
            if($CheckAdd['info'] == 'Product with ingredient added'){
                Session::set('AddApply', $CheckAdd['info']);
            } else {
                Session::set('AddError', $CheckAdd['info']);
                Session::set('AddingredientID', $IngredientID);
                Session::set('AddGrams', $grams);
            }
        }

	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }
		
        $this->view->set('Product', $this->model->getProduct($product));
        $this->view->set('AllIngredients', $this->model->getAllIngredients());
        $this->view->set('TitlePage', "Golden Admin - Add ingredient to product");
        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "products");
        $this->view->render('admin/addproductingredients');
    }
    
    function users($user = '') {
        if(isset($_POST['submit'])){
            //$VideoID = $_POST['videoidread'];
            $UserImie = $_POST['userimie'];
            $UserNazwisko = $_POST['usernazwisko'];
            $UserTyp = $_POST['usertype'];
            
            $CheckEdit = $this->model->editUser($user,$UserImie,$UserNazwisko,$UserTyp);
            if($CheckEdit['info'] == 'Edited'){
                Session::set('EditApply', $CheckEdit['info']);
            } else {
                Session::set('EditError', $CheckEdit['info']);
                Session::set('UserImie', $UserImie);
                Session::set('UserNazwisko', $UserNazwisko);
                Session::set('UserTyp', $UserTyp);
            }
        } elseif(isset($_POST['submitPass'])){
            //$VideoID = $_POST['videoidread'];
            $UserPass = trim($_POST['userpass']);
            $options = [
                'cost' => 10,
                'salt' => random_bytes(22),
            ];
    		$pass = password_hash($UserPass, PASSWORD_BCRYPT, $options);
            
            $CheckEdit = $this->model->changePassUser($user,$pass);
            if($CheckEdit['info'] == 'Changed'){
                Session::set('EditApply', $CheckEdit['info']);
            } else {
                Session::set('EditError', $CheckEdit['info']);
            }
        }
        
        
	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }
		
        $this->view->set('TitlePage', "Golden Admin - Users");
        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "users");
        if($user == '' || $user == NULL){
            $this->view->set('AllUsers', $this->model->getAllUser());
            $this->view->render('admin/users');
        } else {
            $this->view->set('User', $this->model->getUser($user));
            $this->view->render('admin/user');
        }
	}
    
    function addUser() {
        if(isset($_POST['submit'])){
            //$VideoID = $_POST['videoidread'];
            $UserEmail = $_POST['useremail'];
            $UserImie = $_POST['userimie'];
            $UserNazwisko = $_POST['usernazwisko'];
            $UserHaslo = trim($_POST['userpass']);
            $UserTyp = $_POST['usertype'];
            
            $options = [
                'cost' => 10,
                'salt' => random_bytes(22),
            ];
    		$pass = password_hash($UserHaslo, PASSWORD_BCRYPT, $options);
            
            $CheckAdd = $this->model->addUser($UserEmail,$UserImie,$UserNazwisko,$pass,$UserTyp);
            if($CheckAdd['info'] == 'Registred'){
                Session::set('AddApply', $CheckAdd['info']);
            } else {
                Session::set('AddError', $CheckAdd['info']);
                Session::set('AddUserEmail', $UserEmail);
                Session::set('AddUserImie', $UserImie);
                Session::set('AddUserNazwisko', $UserNazwisko);
                Session::set('AddUserTyp', $UserTyp);
            }
        }

	    $logged = Session::get('loggedIn');
		$logType = Session::get('user_type');
        $tok = Session::get('token');
        $CheckLogin = $this->model->checkToken($tok);
        if($CheckLogin['status'] != 1 || $CheckLogin['status'] != "1"){
            Session::destroy();
            Session::init();
            Session::set('loginError', $CheckLogin['info']);
            header("Location: /login");
            exit;
        }
		
        $this->view->set('TitlePage', "Golden Admin - Users");
        $this->view->set('keywords', "Golden");
        $this->view->set('description', "Golden");
        
        $this->view->js = array('admin/js/js.js');
        $this->view->set('NavBold', "users");
        $this->view->render('admin/adduser');

	}
    
    function getAllIngredientsContainsNutrients(){
        $this->model->getAllIngredientsContainsNutrients();
    }
    
    function getAllProductsContainsIngredients(){
        $this->model->getAllProductsContainsIngredients();
    }
    
}

?>