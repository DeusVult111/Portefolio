<?php
class courses extends controller {
    public $course;

    var $models = array('course');

    // Méthode principale pour afficher les courses
    function index() {
        $d = array();
        $d['cours'] = $this->course->getLast(999, null, null);
        $this->set($d);
        $this->render('index');
    }

    // Vue pour une course spécifique
    function view($id) {
        $d['cour'] = $this->course->getCour($id);
        $this->set($d);
        $this->render('view');
    }

    // Recherche AJAX de courses
    function ajaxListCourse($nom_course = null) {
        $cours = $this->course->getLast(99999, $nom_course, "LEFT");
        require (ROOT . 'views/courses/indexAjax.php');
    }

    // Mise à jour AJAX d'un champ de course
    function ajaxUpdateField() {
        if ($this->Session->isLogged() && !empty($_POST['id']) && !empty($_POST['field']) && isset($_POST['value'])) {
            $id = intval($_POST['id']);
            $field = htmlspecialchars($_POST['field']);
            $value = htmlspecialchars($_POST['value']);

            // Champs valides pour une course
            $validFields = ['nom_course', 'date_course', 'lieu', 'distance', 'description', 'etat'];
            if (in_array($field, $validFields)) {
                // Mise à jour dans le modèle
                $this->course->updateField($id, $field, $value);
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Champ invalide']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Données invalides']);
        }
        die();
    }

    function admin_delete($id) {
        if ($this->Session->isLogged()) {
            if ($this->course->deleteCour($id)) {
                $this->Session->setFlash("Suppression bien effectuée",'<i class="fas fa-times"></i>');
            } else {
                $this->Session->setFlash("Suppression impossible",'<i class="fas fa-times"></i>','danger');
            }
            return $this->index();
        } else {
            $this->Session->setFlash("Appli impiratable, passez votre chemin. Ton adresse  Ip "
                .$_SERVER['REMOTE_ADDR'].
                " a été interceptée par le commisariat de police du Puy-En-Velay",
                '<i class="fas fa-times"></i>',"danger");
            $this->render('index');
        }
    }
}
