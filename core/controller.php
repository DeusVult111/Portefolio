<?php
class controller {
    var $vars = array();
    protected $Session;
    protected $models;
    var $layout = "default";
    function __construct() {
        //chargement de tous nos modèles en mémoire
        if (isset($this->models)) {
            foreach ($this->models as $m) {
                $this->load($m);
            }
        }
        $this->Session = new Session();
    }

    function render($filename) {
        // On passe les données à la vue
        extract($this->vars);
    
        // Si aucun layout n'a été défini explicitement, déterminez le layout par défaut
        if ($this->Session->isLogged() && $this->Session->user('role') === 'admin') {
            $this->layout = 'admin';
        } else {
            $this->layout = 'default';
        }
    
        // Démarrage de la mise en mémoire tampon
        ob_start();
    
        // Chargement de la vue
        $viewFile = ROOT . 'views/' . get_class($this) . '/' . $filename . '.php';
        if (!file_exists($viewFile)) {
            throw new Exception("Vue introuvable : $viewFile");
        }
        require $viewFile;
    
        // Contenu de la vue
        $content_for_layout = ob_get_clean();
    
        // Chargement du layout
        if ($this->layout === false) {
            echo $content_for_layout; // Si aucun layout n'est défini, affichez directement la vue
        } else {
            $layoutFile = ROOT . 'views/layout/' . $this->layout . '.php';
            if (!file_exists($layoutFile)) {
                throw new Exception("Layout introuvable : $layoutFile");
            }
            require $layoutFile;
        }
    }
    
    

    function set ($d) {
        //fusion des données a envoyer avec les données 
        //deja presenté dans $vars
        $this ->vars = array_merge($this->vars, $d);
    }
    
    function load($name) {
        //chargement du model 
        require "model/".strtolower($name).".php";
        //je retourne une instance de ma classe passée en paramètre
        $this-> $name = new $name();
    }
}
