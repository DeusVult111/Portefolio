<?php
class course extends model {
    public $table = "course";
    public $id;
    public $nom_course;
    public $date_course;
    public $lieu;
    public $distance;
    public $description;
    public $etat;

    // Récupérer les dernières courses
    function getLast($num = 6, $nom_course = null, $joinleft = null) {
         // Condition par défaut pour éviter les erreurs SQL
    
        // Ajout de la condition pour le champ `nom_course` ou `lieu`
        $params = [];
        if (!empty($nom_course)) {
            $condition = " AND course.nom_course LIKE '%" . $nom_course . "%' OR course.lieu LIKE '%" . $nom_course . "%'";
        } else {
            $condition = "";  
        }
    
        // Préparation de la requête
        return $this->find(array(
            "fields" => "course.*",
            "condition" => $condition,
            "order" => "id ASC",
            "limit" => "LIMIT " . intval($num), // Sécurisation de la limite
        ));
    }
    

    // Récupérer une course spécifique
    function getCour($id) {
        return $this->findfirst(array(
            'condition' => 'id = :id',
            'params' => [':id' => $id]
        ));
    }

    function deleteCour($id){
        $this->id = $id;
        return $this->delete();
    }

    // Mise à jour d'un champ spécifique d'une course
    function updateField($id, $field, $value) {
        $sql = "UPDATE " . $this->table . " SET " . $field . " = :value WHERE id = :id";
        $sth = $this->db->prepare($sql);
        return $sth->execute([':value' => $value, ':id' => $id]);
    }
}
