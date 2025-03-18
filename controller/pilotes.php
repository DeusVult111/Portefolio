<?php
class pilotes extends controller {
    public $pilote;

    var $models = array('pilote');
    function index()  {
        // Simulation réception de données revenant du modèle 
        $d = array();
        /*$d['cat'] = array (
            'id'=> "berline",
            'name'=> "berline",
            'ordre'=> 3
        );*/
        // Je rends la vue index 
        $d['pils'] = $this->pilote->getLast();
        $this->set($d);
        $this->render('index');
    }
    function view($id) {
        $d['pil'] = $this->pilote->getPil($id);
        $this-> set($d);
        $this->render('view');
    }
}