<?php
header('Content-Type: application/json');

session_start();
include('IdentifiantDB.php');

try {
    $db = new PDO("mysql:host=$hote; dbname=$nomdb; charset=utf8", $user, $password);
    $retour["success"] = true;
    $retour["message"] = "Connexion à la base de donnée réussi";
} catch (PDOException $e) {
    $retour["success"] = false;
    $retour["message"] = "Connexion à la base de donnée impossible";
}

$id_Livre = strip_tags($_POST["id_Livre"]);
$note = strip_tags($_POST['note']);
$commentaire = strip_tags($_POST['commentaires']);


if (empty($_SESSION['user']['pseudo'])) {
    $retour["success"] = false;
    $retour["message"] = "Vous n'êtes pas connecté";

   
} else {

    if (!empty($id_Livre) && !empty($commentaire) && !empty($note)) {
        if (intval($note) <= 5 && intval($note) >= 0) {

            $requete = $db->prepare("INSERT INTO Commentaire (titre_Livre, note, commentaire, utilisateur) VALUES (:livre, :note, :commentaire, :utilisateur)");
            $requete->execute([

                ':livre' => $id_Livre,
                ':note' => $note,
                ':commentaire' => $commentaire,
                ':utilisateur' => $_SESSION['user']['pseudo'],

            ]);

            $retour["success"] = true;
            $retour["message"] = "Ajout du commentaire réussi.";
            $retour["results"] = array();


            header("location: Panier.php");
        } else {
            $retour["success"] = false;
            $retour["message"] = "La note n'est pas comprise entre 0 et 5.";
        }
    } else {
        $retour["success"] = false;
        $retour["message"] = "Il manque des infos.";
    }
}

echo json_encode($retour);
