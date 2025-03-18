<?php 
	class Session {

		function  __construct() {
			if(!isset($_SESSION)){
				session_start();
			}
		}

		//méthode pour affecter un message (d'erreur ou pas...)
		public function setFlash($message,$icon="",$type="success") {
			$_SESSION['flash'] = array (
				'message'=>$message,
				'icon'=>$icon,
				'type'=>$type
			);
		}	

		//méthode pour afficher un message
		public function flash() {
			if (isset($_SESSION['flash']['message'])){
				$html = '<div class="alert alert-'.$_SESSION['flash']['type'].' d-flex align-items-center" role="alert">';
				$html .= $_SESSION['flash']['icon'];
				$html .= '<div> ';
				$html .= $_SESSION['flash']['message'];
				$html .= '</div>';
				$html .= '</div>';
				$_SESSION['flash'] = array ();
				return $html;
			}
			
		}	
		
		//init d'une variable de SESSION
		public function write($key, $value) {
			$_SESSION[$key] = $value;
		}
		
		//lecture d'une variable de SESSION
		public function read($key=null) {
			if($key) {
				if (isset($_SESSION[$key])) {
					return $_SESSION[$key];
				} else {
					return false;
				}
			} else {
				return $_SESSION;
			}
		}
		
		//retourne vrai si le nom de la personne loguée existe
		public function isLogged() {
			$isLogged = isset($_SESSION['User']);
			if (!$isLogged) {
				error_log("L'utilisateur n'est pas connecté. SESSION : " . print_r($_SESSION, true));
			}
			return $isLogged;
		}

		//methode pour lire la valeur du user
		public function user($key) {
		   if ($this->read('User')){
			   if (isset($this->read('User')->$key)){
				   return $this->read('User')->$key;
			   } else {
				   return false;
			   }
		   }
		   return false;
		}		
		
	}
?>