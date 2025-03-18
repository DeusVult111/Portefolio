<?php
class statistique extends Model {
    //propriétés
    public $table="statistique";
    function getLast($num = 5) {
        return $this->find(array(
            'limit' => 'LIMIT ' . $num
        ));
    }
    function getStat($id) {
        return $this->findfirst(array(
            'condition' => 'AND id='. $id
        ));
    }
}