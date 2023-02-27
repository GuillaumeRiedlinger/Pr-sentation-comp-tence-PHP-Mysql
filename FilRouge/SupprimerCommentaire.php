<?php
header('Content-Type: text/plain');

session_start();
include('IdentifiantDB.php');


$id_Commentaire = strip_tags($_GET['id']);

echo $id_Commentaire;

try {
    $db = new PDO("mysql:host=$hote; dbname=$nomdb; charset=utf8", $user, $password);
    $retour["success"] = true;
    $retour["message"] = "Connexion à la base de donnée réussi";
} catch (PDOException $e) {
    $retour["success"] = false;
    $retour["message"] = "Connexion à la base de donnée impossible";
}


$requete = $db->prepare("DELETE FROM `Commentaire` WHERE id_commentaire = $id_Commentaire ");
$requete->execute([]);

echo json_encode($retour);
?>
