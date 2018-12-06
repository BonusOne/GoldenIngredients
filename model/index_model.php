<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Index_Model extends Model {
	
	function __construct() {
		parent::__construct();
	}
    
    function getAllProductsPhp() {
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
    
    function getAllProducts() {
		$que = $this->db->query('call getAllProducts()');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            $data = json_encode($data);
            echo $data;
        } else {
            $data['info'] = "Error with getAllProducts";
            return $data['info'];
        }
	}
    
    function selectProductContainsCountIngredientsNutrients() {
        $product = $_GET['Product'];
		$que = $this->db->query('call selectProductContainsCountIngredientsNutrients("'.$product.'")');
		$data = $que->fetchAll(PDO::FETCH_ASSOC);
        $count = $que->rowCount();
        $que->closeCursor();
		if($count > 0) {
            for($j = 0; $j < count($data); $j++){
                $nut = explode(", ",$data[$j]['nutrients']);
                for($i = 0; $i < count($nut); $i++){
                    $exp[$i] = explode(":",$nut[$i]);
                }
                $data[$j]['nutrients'] = $exp;
            }
            $data = json_encode($data);
            echo $data;
        } else {
            $data['info'] = "Error with getAllProducts";
            return $data['info'];
        }
	}
		
}

?>