<?php

header("Content-Type: application/json");

include('IdentifiantDB.php');

$db = new PDO("mysql:host=$hote; dbname=$nomdb;charset=utf8", $user, $password);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$livres= $db->query('SELECT * FROM Commentaire');
     $Array = $livres->fetchAll();
    $json = json_encode($Array);
    echo $json;
//    echo json_encode($Array);

?>