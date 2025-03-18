<?php
class user extends Model {
    //propriétés
    public $table="utilisateur";

    function getUser($login, $password) {
        return $this->findfirst(array(
            'fields' => "*",
            'condition' => "AND login='".$login."' AND password='".md5($password)."'",
            'limit' => 'LIMIT 1'
        ),PDO::FETCH_OBJ); // Récupère un tableau associatif
    }

    public function GenererSel($id, $nom, $prenom) {
        return $id.$nom.$prenom.$id;
    }

    public function ConcatenerMotDePasseAvecSel($password, $sel) {
        return $sel.$password;
    }

    public function ValiderMotDePasse($password, $passwordConf) {
        return $password === $passwordConf;
    }

    public function VerifierMotDePasse($password, $sel) {
        $passwordAvecSel = $this->ConcatenerMotDePasseAvecSel($password, $sel);
        return password_verify($passwordAvecSel);
    }
    

    function TrouverParLogin($login) {
        return $this->findFirst(array (
            'fields' => '*',
            'condition' => 'AND login = "'.$login.'"'
        ));
    } 
    function getLastInsertId() {
        $sql = "SELECT MAX(id) AS last_id FROM ". $this->table;
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()){
            return $stmt->fetchColumn();
        } else {
            echo "Erreur SQL lors de la récupération du dernier id utilisateurs.";
            return 0;
        }
    }
}