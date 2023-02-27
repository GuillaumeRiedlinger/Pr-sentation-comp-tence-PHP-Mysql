<?php

include('../IdentifiantDB.php');

try {
    $db = new PDO("mysql:host=$hote; dbname=$nomdb; charset=utf8", $user, $password);

} catch (PDOException $e) {
    die('Erreur'.$e->getMessage());
}

?>