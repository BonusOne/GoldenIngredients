<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Admin_Model extends Model {
	
	function __construct() {
		parent::__construct();
	}
    
    public function checkToken($token) {
        $userid = Session::get('user_id');
        
        $que = $this->db->query('call checkToken("'.$token.'","'.$userid.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
        if($count > 0) {
            return $data;
        } else {
            $incorrect['info'] = "Check error";
            $incorrect['status'] = 0;
            return $incorrect;
        }
        
    }
    
    public function getUser($idUser) {
		$que = $this->db->query('call ADMgetUser("'.$idUser.'")');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getUser";
            return $data['info'];
        }
	}
    
    public function getAllUser() {
		$que = $this->db->query('call ADMselectAllUser()');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getAllUser";
            return $data['info'];
        }
	}
    
    public function getcountData() {
		$que = $this->db->query('call selectCount()');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getcountData";
            return $data['info'];
        }
	}
    
    public function getIngredient($idIngredient) {
		$que = $this->db->query('call ADMgetIngredient("'.$idIngredient.'")');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getIngredient";
            return $data['info'];
        }
	}
    
    public function getAllIngredients() {
		$que = $this->db->query('call getAllIngredient()');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getAllIngredient";
            return $data['info'];
        }
	}
    
    public function getAllIngredientsContainsNutrients() {
		$que = $this->db->query('call selectAllIngredientsContainsNutrients()');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            $data = json_encode($data);
            echo $data;
        } else {
            $data['info'] = "Error with getAllIngredientsContainsNutrients";
            echo $data['info'];
        }
	}
    
    public function getIngredientContainsNutrients($idIngredient) {
		$que = $this->db->query('call selectIngredientContainsNutrients("'.$idIngredient.'")');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getIngredientContainsNutrients";
            return $data['info'];
        }
	}
    
    public function editIngredient($IngredientID,$IngredientName){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call editIngredient("'.$IngredientID.'","'.$IngredientName.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with editIngredient";
            return $data['info'];
        }
    }
    
    public function addIngredient($IngredientName){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call addIngredient("'.$IngredientName.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with addIngredient";
            return $data['info'];
        }
    }
    
    public function addIngredientContains($IngredientID,$NutrientID,$Grams){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call addIngredientContains("'.$IngredientID.'","'.$NutrientID.'","'.$Grams.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with addIngredientContains";
            return $data['info'];
        }
    }
    
    public function getNutrient($idNutrient) {
		$que = $this->db->query('call ADMgetNutrients("'.$idNutrient.'")');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getNutrients";
            return $data['info'];
        }
	}
    
    public function getAllNutrients() {
		$que = $this->db->query('call getAllNutrients()');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getAllNutrients";
            return $data['info'];
        }
	}
    
    public function editNutrients($NutrientsID,$NutrientsName){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call editNutrients("'.$NutrientsID.'","'.$NutrientsName.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with editNutrients";
            return $data['info'];
        }
    }
    
    public function addNutrient($NutrientName){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call addNutrient("'.$NutrientName.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with addNutrient";
            return $data['info'];
        }
    }
    
    public function addProductContains($ProductID,$IngredientID,$Grams){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call addProductContains("'.$ProductID.'","'.$IngredientID.'","'.$Grams.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with addProductContains";
            return $data['info'];
        }
    }
    
    public function getProduct($idProduct) {
		$que = $this->db->query('call ADMgetProduct("'.$idProduct.'")');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getProduct";
            return $data['info'];
        }
	}
    
    public function getAllProducts() {
		$que = $this->db->query('call getAllProducts()');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getAllProducts";
            return $data['info'];
        }
	}
    
    public function editProduct($ProductID,$ProductName){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call editProduct("'.$ProductID.'","'.$ProductName.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with editProduct";
            return $data['info'];
        }
    }
    
    public function addProduct($ProductName){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call addProduct("'.$ProductName.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with addProduct";
            return $data['info'];
        }
    }
    
    public function getAllProductsContainsIngredients() {
		$que = $this->db->query('call selectAllProductsContainsIngredients()');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            $data = json_encode($data);
            echo $data;
        } else {
            $data['info'] = "Error with getAllProductsContainsIngredients";
            echo $data['info'];
        }
	}
    
    public function getProductContainsIngredients($idIngredient) {
		$que = $this->db->query('call selectProductContainsIngredients("'.$idIngredient.'")');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with getProductContainsIngredients";
            return $data['info'];
        }
	}
    
    public function editUser($UserID,$UserImie,$UserNazwisko,$UserTyp){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call ADMeditUser("'.$UserID.'","'.$UserImie.'","'.$UserNazwisko.'","'.$UserTyp.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            $data['info'] = "Edited";
            return $data;
        } else {
            $data['info'] = "Error with editUser";
            return $data['info'];
        }
    }
    
    public function addUser($UserEmail,$UserImie,$UserNazwisko,$UserHaslo,$UserTyp){
        $userID = Session::get('user_id');
        $que = $this->db->query('call ADMaddUser("'.$UserEmail.'","'.$UserImie.'","'.$UserNazwisko.'","'.$UserHaslo.'","'.$UserTyp.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with addUser";
            return $data['info'];
        }
    }
    
    public function changePassUser($UserID,$UserPass){
        //$userID = Session::get('user_id');
        $que = $this->db->query('call ADMchangePass("'.$UserID.'","'.$UserPass.'")');
		$data = $que->fetch(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            return $data;
        } else {
            $data['info'] = "Error with changePassUser";
            return $data['info'];
        }
    }
    
		
}

?>