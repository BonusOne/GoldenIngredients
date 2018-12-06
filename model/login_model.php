<?php 

/**
 * @author Paweł Liwocha
 * @copyright 2018
 */

class Login_Model extends Model {
	
	function __construct() {
		parent::__construct();
	}
    
    public function loginDo() {
  		
		$login = htmlspecialchars(trim($_POST['login']));
		$pass = trim($_POST['pass']);
        /*$options = [
            'cost' => 10,
            'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
        ];
		$pass = password_hash($pass, PASSWORD_BCRYPT, $options);*/
        
        function get_client_ip() {
            $ipaddress = '';
            if (isset($_SERVER['HTTP_CLIENT_IP'])){
                $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
            } else if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else if(isset($_SERVER['HTTP_X_FORWARDED'])){
                $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
            } else if(isset($_SERVER['HTTP_FORWARDED_FOR'])){
                $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
            } else if(isset($_SERVER['HTTP_FORWARDED'])){
                $ipaddress = $_SERVER['HTTP_FORWARDED'];
            } else if(isset($_SERVER['REMOTE_ADDR'])){
                $ipaddress = $_SERVER['REMOTE_ADDR'];
            } else {
                $ipaddress = 'UNKNOWN';
            } 
            return $ipaddress;
        }
        
        $quePas = $this->db->query('call checkUser("'.$login.'")');
		$dataPas = $quePas->fetch(PDO::FETCH_ASSOC);
        $countPas = $quePas->rowCount();
        $quePas->closeCursor();
        if($countPas > 0) {
            if(isset($dataPas['password'])){
                if(password_verify($pass, $dataPas['password'])){
                    $remoteAd = get_client_ip();
                        $que = $this->db->query('call loginUser("'.$login.'","'.$remoteAd.'","'.$_SERVER ['HTTP_USER_AGENT'].'")');
                        if(!$que){
                            die("Execute query error, because: ". print_r($this->db->errorInfo(),true) );
                        } else {
                            
                    		$data = $que->fetch(PDO::FETCH_ASSOC);
                            $count = $que->rowCount();
                            $que->closeCursor();
                            if($count > 0) {
                                if(isset($data['id']) and $data['id'] != NULL) {
                                    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256', 'date' => date('Y-m-d\TH:i:sO')]);
                                    $payload = json_encode(['user_id' => $data['id']]);
                                    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
                                    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
                                    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'g0ld3n', true);
                                    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
                                    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
                                    
                                    $queTk = $this->db->query('call addToken("'.$jwt.'","'.$data['id'].'")');
                                    $queTk->closeCursor();
                                    Session::init();
                         			Session::set('user_id', $data['id']);
                         			Session::set('user_email', $data['email']);
                         			Session::set('user_name', $data['firstname']);
                         			Session::set('user_imie', $data['lastname']);
                         			Session::set('user_type', $data['type']);
                                    Session::set('token', $jwt);
                         			Session::set('loggedIn', true);	
                            			
                         			header("Location: /admin");
                         			exit;
                                } else {
                                    Session::init();
                                    Session::set('loginError', $data['info']);
                                    header("Location: /login");
                                }
                            } else {
                        	    Session::init();
                                Session::set('loginError', 'Login or password is wrong!');
                                header("Location: /login");
                    		}
                        }
                } else {
                    Session::set('loginError', 'Wrong password!');
                    header("Location: /login");
                }
            } else {
                Session::set('loginError', $dataPas['info']);
                header("Location: /login");
            }
        } else {
            Session::set('loginError', 'Login error!');
            header("Location: /login");
        }

		
	}

		
}

?>