<?php
class statistiques extends controller {
    public $statistique;
    var $models = array('statistique');
    function index()  {
        // Simulation réception de données revenant du modèle 
        $d = array();
        /*$d['cat'] = array (
            'id'=> "berline",
            'name'=> "berline",
            'ordre'=> 3
        );*/
        // Je rends la vue index 
        $d['stats'] = $this->statistique->getLast();
        $this->set($d);
        $this->render('index');
    }
    function view($id) {
        $d['stat'] = $this->statistique->getStat($id);
        $this-> set($d);
        $this->render('view');
    }
}