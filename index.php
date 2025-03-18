<?php
//index.php : dispatcheur ou routeur : pour aiguiller 
define ('WEBROOT', str_replace("index.php", "",$_SERVER['REQUEST_URI']));
define ('ROOT', str_replace("index.php", "",$_SERVER["SCRIPT_FILENAME"]));

//phpinfo();
require (ROOT. 'config/conf.php');
require (ROOT. 'core/model.php');
require (ROOT. 'core/controller.php');
require (ROOT.'core/session.php');

$chemin=explode("/", WEBROOT);

/*echo "<PRE>";
print_r($chemin);
echo "</PRE>";*/

define ('WEBROOT2', $chemin[1]);
//echo "WEBROOT2:".WEBROOT2."<br>";
if (empty($chemin[2])){
    $controller= "accueil";
} else {
    $controller= $chemin[2];
}
//echo "controller:".$controller."<br>";

if (empty($chemin[3])){
    $action = "index";
} else {
    $action = $chemin[3];
}

require (ROOT. 'controller/'.$controller.'.php');

//instanciation du controller 
$controller = new $controller();

//verifier l'existance de l'action demander 
if (method_exists($controller,$action)) {
    //$controller -> $action();
    unset($chemin[0]);
    unset($chemin[1]);
    unset($chemin[2]);
    unset($chemin[3]);

    call_user_func_array(array($controller, $action), $chemin);
} else {
    echo "erreur 404";
}