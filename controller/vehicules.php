<?php 
class vehicules extends controller {
	
	var $models = array('vehicule');
	var $vehicule;
	var $marque;
	var $photoveh;
	function index() {
		$d = array();
	
		// Récupère les véhicules
		$d['vehs'] = $this->vehicule->getLast(999, null, null, 'left');
	
		// Récupère les pilotes pour la liste déroulante
		$d['pilotes'] = $this->vehicule->getAllPilotes();
	
		$this->set($d);
		$this->render('index');
	}
	/*function ajaxListVehicules($idcategorie=null) {
		$vehs = $this->vehicule->getLast(99999,$idcategorie, null, "LEFT");
		// echo "<PRE>";
		// print_r($vehs); 
		// echo "</PRE>";	
		//je rends la vue indexAjax
		require (ROOT.'views/vehicules/indexAjax.php');
	}*/
	
	
	function ajaxListVehicule2s($modele=null) {
		$vehs = $this->vehicule->getLast(99999,$modele, "LEFT");
		//echo "<PRE>";
		//print_r($vehs); 
		//echo "</PRE>";	
		//je rends la vue indexAjax
		require (ROOT.'views/vehicules/indexAjax.php');
	}
	
	function view($id) {
		// echo "méthode view de objet vehicule id:".$id;
		$d['veh'] = $this->vehicule->getVeh($id);
		$d['photoveh'] = $this->photoveh->getPhotos($id);
		// echo "<PRE>";
		// print_r($d['photoveh']); 
		// echo "</PRE>";	
		$this->set($d);
		//je rends la vue view
		$this->render('view');
	}
	
	function admin_index() {
		//echo "méthode index de objet vehicule";
		if ($this->Session->isLogged()) {
			$d=array();
			
			$d['vehs'] = $this->vehicule->getLast(999, null, null, "LEFT");
			$this->set($d);
			$this->layout ='admin';
			//je rends la vue index
			$this->render('admin_index');
		} else {
			$this->Session->setFlash("Appli impiratable, passez votre chemin. Ton adresse  Ip "
				.$_SERVER['REMOTE_ADDR'].
				" a été interceptée par le commissariat de police du Puy-En-Velay",
				'<i class="fas fa-times"></i>',"danger");
			$this->layout ='default';
			//je rends la vue index
			$this->render('index');
		}
	}
	function admin_edit($id=null) {
		// echo "méthode admin_edit de objet vehicule id:".$id;
		if ($this->Session->isLogged()) {
			// echo "session ok";
			// echo "<PRE>";
			// print_r($_POST); 
			// echo "</PRE>";	
			//si on a validé la page, alors on appelle le model méthode save
			if (isset($_POST)){
				if (!empty($_POST)){
					//echo "dedans ok";
					if (is_numeric($_POST["puissance"])){
						// echo "prix ok";
						// echo "<PRE>";
						// print_r($_POST); 
						// echo "</PRE>";
						if (isset($_POST["supprphoto"])){
							$photosasupprimer = $_POST["supprphoto"];
							foreach( $photosasupprimer as $p) {
								//echo "photo à suppr :".$p;
								$this->photoveh->id=$p;	
								//print_r($this->photoveh->getChemin($p));
								$chemin = $this->photoveh->getChemin($p);
								//print_r($chemin);
								//echo "<br>chemin photo à suppr :".$chemin->chemin;
								unlink('webroot/img/'.$chemin->chemin);
								$this->photoveh->delete();
							}
							unset($_POST["supprphoto"]);
						}
						$this->vehicule->save($_POST);	
						
						// echo "RETOUR this->vehicule->->id:".$this->vehicule->id;
						$idveh=$this->vehicule->id;
						$d['vehs'] = $this->vehicule->getLast(999);
						// echo "FILES :";
						// echo "<PRE>";
						// print_r($_FILES); 
						// echo "</PRE>";	
						//on compte le nombre de fichiers envoyés
						$nbFichiersEnvoyes = count($_FILES["photo"]["modele"]);
						// echo "nbFichiersEnvoyes:".$nbFichiersEnvoyes." <br>";
						if (!empty($_FILES["photo"]["modele"][0])) {
							for($i=0;$i<$nbFichiersEnvoyes;$i++){
								// echo "i :".$i."<br>";
								// echo "nom fichier téléchargé :".$_FILES["photo"]["modele"][$i]."<br>";
								// echo "nom chemin upload :".$_FILES["photo"]["tmp_modele"][$i]."<br>";
								$im_src="webroot/img/".$_FILES['photo']['modele'][$i];
								if (!move_uploaded_file($_FILES['photo']['tmp_modele'][$i], $im_src)){
									$this->Session->setFlash("Téléchargement KO",
										'<i class="fas fa-times"></i>',"danger");
								}
								$photoveh["id"]="";
								$photoveh["chemin"]=$_FILES["photo"]["modele"][$i];
								$photoveh["nom"]=$_POST["modele"];
								$photoveh["idveh"]=$idveh;
								$this->photoveh->save($photoveh);	
							}
						}
						// echo "save<br>";
						/*$this->set($d);
						$this->layout ='admin';
						$this->render('admin_index');*/
						$this->Session->setFlash("Mise à jour ok",'<i class="fas fa-check"></i>');
						return $this->admin_index();
						
					} else {
						// echo "prix ko";
						$d['validprix']="is-invalid";
						$this->Session->setFlash("La puissance doit etre numerique saisi doit être numérique",'<i class="fas fa-times"></i>',"danger");
						/*$this->set($d);
						$this->layout ='admin';
						$this->render('admin_edit');*/
					}
				}
			}
			if(!empty($id)){
				$d['titre'] = "Modification ";
				$d['veh'] = $this->vehicule->getVeh($id);
				$d['photos'] = $this->photoveh->getPhotos($id);
			} else {
				$d['titre'] = "Ajout ";
			}
			//$d['cats'] = $this->category->getLast(99999);
			$d['marques'] = $this->marque->getMarques(99999);
			//$d['couleurs'] = $this->couleur->getCouleurs(99999);
			$this->set($d);
			//je rends la vue admin_edit 
			$this->layout ='admin';
			$this->render('admin_edit');
		}
	}
	
	function admin_delete($id) {
		//echo "méthode view de objet vehicule id:".$id;
		if ($this->Session->isLogged()) {
			if ($this->vehicule->deleteVeh($id)) {
				//suppression des photos du vehicule
				//$this->photoveh->deletePhotosVeh($id);
				$this->Session->setFlash("Suppression bien effectuée",'<i class="fas fa-times"></i>'); 
			}
			else {
				$this->Session->setFlash("Suppression impossible",'<i class="fas fa-times"></i>','danger'); 
			}
			
			/*$d['vehs'] = $this->vehicule->getLast(999);
			$this->set($d);
			$this->layout ='admin';*/
			return $this->index();
		} else {
			$this->Session->setFlash("Appli impiratable, passez votre chemin. Ton adresse  Ip "
				.$_SERVER['REMOTE_ADDR'].
				" a été interceptée par le commisariat de police du Puy-En-Velay",
				'<i class="fas fa-times"></i>',"danger");
			$this->layout ='default';
			//je rends la vue index
			$this->render('index');
		}
	}
	
	function ajaxUpdateField() {
		if ($this->Session->isLogged() && !empty($_POST['id']) && !empty($_POST['field']) && isset($_POST['value'])) {
			$id = intval($_POST['id']);
			$field = htmlspecialchars($_POST['field']);
			$value = htmlspecialchars($_POST['value']);
	
			// Vérifiez que le champ à mettre à jour est valide
			$validFields = ['marque', 'modele', 'annee', 'puissance', 'type'];
			if (in_array($field, $validFields)) {
				// Mise à jour dans le modèle
				$this->vehicule->updateField($id, $field, $value);
				echo json_encode(['status' => 'success']);
			} else {
				echo json_encode(['status' => 'error', 'message' => 'Champ invalide']);
			}
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Données invalides']);
		}
		die();
	}

	function add() {
		if ($this->Session->isLogged() && !empty($_POST)) {
			$data = [
				'marque' => htmlspecialchars($_POST['marque']),
				'modele' => htmlspecialchars($_POST['modele']),
				'annee' => intval($_POST['annee']),
				'puissance' => intval($_POST['puissance']),
				'type' => htmlspecialchars($_POST['type']),
				'id_utilisateur' => htmlspecialchars($_POST['id_utilisateur']),
			];
	
			if ($this->vehicule->save($data)) {
				$this->Session->setFlash("Véhicule ajouté avec succès", '<i class="fas fa-check"></i>', 'success');
			} else {
				$this->Session->setFlash("Erreur lors de l'ajout du véhicule", '<i class="fas fa-times"></i>', 'danger');
			}
		} else {
			$this->Session->setFlash("Accès non autorisé", '<i class="fas fa-times"></i>', 'danger');
		}
	
		return $this->index();
	}
	
}
?>