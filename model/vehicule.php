<?php
class vehicule extends Model {
    //propriétés
    public $table="vehicule";
    public $id ;
    public $marque ;
    public $modele ;
    public $annee ;
    public $puissance ;
    public $type ;
    public $id_utilisateur ;
    function getLast($num=6,$modele=null, $joinleft=null){
        // Fonction pour nettoyer les chaînes de caractères

        // Nettoyer les paramètres $modele
        if (!empty($modele)) {
            $condition = "AND vehicule.modele LIKE '%" . $modele . "%' OR vehicule.marque LIKE '%" . $modele . "%'";
        } else {
            $condition = "";
        }

        // Jointure avec photveh pour aller chercher la photo principale du véhicule
        return $this->find(array(
            "fields" => 'vehicule.*, utilisateur.nom as nompilote, utilisateur.prenom as prenompilote',
            "condition" => $condition,
            "join" => ' INNER JOIN utilisateur ON vehicule.id_utilisateur = utilisateur.id ',
            "order" => ' id ASC',
            "limit" => ' LIMIT ' . $num
        ));
    }
    function getVeh($id) {
        return $this->findfirst(array(
            'condition' => 'AND id='. $id
        ));
    }
    function deleteVeh($id){
        $this->id = $id;
        return $this->delete();	
    }
    function updateField($id, $field, $value) {
        $sql = "UPDATE " . $this->table . " SET " . $field . " = :value WHERE id = :id";
        $sth = $this->db->prepare($sql);
        return $sth->execute([':value' => $value, ':id' => $id]);
    }

    function getAllPilotes() {
        $sql = "SELECT id, CONCAT(prenom, ' ', nom) as full_name FROM utilisateur WHERE role='pilote' OR role='admin'";
        $sth = $this->db->prepare($sql);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}