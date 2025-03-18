<?php
class pilote extends Model {
    //propriétés
    public $table="utilisateur";
    function getLast($num = 10) {
        return $this->find(array(
            'fields' => 'DISTINCT *',
            'condition' => ' AND role="pilote"',
            'limit' => 'LIMIT ' . $num
        ));
    }
    function getPil ($id) {
        return $this->findfirst(array(
            'fields' => 'DISTINCT *',
            'condition' => ' AND id='. $id .' AND role="pilote"'
        ));
    }
}