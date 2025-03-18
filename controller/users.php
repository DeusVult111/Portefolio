<?php
class users extends controller {
    var $models = array('user');

    public $user;

    function index() {
        $d = array();

        if (!empty($_POST)) {
            $user = $this->user->getUser($_POST["login"], $_POST["password"]);
            
            if (!empty($user)) {
                $this->Session->write('User', $user);
                $this->Session->setFlash("Connexion réussie", '<i class="fas fa-check"></i>', 'success');
            } else {
                $this->Session->setFlash("Connexion incorrecte", '<i class="fas fa-times"></i>', 'danger');
            }
        }

        $this->set($d);
        if ($this->Session->isLogged()) {
            $this->render('loginok');
        } else {
            $this->render('index');

        }
    }


    function logout() {
        unset($_SESSION["User"]);
        $this->render("index");
    }

    function form() {
        // Vérification que les champs nécessaires sont définis
        if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['login'], $_POST['password'], $_POST['passwordConf'])) {
            // Vérifier si l'email existe déjà dans la base de données
            if ($this->user->TrouverParLogin($_POST['login'])) {
                $this->Session->setFlash('Ce login est déjà utilisé', '', 'danger');
                return; // Sortir de la méthode pour ne pas continuer l'inscription
            }

            // Vérification que le mot de passe et la confirmation sont identiques
            if ($this->user->ValiderMotDePasse($_POST['password'], $_POST['passwordConf'])) {
                $lastId = $this->user->getLastInsertedId();
                $Sel = $this->user->GenererSel($lastId + 1,$_POST['Nom'],$_POST['Prenom']);
                $data = [
                    'nom' => $_POST['nom'],
                    'prenom' => $_POST['prenom'],
                    'email' => $_POST['email'],
                    'login' => $_POST['login'],
                    'sel'=> $Sel,
                    'password' => md5($Sel.$_POST['password']),
                    'role' => $_POST['role']
                ];
                if ($this->user->save($data)) {
                    $user = $this->user->TrouverParLogin($_POST['login']);
                    $this->Session->write('user',$user);
                    $this->Session->setFlash('Inscription réussie!', '', 'success');
                    header('Location: /' . WEBROOT2 . '/users/loginok');
                    exit;
                } else {
                    $this->Session->setFlash('Erreur lors de l\'enregistrement du mot de passe, veuillez réessayer.', '', 'danger');
                }
                
            } else {
                $this->Session->setFlash('Les mots de passe ne correspondent pas', '', 'danger');
            }
        } else {
            $this->Session->setFlash('Veuillez remplir tous les champs', '', 'danger');
        }
        $this->render('form');
    }
}
