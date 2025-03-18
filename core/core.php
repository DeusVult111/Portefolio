<?php
$user = "root";
$pass  = "";
try {
    $dbh = new PDO('mysql:host=localhost;dbname=mvcd3',
        $user, $pass, array(PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_WARNING));
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

require "core/model.php";
?>